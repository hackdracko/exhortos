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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospersonas/TipospersonasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/tipospersonas/TipospersonasController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class TipospersonasFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarTipospersonas($TipospersonasDto) {
        $TipospersonasDto->setcveTipoPersona(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospersonasDto->getcveTipoPersona(), "utf8") : strtoupper($TipospersonasDto->getcveTipoPersona()))))));
        if ($this->esFecha($TipospersonasDto->getcveTipoPersona())) {
            $TipospersonasDto->setcveTipoPersona($this->fechaMysql($TipospersonasDto->getcveTipoPersona()));
        }
        $TipospersonasDto->setdesTipoPersona(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospersonasDto->getdesTipoPersona(), "utf8") : strtoupper($TipospersonasDto->getdesTipoPersona()))))));
        if ($this->esFecha($TipospersonasDto->getdesTipoPersona())) {
            $TipospersonasDto->setdesTipoPersona($this->fechaMysql($TipospersonasDto->getdesTipoPersona()));
        }
        $TipospersonasDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospersonasDto->getactivo(), "utf8") : strtoupper($TipospersonasDto->getactivo()))))));
        if ($this->esFecha($TipospersonasDto->getactivo())) {
            $TipospersonasDto->setactivo($this->fechaMysql($TipospersonasDto->getactivo()));
        }
        $TipospersonasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospersonasDto->getfechaRegistro(), "utf8") : strtoupper($TipospersonasDto->getfechaRegistro()))))));
        if ($this->esFecha($TipospersonasDto->getfechaRegistro())) {
            $TipospersonasDto->setfechaRegistro($this->fechaMysql($TipospersonasDto->getfechaRegistro()));
        }
        $TipospersonasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($TipospersonasDto->getfechaActualizacion(), "utf8") : strtoupper($TipospersonasDto->getfechaActualizacion()))))));
        if ($this->esFecha($TipospersonasDto->getfechaActualizacion())) {
            $TipospersonasDto->setfechaActualizacion($this->fechaMysql($TipospersonasDto->getfechaActualizacion()));
        }
        return $TipospersonasDto;
    }

    public function selectTipospersonas($TipospersonasDto, $param = null) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasController = new TipospersonasController();
        $TipospersonasDto = $TipospersonasController->selectTipospersonas($TipospersonasDto, $param);
        if ($TipospersonasDto != "") {
            $dtoToJson = new DtoToJson($TipospersonasDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($TipospersonasDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertTipospersonas($TipospersonasDto) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasController = new TipospersonasController();
        $param["like"] = true;
        $TipospersonasDto->setActivo("S");
        $existe = $TipospersonasController->selectTipospersonas($TipospersonasDto,$param);
        if ($existe == "") {
            $TipospersonasDto = $TipospersonasController->insertTipospersonas($TipospersonasDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $TipospersonasDto = $TipospersonasController->insertTipospersonas($TipospersonasDto);
        if ($TipospersonasDto != "") {
            $dtoToJson = new DtoToJson($TipospersonasDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateTipospersonas($TipospersonasDto) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $cloneTipospersonasDto = clone $TipospersonasDto;
        
        $TipospersonasController = new TipospersonasController();
        $cTipospersonasDto = $TipospersonasDto;
        $cTipospersonasDto->setCveTipoPersona("");
        if($TipospersonasDto->getActivo() == "N"){
            $TipospersonasDto = $TipospersonasController->updateTipospersonas($cloneTipospersonasDto);
            if($TipospersonasDto != ""){
                $dtoToJson = new DtoToJson($TipospersonasDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cTipospersonasDto->setActivo("S");
        $ext = $TipospersonasController->selectTipospersonas($cTipospersonasDto, $param);
        if ($ext == "") {
            $TipospersonasDto = $TipospersonasController->updateTipospersonas($cloneTipospersonasDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
        if ($TipospersonasDto != "") {
            $dtoToJson = new DtoToJson($TipospersonasDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteTipospersonas($TipospersonasDto) {
        $TipospersonasDto = $this->validarTipospersonas($TipospersonasDto);
        $TipospersonasController = new TipospersonasController();
        $TipospersonasDto = $TipospersonasController->deleteTipospersonas($TipospersonasDto);
        if ($TipospersonasDto == true) {
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
    
    public function getPaginas($tipospersonasDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $tipospersonasDto = $this->validarTipospersonas($tipospersonasDto);
        $TipospersonasController = new TipospersonasController();
        $tipospersonasDto = $TipospersonasController->getPaginas($tipospersonasDto, $param);
        if ($tipospersonasDto != "") {
            return $tipospersonasDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveTipoPersona = $_POST["cveTipoPersona"];
@$desTipoPersona = $_POST["desTipoPersona"];
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
$tipospersonasFacade = new TipospersonasFacade();
$tipospersonasDto = new TipospersonasDTO();

$tipospersonasDto->setCveTipoPersona($cveTipoPersona);
$tipospersonasDto->setDesTipoPersona(htmlspecialchars($desTipoPersona));
$tipospersonasDto->setActivo($activo);
$tipospersonasDto->setFechaRegistro($fechaRegistro);
$tipospersonasDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveTipoPersona == "")) {
    $tipospersonasDto = $tipospersonasFacade->insertTipospersonas($tipospersonasDto);
    echo $tipospersonasDto;
} else if (($accion == "guardar") && ($cveTipoPersona != "")) {
    $tipospersonasDto = $tipospersonasFacade->updateTipospersonas($tipospersonasDto);
    echo $tipospersonasDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $tipospersonasDto = $tipospersonasFacade->selectTipospersonas($tipospersonasDto, $param);
    echo $tipospersonasDto;
} else if (($accion == "baja") && ($cveTipoPersona != "")) {
    $tipospersonasDto = $tipospersonasFacade->deleteTipospersonas($tipospersonasDto);
    echo $tipospersonasDto;
} else if (($accion == "seleccionar") && ($cveTipoPersona != "")) {
    $tipospersonasDto = $tipospersonasFacade->selectTipospersonas($tipospersonasDto);
    echo $tipospersonasDto;
} else if ($accion == "getPaginas") {
    $tipospersonasDto = $tipospersonasFacade->getPaginas($tipospersonasDto, $param);
    echo $tipospersonasDto;
}else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $tipospersonasDto = $tipospersonasFacade->selectTipospersonas($tipospersonasDto, $param);
    echo $tipospersonasDto;
}
?>