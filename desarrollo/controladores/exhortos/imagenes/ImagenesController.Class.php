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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/imagenes/ImagenesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposdocumentos/TiposdocumentosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tiposdocumentos/TiposdocumentosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/tiposactuaciones/TiposactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/tiposactuaciones/TiposactuacionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/actuaciones/ActuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/actuaciones/ActuacionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/exhortos/ExhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/exhortos/ExhortosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/imagenes/ImagenesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class ImagenesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarImagenes($ImagenesDto) {
        $ImagenesDto->setidImagen(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getidImagen()))));
        $ImagenesDto->setidDocumentoImg(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getidDocumentoImg()))));
        $ImagenesDto->setfojas(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getfojas()))));
        $ImagenesDto->setruta(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getruta()))));
        $ImagenesDto->setposicion(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getposicion()))));
        $ImagenesDto->setactivo(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getactivo()))));
        $ImagenesDto->setfechaImagen(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getfechaImagen()))));
        $ImagenesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getfechaActualizacion()))));
        $ImagenesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getfechaRegistro()))));
        $ImagenesDto->setadjunto(strtoupper(str_ireplace("'", "", trim($ImagenesDto->getadjunto()))));
        return $ImagenesDto;
    }

    public function selectImagenes($ImagenesDto, $proveedor = null) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesDao = new ImagenesDAO();
        $ImagenesDto = $ImagenesDao->selectImagenes($ImagenesDto, $proveedor);
        return $ImagenesDto;
    }

    public function insertImagenes($ImagenesDto, $proveedor = null) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesDao = new ImagenesDAO();
        $ImagenesDto = $ImagenesDao->insertImagenes($ImagenesDto, $proveedor);
        return $ImagenesDto;
    }

    public function updateImagenes($ImagenesDto, $proveedor = null) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $activo = $ImagenesDto->getActivo();
        $ImagenesDao = new ImagenesDAO();
//$tmpDto = new ImagenesDTO();
//$tmpDto = $ImagenesDao->selectImagenes($ImagenesDto,$proveedor);
//if($tmpDto!=""){//$ImagenesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ImagenesDto = $ImagenesDao->updateImagenes($ImagenesDto, $proveedor);
        //eliminación fisica de la imagen
        if( $activo == 'N' && $ImagenesDto[0]->getActivo() == 'N' ){
            //valida la existencia del archivo
            if( is_file( $ImagenesDto[0]->getRuta() ) ){
                if( unlink( $ImagenesDto[0]->getRuta() ) == 0 ){ //error al borrar
                    $ImagenesDto = ((array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "Error al borrar el archivo."))));
                }
            }else{
                    $ImagenesDto = ((array("totalCount" => 0, "data" => array("type" => "ERROR", "text" => "No existe el archivo."))));
            }
        }

        return $ImagenesDto;
//}
//return "";
    }

    public function deleteImagenes($ImagenesDto, $proveedor = null) {
        $ImagenesDto = $this->validarImagenes($ImagenesDto);
        $ImagenesDao = new ImagenesDAO();
        $ImagenesDto = $ImagenesDao->deleteImagenes($ImagenesDto, $proveedor);
        return $ImagenesDto;
    }

    public function creaDocumento($tipo, $id, $cveTipoDocumento) {
        $proveedor = new Proveedor("mysql", "exhortos");
        $proveedor->connect();
        $json = new Encode_JSON();

        #crea el objeto documento Img y asigna propiedades
        $documentosimgDto = new DocumentosimgDTO();
        $documentosimgDto->setCveTipoDocumento($cveTipoDocumento);

        if ($tipo == 1 || $tipo == 3 || $tipo == 4) {
            $documentosimgDto->setIdExhorto($id);
            $documentosimgDto->setIdActuacion('0');
        } elseif ($tipo == 2) {
            $documentosimgDto->setIdExhorto('0');
            $documentosimgDto->setIdActuacion($id);
        }

        /**
         * @todo incluir ID de sesión
         */
        $documentosimgDto->setcveUsuario(1);
        $documentosimgDto->setFechaActualizacion(date('Y-m-d'));
        $documentosimgDto->setFechaRegistro(date('Y-m-d'));

        #inserta documentosimg
        //error_log("Documentos img" . print_r($documentosimgDto, true));
        $documentosimgDao = new DocumentosimgDAO();
        $documentosimgDto = $documentosimgDao->insertDocumentosimg($documentosimgDto, $proveedor);
        //error_log("despues Documentos img " . print_r($documentosimgDto, true) . "Proveedor =>" . $proveedor->error());
        return ($documentosimgDto != null) ? $documentosimgDto : utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "Error", "text" => "Error al crear el documento."))));
    }

    public function insertaImagen($tipo, $documentosimgDto, $cveTipoDocumento, $fileExtension, $proveedor = null) {

        $json = new Encode_JSON();
        $cveJuzgado = $anio = $tipoDocumento = $expediente = '';
        /**
         * @todo 1 es temporal
         */
        $fojas = 1;

        # devuelve clavejuzgado y año para url
        if ($tipo == 2) { # 2 actuacion
            $actuacionesDto = new ActuacionesDTO();
            $actuacionesDto->setIdActuacion($documentosimgDto->getIdActuacion());
            $actuacionesDao = new ActuacionesDAO(); # $actuacionesDto, $proveedor = null, $orden = "", $param = null, $fields = null
            $actuacionesDto = $actuacionesDao->selectActuaciones($actuacionesDto,"", $proveedor);
            $cveJuzgado = $actuacionesDto[0]->getCveJuzgado(); 
            $anio = $actuacionesDto[0]->getAniActuacion();
            $expediente = $actuacionesDto[0]->getIdActuacion();
            $cveTipoActuacion = $actuacionesDto[0]->getCveTipoActuacion();

            $tipoactuacionesDao = new TiposactuacionesDAO();
            $tipoactuacionesDto = new TiposactuacionesDTO();
            $tipoactuacionesDto->setActivo("S");
            $tipoactuacionesDto->setCveTipoActuacion($cveTipoActuacion);
            $tipoactuaciones = $tipoactuacionesDao->selectTiposactuaciones($tipoactuacionesDto);
            if ($tipoactuaciones != "") {
                $nombreTipoCarpeta = $tipoactuaciones[0]->getDesTipoActuacion();
            }
        } else { # default carpeta judicial
            $exhortosDto = new ExhortosDTO();
            $exhortosDto->setIdExhorto($documentosimgDto->getIdExhorto());
            $exhortosDao = new ExhortosDAO(); 
            $exhortosDto = $exhortosDao->selectExhortos($exhortosDto, '', $proveedor);

            $cveJuzgado = $exhortosDto[0]->getCveJuzgado();
            $anio = $exhortosDto[0]->getAniExhorto();
            $expediente = $exhortosDto[0]->getNumExhorto();
            //$cveTipoCarpeta = $exhortosDto[0]->getCveTipoCarpeta();
            $nombreTipoCarpeta = "EXHORTO";
        }

//        #devuelve descripcion tipo carpeta
//        $tiposCarpetasDTO = new TiposcarpetasDTO();
//        $tiposCarpetasDTO->setCveTipoCarpeta($cveTipoCarpeta);
//        $tiposCarpetasDAO = new TiposcarpetasDAO();
//        $tiposCarpetasDTO = $tiposCarpetasDAO->selectTiposcarpetas($tiposCarpetasDTO, '', $proveedor);
//        $nombreTipoCarpeta = str_ireplace(' ', '_', $tiposCarpetasDTO[0]->getDesTipoCarpeta());
        # devuelve extensión del tipo de documento
        $tiposDocumentosDto = new TiposdocumentosDTO();
        $tiposDocumentosDto->setCveTipodocumento($cveTipoDocumento);
        $tiposDocumentosDao = new TiposdocumentosDAO();
        $tiposDocumentosDto = $tiposDocumentosDao->selectTiposDocumentos($tiposDocumentosDto, '', $proveedor);
        $tipoDocumento = $tiposDocumentosDto[0]->getExtension();

        if ($documentosimgDto != '') {
            #crea ruta física de directorios
            $path = "../../../imagenes"; //Nodo Raiz
            $ruta = $path . '/' . $cveJuzgado . '/' . $anio . '/' . $nombreTipoCarpeta . '/' . $expediente;
            $this->CreaDirectorio($ruta);

            if ($this->ExisteDirectorio($ruta)) {
                $imagenesDto = new ImagenesDTO();
                $imagenesDto->setIdDocumentoImg($documentosimgDto->getIdDocumentoImg());
                $imagenesDao = new ImagenesDAO();
                $imagenesDto = $imagenesDao->selectImagenes($imagenesDto, $order = "ORDER BY idImagen DESC", $proveedor);
                $posicion = 1;
                if ($imagenesDto != '' && count($imagenesDto) > 0) {
                    $posicion = $imagenesDto[0]->getPosicion();
                    ++$posicion;
                }

                # arma ruta con posicion
                $ruta = $path . '/' . $cveJuzgado . '/' . $anio . '/' . $nombreTipoCarpeta . '/' . $expediente . '/' . $posicion . $tipoDocumento . '.' . $fileExtension;
                unset($imagenesDto);
                $ruta = trim($ruta, "'");
                //error_log("ruta => " . $ruta);
                $imagenesDto = new ImagenesDTO();
                $imagenesDto->setIdDocumentoImg($documentosimgDto->getIdDocumentoImg());
                $imagenesDto->setRuta($ruta);
                $imagenesDto->setPosicion($posicion);
                $imagenesDto->setFojas($fojas);
                $imagenesDto->setAdjunto('N');

                $imagenesDto = $imagenesDao->insertImagenes($imagenesDto, $proveedor);
                //error_log("proveedor =>" . $proveedor->error());
                if ($imagenesDto != "") {
                    $imagenesDto = $imagenesDto[0];
                    /**
                     * @todo poner extensión de archivo
                     */
                    $imagenesDto->setRuta($ruta);
                    $imagenesDto = $imagenesDao->updateImagenes($imagenesDto, $proveedor);

                    if ($imagenesDto != "") {  # correcto
                        $imagenesDto = $imagenesDto[0];
                        //$proveedor->execute("COMMIT");
                        $json = new Encode_JSON();
                        $rutaArchivo = explode('/', $imagenesDto->getRuta() );
                        $nombreArchivo = $rutaArchivo[ sizeof($rutaArchivo)-1 ];
                        //$proveedor->close();
                        return utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "OK", "ruta" => $imagenesDto->getRuta(), "nombreArchivo" => $nombreArchivo, "idImagen" => $imagenesDto->getIdImagen()))));
                    } else {
                        # error al crear el directorio
                        $proveedor->execute("ROLLBACK");
                        $json = new Encode_JSON();
                        $proveedor->close();
                        return utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "Error", "text" => "No existe relacion del tipo de numero con el documento "))));
                    }
                } else {
                    # error al crear el directorio
                    #$proveedor->execute("ROLLBACK");
                    $json = new Encode_JSON();
                    $proveedor->close();
                    return utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "Error", "text" => "No existe relacion del tipo de numero con el documento "))));
                }
            } else {
                # error al crear el directorio
                $proveedor->execute("ROLLBACK");
                $json = new Encode_JSON();
                $proveedor->close();
                return utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "Error", "text" => "No existe relacion del tipo de numero con el documento "))));
            }
        } else {
            # error al insertar
            $proveedor->execute("ROLLBACK");
            $json = new Encode_JSON();
            $proveedor->close();
            return utf8_encode($json->convert(array("totalCount" => 1, "data" => array("type" => "Error", "text" => "No existe relacion del tipo de numero con el documento "))));
        }
    }

    private function CreaDirectorio($NomDirectorio) { //Crea el directorio deonde se almacenara la imagen
        $VectorDirectorio = explode("/", $NomDirectorio);
        $ruta = ".";
        foreach ($VectorDirectorio as $Carpeta) {
            if ($Carpeta != "." && trim($Carpeta) != "") {
                $ruta = $ruta . "/" . $Carpeta;
                //error_log($ruta . "ruta de digitalizacion");
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777);
                }
            }
        }
    }

    private function ExisteDirectorio($NomDirectorio) {
        if (is_dir($NomDirectorio) == true)
            return true;
        return false;
    }

}

?>