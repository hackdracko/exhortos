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

class TiposdocumentosDTO {
    private $cveTipoDocumento;
    private $descTipoDocumento;
    private $extension;
    private $activo;
    private $fechaActualizacion;
    private $fechaRegistro;
    public function getCveTipoDocumento(){
        return $this->cveTipoDocumento;
    }
    public function setCveTipoDocumento($cveTipoDocumento){
        $this->cveTipoDocumento=$cveTipoDocumento;
    }
    public function getDescTipoDocumento(){
        return $this->descTipoDocumento;
    }
    public function setDescTipoDocumento($descTipoDocumento){
        $this->descTipoDocumento=$descTipoDocumento;
    }
    public function getExtension(){
        return $this->extension;
    }
    public function setExtension($extension){
        $this->extension=$extension;
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
        return array("cveTipoDocumento"=>$this->cveTipoDocumento,
"descTipoDocumento"=>$this->descTipoDocumento,
"extension"=>$this->extension,
"activo"=>$this->activo,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro);
    }
}
?>