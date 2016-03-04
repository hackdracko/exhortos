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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipos/TiposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/tipos/TiposController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TiposFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTipos($TiposDto) {
        $TiposDto->setcveTipo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getcveTipo(), "utf8") : strtoupper($TiposDto->getcveTipo()))))));
        if ($this->esFecha($TiposDto->getcveTipo())) {
            $TiposDto->setcveTipo($this->fechaMysql($TiposDto->getcveTipo()));
        }
        $TiposDto->setdesTipo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getdesTipo(), "utf8") : strtoupper($TiposDto->getdesTipo()))))));
        if ($this->esFecha($TiposDto->getdesTipo())) {
            $TiposDto->setdesTipo($this->fechaMysql($TiposDto->getdesTipo()));
        }
        $TiposDto->setdesCarpeta(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getdesCarpeta(), "utf8") : strtoupper($TiposDto->getdesCarpeta()))))));
        if ($this->esFecha($TiposDto->getdesCarpeta())) {
            $TiposDto->setdesCarpeta($this->fechaMysql($TiposDto->getdesCarpeta()));
        }
        $TiposDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getactivo(), "utf8") : strtoupper($TiposDto->getactivo()))))));
        if ($this->esFecha($TiposDto->getactivo())) {
            $TiposDto->setactivo($this->fechaMysql($TiposDto->getactivo()));
        }
        $TiposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getfechaRegistro(), "utf8") : strtoupper($TiposDto->getfechaRegistro()))))));
        if ($this->esFecha($TiposDto->getfechaRegistro())) {
            $TiposDto->setfechaRegistro($this->fechaMysql($TiposDto->getfechaRegistro()));
        }
        $TiposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposDto->getfechaActualizacion(), "utf8") : strtoupper($TiposDto->getfechaActualizacion()))))));
        if ($this->esFecha($TiposDto->getfechaActualizacion())) {
            $TiposDto->setfechaActualizacion($this->fechaMysql($TiposDto->getfechaActualizacion()));
        }
        return $TiposDto;
    }

    public function selectTipos($TiposDto, $param = null) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposController = new TiposController();
        $TiposDto = $TiposController->selectTipos($TiposDto, $param);
        if ($TiposDto != "") {
            $dtoToJson = new DtoToJson($TiposDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($TiposDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertTipos($TiposDto, $param) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposController = new TiposController();
        $param["like"] = true;
        $TiposDto->setActivo("S");
        $existe = $TiposController->selectTipos($TiposDto, $param);
        if ($existe == "") {
            $TiposDto = $TiposController->insertTipos($TiposDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TiposDto = $TiposController->insertTipos($TiposDto);
        if ($TiposDto != "") {
            $dtoToJson = new DtoToJson($TiposDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateTipos($TiposDto, $param) {
        $TiposDto = $this->validarTipos($TiposDto);
        $cloneTiposDto = clone $TiposDto;

        $TiposController = new TiposController();
        $cTiposDto = $TiposDto;
        $cTiposDto->setCveTipo("");
        if ($TiposDto->getActivo() == "N") {
            $TiposDto = $TiposController->updateTipos($cloneTiposDto);
            if ($TiposDto != "") {
                $dtoToJson = new DtoToJson($TiposDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cTiposDto->setActivo("S");
        $ext = $TiposController->selectTipos($cTiposDto, $param);
        if ($ext == "") {
            $TiposDto = $TiposController->updateTipos($cloneTiposDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TiposDto = $TiposController->updateTipos($TiposDto);
        if ($TiposDto != "") {
            $dtoToJson = new DtoToJson($TiposDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteTipos($TiposDto) {
        $TiposDto = $this->validarTipos($TiposDto);
        $TiposController = new TiposController();
        $TiposDto = $TiposController->deleteTipos($TiposDto);
        if ($TiposDto == true) {
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

    public function getPaginas($tiposDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $tiposDto = $this->validarTipos($tiposDto);
        $TiposController = new TiposController();
        $tiposDto = $TiposController->getPaginas($tiposDto, $param);
        if ($tiposDto != "") {
            return $tiposDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveTipo = $_POST["cveTipo"];
@$desTipo = $_POST["desTipo"];
@$desCarpeta = $_POST["desCarpeta"];
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

$tiposFacade = new TiposFacade();
$tiposDto = new TiposDTO();

$tiposDto->setCveTipo($cveTipo);
$tiposDto->setDesTipo($desTipo);
$tiposDto->setDesCarpeta($desCarpeta);
$tiposDto->setActivo($activo);
$tiposDto->setFechaRegistro($fechaRegistro);
$tiposDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveTipo == "")) {
    $tiposDto = $tiposFacade->insertTipos($tiposDto, $param);
    echo $tiposDto;
} else if (($accion == "guardar") && ($cveTipo != "")) {
    $tiposDto = $tiposFacade->updateTipos($tiposDto, $param);
    echo $tiposDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $tiposDto = $tiposFacade->selectTipos($tiposDto, $param);
    echo $tiposDto;
} else if (($accion == "baja") && ($cveTipo != "")) {
    $tiposDto = $tiposFacade->deleteTipos($tiposDto);
    echo $tiposDto;
} else if (($accion == "seleccionar") && ($cveTipo != "")) {
    $tiposDto = $tiposFacade->selectTipos($tiposDto);
    echo $tiposDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $tiposDto = $tiposFacade->selectTipos($tiposDto, $param);
    echo $tiposDto;
} else if ($accion == "getPaginas") {
    $tiposDto = $tiposFacade->getPaginas($tiposDto, $param);
    echo $tiposDto;
}
?>