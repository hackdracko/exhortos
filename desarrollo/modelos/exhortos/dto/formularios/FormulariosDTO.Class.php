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

class FormulariosDTO {
    private $cveFormulario;
    private $nomFormulario;
    private $activo;
    private $cveSistema;
    private $ruta;
    private $desFormulario;
    private $orden;
    private $padre;
    private $nivel;
    private $vista;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveFormulario(){
        return $this->cveFormulario;
    }
    public function setCveFormulario($cveFormulario){
        $this->cveFormulario=$cveFormulario;
    }
    public function getNomFormulario(){
        return $this->nomFormulario;
    }
    public function setNomFormulario($nomFormulario){
        $this->nomFormulario=$nomFormulario;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function getCveSistema(){
        return $this->cveSistema;
    }
    public function setCveSistema($cveSistema){
        $this->cveSistema=$cveSistema;
    }
    public function getRuta(){
        return $this->ruta;
    }
    public function setRuta($ruta){
        $this->ruta=$ruta;
    }
    public function getDesFormulario(){
        return $this->desFormulario;
    }
    public function setDesFormulario($desFormulario){
        $this->desFormulario=$desFormulario;
    }
    public function getOrden(){
        return $this->orden;
    }
    public function setOrden($orden){
        $this->orden=$orden;
    }
    public function getPadre(){
        return $this->padre;
    }
    public function setPadre($padre){
        $this->padre=$padre;
    }
    public function getNivel(){
        return $this->nivel;
    }
    public function setNivel($nivel){
        $this->nivel=$nivel;
    }
    public function getVista(){
        return $this->vista;
    }
    public function setVista($vista){
        $this->vista=$vista;
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
        return array("cveFormulario"=>$this->cveFormulario,
"nomFormulario"=>$this->nomFormulario,
"activo"=>$this->activo,
"cveSistema"=>$this->cveSistema,
"ruta"=>$this->ruta,
"desFormulario"=>$this->desFormulario,
"orden"=>$this->orden,
"padre"=>$this->padre,
"nivel"=>$this->nivel,
"vista"=>$this->vista,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>