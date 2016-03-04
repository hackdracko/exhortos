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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/sistemas/SistemasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/sistemas/SistemasController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class SistemasFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarSistemas($SistemasDto) {
        $SistemasDto->setcveSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($SistemasDto->getcveSistema(), "utf8") : strtoupper($SistemasDto->getcveSistema()))))));
        if ($this->esFecha($SistemasDto->getcveSistema())) {
            $SistemasDto->setcveSistema($this->fechaMysql($SistemasDto->getcveSistema()));
        }
        $SistemasDto->setnomSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($SistemasDto->getnomSistema(), "utf8") : strtoupper($SistemasDto->getnomSistema()))))));
        if ($this->esFecha($SistemasDto->getnomSistema())) {
            $SistemasDto->setnomSistema($this->fechaMysql($SistemasDto->getnomSistema()));
        }
        $SistemasDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($SistemasDto->getactivo(), "utf8") : strtoupper($SistemasDto->getactivo()))))));
        if ($this->esFecha($SistemasDto->getactivo())) {
            $SistemasDto->setactivo($this->fechaMysql($SistemasDto->getactivo()));
        }
        $SistemasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($SistemasDto->getfechaRegistro(), "utf8") : strtoupper($SistemasDto->getfechaRegistro()))))));
        if ($this->esFecha($SistemasDto->getfechaRegistro())) {
            $SistemasDto->setfechaRegistro($this->fechaMysql($SistemasDto->getfechaRegistro()));
        }
        $SistemasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($SistemasDto->getfechaActualizacion(), "utf8") : strtoupper($SistemasDto->getfechaActualizacion()))))));
        if ($this->esFecha($SistemasDto->getfechaActualizacion())) {
            $SistemasDto->setfechaActualizacion($this->fechaMysql($SistemasDto->getfechaActualizacion()));
        }
        return $SistemasDto;
    }

    public function selectSistemas($SistemasDto) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasDto = $SistemasController->selectSistemas($SistemasDto);
        $json = "";
        $x = 1;
        if ($SistemasDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($SistemasDto) . '",';
            $json .= '"data":[';
            foreach ($SistemasDto as $Sistema) {
                $json .= "{";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Sistema->getCveSistema())) . ",";
                $json .= '"nomSistema":' . json_encode(utf8_encode($Sistema->getNomSistema())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Sistema->getActivo())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Sistema->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Sistema->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($SistemasDto)) {
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

    public function insertSistemas($SistemasDto) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasAuxDto = new SistemasDTO();
        $SistemasAuxDto->setNomSistema($SistemasDto->getNomSistema());
        $SistemasAuxDto = $SistemasController->selectSistemas($SistemasAuxDto);
        $json = "";
        $x = 1;
        if ($SistemasAuxDto == "") {
            $SistemasDto = $SistemasController->insertSistemas($SistemasDto);
            if ($SistemasDto != "") {
                $json .= "{";
                $json .= '"status":"Ok",';
                $json .= '"totalCount":"' . count($SistemasDto) . '",';
                $json .= '"data":[';
                foreach ($SistemasDto as $Sistema) {
                    $json .= "{";
                    $json .= '"cveSistema":' . json_encode(utf8_encode($Sistema->getCveSistema())) . ",";
                    $json .= '"nomSistema":' . json_encode(utf8_encode($Sistema->getNomSistema())) . ",";
                    $json .= '"activo":' . json_encode(utf8_encode($Sistema->getActivo())) . ",";
                    $json .= '"fechaRegistro":' . json_encode(utf8_encode($Sistema->getFechaRegistro())) . ",";
                    $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Sistema->getFechaActualizacion())) . "";
                    $json .= "}" . "\n";
                    $x ++;
                    if ($x <= count($SistemasDto)) {
                        $json .= ",";
                    }
                }
                $json .= "]";
                $json .= "}";

                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("40");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones("AGREGO FORMULARIOS " . $json);
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
            } else {
                $json .= '{"estatus":"Fail",';
                $json .= '"text":"OCURRIO UN ERROR AL REALIZAR EL REGISTRO."}';
            }
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"text":"El registro ya se encuentra dado de alta. Verifique."}';
        }
        echo $json;
    }

    public function updateSistemas($SistemasDto) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasAuxDto = new SistemasDTO();
        $SistemasAuxDto->setNomSistema($SistemasDto->getNomSistema());
        $SistemasAuxDto = $SistemasController->selectSistemas($SistemasAuxDto);
        $json = "";
        $x = 1;
        if ($SistemasAuxDto == "") {
            $SistemasDto = $SistemasController->updateSistemas($SistemasDto);
            if ($SistemasDto != "") {
                $json .= "{";
                $json .= '"status":"Ok",';
                $json .= '"totalCount":"' . count($SistemasDto) . '",';
                $json .= '"data":[';
                foreach ($SistemasDto as $Sistema) {
                    $json .= "{";
                    $json .= '"cveSistema":' . json_encode(utf8_encode($Sistema->getCveSistema())) . ",";
                    $json .= '"nomSistema":' . json_encode(utf8_encode($Sistema->getNomSistema())) . ",";
                    $json .= '"activo":' . json_encode(utf8_encode($Sistema->getActivo())) . ",";
                    $json .= '"fechaRegistro":' . json_encode(utf8_encode($Sistema->getFechaRegistro())) . ",";
                    $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Sistema->getFechaActualizacion())) . "";
                    $json .= "}" . "\n";
                    $x ++;
                    if ($x <= count($SistemasDto)) {
                        $json .= ",";
                    }
                }
                $json .= "]";
                $json .= "}";
                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("41");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones("MODIFICO SISTEMAS " . $json);
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
            } else {
                $json .= '{"estatus":"Fail",';
                $json .= '"text":"OCURRIO UN ERROR AL REALIZAR EL REGISTRO."}';
            }
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"text":"El registro ya se encuentra dado de alta. Verifique."}';
        }
        echo $json;
    }

    public function eliminaSistemas($SistemasDto) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasDto = $SistemasController->updateSistemas($SistemasDto);
        if ($SistemasDto != "") {
            $dtoToJson = new DtoToJson($SistemasDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
        }
    }

    public function deleteSistemas($SistemasDto) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasDto = $SistemasController->deleteSistemas($SistemasDto);
        if ($SistemasDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function consultaGeneral($SistemasDto, $param) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasDto = $SistemasController->selectSistemasGeneral($SistemasDto, $param);

//        print_r($SistemasDto);
        $json = "";
        $x = 1;
        if ($SistemasDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($SistemasDto) . '",';
            $json .= '"data":[';
            foreach ($SistemasDto as $Sistema) {
                $json .= "{";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Sistema->getCveSistema())) . ",";
                $json .= '"nomSistema":' . json_encode(utf8_encode($Sistema->getNomSistema())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Sistema->getActivo())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Sistema->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Sistema->getFechaActualizacion())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($SistemasDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($SistemasDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }


        echo $json;
    }

    public function getPaginas($SistemasDto, $param) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasController = new SistemasController();
        $SistemasDto = $SistemasController->getPaginas($SistemasDto, $param);
        if ($SistemasDto == true) {
            return $SistemasDto;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
        }
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

@$cveSistema = $_POST["cveSistema"];
@$nomSistema = $_POST["nomSistema"];
@$activo = $_POST["activo"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];

$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];

$sistemasFacade = new SistemasFacade();
$sistemasDto = new SistemasDTO();

$sistemasDto->setCveSistema($cveSistema);
$sistemasDto->setNomSistema($nomSistema);
$sistemasDto->setActivo($activo);
$sistemasDto->setFechaRegistro($fechaRegistro);
$sistemasDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveSistema == "")) {
    $sistemasDto = $sistemasFacade->insertSistemas($sistemasDto);
    echo $sistemasDto;
} else if (($accion == "guardar") && ($cveSistema != "")) {
    $sistemasDto = $sistemasFacade->updateSistemas($sistemasDto);
    echo $sistemasDto;
} else if ($accion == "consultar") {
    $sistemasDto = $sistemasFacade->selectSistemas($sistemasDto);
    echo $sistemasDto;
} else if (($accion == "baja") && ($cveSistema != "")) {
    $sistemasDto = $sistemasFacade->deleteSistemas($sistemasDto);
    echo $sistemasDto;
} else if (($accion == "seleccionar") && ($cveSistema != "")) {
    $sistemasDto = $sistemasFacade->selectSistemas($sistemasDto);
    echo $sistemasDto;
} else if (($accion == "consultaGeneral")) {
    $param["paginacion"] = true;
    $sistemasDto = $sistemasFacade->consultaGeneral($sistemasDto, $param);
    echo $sistemasDto;
} else if (($accion == "getPaginas")) {
    $param["paginacion"] = true;
    $sistemasDto = $sistemasFacade->getPaginas($sistemasDto, $param);
    echo $sistemasDto;
} else if (($accion == "eliminar")) {
    $sistemasDto->setActivo('N');
    $sistemasDto = $sistemasFacade->eliminaSistemas($sistemasDto, $param);
    echo $sistemasDto;
}
?>