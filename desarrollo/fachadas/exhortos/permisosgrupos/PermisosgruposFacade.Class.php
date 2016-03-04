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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosgrupos/PermisosgruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/permisosgrupos/PermisosgruposController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class PermisosgruposFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPermisosgrupos($PermisosgruposDto) {
        $PermisosgruposDto->setcvePermisoGrupo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getcvePermisoGrupo(), "utf8") : strtoupper($PermisosgruposDto->getcvePermisoGrupo()))))));
        if ($this->esFecha($PermisosgruposDto->getcvePermisoGrupo())) {
            $PermisosgruposDto->setcvePermisoGrupo($this->fechaMysql($PermisosgruposDto->getcvePermisoGrupo()));
        }
        $PermisosgruposDto->setcveGrupo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getcveGrupo(), "utf8") : strtoupper($PermisosgruposDto->getcveGrupo()))))));
        if ($this->esFecha($PermisosgruposDto->getcveGrupo())) {
            $PermisosgruposDto->setcveGrupo($this->fechaMysql($PermisosgruposDto->getcveGrupo()));
        }
        $PermisosgruposDto->setcveSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getcveSistema(), "utf8") : strtoupper($PermisosgruposDto->getcveSistema()))))));
        if ($this->esFecha($PermisosgruposDto->getcveSistema())) {
            $PermisosgruposDto->setcveSistema($this->fechaMysql($PermisosgruposDto->getcveSistema()));
        }
        $PermisosgruposDto->setcveFormulario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getcveFormulario(), "utf8") : strtoupper($PermisosgruposDto->getcveFormulario()))))));
        if ($this->esFecha($PermisosgruposDto->getcveFormulario())) {
            $PermisosgruposDto->setcveFormulario($this->fechaMysql($PermisosgruposDto->getcveFormulario()));
        }
        $PermisosgruposDto->setconsulta(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getconsulta(), "utf8") : strtoupper($PermisosgruposDto->getconsulta()))))));
        if ($this->esFecha($PermisosgruposDto->getconsulta())) {
            $PermisosgruposDto->setconsulta($this->fechaMysql($PermisosgruposDto->getconsulta()));
        }
        $PermisosgruposDto->setmodificar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getmodificar(), "utf8") : strtoupper($PermisosgruposDto->getmodificar()))))));
        if ($this->esFecha($PermisosgruposDto->getmodificar())) {
            $PermisosgruposDto->setmodificar($this->fechaMysql($PermisosgruposDto->getmodificar()));
        }
        $PermisosgruposDto->seteliminar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->geteliminar(), "utf8") : strtoupper($PermisosgruposDto->geteliminar()))))));
        if ($this->esFecha($PermisosgruposDto->geteliminar())) {
            $PermisosgruposDto->seteliminar($this->fechaMysql($PermisosgruposDto->geteliminar()));
        }
        $PermisosgruposDto->setregistrar(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getregistrar(), "utf8") : strtoupper($PermisosgruposDto->getregistrar()))))));
        if ($this->esFecha($PermisosgruposDto->getregistrar())) {
            $PermisosgruposDto->setregistrar($this->fechaMysql($PermisosgruposDto->getregistrar()));
        }
        $PermisosgruposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getfechaRegistro(), "utf8") : strtoupper($PermisosgruposDto->getfechaRegistro()))))));
        if ($this->esFecha($PermisosgruposDto->getfechaRegistro())) {
            $PermisosgruposDto->setfechaRegistro($this->fechaMysql($PermisosgruposDto->getfechaRegistro()));
        }
        $PermisosgruposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PermisosgruposDto->getfechaActualizacion(), "utf8") : strtoupper($PermisosgruposDto->getfechaActualizacion()))))));
        if ($this->esFecha($PermisosgruposDto->getfechaActualizacion())) {
            $PermisosgruposDto->setfechaActualizacion($this->fechaMysql($PermisosgruposDto->getfechaActualizacion()));
        }
        return $PermisosgruposDto;
    }

    public function selectPermisosgrupos($PermisosgruposDto) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposController = new PermisosgruposController();
        $PermisosgruposDto = $PermisosgruposController->selectPermisosgrupos($PermisosgruposDto);
        if ($PermisosgruposDto != "") {
            $dtoToJson = new DtoToJson($PermisosgruposDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertPermisosgrupos($PermisosgruposDto,$param) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposController = new PermisosgruposController();
        $resultado = $PermisosgruposController->insertPermisosgrupos($PermisosgruposDto,$param);
        return $resultado;
    }

    public function updatePermisosgrupos($PermisosgruposDto) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposController = new PermisosgruposController();
        $PermisosgruposDto = $PermisosgruposController->updatePermisosgrupos($PermisosgruposDto);
        if ($PermisosgruposDto != "") {
            $dtoToJson = new DtoToJson($PermisosgruposDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deletePermisosgrupos($PermisosgruposDto) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposController = new PermisosgruposController();
        $PermisosgruposDto = $PermisosgruposController->deletePermisosgrupos($PermisosgruposDto);
        if ($PermisosgruposDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function consultarOpciones($param) {
        $PermisosgruposController = new PermisosgruposController();
        $result = $PermisosgruposController->consultarOpciones($param);
        return $result;
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

@$cvePermisoGrupo = $_POST["cvePermisoGrupo"];
@$cveGrupo = $_POST["cveGrupo"];
@$cveSistema = $_POST["cveSistema"];
@$cveFormulario = $_POST["cveFormulario"];
@$consulta = $_POST["consulta"];
@$modificar = $_POST["modificar"];
@$eliminar = $_POST["eliminar"];
@$registrar = $_POST["registrar"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];


$param = array();
@$param["tipoPermiso"] = $_POST['tipoPermiso'];
@$param["crud"] = $_POST['crud'];
@$param["cveSistema"] = $_POST['cveSistema'];


$permisosgruposFacade = new PermisosgruposFacade();
$permisosgruposDto = new PermisosgruposDTO();

$permisosgruposDto->setCvePermisoGrupo($cvePermisoGrupo);
$permisosgruposDto->setCveGrupo($cveGrupo);
$permisosgruposDto->setCveSistema($cveSistema);
$permisosgruposDto->setCveFormulario($cveFormulario);
$permisosgruposDto->setConsulta($consulta);
$permisosgruposDto->setModificar($modificar);
$permisosgruposDto->setEliminar($eliminar);
$permisosgruposDto->setRegistrar($registrar);
$permisosgruposDto->setFechaRegistro($fechaRegistro);
$permisosgruposDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cvePermisoGrupo == "")) {
    $permisosgruposDto = $permisosgruposFacade->insertPermisosgrupos($permisosgruposDto,$param);
    echo $permisosgruposDto;
} else if (($accion == "guardar") && ($cvePermisoGrupo != "")) {
    $permisosgruposDto = $permisosgruposFacade->updatePermisosgrupos($permisosgruposDto);
    echo $permisosgruposDto;
} else if ($accion == "consultar") {
    $permisosgruposDto = $permisosgruposFacade->selectPermisosgrupos($permisosgruposDto);
    echo $permisosgruposDto;
} else if (($accion == "baja") && ($cvePermisoGrupo != "")) {
    $permisosgruposDto = $permisosgruposFacade->deletePermisosgrupos($permisosgruposDto);
    echo $permisosgruposDto;
} else if (($accion == "seleccionar") && ($cvePermisoGrupo != "")) {
    $permisosgruposDto = $permisosgruposFacade->selectPermisosgrupos($permisosgruposDto);
    echo $permisosgruposDto;
} else if (($accion == "consultarOpciones")) {
    $permisosgruposDto = $permisosgruposFacade->consultarOpciones($param);
    echo $permisosgruposDto;
}
?>