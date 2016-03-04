<?php

/*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 FACADES
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

session_start();
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/tiposdocumentos/TiposdocumentosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/tiposdocumentos/TiposdocumentosController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class TiposdocumentosFacade {
private $proveedor;
public function __construct() {
}
public function validarTiposdocumentos($TiposdocumentosDto){
$TiposdocumentosDto->setcveTipoDocumento(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getcveTipoDocumento(),"utf8"):strtoupper($TiposdocumentosDto->getcveTipoDocumento()))))));
if($this->esFecha($TiposdocumentosDto->getcveTipoDocumento())){
$TiposdocumentosDto->setcveTipoDocumento($this->fechaMysql($TiposdocumentosDto->getcveTipoDocumento()));
}
$TiposdocumentosDto->setdescTipoDocumento(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getdescTipoDocumento(),"utf8"):strtoupper($TiposdocumentosDto->getdescTipoDocumento()))))));
if($this->esFecha($TiposdocumentosDto->getdescTipoDocumento())){
$TiposdocumentosDto->setdescTipoDocumento($this->fechaMysql($TiposdocumentosDto->getdescTipoDocumento()));
}
$TiposdocumentosDto->setextension(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getextension(),"utf8"):strtoupper($TiposdocumentosDto->getextension()))))));
if($this->esFecha($TiposdocumentosDto->getextension())){
$TiposdocumentosDto->setextension($this->fechaMysql($TiposdocumentosDto->getextension()));
}
$TiposdocumentosDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getactivo(),"utf8"):strtoupper($TiposdocumentosDto->getactivo()))))));
if($this->esFecha($TiposdocumentosDto->getactivo())){
$TiposdocumentosDto->setactivo($this->fechaMysql($TiposdocumentosDto->getactivo()));
}
$TiposdocumentosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getfechaActualizacion(),"utf8"):strtoupper($TiposdocumentosDto->getfechaActualizacion()))))));
if($this->esFecha($TiposdocumentosDto->getfechaActualizacion())){
$TiposdocumentosDto->setfechaActualizacion($this->fechaMysql($TiposdocumentosDto->getfechaActualizacion()));
}
$TiposdocumentosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TiposdocumentosDto->getfechaRegistro(),"utf8"):strtoupper($TiposdocumentosDto->getfechaRegistro()))))));
if($this->esFecha($TiposdocumentosDto->getfechaRegistro())){
$TiposdocumentosDto->setfechaRegistro($this->fechaMysql($TiposdocumentosDto->getfechaRegistro()));
}
return $TiposdocumentosDto;
}
public function selectTiposdocumentos($TiposdocumentosDto){
$TiposdocumentosDto=$this->validarTiposdocumentos($TiposdocumentosDto);
$TiposdocumentosController = new TiposdocumentosController();
$TiposdocumentosDto = $TiposdocumentosController->selectTiposdocumentos($TiposdocumentosDto);
if($TiposdocumentosDto!=""){
$dtoToJson = new DtoToJson($TiposdocumentosDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertTiposdocumentos($TiposdocumentosDto){
$TiposdocumentosDto=$this->validarTiposdocumentos($TiposdocumentosDto);
$TiposdocumentosController = new TiposdocumentosController();
$TiposdocumentosDto = $TiposdocumentosController->insertTiposdocumentos($TiposdocumentosDto);
if($TiposdocumentosDto!=""){
$dtoToJson = new DtoToJson($TiposdocumentosDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateTiposdocumentos($TiposdocumentosDto){
$TiposdocumentosDto=$this->validarTiposdocumentos($TiposdocumentosDto);
$TiposdocumentosController = new TiposdocumentosController();
$TiposdocumentosDto = $TiposdocumentosController->updateTiposdocumentos($TiposdocumentosDto);
if($TiposdocumentosDto!=""){
$dtoToJson = new DtoToJson($TiposdocumentosDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteTiposdocumentos($TiposdocumentosDto){
$TiposdocumentosDto=$this->validarTiposdocumentos($TiposdocumentosDto);
$TiposdocumentosController = new TiposdocumentosController();
$TiposdocumentosDto = $TiposdocumentosController->deleteTiposdocumentos($TiposdocumentosDto);
if($TiposdocumentosDto==true){
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"REGISTRO ELIMINADO DE FORMA CORRECTA"));
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
}
private function esFecha($fecha) {
if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
return true;
}
return false;
}
private function esFechaMysql($fecha) {
if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
return true;
}
return false;
}
private function fechaMysql($fecha) {
list($dia, $mes, $year) = explode("/", $fecha);
return $year . "-" . $mes . "-" . $dia;
}
private function fechaNormal($fecha) {
list($dia, $mes, $year) = explode("/", $fecha);
return $year . "-" . $mes . "-" . $dia;
}
}



@$cveTipoDocumento=$_POST["cveTipoDocumento"];
@$descTipoDocumento=$_POST["descTipoDocumento"];
@$extension=$_POST["extension"];
@$activo=$_POST["activo"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$accion=$_POST["accion"];

$tiposdocumentosFacade = new TiposdocumentosFacade();
$tiposdocumentosDto = new TiposdocumentosDTO();

$tiposdocumentosDto->setCveTipoDocumento($cveTipoDocumento);
$tiposdocumentosDto->setDescTipoDocumento($descTipoDocumento);
$tiposdocumentosDto->setExtension($extension);
$tiposdocumentosDto->setActivo($activo);
$tiposdocumentosDto->setFechaActualizacion($fechaActualizacion);
$tiposdocumentosDto->setFechaRegistro($fechaRegistro);

if( ($accion=="guardar") && ($cveTipoDocumento=="") ){
$tiposdocumentosDto=$tiposdocumentosFacade->insertTiposdocumentos($tiposdocumentosDto);
echo $tiposdocumentosDto;
} else if(($accion=="guardar") && ($cveTipoDocumento!="")){
$tiposdocumentosDto=$tiposdocumentosFacade->updateTiposdocumentos($tiposdocumentosDto);
echo $tiposdocumentosDto;
} else if($accion=="consultar"){
$tiposdocumentosDto=$tiposdocumentosFacade->selectTiposdocumentos($tiposdocumentosDto);
echo $tiposdocumentosDto;
} else if( ($accion=="baja") && ($cveTipoDocumento!="") ){
$tiposdocumentosDto=$tiposdocumentosFacade->deleteTiposdocumentos($tiposdocumentosDto);
echo $tiposdocumentosDto;
} else if( ($accion=="seleccionar") && ($cveTipoDocumento!="") ){
$tiposdocumentosDto=$tiposdocumentosFacade->selectTiposdocumentos($tiposdocumentosDto);
echo $tiposdocumentosDto;
}


?>