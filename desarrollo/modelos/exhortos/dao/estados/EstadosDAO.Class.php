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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/estados/EstadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class EstadosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertEstados($estadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblestados(";
        if ($estadosDto->getCveEstado() != "") {
            $sql.="cveEstado";
            if (($estadosDto->getDesEstado() != "") || ($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getDesEstado() != "") {
            $sql.="desEstado";
            if (($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getUrlWebServices() != "") {
            $sql.="urlWebServices";
            if (($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($estadosDto->getCveEstado() != "") {
            $sql.="'" . $estadosDto->getCveEstado() . "'";
            if (($estadosDto->getDesEstado() != "") || ($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getDesEstado() != "") {
            $sql.="'" . $estadosDto->getDesEstado() . "'";
            if (($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getUrlWebServices() != "") {
            $sql.="'" . $estadosDto->getUrlWebServices() . "'";
            if (($estadosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getActivo() != "") {
            $sql.="'" . $estadosDto->getActivo() . "'";
        }
        if ($estadosDto->getFechaRegistro() != "") {
            
        }
        if ($estadosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new EstadosDTO();
            $tmp->setcveEstado($this->_proveedor->lastID());
            $tmp = $this->selectEstados($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateEstados($estadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblestados SET ";
        if ($estadosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $estadosDto->getCveEstado() . "'";
            if (($estadosDto->getDesEstado() != "") || ($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getDesEstado() != "") {
            $sql.="desEstado='" . $estadosDto->getDesEstado() . "'";
            if (($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getUrlWebServices() != "") {
            $sql.="urlWebServices='" . $estadosDto->getUrlWebServices() . "'";
            if (($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getActivo() != "") {
            $sql.="activo='" . $estadosDto->getActivo() . "'";
            if (($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $estadosDto->getFechaRegistro() . "'";
            if (($estadosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($estadosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $estadosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveEstado='" . $estadosDto->getCveEstado() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new EstadosDTO();
            $tmp->setcveEstado($estadosDto->getCveEstado());
            $tmp = $this->selectEstados($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteEstados($estadosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblestados  WHERE cveEstado='" . $estadosDto->getCveEstado() . "'";
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

    public function selectEstados($estadosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
        //error_log(print_r($estadosDto,true));
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
            $sql .= " cveEstado,desEstado,urlWebServices,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblestados ";
        if (($estadosDto->getCveEstado() != "") || ($estadosDto->getDesEstado() != "") || ($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($estadosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $estadosDto->getCveEstado() . "'";
            if (($estadosDto->getDesEstado() != "") || ($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estadosDto->getDesEstado() != "") {
            if (isset($param["like"]))
                $sql.="desEstado='" . $estadosDto->getDesEstado() . "'";
            else
                $sql.="desEstado like '%" . $estadosDto->getDesEstado() . "%'";
            if (($estadosDto->getUrlWebServices() != "") || ($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estadosDto->getUrlWebServices() != "") {
            if ($param["like"])
                $sql.="urlWebServices='" . $estadosDto->getUrlWebServices() . "'";
            else
                $sql.="urlWebServices like '%" . $estadosDto->getUrlWebServices() . "%'";
            if (($estadosDto->getActivo() != "") || ($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estadosDto->getActivo() != "") {
            $sql.="activo='" . $estadosDto->getActivo() . "'";
            if (($estadosDto->getFechaRegistro() != "") || ($estadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estadosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $estadosDto->getFechaRegistro() . "'";
            if (($estadosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($estadosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $estadosDto->getFechaActualizacion() . "'";
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
        //  error_log($sql);
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
                        $tmp[$contador] = new EstadosDTO();
                        $tmp[$contador]->setCveEstado($row["cveEstado"]);
                        $tmp[$contador]->setDesEstado($row["desEstado"]);
                        $tmp[$contador]->setUrlWebServices($row["urlWebServices"]);
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