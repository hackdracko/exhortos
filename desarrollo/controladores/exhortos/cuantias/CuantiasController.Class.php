<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 CONTROLLER
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/cuantias/CuantiasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/cuantias/CuantiasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class CuantiasController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarCuantias($CuantiasDto) {
        $CuantiasDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim($CuantiasDto->getcveCuantia()))));
        $CuantiasDto->setdesCuantia(strtoupper(str_ireplace("'", "", trim($CuantiasDto->getdesCuantia()))));
        $CuantiasDto->setactivo(strtoupper(str_ireplace("'", "", trim($CuantiasDto->getactivo()))));
        $CuantiasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($CuantiasDto->getfechaRegistro()))));
        $CuantiasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($CuantiasDto->getfechaActualizacion()))));
        return $CuantiasDto;
    }

    public function selectCuantias($CuantiasDto, $param = null) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasDao = new CuantiasDAO();
        $CuantiasDto = $CuantiasDao->selectCuantias($CuantiasDto, " ORDER BY desCuantia ASC ", null, $param, null);
        return $CuantiasDto;
    }

    public function insertCuantias($CuantiasDto, $proveedor = null) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasDao = new CuantiasDAO();
        $CuantiasDto = $CuantiasDao->insertCuantias($CuantiasDto, $proveedor);
        $dtoToJson = new DtoToJson($CuantiasDto);
        $this->bitacora($dtoToJson, "61", "Insert en ".get_class($this)."");
        return $CuantiasDto;
    }

    public function updateCuantias($CuantiasDto, $proveedor = null) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasDao = new CuantiasDAO();
//$tmpDto = new CuantiasDTO();
//$tmpDto = $CuantiasDao->selectCuantias($CuantiasDto,$proveedor);
//if($tmpDto!=""){//$CuantiasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $CuantiasDto = $CuantiasDao->updateCuantias($CuantiasDto, $proveedor);
        $dtoToJson = new DtoToJson($CuantiasDto);
        $this->bitacora($dtoToJson, "62", "Update en ".get_class($this)."");
        return $CuantiasDto;
//}
//return "";
    }

    public function deleteCuantias($CuantiasDto, $proveedor = null) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasDao = new CuantiasDAO();
        $CuantiasDto = $CuantiasDao->deleteCuantias($CuantiasDto, $proveedor);
        return $CuantiasDto;
    }
    
    public function bitacora($dto_json, $accion, $mensaje) {
        $BitacoramovimientosDao = new BitacoramovimientosDAO();
        $BitacoramovimientosDto = new BitacoramovimientosDTO();
        $BitacoramovimientosDto->setCveAccion($accion);
        $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
        $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
        $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
        $BitacoramovimientosDto->setObservaciones($mensaje. " " . $dto_json->toJson($mensaje));
        $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto);
    }
    public function getPaginas($CuantiasDto, $param) {
        $CuantiasDao = new CuantiasDAO();
        $param["paginacion"] = false;
        $numTot = $CuantiasDao->selectCuantias($CuantiasDto, null, "", null, " count(cveCuantia) as totalCount ");
        $Pages = (int) $numTot[0]['totalCount'] / $param["cantxPag"];
        $restoPages = $numTot[0]['totalCount'] % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0]['totalCount'] . '",';
        $json .= '"data":[';
        $x = 1;

        if ($totPages >= 1) {
            for ($index = 1; $index <= $totPages; $index++) {

                $json .= "{";
                $json .= '"pagina":' . json_encode(utf8_encode($index)) . "";
                $json .= "}";
                $x++;
                if ($x <= ($totPages )) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":{"total":""},';
            $json .= '"total":"' . ($index - 1) . '"';
            $json .= "}";
        } else {
            $json .= "]}";
        }
        return $json;
    }
}

?>