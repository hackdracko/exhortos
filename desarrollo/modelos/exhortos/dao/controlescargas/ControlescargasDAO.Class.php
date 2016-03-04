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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/controlescargas/ControlescargasDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class ControlescargasDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertControlescargas($controlescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblcontrolescargas(";
if($controlescargasDto->getIdControlCarga()!=""){
$sql.="idControlCarga";
if(($controlescargasDto->getCveConfiguracionCarga()!="") ||($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga";
if(($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveMateria()!=""){
$sql.="cveMateria";
if(($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuicio()!=""){
$sql.="cveJuicio";
if(($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveCuantia()!=""){
$sql.="cveCuantia";
if(($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuzgado()!=""){
$sql.="cveJuzgado";
if(($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getTotalAsignados()!=""){
$sql.="totalAsignados";
if(($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getAnioControl()!=""){
$sql.="anioControl";
}
$sql.=") VALUES(";
if($controlescargasDto->getIdControlCarga()!=""){
$sql.="'".$controlescargasDto->getIdControlCarga()."'";
if(($controlescargasDto->getCveConfiguracionCarga()!="") ||($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveConfiguracionCarga()!=""){
$sql.="'".$controlescargasDto->getCveConfiguracionCarga()."'";
if(($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveMateria()!=""){
$sql.="'".$controlescargasDto->getCveMateria()."'";
if(($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuicio()!=""){
$sql.="'".$controlescargasDto->getCveJuicio()."'";
if(($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveCuantia()!=""){
$sql.="'".$controlescargasDto->getCveCuantia()."'";
if(($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuzgado()!=""){
$sql.="'".$controlescargasDto->getCveJuzgado()."'";
if(($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getTotalAsignados()!=""){
$sql.="'".$controlescargasDto->getTotalAsignados()."'";
if(($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getAnioControl()!=""){
$sql.="'".$controlescargasDto->getAnioControl()."'";
}
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ControlescargasDTO();
$tmp->setidControlCarga($this->_proveedor->lastID());
$tmp = $this->selectControlescargas($tmp,"",$this->_proveedor);
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
public function updateControlescargas($controlescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblcontrolescargas SET ";
if($controlescargasDto->getIdControlCarga()!=""){
$sql.="idControlCarga='".$controlescargasDto->getIdControlCarga()."'";
if(($controlescargasDto->getCveConfiguracionCarga()!="") ||($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga='".$controlescargasDto->getCveConfiguracionCarga()."'";
if(($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveMateria()!=""){
$sql.="cveMateria='".$controlescargasDto->getCveMateria()."'";
if(($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuicio()!=""){
$sql.="cveJuicio='".$controlescargasDto->getCveJuicio()."'";
if(($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveCuantia()!=""){
$sql.="cveCuantia='".$controlescargasDto->getCveCuantia()."'";
if(($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getCveJuzgado()!=""){
$sql.="cveJuzgado='".$controlescargasDto->getCveJuzgado()."'";
if(($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getTotalAsignados()!=""){
$sql.="totalAsignados='".$controlescargasDto->getTotalAsignados()."'";
if(($controlescargasDto->getAnioControl()!="") ){
$sql.=",";
}
}
if($controlescargasDto->getAnioControl()!=""){
$sql.="anioControl='".$controlescargasDto->getAnioControl()."'";
}
$sql.=" WHERE idControlCarga='".$controlescargasDto->getIdControlCarga()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ControlescargasDTO();
$tmp->setidControlCarga($controlescargasDto->getIdControlCarga());
$tmp = $this->selectControlescargas($tmp,"",$this->_proveedor);
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
public function deleteControlescargas($controlescargasDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblcontrolescargas  WHERE idControlCarga='".$controlescargasDto->getIdControlCarga()."'";
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
public function selectControlescargas($controlescargasDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idControlCarga,cveConfiguracionCarga,cveMateria,cveJuicio,cveCuantia,cveJuzgado,totalAsignados,anioControl FROM tblcontrolescargas ";
if(($controlescargasDto->getIdControlCarga()!="") ||($controlescargasDto->getCveConfiguracionCarga()!="") ||($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" WHERE ";
}
if($controlescargasDto->getIdControlCarga()!=""){
$sql.="idControlCarga='".$controlescargasDto->getIdControlCarga()."'";
if(($controlescargasDto->getCveConfiguracionCarga()!="") ||($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getCveConfiguracionCarga()!=""){
$sql.="cveConfiguracionCarga='".$controlescargasDto->getCveConfiguracionCarga()."'";
if(($controlescargasDto->getCveMateria()!="") ||($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getCveMateria()!=""){
$sql.="cveMateria='".$controlescargasDto->getCveMateria()."'";
if(($controlescargasDto->getCveJuicio()!="") ||($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getCveJuicio()!=""){
$sql.="cveJuicio='".$controlescargasDto->getCveJuicio()."'";
if(($controlescargasDto->getCveCuantia()!="") ||($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getCveCuantia()!=""){
$sql.="cveCuantia='".$controlescargasDto->getCveCuantia()."'";
if(($controlescargasDto->getCveJuzgado()!="") ||($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getCveJuzgado()!=""){
$sql.="cveJuzgado='".$controlescargasDto->getCveJuzgado()."'";
if(($controlescargasDto->getTotalAsignados()!="") ||($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getTotalAsignados()!=""){
$sql.="totalAsignados='".$controlescargasDto->getTotalAsignados()."'";
if(($controlescargasDto->getAnioControl()!="") ){
$sql.=" AND ";
}
}
if($controlescargasDto->getAnioControl()!=""){
$sql.="anioControl='".$controlescargasDto->getAnioControl()."'";
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
$tmp[$contador] = new ControlescargasDTO();
$tmp[$contador]->setIdControlCarga($row["idControlCarga"]);
$tmp[$contador]->setCveConfiguracionCarga($row["cveConfiguracionCarga"]);
$tmp[$contador]->setCveMateria($row["cveMateria"]);
$tmp[$contador]->setCveJuicio($row["cveJuicio"]);
$tmp[$contador]->setCveCuantia($row["cveCuantia"]);
$tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
$tmp[$contador]->setTotalAsignados($row["totalAsignados"]);
$tmp[$contador]->setAnioControl($row["anioControl"]);
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