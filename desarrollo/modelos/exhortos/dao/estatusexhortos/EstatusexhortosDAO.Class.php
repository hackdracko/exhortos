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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/estatusexhortos/EstatusexhortosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class EstatusexhortosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertEstatusexhortos($estatusexhortosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblestatusexhortos(";
        if ($estatusexhortosDto->getCveEstatusExhorto() != "") {
            $sql.="cveEstatusExhorto";
            if (($estatusexhortosDto->getDesEstatusExhorto() != "") || ($estatusexhortosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getDesEstatusExhorto() != "") {
            $sql.="desEstatusExhorto";
            if (($estatusexhortosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($estatusexhortosDto->getCveEstatusExhorto() != "") {
            $sql.="'" . $estatusexhortosDto->getCveEstatusExhorto() . "'";
            if (($estatusexhortosDto->getDesEstatusExhorto() != "") || ($estatusexhortosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getDesEstatusExhorto() != "") {
            $sql.="'" . $estatusexhortosDto->getDesEstatusExhorto() . "'";
            if (($estatusexhortosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getActivo() != "") {
            $sql.="'" . $estatusexhortosDto->getActivo() . "'";
        }
        if ($estatusexhortosDto->getFechaRegistro() != "") {
            
        }
        if ($estatusexhortosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new EstatusexhortosDTO();
            $tmp->setcveEstatusExhorto($this->_proveedor->lastID());
            $tmp = $this->selectEstatusexhortos($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateEstatusexhortos($estatusexhortosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblestatusexhortos SET ";
        if ($estatusexhortosDto->getCveEstatusExhorto() != "") {
            $sql.="cveEstatusExhorto='" . $estatusexhortosDto->getCveEstatusExhorto() . "'";
            if (($estatusexhortosDto->getDesEstatusExhorto() != "") || ($estatusexhortosDto->getActivo() != "") || ($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getDesEstatusExhorto() != "") {
            $sql.="desEstatusExhorto='" . $estatusexhortosDto->getDesEstatusExhorto() . "'";
            if (($estatusexhortosDto->getActivo() != "") || ($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getActivo() != "") {
            $sql.="activo='" . $estatusexhortosDto->getActivo() . "'";
            if (($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $estatusexhortosDto->getFechaRegistro() . "'";
            if (($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estatusexhortosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $estatusexhortosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveEstatusExhorto='" . $estatusexhortosDto->getCveEstatusExhorto() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new EstatusexhortosDTO();
            $tmp->setcveEstatusExhorto($estatusexhortosDto->getCveEstatusExhorto());
            $tmp = $this->selectEstatusexhortos($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteEstatusexhortos($estatusexhortosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblestatusexhortos  WHERE cveEstatusExhorto='" . $estatusexhortosDto->getCveEstatusExhorto() . "'";
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

    public function selectEstatusexhortos($estatusexhortosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveEstatusExhorto,desEstatusExhorto,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblestatusexhortos ";
        if (($estatusexhortosDto->getCveEstatusExhorto() != "") || ($estatusexhortosDto->getDesEstatusExhorto() != "") || ($estatusexhortosDto->getActivo() != "") || ($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($estatusexhortosDto->getCveEstatusExhorto() != "") {
            $sql.="cveEstatusExhorto='" . $estatusexhortosDto->getCveEstatusExhorto() . "'";
            if (($estatusexhortosDto->getDesEstatusExhorto() != "") || ($estatusexhortosDto->getActivo() != "") || ($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estatusexhortosDto->getDesEstatusExhorto() != "") {
            if (isset($param["like"]))
                $sql.="desEstatusExhorto='" . $estatusexhortosDto->getDesEstatusExhorto() . "'";
            else
                $sql.="desEstatusExhorto like '%" . $estatusexhortosDto->getDesEstatusExhorto() . "%'";
            if (($estatusexhortosDto->getActivo() != "") || ($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estatusexhortosDto->getActivo() != "") {
            $sql.="activo='" . $estatusexhortosDto->getActivo() . "'";
            if (($estatusexhortosDto->getFechaRegistro() != "") || ($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estatusexhortosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $estatusexhortosDto->getFechaRegistro() . "'";
            if (($estatusexhortosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estatusexhortosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $estatusexhortosDto->getFechaActualizacion() . "'";
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
//                var_dump($this->_proveedor->stmt);
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        for ($i = 0; $i < $numField; $i++) {
                            $fieldInfo = mysqli_fetch_field_direct($this->_proveedor->stmt, $i);
                            $row[$fieldInfo->name] = utf8_encode($row[$fieldInfo->name]);
                        }
                        $tmp[$contador] = new EstatusexhortosDTO();
                        $tmp[$contador]->setCveEstatusExhorto($row["cveEstatusExhorto"]);
                        $tmp[$contador]->setDesEstatusExhorto($row["desEstatusExhorto"]);
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