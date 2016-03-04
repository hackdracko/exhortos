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
ini_set("error_log", dirname(__FILE__) . "/../../../logs/ActuacionesController.log");
ini_set("log_errors", 1);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/actuaciones/ActuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/actuaciones/ActuacionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/contadores/ContadoresDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/contadores/ContadoresController.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juzgados/JuzgadosController.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
//Exhortos generados
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/exhortosgenerados/ExhortosgeneradosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/exhortosgenerados/ExhortosgeneradosDAO.Class.php");
//Juicios-Exhortos
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juiciosexhortos/JuiciosexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juiciosexhortos/JuiciosexhortosDAO.Class.php");
//Partes
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/partes/PartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/partes/PartesDAO.Class.php");
//Tipo Partes
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospartes/TipospartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipospartes/TipospartesDAO.Class.php");
//Tipo Personas
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipospersonas/TipospersonasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipospersonas/TipospersonasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/tipospersonas/TipospersonasController.Class.php");
//Estados
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estados/EstadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estados/EstadosDAO.Class.php");
//Consiganciones
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/consignaciones/ConsignacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/consignaciones/ConsignacionesDAO.Class.php");
//Estatus Exhortos
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/estatusexhortos/EstatusexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/estatusexhortos/EstatusexhortosDAO.Class.php");
//Tipos
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tipos/TiposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tipos/TiposDAO.Class.php");
//Webservice
include_once(dirname(__FILE__) . "/../../../webservice/cliente/exhortoGeneradoCliente.php");
//promoventes
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/promoventesactuaciones/PromoventesactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/promoventesactuaciones/PromoventesactuacionesDAO.Class.php");
// validacion
include_once(dirname(__FILE__) . "/../../../tribunal/validacion/Validacion.Class.php");
// generos
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/generos/GenerosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/generos/GenerosController.Class.php");
//oficialia
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/oficialia/OficialiaDAO.Class.php");
//municipios
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/municipios/MunicipiosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/municipios/MunicipiosDAO.Class.php");
//Documentosimg
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/documentosimg/DocumentosimgDAO.Class.php");
//Imagenes
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/imagenes/ImagenesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/imagenes/ImagenesDAO.Class.php");

class ActuacionesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarActuaciones($ActuacionesDto) {
        $ActuacionesDto->setidActuacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getidActuacion()))));
        $ActuacionesDto->setnumActuacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getnumActuacion()))));
        $ActuacionesDto->setaniActuacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getaniActuacion()))));
        $ActuacionesDto->setcveTipoActuacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveTipoActuacion()))));
        $ActuacionesDto->setnumeroExp(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getnumeroExp()))));
        $ActuacionesDto->setanioExp(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getanioExp()))));
        $ActuacionesDto->setcveTipo(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveTipo()))));
        $ActuacionesDto->setcarpetaInv(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcarpetaInv()))));
        $ActuacionesDto->setnuc(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getnuc()))));
        $ActuacionesDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveMateria()))));
        $ActuacionesDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveCuantia()))));
        $ActuacionesDto->setnoFojas(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getnoFojas()))));
        $ActuacionesDto->setnumOficio(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getnumOficio()))));
        $ActuacionesDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveJuzgado()))));
        $ActuacionesDto->setsintesis(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getsintesis()))));
        $ActuacionesDto->setobservaciones(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getobservaciones()))));
        $ActuacionesDto->setcveConsignacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveConsignacion()))));
        $ActuacionesDto->setcveJuzgadoDestino(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getcveJuzgadoDestino()))));
        $ActuacionesDto->setjuzgadoDestino(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getjuzgadoDestino()))));
        $ActuacionesDto->setactivo(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getactivo()))));
        $ActuacionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getfechaRegistro()))));
        $ActuacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($ActuacionesDto->getfechaActualizacion()))));
        return $ActuacionesDto;
    }

    public function obtenCveJuzgado( $cveJuzgado ){
        $juzgadosController = new JuzgadosController();
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setActivo("S");
        $juzgadosDto->setCveAdscripcion( $cveJuzgado );
        $juzgados = $juzgadosController->selectJuzgados( $juzgadosDto );
        if ($juzgados != "") {
            $cveJuzgado = $juzgados[0]->getCveJuzgado();
        }
        return $cveJuzgado;
    }

    public function selectActuaciones($ActuacionesDto, $proveedor = null) {

        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDao = new JuzgadosDAO();

        $juzgadosDto->setActivo("S");
        $juzgadosDto->setCveAdscripcion($ActuacionesDto->getCveJuzgado());
        $juzgados = $juzgadosDao->selectJuzgados($juzgadosDto);
        if ($juzgados != "") {
            $ActuacionesDto->setcveJuzgado($juzgados[0]->getCveJuzgado());
        }

        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
        $ActuacionesDto->setCveJuzgado( $this->obtenCveJuzgado( $ActuacionesDto->getCveJuzgado() ) );
        $ActuacionesDto = $ActuacionesDao->selectActuaciones($ActuacionesDto, $proveedor);
        return $ActuacionesDto;
    }

    public function insertActuaciones($ActuacionesDto, $proveedor = null) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
        $ActuacionesDto = $ActuacionesDao->insertActuaciones($ActuacionesDto, $proveedor);
        return $ActuacionesDto;
    }

    public function updateActuaciones($ActuacionesDto, $proveedor = null) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
//$tmpDto = new ActuacionesDTO();
//$tmpDto = $ActuacionesDao->selectActuaciones($ActuacionesDto,$proveedor);
//if($tmpDto!=""){//$ActuacionesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ActuacionesDto = $ActuacionesDao->updateActuaciones($ActuacionesDto, $proveedor);
        return $ActuacionesDto;
//}
//return "";
    }

    public function deleteActuaciones($ActuacionesDto, $proveedor = null) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
        $ActuacionesDto = $ActuacionesDao->deleteActuaciones($ActuacionesDto, $proveedor);
        return $ActuacionesDto;
    }

// ********************** EXHORTO GENERADO ******************
    /**
     * Función global para guardar el exhorto generado
     */
    public function guardarExhortoGenerado($ActuacionesDto, $param, $proveedor = null) {
        $mensaje = "";
        /* Proceso global
         * - Insertar actuacion y obtener Id de esta
         * - Insertar exhorto generado y obtener Id de este
         * - Insertar en juicios exhorto
         * - Insertar partes
         * ** Proceso Actuaciones:
         * Obtener contador de la actuacion
         * definir variables de control
         * Insertar y obtener id de actuacion
         * ** Proceso Exhorto generado
         * El numero y año de la actuacion es el mismo que se insertará en el exhorto generado
         * ** Proceso Juicios Exhorto
         * Insertar Id de exhorto generado y clave de juicio
         * ** Proceso partes
         * Inserción de datos con el Id de exhorto generado
         */
        if ( isset( $_SESSION['cveUsuarioSistema'] ) ) {
            $proveedor = new Proveedor('mysql', 'exhortos');
            $proveedor->connect();
            $proveedor->execute("BEGIN");
            $statusTransaccion = 1;
            $tipoActuacion = 1; //mismo valor de 'exhortos generados' en la tabla 'tblactuaciones'
            $estadoDestino = $param["cveEstadoDestino"];
            $cveOficialia = $param["cveOficialia"];
            $cveAdscripcion = $_SESSION['cveAdscripcion'];
            $cveJuicio = $param["cveJuicio"];
            $desJuicio = $param["desJuicio"];
            $otroJuicio = ( $param["otroJuicio"] != '' ) ? $param["otroJuicio"] : ' ';
            $otroJuicioJson = ( $param["otroJuicio"] != '' ) ? $param["otroJuicio"] : $desJuicio;
            $partes = $param["partes"];
            $enviarExhorto = $param["enviarExhorto"];
            $urlWebserviceEstado = "";
            $cveEstadoProcedencia = 0;
            $estatusExhorto = ( $enviarExhorto == "true" ) ? 6 : 5; //mismo valor de la tabla 'tblexhortosgenerados'
            $personaFisica = 1; //mismo valor de 'tipopersona' en la tabla 'tbltipospersonas'
            //**obtencion del estado de procedencia
            //obtencion de la oficialia a traves de -tbljuzgados-
            $JuzgadosDTO = new JuzgadosDTO();
            $JuzgadosDAO = new JuzgadosDAO();
            $JuzgadosDTO->setCveAdscripcion( $cveAdscripcion );
            $JuzgadosDTO = $JuzgadosDAO->selectJuzgados( $JuzgadosDTO, ' AND cveOficialia>0 LIMIT 1 ' , $proveedor );
            if( $JuzgadosDTO != '' ){
                //obtencion del municipio a través de -tbloficialias-
                $OficialiaDTO = new OficialiaDTO();
                $OficialiaDAO = new OficialiaDAO();
                $OficialiaDTO->setCveOficialia( $JuzgadosDTO[0]->getCveOficialia() );
                $OficialiaDTO = $OficialiaDAO->selectOficialia( $OficialiaDTO,'',$proveedor );
                if( $OficialiaDTO != '' ){
                    //obtencion del estado a través de -tblmunicipios-
                    $MunicipiosDTO = new MunicipiosDTO();
                    $MunicipiosDAO = new MunicipiosDAO();
                    $MunicipiosDTO->setCveMunicipio( $OficialiaDTO[0]->getCveMunicipio() );
                    $MunicipiosDTO = $MunicipiosDAO->selectMunicipios( $MunicipiosDTO,'',$proveedor );
                    if( $MunicipiosDTO != '' ){
                        $cveEstadoProcedencia = $MunicipiosDTO[0]->getCveEstado();
                    }
                }
            }
            if( $cveEstadoProcedencia == 0){
                $statusTransaccion = 0;
                $mensaje = "Error en la obtenci&oacute;n del Estado de Prodecencia.";
            }
            //*** Proceso Actuaciones
            $ActuacionesDto->setCveTipoActuacion($tipoActuacion);
            $cveTipoActuacion = $ActuacionesDto->getCveTipoActuacion();
            //definiciOn de variables para obtener los valores del contador
            $ActuacionesDto->setCveJuzgado( $this->obtenCveJuzgado( $cveAdscripcion ) );
            $cveJuzgado = $ActuacionesDto->getCveJuzgado();
            //obtenciOn de nUmero de la tabla contadores
            $numActuacion = $this->obtenerContadorActuacion($cveJuzgado, $cveTipoActuacion, $proveedor);
            $numActuacion = $numActuacion[0]->getNumero();
            //asignaciOn de variables en el DTO de las actuaciones
            $ActuacionesDto->setNumActuacion($numActuacion);
            $anioTmp = explode(' ', $proveedor->getfechaActual());
            $anioTmp = explode('-', $anioTmp[0]);
            $ActuacionesDto->setAniActuacion($anioTmp[0]);
            //paso a mayusculas
            $ActuacionesDto->setCarpetaInv(strtoupper(utf8_decode($ActuacionesDto->getCarpetaInv())));
            $ActuacionesDto->setNuc(strtoupper(utf8_decode($ActuacionesDto->getNuc())));
            $ActuacionesDto->setSintesis(strtoupper(utf8_decode($ActuacionesDto->getSintesis())));
            $ActuacionesDto->setObservaciones(strtoupper(utf8_decode($ActuacionesDto->getObservaciones())));
            $ActuacionesDto->setActivo('S');
            //asignacion de los valores para el exhorto generado
            $datosExhorto["numeroExp"] = utf8_decode($ActuacionesDto->getNumeroExp());
            $datosExhorto["anioExp"] = utf8_decode($ActuacionesDto->getAnioExp());
            $datosExhorto["cveEstadoProcedencia"] = utf8_decode($cveEstadoProcedencia);
            $datosExhorto["juzgadoProcedencia"] = utf8_decode($_SESSION['desAdscripcion']);
            $datosExhorto["carpetaInv"] = utf8_decode($ActuacionesDto->getCarpetaInv());
            $datosExhorto["nuc"] = utf8_decode($ActuacionesDto->getNuc());
            $datosExhorto["cveMateria"] = utf8_decode($ActuacionesDto->getCveMateria());
            $datosExhorto["cveJuicio"] = utf8_decode($cveJuicio);
            $datosExhorto["otroJuicio"] = utf8_decode($otroJuicioJson);
            $datosExhorto["cveCuantia"] = utf8_decode($ActuacionesDto->getCveCuantia());
            $datosExhorto["noFojas"] = utf8_decode($ActuacionesDto->getNoFojas());
            $datosExhorto["numOficio"] = utf8_decode($ActuacionesDto->getNumOficio());
            $datosExhorto["sintesis"] = utf8_decode($ActuacionesDto->getSintesis());
            $datosExhorto["observaciones"] = utf8_decode($ActuacionesDto->getObservaciones());
            $datosExhorto["cveConsignacion"] = utf8_decode($ActuacionesDto->getCveConsignacion());
            $datosExhorto["cveEstadoDestino"] = utf8_decode($estadoDestino);
            $datosExhorto["cveOficialia"] = utf8_decode($cveOficialia);
            //inserciOn de la ActuaciOn
            $ActuacionesDto = $this->insertActuaciones($ActuacionesDto, $proveedor);
            //*** Proceso Actuaciones/
            //validacion de datos de inserción en el DTO de $ActuacionesDto
            if ($ActuacionesDto != '') { //trae los datos del registro recien insertado
                $idActuacion = $ActuacionesDto[0]->getIdActuacion();
                //*** Proceso Exhorto generado
                $ExhortosgeneradosDAO = new ExhortosgeneradosDAO();
                $ExhortosgeneradosDTO = new ExhortosgeneradosDTO();
                $ExhortosgeneradosDTO->setIdActuacion($idActuacion);
                $ExhortosgeneradosDTO->setCveEstatusExhorto($estatusExhorto);
                $ExhortosgeneradosDTO->setCveEstadoDestino($estadoDestino);
                $ExhortosgeneradosDTO->setCveOficialia($cveOficialia);
                $ExhortosgeneradosDTO->setActivo('S');
                $ExhortosgeneradosDTO = $ExhortosgeneradosDAO->insertExhortosgenerados($ExhortosgeneradosDTO,$proveedor);
                //*** Proceso Exhorto generado/
                //validacion de datos de insercion en el DTO de $ExhortosgeneradosDTO
                if ($ExhortosgeneradosDTO != '') { //trae los datos del registro recien insertado
                    $idExhortoGenerado = $ExhortosgeneradosDTO[0]->getIdExhortoGenerado();
                    $datosExhorto["idExhortoGenerado"] = $idExhortoGenerado;
                    //*** Proceso Juicios Exhorto
                    $JuiciosexhortosDAO = new JuiciosexhortosDAO();
                    $JuiciosexhortosDTO = new JuiciosexhortosDTO();
                    $JuiciosexhortosDTO->setIdExhortoGenerado($idExhortoGenerado);
                    $JuiciosexhortosDTO->setCveJuicio($cveJuicio);
                    $JuiciosexhortosDTO->setOtroJuicio($otroJuicio);
                    $JuiciosexhortosDTO->setActivo('S');
                    $JuiciosexhortosDTO = $JuiciosexhortosDAO->insertJuiciosexhortos($JuiciosexhortosDTO,$proveedor);
                    //*** Proceso Juicios Exhorto/
                    //validacion de datos de insercion en el DTO de $JuiciosexhortosDTO
                    if ($JuiciosexhortosDTO != '') { //trae los datos del registro recien insertado
                        //*** Proceso partes
                        //$c = ''; xxx
                        $contadorPartes = 0;
                        foreach ($partes as $parte) {
                            $PartesDAO = new PartesDAO();
                            $PartesDTO = new PartesDTO();
                            if ($parte['cveTipoPersona'] == $personaFisica) {
                                $parte['nombrePersonaMoral'] = '';
                            } else {
                                $parte['nombre'] = '';
                                $parte['paterno'] = '';
                                $parte['materno'] = '';
                                $parte['edad'] = '';
                                $parte['fechaNacimiento'] = '';
                                $parte['CURP'] = '';
                            }
                            $fechaNacimiento = ( $parte['fechaNacimiento'] != '' ) ? explode('/', $parte['fechaNacimiento']) : '00/00/0000';
                            $fechaNacimiento = $fechaNacimiento[2] . '-' . $fechaNacimiento[1] . '-' . $fechaNacimiento[0];
                            $PartesDTO->setIdExhortoGenerado($idExhortoGenerado);
                            $PartesDTO->setNombre(utf8_decode(strtoupper($parte['nombre'])));
                            $PartesDTO->setPaterno(utf8_decode(strtoupper($parte['paterno'])));
                            $PartesDTO->setMaterno(utf8_decode(strtoupper($parte['materno'])));
                            $PartesDTO->setNombrePersonaMoral(utf8_decode(strtoupper($parte['nombrePersonaMoral'])));
                            $PartesDTO->setCveTipoPersona($parte['cveTipoPersona']);
                            $PartesDTO->setCveTipoParte($parte['cveTipoParte']);
                            $PartesDTO->setEdad($parte['edad']);
                            $PartesDTO->setFechaNacimiento(utf8_decode($fechaNacimiento));
                            $PartesDTO->setRFC(strtoupper($parte['RFC']));
                            $PartesDTO->setCURP(strtoupper($parte['CURP']));
                            $PartesDTO->setCveEstado($parte['cveEstado']);
                            $PartesDTO->setCveMunicipio($parte['cveMunicipio']);
                            $PartesDTO->setDomicilio(strtoupper($parte['domicilio']));
                            $PartesDTO->setTelefono($parte['telefono']);
                            $PartesDTO->setEmail($parte['email']);
                            $PartesDTO->setCveGenero($parte['cveGenero']);
                            $PartesDTO->setDetenido($parte['detenido']);
                            $PartesDTO->setActivo('S');
                            $PartesDTO = $PartesDAO->insertPartes( $PartesDTO,$proveedor );
                            //validacion de datos de insercion en el DTO de $PartesDTO
                            if ($PartesDTO != '') { //trae los datos del registro recien insertado
                                //insercion en bitacora
                            } else {
                                $statusTransaccion = 0;
                            }
                        }
                    } else {
                        //no se insertó en jucio-exhorto
                        $statusTransaccion = 0;
                        $mensaje = 'NO SE INSERT&Oacute; EN JUICIO-EXHORTO. ';
                    }
                } else {
                    // no se insertó el exhorto generado
                    $statusTransaccion = 0;
                    $mensaje = 'NO SE INSERT&Oacute; EL EXHORTO GENERADO. ';
                }
            } else {
                $mensaje = "NO SE INSERT&Oacute; LA ACTUACI&Oacute;N. ";
                $statusTransaccion = 0;
            }
            if ($statusTransaccion == 1) {
                $proveedor->execute("COMMIT");
                $proveedor->close();
                if($enviarExhorto == "true"){
                    $dtoToJson = new DtoToJson($ActuacionesDTOFinal);
                    return $dtoToJson->toJson("EXHORTO GUARDADO Y ENVIADO CORRECTAMENTE."); //$json;
                }else{
                    $dtoToJson = new DtoToJson($ActuacionesDto);
                    return $dtoToJson->toJson("EXHORTO GUARDADO CORRECTAMENTE."); //$json;
                }
                //return $ActuacionesDto; //$json;
            } else if ($statusTransaccion == 0) {
                $proveedor->execute("ROLLBACK");
                $proveedor->close();
                $error = json_encode( array('totalCount'=>'0' , 'text' => utf8_decode($mensaje)) );
                return $error;
            }
        }else{
            return json_encode( array('totalCount'=>'0' , 'text' => utf8_decode( "NO EXISTE UNA SESI&Oacute;N ACTIVA. INGRESE NUEVAMENTE." )) );
        }        
    }

    /**
     * Función global para actualizar el exhorto generado
     */
    public function actualizarExhortoGenerado($ActuacionesDto, $param, $proveedor = null) {
        /* Proceso global
         * - Actualiza la actuacion 
         * - Actualizar exhorto generado
         * - Actualizar en juicios exhorto
         * - Actualizar partes
         * ** Proceso Actuaciones:
         * Actualizar datos de Actuación
         * ** Proceso Exhorto generado
         * Obtener id de exhorto generado
         * ** Proceso Juicios Exhorto
         * Actualizar cveJuicio
         * ** Proceso partes
         * Actualización/Inserción de datos con el Id de exhorto generado
         * Busqueda y guardado en array temporal los regitros con el mismo ID de exhorto generado, desactivar tales registros y actualizar/insertar-
         * los nuevos registros de acuerdo al numero de regitros en el array temporal
         */
        if ( isset( $_SESSION['cveUsuarioSistema'] ) ) {
            $proveedor = new Proveedor('mysql', 'exhortos');
            $proveedor->connect();
            $proveedor->execute("BEGIN");
            $statusTransaccion = 1;
            $mensaje = '';
            $estadoDestino = $param["cveEstadoDestino"];
            $cveOficialia = $param['cveOficialia'];
            $cveAdscripcion = $_SESSION['cveAdscripcion'];
            $cveJuicio = $param["cveJuicio"];
            $desJuicio = $param["desJuicio"];
            $otroJuicio = ( $param["otroJuicio"] != '' ) ? $param["otroJuicio"] : ' ';
            $otroJuicioJson = ( $param["otroJuicio"] != '' ) ? $param["otroJuicio"] : $desJuicio;
            $partes = $param["partes"];
            $enviarExhorto = $param["enviarExhorto"];
            $urlWebserviceEstado = "";
            $estatusExhorto = 5; //mismo valor de 'enviado' en la tabla 'tblexhortosgenerados'
            //estructura de json para webservice
            $respuestaWS = '';
            $jsonWebservice = [ "exhorto" => array()];
            $datosExhorto = [ "idExhortoGenerado" => "", "numeroExp" => "", "anioExp" => "", "cveEstadoProcedencia" => "", "juzgadoProcedencia" => "", "carpetaInv" => "", "nuc" => "", "cveMateria" => "", "cveJuicio" => "", "otroJuicio" => "", "cveCuantia" => "", "noFojas" => "", "numOficio" => "", "sintesis" => "", "observaciones" => "", "cveConsignacion" => "", "cveEstadoDestino" => "", "cveOficialia" => "", "partes" => array(), "documentos" => array()]; 
            $partesWS[] = ["tipo" => "", "persona" => "", "nombreFisica" => "", "paternoFisica" => "", "maternoFisica" => "", "edadFisica" => "", "fNacFisica" => "", "rfcFisica" => "", "curpFisica" => "", "generoFisica" => "", "direccionFisica" => "", "estadoFisica" => "", "municipioFisica" => "", "telefonoFisica" => "", "mailFisica" => "", "detenidoFisica" => "", "nombreMoral" => "", "direccionMoral" => "", "estadoMoral" => "", "municipioMoral" => "", "telefonoMoral" => "", "mailMoral" => "","idParte" => ""];
            if ($enviarExhorto == "true") {
                $estatusExhorto = 6; //valor correspondiente a 'enviado' en la tabla -tblestatusexhortos-
            }
            $personaFisica = 1;
            //**obtencion del estado de procedencia
            //obtencion de la oficialia a traves de -tbljuzgados-
            $JuzgadosDTO = new JuzgadosDTO();
            $JuzgadosDAO = new JuzgadosDAO();
            $JuzgadosDTO->setCveAdscripcion( $cveAdscripcion );
            $JuzgadosDTO = $JuzgadosDAO->selectJuzgados( $JuzgadosDTO, ' AND cveOficialia>0 LIMIT 1 ' , $proveedor );
            if( $JuzgadosDTO != '' ){
                //obtencion del municipio a través de -tbloficialias-
                $OficialiaDTO = new OficialiaDTO();
                $OficialiaDAO = new OficialiaDAO();
                $OficialiaDTO->setCveOficialia( $JuzgadosDTO[0]->getCveOficialia() );
                $OficialiaDTO = $OficialiaDAO->selectOficialia( $OficialiaDTO,'',$proveedor );
                if( $OficialiaDTO != '' ){
                    //obtencion del estado a través de -tblmunicipios-
                    $MunicipiosDTO = new MunicipiosDTO();
                    $MunicipiosDAO = new MunicipiosDAO();
                    $MunicipiosDTO->setCveMunicipio( $OficialiaDTO[0]->getCveMunicipio() );
                    $MunicipiosDTO = $MunicipiosDAO->selectMunicipios( $MunicipiosDTO,'',$proveedor );
                    if( $MunicipiosDTO != '' ){
                        $cveEstadoProcedencia = $MunicipiosDTO[0]->getCveEstado();
                    }
                }
            }
            if( $cveEstadoProcedencia == 0){
                $statusTransaccion = 0;
                $mensaje = "Error en la obtenci&oacute;n del Estado de Prodecencia.";
            }

            //*** Proceso Actuaciones
            $ActuacionesDAO = new ActuacionesDAO();
            //validacion de observaciones, carpeta de investigacion y nuc vacios
            $ActuacionesDto->setObservaciones(( $ActuacionesDto->getObservaciones() != '' ) ? $ActuacionesDto->getObservaciones() : ' ' );
            $ActuacionesDto->setCarpetaInv(( $ActuacionesDto->getCarpetaInv() != '' ) ? $ActuacionesDto->getCarpetaInv() : ' ' );
            $ActuacionesDto->setNuc(( $ActuacionesDto->getNuc() != '' ) ? $ActuacionesDto->getNuc() : ' ' );
            //asignacion de los valores para el exhorto generado
            $datosExhorto["numeroExp"] = $ActuacionesDto->getNumeroExp();
            $datosExhorto["anioExp"] = $ActuacionesDto->getAnioExp();
            $datosExhorto["cveEstadoProcedencia"] = $cveEstadoProcedencia; //cambiar por variable de sesion
            $datosExhorto["juzgadoProcedencia"] = $_SESSION['desAdscripcion'];
            $datosExhorto["carpetaInv"] = $ActuacionesDto->getCarpetaInv();
            $datosExhorto["nuc"] = $ActuacionesDto->getNuc();
            $datosExhorto["cveMateria"] = $ActuacionesDto->getCveMateria();
            $datosExhorto["cveJuicio"] = $cveJuicio;
            $datosExhorto["otroJuicio"] = utf8_decode($otroJuicioJson);
            $datosExhorto["cveCuantia"] = $ActuacionesDto->getCveCuantia();
            $datosExhorto["noFojas"] = $ActuacionesDto->getNoFojas();
            $datosExhorto["numOficio"] = $ActuacionesDto->getNumOficio();
            $datosExhorto["sintesis"] = $ActuacionesDto->getSintesis();
            $datosExhorto["observaciones"] = $ActuacionesDto->getObservaciones();
            $datosExhorto["cveConsignacion"] = $ActuacionesDto->getCveConsignacion();
            $datosExhorto["cveEstadoDestino"] = $estadoDestino;
            $datosExhorto["cveOficialia"] = $cveOficialia;
            //Actualización de la Actuación
            $ActuacionesDto = $ActuacionesDAO->updateActuaciones($ActuacionesDto, $proveedor);
            //*** Proceso Actuaciones/
            //validacion de datos de inserción en el DTO de $ActuacionesDto
            if ($ActuacionesDto != '') { //trae los datos del registro recien insertado
                $idActuacion = $ActuacionesDto[0]->getIdActuacion();
                //*** Proceso Exhorto generado
                $ExhortosgeneradosDAO = new ExhortosgeneradosDAO();
                $ExhortosgeneradosDTO = new ExhortosgeneradosDTO();
                //* Obtener id de exhorto generado
                $ExhortosgeneradosDTO->setIdActuacion($idActuacion);
                $ExhortosgeneradosDTO->setActivo('S');
                $ExhortosgeneradosDTO = $ExhortosgeneradosDAO->selectExhortosgenerados($ExhortosgeneradosDTO,'',$proveedor);
                if ($ExhortosgeneradosDTO != '') {
                    $idExhortoGenerado = $ExhortosgeneradosDTO[0]->getIdExhortoGenerado();
                } else {
                    $idExhortoGenerado = 0;
                }
                $ExhortosgeneradosDAO2 = new ExhortosgeneradosDAO();
                $ExhortosgeneradosDTO2 = new ExhortosgeneradosDTO();
                //cveEstadoDestino - unico campo con posibilidad de actualizacion
                $ExhortosgeneradosDTO2->setIdExhortoGenerado($idExhortoGenerado);
                $ExhortosgeneradosDTO2->setCveEstadoDestino($estadoDestino);
                $ExhortosgeneradosDTO2->setCveOficialia($cveOficialia);
                $ExhortosgeneradosDTO2 = $ExhortosgeneradosDAO2->updateExhortosgenerados($ExhortosgeneradosDTO2,$proveedor);
                //*** Proceso Exhorto generado/
                //validacion de datos de insercion en el DTO de $ExhortosgeneradosDTO
                if ($ExhortosgeneradosDTO != '') { //trae los datos del registro recien actualizado
                    $datosExhorto["idExhortoGenerado"] = $idExhortoGenerado;
                    $idExhortoGenerado = $ExhortosgeneradosDTO[0]->getIdExhortoGenerado();
                    //**Proceso de obtencion de url webservice
                    $EstadosDTO = new EstadosDTO();
                    $EstadosDAO = new EstadosDAO();
                    $EstadosDTO->setCveEstado($ExhortosgeneradosDTO[0]->getCveEstadoDestino());
                    $EstadosDTO->setActivo('S');
                    $EstadosDTO = $EstadosDAO->selectEstados($EstadosDTO,'',$proveedor);
                    if ($EstadosDTO != '') {
                        $urlWebserviceEstado = $EstadosDTO[0]->getUrlWebServices();
                    }
                    //**Proceso de obtencion de url webservice/                
                    //*** Proceso Juicios Exhorto
                    $JuiciosexhortosDAO = new JuiciosexhortosDAO();
                    $JuiciosexhortosDTO = new JuiciosexhortosDTO();
                    //obtener id de juicios-exhorto
                    $JuiciosexhortosDTO->setIdExhortoGenerado($idExhortoGenerado);
                    $JuiciosexhortosDTO->setActivo('S');
                    $JuiciosexhortosDTO = $JuiciosexhortosDAO->selectJuiciosexhortos($JuiciosexhortosDTO,'',$proveedor);
                    if ($JuiciosexhortosDTO != '') {
                        $idJuicioExhorto = $JuiciosexhortosDTO[0]->getIdJuicioExhorto();
                    } else {
                        $idJuicioExhorto = 0;
                    }
                    $JuiciosexhortosDAO2 = new JuiciosexhortosDAO();
                    $JuiciosexhortosDTO2 = new JuiciosexhortosDTO();
                    //cveJuicio - unico campo con posibilidad de actualizacion
                    $JuiciosexhortosDTO2->setIdJuicioexhorto($idJuicioExhorto);
                    $JuiciosexhortosDTO2->setCveJuicio($cveJuicio);
                    $JuiciosexhortosDTO2->setOtroJuicio($otroJuicio);
                    $JuiciosexhortosDTO2 = $JuiciosexhortosDAO2->updateJuiciosexhortos($JuiciosexhortosDTO2,$proveedor);
                    //*** Proceso Juicios Exhorto/
                    //validacion de datos de insercion en el DTO de $JuiciosexhortosDTO
                    if ($JuiciosexhortosDTO2 != '') { //trae los datos del registro recien insertado
                        //*** Proceso partes
                        //*Inactivar todos los registros vinculados al IdExhortoGenerado
                        $PartesDAO2 = new PartesDAO();
                        $PartesDTO2 = new PartesDTO();
                        //buscar, actualizar los encontrados a 'N', actualizar los registros con los nuevos valores y a 'S'
                        $PartesDTO2->setIdExhortoGenerado($idExhortoGenerado);
                        $PartesDTO2 = $PartesDAO2->selectPartes($PartesDTO2, ' ORDER BY idParte ASC',$proveedor);
                        //actualizacion de los encontrados a 'N'
                        $idsPartes = array();
                        if ($PartesDTO2 != '') {
                            foreach ($PartesDTO2 as $parteActualizar) {
                                $PartesDAO3 = new PartesDAO();
                                $PartesDTO3 = new PartesDTO();
                                $idsPartes[] = $parteActualizar->getIdParte();
                                $PartesDTO3->setIdParte($parteActualizar->getIdParte());
                                $PartesDTO3->setActivo('N');
                                $PartesDTO3 = $PartesDAO3->updatePartes($PartesDTO3,$proveedor);
                                if ($PartesDTO3 == '') {
                                    $statusTransaccion = 0;
                                }
                            }
                        }
                        $contadorIdPartes = 0;
                        //inserccion de los nuevos datos
                        $contadorPartes = 0;
                        foreach ($partes as $parte) {
                            $PartesDAO = new PartesDAO();
                            $PartesDTO = new PartesDTO();
                            $fechaNacimiento = '';
                            if ($parte['cveTipoPersona'] == $personaFisica) {
                                $parte['nombrePersonaMoral'] = ' ';
                            } else {
                                $parte['nombre'] = ' ';
                                $parte['paterno'] = ' ';
                                $parte['materno'] = ' ';
                                $parte['edad'] = '';
                                $parte['fechaNacimiento'] = '';
                                $parte['CURP'] = ' ';
                            }
                            if (!isset($parte['fechaNacimiento']) || $parte['fechaNacimiento'] != '0000-00-00' || $parte['fechaNacimiento'] != '') {
                                $fechaNacimiento = ( $parte['fechaNacimiento'] != '' ) ? explode('/', $parte['fechaNacimiento']) : '00/00/0000';
                                $fechaNacimiento = $fechaNacimiento[2] . '-' . $fechaNacimiento[1] . '-' . $fechaNacimiento[0];
                            } else {
                                $fechaNacimiento = '0000-00-00';
                            }
                            $PartesDTO->setIdExhortoGenerado($idExhortoGenerado);
                            $PartesDTO->setNombre(utf8_decode(strtoupper($parte['nombre'])));
                            $PartesDTO->setPaterno(utf8_decode(strtoupper($parte['paterno'])));
                            $PartesDTO->setMaterno(utf8_decode(strtoupper($parte['materno'])));
                            $PartesDTO->setNombrePersonaMoral(utf8_decode(strtoupper($parte['nombrePersonaMoral'])));
                            $PartesDTO->setCveTipoPersona($parte['cveTipoPersona']);
                            $PartesDTO->setCveTipoParte($parte['cveTipoParte']);
                            $PartesDTO->setEdad($parte['edad']);
                            $PartesDTO->setFechaNacimiento(utf8_decode($fechaNacimiento));
                            $PartesDTO->setRFC(( $parte['RFC'] != '' ) ? utf8_decode(strtoupper($parte['RFC'])) : ' ' ); //validacion de RFC vacio
                            $PartesDTO->setCURP(( $parte['CURP'] != '' ) ? utf8_decode(strtoupper($parte['CURP'])) : ' ' ); //validacion de CURP vacio
                            $PartesDTO->setCveEstado($parte['cveEstado']);
                            $PartesDTO->setCveMunicipio($parte['cveMunicipio']);
                            $PartesDTO->setDomicilio(( $parte['domicilio'] != '' ) ? utf8_decode(strtoupper($parte['domicilio'])) : ' ' ); //validacion de domicilio vacio
                            $PartesDTO->setTelefono(( $parte['telefono'] != '' ) ? $parte['telefono'] : ' ' ); //validacion de telefono vacio
                            $PartesDTO->setEmail(( $parte['email'] != '' ) ? $parte['email'] : ' ' ); //validacion de email vacio
                            $PartesDTO->setCveGenero($parte['cveGenero']);
                            $PartesDTO->setDetenido($parte['detenido']);
                            //datos para el WS
                            if ($parte['cveTipoPersona'] == $personaFisica) { //persona fisica
                                $partesWS[$contadorPartes]["tipo"] = utf8_encode($PartesDTO->getCveTipoParte());
                                $partesWS[$contadorPartes]["persona"] = utf8_encode($PartesDTO->getCveTipoPersona());
                                $partesWS[$contadorPartes]["nombreFisica"] = utf8_encode($PartesDTO->getNombre());
                                $partesWS[$contadorPartes]["paternoFisica"] = utf8_encode($PartesDTO->getPaterno());
                                $partesWS[$contadorPartes]["maternoFisica"] = utf8_encode($PartesDTO->getMaterno());
                                $partesWS[$contadorPartes]["edadFisica"] = utf8_encode($PartesDTO->getEdad());
                                $partesWS[$contadorPartes]["fNacFisica"] = utf8_encode($PartesDTO->getFechaNacimiento());
                                $partesWS[$contadorPartes]["rfcFisica"] = utf8_encode($PartesDTO->getRFC());
                                $partesWS[$contadorPartes]["curpFisica"] = utf8_encode($PartesDTO->getCURP());
                                $partesWS[$contadorPartes]["generoFisica"] = utf8_encode($PartesDTO->getCveGenero());
                                $partesWS[$contadorPartes]["direccionFisica"] = utf8_encode($PartesDTO->getDomicilio());
                                $partesWS[$contadorPartes]["estadoFisica"] = utf8_encode($PartesDTO->getCveEstado());
                                $partesWS[$contadorPartes]["municipioFisica"] = utf8_encode($PartesDTO->getCveMunicipio());
                                $partesWS[$contadorPartes]["telefonoFisica"] = utf8_encode($PartesDTO->getTelefono());
                                $partesWS[$contadorPartes]["mailFisica"] = utf8_encode($PartesDTO->getEmail());
                                $partesWS[$contadorPartes]["detenidoFisica"] = utf8_encode($PartesDTO->getDetenido());
                                $partesWS[$contadorPartes]["nombreMoral"] = "";
                                $partesWS[$contadorPartes]["direccionMoral"] = "";
                                $partesWS[$contadorPartes]["estadoMoral"] = "";
                                $partesWS[$contadorPartes]["municipioMoral"] = "";
                                $partesWS[$contadorPartes]["telefonoMoral"] = "";
                                $partesWS[$contadorPartes]["mailMoral"] = "";
                            } else {
                                $partesWS[$contadorPartes]["tipo"] = utf8_encode($PartesDTO->getCveTipoParte());
                                $partesWS[$contadorPartes]["persona"] = utf8_encode($PartesDTO->getCveTipoPersona());
                                $partesWS[$contadorPartes]["nombreFisica"] = "";
                                $partesWS[$contadorPartes]["paternoFisica"] = "";
                                $partesWS[$contadorPartes]["maternoFisica"] = "";
                                $partesWS[$contadorPartes]["edadFisica"] = "";
                                $partesWS[$contadorPartes]["fNacFisica"] = "";
                                $partesWS[$contadorPartes]["rfcFisica"] = "";
                                $partesWS[$contadorPartes]["curpFisica"] = "";
                                $partesWS[$contadorPartes]["generoFisica"] = "";
                                $partesWS[$contadorPartes]["direccionFisica"] = "";
                                $partesWS[$contadorPartes]["estadoFisica"] = "";
                                $partesWS[$contadorPartes]["municipioFisica"] = "";
                                $partesWS[$contadorPartes]["telefonoFisica"] = "";
                                $partesWS[$contadorPartes]["mailFisica"] = "";
                                $partesWS[$contadorPartes]["detenidoFisica"] = "";
                                $partesWS[$contadorPartes]["nombreMoral"] = utf8_encode($PartesDTO->getNombrePersonaMoral());
                                $partesWS[$contadorPartes]["direccionMoral"] = utf8_encode($PartesDTO->getDomicilio());
                                $partesWS[$contadorPartes]["estadoMoral"] = utf8_encode($PartesDTO->getCveEstado());
                                $partesWS[$contadorPartes]["municipioMoral"] = utf8_encode($PartesDTO->getCveMunicipio());
                                $partesWS[$contadorPartes]["telefonoMoral"] = utf8_encode($PartesDTO->getTelefono());
                                $partesWS[$contadorPartes]["mailMoral"] = utf8_encode($PartesDTO->getEmail());
                            }

                            //validacion de registros para actualizar de los inactivos o para insertar, de acuerdo a la cantidad de registros inactivos
                            if (isset($idsPartes[$contadorIdPartes])) {
                                $PartesDTO->setIdParte($idsPartes[$contadorIdPartes]);
                                $PartesDTO->setActivo('S');
                                $PartesDTO = $PartesDAO->updatePartes($PartesDTO,$proveedor);
                                $contadorIdPartes++;
                            } else {
                                $PartesDTO = $PartesDAO->insertPartes($PartesDTO,$proveedor);
                            }
                            //validacion de datos de insercion en el DTO de $PartesDTO
                            if ($PartesDTO != '') { //trae los datos del registro recien insertado
                                $idParteTemp = $PartesDTO[0]->getIdParte();
                                //insercion en bitacora
                            } else {
                                //no se insertó la parte
                                $statusTransaccion = 0;
                            }
                            $partesWS[$contadorPartes]["idParte"] = utf8_encode($idParteTemp);
                            $contadorPartes++;
                        }
                        if ($statusTransaccion == 1) {
                            //***envio a traves del webservice
                            //armado de json
                            $datosExhorto["partes"] = $partesWS;
                            $contenido = $this->obtenerImagenes($idActuacion);
                            if ($contenido != "") {
                                $datosExhorto["documentos"] = $contenido;
                            } else {
                                $enviarExhorto = "false";
                            }

                            $jsonWebservice["exhorto"] = $datosExhorto;
                            $json = json_encode($jsonWebservice);
                            //print_r($json);
                            if ($enviarExhorto == "true") {
                                try {
                                    $respuestaWS = $this->enviarExhorto($urlWebserviceEstado, $json);
                                    //print_r($respuestaWS);
                                    //validacion de la respuesta
                                    if ($this->isJson($respuestaWS) == true) {
                                        $respuestaWS = json_decode($respuestaWS);
                                        if ($respuestaWS->status == 'ok') {
                                            $resultadosWS = $respuestaWS->resultados[0];
                                            $mensajeWS = $resultadosWS->mensaje;
                                            $idExhortoWS = $resultadosWS->idExhorto;
                                            $numeroWS = $resultadosWS->numero;
                                            $anioWS = $resultadosWS->anio;
                                            $cveJuicioWS = $resultadosWS->juicioExhorto->cveJuicio;
                                            $otroJuicioWS =  $resultadosWS->juicioExhorto->otroJuicio;
                                            $cveJuzgadoAsignadoWS =$resultadosWS->juzgadoAsignado->cveJuzgado;
                                            $desJuzgadoAsignadoWS =$resultadosWS->juzgadoAsignado->desJuzgado;
                                            ////error_log('entro a la asignascion de variables: '. $desJuzgadoAsignadoWS);
                                            //concatena los datos de respuesta al JSON global
                                            //***insercion de la respuesta en -tblexhortosgenerados-
                                            $ExhortosgeneradosDTO = new ExhortosgeneradosDTO();
                                            $ExhortosgeneradosDAO = new ExhortosgeneradosDAO();
                                            $ExhortosgeneradosDTO->setIdExhortoGenerado($idExhortoGenerado);
                                            $ExhortosgeneradosDTO->setNumero($numeroWS);
                                            $ExhortosgeneradosDTO->setAnio($anioWS);
                                            $ExhortosgeneradosDTO->setIdExhortoDestino($idExhortoWS);
                                            $ExhortosgeneradosDTO->setCveEstatusExhorto($estatusExhorto);
                                            $ExhortosgeneradosDTO = $ExhortosgeneradosDAO->updateExhortosgenerados($ExhortosgeneradosDTO,$proveedor);
                                            if ($ExhortosgeneradosDTO != '') {
                                                $ActuacionesDTOFinal = new ActuacionesDTO();
                                                $ActuacionesDAO = new ActuacionesDAO();
                                                $ActuacionesDTOFinal->setIdActuacion($idActuacion);
                                                $ActuacionesDTOFinal->setCveJuzgadoDestino($cveJuzgadoAsignadoWS);
                                                $ActuacionesDTOFinal->setJuzgadoDestino($desJuzgadoAsignadoWS);
                                                $ActuacionesDTOFinal = $ActuacionesDAO->updateActuaciones($ActuacionesDTOFinal,$proveedor);
                                                if ($ActuacionesDTOFinal != '') {
                                                    //asignacion temporal de datos de respuesta en el campo cveJuzgadoDestino de este DTO
                                                    $ActuacionesDTOFinal[0]->setCveJuzgadoDestino( $numeroWS . '/' . $anioWS );
                                                    //insercion en bitacora
                                                } else {
                                                    //ocurrio un error en la actualizacion de 'actuaciones'
                                                    $statusTransaccion = 0;
                                                }
                                            } else {
                                                //ocurrio un error en la actualizacion de 'exhortosgenerados'
                                                $statusTransaccion = 0;
                                            }
                                        } else {
                                            if ($respuestaWS->status == 'error') {
                                                $mensaje = 'Respuesta WebService: '. $respuestaWS->resultados[0]->mensaje . '. ';
                                                ////error_log('error1: '.$mensaje);
                                                $statusTransaccion = 0;
                                            }
                                        }
                                    } else {
                                        $mensaje = 'Error en la respuesta del servidor. ';
                                        ////error_log('error2: '.$mensaje);
                                    }
                                } catch (Exception $e) {
                                    $mensaje = $e . '. ';
                                    ////error_log('error3: '.$mensaje);
                                }
                            }
                        }
                        //*** Proceso partes/
                    } else {
                        //return "no se insertó en jucio-exhorto";
                        $mensaje = 'NO SE INSERT&Oacute; EN JUICIO-EXHORTO. ';
                        ////error_log('error4: '.$mensaje);
                        $statusTransaccion = 0;
                    }
                } else {
                    //return "no se insertó el exhorto generado";
                    $statusTransaccion = 0;
                    $mensaje = 'NO SE INSERT&Oacute; EL EXHORTO GENERADO. ';
                    ////error_log('error5: '.$mensaje);
                }
            } else {
                //return "no se insertó la actuacion";
                $statusTransaccion = 0;
                $mensaje = 'NO SE INSERT&Oacute; LA ACTUACI&Oacute;N. ';
                ////error_log('error6: '.$mensaje);
            }

            if ($statusTransaccion == 1) {
                $proveedor->execute("COMMIT");
                $proveedor->close();
                if($enviarExhorto == "true"){
                    $dtoToJson = new DtoToJson($ActuacionesDTOFinal);
                    return $dtoToJson->toJson("EXHORTO ACTUALIZADO Y ENVIADO CORRECTAMENTE."); //$json;
                }else{
                    $dtoToJson = new DtoToJson($ActuacionesDto);
                    return $dtoToJson->toJson("EXHORTO ACTUALIZADO CORRECTAMENTE."); //$json;
                }
            } else if ($statusTransaccion == 0) {
                $proveedor->execute("ROLLBACK");
                $proveedor->close();
                $error = json_encode( array('totalCount'=>'0' , 'text' => utf8_decode($mensaje)) );
                return $error;
            }
        }else{
            return json_encode( array('totalCount'=>'0' , 'text' => utf8_decode( "NO EXISTE UNA SESI&Oacute;N ACTIVA. INGRESE NUEVAMENTE." )) );
        }
    }

    public function isJson($cadena) {
        return json_decode($cadena) != null;
    }

    public function obtenerContadorActuacion($cveJuzgado, $cveTipoActuacion, $proveedor) {
        $contadorCrl = new ContadoresController();
        $contadoresDto = new ContadoresDTO();
        $contadoresDto->setCveJuzgado($cveJuzgado);
        $contadoresDto->setCveTipoActuacion($cveTipoActuacion);
        $anioTmp = explode(' ', $proveedor->getfechaActual());
        $anioTmp = explode('-', $anioTmp[0]);
        $contadoresDto->setAnio($anioTmp[0]);
        $contadoresDto = $contadorCrl->getContador($contadoresDto, $proveedor); //selectContadores($contadoresDto);
        return $contadoresDto;
    }

    /**
     * Función que consulta los Exhortos Generados
     */
    public function consultarExhortoGenerado($ActuacionesDto, $param) {
        if ( isset( $_SESSION['cveUsuarioSistema'] ) ) {
            //obtencion de la actuacion
            $actuacionExhortoGenerado = array();
            $ActuacionesDAO = new ActuacionesDAO();
            $ActuacionesDto->setCveJuzgado( $this->obtenCveJuzgado( $ActuacionesDto->getCveJuzgado() ) );
            $order = '';
            if ($param["fechaInicio"] != '' && $param["fechaFin"] != '') {
                $fechaInicio = explode('/', $param["fechaInicio"]);
                $fechaFin = explode('/', $param["fechaFin"]);
                $fechaInicio = $fechaInicio[2] . '-' . $fechaInicio[1] . '-' . $fechaInicio[0] . ' 00:00:00';
                $fechaFin = $fechaFin[2] . '-' . $fechaFin[1] . '-' . $fechaFin[0] . ' 23:59:59';
                $order = ' AND fechaRegistro>="' . $fechaInicio . '" AND fechaRegistro<="' . $fechaFin . '" ORDER BY fechaRegistro DESC';
            } else {
                $order = ' ORDER BY fechaRegistro DESC';
            }
            $ActuacionesDto = $ActuacionesDAO->selectActuaciones($ActuacionesDto, $order);
            $totalRegistros = array('totalCount' => 0);
            if ($ActuacionesDto != '') {
                $respuesta = array("status" => "OK", "mensaje" => "RESULTADO DE LA CONSULTA");
                $contadorRegistros = 0;
                foreach ($ActuacionesDto as $actuacion) {
                    $exhortoGenerado = array();
                    $estados = array();
                    $consignacion = array();
                    $juiciosExhorto = array();
                    $partes = array();
                    $estatusexhorto = array();
                    $imagenes = array();
                    //Obtencion de la consignacion
                    $ConsignacionesDTO = new ConsignacionesDTO();
                    $ConsignacionesDAO = new ConsignacionesDAO();
                    $ConsignacionesDTO->setCveConsignacion($actuacion->getCveConsignacion());
                    $ConsignacionesDTO = $ConsignacionesDAO->selectConsignaciones($ConsignacionesDTO);

                    //obtencion de los Tipos
                    $TiposDAO = new TiposDAO();
                    $TiposDTO = new TiposDTO();
                    $TiposDTO->setCveTipo($actuacion->getCveTipo());
                    $TiposDTO = $TiposDAO->selectTipos($TiposDTO);

                    //Obtención de Exhorto generado
                    $ExhortosgeneradosDTO = new ExhortosgeneradosDTO();
                    $ExhortosgeneradosDAO = new ExhortosgeneradosDAO();
                    $ExhortosgeneradosDTO->setIdActuacion($actuacion->getIdActuacion());
                    $ExhortosgeneradosDTO = $ExhortosgeneradosDAO->selectExhortosgenerados($ExhortosgeneradosDTO);
                    if ($ExhortosgeneradosDTO != '') {
                        //obtencion del Estado Destino
                        $EstadosDTO = new EstadosDTO();
                        $EstadosDAO = new EstadosDAO();
                        $EstadosDTO->setCveEstado($ExhortosgeneradosDTO[0]->getCveEstadoDestino());
                        $EstadosDTO = $EstadosDAO->selectEstados($EstadosDTO);
                        //obtencion del estatusexhorto
                        //obtencion de la materia
                        //obtencion del juicio
                        //obtencion de juicios exhortos
                        $JuiciosexhortosDTO = new JuiciosexhortosDTO();
                        $JuiciosexhortosDAO = new JuiciosexhortosDAO();
                        $JuiciosexhortosDTO->setIdExhortoGenerado($ExhortosgeneradosDTO[0]->getIdExhortoGenerado());
                        $JuiciosexhortosDTO = $JuiciosexhortosDAO->selectJuiciosexhortos($JuiciosexhortosDTO);

                        //obtencion de partes
                        $PartesDTO = new PartesDTO();
                        $PartesDAO = new PartesDAO();
                        $PartesDTO->setIdExhortoGenerado($ExhortosgeneradosDTO[0]->getIdExhortoGenerado());
                        $PartesDTO->setActivo('S');
                        $PartesDTO = $PartesDAO->selectPartes($PartesDTO);

                        //obtencion de estatus exhorto
                        $EstatusexhortosDTO = new EstatusexhortosDTO();
                        $EstatusexhortosDAO = new EstatusexhortosDAO();
                        $EstatusexhortosDTO->setCveEstatusExhorto($ExhortosgeneradosDTO[0]->getCveEstatusExhorto());
                        $EstatusexhortosDTO = $EstatusexhortosDAO->selectEstatusexhortos($EstatusexhortosDTO);

                        if ($EstadosDTO != '') {
                            foreach ($EstadosDTO as $Estados) {
                                $estados[] = array('cveEstado' => $Estados->getCveEstado(),
                                    'desEstado' => $Estados->getDesEstado());
                            }
                        }

                        if ($JuiciosexhortosDTO != '') {
                            foreach ($JuiciosexhortosDTO as $Juicioexhorto) {
                                $juiciosExhorto[] = array('idJuicioExhorto' => $Juicioexhorto->getIdJuicioexhorto(),
                                    'cveJuicio' => $Juicioexhorto->getCveJuicio(),
                                    'otroJuicio' => $Juicioexhorto->getOtroJuicio());
                            }
                        }

                        if ($EstatusexhortosDTO != '') {
                            foreach ($EstatusexhortosDTO as $Estatusexhortos) {
                                $estatusexhorto[] = array('cveEstatusExhorto' => $Estatusexhortos->getCveEstatusExhorto(),
                                    'desEstatusExhorto' => $Estatusexhortos->getDesEstatusExhorto());
                            }
                        }

                        if ($PartesDTO != '') {
                            foreach ($PartesDTO as $parte) {
                                $tipospersonas = array();
                                $tipospartes = array();

                                //obtención de tipo de partes
                                $TipospartesDTO = new TipospartesDTO();
                                $TipospartesDAO = new TipospartesDAO();
                                $TipospartesDTO->setCveTipoParte($parte->getCveTipoParte());
                                $TipospartesDTO = $TipospartesDAO->selectTipospartes($TipospartesDTO);

                                //obtencion de tipo de personas
                                $TipospersonasDTO = new TipospersonasDTO();
                                $TipospersonasDAO = new TipospersonasDAO();
                                $TipospersonasDTO->setCveTipoPersona($parte->getCveTipoPersona());
                                $TipospersonasDTO = $TipospersonasDAO->selectTipospersonas($TipospersonasDTO);

                                if ($TipospartesDTO != '') {
                                    foreach ($TipospartesDTO as $Tipospartes) {
                                        $tipospartes[] = array('cveTipoParte' => $Tipospartes->getCveTipoParte(),
                                            'descTipoParte' => $Tipospartes->getDescTipoParte());
                                    }
                                }

                                if ($TipospersonasDTO != '') {
                                    foreach ($TipospersonasDTO as $Tipospersonas) {
                                        $tipospersonas[] = array('cveTipoPersona' => $Tipospersonas->getCveTipoPersona(),
                                            'desTipoPersona' => $Tipospersonas->getDesTipoPersona());
                                    }
                                }
                                $fechaNacimiento = '';
                                if (utf8_decode($parte->getFechaNacimiento()) != '0000-00-00') {
                                    $fechaNacimiento = explode('-', utf8_decode($parte->getFechaNacimiento()));
                                    $fechaNacimiento = $fechaNacimiento[2] . '/' . $fechaNacimiento[1] . '/' . $fechaNacimiento[0];
                                }
                                $partes[] = array("idParte" => utf8_encode($parte->getIdParte()),
                                    "idExhorto" => utf8_encode($parte->getIdExhorto()),
                                    "idExhortoGenerado" => utf8_encode($parte->getIdExhortoGenerado()),
                                    "nombre" => utf8_encode($parte->getNombre()),
                                    "paterno" => utf8_encode($parte->getPaterno()),
                                    "materno" => utf8_encode($parte->getMaterno()),
                                    "nombrePersonaMoral" => utf8_encode($parte->getNombrePersonaMoral()),
                                    "cveTipoPersona" => $tipospersonas,
                                    "cveTipoParte" => $tipospartes,
                                    "edad" => utf8_encode($parte->getEdad()),
                                    "fechaNacimiento" => utf8_encode($fechaNacimiento),
                                    "rfc" => utf8_encode($parte->getRFC()),
                                    "curp" => utf8_encode($parte->getCURP()),
                                    "cveEstado" => utf8_encode($parte->getCveEstado()),
                                    "cveMunicipio" => utf8_encode($parte->getCveMunicipio()),
                                    "domicilio" => utf8_encode($parte->getDomicilio()),
                                    "telefono" => utf8_encode($parte->getTelefono()),
                                    "email" => utf8_encode($parte->getEmail()),
                                    "cveGenero" => utf8_encode($parte->getCveGenero()),
                                    "detenido" => utf8_encode($parte->getDetenido())
                                );
                            }
                        }

                        if ($ExhortosgeneradosDTO != '') {
                            foreach ($ExhortosgeneradosDTO as $Exhortogenerado) {
                                $exhortoGenerado[] = array('idExhortoGenerado' => $Exhortogenerado->getIdExhortoGenerado(),
                                    'cveEstatusExhorto' => $estatusexhorto,
                                    'cveEstadoDestino' => $estados,
                                    'cveOficialia' => $Exhortogenerado->getCveOficialia(),
                                    'requisitoria' => $Exhortogenerado->getRequisitoria(),
                                    'numeroAnio' => $Exhortogenerado->getNumero() . ' / ' . $Exhortogenerado->getAnio(),
                                    'juiciosExhortos' => $juiciosExhorto,
                                    'partes' => $partes
                                );
                            }
                        }
                    }

                    if ($ConsignacionesDTO != '') {
                        foreach ($ConsignacionesDTO as $Consignacion) {
                            $consignacion[] = array('cveConsignacion' => $Consignacion->getCveConsignacion(),
                                'desConsignacion' => $Consignacion->getDesConsignacion());
                        }
                    }

                    if ($TiposDTO != '') {
                        foreach ($TiposDTO as $Tipos) {
                            $tipos[] = array('cveTipo' => $Tipos->getCveTipo(),
                                'desCarpeta' => $Tipos->getDesCarpeta());
                        }
                    }

                    //obtencion de la ruta de los archivos digitalizados adjuntos
                    $DocumentosimgDTO = new DocumentosimgDTO();
                    $DocumentosimgDAO = new DocumentosimgDAO();
                    $DocumentosimgDTO->setIdActuacion( $actuacion->getIdActuacion() );
                    $DocumentosimgDTO->setActivo( 'S' );
                    $DocumentosimgDTO = $DocumentosimgDAO->selectDocumentosimg( $DocumentosimgDTO );
                    //////error_log(json_encode($DocumentosimgDTO));
                    if( $DocumentosimgDTO != '' ){
                        $ImagenesDTO = new ImagenesDTO();
                        $ImagenesDAO = new ImagenesDAO();
                        $ImagenesDTO->setActivo('S');
                        $ImagenesDTO->setAdjunto('S');
                        $ImagenesDTO->setIdDocumentoImg( $DocumentosimgDTO[0]->getIdDocumentoImg() );
                        $ImagenesDTO = $ImagenesDAO->selectImagenes( $ImagenesDTO );
                    }

                    if( $ImagenesDTO != '' ){
                        foreach ($ImagenesDTO as $Imagenes) {
                            //obtiene datos del archivo
                            $size = filesize( $Imagenes->getRuta() );
                            $rutaArchivo = explode('/', $Imagenes->getRuta() );
                            $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];
                            $imagenes[] = array('ruta' => utf8_encode( substr($Imagenes->getRuta(), 9) ),
                                'nombreArchivo' => utf8_encode( $nombreArchivo ),
                                'idImagen' => utf8_encode( $Imagenes->getIdImagen() ),
                                'tamano' => $size ) ;
                        }
                    }

                    $tmpFechaRegistro = explode(' ', $actuacion->getFechaRegistro());
                    $fechaRegistro = explode('-', $tmpFechaRegistro[0]);
                    $fechaRegistro = $fechaRegistro[2] . '/' . $fechaRegistro[1] . '/' . $fechaRegistro[0] . ' ' . $tmpFechaRegistro[1];
                    $nuc = ( $actuacion->getNuc() != ' ' && $actuacion->getNuc() != null && $actuacion->getNuc() != '' ) ? $actuacion->getNuc() : 'n/a';
                    $carpetaInv = ( $actuacion->getCarpetaInv() != ' ' && $actuacion->getCarpetaInv() != null && $actuacion->getCarpetaInv() != '' ) ? $actuacion->getCarpetaInv() : 'n/a';
                    $oficio = explode('/', $actuacion->getNumOficio());
                    if ($param["cveEstadoDestino"] == 0) {
                        $contadorRegistros++;
                        $actuacionExhortoGenerado['data'][] = array('idActuacion' => $actuacion->getIdActuacion(),
                            'numActuacion' => $actuacion->getNumActuacion(),
                            'aniActuacion' => $actuacion->getaniActuacion(),
                            'cveTipoActuacion' => $actuacion->getCveTipoActuacion(),
                            'numeroExp' => $actuacion->getnumeroExp(),
                            'anioExp' => $actuacion->getAnioExp(),
                            'numOficio' => $oficio[0],
                            'anioOficio' => $oficio[1],
                            'cveTipo' => $tipos,
                            'carpetaInv' => $carpetaInv,
                            'nuc' => $nuc,
                            'cveMateria' => $actuacion->getCveMateria(),
                            'cveCuantia' => $actuacion->getCveCuantia(),
                            'noFojas' => $actuacion->getNoFojas(),
                            'cveJuzgado' => $actuacion->getCveJuzgado(),
                            'sintesis' => $actuacion->getSintesis(),
                            'observaciones' => $actuacion->getObservaciones(),
                            'cveConsignacion' => $consignacion,
                            'cveJuzgadoDestino' => $actuacion->getCveJuzgadoDestino(),
                            'juzgadoDestino' => $actuacion->getJuzgadoDestino(),
                            'juzgadoDestino' => $actuacion->getJuzgadoDestino(),
                            'fechaRegistro' => $fechaRegistro,
                            'exhortoGenerado' => $exhortoGenerado,
                            'adjuntos' => $imagenes
                        );
                    } elseif ($param["cveEstadoDestino"] == $estados[0]["cveEstado"]) {
                        $contadorRegistros++;
                        $actuacionExhortoGenerado['data'][] = array('idActuacion' => $actuacion->getIdActuacion(),
                            'numActuacion' => $actuacion->getNumActuacion(),
                            'aniActuacion' => $actuacion->getaniActuacion(),
                            'cveTipoActuacion' => $actuacion->getCveTipoActuacion(),
                            'numeroExp' => $actuacion->getnumeroExp(),
                            'anioExp' => $actuacion->getAnioExp(),
                            'numOficio' => $oficio[0],
                            'anioOficio' => $oficio[1],
                            'cveTipo' => $actuacion->getCveTipo(),
                            'carpetaInv' => $carpetaInv,
                            'nuc' => $nuc,
                            'cveMateria' => $actuacion->getCveMateria(),
                            'cveCuantia' => $actuacion->getCveCuantia(),
                            'noFojas' => $actuacion->getNoFojas(),
                            'cveJuzgado' => $actuacion->getCveJuzgado(),
                            'sintesis' => $actuacion->getSintesis(),
                            'observaciones' => $actuacion->getObservaciones(),
                            'cveConsignacion' => $consignacion,
                            'cveJuzgadoDestino' => $actuacion->getCveJuzgadoDestino(),
                            'juzgadoDestino' => $actuacion->getJuzgadoDestino(),
                            'fechaRegistro' => $fechaRegistro,
                            'exhortoGenerado' => $exhortoGenerado,
                            'adjuntos' => $imagenes
                        );
                    }
                }
                $totalRegistros['totalCount'] = $contadorRegistros;
            } else {
                $respuesta = array("status" => "ERROR", "text" => "NO EXISTEN DATOS CON ESTOS PARAMETROS DE BUSQUEDA.");
            }
            $response = array_merge($respuesta, $totalRegistros, $actuacionExhortoGenerado);
            return json_encode($response);
        }else{
            return json_encode( array('totalCount'=>'0' , 'text' => utf8_decode( "NO EXISTE UNA SESIÓN ACTIVA. INGRESE NUEVAMENTE." )) );
        }        
    }

    public function obtenerOficialias($param) {
        $cveEstadoDestino = $param['cveEstadoDestino'];
        $EstadosDTO = new EstadosDTO();
        $EstadosDAO = new EstadosDAO();
        $EstadosDTO->setCveEstado($cveEstadoDestino);
        $EstadosDTO->setActivo('S');
        $EstadosDTO = $EstadosDAO->selectEstados($EstadosDTO);
        if ($EstadosDTO != '') {
            $urlWS = $EstadosDTO[0]->getUrlWebServices();
            if ($urlWS != '') {
                $response = $this->obtieneOficialias($urlWS);
                if ($this->isJson($response) == true) {
                    return $response;
                } else {
                    return '{"estatus":"error","mensaje":"SIN OFICIALIAS"}';
                }
            }
            return '{"estatus":"error","mensaje":"SIN OFICIALIAS"}';
        } else {
            return '{"estatus":"error","mensaje":"SIN OFICIALIAS"}';
        }
    }

    public function enviarExhorto($host, $json) {
        //$host = 'http://127.0.0.1/exhortos/desarrollo/webservice/servidor/exhortos/ExhortosServer.php?wsdl';
        $enviarExhortoGenerado = new exhortoGeneradoCliente();
        $response = $enviarExhortoGenerado->envia($host, $json);
        //////error_log("response =>" . $response);
        return $response;
    }

    public function obtenerImagenes($idActuacion) {
        $content64 = "";
        $documentosimgDao = new DocumentosimgDAO();
        $documentosimgDto = new DocumentosimgDTO();
        $documentosimgDto->setActivo("S");
        $documentosimgDto->setIdActuacion($idActuacion);
        $documentosimg = $documentosimgDao->selectDocumentosimg($documentosimgDto);
        //////error_log(print_r($documentosimg, true));
        if ($documentosimg != "") {
            $idDocumentoImg = $documentosimg[0]->getIdDocumentoImg();
            $imagenesDao = new ImagenesDAO();
            $imagenesDto = new ImagenesDTO();
            $imagenesDto->setActivo("S");
            $imagenesDto->setIdDocumentoImg($idDocumentoImg);
            $imagenes = $imagenesDao->selectImagenes($imagenesDto);
            //////error_log(print_r($imagenes, true));
            if ($imagenes != "") {
                $destination = 'ac-' . $idActuacion . '.zip';
                $zip = new ZipArchive();
                if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                 //   echo "error a abrir zip";
                    return false;
                }
                foreach ($imagenes as $imagen) {
                    error_log('ruta: '.$imagen->getRuta());
                    $ruta = explode("/", $imagen->getRuta());
                    $totalNiveles = count($ruta);
                    $archivo = $ruta[$totalNiveles - 1];
                    $zip->addFile($imagen->getRuta(), $archivo);
                }
                //////error_log("zip obj => " . print_r($zip) );
                $zip->close();
                $content = file_get_contents($destination);
                $content64 = base64_encode($content);
            }
        }
        $resp = unlink($destination);
        return $content64;
    }

    public function obtieneOficialias($host) {
        //$host = 'http://127.0.0.1/exhortos/desarrollo/webservice/servidor/exhortos/ExhortosScramble.wsdl';
        $getOficialias = new exhortoGeneradoCliente();
        return $getOficialias->getOficialias($host);
    }


    public function actualizaExhortoGeneradoWS($json) {
        error_log('entro a traves de ws');
        $statusTransaccion = 1;
        $respuesta = array("estatus" => "", "mensaje" => "", "data" => array());
        //$arrayActualizacion = json_decode($json, true);
        $dataActuacion = json_decode($json);
        error_log('json recibido: '.$json);
/*        $exhortoGenerado = $dataActuacion["exhortoGenerado"];
        $actuacion = $dataActuacion["actuacion"];
        $promovente = $dataActuacion["promovente"];
        $documentos = $dataActuacion["documentos"];*/
        $exhortoGenerado = $dataActuacion->exhortoGenerado;
        $actuacion = $dataActuacion->actuacion;
        $promovente = $dataActuacion->promovente;
        $documentos = $dataActuacion->documentos;
        $cveTipoActuacion = '2'; //promociones
        //proveedor de la conexion
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        //actualizacion del exhorto generado
        $ExhortosgeneradosDTO = new ExhortosgeneradosDTO();
        $ExhortosgeneradosDAO = new ExhortosgeneradosDAO();
        $ExhortosgeneradosDTO->setIdExhortoGenerado($exhortoGenerado->idExhortoGenerado);
        $ExhortosgeneradosDTO->setCveEstadoDestino($exhortoGenerado->estadoOrigen);
        $ExhortosgeneradosDTO->setCveEstatusExhorto($exhortoGenerado->idEstatus);
        $ExhortosgeneradosDTO = $ExhortosgeneradosDAO->updateExhortosgenerados($ExhortosgeneradosDTO,$proveedor);
        if ($ExhortosgeneradosDTO != '') {
            //insercion en bitacora
            //***actualizacion de la actuacion
            //obtencion de la clave de juzgado de la actuacion vinculada al exhorto generado
            $idActuacion = $ExhortosgeneradosDTO[0]->getIdActuacion();
            $cveJuzgado = '1';
            $cveMateria = '1';
            $cveCuantia = '1';
            $numeroExp = '1';
            $anioExp = '1';
            $cveTipo = '0';
            $ActuacionesDTO0 = new ActuacionesDTO();
            $ActuacionesDAO0 = new ActuacionesDAO();
            $ActuacionesDTO0->setIdActuacion($idActuacion);
            $ActuacionesDTO0 = $ActuacionesDAO0->selectActuaciones($ActuacionesDTO0,'',$proveedor);
            ////error_log('actuaciones de la recepcion de ws');
            if ($ActuacionesDTO0 != '') {
                $cveJuzgado = $ActuacionesDTO0[0]->getCveJuzgado();
                $cveMateria = $ActuacionesDTO0[0]->getCveMateria();
                $cveCuantia = $ActuacionesDTO0[0]->getCveCuantia();
                $numeroExp = $ActuacionesDTO0[0]->getNumActuacion();
                $anioExp = $ActuacionesDTO0[0]->getAniActuacion();
                $cveTipo = $ActuacionesDTO0[0]->getCveTipo();
            }
            //obtencion del contador
            $numActuacion = $this->obtenerContadorActuacion($cveJuzgado, $cveTipoActuacion, $proveedor);
            $numActuacion = $numActuacion[0]->getNumero();
            //asignacion de variables al DTO
            $ActuacionesDTO = new ActuacionesDTO();
            $ActuacionesDAO = new ActuacionesDAO();
            $ActuacionesDTO->setNumActuacion($numActuacion);
            $anioTmp = explode(' ', $proveedor->getfechaActual());
            $anioTmp = explode('-', $anioTmp[0]);
            $ActuacionesDTO->setAniActuacion($anioTmp[0]);
            $ActuacionesDTO->setCveTipo( $cveTipo ); //dato igual al de la base para 'EXHORTO GENERADO'
            $ActuacionesDTO->setCveTipoActuacion($cveTipoActuacion); //dato igual al de la base para 'PROMOCION'
            //materia y cuantia no se consideran ya que son los mismo valores de la actuacion padre
            $ActuacionesDTO->setCveMateria($cveMateria);
            $ActuacionesDTO->setCveCuantia($cveCuantia);
            $ActuacionesDTO->setIdReferencia($idActuacion);
            $ActuacionesDTO->setNumeroExp($numeroExp);
            $ActuacionesDTO->setAnioExp($anioExp);
            $ActuacionesDTO->setNoFojas($actuacion->noFojas);
            $ActuacionesDTO->setCveJuzgado($cveJuzgado);
            $ActuacionesDTO->setSintesis($actuacion->sintesis);
            $ActuacionesDTO->setObservaciones($actuacion->observaciones);
            $ActuacionesDTO = $ActuacionesDAO->insertActuaciones($ActuacionesDTO,$proveedor);
            if ($ActuacionesDTO != '') {
                //insercion en bitacora
                //variables de retorno del WS
                $idActuacionNva = $ActuacionesDTO[0]->getIdActuacion();
                $numeroPromocion = $ActuacionesDTO[0]->getNumActuacion();
                $anioPromocion = $ActuacionesDTO[0]->getAniActuacion();
                $estadoPromoventes = true;
                //actualizacion de promoventes-actuaciones
                foreach ($promovente as $promoventeSingle) {
                    $PromoventesactuacionesDTO = new PromoventesactuacionesDTO();
                    $PromoventesactuacionesDAO = new PromoventesactuacionesDAO();
                    $PromoventesactuacionesDTO->setIdActuacion($idActuacionNva);
                    $PromoventesactuacionesDTO->setCveTipoParte('5'); //verificar
                    $PromoventesactuacionesDTO->setCveTipoPersona($promoventeSingle->tipoPersona); // deberá ser moral (2)
                    $PromoventesactuacionesDTO->setNombrePersonaMoral($promoventeSingle->nombrePersona);
                    $PromoventesactuacionesDTO->setCveGenero('3'); //corresponde a persona moral
                    $PromoventesactuacionesDTO = $PromoventesactuacionesDAO->insertPromoventesactuaciones($PromoventesactuacionesDTO,$proveedor);
                    if ($PromoventesactuacionesDTO == '') {
                        $estadoPromoventes = false;
                        $statusTransaccion = 0;
                        break;
                    }
                }
                if ($statusTransaccion == 1) {
                    $proveedor->execute("COMMIT");
                } else if ($statusTransaccion == 0) {
                    $proveedor->execute("ROLLBACK");
                }

                //recepción de imagenes
                if ($documentos != "") { 
                    $guardar = true; 
                    ////error_log("se recibieron documentos"); 
                    $nombreArch = $exhortoGenerado->idExhortoGenerado . $exhortoGenerado->estadoOrigen . 'mypdf.zip'; 
                    $folder = $exhortoGenerado->idExhortoGenerado . $exhortoGenerado->estadoOrigen . 'mypdf'; 
                    file_put_contents($exhortoGenerado->idExhortoGenerado . $exhortoGenerado->estadoOrigen . 'mypdf.zip', base64_decode( $documentos )); 
                    ////error_log("Folder => " . $folder); 
                    ////error_log("Archivo => " . $folder); 
                    $zip = new ZipArchive; 
                    $res = $zip->open($nombreArch); 
                    if ($res === TRUE) { 
                        $zip->extractTo($folder); 
                        $zip->close(); 
                    } else { 

                    } 

                    $files1 = scandir($folder, 1); 
                    $files1 = array_filter(scandir($folder), function($item) { 
                        return !is_dir($folder . $item); 
                    }); 
                } else { 
                    $exhorto = array();
                    $exhorto["status"] = "error"; 
                    $exhorto["idExhorto"] = "0"; 
                    $exhorto["numero"] = "0"; 
                    $exhorto["anio"] = "0"; 
                    $exhorto["juzgadoAsignado"] = ""; 
                    $exhorto["mensaje"] = "no se enviaron documentos"; 
                    $respuesta = json_encode($exhorto); 
                    ////error_log($respuesta); 
                    return $respuesta; 
                } 

/*                //insercion de registro en -tbldocumentosimg-
                $DocumentosimgDTO = new DocumentosimgDTO();
                $DocumentosimgDAO = new DocumentosimgDAO();
                $DocumentosimgDTO->setIdActuacion( $idActuacionNva );
                $DocumentosimgDTO->setCveTipoDocumento( '13' );
                $DocumentosimgDTO->setCveUsuario( $_SESSION['cveUsuarioSistema'] );
                $DocumentosimgDTO = $DocumentosimgDAO->insertDocumentosimg( $DocumentosimgDTO );*/

/*                if( $DocumentosimgDTO != '' ){
                    //insercion de los registros de los archivos*/
                $param = array();
                foreach ($files1 as $file) {
                    $param = [];
                    // echo "file => " . $file . "<br>"; 
                    if ($file != "." && $file != "..") { 
                        $archivo = $file; 
                        $tmpfile = $folder . "/" . $file;
                        $param["cveTipoDocumento"] = '13';
                        $param["idActuacion"] = $idActuacionNva;
                        $param["idExhorto"] = '0';
                        $param["archivo"]['name'] = $file;
                        $param["archivo"]['path'] = dirname(__FILE__).'/../../../webservice/servidor/exhortos/'.$tmpfile;
                        include_once(dirname(__FILE__) . "/../../../controladores/exhortos/imagenes/ImagenesController.Class.php");
                        include_once(dirname(__FILE__) . "/../../../fachadas/exhortos/imagenes/ImagenesFacade.Class.php");
                        $ImagenesFacade = new ImagenesFacade();
                        $response = $ImagenesFacade->insertImagenesRecibidasPromociones( $param, $proveedor );
                        //error_log('respuesta de la insercion => '.json_encode($response));
                    } 
                }

                if ($estadoPromoventes == true) {
                    //insercion en bitacora
                    //armado de json de retorno
                    $idActuacionNva = $ActuacionesDTO[0]->getIdActuacion();
                    $numeroPromocion = $ActuacionesDTO[0]->getNumActuacion();
                    $anioPromocion = $ActuacionesDTO[0]->getAniActuacion();
                    $respuesta["estatus"] = "ok";
                    $respuesta["mensaje"] = "EXHORTO ACTUALIZADO CORRECTAMENTE";
                    $respuesta["data"] = array("idActuacion" => $idActuacionNva, "numeroPromocion" => $numeroPromocion, "anioPromocion" => $anioPromocion);
                } else {
                    //no se registro en la tabla -promoventesactuaciones-
                    $respuesta["estatus"] = "error";
                    $respuesta["mensaje"] = "ERROR AL REGISTRAR LOS PROMOVENTES. Err:WS003";
                }
            } else {
                ////error_log('la insercion NO trae datos ********');
                //no se insertó la actuacion
                $respuesta["estatus"] = "error";
                $respuesta["mensaje"] = "NO SE GENER&Oacute; LA PROMOCI&Oacute;N. Err:WS002";
                $statusTransaccion = 0;
            }
        } else {
            //error en la actualizacion
            $respuesta["estatus"] = "error";
            $respuesta["mensaje"] = "NO SE ACTUALIZ&Oacute; EL EXHORTO. Err:WS001";
            $statusTransaccion = 0;
        }

        if ($statusTransaccion == 1) {
/*            $proveedor->execute("COMMIT");
            $proveedor->close();*/
            return json_encode($respuesta);
        } else if ($statusTransaccion == 0) {
/*            $proveedor->execute("ROLLBACK");
            $proveedor->close();*/
            return json_encode($respuesta);
  //          $error = json_encode( array('totalCount'=>'0' , 'text' => utf8_decode($mensaje)) );
        }
    }

//********************** EXHORTO GENERADO/ ******************
//********************** PROMOCIONES/ ******************
    public function guardarActuacion_Promocion($ActuacionesDto, $proveedor = null, $listaPromoventes) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
        $contadorCrl = new ContadoresController();
        $contadoresDto = new ContadoresDTO();
        $transaccion = 1;
        //$asignaContador = false;
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $mensaje = "";
        $cveAdscripcion = $_SESSION['cveAdscripcion'];
        // campos exhorto generado;
        $actuacionExhGenDto = new ActuacionesDTO();
        $cveJuzgado = $this->obtenCveJuzgado( $cveAdscripcion );
        $actuacionExhGenDto->setIdActuacion($ActuacionesDto->getIdReferencia());
        $actuacionExhGenDto->setCveTipoActuacion(1); //id de exhorto generado
        $actuacionExhGenDto->setCveJuzgado( $cveJuzgado );
        $actuacionExhGen = $this->selectActuaciones($actuacionExhGenDto);
        if ($actuacionExhGen != "") {
            $ActuacionesDto->setCveMateria($actuacionExhGen[0]->getCveMateria());
            $ActuacionesDto->setCveTipo($actuacionExhGen[0]->getCveTipo());
            $ActuacionesDto->setcveCuantia($actuacionExhGen[0]->getCveCuantia());
        }
        // parametros para contadores
        $contadoresDto->setCveJuzgado( $cveJuzgado );
        $contadoresDto->setCveTipoActuacion($ActuacionesDto->getCveTipoActuacion());
        $anioTmp = explode(' ', $proveedor->getfechaActual());
        $anioTmp = explode('-', $anioTmp[0]);
        $contadoresDto->setAnio($anioTmp[0]);
        //obtecion del contador
        $contadoresDto = $contadorCrl->getContador($contadoresDto, $proveedor);
        if ($contadoresDto != "") {
            //////error_log(print_r($contadoresDto, true));
        }
        $ActuacionesDto->setNumActuacion($contadoresDto[0]->getNumero());
        $ActuacionesDto->setAniActuacion($contadoresDto[0]->getAnio());
        if ($contadoresDto != "") { // && $transaccion == 1) {
            $ActuacionesDao = new ActuacionesDAO();
            $ActuacionesDto->setCveJuzgado( $cveJuzgado );
            $ActuacionesDto->setActivo("S");
            $ActuacionesDto->setSintesis(utf8_decode($ActuacionesDto->getSintesis()));
            $ActuacionesDto->setObservaciones(utf8_decode($ActuacionesDto->getObservaciones()));
            $ActuacionesDto = $ActuacionesDao->insertActuaciones($ActuacionesDto, $proveedor);
            $ActuacionesDtoTmp = $ActuacionesDto;
            if ($ActuacionesDto != "") {
                $ActuacionesDto = $ActuacionesDto[0];
                $listaPromoventes = json_decode($listaPromoventes, true);
                $promoventesActuacionesDao = new PromoventesactuacionesDAO();
                foreach ($listaPromoventes as $promovente) {
                    $promoventesActuacionesDto = new PromoventesactuacionesDTO();
                    $promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getidActuacion());
                    $promoventesActuacionesDto->setCveTipoParte("5"); //valor fijo
                    $promoventesActuacionesDto->setCveTipoPersona($promovente["cveTipoPersona"]);
                    $promoventesActuacionesDto->setCveGenero($promovente["cveGenero"]);
                    if ($promovente["cveTipoPersona"] == 1) {
                        $promoventesActuacionesDto->setMaterno(utf8_decode($promovente["materno"]));
                        $promoventesActuacionesDto->setPaterno(utf8_decode($promovente["paterno"]));
                        $promoventesActuacionesDto->setNombre(utf8_decode($promovente["nombre"]));
                    } else if ($promovente["cveTipoPersona"] == 2 || $promovente["cveTipoPersona"] == 3) {
                        $promoventesActuacionesDto->setNombrePersonaMoral(utf8_decode($promovente["nombre"]));
                    }
                    $promoventesActuaciones = $promoventesActuacionesDao->insertPromoventesactuaciones($promoventesActuacionesDto, $proveedor);
                    if ($promoventesActuaciones == "") {
                        $transaccion = 0;
                        break;
                    }
                }
            } else {
                $transaccion = 0;
                $mensaje = "error en al insertar la promocion";
            }
        } else {
            $transaccion = 0;
            $mensaje = "error en contadores";
        }

        $respuesta = array();
        if ($transaccion == 1) {
            //agregar a bitacora
            $proveedor->execute("COMMIT");
            $respuesta = array("Estatus" => "Ok", "Mensaje" => "Se registro la promocion", "idActuacion" => $ActuacionesDto->getIdActuacion(), "numActuacion" => $ActuacionesDto->getNumActuacion(), $ActuacionesDto->getAniActuacion());
            $ActuacionesDto = $ActuacionesDtoTmp;
        } else if ($transaccion == 0) {
            $proveedor->execute("ROLLBACK");
            $ActuacionesDto = "";
            $respuesta = array("Estatus" => "Error", "Mensaje" => $mensaje);
        }
        $respuesta = json_encode($respuesta);
        $proveedor->close();
        return $ActuacionesDto;
    }

    public function actualizarActuacion_Promocion($ActuacionesDto, $proveedor = null, $listaPromoventes) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesDao = new ActuacionesDAO();
        $contadorCrl = new ContadoresController();
        $contadoresDto = new ContadoresDTO();
        $transaccion = 1;
        $mensaje = "";
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $ActuacionesDto->setSintesis(utf8_decode($ActuacionesDto->getSintesis()));
        $ActuacionesDto->setObservaciones(utf8_decode($ActuacionesDto->getObservaciones()));
        $ActuacionesDto->setCveJuzgado( $this->obtenCveJuzgado( $_SESSION['cveAdscripcion'] ) );
        $ActuacionesDto = $ActuacionesDao->updateActuaciones($ActuacionesDto, $proveedor);
        $ActuacionesDtoTmp = $ActuacionesDto;
        if ($ActuacionesDto != "") {
            $ActuacionesDto = $ActuacionesDto[0];
            $listaPromoventes = json_decode($listaPromoventes, true);
            $promoventesActuacionesDao = new PromoventesactuacionesDAO();
            $promoventesActuacionesDto = new PromoventesactuacionesDTO();
            $promoventesActuacionesDto2 = new PromoventesactuacionesDTO();
            //desactivar los registros actuales
            $promoventesActuacionesDto2->setIdActuacion($ActuacionesDto->getIdActuacion());
            $promoventesActuacionesDto2->setActivo('N');
            $promoventesActuacionesDto2 = $promoventesActuacionesDao->updatePromoventesactuaciones($promoventesActuacionesDto2);
            if ($promoventesActuacionesDto2 == '') {
                $transaccion = 0;
            }
            //insercion de los promoventes
            $promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getIdActuacion());
            $promoventes = $promoventesActuacionesDao->selectPromoventesactuaciones($promoventesActuacionesDto);
            foreach ($listaPromoventes as $promovente) {
                if ($promovente["idPromoventeActuacion"] == 0) {
                    $promoventesActuacionesDto = new PromoventesactuacionesDTO();
                    $promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getidActuacion());
                    $promoventesActuacionesDto->setCveTipoParte("5");
                    $promoventesActuacionesDto->setCveTipoPersona($promovente["cveTipoPersona"]);
                    $promoventesActuacionesDto->setCveGenero($promovente["cveGenero"]);
                    if ($promovente["cveTipoPersona"] == 1) {
                        $promoventesActuacionesDto->setMaterno(utf8_decode($promovente["materno"]));
                        $promoventesActuacionesDto->setPaterno(utf8_decode($promovente["paterno"]));
                        $promoventesActuacionesDto->setNombre(utf8_decode($promovente["nombre"]));
                    } else if ($promovente["cveTipoPersona"] == 2 || $promovente["cveTipoPersona"] == 3) {
                        $promoventesActuacionesDto->setNombrePersonaMoral(utf8_decode($promovente["nombre"]));
                    }
                    $promoventesActuaciones = $promoventesActuacionesDao->insertPromoventesactuaciones($promoventesActuacionesDto, $proveedor);
                    if ($promoventesActuaciones == "") {
                        $transaccion = 0;
                        break;
                    }
                }
            }

            /*            $promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getIdActuacion());
              $promoventes = $promoventesActuacionesDao->selectPromoventesactuaciones($promoventesActuacionesDto); */
            //insercion de promoventes
            /*            foreach ($listaPromoventes as $promovente) {
              if ($promovente["idPromoventeActuacion"] == 0) {
              $promoventesActuacionesDto = new PromoventesactuacionesDTO();
              $promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getidActuacion());
              $promoventesActuacionesDto->setCveTipoParte("5");
              $promoventesActuacionesDto->setCveTipoPersona($promovente["cveTipoPersona"]);
              $promoventesActuacionesDto->setCveGenero($promovente["cveGenero"]);
              if ($promovente["cveTipoPersona"] == 1) {
              $promoventesActuacionesDto->setMaterno($promovente["materno"]);
              $promoventesActuacionesDto->setPaterno($promovente["paterno"]);
              $promoventesActuacionesDto->setNombre($promovente["nombre"]);
              } else if ($promovente["cveTipoPersona"] == 2 || $promovente["cveTipoPersona"] == 3) {
              $promoventesActuacionesDto->setNombrePersonaMoral($promovente["nombre"]);
              }
              $promoventesActuaciones = $promoventesActuacionesDao->insertPromoventesactuaciones($promoventesActuacionesDto, $proveedor);
              if ($promoventesActuaciones == "") {
              $transaccion = 0;
              break;
              }
              }
              }
             */
            //promoventes provenientes del select
            foreach ($promoventes as $otherPromovente) { //provenientes del select 
                $encontrado = false;
                foreach ($listaPromoventes as $promovente) { //provenientes de los capturados
                    if ($otherPromovente->getIdPromoventeActuacion() == $promovente["idPromoventeActuacion"]) {
                        $encontrado = true;
                        $promoventesActuacionesDto = new PromoventesactuacionesDTO();
                        //$promoventesActuacionesDto->setIdActuacion($ActuacionesDto->getidActuacion());
                        $promoventesActuacionesDto->setCveTipoParte("5");
                        $promoventesActuacionesDto->setCveTipoPersona($promovente["cveTipoPersona"]);
                        $promoventesActuacionesDto->setCveGenero($promovente["cveGenero"]);
                        $promoventesActuacionesDto->setIdPromoventeActuacion($promovente["idPromoventeActuacion"]);
                        if ($promovente["cveTipoPersona"] == 1) {
                            $promoventesActuacionesDto->setMaterno(utf8_decode($promovente["materno"]));
                            $promoventesActuacionesDto->setPaterno(utf8_decode($promovente["paterno"]));
                            $promoventesActuacionesDto->setNombre(utf8_decode($promovente["nombre"]));
                        } else if ($promovente["cveTipoPersona"] == 2 || $promovente["cveTipoPersona"] == 3) {
                            $promoventesActuacionesDto->setNombrePersonaMoral(utf8_decode($promovente["nombre"]));
                        }
                        $promoventesActuaciones = $promoventesActuacionesDao->updatePromoventesactuaciones($promoventesActuacionesDto, $proveedor);
                        if ($promoventesActuaciones == "") {
                            $transaccion = 0;
                        }
                        break;
                    }
                }
                if (!$encontrado) {
                    $promoventesActuacionesDto->setIdPromoventeActuacion($otherPromovente->getIdPromoventeActuacion());
                    $promoventesActuaciones = $promoventesActuacionesDao->deletePromoventesactuaciones($promoventesActuacionesDto, $proveedor);

                    if ($promoventesActuaciones == "") {
                        $transaccion = 0;
                        break;
                    }
                }
            }
        } else {
            $transaccion = 0;
        }


        $respuesta = array();
        if ($transaccion == 1) {
            /*            $bitacoraDTO = new BitacoramovimientosDTO();
              $bitacoraCtrl = new BitacoramovimientosController();
              $bitacoraDTO->setCveAccion(92); // insercion de oficio / acuerdo
              $bitacoraDTO->setFechaMovimiento(date("Y-m-d H:i:s")); //
              $bitacoraDTO->setObservaciones($dtoToJson->toJson("MODIFICACION")); //
              $bitacoraDTO->setCveUsuario($ActuacionesDto->getCveUsuario());
              $bitacoraDTO->setCvePerfil("100"); // variable de session
              $bitacoraDTO->setCveAdscripcion($ActuacionesDto->getCveJuzgado()); // variable de session
              $bitacoraCtrl->insertBitacoramovimientos($bitacoraDTO); */
            $dtoToJson = new DtoToJson($ActuacionesDtoTmp);
            $dtoToJson->toJson("MODIFICACION");

            $proveedor->execute("COMMIT");

            $respuesta = array("Estatus" => "Ok", "Mensaje" => "Se actualizo la promocion", "ActuacionesDto" => $ActuacionesDtoTmp);
            $ActuacionesDto = $ActuacionesDtoTmp;
        } else if ($transaccion == 0) {
            $proveedor->execute("ROLLBACK");
            $ActuacionesDto = "";
            $respuesta = array("Estatus" => "Error", "Mensaje" => $mensaje);
        }
        //$respuesta = json_encode($respuesta);
        $proveedor->close();

        return $respuesta;
    }

    public function consultarActuacion_Promocion($actuacionesDto = "", $param = null) {
        $ActuacionesDao = new ActuacionesDAO();
        $promoventesActuacionesDao = new PromoventesactuacionesDAO();
        $promoventesActuacionesDto = new PromoventesactuacionesDTO();
        $numExhorto = $param["ExhNumero"];
        $anioExhorto = $param["ExhAnio"];
        $numTot = "0";
        $totPages = "0";
        $rangoFechas = "";
        $actuacionesDto->setActivo("S");
        $numeroExhoro = "";
        $anioExhorto = "";
        $imagenes = array();
        $validacion = new Validacion();
        $fechaDesde = $validacion->normalToMysql($param["fechaDesde"]);
        $fechaHasta = $validacion->normalToMysql($param["fechaHasta"]);

/*        $juzgadosController = new JuzgadosController();
        $juzgadosDto = new JuzgadosDTO();
        $juzgadosDto->setCveAdscripcion($actuacionesDto->getCveJuzgado());
        $juzgados = $juzgadosController->selectJuzgados($juzgadosDto);
        //print_r($juzgados);
        if ($juzgados != "") {
            $cveJuzgado = $juzgados[0]->getCveJuzgado();
            $actuacionesDto->setCveJuzgado($cveJuzgado);
        }*/
        $actuacionesDto->setCveJuzgado( $this->obtenCveJuzgado( $actuacionesDto->getCveJuzgado() ) );

        //validación de busqueda con datos de exhorto
        if ($numExhorto != '' || $anioExhorto != '') {
            $actuacionesDto->setCveTipoActuacion('1'); //referente a exhorto generado
            $actuacionesDto->setNumActuacion($numExhorto);
            $actuacionesDto->setAniActuacion($anioExhorto);
        }
        //validacion de busqueda por fecha o por los demas parametros
        if ($numExhorto == '' && $anioExhorto == '' && $actuacionesDto->getNumActuacion() == '' && $actuacionesDto->getAniActuacion() == '') {
            $rangoFechas = " AND fechaRegistro>='" . $fechaDesde . " 00:00:00' AND fechaRegistro<='" . $fechaHasta . " 23:59:59'";
        }
        if ($param["pag"] == 1) {
            $numTot = $ActuacionesDao->selectActuaciones($actuacionesDto, $rangoFechas, null, "count( idActuacion) as total");
            $Pages = (int) $numTot[0]["totalCount"] / $param["cantxPag"];
            $numTotal = $numTot[0];
            $restoPages = $numTot[0] % $param["cantxPag"];
            $totPages = $Pages;
        }
        $ActuacionesDto = $ActuacionesDao->selectActuaciones($actuacionesDto, $rangoFechas . " ORDER BY idActuacion DESC", null, null);
        $datos = "";
        if ($ActuacionesDto != "") {
            $datos = array("estatus" => "ok", "mensaje" => "Resultados", "datos" => array());
            $generosController = new GenerosController();
            $GenerosDto = new GenerosDTO();
            $GenerosDto->setActivo("S");

            $tiposPersonasController = new TipospersonasController();
            $TipospersonasDto = new TipospersonasDTO();
            $TipospersonasDto->setActivo("S");

            $listaGeneros = $generosController->selectGeneros($GenerosDto);
            $listaTiposPersonas = $tiposPersonasController->selectTipospersonas($TipospersonasDto);

            foreach ($ActuacionesDto as $actuacion) {
                $imagenes = [];
                //obtencion de los datos del Exhorto generado
                $ActuacionesDTO = $ActuacionesDTO2 = new ActuacionesDTO();
                $ActuacionesDAO = new ActuacionesDAO();
                $ActuacionesDTO->setIdActuacion($actuacion->getIdActuacion());
                $ActuacionesDTO = $ActuacionesDAO->selectActuaciones($ActuacionesDTO);
                if ($ActuacionesDTO != "") {
                    //obtencion de la actuacion padre
                    $ActuacionesDTO2->setIdActuacion($ActuacionesDTO[0]->getIdReferencia());
                    $ActuacionesDTO2 = $ActuacionesDAO->selectActuaciones($ActuacionesDTO2);
                    if ($ActuacionesDTO2 != '') {
                        //obtencion de numero y año del exhorto generado (actuacion padre)
                        $numeroExhoro = $ActuacionesDTO2[0]->getNumActuacion();
                        $anioExhorto = $ActuacionesDTO2[0]->getAniActuacion();
                    }
                }

                //obtencion de la ruta de los archivos digitalizados adjuntos
                $DocumentosimgDTO = new DocumentosimgDTO();
                $DocumentosimgDAO = new DocumentosimgDAO();
                ////error_log('id actuacion: '. $actuacion->getIdActuacion());
                $DocumentosimgDTO->setIdActuacion( $actuacion->getIdActuacion() ); //XXX
                $DocumentosimgDTO->setActivo( 'S' );
                //error_log('info documentos dto => '.json_encode($DocumentosimgDTO));
                $DocumentosimgDTO = $DocumentosimgDAO->selectDocumentosimg( $DocumentosimgDTO );
                if( $DocumentosimgDTO != '' ){
                    $ImagenesDTO = new ImagenesDTO();
                    $ImagenesDAO = new ImagenesDAO();
                    $ImagenesDTO->setActivo('S');
                    $ImagenesDTO->setAdjunto('S');
                    $ImagenesDTO->setIdDocumentoImg( $DocumentosimgDTO[0]->getIdDocumentoImg() );
                    $ImagenesDTO = $ImagenesDAO->selectImagenes( $ImagenesDTO );
                }

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

                //obtencion de promoventes
                $promoventesActuacionesDto->setIdActuacion($actuacion->getIdActuacion());
                $promoventesActuacionesDto->setActivo('S');
                $promoventesActuaciones = $promoventesActuacionesDao->selectPromoventesactuaciones($promoventesActuacionesDto);
                if ($promoventesActuaciones != '') {
                    $listPromovente = array();
                    foreach ($promoventesActuaciones as $promovente) {
                        $descGenero = "";
                        foreach ($listaGeneros as $genero) {
                            if ($promovente->getCveGenero() == $genero->getCveGenero()) {
                                $descGenero = $genero->getDesGenero();
                                break;
                            }
                        }
                        $desTipoPersona = "";
                        foreach ($listaTiposPersonas as $tipoPersona) {
                            if ($tipoPersona->getCveTipoPersona() == $promovente->getCveTipoPersona()) {
                                $desTipoPersona = $tipoPersona->getDesTipoPersona();
                                break;
                            }
                        }
                        $prom = array("idPromoventeActuacion" => utf8_encode($promovente->getIdPromoventeActuacion()),
                            "cveTipoParte" => utf8_encode($promovente->getCveTipoParte()),
                            "cveTipoPersona" => utf8_encode($promovente->getCveTipoPersona()),
                            "descTipoPersona" => utf8_encode($desTipoPersona),
                            "nombre" => utf8_encode($promovente->getNombre()),
                            "paterno" => utf8_encode($promovente->getPaterno()),
                            "materno" => utf8_encode($promovente->getMaterno()),
                            "nombrePersonaMoral" => utf8_encode($promovente->getNombrePersonaMoral()),
                            "cveGenero" => utf8_encode($promovente->getCveGenero()),
                            "descGenero" => utf8_encode($descGenero)
                        );
                        array_push($listPromovente, $prom);
                    }
                } else {
                    //no existen promoventes
                }

                $dato = array("idActuacion" => utf8_encode($actuacion->getIdActuacion()),
                    "numActuacion" => utf8_encode($actuacion->getNumActuacion()),
                    "aniActuacion" => utf8_encode($actuacion->getAniActuacion()),
                    "numExhorto" => utf8_encode($numeroExhoro),
                    "anioExhorto" => utf8_encode($anioExhorto),
                    "idReferencia" => utf8_encode($actuacion->getIdReferencia()),
                    "fojas" => utf8_encode($actuacion->getNoFojas()),
                    "sintesis" => utf8_encode($actuacion->getSintesis()),
                    "observaciones" => utf8_encode($actuacion->getObservaciones()),
                    "fechaRegistro" => utf8_encode($actuacion->getFechaRegistro()),
                    "promoventes" => $listPromovente,
                    'adjuntos' => $imagenes);
                array_push($datos["datos"], $dato);
            }
            ($datos["totalCount"] = $numTot[0]);
            ($datos["total"] = ceil($totPages));
        } else {
            $datos = array("estatus" => "Error", "mensaje" => "NO EXISTEN REGISTROS CON LOS PARAMETROS SELECCIONADOS. INTENTE NUEVAMENTE.");
        }
        return $datos;
    }

    public function eliminarActuacion_Promocion($ActuacionesDto = "") {
        $transaccion = 1;
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        if ($ActuacionesDto != "") {
            $ActuacionesDao = new ActuacionesDAO();
            $ActuacionesDto2 = new ActuacionesDTO();
            $ActuacionesDto2->setActivo("N");
            $ActuacionesDto2->setFechaActualizacion($proveedor->getfechaActual());
            $ActuacionesDto2->setIdActuacion($ActuacionesDto->getIdActuacion());
            $ActuacionesDto2 = $ActuacionesDao->updateActuaciones($ActuacionesDto2, $proveedor);
            if ($ActuacionesDto2 == '') {
                $transaccion = 0;
            }
        } else {
            $transaccion = 0;
        }
        if ($transaccion == 1) {
            $proveedor->execute("COMMIT");
            $respuesta = array("Estatus" => "Ok", "Mensaje" => "Se elimino la promocion",
                "idActuacion" => $ActuacionesDto2[0]->getIdActuacion(),
                "numActuacion" => $ActuacionesDto2[0]->getNumActuacion(), $ActuacionesDto2[0]->getAniActuacion());
        } else if ($transaccion == 0) {
            $proveedor->execute("ROLLBACK");
            $ActuacionesDto2[0] = "";
            $respuesta = array("Estatus" => "Error", "Mensaje" => "No se elimino la promocion");
        }
        return $respuesta;
    }
    //****************** PROMOCIONES /
}

?>
