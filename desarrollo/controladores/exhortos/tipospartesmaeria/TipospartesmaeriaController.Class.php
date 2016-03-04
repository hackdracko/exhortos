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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/tipospartesmaeria/TipospartesmaeriaDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/tipospartesmaeria/TipospartesmaeriaDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class TipospartesmaeriaController {
private $proveedor;
public function __construct() {
}
public function validarTipospartesmaeria($TipospartesmaeriaDto){
$TipospartesmaeriaDto->setidTipoParteMateria(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getidTipoParteMateria()))));
$TipospartesmaeriaDto->setcveTipoParte(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getcveTipoParte()))));
$TipospartesmaeriaDto->setcveMateria(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getcveMateria()))));
$TipospartesmaeriaDto->setactivo(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getactivo()))));
$TipospartesmaeriaDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getfechaRegistro()))));
$TipospartesmaeriaDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($TipospartesmaeriaDto->getfechaActualizacion()))));
return $TipospartesmaeriaDto;
}
public function selectTipospartesmaeria($TipospartesmaeriaDto,$proveedor=null){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaDao = new TipospartesmaeriaDAO();
$TipospartesmaeriaDto = $TipospartesmaeriaDao->selectTipospartesmaeria($TipospartesmaeriaDto,$proveedor);
return $TipospartesmaeriaDto;
}
public function insertTipospartesmaeria($TipospartesmaeriaDto,$proveedor=null){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaDao = new TipospartesmaeriaDAO();
$TipospartesmaeriaDto = $TipospartesmaeriaDao->insertTipospartesmaeria($TipospartesmaeriaDto,$proveedor);
return $TipospartesmaeriaDto;
}
public function updateTipospartesmaeria($TipospartesmaeriaDto,$proveedor=null){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaDao = new TipospartesmaeriaDAO();
//$tmpDto = new TipospartesmaeriaDTO();
//$tmpDto = $TipospartesmaeriaDao->selectTipospartesmaeria($TipospartesmaeriaDto,$proveedor);
//if($tmpDto!=""){//$TipospartesmaeriaDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$TipospartesmaeriaDto = $TipospartesmaeriaDao->updateTipospartesmaeria($TipospartesmaeriaDto,$proveedor);
return $TipospartesmaeriaDto;
//}
//return "";
}
public function deleteTipospartesmaeria($TipospartesmaeriaDto,$proveedor=null){
$TipospartesmaeriaDto=$this->validarTipospartesmaeria($TipospartesmaeriaDto);
$TipospartesmaeriaDao = new TipospartesmaeriaDAO();
$TipospartesmaeriaDto = $TipospartesmaeriaDao->deleteTipospartesmaeria($TipospartesmaeriaDto,$proveedor);
return $TipospartesmaeriaDto;
}
}
?>