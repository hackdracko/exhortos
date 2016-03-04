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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juzgadosmaterias/JuzgadosmateriasController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class JuzgadosmateriasFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuzgadosmaterias($JuzgadosmateriasDto) {
        $JuzgadosmateriasDto->setcveJuzgadoMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getcveJuzgadoMateria(), "utf8") : strtoupper($JuzgadosmateriasDto->getcveJuzgadoMateria()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getcveJuzgadoMateria())) {
            $JuzgadosmateriasDto->setcveJuzgadoMateria($this->fechaMysql($JuzgadosmateriasDto->getcveJuzgadoMateria()));
        }
        $JuzgadosmateriasDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getcveJuzgado(), "utf8") : strtoupper($JuzgadosmateriasDto->getcveJuzgado()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getcveJuzgado())) {
            $JuzgadosmateriasDto->setcveJuzgado($this->fechaMysql($JuzgadosmateriasDto->getcveJuzgado()));
        }
        $JuzgadosmateriasDto->setcveMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getcveMateria(), "utf8") : strtoupper($JuzgadosmateriasDto->getcveMateria()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getcveMateria())) {
            $JuzgadosmateriasDto->setcveMateria($this->fechaMysql($JuzgadosmateriasDto->getcveMateria()));
        }
        $JuzgadosmateriasDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getcveCuantia(), "utf8") : strtoupper($JuzgadosmateriasDto->getcveCuantia()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getcveCuantia())) {
            $JuzgadosmateriasDto->setcveCuantia($this->fechaMysql($JuzgadosmateriasDto->getcveCuantia()));
        }
        $JuzgadosmateriasDto->setcveTipo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getcveTipo(), "utf8") : strtoupper($JuzgadosmateriasDto->getcveTipo()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getcveTipo())) {
            $JuzgadosmateriasDto->setcveTipo($this->fechaMysql($JuzgadosmateriasDto->getcveTipo()));
        }
        $JuzgadosmateriasDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getactivo(), "utf8") : strtoupper($JuzgadosmateriasDto->getactivo()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getactivo())) {
            $JuzgadosmateriasDto->setactivo($this->fechaMysql($JuzgadosmateriasDto->getactivo()));
        }
        $JuzgadosmateriasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getfechaRegistro(), "utf8") : strtoupper($JuzgadosmateriasDto->getfechaRegistro()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getfechaRegistro())) {
            $JuzgadosmateriasDto->setfechaRegistro($this->fechaMysql($JuzgadosmateriasDto->getfechaRegistro()));
        }
        $JuzgadosmateriasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosmateriasDto->getfechaActualizacion(), "utf8") : strtoupper($JuzgadosmateriasDto->getfechaActualizacion()))))));
        if ($this->esFecha($JuzgadosmateriasDto->getfechaActualizacion())) {
            $JuzgadosmateriasDto->setfechaActualizacion($this->fechaMysql($JuzgadosmateriasDto->getfechaActualizacion()));
        }
        return $JuzgadosmateriasDto;
    }

    public function selectJuzgadosmaterias($JuzgadosmateriasDto, $param) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $JuzgadosmateriasDto = $JuzgadosmateriasController->selectJuzgadosmaterias($JuzgadosmateriasDto, $param);
        if ($JuzgadosmateriasDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosmateriasDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectJuzgadosmateriasPaginacion($JuzgadosmateriasDto, $param) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $JuzgadosmateriasDto = $JuzgadosmateriasController->selectJuzgadosmateriasPaginacion($JuzgadosmateriasDto, $param);
        if ($JuzgadosmateriasDto != "") {
            return json_encode($JuzgadosmateriasDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertJuzgadosmaterias($JuzgadosmateriasDto) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $param["like"] = true;
        $JuzgadosmateriasDto->setActivo("S");
        $existe = $JuzgadosmateriasController->selectJuzgadosmaterias($JuzgadosmateriasDto, $param);
        if ($existe == "") {
            $JuzgadosmateriasDto = $JuzgadosmateriasController->insertJuzgadosmaterias($JuzgadosmateriasDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuzgadosmateriasDto = $JuzgadosmateriasController->insertJuzgadosmaterias($JuzgadosmateriasDto);
        if ($JuzgadosmateriasDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosmateriasDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateJuzgadosmaterias($JuzgadosmateriasDto) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $cloneJuzgadosmateriasDto = clone $JuzgadosmateriasDto;

        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $cJuzgadosmateriasDto = $JuzgadosmateriasDto;
        $cJuzgadosmateriasDto->setCveJuzgadoMateria("");
        if ($JuzgadosmateriasDto->getActivo() == "N") {
            $JuzgadosmateriasDto = $JuzgadosmateriasController->updateJuzgadosmaterias($cloneJuzgadosmateriasDto);
            if ($JuzgadosmateriasDto != "") {
                $dtoToJson = new DtoToJson($JuzgadosmateriasDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cJuzgadosmateriasDto->setActivo("S");
        $ext = $JuzgadosmateriasController->selectJuzgadosmaterias($cJuzgadosmateriasDto, $param);
        if ($ext == "") {
            $JuzgadosmateriasDto = $JuzgadosmateriasController->updateJuzgadosmaterias($cloneJuzgadosmateriasDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuzgadosmateriasDto = $JuzgadosmateriasController->updateJuzgadosmaterias($JuzgadosmateriasDto);
        if ($JuzgadosmateriasDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosmateriasDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteJuzgadosmaterias($JuzgadosmateriasDto) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $JuzgadosmateriasDto = $JuzgadosmateriasController->deleteJuzgadosmaterias($JuzgadosmateriasDto);
        if ($JuzgadosmateriasDto == true) {
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

    public function getPaginas($juzgadosmateriasDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $juzgadosmateriasDto = $this->validarJuzgadosmaterias($juzgadosmateriasDto);
        $JuzgadosmateriasController = new JuzgadosmateriasController();
        $juzgadosmateriasDto = $JuzgadosmateriasController->getPaginas($juzgadosmateriasDto, $param);
        if ($juzgadosmateriasDto != "") {
            return $juzgadosmateriasDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveJuzgadoMateria = $_POST["cveJuzgadoMateria"];
@$cveJuzgado = $_POST["cveJuzgado"];
@$cveMateria = $_POST["cveMateria"];
@$cveCuantia = $_POST["cveCuantia"];
@$cveTipo = $_POST["cveTipo"];
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
$juzgadosmateriasFacade = new JuzgadosmateriasFacade();
$juzgadosmateriasDto = new JuzgadosmateriasDTO();

$juzgadosmateriasDto->setCveJuzgadoMateria($cveJuzgadoMateria);
$juzgadosmateriasDto->setCveJuzgado($cveJuzgado);
$juzgadosmateriasDto->setCveMateria($cveMateria);
$juzgadosmateriasDto->setCveCuantia($cveCuantia);
$juzgadosmateriasDto->setCveTipo($cveTipo);
$juzgadosmateriasDto->setActivo($activo);
$juzgadosmateriasDto->setFechaRegistro($fechaRegistro);
$juzgadosmateriasDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveJuzgadoMateria == "")) {
    $juzgadosmateriasDto = $juzgadosmateriasFacade->insertJuzgadosmaterias($juzgadosmateriasDto);
    echo $juzgadosmateriasDto;
} else if (($accion == "guardar") && ($cveJuzgadoMateria != "")) {
    $juzgadosmateriasDto = $juzgadosmateriasFacade->updateJuzgadosmaterias($juzgadosmateriasDto);
    echo $juzgadosmateriasDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $juzgadosmateriasDto = $juzgadosmateriasFacade->selectJuzgadosmaterias($juzgadosmateriasDto);
    echo $juzgadosmateriasDto;
} else if (($accion == "baja") && ($cveJuzgadoMateria != "")) {
    $juzgadosmateriasDto = $juzgadosmateriasFacade->deleteJuzgadosmaterias($juzgadosmateriasDto);
    echo $juzgadosmateriasDto;
} else if (($accion == "seleccionar") && ($cveJuzgadoMateria != "")) {
    $juzgadosmateriasDto = $juzgadosmateriasFacade->selectJuzgadosmaterias($juzgadosmateriasDto);
    echo $juzgadosmateriasDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $juzgadosmateriasDto = $juzgadosmateriasFacade->selectJuzgadosmateriasPaginacion($juzgadosmateriasDto, $param);
    echo $juzgadosmateriasDto;
} else if ($accion == "getPaginas") {
    $juzgadosmateriasDto = $juzgadosmateriasFacade->getPaginas($juzgadosmateriasDto, $param);
    echo $juzgadosmateriasDto;
}
?>