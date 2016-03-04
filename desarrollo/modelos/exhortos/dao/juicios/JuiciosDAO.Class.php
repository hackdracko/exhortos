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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/juicios/JuiciosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class JuiciosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertJuicios($juiciosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbljuicios(";
        if ($juiciosDto->getCveJuicio() != "") {
            $sql.="cveJuicio";
            if (($juiciosDto->getCveMateria() != "") || ($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getCveMateria() != "") {
            $sql.="cveMateria";
            if (($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getDesJuicioDelito() != "") {
            $sql.="desJuicioDelito";
            if (($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getFundamento() != "") {
            $sql.="fundamento";
            if (($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($juiciosDto->getCveJuicio() != "") {
            $sql.="'" . $juiciosDto->getCveJuicio() . "'";
            if (($juiciosDto->getCveMateria() != "") || ($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getCveMateria() != "") {
            $sql.="'" . $juiciosDto->getCveMateria() . "'";
            if (($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getDesJuicioDelito() != "") {
            $sql.="'" . $juiciosDto->getDesJuicioDelito() . "'";
            if (($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getFundamento() != "") {
            $sql.="'" . $juiciosDto->getFundamento() . "'";
            if (($juiciosDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getActivo() != "") {
            $sql.="'" . $juiciosDto->getActivo() . "'";
        }
        if ($juiciosDto->getFechaRegistro() != "") {
            
        }
        if ($juiciosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuiciosDTO();
            $tmp->setcveJuicio($this->_proveedor->lastID());
            $tmp = $this->selectJuicios($tmp, "", $this->_proveedor);
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

    public function updateJuicios($juiciosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbljuicios SET ";
        if ($juiciosDto->getCveJuicio() != "") {
            $sql.="cveJuicio='" . $juiciosDto->getCveJuicio() . "'";
            if (($juiciosDto->getCveMateria() != "") || ($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $juiciosDto->getCveMateria() . "'";
            if (($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getDesJuicioDelito() != "") {
            $sql.="desJuicioDelito='" . $juiciosDto->getDesJuicioDelito() . "'";
            if (($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getFundamento() != "") {
            $sql.="fundamento='" . $juiciosDto->getFundamento() . "'";
            if (($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getActivo() != "") {
            $sql.="activo='" . $juiciosDto->getActivo() . "'";
            if (($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juiciosDto->getFechaRegistro() . "'";
            if (($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juiciosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juiciosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveJuicio='" . $juiciosDto->getCveJuicio() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuiciosDTO();
            $tmp->setcveJuicio($juiciosDto->getCveJuicio());
            $tmp = $this->selectJuicios($tmp, "", $this->_proveedor);
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

    public function deleteJuicios($juiciosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbljuicios  WHERE cveJuicio='" . $juiciosDto->getCveJuicio() . "'";
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

    public function selectJuicios($juiciosDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveJuicio,cveMateria,desJuicioDelito,fundamento,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbljuicios ";
        if (($juiciosDto->getCveJuicio() != "") || ($juiciosDto->getCveMateria() != "") || ($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($juiciosDto->getCveJuicio() != "") {
            $sql.="cveJuicio='" . $juiciosDto->getCveJuicio() . "'";
            if (($juiciosDto->getCveMateria() != "") || ($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $juiciosDto->getCveMateria() . "'";
            if (($juiciosDto->getDesJuicioDelito() != "") || ($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getDesJuicioDelito() != "") {
            if (isset($param["like"]))
                $sql.="desJuicioDelito='" . $juiciosDto->getDesJuicioDelito() . "'";
            else
                $sql.="desJuicioDelito like '%" . $juiciosDto->getDesJuicioDelito() . "%'";
            if (($juiciosDto->getFundamento() != "") || ($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getFundamento() != "") {
            $sql.="fundamento='" . $juiciosDto->getFundamento() . "'";
            if (($juiciosDto->getActivo() != "") || ($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getActivo() != "") {
            $sql.="activo='" . $juiciosDto->getActivo() . "'";
            if (($juiciosDto->getFechaRegistro() != "") || ($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juiciosDto->getFechaRegistro() . "'";
            if (($juiciosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juiciosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juiciosDto->getFechaActualizacion() . "'";
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
//        echo  "\n".$sql;
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
                        $tmp[$contador] = new JuiciosDTO();
                        $tmp[$contador]->setCveJuicio($row["cveJuicio"]);
                        $tmp[$contador]->setCveMateria($row["cveMateria"]);
                        $tmp[$contador]->setDesJuicioDelito($row["desJuicioDelito"]);
                        $tmp[$contador]->setFundamento($row["fundamento"]);
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
//        var_dump($tmp);
        unset($contador);
        unset($sql);
        return $tmp;
    }

}

?>