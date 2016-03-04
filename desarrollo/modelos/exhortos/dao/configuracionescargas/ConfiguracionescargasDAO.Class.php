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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/configuracionescargas/ConfiguracionescargasDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class ConfiguracionescargasDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertConfiguracionescargas($configuracionescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblconfiguracionescargas(";
if($configuracionescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga";
if(($configuracionescargasDto->getCveOficialia()!="") ||($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getCveOficialia()!=""){
$sql.="cveOficialia";
if(($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTopeCarga()!=""){
$sql.="topeCarga";
if(($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTipoOficialia()!=""){
$sql.="tipoOficialia";
if(($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getActivo()!=""){
$sql.="activo";
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getInicia()!=""){
$sql.="inicia";
if(($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTermina()!=""){
$sql.="termina";
}
$sql.=",fechaActualizacion";
$sql.=",fechaRegistro";
$sql.=") VALUES(";
if($configuracionescargasDto->getCveConfiguracionCarga()!=""){
$sql.="'".$configuracionescargasDto->getCveConfiguracionCarga()."'";
if(($configuracionescargasDto->getCveOficialia()!="") ||($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getCveOficialia()!=""){
$sql.="'".$configuracionescargasDto->getCveOficialia()."'";
if(($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTopeCarga()!=""){
$sql.="'".$configuracionescargasDto->getTopeCarga()."'";
if(($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTipoOficialia()!=""){
$sql.="'".$configuracionescargasDto->getTipoOficialia()."'";
if(($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getActivo()!=""){
$sql.="'".$configuracionescargasDto->getActivo()."'";
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getFechaActualizacion()!=""){
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getFechaRegistro()!=""){
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getInicia()!=""){
$sql.="'".$configuracionescargasDto->getInicia()."'";
if(($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTermina()!=""){
$sql.="'".$configuracionescargasDto->getTermina()."'";
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ConfiguracionescargasDTO();
$tmp->setcveConfiguracionCarga($this->_proveedor->lastID());
$tmp = $this->selectConfiguracionescargas($tmp,"",$this->_proveedor);
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
public function updateConfiguracionescargas($configuracionescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblconfiguracionescargas SET ";
if($configuracionescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga='".$configuracionescargasDto->getCveConfiguracionCarga()."'";
if(($configuracionescargasDto->getCveOficialia()!="") ||($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getCveOficialia()!=""){
$sql.="cveOficialia='".$configuracionescargasDto->getCveOficialia()."'";
if(($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTopeCarga()!=""){
$sql.="topeCarga='".$configuracionescargasDto->getTopeCarga()."'";
if(($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTipoOficialia()!=""){
$sql.="tipoOficialia='".$configuracionescargasDto->getTipoOficialia()."'";
if(($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getActivo()!=""){
$sql.="activo='".$configuracionescargasDto->getActivo()."'";
if(($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$configuracionescargasDto->getFechaActualizacion()."'";
if(($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$configuracionescargasDto->getFechaRegistro()."'";
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getInicia()!=""){
$sql.="inicia='".$configuracionescargasDto->getInicia()."'";
if(($configuracionescargasDto->getTermina()!="") ){
$sql.=",";
}
}
if($configuracionescargasDto->getTermina()!=""){
$sql.="termina='".$configuracionescargasDto->getTermina()."'";
}
$sql.=" WHERE cveConfiguracionCarga='".$configuracionescargasDto->getCveConfiguracionCarga()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ConfiguracionescargasDTO();
$tmp->setcveConfiguracionCarga($configuracionescargasDto->getCveConfiguracionCarga());
$tmp = $this->selectConfiguracionescargas($tmp,"",$this->_proveedor);
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
public function deleteConfiguracionescargas($configuracionescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblconfiguracionescargas  WHERE cveConfiguracionCarga='".$configuracionescargasDto->getCveConfiguracionCarga()."'";
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
public function selectConfiguracionescargas($configuracionescargasDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT cveConfiguracionCarga,cveOficialia,topeCarga,tipoOficialia,activo,fechaActualizacion,fechaRegistro,inicia,termina FROM tblconfiguracionescargas ";
if(($configuracionescargasDto->getCveConfiguracionCarga()!="") ||($configuracionescargasDto->getCveOficialia()!="") ||($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" WHERE ";
}
if($configuracionescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga='".$configuracionescargasDto->getCveConfiguracionCarga()."'";
if(($configuracionescargasDto->getCveOficialia()!="") ||($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getCveOficialia()!=""){
$sql.="cveOficialia='".$configuracionescargasDto->getCveOficialia()."'";
if(($configuracionescargasDto->getTopeCarga()!="") ||($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getTopeCarga()!=""){
$sql.="topeCarga='".$configuracionescargasDto->getTopeCarga()."'";
if(($configuracionescargasDto->getTipoOficialia()!="") ||($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getTipoOficialia()!=""){
$sql.="tipoOficialia='".$configuracionescargasDto->getTipoOficialia()."'";
if(($configuracionescargasDto->getActivo()!="") ||($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getActivo()!=""){
$sql.="activo='".$configuracionescargasDto->getActivo()."'";
if(($configuracionescargasDto->getFechaActualizacion()!="") ||($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$configuracionescargasDto->getFechaActualizacion()."'";
if(($configuracionescargasDto->getFechaRegistro()!="") ||($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$configuracionescargasDto->getFechaRegistro()."'";
if(($configuracionescargasDto->getInicia()!="") ||($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getInicia()!=""){
$sql.="inicia<='".$configuracionescargasDto->getInicia()."'";
$sql.=" AND termina>='".$configuracionescargasDto->getInicia()."'";
if(($configuracionescargasDto->getTermina()!="") ){
$sql.=" AND ";
}
}
if($configuracionescargasDto->getTermina()!=""){
$sql.="termina='".$configuracionescargasDto->getTermina()."'";
}
if($orden!=""){
$sql.=$orden;
}else{
$sql.="";
}
error_log($sql);
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
$tmp[$contador] = new ConfiguracionescargasDTO();
$tmp[$contador]->setCveConfiguracionCarga($row["cveConfiguracionCarga"]);
$tmp[$contador]->setCveOficialia($row["cveOficialia"]);
$tmp[$contador]->setTopeCarga($row["topeCarga"]);
$tmp[$contador]->setTipoOficialia($row["tipoOficialia"]);
$tmp[$contador]->setActivo($row["activo"]);
$tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
$tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
$tmp[$contador]->setInicia($row["inicia"]);
$tmp[$contador]->setTermina($row["termina"]);
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