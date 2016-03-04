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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/generos/GenerosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class GenerosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertGeneros($generosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblgeneros(";
        if ($generosDto->getCveGenero() != "") {
            $sql.="cveGenero";
            if (($generosDto->getDesGenero() != "") || ($generosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getDesGenero() != "") {
            $sql.="desGenero";
            if (($generosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($generosDto->getCveGenero() != "") {
            $sql.="'" . $generosDto->getCveGenero() . "'";
            if (($generosDto->getDesGenero() != "") || ($generosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getDesGenero() != "") {
            $sql.="'" . $generosDto->getDesGenero() . "'";
            if (($generosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getActivo() != "") {
            $sql.="'" . $generosDto->getActivo() . "'";
        }
        if ($generosDto->getFechaRegistro() != "") {
            
        }
        if ($generosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new GenerosDTO();
            $tmp->setcveGenero($this->_proveedor->lastID());
            $tmp = $this->selectGeneros($tmp, "", $this->_proveedor, "", null,null);
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

    public function updateGeneros($generosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblgeneros SET ";
        if ($generosDto->getCveGenero() != "") {
            $sql.="cveGenero='" . $generosDto->getCveGenero() . "'";
            if (($generosDto->getDesGenero() != "") || ($generosDto->getActivo() != "") || ($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getDesGenero() != "") {
            $sql.="desGenero='" . $generosDto->getDesGenero() . "'";
            if (($generosDto->getActivo() != "") || ($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getActivo() != "") {
            $sql.="activo='" . $generosDto->getActivo() . "'";
            if (($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $generosDto->getFechaRegistro() . "'";
            if (($generosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($generosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $generosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveGenero='" . $generosDto->getCveGenero() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new GenerosDTO();
            $tmp->setcveGenero($generosDto->getCveGenero());
            $tmp = $this->selectGeneros($tmp, "",$this->_proveedor, null,null);
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

    public function deleteGeneros($generosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblgeneros  WHERE cveGenero='" . $generosDto->getCveGenero() . "'";
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

    public function selectGeneros($generosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveGenero,desGenero,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblgeneros ";
        if (($generosDto->getCveGenero() != "") || ($generosDto->getDesGenero() != "") || ($generosDto->getActivo() != "") || ($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($generosDto->getCveGenero() != "") {
            $sql.="cveGenero='" . $generosDto->getCveGenero() . "'";
            if (($generosDto->getDesGenero() != "") || ($generosDto->getActivo() != "") || ($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($generosDto->getDesGenero() != "") {
            if(isset($param["like"]))
                $sql.="desGenero='" . $generosDto->getDesGenero() . "'";
            else
                $sql.="desGenero like '%" . $generosDto->getDesGenero() . "%'";
            if (($generosDto->getActivo() != "") || ($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($generosDto->getActivo() != "") {
            $sql.="activo='" . $generosDto->getActivo() . "'";
            if (($generosDto->getFechaRegistro() != "") || ($generosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($generosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $generosDto->getFechaRegistro() . "'";
            if (($generosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($generosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $generosDto->getFechaActualizacion() . "'";
        }
        $inicial="";
//        var_dump($param);
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
        if ($param != "" && $param != null && isset($param['cantxPag'])  && $param["cantxPag"] != "") {
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
                        $tmp[$contador] = new GenerosDTO();
                        $tmp[$contador]->setCveGenero($row["cveGenero"]);
                        $tmp[$contador]->setDesGenero($row["desGenero"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
//                        $contador++;
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