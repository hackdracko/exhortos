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

class TipospartesDTO {
    private $cveTipoParte;
    private $descTipoParte;
    private $activo;
    private $fechaActualizacion;
    private $fechaRegistro;
    public function getCveTipoParte(){
        return $this->cveTipoParte;
    }
    public function setCveTipoParte($cveTipoParte){
        $this->cveTipoParte=$cveTipoParte;
    }
    public function getDescTipoParte(){
        return $this->descTipoParte;
    }
    public function setDescTipoParte($descTipoParte){
        $this->descTipoParte=$descTipoParte;
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
        return array("cveTipoParte"=>$this->cveTipoParte,
"descTipoParte"=>$this->descTipoParte,
"activo"=>$this->activo,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro);
    }
}
?>