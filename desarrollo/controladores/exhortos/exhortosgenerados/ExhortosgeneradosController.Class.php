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

include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/exhortosgenerados/ExhortosgeneradosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/exhortosgenerados/ExhortosgeneradosDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class ExhortosgeneradosController {
private $proveedor;
public function __construct() {
}
public function validarExhortosgenerados($ExhortosgeneradosDto){
$ExhortosgeneradosDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getidExhortoGenerado()))));
$ExhortosgeneradosDto->setidActuacion(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getidActuacion()))));
$ExhortosgeneradosDto->setcveEstatusExhorto(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getcveEstatusExhorto()))));
$ExhortosgeneradosDto->setcveEstadoDestino(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getcveEstadoDestino()))));
$ExhortosgeneradosDto->setrequisitoria(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getrequisitoria()))));
$ExhortosgeneradosDto->setactivo(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getactivo()))));
$ExhortosgeneradosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getfechaRegistro()))));
$ExhortosgeneradosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($ExhortosgeneradosDto->getfechaActualizacion()))));
return $ExhortosgeneradosDto;
}
public function selectExhortosgenerados($ExhortosgeneradosDto,$proveedor=null){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosDao = new ExhortosgeneradosDAO();
$ExhortosgeneradosDto = $ExhortosgeneradosDao->selectExhortosgenerados($ExhortosgeneradosDto,$proveedor);
return $ExhortosgeneradosDto;
}
public function insertExhortosgenerados($ExhortosgeneradosDto,$proveedor=null){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosDao = new ExhortosgeneradosDAO();
$ExhortosgeneradosDto = $ExhortosgeneradosDao->insertExhortosgenerados($ExhortosgeneradosDto,$proveedor);
return $ExhortosgeneradosDto;
}
public function updateExhortosgenerados($ExhortosgeneradosDto,$proveedor=null){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosDao = new ExhortosgeneradosDAO();
//$tmpDto = new ExhortosgeneradosDTO();
//$tmpDto = $ExhortosgeneradosDao->selectExhortosgenerados($ExhortosgeneradosDto,$proveedor);
//if($tmpDto!=""){//$ExhortosgeneradosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$ExhortosgeneradosDto = $ExhortosgeneradosDao->updateExhortosgenerados($ExhortosgeneradosDto,$proveedor);
return $ExhortosgeneradosDto;
//}
//return "";
}
public function deleteExhortosgenerados($ExhortosgeneradosDto,$proveedor=null){
$ExhortosgeneradosDto=$this->validarExhortosgenerados($ExhortosgeneradosDto);
$ExhortosgeneradosDao = new ExhortosgeneradosDAO();
$ExhortosgeneradosDto = $ExhortosgeneradosDao->deleteExhortosgenerados($ExhortosgeneradosDto,$proveedor);
return $ExhortosgeneradosDto;
}
}
?>