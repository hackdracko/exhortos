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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/documentos/DocumentosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class DocumentosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertDocumentos($documentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tbldocumentos(";
if($documentosDto->getCveDocumento()!=""){
$sql.="cveDocumento";
if(($documentosDto->getDescDocumento()!="") ||($documentosDto->getActivo()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getDescDocumento()!=""){
$sql.="descDocumento";
if(($documentosDto->getActivo()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getActivo()!=""){
$sql.="activo";
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getCveTipoNumero()!=""){
$sql.="cveTipoNumero";
}
$sql.=",fechaActualizacion";
$sql.=",fechaRegistro";
$sql.=") VALUES(";
if($documentosDto->getCveDocumento()!=""){
$sql.="'".$documentosDto->getCveDocumento()."'";
if(($documentosDto->getDescDocumento()!="") ||($documentosDto->getActivo()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getDescDocumento()!=""){
$sql.="'".$documentosDto->getDescDocumento()."'";
if(($documentosDto->getActivo()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getActivo()!=""){
$sql.="'".$documentosDto->getActivo()."'";
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getFechaActualizacion()!=""){
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getFechaRegistro()!=""){
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getCveTipoNumero()!=""){
$sql.="'".$documentosDto->getCveTipoNumero()."'";
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new DocumentosDTO();
$tmp->setcveDocumento($this->_proveedor->lastID());
$tmp = $this->selectDocumentos($tmp,"",$this->_proveedor);
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
public function updateDocumentos($documentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tbldocumentos SET ";
if($documentosDto->getCveDocumento()!=""){
$sql.="cveDocumento='".$documentosDto->getCveDocumento()."'";
if(($documentosDto->getDescDocumento()!="") ||($documentosDto->getActivo()!="") ||($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getDescDocumento()!=""){
$sql.="descDocumento='".$documentosDto->getDescDocumento()."'";
if(($documentosDto->getActivo()!="") ||($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getActivo()!=""){
$sql.="activo='".$documentosDto->getActivo()."'";
if(($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$documentosDto->getFechaActualizacion()."'";
if(($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$documentosDto->getFechaRegistro()."'";
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=",";
}
}
if($documentosDto->getCveTipoNumero()!=""){
$sql.="cveTipoNumero='".$documentosDto->getCveTipoNumero()."'";
}
$sql.=" WHERE cveDocumento='".$documentosDto->getCveDocumento()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new DocumentosDTO();
$tmp->setcveDocumento($documentosDto->getCveDocumento());
$tmp = $this->selectDocumentos($tmp,"",$this->_proveedor);
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
public function deleteDocumentos($documentosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tbldocumentos  WHERE cveDocumento='".$documentosDto->getCveDocumento()."'";
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
public function selectDocumentos($documentosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT cveDocumento,descDocumento,activo,fechaActualizacion,fechaRegistro,cveTipoNumero FROM tbldocumentos ";
if(($documentosDto->getCveDocumento()!="") ||($documentosDto->getDescDocumento()!="") ||($documentosDto->getActivo()!="") ||($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=" WHERE ";
}
if($documentosDto->getCveDocumento()!=""){
$sql.="cveDocumento='".$documentosDto->getCveDocumento()."'";
if(($documentosDto->getDescDocumento()!="") ||($documentosDto->getActivo()!="") ||($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=" AND ";
}
}
if($documentosDto->getDescDocumento()!=""){
$sql.="descDocumento='".$documentosDto->getDescDocumento()."'";
if(($documentosDto->getActivo()!="") ||($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=" AND ";
}
}
if($documentosDto->getActivo()!=""){
$sql.="activo='".$documentosDto->getActivo()."'";
if(($documentosDto->getFechaActualizacion()!="") ||($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=" AND ";
}
}
if($documentosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$documentosDto->getFechaActualizacion()."'";
if(($documentosDto->getFechaRegistro()!="") ||($documentosDto->getCveTipoNumero()!="") ){
$sql.=" AND ";
}
}
if($documentosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$documentosDto->getFechaRegistro()."'";
if(($documentosDto->getCveTipoNumero()!="") ){
$sql.=" AND ";
}
}
if($documentosDto->getCveTipoNumero()!=""){
$sql.="cveTipoNumero='".$documentosDto->getCveTipoNumero()."'";
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
$tmp[$contador] = new DocumentosDTO();
$tmp[$contador]->setCveDocumento($row["cveDocumento"]);
$tmp[$contador]->setDescDocumento($row["descDocumento"]);
$tmp[$contador]->setActivo($row["activo"]);
$tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
$tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
$tmp[$contador]->setCveTipoNumero($row["cveTipoNumero"]);
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