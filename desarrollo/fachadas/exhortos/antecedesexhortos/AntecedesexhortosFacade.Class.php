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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/antecedesexhortos/AntecedesexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/antecedesexhortos/AntecedesexhortosController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class AntecedesexhortosFacade {
private $proveedor;
public function __construct() {
}
public function validarAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto->setidAntecedeExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getidAntecedeExhorto(),"utf8"):strtoupper($AntecedesexhortosDto->getidAntecedeExhorto()))))));
if($this->esFecha($AntecedesexhortosDto->getidAntecedeExhorto())){
$AntecedesexhortosDto->setidAntecedeExhorto($this->fechaMysql($AntecedesexhortosDto->getidAntecedeExhorto()));
}
$AntecedesexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getidExhorto(),"utf8"):strtoupper($AntecedesexhortosDto->getidExhorto()))))));
if($this->esFecha($AntecedesexhortosDto->getidExhorto())){
$AntecedesexhortosDto->setidExhorto($this->fechaMysql($AntecedesexhortosDto->getidExhorto()));
}
$AntecedesexhortosDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getidActuacion(),"utf8"):strtoupper($AntecedesexhortosDto->getidActuacion()))))));
if($this->esFecha($AntecedesexhortosDto->getidActuacion())){
$AntecedesexhortosDto->setidActuacion($this->fechaMysql($AntecedesexhortosDto->getidActuacion()));
}
$AntecedesexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getactivo(),"utf8"):strtoupper($AntecedesexhortosDto->getactivo()))))));
if($this->esFecha($AntecedesexhortosDto->getactivo())){
$AntecedesexhortosDto->setactivo($this->fechaMysql($AntecedesexhortosDto->getactivo()));
}
$AntecedesexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getfechaRegistro(),"utf8"):strtoupper($AntecedesexhortosDto->getfechaRegistro()))))));
if($this->esFecha($AntecedesexhortosDto->getfechaRegistro())){
$AntecedesexhortosDto->setfechaRegistro($this->fechaMysql($AntecedesexhortosDto->getfechaRegistro()));
}
$AntecedesexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($AntecedesexhortosDto->getfechaActualizacion(),"utf8"):strtoupper($AntecedesexhortosDto->getfechaActualizacion()))))));
if($this->esFecha($AntecedesexhortosDto->getfechaActualizacion())){
$AntecedesexhortosDto->setfechaActualizacion($this->fechaMysql($AntecedesexhortosDto->getfechaActualizacion()));
}
return $AntecedesexhortosDto;
}
public function selectAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosController = new AntecedesexhortosController();
$AntecedesexhortosDto = $AntecedesexhortosController->selectAntecedesexhortos($AntecedesexhortosDto);
if($AntecedesexhortosDto!=""){
$dtoToJson = new DtoToJson($AntecedesexhortosDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosController = new AntecedesexhortosController();
$AntecedesexhortosDto = $AntecedesexhortosController->insertAntecedesexhortos($AntecedesexhortosDto);
if($AntecedesexhortosDto!=""){
$dtoToJson = new DtoToJson($AntecedesexhortosDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosController = new AntecedesexhortosController();
$AntecedesexhortosDto = $AntecedesexhortosController->updateAntecedesexhortos($AntecedesexhortosDto);
if($AntecedesexhortosDto!=""){
$dtoToJson = new DtoToJson($AntecedesexhortosDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosController = new AntecedesexhortosController();
$AntecedesexhortosDto = $AntecedesexhortosController->deleteAntecedesexhortos($AntecedesexhortosDto);
if($AntecedesexhortosDto==true){
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



@$idAntecedeExhorto=$_POST["idAntecedeExhorto"];
@$idExhorto=$_POST["idExhorto"];
@$idActuacion=$_POST["idActuacion"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$antecedesexhortosFacade = new AntecedesexhortosFacade();
$antecedesexhortosDto = new AntecedesexhortosDTO();

$antecedesexhortosDto->setIdAntecedeExhorto($idAntecedeExhorto);
$antecedesexhortosDto->setIdExhorto($idExhorto);
$antecedesexhortosDto->setIdActuacion($idActuacion);
$antecedesexhortosDto->setActivo($activo);
$antecedesexhortosDto->setFechaRegistro($fechaRegistro);
$antecedesexhortosDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idAntecedeExhorto=="") ){
$antecedesexhortosDto=$antecedesexhortosFacade->insertAntecedesexhortos($antecedesexhortosDto);
echo $antecedesexhortosDto;
} else if(($accion=="guardar") && ($idAntecedeExhorto!="")){
$antecedesexhortosDto=$antecedesexhortosFacade->updateAntecedesexhortos($antecedesexhortosDto);
echo $antecedesexhortosDto;
} else if($accion=="consultar"){
$antecedesexhortosDto=$antecedesexhortosFacade->selectAntecedesexhortos($antecedesexhortosDto);
echo $antecedesexhortosDto;
} else if( ($accion=="baja") && ($idAntecedeExhorto!="") ){
$antecedesexhortosDto=$antecedesexhortosFacade->deleteAntecedesexhortos($antecedesexhortosDto);
echo $antecedesexhortosDto;
} else if( ($accion=="seleccionar") && ($idAntecedeExhorto!="") ){
$antecedesexhortosDto=$antecedesexhortosFacade->selectAntecedesexhortos($antecedesexhortosDto);
echo $antecedesexhortosDto;
}


?>