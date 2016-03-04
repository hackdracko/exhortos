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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/grupos/GruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/grupos/GruposController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class GruposFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarGrupos($GruposDto) {
        $GruposDto->setCveGrupo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getCveGrupo(), "utf8") : strtoupper($GruposDto->getCveGrupo()))))));
        if ($this->esFecha($GruposDto->getCveGrupo())) {
            $GruposDto->setCveGrupo($this->fechaMysql($GruposDto->getCveGrupo()));
        }
        $GruposDto->setNomGrupo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getNomGrupo(), "utf8") : strtoupper($GruposDto->getNomGrupo()))))));
        if ($this->esFecha($GruposDto->getNomGrupo())) {
            $GruposDto->setNomGrupo($this->fechaMysql($GruposDto->getNomGrupo()));
        }
        $GruposDto->setcveSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getcveSistema(), "utf8") : strtoupper($GruposDto->getcveSistema()))))));
        if ($this->esFecha($GruposDto->getcveSistema())) {
            $GruposDto->setcveSistema($this->fechaMysql($GruposDto->getcveSistema()));
        }
        $GruposDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getactivo(), "utf8") : strtoupper($GruposDto->getactivo()))))));
        if ($this->esFecha($GruposDto->getactivo())) {
            $GruposDto->setactivo($this->fechaMysql($GruposDto->getactivo()));
        }
        $GruposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getfechaRegistro(), "utf8") : strtoupper($GruposDto->getfechaRegistro()))))));
        if ($this->esFecha($GruposDto->getfechaRegistro())) {
            $GruposDto->setfechaRegistro($this->fechaMysql($GruposDto->getfechaRegistro()));
        }
        $GruposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($GruposDto->getfechaActualizacion(), "utf8") : strtoupper($GruposDto->getfechaActualizacion()))))));
        if ($this->esFecha($GruposDto->getfechaActualizacion())) {
            $GruposDto->setfechaActualizacion($this->fechaMysql($GruposDto->getfechaActualizacion()));
        }
        return $GruposDto;
    }

    public function selectGrupos($GruposDto, $param = null) {
        //var_dump($GruposDto);
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposController = new GruposController();
        $GruposDto = $GruposController->selectGrupos($GruposDto, $param);
        if ($GruposDto != "") {
            $dtoToJson = new DtoToJson($GruposDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($GruposDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectGruposGenerico($GruposDto, $param) {
        //var_dump($GruposDto);
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposController = new GruposController();
        $GruposDto = $GruposController->selectGruposGenerico($GruposDto, $param);
        if ($GruposDto != "") {
            $dtoToJson = new DtoToJson($GruposDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($GruposDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertGrupos($GruposDto) {
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposController = new GruposController();
        $param["like"] = true;
        $existe = $GruposController->selectGrupos($GruposDto,$param);
        if ($existe == "") {
        $GruposDto = $GruposController->insertGrupos($GruposDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $GruposDto = $GruposController->insertGrupos($GruposDto);
        if ($GruposDto != "") {
            $dtoToJson = new DtoToJson($GruposDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateGrupos($GruposDto) {
        $GruposDto = $this->validarGrupos($GruposDto);
        $cloneGruposDto = clone $GruposDto;
        
        $GruposController = new GruposController();
        $cGrupoDto = $GruposDto;
        $cGrupoDto->setCveGrupo("");
        if($GruposDto->getActivo() == "N"){
            $GruposDto = $GruposController->updateGrupos($cloneGruposDto);
            if($GruposDto != ""){
                $dtoToJson = new DtoToJson($GruposDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cGrupoDto->setActivo("S");
        $ext = $GruposController->selectGrupos($cGrupoDto, $param);
        if ($ext == "") {
            $GruposDto = $GruposController->updateGrupos($cloneGruposDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $GruposDto = $GruposController->updateGrupos($GruposDto);
        if ($GruposDto != "") {
            $dtoToJson = new DtoToJson($GruposDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteGrupos($GruposDto) {
        $GruposDto = $this->validarGrupos($GruposDto);
        $GruposController = new GruposController();
        $GruposDto = $GruposController->deleteGrupos($GruposDto);
        if ($GruposDto == true) {
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
    public function getPaginas($gruposDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $gruposDto = $this->validarGrupos($gruposDto);
        $GruposController = new GruposController();
        $gruposDto = $GruposController->getPaginas($gruposDto, $param);
        if ($gruposDto != "") {
            return $gruposDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$CveGrupo = $_POST["CveGrupo"];
@$NomGrupo = $_POST["NomGrupo"];
@$cveSistema = $_POST["cveSistema"];
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
$gruposFacade = new GruposFacade();
$gruposDto = new GruposDTO();

$gruposDto->setCveGrupo($CveGrupo);
$gruposDto->setNomGrupo(htmlspecialchars($NomGrupo));
$gruposDto->setCveSistema($cveSistema);
$gruposDto->setActivo($activo);
$gruposDto->setFechaRegistro($fechaRegistro);
$gruposDto->setFechaActualizacion($fechaActualizacion);
//var_dump($gruposDto);
if (($accion == "guardar") && ($CveGrupo == "")) {
    //var_dump($gruposDto);
    $gruposDto = $gruposFacade->insertGrupos($gruposDto);
    echo $gruposDto;
} else if (($accion == "guardar") && ($CveGrupo != "")) {
    $gruposDto = $gruposFacade->updateGrupos($gruposDto);
    echo $gruposDto;
} else if ($accion == "consultar") {
    //var_dump($gruposDto);
    $param["paginacion"] = true;
    $gruposDto = $gruposFacade->selectGrupos($gruposDto, $param);
    echo $gruposDto;
} else if (($accion == "baja") && ($CveGrupo != "")) {
    $gruposDto = $gruposFacade->deleteGrupos($gruposDto);
    echo $gruposDto;
} else if (($accion == "seleccionar") && ($CveGrupo != "")) {
    $gruposDto = $gruposFacade->selectGrupos($gruposDto);
    echo $gruposDto;
} else if ($accion == "getPaginas") {
    $gruposDto = $gruposFacade->getPaginas($gruposDto, $param);
    echo $gruposDto;
} else if ($accion == "consultarGenerla") {
     $param["paginacion"] = false;
    $gruposDto = $gruposFacade->selectGruposGenerico($gruposDto, $param);
    echo $gruposDto;
}
?>