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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/cuantias/CuantiasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/cuantias/CuantiasController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class CuantiasFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarCuantias($CuantiasDto) {
        $CuantiasDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($CuantiasDto->getcveCuantia(), "utf8") : strtoupper($CuantiasDto->getcveCuantia()))))));
        if ($this->esFecha($CuantiasDto->getcveCuantia())) {
            $CuantiasDto->setcveCuantia($this->fechaMysql($CuantiasDto->getcveCuantia()));
        }
        $CuantiasDto->setdesCuantia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($CuantiasDto->getdesCuantia(), "utf8") : strtoupper($CuantiasDto->getdesCuantia()))))));
        if ($this->esFecha($CuantiasDto->getdesCuantia())) {
            $CuantiasDto->setdesCuantia($this->fechaMysql($CuantiasDto->getdesCuantia()));
        }
        $CuantiasDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($CuantiasDto->getactivo(), "utf8") : strtoupper($CuantiasDto->getactivo()))))));
        if ($this->esFecha($CuantiasDto->getactivo())) {
            $CuantiasDto->setactivo($this->fechaMysql($CuantiasDto->getactivo()));
        }
        $CuantiasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($CuantiasDto->getfechaRegistro(), "utf8") : strtoupper($CuantiasDto->getfechaRegistro()))))));
        if ($this->esFecha($CuantiasDto->getfechaRegistro())) {
            $CuantiasDto->setfechaRegistro($this->fechaMysql($CuantiasDto->getfechaRegistro()));
        }
        $CuantiasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($CuantiasDto->getfechaActualizacion(), "utf8") : strtoupper($CuantiasDto->getfechaActualizacion()))))));
        if ($this->esFecha($CuantiasDto->getfechaActualizacion())) {
            $CuantiasDto->setfechaActualizacion($this->fechaMysql($CuantiasDto->getfechaActualizacion()));
        }
        return $CuantiasDto;
    }

    public function selectCuantias($CuantiasDto, $param = null) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasController = new CuantiasController();
        $CuantiasDto = $CuantiasController->selectCuantias($CuantiasDto, $param);
        if ($CuantiasDto != "") {
            $dtoToJson = new DtoToJson($CuantiasDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($CuantiasDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertCuantias($CuantiasDto) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasController = new CuantiasController();
        $param["like"] = true;
        $CuantiasDto->setActivo("S");
        $existe = $CuantiasController->selectCuantias($CuantiasDto,$param);
        if ($existe == "") {
            $CuantiasDto = $CuantiasController->insertCuantias($CuantiasDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $CuantiasDto = $CuantiasController->insertCuantias($CuantiasDto);
        if ($CuantiasDto != "") {
            $dtoToJson = new DtoToJson($CuantiasDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateCuantias($CuantiasDto) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $cloneCuantiasDto = clone $CuantiasDto;
        
        $CuantiasController = new CuantiasController();
        $cCuantiasDto = $CuantiasDto;
        $cCuantiasDto->setCveCuantia("");
        if($CuantiasDto->getActivo() == "N"){
            $CuantiasDto = $CuantiasController->updateCuantias($cloneCuantiasDto);
            if($CuantiasDto != ""){
                $dtoToJson = new DtoToJson($CuantiasDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cCuantiasDto->setActivo("S");
        $ext = $CuantiasController->selectCuantias($cCuantiasDto, $param);
        if ($ext == "") {
            $CuantiasDto = $CuantiasController->updateCuantias($cloneCuantiasDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $CuantiasDto = $CuantiasController->updateCuantias($CuantiasDto);
        if ($CuantiasDto != "") {
            $dtoToJson = new DtoToJson($CuantiasDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteCuantias($CuantiasDto) {
        $CuantiasDto = $this->validarCuantias($CuantiasDto);
        $CuantiasController = new CuantiasController();
        $CuantiasDto = $CuantiasController->deleteCuantias($CuantiasDto);
        if ($CuantiasDto == true) {
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
    public function getPaginas($cuantiasDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $cuantiasDto = $this->validarCuantias($cuantiasDto);
        $CuantiasController = new CuantiasController();
        $cuantiasDto = $CuantiasController->getPaginas($cuantiasDto, $param);
        if ($cuantiasDto != "") {
            return $cuantiasDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
}

@$cveCuantia = $_POST["cveCuantia"];
@$desCuantia = $_POST["desCuantia"];
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
$cuantiasFacade = new CuantiasFacade();
$cuantiasDto = new CuantiasDTO();

$cuantiasDto->setCveCuantia($cveCuantia);
$cuantiasDto->setDesCuantia($desCuantia);
$cuantiasDto->setActivo($activo);
$cuantiasDto->setFechaRegistro($fechaRegistro);
$cuantiasDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveCuantia == "")) {
    $cuantiasDto = $cuantiasFacade->insertCuantias($cuantiasDto);
    echo $cuantiasDto;
} else if (($accion == "guardar") && ($cveCuantia != "")) {
    $cuantiasDto = $cuantiasFacade->updateCuantias($cuantiasDto);
    echo $cuantiasDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $cuantiasDto = $cuantiasFacade->selectCuantias($cuantiasDto, $param);
    echo $cuantiasDto;
} else if (($accion == "baja") && ($cveCuantia != "")) {
    $cuantiasDto = $cuantiasFacade->deleteCuantias($cuantiasDto);
    echo $cuantiasDto;
} else if (($accion == "seleccionar") && ($cveCuantia != "")) {
    $cuantiasDto = $cuantiasFacade->selectCuantias($cuantiasDto);
    echo $cuantiasDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $cuantiasDto = $cuantiasFacade->selectCuantias($cuantiasDto, $param);
    echo $cuantiasDto;
} else if ($accion == "getPaginas") {
    $cuantiasDto = $cuantiasFacade->getPaginas($cuantiasDto, $param);
    echo $cuantiasDto;
}
?>