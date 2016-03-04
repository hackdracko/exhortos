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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipos/TiposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipos/TiposDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TiposController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTipos($TiposDto) {
        $TiposDto->setcveTipo(strtoupper(str_ireplace("'", "", trim($TiposDto->getcveTipo()))));
        $TiposDto->setdesTipo(strtoupper(str_ireplace("'", "", trim($TiposDto->getdesTipo()))));
        $TiposDto->setdesCarpeta(strtoupper(str_ireplace("'", "", trim($TiposDto->getdesCarpeta()))));
        $TiposDto->setactivo(strtoupper(str_ireplace("'", "", trim($TiposDto->getactivo()))));
        $TiposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($TiposDto->getfechaRegistro()))));
        $TiposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($TiposDto->getfechaActualizacion()))));
        return $TiposDto;
    }

    public function selectTipos($TiposDto, $param = null) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposDao = new TiposDAO();
        $TiposDto = $TiposDao->selectTipos($TiposDto, " ORDER BY desCarpeta ASC ", null, $param, null);
        return $TiposDto;
    }

    public function insertTipos($TiposDto, $proveedor = null) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposDao = new TiposDAO();
        $TiposDto = $TiposDao->insertTipos($TiposDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposDto);
        $this->bitacora($dtoToJson, "59", "Insert en ".get_class($this)."");
        return $TiposDto;
    }

    public function updateTipos($TiposDto, $proveedor = null) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposDao = new TiposDAO();
//$tmpDto = new TiposDTO();
//$tmpDto = $TiposDao->selectTipos($TiposDto,$proveedor);
//if($tmpDto!=""){//$TiposDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $TiposDto = $TiposDao->updateTipos($TiposDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposDto);
        $this->bitacora($dtoToJson, "60", "Update en ".get_class($this)."");
        return $TiposDto;
//}
//return "";
    }

    public function deleteTipos($TiposDto, $proveedor = null) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposDao = new TiposDAO();
        $TiposDto = $TiposDao->deleteTipos($TiposDto, $proveedor);
        return $TiposDto;
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

    public function getPaginas($TiposDto, $param) {
        $TiposDao = new TiposDAO();
        $param["paginacion"] = false;
        $numTot = $TiposDao->selectTipos($TiposDto, null, "", null, " count(cveTipo) as totalCount ");
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