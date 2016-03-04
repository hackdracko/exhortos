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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/tipospartesmaeria/TipospartesmaeriaDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/tipospartesmaeria/TipospartesmaeriaController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class TipospartesmaeriaFacade {
private $proveedor;
public function __construct() {
}
public function validarTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto->setidTipoParteMateria(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getidTipoParteMateria(),"utf8"):strtoupper($TipospartesmaeriaDto->getidTipoParteMateria()))))));
if($this->esFecha($TipospartesmaeriaDto->getidTipoParteMateria())){
$TipospartesmaeriaDto->setidTipoParteMateria($this->fechaMysql($TipospartesmaeriaDto->getidTipoParteMateria()));
}
$TipospartesmaeriaDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getcveTipoParte(),"utf8"):strtoupper($TipospartesmaeriaDto->getcveTipoParte()))))));
if($this->esFecha($TipospartesmaeriaDto->getcveTipoParte())){
$TipospartesmaeriaDto->setcveTipoParte($this->fechaMysql($TipospartesmaeriaDto->getcveTipoParte()));
}
$TipospartesmaeriaDto->setcveMateria(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getcveMateria(),"utf8"):strtoupper($TipospartesmaeriaDto->getcveMateria()))))));
if($this->esFecha($TipospartesmaeriaDto->getcveMateria())){
$TipospartesmaeriaDto->setcveMateria($this->fechaMysql($TipospartesmaeriaDto->getcveMateria()));
}
$TipospartesmaeriaDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getactivo(),"utf8"):strtoupper($TipospartesmaeriaDto->getactivo()))))));
if($this->esFecha($TipospartesmaeriaDto->getactivo())){
$TipospartesmaeriaDto->setactivo($this->fechaMysql($TipospartesmaeriaDto->getactivo()));
}
$TipospartesmaeriaDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getfechaRegistro(),"utf8"):strtoupper($TipospartesmaeriaDto->getfechaRegistro()))))));
if($this->esFecha($TipospartesmaeriaDto->getfechaRegistro())){
$TipospartesmaeriaDto->setfechaRegistro($this->fechaMysql($TipospartesmaeriaDto->getfechaRegistro()));
}
$TipospartesmaeriaDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($TipospartesmaeriaDto->getfechaActualizacion(),"utf8"):strtoupper($TipospartesmaeriaDto->getfechaActualizacion()))))));
if($this->esFecha($TipospartesmaeriaDto->getfechaActualizacion())){
$TipospartesmaeriaDto->setfechaActualizacion($this->fechaMysql($TipospartesmaeriaDto->getfechaActualizacion()));
}
return $TipospartesmaeriaDto;
}
public function selectTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaController = new TipospartesmaeriaController();
$TipospartesmaeriaDto = $TipospartesmaeriaController->selectTipospartesmaeria($TipospartesmaeriaDto);
if($TipospartesmaeriaDto!=""){
$dtoToJson = new DtoToJson($TipospartesmaeriaDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaController = new TipospartesmaeriaController();
$TipospartesmaeriaDto = $TipospartesmaeriaController->insertTipospartesmaeria($TipospartesmaeriaDto);
if($TipospartesmaeriaDto!=""){
$dtoToJson = new DtoToJson($TipospartesmaeriaDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaController = new TipospartesmaeriaController();
$TipospartesmaeriaDto = $TipospartesmaeriaController->updateTipospartesmaeria($TipospartesmaeriaDto);
if($TipospartesmaeriaDto!=""){
$dtoToJson = new DtoToJson($TipospartesmaeriaDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaController = new TipospartesmaeriaController();
$TipospartesmaeriaDto = $TipospartesmaeriaController->deleteTipospartesmaeria($TipospartesmaeriaDto);
if($TipospartesmaeriaDto==true){
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



@$idTipoParteMateria=$_POST["idTipoParteMateria"];
@$cveTipoParte=$_POST["cveTipoParte"];
@$cveMateria=$_POST["cveMateria"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$tipospartesmaeriaFacade = new TipospartesmaeriaFacade();
$tipospartesmaeriaDto = new TipospartesmaeriaDTO();

$tipospartesmaeriaDto->setIdTipoParteMateria($idTipoParteMateria);
$tipospartesmaeriaDto->setCveTipoParte($cveTipoParte);
$tipospartesmaeriaDto->setCveMateria($cveMateria);
$tipospartesmaeriaDto->setActivo($activo);
$tipospartesmaeriaDto->setFechaRegistro($fechaRegistro);
$tipospartesmaeriaDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idTipoParteMateria=="") ){
$tipospartesmaeriaDto=$tipospartesmaeriaFacade->insertTipospartesmaeria($tipospartesmaeriaDto);
echo $tipospartesmaeriaDto;
} else if(($accion=="guardar") && ($idTipoParteMateria!="")){
$tipospartesmaeriaDto=$tipospartesmaeriaFacade->updateTipospartesmaeria($tipospartesmaeriaDto);
echo $tipospartesmaeriaDto;
} else if($accion=="consultar"){
$tipospartesmaeriaDto=$tipospartesmaeriaFacade->selectTipospartesmaeria($tipospartesmaeriaDto);
echo $tipospartesmaeriaDto;
} else if( ($accion=="baja") && ($idTipoParteMateria!="") ){
$tipospartesmaeriaDto=$tipospartesmaeriaFacade->deleteTipospartesmaeria($tipospartesmaeriaDto);
echo $tipospartesmaeriaDto;
} else if( ($accion=="seleccionar") && ($idTipoParteMateria!="") ){
$tipospartesmaeriaDto=$tipospartesmaeriaFacade->selectTipospartesmaeria($tipospartesmaeriaDto);
echo $tipospartesmaeriaDto;
}


?>