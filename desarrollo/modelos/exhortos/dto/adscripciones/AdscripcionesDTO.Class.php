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

class AdscripcionesDTO {
    private $cveAdscripcion;
    private $desAdscripcion;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveAdscripcion(){
        return $this->cveAdscripcion;
    }
    public function setCveAdscripcion($cveAdscripcion){
        $this->cveAdscripcion=$cveAdscripcion;
    }
    public function getDesAdscripcion(){
        return $this->desAdscripcion;
    }
    public function setDesAdscripcion($desAdscripcion){
        $this->desAdscripcion=$desAdscripcion;
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
        return array("cveAdscripcion"=>$this->cveAdscripcion,
"desAdscripcion"=>$this->desAdscripcion,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>