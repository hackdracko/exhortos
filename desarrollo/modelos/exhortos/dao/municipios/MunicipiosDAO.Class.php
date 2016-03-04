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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/municipios/MunicipiosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class MunicipiosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertMunicipios($municipiosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblmunicipios(";
        if ($municipiosDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio";
            if (($municipiosDto->getDesMunicipio() != "") || ($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getDesMunicipio() != "") {
            $sql.="desMunicipio";
            if (($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getCveEstado() != "") {
            $sql.="cveEstado";
            if (($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($municipiosDto->getCveMunicipio() != "") {
            $sql.="'" . $municipiosDto->getCveMunicipio() . "'";
            if (($municipiosDto->getDesMunicipio() != "") || ($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getDesMunicipio() != "") {
            $sql.="'" . $municipiosDto->getDesMunicipio() . "'";
            if (($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getCveEstado() != "") {
            $sql.="'" . $municipiosDto->getCveEstado() . "'";
            if (($municipiosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getActivo() != "") {
            $sql.="'" . $municipiosDto->getActivo() . "'";
        }
        if ($municipiosDto->getFechaRegistro() != "") {
            
        }
        if ($municipiosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new MunicipiosDTO();
            $tmp->setcveMunicipio($this->_proveedor->lastID());
            $tmp = $this->selectMunicipios($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateMunicipios($municipiosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblmunicipios SET ";
        if ($municipiosDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio='" . $municipiosDto->getCveMunicipio() . "'";
            if (($municipiosDto->getDesMunicipio() != "") || ($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getDesMunicipio() != "") {
            $sql.="desMunicipio='" . $municipiosDto->getDesMunicipio() . "'";
            if (($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $municipiosDto->getCveEstado() . "'";
            if (($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getActivo() != "") {
            $sql.="activo='" . $municipiosDto->getActivo() . "'";
            if (($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $municipiosDto->getFechaRegistro() . "'";
            if (($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($municipiosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $municipiosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveMunicipio='" . $municipiosDto->getCveMunicipio() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new MunicipiosDTO();
            $tmp->setcveMunicipio($municipiosDto->getCveMunicipio());
            $tmp = $this->selectMunicipios($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteMunicipios($municipiosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblmunicipios  WHERE cveMunicipio='" . $municipiosDto->getCveMunicipio() . "'";
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

    public function selectMunicipios($municipiosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveMunicipio,desMunicipio,cveEstado,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblmunicipios ";
        if (($municipiosDto->getCveMunicipio() != "") || ($municipiosDto->getDesMunicipio() != "") || ($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($municipiosDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio='" . $municipiosDto->getCveMunicipio() . "'";
            if (($municipiosDto->getDesMunicipio() != "") || ($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($municipiosDto->getDesMunicipio() != "") {
            if (isset($param["like"]))
                $sql.="desMunicipio='" . $municipiosDto->getDesMunicipio() . "'";
            else
                $sql.="desMunicipio like '%" . $municipiosDto->getDesMunicipio() . "%'";
            if (($municipiosDto->getCveEstado() != "") || ($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($municipiosDto->getCveEstado() != "") {
            $sql.="cveEstado='" . $municipiosDto->getCveEstado() . "'";
            if (($municipiosDto->getActivo() != "") || ($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($municipiosDto->getActivo() != "") {
            $sql.="activo='" . $municipiosDto->getActivo() . "'";
            if (($municipiosDto->getFechaRegistro() != "") || ($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($municipiosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $municipiosDto->getFechaRegistro() . "'";
            if (($municipiosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($municipiosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $municipiosDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new MunicipiosDTO();
                        $tmp[$contador]->setCveMunicipio($row["cveMunicipio"]);
                        $tmp[$contador]->setDesMunicipio($row["desMunicipio"]);
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