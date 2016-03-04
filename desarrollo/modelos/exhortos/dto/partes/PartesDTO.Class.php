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

class PartesDTO {
    private $idParte;
    private $idExhorto;
    private $idExhortoGenerado;
    private $nombre;
    private $paterno;
    private $materno;
    private $nombrePersonaMoral;
    private $cveTipoPersona;
    private $cveTipoParte;
    private $edad;
    private $fechaNacimiento;
    private $RFC;
    private $CURP;
    private $cveEstado;
    private $cveMunicipio;
    private $domicilio;
    private $telefono;
    private $email;
    private $cveGenero;
    private $detenido;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdParte(){
        return $this->idParte;
    }
    public function setIdParte($idParte){
        $this->idParte=$idParte;
    }
    public function getIdExhorto(){
        return $this->idExhorto;
    }
    public function setIdExhorto($idExhorto){
        $this->idExhorto=$idExhorto;
    }
    public function getIdExhortoGenerado(){
        return $this->idExhortoGenerado;
    }
    public function setIdExhortoGenerado($idExhortoGenerado){
        $this->idExhortoGenerado=$idExhortoGenerado;
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
    public function getNombrePersonaMoral(){
        return $this->nombrePersonaMoral;
    }
    public function setNombrePersonaMoral($nombrePersonaMoral){
        $this->nombrePersonaMoral=$nombrePersonaMoral;
    }
    public function getCveTipoPersona(){
        return $this->cveTipoPersona;
    }
    public function setCveTipoPersona($cveTipoPersona){
        $this->cveTipoPersona=$cveTipoPersona;
    }
    public function getCveTipoParte(){
        return $this->cveTipoParte;
    }
    public function setCveTipoParte($cveTipoParte){
        $this->cveTipoParte=$cveTipoParte;
    }
    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($edad){
        $this->edad=$edad;
    }
    public function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento=$fechaNacimiento;
    }
    public function getRFC(){
        return $this->RFC;
    }
    public function setRFC($RFC){
        $this->RFC=$RFC;
    }
    public function getCURP(){
        return $this->CURP;
    }
    public function setCURP($CURP){
        $this->CURP=$CURP;
    }
    public function getCveEstado(){
        return $this->cveEstado;
    }
    public function setCveEstado($cveEstado){
        $this->cveEstado=$cveEstado;
    }
    public function getCveMunicipio(){
        return $this->cveMunicipio;
    }
    public function setCveMunicipio($cveMunicipio){
        $this->cveMunicipio=$cveMunicipio;
    }
    public function getDomicilio(){
        return $this->domicilio;
    }
    public function setDomicilio($domicilio){
        $this->domicilio=$domicilio;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function getCveGenero(){
        return $this->cveGenero;
    }
    public function setCveGenero($cveGenero){
        $this->cveGenero=$cveGenero;
    }
    public function getDetenido(){
        return $this->detenido;
    }
    public function setDetenido($detenido){
        $this->detenido=$detenido;
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
        return array("idParte"=>$this->idParte,
"idExhorto"=>$this->idExhorto,
"idExhortoGenerado"=>$this->idExhortoGenerado,
"nombre"=>$this->nombre,
"paterno"=>$this->paterno,
"materno"=>$this->materno,
"nombrePersonaMoral"=>$this->nombrePersonaMoral,
"cveTipoPersona"=>$this->cveTipoPersona,
"cveTipoParte"=>$this->cveTipoParte,
"edad"=>$this->edad,
"fechaNacimiento"=>$this->fechaNacimiento,
"RFC"=>$this->RFC,
"CURP"=>$this->CURP,
"cveEstado"=>$this->cveEstado,
"cveMunicipio"=>$this->cveMunicipio,
"domicilio"=>$this->domicilio,
"telefono"=>$this->telefono,
"email"=>$this->email,
"cveGenero"=>$this->cveGenero,
"detenido"=>$this->detenido,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>