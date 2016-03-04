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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/promoventesactuaciones/PromoventesactuacionesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class PromoventesactuacionesDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertPromoventesactuaciones($promoventesactuacionesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblpromoventesactuaciones(";
if($promoventesactuacionesDto->getIdPromoventeActuacion()!=""){
$sql.="idPromoventeActuacion";
if(($promoventesactuacionesDto->getIdActuacion()!="") ||($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getIdActuacion()!=""){
$sql.="idActuacion";
if(($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte";
if(($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona";
if(($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombre()!=""){
$sql.="nombre";
if(($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getPaterno()!=""){
$sql.="paterno";
if(($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getMaterno()!=""){
$sql.="materno";
if(($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getActivo()!=""){
$sql.="activo";
if(($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral";
if(($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCedula()!=""){
$sql.="cedula";
if(($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveGenero()!=""){
$sql.="cveGenero";
}
$sql.=") VALUES(";
if($promoventesactuacionesDto->getIdPromoventeActuacion()!=""){
$sql.="'".$promoventesactuacionesDto->getIdPromoventeActuacion()."'";
if(($promoventesactuacionesDto->getIdActuacion()!="") ||($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getIdActuacion()!=""){
$sql.="'".$promoventesactuacionesDto->getIdActuacion()."'";
if(($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoParte()!=""){
$sql.="'".$promoventesactuacionesDto->getCveTipoParte()."'";
if(($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoPersona()!=""){
$sql.="'".$promoventesactuacionesDto->getCveTipoPersona()."'";
if(($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombre()!=""){
$sql.="'".$promoventesactuacionesDto->getNombre()."'";
if(($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getPaterno()!=""){
$sql.="'".$promoventesactuacionesDto->getPaterno()."'";
if(($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getMaterno()!=""){
$sql.="'".$promoventesactuacionesDto->getMaterno()."'";
if(($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getActivo()!=""){
$sql.="'".$promoventesactuacionesDto->getActivo()."'";
if(($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombrePersonaMoral()!=""){
$sql.="'".$promoventesactuacionesDto->getNombrePersonaMoral()."'";
if(($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCedula()!=""){
$sql.="'".$promoventesactuacionesDto->getCedula()."'";
if(($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveGenero()!=""){
$sql.="'".$promoventesactuacionesDto->getCveGenero()."'";
}
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PromoventesactuacionesDTO();
$tmp->setidPromoventeActuacion($this->_proveedor->lastID());
$tmp = $this->selectPromoventesactuaciones($tmp,"",$this->_proveedor);
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
public function updatePromoventesactuaciones($promoventesactuacionesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblpromoventesactuaciones SET ";
if($promoventesactuacionesDto->getIdPromoventeActuacion()!=""){
$sql.="idPromoventeActuacion='".$promoventesactuacionesDto->getIdPromoventeActuacion()."'";
if(($promoventesactuacionesDto->getIdActuacion()!="") ||($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getIdActuacion()!=""){
$sql.="idActuacion='".$promoventesactuacionesDto->getIdActuacion()."'";
if(($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$promoventesactuacionesDto->getCveTipoParte()."'";
if(($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona='".$promoventesactuacionesDto->getCveTipoPersona()."'";
if(($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombre()!=""){
$sql.="nombre='".$promoventesactuacionesDto->getNombre()."'";
if(($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getPaterno()!=""){
$sql.="paterno='".$promoventesactuacionesDto->getPaterno()."'";
if(($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getMaterno()!=""){
$sql.="materno='".$promoventesactuacionesDto->getMaterno()."'";
if(($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getActivo()!=""){
$sql.="activo='".$promoventesactuacionesDto->getActivo()."'";
if(($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral='".$promoventesactuacionesDto->getNombrePersonaMoral()."'";
if(($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCedula()!=""){
$sql.="cedula='".$promoventesactuacionesDto->getCedula()."'";
if(($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=",";
}
}
if($promoventesactuacionesDto->getCveGenero()!=""){
$sql.="cveGenero='".$promoventesactuacionesDto->getCveGenero()."'";
}
$sql.=" WHERE idPromoventeActuacion='".$promoventesactuacionesDto->getIdPromoventeActuacion()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PromoventesactuacionesDTO();
$tmp->setidPromoventeActuacion($promoventesactuacionesDto->getIdPromoventeActuacion());
$tmp = $this->selectPromoventesactuaciones($tmp,"",$this->_proveedor);
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
public function deletePromoventesactuaciones($promoventesactuacionesDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblpromoventesactuaciones  WHERE idPromoventeActuacion='".$promoventesactuacionesDto->getIdPromoventeActuacion()."'";
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
public function selectPromoventesactuaciones($promoventesactuacionesDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idPromoventeActuacion,idActuacion,cveTipoParte,cveTipoPersona,nombre,paterno,materno,activo,nombrePersonaMoral,cedula,cveGenero FROM tblpromoventesactuaciones ";
if(($promoventesactuacionesDto->getIdPromoventeActuacion()!="") ||($promoventesactuacionesDto->getIdActuacion()!="") ||($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" WHERE ";
}
if($promoventesactuacionesDto->getIdPromoventeActuacion()!=""){
$sql.="idPromoventeActuacion='".$promoventesactuacionesDto->getIdPromoventeActuacion()."'";
if(($promoventesactuacionesDto->getIdActuacion()!="") ||($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getIdActuacion()!=""){
$sql.="idActuacion='".$promoventesactuacionesDto->getIdActuacion()."'";
if(($promoventesactuacionesDto->getCveTipoParte()!="") ||($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$promoventesactuacionesDto->getCveTipoParte()."'";
if(($promoventesactuacionesDto->getCveTipoPersona()!="") ||($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getCveTipoPersona()!=""){
$sql.="cveTipoPersona='".$promoventesactuacionesDto->getCveTipoPersona()."'";
if(($promoventesactuacionesDto->getNombre()!="") ||($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getNombre()!=""){
$sql.="nombre='".$promoventesactuacionesDto->getNombre()."'";
if(($promoventesactuacionesDto->getPaterno()!="") ||($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getPaterno()!=""){
$sql.="paterno='".$promoventesactuacionesDto->getPaterno()."'";
if(($promoventesactuacionesDto->getMaterno()!="") ||($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getMaterno()!=""){
$sql.="materno='".$promoventesactuacionesDto->getMaterno()."'";
if(($promoventesactuacionesDto->getActivo()!="") ||($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getActivo()!=""){
$sql.="activo='".$promoventesactuacionesDto->getActivo()."'";
if(($promoventesactuacionesDto->getNombrePersonaMoral()!="") ||($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getNombrePersonaMoral()!=""){
$sql.="nombrePersonaMoral='".$promoventesactuacionesDto->getNombrePersonaMoral()."'";
if(($promoventesactuacionesDto->getCedula()!="") ||($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getCedula()!=""){
$sql.="cedula='".$promoventesactuacionesDto->getCedula()."'";
if(($promoventesactuacionesDto->getCveGenero()!="") ){
$sql.=" AND ";
}
}
if($promoventesactuacionesDto->getCveGenero()!=""){
$sql.="cveGenero='".$promoventesactuacionesDto->getCveGenero()."'";
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
$tmp[$contador] = new PromoventesactuacionesDTO();
$tmp[$contador]->setIdPromoventeActuacion($row["idPromoventeActuacion"]);
$tmp[$contador]->setIdActuacion($row["idActuacion"]);
$tmp[$contador]->setCveTipoParte($row["cveTipoParte"]);
$tmp[$contador]->setCveTipoPersona($row["cveTipoPersona"]);
$tmp[$contador]->setNombre($row["nombre"]);
$tmp[$contador]->setPaterno($row["paterno"]);
$tmp[$contador]->setMaterno($row["materno"]);
$tmp[$contador]->setActivo($row["activo"]);
$tmp[$contador]->setNombrePersonaMoral($row["nombrePersonaMoral"]);
$tmp[$contador]->setCedula($row["cedula"]);
$tmp[$contador]->setCveGenero($row["cveGenero"]);
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