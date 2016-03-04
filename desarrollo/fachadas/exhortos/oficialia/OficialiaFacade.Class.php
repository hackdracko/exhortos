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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/oficialia/OficialiaController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class OficialiaFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarOficialia($OficialiaDto) {
        $OficialiaDto->setcveOficialia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getcveOficialia(), "utf8") : strtoupper($OficialiaDto->getcveOficialia()))))));
        if ($this->esFecha($OficialiaDto->getcveOficialia())) {
            $OficialiaDto->setcveOficialia($this->fechaMysql($OficialiaDto->getcveOficialia()));
        }
        $OficialiaDto->setdesOficilia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getdesOficilia(), "utf8") : strtoupper($OficialiaDto->getdesOficilia()))))));
        if ($this->esFecha($OficialiaDto->getdesOficilia())) {
            $OficialiaDto->setdesOficilia($this->fechaMysql($OficialiaDto->getdesOficilia()));
        }
        $OficialiaDto->setcveDistrito(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getcveDistrito(), "utf8") : strtoupper($OficialiaDto->getcveDistrito()))))));
        if ($this->esFecha($OficialiaDto->getcveDistrito())) {
            $OficialiaDto->setcveDistrito($this->fechaMysql($OficialiaDto->getcveDistrito()));
        }
        $OficialiaDto->setcveMunicipio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getcveMunicipio(), "utf8") : strtoupper($OficialiaDto->getcveMunicipio()))))));
        if ($this->esFecha($OficialiaDto->getcveMunicipio())) {
            $OficialiaDto->setcveMunicipio($this->fechaMysql($OficialiaDto->getcveMunicipio()));
        }
        $OficialiaDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getcveAdscripcion(), "utf8") : strtoupper($OficialiaDto->getcveAdscripcion()))))));
        if ($this->esFecha($OficialiaDto->getcveAdscripcion())) {
            $OficialiaDto->setcveAdscripcion($this->fechaMysql($OficialiaDto->getcveAdscripcion()));
        }
        $OficialiaDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getactivo(), "utf8") : strtoupper($OficialiaDto->getactivo()))))));
        if ($this->esFecha($OficialiaDto->getactivo())) {
            $OficialiaDto->setactivo($this->fechaMysql($OficialiaDto->getactivo()));
        }
        $OficialiaDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getfechaRegistro(), "utf8") : strtoupper($OficialiaDto->getfechaRegistro()))))));
        if ($this->esFecha($OficialiaDto->getfechaRegistro())) {
            $OficialiaDto->setfechaRegistro($this->fechaMysql($OficialiaDto->getfechaRegistro()));
        }
        $OficialiaDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($OficialiaDto->getfechaActualizacion(), "utf8") : strtoupper($OficialiaDto->getfechaActualizacion()))))));
        if ($this->esFecha($OficialiaDto->getfechaActualizacion())) {
            $OficialiaDto->setfechaActualizacion($this->fechaMysql($OficialiaDto->getfechaActualizacion()));
        }
        return $OficialiaDto;
    }

    public function selectOficialia($OficialiaDto, $param = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaController = new OficialiaController();
        $OficialiaDto = $OficialiaController->selectOficialia($OficialiaDto, $param);
        if ($OficialiaDto != "") {
            $dtoToJson = new DtoToJson($OficialiaDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($OficialiaDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectOficialiaPaginacion($OficialiaDto, $param = null, $estado = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaController = new OficialiaController();
        $OficialiaDto = $OficialiaController->selectOficialiaPaginacion($OficialiaDto, $param, $estado);
        if ($OficialiaDto != "") {
            return json_encode($OficialiaDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertOficialia($OficialiaDto) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaController = new OficialiaController();
        $param["like"] = true;
        $OficialiaDto->setActivo("S");
        $existe = $OficialiaController->selectOficialia($OficialiaDto, $param);
        if ($existe == "") {
            $OficialiaDto = $OficialiaController->insertOficialia($OficialiaDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $OficialiaDto = $OficialiaController->insertOficialia($OficialiaDto);
        if ($OficialiaDto != "") {
            $dtoToJson = new DtoToJson($OficialiaDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateOficialia($OficialiaDto) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $cloneOficialiaDto = clone $OficialiaDto;

        $OficialiaController = new OficialiaController();
        $cOficialiaDto = $OficialiaDto;
        $cOficialiaDto->setCveOficialia("");
        if ($OficialiaDto->getActivo() == "N") {
            $OficialiaDto = $OficialiaController->updateOficialia($cloneOficialiaDto);
            if ($OficialiaDto != "") {
                $dtoToJson = new DtoToJson($OficialiaDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cOficialiaDto->setActivo("S");
        $ext = $OficialiaController->selectOficialia($cOficialiaDto, $param);
        if ($ext == "") {
            $OficialiaDto = $OficialiaController->updateOficialia($cloneOficialiaDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $OficialiaDto = $OficialiaController->updateOficialia($OficialiaDto);
        if ($OficialiaDto != "") {
            $dtoToJson = new DtoToJson($OficialiaDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteOficialia($OficialiaDto) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaController = new OficialiaController();
        $OficialiaDto = $OficialiaController->deleteOficialia($OficialiaDto);
        if ($OficialiaDto == true) {
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

    public function getPaginas($oficialiaDto, $param, $estado) {
        //var_dump($generosDto);
        //var_dump($param);
        $oficialiaDto = $this->validarOficialia($oficialiaDto);
        $OficialiaController = new OficialiaController();
        $oficialiaDto = $OficialiaController->getPaginas($oficialiaDto, $param, $estado);
        if ($oficialiaDto != "") {
            return $oficialiaDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveOficialia = $_POST["cveOficialia"];
@$desOficilia = $_POST["desOficilia"];
@$cveDistrito = $_POST["cveDistrito"];
@$cveMunicipio = $_POST["cveMunicipio"];
@$cveAdscripcion = $_POST["cveAdscripcion"];
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

$oficialiaFacade = new OficialiaFacade();
$oficialiaDto = new OficialiaDTO();

$oficialiaDto->setCveOficialia($cveOficialia);
$oficialiaDto->setDesOficilia($desOficilia);
$oficialiaDto->setCveDistrito($cveDistrito);
$oficialiaDto->setCveMunicipio($cveMunicipio);
$oficialiaDto->setCveAdscripcion($cveAdscripcion);
$oficialiaDto->setActivo($activo);
$oficialiaDto->setFechaRegistro($fechaRegistro);
$oficialiaDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveOficialia == "")) {
    $oficialiaDto = $oficialiaFacade->insertOficialia($oficialiaDto);
    echo $oficialiaDto;
} else if (($accion == "guardar") && ($cveOficialia != "")) {
    $oficialiaDto = $oficialiaFacade->updateOficialia($oficialiaDto);
    echo $oficialiaDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $oficialiaDto = $oficialiaFacade->selectOficialia($oficialiaDto, $param);
    echo $oficialiaDto;
} else if (($accion == "baja") && ($cveOficialia != "")) {
    $oficialiaDto = $oficialiaFacade->deleteOficialia($oficialiaDto);
    echo $oficialiaDto;
} else if (($accion == "seleccionar") && ($cveOficialia != "")) {
    $oficialiaDto = $oficialiaFacade->selectOficialia($oficialiaDto);
    echo $oficialiaDto;
} else if ($accion == "consultar-paginacion") {
//    var_dump($_POST);
    @$estado = $_POST['estado'];
//    echo '\n'.$estado.'\n';
    $param["paginacion"] = true;
    $oficialiaDto = $oficialiaFacade->selectOficialiaPaginacion($oficialiaDto, $param, $estado);
    echo $oficialiaDto;
} else if ($accion == "getPaginas") {
    @$estado = $_POST['estado'];
    $oficialiaDto = $oficialiaFacade->getPaginas($oficialiaDto, $param, $estado);
    echo $oficialiaDto;
} else if ($accion == "consultar-paginacion-estado") {
    $param["paginacion"] = false;
    @$estado = $_POST['estado'];
//    echo '\n'.$estado.'\n';
    $oficialiaDto = $oficialiaFacade->selectOficialiaPaginacion($oficialiaDto, $param, $estado);
    echo $oficialiaDto;
}
?>