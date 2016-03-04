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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/consignaciones/ConsignacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/consignaciones/ConsignacionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class ConsignacionesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarConsignaciones($ConsignacionesDto) {
        $ConsignacionesDto->setcveConsignacion(strtoupper(str_ireplace("'", "", trim($ConsignacionesDto->getcveConsignacion()))));
        $ConsignacionesDto->setdesConsignacion(strtoupper(str_ireplace("'", "", trim($ConsignacionesDto->getdesConsignacion()))));
        $ConsignacionesDto->setactivo(strtoupper(str_ireplace("'", "", trim($ConsignacionesDto->getactivo()))));
        $ConsignacionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($ConsignacionesDto->getfechaRegistro()))));
        $ConsignacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($ConsignacionesDto->getfechaActualizacion()))));
        return $ConsignacionesDto;
    }

    public function selectConsignaciones($ConsignacionesDto, $param = null) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesDao = new ConsignacionesDAO();
        $ConsignacionesDto = $ConsignacionesDao->selectConsignaciones($ConsignacionesDto, "", null, $param, null);
        return $ConsignacionesDto;
    }

    public function insertConsignaciones($ConsignacionesDto, $proveedor = null) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesDao = new ConsignacionesDAO();
        $ConsignacionesDto = $ConsignacionesDao->insertConsignaciones($ConsignacionesDto, $proveedor);
        $dtoToJson = new DtoToJson($ConsignacionesDto);
        $this->bitacora($dtoToJson, "55", "Insert en ".get_class($this)."");
        return $ConsignacionesDto;
    }

    public function updateConsignaciones($ConsignacionesDto, $proveedor = null) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesDao = new ConsignacionesDAO();
//$tmpDto = new ConsignacionesDTO();
//$tmpDto = $ConsignacionesDao->selectConsignaciones($ConsignacionesDto,$proveedor);
//if($tmpDto!=""){//$ConsignacionesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ConsignacionesDto = $ConsignacionesDao->updateConsignaciones($ConsignacionesDto, $proveedor);
        $dtoToJson = new DtoToJson($ConsignacionesDto);
        $this->bitacora($dtoToJson, "56", "Update en ".get_class($this)."");
        return $ConsignacionesDto;
//}
//return "";
    }

    public function deleteConsignaciones($ConsignacionesDto, $proveedor = null) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesDao = new ConsignacionesDAO();
        $ConsignacionesDto = $ConsignacionesDao->deleteConsignaciones($ConsignacionesDto, $proveedor);
        return $ConsignacionesDto;
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

    public function getPaginas($consignacionesDto, $param) {
        $ConsignacionesDao = new ConsignacionesDAO();
        $param["paginacion"] = false;
        $numTot = $ConsignacionesDao->selectConsignaciones($consignacionesDto, null, "", null, " count(cveConsignacion) as totalCount ");
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