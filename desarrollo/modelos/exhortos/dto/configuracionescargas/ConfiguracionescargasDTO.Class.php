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

class ConfiguracionescargasDTO {
    private $cveConfiguracionCarga;
    private $cveOficialia;
    private $topeCarga;
    private $tipoOficialia;
    private $activo;
    private $fechaActualizacion;
    private $fechaRegistro;
    private $inicia;
    private $termina;
    public function getCveConfiguracionCarga(){
        return $this->cveConfiguracionCarga;
    }
    public function setCveConfiguracionCarga($cveConfiguracionCarga){
        $this->cveConfiguracionCarga=$cveConfiguracionCarga;
    }
    public function getCveOficialia(){
        return $this->cveOficialia;
    }
    public function setCveOficialia($cveOficialia){
        $this->cveOficialia=$cveOficialia;
    }
    public function getTopeCarga(){
        return $this->topeCarga;
    }
    public function setTopeCarga($topeCarga){
        $this->topeCarga=$topeCarga;
    }
    public function getTipoOficialia(){
        return $this->tipoOficialia;
    }
    public function setTipoOficialia($tipoOficialia){
        $this->tipoOficialia=$tipoOficialia;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function getFechaActualizacion(){
        return $this->fechaActualizacion;
    }
    public function setFechaActualizacion($fechaActualizacion){
        $this->fechaActualizacion=$fechaActualizacion;
    }
    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }
    public function setFechaRegistro($fechaRegistro){
        $this->fechaRegistro=$fechaRegistro;
    }
    public function getInicia(){
        return $this->inicia;
    }
    public function setInicia($inicia){
        $this->inicia=$inicia;
    }
    public function getTermina(){
        return $this->termina;
    }
    public function setTermina($termina){
        $this->termina=$termina;
    }
    public function toString(){
        return array("cveConfiguracionCarga"=>$this->cveConfiguracionCarga,
"cveOficialia"=>$this->cveOficialia,
"topeCarga"=>$this->topeCarga,
"tipoOficialia"=>$this->tipoOficialia,
"activo"=>$this->activo,
"fechaActualizacion"=>$this->fechaActualizacion,
"fechaRegistro"=>$this->fechaRegistro,
"inicia"=>$this->inicia,
"termina"=>$this->termina);
    }
}
?>