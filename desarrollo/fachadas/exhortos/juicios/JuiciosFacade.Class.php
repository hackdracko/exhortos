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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juicios/JuiciosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juicios/JuiciosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class JuiciosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuicios($JuiciosDto) {
        $JuiciosDto->setcveJuicio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getcveJuicio(), "utf8") : strtoupper($JuiciosDto->getcveJuicio()))))));
        if ($this->esFecha($JuiciosDto->getcveJuicio())) {
            $JuiciosDto->setcveJuicio($this->fechaMysql($JuiciosDto->getcveJuicio()));
        }
        $JuiciosDto->setcveMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getcveMateria(), "utf8") : strtoupper($JuiciosDto->getcveMateria()))))));
        if ($this->esFecha($JuiciosDto->getcveMateria())) {
            $JuiciosDto->setcveMateria($this->fechaMysql($JuiciosDto->getcveMateria()));
        }
        $JuiciosDto->setdesJuicioDelito(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getdesJuicioDelito(), "utf8") : strtoupper($JuiciosDto->getdesJuicioDelito()))))));
        if ($this->esFecha($JuiciosDto->getdesJuicioDelito())) {
            $JuiciosDto->setdesJuicioDelito($this->fechaMysql($JuiciosDto->getdesJuicioDelito()));
        }
        $JuiciosDto->setfundamento(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getfundamento(), "utf8") : strtoupper($JuiciosDto->getfundamento()))))));
        if ($this->esFecha($JuiciosDto->getfundamento())) {
            $JuiciosDto->setfundamento($this->fechaMysql($JuiciosDto->getfundamento()));
        }
        $JuiciosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getactivo(), "utf8") : strtoupper($JuiciosDto->getactivo()))))));
        if ($this->esFecha($JuiciosDto->getactivo())) {
            $JuiciosDto->setactivo($this->fechaMysql($JuiciosDto->getactivo()));
        }
        $JuiciosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getfechaRegistro(), "utf8") : strtoupper($JuiciosDto->getfechaRegistro()))))));
        if ($this->esFecha($JuiciosDto->getfechaRegistro())) {
            $JuiciosDto->setfechaRegistro($this->fechaMysql($JuiciosDto->getfechaRegistro()));
        }
        $JuiciosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuiciosDto->getfechaActualizacion(), "utf8") : strtoupper($JuiciosDto->getfechaActualizacion()))))));
        if ($this->esFecha($JuiciosDto->getfechaActualizacion())) {
            $JuiciosDto->setfechaActualizacion($this->fechaMysql($JuiciosDto->getfechaActualizacion()));
        }
        return $JuiciosDto;
    }

    public function selectJuicios($JuiciosDto) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosController = new JuiciosController();
        $JuiciosDto = $JuiciosController->selectJuicios($JuiciosDto);
        if ($JuiciosDto != "") {
            $dtoToJson = new DtoToJson($JuiciosDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectJuiciosPaginacion($JuiciosDto, $param = null) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosController = new JuiciosController();
        $JuiciosDto = $JuiciosController->selectJuiciosPaginacion($JuiciosDto, $param);
        if ($JuiciosDto != "") {
           $dtoToJson = new DtoToJson($JuiciosDto);
           return $dtoToJson->toJsonPaginado($param["pag"], count($JuiciosDto));
//            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertJuicios($JuiciosDto) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosController = new JuiciosController();
        $param["like"] = true;
        $JuiciosDto->setActivo("S");
        $existe = $JuiciosController->selectJuicios($JuiciosDto, $param);
        if ($existe == "") {
            $JuiciosDto = $JuiciosController->insertJuicios($JuiciosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuiciosDto = $JuiciosController->insertJuicios($JuiciosDto);
        if ($JuiciosDto != "") {
            $dtoToJson = new DtoToJson($JuiciosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateJuicios($JuiciosDto) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $cloneJuiciosDto = clone $JuiciosDto;
        
        $JuiciosController = new JuiciosController();
        $cJuiciosDto = $JuiciosDto;
        $cJuiciosDto->setCveJuicio("");
        if ($JuiciosDto->getActivo() == "N") {
            $JuiciosDto = $JuiciosController->updateJuicios($cloneJuiciosDto);
            if ($JuiciosDto != "") {
                $dtoToJson = new DtoToJson($JuiciosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cJuiciosDto->setActivo("S");
        $ext = $JuiciosController->selectJuicios($cJuiciosDto, $param);
        if ($ext == "") {
            $JuiciosDto = $JuiciosController->updateJuicios($cloneJuiciosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuiciosDto = $JuiciosController->updateJuicios($JuiciosDto);
        if ($JuiciosDto != "") {
            $dtoToJson = new DtoToJson($JuiciosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteJuicios($JuiciosDto) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosController = new JuiciosController();
        $JuiciosDto = $JuiciosController->deleteJuicios($JuiciosDto);
        if ($JuiciosDto == true) {
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
    public function getPaginas($JuiciosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosController = new JuiciosController();
        $JuiciosDto = $JuiciosController->getPaginas($JuiciosDto, $param);
        if ($JuiciosDto != "") {
            return $JuiciosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
}

@$cveJuicio = $_POST["cveJuicio"];
@$cveMateria = $_POST["cveMateria"];
@$desJuicioDelito = $_POST["desJuicioDelito"];
@$fundamento = $_POST["fundamento"];
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

$juiciosFacade = new JuiciosFacade();
$juiciosDto = new JuiciosDTO();

$juiciosDto->setCveJuicio($cveJuicio);
$juiciosDto->setCveMateria($cveMateria);
$juiciosDto->setDesJuicioDelito($desJuicioDelito);
$juiciosDto->setFundamento($fundamento);
$juiciosDto->setActivo($activo);
$juiciosDto->setFechaRegistro($fechaRegistro);
$juiciosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveJuicio == "")) {
    $juiciosDto = $juiciosFacade->insertJuicios($juiciosDto);
    echo $juiciosDto;
} else if (($accion == "guardar") && ($cveJuicio != "")) {
    $juiciosDto = $juiciosFacade->updateJuicios($juiciosDto);
    echo $juiciosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $juiciosDto = $juiciosFacade->selectJuicios($juiciosDto);
    echo utf8_encode($juiciosDto);
} else if (($accion == "baja") && ($cveJuicio != "")) {
    $juiciosDto = $juiciosFacade->deleteJuicios($juiciosDto);
    echo $juiciosDto;
} else if (($accion == "seleccionar") && ($cveJuicio != "")) {
    $juiciosDto = $juiciosFacade->selectJuicios($juiciosDto);
    echo $juiciosDto;
}else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $juiciosDto = $juiciosFacade->selectJuiciosPaginacion($juiciosDto, $param);
    echo $juiciosDto;
}else if ($accion == "getPaginas") {
    $juiciosDto = $juiciosFacade->getPaginas($juiciosDto, $param);
    echo $juiciosDto;
}
?>