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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/acciones/AccionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class AccionesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertAcciones($accionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblacciones(";
        if ($accionesDto->getCveAccion() != "") {
            $sql.="cveAccion";
            if (($accionesDto->getDesAccion() != "") || ($accionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getDesAccion() != "") {
            $sql.="desAccion";
            if (($accionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($accionesDto->getCveAccion() != "") {
            $sql.="'" . $accionesDto->getCveAccion() . "'";
            if (($accionesDto->getDesAccion() != "") || ($accionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getDesAccion() != "") {
            $sql.="'" . $accionesDto->getDesAccion() . "'";
            if (($accionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getActivo() != "") {
            $sql.="'" . $accionesDto->getActivo() . "'";
        }
        if ($accionesDto->getFechaRegistro() != "") {
            
        }
        if ($accionesDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new AccionesDTO();
            $tmp->setcveAccion($this->_proveedor->lastID());
            $tmp = $this->selectAcciones($tmp, $this->_proveedor, "", null, null);
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

    public function updateAcciones($accionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblacciones SET ";
        if ($accionesDto->getCveAccion() != "") {
            $sql.="cveAccion='" . $accionesDto->getCveAccion() . "'";
            if (($accionesDto->getDesAccion() != "") || ($accionesDto->getActivo() != "") || ($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getDesAccion() != "") {
            $sql.="desAccion='" . $accionesDto->getDesAccion() . "'";
            if (($accionesDto->getActivo() != "") || ($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getActivo() != "") {
            $sql.="activo='" . $accionesDto->getActivo() . "'";
            if (($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $accionesDto->getFechaRegistro() . "'";
            if (($accionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($accionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $accionesDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveAccion='" . $accionesDto->getCveAccion() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new AccionesDTO();
            $tmp->setcveAccion($accionesDto->getCveAccion());
            $tmp = $this->selectAcciones($tmp, $this->_proveedor, "", null, null);
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

    public function deleteAcciones($accionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblacciones  WHERE cveAccion='" . $accionesDto->getCveAccion() . "'";
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

    public function selectAcciones($accionesDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
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
            $sql .= " cveAccion,desAccion,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblacciones";


        if (($accionesDto->getCveAccion() != "") || ($accionesDto->getDesAccion() != "") || ($accionesDto->getActivo() != "") || ($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($accionesDto->getCveAccion() != "") {
            $sql.="cveAccion='" . $accionesDto->getCveAccion() . "'";
            if (($accionesDto->getDesAccion() != "") || ($accionesDto->getActivo() != "") || ($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($accionesDto->getDesAccion() != "") {
            $sql.="desAccion='" . $accionesDto->getDesAccion() . "'";
            if (($accionesDto->getActivo() != "") || ($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($accionesDto->getActivo() != "") {
            $sql.="activo='" . $accionesDto->getActivo() . "'";
            if (($accionesDto->getFechaRegistro() != "") || ($accionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($accionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $accionesDto->getFechaRegistro() . "'";
            if (($accionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($accionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $accionesDto->getFechaActualizacion() . "'";
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
        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "") {
                if ($param["paginacion"] == "true") {
                    $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
                }
            }
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new AccionesDTO();
                        $tmp[$contador]->setCveAccion($row["cveAccion"]);
                        $tmp[$contador]->setDesAccion($row["desAccion"]);
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