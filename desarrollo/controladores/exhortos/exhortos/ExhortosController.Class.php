<?php
/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 CONTROLLER
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */
define('WP_DEBUG', true); // enable debugging mode
ini_set("error_log", dirname(__FILE__) . "/../../../logs/ExhortosController.log");
ini_set("log_errors", 1);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Mexico_City');
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/exhortos/ExhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/exhortos/ExhortosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/partes/PartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/partes/PartesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgados/JuzgadosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estados/EstadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estados/EstadosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospartes/TipospartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipospartes/TipospartesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospersonas/TipospersonasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipospersonas/TipospersonasDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juiciosexhortos/JuiciosexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juiciosexhortos/JuiciosexhortosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estatusexhortos/EstatusexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estatusexhortos/EstatusexhortosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/contadores/ContadoresDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/contadores/ContadoresController.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/actuaciones/ActuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/actuaciones/ActuacionesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/generos/GenerosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/generos/GenerosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/imagenes/ImagenesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/imagenes/ImagenesDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/documentosimg/DocumentosimgDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/respuestasexhortos/RespuestasexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/respuestasexhortos/RespuestasexhortosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/controlescargas/ControlescargasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/controlescargas/ControlescargasController.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/configuracionescargas/ConfiguracionescargasDTO.Class.php");

include_once(dirname(__FILE__) . "../../../../webservice/cliente/exhortoGeneradoCliente.php");

include_once(dirname(__FILE__) . "/../../../tribunal/validacion/Validacion.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class ExhortosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarExhortos($ExhortosDto) {
        $ExhortosDto->setidExhorto(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getidExhorto()))));
        $ExhortosDto->setIdExhortoGenerado(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getIdExhortoGenerado()))));
        $ExhortosDto->setnumExhorto(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getnumExhorto()))));
        $ExhortosDto->setaniExhorto(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getaniExhorto()))));
        $ExhortosDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveJuzgado()))));
        $ExhortosDto->setnumeroExp(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getnumeroExp()))));
        $ExhortosDto->setanioExp(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getanioExp()))));
        $ExhortosDto->setcveJuzgadoProcedencia(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveJuzgadoProcedencia()))));
        $ExhortosDto->setjuzgadoProcedencia(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getjuzgadoProcedencia()))));
        $ExhortosDto->setcveEstadoProcedencia(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveEstadoProcedencia()))));
        $ExhortosDto->setcarpetaInv(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcarpetaInv()))));
        $ExhortosDto->setnuc(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getnuc()))));
        $ExhortosDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveMateria()))));
        $ExhortosDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveCuantia()))));
        $ExhortosDto->setnoFojas(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getnoFojas()))));
        $ExhortosDto->setnumOficio(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getnumOficio()))));
        $ExhortosDto->setsintesis(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getsintesis()))));
        $ExhortosDto->setobservaciones(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getobservaciones()))));
        $ExhortosDto->setcveConsignacion(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveConsignacion()))));
        $ExhortosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveEstatusExhorto()))));
        $ExhortosDto->setactivo(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getactivo()))));
        $ExhortosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getfechaRegistro()))));
        $ExhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getfechaActualizacion()))));
        $ExhortosDto->setcveEstadoDestino(strtoupper(str_ireplace("'", "", trim($ExhortosDto->getcveEstadoDestino()))));
        return $ExhortosDto;
    }

    public function validaCamposExhorto($ExhortosDto) {
        $validacion = new Validacion();
        $numExp = $validacion->datoTipoRequerido($ExhortosDto->getNumeroExp());
        $anioExp = $validacion->datoTipoRequerido($ExhortosDto->getAnioExp());
        $cveEstadoProcedencia = $validacion->datoTipoRequerido($ExhortosDto->getCveEstadoProcedencia());
        $cveJuzgadoProcedencia = $validacion->datoTipoRequerido($ExhortosDto->getCveJuzgadoProcedencia());
        $juzgadoProcedencia = $validacion->datoTipoRequerido($ExhortosDto->getJuzgadoProcedencia());
        $cveMateria = $validacion->datoTipoRequerido($ExhortosDto->getCveMateria());
        $cveJuicio = $validacion->datoTipoRequerido($ExhortosDto->getCveJuicio());
        $cveCuantia = $validacion->datoTipoRequerido($ExhortosDto->getCveCuantia());
        $noFojas = $validacion->datoTipoRequerido($ExhortosDto->getNoFojas());
        $numOficio = $validacion->datoTipoRequerido($ExhortosDto->getNumOficio());
        $sintesis = $validacion->datoTipoRequerido($ExhortosDto->getSintesis());
        $cveEstatusExhorto = $validacion->datoTipoRequerido($ExhortosDto->getCveEstatusExhorto());
        $estatus = true;
        $mensaje = [];
        if ($numExp == false) {
            $mensaje["mensaje"] = "El campo Número Expediente esta vacio.";
            $estatus = false;
        } else if ($anioExp == false) {
            $mensaje["mensaje"] = "El campo Año Expediente esta vacio.";
            $estatus = false;
        } else if ($cveEstadoProcedencia == false) {
            $mensaje["mensaje"] = "Debes elegir un Estado";
            $estatus = false;
        } else if ($cveJuzgadoProcedencia == false && $juzgadoProcedencia == false) {
            $mensaje["mensaje"] = "Debes elegir un Juzgado";
            $estatus = false;
        } else if ($cveMateria == false) {
            $mensaje["mensaje"] = "Debes elegir una Materia.";
            $estatus = false;
        } else if ($cveJuicio == false) {
            $mensaje["mensaje"] = "Debes elegir un Juicio.";
            $estatus = false;
        } else if ($cveCuantia == false) {
            $mensaje["mensaje"] = "Debes elegir una Cuantia.";
            $estatus = false;
        } else if ($noFojas == false) {
            $mensaje["mensaje"] = "El campo No.Fojas esta vacio.";
            $estatus = false;
        } else if ($numOficio == false) {
            $mensaje["mensaje"] = "El campo No.Oficio esta vacio.";
            $estatus = false;
        } else if ($sintesis == false) {
            $mensaje["mensaje"] = "El campo Sintesis esta vacio.";
            $estatus = false;
        } else if ($cveEstatusExhorto == false) {
            $mensaje["mensaje"] = "Debes elegir un Estatus.";
            $estatus = false;
        }
        if ($estatus == true) {
            $estatus = array("status" => "ok");
        } else {
            $estatus = array("status" => "error");
        }
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));

        return $respuesta;
    }

    public function validaCamposExhortoOficio($ExhortosDto) {
        $validacion = new Validacion();
        $noFojas = $validacion->datoTipoRequerido($ExhortosDto->getNoFojas());
        $sintesis = $validacion->datoTipoRequerido($ExhortosDto->getSintesis());
        $observaciones = $validacion->datoTipoRequerido($ExhortosDto->getObservaciones());
        $cveEstatusExhorto = $validacion->datoTipoRequerido($ExhortosDto->getCveEstatusExhorto());
        $estatus = true;
        $mensaje = [];
        if ($noFojas == false) {
            $mensaje["mensaje"] = "El campo No.Fojas esta vacio.";
            $estatus = false;
        } else if ($sintesis == false) {
            $mensaje["mensaje"] = "El campo Sintesis esta vacio.";
            $estatus = false;
        } else if ($observaciones == false) {
            $mensaje["mensaje"] = "El campo Observaciones esta vacio.";
            $estatus = false;
        } else if ($cveEstatusExhorto == false) {
            $mensaje["mensaje"] = "Debes elegir un Estatus.";
            $estatus = false;
        }
        if ($estatus == true) {
            $estatus = array("status" => "ok");
        } else {
            $estatus = array("status" => "error");
        }
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));

        return $respuesta;
    }

    public function respuestaWs($ExhortosDto, $proveedor = null) {
        $idActuacion = $ExhortosDto->getIdExhortoGenerado();
        $ExhortosDto->setIdExhortoGenerado('');
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);

        $ActuacionesDto = new ActuacionesDTO();
        $ActuacionesDto->setIdActuacion($idActuacion);
        $ActuacionesDao = new ActuacionesDAO();
        $ActuacionesDto = $ActuacionesDao->selectActuaciones($ActuacionesDto, $proveedor);

        $estadosDto = new EstadosDTO();
        $estadosDto->setCveEstado($ExhortosDto[0]->getCveEstadoProcedencia());
        $estadosDao = new EstadosDAO();
        $estadosDto = $estadosDao->selectEstados($estadosDto, $proveedor);

        $imagenesZip = $this->obtenerImagenes(0,$ActuacionesDto[0]->getIdActuacion());

        $urlWS = $estadosDto[0]->getUrlWebServices();

        $cveAdscripcion = $_SESSION["cveAdscripcion"];

        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setCveAdscripcion($cveAdscripcion);
        $juzgadosDao = new JuzgadosDAO();
        $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, $proveedor);

        /* OBTIENE ESTATUS OFICIO */
        $respuestasExhortosEstatusDto = new RespuestasExhortosDTO();
        $respuestasExhortosEstatusDto->setIdActuacion($ActuacionesDto[0]->getIdActuacion());
        $respuestasExhortosEstatusDto->setActivo("S");
        $respuestasExhortosEstatusDao = new RespuestasExhortosDAO();
        $respuestasExhortosEstatusDto = $respuestasExhortosEstatusDao->selectRespuestasExhortos($respuestasExhortosEstatusDto, $proveedor);

        $exhortoGenerado = array('estadoOrigen' => 1,
            'idExhortoGenerado' => $ExhortosDto[0]->getIdExhortoGenerado(),
            'idEstatus' => $respuestasExhortosEstatusDto[0]->getCveEstatusExhortos());
        $actuacion = array('noFojas' => utf8_encode($ActuacionesDto[0]->getNoFojas()),
            'sintesis' => utf8_encode($ActuacionesDto[0]->getSintesis()),
            'observaciones' => utf8_encode($ActuacionesDto[0]->getObservaciones()));
        $promovente[] = array('tipoPersona' => 2,
            'nombrePersona' => utf8_encode($juzgadosDto[0]->getDesJuzgado()));

        $respuesta = array("exhortoGenerado" => $exhortoGenerado, "actuacion" => $actuacion, "promovente" => $promovente, "documentos" => $imagenesZip);
        $json = json_encode($respuesta);

        $exhortoGeneradoCliente = new exhortoGeneradoCliente();
        //$urlWS = "http://127.0.0.1/exhortos/desarrollo/webservice/servidor/exhortos/ExhortosServer.php?wsdl";
        $envioWS = $exhortoGeneradoCliente->actualizaExhortoGenerado($urlWS, $json);
        $actualizacionWS = json_decode($envioWS, true);
        /* ACTUALIZA EN TABLA RESPUESTAS EXHORTOS */
        $respuestasExhortosDto = new RespuestasExhortosDTO();
        $respuestasExhortosDto->setIdActuacion($ActuacionesDto[0]->getIdActuacion());
        $respuestasExhortosDto->setActivo("S");
        $respuestasExhortosDao = new RespuestasExhortosDAO();
        $respuestasExhortosDto = $respuestasExhortosDao->selectRespuestasExhortos($respuestasExhortosDto, $proveedor);

        $idActuacionPromocion = $actualizacionWS["data"]["idActuacion"];
        $numPromocion = $actualizacionWS["data"]["numeroPromocion"];
        $aniPromocion = $actualizacionWS["data"]["anioPromocion"];

        $respuestasExhortosActualizaDto = new RespuestasExhortosDTO();
        $respuestasExhortosActualizaDto->setIdRespuestaExhorto($respuestasExhortosDto[0]->getIdRespuestaExhorto());
        $respuestasExhortosActualizaDto->setNumPromocion($numPromocion);
        $respuestasExhortosActualizaDto->setAniPromocion($aniPromocion);
        $respuestasExhortosActualizaDto->setIdActuacionPromocion($idActuacionPromocion);
        $respuestasExhortosActualizaDao = new RespuestasExhortosDAO();
        $respuestasExhortosActualizaDto = $respuestasExhortosActualizaDao->updateRespuestasExhortos($respuestasExhortosActualizaDto, $proveedor);

        $estatus = array("status" => "ok");
        $mensaje = array("mensaje" => "El oficio se envio correctamente", "numPromocion" => $numPromocion, "aniPromocion" => $aniPromocion);
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
        return json_encode($respuesta);
    }

    public function selectExhortos($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);
        return $ExhortosDto;
    }

    public function obtenerImagenes($idExhorto=0, $idActuacion=0) {
        $content64 = "";
        $documentosimgDao = new DocumentosimgDAO();
        $documentosimgDto = new DocumentosimgDTO();
        $documentosimgDto->setActivo("S");
        if($idExhorto > 0){
            $documentosimgDto->setIdExhorto($idExhorto);
        }else{
            $documentosimgDto->setIdActuacion($idActuacion);
        }

        $documentosimg = $documentosimgDao->selectDocumentosimg($documentosimgDto);
        //error_log(print_r($documentosimg, true));
        if ($documentosimg != "") {
            $idDocumentoImg = $documentosimg[0]->getIdDocumentoImg();
            $imagenesDao = new ImagenesDAO();
            $imagenesDto = new ImagenesDTO();
            $imagenesDto->setActivo("S");
            $imagenesDto->setIdDocumentoImg($idDocumentoImg);
            $imagenes = $imagenesDao->selectImagenes($imagenesDto);
            //error_log(print_r($imagenes, true));
            if ($imagenes != "") {
                if($idExhorto > 0){
                    $destination = 'ex-' . $idExhorto . '.zip';
                }else{
                    $destination = 'ex-' . $idActuacion . '.zip';
                }
                $zip = new ZipArchive();
                if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                 //   echo "error a abrir zip";
                    return false;
                }
                foreach ($imagenes as $imagen) {
                    $ruta = explode("/", $imagen->getRuta());
                    $totalNiveles = count($ruta);
                    $archivo = $ruta[$totalNiveles - 1];
                    $zip->addFile($imagen->getRuta(), $archivo);
                }
                //error_log("zip obj => " . print_r($zip) );
                $zip->close();
                $content = file_get_contents($destination);
                $content64 = base64_encode($content);
            }
        }
        //$unlink = unlink($destination);
        //error_log($content64);
        return $content64;
    }

    public function selectExhortosAdscripcion($ExhortosDto, $proveedor = null) {
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setCveAdscripcion($_SESSION["cveAdscripcion"]);
        $juzgadosDto->setActivo("S");
        $juzgadosDao = new JuzgadosDAO();
        $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);
        $ExhortosDto->setCveJuzgado($juzgadosDto[0]->getCveJuzgado());
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);
//        print_r($ExhortosDto);
        /* BUSCA SI YA EXISTE REGISTRADA LA ACTUACION */
        if ($ExhortosDto != "") {
            $actuacionesDto = new ActuacionesDTO();
            $actuacionesDto->setIdReferencia($ExhortosDto[0]->getIdExhorto());
            $actuacionesDto->setCveTipoActuacion(3);
            $actuacionesDto->setActivo("S");
            $actuacionesDao = new ActuacionesDAO();
            $actuacionesDto = $actuacionesDao->selectactuaciones($actuacionesDto, "", $proveedor);
            if ($actuacionesDto != "") {
                return false;
            }
        }
        return $ExhortosDto;
    }

    public function selectReporte($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);

        /* OBTIENE FECHA DE REGISTRO */
        $fecha = $ExhortosDto[0]->getFechaRegistro();
        $fecha = explode(" ", $fecha);
        $fechaRegistro = $fecha[0];
        $hora = $fecha[1];
        $fechaRegistro = explode("-", $fechaRegistro);
        $fechaRegistro = $fechaRegistro[2] . "/" . $fechaRegistro[1] . "/" . $fechaRegistro[0];
        $fechaRegistro = $fechaRegistro . " " . $hora;

        /* OBTIENE JUZGADO PROCEDENCIA */
        if ($ExhortosDto[0]->getCveJuzgadoProcedencia() != "") {
            $juzgadosDto = new JuzgadosDTO();
            $juzgadosDto->setCveJuzgado($ExhortosDto[0]->getCveJuzgadoProcedencia());
            $juzgadosDao = new JuzgadosDAO();
            $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);
            $juzgadoProcedencia = array(
                "cveJuzgado" => $juzgadosDto[0]->getCveJuzgado(),
                "desJuzgado" => $juzgadosDto[0]->getDesJuzgado()
            );
        } else {
            $juzgadoProcedencia = array(
                "cveJuzgado" => "",
                "desJuzgado" => ""
            );
        }

        /* OBTIENE JUZGADO DESTINO */
        if ($ExhortosDto[0]->getCveJuzgado() != "") {
            $juzgadosDto = new JuzgadosDTO();
            $juzgadosDto->setCveJuzgado($ExhortosDto[0]->getCveJuzgado());
            $juzgadosDao = new JuzgadosDAO();
            $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);
            $juzgadoDestino = array(
                "cveJuzgado" => $juzgadosDto[0]->getCveJuzgado(),
                "desJuzgado" => $juzgadosDto[0]->getDesJuzgado()
            );
        } else {
            $juzgadoDestino = array(
                "cveJuzgado" => "",
                "desJuzgado" => ""
            );
        }

        /* OBTIENE PARTES */
        $partesDto = new PartesDTO();
        $partesDto->setIdExhorto($ExhortosDto[0]->getIdExhorto());
        $partesDto->setActivo("S");
        $partesDao = new PartesDAO();
        $partesDto = $partesDao->selectpartes($partesDto, "", $proveedor);

        /* OBTIENE ACTUACIONES */
        $actuacionesDto = new ActuacionesDTO();
        $actuacionesDto->setIdReferencia($ExhortosDto[0]->getIdExhorto());
        $actuacionesDto->setCveTipoActuacion(3);
        $actuacionesDto->setActivo("S");
        $actuacionesDao = new ActuacionesDAO();
        $actuacionesDto = $actuacionesDao->selectactuaciones($actuacionesDto, "", $proveedor);

        /* DATOS DE LA RESPUESTA */
        $respuestasExhortosDto = new RespuestasExhortosDTO();
        $respuestasExhortosDto->setIdActuacion($actuacionesDto[0]->getIdActuacion());
        $respuestasExhortosDao = new RespuestasExhortosDAO();
        $respuestasExhortosDto = $respuestasExhortosDao->selectRespuestasExhortos($respuestasExhortosDto, $proveedor);

        foreach ($partesDto as $parteDto) {
            /* OBTIENE TIPOS PARTES */
            $tiposPartesDto = new TiposPartesDTO();
            $tiposPartesDto->setCveTipoParte($parteDto->getCveTipoParte());
            $tiposPartesDao = new TiposPartesDAO();
            $tiposPartesDto = $tiposPartesDao->selectTipospartes($tiposPartesDto, "", $proveedor);

            /* OBTIENE TIPO PERSONA */
            $tiposPersonasDto = new TiposPersonasDTO();
            $tiposPersonasDto->setCveTipoPersona($parteDto->getCveTipoPersona());
            $tiposPersonasDao = new TiposPersonasDAO();
            $tiposPersonasDto = $tiposPersonasDao->selectTipospersonas($tiposPersonasDto, "", $proveedor);

            /* OBTIENE GENERO */
            $generosDto = new GenerosDTO();
            $generosDto->setCveGenero($parteDto->getCveGenero());
            $generosDao = new GenerosDAO();
            $generosDto = $generosDao->selectgeneros($generosDto, "", $proveedor);

            $partes[] = array(
                "idParte" => $parteDto->getIdParte(),
                "nombre" => $this->validaNull($parteDto->getNombre()),
                "paterno" => $this->validaNull($parteDto->getPaterno()),
                "materno" => $this->validaNull($parteDto->getMaterno()),
                "nombrePersonaMoral" => $this->validaNull($parteDto->getNombrePersonaMoral()),
                "cveTipoParte" => $tiposPartesDto[0]->getCveTipoParte(),
                "desTipoParte" => $this->validaNull($tiposPartesDto[0]->getDescTipoParte()),
                "cveTipoPersona" => $tiposPersonasDto[0]->getCveTipoPersona(),
                "desTipoPersona" => $this->validaNull($tiposPersonasDto[0]->getDesTipoPersona()),
                "cveGenero" => $generosDto[0]->getcveGenero(),
                "desGenero" => $this->validaNull($generosDto[0]->getDesGenero()),
                "detenido" => $parteDto->getDetenido()
            );
        }
        $datos["datos"] = array(
            "idExhorto" => $ExhortosDto[0]->getIdExhorto(),
            "numExhorto" => $ExhortosDto[0]->getnumExhorto(),
            "aniExhorto" => $ExhortosDto[0]->getAniExhorto(),
            "numPromocion" => $this->validaNull($respuestasExhortosDto[0]->getNumPromocion()),
            "aniPromocion" => $this->validaNull($respuestasExhortosDto[0]->getAniPromocion()),
            "numeroExp" => $this->validaNull($ExhortosDto[0]->getNumeroExp()),
            "anioExp" => $this->validaNull($ExhortosDto[0]->getAnioExp()),
            "numOficio" => $this->validaNull($actuacionesDto[0]->getNumActuacion())."/".$this->validaNull($actuacionesDto[0]->getAniActuacion()),
            "carpetaInv" => $this->validaNull($ExhortosDto[0]->getCarpetaInv()),
            "fechaAlta" => $fechaRegistro,
            "sintesis" => $this->validaNull($actuacionesDto[0]->getSintesis()),
            "observaciones" => $this->validaNull($actuacionesDto[0]->getObservaciones()),
            "cveJuzgadoProcedencia" => $juzgadoProcedencia,
            "juzgadoProcedencia" => $this->validaNull($ExhortosDto[0]->getJuzgadoProcedencia()),
            "juzgadoDestino" => $juzgadoDestino,
            "partes" => $partes
        );
        return json_encode($datos);
    }

    public function validaNull($dato) {
        if ($dato == "") {
            $dato = '';
        } else {
            $dato = utf8_encode($dato);
        }
        return $dato;
    }

    public function selectOficios($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $rangoFechas = json_decode($ExhortosDto->getPartes());
        $fechaInicial = $rangoFechas->fechaInicioConsulta;
        $fechaFinal = $rangoFechas->fechaFinConsulta;
        $entreFecha = "";
        if ($fechaInicial != "" && $fechaFinal != "") {
            $fechaInicial = explode("/", $fechaInicial);
            $fechaInicial = $fechaInicial[2] . "-" . $fechaInicial[1] . "-" . $fechaInicial[0];
            $fechaFinal = explode("/", $fechaFinal);
            $fechaFinal = $fechaFinal[2] . "-" . $fechaFinal[1] . "-" . $fechaFinal[0];
            $entreFecha = " AND fechaRegistro >= '$fechaInicial 00:00:00' AND fechaRegistro <= '$fechaFinal 23:59:59'";
        }
        /* BUSCA ACTUACIONES */
        $actuacionesDto = new ActuacionesDTO();
        $actuacionesDto->setNumActuacion($ExhortosDto->getNumExhorto());
        $actuacionesDto->setAniActuacion($ExhortosDto->getAniExhorto());
        $actuacionesDto->setCveTipoActuacion(3);
        $actuacionesDto->setActivo("S");
        $actuacionesDao = new ActuacionesDAO();
        $totalRegistros = $actuacionesDao->selectActuaciones($actuacionesDto, $entreFecha, $proveedor);
        /* NUMERO DE REGISTROS POR PAGINA */
        $tamanoPagina = $ExhortosDto->getNumeroRegistros();
        $paginaActual = $ExhortosDto->getPagina();
        $pagina = $paginaActual;
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $tamanoPagina;
        }
        $totalPaginas = ceil(count($totalRegistros) / $tamanoPagina);

        /* LIMITE DE PAGINACION */
        $limit = " ORDER BY idActuacion DESC LIMIT " . $inicio . "," . $tamanoPagina;
        $actuacionesDto = $actuacionesDao->selectActuaciones($actuacionesDto, $entreFecha . $limit, $proveedor);
        $resultado = array();
        if ($actuacionesDto != "") {
            $mensaje = array("estatus" => "ok", "mensaje" => "SI EXISTEN DATOS");
            foreach ($actuacionesDto as $actuacionDto) {
            	$imagenes = array();
                /* DATOS DEL EXHORTO */
                $exhortosDto = new ExhortosDTO();
                $exhortosDto->setIdExhorto($actuacionDto->getIdReferencia());
                $exhortosDao = new ExhortosDAO();
                $exhortosDto = $exhortosDao->selectExhortos($exhortosDto, "", "", $proveedor);
                //obtencion de la ruta de los archivos digitalizados adjuntos
                $DocumentosimgDTO = new DocumentosimgDTO();
                $DocumentosimgDAO = new DocumentosimgDAO();
                $DocumentosimgDTO->setIdActuacion( $actuacionDto->getIdActuacion() );
                $DocumentosimgDTO->setActivo( 'S' );
                $DocumentosimgDTO = $DocumentosimgDAO->selectDocumentosimg( $DocumentosimgDTO );
                //error_log(json_encode($DocumentosimgDTO));
                if( $DocumentosimgDTO != '' ){
                    $ImagenesDTO = new ImagenesDTO();
                    $ImagenesDAO = new ImagenesDAO();
                    $ImagenesDTO->setActivo('S');
                    $ImagenesDTO->setAdjunto('S');
                    $ImagenesDTO->setIdDocumentoImg( $DocumentosimgDTO[0]->getIdDocumentoImg() );
                    $ImagenesDTO = $ImagenesDAO->selectImagenes( $ImagenesDTO );
	                if( $ImagenesDTO != '' ){
	                    foreach ($ImagenesDTO as $Imagenes) {
	                    	$size = filesize( $Imagenes->getRuta() );
	                        $rutaArchivo = explode('/', $Imagenes->getRuta() );
	                        $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];
	                        $imagenes[] = array('ruta' => utf8_encode( substr($Imagenes->getRuta(), 9) ),
	                            'nombreArchivo' => utf8_encode( $nombreArchivo ),
                                'idImagen' => utf8_encode( $Imagenes->getIdImagen() ),
                                'tamano' => $size ) ;
	                    }
	                }
                }


                /* DATOS DE LA RESPUESTA */
                $respuestasExhortosDto = new RespuestasExhortosDTO();
                $respuestasExhortosDto->setIdActuacion($actuacionDto->getIdActuacion());
                $respuestasExhortosDao = new RespuestasExhortosDAO();
                $respuestasExhortosDto = $respuestasExhortosDao->selectRespuestasExhortos($respuestasExhortosDto, $proveedor);

                /* DATOS DEL ESTATUS DE LA ACTUACION */
                $estatusExhortosDto = new EstatusExhortosDTO();
                $estatusExhortosDto->setCveEstatusExhorto($respuestasExhortosDto[0]->getCveEstatusExhortos());
                $estatusExhortosDao = new EstatusExhortosDAO();
                $estatusExhortosDto = $estatusExhortosDao->selectestatusExhortos($estatusExhortosDto, $proveedor);

                $resultado["datos"][] = array("idActuacion" => utf8_encode($actuacionDto->getIdActuacion()),
                    "idExhorto" => utf8_encode($exhortosDto[0]->getIdExhorto()),
                    "idExhortoGenerado" => utf8_encode($exhortosDto[0]->getIdExhortoGenerado()),
                    "numExhorto" => utf8_encode($exhortosDto[0]->getNumExhorto()),
                    "aniExhorto" => utf8_encode($exhortosDto[0]->getAniExhorto()),
                    "numActuacion" => utf8_encode($actuacionDto->getNumActuacion()),
                    "aniActuacion" => utf8_encode($actuacionDto->getAniActuacion()),
                    "noFojas" => utf8_encode($actuacionDto->getNoFojas()),
                    "sintesis" => utf8_encode($actuacionDto->getSintesis()),
                    "observaciones" => utf8_encode($actuacionDto->getObservaciones()),
                    "idActuacionPromocion" => utf8_encode($respuestasExhortosDto[0]->getIdActuacionPromocion()),
                    "numPromocion" => utf8_encode($respuestasExhortosDto[0]->getNumPromocion()),
                    "aniPromocion" => utf8_encode($respuestasExhortosDto[0]->getAniPromocion()),
                    "cveEstatusExhorto" => utf8_encode($estatusExhortosDto[0]->getCveEstatusExhorto()),
                    "desEstatusExhorto" => utf8_encode($estatusExhortosDto[0]->getDesEstatusExhorto()),
                    "pagina" => $pagina,
                    "totalPaginas" => $totalPaginas,
                    "adjuntos" => $imagenes
                );
            }
        } else {
            $mensaje = array("estatus" => "error", "mensaje" => "NO EXISTEN DATOS CON ESTOS PARAMETROS DE BUSQUEDA");
        }
        $return = array_merge($mensaje, $resultado);
        return json_encode($return);
    }

    public function selectExhortosParte($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        /* VALIDA ESTADO PROCEDENCIA */
        ($ExhortosDto->getCveEstadoProcedencia() == 0) ? $ExhortosDto->setCveEstadoProcedencia('') : $ExhortosDto->getCveEstadoProcedencia();

        /* VALIDA JUZGADO PROCEDENCIA */
        ($ExhortosDto->getCveJuzgadoProcedencia() == 0) ? $ExhortosDto->setCveJuzgadoProcedencia('') : $ExhortosDto->getCveJuzgadoProcedencia();

        /* BUSQUEDA POR RANGO DE FECHAS */

        $oficialiasController = new OficialiaController();
        $oficialiaDto = new OficialiaDTO();
        $oficialiaDto->setActivo("S");
        $oficialiaDto->setCveAdscripcion($ExhortosDto->getCveJuzgado());
        $listaOficialias = $oficialiasController->selectOficialia($oficialiaDto);
        error_log(print_r($listaOficialias, true));
        $cveOficialia = "";
        if ($listaOficialias != "") {
            $cveOficialia = $listaOficialias[0]->getCveOficialia();
        }
        $juzgadosController = new JuzgadosController();
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setActivo("S");
        $juzgadosDto->setCveOficialia($cveOficialia);
        $listaJuzgados = $juzgadosController->selectJuzgados($juzgadosDto);
        error_log("juzgados =>" . print_r($listaJuzgados, true));
        $cveJuzgados = "";
        if ($listaJuzgados != "") {
            foreach ($listaJuzgados as $juz) {
                $cveJuzgados.=$juz->getCveJuzgado() . ",";
            }
        }
        if ($cveJuzgados != "") {
            $cveJuzgados = trim($cveJuzgados, ",");
        }
        $ExhortosDto->setCveJuzgado($cveJuzgados);

        ;
        $rangoFechas = json_decode($ExhortosDto->getPartes());
        $fechaInicial = $rangoFechas->fechaInicioConsulta;
        $fechaFinal = $rangoFechas->fechaFinConsulta;
        $entreFecha = "";
        if ($fechaInicial != "" && $fechaFinal != "") {
            $fechaInicial = explode("/", $fechaInicial);
            $fechaInicial = $fechaInicial[2] . "-" . $fechaInicial[1] . "-" . $fechaInicial[0];
            $fechaFinal = explode("/", $fechaFinal);
            $fechaFinal = $fechaFinal[2] . "-" . $fechaFinal[1] . "-" . $fechaFinal[0];
            $entreFecha = " AND fechaRegistro >= '$fechaInicial 00:00:00' AND fechaRegistro <= '$fechaFinal 23:59:59'";
        }
        $ExhortosDao = new ExhortosDAO();
        $totalRegistros = $ExhortosDao->selectExhortos($ExhortosDto, $entreFecha, $proveedor);

        /* NUMERO DE REGISTROS POR PAGINA */
        $tamanoPagina = $ExhortosDto->getNumeroRegistros();
        $paginaActual = $ExhortosDto->getPagina();
        $pagina = $paginaActual;
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $tamanoPagina;
        }
        $totalPaginas = ceil(count($totalRegistros) / $tamanoPagina);

        /* LIMITE DE PAGINACION */
        $limit = " ORDER BY idExhorto DESC LIMIT " . $inicio . "," . $tamanoPagina;
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $entreFecha . $limit, $proveedor);

        $resultado = array();
        if ($ExhortosDto != "") {
            $mensaje = array("estatus" => "ok", "mensaje" => "SI EXISTEN DATOS");
            foreach ($ExhortosDto as $ExhortoDto) {
                $partes = array();
                $juzgado = array();
                $juzgadoProcedencia = array();
                $estadoProcedencia = array();
                $juicioExhorto = array();
                $imagenes = array();

                /* OBTIENE JUZGADOS */
                $juzgadosDto = new JuzgadosDTO();
                $juzgadosDto->setCveJuzgado($ExhortoDto->getCveJuzgado());
                $juzgadosDao = new JuzgadosDAO();
                $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);

                /* OBTIENE JUZGADOS PROCEDENCIA */
                $juzgadosPDto = new JuzgadosDTO();
                $juzgadosPDto->setCveJuzgado($ExhortoDto->getCveJuzgadoProcedencia());
                $juzgadosPDao = new JuzgadosDAO();
                $juzgadosPDto = $juzgadosPDao->selectJuzgados($juzgadosPDto, "", $proveedor);

                /* OBTIENE ESTADOS PROCEDENCIA */
                $estadosDto = new EstadosDTO();
                $estadosDto->setCveEstado($ExhortoDto->getCveEstadoProcedencia());
                $estadosDao = new EstadosDAO();
                $estadosDto = $estadosDao->selectEstados($estadosDto, "", "", $proveedor);


                /* OBTIENE JUICIO */
                $JuiciosExhortosDto = new JuiciosExhortosDTO();
                $JuiciosExhortosDto->setIdExhorto($ExhortoDto->getIdExhorto());
                $JuiciosExhortosDto->setActivo("S");
                $JuiciosExhortosDao = new JuiciosExhortosDAO();
                $JuiciosExhortosDto = $JuiciosExhortosDao->selectJuiciosExhortos($JuiciosExhortosDto, "", "", $proveedor);

                /* OBTIENE PARTES */
                $partesDto = new PartesDTO();
                $partesDto->setIdExhorto($ExhortoDto->getIdExhorto());
                $partesDto->setActivo("S");
                $partesDao = new PartesDAO();
                $partesDto = $partesDao->selectPartes($partesDto, "", $proveedor);

                //obtencion de la ruta de los archivos digitalizados adjuntos
                $DocumentosimgDTO = new DocumentosimgDTO();
                $DocumentosimgDAO = new DocumentosimgDAO();
                $DocumentosimgDTO->setIdExhorto( $ExhortoDto->getIdExhorto() );
                $DocumentosimgDTO->setActivo( 'S' );
                $DocumentosimgDTO = $DocumentosimgDAO->selectDocumentosimg( $DocumentosimgDTO );
                //error_log(json_encode($DocumentosimgDTO));
                if( $DocumentosimgDTO != '' ){
                    $ImagenesDTO = new ImagenesDTO();
                    $ImagenesDAO = new ImagenesDAO();
                    $ImagenesDTO->setActivo('S');
                    $ImagenesDTO->setAdjunto('S');
                    $ImagenesDTO->setIdDocumentoImg( $DocumentosimgDTO[0]->getIdDocumentoImg() );
                    $ImagenesDTO = $ImagenesDAO->selectImagenes( $ImagenesDTO );
	                if( $ImagenesDTO != '' ){
	                    foreach ($ImagenesDTO as $Imagenes) {
	                    	$size = filesize( $Imagenes->getRuta() );
	                        $rutaArchivo = explode('/', $Imagenes->getRuta() );
	                        $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];
	                        $imagenes[] = array('ruta' => utf8_encode( substr($Imagenes->getRuta(), 9) ),
	                            'nombreArchivo' => utf8_encode( $nombreArchivo ),
                                'idImagen' => utf8_encode( $Imagenes->getIdImagen() ),
                                'tamano' => $size ) ;
	                    }
	                }
                }

                if ($juzgadosDto != "") {
                    foreach ($juzgadosDto as $juzgadoDto) {
                        $juzgado[] = array("cveJuzgado" => utf8_encode($juzgadoDto->getCveJuzgado()),
                            "desJuzgado" => utf8_encode($juzgadoDto->getDesJuzgado()));
                    }
                }
                if ($juzgadosPDto != "") {
                    foreach ($juzgadosPDto as $juzgadoPDto) {
                        $juzgadoProcedencia[] = array("cveJuzgado" => utf8_encode($juzgadoPDto->getCveJuzgado()),
                            "desJuzgado" => utf8_encode($juzgadoPDto->getDesJuzgado()));
                    }
                }
                if ($estadosDto != "") {
                    foreach ($estadosDto as $estadoDto) {
                        $estadoProcedencia[] = array("cveEstado" => utf8_encode($estadoDto->getCveEstado()),
                            "desEstado" => utf8_encode($estadoDto->getDesEstado()));
                    }
                }
                if ($JuiciosExhortosDto != "") {
                    foreach ($JuiciosExhortosDto as $JuicioExhortoDto) {
                        $juicioExhorto[] = array("idJuicioexhorto" => utf8_encode($JuicioExhortoDto->getIdJuicioexhorto()),
                            "idExhorto" => utf8_encode($JuicioExhortoDto->getIdExhorto()),
                            "idExhortoGenerado" => utf8_encode($JuicioExhortoDto->getIdExhortoGenerado()),
                            "cveJuicio" => utf8_encode($JuicioExhortoDto->getCveJuicio()),
                            "otroJuicio" => utf8_encode($JuicioExhortoDto->getOtroJuicio()));
                    }
                }
                if ($partesDto != "") {
                    foreach ($partesDto as $parteDto) {
                        $tipospartes = array();
                        $tipospersonas = array();

                        /* OBTIENE TIPOS PARTES */
                        $tiposPartesDto = new TiposPartesDTO();
                        $tiposPartesDto->setCveTipoParte($parteDto->getCveTipoParte());
                        $tiposPartesDao = new TiposPartesDAO();
                        $tiposPartesDto = $tiposPartesDao->selectTiposPartes($tiposPartesDto, "", "", $proveedor);

                        /* OBTIENE TIPOS PERSONAS */
                        $tiposPersonasDto = new TiposPersonasDTO();
                        $tiposPersonasDto->setCveTipoPersona($parteDto->getCveTipoPersona());
                        $tiposPersonasDao = new TiposPersonasDAO();
                        $tiposPersonasDto = $tiposPersonasDao->selectTiposPersonas($tiposPersonasDto, "", "", $proveedor);

                        if ($tiposPartesDto != "") {
                            foreach ($tiposPartesDto as $tipoParteDto) {
                                $tipospartes[] = array("cveTipoParte" => utf8_encode($tipoParteDto->getCveTipoParte()),
                                    "descTipoParte" => utf8_encode($tipoParteDto->getDescTipoParte()));
                            }
                        }

                        if ($tiposPersonasDto != "") {
                            foreach ($tiposPersonasDto as $tipoPersonaDto) {
                                $tipospersonas[] = array("cveTipoPersona" => utf8_encode($tipoPersonaDto->getCveTipoPersona()),
                                    "desTipoPersona" => utf8_encode($tipoPersonaDto->getDesTipoPersona()));
                            }
                        }

                        $partes[] = array("idParte" => utf8_encode($parteDto->getIdParte()),
                            "idExhorto" => utf8_encode($parteDto->getIdExhorto()),
                            "idExhortoGenerado" => utf8_encode($parteDto->getIdExhortoGenerado()),
                            "nombre" => utf8_encode($parteDto->getNombre()),
                            "paterno" => utf8_encode($parteDto->getPaterno()),
                            "materno" => utf8_encode($parteDto->getMaterno()),
                            "nombrePersonaMoral" => utf8_encode($parteDto->getNombrePersonaMoral()),
                            "cveTipoPersona" => $tipospersonas,
                            "cveTipoParte" => $tipospartes,
                            "edad" => utf8_encode($parteDto->getEdad()),
                            "fechaNacimiento" => utf8_encode($parteDto->getFechaNacimiento()),
                            "rfc" => utf8_encode($parteDto->getRFC()),
                            "curp" => utf8_encode($parteDto->getCURP()),
                            "cveEstado" => utf8_encode($parteDto->getCveEstado()),
                            "cveMunicipio" => utf8_encode($parteDto->getCveMunicipio()),
                            "domicilio" => utf8_encode($parteDto->getDomicilio()),
                            "telefono" => utf8_encode($parteDto->getTelefono()),
                            "email" => utf8_encode($parteDto->getEmail()),
                            "cveGenero" => utf8_encode($parteDto->getCveGenero()),
                            "detenido" => utf8_encode($parteDto->getDetenido()));
                    }
                }
                $fechaRegistro = $ExhortoDto->getFechaRegistro();
                $fechaRegistro = explode(" ", $fechaRegistro);
                $fechaRegistro = $fechaRegistro[0];
                $fechaRegistro = explode("-", $fechaRegistro);
                $fechaRegistro = $fechaRegistro[2] . "/" . $fechaRegistro[1] . "/" . $fechaRegistro[0];
                $oficio = explode("/", $ExhortoDto->getNumOficio());
                $oficioNumero = $oficio[0];
                $oficioAnio = $oficio[1];
                $resultado["datos"][] = array("idExhorto" => utf8_encode($ExhortoDto->getIdExhorto()),
                    "idExhortoGenerado" => utf8_encode($ExhortoDto->getIdExhortoGenerado()),
                    "numExhorto" => utf8_encode($ExhortoDto->getNumExhorto()),
                    "aniExhorto" => utf8_encode($ExhortoDto->getAniExhorto()),
                    "numeroExp" => utf8_encode($ExhortoDto->getNumeroExp()),
                    "anioExp" => utf8_encode($ExhortoDto->getAnioExp()),
                    "cveJuzgado" => $juzgado,
                    "cveJuzgadoProcedencia" => $juzgadoProcedencia,
                    "juzgadoProcedencia" => utf8_encode($ExhortoDto->getJuzgadoProcedencia()),
                    "cveEstadoProcedencia" => $estadoProcedencia,
                    "carpetaInv" => utf8_encode($ExhortoDto->getCarpetaInv()),
                    "nuc" => utf8_encode($ExhortoDto->getNuc()),
                    "cveMateria" => utf8_encode($ExhortoDto->getCveMateria()),
                    "cveJuicio" => $juicioExhorto,
                    "cveCuantia" => utf8_encode($ExhortoDto->getCveCuantia()),
                    "noFojas" => utf8_encode($ExhortoDto->getNoFojas()),
                    "numOficio" => $oficioNumero,
                    "anioOficio" => $oficioAnio,
                    "sintesis" => utf8_encode($ExhortoDto->getSintesis()),
                    "observaciones" => utf8_encode($ExhortoDto->getObservaciones()),
                    "cveConsignacion" => utf8_encode($ExhortoDto->getCveConsignacion()),
                    "cveEstatusExhorto" => utf8_encode($ExhortoDto->getCveEstatusExhorto()),
                    "cveEstadoDestino" => utf8_encode($ExhortoDto->getCveEstadoDestino()),
                    "fechaRegistro" => $fechaRegistro,
                    "partes" => $partes,
                    "pagina" => $pagina,
                    "totalPaginas" => $totalPaginas,
                    "adjuntos" => $imagenes
                );
            }
        } else {
            $mensaje = array("estatus" => "error", "mensaje" => "NO EXISTEN DATOS CON ESTOS PARAMETROS DE BUSQUEDA");
        }
        $return = array_merge($mensaje, $resultado);
        return json_encode($return);
    }

    public function selectExhortosParteJuzgado($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        /* VALIDA ESTADO PROCEDENCIA */
        ($ExhortosDto->getCveEstadoProcedencia() == 0) ? $ExhortosDto->setCveEstadoProcedencia('') : $ExhortosDto->getCveEstadoProcedencia();

        /* VALIDA JUZGADO PROCEDENCIA */
        ($ExhortosDto->getCveJuzgadoProcedencia() == 0) ? $ExhortosDto->setCveJuzgadoProcedencia('') : $ExhortosDto->getCveJuzgadoProcedencia();

        /* BUSQUEDA POR RANGO DE FECHAS */

//                $oficialiasController = new OficialiaController();
//                $oficialiaDto = new OficialiaDTO();
//                $oficialiaDto->setActivo("S");
//                $oficialiaDto->setCveAdscripcion($ExhortosDto->getCveJuzgado());
//                $listaOficialias=$oficialiasController->selectOficialia($oficialiaDto);
//                $cveOficialia="";
//                if($listaOficialias!=""){
//                   $cveOficialia =   $listaOficialias[0]->getCveOficialia();
//                }
        $juzgadosController = new JuzgadosController();
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setActivo("S");
        $juzgadosDto->setCveAdscripcion($ExhortosDto->getCveJuzgado());
        $listaJuzgados = $juzgadosController->selectJuzgados($juzgadosDto);
        $cveJuzgados = "";
        if ($listaJuzgados != "") {
            foreach ($listaJuzgados as $juz) {
                $cveJuzgados.=$juz->getCveJuzgado() . ",";
            }
        }
        if ($cveJuzgados != "") {
            $cveJuzgados = trim($cveJuzgados, ",");
        }
        $ExhortosDto->setCveJuzgado($cveJuzgados);
        $rangoFechas = json_decode($ExhortosDto->getPartes());
        $fechaInicial = $rangoFechas->fechaInicioConsulta;
        $fechaFinal = $rangoFechas->fechaFinConsulta;
        $entreFecha = "";
        if ($fechaInicial != "" && $fechaFinal != "") {
            $fechaInicial = explode("/", $fechaInicial);
            $fechaInicial = $fechaInicial[2] . "-" . $fechaInicial[1] . "-" . $fechaInicial[0];
            $fechaFinal = explode("/", $fechaFinal);
            $fechaFinal = $fechaFinal[2] . "-" . $fechaFinal[1] . "-" . $fechaFinal[0];
            $entreFecha = " AND fechaRegistro >= '$fechaInicial 00:00:00' AND fechaRegistro <= '$fechaFinal 23:59:59'";
        }
        $ExhortosDao = new ExhortosDAO();
        error_log(print_r($ExhortosDto, true));
        $totalRegistros = $ExhortosDao->selectExhortos($ExhortosDto, $entreFecha, $proveedor);

        /* NUMERO DE REGISTROS POR PAGINA */
        $tamanoPagina = $ExhortosDto->getNumeroRegistros();
        $paginaActual = $ExhortosDto->getPagina();
        $pagina = $paginaActual;
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $tamanoPagina;
        }
        $totalPaginas = ceil(count($totalRegistros) / $tamanoPagina);

        /* LIMITE DE PAGINACION */
        $limit = " ORDER BY idExhorto DESC LIMIT " . $inicio . "," . $tamanoPagina;
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $entreFecha . $limit, $proveedor);

        $resultado = array();
        if ($ExhortosDto != "") {
            $mensaje = array("estatus" => "ok", "mensaje" => "SI EXISTEN DATOS");
            foreach ($ExhortosDto as $ExhortoDto) {
                $partes = array();
                $juzgado = array();
                $juzgadoProcedencia = array();
                $estadoProcedencia = array();
                $juicioExhorto = array();
                $imagenes = array();

                /* OBTIENE JUZGADOS */
                $juzgadosDto = new JuzgadosDTO();
                $juzgadosDto->setCveJuzgado($ExhortoDto->getCveJuzgado());
                $juzgadosDao = new JuzgadosDAO();
                $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);

                /* OBTIENE JUZGADOS PROCEDENCIA */
                $juzgadosPDto = new JuzgadosDTO();
                $juzgadosPDto->setCveJuzgado($ExhortoDto->getCveJuzgadoProcedencia());
                $juzgadosPDao = new JuzgadosDAO();
                $juzgadosPDto = $juzgadosPDao->selectJuzgados($juzgadosPDto, "", $proveedor);

                /* OBTIENE ESTADOS PROCEDENCIA */
                $estadosDto = new EstadosDTO();
                $estadosDto->setCveEstado($ExhortoDto->getCveEstadoProcedencia());
                $estadosDao = new EstadosDAO();
                $estadosDto = $estadosDao->selectEstados($estadosDto, "", "", $proveedor);


                /* OBTIENE JUICIO */
                $JuiciosExhortosDto = new JuiciosExhortosDTO();
                $JuiciosExhortosDto->setIdExhorto($ExhortoDto->getIdExhorto());
                $JuiciosExhortosDto->setActivo("S");
                $JuiciosExhortosDao = new JuiciosExhortosDAO();
                $JuiciosExhortosDto = $JuiciosExhortosDao->selectJuiciosExhortos($JuiciosExhortosDto, "", "", $proveedor);

                /* OBTIENE PARTES */
                $partesDto = new PartesDTO();
                $partesDto->setIdExhorto($ExhortoDto->getIdExhorto());
                $partesDto->setActivo("S");
                $partesDao = new PartesDAO();
                $partesDto = $partesDao->selectPartes($partesDto, "", $proveedor);

                //obtencion de la ruta de los archivos digitalizados adjuntos
                $DocumentosimgDTO = new DocumentosimgDTO();
                $DocumentosimgDAO = new DocumentosimgDAO();
                $DocumentosimgDTO->setIdExhorto( $ExhortoDto->getIdExhorto() );
                $DocumentosimgDTO->setActivo( 'S' );
                $DocumentosimgDTO = $DocumentosimgDAO->selectDocumentosimg( $DocumentosimgDTO );
                //error_log(json_encode($DocumentosimgDTO));
                if( $DocumentosimgDTO != '' ){
                    $ImagenesDTO = new ImagenesDTO();
                    $ImagenesDAO = new ImagenesDAO();
                    $ImagenesDTO->setActivo('S');
                    $ImagenesDTO->setAdjunto('S');
                    $ImagenesDTO->setIdDocumentoImg( $DocumentosimgDTO[0]->getIdDocumentoImg() );
                    $ImagenesDTO = $ImagenesDAO->selectImagenes( $ImagenesDTO );
                    if( $ImagenesDTO != '' ){
                        foreach ($ImagenesDTO as $Imagenes) {
                            $size = filesize( $Imagenes->getRuta() );
                            $rutaArchivo = explode('/', $Imagenes->getRuta() );
                            $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];
                            $imagenes[] = array('ruta' => utf8_encode( substr($Imagenes->getRuta(), 9) ),
                                'nombreArchivo' => utf8_encode( $nombreArchivo ),
                                'idImagen' => utf8_encode( $Imagenes->getIdImagen() ),
                                'tamano' => $size ) ;
                        }
                    }
                }

                if ($juzgadosDto != "") {
                    foreach ($juzgadosDto as $juzgadoDto) {
                        $juzgado[] = array("cveJuzgado" => utf8_encode($juzgadoDto->getCveJuzgado()),
                            "desJuzgado" => utf8_encode($juzgadoDto->getDesJuzgado()));
                    }
                }
                if ($juzgadosPDto != "") {
                    foreach ($juzgadosPDto as $juzgadoPDto) {
                        $juzgadoProcedencia[] = array("cveJuzgado" => utf8_encode($juzgadoPDto->getCveJuzgado()),
                            "desJuzgado" => utf8_encode($juzgadoPDto->getDesJuzgado()));
                    }
                }
                if ($estadosDto != "") {
                    foreach ($estadosDto as $estadoDto) {
                        $estadoProcedencia[] = array("cveEstado" => utf8_encode($estadoDto->getCveEstado()),
                            "desEstado" => utf8_encode($estadoDto->getDesEstado()));
                    }
                }
                if ($JuiciosExhortosDto != "") {
                    foreach ($JuiciosExhortosDto as $JuicioExhortoDto) {
                        $juicioExhorto[] = array("idJuicioexhorto" => utf8_encode($JuicioExhortoDto->getIdJuicioexhorto()),
                            "idExhorto" => utf8_encode($JuicioExhortoDto->getIdExhorto()),
                            "idExhortoGenerado" => utf8_encode($JuicioExhortoDto->getIdExhortoGenerado()),
                            "cveJuicio" => utf8_encode($JuicioExhortoDto->getCveJuicio()),
                            "otroJuicio" => utf8_encode($JuicioExhortoDto->getOtroJuicio()));
                    }
                }
                if ($partesDto != "") {
                    foreach ($partesDto as $parteDto) {
                        $tipospartes = array();
                        $tipospersonas = array();

                        /* OBTIENE TIPOS PARTES */
                        $tiposPartesDto = new TiposPartesDTO();
                        $tiposPartesDto->setCveTipoParte($parteDto->getCveTipoParte());
                        $tiposPartesDao = new TiposPartesDAO();
                        $tiposPartesDto = $tiposPartesDao->selectTiposPartes($tiposPartesDto, "", "", $proveedor);

                        /* OBTIENE TIPOS PERSONAS */
                        $tiposPersonasDto = new TiposPersonasDTO();
                        $tiposPersonasDto->setCveTipoPersona($parteDto->getCveTipoPersona());
                        $tiposPersonasDao = new TiposPersonasDAO();
                        $tiposPersonasDto = $tiposPersonasDao->selectTiposPersonas($tiposPersonasDto, "", "", $proveedor);

                        if ($tiposPartesDto != "") {
                            foreach ($tiposPartesDto as $tipoParteDto) {
                                $tipospartes[] = array("cveTipoParte" => utf8_encode($tipoParteDto->getCveTipoParte()),
                                    "descTipoParte" => utf8_encode($tipoParteDto->getDescTipoParte()));
                            }
                        }

                        if ($tiposPersonasDto != "") {
                            foreach ($tiposPersonasDto as $tipoPersonaDto) {
                                $tipospersonas[] = array("cveTipoPersona" => utf8_encode($tipoPersonaDto->getCveTipoPersona()),
                                    "desTipoPersona" => utf8_encode($tipoPersonaDto->getDesTipoPersona()));
                            }
                        }

                        $partes[] = array("idParte" => utf8_encode($parteDto->getIdParte()),
                            "idExhorto" => utf8_encode($parteDto->getIdExhorto()),
                            "idExhortoGenerado" => utf8_encode($parteDto->getIdExhortoGenerado()),
                            "nombre" => utf8_encode($parteDto->getNombre()),
                            "paterno" => utf8_encode($parteDto->getPaterno()),
                            "materno" => utf8_encode($parteDto->getMaterno()),
                            "nombrePersonaMoral" => utf8_encode($parteDto->getNombrePersonaMoral()),
                            "cveTipoPersona" => $tipospersonas,
                            "cveTipoParte" => $tipospartes,
                            "edad" => utf8_encode($parteDto->getEdad()),
                            "fechaNacimiento" => utf8_encode($parteDto->getFechaNacimiento()),
                            "rfc" => utf8_encode($parteDto->getRFC()),
                            "curp" => utf8_encode($parteDto->getCURP()),
                            "cveEstado" => utf8_encode($parteDto->getCveEstado()),
                            "cveMunicipio" => utf8_encode($parteDto->getCveMunicipio()),
                            "domicilio" => utf8_encode($parteDto->getDomicilio()),
                            "telefono" => utf8_encode($parteDto->getTelefono()),
                            "email" => utf8_encode($parteDto->getEmail()),
                            "cveGenero" => utf8_encode($parteDto->getCveGenero()),
                            "detenido" => utf8_encode($parteDto->getDetenido()));
                    }
                }
                $fechaRegistro = $ExhortoDto->getFechaRegistro();
                $fechaRegistro = explode(" ", $fechaRegistro);
                $fechaRegistro = $fechaRegistro[0];
                $fechaRegistro = explode("-", $fechaRegistro);
                $fechaRegistro = $fechaRegistro[2] . "-" . $fechaRegistro[1] . "-" . $fechaRegistro[0];
                $oficio = explode("/", $ExhortoDto->getNumOficio());
                $oficioNumero = $oficio[0];
                $oficioAnio = $oficio[1];
                $resultado["datos"][] = array("idExhorto" => utf8_encode($ExhortoDto->getIdExhorto()),
                    "idExhortoGenerado" => utf8_encode($ExhortoDto->getIdExhortoGenerado()),
                    "numExhorto" => utf8_encode($ExhortoDto->getNumExhorto()),
                    "aniExhorto" => utf8_encode($ExhortoDto->getAniExhorto()),
                    "numeroExp" => utf8_encode($ExhortoDto->getNumeroExp()),
                    "anioExp" => utf8_encode($ExhortoDto->getAnioExp()),
                    "cveJuzgado" => $juzgado,
                    "cveJuzgadoProcedencia" => $juzgadoProcedencia,
                    "juzgadoProcedencia" => utf8_encode($ExhortoDto->getJuzgadoProcedencia()),
                    "cveEstadoProcedencia" => $estadoProcedencia,
                    "carpetaInv" => utf8_encode($ExhortoDto->getCarpetaInv()),
                    "nuc" => utf8_encode($ExhortoDto->getNuc()),
                    "cveMateria" => utf8_encode($ExhortoDto->getCveMateria()),
                    "cveJuicio" => $juicioExhorto,
                    "cveCuantia" => utf8_encode($ExhortoDto->getCveCuantia()),
                    "noFojas" => utf8_encode($ExhortoDto->getNoFojas()),
                    "numOficio" => $oficioNumero,
                    "anioOficio" => $oficioAnio,
                    "sintesis" => utf8_encode($ExhortoDto->getSintesis()),
                    "observaciones" => utf8_encode($ExhortoDto->getObservaciones()),
                    "cveConsignacion" => utf8_encode($ExhortoDto->getCveConsignacion()),
                    "cveEstatusExhorto" => utf8_encode($ExhortoDto->getCveEstatusExhorto()),
                    "cveEstadoDestino" => utf8_encode($ExhortoDto->getCveEstadoDestino()),
                    "fechaRegistro" => $fechaRegistro,
                    "partes" => $partes,
                    "pagina" => $pagina,
                    "totalPaginas" => $totalPaginas,
                    "adjuntos" => $imagenes
                );
            }
        } else {
            $mensaje = array("estatus" => "error", "mensaje" => "NO EXISTEN DATOS CON ESTOS PARAMETROS DE BUSQUEDA");
        }
        $return = array_merge($mensaje, $resultado);
        return json_encode($return);
    }

    public function insertExhortos($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->insertExhortos($ExhortosDto, $proveedor);
        return $ExhortosDto;
    }

    public function insertExhortosPartes($ExhortosDto, $proveedor = null, $webServices = 0) {
        $proveedor = new Proveedor("mysql", "exhortos");
        $proveedor->connect();
        $proveedor->execute("BEGIN");




        /* VALIDA LOS CAMPOS */
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $validaCampos = $this->validaCamposExhorto($ExhortosDto);
        $mensaje = [];
        if ($validaCampos["status"] == "error") {
            $proveedor->execute("ROLLBACK");
            $proveedor->close();
            exit(json_encode($validaCampos));
        }

        /* OBTIENE EL JUZGADO EXHORTADO */
        $params["cveMateria"] = $ExhortosDto->getCveMateria();
        $params["cveCuantia"] = $ExhortosDto->getCveCuantia();
        $cveJuicio = $ExhortosDto->getCveJuicio();
        if ($webServices == 1) {
            $otroJuicio = $ExhortosDto->getCveJuicio();
            $otroJuicio = explode("|", $otroJuicio);
            $cveJuicio = $otroJuicio[0];
            $otroJuicio = $otroJuicio[1];
        } else {
            $otroJuicio = "";
        }
        $controlesCargas = new ControlescargasController();
        $configuracionesCargasDto = new ConfiguracionescargasDTO();
        $oficialia = "3";
        if ($webServices == 1) {
            $oficialia = $ExhortosDto->getCveOficialia();
        } else {
            $oficialia = $_SESSION["cveAdscripcion"];
        }

        $configuracionesCargasDto->setCveOficialia($oficialia);


        $controlescargasDto = new ControlescargasDTO();
        $controlescargasDto->setAnioControl(date("Y"));
        $controlescargasDto->setCveMateria($ExhortosDto->getCveMateria());
        $juzgadoExhortado = $controlesCargas->getJuzgado($configuracionesCargasDto, $controlescargasDto, $proveedor, $params);
        error_log("Juzgado Exhortado =>" . $juzgadoExhortado);
        if ($juzgadoExhortado <= 0) {
            switch ($juzgadoExhortado) {
                case "0":
                    $mensaje["mensaje"] = "NO EXISTEN JUZGADOS EN HORARIO DISPONIBLE.";
                    break;
                case "-1":
                    $mensaje["mensaje"] = "NO EXISTEN CONFIGURACION PARA LA OFICIALIA.";
                    break;
                case "-2":
                    $mensaje["mensaje"] = "NO SE ENCUENTRA EN HORARIO DE ATENCION.";
                    break;
                case "-3":
                    $mensaje["mensaje"] = "NO EXISTEN JUZGADOS EN HORARIO DISPONIBLE.";
                    break;
                case "-4":
                    $mensaje["mensaje"] = "LA CLAVE DE OFICIALIA LLEGO VACIO O IGUAL A CERO.";
                    break;
            }
            $estatus = array("status" => "error");
            error_log("regreso ");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));

            error_log(print_r($respuesta, true));
            $proveedor->execute("ROLLBACK");
            return (json_encode($respuesta));
        }
        /* OBTIENE EL JUZGADO ASIGNADO */
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setCveJuzgado($juzgadoExhortado);
        $juzgadosDao = new JuzgadosDAO();
        $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, "", $proveedor);
        $juzgadosArray = array("cveJuzgado" => $juzgadosDto[0]->getCveJuzgado(), "desJuzgado" => $juzgadosDto[0]->getDesJuzgado());

        /* OBTIENE EL NUMERO Y ANIO DEL EXHORTO */
        $ContadoresDto = new ContadoresDTO();
        $ContadoresDto->setCveJuzgado($juzgadoExhortado);
        $ContadoresDto->setCveTipoActuacion('null');
        $ContadoresDto->setAnio(date("Y"));

        $ContadoresController = new ContadoresController();
        $respuestaContador = $ContadoresController->getContador($ContadoresDto, $proveedor);

        $partes = $ExhortosDto->getPartes();

        $ExhortosDto->setCveJuzgado($juzgadoExhortado);
        $ExhortosDto->setNumExhorto($respuestaContador[0]->getNumero());
        $ExhortosDto->setAniExhorto($respuestaContador[0]->getAnio());
        if ($partes != "") {
            $ExhortosDao = new ExhortosDAO();
            $ExhortosDto = $ExhortosDao->insertExhortos($ExhortosDto, $proveedor);
            if ($ExhortosDto == "") {
                $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR INSERTAR EL EXHORTO";
                $estatus = array("status" => "error");
                $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                $proveedor->execute("ROLLBACK");
                exit(json_encode($respuesta));
            }

            /* INSERTA EL TIPO DE JUICIO */
            $JuiciosExhortosDto = new JuiciosExhortosDTO();
            $JuiciosExhortosDto->setidExhorto($ExhortosDto[0]->getIdExhorto());
            $JuiciosExhortosDto->setCveJuicio($cveJuicio);
            $JuiciosExhortosDto->setOtroJuicio($otroJuicio);
            $JuiciosExhortosDto->setActivo("S");
            $JuiciosExhortosDao = new JuiciosExhortosDAO();
            $JuiciosExhortosDto = $JuiciosExhortosDao->insertJuiciosExhortos($JuiciosExhortosDto, $proveedor);
            $juiciosExhortosArray = array("cveJuicio" => $JuiciosExhortosDto[0]->getCveJuicio(), "otroJuicio" => $JuiciosExhortosDto[0]->getOtroJuicio());
            foreach ($partes as $value) {
                $decode = json_decode($value, true);
                $partesDto = new PartesDTO();
                $partesDto->setIdExhorto($ExhortosDto[0]->getIdExhorto());
                $partesDto->setCveTipoPersona(utf8_decode($decode["persona"]));
                $partesDto->setCveTipoParte(utf8_decode($decode["tipo"]));

                if ($decode["persona"] == 1) {
                    $partesDto->setCveGenero(utf8_decode($decode["generoFisica"]));
                    /* 	VALIDA EL NOMBRE DE LA PERSONA FISICA */
                    if ($decode["nombreFisica"] == "") {
                        $mensaje["mensaje"] = "El Nombre de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL APELLIDO DE LA PERSONA FISICA */
                    if ($decode["paternoFisica"] == "") {
                        $mensaje["mensaje"] = "El Apellido Paterno de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL APELLIDO MATERNO DE LA PERSONA FISICA */
                    if ($decode["maternoFisica"] == "") {
                        $mensaje["mensaje"] = "El Apellido Materno de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL GENERO DE LA PERSONA FISICA */
                    if ($decode["generoFisica"] == 0 || $decode["generoFisica"] == "") {
                        $mensaje["mensaje"] = "El Genero de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* LLENA EL OBJETO DE LA PERSONA FISICA */
                    $partesDto->setNombre(utf8_decode($decode["nombreFisica"]));
                    $partesDto->setPaterno(utf8_decode($decode["paternoFisica"]));
                    $partesDto->setMaterno(utf8_decode($decode["maternoFisica"]));
                    $partesDto->setEdad(utf8_decode($decode["edadFisica"]));
                    if ($decode["fNacFisica"] != "") {
                        $fechaNacimiento = explode("/", $decode["fNacFisica"]);
                        $fechaNacimiento = $fechaNacimiento[2] . "/" . $fechaNacimiento[1] . "/" . $fechaNacimiento[0];
                        $partesDto->setFechaNacimiento($fechaNacimiento);
                    }
                    $partesDto->setRFC(utf8_decode($decode["rfcFisica"]));
                    $partesDto->setCURP(utf8_decode($decode["curpFisica"]));
                    $partesDto->setDomicilio(utf8_decode($decode["direccionFisica"]));
                    $partesDto->setCveEstado(utf8_decode($decode["estadoFisica"]));
                    $partesDto->setCveMunicipio(utf8_decode($decode["municipioFisica"]));
                    $partesDto->setTelefono(utf8_decode($decode["telefonoFisica"]));
                    $partesDto->setEmail(utf8_decode($decode["mailFisica"]));
                    $partesDto->setDetenido(utf8_decode($decode["detenidoFisica"]));
                } else {
                    $partesDto->setCveGenero(3);
                    /* 	VALIDA EL NOMBRE DE LA PERSONA MORAL */
                    if ($decode["nombreMoral"] == "") {
                        $mensaje["mensaje"] = "El Nombre de la persona moral se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* LLENA EL OBJETO DE LA PERSONA MORAL */
                    $partesDto->setNombrePersonaMoral(utf8_decode($decode["nombreMoral"]));
                    $partesDto->setRFC(utf8_decode($decode["rfcMoral"]));
                    $partesDto->setDomicilio(utf8_decode($decode["direccionMoral"]));
                    $partesDto->setCveEstado(utf8_decode($decode["estadoMoral"]));
                    $partesDto->setCveMunicipio(utf8_decode($decode["municipioMoral"]));
                    $partesDto->setTelefono(utf8_decode($decode["telefonoMoral"]));
                    $partesDto->setEmail(utf8_decode($decode["mailMoral"]));
                    $partesDto->setDetenido(utf8_decode("N"));
                }
                $partesDto->setActivo("S");
                $partesDao = new PartesDAO();
                $partesDto = $partesDao->insertPartes($partesDto, "", $proveedor);
                if ($partesDto == "") {
                    $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR INSERTAR LAS PARTES";
                    $estatus = array("status" => "error");
                    $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                    $proveedor->execute("ROLLBACK");
                    exit(json_encode($respuesta));
                }
            }
        } else {
            $mensaje["mensaje"] = "Debes registrar al menos una parte.";
            $estatus = array("status" => "error");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            exit(json_encode($respuesta));
        }
        $estatus = array("status" => "ok");
        $mensaje = array("mensaje" => "Se inserto correctamente", "idExhorto" => $ExhortosDto[0]->getIdExhorto(), "idContador" => $respuestaContador[0]->getIdContador(), "numero" => $respuestaContador[0]->getNumero(), "anio" => $respuestaContador[0]->getAnio(), "juicioExhorto" => $juiciosExhortosArray, "juzgadoAsignado" => $juzgadosArray);
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
        $proveedor->execute("COMMIT");
        $proveedor->close();
        return json_encode($respuesta);
    }

    public function guardarOficio($ExhortosDto, $proveedor = null) {
        $commit = new Proveedor("mysql", "exhortos");
        $commit->connect();
        $commit->execute("BEGIN");
        /* VALIDA LOS CAMPOS */
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $validaCampos = $this->validaCamposExhortoOficio($ExhortosDto);
        $mensaje = [];
        if ($validaCampos["status"] == "error") {
            exit(json_encode($validaCampos));
        }

        $idExhorto = $ExhortosDto->getIdExhorto();
        $noFojas = $ExhortosDto->getNoFojas();
        $sintesis = $ExhortosDto->getSintesis();
        $observaciones = $ExhortosDto->getObservaciones();
        $estatusExhorto = $ExhortosDto->getCveEstatusExhorto();
        $ExhortosDto->setNoFojas('');
        $ExhortosDto->setSintesis('');
        $ExhortosDto->setObservaciones('');
        $ExhortosDto->setCveEstatusExhorto('');
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);

        /* OBTIENE EL NUMERO Y ANIO DEL EXHORTO */
        $ContadoresDto = new ContadoresDTO();
        $ContadoresDto->setCveJuzgado($ExhortosDto[0]->getCveJuzgado());
        $ContadoresDto->setCveTipoActuacion('null');
        $ContadoresDto->setAnio(date("Y"));

        $ContadoresController = new ContadoresController();
        $respuestaContador = $ContadoresController->getContador($ContadoresDto, $proveedor);
        $numActuacion = $respuestaContador[0]->getNumero();
        $anioActuacion = $respuestaContador[0]->getAnio();

        $cveAdscripcion = $_SESSION["cveAdscripcion"];

        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setCveAdscripcion($cveAdscripcion);
        $juzgadosDao = new JuzgadosDAO();
        $juzgadosDto = $juzgadosDao->selectJuzgados($juzgadosDto, $proveedor);
      
        
        
        
        /* INSERTA EN TABLA ACTUACIONES */
        $actuacionesDto = new ActuacionesDTO();
        $actuacionesDto->setNumActuacion($numActuacion);
        $actuacionesDto->setAniActuacion($anioActuacion);
        $actuacionesDto->setCveTipoActuacion(3);
        $actuacionesDto->setCveTipo(3);
        $actuacionesDto->setCveMateria($ExhortosDto[0]->getCveMateria());
        $actuacionesDto->setCveCuantia($ExhortosDto[0]->getCveCuantia());
        $actuacionesDto->setIdReferencia($ExhortosDto[0]->getIdExhorto());
        $actuacionesDto->setNumeroExp($ExhortosDto[0]->getNumeroExp());
        $actuacionesDto->setAnioExp($ExhortosDto[0]->getAnioExp());
        $actuacionesDto->setCveTipo(1);
        $actuacionesDto->setNoFojas($noFojas);
        $actuacionesDto->setCveJuzgado($juzgadosDto[0]->getCveJuzgado());
        $actuacionesDto->setSintesis($sintesis);
        $actuacionesDto->setObservaciones($observaciones);
        $actuacionesDao = new ActuacionesDAO();
        $actuacionesDto = $actuacionesDao->insertActuaciones($actuacionesDto,  $commit);
        if ($actuacionesDto == "") {
            $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR INSERTAR LA ACTUACION";
            $estatus = array("status" => "error");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            $commit->execute("ROLLBACK");
            exit(json_encode($respuesta));
        }

        /* INSERTA EN TABLA RESPUESTAS EXHORTOS */
        $respuestasExhortosDto = new RespuestasExhortosDTO();
        $respuestasExhortosDto->setIdExhorto($idExhorto);
        $respuestasExhortosDto->setIdActuacion($actuacionesDto[0]->getIdActuacion());
        $respuestasExhortosDto->setCveEstadoDestino($ExhortosDto[0]->getCveEstadoProcedencia());
        $respuestasExhortosDto->setCveEstatusExhortos($estatusExhorto);
        $respuestasExhortosDto->setActivo("S");
        $respuestasExhortosDao = new RespuestasExhortosDAO();
        $respuestasExhortosDto = $respuestasExhortosDao->insertRespuestasExhortos($respuestasExhortosDto,  $commit);
        if ($respuestasExhortosDto == "") {
            $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR INSERTAR LA RESPUESTA EXHORTO";
            $estatus = array("status" => "error");
            error_log($commit->error());
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            $commit->execute("ROLLBACK");
            exit(json_encode($respuesta));
        }

        $estatus = array("status" => "ok");
        $mensaje = array("mensaje" => "Se inserto correctamente", "idActuacion" => $actuacionesDto[0]->getIdActuacion(), "numero" => $respuestaContador[0]->getNumero(), "anio" => $respuestaContador[0]->getAnio());
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
        $commit->execute("COMMIT");
        $commit->close();
        return json_encode($respuesta);
    }

    public function actualizaOficio($ExhortosDto, $proveedor = null) {
        $commit = new Proveedor("mysql", "exhortos");
        $commit->connect();
        $commit->execute("BEGIN");
        /* VALIDA LOS CAMPOS */
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $validaCampos = $this->validaCamposExhortoOficio($ExhortosDto);
        $mensaje = [];
        if ($validaCampos["status"] == "error") {
            exit(json_encode($validaCampos));
        }
        $idExhorto = $ExhortosDto->getIdExhorto();
        $noFojas = $ExhortosDto->getNoFojas();
        $sintesis = $ExhortosDto->getSintesis();
        $observaciones = $ExhortosDto->getObservaciones();
        $estatusExhorto = $ExhortosDto->getCveEstatusExhorto();
        $ExhortosDto->setNoFojas('');
        $ExhortosDto->setSintesis('');
        $ExhortosDto->setObservaciones('');
        $ExhortosDto->setCveEstatusExhorto('');
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->selectExhortos($ExhortosDto, $proveedor);

        /* BUSCA EN TABLA ACTUACIONES */
        $actuacionesDto = new ActuacionesDTO();
        $actuacionesDto->setIdReferencia($ExhortosDto[0]->getIdExhorto());
        $actuacionesDao = new ActuacionesDAO();
        $actuacionesDto = $actuacionesDao->selectActuaciones($actuacionesDto, $proveedor);

        /* ACTUALIZA EN TABLA ACTUACIONES */
        $actuacionesActualizaDto = new ActuacionesDTO();
        $actuacionesActualizaDto->setIdActuacion($actuacionesDto[0]->getIdActuacion());
        $actuacionesActualizaDto->setNoFojas($noFojas);
        $actuacionesActualizaDto->setSintesis($sintesis);
        $actuacionesActualizaDto->setObservaciones($observaciones);
        $actuacionesActualizaDao = new ActuacionesDAO();
        $actuacionesActualizaDto = $actuacionesActualizaDao->updateActuaciones($actuacionesActualizaDto, "", "", $commit);
        if ($actuacionesActualizaDto == "") {
            $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR ACTUALIZAR LA ACTUACION";
            $estatus = array("status" => "error");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            $commit->execute("ROLLBACK");
            exit(json_encode($respuesta));
        }

        /* INSERTA EN TABLA RESPUESTAS EXHORTOS */
        $respuestasExhortosDto = new RespuestasExhortosDTO();
        $respuestasExhortosDto->setIdActuacion($actuacionesDto[0]->getIdActuacion());
        $respuestasExhortosDao = new RespuestasExhortosDAO();
        $respuestasExhortosDto = $respuestasExhortosDao->selectRespuestasExhortos($respuestasExhortosDto, $proveedor);

        /* ACTUALIZA EN TABLA RESPUESTAS EXHORTOS */
        $respuestasExhortosActualizaDto = new RespuestasExhortosDTO();
        $respuestasExhortosActualizaDto->setIdRespuestaExhorto($respuestasExhortosDto[0]->getIdRespuestaExhorto());
        $respuestasExhortosActualizaDto->setCveEstatusExhortos($estatusExhorto);
        $respuestasExhortosActualizaDao = new RespuestasExhortosDAO();
        $respuestasExhortosActualizaDto = $respuestasExhortosActualizaDao->updateRespuestasExhortos($respuestasExhortosActualizaDto, "", "", $commit);
        if ($respuestasExhortosActualizaDto == "") {
            $mensaje["mensaje"] = "OCURRIO UN ERROR AL INTENTAR ACTUALIZAR LA RESPUESTA DEL EXHORTO";
            $estatus = array("status" => "error");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            $commit->execute("ROLLBACK");
            exit(json_encode($respuesta));
        }

        $estatus = array("status" => "ok");
        $mensaje = array("mensaje" => "Se actualizo correctamente");
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
        $commit->execute("COMMIT");
        $commit->close();
        return json_encode($respuesta);
    }

    public function updateExhortos($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
//$tmpDto = new ExhortosDTO();
//$tmpDto = $ExhortosDao->selectExhortos($ExhortosDto,$proveedor);
//if($tmpDto!=""){//$ExhortosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ExhortosDto = $ExhortosDao->updateExhortos($ExhortosDto, $proveedor);
        return $ExhortosDto;
//}
//return "";
    }

    public function updateExhortosPartes($ExhortosDto, $proveedor = null) {
        $proveedor = new Proveedor("mysql", "exhortos");
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        /* VALIDA LOS CAMPOS */
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $validaCampos = $this->validaCamposExhorto($ExhortosDto);
        $mensaje = [];
        if ($validaCampos["status"] == "error") {
            exit(json_encode($validaCampos));
        }
        $cveJuicio = $ExhortosDto->getCveJuicio();
        $partes = $ExhortosDto->getPartes();

        if ($partes != "") {
            $ExhortosDao = new ExhortosDAO();
            $ExhortosDto = $ExhortosDao->updateExhortos($ExhortosDto, $proveedor);
            /* INSERTA EL TIPO DE JUICIO */
            $JuiciosExhortosDto = new JuiciosExhortosDTO();
            $JuiciosExhortosDto->setidExhorto($ExhortosDto[0]->getIdExhorto());
            $JuiciosExhortosDto->setCveJuicio($cveJuicio);
            $JuiciosExhortosDto->setActivo("S");
            $JuiciosExhortosDao = new JuiciosExhortosDAO();
            $JuiciosExhortosDtoRes = $JuiciosExhortosDao->selectJuiciosExhortos($JuiciosExhortosDto, "", "", $proveedor);

            $JuiciosExhortosDto = new JuiciosExhortosDTO();
            $JuiciosExhortosDto->setIdJuicioexhorto($JuiciosExhortosDtoRes[0]->getIdJuicioexhorto());
            $JuiciosExhortosDto->setCveJuicio($cveJuicio);
            $JuiciosExhortosDto->setActivo("S");

            $JuiciosExhortosDao = new JuiciosExhortosDAO();
            $JuiciosExhortosDto = $JuiciosExhortosDao->updateJuiciosExhortos($JuiciosExhortosDto, "", "", $proveedor);

            $partesDto = new PartesDTO();
            $partesDto->setIdExhorto($ExhortosDto[0]->getIdExhorto());
            $partesDto->setActivo("S");

            $partesDao = new PartesDAO();
            $partesDto = $partesDao->selectPartes($partesDto, "", $proveedor);

            if ($partesDto != "") {
                foreach ($partesDto as $parteDto) {
                    $partesDto = new PartesDTO();
                    $partesDto->setIdParte($parteDto->getIdParte());
                    $partesDto->setActivo("N");
                    $partesDao = new PartesDAO();
                    $partesDto = $partesDao->updatePartes($partesDto, "", $proveedor);
                }
            }
            $partes = array_filter($partes, "strlen");
            foreach ($partes as $value) {
                $decode = json_decode($value, true);
                $partesDto = new PartesDTO();
                $idParte = $decode["idParte"];
                $partesDto->setIdExhorto($ExhortosDto[0]->getIdExhorto());
                $partesDto->setCveTipoPersona(utf8_decode($decode["persona"]));
                $partesDto->setCveTipoParte(utf8_decode($decode["tipo"]));
                if ($decode["persona"] == 1) {
                    $partesDto->setCveGenero(utf8_decode($decode["generoFisica"]));

                    /* 	VALIDA EL NOMBRE DE LA PERSONA FISICA */
                    if ($decode["nombreFisica"] == "") {
                        $mensaje["mensaje"] = "El Nombre de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL APELLIDO DE LA PERSONA FISICA */
                    if ($decode["paternoFisica"] == "") {
                        $mensaje["mensaje"] = "El Apellido Paterno de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL APELLIDO MATERNO DE LA PERSONA FISICA */
                    if ($decode["maternoFisica"] == "") {
                        $mensaje["mensaje"] = "El Apellido Materno de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* 	VALIDA EL GENERO DE LA PERSONA FISICA */
                    if ($decode["generoFisica"] == 0 || $decode["generoFisica"] == "") {
                        $mensaje["mensaje"] = "El Genero de la persona fisica se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* LLENA EL OBJETO DE LA PERSONA FISICA */
                    $partesDto->setNombre(utf8_decode($decode["nombreFisica"]));
                    $partesDto->setPaterno(utf8_decode($decode["paternoFisica"]));
                    $partesDto->setMaterno(utf8_decode($decode["maternoFisica"]));
                    $partesDto->setEdad(utf8_decode($decode["edadFisica"]));
                    $fechaNacimiento = explode("/", $decode["fNacFisica"]);
                    $fechaNacimiento = $fechaNacimiento[2] . "/" . $fechaNacimiento[1] . "/" . $fechaNacimiento[0];
                    $partesDto->setFechaNacimiento($fechaNacimiento);
                    $partesDto->setRFC(utf8_decode($decode["rfcFisica"]));
                    $partesDto->setCURP(utf8_decode($decode["curpFisica"]));
                    $partesDto->setDomicilio(utf8_decode($decode["direccionFisica"]));
                    $partesDto->setCveEstado(utf8_decode($decode["estadoFisica"]));
                    $partesDto->setCveMunicipio(utf8_decode($decode["municipioFisica"]));
                    $partesDto->setTelefono(utf8_decode($decode["telefonoFisica"]));
                    $partesDto->setEmail(utf8_decode($decode["mailFisica"]));
                    $partesDto->setDetenido(utf8_decode($decode["detenidoFisica"]));
                } else {
                    $partesDto->setCveGenero(3);
                    /* 	VALIDA EL NOMBRE DE LA PERSONA MORAL */
                    if ($decode["nombreMoral"] == "") {
                        $mensaje["mensaje"] = "El Nombre de la persona moral se encuentra vacio";
                        $estatus = array("status" => "error");
                        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
                        $proveedor->execute("ROLLBACK");
                        exit(json_encode($respuesta));
                    }
                    /* LLENA EL OBJETO DE LA PERSONA MORAL */
                    $partesDto->setNombrePersonaMoral(utf8_decode($decode["nombreMoral"]));
                    $partesDto->setRFC(utf8_decode($decode["rfcMoral"]));
                    $partesDto->setDomicilio(utf8_decode($decode["direccionMoral"]));
                    $partesDto->setCveEstado(utf8_decode($decode["estadoMoral"]));
                    $partesDto->setCveMunicipio(utf8_decode($decode["municipioMoral"]));
                    $partesDto->setTelefono(utf8_decode($decode["telefonoMoral"]));
                    $partesDto->setEmail(utf8_decode($decode["mailMoral"]));
                    $partesDto->setDetenido(utf8_decode("N"));
                }
                $partesDto->setActivo("S");
                if ($idParte == 0) {
                    $partesDao = new PartesDAO();
                    $partesDto = $partesDao->insertPartes($partesDto, "", $proveedor);
                } else {
                    $partesDto->setIdParte($decode["idParte"]);
                    $partesDao = new PartesDAO();
                    $partesDto = $partesDao->updatePartes($partesDto, "", $proveedor);
                }
            }
        } else {
            $mensaje["mensaje"] = "Debes registrar al menos una parte.";
            $estatus = array("status" => "error");
            $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
            exit(json_encode($respuesta));
        }
        $estatus = array("status" => "ok");
        $mensaje = array("mensaje" => "Se realizo correctamente la actualización", "idContador" => "", "numero" => $ExhortosDto[0]->getNumExhorto(), "anio" => $ExhortosDto[0]->getAniExhorto());
        $respuesta = array_merge($estatus, array("resultados" => array($mensaje)));
        $proveedor->execute("COMMIT");
        $proveedor->close();
        return json_encode($respuesta);
    }

    public function deleteExhortos($ExhortosDto, $proveedor = null) {
        $ExhortosDto = $this->validarExhortos($ExhortosDto);
        $ExhortosDao = new ExhortosDAO();
        $ExhortosDto = $ExhortosDao->deleteExhortos($ExhortosDto, $proveedor);
        return $ExhortosDto;
    }

}

?>
