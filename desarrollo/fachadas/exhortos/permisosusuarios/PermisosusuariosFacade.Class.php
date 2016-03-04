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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosusuarios/PermisosusuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/permisosusuarios/PermisosusuariosController.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/perfiles/PerfilesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class PermisosusuariosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPermisosusuarios($PermisosusuariosDto) {
        $PermisosusuariosDto->setcvePermisoUsuario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getcvePermisoUsuario(), "utf8") : strtoupper($PermisosusuariosDto->getcvePermisoUsuario()))))));
        if ($this->esFecha($PermisosusuariosDto->getcvePermisoUsuario())) {
            $PermisosusuariosDto->setcvePermisoUsuario($this->fechaMysql($PermisosusuariosDto->getcvePermisoUsuario()));
        }
        $PermisosusuariosDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getcveUsuario(), "utf8") : strtoupper($PermisosusuariosDto->getcveUsuario()))))));
        if ($this->esFecha($PermisosusuariosDto->getcveUsuario())) {
            $PermisosusuariosDto->setcveUsuario($this->fechaMysql($PermisosusuariosDto->getcveUsuario()));
        }
        $PermisosusuariosDto->setcveSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getcveSistema(), "utf8") : strtoupper($PermisosusuariosDto->getcveSistema()))))));
        if ($this->esFecha($PermisosusuariosDto->getcveSistema())) {
            $PermisosusuariosDto->setcveSistema($this->fechaMysql($PermisosusuariosDto->getcveSistema()));
        }
        $PermisosusuariosDto->setcveFormulario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getcveFormulario(), "utf8") : strtoupper($PermisosusuariosDto->getcveFormulario()))))));
        if ($this->esFecha($PermisosusuariosDto->getcveFormulario())) {
            $PermisosusuariosDto->setcveFormulario($this->fechaMysql($PermisosusuariosDto->getcveFormulario()));
        }
        $PermisosusuariosDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getcvePerfil(), "utf8") : strtoupper($PermisosusuariosDto->getcvePerfil()))))));
        if ($this->esFecha($PermisosusuariosDto->getcvePerfil())) {
            $PermisosusuariosDto->setcvePerfil($this->fechaMysql($PermisosusuariosDto->getcvePerfil()));
        }
        $PermisosusuariosDto->setconsulta(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getconsulta(), "utf8") : strtoupper($PermisosusuariosDto->getconsulta()))))));
        if ($this->esFecha($PermisosusuariosDto->getconsulta())) {
            $PermisosusuariosDto->setconsulta($this->fechaMysql($PermisosusuariosDto->getconsulta()));
        }
        $PermisosusuariosDto->setmodificar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getmodificar(), "utf8") : strtoupper($PermisosusuariosDto->getmodificar()))))));
        if ($this->esFecha($PermisosusuariosDto->getmodificar())) {
            $PermisosusuariosDto->setmodificar($this->fechaMysql($PermisosusuariosDto->getmodificar()));
        }
        $PermisosusuariosDto->seteliminar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->geteliminar(), "utf8") : strtoupper($PermisosusuariosDto->geteliminar()))))));
        if ($this->esFecha($PermisosusuariosDto->geteliminar())) {
            $PermisosusuariosDto->seteliminar($this->fechaMysql($PermisosusuariosDto->geteliminar()));
        }
        $PermisosusuariosDto->setregistrar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getregistrar(), "utf8") : strtoupper($PermisosusuariosDto->getregistrar()))))));
        if ($this->esFecha($PermisosusuariosDto->getregistrar())) {
            $PermisosusuariosDto->setregistrar($this->fechaMysql($PermisosusuariosDto->getregistrar()));
        }
        $PermisosusuariosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getfechaRegistro(), "utf8") : strtoupper($PermisosusuariosDto->getfechaRegistro()))))));
        if ($this->esFecha($PermisosusuariosDto->getfechaRegistro())) {
            $PermisosusuariosDto->setfechaRegistro($this->fechaMysql($PermisosusuariosDto->getfechaRegistro()));
        }
        $PermisosusuariosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosusuariosDto->getfechaActualizacion(), "utf8") : strtoupper($PermisosusuariosDto->getfechaActualizacion()))))));
        if ($this->esFecha($PermisosusuariosDto->getfechaActualizacion())) {
            $PermisosusuariosDto->setfechaActualizacion($this->fechaMysql($PermisosusuariosDto->getfechaActualizacion()));
        }
        return $PermisosusuariosDto;
    }

    public function selectPermisosusuarios($PermisosusuariosDto) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosController = new PermisosusuariosController();
        $PermisosusuariosDto = $PermisosusuariosController->selectPermisosusuarios($PermisosusuariosDto);
        if ($PermisosusuariosDto != "") {
            $dtoToJson = new DtoToJson($PermisosusuariosDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertPermisosusuarios($PermisosusuariosDto, $param) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosController = new PermisosusuariosController();
        $rsPermisos = $PermisosusuariosController->insertPermisosusuarios($PermisosusuariosDto, $param);
        return $rsPermisos;
    }

    public function updatePermisosusuarios($PermisosusuariosDto) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosController = new PermisosusuariosController();
        $PermisosusuariosDto = $PermisosusuariosController->updatePermisosusuarios($PermisosusuariosDto);
        if ($PermisosusuariosDto != "") {
            $dtoToJson = new DtoToJson($PermisosusuariosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deletePermisosusuarios($PermisosusuariosDto) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosController = new PermisosusuariosController();
        $PermisosusuariosDto = $PermisosusuariosController->deletePermisosusuarios($PermisosusuariosDto);
        if ($PermisosusuariosDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function consultarOpciones($perfilesDto) {
        $PermisosusuariosController = new PermisosusuariosController();
        $PermisosusuariosDto = $PermisosusuariosController->consultarOpciones($perfilesDto);
        return $PermisosusuariosDto;
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

@$cvePermisoUsuario = $_POST["cvePermisoUsuario"];
@$cveUsuario = $_POST["cveUsuario"];
@$cveSistema = $_POST["cveSistema"];
@$cveFormulario = $_POST["cveFormulario"];
@$cvePerfil = $_POST["cvePerfil"];
@$consulta = $_POST["consulta"];
@$modificar = $_POST["modificar"];
@$eliminar = $_POST["eliminar"];
@$registrar = $_POST["registrar"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$activo = $_POST["activo"];

$param = array();
@$param["tipoPermiso"] = $_POST['tipoPermiso'];
@$param["crud"] = $_POST['crud'];




@$accion = $_POST["accion"];

$permisosusuariosFacade = new PermisosusuariosFacade();
$permisosusuariosDto = new PermisosusuariosDTO();

$permisosusuariosDto->setCvePermisoUsuario($cvePermisoUsuario);
$permisosusuariosDto->setCveUsuario($cveUsuario);
$permisosusuariosDto->setCveSistema($cveSistema);
$permisosusuariosDto->setCveFormulario($cveFormulario);
$permisosusuariosDto->setCvePerfil($cvePerfil);
$permisosusuariosDto->setConsulta($consulta);
$permisosusuariosDto->setModificar($modificar);
$permisosusuariosDto->setEliminar($eliminar);
$permisosusuariosDto->setRegistrar($registrar);
$permisosusuariosDto->setFechaRegistro($fechaRegistro);
$permisosusuariosDto->setFechaActualizacion($fechaActualizacion);

$perfilesDto = new PerfilesDTO();
$perfilesDto->setCvePerfil($cvePerfil);
$perfilesDto->setActivo($activo);


if (($accion == "guardar") && ($cvePermisoUsuario == "")) {
    $permisosusuariosDto = $permisosusuariosFacade->insertPermisosusuarios($permisosusuariosDto, $param);
    echo $permisosusuariosDto;
} else if (($accion == "guardar") && ($cvePermisoUsuario != "")) {
    $permisosusuariosDto = $permisosusuariosFacade->updatePermisosusuarios($permisosusuariosDto);
    echo $permisosusuariosDto;
} else if ($accion == "consultar") {
    $permisosusuariosDto = $permisosusuariosFacade->selectPermisosusuarios($permisosusuariosDto);
    echo $permisosusuariosDto;
} else if (($accion == "baja") && ($cvePermisoUsuario != "")) {
    $permisosusuariosDto = $permisosusuariosFacade->deletePermisosusuarios($permisosusuariosDto);
    echo $permisosusuariosDto;
} else if (($accion == "seleccionar") && ($cvePermisoUsuario != "")) {
    $permisosusuariosDto = $permisosusuariosFacade->selectPermisosusuarios($permisosusuariosDto);
    echo $permisosusuariosDto;
} else if (($accion == "consultarOpciones")) {
    $permisosusuariosDto = $permisosusuariosFacade->consultarOpciones($perfilesDto);
    echo $permisosusuariosDto;
}
?>