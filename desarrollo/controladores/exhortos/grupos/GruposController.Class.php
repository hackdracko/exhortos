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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/grupos/GruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/grupos/GruposDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class GruposController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarGrupos($GruposDto) {
        $GruposDto->setCveGrupo(strtoupper(str_ireplace("'", "", trim($GruposDto->getCveGrupo()))));
        $GruposDto->setNomGrupo(strtoupper(str_ireplace("'", "", trim($GruposDto->getNomGrupo()))));
        $GruposDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($GruposDto->getcveSistema()))));
        $GruposDto->setactivo(strtoupper(str_ireplace("'", "", trim($GruposDto->getactivo()))));
        $GruposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($GruposDto->getfechaRegistro()))));
        $GruposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($GruposDto->getfechaActualizacion()))));
        return $GruposDto;
    }

    public function selectGrupos($GruposDto, $param = null) {
        //var_dump($GruposDto);
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposDao = new GruposDAO();
        $GruposDto = $GruposDao->selectGrupos($GruposDto, "", null, $param, null);
        return $GruposDto;
    }

    public function selectGruposGenerico($GruposDto, $param) {
        //var_dump($GruposDto);
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposDao = new GruposDAO();
        $GruposDto = $GruposDao->selectGrupos($GruposDto, " order by NomGrupo ASC ", null, $param, null);
        return $GruposDto;
    }

    public function insertGrupos($GruposDto, $proveedor = null) {
        //var_dump($GruposDto);
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposDao = new GruposDAO();
        $GruposDto = $GruposDao->insertGrupos($GruposDto, $proveedor);
        $dtoToJson = new DtoToJson($GruposDto);
        $this->bitacora($dtoToJson, "57", "Insert en ".get_class($this)."");
        return $GruposDto;
    }

    public function updateGrupos($GruposDto, $proveedor = null) {
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposDao = new GruposDAO();
//$tmpDto = new GruposDTO();
//$tmpDto = $GruposDao->selectGrupos($GruposDto,$proveedor);
//if($tmpDto!=""){//$GruposDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $GruposDto = $GruposDao->updateGrupos($GruposDto, $proveedor);
        $dtoToJson = new DtoToJson($GruposDto);
        $this->bitacora($dtoToJson, "58", "Update en ".get_class($this)."");
        return $GruposDto;
//}
//return "";
    }

    public function deleteGrupos($GruposDto, $proveedor = null) {
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposDao = new GruposDAO();
        $GruposDto = $GruposDao->deleteGrupos($GruposDto, $proveedor);
        return $GruposDto;
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

    public function getPaginas($gruposDto, $param) {
        $GruposDao = new GruposDAO();
        $param["paginacion"] = false;
        $numTot = $GruposDao->selectGrupos($gruposDto, null, "", null, " count(CveGrupo) as totalCount ");
//        var_dump($numTot);
//        var_dump($param);
        $Pages = (int) $numTot[0]['totalCount'] / $param["cantxPag"];
        $restoPages = $numTot[0]['totalCount'] % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0]['totalCount'] . '",';
        $json .= '"data":[';
        $x = 1;
        //var_dump($totPages);
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
        //var_dump($json);
        return $json;
    }

}

?>