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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/juiciosexhortos/JuiciosexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/juiciosexhortos/JuiciosexhortosController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class JuiciosexhortosFacade {
private $proveedor;
public function __construct() {
}
public function validarJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto->setidJuicioexhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getidJuicioexhorto(),"utf8"):strtoupper($JuiciosexhortosDto->getidJuicioexhorto()))))));
if($this->esFecha($JuiciosexhortosDto->getidJuicioexhorto())){
$JuiciosexhortosDto->setidJuicioexhorto($this->fechaMysql($JuiciosexhortosDto->getidJuicioexhorto()));
}
$JuiciosexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getidExhorto(),"utf8"):strtoupper($JuiciosexhortosDto->getidExhorto()))))));
if($this->esFecha($JuiciosexhortosDto->getidExhorto())){
$JuiciosexhortosDto->setidExhorto($this->fechaMysql($JuiciosexhortosDto->getidExhorto()));
}
$JuiciosexhortosDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getidExhortoGenerado(),"utf8"):strtoupper($JuiciosexhortosDto->getidExhortoGenerado()))))));
if($this->esFecha($JuiciosexhortosDto->getidExhortoGenerado())){
$JuiciosexhortosDto->setidExhortoGenerado($this->fechaMysql($JuiciosexhortosDto->getidExhortoGenerado()));
}
$JuiciosexhortosDto->setcveJuicio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getcveJuicio(),"utf8"):strtoupper($JuiciosexhortosDto->getcveJuicio()))))));
if($this->esFecha($JuiciosexhortosDto->getcveJuicio())){
$JuiciosexhortosDto->setcveJuicio($this->fechaMysql($JuiciosexhortosDto->getcveJuicio()));
}
$JuiciosexhortosDto->setotroJuicio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getotroJuicio(),"utf8"):strtoupper($JuiciosexhortosDto->getotroJuicio()))))));
if($this->esFecha($JuiciosexhortosDto->getotroJuicio())){
$JuiciosexhortosDto->setotroJuicio($this->fechaMysql($JuiciosexhortosDto->getotroJuicio()));
}
$JuiciosexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getactivo(),"utf8"):strtoupper($JuiciosexhortosDto->getactivo()))))));
if($this->esFecha($JuiciosexhortosDto->getactivo())){
$JuiciosexhortosDto->setactivo($this->fechaMysql($JuiciosexhortosDto->getactivo()));
}
$JuiciosexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getfechaRegistro(),"utf8"):strtoupper($JuiciosexhortosDto->getfechaRegistro()))))));
if($this->esFecha($JuiciosexhortosDto->getfechaRegistro())){
$JuiciosexhortosDto->setfechaRegistro($this->fechaMysql($JuiciosexhortosDto->getfechaRegistro()));
}
$JuiciosexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($JuiciosexhortosDto->getfechaActualizacion(),"utf8"):strtoupper($JuiciosexhortosDto->getfechaActualizacion()))))));
if($this->esFecha($JuiciosexhortosDto->getfechaActualizacion())){
$JuiciosexhortosDto->setfechaActualizacion($this->fechaMysql($JuiciosexhortosDto->getfechaActualizacion()));
}
return $JuiciosexhortosDto;
}
public function selectJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosController = new JuiciosexhortosController();
$JuiciosexhortosDto = $JuiciosexhortosController->selectJuiciosexhortos($JuiciosexhortosDto);
if($JuiciosexhortosDto!=""){
$dtoToJson = new DtoToJson($JuiciosexhortosDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosController = new JuiciosexhortosController();
$JuiciosexhortosDto = $JuiciosexhortosController->insertJuiciosexhortos($JuiciosexhortosDto);
if($JuiciosexhortosDto!=""){
$dtoToJson = new DtoToJson($JuiciosexhortosDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosController = new JuiciosexhortosController();
$JuiciosexhortosDto = $JuiciosexhortosController->updateJuiciosexhortos($JuiciosexhortosDto);
if($JuiciosexhortosDto!=""){
$dtoToJson = new DtoToJson($JuiciosexhortosDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosController = new JuiciosexhortosController();
$JuiciosexhortosDto = $JuiciosexhortosController->deleteJuiciosexhortos($JuiciosexhortosDto);
if($JuiciosexhortosDto==true){
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



@$idJuicioexhorto=$_POST["idJuicioexhorto"];
@$idExhorto=$_POST["idExhorto"];
@$idExhortoGenerado=$_POST["idExhortoGenerado"];
@$cveJuicio=$_POST["cveJuicio"];
@$otroJuicio=$_POST["otroJuicio"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$juiciosexhortosFacade = new JuiciosexhortosFacade();
$juiciosexhortosDto = new JuiciosexhortosDTO();

$juiciosexhortosDto->setIdJuicioexhorto($idJuicioexhorto);
$juiciosexhortosDto->setIdExhorto($idExhorto);
$juiciosexhortosDto->setIdExhortoGenerado($idExhortoGenerado);
$juiciosexhortosDto->setCveJuicio($cveJuicio);
$juiciosexhortosDto->setOtroJuicio($otroJuicio);
$juiciosexhortosDto->setActivo($activo);
$juiciosexhortosDto->setFechaRegistro($fechaRegistro);
$juiciosexhortosDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idJuicioexhorto=="") ){
$juiciosexhortosDto=$juiciosexhortosFacade->insertJuiciosexhortos($juiciosexhortosDto);
echo $juiciosexhortosDto;
} else if(($accion=="guardar") && ($idJuicioexhorto!="")){
$juiciosexhortosDto=$juiciosexhortosFacade->updateJuiciosexhortos($juiciosexhortosDto);
echo $juiciosexhortosDto;
} else if($accion=="consultar"){
$juiciosexhortosDto=$juiciosexhortosFacade->selectJuiciosexhortos($juiciosexhortosDto);
echo $juiciosexhortosDto;
} else if( ($accion=="baja") && ($idJuicioexhorto!="") ){
$juiciosexhortosDto=$juiciosexhortosFacade->deleteJuiciosexhortos($juiciosexhortosDto);
echo $juiciosexhortosDto;
} else if( ($accion=="seleccionar") && ($idJuicioexhorto!="") ){
$juiciosexhortosDto=$juiciosexhortosFacade->selectJuiciosexhortos($juiciosexhortosDto);
echo $juiciosexhortosDto;
}


?>