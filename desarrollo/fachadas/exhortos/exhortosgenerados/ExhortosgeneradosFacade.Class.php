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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/exhortosgenerados/ExhortosgeneradosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/exhortosgenerados/ExhortosgeneradosController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class ExhortosgeneradosFacade {
private $proveedor;
public function __construct() {
}
public function validarExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getidExhortoGenerado(),"utf8"):strtoupper($ExhortosgeneradosDto->getidExhortoGenerado()))))));
if($this->esFecha($ExhortosgeneradosDto->getidExhortoGenerado())){
$ExhortosgeneradosDto->setidExhortoGenerado($this->fechaMysql($ExhortosgeneradosDto->getidExhortoGenerado()));
}
$ExhortosgeneradosDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getidActuacion(),"utf8"):strtoupper($ExhortosgeneradosDto->getidActuacion()))))));
if($this->esFecha($ExhortosgeneradosDto->getidActuacion())){
$ExhortosgeneradosDto->setidActuacion($this->fechaMysql($ExhortosgeneradosDto->getidActuacion()));
}
$ExhortosgeneradosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getcveEstatusExhorto(),"utf8"):strtoupper($ExhortosgeneradosDto->getcveEstatusExhorto()))))));
if($this->esFecha($ExhortosgeneradosDto->getcveEstatusExhorto())){
$ExhortosgeneradosDto->setcveEstatusExhorto($this->fechaMysql($ExhortosgeneradosDto->getcveEstatusExhorto()));
}
$ExhortosgeneradosDto->setcveEstadoDestino(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getcveEstadoDestino(),"utf8"):strtoupper($ExhortosgeneradosDto->getcveEstadoDestino()))))));
if($this->esFecha($ExhortosgeneradosDto->getcveEstadoDestino())){
$ExhortosgeneradosDto->setcveEstadoDestino($this->fechaMysql($ExhortosgeneradosDto->getcveEstadoDestino()));
}
$ExhortosgeneradosDto->setrequisitoria(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getrequisitoria(),"utf8"):strtoupper($ExhortosgeneradosDto->getrequisitoria()))))));
if($this->esFecha($ExhortosgeneradosDto->getrequisitoria())){
$ExhortosgeneradosDto->setrequisitoria($this->fechaMysql($ExhortosgeneradosDto->getrequisitoria()));
}
$ExhortosgeneradosDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getactivo(),"utf8"):strtoupper($ExhortosgeneradosDto->getactivo()))))));
if($this->esFecha($ExhortosgeneradosDto->getactivo())){
$ExhortosgeneradosDto->setactivo($this->fechaMysql($ExhortosgeneradosDto->getactivo()));
}
$ExhortosgeneradosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getfechaRegistro(),"utf8"):strtoupper($ExhortosgeneradosDto->getfechaRegistro()))))));
if($this->esFecha($ExhortosgeneradosDto->getfechaRegistro())){
$ExhortosgeneradosDto->setfechaRegistro($this->fechaMysql($ExhortosgeneradosDto->getfechaRegistro()));
}
$ExhortosgeneradosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ExhortosgeneradosDto->getfechaActualizacion(),"utf8"):strtoupper($ExhortosgeneradosDto->getfechaActualizacion()))))));
if($this->esFecha($ExhortosgeneradosDto->getfechaActualizacion())){
$ExhortosgeneradosDto->setfechaActualizacion($this->fechaMysql($ExhortosgeneradosDto->getfechaActualizacion()));
}
return $ExhortosgeneradosDto;
}
public function selectExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosController = new ExhortosgeneradosController();
$ExhortosgeneradosDto = $ExhortosgeneradosController->selectExhortosgenerados($ExhortosgeneradosDto);
if($ExhortosgeneradosDto!=""){
$dtoToJson = new DtoToJson($ExhortosgeneradosDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosController = new ExhortosgeneradosController();
$ExhortosgeneradosDto = $ExhortosgeneradosController->insertExhortosgenerados($ExhortosgeneradosDto);
if($ExhortosgeneradosDto!=""){
$dtoToJson = new DtoToJson($ExhortosgeneradosDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosController = new ExhortosgeneradosController();
$ExhortosgeneradosDto = $ExhortosgeneradosController->updateExhortosgenerados($ExhortosgeneradosDto);
if($ExhortosgeneradosDto!=""){
$dtoToJson = new DtoToJson($ExhortosgeneradosDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosController = new ExhortosgeneradosController();
$ExhortosgeneradosDto = $ExhortosgeneradosController->deleteExhortosgenerados($ExhortosgeneradosDto);
if($ExhortosgeneradosDto==true){
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



@$idExhortoGenerado=$_POST["idExhortoGenerado"];
@$idActuacion=$_POST["idActuacion"];
@$cveEstatusExhorto=$_POST["cveEstatusExhorto"];
@$cveEstadoDestino=$_POST["cveEstadoDestino"];
@$requisitoria=$_POST["requisitoria"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$exhortosgeneradosFacade = new ExhortosgeneradosFacade();
$exhortosgeneradosDto = new ExhortosgeneradosDTO();

$exhortosgeneradosDto->setIdExhortoGenerado($idExhortoGenerado);
$exhortosgeneradosDto->setIdActuacion($idActuacion);
$exhortosgeneradosDto->setCveEstatusExhorto($cveEstatusExhorto);
$exhortosgeneradosDto->setCveEstadoDestino($cveEstadoDestino);
$exhortosgeneradosDto->setRequisitoria($requisitoria);
$exhortosgeneradosDto->setActivo($activo);
$exhortosgeneradosDto->setFechaRegistro($fechaRegistro);
$exhortosgeneradosDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idExhortoGenerado=="") ){
$exhortosgeneradosDto=$exhortosgeneradosFacade->insertExhortosgenerados($exhortosgeneradosDto);
echo $exhortosgeneradosDto;
} else if(($accion=="guardar") && ($idExhortoGenerado!="")){
$exhortosgeneradosDto=$exhortosgeneradosFacade->updateExhortosgenerados($exhortosgeneradosDto);
echo $exhortosgeneradosDto;
} else if($accion=="consultar"){
$exhortosgeneradosDto=$exhortosgeneradosFacade->selectExhortosgenerados($exhortosgeneradosDto);
echo $exhortosgeneradosDto;
} else if( ($accion=="baja") && ($idExhortoGenerado!="") ){
$exhortosgeneradosDto=$exhortosgeneradosFacade->deleteExhortosgenerados($exhortosgeneradosDto);
echo $exhortosgeneradosDto;
} else if( ($accion=="seleccionar") && ($idExhortoGenerado!="") ){
$exhortosgeneradosDto=$exhortosgeneradosFacade->selectExhortosgenerados($exhortosgeneradosDto);
echo $exhortosgeneradosDto;
}


?>