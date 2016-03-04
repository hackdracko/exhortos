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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposdocumentos/TiposdocumentosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tiposdocumentos/TiposdocumentosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TiposdocumentosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTiposdocumentos($TiposdocumentosDto) {
        $TiposdocumentosDto->setcveTipoDocumento(strtoupper(str_ireplace("'", "", trim($TiposdocumentosDto->getcveTipoDocumento()))));
        $TiposdocumentosDto->setdescTipoDocumento(strtoupper(str_ireplace("'", "", trim($TiposdocumentosDto->getdescTipoDocumento()))));
        $TiposdocumentosDto->setactivo(strtoupper(str_ireplace("'", "", trim($TiposdocumentosDto->getactivo()))));
        $TiposdocumentosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($TiposdocumentosDto->getfechaRegistro()))));
        $TiposdocumentosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($TiposdocumentosDto->getfechaActualizacion()))));
        return $TiposdocumentosDto;
    }

    public function selectTiposdocumentos($TiposdocumentosDto, $param= null) {
        $TiposdocumentosDto = $this->validarTiposdocumentos($TiposdocumentosDto);
        $TiposdocumentosDao = new TiposdocumentosDAO();
        $TiposdocumentosDto = $TiposdocumentosDao->selectTiposdocumentos($TiposdocumentosDto, "", null, $param, null);
        return $TiposdocumentosDto;
    }

    public function insertTiposdocumentos($TiposdocumentosDto, $proveedor = null) {
        $TiposdocumentosDto = $this->validarTiposdocumentos($TiposdocumentosDto);
        $TiposdocumentosDao = new TiposdocumentosDAO();
        $TiposdocumentosDto = $TiposdocumentosDao->insertTiposdocumentos($TiposdocumentosDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposdocumentosDto);
        $this->bitacora($dtoToJson, "53", "Insert en ".get_class($this)."");
        return $TiposdocumentosDto;
    }

    public function updateTiposdocumentos($TiposdocumentosDto, $proveedor = null) {
        $TiposdocumentosDto = $this->validarTiposdocumentos($TiposdocumentosDto);
        $TiposdocumentosDao = new TiposdocumentosDAO();
//$tmpDto = new TiposdocumentosDTO();
//$tmpDto = $TiposdocumentosDao->selectTiposdocumentos($TiposdocumentosDto,$proveedor);
//if($tmpDto!=""){//$TiposdocumentosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $TiposdocumentosDto = $TiposdocumentosDao->updateTiposdocumentos($TiposdocumentosDto, $proveedor);
        $dtoToJson = new DtoToJson($TiposdocumentosDto);
        $this->bitacora($dtoToJson, "54", "Update en ".get_class($this)."");
        return $TiposdocumentosDto;
//}
//return "";
    }

    public function deleteTiposdocumentos($TiposdocumentosDto, $proveedor = null) {
        $TiposdocumentosDto = $this->validarTiposdocumentos($TiposdocumentosDto);
        $TiposdocumentosDao = new TiposdocumentosDAO();
        $TiposdocumentosDto = $TiposdocumentosDao->deleteTiposdocumentos($TiposdocumentosDto, $proveedor);
        return $TiposdocumentosDto;
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

    public function getPaginas($tiposdocumentosDto, $param) {
        $TiposDocumentosDao = new TiposdocumentosDAO();
        $param["paginacion"] = false;
        $numTot = $TiposDocumentosDao->selectTiposdocumentos($tiposdocumentosDto, null, "", null, " count(cveTipoDocumento) as totalCount ");
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