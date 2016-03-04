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

class BitacoramovimientosDTO {
    private $idBitacoraMovimiento;
    private $cveAccion;
    private $fechaMovimiento;
    private $observaciones;
    private $cveUsuario;
    private $cvePerfil;
    private $cveAdscripcion;
    public function getIdBitacoraMovimiento(){
        return $this->idBitacoraMovimiento;
    }
    public function setIdBitacoraMovimiento($idBitacoraMovimiento){
        $this->idBitacoraMovimiento=$idBitacoraMovimiento;
    }
    public function getCveAccion(){
        return $this->cveAccion;
    }
    public function setCveAccion($cveAccion){
        $this->cveAccion=$cveAccion;
    }
    public function getFechaMovimiento(){
        return $this->fechaMovimiento;
    }
    public function setFechaMovimiento($fechaMovimiento){
        $this->fechaMovimiento=$fechaMovimiento;
    }
    public function getObservaciones(){
        return $this->observaciones;
    }
    public function setObservaciones($observaciones){
        $this->observaciones=$observaciones;
    }
    public function getCveUsuario(){
        return $this->cveUsuario;
    }
    public function setCveUsuario($cveUsuario){
        $this->cveUsuario=$cveUsuario;
    }
    public function getCvePerfil(){
        return $this->cvePerfil;
    }
    public function setCvePerfil($cvePerfil){
        $this->cvePerfil=$cvePerfil;
    }
    public function getCveAdscripcion(){
        return $this->cveAdscripcion;
    }
    public function setCveAdscripcion($cveAdscripcion){
        $this->cveAdscripcion=$cveAdscripcion;
    }
    public function toString(){
        return array("idBitacoraMovimiento"=>$this->idBitacoraMovimiento,
"cveAccion"=>$this->cveAccion,
"fechaMovimiento"=>$this->fechaMovimiento,
"observaciones"=>$this->observaciones,
"cveUsuario"=>$this->cveUsuario,
"cvePerfil"=>$this->cvePerfil,
"cveAdscripcion"=>$this->cveAdscripcion);
    }
}
?>