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
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/adscripciones/AdscripcionesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class AdscripcionesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarAdscripciones($AdscripcionesDto) {
        $AdscripcionesDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getcveAdscripcion(), "utf8") : strtoupper($AdscripcionesDto->getcveAdscripcion()))))));
        if ($this->esFecha($AdscripcionesDto->getcveAdscripcion())) {
            $AdscripcionesDto->setcveAdscripcion($this->fechaMysql($AdscripcionesDto->getcveAdscripcion()));
        }
        $AdscripcionesDto->setdesAdscripcion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getdesAdscripcion(), "utf8") : strtoupper($AdscripcionesDto->getdesAdscripcion()))))));
        if ($this->esFecha($AdscripcionesDto->getdesAdscripcion())) {
            $AdscripcionesDto->setdesAdscripcion($this->fechaMysql($AdscripcionesDto->getdesAdscripcion()));
        }
        $AdscripcionesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getactivo(), "utf8") : strtoupper($AdscripcionesDto->getactivo()))))));
        if ($this->esFecha($AdscripcionesDto->getactivo())) {
            $AdscripcionesDto->setactivo($this->fechaMysql($AdscripcionesDto->getactivo()));
        }
        $AdscripcionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getfechaRegistro(), "utf8") : strtoupper($AdscripcionesDto->getfechaRegistro()))))));
        if ($this->esFecha($AdscripcionesDto->getfechaRegistro())) {
            $AdscripcionesDto->setfechaRegistro($this->fechaMysql($AdscripcionesDto->getfechaRegistro()));
        }
        $AdscripcionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getfechaActualizacion(), "utf8") : strtoupper($AdscripcionesDto->getfechaActualizacion()))))));
        if ($this->esFecha($AdscripcionesDto->getfechaActualizacion())) {
            $AdscripcionesDto->setfechaActualizacion($this->fechaMysql($AdscripcionesDto->getfechaActualizacion()));
        }
        return $AdscripcionesDto;
    }

    public function selectAdscripciones($AdscripcionesDto, $param = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->selectAdscripciones($AdscripcionesDto);
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectAdscripcionesJuzgado($AdscripcionesDto, $param = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->selectAdscripciones_j($AdscripcionesDto, $param);
        if ($AdscripcionesDto != "") {
            return json_encode($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectAdscripcionesOficialia($AdscripcionesDto, $param = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->selectAdscripciones_o($AdscripcionesDto, $param);
        if ($AdscripcionesDto != "") {
            return json_encode($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function selectAdscripcionesPaginacion($AdscripcionesDto, $param = null, $tipo = null, $oficialiaDto = null, $juzgadoDto = null, $juzgadoMateriaDto = null, $estado = null, $municipio = null, $distrito = null, $activos = null) {
//        var_dump($tipo);
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
//                                                                      $AdscripcionesDto, $param = null, $tipo = null, $oficialiaDto = null, $juzgadoDto = null, $juzgadoMateriaDto = null, $estado = null, $municipio = null, $distrito = null, $activos = null
        $AdscripcionesDto = $AdscripcionesController->selectAdscripciones_o_j($AdscripcionesDto, $param, $tipo, $oficialiaDto, $juzgadoDto, $juzgadoMateriaDto, $estado, $municipio, $distrito, $activos );
        if ($AdscripcionesDto != "") {
            return ($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function insertAdscripciones($AdscripcionesDto) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->insertAdscripciones($AdscripcionesDto);
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function insertAdscripciones_Oficialia($AdscripcionesDto, $tipo = null, $municipio = null, $distrito = null, $nombreOficialia = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $param["like"] = true;
        $AdscripcionesDto->setActivo("S");
//        $existe = $AdscripcionesController->selectAdscripciones_o_j($AdscripcionesDto, $param, $tipo);
        $existe = "";
        if ($existe == "") {
            $AdscripcionesDto = $AdscripcionesController->insertAdscripciones_Oficialia($AdscripcionesDto, null, $municipio, $distrito, $nombreOficialia);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $AdscripcionesDto = $AdscripcionesController->insertAdscripciones_Oficialia($AdscripcionesDto);
//        var_dump($AdscripcionesDto);
        if ($AdscripcionesDto != "") {
//            var_dump($AdscripcionesDto);
//            var_dump(json_encode($AdscripcionesDto));
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function insertAdscripciones_Juzgado($AdscripcionesDto, $tipo = null, $listadoJuzgadoMateria = null, $oficialia = null) {
//        echo "\nfacade listado\n";
//                var_dump($listadoJuzgadoMateria);
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $param["like"] = true;
        $AdscripcionesDto->setActivo("S");
//        $existe = $AdscripcionesController->selectAdscripciones_o_j($AdscripcionesDto, $param, $tipo);
        $existe = "";
        if ($existe == "") {
//            echo "\nantes de envias\n";
//            var_dump($listadoJuzgadoMateria->content);
            $AdscripcionesDto = $AdscripcionesController->insertAdscripciones_Juzgado($AdscripcionesDto, null, $listadoJuzgadoMateria, $oficialia);
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "#", "text" => "YA EXISTE EL REGISTRO"));
        }
//        $AdscripcionesDto = $AdscripcionesController->insertAdscripciones_Juzgado($AdscripcionesDto);
        if ($AdscripcionesDto != "") {
//            $dtoToJson = new DtoToJson($AdscripcionesDto);
//            return json_encode($AdscripcionesDto);
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function updateAdscripciones($AdscripcionesDto) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->updateAdscripciones($AdscripcionesDto);
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function updateAdscripciones_Oficialia($AdscripcionesDto, $tipo = null, $oficialia = null, $tipoAnterior = null, $nombreOficialia = null, $distrito = null, $municipio = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
//        $AdscripcionesDto, $tipo = null, $oj = null, $tipoAnterior= null, $oficialia = null, $listadoJuzgadoMateria = null, $nombreOficialia = null
//        $AdscripcionesDto, $tipo = null, $oj = null, $tipoAnterior= null, $oficialia = null, $listadoJuzgadoMateria = null, $nombreOficialia = null
        $AdscripcionesDto = $AdscripcionesController->updateAdscripciones_o_j($AdscripcionesDto, $tipo, null, $tipoAnterior, $oficialia, null, $nombreOficialia, $distrito, $municipio);
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function updateAdscripciones_Juzgado($AdscripcionesDto, $tipo = null, $juzgado = null, $tipoAnterior = null, $oficialia = null, $listadoJuzgadoMateria = null, $desJuzgado = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
//        $AdscripcionesDto = $AdscripcionesController->updateAdscripciones_o_j($AdscripcionesDto, $tipo, $juzgado, $tipoAnterior, $oficialia, $listadoJuzgadoMateria, desJuzgado);
        $AdscripcionesDto = $AdscripcionesController->updateAdscripciones_o_j($AdscripcionesDto, $tipo, $juzgado, $tipoAnterior, $oficialia, $listadoJuzgadoMateria, null, null, null, $desJuzgado);
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteAdscripciones($AdscripcionesDto) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->deleteAdscripciones($AdscripcionesDto);
        if ($AdscripcionesDto == true) {
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

    public function getPaginas($adscripcionesDto, $param, $tipo) {
        //var_dump($generosDto);
        //var_dump($param);
        $adscripcionesDto = $this->validarAdscripciones($adscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $adscripcionesDto = $AdscripcionesController->getPaginas($adscripcionesDto, $param, $tipo);
        if ($adscripcionesDto != "") {
            return $adscripcionesDto;
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
    }

    public function eliminarAdscripcionConRelacionado($adscripcionesDto, $tipAdscripcionAnterior = null, $esOficialia = null, $esJuzagdo = null) {
        $AdscripcionesDto = $this->validarAdscripciones($adscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->updateEliminarAdscripciones_o($AdscripcionesDto, $tipAdscripcionAnterior, $esOficialia, $esJuzagdo);
//        echo "\nRespuesta\n";
        if ($AdscripcionesDto != "") {
            return json_encode($AdscripcionesDto);
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function reasignarJuzgado($adscripcionesDto, $cveJuzgado = null, $desJuzgado = null, $cveOficialia = null) {
        $AdscripcionesDto = $this->validarAdscripciones($adscripcionesDto);
        $AdscripcionesController = new AdscripcionesController();
        $AdscripcionesDto = $AdscripcionesController->reasignarJuzgado($AdscripcionesDto, $cveJuzgado, $desJuzgado, $cveOficialia);
//        echo "\nRespuesta\n";
        if ($AdscripcionesDto != "") {
            $dtoToJson = new DtoToJson($AdscripcionesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

}

@$cveAdscripcion = $_POST["cveAdscripcion"];
@$desAdscripcion = $_POST["desAdscripcion"];
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
$adscripcionesFacade = new AdscripcionesFacade();
$adscripcionesDto = new AdscripcionesDTO();

$adscripcionesDto->setCveAdscripcion($cveAdscripcion);
$adscripcionesDto->setDesAdscripcion($desAdscripcion);
$adscripcionesDto->setActivo($activo);
$adscripcionesDto->setFechaRegistro($fechaRegistro);
$adscripcionesDto->setFechaActualizacion($fechaActualizacion);

if (($accion == "guardar") && ($cveAdscripcion == "")) {
    $adscripcionesDto = $adscripcionesFacade->insertAdscripciones($adscripcionesDto);
    echo $adscripcionesDto;
} else if (($accion == "guardar") && ($cveAdscripcion != "")) {
    $adscripcionesDto = $adscripcionesFacade->updateAdscripciones($adscripcionesDto);
    echo $adscripcionesDto;
} else if ($accion == "consultar") {
    $param["paginacion"] = false;
    $adscripcionesDto = $adscripcionesFacade->selectAdscripciones($adscripcionesDto, $param);
    echo $adscripcionesDto;
} else if (($accion == "baja") && ($cveAdscripcion != "")) {
    $adscripcionesDto = $adscripcionesFacade->deleteAdscripciones($adscripcionesDto);
    echo $adscripcionesDto;
} else if (($accion == "seleccionar") && ($cveAdscripcion != "")) {
    $adscripcionesDto = $adscripcionesFacade->selectAdscripciones($adscripcionesDto);
    echo $adscripcionesDto;
} else if (($accion == "guardar-oficialia") && ($cveAdscripcion == "")) {//guardar  oficialia nueva
    @$tipo = $_POST['tipoAdscripcion'];
    @$distrito = $_POST['cveDistrito'];
    @$municipio = $_POST['cveMunicipio'];
//  strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($AdscripcionesDto->getcveAdscripcion(), "utf8") : strtoupper($AdscripcionesDto->getcveAdscripcion())))));
    @$nombreOficialia = strtoupper($_POST['desOfificialia']);
//    var_dump($nombreOficialia);
    $nombreOficialia = strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($nombreOficialia, "utf8") : strtoupper($nombreOficialia)))));
//    var_dump($nombreOficialia);
    $adscripcionesDto = $adscripcionesFacade->insertAdscripciones_Oficialia($adscripcionesDto, $tipo, $municipio, $distrito, $nombreOficialia);
//    var_dump($adscripcionesDto);
    echo $adscripcionesDto;
} else if (($accion == "guardar-oficialia") && ($cveAdscripcion != "")) {//actualizar oficialia existente
    @$tipo = $_POST['tipoAdscripcion'];
    @$tipoAnterior = $_POST['TipoAdscripcionAnterior'];
    
//    var_dump($tipoAnterior);
    @$cveOficialia = $_POST['cveOficialia'];
    @$nombreOficialia = strtoupper($_POST['desOfificialia']);
    $nombreOficialia = strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($nombreOficialia, "utf8") : strtoupper($nombreOficialia)))));
    @$distrito = $_POST['cveDistrito'];
    @$municipio = $_POST['cveMunicipio'];
    $adscripcionesDto = $adscripcionesFacade->updateAdscripciones_Oficialia($adscripcionesDto, $tipo, $cveOficialia, $tipoAnterior, $nombreOficialia, $distrito, $municipio);
    echo $adscripcionesDto;
} else if (($accion == "guardar-juzgado") && ($cveAdscripcion == "")) {//guardar juzgado nuevo
    @$tipo = $_POST['tipoAdscripcion'];
    @$listadoJuzgadoMateria = json_decode($_POST['listaJuzgadoMateria']);
    @$oficialia = $_POST['cveOficialia'];
//    var_dump($listadoJuzgadoMateria);
    $adscripcionesDto = $adscripcionesFacade->insertAdscripciones_Juzgado($adscripcionesDto, $tipo, $listadoJuzgadoMateria, $oficialia);
    echo $adscripcionesDto;
} else if (($accion == "guardar-juzgado") && ($cveAdscripcion != "")) {//actualizar juzgado nuevo
    @$tipo = $_POST['tipoAdscripcion'];
    @$tipoAnterior = $_POST['TipoAdscripcionAnterior'];
    @$cveJuzgado = $_POST['cveJuzgado'];
    @$desJuzgado = $_POST['desJuzgado'];
    @$desJuzgado = strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($desJuzgado, "utf8") : strtoupper($desJuzgado)))));
    @$listadoJuzgadoMateria = json_decode($_POST['listaJuzgadoMateria']);
    @$cveOficialia = $_POST['cveOficialia'];
    @$oficialiaAnterior = $_POST['oficialiaAnterior'];
    @$oficialiaNueva = $_POST['oficialiaNueva'];
    $adscripcionesDto = $adscripcionesFacade->updateAdscripciones_Juzgado($adscripcionesDto, $tipo, $cveJuzgado, $tipoAnterior, $cveOficialia, $listadoJuzgadoMateria, $desJuzgado);
    echo $adscripcionesDto;
} else if ($accion == "getPaginas") {
    @$tipo = $_POST['tipoAdscripcion'];
    $adscripcionesDto = $adscripcionesFacade->getPaginas($adscripcionesDto, $param, $tipo);
    echo $adscripcionesDto;
} else if ($accion == "consultar-paginacion") {
    @$tipo = $_POST['tipoAdscripcion'];
    @$activos = $_POST['activo'];
    $oficialiaDto = new OficialiaDTO();
    $juzgadoDto = new JuzgadosDTO();
    $juzgadoMateriaDto = new JuzgadosmateriasDTO();
    @$estado = "";
    @$municipio = "";
    @$distrito = "";
    @$hddAdscripcionJuzgado = "";
    @$hddJuzgadoBusqueda = "";
    @$txtDescJuzgado = "";
    if ($tipo == "O") {
//        echo "\nO\n";
        @$estado = $_POST['cveEstado'];
        @$municipio = $_POST['cveMunicipio'];
        @$distrito = $_POST['cveDistrito'];
        @$oficialia = $_POST['desOfificialia'];
        $oficialiaDto->setDesOficilia($oficialia);
        $oficialiaDto->setCveDistrito($distrito);
        $oficialiaDto->setCveMunicipio($municipio);
    } elseif ($tipo == "J") {
//        echo "\nJ\n";
        @$estado = $_POST['cveEstado'];
        @$municipio = $_POST['cveMunicipio'];
        @$distrito = $_POST['cveDistrito'];
        @$oficialia = $_POST['cveOficialia'];
        @$materia = $_POST['cveMateria'];
        @$cuantia = $_POST['cveCuantia'];
        @$tipoJM = $_POST['cveTipo'];
        @$hddAdscripcionJuzgado = $_POST['hddAdscripcionJuzgado'];
        @$hddJuzgadoBusqueda = $_POST['hddJuzgadoBusqueda'];
        @$txtDescJuzgado = $_POST['txtDescJuzgado'];
        $juzgadoDto->setCveOficialia($oficialia);
        $juzgadoDto->setCveAdscripcion($hddAdscripcionJuzgado);
        $juzgadoDto->setCveJuzgado($hddJuzgadoBusqueda);
        $juzgadoDto->setDesJuzgado($txtDescJuzgado);
        $juzgadoMateriaDto->setCveCuantia($cuantia);
        $juzgadoMateriaDto->setCveMateria($materia);
        $juzgadoMateriaDto->setCveTipo($tipoJM);
    } elseif ($tipo == "") {
//        echo "\nVACIO\n";
    }
    $param["paginacion"] = true;
//    var_dump($tipo);
//                                                                          $AdscripcionesDto, $param = null, $tipo = null, $oficialiaDto = null, $juzgadoDto = null, $juzgadoMateriaDto = null, $estado = null, $municipio = null, $distrito = null, $activos = null
    $adscripcionesDto = $adscripcionesFacade->selectAdscripcionesPaginacion($adscripcionesDto, $param, $tipo, $oficialiaDto, $juzgadoDto, $juzgadoMateriaDto, $estado, $municipio, $distrito, $activos);
    echo $adscripcionesDto;
} else if ($accion == "consultar-oficialia") {
    $param["paginacion"] = false;
    $adscripcionesDto = $adscripcionesFacade->selectAdscripcionesOficialia($adscripcionesDto, $param);
    echo $adscripcionesDto;
} else if ($accion == "consultar-juzgado") {
    $param["paginacion"] = false;
    $adscripcionesDto = $adscripcionesFacade->selectAdscripcionesJuzgado($adscripcionesDto, $param);
    echo $adscripcionesDto;
} else if ($accion == "eliminar-guardar-Adscripcion") {
    @$tipAdscripcionAnterior = $_POST['TipoAdscripcionAnterior'];
    @$esOficialia = $_POST['esOficialia'];
    @$esJuzgado = $_POST['esJuzgado'];
//    var_dump($adscripcionesDto);
    $adscripcionesDto = $adscripcionesFacade->eliminarAdscripcionConRelacionado($adscripcionesDto, $tipAdscripcionAnterior, $esOficialia, $esJuzgado);
    echo $adscripcionesDto;
} else if ($accion == "guardar-reasignar-juzgado") {
    @$cveJuzgado = $_POST['cveJuzgado'];
    @$desJuzgado = $_POST['desJuzgado'];
    @$cveOficialia = $_POST['cveOficialia'];
    $adscripcionesDto = $adscripcionesFacade->reasignarJuzgado($adscripcionesDto, $cveJuzgado, $desJuzgado, $cveOficialia);
    echo $adscripcionesDto;
}
?>