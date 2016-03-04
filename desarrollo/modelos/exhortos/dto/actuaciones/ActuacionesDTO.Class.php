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

class ActuacionesDTO {
    private $idActuacion;
    private $numActuacion;
    private $aniActuacion;
    private $cveTipoActuacion;
    private $numeroExp;
    private $anioExp;
    private $cveTipo;
    private $carpetaInv;
    private $nuc;
    private $cveMateria;
    private $cveCuantia;
    private $idReferencia;
    private $noFojas;
    private $numOficio;
    private $cveJuzgado;
    private $sintesis;
    private $observaciones;
    private $cveConsignacion;
    private $cveJuzgadoDestino;
    private $juzgadoDestino;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdActuacion(){
        return $this->idActuacion;
    }
    public function setIdActuacion($idActuacion){
        $this->idActuacion=$idActuacion;
    }
    public function getNumActuacion(){
        return $this->numActuacion;
    }
    public function setNumActuacion($numActuacion){
        $this->numActuacion=$numActuacion;
    }
    public function getAniActuacion(){
        return $this->aniActuacion;
    }
    public function setAniActuacion($aniActuacion){
        $this->aniActuacion=$aniActuacion;
    }
    public function getCveTipoActuacion(){
        return $this->cveTipoActuacion;
    }
    public function setCveTipoActuacion($cveTipoActuacion){
        $this->cveTipoActuacion=$cveTipoActuacion;
    }
    public function getNumeroExp(){
        return $this->numeroExp;
    }
    public function setNumeroExp($numeroExp){
        $this->numeroExp=$numeroExp;
    }
    public function getAnioExp(){
        return $this->anioExp;
    }
    public function setAnioExp($anioExp){
        $this->anioExp=$anioExp;
    }
    public function getCveTipo(){
        return $this->cveTipo;
    }
    public function setCveTipo($cveTipo){
        $this->cveTipo=$cveTipo;
    }
    public function getCarpetaInv(){
        return $this->carpetaInv;
    }
    public function setCarpetaInv($carpetaInv){
        $this->carpetaInv=$carpetaInv;
    }
    public function getNuc(){
        return $this->nuc;
    }
    public function setNuc($nuc){
        $this->nuc=$nuc;
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
    public function getIdReferencia(){
        return $this->idReferencia;
    }
    public function setIdReferencia($idReferencia){
        $this->idReferencia=$idReferencia;
    }
    public function getNoFojas(){
        return $this->noFojas;
    }
    public function setNoFojas($noFojas){
        $this->noFojas=$noFojas;
    }
    public function getNumOficio(){
        return $this->numOficio;
    }
    public function setNumOficio($numOficio){
        $this->numOficio=$numOficio;
    }
    public function getCveJuzgado(){
        return $this->cveJuzgado;
    }
    public function setCveJuzgado($cveJuzgado){
        $this->cveJuzgado=$cveJuzgado;
    }
    public function getSintesis(){
        return $this->sintesis;
    }
    public function setSintesis($sintesis){
        $this->sintesis=$sintesis;
    }
    public function getObservaciones(){
        return $this->observaciones;
    }
    public function setObservaciones($observaciones){
        $this->observaciones=$observaciones;
    }
    public function getCveConsignacion(){
        return $this->cveConsignacion;
    }
    public function setCveConsignacion($cveConsignacion){
        $this->cveConsignacion=$cveConsignacion;
    }
    public function getCveJuzgadoDestino(){
        return $this->cveJuzgadoDestino;
    }
    public function setCveJuzgadoDestino($cveJuzgadoDestino){
        $this->cveJuzgadoDestino=$cveJuzgadoDestino;
    }
    public function getJuzgadoDestino(){
        return $this->juzgadoDestino;
    }
    public function setJuzgadoDestino($juzgadoDestino){
        $this->juzgadoDestino=$juzgadoDestino;
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
        return array("idActuacion"=>$this->idActuacion,
"numActuacion"=>$this->numActuacion,
"aniActuacion"=>$this->aniActuacion,
"cveTipoActuacion"=>$this->cveTipoActuacion,
"numeroExp"=>$this->numeroExp,
"anioExp"=>$this->anioExp,
"cveTipo"=>$this->cveTipo,
"carpetaInv"=>$this->carpetaInv,
"nuc"=>$this->nuc,
"cveMateria"=>$this->cveMateria,
"cveCuantia"=>$this->cveCuantia,
"idReferencia"=>$this->idReferencia,
"noFojas"=>$this->noFojas,
"numOficio"=>$this->numOficio,
"cveJuzgado"=>$this->cveJuzgado,
"sintesis"=>$this->sintesis,
"observaciones"=>$this->observaciones,
"cveConsignacion"=>$this->cveConsignacion,
"cveJuzgadoDestino"=>$this->cveJuzgadoDestino,
"juzgadoDestino"=>$this->juzgadoDestino,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>