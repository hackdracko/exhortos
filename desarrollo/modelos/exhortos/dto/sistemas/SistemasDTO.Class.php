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

class SistemasDTO {
    private $cveSistema;
    private $nomSistema;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveSistema(){
        return $this->cveSistema;
    }
    public function setCveSistema($cveSistema){
        $this->cveSistema=$cveSistema;
    }
    public function getNomSistema(){
        return $this->nomSistema;
    }
    public function setNomSistema($nomSistema){
        $this->nomSistema=$nomSistema;
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
        return array("cveSistema"=>$this->cveSistema,
"nomSistema"=>$this->nomSistema,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>