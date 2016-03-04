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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/tipospersonas/TipospersonasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class TipospersonasDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertTipospersonas($tipospersonasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbltipospersonas(";
        if ($tipospersonasDto->getCveTipoPersona() != "") {
            $sql.="cveTipoPersona";
            if (($tipospersonasDto->getDesTipoPersona() != "") || ($tipospersonasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getDesTipoPersona() != "") {
            $sql.="desTipoPersona";
            if (($tipospersonasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($tipospersonasDto->getCveTipoPersona() != "") {
            $sql.="'" . $tipospersonasDto->getCveTipoPersona() . "'";
            if (($tipospersonasDto->getDesTipoPersona() != "") || ($tipospersonasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getDesTipoPersona() != "") {
            $sql.="'" . $tipospersonasDto->getDesTipoPersona() . "'";
            if (($tipospersonasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getActivo() != "") {
            $sql.="'" . $tipospersonasDto->getActivo() . "'";
        }
        if ($tipospersonasDto->getFechaRegistro() != "") {
            
        }
        if ($tipospersonasDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TipospersonasDTO();
            $tmp->setcveTipoPersona($this->_proveedor->lastID());
            $tmp = $this->selectTipospersonas($tmp, "", $this->_proveedor, null, null);
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

    public function updateTipospersonas($tipospersonasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbltipospersonas SET ";
        if ($tipospersonasDto->getCveTipoPersona() != "") {
            $sql.="cveTipoPersona='" . $tipospersonasDto->getCveTipoPersona() . "'";
            if (($tipospersonasDto->getDesTipoPersona() != "") || ($tipospersonasDto->getActivo() != "") || ($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getDesTipoPersona() != "") {
            $sql.="desTipoPersona='" . $tipospersonasDto->getDesTipoPersona() . "'";
            if (($tipospersonasDto->getActivo() != "") || ($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getActivo() != "") {
            $sql.="activo='" . $tipospersonasDto->getActivo() . "'";
            if (($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tipospersonasDto->getFechaRegistro() . "'";
            if (($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($tipospersonasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tipospersonasDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveTipoPersona='" . $tipospersonasDto->getCveTipoPersona() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new TipospersonasDTO();
            $tmp->setcveTipoPersona($tipospersonasDto->getCveTipoPersona());
            $tmp = $this->selectTipospersonas($tmp, "", $this->_proveedor, null, null);
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

    public function deleteTipospersonas($tipospersonasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbltipospersonas  WHERE cveTipoPersona='" . $tipospersonasDto->getCveTipoPersona() . "'";
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

    public function selectTipospersonas($tipospersonasDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveTipoPersona,desTipoPersona,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbltipospersonas ";
        if (($tipospersonasDto->getCveTipoPersona() != "") || ($tipospersonasDto->getDesTipoPersona() != "") || ($tipospersonasDto->getActivo() != "") || ($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($tipospersonasDto->getCveTipoPersona() != "") {
            $sql.="cveTipoPersona='" . $tipospersonasDto->getCveTipoPersona() . "'";
            if (($tipospersonasDto->getDesTipoPersona() != "") || ($tipospersonasDto->getActivo() != "") || ($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospersonasDto->getDesTipoPersona() != "") {
            if (isset($param["like"]))
                $sql.="desTipoPersona='" . $tipospersonasDto->getDesTipoPersona() . "'";
            else
                $sql.="desTipoPersona like '%" . $tipospersonasDto->getDesTipoPersona() . "%'";
            if (($tipospersonasDto->getActivo() != "") || ($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospersonasDto->getActivo() != "") {
            $sql.="activo='" . $tipospersonasDto->getActivo() . "'";
            if (($tipospersonasDto->getFechaRegistro() != "") || ($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospersonasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $tipospersonasDto->getFechaRegistro() . "'";
            if (($tipospersonasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($tipospersonasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $tipospersonasDto->getFechaActualizacion() . "'";
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
                        $tmp[$contador] = new TipospersonasDTO();
                        $tmp[$contador]->setCveTipoPersona($row["cveTipoPersona"]);
                        $tmp[$contador]->setDesTipoPersona($row["desTipoPersona"]);
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
