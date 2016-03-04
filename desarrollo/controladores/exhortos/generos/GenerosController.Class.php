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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/generos/GenerosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/generos/GenerosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class GenerosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarGeneros($GenerosDto) {
        $GenerosDto->setcveGenero(strtoupper(str_ireplace("'", "", trim($GenerosDto->getcveGenero()))));
        $GenerosDto->setdesGenero(strtoupper(str_ireplace("'", "", trim($GenerosDto->getdesGenero()))));
        $GenerosDto->setactivo(strtoupper(str_ireplace("'", "", trim($GenerosDto->getactivo()))));
        $GenerosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($GenerosDto->getfechaRegistro()))));
        $GenerosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($GenerosDto->getfechaActualizacion()))));
        return $GenerosDto;
    }

    public function selectGeneros($GenerosDto, $param = null) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosDao = new GenerosDAO();
        $GenerosDto = $GenerosDao->selectGeneros($GenerosDto, "", null, $param, null);
        return $GenerosDto;
    }

    public function insertGeneros($GenerosDto, $proveedor = null) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosDao = new GenerosDAO();
        $GenerosDto = $GenerosDao->insertGeneros($GenerosDto, $proveedor);
        $dtoToJson = new DtoToJson($GenerosDto);
        $this->bitacora($dtoToJson, "45", "Insert en ".get_class($this)."");
        return $GenerosDto;
    }

    public function updateGeneros($GenerosDto, $proveedor = null) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosDao = new GenerosDAO();
//$tmpDto = new GenerosDTO();
//$tmpDto = $GenerosDao->selectGeneros($GenerosDto,$proveedor);
//if($tmpDto!=""){//$GenerosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $GenerosDto = $GenerosDao->updateGeneros($GenerosDto, $proveedor);
        $dtoToJson = new DtoToJson($GenerosDto);
        $this->bitacora($dtoToJson, "46", "Update en ".get_class($this)."");
        return $GenerosDto;
//}
//return "";
    }

    public function deleteGeneros($GenerosDto, $proveedor = null) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosDao = new GenerosDAO();
        $GenerosDto = $GenerosDao->deleteGeneros($GenerosDto, $proveedor);
        return $GenerosDto;
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

    public function getPaginas($generosDto, $param) {
        $GenerosDao = new GenerosDAO();
        $param["paginacion"] = false;
        $numTot = $GenerosDao->selectGeneros($generosDto, null, "", null, " count(cveGenero) as totalCount ");
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