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

class PerfilesDTO {
    private $cvePerfil;
    private $cveGrupo;
    private $cveUsuario;
    private $cveSistema;
    private $cveAdscripcion;
    private $fechaRegistro;
    private $fechaActualizacion;
    private $activo;
    public function getCvePerfil(){
        return $this->cvePerfil;
    }
    public function setCvePerfil($cvePerfil){
        $this->cvePerfil=$cvePerfil;
    }
    public function getCveGrupo(){
        return $this->cveGrupo;
    }
    public function setCveGrupo($cveGrupo){
        $this->cveGrupo=$cveGrupo;
    }
    public function getCveUsuario(){
        return $this->cveUsuario;
    }
    public function setCveUsuario($cveUsuario){
        $this->cveUsuario=$cveUsuario;
    }
    public function getCveSistema(){
        return $this->cveSistema;
    }
    public function setCveSistema($cveSistema){
        $this->cveSistema=$cveSistema;
    }
    public function getCveAdscripcion(){
        return $this->cveAdscripcion;
    }
    public function setCveAdscripcion($cveAdscripcion){
        $this->cveAdscripcion=$cveAdscripcion;
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
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function toString(){
        return array("cvePerfil"=>$this->cvePerfil,
"cveGrupo"=>$this->cveGrupo,
"cveUsuario"=>$this->cveUsuario,
"cveSistema"=>$this->cveSistema,
"cveAdscripcion"=>$this->cveAdscripcion,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion,
"activo"=>$this->activo);
    }
}
?>