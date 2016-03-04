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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/tiposactuaciones/TiposactuacionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class TiposactuacionesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertTiposactuaciones($tiposactuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbltiposactuaciones(";
        if ($tiposactuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion";
            if (($tiposactuacionesDto->getDesTipoActuacion() != "") || ($tiposactuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getDesTipoActuacion() != "") {
            $sql.="desTipoActuacion";
            if (($tiposactuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($tiposactuacionesDto->getCveTipoActuacion() != "") {
            $sql.="'" . $tiposactuacionesDto->getCveTipoActuacion() . "'";
            if (($tiposactuacionesDto->getDesTipoActuacion() != "") || ($tiposactuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getDesTipoActuacion() != "") {
            $sql.="'" . $tiposactuacionesDto->getDesTipoActuacion() . "'";
            if (($tiposactuacionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getActivo() != "") {
            $sql.="'" . $tiposactuacionesDto->getActivo() . "'";
        }
        if ($tiposactuacionesDto->getFechaRegistro() != "") {
            
        }
        if ($tiposactuacionesDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TiposactuacionesDTO();
            $tmp->setcveTipoActuacion($this->_proveedor->lastID());
            $tmp = $this->selectTiposactuaciones($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateTiposactuaciones($tiposactuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbltiposactuaciones SET ";
        if ($tiposactuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $tiposactuacionesDto->getCveTipoActuacion() . "'";
            if (($tiposactuacionesDto->getDesTipoActuacion() != "") || ($tiposactuacionesDto->getActivo() != "") || ($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getDesTipoActuacion() != "") {
            $sql.="desTipoActuacion='" . $tiposactuacionesDto->getDesTipoActuacion() . "'";
            if (($tiposactuacionesDto->getActivo() != "") || ($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getActivo() != "") {
            $sql.="activo='" . $tiposactuacionesDto->getActivo() . "'";
            if (($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tiposactuacionesDto->getFechaRegistro() . "'";
            if (($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposactuacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tiposactuacionesDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveTipoActuacion='" . $tiposactuacionesDto->getCveTipoActuacion() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TiposactuacionesDTO();
            $tmp->setcveTipoActuacion($tiposactuacionesDto->getCveTipoActuacion());
            $tmp = $this->selectTiposactuaciones($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteTiposactuaciones($tiposactuacionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbltiposactuaciones  WHERE cveTipoActuacion='" . $tiposactuacionesDto->getCveTipoActuacion() . "'";
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

    public function selectTiposactuaciones($tiposactuacionesDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveTipoActuacion,desTipoActuacion,activo,fechaRegistro,fechaActualizacion  ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tbltiposactuaciones";
        if (($tiposactuacionesDto->getCveTipoActuacion() != "") || ($tiposactuacionesDto->getDesTipoActuacion() != "") || ($tiposactuacionesDto->getActivo() != "") || ($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($tiposactuacionesDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $tiposactuacionesDto->getCveTipoActuacion() . "'";
            if (($tiposactuacionesDto->getDesTipoActuacion() != "") || ($tiposactuacionesDto->getActivo() != "") || ($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposactuacionesDto->getDesTipoActuacion() != "") {
            if (isset($param["like"]))
            $sql.="desTipoActuacion='" . $tiposactuacionesDto->getDesTipoActuacion() . "'";
            else
                $sql.="desTipoActuacion like '%" . $tiposactuacionesDto->getDesTipoActuacion() . "%'";
            if (($tiposactuacionesDto->getActivo() != "") || ($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposactuacionesDto->getActivo() != "") {
            $sql.="activo='" . $tiposactuacionesDto->getActivo() . "'";
            if (($tiposactuacionesDto->getFechaRegistro() != "") || ($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposactuacionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tiposactuacionesDto->getFechaRegistro() . "'";
            if (($tiposactuacionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposactuacionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tiposactuacionesDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new TiposactuacionesDTO();
                        $tmp[$contador]->setCveTipoActuacion($row["cveTipoActuacion"]);
                        $tmp[$contador]->setDesTipoActuacion($row["desTipoActuacion"]);
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