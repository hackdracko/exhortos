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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/permisosgrupos/PermisosgruposDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class PermisosgruposDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertPermisosgrupos($permisosgruposDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblpermisosgrupos(";
if($permisosgruposDto->getCvePermisoGrupo()!=""){
$sql.="cvePermisoGrupo";
if(($permisosgruposDto->getCveGrupo()!="") ||($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveGrupo()!=""){
$sql.="cveGrupo";
if(($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveSistema()!=""){
$sql.="cveSistema";
if(($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveFormulario()!=""){
$sql.="cveFormulario";
if(($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getConsulta()!=""){
$sql.="consulta";
if(($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getModificar()!=""){
$sql.="modificar";
if(($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getEliminar()!=""){
$sql.="eliminar";
if(($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getRegistrar()!=""){
$sql.="registrar";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($permisosgruposDto->getCvePermisoGrupo()!=""){
$sql.="'".$permisosgruposDto->getCvePermisoGrupo()."'";
if(($permisosgruposDto->getCveGrupo()!="") ||($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveGrupo()!=""){
$sql.="'".$permisosgruposDto->getCveGrupo()."'";
if(($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveSistema()!=""){
$sql.="'".$permisosgruposDto->getCveSistema()."'";
if(($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveFormulario()!=""){
$sql.="'".$permisosgruposDto->getCveFormulario()."'";
if(($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getConsulta()!=""){
$sql.="'".$permisosgruposDto->getConsulta()."'";
if(($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getModificar()!=""){
$sql.="'".$permisosgruposDto->getModificar()."'";
if(($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getEliminar()!=""){
$sql.="'".$permisosgruposDto->getEliminar()."'";
if(($permisosgruposDto->getRegistrar()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getRegistrar()!=""){
$sql.="'".$permisosgruposDto->getRegistrar()."'";
}
if($permisosgruposDto->getFechaRegistro()!=""){
}
if($permisosgruposDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PermisosgruposDTO();
$tmp->setcvePermisoGrupo($this->_proveedor->lastID());
$tmp = $this->selectPermisosgrupos($tmp,"",$this->_proveedor);
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
public function updatePermisosgrupos($permisosgruposDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblpermisosgrupos SET ";
if($permisosgruposDto->getCvePermisoGrupo()!=""){
$sql.="cvePermisoGrupo='".$permisosgruposDto->getCvePermisoGrupo()."'";
if(($permisosgruposDto->getCveGrupo()!="") ||($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveGrupo()!=""){
$sql.="cveGrupo='".$permisosgruposDto->getCveGrupo()."'";
if(($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveSistema()!=""){
$sql.="cveSistema='".$permisosgruposDto->getCveSistema()."'";
if(($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getCveFormulario()!=""){
$sql.="cveFormulario='".$permisosgruposDto->getCveFormulario()."'";
if(($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getConsulta()!=""){
$sql.="consulta='".$permisosgruposDto->getConsulta()."'";
if(($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getModificar()!=""){
$sql.="modificar='".$permisosgruposDto->getModificar()."'";
if(($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getEliminar()!=""){
$sql.="eliminar='".$permisosgruposDto->getEliminar()."'";
if(($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getRegistrar()!=""){
$sql.="registrar='".$permisosgruposDto->getRegistrar()."'";
if(($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$permisosgruposDto->getFechaRegistro()."'";
if(($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($permisosgruposDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$permisosgruposDto->getFechaActualizacion()."'";
}
$sql.=" WHERE cvePermisoGrupo='".$permisosgruposDto->getCvePermisoGrupo()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new PermisosgruposDTO();
$tmp->setcvePermisoGrupo($permisosgruposDto->getCvePermisoGrupo());
$tmp = $this->selectPermisosgrupos($tmp,"",$this->_proveedor);
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
public function deletePermisosgrupos($permisosgruposDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblpermisosgrupos  WHERE cvePermisoGrupo='".$permisosgruposDto->getCvePermisoGrupo()."'";
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
public function selectPermisosgrupos($permisosgruposDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT cvePermisoGrupo,cveGrupo,cveSistema,cveFormulario,consulta,modificar,eliminar,registrar,fechaRegistro,fechaActualizacion FROM tblpermisosgrupos ";
if(($permisosgruposDto->getCvePermisoGrupo()!="") ||($permisosgruposDto->getCveGrupo()!="") ||($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($permisosgruposDto->getCvePermisoGrupo()!=""){
$sql.="cvePermisoGrupo='".$permisosgruposDto->getCvePermisoGrupo()."'";
if(($permisosgruposDto->getCveGrupo()!="") ||($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getCveGrupo()!=""){
$sql.="cveGrupo='".$permisosgruposDto->getCveGrupo()."'";
if(($permisosgruposDto->getCveSistema()!="") ||($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getCveSistema()!=""){
$sql.="cveSistema='".$permisosgruposDto->getCveSistema()."'";
if(($permisosgruposDto->getCveFormulario()!="") ||($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getCveFormulario()!=""){
$sql.="cveFormulario='".$permisosgruposDto->getCveFormulario()."'";
if(($permisosgruposDto->getConsulta()!="") ||($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getConsulta()!=""){
$sql.="consulta='".$permisosgruposDto->getConsulta()."'";
if(($permisosgruposDto->getModificar()!="") ||($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getModificar()!=""){
$sql.="modificar='".$permisosgruposDto->getModificar()."'";
if(($permisosgruposDto->getEliminar()!="") ||($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getEliminar()!=""){
$sql.="eliminar='".$permisosgruposDto->getEliminar()."'";
if(($permisosgruposDto->getRegistrar()!="") ||($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getRegistrar()!=""){
$sql.="registrar='".$permisosgruposDto->getRegistrar()."'";
if(($permisosgruposDto->getFechaRegistro()!="") ||($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$permisosgruposDto->getFechaRegistro()."'";
if(($permisosgruposDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($permisosgruposDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$permisosgruposDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new PermisosgruposDTO();
$tmp[$contador]->setCvePermisoGrupo($row["cvePermisoGrupo"]);
$tmp[$contador]->setCveGrupo($row["cveGrupo"]);
$tmp[$contador]->setCveSistema($row["cveSistema"]);
$tmp[$contador]->setCveFormulario($row["cveFormulario"]);
$tmp[$contador]->setConsulta($row["consulta"]);
$tmp[$contador]->setModificar($row["modificar"]);
$tmp[$contador]->setEliminar($row["eliminar"]);
$tmp[$contador]->setRegistrar($row["registrar"]);
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