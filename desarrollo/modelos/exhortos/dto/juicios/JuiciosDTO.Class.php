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

class JuiciosDTO {
    private $cveJuicio;
    private $cveMateria;
    private $desJuicioDelito;
    private $fundamento;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveJuicio(){
        return $this->cveJuicio;
    }
    public function setCveJuicio($cveJuicio){
        $this->cveJuicio=$cveJuicio;
    }
    public function getCveMateria(){
        return $this->cveMateria;
    }
    public function setCveMateria($cveMateria){
        $this->cveMateria=$cveMateria;
    }
    public function getDesJuicioDelito(){
        return $this->desJuicioDelito;
    }
    public function setDesJuicioDelito($desJuicioDelito){
        $this->desJuicioDelito=$desJuicioDelito;
    }
    public function getFundamento(){
        return $this->fundamento;
    }
    public function setFundamento($fundamento){
        $this->fundamento=$fundamento;
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
        return array("cveJuicio"=>$this->cveJuicio,
"cveMateria"=>$this->cveMateria,
"desJuicioDelito"=>$this->desJuicioDelito,
"fundamento"=>$this->fundamento,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>