<?php
/*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 CONTROLLER
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/respuestasexhortos/RespuestasexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/respuestasexhortos/RespuestasexhortosDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class RespuestasexhortosController {
private $proveedor;
public function __construct() {
}
public function validarRespuestasexhortos($RespuestasexhortosDto){
$RespuestasexhortosDto->setidRespuestaExhorto(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getidRespuestaExhorto()))));
$RespuestasexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getidExhorto()))));
$RespuestasexhortosDto->setidActuacion(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getidActuacion()))));
$RespuestasexhortosDto->setcveEstadoDestino(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getcveEstadoDestino()))));
$RespuestasexhortosDto->setnumPromocion(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getnumPromocion()))));
$RespuestasexhortosDto->setaniPromocion(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getaniPromocion()))));
$RespuestasexhortosDto->setidActuacionPromocion(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getidActuacionPromocion()))));
$RespuestasexhortosDto->setcveEstatusExhortos(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getcveEstatusExhortos()))));
$RespuestasexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getactivo()))));
$RespuestasexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getfechaRegistro()))));
$RespuestasexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($RespuestasexhortosDto->getfechaActualizacion()))));
return $RespuestasexhortosDto;
}
public function selectRespuestasexhortos($RespuestasexhortosDto,$proveedor=null){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosDao = new RespuestasexhortosDAO();
$RespuestasexhortosDto = $RespuestasexhortosDao->selectRespuestasexhortos($RespuestasexhortosDto,$proveedor);
return $RespuestasexhortosDto;
}
public function insertRespuestasexhortos($RespuestasexhortosDto,$proveedor=null){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosDao = new RespuestasexhortosDAO();
$RespuestasexhortosDto = $RespuestasexhortosDao->insertRespuestasexhortos($RespuestasexhortosDto,$proveedor);
return $RespuestasexhortosDto;
}
public function updateRespuestasexhortos($RespuestasexhortosDto,$proveedor=null){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosDao = new RespuestasexhortosDAO();
//$tmpDto = new RespuestasexhortosDTO();
//$tmpDto = $RespuestasexhortosDao->selectRespuestasexhortos($RespuestasexhortosDto,$proveedor);
//if($tmpDto!=""){//$RespuestasexhortosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$RespuestasexhortosDto = $RespuestasexhortosDao->updateRespuestasexhortos($RespuestasexhortosDto,$proveedor);
return $RespuestasexhortosDto;
//}
//return "";
}
public function deleteRespuestasexhortos($RespuestasexhortosDto,$proveedor=null){
$RespuestasexhortosDto=$this->validarRespuestasexhortos($RespuestasexhortosDto);
$RespuestasexhortosDao = new RespuestasexhortosDAO();
$RespuestasexhortosDto = $RespuestasexhortosDao->deleteRespuestasexhortos($RespuestasexhortosDto,$proveedor);
return $RespuestasexhortosDto;
}
}
?>