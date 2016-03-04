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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposactuaciones/TiposactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/tiposactuaciones/TiposactuacionesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TiposactuacionesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTiposactuaciones($TiposactuacionesDto) {
        $TiposactuacionesDto->setcveTipoActuacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposactuacionesDto->getcveTipoActuacion(), "utf8") : strtoupper($TiposactuacionesDto->getcveTipoActuacion()))))));
        if ($this->esFecha($TiposactuacionesDto->getcveTipoActuacion())) {
            $TiposactuacionesDto->setcveTipoActuacion($this->fechaMysql($TiposactuacionesDto->getcveTipoActuacion()));
        }
        $TiposactuacionesDto->setdesTipoActuacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposactuacionesDto->getdesTipoActuacion(), "utf8") : strtoupper($TiposactuacionesDto->getdesTipoActuacion()))))));
        if ($this->esFecha($TiposactuacionesDto->getdesTipoActuacion())) {
            $TiposactuacionesDto->setdesTipoActuacion($this->fechaMysql($TiposactuacionesDto->getdesTipoActuacion()));
        }
        $TiposactuacionesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposactuacionesDto->getactivo(), "utf8") : strtoupper($TiposactuacionesDto->getactivo()))))));
        if ($this->esFecha($TiposactuacionesDto->getactivo())) {
            $TiposactuacionesDto->setactivo($this->fechaMysql($TiposactuacionesDto->getactivo()));
        }
        $TiposactuacionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposactuacionesDto->getfechaRegistro(), "utf8") : strtoupper($TiposactuacionesDto->getfechaRegistro()))))));
        if ($this->esFecha($TiposactuacionesDto->getfechaRegistro())) {
            $TiposactuacionesDto->setfechaRegistro($this->fechaMysql($TiposactuacionesDto->getfechaRegistro()));
        }
        $TiposactuacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TiposactuacionesDto->getfechaActualizacion(), "utf8") : strtoupper($TiposactuacionesDto->getfechaActualizacion()))))));
        if ($this->esFecha($TiposactuacionesDto->getfechaActualizacion())) {
            $TiposactuacionesDto->setfechaActualizacion($this->fechaMysql($TiposactuacionesDto->getfechaActualizacion()));
        }
        return $TiposactuacionesDto;
    }

    public function selectTiposactuaciones($TiposactuacionesDto, $param = null) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesController = new TiposactuacionesController();
        $TiposactuacionesDto = $TiposactuacionesController->selectTiposactuaciones($TiposactuacionesDto, $param);
        if ($TiposactuacionesDto != "") {
            $dtoToJson = new DtoToJson($TiposactuacionesDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($TiposactuacionesDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertTiposactuaciones($TiposactuacionesDto, $param) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesController = new TiposactuacionesController();
        $param["like"] = true;
        $TiposactuacionesDto->setActivo("S");
        $existe = $TiposactuacionesController->selectTiposactuaciones($TiposactuacionesDto, $param);
        if ($existe == "") {
            $TiposactuacionesDto = $TiposactuacionesController->insertTiposactuaciones($TiposactuacionesDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TiposactuacionesDto = $TiposactuacionesController->insertTiposactuaciones($TiposactuacionesDto);
        if ($TiposactuacionesDto != "") {
            $dtoToJson = new DtoToJson($TiposactuacionesDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateTiposactuaciones($TiposactuacionesDto, $param) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $cloneTiposactuacionesDto = clone $TiposactuacionesDto;

        $TiposactuacionesController = new TiposactuacionesController();
        $cTiposactuacionesDto = $TiposactuacionesDto;
        $cTiposactuacionesDto->setCveTipoActuacion("");
        if ($TiposactuacionesDto->getActivo() == "N") {
            $TiposactuacionesDto = $TiposactuacionesController->updateTiposactuaciones($cloneTiposactuacionesDto);
            if ($TiposactuacionesDto != "") {
                $dtoToJson = new DtoToJson($TiposactuacionesDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cTiposactuacionesDto->setActivo("S");
        $ext = $TiposactuacionesController->selectTiposactuaciones($TiposactuacionesDto, $param);
        if ($ext == "") {
            $TiposactuacionesDto = $TiposactuacionesController->updateTiposactuaciones($cloneTiposactuacionesDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TiposactuacionesDto = $TiposactuacionesController->updateTiposactuaciones($TiposactuacionesDto);
        if ($TiposactuacionesDto != "") {
            $dtoToJson = new DtoToJson($TiposactuacionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteTiposactuaciones($TiposactuacionesDto) {
        $TiposactuacionesDto = $this->validarTiposactuaciones($TiposactuacionesDto);
        $TiposactuacionesController = new TiposactuacionesController();
        $TiposactuacionesDto = $TiposactuacionesController->deleteTiposactuaciones($TiposactuacionesDto);
        if ($TiposactuacionesDto == true) {
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

    public function getPaginas($tiposactuacionesDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $tiposactuacionesDto = $this->validarTiposactuaciones($tiposactuacionesDto);
        $TiposactuacionesController = new TiposactuacionesController();
        $tiposactuacionesDto = $TiposactuacionesController->getPaginas($tiposactuacionesDto, $param);
        if ($tiposactuacionesDto != "") {
            return $tiposactuacionesDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveTipoActuacion = $_POST["cveTipoActuacion"];
@$desTipoActuacion = $_POST["desTipoActuacion"];
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
$tiposactuacionesFacade = new TiposactuacionesFacade();
$tiposactuacionesDto = new TiposactuacionesDTO();

$tiposactuacionesDto->setCveTipoActuacion($cveTipoActuacion);
$tiposactuacionesDto->setDesTipoActuacion(htmlspecialchars($desTipoActuacion));
$tiposactuacionesDto->setActivo($activo);
$tiposactuacionesDto->setFechaRegistro($fechaRegistro);
$tiposactuacionesDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveTipoActuacion == "")) {
    $tiposactuacionesDto = $tiposactuacionesFacade->insertTiposactuaciones($tiposactuacionesDto, $param);
    echo $tiposactuacionesDto;
} else if (($accion == "guardar") && ($cveTipoActuacion != "")) {
    $tiposactuacionesDto = $tiposactuacionesFacade->updateTiposactuaciones($tiposactuacionesDto, $param);
    echo $tiposactuacionesDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = true;
    $tiposactuacionesDto = $tiposactuacionesFacade->selectTiposactuaciones($tiposactuacionesDto, $param);
    echo $tiposactuacionesDto;
} else if (($accion == "baja") && ($cveTipoActuacion != "")) {
    $tiposactuacionesDto = $tiposactuacionesFacade->deleteTiposactuaciones($tiposactuacionesDto);
    echo $tiposactuacionesDto;
} else if (($accion == "seleccionar") && ($cveTipoActuacion != "")) {
    $tiposactuacionesDto = $tiposactuacionesFacade->selectTiposactuaciones($tiposactuacionesDto);
    echo $tiposactuacionesDto;
} else if ($accion == "getPaginas") {
    $tiposactuacionesDto = $tiposactuacionesFacade->getPaginas($tiposactuacionesDto, $param);
    echo $tiposactuacionesDto;
} else if ($accion == "consultarGeneral") {
    $param["paginacion"] = false;
    $tiposactuacionesDto = $tiposactuacionesFacade->selectTiposactuaciones($tiposactuacionesDto, $param);
    echo $tiposactuacionesDto;
}
?>