<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 FACADES
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

session_start();
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospartes/TipospartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/tipospartes/TipospartesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TipospartesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTipospartes($TipospartesDto) {
        $TipospartesDto->setcveTipoParte(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospartesDto->getcveTipoParte(), "utf8") : strtoupper($TipospartesDto->getcveTipoParte()))))));
        if ($this->esFecha($TipospartesDto->getcveTipoParte())) {
            $TipospartesDto->setcveTipoParte($this->fechaMysql($TipospartesDto->getcveTipoParte()));
        }
        $TipospartesDto->setdescTipoParte(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospartesDto->getdescTipoParte(), "utf8") : strtoupper($TipospartesDto->getdescTipoParte()))))));
        if ($this->esFecha($TipospartesDto->getdescTipoParte())) {
            $TipospartesDto->setdescTipoParte($this->fechaMysql($TipospartesDto->getdescTipoParte()));
        }
        $TipospartesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospartesDto->getactivo(), "utf8") : strtoupper($TipospartesDto->getactivo()))))));
        if ($this->esFecha($TipospartesDto->getactivo())) {
            $TipospartesDto->setactivo($this->fechaMysql($TipospartesDto->getactivo()));
        }
        $TipospartesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospartesDto->getfechaActualizacion(), "utf8") : strtoupper($TipospartesDto->getfechaActualizacion()))))));
        if ($this->esFecha($TipospartesDto->getfechaActualizacion())) {
            $TipospartesDto->setfechaActualizacion($this->fechaMysql($TipospartesDto->getfechaActualizacion()));
        }
        $TipospartesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospartesDto->getfechaRegistro(), "utf8") : strtoupper($TipospartesDto->getfechaRegistro()))))));
        if ($this->esFecha($TipospartesDto->getfechaRegistro())) {
            $TipospartesDto->setfechaRegistro($this->fechaMysql($TipospartesDto->getfechaRegistro()));
        }
        return $TipospartesDto;
    }

    public function selectTipospartes($TipospartesDto, $param = null) {
        $TipospartesDto = $this->validarTipospartes($TipospartesDto);
        $TipospartesController = new TipospartesController();
        $TipospartesDto = $TipospartesController->selectTipospartes($TipospartesDto, $param);
        if ($TipospartesDto != "") {
            $dtoToJson = new DtoToJson($TipospartesDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($TipospartesDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertTipospartes($TipospartesDto) {
        $TipospartesDto = $this->validarTipospartes($TipospartesDto);
        $TipospartesController = new TipospartesController();
        $param["like"] = true;
        $TipospartesDto->setActivo("S");
        $existe = $TipospartesController->selectTipospartes($TipospartesDto,$param);
        if ($existe == "") {
            $TipospartesDto = $TipospartesController->insertTipospartes($TipospartesDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TipospartesDto = $TipospartesController->insertTipospartes($TipospartesDto);
        if ($TipospartesDto != "") {
            $dtoToJson = new DtoToJson($TipospartesDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateTipospartes($TipospartesDto) {
        $TipospartesDto = $this->validarTipospartes($TipospartesDto);
        $cloneTipospartesDto = clone $TipospartesDto;
        
        $TipospartesController = new TipospartesController();
        $cTipospartesDto = $TipospartesDto;
        $cTipospartesDto->setCveTipoParte("");
        if($TipospartesDto->getActivo() == "N"){
            $TipospartesDto = $TipospartesController->updateTipospartes($cloneTipospartesDto);
            if($TipospartesDto != ""){
                $dtoToJson = new DtoToJson($TipospartesDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cTipospartesDto->setActivo("S");
        $ext = $TipospartesController->selectTipospartes($cTipospartesDto, $param);
        if ($ext == "") {
            $TipospartesDto = $TipospartesController->updateTipospartes($cloneTipospartesDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TipospartesController = new TipospartesController();
//        $TipoCspartesDto = $TipospartesController->updateTipospartes($TipospartesDto);
        if ($TipospartesDto != "") {
            $dtoToJson = new DtoToJson($TipospartesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteTipospartes($TipospartesDto) {
        $TipospartesDto = $this->validarTipospartes($TipospartesDto);
        $TipospartesController = new TipospartesController();
        $TipospartesDto = $TipospartesController->deleteTipospartes($TipospartesDto);
        if ($TipospartesDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    private function esFecha($fecha) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
            return true;
        }
        return false;
    }

    private function esFechaMysql($fecha) {
        if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
            return true;
        }
        return false;
    }

    private function fechaMysql($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

    private function fechaNormal($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }
    public function getPaginas($tipospartesDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $tipospartesDto = $this->validarTipospartes($tipospartesDto);
        $TiposPartesController = new TipospartesController();
        $tipospartesDto = $TiposPartesController->getPaginas($tipospartesDto, $param);
        if ($tipospartesDto != "") {
            return $tipospartesDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
}

@$cveTipoParte = $_POST["cveTipoParte"];
@$descTipoParte = $_POST["descTipoParte"];
@$activo = $_POST["activo"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$accion = $_POST["accion"];
$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["fechaDesde"] = $_POST['txtFecInicialBusqueda'];
@$param["fechaHasta"] = $_POST['txtFecFinalBusqueda'];
@$param["generico"] = $_POST['generico'];
@$param["asigNumero"] = $_POST['asigNumero'];
$tipospartesFacade = new TipospartesFacade();
$tipospartesDto = new TipospartesDTO();

$tipospartesDto->setCveTipoParte($cveTipoParte);
$tipospartesDto->setDescTipoParte(htmlspecialchars($descTipoParte));
$tipospartesDto->setActivo($activo);
$tipospartesDto->setFechaActualizacion($fechaActualizacion);
$tipospartesDto->setFechaRegistro($fechaRegistro);

if (($accion == "guardar") && ($cveTipoParte == "")) {
    $tipospartesDto = $tipospartesFacade->insertTipospartes($tipospartesDto);
    echo $tipospartesDto;
} else if (($accion == "guardar") && ($cveTipoParte != "")) {
    $tipospartesDto = $tipospartesFacade->updateTipospartes($tipospartesDto);
    echo $tipospartesDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $tipospartesDto = $tipospartesFacade->selectTipospartes($tipospartesDto, $param);
    echo $tipospartesDto;
} else if (($accion == "baja") && ($cveTipoParte != "")) {
    $tipospartesDto = $tipospartesFacade->deleteTipospartes($tipospartesDto);
    echo $tipospartesDto;
} else if (($accion == "seleccionar") && ($cveTipoParte != "")) {
    $tipospartesDto = $tipospartesFacade->selectTipospartes($tipospartesDto);
    echo $tipospartesDto;
}else if ($accion == "getPaginas") {
    $tipospartesDto = $tipospartesFacade->getPaginas($tipospartesDto, $param);
    echo $tipospartesDto;
}else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $tipospartesDto = $tipospartesFacade->selectTipospartes($tipospartesDto, $param);
    echo $tipospartesDto;
}
?>