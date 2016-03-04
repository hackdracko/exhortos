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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/distritos/DistritosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/distritos/DistritosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class DistritosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarDistritos($DistritosDto) {
        $DistritosDto->setcveDistrito(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getcveDistrito(), "utf8") : strtoupper($DistritosDto->getcveDistrito()))))));
        if ($this->esFecha($DistritosDto->getcveDistrito())) {
            $DistritosDto->setcveDistrito($this->fechaMysql($DistritosDto->getcveDistrito()));
        }
        $DistritosDto->setdesDistrito(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getdesDistrito(), "utf8") : strtoupper($DistritosDto->getdesDistrito()))))));
        if ($this->esFecha($DistritosDto->getdesDistrito())) {
            $DistritosDto->setdesDistrito($this->fechaMysql($DistritosDto->getdesDistrito()));
        }
        $DistritosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getcveEstado(), "utf8") : strtoupper($DistritosDto->getcveEstado()))))));
        if ($this->esFecha($DistritosDto->getcveEstado())) {
            $DistritosDto->setcveEstado($this->fechaMysql($DistritosDto->getcveEstado()));
        }
        $DistritosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getactivo(), "utf8") : strtoupper($DistritosDto->getactivo()))))));
        if ($this->esFecha($DistritosDto->getactivo())) {
            $DistritosDto->setactivo($this->fechaMysql($DistritosDto->getactivo()));
        }
        $DistritosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getfechaRegistro(), "utf8") : strtoupper($DistritosDto->getfechaRegistro()))))));
        if ($this->esFecha($DistritosDto->getfechaRegistro())) {
            $DistritosDto->setfechaRegistro($this->fechaMysql($DistritosDto->getfechaRegistro()));
        }
        $DistritosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($DistritosDto->getfechaActualizacion(), "utf8") : strtoupper($DistritosDto->getfechaActualizacion()))))));
        if ($this->esFecha($DistritosDto->getfechaActualizacion())) {
            $DistritosDto->setfechaActualizacion($this->fechaMysql($DistritosDto->getfechaActualizacion()));
        }
        return $DistritosDto;
    }

    public function selectDistritos($DistritosDto, $param = null) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosController = new DistritosController();
        $DistritosDto = $DistritosController->selectDistritos($DistritosDto, $param);
        if ($DistritosDto != "") {
            $dtoToJson = new DtoToJson($DistritosDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($DistritosDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertDistritos($DistritosDto) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosController = new DistritosController();
        $param["like"] = true;
        $DistritosDto->setActivo("S");
        $existe = $DistritosController->selectDistritos($DistritosDto, $param);
        if ($existe == "") {
            $DistritosDto = $DistritosController->insertDistritos($DistritosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $DistritosDto = $DistritosController->insertDistritos($DistritosDto);
        if ($DistritosDto != "") {
            $dtoToJson = new DtoToJson($DistritosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateDistritos($DistritosDto) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $cloneDistritosDto = clone $DistritosDto;

        $DistritosController = new DistritosController();
        $cDistritosDto = $DistritosDto;
        $cDistritosDto->setCveDistrito("");
        if ($DistritosDto->getActivo() == "N") {
            $DistritosDto = $DistritosController->updateDistritos($cloneDistritosDto);
            if ($DistritosDto != "") {
                $dtoToJson = new DtoToJson($DistritosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cDistritosDto->setActivo("S");
        $ext = $DistritosController->selectDistritos($cDistritosDto, $param);
        if ($ext == "") {
            $DistritosDto = $DistritosController->updateDistritos($cloneDistritosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $DistritosDto = $DistritosController->updateDistritos($DistritosDto);
        if ($DistritosDto != "") {
            $dtoToJson = new DtoToJson($DistritosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteDistritos($DistritosDto) {
        $DistritosDto = $this->validarDistritos($DistritosDto);
        $DistritosController = new DistritosController();
        $DistritosDto = $DistritosController->deleteDistritos($DistritosDto);
        if ($DistritosDto == true) {
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

    public function getPaginas($distritosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $distritosDto = $this->validarDistritos($distritosDto);
        $DistritosController = new DistritosController();
        $distritosDto = $DistritosController->getPaginas($distritosDto, $param);
        if ($distritosDto != "") {
            return $distritosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveDistrito = $_POST["cveDistrito"];
@$desDistrito = $_POST["desDistrito"];
@$cveEstado = $_POST["cveEstado"];
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

$distritosFacade = new DistritosFacade();
$distritosDto = new DistritosDTO();

$distritosDto->setCveDistrito($cveDistrito);
$distritosDto->setDesDistrito($desDistrito);
$distritosDto->setCveEstado($cveEstado);
$distritosDto->setActivo($activo);
$distritosDto->setFechaRegistro($fechaRegistro);
$distritosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveDistrito == "")) {
    $distritosDto = $distritosFacade->insertDistritos($distritosDto);
    echo $distritosDto;
} else if (($accion == "guardar") && ($cveDistrito != "")) {
    $distritosDto = $distritosFacade->updateDistritos($distritosDto);
    echo $distritosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $distritosDto = $distritosFacade->selectDistritos($distritosDto, $param);
    echo $distritosDto;
} else if (($accion == "baja") && ($cveDistrito != "")) {
    $distritosDto = $distritosFacade->deleteDistritos($distritosDto);
    echo $distritosDto;
} else if (($accion == "seleccionar") && ($cveDistrito != "")) {
    $distritosDto = $distritosFacade->selectDistritos($distritosDto);
    echo $distritosDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $distritosDto = $distritosFacade->selectDistritos($distritosDto, $param);
    echo $distritosDto;
} else if ($accion == "getPaginas") {
    $distritosDto = $distritosFacade->getPaginas($distritosDto, $param);
    echo $distritosDto;
}
?>