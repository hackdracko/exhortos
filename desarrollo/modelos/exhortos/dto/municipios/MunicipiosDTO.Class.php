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

class MunicipiosDTO {
    private $cveMunicipio;
    private $desMunicipio;
    private $cveEstado;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveMunicipio(){
        return $this->cveMunicipio;
    }
    public function setCveMunicipio($cveMunicipio){
        $this->cveMunicipio=$cveMunicipio;
    }
    public function getDesMunicipio(){
        return $this->desMunicipio;
    }
    public function setDesMunicipio($desMunicipio){
        $this->desMunicipio=$desMunicipio;
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
        return array("cveMunicipio"=>$this->cveMunicipio,
"desMunicipio"=>$this->desMunicipio,
"cveEstado"=>$this->cveEstado,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>