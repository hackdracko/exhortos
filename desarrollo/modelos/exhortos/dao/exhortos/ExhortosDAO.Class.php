<?php
 /*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 DAOS
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

include_once(dirname(__FILE__)."/../../../../modelos/exhortos/dto/exhortos/ExhortosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../tribunal/connect/Proveedor.Class.php");
class ExhortosDAO{
	protected $_proveedor;
	public function __construct($gestor = "mysql", $bd = "gestion") {
		$this->_proveedor = new Proveedor('mysql', 'exhortos');
	}
	public function _conexion(){
		$this->_proveedor->connect();
	}
	public function insertExhortos($exhortosDto,$proveedor=null){
		$tmp = "";
		$contador = 0;
		if ($proveedor == null) {
			$this->_conexion(null);
//$this->_proveedor->connect();
		} else if ($proveedor != null) {
			$this->_proveedor = $proveedor;
		}
		$sql="INSERT INTO tblexhortos(";
			if($exhortosDto->getIdExhorto()!=""){
				$sql.="idExhorto";
				if(($exhortosDto->getIdExhortoGenerado()!="") ||($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getIdExhortoGenerado()!=""){
				$sql.="IdExhortoGenerado";
				if(($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumExhorto()!=""){
				$sql.="numExhorto";
				if(($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getAniExhorto()!=""){
				$sql.="aniExhorto";
				if(($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveJuzgado()!=""){
				$sql.="cveJuzgado";
				if(($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumeroExp()!=""){
				$sql.="numeroExp";
				if(($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getAnioExp()!=""){
				$sql.="anioExp";
				if(($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveJuzgadoProcedencia()!=""){
				$sql.="cveJuzgadoProcedencia";
				if(($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getJuzgadoProcedencia()!=""){
				$sql.="juzgadoProcedencia";
				if(($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstadoProcedencia()!=""){
				$sql.="cveEstadoProcedencia";
				if(($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCarpetaInv()!=""){
				$sql.="carpetaInv";
				if(($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNuc()!=""){
				$sql.="nuc";
				if(($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveMateria()!=""){
				$sql.="cveMateria";
				if(($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveCuantia()!=""){
				$sql.="cveCuantia";
				if(($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNoFojas()!=""){
				$sql.="noFojas";
				if(($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumOficio()!=""){
				$sql.="numOficio";
				if(($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getSintesis()!=""){
				$sql.="sintesis";
				if(($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getObservaciones()!=""){
				$sql.="observaciones";
				if(($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveConsignacion()!=""){
				$sql.="cveConsignacion";
				if(($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstatusExhorto()!=""){
				$sql.="cveEstatusExhorto";
				if(($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getActivo()!=""){
				$sql.="activo";
				if(($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstadoDestino()!=""){
				$sql.="cveEstadoDestino";
			}
			$sql.=",fechaRegistro";
			$sql.=",fechaActualizacion";
			$sql.=") VALUES(";
			if($exhortosDto->getIdExhorto()!=""){
				$sql.="'".$exhortosDto->getIdExhorto()."'";
				if(($exhortosDto->getIdExhortoGenerado()!="") ||($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getIdExhortoGenerado()!=""){
				$sql.="'".$exhortosDto->getIdExhortoGenerado()."'";
				if(($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumExhorto()!=""){
				$sql.="'".$exhortosDto->getNumExhorto()."'";
				if(($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getAniExhorto()!=""){
				$sql.="'".$exhortosDto->getAniExhorto()."'";
				if(($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveJuzgado()!=""){
				$sql.="'".$exhortosDto->getCveJuzgado()."'";
				if(($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumeroExp()!=""){
				$sql.="'".$exhortosDto->getNumeroExp()."'";
				if(($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getAnioExp()!=""){
				$sql.="'".$exhortosDto->getAnioExp()."'";
				if(($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveJuzgadoProcedencia()!=""){
				$sql.="'".$exhortosDto->getCveJuzgadoProcedencia()."'";
				if(($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getJuzgadoProcedencia()!=""){
				$sql.="'".$exhortosDto->getJuzgadoProcedencia()."'";
				if(($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstadoProcedencia()!=""){
				$sql.="'".$exhortosDto->getCveEstadoProcedencia()."'";
				if(($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCarpetaInv()!=""){
				$sql.="'".$exhortosDto->getCarpetaInv()."'";
				if(($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNuc()!=""){
				$sql.="'".$exhortosDto->getNuc()."'";
				if(($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveMateria()!=""){
				$sql.="'".$exhortosDto->getCveMateria()."'";
				if(($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveCuantia()!=""){
				$sql.="'".$exhortosDto->getCveCuantia()."'";
				if(($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNoFojas()!=""){
				$sql.="'".$exhortosDto->getNoFojas()."'";
				if(($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getNumOficio()!=""){
				$sql.="'".$exhortosDto->getNumOficio()."'";
				if(($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getSintesis()!=""){
				$sql.="'".$exhortosDto->getSintesis()."'";
				if(($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getObservaciones()!=""){
				$sql.="'".$exhortosDto->getObservaciones()."'";
				if(($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveConsignacion()!=""){
				$sql.="'".$exhortosDto->getCveConsignacion()."'";
				if(($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstatusExhorto()!=""){
				$sql.="'".$exhortosDto->getCveEstatusExhorto()."'";
				if(($exhortosDto->getActivo()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getActivo()!=""){
				$sql.="'".$exhortosDto->getActivo()."'";
				if(($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getFechaRegistro()!=""){
				if(($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getFechaActualizacion()!=""){
				if(($exhortosDto->getCveEstadoDestino()!="") ){
					$sql.=",";
				}
			}
			if($exhortosDto->getCveEstadoDestino()!=""){
				$sql.="'".$exhortosDto->getCveEstadoDestino()."'";
			}
			$sql.=",now()";
			$sql.=",now()";
			$sql.=")";
$this->_proveedor->execute($sql);
if (!$this->_proveedor->error()) {
	$tmp = new ExhortosDTO();
	$tmp->setidExhorto($this->_proveedor->lastID());
	$tmp = $this->selectExhortos($tmp,"",$this->_proveedor);
} else {
	$error = true;
}
if ($proveedor == null) {
	$this->_proveedor->close();
}
unset($contador);
unset($sql);
return $tmp;
}
public function updateExhortos($exhortosDto,$proveedor=null){
	$tmp = "";
	$contador = 0;
	if ($proveedor == null) {
		$this->_conexion(null);
//$this->_proveedor->connect();
	} else if ($proveedor != null) {
		$this->_proveedor = $proveedor;
	}
	$sql="UPDATE tblexhortos SET ";
	if($exhortosDto->getIdExhorto()!=""){
		$sql.="idExhorto='".$exhortosDto->getIdExhorto()."'";
		if(($exhortosDto->getIdExhortoGenerado()!="") ||($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getIdExhortoGenerado()!=""){
		$sql.="IdExhortoGenerado='".$exhortosDto->getIdExhortoGenerado()."'";
		if(($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getNumExhorto()!=""){
		$sql.="numExhorto='".$exhortosDto->getNumExhorto()."'";
		if(($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getAniExhorto()!=""){
		$sql.="aniExhorto='".$exhortosDto->getAniExhorto()."'";
		if(($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveJuzgado()!=""){
		$sql.="cveJuzgado='".$exhortosDto->getCveJuzgado()."'";
		if(($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getNumeroExp()!=""){
		$sql.="numeroExp='".$exhortosDto->getNumeroExp()."'";
		if(($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getAnioExp()!=""){
		$sql.="anioExp='".$exhortosDto->getAnioExp()."'";
		if(($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveJuzgadoProcedencia()!=""){
		$sql.="cveJuzgadoProcedencia='".$exhortosDto->getCveJuzgadoProcedencia()."'";
		if(($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getJuzgadoProcedencia()!=""){
		$sql.="juzgadoProcedencia='".$exhortosDto->getJuzgadoProcedencia()."'";
		if(($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveEstadoProcedencia()!=""){
		$sql.="cveEstadoProcedencia='".$exhortosDto->getCveEstadoProcedencia()."'";
		if(($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCarpetaInv()!=""){
		$sql.="carpetaInv='".$exhortosDto->getCarpetaInv()."'";
		if(($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getNuc()!=""){
		$sql.="nuc='".$exhortosDto->getNuc()."'";
		if(($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveMateria()!=""){
		$sql.="cveMateria='".$exhortosDto->getCveMateria()."'";
		if(($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveCuantia()!=""){
		$sql.="cveCuantia='".$exhortosDto->getCveCuantia()."'";
		if(($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getNoFojas()!=""){
		$sql.="noFojas='".$exhortosDto->getNoFojas()."'";
		if(($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getNumOficio()!=""){
		$sql.="numOficio='".$exhortosDto->getNumOficio()."'";
		if(($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getSintesis()!=""){
		$sql.="sintesis='".$exhortosDto->getSintesis()."'";
		if(($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getObservaciones()!=""){
		$sql.="observaciones='".$exhortosDto->getObservaciones()."'";
		if(($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveConsignacion()!=""){
		$sql.="cveConsignacion='".$exhortosDto->getCveConsignacion()."'";
		if(($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveEstatusExhorto()!=""){
		$sql.="cveEstatusExhorto='".$exhortosDto->getCveEstatusExhorto()."'";
		if(($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getActivo()!=""){
		$sql.="activo='".$exhortosDto->getActivo()."'";
		if(($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getFechaRegistro()!=""){
		$sql.="fechaRegistro='".$exhortosDto->getFechaRegistro()."'";
		if(($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getFechaActualizacion()!=""){
		$sql.="fechaActualizacion='".$exhortosDto->getFechaActualizacion()."'";
		if(($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=",";
		}
	}
	if($exhortosDto->getCveEstadoDestino()!=""){
		$sql.="cveEstadoDestino='".$exhortosDto->getCveEstadoDestino()."'";
	}
	$sql.=" WHERE idExhorto='".$exhortosDto->getIdExhorto()."'";
	$this->_proveedor->execute($sql);
	if (!$this->_proveedor->error()) {
		$tmp = new ExhortosDTO();
		$tmp->setidExhorto($exhortosDto->getIdExhorto());
		$tmp = $this->selectExhortos($tmp,"",$this->_proveedor);
	} else {
		$error = true;
	}
	if ($proveedor == null) {
		$this->_proveedor->close();
	}
	unset($contador);
	unset($sql);
	return $tmp;
}
public function deleteExhortos($exhortosDto,$proveedor=null){
	$tmp = "";
	$contador = 0;
	if ($proveedor == null) {
		$this->_conexion(null);
//$this->_proveedor->connect();
	} else if ($proveedor != null) {
		$this->_proveedor = $proveedor;
	}
	$sql="DELETE FROM tblexhortos  WHERE idExhorto='".$exhortosDto->getIdExhorto()."'";
	$this->_proveedor->execute($sql);
	if (!$this->_proveedor->error()) {
		$tmp = true;
	} else {
		$tmp = false;
	}
	if ($proveedor == null) {
		$this->_proveedor->close();
	}
	unset($contador);
	unset($sql);
	return $tmp;
}
public function selectExhortos($exhortosDto,$orden="",$proveedor=null){
	$tmp = "";
	$contador = 0;
	if ($proveedor == null) {
		$this->_conexion(null);
//$this->_proveedor->connect();
	} else if ($proveedor != null) {
		$this->_proveedor = $proveedor;
	}
	$sql="SELECT idExhorto,IdExhortoGenerado,numExhorto,aniExhorto,cveJuzgado,numeroExp,anioExp,cveJuzgadoProcedencia,juzgadoProcedencia,cveEstadoProcedencia,carpetaInv,nuc,cveMateria,cveCuantia,noFojas,numOficio,sintesis,observaciones,cveConsignacion,cveEstatusExhorto,activo,fechaRegistro,fechaActualizacion,cveEstadoDestino FROM tblexhortos ";
	if(($exhortosDto->getIdExhorto()!="") ||($exhortosDto->getIdExhortoGenerado()!="") ||($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
		$sql.=" WHERE ";
	}
	if($exhortosDto->getIdExhorto()!=""){
		$sql.="idExhorto='".$exhortosDto->getIdExhorto()."'";
		if(($exhortosDto->getIdExhortoGenerado()!="") ||($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getIdExhortoGenerado()!=""){
		$sql.="IdExhortoGenerado='".$exhortosDto->getIdExhortoGenerado()."'";
		if(($exhortosDto->getNumExhorto()!="") ||($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getNumExhorto()!=""){
		$sql.="numExhorto='".$exhortosDto->getNumExhorto()."'";
		if(($exhortosDto->getAniExhorto()!="") ||($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getAniExhorto()!=""){
		$sql.="aniExhorto='".$exhortosDto->getAniExhorto()."'";
		if(($exhortosDto->getCveJuzgado()!="") ||($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveJuzgado()!=""){
		$sql.="cveJuzgado in (".$exhortosDto->getCveJuzgado().") ";
		if(($exhortosDto->getNumeroExp()!="") ||($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getNumeroExp()!=""){
		$sql.="numeroExp='".$exhortosDto->getNumeroExp()."'";
		if(($exhortosDto->getAnioExp()!="") ||($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getAnioExp()!=""){
		$sql.="anioExp='".$exhortosDto->getAnioExp()."'";
		if(($exhortosDto->getCveJuzgadoProcedencia()!="") ||($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveJuzgadoProcedencia()!=""){
		$sql.="cveJuzgadoProcedencia='".$exhortosDto->getCveJuzgadoProcedencia()."'";
		if(($exhortosDto->getJuzgadoProcedencia()!="") ||($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getJuzgadoProcedencia()!=""){
		$sql.="juzgadoProcedencia='".$exhortosDto->getJuzgadoProcedencia()."'";
		if(($exhortosDto->getCveEstadoProcedencia()!="") ||($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveEstadoProcedencia()!=""){
		$sql.="cveEstadoProcedencia='".$exhortosDto->getCveEstadoProcedencia()."'";
		if(($exhortosDto->getCarpetaInv()!="") ||($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCarpetaInv()!=""){
		$sql.="carpetaInv='".$exhortosDto->getCarpetaInv()."'";
		if(($exhortosDto->getNuc()!="") ||($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getNuc()!=""){
		$sql.="nuc='".$exhortosDto->getNuc()."'";
		if(($exhortosDto->getCveMateria()!="") ||($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveMateria()!=""){
		$sql.="cveMateria='".$exhortosDto->getCveMateria()."'";
		if(($exhortosDto->getCveCuantia()!="") ||($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveCuantia()!=""){
		$sql.="cveCuantia='".$exhortosDto->getCveCuantia()."'";
		if(($exhortosDto->getNoFojas()!="") ||($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getNoFojas()!=""){
		$sql.="noFojas='".$exhortosDto->getNoFojas()."'";
		if(($exhortosDto->getNumOficio()!="") ||($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getNumOficio()!=""){
		$sql.="numOficio='".$exhortosDto->getNumOficio()."'";
		if(($exhortosDto->getSintesis()!="") ||($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getSintesis()!=""){
		$sql.="sintesis='".$exhortosDto->getSintesis()."'";
		if(($exhortosDto->getObservaciones()!="") ||($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getObservaciones()!=""){
		$sql.="observaciones='".$exhortosDto->getObservaciones()."'";
		if(($exhortosDto->getCveConsignacion()!="") ||($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveConsignacion()!=""){
		$sql.="cveConsignacion='".$exhortosDto->getCveConsignacion()."'";
		if(($exhortosDto->getCveEstatusExhorto()!="") ||($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveEstatusExhorto()!=""){
		$sql.="cveEstatusExhorto='".$exhortosDto->getCveEstatusExhorto()."'";
		if(($exhortosDto->getActivo()!="") ||($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getActivo()!=""){
		$sql.="activo='".$exhortosDto->getActivo()."'";
		if(($exhortosDto->getFechaRegistro()!="") ||($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getFechaRegistro()!=""){
		$sql.="fechaRegistro='".$exhortosDto->getFechaRegistro()."'";
		if(($exhortosDto->getFechaActualizacion()!="") ||($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getFechaActualizacion()!=""){
		$sql.="fechaActualizacion='".$exhortosDto->getFechaActualizacion()."'";
		if(($exhortosDto->getCveEstadoDestino()!="") ){
			$sql.=" AND ";
		}
	}
	if($exhortosDto->getCveEstadoDestino()!=""){
		$sql.="cveEstadoDestino='".$exhortosDto->getCveEstadoDestino()."'";
	}
	if($orden!=""){
		$sql.=$orden;
	}else{
		$sql.="";
	}
//error_log($sql);
	$this->_proveedor->execute($sql);
	if (!$this->_proveedor->error()) {
		if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
			while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
				$tmp[$contador] = new ExhortosDTO();
				$tmp[$contador]->setIdExhorto($row["idExhorto"]);
				$tmp[$contador]->setIdExhortoGenerado($row["IdExhortoGenerado"]);
				$tmp[$contador]->setNumExhorto($row["numExhorto"]);
				$tmp[$contador]->setAniExhorto($row["aniExhorto"]);
				$tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
				$tmp[$contador]->setNumeroExp($row["numeroExp"]);
				$tmp[$contador]->setAnioExp($row["anioExp"]);
				$tmp[$contador]->setCveJuzgadoProcedencia($row["cveJuzgadoProcedencia"]);
				$tmp[$contador]->setJuzgadoProcedencia($row["juzgadoProcedencia"]);
				$tmp[$contador]->setCveEstadoProcedencia($row["cveEstadoProcedencia"]);
				$tmp[$contador]->setCarpetaInv($row["carpetaInv"]);
				$tmp[$contador]->setNuc($row["nuc"]);
				$tmp[$contador]->setCveMateria($row["cveMateria"]);
				$tmp[$contador]->setCveCuantia($row["cveCuantia"]);
				$tmp[$contador]->setNoFojas($row["noFojas"]);
				$tmp[$contador]->setNumOficio($row["numOficio"]);
				$tmp[$contador]->setSintesis($row["sintesis"]);
				$tmp[$contador]->setObservaciones($row["observaciones"]);
				$tmp[$contador]->setCveConsignacion($row["cveConsignacion"]);
				$tmp[$contador]->setCveEstatusExhorto($row["cveEstatusExhorto"]);
				$tmp[$contador]->setActivo($row["activo"]);
				$tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
				$tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
				$tmp[$contador]->setCveEstadoDestino($row["cveEstadoDestino"]);
				$contador++;
			}
		} else {
			$error = true;
		}
	} else {
		$error = true;
	}
	if ($proveedor == null) {
		$this->_proveedor->close();
	}
	unset($contador);
	unset($sql);
	return $tmp;
}
}
?>