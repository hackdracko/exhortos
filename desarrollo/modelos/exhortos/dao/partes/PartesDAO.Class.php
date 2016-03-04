<?php
 /*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 DAOS
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/partes/PartesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class PartesDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertPartes($partesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblpartes(";
if($partesDto->getIdParte()!=""){
$sql.="idParte";
if(($partesDto->getIdExhorto()!="") ||($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhorto()!=""){
$sql.="idExhorto";
if(($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado";
if(($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getNombre()!=""){
$sql.="nombre";
if(($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getPaterno()!=""){
$sql.="paterno";
if(($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getMaterno()!=""){
$sql.="materno";
if(($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral";
if(($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona";
if(($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte";
if(($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getEdad()!=""){
$sql.="edad";
if(($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getFechaNacimiento()!=""){
$sql.="fechaNacimiento";
if(($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getRFC()!=""){
$sql.="RFC";
if(($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCURP()!=""){
$sql.="CURP";
if(($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveEstado()!=""){
$sql.="cveEstado";
if(($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveMunicipio()!=""){
$sql.="cveMunicipio";
if(($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getDomicilio()!=""){
$sql.="domicilio";
if(($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getTelefono()!=""){
$sql.="telefono";
if(($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getEmail()!=""){
$sql.="email";
if(($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveGenero()!=""){
$sql.="cveGenero";
if(($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getDetenido()!=""){
$sql.="detenido";
if(($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($partesDto->getIdParte()!=""){
$sql.="'".$partesDto->getIdParte()."'";
if(($partesDto->getIdExhorto()!="") ||($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhorto()!=""){
$sql.="'".$partesDto->getIdExhorto()."'";
if(($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhortoGenerado()!=""){
$sql.="'".$partesDto->getIdExhortoGenerado()."'";
if(($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getNombre()!=""){
$sql.="'".$partesDto->getNombre()."'";
if(($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getPaterno()!=""){
$sql.="'".$partesDto->getPaterno()."'";
if(($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getMaterno()!=""){
$sql.="'".$partesDto->getMaterno()."'";
if(($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getNombrePersonaMoral()!=""){
$sql.="'".$partesDto->getNombrePersonaMoral()."'";
if(($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoPersona()!=""){
$sql.="'".$partesDto->getCveTipoPersona()."'";
if(($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoParte()!=""){
$sql.="'".$partesDto->getCveTipoParte()."'";
if(($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getEdad()!=""){
$sql.="'".$partesDto->getEdad()."'";
if(($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getFechaNacimiento()!=""){
$sql.="'".$partesDto->getFechaNacimiento()."'";
if(($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getRFC()!=""){
$sql.="'".$partesDto->getRFC()."'";
if(($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCURP()!=""){
$sql.="'".$partesDto->getCURP()."'";
if(($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveEstado()!=""){
$sql.="'".$partesDto->getCveEstado()."'";
if(($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveMunicipio()!=""){
$sql.="'".$partesDto->getCveMunicipio()."'";
if(($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getDomicilio()!=""){
$sql.="'".$partesDto->getDomicilio()."'";
if(($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getTelefono()!=""){
$sql.="'".$partesDto->getTelefono()."'";
if(($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getEmail()!=""){
$sql.="'".$partesDto->getEmail()."'";
if(($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getCveGenero()!=""){
$sql.="'".$partesDto->getCveGenero()."'";
if(($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getDetenido()!=""){
$sql.="'".$partesDto->getDetenido()."'";
if(($partesDto->getActivo()!="") ){
$sql.=",";
}
}
if($partesDto->getActivo()!=""){
$sql.="'".$partesDto->getActivo()."'";
}
if($partesDto->getFechaRegistro()!=""){
}
if($partesDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PartesDTO();
$tmp->setidParte($this->_proveedor->lastID());
$tmp = $this->selectPartes($tmp,"",$this->_proveedor);
} else {
    $error = true;
}
if ($proveedor == null) {
    $this->_proveedor->close();
}
unset($contador);
unset($sql);
return $tmp;
}
public function updatePartes($partesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblpartes SET ";
if($partesDto->getIdParte()!=""){
$sql.="idParte='".$partesDto->getIdParte()."'";
if(($partesDto->getIdExhorto()!="") ||($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhorto()!=""){
$sql.="idExhorto='".$partesDto->getIdExhorto()."'";
if(($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$partesDto->getIdExhortoGenerado()."'";
if(($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getNombre()!=""){
$sql.="nombre='".$partesDto->getNombre()."'";
if(($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getPaterno()!=""){
$sql.="paterno='".$partesDto->getPaterno()."'";
if(($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getMaterno()!=""){
$sql.="materno='".$partesDto->getMaterno()."'";
if(($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral='".$partesDto->getNombrePersonaMoral()."'";
if(($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona='".$partesDto->getCveTipoPersona()."'";
if(($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$partesDto->getCveTipoParte()."'";
if(($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getEdad()!=""){
$sql.="edad='".$partesDto->getEdad()."'";
if(($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getFechaNacimiento()!=""){
$sql.="fechaNacimiento='".$partesDto->getFechaNacimiento()."'";
if(($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getRFC()!=""){
$sql.="RFC='".$partesDto->getRFC()."'";
if(($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCURP()!=""){
$sql.="CURP='".$partesDto->getCURP()."'";
if(($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCveEstado()!=""){
$sql.="cveEstado='".$partesDto->getCveEstado()."'";
if(($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCveMunicipio()!=""){
$sql.="cveMunicipio='".$partesDto->getCveMunicipio()."'";
if(($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getDomicilio()!=""){
$sql.="domicilio='".$partesDto->getDomicilio()."'";
if(($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getTelefono()!=""){
$sql.="telefono='".$partesDto->getTelefono()."'";
if(($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getEmail()!=""){
$sql.="email='".$partesDto->getEmail()."'";
if(($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getCveGenero()!=""){
$sql.="cveGenero='".$partesDto->getCveGenero()."'";
if(($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getDetenido()!=""){
$sql.="detenido='".$partesDto->getDetenido()."'";
if(($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getActivo()!=""){
$sql.="activo='".$partesDto->getActivo()."'";
if(($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$partesDto->getFechaRegistro()."'";
if(($partesDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($partesDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$partesDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idParte='".$partesDto->getIdParte()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PartesDTO();
$tmp->setidParte($partesDto->getIdParte());
$tmp = $this->selectPartes($tmp,"",$this->_proveedor);
} else {
    $error = true;
}
if ($proveedor == null) {
    $this->_proveedor->close();
}
unset($contador);
unset($sql);
return $tmp;
}
public function deletePartes($partesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblpartes  WHERE idParte='".$partesDto->getIdParte()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = true;
} else {
$tmp = false;
}
if ($proveedor == null) {
    $this->_proveedor->close();
}
unset($contador);
unset($sql);
return $tmp;
}
public function selectPartes($partesDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idParte,idExhorto,idExhortoGenerado,nombre,paterno,materno,nombrePersonaMoral,cveTipoPersona,cveTipoParte,edad,fechaNacimiento,RFC,CURP,cveEstado,cveMunicipio,domicilio,telefono,email,cveGenero,detenido,activo,fechaRegistro,fechaActualizacion FROM tblpartes ";
if(($partesDto->getIdParte()!="") ||($partesDto->getIdExhorto()!="") ||($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($partesDto->getIdParte()!=""){
$sql.="idParte='".$partesDto->getIdParte()."'";
if(($partesDto->getIdExhorto()!="") ||($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getIdExhorto()!=""){
$sql.="idExhorto='".$partesDto->getIdExhorto()."'";
if(($partesDto->getIdExhortoGenerado()!="") ||($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$partesDto->getIdExhortoGenerado()."'";
if(($partesDto->getNombre()!="") ||($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getNombre()!=""){
$sql.="nombre='".$partesDto->getNombre()."'";
if(($partesDto->getPaterno()!="") ||($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getPaterno()!=""){
$sql.="paterno='".$partesDto->getPaterno()."'";
if(($partesDto->getMaterno()!="") ||($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getMaterno()!=""){
$sql.="materno='".$partesDto->getMaterno()."'";
if(($partesDto->getNombrePersonaMoral()!="") ||($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral='".$partesDto->getNombrePersonaMoral()."'";
if(($partesDto->getCveTipoPersona()!="") ||($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona='".$partesDto->getCveTipoPersona()."'";
if(($partesDto->getCveTipoParte()!="") ||($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$partesDto->getCveTipoParte()."'";
if(($partesDto->getEdad()!="") ||($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getEdad()!=""){
$sql.="edad='".$partesDto->getEdad()."'";
if(($partesDto->getFechaNacimiento()!="") ||($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getFechaNacimiento()!=""){
$sql.="fechaNacimiento='".$partesDto->getFechaNacimiento()."'";
if(($partesDto->getRFC()!="") ||($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getRFC()!=""){
$sql.="RFC='".$partesDto->getRFC()."'";
if(($partesDto->getCURP()!="") ||($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCURP()!=""){
$sql.="CURP='".$partesDto->getCURP()."'";
if(($partesDto->getCveEstado()!="") ||($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCveEstado()!=""){
$sql.="cveEstado='".$partesDto->getCveEstado()."'";
if(($partesDto->getCveMunicipio()!="") ||($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCveMunicipio()!=""){
$sql.="cveMunicipio='".$partesDto->getCveMunicipio()."'";
if(($partesDto->getDomicilio()!="") ||($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getDomicilio()!=""){
$sql.="domicilio='".$partesDto->getDomicilio()."'";
if(($partesDto->getTelefono()!="") ||($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getTelefono()!=""){
$sql.="telefono='".$partesDto->getTelefono()."'";
if(($partesDto->getEmail()!="") ||($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getEmail()!=""){
$sql.="email='".$partesDto->getEmail()."'";
if(($partesDto->getCveGenero()!="") ||($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getCveGenero()!=""){
$sql.="cveGenero='".$partesDto->getCveGenero()."'";
if(($partesDto->getDetenido()!="") ||($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getDetenido()!=""){
$sql.="detenido='".$partesDto->getDetenido()."'";
if(($partesDto->getActivo()!="") ||($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getActivo()!=""){
$sql.="activo='".$partesDto->getActivo()."'";
if(($partesDto->getFechaRegistro()!="") ||($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$partesDto->getFechaRegistro()."'";
if(($partesDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($partesDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$partesDto->getFechaActualizacion()."'";
}
if($orden!=""){
$sql.=$orden;
}else{
$sql.="";
}
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
$tmp[$contador] = new PartesDTO();
$tmp[$contador]->setIdParte($row["idParte"]);
$tmp[$contador]->setIdExhorto($row["idExhorto"]);
$tmp[$contador]->setIdExhortoGenerado($row["idExhortoGenerado"]);
$tmp[$contador]->setNombre($row["nombre"]);
$tmp[$contador]->setPaterno($row["paterno"]);
$tmp[$contador]->setMaterno($row["materno"]);
$tmp[$contador]->setNombrePersonaMoral($row["nombrePersonaMoral"]);
$tmp[$contador]->setCveTipoPersona($row["cveTipoPersona"]);
$tmp[$contador]->setCveTipoParte($row["cveTipoParte"]);
$tmp[$contador]->setEdad($row["edad"]);
$tmp[$contador]->setFechaNacimiento($row["fechaNacimiento"]);
$tmp[$contador]->setRFC($row["RFC"]);
$tmp[$contador]->setCURP($row["CURP"]);
$tmp[$contador]->setCveEstado($row["cveEstado"]);
$tmp[$contador]->setCveMunicipio($row["cveMunicipio"]);
$tmp[$contador]->setDomicilio($row["domicilio"]);
$tmp[$contador]->setTelefono($row["telefono"]);
$tmp[$contador]->setEmail($row["email"]);
$tmp[$contador]->setCveGenero($row["cveGenero"]);
$tmp[$contador]->setDetenido($row["detenido"]);
$tmp[$contador]->setActivo($row["activo"]);
$tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
$tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
$contador++;
}
} else {
$error = true;
}
} else {
    $error = true;
}
if ($proveedor == null) {
    $this->_proveedor->close();
}
unset($contador);
unset($sql);
return $tmp;
}
}
?>