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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class JuzgadosmateriasDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertJuzgadosmaterias($juzgadosmateriasDto, $proveedor = null) {
//        print_r($juzgadosmateriasDto );
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tbljuzgadosmaterias(";
        if ($juzgadosmateriasDto->getCveJuzgadoMateria() != "") {
            $sql.="cveJuzgadoMateria";
            if (($juzgadosmateriasDto->getCveJuzgado() != "") || ($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado";
            if (($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveMateria() != "") {
            $sql.="cveMateria";
            if (($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveCuantia() != "") {
            $sql.="cveCuantia";
            if (($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveTipo() != "") {
            $sql.="cveTipo";
            if (($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($juzgadosmateriasDto->getCveJuzgadoMateria() != "") {
            $sql.="'" . $juzgadosmateriasDto->getCveJuzgadoMateria() . "'";
            if (($juzgadosmateriasDto->getCveJuzgado() != "") || ($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveJuzgado() != "") {
            $sql.="'" . $juzgadosmateriasDto->getCveJuzgado() . "'";
            if (($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveMateria() != "") {
            $sql.="'" . $juzgadosmateriasDto->getCveMateria() . "'";
            if (($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveCuantia() != "") {
            $sql.="'" . $juzgadosmateriasDto->getCveCuantia() . "'";
            if (($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveTipo() != "") {
            $sql.="'" . $juzgadosmateriasDto->getCveTipo() . "'";
            if (($juzgadosmateriasDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getActivo() != "") {
            $sql.="'" . $juzgadosmateriasDto->getActivo() . "'";
        }
        if ($juzgadosmateriasDto->getFechaRegistro() != "") {
            
        }
        if ($juzgadosmateriasDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
//        echo "\n\n".$sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuzgadosmateriasDTO();
            $tmp->setcveJuzgadoMateria($this->_proveedor->lastID());
            $tmp = $this->selectJuzgadosmaterias($tmp, "", $this->_proveedor, null, null);
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

    public function updateJuzgadosmaterias($juzgadosmateriasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tbljuzgadosmaterias SET ";
        if ($juzgadosmateriasDto->getCveJuzgadoMateria() != "") {
            $sql.="cveJuzgadoMateria='" . $juzgadosmateriasDto->getCveJuzgadoMateria() . "'";
            if (($juzgadosmateriasDto->getCveJuzgado() != "") || ($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $juzgadosmateriasDto->getCveJuzgado() . "'";
            if (($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $juzgadosmateriasDto->getCveMateria() . "'";
            if (($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $juzgadosmateriasDto->getCveCuantia() . "'";
            if (($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $juzgadosmateriasDto->getCveTipo() . "'";
            if (($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getActivo() != "") {
            $sql.="activo='" . $juzgadosmateriasDto->getActivo() . "'";
            if (($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juzgadosmateriasDto->getFechaRegistro() . "'";
            if (($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($juzgadosmateriasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juzgadosmateriasDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveJuzgadoMateria='" . $juzgadosmateriasDto->getCveJuzgadoMateria() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new JuzgadosmateriasDTO();
            $tmp->setcveJuzgadoMateria($juzgadosmateriasDto->getCveJuzgadoMateria());
            $tmp = $this->selectJuzgadosmaterias($tmp, "", $this->_proveedor, null, null);
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

    public function deleteJuzgadosmaterias($juzgadosmateriasDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tbljuzgadosmaterias  WHERE cveJuzgadoMateria='" . $juzgadosmateriasDto->getCveJuzgadoMateria() . "'";
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

    public function selectJuzgadosmaterias($juzgadosmateriasDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " cveJuzgadoMateria,cveJuzgado,cveMateria,cveCuantia,cveTipo,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tbljuzgadosmaterias ";
        if (($juzgadosmateriasDto->getCveJuzgadoMateria() != "") || ($juzgadosmateriasDto->getCveJuzgado() != "") || ($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($juzgadosmateriasDto->getCveJuzgadoMateria() != "") {
            $sql.="cveJuzgadoMateria='" . $juzgadosmateriasDto->getCveJuzgadoMateria() . "'";
            if (($juzgadosmateriasDto->getCveJuzgado() != "") || ($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado in (" . $juzgadosmateriasDto->getCveJuzgado() . ")";
            if (($juzgadosmateriasDto->getCveMateria() != "") || ($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getCveMateria() != "") {
            $sql.="cveMateria='" . $juzgadosmateriasDto->getCveMateria() . "'";
            if (($juzgadosmateriasDto->getCveCuantia() != "") || ($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getCveCuantia() != "") {
            $sql.="cveCuantia='" . $juzgadosmateriasDto->getCveCuantia() . "'";
            if (($juzgadosmateriasDto->getCveTipo() != "") || ($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getCveTipo() != "") {
            $sql.="cveTipo='" . $juzgadosmateriasDto->getCveTipo() . "'";
            if (($juzgadosmateriasDto->getActivo() != "") || ($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getActivo() != "") {
            $sql.="activo='" . $juzgadosmateriasDto->getActivo() . "'";
            if (($juzgadosmateriasDto->getFechaRegistro() != "") || ($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $juzgadosmateriasDto->getFechaRegistro() . "'";
            if (($juzgadosmateriasDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($juzgadosmateriasDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $juzgadosmateriasDto->getFechaActualizacion() . "'";
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
        error_log($sql);
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
                        $tmp[$contador] = new JuzgadosmateriasDTO();
                        $tmp[$contador]->setCveJuzgadoMateria($row["cveJuzgadoMateria"]);
                        $tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
                        $tmp[$contador]->setCveMateria($row["cveMateria"]);
                        $tmp[$contador]->setCveCuantia($row["cveCuantia"]);
                        $tmp[$contador]->setCveTipo($row["cveTipo"]);
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