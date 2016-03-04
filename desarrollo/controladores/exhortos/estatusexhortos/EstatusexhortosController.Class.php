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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estatusexhortos/EstatusexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estatusexhortos/EstatusexhortosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class EstatusexhortosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarEstatusexhortos($EstatusexhortosDto) {
        $EstatusexhortosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'", "", trim($EstatusexhortosDto->getcveEstatusExhorto()))));
        $EstatusexhortosDto->setdesEstatusExhorto(strtoupper(str_ireplace("'", "", trim($EstatusexhortosDto->getdesEstatusExhorto()))));
        $EstatusexhortosDto->setActivo(strtoupper(str_ireplace("'", "", trim($EstatusexhortosDto->getActivo()))));
        $EstatusexhortosDto->setFechaRegistro(strtoupper(str_ireplace("'", "", trim($EstatusexhortosDto->getFechaRegistro()))));
        $EstatusexhortosDto->setFechaActualizacion(strtoupper(str_ireplace("'", "", trim($EstatusexhortosDto->getFechaActualizacion()))));
        return $EstatusexhortosDto;
    }

    public function selectEstatusexhortos($EstatusexhortosDto, $param = null) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosDao = new EstatusexhortosDAO();
        $EstatusexhortosDto = $EstatusexhortosDao->selectEstatusexhortos($EstatusexhortosDto, "", null, $param, null);
        return $EstatusexhortosDto;
    }

    public function insertEstatusexhortos($EstatusexhortosDto, $proveedor = null) {
        //var_dump($EstatusexhortosDto);
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);

        $EstatusexhortosDao = new EstatusexhortosDAO();
//        echo "******\n";
//        var_dump($EstatusexhortosDto);
        $EstatusexhortosDto = $EstatusexhortosDao->insertEstatusexhortos($EstatusexhortosDto, $proveedor);
        $dtoToJson = new DtoToJson($EstatusexhortosDto);
        $this->bitacora($dtoToJson, "43", "Insert en estatus exhortos");
        
        return $EstatusexhortosDto;
    }

    public function updateEstatusexhortos($EstatusexhortosDto, $proveedor = null) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosDao = new EstatusexhortosDAO();
//$tmpDto = new EstatusexhortosDTO();
//$tmpDto = $EstatusexhortosDao->selectEstatusexhortos($EstatusexhortosDto,$proveedor);
//if($tmpDto!=""){//$EstatusexhortosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $EstatusexhortosDto = $EstatusexhortosDao->updateEstatusexhortos($EstatusexhortosDto, $proveedor);
        $dtoToJson = new DtoToJson($EstatusexhortosDto);
        $this->bitacora($dtoToJson, "44", "Update en estatus exhortos");
        return $EstatusexhortosDto;
//}
//return "";
    }

    public function deleteEstatusexhortos($EstatusexhortosDto, $proveedor = null) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosDao = new EstatusexhortosDAO();
        $EstatusexhortosDto = $EstatusexhortosDao->deleteEstatusexhortos($EstatusexhortosDto, $proveedor);
        return $EstatusexhortosDto;
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

    public function getPaginas($estatusexhortosDto, $param) {
        $EstatusexhortosDao = new EstatusexhortosDAO();
        $param["paginacion"] = false;
        $numTot = $EstatusexhortosDao->selectEstatusexhortos($estatusexhortosDto, null, "", null, " count(cveEstatusExhorto) as totalCount ");
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