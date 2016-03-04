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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/municipios/MunicipiosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/municipios/MunicipiosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class MunicipiosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarMunicipios($MunicipiosDto) {
        $MunicipiosDto->setcveMunicipio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getcveMunicipio(), "utf8") : strtoupper($MunicipiosDto->getcveMunicipio()))))));
        if ($this->esFecha($MunicipiosDto->getcveMunicipio())) {
            $MunicipiosDto->setcveMunicipio($this->fechaMysql($MunicipiosDto->getcveMunicipio()));
        }
        $MunicipiosDto->setdesMunicipio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getdesMunicipio(), "utf8") : strtoupper($MunicipiosDto->getdesMunicipio()))))));
        if ($this->esFecha($MunicipiosDto->getdesMunicipio())) {
            $MunicipiosDto->setdesMunicipio($this->fechaMysql($MunicipiosDto->getdesMunicipio()));
        }
        $MunicipiosDto->setcveEstado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getcveEstado(), "utf8") : strtoupper($MunicipiosDto->getcveEstado()))))));
        if ($this->esFecha($MunicipiosDto->getcveEstado())) {
            $MunicipiosDto->setcveEstado($this->fechaMysql($MunicipiosDto->getcveEstado()));
        }
        $MunicipiosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getactivo(), "utf8") : strtoupper($MunicipiosDto->getactivo()))))));
        if ($this->esFecha($MunicipiosDto->getactivo())) {
            $MunicipiosDto->setactivo($this->fechaMysql($MunicipiosDto->getactivo()));
        }
        $MunicipiosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getfechaRegistro(), "utf8") : strtoupper($MunicipiosDto->getfechaRegistro()))))));
        if ($this->esFecha($MunicipiosDto->getfechaRegistro())) {
            $MunicipiosDto->setfechaRegistro($this->fechaMysql($MunicipiosDto->getfechaRegistro()));
        }
        $MunicipiosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MunicipiosDto->getfechaActualizacion(), "utf8") : strtoupper($MunicipiosDto->getfechaActualizacion()))))));
        if ($this->esFecha($MunicipiosDto->getfechaActualizacion())) {
            $MunicipiosDto->setfechaActualizacion($this->fechaMysql($MunicipiosDto->getfechaActualizacion()));
        }
        return $MunicipiosDto;
    }

    public function selectMunicipios($MunicipiosDto, $param = null) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosController = new MunicipiosController();
        $MunicipiosDto = $MunicipiosController->selectMunicipios($MunicipiosDto, $param);
        if ($MunicipiosDto != "") {
            $dtoToJson = new DtoToJson($MunicipiosDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($MunicipiosDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertMunicipios($MunicipiosDto) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosController = new MunicipiosController();
        $param["like"] = true;
        $MunicipiosDto->setActivo("S");
        $existe = $MunicipiosController->selectMunicipios($MunicipiosDto,$param);
        if ($existe == "") {
            $MunicipiosDto = $MunicipiosController->insertMunicipios($MunicipiosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $MunicipiosDto = $MunicipiosController->insertMunicipios($MunicipiosDto);
        if ($MunicipiosDto != "") {
            $dtoToJson = new DtoToJson($MunicipiosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateMunicipios($MunicipiosDto) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $cloneMunicipiosDto = clone $MunicipiosDto;
        
        $MunicipiosController = new MunicipiosController();
        $cMunicipiosDto = $MunicipiosDto;
        $cMunicipiosDto->setCveMunicipio("");
        if($MunicipiosDto->getActivo() == "N"){
            $MunicipiosDto = $MunicipiosController->updateMunicipios($cloneMunicipiosDto);
            if($MunicipiosDto != ""){
                $dtoToJson = new DtoToJson($MunicipiosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cMunicipiosDto->setActivo("S");
        $ext = $MunicipiosController->selectMunicipios($cMunicipiosDto, $param);
        if ($ext == "") {
            $MunicipiosDto = $MunicipiosController->updateMunicipios($cloneMunicipiosDto);
        }else{
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $MunicipiosDto = $MunicipiosController->updateMunicipios($MunicipiosDto);
        if ($MunicipiosDto != "") {
            $dtoToJson = new DtoToJson($MunicipiosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteMunicipios($MunicipiosDto) {
        $MunicipiosDto = $this->validarMunicipios($MunicipiosDto);
        $MunicipiosController = new MunicipiosController();
        $MunicipiosDto = $MunicipiosController->deleteMunicipios($MunicipiosDto);
        if ($MunicipiosDto == true) {
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

    public function getPaginas($municipiosDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $municipiosDto = $this->validarMunicipios($municipiosDto);
        $MunicipiosController = new MunicipiosController();
        $municipiosDto = $MunicipiosController->getPaginas($municipiosDto, $param);
        if ($municipiosDto != "") {
            return $municipiosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveMunicipio = $_POST["cveMunicipio"];
@$desMunicipio = $_POST["desMunicipio"];
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

$municipiosFacade = new MunicipiosFacade();
$municipiosDto = new MunicipiosDTO();

$municipiosDto->setCveMunicipio($cveMunicipio);
$municipiosDto->setDesMunicipio($desMunicipio);
$municipiosDto->setCveEstado($cveEstado);
$municipiosDto->setActivo($activo);
$municipiosDto->setFechaRegistro($fechaRegistro);
$municipiosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveMunicipio == "")) {
    $municipiosDto = $municipiosFacade->insertMunicipios($municipiosDto);
    echo $municipiosDto;
} else if (($accion == "guardar") && ($cveMunicipio != "")) {
    $municipiosDto = $municipiosFacade->updateMunicipios($municipiosDto);
    echo $municipiosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $municipiosDto = $municipiosFacade->selectMunicipios($municipiosDto, $param);
    echo $municipiosDto;
} else if (($accion == "baja") && ($cveMunicipio != "")) {
    $municipiosDto = $municipiosFacade->deleteMunicipios($municipiosDto);
    echo $municipiosDto;
} else if (($accion == "seleccionar") && ($cveMunicipio != "")) {
    $municipiosDto = $municipiosFacade->selectMunicipios($municipiosDto);
    echo $municipiosDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $municipiosDto = $municipiosFacade->selectMunicipios($municipiosDto, $param);
    echo $municipiosDto;
} else if ($accion == "getPaginas") {
    $municipiosDto = $municipiosFacade->getPaginas($municipiosDto, $param);
    echo $municipiosDto;
}
?>