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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/partes/PartesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/partes/PartesDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class PartesController {
private $proveedor;
public function __construct() {
}
public function validarPartes($PartesDto){
$PartesDto->setidParte(strtoupper(str_ireplace("'","",trim($PartesDto->getidParte()))));
$PartesDto->setidExhorto(strtoupper(str_ireplace("'","",trim($PartesDto->getidExhorto()))));
$PartesDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim($PartesDto->getidExhortoGenerado()))));
$PartesDto->setnombre(strtoupper(str_ireplace("'","",trim($PartesDto->getnombre()))));
$PartesDto->setpaterno(strtoupper(str_ireplace("'","",trim($PartesDto->getpaterno()))));
$PartesDto->setmaterno(strtoupper(str_ireplace("'","",trim($PartesDto->getmaterno()))));
$PartesDto->setnombrePersonaMoral(strtoupper(str_ireplace("'","",trim($PartesDto->getnombrePersonaMoral()))));
$PartesDto->setcveTipoPersona(strtoupper(str_ireplace("'","",trim($PartesDto->getcveTipoPersona()))));
$PartesDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim($PartesDto->getcveTipoParte()))));
$PartesDto->setedad(strtoupper(str_ireplace("'","",trim($PartesDto->getedad()))));
$PartesDto->setfechaNacimiento(strtoupper(str_ireplace("'","",trim($PartesDto->getfechaNacimiento()))));
$PartesDto->setRFC(strtoupper(str_ireplace("'","",trim($PartesDto->getRFC()))));
$PartesDto->setCURP(strtoupper(str_ireplace("'","",trim($PartesDto->getCURP()))));
$PartesDto->setcveEstado(strtoupper(str_ireplace("'","",trim($PartesDto->getcveEstado()))));
$PartesDto->setcveMunicipio(strtoupper(str_ireplace("'","",trim($PartesDto->getcveMunicipio()))));
$PartesDto->setdomicilio(strtoupper(str_ireplace("'","",trim($PartesDto->getdomicilio()))));
$PartesDto->settelefono(strtoupper(str_ireplace("'","",trim($PartesDto->gettelefono()))));
$PartesDto->setemail(strtoupper(str_ireplace("'","",trim($PartesDto->getemail()))));
$PartesDto->setcveGenero(strtoupper(str_ireplace("'","",trim($PartesDto->getcveGenero()))));
$PartesDto->setdetenido(strtoupper(str_ireplace("'","",trim($PartesDto->getdetenido()))));
$PartesDto->setactivo(strtoupper(str_ireplace("'","",trim($PartesDto->getactivo()))));
$PartesDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($PartesDto->getfechaRegistro()))));
$PartesDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($PartesDto->getfechaActualizacion()))));
return $PartesDto;
}
public function selectPartes($PartesDto,$proveedor=null){
$PartesDto=$this->validarPartes($PartesDto);
$PartesDao = new PartesDAO();
$PartesDto = $PartesDao->selectPartes($PartesDto,$proveedor);
return $PartesDto;
}
public function insertPartes($PartesDto,$proveedor=null){
$PartesDto=$this->validarPartes($PartesDto);
$PartesDao = new PartesDAO();
$PartesDto = $PartesDao->insertPartes($PartesDto,$proveedor);
return $PartesDto;
}
public function updatePartes($PartesDto,$proveedor=null){
$PartesDto=$this->validarPartes($PartesDto);
$PartesDao = new PartesDAO();
//$tmpDto = new PartesDTO();
//$tmpDto = $PartesDao->selectPartes($PartesDto,$proveedor);
//if($tmpDto!=""){//$PartesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$PartesDto = $PartesDao->updatePartes($PartesDto,$proveedor);
return $PartesDto;
//}
//return "";
}
public function deletePartes($PartesDto,$proveedor=null){
$PartesDto=$this->validarPartes($PartesDto);
$PartesDao = new PartesDAO();
$PartesDto = $PartesDao->deletePartes($PartesDto,$proveedor);
return $PartesDto;
}
}
?>