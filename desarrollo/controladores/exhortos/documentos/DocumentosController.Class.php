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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/documentos/DocumentosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/documentos/DocumentosDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class DocumentosController {
private $proveedor;
public function __construct() {
}
public function validarDocumentos($DocumentosDto){
$DocumentosDto->setcveDocumento(strtoupper(str_ireplace("'","",trim($DocumentosDto->getcveDocumento()))));
$DocumentosDto->setdescDocumento(strtoupper(str_ireplace("'","",trim($DocumentosDto->getdescDocumento()))));
$DocumentosDto->setactivo(strtoupper(str_ireplace("'","",trim($DocumentosDto->getactivo()))));
$DocumentosDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($DocumentosDto->getfechaActualizacion()))));
$DocumentosDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($DocumentosDto->getfechaRegistro()))));
$DocumentosDto->setcveTipoNumero(strtoupper(str_ireplace("'","",trim($DocumentosDto->getcveTipoNumero()))));
return $DocumentosDto;
}
public function selectDocumentos($DocumentosDto,$proveedor=null){
$DocumentosDto=$this->validarDocumentos($DocumentosDto);
$DocumentosDao = new DocumentosDAO();
$DocumentosDto = $DocumentosDao->selectDocumentos($DocumentosDto,$proveedor);
return $DocumentosDto;
}
public function insertDocumentos($DocumentosDto,$proveedor=null){
$DocumentosDto=$this->validarDocumentos($DocumentosDto);
$DocumentosDao = new DocumentosDAO();
$DocumentosDto = $DocumentosDao->insertDocumentos($DocumentosDto,$proveedor);
return $DocumentosDto;
}
public function updateDocumentos($DocumentosDto,$proveedor=null){
$DocumentosDto=$this->validarDocumentos($DocumentosDto);
$DocumentosDao = new DocumentosDAO();
//$tmpDto = new DocumentosDTO();
//$tmpDto = $DocumentosDao->selectDocumentos($DocumentosDto,$proveedor);
//if($tmpDto!=""){//$DocumentosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$DocumentosDto = $DocumentosDao->updateDocumentos($DocumentosDto,$proveedor);
return $DocumentosDto;
//}
//return "";
}
public function deleteDocumentos($DocumentosDto,$proveedor=null){
$DocumentosDto=$this->validarDocumentos($DocumentosDto);
$DocumentosDao = new DocumentosDAO();
$DocumentosDto = $DocumentosDao->deleteDocumentos($DocumentosDto,$proveedor);
return $DocumentosDto;
}
}
?>