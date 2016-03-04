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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/respuestasexhortos/RespuestasexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/respuestasexhortos/RespuestasexhortosController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class RespuestasexhortosFacade {
private $proveedor;
public function __construct() {
}
public function validarRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto->setidRespuestaExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getidRespuestaExhorto(),"utf8"):strtoupper($RespuestasexhortosDto->getidRespuestaExhorto()))))));
if($this->esFecha($RespuestasexhortosDto->getidRespuestaExhorto())){
$RespuestasexhortosDto->setidRespuestaExhorto($this->fechaMysql($RespuestasexhortosDto->getidRespuestaExhorto()));
}
$RespuestasexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getidExhorto(),"utf8"):strtoupper($RespuestasexhortosDto->getidExhorto()))))));
if($this->esFecha($RespuestasexhortosDto->getidExhorto())){
$RespuestasexhortosDto->setidExhorto($this->fechaMysql($RespuestasexhortosDto->getidExhorto()));
}
$RespuestasexhortosDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getidActuacion(),"utf8"):strtoupper($RespuestasexhortosDto->getidActuacion()))))));
if($this->esFecha($RespuestasexhortosDto->getidActuacion())){
$RespuestasexhortosDto->setidActuacion($this->fechaMysql($RespuestasexhortosDto->getidActuacion()));
}
$RespuestasexhortosDto->setcveEstadoDestino(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getcveEstadoDestino(),"utf8"):strtoupper($RespuestasexhortosDto->getcveEstadoDestino()))))));
if($this->esFecha($RespuestasexhortosDto->getcveEstadoDestino())){
$RespuestasexhortosDto->setcveEstadoDestino($this->fechaMysql($RespuestasexhortosDto->getcveEstadoDestino()));
}
$RespuestasexhortosDto->setnumPromocion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getnumPromocion(),"utf8"):strtoupper($RespuestasexhortosDto->getnumPromocion()))))));
if($this->esFecha($RespuestasexhortosDto->getnumPromocion())){
$RespuestasexhortosDto->setnumPromocion($this->fechaMysql($RespuestasexhortosDto->getnumPromocion()));
}
$RespuestasexhortosDto->setaniPromocion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getaniPromocion(),"utf8"):strtoupper($RespuestasexhortosDto->getaniPromocion()))))));
if($this->esFecha($RespuestasexhortosDto->getaniPromocion())){
$RespuestasexhortosDto->setaniPromocion($this->fechaMysql($RespuestasexhortosDto->getaniPromocion()));
}
$RespuestasexhortosDto->setidActuacionPromocion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getidActuacionPromocion(),"utf8"):strtoupper($RespuestasexhortosDto->getidActuacionPromocion()))))));
if($this->esFecha($RespuestasexhortosDto->getidActuacionPromocion())){
$RespuestasexhortosDto->setidActuacionPromocion($this->fechaMysql($RespuestasexhortosDto->getidActuacionPromocion()));
}
$RespuestasexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getactivo(),"utf8"):strtoupper($RespuestasexhortosDto->getactivo()))))));
if($this->esFecha($RespuestasexhortosDto->getactivo())){
$RespuestasexhortosDto->setactivo($this->fechaMysql($RespuestasexhortosDto->getactivo()));
}
$RespuestasexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getfechaRegistro(),"utf8"):strtoupper($RespuestasexhortosDto->getfechaRegistro()))))));
if($this->esFecha($RespuestasexhortosDto->getfechaRegistro())){
$RespuestasexhortosDto->setfechaRegistro($this->fechaMysql($RespuestasexhortosDto->getfechaRegistro()));
}
$RespuestasexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($RespuestasexhortosDto->getfechaActualizacion(),"utf8"):strtoupper($RespuestasexhortosDto->getfechaActualizacion()))))));
if($this->esFecha($RespuestasexhortosDto->getfechaActualizacion())){
$RespuestasexhortosDto->setfechaActualizacion($this->fechaMysql($RespuestasexhortosDto->getfechaActualizacion()));
}
return $RespuestasexhortosDto;
}
public function selectRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosController = new RespuestasexhortosController();
$RespuestasexhortosDto = $RespuestasexhortosController->selectRespuestasexhortos($RespuestasexhortosDto);
if($RespuestasexhortosDto!=""){
$dtoToJson = new DtoToJson($RespuestasexhortosDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosController = new RespuestasexhortosController();
$RespuestasexhortosDto = $RespuestasexhortosController->insertRespuestasexhortos($RespuestasexhortosDto);
if($RespuestasexhortosDto!=""){
$dtoToJson = new DtoToJson($RespuestasexhortosDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosController = new RespuestasexhortosController();
$RespuestasexhortosDto = $RespuestasexhortosController->updateRespuestasexhortos($RespuestasexhortosDto);
if($RespuestasexhortosDto!=""){
$dtoToJson = new DtoToJson($RespuestasexhortosDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosController = new RespuestasexhortosController();
$RespuestasexhortosDto = $RespuestasexhortosController->deleteRespuestasexhortos($RespuestasexhortosDto);
if($RespuestasexhortosDto==true){
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



@$idRespuestaExhorto=$_POST["idRespuestaExhorto"];
@$idExhorto=$_POST["idExhorto"];
@$idActuacion=$_POST["idActuacion"];
@$cveEstadoDestino=$_POST["cveEstadoDestino"];
@$numPromocion=$_POST["numPromocion"];
@$aniPromocion=$_POST["aniPromocion"];
@$idActuacionPromocion=$_POST["idActuacionPromocion"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$respuestasexhortosFacade = new RespuestasexhortosFacade();
$respuestasexhortosDto = new RespuestasexhortosDTO();

$respuestasexhortosDto->setIdRespuestaExhorto($idRespuestaExhorto);
$respuestasexhortosDto->setIdExhorto($idExhorto);
$respuestasexhortosDto->setIdActuacion($idActuacion);
$respuestasexhortosDto->setCveEstadoDestino($cveEstadoDestino);
$respuestasexhortosDto->setNumPromocion($numPromocion);
$respuestasexhortosDto->setAniPromocion($aniPromocion);
$respuestasexhortosDto->setIdActuacionPromocion($idActuacionPromocion);
$respuestasexhortosDto->setActivo($activo);
$respuestasexhortosDto->setFechaRegistro($fechaRegistro);
$respuestasexhortosDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idRespuestaExhorto=="") ){
$respuestasexhortosDto=$respuestasexhortosFacade->insertRespuestasexhortos($respuestasexhortosDto);
echo $respuestasexhortosDto;
} else if(($accion=="guardar") && ($idRespuestaExhorto!="")){
$respuestasexhortosDto=$respuestasexhortosFacade->updateRespuestasexhortos($respuestasexhortosDto);
echo $respuestasexhortosDto;
} else if($accion=="consultar"){
$respuestasexhortosDto=$respuestasexhortosFacade->selectRespuestasexhortos($respuestasexhortosDto);
echo $respuestasexhortosDto;
} else if( ($accion=="baja") && ($idRespuestaExhorto!="") ){
$respuestasexhortosDto=$respuestasexhortosFacade->deleteRespuestasexhortos($respuestasexhortosDto);
echo $respuestasexhortosDto;
} else if( ($accion=="seleccionar") && ($idRespuestaExhorto!="") ){
$respuestasexhortosDto=$respuestasexhortosFacade->selectRespuestasexhortos($respuestasexhortosDto);
echo $respuestasexhortosDto;
}


?>