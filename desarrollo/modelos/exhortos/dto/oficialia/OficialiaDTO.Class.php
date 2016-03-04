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

class OficialiaDTO {
    private $cveOficialia;
    private $desOficilia;
    private $cveDistrito;
    private $cveMunicipio;
    private $cveAdscripcion;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveOficialia(){
        return $this->cveOficialia;
    }
    public function setCveOficialia($cveOficialia){
        $this->cveOficialia=$cveOficialia;
    }
    public function getDesOficilia(){
        return $this->desOficilia;
    }
    public function setDesOficilia($desOficilia){
        $this->desOficilia=$desOficilia;
    }
    public function getCveDistrito(){
        return $this->cveDistrito;
    }
    public function setCveDistrito($cveDistrito){
        $this->cveDistrito=$cveDistrito;
    }
    public function getCveMunicipio(){
        return $this->cveMunicipio;
    }
    public function setCveMunicipio($cveMunicipio){
        $this->cveMunicipio=$cveMunicipio;
    }
    public function getCveAdscripcion(){
        return $this->cveAdscripcion;
    }
    public function setCveAdscripcion($cveAdscripcion){
        $this->cveAdscripcion=$cveAdscripcion;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }
    public function setFechaRegistro($fechaRegistro){
        $this->fechaRegistro=$fechaRegistro;
    }
    public function getFechaActualizacion(){
        return $this->fechaActualizacion;
    }
    public function setFechaActualizacion($fechaActualizacion){
        $this->fechaActualizacion=$fechaActualizacion;
    }
    public function toString(){
        return array("cveOficialia"=>$this->cveOficialia,
"desOficilia"=>$this->desOficilia,
"cveDistrito"=>$this->cveDistrito,
"cveMunicipio"=>$this->cveMunicipio,
"cveAdscripcion"=>$this->cveAdscripcion,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>