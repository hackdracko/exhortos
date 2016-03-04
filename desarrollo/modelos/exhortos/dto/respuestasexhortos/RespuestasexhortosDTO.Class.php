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

class RespuestasexhortosDTO {
    private $idRespuestaExhorto;
    private $idExhorto;
    private $idActuacion;
    private $cveEstadoDestino;
    private $numPromocion;
    private $aniPromocion;
    private $idActuacionPromocion;
    private $cveEstatusExhortos;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdRespuestaExhorto(){
        return $this->idRespuestaExhorto;
    }
    public function setIdRespuestaExhorto($idRespuestaExhorto){
        $this->idRespuestaExhorto=$idRespuestaExhorto;
    }
    public function getIdExhorto(){
        return $this->idExhorto;
    }
    public function setIdExhorto($idExhorto){
        $this->idExhorto=$idExhorto;
    }
    public function getIdActuacion(){
        return $this->idActuacion;
    }
    public function setIdActuacion($idActuacion){
        $this->idActuacion=$idActuacion;
    }
    public function getCveEstadoDestino(){
        return $this->cveEstadoDestino;
    }
    public function setCveEstadoDestino($cveEstadoDestino){
        $this->cveEstadoDestino=$cveEstadoDestino;
    }
    public function getNumPromocion(){
        return $this->numPromocion;
    }
    public function setNumPromocion($numPromocion){
        $this->numPromocion=$numPromocion;
    }
    public function getAniPromocion(){
        return $this->aniPromocion;
    }
    public function setAniPromocion($aniPromocion){
        $this->aniPromocion=$aniPromocion;
    }
    public function getIdActuacionPromocion(){
        return $this->idActuacionPromocion;
    }
    public function setIdActuacionPromocion($idActuacionPromocion){
        $this->idActuacionPromocion=$idActuacionPromocion;
    }
    public function getCveEstatusExhortos(){
        return $this->cveEstatusExhortos;
    }
    public function setCveEstatusExhortos($cveEstatusExhortos){
        $this->cveEstatusExhortos=$cveEstatusExhortos;
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
        return array("idRespuestaExhorto"=>$this->idRespuestaExhorto,
"idExhorto"=>$this->idExhorto,
"idActuacion"=>$this->idActuacion,
"cveEstadoDestino"=>$this->cveEstadoDestino,
"numPromocion"=>$this->numPromocion,
"aniPromocion"=>$this->aniPromocion,
"idActuacionPromocion"=>$this->idActuacionPromocion,
"cveEstatusExhortos"=>$this->cveEstatusExhortos,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>