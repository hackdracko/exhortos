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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/materias/MateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class MateriasDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertMaterias($materiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblmaterias(";
        if ($materiasDto->getCveMateria() != "") {
            $sql.="cveMateria";
            if (($materiasDto->getDesMateria() != "") || ($materiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getDesMateria() != "") {
            $sql.="desMateria";
            if (($materiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($materiasDto->getCveMateria() != "") {
            $sql.="'" . $materiasDto->getCveMateria() . "'";
            if (($materiasDto->getDesMateria() != "") || ($materiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getDesMateria() != "") {
            $sql.="'" . $materiasDto->getDesMateria() . "'";
            if (($materiasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getActivo() != "") {
            $sql.="'" . $materiasDto->getActivo() . "'";
        }
        if ($materiasDto->getFechaRegistro() != "") {
            
        }
        if ($materiasDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new MateriasDTO();
            $tmp->setcveMateria($this->_proveedor->lastID());
            $tmp = $this->selectMaterias($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateMaterias($materiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblmaterias SET ";
        if ($materiasDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $materiasDto->getCveMateria() . "'";
            if (($materiasDto->getDesMateria() != "") || ($materiasDto->getActivo() != "") || ($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getDesMateria() != "") {
            $sql.="desMateria='" . $materiasDto->getDesMateria() . "'";
            if (($materiasDto->getActivo() != "") || ($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getActivo() != "") {
            $sql.="activo='" . $materiasDto->getActivo() . "'";
            if (($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $materiasDto->getFechaRegistro() . "'";
            if (($materiasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($materiasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $materiasDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveMateria='" . $materiasDto->getCveMateria() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new MateriasDTO();
            $tmp->setcveMateria($materiasDto->getCveMateria());
            $tmp = $this->selectMaterias($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteMaterias($materiasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblmaterias  WHERE cveMateria='" . $materiasDto->getCveMateria() . "'";
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

    public function selectMaterias($materiasDto, $orden = "", $proveedor = null, $param, $fields = null) {
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
            $sql .= " cveMateria,desMateria,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblmaterias ";
        if (($materiasDto->getCveMateria() != "") || ($materiasDto->getDesMateria() != "") || ($materiasDto->getActivo() != "") || ($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($materiasDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $materiasDto->getCveMateria() . "'";
            if (($materiasDto->getDesMateria() != "") || ($materiasDto->getActivo() != "") || ($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($materiasDto->getDesMateria() != "") {
            if (isset($param["like"]))
                $sql.="desMateria='" . $materiasDto->getDesMateria() . "'";
            else
                $sql.="desMateria like '%" . $materiasDto->getDesMateria() . "%'";
            if (($materiasDto->getActivo() != "") || ($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($materiasDto->getActivo() != "") {
            $sql.="activo='" . $materiasDto->getActivo() . "'";
            if (($materiasDto->getFechaRegistro() != "") || ($materiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($materiasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $materiasDto->getFechaRegistro() . "'";
            if (($materiasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($materiasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $materiasDto->getFechaActualizacion() . "'";
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
//        if($fields != null)
//            echo $sql;
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
                        $tmp[$contador] = new MateriasDTO();
                        $tmp[$contador]->setCveMateria($row["cveMateria"]);
                        $tmp[$contador]->setDesMateria($row["desMateria"]);
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