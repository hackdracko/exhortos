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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/perfiles/PerfilesController.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/grupos/GruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/grupos/GruposDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/sistemas/SistemasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/sistemas/SistemasDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/adscripciones/AdscripcionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class PerfilesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPerfiles($PerfilesDto) {
        $PerfilesDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getcvePerfil(), "utf8") : strtoupper($PerfilesDto->getcvePerfil()))))));
        if ($this->esFecha($PerfilesDto->getcvePerfil())) {
            $PerfilesDto->setcvePerfil($this->fechaMysql($PerfilesDto->getcvePerfil()));
        }
        $PerfilesDto->setcveGrupo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getcveGrupo(), "utf8") : strtoupper($PerfilesDto->getcveGrupo()))))));
        if ($this->esFecha($PerfilesDto->getcveGrupo())) {
            $PerfilesDto->setcveGrupo($this->fechaMysql($PerfilesDto->getcveGrupo()));
        }
        $PerfilesDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getcveUsuario(), "utf8") : strtoupper($PerfilesDto->getcveUsuario()))))));
        if ($this->esFecha($PerfilesDto->getcveUsuario())) {
            $PerfilesDto->setcveUsuario($this->fechaMysql($PerfilesDto->getcveUsuario()));
        }
        $PerfilesDto->setcveSistema(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getcveSistema(), "utf8") : strtoupper($PerfilesDto->getcveSistema()))))));
        if ($this->esFecha($PerfilesDto->getcveSistema())) {
            $PerfilesDto->setcveSistema($this->fechaMysql($PerfilesDto->getcveSistema()));
        }
        $PerfilesDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getcveAdscripcion(), "utf8") : strtoupper($PerfilesDto->getcveAdscripcion()))))));
        if ($this->esFecha($PerfilesDto->getcveAdscripcion())) {
            $PerfilesDto->setcveAdscripcion($this->fechaMysql($PerfilesDto->getcveAdscripcion()));
        }
        $PerfilesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getfechaRegistro(), "utf8") : strtoupper($PerfilesDto->getfechaRegistro()))))));
        if ($this->esFecha($PerfilesDto->getfechaRegistro())) {
            $PerfilesDto->setfechaRegistro($this->fechaMysql($PerfilesDto->getfechaRegistro()));
        }
        $PerfilesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getfechaActualizacion(), "utf8") : strtoupper($PerfilesDto->getfechaActualizacion()))))));
        if ($this->esFecha($PerfilesDto->getfechaActualizacion())) {
            $PerfilesDto->setfechaActualizacion($this->fechaMysql($PerfilesDto->getfechaActualizacion()));
        }
        $PerfilesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($PerfilesDto->getactivo(), "utf8") : strtoupper($PerfilesDto->getactivo()))))));
        if ($this->esFecha($PerfilesDto->getactivo())) {
            $PerfilesDto->setactivo($this->fechaMysql($PerfilesDto->getactivo()));
        }
        return $PerfilesDto;
    }

    public function selectPerfiles($PerfilesDto) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $PerfilesDto = $PerfilesController->selectPerfiles($PerfilesDto);
        if ($PerfilesDto != "") {
            $dtoToJson = new DtoToJson($PerfilesDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertPerfiles($PerfilesDto) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $rsPerfiles = $PerfilesController->insertPerfiles($PerfilesDto);
        return $rsPerfiles;
    }

    public function updatePerfiles($PerfilesDto) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $rsPerfiles = $PerfilesController->updatePerfiles($PerfilesDto);
        return $rsPerfiles;
    }

    public function deletePerfiles($PerfilesDto) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $PerfilesDto = $PerfilesController->deletePerfiles($PerfilesDto);
        if ($PerfilesDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function consultarDetalle($PerfilesDto, $param) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $PerfilesDto = $PerfilesController->selectPerfiles($PerfilesDto);
        $json = "";
        $x = 1;
        if ($PerfilesDto != "") {


            $gruposDto = new GruposDTO();
            $gruposDao = new GruposDAO();

            $sistemasDto = new SistemasDTO();
            $sistemasDao = new SistemasDAO();

            $adscripcionesDto = new AdscripcionesDTO();
            $adscripcionesDao = new AdscripcionesDAO();



            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($PerfilesDto) . '",';
            $json .= '"data":[';
            foreach ($PerfilesDto as $Perfil) {
                $gruposDto->setCveGrupo($Perfil->getCveGrupo());
                $rsGrupo = $gruposDao->selectGruposPerfil($gruposDto);

                $sistemasDto->setCveSistema($Perfil->getCveSistema());
                $rsSistema = $sistemasDao->selectSistemas($sistemasDto);

                $adscripcionesDto->setCveAdscripcion($Perfil->getCveAdscripcion());
                $rsAdscripciones = $adscripcionesDao->selectAdscripciones($adscripcionesDto);


                $json .= "{";
                $json .= '"cvePerfil":' . json_encode(utf8_encode($Perfil->getCvePerfil())) . ",";
                $json .= '"cveGrupo":' . json_encode(utf8_encode($Perfil->getCveGrupo())) . ",";
                if ($rsGrupo != "") {
                    $json .= '"desGrupo":' . json_encode(utf8_encode($rsGrupo[0]->getNomGrupo())) . ",";
                } else {
                    $json .= '"desGrupo": "",';
                }
                $json .= '"cveUsuario":' . json_encode(utf8_encode($Perfil->getCveUsuario())) . ",";
                $json .= '"cveSistema":' . json_encode(utf8_encode($Perfil->getCveSistema())) . ",";
                if ($rsSistema != "") {
                    $json .= '"desSistema":' . json_encode(utf8_encode($rsSistema[0]->getNomSistema())) . ",";
                } else {
                    $json .= '"desSistema": "",';
                }
                $json .= '"cveAdscripcion":' . json_encode(utf8_encode($Perfil->getCveAdscripcion())) . ",";
                if ($rsAdscripciones != "") {
                    $json .= '"desAdscripcion":' . json_encode(utf8_encode($rsAdscripciones[0]->getDesAdscripcion())) . ",";
                } else {
                    $json .= '"desAdscripcion": "",';
                }
                $json .= '"activo":' . json_encode(utf8_encode($Perfil->getActivo())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($PerfilesDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($PerfilesDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        return $json;
    }

    public function getPaginas($PerfilesDto, $param) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesController = new PerfilesController();
        $PerfilesDto = $PerfilesController->getPaginas($PerfilesDto, $param);
//        echo ($PerfilesDto);
        if ($PerfilesDto != "") {
            return $PerfilesDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
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

$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];

@$cvePerfil = $_POST["cvePerfil"];
@$cveGrupo = $_POST["cveGrupo"];
@$cveUsuario = $_POST["cveUsuario"];
@$cveSistema = $_POST["cveSistema"];
@$cveAdscripcion = $_POST["cveAdscripcion"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$activo = $_POST["activo"];
@$accion = $_POST["accion"];

$perfilesFacade = new PerfilesFacade();
$perfilesDto = new PerfilesDTO();

$perfilesDto->setCvePerfil($cvePerfil);
$perfilesDto->setCveGrupo($cveGrupo);
$perfilesDto->setCveUsuario($cveUsuario);
$perfilesDto->setCveSistema($cveSistema);
$perfilesDto->setCveAdscripcion($cveAdscripcion);
$perfilesDto->setFechaRegistro($fechaRegistro);
$perfilesDto->setFechaActualizacion($fechaActualizacion);
$perfilesDto->setActivo($activo);

if (($accion == "guardar") && ($cvePerfil == "")) {
    $perfilesDto = $perfilesFacade->insertPerfiles($perfilesDto);
    echo $perfilesDto;
} else if (($accion == "guardar") && ($cvePerfil != "")) {
    $perfilesDto = $perfilesFacade->updatePerfiles($perfilesDto);
    echo $perfilesDto;
} else if ($accion == "consultar") {
    $perfilesDto = $perfilesFacade->selectPerfiles($perfilesDto);
    echo $perfilesDto;
} else if (($accion == "baja") && ($cvePerfil != "")) {
    $perfilesDto = $perfilesFacade->deletePerfiles($perfilesDto);
    echo $perfilesDto;
} else if (($accion == "seleccionar") && ($cvePerfil != "")) {
    $perfilesDto = $perfilesFacade->selectPerfiles($perfilesDto);
    echo $perfilesDto;
} else if ($accion == "consultarDetalle") {
    $perfilesDto = $perfilesFacade->consultarDetalle($perfilesDto, $param);
    echo $perfilesDto;
} else if ($accion == "getPaginas") {
    $param["paginacion"] = true;
    $perfilesDto = $perfilesFacade->getPaginas($perfilesDto, $param);
    echo $perfilesDto;
}
?>