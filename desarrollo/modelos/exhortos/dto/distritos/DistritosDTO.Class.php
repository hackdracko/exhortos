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

class DistritosDTO {
    private $cveDistrito;
    private $desDistrito;
    private $cveEstado;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveDistrito(){
        return $this->cveDistrito;
    }
    public function setCveDistrito($cveDistrito){
        $this->cveDistrito=$cveDistrito;
    }
    public function getDesDistrito(){
        return $this->desDistrito;
    }
    public function setDesDistrito($desDistrito){
        $this->desDistrito=$desDistrito;
    }
    public function getCveEstado(){
        return $this->cveEstado;
    }
    public function setCveEstado($cveEstado){
        $this->cveEstado=$cveEstado;
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
        return array("cveDistrito"=>$this->cveDistrito,
"desDistrito"=>$this->desDistrito,
"cveEstado"=>$this->cveEstado,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>