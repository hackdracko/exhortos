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

class ContadoresDTO {
    private $idContador;
    private $numero;
    private $anio;
    private $cveJuzgado;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    private $cveTipoActuacion;
    public function getIdContador(){
        return $this->idContador;
    }
    public function setIdContador($idContador){
        $this->idContador=$idContador;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero($numero){
        $this->numero=$numero;
    }
    public function getAnio(){
        return $this->anio;
    }
    public function setAnio($anio){
        $this->anio=$anio;
    }
    public function getCveJuzgado(){
        return $this->cveJuzgado;
    }
    public function setCveJuzgado($cveJuzgado){
        $this->cveJuzgado=$cveJuzgado;
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
    public function getCveTipoActuacion(){
        return $this->cveTipoActuacion;
    }
    public function setCveTipoActuacion($cveTipoActuacion){
        $this->cveTipoActuacion=$cveTipoActuacion;
    }
    public function toString(){
        return array("idContador"=>$this->idContador,
"numero"=>$this->numero,
"anio"=>$this->anio,
"cveJuzgado"=>$this->cveJuzgado,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion,
"cveTipoActuacion"=>$this->cveTipoActuacion);
    }
}
?>