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

class ExhortosgeneradosDTO {
    private $idExhortoGenerado;
    private $idActuacion;
    private $cveEstatusExhorto;
    private $cveEstadoDestino;
    private $cveOficialia;
    private $numero;
    private $anio;
    private $idExhortoDestino;
    private $requisitoria;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdExhortoGenerado(){
        return $this->idExhortoGenerado;
    }
    public function setIdExhortoGenerado($idExhortoGenerado){
        $this->idExhortoGenerado=$idExhortoGenerado;
    }
    public function getIdActuacion(){
        return $this->idActuacion;
    }
    public function setIdActuacion($idActuacion){
        $this->idActuacion=$idActuacion;
    }
    public function getCveEstatusExhorto(){
        return $this->cveEstatusExhorto;
    }
    public function setCveEstatusExhorto($cveEstatusExhorto){
        $this->cveEstatusExhorto=$cveEstatusExhorto;
    }
    public function getCveEstadoDestino(){
        return $this->cveEstadoDestino;
    }
    public function setCveEstadoDestino($cveEstadoDestino){
        $this->cveEstadoDestino=$cveEstadoDestino;
    }
    public function getCveOficialia(){
        return $this->cveOficialia;
    }
    public function setCveOficialia($cveOficialia){
        $this->cveOficialia=$cveOficialia;
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
    public function getIdExhortoDestino(){
        return $this->idExhortoDestino;
    }
    public function setIdExhortoDestino($idExhortoDestino){
        $this->idExhortoDestino=$idExhortoDestino;
    }
    public function getRequisitoria(){
        return $this->requisitoria;
    }
    public function setRequisitoria($requisitoria){
        $this->requisitoria=$requisitoria;
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
        return array("idExhortoGenerado"=>$this->idExhortoGenerado,
"idActuacion"=>$this->idActuacion,
"cveEstatusExhorto"=>$this->cveEstatusExhorto,
"cveEstadoDestino"=>$this->cveEstadoDestino,
"cveOficialia"=>$this->cveOficialia,
"numero"=>$this->numero,
"anio"=>$this->anio,
"idExhortoDestino"=>$this->idExhortoDestino,
"requisitoria"=>$this->requisitoria,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>