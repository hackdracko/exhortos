<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 DAOS
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/actuaciones/ActuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class ActuacionesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertActuaciones($actuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblactuaciones(";
        if ($actuacionesDto->getIdActuacion() != "") {
            $sql.="idActuacion";
            if (($actuacionesDto->getNumActuacion() != "") || ($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumActuacion() != "") {
            $sql.="numActuacion";
            if (($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAniActuacion() != "") {
            $sql.="aniActuacion";
            if (($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion";
            if (($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumeroExp() != "") {
            $sql.="numeroExp";
            if (($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAnioExp() != "") {
            $sql.="anioExp";
            if (($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipo() != "") {
            $sql.="cveTipo";
            if (($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCarpetaInv() != "") {
            $sql.="carpetaInv";
            if (($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNuc() != "") {
            $sql.="nuc";
            if (($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveMateria() != "") {
            $sql.="cveMateria";
            if (($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveCuantia() != "") {
            $sql.="cveCuantia";
            if (($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getIdReferencia() != "") {
            $sql.="idReferencia";
            if (($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNoFojas() != "") {
            $sql.="noFojas";
            if (($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumOficio() != "") {
            $sql.="numOficio";
            if (($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado";
            if (($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getSintesis() != "") {
            $sql.="sintesis";
            if (($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getObservaciones() != "") {
            $sql.="observaciones";
            if (($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion";
            if (($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgadoDestino() != "") {
            $sql.="cveJuzgadoDestino";
            if (($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getJuzgadoDestino() != "") {
            $sql.="juzgadoDestino";
            if (($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($actuacionesDto->getIdActuacion() != "") {
            $sql.="'" . $actuacionesDto->getIdActuacion() . "'";
            if (($actuacionesDto->getNumActuacion() != "") || ($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumActuacion() != "") {
            $sql.="'" . $actuacionesDto->getNumActuacion() . "'";
            if (($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAniActuacion() != "") {
            $sql.="'" . $actuacionesDto->getAniActuacion() . "'";
            if (($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipoActuacion() != "") {
            $sql.="'" . $actuacionesDto->getCveTipoActuacion() . "'";
            if (($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumeroExp() != "") {
            $sql.="'" . $actuacionesDto->getNumeroExp() . "'";
            if (($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAnioExp() != "") {
            $sql.="'" . $actuacionesDto->getAnioExp() . "'";
            if (($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipo() != "") {
            $sql.="'" . $actuacionesDto->getCveTipo() . "'";
            if (($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCarpetaInv() != "") {
            $sql.="'" . $actuacionesDto->getCarpetaInv() . "'";
            if (($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNuc() != "") {
            $sql.="'" . $actuacionesDto->getNuc() . "'";
            if (($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveMateria() != "") {
            $sql.="'" . $actuacionesDto->getCveMateria() . "'";
            if (($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveCuantia() != "") {
            $sql.="'" . $actuacionesDto->getCveCuantia() . "'";
            if (($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getIdReferencia() != "") {
            $sql.="'" . $actuacionesDto->getIdReferencia() . "'";
            if (($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNoFojas() != "") {
            $sql.="'" . $actuacionesDto->getNoFojas() . "'";
            if (($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumOficio() != "") {
            $sql.="'" . $actuacionesDto->getNumOficio() . "'";
            if (($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgado() != "") {
            $sql.="'" . $actuacionesDto->getCveJuzgado() . "'";
            if (($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getSintesis() != "") {
            $sql.="'" . $actuacionesDto->getSintesis() . "'";
            if (($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getObservaciones() != "") {
            $sql.="'" . $actuacionesDto->getObservaciones() . "'";
            if (($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveConsignacion() != "") {
            $sql.="'" . $actuacionesDto->getCveConsignacion() . "'";
            if (($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgadoDestino() != "") {
            $sql.="'" . $actuacionesDto->getCveJuzgadoDestino() . "'";
            if (($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getJuzgadoDestino() != "") {
            $sql.="'" . $actuacionesDto->getJuzgadoDestino() . "'";
            if (($actuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getActivo() != "") {
            $sql.="'" . $actuacionesDto->getActivo() . "'";
        }
        if ($actuacionesDto->getFechaRegistro() != "") {
            
        }
        if ($actuacionesDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ActuacionesDTO();
            $tmp->setidActuacion($this->_proveedor->lastID());
            $tmp = $this->selectActuaciones($tmp, "", $this->_proveedor);
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

    public function updateActuaciones($actuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblactuaciones SET ";
//        if ($actuacionesDto->getIdActuacion() != "") {
//            $sql.="idActuacion='" . $actuacionesDto->getIdActuacion() . "'";
//            if (($actuacionesDto->getNumActuacion() != "") || ($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
//                $sql.=",";
//            }
//        }
        if ($actuacionesDto->getNumActuacion() != "") {
            $sql.="numActuacion='" . $actuacionesDto->getNumActuacion() . "'";
            if (($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAniActuacion() != "") {
            $sql.="aniActuacion='" . $actuacionesDto->getAniActuacion() . "'";
            if (($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $actuacionesDto->getCveTipoActuacion() . "'";
            if (($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumeroExp() != "") {
            $sql.="numeroExp='" . $actuacionesDto->getNumeroExp() . "'";
            if (($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getAnioExp() != "") {
            $sql.="anioExp='" . $actuacionesDto->getAnioExp() . "'";
            if (($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $actuacionesDto->getCveTipo() . "'";
            if (($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCarpetaInv() != "") {
            $sql.="carpetaInv='" . $actuacionesDto->getCarpetaInv() . "'";
            if (($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNuc() != "") {
            $sql.="nuc='" . $actuacionesDto->getNuc() . "'";
            if (($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $actuacionesDto->getCveMateria() . "'";
            if (($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $actuacionesDto->getCveCuantia() . "'";
            if (($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getIdReferencia() != "") {
            $sql.="idReferencia='" . $actuacionesDto->getIdReferencia() . "'";
            if (($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNoFojas() != "") {
            $sql.="noFojas='" . $actuacionesDto->getNoFojas() . "'";
            if (($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getNumOficio() != "") {
            $sql.="numOficio='" . $actuacionesDto->getNumOficio() . "'";
            if (($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $actuacionesDto->getCveJuzgado() . "'";
            if (($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getSintesis() != "") {
            $sql.="sintesis='" . $actuacionesDto->getSintesis() . "'";
            if (($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getObservaciones() != "") {
            $sql.="observaciones='" . $actuacionesDto->getObservaciones() . "'";
            if (($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion='" . $actuacionesDto->getCveConsignacion() . "'";
            if (($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getCveJuzgadoDestino() != "") {
            $sql.="cveJuzgadoDestino='" . $actuacionesDto->getCveJuzgadoDestino() . "'";
            if (($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getJuzgadoDestino() != "") {
            $sql.="juzgadoDestino='" . $actuacionesDto->getJuzgadoDestino() . "'";
            if (($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getActivo() != "") {
            $sql.="activo='" . $actuacionesDto->getActivo() . "'";
            if (($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $actuacionesDto->getFechaRegistro() . "'";
            if (($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($actuacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $actuacionesDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE idActuacion='" . $actuacionesDto->getIdActuacion() . "'";
        error_log($sql);
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ActuacionesDTO();
            $tmp->setidActuacion($actuacionesDto->getIdActuacion());
            $tmp = $this->selectActuaciones($tmp, "", $this->_proveedor);
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

    public function deleteActuaciones($actuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblactuaciones  WHERE idActuacion='" . $actuacionesDto->getIdActuacion() . "'";
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

    public function selectActuaciones($actuacionesDto, $orden = "", $proveedor = null, $fields = null) {
        $tmp = "";
        $sql = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql.="SELECT ";
        if ($fields === null) {
            $sql .= " idActuacion,numActuacion,aniActuacion,cveTipoActuacion,numeroExp,anioExp,cveTipo,carpetaInv,nuc,cveMateria,cveCuantia,idReferencia,noFojas,numOficio,cveJuzgado,sintesis,observaciones,cveConsignacion,cveJuzgadoDestino,juzgadoDestino,activo,fechaRegistro,fechaActualizacion";
        } else {
            $sql .= $fields;
        }
        $sql.="  FROM tblactuaciones ";
        if (($actuacionesDto->getIdActuacion() != "") || ($actuacionesDto->getNumActuacion() != "") || ($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($actuacionesDto->getIdActuacion() != "") {
            $sql.="idActuacion='" . $actuacionesDto->getIdActuacion() . "'";
            if (($actuacionesDto->getNumActuacion() != "") || ($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getNumActuacion() != "") {
            $sql.="numActuacion='" . $actuacionesDto->getNumActuacion() . "'";
            if (($actuacionesDto->getAniActuacion() != "") || ($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getAniActuacion() != "") {
            $sql.="aniActuacion='" . $actuacionesDto->getAniActuacion() . "'";
            if (($actuacionesDto->getCveTipoActuacion() != "") || ($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $actuacionesDto->getCveTipoActuacion() . "'";
            if (($actuacionesDto->getNumeroExp() != "") || ($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getNumeroExp() != "") {
            $sql.="numeroExp='" . $actuacionesDto->getNumeroExp() . "'";
            if (($actuacionesDto->getAnioExp() != "") || ($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getAnioExp() != "") {
            $sql.="anioExp='" . $actuacionesDto->getAnioExp() . "'";
            if (($actuacionesDto->getCveTipo() != "") || ($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $actuacionesDto->getCveTipo() . "'";
            if (($actuacionesDto->getCarpetaInv() != "") || ($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCarpetaInv() != "") {
            $sql.="carpetaInv='" . $actuacionesDto->getCarpetaInv() . "'";
            if (($actuacionesDto->getNuc() != "") || ($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getNuc() != "") {
            $sql.="nuc='" . $actuacionesDto->getNuc() . "'";
            if (($actuacionesDto->getCveMateria() != "") || ($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $actuacionesDto->getCveMateria() . "'";
            if (($actuacionesDto->getCveCuantia() != "") || ($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $actuacionesDto->getCveCuantia() . "'";
            if (($actuacionesDto->getIdReferencia() != "") || ($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getIdReferencia() != "") {
            $sql.="idReferencia='" . $actuacionesDto->getIdReferencia() . "'";
            if (($actuacionesDto->getNoFojas() != "") || ($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getNoFojas() != "") {
            $sql.="noFojas='" . $actuacionesDto->getNoFojas() . "'";
            if (($actuacionesDto->getNumOficio() != "") || ($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getNumOficio() != "") {
            $sql.="numOficio='" . $actuacionesDto->getNumOficio() . "'";
            if (($actuacionesDto->getCveJuzgado() != "") || ($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $actuacionesDto->getCveJuzgado() . "'";
            if (($actuacionesDto->getSintesis() != "") || ($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getSintesis() != "") {
            $sql.="sintesis='" . $actuacionesDto->getSintesis() . "'";
            if (($actuacionesDto->getObservaciones() != "") || ($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getObservaciones() != "") {
            $sql.="observaciones='" . $actuacionesDto->getObservaciones() . "'";
            if (($actuacionesDto->getCveConsignacion() != "") || ($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion='" . $actuacionesDto->getCveConsignacion() . "'";
            if (($actuacionesDto->getCveJuzgadoDestino() != "") || ($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getCveJuzgadoDestino() != "") {
            $sql.="cveJuzgadoDestino='" . $actuacionesDto->getCveJuzgadoDestino() . "'";
            if (($actuacionesDto->getJuzgadoDestino() != "") || ($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getJuzgadoDestino() != "") {
            $sql.="juzgadoDestino='" . $actuacionesDto->getJuzgadoDestino() . "'";
            if (($actuacionesDto->getActivo() != "") || ($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getActivo() != "") {
            $sql.="activo='" . $actuacionesDto->getActivo() . "'";
            if (($actuacionesDto->getFechaRegistro() != "") || ($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $actuacionesDto->getFechaRegistro() . "'";
            if (($actuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($actuacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $actuacionesDto->getFechaActualizacion() . "'";
        }
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new ActuacionesDTO();
                        $tmp[$contador]->setIdActuacion($row["idActuacion"]);
                        $tmp[$contador]->setNumActuacion($row["numActuacion"]);
                        $tmp[$contador]->setAniActuacion($row["aniActuacion"]);
                        $tmp[$contador]->setCveTipoActuacion($row["cveTipoActuacion"]);
                        $tmp[$contador]->setNumeroExp($row["numeroExp"]);
                        $tmp[$contador]->setAnioExp($row["anioExp"]);
                        $tmp[$contador]->setCveTipo($row["cveTipo"]);
                        $tmp[$contador]->setCarpetaInv($row["carpetaInv"]);
                        $tmp[$contador]->setNuc($row["nuc"]);
                        $tmp[$contador]->setCveMateria($row["cveMateria"]);
                        $tmp[$contador]->setCveCuantia($row["cveCuantia"]);
                        $tmp[$contador]->setIdReferencia($row["idReferencia"]);
                        $tmp[$contador]->setNoFojas($row["noFojas"]);
                        $tmp[$contador]->setNumOficio($row["numOficio"]);
                        $tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
                        $tmp[$contador]->setSintesis($row["sintesis"]);
                        $tmp[$contador]->setObservaciones($row["observaciones"]);
                        $tmp[$contador]->setCveConsignacion($row["cveConsignacion"]);
                        $tmp[$contador]->setCveJuzgadoDestino($row["cveJuzgadoDestino"]);
                        $tmp[$contador]->setJuzgadoDestino($row["juzgadoDestino"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $contador++;
                    } else {
                        $tmp[$contador] = array();
                            for ($i = 0; $i < $numField; $i++){
                                $fieldInfo = mysqli_fetch_field_direct($this->_proveedor->stmt, $i);
                                //var_dump($fieldInfo);
                                $tmp[$contador][$fieldInfo->name] = utf8_encode($row[$fieldInfo->name]);
                                
                            }
                        
                    }
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