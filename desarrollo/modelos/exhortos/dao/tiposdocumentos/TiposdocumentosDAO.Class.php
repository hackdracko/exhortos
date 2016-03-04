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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/tiposdocumentos/TiposdocumentosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class TiposdocumentosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertTiposdocumentos($tiposdocumentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tbltiposdocumentos(";
if($tiposdocumentosDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento";
if(($tiposdocumentosDto->getDescTipoDocumento()!="") ||($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getDescTipoDocumento()!=""){
$sql.="descTipoDocumento";
if(($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getExtension()!=""){
$sql.="extension";
if(($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaActualizacion";
$sql.=",fechaRegistro";
$sql.=") VALUES(";
if($tiposdocumentosDto->getCveTipoDocumento()!=""){
$sql.="'".$tiposdocumentosDto->getCveTipoDocumento()."'";
if(($tiposdocumentosDto->getDescTipoDocumento()!="") ||($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getDescTipoDocumento()!=""){
$sql.="'".$tiposdocumentosDto->getDescTipoDocumento()."'";
if(($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getExtension()!=""){
$sql.="'".$tiposdocumentosDto->getExtension()."'";
if(($tiposdocumentosDto->getActivo()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getActivo()!=""){
$sql.="'".$tiposdocumentosDto->getActivo()."'";
}
if($tiposdocumentosDto->getFechaActualizacion()!=""){
}
if($tiposdocumentosDto->getFechaRegistro()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new TiposdocumentosDTO();
$tmp->setcveTipoDocumento($this->_proveedor->lastID());
$tmp = $this->selectTiposdocumentos($tmp,"",$this->_proveedor);
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
public function updateTiposdocumentos($tiposdocumentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tbltiposdocumentos SET ";
if($tiposdocumentosDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento='".$tiposdocumentosDto->getCveTipoDocumento()."'";
if(($tiposdocumentosDto->getDescTipoDocumento()!="") ||($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getDescTipoDocumento()!=""){
$sql.="descTipoDocumento='".$tiposdocumentosDto->getDescTipoDocumento()."'";
if(($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getExtension()!=""){
$sql.="extension='".$tiposdocumentosDto->getExtension()."'";
if(($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getActivo()!=""){
$sql.="activo='".$tiposdocumentosDto->getActivo()."'";
if(($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$tiposdocumentosDto->getFechaActualizacion()."'";
if(($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($tiposdocumentosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$tiposdocumentosDto->getFechaRegistro()."'";
}
$sql.=" WHERE cveTipoDocumento='".$tiposdocumentosDto->getCveTipoDocumento()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new TiposdocumentosDTO();
$tmp->setcveTipoDocumento($tiposdocumentosDto->getCveTipoDocumento());
$tmp = $this->selectTiposdocumentos($tmp,"",$this->_proveedor);
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
public function deleteTiposdocumentos($tiposdocumentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tbltiposdocumentos  WHERE cveTipoDocumento='".$tiposdocumentosDto->getCveTipoDocumento()."'";
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
public function selectTiposdocumentos($tiposdocumentosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT cveTipoDocumento,descTipoDocumento,extension,activo,fechaActualizacion,fechaRegistro FROM tbltiposdocumentos ";
if(($tiposdocumentosDto->getCveTipoDocumento()!="") ||($tiposdocumentosDto->getDescTipoDocumento()!="") ||($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" WHERE ";
}
if($tiposdocumentosDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento='".$tiposdocumentosDto->getCveTipoDocumento()."'";
if(($tiposdocumentosDto->getDescTipoDocumento()!="") ||($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($tiposdocumentosDto->getDescTipoDocumento()!=""){
$sql.="descTipoDocumento='".$tiposdocumentosDto->getDescTipoDocumento()."'";
if(($tiposdocumentosDto->getExtension()!="") ||($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($tiposdocumentosDto->getExtension()!=""){
$sql.="extension='".$tiposdocumentosDto->getExtension()."'";
if(($tiposdocumentosDto->getActivo()!="") ||($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($tiposdocumentosDto->getActivo()!=""){
$sql.="activo='".$tiposdocumentosDto->getActivo()."'";
if(($tiposdocumentosDto->getFechaActualizacion()!="") ||($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($tiposdocumentosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$tiposdocumentosDto->getFechaActualizacion()."'";
if(($tiposdocumentosDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($tiposdocumentosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$tiposdocumentosDto->getFechaRegistro()."'";
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
$tmp[$contador] = new TiposdocumentosDTO();
$tmp[$contador]->setCveTipoDocumento($row["cveTipoDocumento"]);
$tmp[$contador]->setDescTipoDocumento($row["descTipoDocumento"]);
$tmp[$contador]->setExtension($row["extension"]);
$tmp[$contador]->setActivo($row["activo"]);
$tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
$tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
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