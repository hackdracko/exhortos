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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/materias/MateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/materias/MateriasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class MateriasController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarMaterias($MateriasDto) {
        $MateriasDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($MateriasDto->getcveMateria()))));
        $MateriasDto->setdesMateria(strtoupper(str_ireplace("'", "", trim($MateriasDto->getdesMateria()))));
        $MateriasDto->setactivo(strtoupper(str_ireplace("'", "", trim($MateriasDto->getactivo()))));
        $MateriasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($MateriasDto->getfechaRegistro()))));
        $MateriasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($MateriasDto->getfechaActualizacion()))));
        return $MateriasDto;
    }

    public function selectMaterias($MateriasDto, $param = null) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasDao = new MateriasDAO();
        $MateriasDto = $MateriasDao->selectMaterias($MateriasDto, " ORDER BY desMateria ASC ", null, $param, null);
        return $MateriasDto;
    }

    public function insertMaterias($MateriasDto, $proveedor = null) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasDao = new MateriasDAO();
        $MateriasDto = $MateriasDao->insertMaterias($MateriasDto, $proveedor);
        $dtoToJson = new DtoToJson($MateriasDto);
        $this->bitacora($dtoToJson, "63", "Insert en ".get_class($this)."");
        return $MateriasDto;
    }

    public function updateMaterias($MateriasDto, $proveedor = null) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasDao = new MateriasDAO();
//$tmpDto = new MateriasDTO();
//$tmpDto = $MateriasDao->selectMaterias($MateriasDto,$proveedor);
//if($tmpDto!=""){//$MateriasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $MateriasDto = $MateriasDao->updateMaterias($MateriasDto, $proveedor);
        $dtoToJson = new DtoToJson($MateriasDto);
        $this->bitacora($dtoToJson, "64", "Update en ".get_class($this)."");
        return $MateriasDto;
//}
//return "";
    }

    public function deleteMaterias($MateriasDto, $proveedor = null) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasDao = new MateriasDAO();
        $MateriasDto = $MateriasDao->deleteMaterias($MateriasDto, $proveedor);
        return $MateriasDto;
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
    public function getPaginas($MateriasDto, $param) {
        $MateriasDao = new MateriasDAO();
        $param["paginacion"] = false;
        $numTot = $MateriasDao->selectMaterias($MateriasDto, null, "", null, " count(cveMateria) as totalCount ");
//        echo $numTot;
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