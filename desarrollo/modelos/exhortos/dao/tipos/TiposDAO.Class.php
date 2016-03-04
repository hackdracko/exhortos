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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/tipos/TiposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class TiposDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertTipos($tiposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbltipos(";
        if ($tiposDto->getCveTipo() != "") {
            $sql.="cveTipo";
            if (($tiposDto->getDesTipo() != "") || ($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesTipo() != "") {
            $sql.="desTipo";
            if (($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesCarpeta() != "") {
            $sql.="desCarpeta";
            if (($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($tiposDto->getCveTipo() != "") {
            $sql.="'" . $tiposDto->getCveTipo() . "'";
            if (($tiposDto->getDesTipo() != "") || ($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesTipo() != "") {
            $sql.="'" . $tiposDto->getDesTipo() . "'";
            if (($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesCarpeta() != "") {
            $sql.="'" . $tiposDto->getDesCarpeta() . "'";
            if (($tiposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getActivo() != "") {
            $sql.="'" . $tiposDto->getActivo() . "'";
        }
        if ($tiposDto->getFechaRegistro() != "") {
            
        }
        if ($tiposDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TiposDTO();
            $tmp->setcveTipo($this->_proveedor->lastID());
            $tmp = $this->selectTipos($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateTipos($tiposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbltipos SET ";
        if ($tiposDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $tiposDto->getCveTipo() . "'";
            if (($tiposDto->getDesTipo() != "") || ($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesTipo() != "") {
            $sql.="desTipo='" . $tiposDto->getDesTipo() . "'";
            if (($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getDesCarpeta() != "") {
            $sql.="desCarpeta='" . $tiposDto->getDesCarpeta() . "'";
            if (($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getActivo() != "") {
            $sql.="activo='" . $tiposDto->getActivo() . "'";
            if (($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tiposDto->getFechaRegistro() . "'";
            if (($tiposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tiposDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tiposDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveTipo='" . $tiposDto->getCveTipo() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TiposDTO();
            $tmp->setcveTipo($tiposDto->getCveTipo());
            $tmp = $this->selectTipos($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteTipos($tiposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbltipos  WHERE cveTipo='" . $tiposDto->getCveTipo() . "'";
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

    public function selectTipos($tiposDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveTipo,desTipo,desCarpeta,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbltipos ";
        if (($tiposDto->getCveTipo() != "") || ($tiposDto->getDesTipo() != "") || ($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($tiposDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $tiposDto->getCveTipo() . "'";
            if (($tiposDto->getDesTipo() != "") || ($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposDto->getDesTipo() != "") {
            if (isset($param["like"]))
                $sql.="desTipo='" . $tiposDto->getDesTipo() . "'";
            else
                $sql.="desTipo like '%" . $tiposDto->getDesTipo() . "%'";
            if (($tiposDto->getDesCarpeta() != "") || ($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposDto->getDesCarpeta() != "") {
            if (isset($param["like"]))
                $sql.="desCarpeta='" . $tiposDto->getDesCarpeta() . "'";
            else
                $sql.="desCarpeta like '%" . $tiposDto->getDesCarpeta() . "%'";
            if (($tiposDto->getActivo() != "") || ($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposDto->getActivo() != "") {
            $sql.="activo='" . $tiposDto->getActivo() . "'";
            if (($tiposDto->getFechaRegistro() != "") || ($tiposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tiposDto->getFechaRegistro() . "'";
            if (($tiposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tiposDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tiposDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new TiposDTO();
                        $tmp[$contador]->setCveTipo($row["cveTipo"]);
                        $tmp[$contador]->setDesTipo($row["desTipo"]);
                        $tmp[$contador]->setDesCarpeta($row["desCarpeta"]);
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