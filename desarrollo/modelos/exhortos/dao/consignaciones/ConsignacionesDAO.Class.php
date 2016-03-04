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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/consignaciones/ConsignacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class ConsignacionesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertConsignaciones($consignacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblconsignaciones(";
        if ($consignacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion";
            if (($consignacionesDto->getDesConsignacion() != "") || ($consignacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getDesConsignacion() != "") {
            $sql.="desConsignacion";
            if (($consignacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($consignacionesDto->getCveConsignacion() != "") {
            $sql.="'" . $consignacionesDto->getCveConsignacion() . "'";
            if (($consignacionesDto->getDesConsignacion() != "") || ($consignacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getDesConsignacion() != "") {
            $sql.="'" . $consignacionesDto->getDesConsignacion() . "'";
            if (($consignacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getActivo() != "") {
            $sql.="'" . $consignacionesDto->getActivo() . "'";
        }
        if ($consignacionesDto->getFechaRegistro() != "") {
            
        }
        if ($consignacionesDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ConsignacionesDTO();
            $tmp->setcveConsignacion($this->_proveedor->lastID());
            $tmp = $this->selectConsignaciones($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateConsignaciones($consignacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblconsignaciones SET ";
        if ($consignacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion='" . $consignacionesDto->getCveConsignacion() . "'";
            if (($consignacionesDto->getDesConsignacion() != "") || ($consignacionesDto->getActivo() != "") || ($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getDesConsignacion() != "") {
            $sql.="desConsignacion='" . $consignacionesDto->getDesConsignacion() . "'";
            if (($consignacionesDto->getActivo() != "") || ($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getActivo() != "") {
            $sql.="activo='" . $consignacionesDto->getActivo() . "'";
            if (($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $consignacionesDto->getFechaRegistro() . "'";
            if (($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($consignacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $consignacionesDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveConsignacion='" . $consignacionesDto->getCveConsignacion() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ConsignacionesDTO();
            $tmp->setcveConsignacion($consignacionesDto->getCveConsignacion());
            $tmp = $this->selectConsignaciones($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteConsignaciones($consignacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblconsignaciones  WHERE cveConsignacion='" . $consignacionesDto->getCveConsignacion() . "'";
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

    public function selectConsignaciones($consignacionesDto, $orden = "", $proveedor = null, $param=null, $fields = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = " SELECT ";
        if ($fields === null) {
            $sql .= " cveConsignacion,desConsignacion,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblconsignaciones ";
        if (($consignacionesDto->getCveConsignacion() != "") || ($consignacionesDto->getDesConsignacion() != "") || ($consignacionesDto->getActivo() != "") || ($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($consignacionesDto->getCveConsignacion() != "") {
            $sql.="cveConsignacion='" . $consignacionesDto->getCveConsignacion() . "'";
            if (($consignacionesDto->getDesConsignacion() != "") || ($consignacionesDto->getActivo() != "") || ($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($consignacionesDto->getDesConsignacion() != "") {
            if (isset($param["like"]))
                $sql.="desConsignacion='" . $consignacionesDto->getDesConsignacion() . "'";
            else
                $sql.="desConsignacion like '%" . $consignacionesDto->getDesConsignacion() . "%'";
            if (($consignacionesDto->getActivo() != "") || ($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($consignacionesDto->getActivo() != "") {
            $sql.="activo='" . $consignacionesDto->getActivo() . "'";
            if (($consignacionesDto->getFechaRegistro() != "") || ($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($consignacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $consignacionesDto->getFechaRegistro() . "'";
            if (($consignacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($consignacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $consignacionesDto->getFechaActualizacion() . "'";
        }
        $inicial = "";
        //var_dump($param);
        if ($param != "" || $param != null) {
            if (isset($param['paginacion']) && $param["paginacion"] == "true") {
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
        if ($param != "" && $param != null && isset($param['cantxPag']) && $param["cantxPag"] != "") {
            $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
        }
//        error_log($sql);
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                $numField = mysqli_num_fields($this->_proveedor->stmt);
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        for ($i = 0; $i < $numField; $i++) {
                            $fieldInfo = mysqli_fetch_field_direct($this->_proveedor->stmt, $i);
                            $row[$fieldInfo->name] = utf8_encode($row[$fieldInfo->name]);
                        }
                        $tmp[$contador] = new ConsignacionesDTO();
                        $tmp[$contador]->setCveConsignacion($row["cveConsignacion"]);
                        $tmp[$contador]->setDesConsignacion($row["desConsignacion"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
//                    $contador++;
                    } else {
                        $tmp[$contador] = array();
                        for ($i = 0; $i < $numField; $i++) {
                            $fieldInfo = mysqli_fetch_field_direct($this->_proveedor->stmt, $i);
                            $tmp[$contador][$fieldInfo->name] = utf8_encode($row[$fieldInfo->name]);
                        }
                    }
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