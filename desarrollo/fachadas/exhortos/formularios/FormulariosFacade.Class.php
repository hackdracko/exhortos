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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/formularios/FormulariosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class FormulariosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarFormularios($FormulariosDto) {
        $FormulariosDto->setcveFormulario(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getcveFormulario())))));
        $FormulariosDto->setnomFormulario(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getnomFormulario())))));
        $FormulariosDto->setactivo(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getactivo())))));
        $FormulariosDto->setruta(trim(utf8_decode(str_replace("'", "", $FormulariosDto->getruta()))));
        $FormulariosDto->setdesFormulario(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getdesFormulario())))));
        $FormulariosDto->setorden(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getorden())))));
        $FormulariosDto->setpadre(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getpadre())))));
        $FormulariosDto->setnivel(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getnivel())))));
        $FormulariosDto->setvista(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getvista())))));
        $FormulariosDto->setvista(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $FormulariosDto->getvista())))));
        return $FormulariosDto;
    }

    public function selectFormularios($FormulariosDto) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->selectFormularios($FormulariosDto);
        $json = "";
        $x = 1;
        if ($FormulariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($FormulariosDto) . '",';
            $json .= '"data":[';
            foreach ($FormulariosDto as $Formulario) {
                $json .= "{";
                $json .= '"cveFormulario":' . json_encode(utf8_encode($Formulario->getCveFormulario())) . ",";
                $json .= '"nomFormulario":' . json_encode(utf8_encode($Formulario->getNomFormulario())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Formulario->getActivo())) . ",";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Formulario->getCveSistema())) . ",";
                $json .= '"ruta":' . json_encode(utf8_encode($Formulario->getRuta())) . ",";
                $json .= '"desFormulario":' . json_encode(utf8_encode($Formulario->getDesFormulario())) . ",";
                $json .= '"orden":' . json_encode(utf8_encode($Formulario->getOrden())) . ",";
                $json .= '"padre":' . json_encode(utf8_encode($Formulario->getPadre())) . ",";
                $json .= '"nivel":' . json_encode(utf8_encode($Formulario->getNivel())) . ",";
                $json .= '"vista":' . json_encode(utf8_encode($Formulario->getVista())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Formulario->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Formulario->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($FormulariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "]";
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        echo $json;
    }

    public function selectFormulariosGeneral($FormulariosDto, $param) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->selectFormulariosGeneral($FormulariosDto, $param);
        $json = "";
        $x = 1;
        if ($FormulariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($FormulariosDto) . '",';
            $json .= '"data":[';
            foreach ($FormulariosDto as $Formulario) {
                $json .= "{";
                $json .= '"cveFormulario":' . json_encode(utf8_encode($Formulario->getCveFormulario())) . ",";
                $json .= '"nomFormulario":' . json_encode(utf8_encode($Formulario->getNomFormulario())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Formulario->getActivo())) . ",";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Formulario->getCveSistema())) . ",";
                $json .= '"ruta":' . json_encode(utf8_encode($Formulario->getRuta())) . ",";
                $json .= '"desFormulario":' . json_encode(utf8_encode($Formulario->getDesFormulario())) . ",";
                $json .= '"orden":' . json_encode(utf8_encode($Formulario->getOrden())) . ",";
                $json .= '"padre":' . json_encode(utf8_encode($Formulario->getPadre())) . ",";
                $json .= '"nivel":' . json_encode(utf8_encode($Formulario->getNivel())) . ",";
                $json .= '"vista":' . json_encode(utf8_encode($Formulario->getVista())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Formulario->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Formulario->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($FormulariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($FormulariosDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        echo $json;
    }

    public function getPaginas($FormulariosDto, $param) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->getPaginas($FormulariosDto, $param);
        if ($FormulariosDto != "") {
            return $FormulariosDto;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
        }
    }

    public function insertFormularios($FormulariosDto) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->insertFormularios($FormulariosDto);
        $json = "";
        $x = 1;
        if ($FormulariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($FormulariosDto) . '",';
            $json .= '"data":[';
            foreach ($FormulariosDto as $Formulario) {
                $json .= "{";
                $json .= '"cveFormulario":' . json_encode(utf8_encode($Formulario->getCveFormulario())) . ",";
                $json .= '"nomFormulario":' . json_encode(utf8_encode($Formulario->getNomFormulario())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Formulario->getActivo())) . ",";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Formulario->getCveSistema())) . ",";
                $json .= '"ruta":' . json_encode(utf8_encode($Formulario->getRuta())) . ",";
                $json .= '"desFormulario":' . json_encode(utf8_encode($Formulario->getDesFormulario())) . ",";
                $json .= '"orden":' . json_encode(utf8_encode($Formulario->getOrden())) . ",";
                $json .= '"padre":' . json_encode(utf8_encode($Formulario->getPadre())) . ",";
                $json .= '"nivel":' . json_encode(utf8_encode($Formulario->getNivel())) . ",";
                $json .= '"vista":' . json_encode(utf8_encode($Formulario->getVista())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Formulario->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Formulario->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($FormulariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "]";
            $json .= "}";

            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("38");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones("AGREGO FORMULARIOS " . $json);
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto);
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        echo $json;
    }

    public function updateFormularios($FormulariosDto) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->updateFormularios($FormulariosDto);
        $json = "";
        $x = 1;
        if ($FormulariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($FormulariosDto) . '",';
            $json .= '"data":[';
            foreach ($FormulariosDto as $Formulario) {
                $json .= "{";
                $json .= '"cveFormulario":' . json_encode(utf8_encode($Formulario->getCveFormulario())) . ",";
                $json .= '"nomFormulario":' . json_encode(utf8_encode($Formulario->getNomFormulario())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Formulario->getActivo())) . ",";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Formulario->getCveSistema())) . ",";
                $json .= '"ruta":' . json_encode(utf8_encode($Formulario->getRuta())) . ",";
                $json .= '"desFormulario":' . json_encode(utf8_encode($Formulario->getDesFormulario())) . ",";
                $json .= '"orden":' . json_encode(utf8_encode($Formulario->getOrden())) . ",";
                $json .= '"padre":' . json_encode(utf8_encode($Formulario->getPadre())) . ",";
                $json .= '"nivel":' . json_encode(utf8_encode($Formulario->getNivel())) . ",";
                $json .= '"vista":' . json_encode(utf8_encode($Formulario->getVista())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Formulario->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Formulario->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($FormulariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "]";
            $json .= "}";
            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("39");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones("MODIFICO FORMULARIOS " . $json);
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto);
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        echo $json;
    }

    public function deleteFormularios($FormulariosDto) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosController = new FormulariosController();
        $FormulariosDto = $FormulariosController->deleteFormularios($FormulariosDto);
        if ($FormulariosDto == true) {
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

@$cveFormulario = $_POST["cveFormulario"];
@$nomFormulario = $_POST["nomFormulario"];
@$activo = $_POST["activo"];
@$cveSistema = $_POST["cveSistema"];
@$ruta = $_POST["ruta"];
@$desFormulario = $_POST["desFormulario"];
@$orden = $_POST["orden"];
@$padre = $_POST["padre"];
@$nivel = $_POST["nivel"];
@$vista = $_POST["vista"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];



$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];



$formulariosFacade = new FormulariosFacade();
$formulariosDto = new FormulariosDTO();

$formulariosDto->setCveFormulario($cveFormulario);
$formulariosDto->setNomFormulario($nomFormulario);
$formulariosDto->setActivo($activo);
$formulariosDto->setCveSistema($cveSistema);
$formulariosDto->setRuta($ruta);
$formulariosDto->setDesFormulario($desFormulario);
$formulariosDto->setOrden($orden);
$formulariosDto->setPadre($padre);
$formulariosDto->setNivel($nivel);
$formulariosDto->setVista($vista);
$formulariosDto->setFechaRegistro($fechaRegistro);
$formulariosDto->setFechaActualizacion($fechaActualizacion);
//print_r($_POST);
if (($accion == "guardar") && ($cveFormulario == "")) {
    $formulariosDto = $formulariosFacade->insertFormularios($formulariosDto);
    echo $formulariosDto;
} else if (($accion == "guardar") && ($cveFormulario != "")) {
    $formulariosDto = $formulariosFacade->updateFormularios($formulariosDto);
    echo $formulariosDto;
} else if ($accion == "consultar") {
    $formulariosDto = $formulariosFacade->selectFormularios($formulariosDto);
    echo $formulariosDto;
} else if (($accion == "baja") && ($cveFormulario != "")) {
    $formulariosDto = $formulariosFacade->deleteFormularios($formulariosDto);
    echo $formulariosDto;
} else if (($accion == "seleccionar") && ($cveFormulario != "")) {
    $formulariosDto = $formulariosFacade->selectFormularios($formulariosDto);
    echo $formulariosDto;
} else if (($accion == "eliminar")) {
    $formulariosDto->setActivo('N');
    $formulariosDto = $formulariosFacade->updateFormularios($formulariosDto);
    echo $formulariosDto;
} else if (($accion == "getPaginas")) {
    $param["paginacion"] = true;
    $formulariosDto = $formulariosFacade->getPaginas($formulariosDto, $param);
    echo $formulariosDto;
} else if (($accion == "selectFormulariosGeneral")) {
    $param["paginacion"] = true;
    $formulariosDto = $formulariosFacade->selectFormulariosGeneral($formulariosDto, $param);
    echo $formulariosDto;
}
?>