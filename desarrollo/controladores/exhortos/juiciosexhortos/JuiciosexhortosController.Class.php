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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/juiciosexhortos/JuiciosexhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/juiciosexhortos/JuiciosexhortosDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class JuiciosexhortosController {
private $proveedor;
public function __construct() {
}
public function validarJuiciosexhortos($JuiciosexhortosDto){
$JuiciosexhortosDto->setidJuicioexhorto(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getidJuicioexhorto()))));
$JuiciosexhortosDto->setidExhorto(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getidExhorto()))));
$JuiciosexhortosDto->setidExhortoGenerado(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getidExhortoGenerado()))));
$JuiciosexhortosDto->setcveJuicio(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getcveJuicio()))));
$JuiciosexhortosDto->setotroJuicio(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getotroJuicio()))));
$JuiciosexhortosDto->setactivo(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getactivo()))));
$JuiciosexhortosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getfechaRegistro()))));
$JuiciosexhortosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($JuiciosexhortosDto->getfechaActualizacion()))));
return $JuiciosexhortosDto;
}
public function selectJuiciosexhortos($JuiciosexhortosDto,$proveedor=null){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosDao = new JuiciosexhortosDAO();
$JuiciosexhortosDto = $JuiciosexhortosDao->selectJuiciosexhortos($JuiciosexhortosDto,$proveedor);
return $JuiciosexhortosDto;
}
public function insertJuiciosexhortos($JuiciosexhortosDto,$proveedor=null){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosDao = new JuiciosexhortosDAO();
$JuiciosexhortosDto = $JuiciosexhortosDao->insertJuiciosexhortos($JuiciosexhortosDto,$proveedor);
return $JuiciosexhortosDto;
}
public function updateJuiciosexhortos($JuiciosexhortosDto,$proveedor=null){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosDao = new JuiciosexhortosDAO();
//$tmpDto = new JuiciosexhortosDTO();
//$tmpDto = $JuiciosexhortosDao->selectJuiciosexhortos($JuiciosexhortosDto,$proveedor);
//if($tmpDto!=""){//$JuiciosexhortosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$JuiciosexhortosDto = $JuiciosexhortosDao->updateJuiciosexhortos($JuiciosexhortosDto,$proveedor);
return $JuiciosexhortosDto;
//}
//return "";
}
public function deleteJuiciosexhortos($JuiciosexhortosDto,$proveedor=null){
$JuiciosexhortosDto=$this->validarJuiciosexhortos($JuiciosexhortosDto);
$JuiciosexhortosDao = new JuiciosexhortosDAO();
$JuiciosexhortosDto = $JuiciosexhortosDao->deleteJuiciosexhortos($JuiciosexhortosDto,$proveedor);
return $JuiciosexhortosDto;
}
}
?>