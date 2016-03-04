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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/configuracionescargas/ConfiguracionescargasDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/configuracionescargas/ConfiguracionescargasDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class ConfiguracionescargasController {
private $proveedor;
public function __construct() {
}
public function validarConfiguracionescargas($ConfiguracionescargasDto){
$ConfiguracionescargasDto->setcveConfiguracionCarga(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getcveConfiguracionCarga()))));
$ConfiguracionescargasDto->setcveOficialia(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getcveOficialia()))));
$ConfiguracionescargasDto->settopeCarga(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->gettopeCarga()))));
$ConfiguracionescargasDto->settipoOficialia(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->gettipoOficialia()))));
$ConfiguracionescargasDto->setactivo(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getactivo()))));
$ConfiguracionescargasDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getfechaActualizacion()))));
$ConfiguracionescargasDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getfechaRegistro()))));
$ConfiguracionescargasDto->setinicia(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->getinicia()))));
$ConfiguracionescargasDto->settermina(strtoupper(str_ireplace("'","",trim($ConfiguracionescargasDto->gettermina()))));
return $ConfiguracionescargasDto;
}
public function selectConfiguracionescargas($ConfiguracionescargasDto,$proveedor=null){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasDao = new ConfiguracionescargasDAO();
$ConfiguracionescargasDto = $ConfiguracionescargasDao->selectConfiguracionescargas($ConfiguracionescargasDto,$proveedor);
return $ConfiguracionescargasDto;
}
public function insertConfiguracionescargas($ConfiguracionescargasDto,$proveedor=null){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasDao = new ConfiguracionescargasDAO();
$ConfiguracionescargasDto = $ConfiguracionescargasDao->insertConfiguracionescargas($ConfiguracionescargasDto,$proveedor);
return $ConfiguracionescargasDto;
}
public function updateConfiguracionescargas($ConfiguracionescargasDto,$proveedor=null){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasDao = new ConfiguracionescargasDAO();
//$tmpDto = new ConfiguracionescargasDTO();
//$tmpDto = $ConfiguracionescargasDao->selectConfiguracionescargas($ConfiguracionescargasDto,$proveedor);
//if($tmpDto!=""){//$ConfiguracionescargasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$ConfiguracionescargasDto = $ConfiguracionescargasDao->updateConfiguracionescargas($ConfiguracionescargasDto,$proveedor);
return $ConfiguracionescargasDto;
//}
//return "";
}
public function deleteConfiguracionescargas($ConfiguracionescargasDto,$proveedor=null){
$ConfiguracionescargasDto=$this->validarConfiguracionescargas($ConfiguracionescargasDto);
$ConfiguracionescargasDao = new ConfiguracionescargasDAO();
$ConfiguracionescargasDto = $ConfiguracionescargasDao->deleteConfiguracionescargas($ConfiguracionescargasDto,$proveedor);
return $ConfiguracionescargasDto;
}
}
?>