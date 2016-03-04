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

class DocumentosimgDTO {
    private $idDocumentoImg;
    private $idExhorto;
    private $idActuacion;
    private $cveTipoDocumento;
    private $fechaDocumento;
    private $fechaModificacion;
    private $observaciones;
    private $cveUsuario;
    private $activo;
    private $fechaActualizacion;
    private $fechaRegistro;
    public function getIdDocumentoImg(){
        return $this->idDocumentoImg;
    }
    public function setIdDocumentoImg($idDocumentoImg){
        $this->idDocumentoImg=$idDocumentoImg;
    }
    public function getIdExhorto(){
        return $this->idExhorto;
    }
    public function setIdExhorto($idExhorto){
        $this->idExhorto=$idExhorto;
    }
    public function getIdActuacion(){
        return $this->idActuacion;
    }
    public function setIdActuacion($idActuacion){
        $this->idActuacion=$idActuacion;
    }
    public function getCveTipoDocumento(){
        return $this->cveTipoDocumento;
    }
    public function setCveTipoDocumento($cveTipoDocumento){
        $this->cveTipoDocumento=$cveTipoDocumento;
    }
    public function getFechaDocumento(){
        return $this->fechaDocumento;
    }
    public function setFechaDocumento($fechaDocumento){
        $this->fechaDocumento=$fechaDocumento;
    }
    public function getFechaModificacion(){
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion){
        $this->fechaModificacion=$fechaModificacion;
    }
    public function getObservaciones(){
        return $this->observaciones;
    }
    public function setObservaciones($observaciones){
        $this->observaciones=$observaciones;
    }
    public function getCveUsuario(){
        return $this->cveUsuario;
    }
    public function setCveUsuario($cveUsuario){
        $this->cveUsuario=$cveUsuario;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
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
    public function toString(){
        return array("idDocumentoImg"=>$this->idDocumentoImg,
"idExhorto"=>$this->idExhorto,
"idActuacion"=>$this->idActuacion,
"cveTipoDocumento"=>$this->cveTipoDocumento,
"fechaDocumento"=>$this->fechaDocumento,
"fechaModificacion"=>$this->fechaModificacion,
"observaciones"=>$this->observaciones,
"cveUsuario"=>$this->cveUsuario,
"activo"=>$this->activo,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro);
    }
}
?>