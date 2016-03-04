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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/acciones/AccionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/acciones/AccionesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class AccionesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarAcciones($AccionesDto) {
        $AccionesDto->setcveAccion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AccionesDto->getcveAccion(), "utf8") : strtoupper($AccionesDto->getcveAccion()))))));
        if ($this->esFecha($AccionesDto->getcveAccion())) {
            $AccionesDto->setcveAccion($this->fechaMysql($AccionesDto->getcveAccion()));
        }
        $AccionesDto->setdesAccion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AccionesDto->getdesAccion(), "utf8") : strtoupper($AccionesDto->getdesAccion()))))));
        if ($this->esFecha($AccionesDto->getdesAccion())) {
            $AccionesDto->setdesAccion($this->fechaMysql($AccionesDto->getdesAccion()));
        }
        $AccionesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AccionesDto->getactivo(), "utf8") : strtoupper($AccionesDto->getactivo()))))));
        if ($this->esFecha($AccionesDto->getactivo())) {
            $AccionesDto->setactivo($this->fechaMysql($AccionesDto->getactivo()));
        }
        $AccionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AccionesDto->getfechaRegistro(), "utf8") : strtoupper($AccionesDto->getfechaRegistro()))))));
        if ($this->esFecha($AccionesDto->getfechaRegistro())) {
            $AccionesDto->setfechaRegistro($this->fechaMysql($AccionesDto->getfechaRegistro()));
        }
        $AccionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AccionesDto->getfechaActualizacion(), "utf8") : strtoupper($AccionesDto->getfechaActualizacion()))))));
        if ($this->esFecha($AccionesDto->getfechaActualizacion())) {
            $AccionesDto->setfechaActualizacion($this->fechaMysql($AccionesDto->getfechaActualizacion()));
        }
        return $AccionesDto;
    }

    public function selectAcciones($AccionesDto, $param) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesController = new AccionesController();
        $AccionesDto = $AccionesController->selectAcciones($AccionesDto, $param);
        $json = "";
        $x = 1;
        if ($AccionesDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($AccionesDto) . '",';
            $json .= '"data":[';
            foreach ($AccionesDto as $accion) {
                $json .= "{";
                $json .= '"cveAccion":' . json_encode(utf8_encode($accion->getCveAccion())) . ",";
                $json .= '"desAccion":' . json_encode(utf8_encode($accion->getDesAccion())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($accion->getActivo())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($accion->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($accion->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($AccionesDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($AccionesDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }


        echo $json;
    }

    public function getPaginas($AccionesDto, $param) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesController = new AccionesController();
        $AccionesDto = $AccionesController->getPaginas($AccionesDto, $param);
        if ($AccionesDto == true) {
            return $AccionesDto;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
        }
    }

    public function insertAcciones($AccionesDto, $param) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesController = new AccionesController();

        $accionesAuxDto = new AccionesDTO();
        $accionesAuxDto->setDesAccion($AccionesDto->getDesAccion());
        $rsAcciones = $AccionesController->selectAcciones($AccionesDto, $param);
        $json = "";
        $x = 1;
        if ($rsAcciones == "") {
            $AccionesDto = $AccionesController->insertAcciones($AccionesDto);
            if ($AccionesDto != "") {
                $json .= "{";
                $json .= '"status":"Ok",';
                $json .= '"totalCount":"' . count($AccionesDto) . '",';
                $json .= '"data":[';
                foreach ($AccionesDto as $accion) {
                    $json .= "{";
                    $json .= '"cveAccion":' . json_encode(utf8_encode($accion->getCveAccion())) . ",";
                    $json .= '"desAccion":' . json_encode(utf8_encode($accion->getDesAccion())) . ",";
                    $json .= '"activo":' . json_encode(utf8_encode($accion->getActivo())) . ",";
                    $json .= '"fechaRegistro":' . json_encode(utf8_encode($accion->getFechaRegistro())) . ",";
                    $json .= '"fechaActualizacion":' . json_encode(utf8_encode($accion->getFechaActualizacion())) . "";
                    $json .= "}" . "\n";
                    $x ++;
                    if ($x <= count($AccionesDto)) {
                        $json .= ",";
                    }
                }
                $json .= "]";
                $json .= "}";
                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("30");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones($json);
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
            } else {
                $json .= '{"estatus":"Fail",';
                $json .= '"totalCount":"0",';
                $json .= '"text":"No se encontraron resultados."}';
            }
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"totalCount":"0",';
            $json .= '"text":"El registro ya se encuentra dado de alta. Verifique."}';
        }
        echo $json;
    }

    public function updateAcciones($AccionesDto) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesController = new AccionesController();
        $AccionesDto = $AccionesController->updateAcciones($AccionesDto);
        $json = "";
        $x = 1;
        if ($AccionesDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($AccionesDto) . '",';
            $json .= '"data":[';
            foreach ($AccionesDto as $accion) {
                $json .= "{";
                $json .= '"cveAccion":' . json_encode(utf8_encode($accion->getCveAccion())) . ",";
                $json .= '"desAccion":' . json_encode(utf8_encode($accion->getDesAccion())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($accion->getActivo())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($accion->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($accion->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($AccionesDto)) {
                    $json .= ",";
                }
            }
            $json .= "]";
            $json .= "}";
            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("32");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones($json);
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"totalCount":"0",';
            $json .= '"text":"No se encontraron resultados."}';
        }
        echo $json;
    }

    public function deleteAcciones($AccionesDto) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesController = new AccionesController();
        $AccionesDto = $AccionesController->deleteAcciones($AccionesDto);
        if ($AccionesDto == true) {
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

}

@$cveAccion = $_POST["cveAccion"];
@$desAccion = $_POST["desAccion"];
@$activo = $_POST["activo"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];

$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];


$accionesFacade = new AccionesFacade();
$accionesDto = new AccionesDTO();

$accionesDto->setCveAccion($cveAccion);
$accionesDto->setDesAccion($desAccion);
$accionesDto->setActivo($activo);
$accionesDto->setFechaRegistro($fechaRegistro);
$accionesDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveAccion == "")) {
    $param["paginacion"] = false;
    $accionesDto = $accionesFacade->insertAcciones($accionesDto, $param);
    echo $accionesDto;
} else if (($accion == "guardar") && ($cveAccion != "")) {
    $param["paginacion"] = false;
    $accionesDto = $accionesFacade->updateAcciones($accionesDto, $param);
    echo $accionesDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = true;
    $accionesDto = $accionesFacade->selectAcciones($accionesDto, $param);
    echo $accionesDto;
} else if ($accion == "getPaginas") {
    $param["paginacion"] = true;
    $accionesDto = $accionesFacade->getPaginas($accionesDto, $param);
    echo $accionesDto;
} else if (($accion == "baja")) {
    $accionesDto->setActivo('N');
    $accionesDto = $accionesFacade->updateAcciones($accionesDto);
    echo $accionesDto;
} else if (($accion == "seleccionar") && ($cveAccion != "")) {
    $param["paginacion"] = false;
    $accionesDto = $accionesFacade->selectAcciones($accionesDto, $param);
    echo $accionesDto;
}
?>