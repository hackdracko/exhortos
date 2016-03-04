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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estados/EstadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estados/EstadosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class EstadosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarEstados($EstadosDto) {
        $EstadosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim($EstadosDto->getcveEstado()))));
        $EstadosDto->setdesEstado(strtoupper(str_ireplace("'", "", trim($EstadosDto->getdesEstado()))));
        $EstadosDto->seturlWebServices(str_ireplace("'", "", trim($EstadosDto->geturlWebServices())));
        $EstadosDto->setactivo(strtoupper(str_ireplace("'", "", trim($EstadosDto->getactivo()))));
        $EstadosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($EstadosDto->getfechaRegistro()))));
        $EstadosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($EstadosDto->getfechaActualizacion()))));
        return $EstadosDto;
    }

    public function selectEstados($EstadosDto, $param = null) {
        $EstadosDto = $this->validarEstados($EstadosDto);
        $EstadosDao = new EstadosDAO();
        $EstadosDto = $EstadosDao->selectEstados($EstadosDto, " ORDER BY desEstado ASC ", null, $param, null);
        return $EstadosDto;
    }

    public function insertEstados($EstadosDto, $proveedor = null) {
//        var_dump($EstadosDto);
        $EstadosDto = $this->validarEstados($EstadosDto);
//        var_dump($EstadosDto);
        $EstadosDao = new EstadosDAO();
        $EstadosDto = $EstadosDao->insertEstados($EstadosDto, $proveedor);
        $dtoToJson = new DtoToJson($EstadosDto);
        $this->bitacora($dtoToJson, "65", "Insert en ".get_class($this)."");
        return $EstadosDto;
    }

    public function updateEstados($EstadosDto, $proveedor = null) {
        $EstadosDto = $this->validarEstados($EstadosDto);
        $EstadosDao = new EstadosDAO();
//$tmpDto = new EstadosDTO();
//$tmpDto = $EstadosDao->selectEstados($EstadosDto,$proveedor);
//if($tmpDto!=""){//$EstadosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $EstadosDto = $EstadosDao->updateEstados($EstadosDto, $proveedor);
        $dtoToJson = new DtoToJson($EstadosDto);
        $this->bitacora($dtoToJson, "66", "Update en ".get_class($this)."");
        return $EstadosDto;
//}
//return "";
    }

    public function deleteEstados($EstadosDto, $proveedor = null) {
        $EstadosDto = $this->validarEstados($EstadosDto);
        $EstadosDao = new EstadosDAO();
        $EstadosDto = $EstadosDao->deleteEstados($EstadosDto, $proveedor);
        return $EstadosDto;
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

    public function getPaginas($estadosDto, $param) {
        $EstadosDao = new EstadosDAO();
        $param["paginacion"] = false;
        $numTot = $EstadosDao->selectEstados($estadosDto, null, "", null, " count(cveEstado) as totalCount ");
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