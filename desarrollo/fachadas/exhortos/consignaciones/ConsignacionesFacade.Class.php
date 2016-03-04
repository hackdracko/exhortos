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
define('WP_DEBUG', true); // enable debugging mode
ini_set("error_log", dirname(__FILE__) . "/../../../logs/ConsignacionesFacade.log");
ini_set("log_errors", 1);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);

session_start();
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/consignaciones/ConsignacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/consignaciones/ConsignacionesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class ConsignacionesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarConsignaciones($ConsignacionesDto) {
        $ConsignacionesDto->setcveConsignacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ConsignacionesDto->getcveConsignacion(), "utf8") : strtoupper($ConsignacionesDto->getcveConsignacion()))))));
        if ($this->esFecha($ConsignacionesDto->getcveConsignacion())) {
            $ConsignacionesDto->setcveConsignacion($this->fechaMysql($ConsignacionesDto->getcveConsignacion()));
        }
        $ConsignacionesDto->setdesConsignacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ConsignacionesDto->getdesConsignacion(), "utf8") : strtoupper($ConsignacionesDto->getdesConsignacion()))))));
        if ($this->esFecha($ConsignacionesDto->getdesConsignacion())) {
            $ConsignacionesDto->setdesConsignacion($this->fechaMysql($ConsignacionesDto->getdesConsignacion()));
        }
        $ConsignacionesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ConsignacionesDto->getactivo(), "utf8") : strtoupper($ConsignacionesDto->getactivo()))))));
        if ($this->esFecha($ConsignacionesDto->getactivo())) {
            $ConsignacionesDto->setactivo($this->fechaMysql($ConsignacionesDto->getactivo()));
        }
        $ConsignacionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ConsignacionesDto->getfechaRegistro(), "utf8") : strtoupper($ConsignacionesDto->getfechaRegistro()))))));
        if ($this->esFecha($ConsignacionesDto->getfechaRegistro())) {
            $ConsignacionesDto->setfechaRegistro($this->fechaMysql($ConsignacionesDto->getfechaRegistro()));
        }
        $ConsignacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ConsignacionesDto->getfechaActualizacion(), "utf8") : strtoupper($ConsignacionesDto->getfechaActualizacion()))))));
        if ($this->esFecha($ConsignacionesDto->getfechaActualizacion())) {
            $ConsignacionesDto->setfechaActualizacion($this->fechaMysql($ConsignacionesDto->getfechaActualizacion()));
        }
        return $ConsignacionesDto;
    }

    public function selectConsignaciones($ConsignacionesDto, $param  = null) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesController = new ConsignacionesController();
        $ConsignacionesDto = $ConsignacionesController->selectConsignaciones($ConsignacionesDto, $param);
        if ($ConsignacionesDto != "") {
            $dtoToJson = new DtoToJson($ConsignacionesDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($ConsignacionesDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertConsignaciones($ConsignacionesDto) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesController = new ConsignacionesController();
        $param["like"] = true;
        $existe = $ConsignacionesController->selectConsignaciones($ConsignacionesDto,$param);
        if ($existe == "") {
            $ConsignacionesDto = $ConsignacionesController->insertConsignaciones($ConsignacionesDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $ConsignacionesDto = $ConsignacionesController->insertConsignaciones($ConsignacionesDto);
        if ($ConsignacionesDto != "") {
            $dtoToJson = new DtoToJson($ConsignacionesDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateConsignaciones($ConsignacionesDto) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $cloneConsignacionesDto = clone $ConsignacionesDto;
        
        $ConsignacionesController = new ConsignacionesController();
        $cConsignacionesDto = $ConsignacionesDto;
        $cConsignacionesDto->setCveConsignacion("");
        if($ConsignacionesDto->getActivo() == "N"){
            $ConsignacionesDto = $ConsignacionesController->updateConsignaciones($cloneConsignacionesDto);
            if($ConsignacionesDto != ""){
                $dtoToJson = new DtoToJson($ConsignacionesDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cConsignacionesDto->setActivo("S");
        $ext = $ConsignacionesController->selectConsignaciones($cConsignacionesDto, $param);
        if ($ext == "") {
            $ConsignacionesDto = $ConsignacionesController->updateConsignaciones($cloneConsignacionesDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $ConsignacionesDto = $ConsignacionesController->updateConsignaciones($ConsignacionesDto);
        if ($ConsignacionesDto != "") {
            $dtoToJson = new DtoToJson($ConsignacionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteConsignaciones($ConsignacionesDto) {
        $ConsignacionesDto = $this->validarConsignaciones($ConsignacionesDto);
        $ConsignacionesController = new ConsignacionesController();
        $ConsignacionesDto = $ConsignacionesController->deleteConsignaciones($ConsignacionesDto);
        if ($ConsignacionesDto == true) {
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
    public function getPaginas($consignacionesDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $consignacionesDto = $this->validarConsignaciones($consignacionesDto);
        $ConsignacionesController = new ConsignacionesController();
        $consignacionesDto = $ConsignacionesController->getPaginas($consignacionesDto, $param);
        if ($consignacionesDto != "") {
            return $consignacionesDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveConsignacion = $_POST["cveConsignacion"];
@$desConsignacion = $_POST["desConsignacion"];
@$activo = $_POST["activo"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];
$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["fechaDesde"] = $_POST['txtFecInicialBusqueda'];
@$param["fechaHasta"] = $_POST['txtFecFinalBusqueda'];
@$param["generico"] = $_POST['generico'];
@$param["asigNumero"] = $_POST['asigNumero'];
$consignacionesFacade = new ConsignacionesFacade();
$consignacionesDto = new ConsignacionesDTO();

$consignacionesDto->setCveConsignacion($cveConsignacion);
$consignacionesDto->setDesConsignacion(htmlspecialchars($desConsignacion));
$consignacionesDto->setActivo($activo);
$consignacionesDto->setFechaRegistro($fechaRegistro);
$consignacionesDto->setFechaActualizacion($fechaActualizacion);
if (($accion == "guardar") && ($cveConsignacion == "")) {
    $consignacionesDto = $consignacionesFacade->insertConsignaciones($consignacionesDto);
    echo $consignacionesDto;
} else if (($accion == "guardar") && ($cveConsignacion != "")) {
    $consignacionesDto = $consignacionesFacade->updateConsignaciones($consignacionesDto);
    echo $consignacionesDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = true;
    $consignacionesDto = $consignacionesFacade->selectConsignaciones($consignacionesDto, $param);
    echo $consignacionesDto;
} else if (($accion == "baja") && ($cveConsignacion != "")) {
    $consignacionesDto = $consignacionesFacade->deleteConsignaciones($consignacionesDto);
    echo $consignacionesDto;
} else if (($accion == "seleccionar") && ($cveConsignacion != "")) {
    $consignacionesDto = $consignacionesFacade->selectConsignaciones($consignacionesDto);
    echo $consignacionesDto;
} else if ($accion == "getPaginas") {
    $consignacionesDto = $consignacionesFacade->getPaginas($consignacionesDto, $param);
    echo $consignacionesDto;
}
?>