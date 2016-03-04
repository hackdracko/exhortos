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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/promoventesactuaciones/PromoventesactuacionesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/promoventesactuaciones/PromoventesactuacionesController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class PromoventesactuacionesFacade {
private $proveedor;
public function __construct() {
}
public function validarPromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto->setidPromoventeActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getidPromoventeActuacion(),"utf8"):strtoupper($PromoventesactuacionesDto->getidPromoventeActuacion()))))));
if($this->esFecha($PromoventesactuacionesDto->getidPromoventeActuacion())){
$PromoventesactuacionesDto->setidPromoventeActuacion($this->fechaMysql($PromoventesactuacionesDto->getidPromoventeActuacion()));
}
$PromoventesactuacionesDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getidActuacion(),"utf8"):strtoupper($PromoventesactuacionesDto->getidActuacion()))))));
if($this->esFecha($PromoventesactuacionesDto->getidActuacion())){
$PromoventesactuacionesDto->setidActuacion($this->fechaMysql($PromoventesactuacionesDto->getidActuacion()));
}
$PromoventesactuacionesDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getcveTipoParte(),"utf8"):strtoupper($PromoventesactuacionesDto->getcveTipoParte()))))));
if($this->esFecha($PromoventesactuacionesDto->getcveTipoParte())){
$PromoventesactuacionesDto->setcveTipoParte($this->fechaMysql($PromoventesactuacionesDto->getcveTipoParte()));
}
$PromoventesactuacionesDto->setcveTipoPersona(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getcveTipoPersona(),"utf8"):strtoupper($PromoventesactuacionesDto->getcveTipoPersona()))))));
if($this->esFecha($PromoventesactuacionesDto->getcveTipoPersona())){
$PromoventesactuacionesDto->setcveTipoPersona($this->fechaMysql($PromoventesactuacionesDto->getcveTipoPersona()));
}
$PromoventesactuacionesDto->setnombre(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getnombre(),"utf8"):strtoupper($PromoventesactuacionesDto->getnombre()))))));
if($this->esFecha($PromoventesactuacionesDto->getnombre())){
$PromoventesactuacionesDto->setnombre($this->fechaMysql($PromoventesactuacionesDto->getnombre()));
}
$PromoventesactuacionesDto->setpaterno(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getpaterno(),"utf8"):strtoupper($PromoventesactuacionesDto->getpaterno()))))));
if($this->esFecha($PromoventesactuacionesDto->getpaterno())){
$PromoventesactuacionesDto->setpaterno($this->fechaMysql($PromoventesactuacionesDto->getpaterno()));
}
$PromoventesactuacionesDto->setmaterno(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getmaterno(),"utf8"):strtoupper($PromoventesactuacionesDto->getmaterno()))))));
if($this->esFecha($PromoventesactuacionesDto->getmaterno())){
$PromoventesactuacionesDto->setmaterno($this->fechaMysql($PromoventesactuacionesDto->getmaterno()));
}
$PromoventesactuacionesDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getactivo(),"utf8"):strtoupper($PromoventesactuacionesDto->getactivo()))))));
if($this->esFecha($PromoventesactuacionesDto->getactivo())){
$PromoventesactuacionesDto->setactivo($this->fechaMysql($PromoventesactuacionesDto->getactivo()));
}
$PromoventesactuacionesDto->setnombrePersonaMoral(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getnombrePersonaMoral(),"utf8"):strtoupper($PromoventesactuacionesDto->getnombrePersonaMoral()))))));
if($this->esFecha($PromoventesactuacionesDto->getnombrePersonaMoral())){
$PromoventesactuacionesDto->setnombrePersonaMoral($this->fechaMysql($PromoventesactuacionesDto->getnombrePersonaMoral()));
}
$PromoventesactuacionesDto->setcedula(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getcedula(),"utf8"):strtoupper($PromoventesactuacionesDto->getcedula()))))));
if($this->esFecha($PromoventesactuacionesDto->getcedula())){
$PromoventesactuacionesDto->setcedula($this->fechaMysql($PromoventesactuacionesDto->getcedula()));
}
$PromoventesactuacionesDto->setcveGenero(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PromoventesactuacionesDto->getcveGenero(),"utf8"):strtoupper($PromoventesactuacionesDto->getcveGenero()))))));
if($this->esFecha($PromoventesactuacionesDto->getcveGenero())){
$PromoventesactuacionesDto->setcveGenero($this->fechaMysql($PromoventesactuacionesDto->getcveGenero()));
}
return $PromoventesactuacionesDto;
}
public function selectPromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesController = new PromoventesactuacionesController();
$PromoventesactuacionesDto = $PromoventesactuacionesController->selectPromoventesactuaciones($PromoventesactuacionesDto);
if($PromoventesactuacionesDto!=""){
$dtoToJson = new DtoToJson($PromoventesactuacionesDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertPromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesController = new PromoventesactuacionesController();
$PromoventesactuacionesDto = $PromoventesactuacionesController->insertPromoventesactuaciones($PromoventesactuacionesDto);
if($PromoventesactuacionesDto!=""){
$dtoToJson = new DtoToJson($PromoventesactuacionesDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updatePromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesController = new PromoventesactuacionesController();
$PromoventesactuacionesDto = $PromoventesactuacionesController->updatePromoventesactuaciones($PromoventesactuacionesDto);
if($PromoventesactuacionesDto!=""){
$dtoToJson = new DtoToJson($PromoventesactuacionesDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deletePromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesController = new PromoventesactuacionesController();
$PromoventesactuacionesDto = $PromoventesactuacionesController->deletePromoventesactuaciones($PromoventesactuacionesDto);
if($PromoventesactuacionesDto==true){
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



@$idPromoventeActuacion=$_POST["idPromoventeActuacion"];
@$idActuacion=$_POST["idActuacion"];
@$cveTipoParte=$_POST["cveTipoParte"];
@$cveTipoPersona=$_POST["cveTipoPersona"];
@$nombre=$_POST["nombre"];
@$paterno=$_POST["paterno"];
@$materno=$_POST["materno"];
@$activo=$_POST["activo"];
@$nombrePersonaMoral=$_POST["nombrePersonaMoral"];
@$cedula=$_POST["cedula"];
@$cveGenero=$_POST["cveGenero"];
@$accion=$_POST["accion"];

$promoventesactuacionesFacade = new PromoventesactuacionesFacade();
$promoventesactuacionesDto = new PromoventesactuacionesDTO();

$promoventesactuacionesDto->setIdPromoventeActuacion($idPromoventeActuacion);
$promoventesactuacionesDto->setIdActuacion($idActuacion);
$promoventesactuacionesDto->setCveTipoParte($cveTipoParte);
$promoventesactuacionesDto->setCveTipoPersona($cveTipoPersona);
$promoventesactuacionesDto->setNombre($nombre);
$promoventesactuacionesDto->setPaterno($paterno);
$promoventesactuacionesDto->setMaterno($materno);
$promoventesactuacionesDto->setActivo($activo);
$promoventesactuacionesDto->setNombrePersonaMoral($nombrePersonaMoral);
$promoventesactuacionesDto->setCedula($cedula);
$promoventesactuacionesDto->setCveGenero($cveGenero);

if( ($accion=="guardar") && ($idPromoventeActuacion=="") ){
$promoventesactuacionesDto=$promoventesactuacionesFacade->insertPromoventesactuaciones($promoventesactuacionesDto);
echo $promoventesactuacionesDto;
} else if(($accion=="guardar") && ($idPromoventeActuacion!="")){
$promoventesactuacionesDto=$promoventesactuacionesFacade->updatePromoventesactuaciones($promoventesactuacionesDto);
echo $promoventesactuacionesDto;
} else if($accion=="consultar"){
$promoventesactuacionesDto=$promoventesactuacionesFacade->selectPromoventesactuaciones($promoventesactuacionesDto);
echo $promoventesactuacionesDto;
} else if( ($accion=="baja") && ($idPromoventeActuacion!="") ){
$promoventesactuacionesDto=$promoventesactuacionesFacade->deletePromoventesactuaciones($promoventesactuacionesDto);
echo $promoventesactuacionesDto;
} else if( ($accion=="seleccionar") && ($idPromoventeActuacion!="") ){
$promoventesactuacionesDto=$promoventesactuacionesFacade->selectPromoventesactuaciones($promoventesactuacionesDto);
echo $promoventesactuacionesDto;
}


?>