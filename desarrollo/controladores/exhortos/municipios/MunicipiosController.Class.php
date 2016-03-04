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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/municipios/MunicipiosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/municipios/MunicipiosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class MunicipiosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarMunicipios($MunicipiosDto) {
        $MunicipiosDto->setcveMunicipio(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getcveMunicipio()))));
        $MunicipiosDto->setdesMunicipio(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getdesMunicipio()))));
        $MunicipiosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getcveEstado()))));
        $MunicipiosDto->setactivo(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getactivo()))));
        $MunicipiosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getfechaRegistro()))));
        $MunicipiosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($MunicipiosDto->getfechaActualizacion()))));
        return $MunicipiosDto;
    }

    public function selectMunicipios($MunicipiosDto, $param = null) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosDao = new MunicipiosDAO();
        $MunicipiosDto = $MunicipiosDao->selectMunicipios($MunicipiosDto, " ORDER BY desMunicipio ASC ", null, $param, null);
        return $MunicipiosDto;
    }

    public function insertMunicipios($MunicipiosDto, $proveedor = null) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosDao = new MunicipiosDAO();
        $MunicipiosDto = $MunicipiosDao->insertMunicipios($MunicipiosDto, $proveedor);
        $dtoToJson = new DtoToJson($MunicipiosDto);
        $this->bitacora($dtoToJson, "69", "Insert en ".get_class($this)."");
        return $MunicipiosDto;
    }

    public function updateMunicipios($MunicipiosDto, $proveedor = null) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosDao = new MunicipiosDAO();
//$tmpDto = new MunicipiosDTO();
//$tmpDto = $MunicipiosDao->selectMunicipios($MunicipiosDto,$proveedor);
//if($tmpDto!=""){//$MunicipiosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $MunicipiosDto = $MunicipiosDao->updateMunicipios($MunicipiosDto, $proveedor);
        $dtoToJson = new DtoToJson($MunicipiosDto);
        $this->bitacora($dtoToJson, "70", "Update en ".get_class($this)."");
        return $MunicipiosDto;
//}
//return "";
    }

    public function deleteMunicipios($MunicipiosDto, $proveedor = null) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosDao = new MunicipiosDAO();
        $MunicipiosDto = $MunicipiosDao->deleteMunicipios($MunicipiosDto, $proveedor);
        return $MunicipiosDto;
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

    public function getPaginas($MunicipiosDto, $param) {
        $MunicipiosDao = new MunicipiosDAO();
        $param["paginacion"] = false;
        $numTot = $MunicipiosDao->selectMunicipios($MunicipiosDto, null, "", null, " count(cveMunicipio) as totalCount ");
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