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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/exhortosgenerados/ExhortosgeneradosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class ExhortosgeneradosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertExhortosgenerados($exhortosgeneradosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblexhortosgenerados(";
if($exhortosgeneradosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado";
if(($exhortosgeneradosDto->getIdActuacion()!="") ||($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdActuacion()!=""){
$sql.="idActuacion";
if(($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstatusExhorto()!=""){
$sql.="cveEstatusExhorto";
if(($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino";
if(($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveOficialia()!=""){
$sql.="cveOficialia";
if(($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getNumero()!=""){
$sql.="numero";
if(($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getAnio()!=""){
$sql.="anio";
if(($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdExhortoDestino()!=""){
$sql.="idExhortoDestino";
if(($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getRequisitoria()!=""){
$sql.="requisitoria";
if(($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($exhortosgeneradosDto->getIdExhortoGenerado()!=""){
$sql.="'".$exhortosgeneradosDto->getIdExhortoGenerado()."'";
if(($exhortosgeneradosDto->getIdActuacion()!="") ||($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdActuacion()!=""){
$sql.="'".$exhortosgeneradosDto->getIdActuacion()."'";
if(($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstatusExhorto()!=""){
$sql.="'".$exhortosgeneradosDto->getCveEstatusExhorto()."'";
if(($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstadoDestino()!=""){
$sql.="'".$exhortosgeneradosDto->getCveEstadoDestino()."'";
if(($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveOficialia()!=""){
$sql.="'".$exhortosgeneradosDto->getCveOficialia()."'";
if(($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getNumero()!=""){
$sql.="'".$exhortosgeneradosDto->getNumero()."'";
if(($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getAnio()!=""){
$sql.="'".$exhortosgeneradosDto->getAnio()."'";
if(($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdExhortoDestino()!=""){
$sql.="'".$exhortosgeneradosDto->getIdExhortoDestino()."'";
if(($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getRequisitoria()!=""){
$sql.="'".$exhortosgeneradosDto->getRequisitoria()."'";
if(($exhortosgeneradosDto->getActivo()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getActivo()!=""){
$sql.="'".$exhortosgeneradosDto->getActivo()."'";
}
if($exhortosgeneradosDto->getFechaRegistro()!=""){
}
if($exhortosgeneradosDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ExhortosgeneradosDTO();
$tmp->setidExhortoGenerado($this->_proveedor->lastID());
$tmp = $this->selectExhortosgenerados($tmp,"",$this->_proveedor);
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
public function updateExhortosgenerados($exhortosgeneradosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblexhortosgenerados SET ";
if($exhortosgeneradosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$exhortosgeneradosDto->getIdExhortoGenerado()."'";
if(($exhortosgeneradosDto->getIdActuacion()!="") ||($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$exhortosgeneradosDto->getIdActuacion()."'";
if(($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstatusExhorto()!=""){
$sql.="cveEstatusExhorto='".$exhortosgeneradosDto->getCveEstatusExhorto()."'";
if(($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino='".$exhortosgeneradosDto->getCveEstadoDestino()."'";
if(($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getCveOficialia()!=""){
$sql.="cveOficialia='".$exhortosgeneradosDto->getCveOficialia()."'";
if(($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getNumero()!=""){
$sql.="numero='".$exhortosgeneradosDto->getNumero()."'";
if(($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getAnio()!=""){
$sql.="anio='".$exhortosgeneradosDto->getAnio()."'";
if(($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getIdExhortoDestino()!=""){
$sql.="idExhortoDestino='".$exhortosgeneradosDto->getIdExhortoDestino()."'";
if(($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getRequisitoria()!=""){
$sql.="requisitoria='".$exhortosgeneradosDto->getRequisitoria()."'";
if(($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getActivo()!=""){
$sql.="activo='".$exhortosgeneradosDto->getActivo()."'";
if(($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$exhortosgeneradosDto->getFechaRegistro()."'";
if(($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($exhortosgeneradosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$exhortosgeneradosDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idExhortoGenerado='".$exhortosgeneradosDto->getIdExhortoGenerado()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new ExhortosgeneradosDTO();
$tmp->setidExhortoGenerado($exhortosgeneradosDto->getIdExhortoGenerado());
$tmp = $this->selectExhortosgenerados($tmp,"",$this->_proveedor);
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
public function deleteExhortosgenerados($exhortosgeneradosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblexhortosgenerados  WHERE idExhortoGenerado='".$exhortosgeneradosDto->getIdExhortoGenerado()."'";
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
public function selectExhortosgenerados($exhortosgeneradosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idExhortoGenerado,idActuacion,cveEstatusExhorto,cveEstadoDestino,cveOficialia,numero,anio,idExhortoDestino,requisitoria,activo,fechaRegistro,fechaActualizacion FROM tblexhortosgenerados ";
if(($exhortosgeneradosDto->getIdExhortoGenerado()!="") ||($exhortosgeneradosDto->getIdActuacion()!="") ||($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($exhortosgeneradosDto->getIdExhortoGenerado()!=""){
$sql.="idExhortoGenerado='".$exhortosgeneradosDto->getIdExhortoGenerado()."'";
if(($exhortosgeneradosDto->getIdActuacion()!="") ||($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$exhortosgeneradosDto->getIdActuacion()."'";
if(($exhortosgeneradosDto->getCveEstatusExhorto()!="") ||($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getCveEstatusExhorto()!=""){
$sql.="cveEstatusExhorto='".$exhortosgeneradosDto->getCveEstatusExhorto()."'";
if(($exhortosgeneradosDto->getCveEstadoDestino()!="") ||($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino='".$exhortosgeneradosDto->getCveEstadoDestino()."'";
if(($exhortosgeneradosDto->getCveOficialia()!="") ||($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getCveOficialia()!=""){
$sql.="cveOficialia='".$exhortosgeneradosDto->getCveOficialia()."'";
if(($exhortosgeneradosDto->getNumero()!="") ||($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getNumero()!=""){
$sql.="numero='".$exhortosgeneradosDto->getNumero()."'";
if(($exhortosgeneradosDto->getAnio()!="") ||($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getAnio()!=""){
$sql.="anio='".$exhortosgeneradosDto->getAnio()."'";
if(($exhortosgeneradosDto->getIdExhortoDestino()!="") ||($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getIdExhortoDestino()!=""){
$sql.="idExhortoDestino='".$exhortosgeneradosDto->getIdExhortoDestino()."'";
if(($exhortosgeneradosDto->getRequisitoria()!="") ||($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getRequisitoria()!=""){
$sql.="requisitoria='".$exhortosgeneradosDto->getRequisitoria()."'";
if(($exhortosgeneradosDto->getActivo()!="") ||($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getActivo()!=""){
$sql.="activo='".$exhortosgeneradosDto->getActivo()."'";
if(($exhortosgeneradosDto->getFechaRegistro()!="") ||($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$exhortosgeneradosDto->getFechaRegistro()."'";
if(($exhortosgeneradosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($exhortosgeneradosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$exhortosgeneradosDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new ExhortosgeneradosDTO();
$tmp[$contador]->setIdExhortoGenerado($row["idExhortoGenerado"]);
$tmp[$contador]->setIdActuacion($row["idActuacion"]);
$tmp[$contador]->setCveEstatusExhorto($row["cveEstatusExhorto"]);
$tmp[$contador]->setCveEstadoDestino($row["cveEstadoDestino"]);
$tmp[$contador]->setCveOficialia($row["cveOficialia"]);
$tmp[$contador]->setNumero($row["numero"]);
$tmp[$contador]->setAnio($row["anio"]);
$tmp[$contador]->setIdExhortoDestino($row["idExhortoDestino"]);
$tmp[$contador]->setRequisitoria($row["requisitoria"]);
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