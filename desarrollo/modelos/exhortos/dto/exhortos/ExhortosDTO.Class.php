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

class ExhortosDTO {
    private $idExhorto;
    private $IdExhortoGenerado;
    private $numExhorto;
    private $aniExhorto;
    private $cveJuzgado;
    private $numeroExp;
    private $anioExp;
    private $cveJuzgadoProcedencia;
    private $juzgadoProcedencia;
    private $cveEstadoProcedencia;
    private $carpetaInv;
    private $nuc;
    private $cveMateria;
    private $cveCuantia;
    private $noFojas;
    private $numOficio;
    private $sintesis;
    private $observaciones;
    private $cveConsignacion;
    private $cveEstatusExhorto;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    private $cveEstadoDestino;
    private $cveJuicio;
    private $cveOficialia;
    private $partes;
    private $pagina;
    public function getIdExhorto(){
        return $this->idExhorto;
    }
    public function setIdExhorto($idExhorto){
        $this->idExhorto=$idExhorto;
    }
    public function getIdExhortoGenerado(){
        return $this->IdExhortoGenerado;
    }
    public function setIdExhortoGenerado($IdExhortoGenerado){
        $this->IdExhortoGenerado=$IdExhortoGenerado;
    }
    public function getNumExhorto(){
        return $this->numExhorto;
    }
    public function setNumExhorto($numExhorto){
        $this->numExhorto=$numExhorto;
    }
    public function getAniExhorto(){
        return $this->aniExhorto;
    }
    public function setAniExhorto($aniExhorto){
        $this->aniExhorto=$aniExhorto;
    }
    public function getCveJuzgado(){
        return $this->cveJuzgado;
    }
    public function setCveJuzgado($cveJuzgado){
        $this->cveJuzgado=$cveJuzgado;
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
    public function getCveJuzgadoProcedencia(){
        return $this->cveJuzgadoProcedencia;
    }
    public function setCveJuzgadoProcedencia($cveJuzgadoProcedencia){
        $this->cveJuzgadoProcedencia=$cveJuzgadoProcedencia;
    }
    public function getJuzgadoProcedencia(){
        return $this->juzgadoProcedencia;
    }
    public function setJuzgadoProcedencia($juzgadoProcedencia){
        $this->juzgadoProcedencia=$juzgadoProcedencia;
    }
    public function getCveEstadoProcedencia(){
        return $this->cveEstadoProcedencia;
    }
    public function setCveEstadoProcedencia($cveEstadoProcedencia){
        $this->cveEstadoProcedencia=$cveEstadoProcedencia;
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
    public function getCveEstatusExhorto(){
        return $this->cveEstatusExhorto;
    }
    public function setCveEstatusExhorto($cveEstatusExhorto){
        $this->cveEstatusExhorto=$cveEstatusExhorto;
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
    public function getCveEstadoDestino(){
        return $this->cveEstadoDestino;
    }
    public function setCveEstadoDestino($cveEstadoDestino){
        $this->cveEstadoDestino=$cveEstadoDestino;
    }
    public function getCveJuicio(){
        return $this->cveJuicio;
    }
    public function setCveJuicio($cveJuicio){
        $this->cveJuicio=$cveJuicio;
    }
    public function getCveOficialia(){
        return $this->cveOficialia;
    }
    public function setCveOficialia($cveOficialia){
        $this->cveOficialia=$cveOficialia;
    }
    public function getPartes(){
        return $this->partes;
    }
    public function setPartes($partes){
        $this->partes=$partes;
    }
    public function getNumeroRegistros(){
        return $this->numeroRegistros;
    }
    public function setNumeroRegistros($numeroRegistros){
        $this->numeroRegistros=$numeroRegistros;
    }
    public function getPagina(){
        return $this->pagina;
    }
    public function setPagina($pagina){
        $this->pagina=$pagina;
    }
    public function toString(){
        return array("idExhorto"=>$this->idExhorto,
                        "IdExhortoGenerado"=>$this->IdExhortoGenerado,
                        "numExhorto"=>$this->numExhorto,
                        "aniExhorto"=>$this->aniExhorto,
                        "cveJuzgado"=>$this->cveJuzgado,
                        "numeroExp"=>$this->numeroExp,
                        "anioExp"=>$this->anioExp,
                        "cveJuzgadoProcedencia"=>$this->cveJuzgadoProcedencia,
                        "juzgadoProcedencia"=>$this->juzgadoProcedencia,
                        "cveEstadoProcedencia"=>$this->cveEstadoProcedencia,
                        "carpetaInv"=>$this->carpetaInv,
                        "nuc"=>$this->nuc,
                        "cveMateria"=>$this->cveMateria,
                        "cveCuantia"=>$this->cveCuantia,
                        "noFojas"=>$this->noFojas,
                        "numOficio"=>$this->numOficio,
                        "sintesis"=>$this->sintesis,
                        "observaciones"=>$this->observaciones,
                        "cveConsignacion"=>$this->cveConsignacion,
                        "cveEstatusExhorto"=>$this->cveEstatusExhorto,
                        "activo"=>$this->activo,
                        "fechaRegistro"=>$this->fechaRegistro,
                        "fechaActualizacion"=>$this->fechaActualizacion,
                        "cveEstadoDestino"=>$this->cveEstadoDestino,
                        "cveJuicio"=>$this->cveJuicio,
                        "partes"=>$this->partes,
                        "numeroRegistros"=>$this->numeroRegistros,
                        "pagina"=>$this->pagina);
    }
}
?>