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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/antecedesexhortos/AntecedesexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/antecedesexhortos/AntecedesexhortosDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class AntecedesexhortosController {
private $proveedor;
public function __construct() {
}
public function validarAntecedesexhortos($AntecedesexhortosDto){
$AntecedesexhortosDto->setidAntecedeExhorto(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getidAntecedeExhorto()))));
$AntecedesexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getidExhorto()))));
$AntecedesexhortosDto->setidActuacion(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getidActuacion()))));
$AntecedesexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getactivo()))));
$AntecedesexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getfechaRegistro()))));
$AntecedesexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($AntecedesexhortosDto->getfechaActualizacion()))));
return $AntecedesexhortosDto;
}
public function selectAntecedesexhortos($AntecedesexhortosDto,$proveedor=null){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosDao = new AntecedesexhortosDAO();
$AntecedesexhortosDto = $AntecedesexhortosDao->selectAntecedesexhortos($AntecedesexhortosDto,$proveedor);
return $AntecedesexhortosDto;
}
public function insertAntecedesexhortos($AntecedesexhortosDto,$proveedor=null){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosDao = new AntecedesexhortosDAO();
$AntecedesexhortosDto = $AntecedesexhortosDao->insertAntecedesexhortos($AntecedesexhortosDto,$proveedor);
return $AntecedesexhortosDto;
}
public function updateAntecedesexhortos($AntecedesexhortosDto,$proveedor=null){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosDao = new AntecedesexhortosDAO();
//$tmpDto = new AntecedesexhortosDTO();
//$tmpDto = $AntecedesexhortosDao->selectAntecedesexhortos($AntecedesexhortosDto,$proveedor);
//if($tmpDto!=""){//$AntecedesexhortosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$AntecedesexhortosDto = $AntecedesexhortosDao->updateAntecedesexhortos($AntecedesexhortosDto,$proveedor);
return $AntecedesexhortosDto;
//}
//return "";
}
public function deleteAntecedesexhortos($AntecedesexhortosDto,$proveedor=null){
$AntecedesexhortosDto=$this->validarAntecedesexhortos($AntecedesexhortosDto);
$AntecedesexhortosDao = new AntecedesexhortosDAO();
$AntecedesexhortosDto = $AntecedesexhortosDao->deleteAntecedesexhortos($AntecedesexhortosDto,$proveedor);
return $AntecedesexhortosDto;
}
}
?>