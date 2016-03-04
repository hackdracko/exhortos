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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class FormulariosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertFormularios($formulariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblformularios(";
        if ($formulariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario";
            if (($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNomFormulario() != "") {
            $sql.="nomFormulario";
            if (($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getActivo() != "") {
            $sql.="activo";
            if (($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getCveSistema() != "") {
            $sql.="cveSistema";
            if (($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getRuta() != "") {
            $sql.="ruta";
            if (($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getDesFormulario() != "") {
            $sql.="desFormulario";
            if (($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getOrden() != "") {
            $sql.="orden";
            if (($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getPadre() != "") {
            $sql.="padre";
            if (($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNivel() != "") {
            $sql.="nivel";
            if (($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getVista() != "") {
            $sql.="vista";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($formulariosDto->getCveFormulario() != "") {
            $sql.="'" . $formulariosDto->getCveFormulario() . "'";
            if (($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNomFormulario() != "") {
            $sql.="'" . $formulariosDto->getNomFormulario() . "'";
            if (($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getActivo() != "") {
            $sql.="'" . $formulariosDto->getActivo() . "'";
            if (($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getCveSistema() != "") {
            $sql.="'" . $formulariosDto->getCveSistema() . "'";
            if (($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getRuta() != "") {
            $sql.="'" . $formulariosDto->getRuta() . "'";
            if (($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getDesFormulario() != "") {
            $sql.="'" . $formulariosDto->getDesFormulario() . "'";
            if (($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getOrden() != "") {
            $sql.="'" . $formulariosDto->getOrden() . "'";
            if (($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getPadre() != "") {
            $sql.="'" . $formulariosDto->getPadre() . "'";
            if (($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNivel() != "") {
            $sql.="'" . $formulariosDto->getNivel() . "'";
            if (($formulariosDto->getVista() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getVista() != "") {
            $sql.="'" . $formulariosDto->getVista() . "'";
        }
        if ($formulariosDto->getFechaRegistro() != "") {
            
        }
        if ($formulariosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new FormulariosDTO();
            $tmp->setcveFormulario($this->_proveedor->lastID());
            $tmp = $this->selectFormularios($tmp, "", $this->_proveedor);
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

    public function updateFormularios($formulariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblformularios SET ";
        if ($formulariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario='" . $formulariosDto->getCveFormulario() . "'";
            if (($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNomFormulario() != "") {
            $sql.="nomFormulario='" . $formulariosDto->getNomFormulario() . "'";
            if (($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getActivo() != "") {
            $sql.="activo='" . $formulariosDto->getActivo() . "'";
            if (($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $formulariosDto->getCveSistema() . "'";
            if (($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getRuta() != "") {
            $sql.="ruta='" . $formulariosDto->getRuta() . "'";
            if (($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getDesFormulario() != "") {
            $sql.="desFormulario='" . $formulariosDto->getDesFormulario() . "'";
            if (($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getOrden() != "") {
            $sql.="orden='" . $formulariosDto->getOrden() . "'";
            if (($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getPadre() != "") {
            $sql.="padre='" . $formulariosDto->getPadre() . "'";
            if (($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getNivel() != "") {
            $sql.="nivel='" . $formulariosDto->getNivel() . "'";
            if (($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getVista() != "") {
            $sql.="vista='" . $formulariosDto->getVista() . "'";
            if (($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $formulariosDto->getFechaRegistro() . "'";
            if (($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($formulariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $formulariosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveFormulario='" . $formulariosDto->getCveFormulario() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new FormulariosDTO();
            $tmp->setcveFormulario($formulariosDto->getCveFormulario());
            $tmp = $this->selectFormularios($tmp, "", $this->_proveedor);
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

    public function deleteFormularios($formulariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblformularios  WHERE cveFormulario='" . $formulariosDto->getCveFormulario() . "'";
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

    public function selectFormularios($formulariosDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cveFormulario,nomFormulario,activo,cveSistema,ruta,desFormulario,orden,padre,nivel,vista,fechaRegistro,fechaActualizacion FROM tblformularios ";
        if (($formulariosDto->getCveFormulario() != "") || ($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($formulariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario='" . $formulariosDto->getCveFormulario() . "'";
            if (($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getNomFormulario() != "") {
            $sql.="nomFormulario='" . $formulariosDto->getNomFormulario() . "'";
            if (($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getActivo() != "") {
            $sql.="activo='" . $formulariosDto->getActivo() . "'";
            if (($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $formulariosDto->getCveSistema() . "'";
            if (($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getRuta() != "") {
            $sql.="ruta='" . $formulariosDto->getRuta() . "'";
            if (($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getDesFormulario() != "") {
            $sql.="desFormulario='" . $formulariosDto->getDesFormulario() . "'";
            if (($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getOrden() != "") {
            $sql.="orden='" . $formulariosDto->getOrden() . "'";
            if (($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getPadre() != "") {
            $sql.="padre='" . $formulariosDto->getPadre() . "'";
            if (($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getNivel() != "") {
            $sql.="nivel='" . $formulariosDto->getNivel() . "'";
            if (($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getVista() != "") {
            $sql.="vista='" . $formulariosDto->getVista() . "'";
            if (($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $formulariosDto->getFechaRegistro() . "'";
            if (($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $formulariosDto->getFechaActualizacion() . "'";
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
                    $tmp[$contador] = new FormulariosDTO();
                    $tmp[$contador]->setCveFormulario($row["cveFormulario"]);
                    $tmp[$contador]->setNomFormulario($row["nomFormulario"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setRuta($row["ruta"]);
                    $tmp[$contador]->setDesFormulario($row["desFormulario"]);
                    $tmp[$contador]->setOrden($row["orden"]);
                    $tmp[$contador]->setPadre($row["padre"]);
                    $tmp[$contador]->setNivel($row["nivel"]);
                    $tmp[$contador]->setVista($row["vista"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
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

    public function selectFormularioHijo($formulariosDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cveFormulario,nomFormulario,activo,cveSistema,ruta,desFormulario,orden,padre,nivel,vista,fechaRegistro,fechaActualizacion FROM tblformularios ";
        $sql.=" where padre='" . $formulariosDto->getCveFormulario() . "'";
        $sql.=" and cveSistema='" . $formulariosDto->getCveSistema() . "'";
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    $tmp[$contador] = new FormulariosDTO();
                    $tmp[$contador]->setCveFormulario($row["cveFormulario"]);
                    $tmp[$contador]->setNomFormulario($row["nomFormulario"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setRuta($row["ruta"]);
                    $tmp[$contador]->setDesFormulario($row["desFormulario"]);
                    $tmp[$contador]->setOrden($row["orden"]);
                    $tmp[$contador]->setPadre($row["padre"]);
                    $tmp[$contador]->setNivel($row["nivel"]);
                    $tmp[$contador]->setVista($row["vista"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
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

    public function selectFormularioNivel($formulariosDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cveFormulario,nomFormulario,activo,cveSistema,ruta,desFormulario,orden,padre,nivel,vista,fechaRegistro,fechaActualizacion FROM tblformularios ";
        $sql.=" where nivel='" . $formulariosDto->getNivel() . "'";
        $sql.=" and cveSistema='" . $formulariosDto->getCveSistema() . "'";
        $sql .=" and activo = 'S'";
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    $tmp[$contador] = new FormulariosDTO();
                    $tmp[$contador]->setCveFormulario($row["cveFormulario"]);
                    $tmp[$contador]->setNomFormulario($row["nomFormulario"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setRuta($row["ruta"]);
                    $tmp[$contador]->setDesFormulario($row["desFormulario"]);
                    $tmp[$contador]->setOrden($row["orden"]);
                    $tmp[$contador]->setPadre($row["padre"]);
                    $tmp[$contador]->setNivel($row["nivel"]);
                    $tmp[$contador]->setVista($row["vista"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
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

    public function selectFormularioGeneral($formulariosDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }


        $sql = "SELECT ";
        if ($fields === null) {
            $sql .= " cveFormulario,nomFormulario,activo,cveSistema,ruta,desFormulario,orden,padre,nivel,vista,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblformularios";

        if (($formulariosDto->getCveFormulario() != "") || ($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($formulariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario='" . $formulariosDto->getCveFormulario() . "'";
            if (($formulariosDto->getNomFormulario() != "") || ($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getNomFormulario() != "") {
            $sql.="nomFormulario like '%" . $formulariosDto->getNomFormulario() . "%'";
            if (($formulariosDto->getActivo() != "") || ($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getActivo() != "") {
            $sql.="activo='" . $formulariosDto->getActivo() . "'";
            if (($formulariosDto->getCveSistema() != "") || ($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $formulariosDto->getCveSistema() . "'";
            if (($formulariosDto->getRuta() != "") || ($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getRuta() != "") {
            $sql.="ruta='" . $formulariosDto->getRuta() . "'";
            if (($formulariosDto->getDesFormulario() != "") || ($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getDesFormulario() != "") {
            $sql.="desFormulario like '%" . $formulariosDto->getDesFormulario() . "%'";
            if (($formulariosDto->getOrden() != "") || ($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getOrden() != "") {
            $sql.="orden='" . $formulariosDto->getOrden() . "'";
            if (($formulariosDto->getPadre() != "") || ($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getPadre() != "") {
            $sql.="padre='" . $formulariosDto->getPadre() . "'";
            if (($formulariosDto->getNivel() != "") || ($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getNivel() != "") {
            $sql.="nivel='" . $formulariosDto->getNivel() . "'";
            if (($formulariosDto->getVista() != "") || ($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getVista() != "") {
            $sql.="vista='" . $formulariosDto->getVista() . "'";
            if (($formulariosDto->getFechaRegistro() != "") || ($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $formulariosDto->getFechaRegistro() . "'";
            if (($formulariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($formulariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $formulariosDto->getFechaActualizacion() . "'";
        }
        if ($param != "") {
            if ($param["paginacion"] == "true") {
                if ($param["pag"] > 0) {
                    $inicial = ($param["pag"] - 1) * $param["cantxPag"];
                } else {
                    $inicial = 0;
                }
            }
        }
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
        $sql.= " order by cveFormulario DESC";

        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "true") {
                $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
            }
        }

//        echo $sql; echo "<br>/n";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new FormulariosDTO();
                        $tmp[$contador]->setCveFormulario($row["cveFormulario"]);
                        $tmp[$contador]->setNomFormulario($row["nomFormulario"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setCveSistema($row["cveSistema"]);
                        $tmp[$contador]->setRuta($row["ruta"]);
                        $tmp[$contador]->setDesFormulario($row["desFormulario"]);
                        $tmp[$contador]->setOrden($row["orden"]);
                        $tmp[$contador]->setPadre($row["padre"]);
                        $tmp[$contador]->setNivel($row["nivel"]);
                        $tmp[$contador]->setVista($row["vista"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $contador++;
                    } else {
                        $tmp[$contador] = $row["totalCount"];
                        $contador++;
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