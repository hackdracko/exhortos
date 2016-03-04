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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/configuracionescargas/ConfiguracionescargasDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/configuracionescargas/ConfiguracionescargasController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class ConfiguracionescargasFacade {
private $proveedor;
public function __construct() {
}
public function validarConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto->setcveConfiguracionCarga(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getcveConfiguracionCarga(),"utf8"):strtoupper($ConfiguracionescargasDto->getcveConfiguracionCarga()))))));
if($this->esFecha($ConfiguracionescargasDto->getcveConfiguracionCarga())){
$ConfiguracionescargasDto->setcveConfiguracionCarga($this->fechaMysql($ConfiguracionescargasDto->getcveConfiguracionCarga()));
}
$ConfiguracionescargasDto->setcveOficialia(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getcveOficialia(),"utf8"):strtoupper($ConfiguracionescargasDto->getcveOficialia()))))));
if($this->esFecha($ConfiguracionescargasDto->getcveOficialia())){
$ConfiguracionescargasDto->setcveOficialia($this->fechaMysql($ConfiguracionescargasDto->getcveOficialia()));
}
$ConfiguracionescargasDto->settopeCarga(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->gettopeCarga(),"utf8"):strtoupper($ConfiguracionescargasDto->gettopeCarga()))))));
if($this->esFecha($ConfiguracionescargasDto->gettopeCarga())){
$ConfiguracionescargasDto->settopeCarga($this->fechaMysql($ConfiguracionescargasDto->gettopeCarga()));
}
$ConfiguracionescargasDto->settipoOficialia(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->gettipoOficialia(),"utf8"):strtoupper($ConfiguracionescargasDto->gettipoOficialia()))))));
if($this->esFecha($ConfiguracionescargasDto->gettipoOficialia())){
$ConfiguracionescargasDto->settipoOficialia($this->fechaMysql($ConfiguracionescargasDto->gettipoOficialia()));
}
$ConfiguracionescargasDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getactivo(),"utf8"):strtoupper($ConfiguracionescargasDto->getactivo()))))));
if($this->esFecha($ConfiguracionescargasDto->getactivo())){
$ConfiguracionescargasDto->setactivo($this->fechaMysql($ConfiguracionescargasDto->getactivo()));
}
$ConfiguracionescargasDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getfechaActualizacion(),"utf8"):strtoupper($ConfiguracionescargasDto->getfechaActualizacion()))))));
if($this->esFecha($ConfiguracionescargasDto->getfechaActualizacion())){
$ConfiguracionescargasDto->setfechaActualizacion($this->fechaMysql($ConfiguracionescargasDto->getfechaActualizacion()));
}
$ConfiguracionescargasDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getfechaRegistro(),"utf8"):strtoupper($ConfiguracionescargasDto->getfechaRegistro()))))));
if($this->esFecha($ConfiguracionescargasDto->getfechaRegistro())){
$ConfiguracionescargasDto->setfechaRegistro($this->fechaMysql($ConfiguracionescargasDto->getfechaRegistro()));
}
$ConfiguracionescargasDto->setinicia(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->getinicia(),"utf8"):strtoupper($ConfiguracionescargasDto->getinicia()))))));
if($this->esFecha($ConfiguracionescargasDto->getinicia())){
$ConfiguracionescargasDto->setinicia($this->fechaMysql($ConfiguracionescargasDto->getinicia()));
}
$ConfiguracionescargasDto->settermina(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ConfiguracionescargasDto->gettermina(),"utf8"):strtoupper($ConfiguracionescargasDto->gettermina()))))));
if($this->esFecha($ConfiguracionescargasDto->gettermina())){
$ConfiguracionescargasDto->settermina($this->fechaMysql($ConfiguracionescargasDto->gettermina()));
}
return $ConfiguracionescargasDto;
}
public function selectConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasController = new ConfiguracionescargasController();
$ConfiguracionescargasDto = $ConfiguracionescargasController->selectConfiguracionescargas($ConfiguracionescargasDto);
if($ConfiguracionescargasDto!=""){
$dtoToJson = new DtoToJson($ConfiguracionescargasDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasController = new ConfiguracionescargasController();
$ConfiguracionescargasDto = $ConfiguracionescargasController->insertConfiguracionescargas($ConfiguracionescargasDto);
if($ConfiguracionescargasDto!=""){
$dtoToJson = new DtoToJson($ConfiguracionescargasDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasController = new ConfiguracionescargasController();
$ConfiguracionescargasDto = $ConfiguracionescargasController->updateConfiguracionescargas($ConfiguracionescargasDto);
if($ConfiguracionescargasDto!=""){
$dtoToJson = new DtoToJson($ConfiguracionescargasDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasController = new ConfiguracionescargasController();
$ConfiguracionescargasDto = $ConfiguracionescargasController->deleteConfiguracionescargas($ConfiguracionescargasDto);
if($ConfiguracionescargasDto==true){
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



@$cveConfiguracionCarga=$_POST["cveConfiguracionCarga"];
@$cveOficialia=$_POST["cveOficialia"];
@$topeCarga=$_POST["topeCarga"];
@$tipoOficialia=$_POST["tipoOficialia"];
@$activo=$_POST["activo"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$inicia=$_POST["inicia"];
@$termina=$_POST["termina"];
@$accion=$_POST["accion"];

$configuracionescargasFacade = new ConfiguracionescargasFacade();
$configuracionescargasDto = new ConfiguracionescargasDTO();

$configuracionescargasDto->setCveConfiguracionCarga($cveConfiguracionCarga);
$configuracionescargasDto->setCveOficialia($cveOficialia);
$configuracionescargasDto->setTopeCarga($topeCarga);
$configuracionescargasDto->setTipoOficialia($tipoOficialia);
$configuracionescargasDto->setActivo($activo);
$configuracionescargasDto->setFechaActualizacion($fechaActualizacion);
$configuracionescargasDto->setFechaRegistro($fechaRegistro);
$configuracionescargasDto->setInicia($inicia);
$configuracionescargasDto->setTermina($termina);

if( ($accion=="guardar") && ($cveConfiguracionCarga=="") ){
$configuracionescargasDto=$configuracionescargasFacade->insertConfiguracionescargas($configuracionescargasDto);
echo $configuracionescargasDto;
} else if(($accion=="guardar") && ($cveConfiguracionCarga!="")){
$configuracionescargasDto=$configuracionescargasFacade->updateConfiguracionescargas($configuracionescargasDto);
echo $configuracionescargasDto;
} else if($accion=="consultar"){
$configuracionescargasDto=$configuracionescargasFacade->selectConfiguracionescargas($configuracionescargasDto);
echo $configuracionescargasDto;
} else if( ($accion=="baja") && ($cveConfiguracionCarga!="") ){
$configuracionescargasDto=$configuracionescargasFacade->deleteConfiguracionescargas($configuracionescargasDto);
echo $configuracionescargasDto;
} else if( ($accion=="seleccionar") && ($cveConfiguracionCarga!="") ){
$configuracionescargasDto=$configuracionescargasFacade->selectConfiguracionescargas($configuracionescargasDto);
echo $configuracionescargasDto;
}


?>