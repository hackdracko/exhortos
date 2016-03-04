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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/permisosusuarios/PermisosusuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class PermisosusuariosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertPermisosusuarios($permisosusuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblpermisosusuarios(";
        if ($permisosusuariosDto->getCvePermisoUsuario() != "") {
            $sql.="cvePermisoUsuario";
            if (($permisosusuariosDto->getCveUsuario() != "") || ($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario";
            if (($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveSistema() != "") {
            $sql.="cveSistema";
            if (($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario";
            if (($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCvePerfil() != "") {
            $sql.="cvePerfil";
            if (($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getConsulta() != "") {
            $sql.="consulta";
            if (($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getModificar() != "") {
            $sql.="modificar";
            if (($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getEliminar() != "") {
            $sql.="eliminar";
            if (($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getRegistrar() != "") {
            $sql.="registrar";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($permisosusuariosDto->getCvePermisoUsuario() != "") {
            $sql.="'" . $permisosusuariosDto->getCvePermisoUsuario() . "'";
            if (($permisosusuariosDto->getCveUsuario() != "") || ($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveUsuario() != "") {
            $sql.="'" . $permisosusuariosDto->getCveUsuario() . "'";
            if (($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveSistema() != "") {
            $sql.="'" . $permisosusuariosDto->getCveSistema() . "'";
            if (($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveFormulario() != "") {
            $sql.="'" . $permisosusuariosDto->getCveFormulario() . "'";
            if (($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCvePerfil() != "") {
            $sql.="'" . $permisosusuariosDto->getCvePerfil() . "'";
            if (($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getConsulta() != "") {
            $sql.="'" . $permisosusuariosDto->getConsulta() . "'";
            if (($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getModificar() != "") {
            $sql.="'" . $permisosusuariosDto->getModificar() . "'";
            if (($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getEliminar() != "") {
            $sql.="'" . $permisosusuariosDto->getEliminar() . "'";
            if (($permisosusuariosDto->getRegistrar() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getRegistrar() != "") {
            $sql.="'" . $permisosusuariosDto->getRegistrar() . "'";
        }
        if ($permisosusuariosDto->getFechaRegistro() != "") {
            
        }
        if ($permisosusuariosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new PermisosusuariosDTO();
            $tmp->setcvePermisoUsuario($this->_proveedor->lastID());
            $tmp = $this->selectPermisosusuarios($tmp, "", $this->_proveedor);
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

    public function updatePermisosusuarios($permisosusuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblpermisosusuarios SET ";
        if ($permisosusuariosDto->getCvePermisoUsuario() != "") {
            $sql.="cvePermisoUsuario='" . $permisosusuariosDto->getCvePermisoUsuario() . "'";
            if (($permisosusuariosDto->getCveUsuario() != "") || ($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $permisosusuariosDto->getCveUsuario() . "'";
            if (($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $permisosusuariosDto->getCveSistema() . "'";
            if (($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario='" . $permisosusuariosDto->getCveFormulario() . "'";
            if (($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $permisosusuariosDto->getCvePerfil() . "'";
            if (($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getConsulta() != "") {
            $sql.="consulta='" . $permisosusuariosDto->getConsulta() . "'";
            if (($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getModificar() != "") {
            $sql.="modificar='" . $permisosusuariosDto->getModificar() . "'";
            if (($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getEliminar() != "") {
            $sql.="eliminar='" . $permisosusuariosDto->getEliminar() . "'";
            if (($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getRegistrar() != "") {
            $sql.="registrar='" . $permisosusuariosDto->getRegistrar() . "'";
            if (($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $permisosusuariosDto->getFechaRegistro() . "'";
            if (($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($permisosusuariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $permisosusuariosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cvePermisoUsuario='" . $permisosusuariosDto->getCvePermisoUsuario() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new PermisosusuariosDTO();
            $tmp->setcvePermisoUsuario($permisosusuariosDto->getCvePermisoUsuario());
            $tmp = $this->selectPermisosusuarios($tmp, "", $this->_proveedor);
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

    public function deletePermisosusuarios($permisosusuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblpermisosusuarios  WHERE cveUsuario='" . $permisosusuariosDto->getCveUsuario() . "'";
        $sql .= " AND cveSistema='" . $permisosusuariosDto->getCveSistema() . "'";
        if ($permisosusuariosDto->getCveFormulario() != "") {
            $sql .= " AND cveFormulario='" . $permisosusuariosDto->getCveFormulario() . "'";
        }
        $sql .= " AND cvePerfil='" . $permisosusuariosDto->getCvePerfil() . "'";
//        echo $sql;
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

    public function selectPermisosusuarios($permisosusuariosDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cvePermisoUsuario,cveUsuario,cveSistema,cveFormulario,cvePerfil,consulta,modificar,eliminar,registrar,fechaRegistro,fechaActualizacion FROM tblpermisosusuarios ";
        if (($permisosusuariosDto->getCvePermisoUsuario() != "") || ($permisosusuariosDto->getCveUsuario() != "") || ($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($permisosusuariosDto->getCvePermisoUsuario() != "") {
            $sql.="cvePermisoUsuario='" . $permisosusuariosDto->getCvePermisoUsuario() . "'";
            if (($permisosusuariosDto->getCveUsuario() != "") || ($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $permisosusuariosDto->getCveUsuario() . "'";
            if (($permisosusuariosDto->getCveSistema() != "") || ($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $permisosusuariosDto->getCveSistema() . "'";
            if (($permisosusuariosDto->getCveFormulario() != "") || ($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getCveFormulario() != "") {
            $sql.="cveFormulario='" . $permisosusuariosDto->getCveFormulario() . "'";
            if (($permisosusuariosDto->getCvePerfil() != "") || ($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $permisosusuariosDto->getCvePerfil() . "'";
            if (($permisosusuariosDto->getConsulta() != "") || ($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getConsulta() != "") {
            $sql.="consulta='" . $permisosusuariosDto->getConsulta() . "'";
            if (($permisosusuariosDto->getModificar() != "") || ($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getModificar() != "") {
            $sql.="modificar='" . $permisosusuariosDto->getModificar() . "'";
            if (($permisosusuariosDto->getEliminar() != "") || ($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getEliminar() != "") {
            $sql.="eliminar='" . $permisosusuariosDto->getEliminar() . "'";
            if (($permisosusuariosDto->getRegistrar() != "") || ($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getRegistrar() != "") {
            $sql.="registrar='" . $permisosusuariosDto->getRegistrar() . "'";
            if (($permisosusuariosDto->getFechaRegistro() != "") || ($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $permisosusuariosDto->getFechaRegistro() . "'";
            if (($permisosusuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($permisosusuariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $permisosusuariosDto->getFechaActualizacion() . "'";
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
                    $tmp[$contador] = new PermisosusuariosDTO();
                    $tmp[$contador]->setCvePermisoUsuario($row["cvePermisoUsuario"]);
                    $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setCveFormulario($row["cveFormulario"]);
                    $tmp[$contador]->setCvePerfil($row["cvePerfil"]);
                    $tmp[$contador]->setConsulta($row["consulta"]);
                    $tmp[$contador]->setModificar($row["modificar"]);
                    $tmp[$contador]->setEliminar($row["eliminar"]);
                    $tmp[$contador]->setRegistrar($row["registrar"]);
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

}

?>