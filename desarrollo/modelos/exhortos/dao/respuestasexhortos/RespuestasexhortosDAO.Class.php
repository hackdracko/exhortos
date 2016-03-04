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

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/respuestasexhortos/RespuestasexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class RespuestasexhortosDAO{
 protected $_proveedor;
public function __construct($gestor = "mysql", $bd = "gestion") {
$this->_proveedor = new Proveedor('mysql', 'exhortos');
}
public function _conexion(){
$this->_proveedor->connect();
}
public function insertRespuestasexhortos($respuestasexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="INSERT INTO tblrespuestasexhortos(";
if($respuestasexhortosDto->getIdRespuestaExhorto()!=""){
$sql.="idRespuestaExhorto";
if(($respuestasexhortosDto->getIdExhorto()!="") ||($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto";
if(($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion";
if(($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino";
if(($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getNumPromocion()!=""){
$sql.="numPromocion";
if(($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getAniPromocion()!=""){
$sql.="aniPromocion";
if(($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacionPromocion()!=""){
$sql.="idActuacionPromocion";
if(($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstatusExhortos()!=""){
$sql.="cveEstatusExhortos";
if(($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getActivo()!=""){
$sql.="activo";
}
$sql.=",fechaRegistro";
$sql.=",fechaActualizacion";
$sql.=") VALUES(";
if($respuestasexhortosDto->getIdRespuestaExhorto()!=""){
$sql.="'".$respuestasexhortosDto->getIdRespuestaExhorto()."'";
if(($respuestasexhortosDto->getIdExhorto()!="") ||($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdExhorto()!=""){
$sql.="'".$respuestasexhortosDto->getIdExhorto()."'";
if(($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacion()!=""){
$sql.="'".$respuestasexhortosDto->getIdActuacion()."'";
if(($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstadoDestino()!=""){
$sql.="'".$respuestasexhortosDto->getCveEstadoDestino()."'";
if(($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getNumPromocion()!=""){
$sql.="'".$respuestasexhortosDto->getNumPromocion()."'";
if(($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getAniPromocion()!=""){
$sql.="'".$respuestasexhortosDto->getAniPromocion()."'";
if(($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacionPromocion()!=""){
$sql.="'".$respuestasexhortosDto->getIdActuacionPromocion()."'";
if(($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstatusExhortos()!=""){
$sql.="'".$respuestasexhortosDto->getCveEstatusExhortos()."'";
if(($respuestasexhortosDto->getActivo()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getActivo()!=""){
$sql.="'".$respuestasexhortosDto->getActivo()."'";
}
if($respuestasexhortosDto->getFechaRegistro()!=""){
}
if($respuestasexhortosDto->getFechaActualizacion()!=""){
}
$sql.=",now()";
$sql.=",now()";
$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new RespuestasexhortosDTO();
$tmp->setidRespuestaExhorto($this->_proveedor->lastID());
$tmp = $this->selectRespuestasexhortos($tmp,"",$this->_proveedor);
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
public function updateRespuestasexhortos($respuestasexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="UPDATE tblrespuestasexhortos SET ";
if($respuestasexhortosDto->getIdRespuestaExhorto()!=""){
$sql.="idRespuestaExhorto='".$respuestasexhortosDto->getIdRespuestaExhorto()."'";
if(($respuestasexhortosDto->getIdExhorto()!="") ||($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$respuestasexhortosDto->getIdExhorto()."'";
if(($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$respuestasexhortosDto->getIdActuacion()."'";
if(($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino='".$respuestasexhortosDto->getCveEstadoDestino()."'";
if(($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getNumPromocion()!=""){
$sql.="numPromocion='".$respuestasexhortosDto->getNumPromocion()."'";
if(($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getAniPromocion()!=""){
$sql.="aniPromocion='".$respuestasexhortosDto->getAniPromocion()."'";
if(($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getIdActuacionPromocion()!=""){
$sql.="idActuacionPromocion='".$respuestasexhortosDto->getIdActuacionPromocion()."'";
if(($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getCveEstatusExhortos()!=""){
$sql.="cveEstatusExhortos='".$respuestasexhortosDto->getCveEstatusExhortos()."'";
if(($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getActivo()!=""){
$sql.="activo='".$respuestasexhortosDto->getActivo()."'";
if(($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$respuestasexhortosDto->getFechaRegistro()."'";
if(($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=",";
}
}
if($respuestasexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$respuestasexhortosDto->getFechaActualizacion()."'";
}
$sql.=" WHERE idRespuestaExhorto='".$respuestasexhortosDto->getIdRespuestaExhorto()."'";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
$tmp = new RespuestasexhortosDTO();
$tmp->setidRespuestaExhorto($respuestasexhortosDto->getIdRespuestaExhorto());
$tmp = $this->selectRespuestasexhortos($tmp,"",$this->_proveedor);
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
public function deleteRespuestasexhortos($respuestasexhortosDto,$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="DELETE FROM tblrespuestasexhortos  WHERE idRespuestaExhorto='".$respuestasexhortosDto->getIdRespuestaExhorto()."'";
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
public function selectRespuestasexhortos($respuestasexhortosDto,$orden="",$proveedor=null){
$tmp = "";
$contador = 0;
if ($proveedor == null) {
$this->_conexion(null);
//$this->_proveedor->connect();
} else if ($proveedor != null) {
$this->_proveedor = $proveedor;
}
$sql="SELECT idRespuestaExhorto,idExhorto,idActuacion,cveEstadoDestino,numPromocion,aniPromocion,idActuacionPromocion,cveEstatusExhortos,activo,fechaRegistro,fechaActualizacion FROM tblrespuestasexhortos ";
if(($respuestasexhortosDto->getIdRespuestaExhorto()!="") ||($respuestasexhortosDto->getIdExhorto()!="") ||($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" WHERE ";
}
if($respuestasexhortosDto->getIdRespuestaExhorto()!=""){
$sql.="idRespuestaExhorto='".$respuestasexhortosDto->getIdRespuestaExhorto()."'";
if(($respuestasexhortosDto->getIdExhorto()!="") ||($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getIdExhorto()!=""){
$sql.="idExhorto='".$respuestasexhortosDto->getIdExhorto()."'";
if(($respuestasexhortosDto->getIdActuacion()!="") ||($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getIdActuacion()!=""){
$sql.="idActuacion='".$respuestasexhortosDto->getIdActuacion()."'";
if(($respuestasexhortosDto->getCveEstadoDestino()!="") ||($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getCveEstadoDestino()!=""){
$sql.="cveEstadoDestino='".$respuestasexhortosDto->getCveEstadoDestino()."'";
if(($respuestasexhortosDto->getNumPromocion()!="") ||($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getNumPromocion()!=""){
$sql.="numPromocion='".$respuestasexhortosDto->getNumPromocion()."'";
if(($respuestasexhortosDto->getAniPromocion()!="") ||($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getAniPromocion()!=""){
$sql.="aniPromocion='".$respuestasexhortosDto->getAniPromocion()."'";
if(($respuestasexhortosDto->getIdActuacionPromocion()!="") ||($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getIdActuacionPromocion()!=""){
$sql.="idActuacionPromocion='".$respuestasexhortosDto->getIdActuacionPromocion()."'";
if(($respuestasexhortosDto->getCveEstatusExhortos()!="") ||($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getCveEstatusExhortos()!=""){
$sql.="cveEstatusExhortos='".$respuestasexhortosDto->getCveEstatusExhortos()."'";
if(($respuestasexhortosDto->getActivo()!="") ||($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getActivo()!=""){
$sql.="activo='".$respuestasexhortosDto->getActivo()."'";
if(($respuestasexhortosDto->getFechaRegistro()!="") ||($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getFechaRegistro()!=""){
$sql.="fechaRegistro='".$respuestasexhortosDto->getFechaRegistro()."'";
if(($respuestasexhortosDto->getFechaActualizacion()!="") ){
$sql.=" AND ";
}
}
if($respuestasexhortosDto->getFechaActualizacion()!=""){
$sql.="fechaActualizacion='".$respuestasexhortosDto->getFechaActualizacion()."'";
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
$tmp[$contador] = new RespuestasexhortosDTO();
$tmp[$contador]->setIdRespuestaExhorto($row["idRespuestaExhorto"]);
$tmp[$contador]->setIdExhorto($row["idExhorto"]);
$tmp[$contador]->setIdActuacion($row["idActuacion"]);
$tmp[$contador]->setCveEstadoDestino($row["cveEstadoDestino"]);
$tmp[$contador]->setNumPromocion($row["numPromocion"]);
$tmp[$contador]->setAniPromocion($row["aniPromocion"]);
$tmp[$contador]->setIdActuacionPromocion($row["idActuacionPromocion"]);
$tmp[$contador]->setCveEstatusExhortos($row["cveEstatusExhortos"]);
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