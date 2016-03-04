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
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/documentosimg/DocumentosimgController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class DocumentosimgFacade {
private $proveedor;
public function __construct() {
}
public function validarDocumentosimg($DocumentosimgDto){
$DocumentosimgDto->setidDocumentoImg(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getidDocumentoImg(),"utf8"):strtoupper($DocumentosimgDto->getidDocumentoImg()))))));
if($this->esFecha($DocumentosimgDto->getidDocumentoImg())){
$DocumentosimgDto->setidDocumentoImg($this->fechaMysql($DocumentosimgDto->getidDocumentoImg()));
}
$DocumentosimgDto->setidExhorto(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getidExhorto(),"utf8"):strtoupper($DocumentosimgDto->getidExhorto()))))));
if($this->esFecha($DocumentosimgDto->getidExhorto())){
$DocumentosimgDto->setidExhorto($this->fechaMysql($DocumentosimgDto->getidExhorto()));
}
$DocumentosimgDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getidActuacion(),"utf8"):strtoupper($DocumentosimgDto->getidActuacion()))))));
if($this->esFecha($DocumentosimgDto->getidActuacion())){
$DocumentosimgDto->setidActuacion($this->fechaMysql($DocumentosimgDto->getidActuacion()));
}
$DocumentosimgDto->setcveTipoDocumento(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getcveTipoDocumento(),"utf8"):strtoupper($DocumentosimgDto->getcveTipoDocumento()))))));
if($this->esFecha($DocumentosimgDto->getcveTipoDocumento())){
$DocumentosimgDto->setcveTipoDocumento($this->fechaMysql($DocumentosimgDto->getcveTipoDocumento()));
}
$DocumentosimgDto->setfechaDocumento(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getfechaDocumento(),"utf8"):strtoupper($DocumentosimgDto->getfechaDocumento()))))));
if($this->esFecha($DocumentosimgDto->getfechaDocumento())){
$DocumentosimgDto->setfechaDocumento($this->fechaMysql($DocumentosimgDto->getfechaDocumento()));
}
$DocumentosimgDto->setfechaModificacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getfechaModificacion(),"utf8"):strtoupper($DocumentosimgDto->getfechaModificacion()))))));
if($this->esFecha($DocumentosimgDto->getfechaModificacion())){
$DocumentosimgDto->setfechaModificacion($this->fechaMysql($DocumentosimgDto->getfechaModificacion()));
}
$DocumentosimgDto->setobservaciones(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getobservaciones(),"utf8"):strtoupper($DocumentosimgDto->getobservaciones()))))));
if($this->esFecha($DocumentosimgDto->getobservaciones())){
$DocumentosimgDto->setobservaciones($this->fechaMysql($DocumentosimgDto->getobservaciones()));
}
$DocumentosimgDto->setcveUsuario(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getcveUsuario(),"utf8"):strtoupper($DocumentosimgDto->getcveUsuario()))))));
if($this->esFecha($DocumentosimgDto->getcveUsuario())){
$DocumentosimgDto->setcveUsuario($this->fechaMysql($DocumentosimgDto->getcveUsuario()));
}
$DocumentosimgDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getactivo(),"utf8"):strtoupper($DocumentosimgDto->getactivo()))))));
if($this->esFecha($DocumentosimgDto->getactivo())){
$DocumentosimgDto->setactivo($this->fechaMysql($DocumentosimgDto->getactivo()));
}
$DocumentosimgDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getfechaActualizacion(),"utf8"):strtoupper($DocumentosimgDto->getfechaActualizacion()))))));
if($this->esFecha($DocumentosimgDto->getfechaActualizacion())){
$DocumentosimgDto->setfechaActualizacion($this->fechaMysql($DocumentosimgDto->getfechaActualizacion()));
}
$DocumentosimgDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($DocumentosimgDto->getfechaRegistro(),"utf8"):strtoupper($DocumentosimgDto->getfechaRegistro()))))));
if($this->esFecha($DocumentosimgDto->getfechaRegistro())){
$DocumentosimgDto->setfechaRegistro($this->fechaMysql($DocumentosimgDto->getfechaRegistro()));
}
return $DocumentosimgDto;
}
public function selectDocumentosimg($DocumentosimgDto){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgController = new DocumentosimgController();
$DocumentosimgDto = $DocumentosimgController->selectDocumentosimg($DocumentosimgDto);
if($DocumentosimgDto!=""){
$dtoToJson = new DtoToJson($DocumentosimgDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertDocumentosimg($DocumentosimgDto){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgController = new DocumentosimgController();
$DocumentosimgDto = $DocumentosimgController->insertDocumentosimg($DocumentosimgDto);
if($DocumentosimgDto!=""){
$dtoToJson = new DtoToJson($DocumentosimgDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateDocumentosimg($DocumentosimgDto){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgController = new DocumentosimgController();
$DocumentosimgDto = $DocumentosimgController->updateDocumentosimg($DocumentosimgDto);
if($DocumentosimgDto!=""){
$dtoToJson = new DtoToJson($DocumentosimgDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteDocumentosimg($DocumentosimgDto){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgController = new DocumentosimgController();
$DocumentosimgDto = $DocumentosimgController->deleteDocumentosimg($DocumentosimgDto);
if($DocumentosimgDto==true){
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



@$idDocumentoImg=$_POST["idDocumentoImg"];
@$idExhorto=$_POST["idExhorto"];
@$idActuacion=$_POST["idActuacion"];
@$cveTipoDocumento=$_POST["cveTipoDocumento"];
@$fechaDocumento=$_POST["fechaDocumento"];
@$fechaModificacion=$_POST["fechaModificacion"];
@$observaciones=$_POST["observaciones"];
@$cveUsuario=$_POST["cveUsuario"];
@$activo=$_POST["activo"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$accion=$_POST["accion"];

$documentosimgFacade = new DocumentosimgFacade();
$documentosimgDto = new DocumentosimgDTO();

$documentosimgDto->setIdDocumentoImg($idDocumentoImg);
$documentosimgDto->setIdExhorto($idExhorto);
$documentosimgDto->setIdActuacion($idActuacion);
$documentosimgDto->setCveTipoDocumento($cveTipoDocumento);
$documentosimgDto->setFechaDocumento($fechaDocumento);
$documentosimgDto->setFechaModificacion($fechaModificacion);
$documentosimgDto->setObservaciones($observaciones);
$documentosimgDto->setCveUsuario($cveUsuario);
$documentosimgDto->setActivo($activo);
$documentosimgDto->setFechaActualizacion($fechaActualizacion);
$documentosimgDto->setFechaRegistro($fechaRegistro);

if( ($accion=="guardar") && ($idDocumentoImg=="") ){
$documentosimgDto=$documentosimgFacade->insertDocumentosimg($documentosimgDto);
echo $documentosimgDto;
} else if(($accion=="guardar") && ($idDocumentoImg!="")){
$documentosimgDto=$documentosimgFacade->updateDocumentosimg($documentosimgDto);
echo $documentosimgDto;
} else if($accion=="consultar"){
$documentosimgDto=$documentosimgFacade->selectDocumentosimg($documentosimgDto);
echo $documentosimgDto;
} else if( ($accion=="baja") && ($idDocumentoImg!="") ){
$documentosimgDto=$documentosimgFacade->deleteDocumentosimg($documentosimgDto);
echo $documentosimgDto;
} else if( ($accion=="seleccionar") && ($idDocumentoImg!="") ){
$documentosimgDto=$documentosimgFacade->selectDocumentosimg($documentosimgDto);
echo $documentosimgDto;
}


?>