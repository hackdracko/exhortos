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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/bitacoramovimientos/BitacoramovimientosController.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/usuarios/UsuariosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/perfiles/PerfilesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/adscripciones/AdscripcionesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/acciones/AccionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/acciones/AccionesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class BitacoramovimientosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarBitacoramovimientos($BitacoramovimientosDto) {
        $BitacoramovimientosDto->setidBitacoraMovimiento(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getidBitacoraMovimiento(), "utf8") : strtoupper($BitacoramovimientosDto->getidBitacoraMovimiento()))))));
        if ($this->esFecha($BitacoramovimientosDto->getidBitacoraMovimiento())) {
            $BitacoramovimientosDto->setidBitacoraMovimiento($this->fechaMysql($BitacoramovimientosDto->getidBitacoraMovimiento()));
        }
        $BitacoramovimientosDto->setcveAccion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getcveAccion(), "utf8") : strtoupper($BitacoramovimientosDto->getcveAccion()))))));
        if ($this->esFecha($BitacoramovimientosDto->getcveAccion())) {
            $BitacoramovimientosDto->setcveAccion($this->fechaMysql($BitacoramovimientosDto->getcveAccion()));
        }
        $BitacoramovimientosDto->setfechaMovimiento(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getfechaMovimiento(), "utf8") : strtoupper($BitacoramovimientosDto->getfechaMovimiento()))))));
        if ($this->esFecha($BitacoramovimientosDto->getfechaMovimiento())) {
            $BitacoramovimientosDto->setfechaMovimiento($this->fechaMysql($BitacoramovimientosDto->getfechaMovimiento()));
        }
        $BitacoramovimientosDto->setobservaciones(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getobservaciones(), "utf8") : strtoupper($BitacoramovimientosDto->getobservaciones()))))));
        if ($this->esFecha($BitacoramovimientosDto->getobservaciones())) {
            $BitacoramovimientosDto->setobservaciones($this->fechaMysql($BitacoramovimientosDto->getobservaciones()));
        }
        $BitacoramovimientosDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getcveUsuario(), "utf8") : strtoupper($BitacoramovimientosDto->getcveUsuario()))))));
        if ($this->esFecha($BitacoramovimientosDto->getcveUsuario())) {
            $BitacoramovimientosDto->setcveUsuario($this->fechaMysql($BitacoramovimientosDto->getcveUsuario()));
        }
        $BitacoramovimientosDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getcvePerfil(), "utf8") : strtoupper($BitacoramovimientosDto->getcvePerfil()))))));
        if ($this->esFecha($BitacoramovimientosDto->getcvePerfil())) {
            $BitacoramovimientosDto->setcvePerfil($this->fechaMysql($BitacoramovimientosDto->getcvePerfil()));
        }
        $BitacoramovimientosDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($BitacoramovimientosDto->getcveAdscripcion(), "utf8") : strtoupper($BitacoramovimientosDto->getcveAdscripcion()))))));
        if ($this->esFecha($BitacoramovimientosDto->getcveAdscripcion())) {
            $BitacoramovimientosDto->setcveAdscripcion($this->fechaMysql($BitacoramovimientosDto->getcveAdscripcion()));
        }
        return $BitacoramovimientosDto;
    }

    public function selectBitacoramovimientos($BitacoramovimientosDto, $param) {
//        print_r($param);
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosController = new BitacoramovimientosController();
        $BitacoramovimientosDto = $BitacoramovimientosController->selectBitacoramovimientos($BitacoramovimientosDto, $param);
        $json = "";
        $i = 1;
        if ($BitacoramovimientosDto != "") {
            $usuariosDto = new UsuariosDTO();
            $usuariosDao = new UsuariosDAO();

            $perfilDto = new PerfilesDTO();
            $perfilDao = new PerfilesDAO();

            $adscripcionesDto = new AdscripcionesDTO();
            $adscripcionesDao = new AdscripcionesDAO();

            $accionesDto = new AccionesDTO();
            $accionesDao = new AccionesDAO();


            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($BitacoramovimientosDto) . '",';
            $json .= '"data":[';
            foreach ($BitacoramovimientosDto as $movimientos) {
                $accionesDto->setCveAccion($movimientos->getCveAccion());
                $rsAcciones = $accionesDao->selectAcciones($accionesDto);

                $usuariosDto->setCveUsuario($movimientos->getCveUsuario());
                $rsUsuarios = $usuariosDao->selectUsuarios($usuariosDto);

                $adscripcionesDto->setCveAdscripcion($movimientos->getCveAdscripcion());
                $rsAdscripciones = $adscripcionesDao->selectAdscripciones($adscripcionesDto);

                $json .= "{";
                $json .= '"idBitacoraMovimiento":' . json_encode(utf8_encode($movimientos->getIdBitacoraMovimiento())) . ",";
                $json .= '"cveAccion":' . json_encode(utf8_encode($movimientos->getCveAccion())) . ",";
                if ($rsAcciones != "") {
                    $json .= '"desAccion":' . json_encode(utf8_encode($rsAcciones[0]->getDesAccion())) . ",";
                } else {
                    $json .= '"desAccion": "",';
                }
                if ($movimientos->getFechaMovimiento() != "") {
                    $json .= '"fechaMovimiento":' . json_encode(utf8_encode($this->fechaHoraNormal($movimientos->getFechaMovimiento()))) . ",";
                } else {
                    $json .= '"fechaMovimiento": "SIN FECHA",';
                }
                $str = $movimientos->getObservaciones();
                $strlen = strlen($str);
                $cadena = "";
                $contador = 0;
                for ($x = 0; $x <= $strlen; $x++) {
                    $char = substr($str, $x, 1);
                    $cadena.= $char;
                    if ($contador == 130) {
                        $cadena .= "\n";
                        $contador = 1;
                    } else {
                        $contador ++;
                    }
                }
                $json .= '"observaciones":' . json_encode(utf8_encode($cadena)) . ",";
                $json .= '"cveUsuario":' . json_encode(utf8_encode($movimientos->getCveUsuario())) . ",";
                if ($rsUsuarios != "") {
                    $json .= '"usuario":' . json_encode(utf8_encode($rsUsuarios[0]->getNombre() . " " . $rsUsuarios[0]->getPaterno() . " " . $rsUsuarios[0]->getMaterno())) . ",";
                } else {
                    $json .= '"usuario": "",';
                }
                $json .= '"cveAdscripcion":' . json_encode(utf8_encode($movimientos->getCveAdscripcion())) . ",";
                if ($rsAdscripciones != "") {
                    $json .= '"desAdscripciones":' . json_encode(utf8_encode($rsAdscripciones[0]->getDesAdscripcion())) . ",";
                } else {
                    $json .= '"desAdscripciones": "",';
                }
                $json .= '"cvePerfil":' . json_encode(utf8_encode($movimientos->getCvePerfil())) . "";
                $json .= "}" . "\n";
                $i ++;

//                echo count($BitacoramovimientosDto). "<br>";
//                echo $i . "<br>";
                if ($i <= count($BitacoramovimientosDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($BitacoramovimientosDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        return $json;
    }

    public function getPaginas($BitacoramovimientosDto, $param) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosController = new BitacoramovimientosController();
        $BitacoramovimientosDto = $BitacoramovimientosController->getPaginas($BitacoramovimientosDto, $param);
        if ($BitacoramovimientosDto == true) {
            return $BitacoramovimientosDto;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
        }
    }

    public function insertBitacoramovimientos($BitacoramovimientosDto) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosController = new BitacoramovimientosController();
        $BitacoramovimientosDto = $BitacoramovimientosController->insertBitacoramovimientos($BitacoramovimientosDto);
        if ($BitacoramovimientosDto != "") {
            $dtoToJson = new DtoToJson($BitacoramovimientosDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateBitacoramovimientos($BitacoramovimientosDto) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosController = new BitacoramovimientosController();
        $BitacoramovimientosDto = $BitacoramovimientosController->updateBitacoramovimientos($BitacoramovimientosDto);
        if ($BitacoramovimientosDto != "") {
            $dtoToJson = new DtoToJson($BitacoramovimientosDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteBitacoramovimientos($BitacoramovimientosDto) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosController = new BitacoramovimientosController();
        $BitacoramovimientosDto = $BitacoramovimientosController->deleteBitacoramovimientos($BitacoramovimientosDto);
        if ($BitacoramovimientosDto == true) {
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

    public function fechaMysql($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

    private function fechaNormal($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

    private function fechaHoraNormal($fecha) {
        list($dias, $hora) = explode(" ", $fecha);
        list($year, $mes, $dia) = explode("-", $dias);
        return $dia . "/" . $mes . "/" . $year . " " . $hora;
    }

}

@$idBitacoraMovimiento = $_POST["idBitacoraMovimiento"];
@$cveAccion = $_POST["cveAccion"];
@$fechaMovimiento = $_POST["fechaMovimiento"];
@$observaciones = $_POST["observaciones"];
@$cveUsuario = $_POST["cveUsuario"];
@$cvePerfil = $_POST["cvePerfil"];
@$cveAdscripcion = $_POST["cveAdscripcion"];
@$accion = $_POST["accion"];



$bitacoramovimientosFacade = new BitacoramovimientosFacade();
//print_r($_POST);

$param = array();
if (@$_POST['fechaInicio'] != "") {
    @$param["fechaInicialConsulta"] = $bitacoramovimientosFacade->fechaMysql($_POST['fechaInicio']);
} else {
    @$param["fechaInicialConsulta"] = ("");
}
if (@$_POST['fechaFin'] != "") {
    @$param["fechaFinalConsulta"] = $bitacoramovimientosFacade->fechaMysql($_POST['fechaFin']);
} else {
    @$param["fechaFinalConsulta"] = ("");
}



@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];


$bitacoramovimientosDto = new BitacoramovimientosDTO();

$bitacoramovimientosDto->setIdBitacoraMovimiento($idBitacoraMovimiento);
$bitacoramovimientosDto->setCveAccion($cveAccion);
$bitacoramovimientosDto->setFechaMovimiento($fechaMovimiento);
$bitacoramovimientosDto->setObservaciones($observaciones);
$bitacoramovimientosDto->setCveUsuario($cveUsuario);
$bitacoramovimientosDto->setCvePerfil($cvePerfil);
$bitacoramovimientosDto->setCveAdscripcion($cveAdscripcion);

if (($accion == "guardar") && ($idBitacoraMovimiento == "")) {
    $bitacoramovimientosDto = $bitacoramovimientosFacade->insertBitacoramovimientos($bitacoramovimientosDto);
    echo $bitacoramovimientosDto;
} else if (($accion == "guardar") && ($idBitacoraMovimiento != "")) {
    $bitacoramovimientosDto = $bitacoramovimientosFacade->updateBitacoramovimientos($bitacoramovimientosDto);
    echo $bitacoramovimientosDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = true;
    $bitacoramovimientosDto = $bitacoramovimientosFacade->selectBitacoramovimientos($bitacoramovimientosDto, $param);
    echo $bitacoramovimientosDto;
} else if ($accion == "getPaginas") {
    $param["paginacion"] = true;
    $bitacoramovimientosDto = $bitacoramovimientosFacade->getPaginas($bitacoramovimientosDto, $param);
    echo $bitacoramovimientosDto;
} else if (($accion == "baja") && ($idBitacoraMovimiento != "")) {
    $bitacoramovimientosDto = $bitacoramovimientosFacade->deleteBitacoramovimientos($bitacoramovimientosDto);
    echo $bitacoramovimientosDto;
} else if (($accion == "seleccionar") && ($idBitacoraMovimiento != "")) {
    $bitacoramovimientosDto = $bitacoramovimientosFacade->selectBitacoramovimientos($bitacoramovimientosDto);
    echo $bitacoramovimientosDto;
}
?>