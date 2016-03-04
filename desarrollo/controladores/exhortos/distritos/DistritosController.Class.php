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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/distritos/DistritosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/distritos/DistritosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class DistritosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarDistritos($DistritosDto) {
        $DistritosDto->setcveDistrito(strtoupper(str_ireplace("'", "", trim($DistritosDto->getcveDistrito()))));
        $DistritosDto->setdesDistrito(strtoupper(str_ireplace("'", "", trim($DistritosDto->getdesDistrito()))));
        $DistritosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim($DistritosDto->getcveEstado()))));
        $DistritosDto->setactivo(strtoupper(str_ireplace("'", "", trim($DistritosDto->getactivo()))));
        $DistritosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($DistritosDto->getfechaRegistro()))));
        $DistritosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($DistritosDto->getfechaActualizacion()))));
        return $DistritosDto;
    }

    public function selectDistritos($DistritosDto, $param = null) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosDao = new DistritosDAO();
        $DistritosDto = $DistritosDao->selectDistritos($DistritosDto, "", null, $param, null);
        return $DistritosDto;
    }

    public function insertDistritos($DistritosDto, $proveedor = null) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosDao = new DistritosDAO();
        $DistritosDto = $DistritosDao->insertDistritos($DistritosDto, $proveedor);
        $dtoToJson = new DtoToJson($DistritosDto);
        $this->bitacora($dtoToJson, "67", "Insert en ".get_class($this)."");
        return $DistritosDto;
    }

    public function updateDistritos($DistritosDto, $proveedor = null) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosDao = new DistritosDAO();
//$tmpDto = new DistritosDTO();
//$tmpDto = $DistritosDao->selectDistritos($DistritosDto,$proveedor);
//if($tmpDto!=""){//$DistritosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $DistritosDto = $DistritosDao->updateDistritos($DistritosDto, $proveedor);
        $dtoToJson = new DtoToJson($DistritosDto);
        $this->bitacora($dtoToJson, "68", "Update en ".get_class($this)."");
        return $DistritosDto;
//}
//return "";
    }

    public function deleteDistritos($DistritosDto, $proveedor = null) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosDao = new DistritosDAO();
        $DistritosDto = $DistritosDao->deleteDistritos($DistritosDto, $proveedor);
        return $DistritosDto;
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

    public function getPaginas($DistritosDto, $param) {
        $DistritosDao = new DistritosDAO();
        $param["paginacion"] = false;
        $numTot = $DistritosDao->selectDistritos($DistritosDto, null, "", null, " count(cveDistrito) as totalCount ");
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