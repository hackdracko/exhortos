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

class JuzgadosmateriasDTO {
    private $cveJuzgadoMateria;
    private $cveJuzgado;
    private $cveMateria;
    private $cveCuantia;
    private $cveTipo;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveJuzgadoMateria(){
        return $this->cveJuzgadoMateria;
    }
    public function setCveJuzgadoMateria($cveJuzgadoMateria){
        $this->cveJuzgadoMateria=$cveJuzgadoMateria;
    }
    public function getCveJuzgado(){
        return $this->cveJuzgado;
    }
    public function setCveJuzgado($cveJuzgado){
        $this->cveJuzgado=$cveJuzgado;
    }
    public function getCveMateria(){
        return $this->cveMateria;
    }
    public function setCveMateria($cveMateria){
        $this->cveMateria=$cveMateria;
    }
    public function getCveCuantia(){
        return $this->cveCuantia;
    }
    public function setCveCuantia($cveCuantia){
        $this->cveCuantia=$cveCuantia;
    }
    public function getCveTipo(){
        return $this->cveTipo;
    }
    public function setCveTipo($cveTipo){
        $this->cveTipo=$cveTipo;
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
        return array("cveJuzgadoMateria"=>$this->cveJuzgadoMateria,
"cveJuzgado"=>$this->cveJuzgado,
"cveMateria"=>$this->cveMateria,
"cveCuantia"=>$this->cveCuantia,
"cveTipo"=>$this->cveTipo,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>