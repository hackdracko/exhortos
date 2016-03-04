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

class DocumentosDTO {
    private $cveDocumento;
    private $descDocumento;
    private $activo;
    private $fechaActualizacion;
    private $fechaRegistro;
    private $cveTipoNumero;
    public function getCveDocumento(){
        return $this->cveDocumento;
    }
    public function setCveDocumento($cveDocumento){
        $this->cveDocumento=$cveDocumento;
    }
    public function getDescDocumento(){
        return $this->descDocumento;
    }
    public function setDescDocumento($descDocumento){
        $this->descDocumento=$descDocumento;
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
    public function getCveTipoNumero(){
        return $this->cveTipoNumero;
    }
    public function setCveTipoNumero($cveTipoNumero){
        $this->cveTipoNumero=$cveTipoNumero;
    }
    public function toString(){
        return array("cveDocumento"=>$this->cveDocumento,
"descDocumento"=>$this->descDocumento,
"activo"=>$this->activo,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro,
"cveTipoNumero"=>$this->cveTipoNumero);
    }
}
?>