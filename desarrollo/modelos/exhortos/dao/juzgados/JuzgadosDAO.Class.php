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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class JuzgadosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertJuzgados($juzgadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbljuzgados(";
        if ($juzgadosDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado";
            if (($juzgadosDto->getDesJuzgado() != "") || ($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getDesJuzgado() != "") {
            $sql.="desJuzgado";
            if (($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveOficialia() != "") {
            $sql.="cveOficialia";
            if (($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
            if (($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getProporcion() != "") {
            $sql.="proporcion";
            if (($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getAsignados() != "") {
            $sql.="asignados";
            if (($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getControl() != "") {
            $sql.="control";
            if (($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($juzgadosDto->getCveJuzgado() != "") {
            $sql.="'" . $juzgadosDto->getCveJuzgado() . "'";
            if (($juzgadosDto->getDesJuzgado() != "") || ($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getDesJuzgado() != "") {
            $sql.="'" . $juzgadosDto->getDesJuzgado() . "'";
            if (($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveOficialia() != "") {
            $sql.="'" . $juzgadosDto->getCveOficialia() . "'";
            if (($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveAdscripcion() != "") {
            $sql.="'" . $juzgadosDto->getCveAdscripcion() . "'";
            if (($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getProporcion() != "") {
            $sql.="'" . $juzgadosDto->getProporcion() . "'";
            if (($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getAsignados() != "") {
            $sql.="'" . $juzgadosDto->getAsignados() . "'";
            if (($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getControl() != "") {
            $sql.="'" . $juzgadosDto->getControl() . "'";
            if (($juzgadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getActivo() != "") {
            $sql.="'" . $juzgadosDto->getActivo() . "'";
        }
        if ($juzgadosDto->getFechaRegistro() != "") {
            
        }
        if ($juzgadosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuzgadosDTO();
            $tmp->setcveJuzgado($this->_proveedor->lastID());
            $tmp = $this->selectJuzgados($tmp, "", $this->_proveedor, null, null);
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

    public function updateJuzgados($juzgadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbljuzgados SET ";
        if ($juzgadosDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $juzgadosDto->getCveJuzgado() . "'";
            if (($juzgadosDto->getDesJuzgado() != "") || ($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getDesJuzgado() != "") {
            $sql.="desJuzgado='" . $juzgadosDto->getDesJuzgado() . "'";
            if (($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveOficialia() != "") {
            $sql.="cveOficialia='" . $juzgadosDto->getCveOficialia() . "'";
            if (($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $juzgadosDto->getCveAdscripcion() . "'";
            if (($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getProporcion() != "") {
            $sql.="proporcion='" . $juzgadosDto->getProporcion() . "'";
            if (($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getAsignados() != "") {
            $sql.="asignados='" . $juzgadosDto->getAsignados() . "'";
            if (($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getControl() != "") {
            $sql.="control='" . $juzgadosDto->getControl() . "'";
            if (($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getActivo() != "") {
            $sql.="activo='" . $juzgadosDto->getActivo() . "'";
            if (($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juzgadosDto->getFechaRegistro() . "'";
            if (($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juzgadosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveJuzgado='" . $juzgadosDto->getCveJuzgado() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuzgadosDTO();
            $tmp->setcveJuzgado($juzgadosDto->getCveJuzgado());
            $tmp = $this->selectJuzgados($tmp, "", $this->_proveedor, null, null);
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

    public function deleteJuzgados($juzgadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbljuzgados  WHERE cveJuzgado='" . $juzgadosDto->getCveJuzgado() . "'";
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

    public function selectJuzgados($juzgadosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
//        var_dump($juzgadosDto);
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
            $sql .= " cveJuzgado,desJuzgado,cveOficialia,cveAdscripcion,proporcion,activo,fechaRegistro,fechaActualizacion,asignados,control ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbljuzgados ";
        if (($juzgadosDto->getCveJuzgado() != "") || ($juzgadosDto->getDesJuzgado() != "") || ($juzgadosDto->getCveOficialia() != "")||($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "")) {
            $sql.=" WHERE ";
        }
        if ($juzgadosDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $juzgadosDto->getCveJuzgado() . "'";
            if (($juzgadosDto->getDesJuzgado() != "") || ($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getDesJuzgado() != "") {
            if (isset($param["like"]))
                $sql.="desJuzgado='" . $juzgadosDto->getDesJuzgado() . "'";
            else
                $sql.="desJuzgado like '%" . $juzgadosDto->getDesJuzgado() . "%'";
            if (($juzgadosDto->getCveOficialia() != "") || ($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getCveOficialia() != "") {
            $sql.="cveOficialia='" . $juzgadosDto->getCveOficialia() . "'";
            if (($juzgadosDto->getCveAdscripcion() != "") || ($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $juzgadosDto->getCveAdscripcion() . "'";
            if (($juzgadosDto->getProporcion() != "") || ($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getProporcion() != "") {
            $sql.="proporcion='" . $juzgadosDto->getProporcion() . "'";
            if (($juzgadosDto->getAsignados() != "") || ($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getAsignados() != "") {
            $sql.="asignados='" . $juzgadosDto->getAsignados() . "'";
            if (($juzgadosDto->getControl() != "") || ($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getControl() != "") {
            $sql.="control='" . $juzgadosDto->getControl() . "'";
            if (($juzgadosDto->getActivo() != "") || ($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getActivo() != "") {
            $sql.="activo='" . $juzgadosDto->getActivo() . "'";
            if (($juzgadosDto->getFechaRegistro() != "") || ($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juzgadosDto->getFechaRegistro() . "'";
            if (($juzgadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juzgadosDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new JuzgadosDTO();
                        $tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
                        $tmp[$contador]->setDesJuzgado($row["desJuzgado"]);
                        $tmp[$contador]->setCveOficialia($row["cveOficialia"]);
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                        $tmp[$contador]->setProporcion($row["proporcion"]);
                        $tmp[$contador]->setAsignados($row["asignados"]);
                        $tmp[$contador]->setControl($row["control"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $tmp[$contador]->setAsignados($row["asignados"]);
                        $tmp[$contador]->setControl($row["control"]);
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
