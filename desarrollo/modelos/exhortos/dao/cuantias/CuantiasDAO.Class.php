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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/cuantias/CuantiasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class CuantiasDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertCuantias($cuantiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblcuantias(";
        if ($cuantiasDto->getCveCuantia() != "") {
            $sql.="cveCuantia";
            if (($cuantiasDto->getDesCuantia() != "") || ($cuantiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getDesCuantia() != "") {
            $sql.="desCuantia";
            if (($cuantiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($cuantiasDto->getCveCuantia() != "") {
            $sql.="'" . $cuantiasDto->getCveCuantia() . "'";
            if (($cuantiasDto->getDesCuantia() != "") || ($cuantiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getDesCuantia() != "") {
            $sql.="'" . $cuantiasDto->getDesCuantia() . "'";
            if (($cuantiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getActivo() != "") {
            $sql.="'" . $cuantiasDto->getActivo() . "'";
        }
        if ($cuantiasDto->getFechaRegistro() != "") {
            
        }
        if ($cuantiasDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new CuantiasDTO();
            $tmp->setcveCuantia($this->_proveedor->lastID());
            $tmp = $this->selectCuantias($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateCuantias($cuantiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblcuantias SET ";
        if ($cuantiasDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $cuantiasDto->getCveCuantia() . "'";
            if (($cuantiasDto->getDesCuantia() != "") || ($cuantiasDto->getActivo() != "") || ($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getDesCuantia() != "") {
            $sql.="desCuantia='" . $cuantiasDto->getDesCuantia() . "'";
            if (($cuantiasDto->getActivo() != "") || ($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getActivo() != "") {
            $sql.="activo='" . $cuantiasDto->getActivo() . "'";
            if (($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $cuantiasDto->getFechaRegistro() . "'";
            if (($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($cuantiasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $cuantiasDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveCuantia='" . $cuantiasDto->getCveCuantia() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new CuantiasDTO();
            $tmp->setcveCuantia($cuantiasDto->getCveCuantia());
            $tmp = $this->selectCuantias($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteCuantias($cuantiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblcuantias  WHERE cveCuantia='" . $cuantiasDto->getCveCuantia() . "'";
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

    public function selectCuantias($cuantiasDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveCuantia,desCuantia,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblcuantias ";
        if (($cuantiasDto->getCveCuantia() != "") || ($cuantiasDto->getDesCuantia() != "") || ($cuantiasDto->getActivo() != "") || ($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($cuantiasDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $cuantiasDto->getCveCuantia() . "'";
            if (($cuantiasDto->getDesCuantia() != "") || ($cuantiasDto->getActivo() != "") || ($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($cuantiasDto->getDesCuantia() != "") {
            if (isset($param["like"]))
                $sql.="desCuantia='" . $cuantiasDto->getDesCuantia() . "'";
            else
                $sql.="desCuantia like '%" . $cuantiasDto->getDesCuantia() . "%'";
            if (($cuantiasDto->getActivo() != "") || ($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($cuantiasDto->getActivo() != "") {
            $sql.="activo='" . $cuantiasDto->getActivo() . "'";
            if (($cuantiasDto->getFechaRegistro() != "") || ($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($cuantiasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $cuantiasDto->getFechaRegistro() . "'";
            if (($cuantiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($cuantiasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $cuantiasDto->getFechaActualizacion() . "'";
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
//        echo $sql;
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
                        $tmp[$contador] = new CuantiasDTO();
                        $tmp[$contador]->setCveCuantia($row["cveCuantia"]);
                        $tmp[$contador]->setDesCuantia($row["desCuantia"]);
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