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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class OficialiaDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertOficialia($oficialiaDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbloficialia(";
        if ($oficialiaDto->getCveOficialia() != "") {
            $sql.="cveOficialia";
            if (($oficialiaDto->getDesOficilia() != "") || ($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getDesOficilia() != "") {
            $sql.="desOficilia";
            if (($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveDistrito() != "") {
            $sql.="cveDistrito";
            if (($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio";
            if (($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
            if (($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($oficialiaDto->getCveOficialia() != "") {
            $sql.="'" . $oficialiaDto->getCveOficialia() . "'";
            if (($oficialiaDto->getDesOficilia() != "") || ($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getDesOficilia() != "") {
            $sql.="'" . $oficialiaDto->getDesOficilia() . "'";
            if (($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveDistrito() != "") {
            $sql.="'" . $oficialiaDto->getCveDistrito() . "'";
            if (($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveMunicipio() != "") {
            $sql.="'" . $oficialiaDto->getCveMunicipio() . "'";
            if (($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveAdscripcion() != "") {
            $sql.="'" . $oficialiaDto->getCveAdscripcion() . "'";
            if (($oficialiaDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getActivo() != "") {
            $sql.="'" . $oficialiaDto->getActivo() . "'";
        }
        if ($oficialiaDto->getFechaRegistro() != "") {
            
        }
        if ($oficialiaDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new OficialiaDTO();
            $tmp->setcveOficialia($this->_proveedor->lastID());
            $tmp = $this->selectOficialia($tmp, "", $this->_proveedor, null, null);
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

    public function updateOficialia($oficialiaDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbloficialia SET ";
        if ($oficialiaDto->getCveOficialia() != "") {
            $sql.="cveOficialia='" . $oficialiaDto->getCveOficialia() . "'";
            if (($oficialiaDto->getDesOficilia() != "") || ($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getDesOficilia() != "") {
            $sql.="desOficilia='" . $oficialiaDto->getDesOficilia() . "'";
            if (($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveDistrito() != "") {
            $sql.="cveDistrito='" . $oficialiaDto->getCveDistrito() . "'";
            if (($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio='" . $oficialiaDto->getCveMunicipio() . "'";
            if (($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $oficialiaDto->getCveAdscripcion() . "'";
            if (($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getActivo() != "") {
            $sql.="activo='" . $oficialiaDto->getActivo() . "'";
            if (($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $oficialiaDto->getFechaRegistro() . "'";
            if (($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($oficialiaDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $oficialiaDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveOficialia='" . $oficialiaDto->getCveOficialia() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new OficialiaDTO();
            $tmp->setcveOficialia($oficialiaDto->getCveOficialia());
            $tmp = $this->selectOficialia($tmp, "", $this->_proveedor, null, null);
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

    public function deleteOficialia($oficialiaDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbloficialia  WHERE cveOficialia='" . $oficialiaDto->getCveOficialia() . "'";
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

    public function selectOficialia($oficialiaDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
//        var_dump($orden);
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
            $sql .= " cveOficialia,desOficilia,cveDistrito,cveMunicipio,cveAdscripcion,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbloficialia ";
        if (($oficialiaDto->getCveOficialia() != "") || ($oficialiaDto->getDesOficilia() != "") || ($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($oficialiaDto->getCveOficialia() != "") {
            $sql.="cveOficialia='" . $oficialiaDto->getCveOficialia() . "'";
            if (($oficialiaDto->getDesOficilia() != "") || ($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getDesOficilia() != "") {
            if (isset($param["like"]))
                $sql.="desOficilia='" . $oficialiaDto->getDesOficilia() . "'";
            else
                $sql.="desOficilia like '%" . $oficialiaDto->getDesOficilia() . "%'";
            if (($oficialiaDto->getCveDistrito() != "") || ($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getCveDistrito() != "") {
            $sql.="cveDistrito='" . $oficialiaDto->getCveDistrito() . "'";
            if (($oficialiaDto->getCveMunicipio() != "") || ($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getCveMunicipio() != "") {
            $sql.="cveMunicipio='" . $oficialiaDto->getCveMunicipio() . "'";
            if (($oficialiaDto->getCveAdscripcion() != "") || ($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $oficialiaDto->getCveAdscripcion() . "'";
            if (($oficialiaDto->getActivo() != "") || ($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getActivo() != "") {
            $sql.="activo='" . $oficialiaDto->getActivo() . "'";
            if (($oficialiaDto->getFechaRegistro() != "") || ($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $oficialiaDto->getFechaRegistro() . "'";
            if (($oficialiaDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($oficialiaDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $oficialiaDto->getFechaActualizacion() . "'";
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
//        if ($param == null)
//            echo $sql."\n";
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
                        $tmp[$contador] = new OficialiaDTO();
                        $tmp[$contador]->setCveOficialia($row["cveOficialia"]);
                        $tmp[$contador]->setDesOficilia($row["desOficilia"]);
                        $tmp[$contador]->setCveDistrito($row["cveDistrito"]);
                        $tmp[$contador]->setCveMunicipio($row["cveMunicipio"]);
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
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