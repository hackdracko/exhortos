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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class AdscripcionesDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertAdscripciones($adscripcionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbladscripciones(";
        if ($adscripcionesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
            if (($adscripcionesDto->getDesAdscripcion() != "") || ($adscripcionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getDesAdscripcion() != "") {
            $sql.="desAdscripcion";
            if (($adscripcionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($adscripcionesDto->getCveAdscripcion() != "") {
            $sql.="'" . $adscripcionesDto->getCveAdscripcion() . "'";
            if (($adscripcionesDto->getDesAdscripcion() != "") || ($adscripcionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getDesAdscripcion() != "") {
            $sql.="'" . $adscripcionesDto->getDesAdscripcion() . "'";
            if (($adscripcionesDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getActivo() != "") {
            $sql.="'" . $adscripcionesDto->getActivo() . "'";
        }
        if ($adscripcionesDto->getFechaRegistro() != "") {
            
        }
        if ($adscripcionesDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
//        echo '\n'.$sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new AdscripcionesDTO();
            $tmp->setcveAdscripcion($this->_proveedor->lastID());
            $tmp = $this->selectAdscripciones($tmp, "", $this->_proveedor, null, null);
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

    public function updateAdscripciones($adscripcionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbladscripciones SET ";
        if ($adscripcionesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $adscripcionesDto->getCveAdscripcion() . "'";
            if (($adscripcionesDto->getDesAdscripcion() != "") || ($adscripcionesDto->getActivo() != "") || ($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getDesAdscripcion() != "") {
            $sql.="desAdscripcion='" . $adscripcionesDto->getDesAdscripcion() . "'";
            if (($adscripcionesDto->getActivo() != "") || ($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getActivo() != "") {
            $sql.="activo='" . $adscripcionesDto->getActivo() . "'";
            if (($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $adscripcionesDto->getFechaRegistro() . "'";
            if (($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($adscripcionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $adscripcionesDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveAdscripcion='" . $adscripcionesDto->getCveAdscripcion() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new AdscripcionesDTO();
            $tmp->setcveAdscripcion($adscripcionesDto->getCveAdscripcion());
            $tmp = $this->selectAdscripciones($tmp, "", $this->_proveedor, null, null);
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

    public function deleteAdscripciones($adscripcionesDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbladscripciones  WHERE cveAdscripcion='" . $adscripcionesDto->getCveAdscripcion() . "'";
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

    public function selectAdscripciones($adscripcionesDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveAdscripcion,desAdscripcion,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
            $sql .= " ";
        }
        $sql .= " FROM tbladscripciones ";
        if (($adscripcionesDto->getCveAdscripcion() != "") || ($adscripcionesDto->getDesAdscripcion() != "") || ($adscripcionesDto->getActivo() != "") || ($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($adscripcionesDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $adscripcionesDto->getCveAdscripcion() . "'";
            if (($adscripcionesDto->getDesAdscripcion() != "") || ($adscripcionesDto->getActivo() != "") || ($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($adscripcionesDto->getDesAdscripcion() != "") {
            if ($param["like"])
                $sql.="desAdscripcion='" . $adscripcionesDto->getDesAdscripcion() . "'";
            else
                $sql.="desAdscripcion like '%" . $adscripcionesDto->getDesAdscripcion() . "%'";
            if (($adscripcionesDto->getActivo() != "") || ($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($adscripcionesDto->getActivo() != "") {
            $sql.="activo='" . $adscripcionesDto->getActivo() . "'";
            if (($adscripcionesDto->getFechaRegistro() != "") || ($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($adscripcionesDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $adscripcionesDto->getFechaRegistro() . "'";
            if (($adscripcionesDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($adscripcionesDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $adscripcionesDto->getFechaActualizacion() . "'";
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
//        if ($param["paginacion"] == false)
//        echo "\n" . $sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                $numField = mysqli_num_fields($this->_proveedor->stmt);
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new AdscripcionesDTO();
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                        $tmp[$contador]->setDesAdscripcion($row["desAdscripcion"]);
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
