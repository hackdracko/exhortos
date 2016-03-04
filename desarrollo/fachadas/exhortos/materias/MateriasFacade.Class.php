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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/materias/MateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/materias/MateriasController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class MateriasFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarMaterias($MateriasDto) {
        $MateriasDto->setcveMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MateriasDto->getcveMateria(), "utf8") : strtoupper($MateriasDto->getcveMateria()))))));
        if ($this->esFecha($MateriasDto->getcveMateria())) {
            $MateriasDto->setcveMateria($this->fechaMysql($MateriasDto->getcveMateria()));
        }
        $MateriasDto->setdesMateria(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MateriasDto->getdesMateria(), "utf8") : strtoupper($MateriasDto->getdesMateria()))))));
        if ($this->esFecha($MateriasDto->getdesMateria())) {
            $MateriasDto->setdesMateria($this->fechaMysql($MateriasDto->getdesMateria()));
        }
        $MateriasDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MateriasDto->getactivo(), "utf8") : strtoupper($MateriasDto->getactivo()))))));
        if ($this->esFecha($MateriasDto->getactivo())) {
            $MateriasDto->setactivo($this->fechaMysql($MateriasDto->getactivo()));
        }
        $MateriasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MateriasDto->getfechaRegistro(), "utf8") : strtoupper($MateriasDto->getfechaRegistro()))))));
        if ($this->esFecha($MateriasDto->getfechaRegistro())) {
            $MateriasDto->setfechaRegistro($this->fechaMysql($MateriasDto->getfechaRegistro()));
        }
        $MateriasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($MateriasDto->getfechaActualizacion(), "utf8") : strtoupper($MateriasDto->getfechaActualizacion()))))));
        if ($this->esFecha($MateriasDto->getfechaActualizacion())) {
            $MateriasDto->setfechaActualizacion($this->fechaMysql($MateriasDto->getfechaActualizacion()));
        }
        return $MateriasDto;
    }

    public function selectMaterias($MateriasDto, $param = null) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasController = new MateriasController();
        $MateriasDto = $MateriasController->selectMaterias($MateriasDto, $param);
        if ($MateriasDto != "") {
            $dtoToJson = new DtoToJson($MateriasDto);
            return $dtoToJson->toJsonPaginado($param["pag"], count($MateriasDto));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertMaterias($MateriasDto, $param) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasController = new MateriasController();
        $param["like"] = true;
        $MateriasDto->setActivo("S");
        $existe = $MateriasController->selectMaterias($MateriasDto, $param);
        if ($existe == "") {
//            var_dump($MateriasDto);
            $MateriasDto = $MateriasController->insertMaterias($MateriasDto);
//            var_dump($MateriasDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $MateriasDto = $MateriasController->insertMaterias($MateriasDto);
        if ($MateriasDto != "") {
            $dtoToJson = new DtoToJson($MateriasDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateMaterias($MateriasDto, $param) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $cloneMateriasDto = clone $MateriasDto;

        $MateriasController = new MateriasController();
        $cMateriasDto = $MateriasDto;
        $cMateriasDto->setCveMateria("");
        if ($MateriasDto->getActivo() == "N") {
            $MateriasDto = $MateriasController->updateMaterias($cloneMateriasDto);
            if ($MateriasDto != "") {
                $dtoToJson = new DtoToJson($MateriasDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cMateriasDto->setActivo("S");
        $ext = $MateriasController->selectMaterias($cMateriasDto, $param);
        if ($ext == "") {
            $MateriasDto = $MateriasController->updateMaterias($cloneMateriasDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $MateriasDto = $MateriasController->updateMaterias($MateriasDto);
        if ($MateriasDto != "") {
            $dtoToJson = new DtoToJson($MateriasDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteMaterias($MateriasDto) {
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasController = new MateriasController();
        $MateriasDto = $MateriasController->deleteMaterias($MateriasDto);
        if ($MateriasDto == true) {
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

    public function getPaginas($MateriasDto, $param) {
        //var_dump($generosDto);
        //var_dump($param);
        $MateriasDto = $this->validarMaterias($MateriasDto);
        $MateriasController = new MateriasController();
        $MateriasDto = $MateriasController->getPaginas($MateriasDto, $param);
        if ($MateriasDto != "") {
            return $MateriasDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveMateria = $_POST["cveMateria"];
@$desMateria = $_POST["desMateria"];
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

$materiasFacade = new MateriasFacade();
$materiasDto = new MateriasDTO();

$materiasDto->setCveMateria($cveMateria);
$materiasDto->setDesMateria($desMateria);
$materiasDto->setActivo($activo);
$materiasDto->setFechaRegistro($fechaRegistro);
$materiasDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveMateria == "")) {
    $materiasDto = $materiasFacade->insertMaterias($materiasDto, $param);
    echo $materiasDto;
} else if (($accion == "guardar") && ($cveMateria != "")) {
    $materiasDto = $materiasFacade->updateMaterias($materiasDto, $param);
    echo $materiasDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $materiasDto = $materiasFacade->selectMaterias($materiasDto, $param);
    echo utf8_encode($materiasDto);
} else if (($accion == "baja") && ($cveMateria != "")) {
    $materiasDto = $materiasFacade->deleteMaterias($materiasDto);
    echo $materiasDto;
} else if (($accion == "seleccionar") && ($cveMateria != "")) {
    $materiasDto = $materiasFacade->selectMaterias($materiasDto);
    echo $materiasDto;
} else if ($accion == "consultar-paginacion") {
    $param["paginacion"] = true;
    $materiasDto = $materiasFacade->selectMaterias($materiasDto, $param);
    echo $materiasDto;
} else if ($accion == "getPaginas") {
    $materiasDto = $materiasFacade->getPaginas($materiasDto, $param);
    echo $materiasDto;
}
?>