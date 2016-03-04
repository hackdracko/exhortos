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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juzgados/JuzgadosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class JuzgadosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuzgados($JuzgadosDto) {
        $JuzgadosDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getcveJuzgado(), "utf8") : strtoupper($JuzgadosDto->getcveJuzgado()))))));
        if ($this->esFecha($JuzgadosDto->getcveJuzgado())) {
            $JuzgadosDto->setcveJuzgado($this->fechaMysql($JuzgadosDto->getcveJuzgado()));
        }
        $JuzgadosDto->setdesJuzgado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getdesJuzgado(), "utf8") : strtoupper($JuzgadosDto->getdesJuzgado()))))));
        if ($this->esFecha($JuzgadosDto->getdesJuzgado())) {
            $JuzgadosDto->setdesJuzgado($this->fechaMysql($JuzgadosDto->getdesJuzgado()));
        }
        $JuzgadosDto->setcveOficialia(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getcveOficialia(), "utf8") : strtoupper($JuzgadosDto->getcveOficialia()))))));
        if ($this->esFecha($JuzgadosDto->getcveOficialia())) {
            $JuzgadosDto->setcveOficialia($this->fechaMysql($JuzgadosDto->getcveOficialia()));
        }
        $JuzgadosDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getcveAdscripcion(), "utf8") : strtoupper($JuzgadosDto->getcveAdscripcion()))))));
        if ($this->esFecha($JuzgadosDto->getcveAdscripcion())) {
            $JuzgadosDto->setcveAdscripcion($this->fechaMysql($JuzgadosDto->getcveAdscripcion()));
        }
        $JuzgadosDto->setproporcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getproporcion(), "utf8") : strtoupper($JuzgadosDto->getproporcion()))))));
        if ($this->esFecha($JuzgadosDto->getproporcion())) {
            $JuzgadosDto->setproporcion($this->fechaMysql($JuzgadosDto->getproporcion()));
        }
        $JuzgadosDto->setasignados(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getasignados(), "utf8") : strtoupper($JuzgadosDto->getasignados()))))));
        if ($this->esFecha($JuzgadosDto->getasignados())) {
            $JuzgadosDto->setasignados($this->fechaMysql($JuzgadosDto->getasignados()));
        }
        $JuzgadosDto->setcontrol(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getcontrol(), "utf8") : strtoupper($JuzgadosDto->getcontrol()))))));
        if ($this->esFecha($JuzgadosDto->getcontrol())) {
            $JuzgadosDto->setcontrol($this->fechaMysql($JuzgadosDto->getcontrol()));
        }
        $JuzgadosDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getactivo(), "utf8") : strtoupper($JuzgadosDto->getactivo()))))));
        if ($this->esFecha($JuzgadosDto->getactivo())) {
            $JuzgadosDto->setactivo($this->fechaMysql($JuzgadosDto->getactivo()));
        }
        $JuzgadosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getfechaRegistro(), "utf8") : strtoupper($JuzgadosDto->getfechaRegistro()))))));
        if ($this->esFecha($JuzgadosDto->getfechaRegistro())) {
            $JuzgadosDto->setfechaRegistro($this->fechaMysql($JuzgadosDto->getfechaRegistro()));
        }
        $JuzgadosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($JuzgadosDto->getfechaActualizacion(), "utf8") : strtoupper($JuzgadosDto->getfechaActualizacion()))))));
        if ($this->esFecha($JuzgadosDto->getfechaActualizacion())) {
            $JuzgadosDto->setfechaActualizacion($this->fechaMysql($JuzgadosDto->getfechaActualizacion()));
        }
        return $JuzgadosDto;
    }

    public function selectJuzgados($JuzgadosDto, $param = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $JuzgadosDto = $JuzgadosController->selectJuzgados($JuzgadosDto, $param);
        if ($JuzgadosDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }
    public function selectJuzgadosEstado($JuzgadosDto, $param = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $JuzgadosDto = $JuzgadosController->selectJuzgadosEstado($JuzgadosDto, $param);
        if ($JuzgadosDto != "") {
            return $JuzgadosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectJuzgadosPaginacion($JuzgadosDto, $param = null, $estado, $municipio, $distrito) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $JuzgadosDto = $JuzgadosController->selectJuzgadosPaginacion($JuzgadosDto, $param, $estado, $municipio, $distrito);
        if ($JuzgadosDto != "") {
//            $dtoToJson = new DtoToJson($JuzgadosDto);
            return ($JuzgadosDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertJuzgados($JuzgadosDto) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $param["like"] = true;
        $JuzgadosDto->setActivo("S");
        $existe = $JuzgadosController->selectJuzgados($JuzgadosDto, $param);
        if ($existe == "") {
            $JuzgadosDto = $JuzgadosController->insertJuzgados($JuzgadosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuzgadosDto = $JuzgadosController->insertJuzgados($JuzgadosDto);
        if ($JuzgadosDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }
    public function insertJuzgadosProvedor($JuzgadosDto, $juzgadoMateriaDto) {
       
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $param["like"] = true;
        $JuzgadosDto->setActivo("S");
        $existe = $JuzgadosController->selectJuzgados($JuzgadosDto, $param);
        if ($existe == "") {
            $JuzgadosDto = $JuzgadosController->insertJuzgadosProvedor($JuzgadosDto, $juzgadoMateriaDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuzgadosDto = $JuzgadosController->insertJuzgados($JuzgadosDto);
        if ($JuzgadosDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateJuzgados($JuzgadosDto) {
//        var_dump($JuzgadosDto);
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $cloneJuzgadosDto = clone $JuzgadosDto;

        $JuzgadosController = new JuzgadosController();
        $cJuzgadosDto = $JuzgadosDto;
        $cJuzgadosDto->setCveJuzgado("");
        if ($JuzgadosDto->getActivo() == "N") {
            $JuzgadosDto = $JuzgadosController->updateJuzgados($cloneJuzgadosDto);
            if ($JuzgadosDto != "") {
                $dtoToJson = new DtoToJson($JuzgadosDto);
                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            }
        }
        $param["like"] = true;
        $cJuzgadosDto->setActivo("S");
        $ext = $JuzgadosController->selectJuzgados($cJuzgadosDto, $param);
//        var_dump($ext);
        if ($ext == "") {
            $JuzgadosDto = $JuzgadosController->updateJuzgados($cloneJuzgadosDto);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $JuzgadosDto = $JuzgadosController->updateJuzgados($JuzgadosDto);
        if ($JuzgadosDto != "") {
            $dtoToJson = new DtoToJson($JuzgadosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteJuzgados($JuzgadosDto) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $JuzgadosDto = $JuzgadosController->deleteJuzgados($JuzgadosDto);
        if ($JuzgadosDto == true) {
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

    public function getPaginas($juzgadosDto, $param, $estado, $municipio, $distrito) {
        //var_dump($generosDto);
        //var_dump($param);
        $juzgadosDto = $this->validarJuzgados($juzgadosDto);
        $JuzgadosController = new JuzgadosController();
        $juzgadosDto = $JuzgadosController->getPaginas($juzgadosDto, $param, $estado, $municipio, $distrito);
        if ($juzgadosDto != "") {
            return $juzgadosDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

}

@$cveJuzgado = $_POST["cveJuzgado"];
@$desJuzgado = $_POST["desJuzgado"];
@$cveOficialia = $_POST["cveOficialia"];
@$cveAdscripcion = $_POST["cveAdscripcion"];
@$proporcion = $_POST["proporcion"];
@$asignados = $_POST["asignados"];
@$control = $_POST["control"];
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
$juzgadosFacade = new JuzgadosFacade();
$juzgadosDto = new JuzgadosDTO();

$juzgadosDto->setCveJuzgado($cveJuzgado);
$juzgadosDto->setDesJuzgado($desJuzgado);
$juzgadosDto->setCveOficialia($cveOficialia);
$juzgadosDto->setCveAdscripcion($cveAdscripcion);
$juzgadosDto->setProporcion($proporcion);
$juzgadosDto->setAsignados($asignados);
$juzgadosDto->setControl($control);
$juzgadosDto->setActivo($activo);
$juzgadosDto->setFechaRegistro($fechaRegistro);
$juzgadosDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveJuzgado == "")) {
    $juzgadosDto = $juzgadosFacade->insertJuzgados($juzgadosDto);
    echo $juzgadosDto;
} else if (($accion == "guardar") && ($cveJuzgado != "")) {
    $juzgadosDto = $juzgadosFacade->updateJuzgados($juzgadosDto);
    echo $juzgadosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $juzgadosDto = $juzgadosFacade->selectJuzgados($juzgadosDto, $param);
    echo $juzgadosDto;
} else if (($accion == "baja") && ($cveJuzgado != "")) {
    $juzgadosDto = $juzgadosFacade->deleteJuzgados($juzgadosDto);
    echo $juzgadosDto;
} else if (($accion == "seleccionar") && ($cveJuzgado != "")) {
    $juzgadosDto = $juzgadosFacade->selectJuzgados($juzgadosDto);
    echo $juzgadosDto;
} else if ($accion == "consultarEstado") {
    $juzgadosDto = $juzgadosFacade->selectJuzgadosEstado($juzgadosDto);
    echo $juzgadosDto;
} else if ($accion == "consultar-paginacion") {
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $distrito = $_POST['distrito'];
    $param["paginacion"] = true;
    $juzgadosDto = $juzgadosFacade->selectJuzgadosPaginacion($juzgadosDto, $param, $estado, $municipio, $distrito);
    echo $juzgadosDto;
} else if ($accion == "getPaginas") {
    @$estado = $_POST['estado'];
    @$municipio = $_POST['municipio'];
    @$distrito = $_POST['distrito'];
    $juzgadosDto = $juzgadosFacade->getPaginas($juzgadosDto, $param, $estado, $municipio, $distrito);
    echo $juzgadosDto;
}else if (($accion == "guardar-provedor")) {
    
    $juzgadoMateriaDto = new JuzgadosmateriasDTO();
    @$cveMateria = $_POST['materia'];
    @$cveCuantia = $_POST['cuantia'];
    @$cveTipo = $_POST['tipo'];
    $juzgadoMateriaDto->setActivo("S");
    $juzgadoMateriaDto->setCveMateria($cveMateria);
    $juzgadoMateriaDto->setCveCuantia($cveCuantia);
    $juzgadoMateriaDto->setCveTipo($cveTipo);
    $juzgadosDto = $juzgadosFacade->insertJuzgadosProvedor($juzgadosDto, $juzgadoMateriaDto);
    echo $juzgadosDto;
}
?> 