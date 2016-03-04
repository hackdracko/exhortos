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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/exhortos/ExhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/exhortos/ExhortosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class ExhortosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarExhortos($ExhortosDto) {
        $ExhortosDto->setidExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getidExhorto(), "utf8") : strtoupper($ExhortosDto->getidExhorto()))))));
        if ($this->esFecha($ExhortosDto->getidExhorto())) {
            $ExhortosDto->setidExhorto($this->fechaMysql($ExhortosDto->getidExhorto()));
        }
        $ExhortosDto->setIdExhortoGenerado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getIdExhortoGenerado(), "utf8") : strtoupper($ExhortosDto->getIdExhortoGenerado()))))));
        if ($this->esFecha($ExhortosDto->getIdExhortoGenerado())) {
            $ExhortosDto->setIdExhortoGenerado($this->fechaMysql($ExhortosDto->getIdExhortoGenerado()));
        }
        $ExhortosDto->setnumExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnumExhorto(), "utf8") : strtoupper($ExhortosDto->getnumExhorto()))))));
        if ($this->esFecha($ExhortosDto->getnumExhorto())) {
            $ExhortosDto->setnumExhorto($this->fechaMysql($ExhortosDto->getnumExhorto()));
        }
        $ExhortosDto->setaniExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getaniExhorto(), "utf8") : strtoupper($ExhortosDto->getaniExhorto()))))));
        if ($this->esFecha($ExhortosDto->getaniExhorto())) {
            $ExhortosDto->setaniExhorto($this->fechaMysql($ExhortosDto->getaniExhorto()));
        }
        $ExhortosDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveJuzgado(), "utf8") : strtoupper($ExhortosDto->getcveJuzgado()))))));
        if ($this->esFecha($ExhortosDto->getcveJuzgado())) {
            $ExhortosDto->setcveJuzgado($this->fechaMysql($ExhortosDto->getcveJuzgado()));
        }
        $ExhortosDto->setnumeroExp(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnumeroExp(), "utf8") : strtoupper($ExhortosDto->getnumeroExp()))))));
        if ($this->esFecha($ExhortosDto->getnumeroExp())) {
            $ExhortosDto->setnumeroExp($this->fechaMysql($ExhortosDto->getnumeroExp()));
        }
        $ExhortosDto->setanioExp(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getanioExp(), "utf8") : strtoupper($ExhortosDto->getanioExp()))))));
        if ($this->esFecha($ExhortosDto->getanioExp())) {
            $ExhortosDto->setanioExp($this->fechaMysql($ExhortosDto->getanioExp()));
        }
        $ExhortosDto->setcveJuzgadoProcedencia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveJuzgadoProcedencia(), "utf8") : strtoupper($ExhortosDto->getcveJuzgadoProcedencia()))))));
        if ($this->esFecha($ExhortosDto->getcveJuzgadoProcedencia())) {
            $ExhortosDto->setcveJuzgadoProcedencia($this->fechaMysql($ExhortosDto->getcveJuzgadoProcedencia()));
        }
        $ExhortosDto->setjuzgadoProcedencia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getjuzgadoProcedencia(), "utf8") : strtoupper($ExhortosDto->getjuzgadoProcedencia()))))));
        if ($this->esFecha($ExhortosDto->getjuzgadoProcedencia())) {
            $ExhortosDto->setjuzgadoProcedencia($this->fechaMysql($ExhortosDto->getjuzgadoProcedencia()));
        }
        $ExhortosDto->setcveEstadoProcedencia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveEstadoProcedencia(), "utf8") : strtoupper($ExhortosDto->getcveEstadoProcedencia()))))));
        if ($this->esFecha($ExhortosDto->getcveEstadoProcedencia())) {
            $ExhortosDto->setcveEstadoProcedencia($this->fechaMysql($ExhortosDto->getcveEstadoProcedencia()));
        }
        $ExhortosDto->setcarpetaInv(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcarpetaInv(), "utf8") : strtoupper($ExhortosDto->getcarpetaInv()))))));
        if ($this->esFecha($ExhortosDto->getcarpetaInv())) {
            $ExhortosDto->setcarpetaInv($this->fechaMysql($ExhortosDto->getcarpetaInv()));
        }
        $ExhortosDto->setnuc(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnuc(), "utf8") : strtoupper($ExhortosDto->getnuc()))))));
        if ($this->esFecha($ExhortosDto->getnuc())) {
            $ExhortosDto->setnuc($this->fechaMysql($ExhortosDto->getnuc()));
        }
        $ExhortosDto->setcveMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveMateria(), "utf8") : strtoupper($ExhortosDto->getcveMateria()))))));
        if ($this->esFecha($ExhortosDto->getcveMateria())) {
            $ExhortosDto->setcveMateria($this->fechaMysql($ExhortosDto->getcveMateria()));
        }
        $ExhortosDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveCuantia(), "utf8") : strtoupper($ExhortosDto->getcveCuantia()))))));
        if ($this->esFecha($ExhortosDto->getcveCuantia())) {
            $ExhortosDto->setcveCuantia($this->fechaMysql($ExhortosDto->getcveCuantia()));
        }
        $ExhortosDto->setnoFojas(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnoFojas(), "utf8") : strtoupper($ExhortosDto->getnoFojas()))))));
        if ($this->esFecha($ExhortosDto->getnoFojas())) {
            $ExhortosDto->setnoFojas($this->fechaMysql($ExhortosDto->getnoFojas()));
        }
        $ExhortosDto->setnumOficio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnumOficio(), "utf8") : strtoupper($ExhortosDto->getnumOficio()))))));
        if ($this->esFecha($ExhortosDto->getnumOficio())) {
            $ExhortosDto->setnumOficio($this->fechaMysql($ExhortosDto->getnumOficio()));
        }
        $ExhortosDto->setsintesis(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getsintesis(), "utf8") : strtoupper($ExhortosDto->getsintesis()))))));
        if ($this->esFecha($ExhortosDto->getsintesis())) {
            $ExhortosDto->setsintesis($this->fechaMysql($ExhortosDto->getsintesis()));
        }
        $ExhortosDto->setobservaciones(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getobservaciones(), "utf8") : strtoupper($ExhortosDto->getobservaciones()))))));
        if ($this->esFecha($ExhortosDto->getobservaciones())) {
            $ExhortosDto->setobservaciones($this->fechaMysql($ExhortosDto->getobservaciones()));
        }
        $ExhortosDto->setcveConsignacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveConsignacion(), "utf8") : strtoupper($ExhortosDto->getcveConsignacion()))))));
        if ($this->esFecha($ExhortosDto->getcveConsignacion())) {
            $ExhortosDto->setcveConsignacion($this->fechaMysql($ExhortosDto->getcveConsignacion()));
        }
        $ExhortosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveEstatusExhorto(), "utf8") : strtoupper($ExhortosDto->getcveEstatusExhorto()))))));
        if ($this->esFecha($ExhortosDto->getcveEstatusExhorto())) {
            $ExhortosDto->setcveEstatusExhorto($this->fechaMysql($ExhortosDto->getcveEstatusExhorto()));
        }
        $ExhortosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getactivo(), "utf8") : strtoupper($ExhortosDto->getactivo()))))));
        if ($this->esFecha($ExhortosDto->getactivo())) {
            $ExhortosDto->setactivo($this->fechaMysql($ExhortosDto->getactivo()));
        }
        $ExhortosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getfechaRegistro(), "utf8") : strtoupper($ExhortosDto->getfechaRegistro()))))));
        if ($this->esFecha($ExhortosDto->getfechaRegistro())) {
            $ExhortosDto->setfechaRegistro($this->fechaMysql($ExhortosDto->getfechaRegistro()));
        }
        $ExhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getfechaActualizacion(), "utf8") : strtoupper($ExhortosDto->getfechaActualizacion()))))));
        if ($this->esFecha($ExhortosDto->getfechaActualizacion())) {
            $ExhortosDto->setfechaActualizacion($this->fechaMysql($ExhortosDto->getfechaActualizacion()));
        }
        $ExhortosDto->setcveEstadoDestino(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveEstadoDestino(), "utf8") : strtoupper($ExhortosDto->getcveEstadoDestino()))))));
        if ($this->esFecha($ExhortosDto->getcveEstadoDestino())) {
            $ExhortosDto->setcveEstadoDestino($this->fechaMysql($ExhortosDto->getcveEstadoDestino()));
        }
        $ExhortosDto->setcveJuicio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getcveJuicio(), "utf8") : strtoupper($ExhortosDto->getcveJuicio()))))));
        if ($this->esFecha($ExhortosDto->getcveJuicio())) {
            $ExhortosDto->setcveJuicio($this->fechaMysql($ExhortosDto->getcveJuicio()));
        }
        $ExhortosDto->setpagina(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getpagina(), "utf8") : strtoupper($ExhortosDto->getpagina()))))));
        if ($this->esFecha($ExhortosDto->getpagina())) {
            $ExhortosDto->setpagina($this->fechaMysql($ExhortosDto->getpagina()));
        }
        $ExhortosDto->setnumeroRegistros(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ExhortosDto->getnumeroRegistros(), "utf8") : strtoupper($ExhortosDto->getnumeroRegistros()))))));
        if ($this->esFecha($ExhortosDto->getnumeroRegistros())) {
            $ExhortosDto->setnumeroRegistros($this->fechaMysql($ExhortosDto->getnumeroRegistros()));
        }
        return $ExhortosDto;
    }

    public function selectExhortos($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectExhortos($ExhortosDto);
        if ($ExhortosDto != "") {
            $dtoToJson = new DtoToJson($ExhortosDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectExhortosAdscripcion($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectExhortosAdscripcion($ExhortosDto);
        if ($ExhortosDto != "") {
            $dtoToJson = new DtoToJson($ExhortosDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function respuestaWS($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->respuestaWS($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectExhortosParte($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectExhortosParte($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectExhortosParteJuzgado($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectExhortosParteJuzgado($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectOficios($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectOficios($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectReporte($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->selectReporte($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertExhortos($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->insertExhortos($ExhortosDto);
        if ($ExhortosDto != "") {
            $dtoToJson = new DtoToJson($ExhortosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function insertExhortosPartes($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->insertExhortosPartes($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function guardarOficio($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->guardarOficio($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function actualizaOficio($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->actualizaOficio($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateExhortos($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->updateExhortos($ExhortosDto);
        if ($ExhortosDto != "") {
            $dtoToJson = new DtoToJson($ExhortosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function updateExhortosPartes($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->updateExhortosPartes($ExhortosDto);
        if ($ExhortosDto != "") {
            return $ExhortosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteExhortos($ExhortosDto) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosController = new ExhortosController();
        $ExhortosDto = $ExhortosController->deleteExhortos($ExhortosDto);
        if ($ExhortosDto == true) {
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

}

@$idExhorto = $_POST["idExhorto"];
@$IdExhortoGenerado = $_POST["IdExhortoGenerado"];
@$numExhorto = $_POST["numExhorto"];
@$aniExhorto = $_POST["aniExhorto"];
@$cveJuzgado = $_POST["cveJuzgado"];
@$numeroExp = $_POST["numeroExp"];
@$anioExp = $_POST["anioExp"];
@$cveJuzgadoProcedencia = $_POST["cveJuzgadoProcedencia"];
@$juzgadoProcedencia = $_POST["juzgadoProcedencia"];
@$cveEstadoProcedencia = $_POST["cveEstadoProcedencia"];
@$carpetaInv = $_POST["carpetaInv"];
@$nuc = $_POST["nuc"];
@$cveMateria = $_POST["cveMateria"];
@$cveCuantia = $_POST["cveCuantia"];
@$noFojas = $_POST["noFojas"];
@$numOficio = $_POST["numOficio"];
@$sintesis = $_POST["sintesis"];
@$observaciones = $_POST["observaciones"];
@$cveConsignacion = $_POST["cveConsignacion"];
@$cveEstatusExhorto = $_POST["cveEstatusExhorto"];
@$activo = $_POST["activo"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$cveEstadoDestino = $_POST["cveEstadoDestino"];
@$cveJuicio = $_POST["cveJuicio"];
@$partes = $_POST["partes"];
@$numeroRegistros = $_POST["numeroRegistros"];
@$pagina = $_POST["pagina"];
@$accion = $_POST["accion"];

$exhortosFacade = new ExhortosFacade();
$exhortosDto = new ExhortosDTO();

$exhortosDto->setIdExhorto($idExhorto);
$exhortosDto->setIdExhortoGenerado($IdExhortoGenerado);
$exhortosDto->setNumExhorto($numExhorto);
$exhortosDto->setAniExhorto($aniExhorto);
$exhortosDto->setCveJuzgado($cveJuzgado);
$exhortosDto->setNumeroExp($numeroExp);
$exhortosDto->setAnioExp($anioExp);
$exhortosDto->setCveJuzgadoProcedencia($cveJuzgadoProcedencia);
$exhortosDto->setJuzgadoProcedencia($juzgadoProcedencia);
$exhortosDto->setCveEstadoProcedencia($cveEstadoProcedencia);
$exhortosDto->setCarpetaInv($carpetaInv);
$exhortosDto->setNuc($nuc);
$exhortosDto->setCveMateria($cveMateria);
$exhortosDto->setCveCuantia($cveCuantia);
$exhortosDto->setNoFojas($noFojas);
$exhortosDto->setNumOficio($numOficio);
$exhortosDto->setSintesis($sintesis);
$exhortosDto->setObservaciones($observaciones);
$exhortosDto->setCveConsignacion($cveConsignacion);
$exhortosDto->setCveEstatusExhorto($cveEstatusExhorto);
$exhortosDto->setActivo($activo);
$exhortosDto->setFechaRegistro($fechaRegistro);
$exhortosDto->setFechaActualizacion($fechaActualizacion);
$exhortosDto->setCveEstadoDestino($cveEstadoDestino);
$exhortosDto->setCveJuicio($cveJuicio);
$exhortosDto->setPartes($partes);
$exhortosDto->setNumeroRegistros($numeroRegistros);
$exhortosDto->setPagina($pagina);

if (($accion == "guardar") && ($idExhorto == "")) {
    $exhortosDto = $exhortosFacade->insertExhortos($exhortosDto);
    echo $exhortosDto;
} else if (($accion == "guardar") && ($idExhorto != "")) {
    $exhortosDto = $exhortosFacade->updateExhortos($exhortosDto);
    echo $exhortosDto;
} else if (($accion == "guardarExhortoParte") && ($idExhorto == "")) {
    $exhortosDto = $exhortosFacade->insertExhortosPartes($exhortosDto);
    ;
    echo $exhortosDto;
} else if ($accion == "guardarOficio") {
    $exhortosDto = $exhortosFacade->guardarOficio($exhortosDto);
    ;
    echo $exhortosDto;
} else if ($accion == "actualizaOficio") {
    $exhortosDto = $exhortosFacade->actualizaOficio($exhortosDto);
    ;
    echo $exhortosDto;
} else if ($accion == "actualizaExhortoParte") {
    $exhortosDto = $exhortosFacade->updateExhortosPartes($exhortosDto);
    ;
    echo $exhortosDto;
} else if ($accion == "consultar") {
    $exhortosDto = $exhortosFacade->selectExhortos($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "consultarExhortoAdscripcion") {
    $exhortosDto = $exhortosFacade->selectExhortosAdscripcion($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "respuestaWs") {
    $exhortosDto = $exhortosFacade->respuestaWs($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "consultarExhortoParte") {
    $exhortosDto = $exhortosFacade->selectExhortosParte($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "consultarExhortoParteJuzgado") {
    $exhortosDto = $exhortosFacade->selectExhortosParteJuzgado($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "consultarOficios") {
    $exhortosDto = $exhortosFacade->selectOficios($exhortosDto);
    echo $exhortosDto;
} else if ($accion == "consultarReporte") {
    $exhortosDto = $exhortosFacade->selectReporte($exhortosDto);
    echo $exhortosDto;
} else if (($accion == "baja") && ($idExhorto != "")) {
    $exhortosDto = $exhortosFacade->deleteExhortos($exhortosDto);
    echo $exhortosDto;
} else if (($accion == "seleccionar") && ($idExhorto != "")) {
    $exhortosDto = $exhortosFacade->selectExhortos($exhortosDto);
    echo $exhortosDto;
}
?>