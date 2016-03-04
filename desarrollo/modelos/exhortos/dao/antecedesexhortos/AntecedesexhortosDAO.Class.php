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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/antecedesexhortos/AntecedesexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class AntecedesexhortosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertAntecedesexhortos($antecedesexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblantecedesexhortos(";
if($antecedesexhortosDto->getIdAntecedeExhorto()!=""){
$sql.="idAntecedeExhorto";
if(($antecedesexhortosDto->getIdExhorto()!="") ||($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto";
if(($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion";
if(($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($antecedesexhortosDto->getIdAntecedeExhorto()!=""){
$sql.="'".$antecedesexhortosDto->getIdAntecedeExhorto()."'";
if(($antecedesexhortosDto->getIdExhorto()!="") ||($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdExhorto()!=""){
$sql.="'".$antecedesexhortosDto->getIdExhorto()."'";
if(($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdActuacion()!=""){
$sql.="'".$antecedesexhortosDto->getIdActuacion()."'";
if(($antecedesexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getActivo()!=""){
$sql.="'".$antecedesexhortosDto->getActivo()."'";
}
if($antecedesexhortosDto->getFechaRegistro()!=""){
}
if($antecedesexhortosDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new AntecedesexhortosDTO();
$tmp->setidAntecedeExhorto($this->_proveedor->lastID());
$tmp = $this->selectAntecedesexhortos($tmp,"",$this->_proveedor);
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
public function updateAntecedesexhortos($antecedesexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblantecedesexhortos SET ";
if($antecedesexhortosDto->getIdAntecedeExhorto()!=""){
$sql.="idAntecedeExhorto='".$antecedesexhortosDto->getIdAntecedeExhorto()."'";
if(($antecedesexhortosDto->getIdExhorto()!="") ||($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$antecedesexhortosDto->getIdExhorto()."'";
if(($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$antecedesexhortosDto->getIdActuacion()."'";
if(($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getActivo()!=""){
$sql.="activo='".$antecedesexhortosDto->getActivo()."'";
if(($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$antecedesexhortosDto->getFechaRegistro()."'";
if(($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($antecedesexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$antecedesexhortosDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idAntecedeExhorto='".$antecedesexhortosDto->getIdAntecedeExhorto()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new AntecedesexhortosDTO();
$tmp->setidAntecedeExhorto($antecedesexhortosDto->getIdAntecedeExhorto());
$tmp = $this->selectAntecedesexhortos($tmp,"",$this->_proveedor);
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
public function deleteAntecedesexhortos($antecedesexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblantecedesexhortos  WHERE idAntecedeExhorto='".$antecedesexhortosDto->getIdAntecedeExhorto()."'";
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
public function selectAntecedesexhortos($antecedesexhortosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idAntecedeExhorto,idExhorto,idActuacion,activo,fechaRegistro,fechaActualizacion FROM tblantecedesexhortos ";
if(($antecedesexhortosDto->getIdAntecedeExhorto()!="") ||($antecedesexhortosDto->getIdExhorto()!="") ||($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($antecedesexhortosDto->getIdAntecedeExhorto()!=""){
$sql.="idAntecedeExhorto='".$antecedesexhortosDto->getIdAntecedeExhorto()."'";
if(($antecedesexhortosDto->getIdExhorto()!="") ||($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($antecedesexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$antecedesexhortosDto->getIdExhorto()."'";
if(($antecedesexhortosDto->getIdActuacion()!="") ||($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($antecedesexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$antecedesexhortosDto->getIdActuacion()."'";
if(($antecedesexhortosDto->getActivo()!="") ||($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($antecedesexhortosDto->getActivo()!=""){
$sql.="activo='".$antecedesexhortosDto->getActivo()."'";
if(($antecedesexhortosDto->getFechaRegistro()!="") ||($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($antecedesexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$antecedesexhortosDto->getFechaRegistro()."'";
if(($antecedesexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($antecedesexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$antecedesexhortosDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new AntecedesexhortosDTO();
$tmp[$contador]->setIdAntecedeExhorto($row["idAntecedeExhorto"]);
$tmp[$contador]->setIdExhorto($row["idExhorto"]);
$tmp[$contador]->setIdActuacion($row["idActuacion"]);
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