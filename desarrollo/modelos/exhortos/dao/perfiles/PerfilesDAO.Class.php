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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class PerfilesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertPerfiles($perfilesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblperfiles(";
        if ($perfilesDto->getCvePerfil() != "") {
            $sql.="cvePerfil";
            if (($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveGrupo() != "") {
            $sql.="cveGrupo";
            if (($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveUsuario() != "") {
            $sql.="cveUsuario";
            if (($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveSistema() != "") {
            $sql.="cveSistema";
            if (($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
            if (($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($perfilesDto->getCvePerfil() != "") {
            $sql.="'" . $perfilesDto->getCvePerfil() . "'";
            if (($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveGrupo() != "") {
            $sql.="'" . $perfilesDto->getCveGrupo() . "'";
            if (($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveUsuario() != "") {
            $sql.="'" . $perfilesDto->getCveUsuario() . "'";
            if (($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveSistema() != "") {
            $sql.="'" . $perfilesDto->getCveSistema() . "'";
            if (($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveAdscripcion() != "") {
            $sql.="'" . $perfilesDto->getCveAdscripcion() . "'";
            if (($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getFechaRegistro() != "") {
            if (($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getFechaActualizacion() != "") {
            if (($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getActivo() != "") {
            $sql.="'" . $perfilesDto->getActivo() . "'";
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new PerfilesDTO();
            $tmp->setcvePerfil($this->_proveedor->lastID());
            $tmp = $this->selectPerfiles($tmp, "", $this->_proveedor);
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

    public function updatePerfiles($perfilesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblperfiles SET ";
        if ($perfilesDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $perfilesDto->getCvePerfil() . "'";
            if (($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveGrupo() != "") {
            $sql.="cveGrupo='" . $perfilesDto->getCveGrupo() . "'";
            if (($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $perfilesDto->getCveUsuario() . "'";
            if (($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $perfilesDto->getCveSistema() . "'";
            if (($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $perfilesDto->getCveAdscripcion() . "'";
            if (($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $perfilesDto->getFechaRegistro() . "'";
            if (($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $perfilesDto->getFechaActualizacion() . "'";
            if (($perfilesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($perfilesDto->getActivo() != "") {
            $sql.="activo='" . $perfilesDto->getActivo() . "'";
        }
        $sql.=" WHERE cvePerfil='" . $perfilesDto->getCvePerfil() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new PerfilesDTO();
            $tmp->setcvePerfil($perfilesDto->getCvePerfil());
            $tmp = $this->selectPerfiles($tmp, "", $this->_proveedor);
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

    public function deletePerfiles($perfilesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblperfiles  WHERE cvePerfil='" . $perfilesDto->getCvePerfil() . "'";
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

    public function selectPerfiles($perfilesDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cvePerfil,cveGrupo,cveUsuario,cveSistema,cveAdscripcion,fechaRegistro,fechaActualizacion,activo FROM tblperfiles ";
        if (($perfilesDto->getCvePerfil() != "") || ($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
            $sql.=" WHERE ";
        }
        if ($perfilesDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $perfilesDto->getCvePerfil() . "'";
            if (($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveGrupo() != "") {
            $sql.="cveGrupo='" . $perfilesDto->getCveGrupo() . "'";
            if (($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $perfilesDto->getCveUsuario() . "'";
            if (($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $perfilesDto->getCveSistema() . "'";
            if (($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $perfilesDto->getCveAdscripcion() . "'";
            if (($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $perfilesDto->getFechaRegistro() . "'";
            if (($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $perfilesDto->getFechaActualizacion() . "'";
            if (($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getActivo() != "") {
            $sql.="activo='" . $perfilesDto->getActivo() . "'";
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
                    $tmp[$contador] = new PerfilesDTO();
                    $tmp[$contador]->setCvePerfil($row["cvePerfil"]);
                    $tmp[$contador]->setCveGrupo($row["cveGrupo"]);
                    $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                    $tmp[$contador]->setActivo($row["activo"]);
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

    public function selectPerfilesGeneral($perfilesDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
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
            $sql .= " cvePerfil,cveGrupo,cveUsuario,cveSistema,cveAdscripcion,fechaRegistro,fechaActualizacion,activo ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblperfiles";


        if (($perfilesDto->getCvePerfil() != "") || ($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
            $sql.=" WHERE ";
        }
        if ($perfilesDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $perfilesDto->getCvePerfil() . "'";
            if (($perfilesDto->getCveGrupo() != "") || ($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveGrupo() != "") {
            $sql.="cveGrupo='" . $perfilesDto->getCveGrupo() . "'";
            if (($perfilesDto->getCveUsuario() != "") || ($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $perfilesDto->getCveUsuario() . "'";
            if (($perfilesDto->getCveSistema() != "") || ($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $perfilesDto->getCveSistema() . "'";
            if (($perfilesDto->getCveAdscripcion() != "") || ($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $perfilesDto->getCveAdscripcion() . "'";
            if (($perfilesDto->getFechaRegistro() != "") || ($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $perfilesDto->getFechaRegistro() . "'";
            if (($perfilesDto->getFechaActualizacion() != "") || ($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $perfilesDto->getFechaActualizacion() . "'";
            if (($perfilesDto->getActivo() != "")) {
                $sql.=" AND ";
            }
        }
        if ($perfilesDto->getActivo() != "") {
            $sql.="activo='" . $perfilesDto->getActivo() . "'";
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
        $sql.= " order by cvePerfil DESC";

        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "true") {
                $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
            }
        }
        error_log("sql => " . $sql);
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new PerfilesDTO();
                        $tmp[$contador]->setCvePerfil($row["cvePerfil"]);
                        $tmp[$contador]->setCveGrupo($row["cveGrupo"]);
                        $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                        $tmp[$contador]->setCveSistema($row["cveSistema"]);
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $tmp[$contador]->setActivo($row["activo"]);
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