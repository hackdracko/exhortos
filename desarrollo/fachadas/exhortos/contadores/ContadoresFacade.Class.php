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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/contadores/ContadoresDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/contadores/ContadoresController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");


include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgados/JuzgadosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposactuaciones/TiposactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tiposactuaciones/TiposactuacionesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class ContadoresFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarContadores($ContadoresDto) {
        $ContadoresDto->setidContador(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getidContador(), "utf8") : strtoupper($ContadoresDto->getidContador()))))));
        if ($this->esFecha($ContadoresDto->getidContador())) {
            $ContadoresDto->setidContador($this->fechaMysql($ContadoresDto->getidContador()));
        }
        $ContadoresDto->setnumero(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getnumero(), "utf8") : strtoupper($ContadoresDto->getnumero()))))));
        if ($this->esFecha($ContadoresDto->getnumero())) {
            $ContadoresDto->setnumero($this->fechaMysql($ContadoresDto->getnumero()));
        }
        $ContadoresDto->setanio(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getanio(), "utf8") : strtoupper($ContadoresDto->getanio()))))));
        if ($this->esFecha($ContadoresDto->getanio())) {
            $ContadoresDto->setanio($this->fechaMysql($ContadoresDto->getanio()));
        }
        $ContadoresDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getcveJuzgado(), "utf8") : strtoupper($ContadoresDto->getcveJuzgado()))))));
        if ($this->esFecha($ContadoresDto->getcveJuzgado())) {
            $ContadoresDto->setcveJuzgado($this->fechaMysql($ContadoresDto->getcveJuzgado()));
        }
        $ContadoresDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getactivo(), "utf8") : strtoupper($ContadoresDto->getactivo()))))));
        if ($this->esFecha($ContadoresDto->getactivo())) {
            $ContadoresDto->setactivo($this->fechaMysql($ContadoresDto->getactivo()));
        }
        $ContadoresDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getfechaRegistro(), "utf8") : strtoupper($ContadoresDto->getfechaRegistro()))))));
        if ($this->esFecha($ContadoresDto->getfechaRegistro())) {
            $ContadoresDto->setfechaRegistro($this->fechaMysql($ContadoresDto->getfechaRegistro()));
        }
        $ContadoresDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getfechaActualizacion(), "utf8") : strtoupper($ContadoresDto->getfechaActualizacion()))))));
        if ($this->esFecha($ContadoresDto->getfechaActualizacion())) {
            $ContadoresDto->setfechaActualizacion($this->fechaMysql($ContadoresDto->getfechaActualizacion()));
        }
        $ContadoresDto->setcveTipoActuacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ContadoresDto->getcveTipoActuacion(), "utf8") : strtoupper($ContadoresDto->getcveTipoActuacion()))))));
        if ($this->esFecha($ContadoresDto->getcveTipoActuacion())) {
            $ContadoresDto->setcveTipoActuacion($this->fechaMysql($ContadoresDto->getcveTipoActuacion()));
        }
        return $ContadoresDto;
    }

    public function selectContadores($ContadoresDto) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();
        $ContadoresDto = $ContadoresController->selectContadores($ContadoresDto);
        if ($ContadoresDto != "") {
            $dtoToJson = new DtoToJson($ContadoresDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertContadores($ContadoresDto) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();


        $ContadoresAuxDto = new ContadoresDTO();
        $ContadoresAuxDto->setCveJuzgado($ContadoresDto->getCveJuzgado());
        $ContadoresAuxDto->setCveTipoActuacion($ContadoresDto->getCveTipoActuacion());
        $ContadoresAuxDto->setActivo($ContadoresDto->getActivo());
        $ContadoresAuxDto->setAnio($ContadoresDto->getAnio());
        $ContadoresAuxDto = $ContadoresController->selectContadores($ContadoresAuxDto);

        if ($ContadoresAuxDto == "") {
            $ContadoresDto = $ContadoresController->insertContadores($ContadoresDto);
            if ($ContadoresDto != "") {
                $dtoToJson = new DtoToJson($ContadoresDto);
                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("27");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones($dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA"));
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
                return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
            } else {
                $jsonDto = new Encode_JSON();
                return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
            }
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "El registro ya se encuentra dado de alta. Verifique."));
        }
    }

    public function updateContadores($ContadoresDto) {
        $ContadoresAuxDto = new ContadoresDTO();
        $ContadoresController = new ContadoresController();
        $ContadoresAuxDto->setCveJuzgado($ContadoresDto->getCveJuzgado());
        $ContadoresAuxDto->setCveTipoActuacion($ContadoresDto->getCveTipoActuacion());
        $ContadoresAuxDto->setActivo($ContadoresDto->getActivo());
        $ContadoresAuxDto->setNumero($ContadoresDto->getNumero());
        $ContadoresAuxDto->setAnio($ContadoresDto->getAnio());
        $ContadoresAuxDto = $ContadoresController->selectContadores($ContadoresAuxDto);
        if ($ContadoresAuxDto == "") {
            $ContadoresDto = $this->validarContadores($ContadoresDto);
            $ContadoresDto = $ContadoresController->updateContadores($ContadoresDto);
            if ($ContadoresDto != "") {
                $dtoToJson = new DtoToJson($ContadoresDto);
                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("28");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones($dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA"));
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);

                return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
            } else {
                $jsonDto = new Encode_JSON();
                return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
            }
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "El registro ya se encuentra dado de alta. Verifique."));
        }
    }

    public function eliminaContadores($ContadoresDto) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();
        $ContadoresDto = $ContadoresController->updateContadores($ContadoresDto);
        if ($ContadoresDto != "") {
            $dtoToJson = new DtoToJson($ContadoresDto);
            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("29");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones($dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA"));
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
        }
    }

    public function deleteContadores($ContadoresDto) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();
        $ContadoresDto = $ContadoresController->deleteContadores($ContadoresDto);
        if ($ContadoresDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function selectContadoresGeneral($ContadoresDto, $param) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();
        $ContadoresDto = $ContadoresController->selectContadoresGeneral($ContadoresDto, $param);
        $json = "";
        $x = 1;
        if ($ContadoresDto != "") {

            $juzgadosDto = new JuzgadosDTO();
            $juzgadosDao = new JuzgadosDAO();

            $tiposActuacionesDto = new TiposactuacionesDTO();
            $tiposActuacionesDao = new TiposactuacionesDAO();

            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($ContadoresDto) . '",';
            $json .= '"data":[';
            foreach ($ContadoresDto as $Contador) {
                $juzgadosDto->setCveJuzgado($Contador->getCveJuzgado());
                $rsJuzgado = $juzgadosDao->selectJuzgados($juzgadosDto);

                $tiposActuacionesDto->setCveTipoActuacion($Contador->getCveTipoActuacion());
                $rsActuacion = $tiposActuacionesDao->selectTiposactuaciones($tiposActuacionesDto, "", "", "", null);
                $json .= "{";
                $json .= '"idContador":' . json_encode(utf8_encode($Contador->getIdContador())) . ",";
                $json .= '"numero":' . json_encode(utf8_encode($Contador->getNumero())) . ",";
                $json .= '"anio":' . json_encode(utf8_encode($Contador->getAnio())) . ",";
                $json .= '"cveJuzgado":' . json_encode(utf8_encode($Contador->getCveJuzgado())) . ",";
                if ($rsJuzgado != "") {
                    $json .= '"desJuzgado":' . json_encode(utf8_encode($rsJuzgado[0]->getDesJuzgado())) . ",";
                } else {
                    $json .= '"desJuzgado": "",';
                }
                $json .= '"activo":' . json_encode(utf8_encode($Contador->getActivo())) . ",";
                $json .= '"fechaRegistro":' . json_encode(utf8_encode($Contador->getFechaRegistro())) . ",";
                $json .= '"fechaActualizacion":' . json_encode(utf8_encode($Contador->getFechaActualizacion())) . ",";
                $json .= '"cveTipoActuacion":' . json_encode(utf8_encode($Contador->getCveTipoActuacion())) . ",";
                if ($rsActuacion != "") {
                    $json .= '"desActuacion":' . json_encode(utf8_encode($rsActuacion[0]->getDesTipoActuacion())) . "";
                } else {
                    $json .= '"desActuacion": ""';
                }
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($ContadoresDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($ContadoresDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }


        echo $json;
    }

    public function getPaginas($ContadoresDto, $param) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresController = new ContadoresController();
        $ContadoresDto = $ContadoresController->getPaginas($ContadoresDto, $param);
        if ($ContadoresDto == true) {
            return $ContadoresDto;
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

@$idContador = $_POST["idContador"];
@$numero = $_POST["numero"];
@$anio = $_POST["anio"];
@$cveJuzgado = $_POST["cveJuzgado"];
@$activo = $_POST["activo"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$cveTipoActuacion = $_POST["cveTipoActuacion"];
@$accion = $_POST["accion"];

$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];

$contadoresFacade = new ContadoresFacade();
$contadoresDto = new ContadoresDTO();

$contadoresDto->setIdContador($idContador);
$contadoresDto->setNumero($numero);
$contadoresDto->setAnio($anio);
$contadoresDto->setCveJuzgado($cveJuzgado);
$contadoresDto->setActivo($activo);
$contadoresDto->setFechaRegistro($fechaRegistro);
$contadoresDto->setFechaActualizacion($fechaActualizacion);
$contadoresDto->setCveTipoActuacion($cveTipoActuacion);

if (($accion == "guardar") && ($idContador == "")) {
    $contadoresDto = $contadoresFacade->insertContadores($contadoresDto);
    echo $contadoresDto;
} else if (($accion == "guardar") && ($idContador != "")) {
    $contadoresDto = $contadoresFacade->updateContadores($contadoresDto);
    echo $contadoresDto;
} else if (($accion == "eliminar")) {
    $contadoresDto->setActivo('N');
    $contadoresDto = $contadoresFacade->eliminaContadores($contadoresDto);
    echo $contadoresDto;
} else if ($accion == "consultar") {
    $contadoresDto = $contadoresFacade->selectContadores($contadoresDto);
    echo $contadoresDto;
} else if (($accion == "baja") && ($idContador != "")) {
    $contadoresDto = $contadoresFacade->deleteContadores($contadoresDto);
    echo $contadoresDto;
} else if (($accion == "seleccionar") && ($idContador != "")) {
    $contadoresDto = $contadoresFacade->selectContadores($contadoresDto);
    echo $contadoresDto;
} else if (($accion == "getPaginas")) {
    $param["paginacion"] = true;
    $contadoresDto = $contadoresFacade->getPaginas($contadoresDto, $param);
    echo $contadoresDto;
} else if (($accion == "consultaGeneral")) {
    $param["paginacion"] = true;
    $contadoresDto = $contadoresFacade->selectContadoresGeneral($contadoresDto, $param);
    echo $contadoresDto;
}
?>