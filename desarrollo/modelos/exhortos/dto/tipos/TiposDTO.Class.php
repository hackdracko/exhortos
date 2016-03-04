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

class TiposDTO {
    private $cveTipo;
    private $desTipo;
    private $desCarpeta;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveTipo(){
        return $this->cveTipo;
    }
    public function setCveTipo($cveTipo){
        $this->cveTipo=$cveTipo;
    }
    public function getDesTipo(){
        return $this->desTipo;
    }
    public function setDesTipo($desTipo){
        $this->desTipo=$desTipo;
    }
    public function getDesCarpeta(){
        return $this->desCarpeta;
    }
    public function setDesCarpeta($desCarpeta){
        $this->desCarpeta=$desCarpeta;
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
        return array("cveTipo"=>$this->cveTipo,
"desTipo"=>$this->desTipo,
"desCarpeta"=>$this->desCarpeta,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>