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

class PromoventesactuacionesDTO {
    private $idPromoventeActuacion;
    private $idActuacion;
    private $cveTipoParte;
    private $cveTipoPersona;
    private $nombre;
    private $paterno;
    private $materno;
    private $activo;
    private $nombrePersonaMoral;
    private $cedula;
    private $cveGenero;
    public function getIdPromoventeActuacion(){
        return $this->idPromoventeActuacion;
    }
    public function setIdPromoventeActuacion($idPromoventeActuacion){
        $this->idPromoventeActuacion=$idPromoventeActuacion;
    }
    public function getIdActuacion(){
        return $this->idActuacion;
    }
    public function setIdActuacion($idActuacion){
        $this->idActuacion=$idActuacion;
    }
    public function getCveTipoParte(){
        return $this->cveTipoParte;
    }
    public function setCveTipoParte($cveTipoParte){
        $this->cveTipoParte=$cveTipoParte;
    }
    public function getCveTipoPersona(){
        return $this->cveTipoPersona;
    }
    public function setCveTipoPersona($cveTipoPersona){
        $this->cveTipoPersona=$cveTipoPersona;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getPaterno(){
        return $this->paterno;
    }
    public function setPaterno($paterno){
        $this->paterno=$paterno;
    }
    public function getMaterno(){
        return $this->materno;
    }
    public function setMaterno($materno){
        $this->materno=$materno;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
    }
    public function getNombrePersonaMoral(){
        return $this->nombrePersonaMoral;
    }
    public function setNombrePersonaMoral($nombrePersonaMoral){
        $this->nombrePersonaMoral=$nombrePersonaMoral;
    }
    public function getCedula(){
        return $this->cedula;
    }
    public function setCedula($cedula){
        $this->cedula=$cedula;
    }
    public function getCveGenero(){
        return $this->cveGenero;
    }
    public function setCveGenero($cveGenero){
        $this->cveGenero=$cveGenero;
    }
    public function toString(){
        return array("idPromoventeActuacion"=>$this->idPromoventeActuacion,
"idActuacion"=>$this->idActuacion,
"cveTipoParte"=>$this->cveTipoParte,
"cveTipoPersona"=>$this->cveTipoPersona,
"nombre"=>$this->nombre,
"paterno"=>$this->paterno,
"materno"=>$this->materno,
"activo"=>$this->activo,
"nombrePersonaMoral"=>$this->nombrePersonaMoral,
"cedula"=>$this->cedula,
"cveGenero"=>$this->cveGenero);
    }
}
?>