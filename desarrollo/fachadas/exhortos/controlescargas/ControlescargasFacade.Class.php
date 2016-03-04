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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/controlescargas/ControlescargasDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/controlescargas/ControlescargasController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class ControlescargasFacade {
private $proveedor;
public function __construct() {
}
public function validarControlescargas($ControlescargasDto){
$ControlescargasDto->setidControlCarga(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getidControlCarga(),"utf8"):strtoupper($ControlescargasDto->getidControlCarga()))))));
if($this->esFecha($ControlescargasDto->getidControlCarga())){
$ControlescargasDto->setidControlCarga($this->fechaMysql($ControlescargasDto->getidControlCarga()));
}
$ControlescargasDto->setcveConfiguracionCarga(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getcveConfiguracionCarga(),"utf8"):strtoupper($ControlescargasDto->getcveConfiguracionCarga()))))));
if($this->esFecha($ControlescargasDto->getcveConfiguracionCarga())){
$ControlescargasDto->setcveConfiguracionCarga($this->fechaMysql($ControlescargasDto->getcveConfiguracionCarga()));
}
$ControlescargasDto->setcveMateria(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getcveMateria(),"utf8"):strtoupper($ControlescargasDto->getcveMateria()))))));
if($this->esFecha($ControlescargasDto->getcveMateria())){
$ControlescargasDto->setcveMateria($this->fechaMysql($ControlescargasDto->getcveMateria()));
}
$ControlescargasDto->setcveJuicio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getcveJuicio(),"utf8"):strtoupper($ControlescargasDto->getcveJuicio()))))));
if($this->esFecha($ControlescargasDto->getcveJuicio())){
$ControlescargasDto->setcveJuicio($this->fechaMysql($ControlescargasDto->getcveJuicio()));
}
$ControlescargasDto->setcveCuantia(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getcveCuantia(),"utf8"):strtoupper($ControlescargasDto->getcveCuantia()))))));
if($this->esFecha($ControlescargasDto->getcveCuantia())){
$ControlescargasDto->setcveCuantia($this->fechaMysql($ControlescargasDto->getcveCuantia()));
}
$ControlescargasDto->setcveJuzgado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getcveJuzgado(),"utf8"):strtoupper($ControlescargasDto->getcveJuzgado()))))));
if($this->esFecha($ControlescargasDto->getcveJuzgado())){
$ControlescargasDto->setcveJuzgado($this->fechaMysql($ControlescargasDto->getcveJuzgado()));
}
$ControlescargasDto->settotalAsignados(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->gettotalAsignados(),"utf8"):strtoupper($ControlescargasDto->gettotalAsignados()))))));
if($this->esFecha($ControlescargasDto->gettotalAsignados())){
$ControlescargasDto->settotalAsignados($this->fechaMysql($ControlescargasDto->gettotalAsignados()));
}
$ControlescargasDto->setanioControl(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ControlescargasDto->getanioControl(),"utf8"):strtoupper($ControlescargasDto->getanioControl()))))));
if($this->esFecha($ControlescargasDto->getanioControl())){
$ControlescargasDto->setanioControl($this->fechaMysql($ControlescargasDto->getanioControl()));
}
return $ControlescargasDto;
}
public function selectControlescargas($ControlescargasDto){
$ControlescargasDto=$this->validarControlescargas($ControlescargasDto);
$ControlescargasController = new ControlescargasController();
$ControlescargasDto = $ControlescargasController->selectControlescargas($ControlescargasDto);
if($ControlescargasDto!=""){
$dtoToJson = new DtoToJson($ControlescargasDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertControlescargas($ControlescargasDto){
$ControlescargasDto=$this->validarControlescargas($ControlescargasDto);
$ControlescargasController = new ControlescargasController();
$ControlescargasDto = $ControlescargasController->insertControlescargas($ControlescargasDto);
if($ControlescargasDto!=""){
$dtoToJson = new DtoToJson($ControlescargasDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateControlescargas($ControlescargasDto){
$ControlescargasDto=$this->validarControlescargas($ControlescargasDto);
$ControlescargasController = new ControlescargasController();
$ControlescargasDto = $ControlescargasController->updateControlescargas($ControlescargasDto);
if($ControlescargasDto!=""){
$dtoToJson = new DtoToJson($ControlescargasDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteControlescargas($ControlescargasDto){
$ControlescargasDto=$this->validarControlescargas($ControlescargasDto);
$ControlescargasController = new ControlescargasController();
$ControlescargasDto = $ControlescargasController->deleteControlescargas($ControlescargasDto);
if($ControlescargasDto==true){
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



@$idControlCarga=$_POST["idControlCarga"];
@$cveConfiguracionCarga=$_POST["cveConfiguracionCarga"];
@$cveMateria=$_POST["cveMateria"];
@$cveJuicio=$_POST["cveJuicio"];
@$cveCuantia=$_POST["cveCuantia"];
@$cveJuzgado=$_POST["cveJuzgado"];
@$totalAsignados=$_POST["totalAsignados"];
@$anioControl=$_POST["anioControl"];
@$accion=$_POST["accion"];

$controlescargasFacade = new ControlescargasFacade();
$controlescargasDto = new ControlescargasDTO();

$controlescargasDto->setIdControlCarga($idControlCarga);
$controlescargasDto->setCveConfiguracionCarga($cveConfiguracionCarga);
$controlescargasDto->setCveMateria($cveMateria);
$controlescargasDto->setCveJuicio($cveJuicio);
$controlescargasDto->setCveCuantia($cveCuantia);
$controlescargasDto->setCveJuzgado($cveJuzgado);
$controlescargasDto->setTotalAsignados($totalAsignados);
$controlescargasDto->setAnioControl($anioControl);

if( ($accion=="guardar") && ($idControlCarga=="") ){
$controlescargasDto=$controlescargasFacade->insertControlescargas($controlescargasDto);
echo $controlescargasDto;
} else if(($accion=="guardar") && ($idControlCarga!="")){
$controlescargasDto=$controlescargasFacade->updateControlescargas($controlescargasDto);
echo $controlescargasDto;
} else if($accion=="consultar"){
$controlescargasDto=$controlescargasFacade->selectControlescargas($controlescargasDto);
echo $controlescargasDto;
} else if( ($accion=="baja") && ($idControlCarga!="") ){
$controlescargasDto=$controlescargasFacade->deleteControlescargas($controlescargasDto);
echo $controlescargasDto;
} else if( ($accion=="seleccionar") && ($idControlCarga!="") ){
$controlescargasDto=$controlescargasFacade->selectControlescargas($controlescargasDto);
echo $controlescargasDto;
}


?>