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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/sistemas/SistemasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class SistemasDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertSistemas($sistemasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblsistemas(";
        if ($sistemasDto->getCveSistema() != "") {
            $sql.="cveSistema";
            if (($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getNomSistema() != "") {
            $sql.="nomSistema";
            if (($sistemasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($sistemasDto->getCveSistema() != "") {
            $sql.="'" . $sistemasDto->getCveSistema() . "'";
            if (($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getNomSistema() != "") {
            $sql.="'" . $sistemasDto->getNomSistema() . "'";
            if (($sistemasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getActivo() != "") {
            $sql.="'" . $sistemasDto->getActivo() . "'";
        }
        if ($sistemasDto->getFechaRegistro() != "") {
            
        }
        if ($sistemasDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new SistemasDTO();
            $tmp->setcveSistema($this->_proveedor->lastID());
            $tmp = $this->selectSistemas($tmp, "", $this->_proveedor);
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

    public function updateSistemas($sistemasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblsistemas SET ";
        if ($sistemasDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $sistemasDto->getCveSistema() . "'";
            if (($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getNomSistema() != "") {
            $sql.="nomSistema='" . $sistemasDto->getNomSistema() . "'";
            if (($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getActivo() != "") {
            $sql.="activo='" . $sistemasDto->getActivo() . "'";
            if (($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $sistemasDto->getFechaRegistro() . "'";
            if (($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($sistemasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $sistemasDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveSistema='" . $sistemasDto->getCveSistema() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new SistemasDTO();
            $tmp->setcveSistema($sistemasDto->getCveSistema());
            $tmp = $this->selectSistemas($tmp, "", $this->_proveedor);
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

    public function deleteSistemas($sistemasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblsistemas  WHERE cveSistema='" . $sistemasDto->getCveSistema() . "'";
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

    public function selectSistemas($sistemasDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cveSistema,nomSistema,activo,fechaRegistro,fechaActualizacion FROM tblsistemas ";
        if (($sistemasDto->getCveSistema() != "") || ($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($sistemasDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $sistemasDto->getCveSistema() . "'";
            if (($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getNomSistema() != "") {
            $sql.="nomSistema='" . $sistemasDto->getNomSistema() . "'";
            if (($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getActivo() != "") {
            $sql.="activo='" . $sistemasDto->getActivo() . "'";
            if (($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $sistemasDto->getFechaRegistro() . "'";
            if (($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $sistemasDto->getFechaActualizacion() . "'";
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
                    $tmp[$contador] = new SistemasDTO();
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setNomSistema($row["nomSistema"]);
                    $tmp[$contador]->setActivo($row["activo"]);
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

    public function selectSistemasGeneral($sistemasDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
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
            $sql .= " cveSistema,nomSistema,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblsistemas";

        if (($sistemasDto->getCveSistema() != "") || ($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($sistemasDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $sistemasDto->getCveSistema() . "'";
            if (($sistemasDto->getNomSistema() != "") || ($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getNomSistema() != "") {
            $sql.="nomSistema like '%" . $sistemasDto->getNomSistema() . "%'";
            if (($sistemasDto->getActivo() != "") || ($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getActivo() != "") {
            $sql.="activo='" . $sistemasDto->getActivo() . "'";
            if (($sistemasDto->getFechaRegistro() != "") || ($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $sistemasDto->getFechaRegistro() . "'";
            if (($sistemasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($sistemasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $sistemasDto->getFechaActualizacion() . "'";
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
        $sql.= " order by cveSistema DESC";

        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "true") {
                $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
            }
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new SistemasDTO();
                        $tmp[$contador]->setCveSistema($row["cveSistema"]);
                        $tmp[$contador]->setNomSistema($row["nomSistema"]);
                        $tmp[$contador]->setActivo($row["activo"]);
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