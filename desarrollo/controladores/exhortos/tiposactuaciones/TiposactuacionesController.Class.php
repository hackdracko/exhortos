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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposactuaciones/TiposactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tiposactuaciones/TiposactuacionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TiposactuacionesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTiposactuaciones($TiposactuacionesDto) {
        $TiposactuacionesDto->setcveTipoActuacion(strtoupper(str_ireplace("'", "", trim($TiposactuacionesDto->getcveTipoActuacion()))));
        $TiposactuacionesDto->setdesTipoActuacion(strtoupper(str_ireplace("'", "", trim($TiposactuacionesDto->getdesTipoActuacion()))));
        $TiposactuacionesDto->setactivo(strtoupper(str_ireplace("'", "", trim($TiposactuacionesDto->getactivo()))));
        $TiposactuacionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($TiposactuacionesDto->getfechaRegistro()))));
        $TiposactuacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($TiposactuacionesDto->getfechaActualizacion()))));
        return $TiposactuacionesDto;
    }

    public function selectTiposactuaciones($TiposactuacionesDto, $param = null) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesDao = new TiposactuacionesDAO();
        $TiposactuacionesDto = $TiposactuacionesDao->selectTiposactuaciones($TiposactuacionesDto, "", null, $param, null);
        return $TiposactuacionesDto;
    }

    public function insertTiposactuaciones($TiposactuacionesDto, $proveedor = null) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesDao = new TiposactuacionesDAO();
        $TiposactuacionesDto = $TiposactuacionesDao->insertTiposactuaciones($TiposactuacionesDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposactuacionesDto);
        $this->bitacora($dtoToJson, "47", "Insert en ".get_class($this)."");
        return $TiposactuacionesDto;
    }

    public function updateTiposactuaciones($TiposactuacionesDto, $proveedor = null) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesDao = new TiposactuacionesDAO();
//$tmpDto = new TiposactuacionesDTO();
//$tmpDto = $TiposactuacionesDao->selectTiposactuaciones($TiposactuacionesDto,$proveedor);
//if($tmpDto!=""){//$TiposactuacionesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $TiposactuacionesDto = $TiposactuacionesDao->updateTiposactuaciones($TiposactuacionesDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposactuacionesDto);
        $this->bitacora($dtoToJson, "48", "Update en ".get_class($this)."");
        return $TiposactuacionesDto;
//}
//return "";
    }

    public function deleteTiposactuaciones($TiposactuacionesDto, $proveedor = null) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesDao = new TiposactuacionesDAO();
        $TiposactuacionesDto = $TiposactuacionesDao->deleteTiposactuaciones($TiposactuacionesDto, $proveedor);
        return $TiposactuacionesDto;
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

    public function getPaginas($tiposactuacionesDto, $param) {
        $TiposactuacionesDao = new TiposactuacionesDAO();
        $param["paginacion"] = false;
        $numTot = $TiposactuacionesDao->selectTiposactuaciones($tiposactuacionesDto, null, "", null, " count(cveTipoActuacion) as totalCount ");
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