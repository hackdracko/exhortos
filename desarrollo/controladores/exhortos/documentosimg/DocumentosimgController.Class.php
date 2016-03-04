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

 include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/documentosimg/DocumentosimgDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dao/documentosimg/DocumentosimgDAO.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
class DocumentosimgController {
private $proveedor;
public function __construct() {
}
public function validarDocumentosimg($DocumentosimgDto){
$DocumentosimgDto->setidDocumentoImg(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getidDocumentoImg()))));
$DocumentosimgDto->setidReferencia(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getidReferencia()))));
$DocumentosimgDto->setcveTipoDocumento(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getcveTipoDocumento()))));
$DocumentosimgDto->setfechaDocumento(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getfechaDocumento()))));
$DocumentosimgDto->setfechaModificacion(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getfechaModificacion()))));
$DocumentosimgDto->setobservaciones(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getobservaciones()))));
$DocumentosimgDto->setcveUsuario(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getcveUsuario()))));
$DocumentosimgDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getfechaActualizacion()))));
$DocumentosimgDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim($DocumentosimgDto->getfechaRegistro()))));
return $DocumentosimgDto;
}
public function selectDocumentosimg($DocumentosimgDto,$proveedor=null){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgDao = new DocumentosimgDAO();
$DocumentosimgDto = $DocumentosimgDao->selectDocumentosimg($DocumentosimgDto,$proveedor);
return $DocumentosimgDto;
}
public function insertDocumentosimg($DocumentosimgDto,$proveedor=null){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgDao = new DocumentosimgDAO();
$DocumentosimgDto = $DocumentosimgDao->insertDocumentosimg($DocumentosimgDto,$proveedor);
return $DocumentosimgDto;
}
public function updateDocumentosimg($DocumentosimgDto,$proveedor=null){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgDao = new DocumentosimgDAO();
//$tmpDto = new DocumentosimgDTO();
//$tmpDto = $DocumentosimgDao->selectDocumentosimg($DocumentosimgDto,$proveedor);
//if($tmpDto!=""){//$DocumentosimgDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$DocumentosimgDto = $DocumentosimgDao->updateDocumentosimg($DocumentosimgDto,$proveedor);
return $DocumentosimgDto;
//}
//return "";
}
public function deleteDocumentosimg($DocumentosimgDto,$proveedor=null){
$DocumentosimgDto=$this->validarDocumentosimg($DocumentosimgDto);
$DocumentosimgDao = new DocumentosimgDAO();
$DocumentosimgDto = $DocumentosimgDao->deleteDocumentosimg($DocumentosimgDto,$proveedor);
return $DocumentosimgDto;
}
}
?>