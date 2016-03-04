<?php
 /*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 DTOS
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

class ImagenesDTO {
    private $idImagen;
    private $idDocumentoImg;
    private $fojas;
    private $ruta;
    private $posicion;
    private $activo;
    private $fechaImagen;
    private $fechaActualizacion;
    private $fechaRegistro;
    private $adjunto;
    public function getIdImagen(){
        return $this->idImagen;
    }
    public function setIdImagen($idImagen){
        $this->idImagen=$idImagen;
    }
    public function getIdDocumentoImg(){
        return $this->idDocumentoImg;
    }
    public function setIdDocumentoImg($idDocumentoImg){
        $this->idDocumentoImg=$idDocumentoImg;
    }
    public function getFojas(){
        return $this->fojas;
    }
    public function setFojas($fojas){
        $this->fojas=$fojas;
    }
    public function getRuta(){
        return $this->ruta;
    }
    public function setRuta($ruta){
        $this->ruta=$ruta;
    }
    public function getPosicion(){
        return $this->posicion;
    }
    public function setPosicion($posicion){
        $this->posicion=$posicion;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function getFechaImagen(){
        return $this->fechaImagen;
    }
    public function setFechaImagen($fechaImagen){
        $this->fechaImagen=$fechaImagen;
    }
    public function getFechaActualizacion(){
        return $this->fechaActualizacion;
    }
    public function setFechaActualizacion($fechaActualizacion){
        $this->fechaActualizacion=$fechaActualizacion;
    }
    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }
    public function setFechaRegistro($fechaRegistro){
        $this->fechaRegistro=$fechaRegistro;
    }
    public function getAdjunto(){
        return $this->adjunto;
    }
    public function setAdjunto($adjunto){
        $this->adjunto=$adjunto;
    }
    public function toString(){
        return array("idImagen"=>$this->idImagen,
"idDocumentoImg"=>$this->idDocumentoImg,
"fojas"=>$this->fojas,
"ruta"=>$this->ruta,
"posicion"=>$this->posicion,
"activo"=>$this->activo,
"fechaImagen"=>$this->fechaImagen,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro,
"adjunto"=>$this->adjunto);
    }
}
?>