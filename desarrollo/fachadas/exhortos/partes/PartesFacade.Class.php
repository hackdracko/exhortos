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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/partes/PartesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/partes/PartesController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class PartesFacade {
private $proveedor;
public function __construct() {
}
public function validarPartes($PartesDto){
$PartesDto->setidParte(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getidParte(),"utf8"):strtoupper($PartesDto->getidParte()))))));
if($this->esFecha($PartesDto->getidParte())){
$PartesDto->setidParte($this->fechaMysql($PartesDto->getidParte()));
}
$PartesDto->setidExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getidExhorto(),"utf8"):strtoupper($PartesDto->getidExhorto()))))));
if($this->esFecha($PartesDto->getidExhorto())){
$PartesDto->setidExhorto($this->fechaMysql($PartesDto->getidExhorto()));
}
$PartesDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getidExhortoGenerado(),"utf8"):strtoupper($PartesDto->getidExhortoGenerado()))))));
if($this->esFecha($PartesDto->getidExhortoGenerado())){
$PartesDto->setidExhortoGenerado($this->fechaMysql($PartesDto->getidExhortoGenerado()));
}
$PartesDto->setnombre(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getnombre(),"utf8"):strtoupper($PartesDto->getnombre()))))));
if($this->esFecha($PartesDto->getnombre())){
$PartesDto->setnombre($this->fechaMysql($PartesDto->getnombre()));
}
$PartesDto->setpaterno(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getpaterno(),"utf8"):strtoupper($PartesDto->getpaterno()))))));
if($this->esFecha($PartesDto->getpaterno())){
$PartesDto->setpaterno($this->fechaMysql($PartesDto->getpaterno()));
}
$PartesDto->setmaterno(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getmaterno(),"utf8"):strtoupper($PartesDto->getmaterno()))))));
if($this->esFecha($PartesDto->getmaterno())){
$PartesDto->setmaterno($this->fechaMysql($PartesDto->getmaterno()));
}
$PartesDto->setnombrePersonaMoral(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getnombrePersonaMoral(),"utf8"):strtoupper($PartesDto->getnombrePersonaMoral()))))));
if($this->esFecha($PartesDto->getnombrePersonaMoral())){
$PartesDto->setnombrePersonaMoral($this->fechaMysql($PartesDto->getnombrePersonaMoral()));
}
$PartesDto->setcveTipoPersona(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getcveTipoPersona(),"utf8"):strtoupper($PartesDto->getcveTipoPersona()))))));
if($this->esFecha($PartesDto->getcveTipoPersona())){
$PartesDto->setcveTipoPersona($this->fechaMysql($PartesDto->getcveTipoPersona()));
}
$PartesDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getcveTipoParte(),"utf8"):strtoupper($PartesDto->getcveTipoParte()))))));
if($this->esFecha($PartesDto->getcveTipoParte())){
$PartesDto->setcveTipoParte($this->fechaMysql($PartesDto->getcveTipoParte()));
}
$PartesDto->setedad(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getedad(),"utf8"):strtoupper($PartesDto->getedad()))))));
if($this->esFecha($PartesDto->getedad())){
$PartesDto->setedad($this->fechaMysql($PartesDto->getedad()));
}
$PartesDto->setfechaNacimiento(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getfechaNacimiento(),"utf8"):strtoupper($PartesDto->getfechaNacimiento()))))));
if($this->esFecha($PartesDto->getfechaNacimiento())){
$PartesDto->setfechaNacimiento($this->fechaMysql($PartesDto->getfechaNacimiento()));
}
$PartesDto->setRFC(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getRFC(),"utf8"):strtoupper($PartesDto->getRFC()))))));
if($this->esFecha($PartesDto->getRFC())){
$PartesDto->setRFC($this->fechaMysql($PartesDto->getRFC()));
}
$PartesDto->setCURP(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getCURP(),"utf8"):strtoupper($PartesDto->getCURP()))))));
if($this->esFecha($PartesDto->getCURP())){
$PartesDto->setCURP($this->fechaMysql($PartesDto->getCURP()));
}
$PartesDto->setcveEstado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getcveEstado(),"utf8"):strtoupper($PartesDto->getcveEstado()))))));
if($this->esFecha($PartesDto->getcveEstado())){
$PartesDto->setcveEstado($this->fechaMysql($PartesDto->getcveEstado()));
}
$PartesDto->setcveMunicipio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getcveMunicipio(),"utf8"):strtoupper($PartesDto->getcveMunicipio()))))));
if($this->esFecha($PartesDto->getcveMunicipio())){
$PartesDto->setcveMunicipio($this->fechaMysql($PartesDto->getcveMunicipio()));
}
$PartesDto->setdomicilio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getdomicilio(),"utf8"):strtoupper($PartesDto->getdomicilio()))))));
if($this->esFecha($PartesDto->getdomicilio())){
$PartesDto->setdomicilio($this->fechaMysql($PartesDto->getdomicilio()));
}
$PartesDto->settelefono(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->gettelefono(),"utf8"):strtoupper($PartesDto->gettelefono()))))));
if($this->esFecha($PartesDto->gettelefono())){
$PartesDto->settelefono($this->fechaMysql($PartesDto->gettelefono()));
}
$PartesDto->setemail(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getemail(),"utf8"):strtoupper($PartesDto->getemail()))))));
if($this->esFecha($PartesDto->getemail())){
$PartesDto->setemail($this->fechaMysql($PartesDto->getemail()));
}
$PartesDto->setcveGenero(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getcveGenero(),"utf8"):strtoupper($PartesDto->getcveGenero()))))));
if($this->esFecha($PartesDto->getcveGenero())){
$PartesDto->setcveGenero($this->fechaMysql($PartesDto->getcveGenero()));
}
$PartesDto->setdetenido(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getdetenido(),"utf8"):strtoupper($PartesDto->getdetenido()))))));
if($this->esFecha($PartesDto->getdetenido())){
$PartesDto->setdetenido($this->fechaMysql($PartesDto->getdetenido()));
}
$PartesDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getactivo(),"utf8"):strtoupper($PartesDto->getactivo()))))));
if($this->esFecha($PartesDto->getactivo())){
$PartesDto->setactivo($this->fechaMysql($PartesDto->getactivo()));
}
$PartesDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getfechaRegistro(),"utf8"):strtoupper($PartesDto->getfechaRegistro()))))));
if($this->esFecha($PartesDto->getfechaRegistro())){
$PartesDto->setfechaRegistro($this->fechaMysql($PartesDto->getfechaRegistro()));
}
$PartesDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($PartesDto->getfechaActualizacion(),"utf8"):strtoupper($PartesDto->getfechaActualizacion()))))));
if($this->esFecha($PartesDto->getfechaActualizacion())){
$PartesDto->setfechaActualizacion($this->fechaMysql($PartesDto->getfechaActualizacion()));
}
return $PartesDto;
}
public function selectPartes($PartesDto){
$PartesDto=$this->validarPartes($PartesDto);
$PartesController = new PartesController();
$PartesDto = $PartesController->selectPartes($PartesDto);
if($PartesDto!=""){
$dtoToJson = new DtoToJson($PartesDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertPartes($PartesDto){
$PartesDto=$this->validarPartes($PartesDto);
$PartesController = new PartesController();
$PartesDto = $PartesController->insertPartes($PartesDto);
if($PartesDto!=""){
$dtoToJson = new DtoToJson($PartesDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updatePartes($PartesDto){
$PartesDto=$this->validarPartes($PartesDto);
$PartesController = new PartesController();
$PartesDto = $PartesController->updatePartes($PartesDto);
if($PartesDto!=""){
$dtoToJson = new DtoToJson($PartesDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deletePartes($PartesDto){
$PartesDto=$this->validarPartes($PartesDto);
$PartesController = new PartesController();
$PartesDto = $PartesController->deletePartes($PartesDto);
if($PartesDto==true){
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



@$idParte=$_POST["idParte"];
@$idExhorto=$_POST["idExhorto"];
@$idExhortoGenerado=$_POST["idExhortoGenerado"];
@$nombre=$_POST["nombre"];
@$paterno=$_POST["paterno"];
@$materno=$_POST["materno"];
@$nombrePersonaMoral=$_POST["nombrePersonaMoral"];
@$cveTipoPersona=$_POST["cveTipoPersona"];
@$cveTipoParte=$_POST["cveTipoParte"];
@$edad=$_POST["edad"];
@$fechaNacimiento=$_POST["fechaNacimiento"];
@$RFC=$_POST["RFC"];
@$CURP=$_POST["CURP"];
@$cveEstado=$_POST["cveEstado"];
@$cveMunicipio=$_POST["cveMunicipio"];
@$domicilio=$_POST["domicilio"];
@$telefono=$_POST["telefono"];
@$email=$_POST["email"];
@$cveGenero=$_POST["cveGenero"];
@$detenido=$_POST["detenido"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];

$partesFacade = new PartesFacade();
$partesDto = new PartesDTO();

$partesDto->setIdParte($idParte);
$partesDto->setIdExhorto($idExhorto);
$partesDto->setIdExhortoGenerado($idExhortoGenerado);
$partesDto->setNombre($nombre);
$partesDto->setPaterno($paterno);
$partesDto->setMaterno($materno);
$partesDto->setNombrePersonaMoral($nombrePersonaMoral);
$partesDto->setCveTipoPersona($cveTipoPersona);
$partesDto->setCveTipoParte($cveTipoParte);
$partesDto->setEdad($edad);
$partesDto->setFechaNacimiento($fechaNacimiento);
$partesDto->setRFC($RFC);
$partesDto->setCURP($CURP);
$partesDto->setCveEstado($cveEstado);
$partesDto->setCveMunicipio($cveMunicipio);
$partesDto->setDomicilio($domicilio);
$partesDto->setTelefono($telefono);
$partesDto->setEmail($email);
$partesDto->setCveGenero($cveGenero);
$partesDto->setDetenido($detenido);
$partesDto->setActivo($activo);
$partesDto->setFechaRegistro($fechaRegistro);
$partesDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idParte=="") ){
$partesDto=$partesFacade->insertPartes($partesDto);
echo $partesDto;
} else if(($accion=="guardar") && ($idParte!="")){
$partesDto=$partesFacade->updatePartes($partesDto);
echo $partesDto;
} else if($accion=="consultar"){
$partesDto=$partesFacade->selectPartes($partesDto);
echo $partesDto;
} else if( ($accion=="baja") && ($idParte!="") ){
$partesDto=$partesFacade->deletePartes($partesDto);
echo $partesDto;
} else if( ($accion=="seleccionar") && ($idParte!="") ){
$partesDto=$partesFacade->selectPartes($partesDto);
echo $partesDto;
}


?>