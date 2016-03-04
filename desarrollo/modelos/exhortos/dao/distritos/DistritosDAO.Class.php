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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/distritos/DistritosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class DistritosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertDistritos($distritosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbldistritos(";
        if ($distritosDto->getCveDistrito() != "") {
            $sql.="cveDistrito";
            if (($distritosDto->getDesDistrito() != "") || ($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getDesDistrito() != "") {
            $sql.="desDistrito";
            if (($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getCveEstado() != "") {
            $sql.="cveEstado";
            if (($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($distritosDto->getCveDistrito() != "") {
            $sql.="'" . $distritosDto->getCveDistrito() . "'";
            if (($distritosDto->getDesDistrito() != "") || ($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getDesDistrito() != "") {
            $sql.="'" . $distritosDto->getDesDistrito() . "'";
            if (($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getCveEstado() != "") {
            $sql.="'" . $distritosDto->getCveEstado() . "'";
            if (($distritosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getActivo() != "") {
            $sql.="'" . $distritosDto->getActivo() . "'";
        }
        if ($distritosDto->getFechaRegistro() != "") {
            
        }
        if ($distritosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new DistritosDTO();
            $tmp->setcveDistrito($this->_proveedor->lastID());
            $tmp = $this->selectDistritos($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateDistritos($distritosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbldistritos SET ";
        if ($distritosDto->getCveDistrito() != "") {
            $sql.="cveDistrito='" . $distritosDto->getCveDistrito() . "'";
            if (($distritosDto->getDesDistrito() != "") || ($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getDesDistrito() != "") {
            $sql.="desDistrito='" . $distritosDto->getDesDistrito() . "'";
            if (($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $distritosDto->getCveEstado() . "'";
            if (($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getActivo() != "") {
            $sql.="activo='" . $distritosDto->getActivo() . "'";
            if (($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $distritosDto->getFechaRegistro() . "'";
            if (($distritosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($distritosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $distritosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveDistrito='" . $distritosDto->getCveDistrito() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new DistritosDTO();
            $tmp->setcveDistrito($distritosDto->getCveDistrito());
            $tmp = $this->selectDistritos($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteDistritos($distritosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbldistritos  WHERE cveDistrito='" . $distritosDto->getCveDistrito() . "'";
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

    public function selectDistritos($distritosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveDistrito,desDistrito,cveEstado,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbldistritos ";
        if (($distritosDto->getCveDistrito() != "") || ($distritosDto->getDesDistrito() != "") || ($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($distritosDto->getCveDistrito() != "") {
            $sql.="cveDistrito='" . $distritosDto->getCveDistrito() . "'";
            if (($distritosDto->getDesDistrito() != "") || ($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($distritosDto->getDesDistrito() != "") {
            if (isset($param["like"]))
                $sql.="desDistrito='" . $distritosDto->getDesDistrito() . "'";
            else
                $sql.="desDistrito like '%" . $distritosDto->getDesDistrito() . "%'";

            if (($distritosDto->getCveEstado() != "") || ($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($distritosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $distritosDto->getCveEstado() . "'";
            if (($distritosDto->getActivo() != "") || ($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($distritosDto->getActivo() != "") {
            $sql.="activo='" . $distritosDto->getActivo() . "'";
            if (($distritosDto->getFechaRegistro() != "") || ($distritosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($distritosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $distritosDto->getFechaRegistro() . "'";
            if (($distritosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($distritosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $distritosDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new DistritosDTO();
                        $tmp[$contador]->setCveDistrito($row["cveDistrito"]);
                        $tmp[$contador]->setDesDistrito($row["desDistrito"]);
                        $tmp[$contador]->setCveEstado($row["cveEstado"]);
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