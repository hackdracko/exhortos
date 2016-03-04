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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class DocumentosimgDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertDocumentosimg($documentosimgDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tbldocumentosimg(";
if($documentosimgDto->getIdDocumentoImg()!=""){
$sql.="idDocumentoImg";
if(($documentosimgDto->getIdExhorto()!="") ||($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdExhorto()!=""){
$sql.="idExhorto";
if(($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdActuacion()!=""){
$sql.="idActuacion";
if(($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento";
if(($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaDocumento()!=""){
$sql.="fechaDocumento";
if(($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaModificacion()!=""){
$sql.="fechaModificacion";
if(($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getObservaciones()!=""){
$sql.="observaciones";
if(($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveUsuario()!=""){
$sql.="cveUsuario";
if(($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaActualizacion";
$sql.=",fechaRegistro";
$sql.=") VALUES(";
if($documentosimgDto->getIdDocumentoImg()!=""){
$sql.="'".$documentosimgDto->getIdDocumentoImg()."'";
if(($documentosimgDto->getIdExhorto()!="") ||($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdExhorto()!=""){
$sql.="'".$documentosimgDto->getIdExhorto()."'";
if(($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdActuacion()!=""){
$sql.="'".$documentosimgDto->getIdActuacion()."'";
if(($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveTipoDocumento()!=""){
$sql.="'".$documentosimgDto->getCveTipoDocumento()."'";
if(($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaDocumento()!=""){
$sql.="'".$documentosimgDto->getFechaDocumento()."'";
if(($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaModificacion()!=""){
$sql.="'".$documentosimgDto->getFechaModificacion()."'";
if(($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getObservaciones()!=""){
$sql.="'".$documentosimgDto->getObservaciones()."'";
if(($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveUsuario()!=""){
$sql.="'".$documentosimgDto->getCveUsuario()."'";
if(($documentosimgDto->getActivo()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getActivo()!=""){
$sql.="'".$documentosimgDto->getActivo()."'";
}
if($documentosimgDto->getFechaActualizacion()!=""){
}
if($documentosimgDto->getFechaRegistro()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
error_log($sql);
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new DocumentosimgDTO();
$tmp->setidDocumentoImg($this->_proveedor->lastID());
$tmp = $this->selectDocumentosimg($tmp,"",$this->_proveedor);
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
public function updateDocumentosimg($documentosimgDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tbldocumentosimg SET ";
if($documentosimgDto->getIdDocumentoImg()!=""){
$sql.="idDocumentoImg='".$documentosimgDto->getIdDocumentoImg()."'";
if(($documentosimgDto->getIdExhorto()!="") ||($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdExhorto()!=""){
$sql.="idExhorto='".$documentosimgDto->getIdExhorto()."'";
if(($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getIdActuacion()!=""){
$sql.="idActuacion='".$documentosimgDto->getIdActuacion()."'";
if(($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento='".$documentosimgDto->getCveTipoDocumento()."'";
if(($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaDocumento()!=""){
$sql.="fechaDocumento='".$documentosimgDto->getFechaDocumento()."'";
if(($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaModificacion()!=""){
$sql.="fechaModificacion='".$documentosimgDto->getFechaModificacion()."'";
if(($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getObservaciones()!=""){
$sql.="observaciones='".$documentosimgDto->getObservaciones()."'";
if(($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getCveUsuario()!=""){
$sql.="cveUsuario='".$documentosimgDto->getCveUsuario()."'";
if(($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getActivo()!=""){
$sql.="activo='".$documentosimgDto->getActivo()."'";
if(($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$documentosimgDto->getFechaActualizacion()."'";
if(($documentosimgDto->getFechaRegistro()!="") ){
$sql.=",";
}
}
if($documentosimgDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$documentosimgDto->getFechaRegistro()."'";
}
$sql.=" WHERE idDocumentoImg='".$documentosimgDto->getIdDocumentoImg()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new DocumentosimgDTO();
$tmp->setidDocumentoImg($documentosimgDto->getIdDocumentoImg());
$tmp = $this->selectDocumentosimg($tmp,"",$this->_proveedor);
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
public function deleteDocumentosimg($documentosimgDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tbldocumentosimg  WHERE idDocumentoImg='".$documentosimgDto->getIdDocumentoImg()."'";
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
public function selectDocumentosimg($documentosimgDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idDocumentoImg,idExhorto,idActuacion,cveTipoDocumento,fechaDocumento,fechaModificacion,observaciones,cveUsuario,activo,fechaActualizacion,fechaRegistro FROM tbldocumentosimg ";
if(($documentosimgDto->getIdDocumentoImg()!="") ||($documentosimgDto->getIdExhorto()!="") ||($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" WHERE ";
}
if($documentosimgDto->getIdDocumentoImg()!=""){
$sql.="idDocumentoImg='".$documentosimgDto->getIdDocumentoImg()."'";
if(($documentosimgDto->getIdExhorto()!="") ||($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getIdExhorto()!=""){
$sql.="idExhorto='".$documentosimgDto->getIdExhorto()."'";
if(($documentosimgDto->getIdActuacion()!="") ||($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getIdActuacion()!=""){
$sql.="idActuacion='".$documentosimgDto->getIdActuacion()."'";
if(($documentosimgDto->getCveTipoDocumento()!="") ||($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getCveTipoDocumento()!=""){
$sql.="cveTipoDocumento='".$documentosimgDto->getCveTipoDocumento()."'";
if(($documentosimgDto->getFechaDocumento()!="") ||($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getFechaDocumento()!=""){
$sql.="fechaDocumento='".$documentosimgDto->getFechaDocumento()."'";
if(($documentosimgDto->getFechaModificacion()!="") ||($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getFechaModificacion()!=""){
$sql.="fechaModificacion='".$documentosimgDto->getFechaModificacion()."'";
if(($documentosimgDto->getObservaciones()!="") ||($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getObservaciones()!=""){
$sql.="observaciones='".$documentosimgDto->getObservaciones()."'";
if(($documentosimgDto->getCveUsuario()!="") ||($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getCveUsuario()!=""){
$sql.="cveUsuario='".$documentosimgDto->getCveUsuario()."'";
if(($documentosimgDto->getActivo()!="") ||($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getActivo()!=""){
$sql.="activo='".$documentosimgDto->getActivo()."'";
if(($documentosimgDto->getFechaActualizacion()!="") ||($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$documentosimgDto->getFechaActualizacion()."'";
if(($documentosimgDto->getFechaRegistro()!="") ){
$sql.=" AND ";
}
}
if($documentosimgDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$documentosimgDto->getFechaRegistro()."'";
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
$tmp[$contador] = new DocumentosimgDTO();
$tmp[$contador]->setIdDocumentoImg($row["idDocumentoImg"]);
$tmp[$contador]->setIdExhorto($row["idExhorto"]);
$tmp[$contador]->setIdActuacion($row["idActuacion"]);
$tmp[$contador]->setCveTipoDocumento($row["cveTipoDocumento"]);
$tmp[$contador]->setFechaDocumento($row["fechaDocumento"]);
$tmp[$contador]->setFechaModificacion($row["fechaModificacion"]);
$tmp[$contador]->setObservaciones($row["observaciones"]);
$tmp[$contador]->setCveUsuario($row["cveUsuario"]);
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