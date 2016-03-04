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

define('WP_DEBUG', true); // enable debugging mode
ini_set("error_log", dirname(__FILE__) . "/../../../logs/ImagenesFacade.log");
ini_set("log_errors", 1);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);

session_start();
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/imagenes/ImagenesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/documentosimg/DocumentosimgDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/imagenes/ImagenesController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class ImagenesFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarImagenes($ImagenesDto) {
        $ImagenesDto->setidImagen(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getidImagen(), "utf8") : strtoupper($ImagenesDto->getidImagen()))))));
        if ($this->esFecha($ImagenesDto->getidImagen())) {
            $ImagenesDto->setidImagen($this->fechaMysql($ImagenesDto->getidImagen()));
        }
        $ImagenesDto->setidDocumentoImg(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getidDocumentoImg(), "utf8") : strtoupper($ImagenesDto->getidDocumentoImg()))))));
        if ($this->esFecha($ImagenesDto->getidDocumentoImg())) {
            $ImagenesDto->setidDocumentoImg($this->fechaMysql($ImagenesDto->getidDocumentoImg()));
        }
        $ImagenesDto->setfojas(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getfojas(), "utf8") : strtoupper($ImagenesDto->getfojas()))))));
        if ($this->esFecha($ImagenesDto->getfojas())) {
            $ImagenesDto->setfojas($this->fechaMysql($ImagenesDto->getfojas()));
        }
        $ImagenesDto->setruta(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getruta(), "utf8") : strtoupper($ImagenesDto->getruta()))))));
        if ($this->esFecha($ImagenesDto->getruta())) {
            $ImagenesDto->setruta($this->fechaMysql($ImagenesDto->getruta()));
        }
        $ImagenesDto->setposicion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getposicion(), "utf8") : strtoupper($ImagenesDto->getposicion()))))));
        if ($this->esFecha($ImagenesDto->getposicion())) {
            $ImagenesDto->setposicion($this->fechaMysql($ImagenesDto->getposicion()));
        }
        $ImagenesDto->setactivo(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getactivo(), "utf8") : strtoupper($ImagenesDto->getactivo()))))));
        if ($this->esFecha($ImagenesDto->getactivo())) {
            $ImagenesDto->setactivo($this->fechaMysql($ImagenesDto->getactivo()));
        }
        $ImagenesDto->setfechaImagen(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getfechaImagen(), "utf8") : strtoupper($ImagenesDto->getfechaImagen()))))));
        if ($this->esFecha($ImagenesDto->getfechaImagen())) {
            $ImagenesDto->setfechaImagen($this->fechaMysql($ImagenesDto->getfechaImagen()));
        }
        $ImagenesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getfechaActualizacion(), "utf8") : strtoupper($ImagenesDto->getfechaActualizacion()))))));
        if ($this->esFecha($ImagenesDto->getfechaActualizacion())) {
            $ImagenesDto->setfechaActualizacion($this->fechaMysql($ImagenesDto->getfechaActualizacion()));
        }
        $ImagenesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getfechaRegistro(), "utf8") : strtoupper($ImagenesDto->getfechaRegistro()))))));
        if ($this->esFecha($ImagenesDto->getfechaRegistro())) {
            $ImagenesDto->setfechaRegistro($this->fechaMysql($ImagenesDto->getfechaRegistro()));
        }
        $ImagenesDto->setadjunto(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($ImagenesDto->getadjunto(), "utf8") : strtoupper($ImagenesDto->getadjunto()))))));
        if ($this->esFecha($ImagenesDto->getadjunto())) {
            $ImagenesDto->setadjunto($this->fechaMysql($ImagenesDto->getadjunto()));
        }
        return $ImagenesDto;
    }

    public function selectImagenes($ImagenesDto) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesController = new ImagenesController();
        $ImagenesDto = $ImagenesController->selectImagenes($ImagenesDto);
        if ($ImagenesDto != "") {
            $dtoToJson = new DtoToJson($ImagenesDto);
            return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR - IMAGENES"));
    }

    public function insertImagenes($param, $proveedor = null) {

        $proveedor = new Proveedor("mysql", "exhortos");
        $proveedor->connect();
        $json = new Encode_JSON();
        /**
         * 1 Verifica el tipo de documento
         * 2 Busca documento con 
         *      idExhorto && cveTipoDocumento
         *      idActuacion && cveTipoDocumento
         * 3 Si no lo encuentra lo crea
         */
        $ImagenesController = new ImagenesController();
        $documentosimgDto = new DocumentosimgDTO();
        $documentosimgDto->setCveTipoDocumento($param["cveTipoDocumento"]);
        /**
         * Busca si es orden de aprehension = 18
         * cateo = 19
         */
        if ($documentosimgDto->getCveTipoDocumento() == 18 || $documentosimgDto->getCveTipoDocumento() == 19) { # aprehensión o cateo
            $documentosimgDto->setIdExhorto($param["idExhorto"]);
            $documentosimgDto->setIdActuacion('');
            $tipo = $documentosimgDto->getCveTipoDocumento() == 18 ? 3 /* órden aprehensión */ : 4 /* cateo */;
            $id = $param["idExhorto"];
        } else {
            # si es carpeta judicial busca que exista documento
            if ($param['idExhorto'] > 0) {
                $documentosimgDto->setIdExhorto($param["idExhorto"]);
                $documentosimgDto->setIdActuacion('');
                $tipo = 1;
                $id = $param['idExhorto'];
            } elseif ($param['idActuacion'] > 0) { # si es actuación busca documento de actuación
                $documentosimgDto->setIdExhorto('');
                $documentosimgDto->setIdActuacion($param["idActuacion"]);
                $tipo = 2;
                $id = $param['idActuacion'];
            } else {
                exit( utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "No se defini&oacute; Exhorto o Actuaci&oacute;n")))) );
            }
        }#cierra si es orden de aprehension o cateo

        $documentosimgDao = new DocumentosimgDAO();
        $documentosImgDtoExiste = $documentosimgDao->selectDocumentosimg($documentosimgDto, '', $proveedor);

        $param["idDocumentoImg"] = ($documentosImgDtoExiste != null) ? $documentosImgDtoExiste : $ImagenesController->creaDocumento($tipo, $id, $param['cveTipoDocumento']);
        ////error_log(print_r($param["idDocumentoImg"], true));
        $fileExtension = explode(".", $param["archivo"]['name']);
        # se inserta la imagen

        $arrImagen = $ImagenesController->insertaImagen($tipo, $param["idDocumentoImg"][0], $param['cveTipoDocumento'], $fileExtension[1], $proveedor); # [0] solo devuelve uno obj el insert
        $tmpArrImagen = json_decode($arrImagen); # convierte a arreglo

        if ($tmpArrImagen->data->type == 'OK') { # si se insertó bien en la tabla
            # se crea manejador físico de imagen
            $imagenesFacade = new ImagenesFacade();
            #guarda imagen fisicamente
            $imagenesFacade->cargaImagenes($param['archivo'], $tmpArrImagen->data->ruta);
            # si se copió correctamente, se actualiza campo adjunto a S
            if (file_exists($tmpArrImagen->data->ruta)) {
                $imagenesDto = new ImagenesDTO();
                $imagenesDto->setIdImagen($tmpArrImagen->data->idImagen);
                $imagenesDao = new ImagenesDAO();
                $imagenesDto = $imagenesDao->selectImagenes($imagenesDto, '', $proveedor);
                $imagenesDto[0]->setAdjunto('S');
                $imagenesDto = $imagenesDao->updateImagenes($imagenesDto[0], $proveedor);
                $imagenesDto = $imagenesDto[0];
                $rutaArchivo = explode('/', $imagenesDto->getRuta() );
                $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];

                return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "OK", "text" => "Archivo agregado.", "idImagen" => $imagenesDto->getIdImagen(), "ruta" => substr($imagenesDto->getRuta(), 9), "nombreArchivo" => $nombreArchivo ))));
            } else {
                $json = new Encode_JSON();
                #$proveedor->close();
                return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "No se agreg&oacute;."))));
            }
        } else {
            return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "ERROR al insertar registro de imagen, intente nuevamente."))));
        }
//        $ImagenesDto = $this->validarImagenes($ImagenesDto);
//        $ImagenesController = new ImagenesController();
//        $ImagenesDto = $ImagenesController->insertImagenes($ImagenesDto);
//        if ($ImagenesDto != "") {
//            $dtoToJson = new DtoToJson($ImagenesDto);
//            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
//        }
//        $jsonDto = new Encode_JSON();
//        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function insertImagenesRecibidasPromociones($param, $proveedor = null) {
        $proveedor = new Proveedor("mysql", "exhortos");
        $proveedor->connect();
        $json = new Encode_JSON();
        //$param = json_decode( $jsonImagenes );
        /**
         * 1 Verifica el tipo de documento
         * 2 Busca documento con 
         *      idExhorto && cveTipoDocumento
         *      idActuacion && cveTipoDocumento
         * 3 Si no lo encuentra lo crea
         */
        $ImagenesController = new ImagenesController();
        $documentosimgDto = new DocumentosimgDTO();
        $documentosimgDto->setCveTipoDocumento($param["cveTipoDocumento"]);

        if ($param['idExhorto'] > 0) {
            $documentosimgDto->setIdExhorto($param["idExhorto"]);
            $documentosimgDto->setIdActuacion('');
            $tipo = 1;
            $id = $param['idExhorto'];
        } elseif ($param['idActuacion'] > 0) { # si es actuación busca documento de actuación
            $documentosimgDto->setIdExhorto('');
            $documentosimgDto->setIdActuacion($param["idActuacion"]);
            $tipo = 2;
            $id = $param['idActuacion'];
        } else {
            exit( utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "No se defini&oacute; Exhorto o Actuaci&oacute;n")))) );
        }

        $documentosimgDao = new DocumentosimgDAO();
        //error_log('+++++++++++');
        $documentosImgDtoExiste = $documentosimgDao->selectDocumentosimg($documentosimgDto, '', $proveedor);
        //error_log('+++++++++++');
        //error_log(json_encode($documentosImgDtoExiste));
        //error_log('+++++++++++');
        $param["idDocumentoImg"] = ($documentosImgDtoExiste != null) ? $documentosImgDtoExiste : $ImagenesController->creaDocumento($tipo, $id, $param['cveTipoDocumento']);
        $fileExtension = "pdf";
        # se inserta la imagen

        //error_log('**********');
        //error_log( json_encode($param["idDocumentoImg"]));
        //error_log('**********');
        $arrImagen = $ImagenesController->insertaImagen($tipo, $param["idDocumentoImg"][0], $param['cveTipoDocumento'], $fileExtension, $proveedor); # [0] solo devuelve uno obj el insert
        $tmpArrImagen = json_decode($arrImagen); # convierte a arreglo

        if ($tmpArrImagen->data->type == 'OK') { # si se insertó bien en la tabla
            # se crea manejador físico de imagen
            $imagenesFacade = new ImagenesFacade();
            #guarda imagen fisicamente
            //$imagenesFacade->cargaImagenes($param['archivo'], $tmpArrImagen->data->ruta);
            //mueve imagenes
            //error_log('parametro=> '.json_encode($param));
            $imagenesFacade->copiaImagenes($param, $tmpArrImagen->data->ruta);
            # si se copió correctamente, se actualiza campo adjunto a S
            if (file_exists($tmpArrImagen->data->ruta)) {
                $imagenesDto = new ImagenesDTO();
                $imagenesDto->setIdImagen($tmpArrImagen->data->idImagen);
                $imagenesDao = new ImagenesDAO();
                $imagenesDto = $imagenesDao->selectImagenes($imagenesDto, '', $proveedor);
                $imagenesDto[0]->setAdjunto('S');
                $imagenesDto = $imagenesDao->updateImagenes($imagenesDto[0], $proveedor);
                $imagenesDto = $imagenesDto[0];
                $rutaArchivo = explode('/', $imagenesDto->getRuta() );
                $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];

                return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "OK", "text" => "Archivo agregado.", "idImagen" => $imagenesDto->getIdImagen(), "ruta" => substr($imagenesDto->getRuta(), 9), "nombreArchivo" => $nombreArchivo ))));
            } else {
                $json = new Encode_JSON();
                #$proveedor->close();
                return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "No se agreg&oacute;."))));
            }
        } else {
            return utf8_encode($json->convert(array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "ERROR al insertar registro de imagen, intente nuevamente."))));
        }
    }


    public function updateImagenes($ImagenesDto) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesController = new ImagenesController();
        $ImagenesDto = $ImagenesController->updateImagenes($ImagenesDto);
        if ($ImagenesDto != "") {
            $dtoToJson = new DtoToJson($ImagenesDto);
            return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
    }

    public function deleteImagenes($ImagenesDto) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesController = new ImagenesController();
        $ImagenesDto = $ImagenesController->deleteImagenes($ImagenesDto);
        if ($ImagenesDto == true) {
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

    public function cargaImagenes($archivo, $ruta) {

        $extension = explode(".", $archivo['name']);
        if ((string) $extension[1] !== "php" || (string) $extension[1] !== "php2" || (string) $extension[1] !== "php3" || (string) $extension[1] !== "php4") {
            if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
                return json_encode(array("type" => "OK", "text" => "Archivo copiado de forma correcta"));
            } else {
                return json_encode(array("type" => "Error", "text" => "Ocurri&oacute; un error al copiar el archivo"));
            }
        } else {
            return json_encode(array("type" => "Error", "text" => "Tipo de Archivo no v&aacute;lido. Archivo con extencion:" . (string) $extension[1]));
        }
    }

    public function copiaImagenes($archivo, $ruta) {

        $extension = explode(".", $archivo["archivo"]['path']);
        if ((string) $extension[1] !== "php" || (string) $extension[1] !== "php2" || (string) $extension[1] !== "php3" || (string) $extension[1] !== "php4") {
            //error_log('******** copia de archivos => '.$archivo["archivo"]['path'].' ***** => '.$ruta);
            if (copy($archivo["archivo"]['path'], $ruta)) {
                return json_encode(array("type" => "OK", "text" => "Archivo copiado de forma correcta"));
            } else {
                return json_encode(array("type" => "Error", "text" => "Ocurri&oacute; un error al copiar el archivo"));
            }
        } else {
            return json_encode(array("type" => "Error", "text" => "Tipo de Archivo no v&aacute;lido. Archivo con extencion:" . (string) $extension[1]));
        }
    }

}

//
//@$idImagen=$_POST["idImagen"];
//@$idDocumentoImg=$_POST["idDocumentoImg"];
//@$fojas=$_POST["fojas"];
//@$ruta=$_POST["ruta"];
//@$posicion=$_POST["posicion"];
//@$activo=$_POST["activo"];
//@$fechaImagen=$_POST["fechaImagen"];
//@$fechaActualizacion=$_POST["fechaActualizacion"];
//@$fechaRegistro=$_POST["fechaRegistro"];
//@$adjunto=$_POST["adjunto"];
//@$accion=$_POST["accion"];
//
//$imagenesFacade = new ImagenesFacade();
//$imagenesDto = new ImagenesDTO();
//
//$imagenesDto->setIdImagen($idImagen);
//$imagenesDto->setIdDocumentoImg($idDocumentoImg);
//$imagenesDto->setFojas($fojas);
//$imagenesDto->setRuta($ruta);
//$imagenesDto->setPosicion($posicion);
//$imagenesDto->setActivo($activo);
//$imagenesDto->setFechaImagen($fechaImagen);
//$imagenesDto->setFechaActualizacion($fechaActualizacion);
//$imagenesDto->setFechaRegistro($fechaRegistro);
//$imagenesDto->setAdjunto($adjunto);
//
//if( ($accion=="guardar") && ($idImagen=="") ){
//$imagenesDto=$imagenesFacade->insertImagenes($imagenesDto);
//echo $imagenesDto;
//} else if(($accion=="guardar") && ($idImagen!="")){
//$imagenesDto=$imagenesFacade->updateImagenes($imagenesDto);
//echo $imagenesDto;
//} else if($accion=="consultar"){
//$imagenesDto=$imagenesFacade->selectImagenes($imagenesDto);
//echo $imagenesDto;
//} else if( ($accion=="baja") && ($idImagen!="") ){
//$imagenesDto=$imagenesFacade->deleteImagenes($imagenesDto);
//echo $imagenesDto;
//} else if( ($accion=="seleccionar") && ($idImagen!="") ){
//$imagenesDto=$imagenesFacade->selectImagenes($imagenesDto);
//echo $imagenesDto;
//}
if (isset($_POST) && isset($_FILES)) {
    @$idImagen = $_POST["idImagen"];
    @$idDocumentoImg = $_POST["idDocumentoImg"];
    @$fojas = $_POST["fojas"];
    @$ruta = $_POST["ruta"];
    @$posicion = $_POST["posicion"];
    @$activo = $_POST["activo"];
    @$fechaImagen = $_POST["fechaImagen"];
    @$fechaActualizacion = $_POST["fechaActualizacion"];
    @$fechaRegistro = $_POST["fechaRegistro"];
    @$adjunto = $_POST["adjunto"];
    @$accionImagen = $_POST["accion"];


    $imagenesFacade = new ImagenesFacade();
    $imagenesDto = new ImagenesDTO();

    $imagenesDto->setIdImagen($idImagen);
    $imagenesDto->setIdDocumentoImg($idDocumentoImg);
    $imagenesDto->setFojas($fojas);
    $imagenesDto->setRuta($ruta);
    $imagenesDto->setPosicion($posicion);
    $imagenesDto->setActivo($activo);
    $imagenesDto->setFechaImagen($fechaImagen);
    $imagenesDto->setFechaActualizacion($fechaActualizacion);
    $imagenesDto->setFechaRegistro($fechaRegistro);
    $imagenesDto->setAdjunto($adjunto);
    if (($accionImagen == "guardar") && ($idImagen == "")) {
        $param = array();
        $param["idExhorto"] = (!empty($_POST['idExhorto'])) ? $_POST['idExhorto'] : 0;
        $param["idActuacion"] = (!empty($_POST['idActuacion'])) ? $_POST['idActuacion'] : 0;
        $param["cveTipoDocumento"] = $_POST['cveTipoDocumento'];
        $param["archivo"] = $_FILES['uploaded_file'];
        $imagenesDto = $imagenesFacade->insertImagenes($param);
        echo $imagenesDto;
    } else if (($accionImagen == "guardar") && ($idImagen != "")) {
        $imagenesDto = $imagenesFacade->updateImagenes($imagenesDto);
        echo $imagenesDto;
    } else if ($accionImagen == "consultar") {
        $imagenesDto = $imagenesFacade->selectImagenes($imagenesDto);
        echo $imagenesDto;
    } else if (($accionImagen == "baja") && ($idImagen != "")) {
        $imagenesDto = $imagenesFacade->deleteImagenes($imagenesDto);
        echo $imagenesDto;
    } else if (($accionImagen == "seleccionar") && ($idImagen != "")) {
        $imagenesDto = $imagenesFacade->selectImagenes($imagenesDto);
        echo $imagenesDto;
    }
} else {
    exit('ERROR no hay datos a procesar.');
}
?>