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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospersonas/TipospersonasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipospersonas/TipospersonasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TipospersonasController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTipospersonas($TipospersonasDto) {
        $TipospersonasDto->setcveTipoPersona(strtoupper(str_ireplace("'", "", trim($TipospersonasDto->getcveTipoPersona()))));
        $TipospersonasDto->setdesTipoPersona(strtoupper(str_ireplace("'", "", trim($TipospersonasDto->getdesTipoPersona()))));
        $TipospersonasDto->setactivo(strtoupper(str_ireplace("'", "", trim($TipospersonasDto->getactivo()))));
        $TipospersonasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($TipospersonasDto->getfechaRegistro()))));
        $TipospersonasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($TipospersonasDto->getfechaActualizacion()))));
        return $TipospersonasDto;
    }

    public function selectTipospersonas($TipospersonasDto, $param = null) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasDao = new TipospersonasDAO();
        $TipospersonasDto = $TipospersonasDao->selectTipospersonas($TipospersonasDto, " ORDER BY desTipoPersona ASC ", null, $param, null);
        return $TipospersonasDto;
    }

    public function insertTipospersonas($TipospersonasDto, $proveedor = null) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasDao = new TipospersonasDAO();
        $TipospersonasDto = $TipospersonasDao->insertTipospersonas($TipospersonasDto, $proveedor);
        $dtoToJson = new DtoToJson($TipospersonasDto);
        $this->bitacora($dtoToJson, "51", "Insert en ".get_class($this)."");
        return $TipospersonasDto;
    }

    public function updateTipospersonas($TipospersonasDto, $proveedor = null) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasDao = new TipospersonasDAO();
//$tmpDto = new TipospersonasDTO();
//$tmpDto = $TipospersonasDao->selectTipospersonas($TipospersonasDto,$proveedor);
//if($tmpDto!=""){//$TipospersonasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $TipospersonasDto = $TipospersonasDao->updateTipospersonas($TipospersonasDto, $proveedor);
        $dtoToJson = new DtoToJson($TipospersonasDto);
        $this->bitacora($dtoToJson, "52", "Update en ".get_class($this)."");
        return $TipospersonasDto;
//}
//return "";
    }

    public function deleteTipospersonas($TipospersonasDto, $proveedor = null) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasDao = new TipospersonasDAO();
        $TipospersonasDto = $TipospersonasDao->deleteTipospersonas($TipospersonasDto, $proveedor);
        return $TipospersonasDto;
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

    public function getPaginas($tipospersonasDto, $param) {
        $TipospersonasDao = new TipospersonasDAO();
        $param["paginacion"] = false;
        $numTot = $TipospersonasDao->selectTipospersonas($tipospersonasDto, null, "", null, " count(cveTipoPersona) as totalCount ");
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