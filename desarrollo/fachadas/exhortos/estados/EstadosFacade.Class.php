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

//define('WP_DEBUG', true); // enable debugging mode
//ini_set("error_log", dirname(__FILE__) . "/../../../logs/EstadosFacade.log");
//ini_set("log_errors", 1);
//ini_set('display_errors', 1);
//ini_set('error_reporting', E_ALL ^ E_NOTICE); 


session_start();
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estados/EstadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/estados/EstadosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class EstadosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarEstados($EstadosDto) {
        $EstadosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstadosDto->getcveEstado(), "utf8") : strtoupper($EstadosDto->getcveEstado()))))));
        if ($this->esFecha($EstadosDto->getcveEstado())) {
            $EstadosDto->setcveEstado($this->fechaMysql($EstadosDto->getcveEstado()));
        }
        $EstadosDto->setdesEstado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstadosDto->getdesEstado(), "utf8") : strtoupper($EstadosDto->getdesEstado()))))));
        if ($this->esFecha($EstadosDto->getdesEstado())) {
            $EstadosDto->setdesEstado($this->fechaMysql($EstadosDto->getdesEstado()));
        }
        //$EstadosDto->seturlWebServices(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_check_encoding($EstadosDto->geturlWebServices(), "utf8") : $EstadosDto->geturlWebServices()))));
//        if ($this->esFecha($EstadosDto->geturlWebServices())) {
//            $EstadosDto->seturlWebServices($this->fechaMysql($EstadosDto->geturlWebServices()));
//        }
        $EstadosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstadosDto->getactivo(), "utf8") : strtoupper($EstadosDto->getactivo()))))));
        if ($this->esFecha($EstadosDto->getactivo())) {
            $EstadosDto->setactivo($this->fechaMysql($EstadosDto->getactivo()));
        }
        $EstadosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstadosDto->getfechaRegistro(), "utf8") : strtoupper($EstadosDto->getfechaRegistro()))))));
        if ($this->esFecha($EstadosDto->getfechaRegistro())) {
            $EstadosDto->setfechaRegistro($this->fechaMysql($EstadosDto->getfechaRegistro()));
        }
        $EstadosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstadosDto->getfechaActualizacion(), "utf8") : strtoupper($EstadosDto->getfechaActualizacion()))))));
        if ($this->esFecha($EstadosDto->getfechaActualizacion())) {
            $EstadosDto->setfechaActualizacion($this->fechaMysql($EstadosDto->getfechaActualizacion()));
        }
        return $EstadosDto;
    }

    public function selectEstados($EstadosDto, $param = null) {
      //  error_log("antes de validar => ".print_r($EstadosDto,true));
        $EstadosDto = $this->validarEstados($EstadosDto);
        //error_log("Despues de validar => ".print_r($EstadosDto,true));
        $EstadosController = new EstadosController();
        if($param["like"]!=""){
         $param["like"] = true;
        }
        $EstadosDto = $EstadosController->selectEstados($EstadosDto, $param);
        if ($EstadosDto != "") {
            $dtoToJson = new DtoToJson($EstadosDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($EstadosDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertEstados($EstadosDto) {
//        echo '*\n';
//        var_dump($EstadosDto);
        $EstadosDto = $this->validarEstados($EstadosDto);
//        var_dump($EstadosDto);
        $EstadosController = new EstadosController();
        $param["like"] = true;
        $EstadosDto->setActivo("S");
        $existe = $EstadosController->selectEstados($EstadosDto,$param);
        if ($existe == "") {
//            echo '¡¡¡¡¡¡¡¡¡ \n';
//            var_dump($EstadosDto);
            $EstadosDto = $EstadosController->insertEstados($EstadosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $EstadosDto = $EstadosController->insertEstados($EstadosDto);
        if ($EstadosDto != "") {
            $dtoToJson = new DtoToJson($EstadosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateEstados($EstadosDto) {
        $EstadosDto = $this->validarEstados($EstadosDto);
        $cloneEstadosDto = clone $EstadosDto;
        
        $EstadosController = new EstadosController();
        $cEstadosDto = $EstadosDto;
        $cEstadosDto->setCveEstado("");
        if($EstadosDto->getActivo() == "N"){
            $EstadosDto = $EstadosController->updateEstados($cloneEstadosDto);
            if($EstadosDto != ""){
                $dtoToJson = new DtoToJson($EstadosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cEstadosDto->setActivo("S");
        $ext = $EstadosController->selectEstados($cEstadosDto, $param);
        if ($ext == "") {
            $EstadosDto = $EstadosController->updateEstados($cloneEstadosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $EstadosDto = $EstadosController->updateEstados($EstadosDto);
        if ($EstadosDto != "") {
            $dtoToJson = new DtoToJson($EstadosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteEstados($EstadosDto) {
        $EstadosDto = $this->validarEstados($EstadosDto);
        $EstadosController = new EstadosController();
        $EstadosDto = $EstadosController->deleteEstados($EstadosDto);
        if ($EstadosDto == true) {
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
    public function getPaginas($estadosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $estadosDto = $this->validarEstados($estadosDto);
        $EstadosController = new EstadosController();
        $estadosDto = $EstadosController->getPaginas($estadosDto, $param);
        if ($estadosDto != "") {
            return $estadosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
}

@$cveEstado = $_POST["cveEstado"];
@$desEstado = $_POST["desEstado"];
@$urlWebServices = $_POST["urlWebServices"];
//var_dump($urlWebServices);
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
$estadosFacade = new EstadosFacade();
$estadosDto = new EstadosDTO();

$estadosDto->setCveEstado($cveEstado);
$estadosDto->setDesEstado($desEstado);
$estadosDto->setUrlWebServices($urlWebServices);
$estadosDto->setActivo($activo);
$estadosDto->setFechaRegistro($fechaRegistro);
$estadosDto->setFechaActualizacion($fechaActualizacion);
//error_log(print_r($estadosDto,true));
//var_dump($estadosDto);
if (($accion == "guardar") && ($cveEstado == "")) {
    $estadosDto = $estadosFacade->insertEstados($estadosDto);
    echo $estadosDto;
} else if (($accion == "guardar") && ($cveEstado != "")) {
    $estadosDto = $estadosFacade->updateEstados($estadosDto);
    echo $estadosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $estadosDto = $estadosFacade->selectEstados($estadosDto, $param);
    echo $estadosDto;
} else if (($accion == "baja") && ($cveEstado != "")) {
    $estadosDto = $estadosFacade->deleteEstados($estadosDto);
    echo $estadosDto;
} else if (($accion == "seleccionar") && ($cveEstado != "")) {
    $estadosDto = $estadosFacade->selectEstados($estadosDto);
    echo $estadosDto;
} else if ($accion == "getPaginas") {
    $estadosDto = $estadosFacade->getPaginas($estadosDto, $param);
    echo $estadosDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $estadosDto = $estadosFacade->selectEstados($estadosDto, $param);
    echo $estadosDto;
}
?>