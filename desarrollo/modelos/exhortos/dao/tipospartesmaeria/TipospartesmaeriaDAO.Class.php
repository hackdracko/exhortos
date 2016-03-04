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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/tipospartesmaeria/TipospartesmaeriaDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class TipospartesmaeriaDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertTipospartesmaeria($tipospartesmaeriaDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tbltipospartesmaeria(";
if($tipospartesmaeriaDto->getIdTipoParteMateria()!=""){
$sql.="idTipoParteMateria";
if(($tipospartesmaeriaDto->getCveTipoParte()!="") ||($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveTipoParte()!=""){
$sql.="cveTipoParte";
if(($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveMateria()!=""){
$sql.="cveMateria";
if(($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($tipospartesmaeriaDto->getIdTipoParteMateria()!=""){
$sql.="'".$tipospartesmaeriaDto->getIdTipoParteMateria()."'";
if(($tipospartesmaeriaDto->getCveTipoParte()!="") ||($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveTipoParte()!=""){
$sql.="'".$tipospartesmaeriaDto->getCveTipoParte()."'";
if(($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveMateria()!=""){
$sql.="'".$tipospartesmaeriaDto->getCveMateria()."'";
if(($tipospartesmaeriaDto->getActivo()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getActivo()!=""){
$sql.="'".$tipospartesmaeriaDto->getActivo()."'";
}
if($tipospartesmaeriaDto->getFechaRegistro()!=""){
}
if($tipospartesmaeriaDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new TipospartesmaeriaDTO();
$tmp->setidTipoParteMateria($this->_proveedor->lastID());
$tmp = $this->selectTipospartesmaeria($tmp,"",$this->_proveedor);
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
public function updateTipospartesmaeria($tipospartesmaeriaDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tbltipospartesmaeria SET ";
if($tipospartesmaeriaDto->getIdTipoParteMateria()!=""){
$sql.="idTipoParteMateria='".$tipospartesmaeriaDto->getIdTipoParteMateria()."'";
if(($tipospartesmaeriaDto->getCveTipoParte()!="") ||($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$tipospartesmaeriaDto->getCveTipoParte()."'";
if(($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getCveMateria()!=""){
$sql.="cveMateria='".$tipospartesmaeriaDto->getCveMateria()."'";
if(($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getActivo()!=""){
$sql.="activo='".$tipospartesmaeriaDto->getActivo()."'";
if(($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$tipospartesmaeriaDto->getFechaRegistro()."'";
if(($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($tipospartesmaeriaDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$tipospartesmaeriaDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idTipoParteMateria='".$tipospartesmaeriaDto->getIdTipoParteMateria()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new TipospartesmaeriaDTO();
$tmp->setidTipoParteMateria($tipospartesmaeriaDto->getIdTipoParteMateria());
$tmp = $this->selectTipospartesmaeria($tmp,"",$this->_proveedor);
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
public function deleteTipospartesmaeria($tipospartesmaeriaDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tbltipospartesmaeria  WHERE idTipoParteMateria='".$tipospartesmaeriaDto->getIdTipoParteMateria()."'";
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
public function selectTipospartesmaeria($tipospartesmaeriaDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idTipoParteMateria,cveTipoParte,cveMateria,activo,fechaRegistro,fechaActualizacion FROM tbltipospartesmaeria ";
if(($tipospartesmaeriaDto->getIdTipoParteMateria()!="") ||($tipospartesmaeriaDto->getCveTipoParte()!="") ||($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($tipospartesmaeriaDto->getIdTipoParteMateria()!=""){
$sql.="idTipoParteMateria='".$tipospartesmaeriaDto->getIdTipoParteMateria()."'";
if(($tipospartesmaeriaDto->getCveTipoParte()!="") ||($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($tipospartesmaeriaDto->getCveTipoParte()!=""){
$sql.="cveTipoParte='".$tipospartesmaeriaDto->getCveTipoParte()."'";
if(($tipospartesmaeriaDto->getCveMateria()!="") ||($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($tipospartesmaeriaDto->getCveMateria()!=""){
$sql.="cveMateria='".$tipospartesmaeriaDto->getCveMateria()."'";
if(($tipospartesmaeriaDto->getActivo()!="") ||($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($tipospartesmaeriaDto->getActivo()!=""){
$sql.="activo='".$tipospartesmaeriaDto->getActivo()."'";
if(($tipospartesmaeriaDto->getFechaRegistro()!="") ||($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($tipospartesmaeriaDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$tipospartesmaeriaDto->getFechaRegistro()."'";
if(($tipospartesmaeriaDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($tipospartesmaeriaDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$tipospartesmaeriaDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new TipospartesmaeriaDTO();
$tmp[$contador]->setIdTipoParteMateria($row["idTipoParteMateria"]);
$tmp[$contador]->setCveTipoParte($row["cveTipoParte"]);
$tmp[$contador]->setCveMateria($row["cveMateria"]);
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