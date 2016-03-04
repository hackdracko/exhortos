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

class CuantiasDTO {
    private $cveCuantia;
    private $desCuantia;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveCuantia(){
        return $this->cveCuantia;
    }
    public function setCveCuantia($cveCuantia){
        $this->cveCuantia=$cveCuantia;
    }
    public function getDesCuantia(){
        return $this->desCuantia;
    }
    public function setDesCuantia($desCuantia){
        $this->desCuantia=$desCuantia;
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
        return array("cveCuantia"=>$this->cveCuantia,
"desCuantia"=>$this->desCuantia,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>