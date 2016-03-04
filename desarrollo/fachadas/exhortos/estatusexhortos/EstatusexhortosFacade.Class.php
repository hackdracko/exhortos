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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estatusexhortos/EstatusexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/estatusexhortos/EstatusexhortosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class EstatusexhortosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarEstatusexhortos($EstatusexhortosDto) {
        $EstatusexhortosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstatusexhortosDto->getcveEstatusExhorto(), "utf8") : strtoupper($EstatusexhortosDto->getcveEstatusExhorto()))))));
        if ($this->esFecha($EstatusexhortosDto->getcveEstatusExhorto())) {
            $EstatusexhortosDto->setcveEstatusExhorto($this->fechaMysql($EstatusexhortosDto->getcveEstatusExhorto()));
        }
        $EstatusexhortosDto->setdesEstatusExhorto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstatusexhortosDto->getdesEstatusExhorto(), "utf8") : strtoupper($EstatusexhortosDto->getdesEstatusExhorto()))))));
        if ($this->esFecha($EstatusexhortosDto->getdesEstatusExhorto())) {
            $EstatusexhortosDto->setdesEstatusExhorto($this->fechaMysql($EstatusexhortosDto->getdesEstatusExhorto()));
        }
        $EstatusexhortosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstatusexhortosDto->getactivo(), "utf8") : strtoupper($EstatusexhortosDto->getactivo()))))));
        if ($this->esFecha($EstatusexhortosDto->getactivo())) {
            $EstatusexhortosDto->setactivo($this->fechaMysql($EstatusexhortosDto->getactivo()));
        }
        $EstatusexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstatusexhortosDto->getfechaRegistro(), "utf8") : strtoupper($EstatusexhortosDto->getfechaRegistro()))))));
        if ($this->esFecha($EstatusexhortosDto->getfechaRegistro())) {
            $EstatusexhortosDto->setfechaRegistro($this->fechaMysql($EstatusexhortosDto->getfechaRegistro()));
        }
        $EstatusexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($EstatusexhortosDto->getfechaActualizacion(), "utf8") : strtoupper($EstatusexhortosDto->getfechaActualizacion()))))));
        if ($this->esFecha($EstatusexhortosDto->getfechaActualizacion())) {
            $EstatusexhortosDto->setfechaActualizacion($this->fechaMysql($EstatusexhortosDto->getfechaActualizacion()));
        }
        return $EstatusexhortosDto;
    }

    public function selectEstatusexhortos($EstatusexhortosDto, $param  =null) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosController = new EstatusexhortosController();
        $EstatusexhortosDto = $EstatusexhortosController->selectEstatusexhortos($EstatusexhortosDto, $param);
        if ($EstatusexhortosDto != "") {
            $dtoToJson = new DtoToJson($EstatusexhortosDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($EstatusexhortosDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertEstatusexhortos($EstatusexhortosDto) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosController = new EstatusexhortosController();
        $EstatusexhortosDto->setActivo("S");
        $param["like"] = true;
        $existe = $EstatusexhortosController->selectEstatusexhortos($EstatusexhortosDto,$param);
        if ($existe == "") {
            $EstatusexhortosDto = $EstatusexhortosController->insertEstatusexhortos($EstatusexhortosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $EstatusexhortosDto = $EstatusexhortosController->insertEstatusexhortos($EstatusexhortosDto);
        if ($EstatusexhortosDto != "") {
            $dtoToJson = new DtoToJson($EstatusexhortosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateEstatusexhortos($EstatusexhortosDto) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $cloneEstatusexhortosDto = clone $EstatusexhortosDto;
        
        $EstatusexhortosController = new EstatusexhortosController();
        $cEstatusexhortosDto = $EstatusexhortosDto;
        $cEstatusexhortosDto->setCveEstatusExhorto("");
        if($EstatusexhortosDto->getActivo() == "N"){
            $EstatusexhortosDto = $EstatusexhortosController->updateEstatusexhortos($cloneEstatusexhortosDto);
            if($EstatusexhortosDto != ""){
                $dtoToJson = new DtoToJson($EstatusexhortosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $EstatusexhortosDto->setActivo("S");
        $ext = $EstatusexhortosController->selectEstatusexhortos($cEstatusexhortosDto, $param);
        if ($ext == "") {
            $EstatusexhortosDto = $EstatusexhortosController->updateEstatusexhortos($cloneEstatusexhortosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $EstatusexhortosDto = $EstatusexhortosController->updateEstatusexhortos($EstatusexhortosDto);
        if ($EstatusexhortosDto != "") {
            $dtoToJson = new DtoToJson($EstatusexhortosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteEstatusexhortos($EstatusexhortosDto) {
        $EstatusexhortosDto = $this->validarEstatusexhortos($EstatusexhortosDto);
        $EstatusexhortosController = new EstatusexhortosController();
        $EstatusexhortosDto = $EstatusexhortosController->deleteEstatusexhortos($EstatusexhortosDto);
        if ($EstatusexhortosDto == true) {
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

    public function getPaginas($estatusexhortosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $estatusexhortosDto = $this->validarEstatusexhortos($estatusexhortosDto);
        $EstatusexhortosController = new EstatusexhortosController();
        $estatusexhortosDto = $EstatusexhortosController->getPaginas($estatusexhortosDto, $param);
        if ($estatusexhortosDto != "") {
            return $estatusexhortosDto;
}
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveEstatusExhorto = $_POST["cveEstatusExhorto"];
@$desEstatusExhorto = $_POST["desEstatusExhorto"];
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
$estatusexhortosFacade = new EstatusexhortosFacade();
$estatusexhortosDto = new EstatusexhortosDTO();

$estatusexhortosDto->setCveEstatusExhorto($cveEstatusExhorto);
$estatusexhortosDto->setDesEstatusExhorto(htmlspecialchars($desEstatusExhorto));
$estatusexhortosDto->setActivo($activo);
$estatusexhortosDto->setFechaRegistro($fechaRegistro);
$estatusexhortosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveEstatusExhorto == "")) {
    $estatusexhortosDto = $estatusexhortosFacade->insertEstatusexhortos($estatusexhortosDto);
    echo $estatusexhortosDto;
} else if (($accion == "guardar") && ($cveEstatusExhorto != "")) {
    $estatusexhortosDto = $estatusexhortosFacade->updateEstatusexhortos($estatusexhortosDto);
    echo $estatusexhortosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $estatusexhortosDto = $estatusexhortosFacade->selectEstatusexhortos($estatusexhortosDto, $param);
    echo $estatusexhortosDto;
} else if (($accion == "baja") && ($cveEstatusExhorto != "")) {
    $estatusexhortosDto = $estatusexhortosFacade->deleteEstatusexhortos($estatusexhortosDto);
    echo $estatusexhortosDto;
} else if (($accion == "seleccionar") && ($cveEstatusExhorto != "")) {
    $estatusexhortosDto = $estatusexhortosFacade->selectEstatusexhortos($estatusexhortosDto);
    echo $estatusexhortosDto;
} else if ($accion == "getPaginas") {
    $estatusexhortosDto = $estatusexhortosFacade->getPaginas($estatusexhortosDto, $param);
    echo $estatusexhortosDto;
}else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $estatusexhortosDto = $estatusexhortosFacade->selectEstatusexhortos($estatusexhortosDto, $param);
    echo $estatusexhortosDto;
}
?>