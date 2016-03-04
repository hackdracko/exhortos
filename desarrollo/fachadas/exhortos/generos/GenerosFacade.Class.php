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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/generos/GenerosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/generos/GenerosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class GenerosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarGeneros($GenerosDto) {
        $GenerosDto->setcveGenero(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GenerosDto->getcveGenero(), "utf8") : strtoupper($GenerosDto->getcveGenero()))))));
        if ($this->esFecha($GenerosDto->getcveGenero())) {
            $GenerosDto->setcveGenero($this->fechaMysql($GenerosDto->getcveGenero()));
        }
        $GenerosDto->setdesGenero(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GenerosDto->getdesGenero(), "utf8") : strtoupper($GenerosDto->getdesGenero()))))));
        if ($this->esFecha($GenerosDto->getdesGenero())) {
            $GenerosDto->setdesGenero($this->fechaMysql($GenerosDto->getdesGenero()));
        }
        $GenerosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GenerosDto->getactivo(), "utf8") : strtoupper($GenerosDto->getactivo()))))));
        if ($this->esFecha($GenerosDto->getactivo())) {
            $GenerosDto->setactivo($this->fechaMysql($GenerosDto->getactivo()));
        }
        $GenerosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GenerosDto->getfechaRegistro(), "utf8") : strtoupper($GenerosDto->getfechaRegistro()))))));
        if ($this->esFecha($GenerosDto->getfechaRegistro())) {
            $GenerosDto->setfechaRegistro($this->fechaMysql($GenerosDto->getfechaRegistro()));
        }
        $GenerosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GenerosDto->getfechaActualizacion(), "utf8") : strtoupper($GenerosDto->getfechaActualizacion()))))));
        if ($this->esFecha($GenerosDto->getfechaActualizacion())) {
            $GenerosDto->setfechaActualizacion($this->fechaMysql($GenerosDto->getfechaActualizacion()));
        }
        return $GenerosDto;
    }

    public function selectGeneros($GenerosDto, $param= null) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosController = new GenerosController();
        $GenerosDto = $GenerosController->selectGeneros($GenerosDto, $param);
        if ($GenerosDto != "") {
            $dtoToJson = new DtoToJson($GenerosDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($GenerosDto));
//            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertGeneros($GenerosDto) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosController = new GenerosController();
        $param["like"] = true;
//        $param["paginacion"] = true;
        
        $GenerosDto->setActivo("S");
        $existe = $GenerosController->selectGeneros($GenerosDto, $param);
        if ($existe == "") {
            $GenerosDto = $GenerosController->insertGeneros($GenerosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
        if ($GenerosDto != "") {
            $dtoToJson = new DtoToJson($GenerosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateGeneros($GenerosDto) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $cloneGenero = clone $GenerosDto;

        $GenerosController = new GenerosController();
        $cGenerosDto = $GenerosDto;
        $cGenerosDto->setCveGenero("");
        if ($GenerosDto->getActivo() == "N") {
            $GenerosDto = $GenerosController->updateGeneros($cloneGenero);
            if ($GenerosDto != "") {
                $dtoToJson = new DtoToJson($GenerosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cGenerosDto->setActivo("S");
        $ext = $GenerosController->selectGeneros($cGenerosDto, $param);
        if ($ext == "") {
            $GenerosDto = $GenerosController->updateGeneros($cloneGenero);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
        if ($GenerosDto != "") {
            $dtoToJson = new DtoToJson($GenerosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteGeneros($GenerosDto) {
        $GenerosDto = $this->validarGeneros($GenerosDto);
        $GenerosController = new GenerosController();
        $GenerosDto = $GenerosController->deleteGeneros($GenerosDto);
        if ($GenerosDto == true) {
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

    public function getPaginas($generosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $generosDto = $this->validarGeneros($generosDto);
        $GenerosController = new GenerosController();
        $generosDto = $GenerosController->getPaginas($generosDto, $param);
        if ($generosDto != "") {
            return $generosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveGenero = $_POST["cveGenero"];
@$desGenero = $_POST["desGenero"];
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
@$param["like"] = $_POST['like'];

$generosFacade = new GenerosFacade();
$generosDto = new GenerosDTO();

$generosDto->setCveGenero($cveGenero);
$generosDto->setDesGenero(htmlspecialchars($desGenero));
$generosDto->setActivo($activo);
$generosDto->setFechaRegistro($fechaRegistro);
$generosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveGenero == "")) {
    $generosDto = $generosFacade->insertGeneros($generosDto);
    echo $generosDto;
} else if (($accion == "guardar") && ($cveGenero != "")) {
    $generosDto = $generosFacade->updateGeneros($generosDto);
    echo $generosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = true;
    $generosDto = $generosFacade->selectGeneros($generosDto, $param);
    echo $generosDto;
} else if (($accion == "baja") && ($cveGenero != "")) {
    $generosDto = $generosFacade->deleteGeneros($generosDto);
    echo $generosDto;
} else if (($accion == "seleccionar") && ($cveGenero != "")) {
    $generosDto = $generosFacade->selectGeneros($generosDto, $param);
    echo $generosDto;
} else if ($accion == "getPaginas") {
    $generosDto = $generosFacade->getPaginas($generosDto, $param);
    echo $generosDto;
}
?>