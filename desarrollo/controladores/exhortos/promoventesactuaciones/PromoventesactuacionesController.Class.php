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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/promoventesactuaciones/PromoventesactuacionesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/promoventesactuaciones/PromoventesactuacionesDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class PromoventesactuacionesController {
private $proveedor;
public function __construct() {
}
public function validarPromoventesactuaciones($PromoventesactuacionesDto){
$PromoventesactuacionesDto->setidPromoventeActuacion(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getidPromoventeActuacion()))));
$PromoventesactuacionesDto->setidActuacion(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getidActuacion()))));
$PromoventesactuacionesDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getcveTipoParte()))));
$PromoventesactuacionesDto->setcveTipoPersona(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getcveTipoPersona()))));
$PromoventesactuacionesDto->setnombre(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getnombre()))));
$PromoventesactuacionesDto->setpaterno(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getpaterno()))));
$PromoventesactuacionesDto->setmaterno(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getmaterno()))));
$PromoventesactuacionesDto->setactivo(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getactivo()))));
$PromoventesactuacionesDto->setnombrePersonaMoral(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getnombrePersonaMoral()))));
$PromoventesactuacionesDto->setcedula(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getcedula()))));
$PromoventesactuacionesDto->setcveGenero(strtoupper(str_ireplace("'","",trim($PromoventesactuacionesDto->getcveGenero()))));
return $PromoventesactuacionesDto;
}
public function selectPromoventesactuaciones($PromoventesactuacionesDto,$proveedor=null){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesDao = new PromoventesactuacionesDAO();
$PromoventesactuacionesDto = $PromoventesactuacionesDao->selectPromoventesactuaciones($PromoventesactuacionesDto,$proveedor);
return $PromoventesactuacionesDto;
}
public function insertPromoventesactuaciones($PromoventesactuacionesDto,$proveedor=null){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesDao = new PromoventesactuacionesDAO();
$PromoventesactuacionesDto = $PromoventesactuacionesDao->insertPromoventesactuaciones($PromoventesactuacionesDto,$proveedor);
return $PromoventesactuacionesDto;
}
public function updatePromoventesactuaciones($PromoventesactuacionesDto,$proveedor=null){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesDao = new PromoventesactuacionesDAO();
//$tmpDto = new PromoventesactuacionesDTO();
//$tmpDto = $PromoventesactuacionesDao->selectPromoventesactuaciones($PromoventesactuacionesDto,$proveedor);
//if($tmpDto!=""){//$PromoventesactuacionesDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$PromoventesactuacionesDto = $PromoventesactuacionesDao->updatePromoventesactuaciones($PromoventesactuacionesDto,$proveedor);
return $PromoventesactuacionesDto;
//}
//return "";
}
public function deletePromoventesactuaciones($PromoventesactuacionesDto,$proveedor=null){
$PromoventesactuacionesDto=$this->validarPromoventesactuaciones($PromoventesactuacionesDto);
$PromoventesactuacionesDao = new PromoventesactuacionesDAO();
$PromoventesactuacionesDto = $PromoventesactuacionesDao->deletePromoventesactuaciones($PromoventesactuacionesDto,$proveedor);
return $PromoventesactuacionesDto;
}
}
?>