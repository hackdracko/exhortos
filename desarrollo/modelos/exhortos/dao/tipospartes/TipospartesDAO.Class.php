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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/tipospartes/TipospartesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class TipospartesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertTipospartes($tipospartesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbltipospartes(";
        if ($tipospartesDto->getCveTipoParte() != "") {
            $sql.="cveTipoParte";
            if (($tipospartesDto->getDescTipoParte() != "") || ($tipospartesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getDescTipoParte() != "") {
            $sql.="descTipoParte";
            if (($tipospartesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaActualizacion";
        $sql.=",fechaRegistro";
        $sql.=") VALUES(";
        if ($tipospartesDto->getCveTipoParte() != "") {
            $sql.="'" . $tipospartesDto->getCveTipoParte() . "'";
            if (($tipospartesDto->getDescTipoParte() != "") || ($tipospartesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getDescTipoParte() != "") {
            $sql.="'" . $tipospartesDto->getDescTipoParte() . "'";
            if (($tipospartesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getActivo() != "") {
            $sql.="'" . $tipospartesDto->getActivo() . "'";
        }
        if ($tipospartesDto->getFechaActualizacion() != "") {
            
        }
        if ($tipospartesDto->getFechaRegistro() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TipospartesDTO();
            $tmp->setcveTipoParte($this->_proveedor->lastID());
            $tmp = $this->selectTipospartes($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateTipospartes($tipospartesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbltipospartes SET ";
        if ($tipospartesDto->getCveTipoParte() != "") {
            $sql.="cveTipoParte='" . $tipospartesDto->getCveTipoParte() . "'";
            if (($tipospartesDto->getDescTipoParte() != "") || ($tipospartesDto->getActivo() != "") || ($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getDescTipoParte() != "") {
            $sql.="descTipoParte='" . $tipospartesDto->getDescTipoParte() . "'";
            if (($tipospartesDto->getActivo() != "") || ($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getActivo() != "") {
            $sql.="activo='" . $tipospartesDto->getActivo() . "'";
            if (($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tipospartesDto->getFechaActualizacion() . "'";
            if (($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=",";
            }
        }
        if ($tipospartesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tipospartesDto->getFechaRegistro() . "'";
        }
        $sql.=" WHERE cveTipoParte='" . $tipospartesDto->getCveTipoParte() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TipospartesDTO();
            $tmp->setcveTipoParte($tipospartesDto->getCveTipoParte());
            $tmp = $this->selectTipospartes($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteTipospartes($tipospartesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbltipospartes  WHERE cveTipoParte='" . $tipospartesDto->getCveTipoParte() . "'";
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

    public function selectTipospartes($tipospartesDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveTipoParte,descTipoParte,activo,fechaActualizacion,fechaRegistro ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbltipospartes ";
        if (($tipospartesDto->getCveTipoParte() != "") || ($tipospartesDto->getDescTipoParte() != "") || ($tipospartesDto->getActivo() != "") || ($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
            $sql.=" WHERE ";
        }
        if ($tipospartesDto->getCveTipoParte() != "") {
            $sql.="cveTipoParte='" . $tipospartesDto->getCveTipoParte() . "'";
            if (($tipospartesDto->getDescTipoParte() != "") || ($tipospartesDto->getActivo() != "") || ($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospartesDto->getDescTipoParte() != "") {
            if (isset($param["like"]))
                $sql.="descTipoParte='" . $tipospartesDto->getDescTipoParte() . "'";
            else
                $sql.="descTipoParte like '%" . $tipospartesDto->getDescTipoParte() . "%'";

            if (($tipospartesDto->getActivo() != "") || ($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospartesDto->getActivo() != "") {
            $sql.="activo='" . $tipospartesDto->getActivo() . "'";
            if (($tipospartesDto->getFechaActualizacion() != "") || ($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospartesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tipospartesDto->getFechaActualizacion() . "'";
            if (($tipospartesDto->getFechaRegistro() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospartesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tipospartesDto->getFechaRegistro() . "'";
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
                        $tmp[$contador] = new TipospartesDTO();
                        $tmp[$contador]->setCveTipoParte($row["cveTipoParte"]);
                        $tmp[$contador]->setDescTipoParte($row["descTipoParte"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
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
