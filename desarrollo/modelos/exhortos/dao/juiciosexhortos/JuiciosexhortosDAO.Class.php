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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/juiciosexhortos/JuiciosexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class JuiciosexhortosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertJuiciosexhortos($juiciosexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tbljuiciosexhortos(";
if($juiciosexhortosDto->getIdJuicioexhorto()!=""){
$sql.="idJuicioexhorto";
if(($juiciosexhortosDto->getIdExhorto()!="") ||($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto";
if(($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado";
if(($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getCveJuicio()!=""){
$sql.="cveJuicio";
if(($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getOtroJuicio()!=""){
$sql.="otroJuicio";
if(($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($juiciosexhortosDto->getIdJuicioexhorto()!=""){
$sql.="'".$juiciosexhortosDto->getIdJuicioexhorto()."'";
if(($juiciosexhortosDto->getIdExhorto()!="") ||($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhorto()!=""){
$sql.="'".$juiciosexhortosDto->getIdExhorto()."'";
if(($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhortoGenerado()!=""){
$sql.="'".$juiciosexhortosDto->getIdExhortoGenerado()."'";
if(($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getCveJuicio()!=""){
$sql.="'".$juiciosexhortosDto->getCveJuicio()."'";
if(($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getOtroJuicio()!=""){
$sql.="'".$juiciosexhortosDto->getOtroJuicio()."'";
if(($juiciosexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getActivo()!=""){
$sql.="'".$juiciosexhortosDto->getActivo()."'";
}
if($juiciosexhortosDto->getFechaRegistro()!=""){
}
if($juiciosexhortosDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new JuiciosexhortosDTO();
$tmp->setidJuicioexhorto($this->_proveedor->lastID());
$tmp = $this->selectJuiciosexhortos($tmp,"",$this->_proveedor);
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
public function updateJuiciosexhortos($juiciosexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tbljuiciosexhortos SET ";
if($juiciosexhortosDto->getIdJuicioexhorto()!=""){
$sql.="idJuicioexhorto='".$juiciosexhortosDto->getIdJuicioexhorto()."'";
if(($juiciosexhortosDto->getIdExhorto()!="") ||($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$juiciosexhortosDto->getIdExhorto()."'";
if(($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$juiciosexhortosDto->getIdExhortoGenerado()."'";
if(($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getCveJuicio()!=""){
$sql.="cveJuicio='".$juiciosexhortosDto->getCveJuicio()."'";
if(($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getOtroJuicio()!=""){
$sql.="otroJuicio='".$juiciosexhortosDto->getOtroJuicio()."'";
if(($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getActivo()!=""){
$sql.="activo='".$juiciosexhortosDto->getActivo()."'";
if(($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$juiciosexhortosDto->getFechaRegistro()."'";
if(($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($juiciosexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$juiciosexhortosDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idJuicioexhorto='".$juiciosexhortosDto->getIdJuicioexhorto()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new JuiciosexhortosDTO();
$tmp->setidJuicioexhorto($juiciosexhortosDto->getIdJuicioexhorto());
$tmp = $this->selectJuiciosexhortos($tmp,"",$this->_proveedor);
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
public function deleteJuiciosexhortos($juiciosexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tbljuiciosexhortos  WHERE idJuicioexhorto='".$juiciosexhortosDto->getIdJuicioexhorto()."'";
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
public function selectJuiciosexhortos($juiciosexhortosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idJuicioexhorto,idExhorto,idExhortoGenerado,cveJuicio,otroJuicio,activo,fechaRegistro,fechaActualizacion FROM tbljuiciosexhortos ";
if(($juiciosexhortosDto->getIdJuicioexhorto()!="") ||($juiciosexhortosDto->getIdExhorto()!="") ||($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($juiciosexhortosDto->getIdJuicioexhorto()!=""){
$sql.="idJuicioexhorto='".$juiciosexhortosDto->getIdJuicioexhorto()."'";
if(($juiciosexhortosDto->getIdExhorto()!="") ||($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$juiciosexhortosDto->getIdExhorto()."'";
if(($juiciosexhortosDto->getIdExhortoGenerado()!="") ||($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$juiciosexhortosDto->getIdExhortoGenerado()."'";
if(($juiciosexhortosDto->getCveJuicio()!="") ||($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getCveJuicio()!=""){
$sql.="cveJuicio='".$juiciosexhortosDto->getCveJuicio()."'";
if(($juiciosexhortosDto->getOtroJuicio()!="") ||($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getOtroJuicio()!=""){
$sql.="otroJuicio='".$juiciosexhortosDto->getOtroJuicio()."'";
if(($juiciosexhortosDto->getActivo()!="") ||($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getActivo()!=""){
$sql.="activo='".$juiciosexhortosDto->getActivo()."'";
if(($juiciosexhortosDto->getFechaRegistro()!="") ||($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$juiciosexhortosDto->getFechaRegistro()."'";
if(($juiciosexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($juiciosexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$juiciosexhortosDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new JuiciosexhortosDTO();
$tmp[$contador]->setIdJuicioexhorto($row["idJuicioexhorto"]);
$tmp[$contador]->setIdExhorto($row["idExhorto"]);
$tmp[$contador]->setIdExhortoGenerado($row["idExhortoGenerado"]);
$tmp[$contador]->setCveJuicio($row["cveJuicio"]);
$tmp[$contador]->setOtroJuicio($row["otroJuicio"]);
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