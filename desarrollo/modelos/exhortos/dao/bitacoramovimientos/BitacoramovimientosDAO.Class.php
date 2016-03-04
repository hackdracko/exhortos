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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class BitacoramovimientosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertBitacoramovimientos($bitacoramovimientosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblbitacoramovimientos(";
        if ($bitacoramovimientosDto->getIdBitacoraMovimiento() != "") {
            $sql.="idBitacoraMovimiento";
            if (($bitacoramovimientosDto->getCveAccion() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAccion() != "") {
            $sql.="cveAccion";
            if (($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getObservaciones() != "") {
            $sql.="observaciones";
            if (($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveUsuario() != "") {
            $sql.="cveUsuario";
            if (($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCvePerfil() != "") {
            $sql.="cvePerfil";
            if (($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
        }
        $sql .= ", fechaMovimiento";
        $sql.=") VALUES(";
        if ($bitacoramovimientosDto->getIdBitacoraMovimiento() != "") {
            $sql.="'" . $bitacoramovimientosDto->getIdBitacoraMovimiento() . "'";
            if (($bitacoramovimientosDto->getCveAccion() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAccion() != "") {
            $sql.="'" . $bitacoramovimientosDto->getCveAccion() . "'";
            if (($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getObservaciones() != "") {
            $sql.="'" . $bitacoramovimientosDto->getObservaciones() . "'";
            if (($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveUsuario() != "") {
            $sql.="'" . $bitacoramovimientosDto->getCveUsuario() . "'";
            if (($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCvePerfil() != "") {
            $sql.="'" . $bitacoramovimientosDto->getCvePerfil() . "'";
            if (($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAdscripcion() != "") {
            $sql.="'" . $bitacoramovimientosDto->getCveAdscripcion() . "'";
        }
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new BitacoramovimientosDTO();
            $tmp->setidBitacoraMovimiento($this->_proveedor->lastID());
            $tmp = $this->selectBitacoramovimientos($tmp, $this->_proveedor, "", null, null);
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

    public function updateBitacoramovimientos($bitacoramovimientosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblbitacoramovimientos SET ";
        if ($bitacoramovimientosDto->getIdBitacoraMovimiento() != "") {
            $sql.="idBitacoraMovimiento='" . $bitacoramovimientosDto->getIdBitacoraMovimiento() . "'";
            if (($bitacoramovimientosDto->getCveAccion() != "") || ($bitacoramovimientosDto->getFechaMovimiento() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAccion() != "") {
            $sql.="cveAccion='" . $bitacoramovimientosDto->getCveAccion() . "'";
            if (($bitacoramovimientosDto->getFechaMovimiento() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getFechaMovimiento() != "") {
            $sql.="fechaMovimiento='" . $bitacoramovimientosDto->getFechaMovimiento() . "'";
            if (($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getObservaciones() != "") {
            $sql.="observaciones='" . $bitacoramovimientosDto->getObservaciones() . "'";
            if (($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $bitacoramovimientosDto->getCveUsuario() . "'";
            if (($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $bitacoramovimientosDto->getCvePerfil() . "'";
            if (($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=",";
            }
        }
        if ($bitacoramovimientosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $bitacoramovimientosDto->getCveAdscripcion() . "'";
        }
        $sql.=" WHERE idBitacoraMovimiento='" . $bitacoramovimientosDto->getIdBitacoraMovimiento() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new BitacoramovimientosDTO();
            $tmp->setidBitacoraMovimiento($bitacoramovimientosDto->getIdBitacoraMovimiento());
            $tmp = $this->selectBitacoramovimientos($tmp, $this->_proveedor, "", null, null);
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

    public function deleteBitacoramovimientos($bitacoramovimientosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblbitacoramovimientos  WHERE idBitacoraMovimiento='" . $bitacoramovimientosDto->getIdBitacoraMovimiento() . "'";
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

    public function selectBitacoramovimientos($bitacoramovimientosDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }

        $sql = "SELECT ";
        if ($fields === null) {
            $sql .= " idBitacoraMovimiento,cveAccion,fechaMovimiento,observaciones,cveUsuario,cvePerfil,cveAdscripcion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblbitacoramovimientos";

        if (($bitacoramovimientosDto->getIdBitacoraMovimiento() != "") || ($bitacoramovimientosDto->getCveAccion() != "") || ($bitacoramovimientosDto->getFechaMovimiento() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
            $sql.=" WHERE ";
        }
        if ($bitacoramovimientosDto->getIdBitacoraMovimiento() != "") {
            $sql.="idBitacoraMovimiento='" . $bitacoramovimientosDto->getIdBitacoraMovimiento() . "'";
            if (($bitacoramovimientosDto->getCveAccion() != "") || ($bitacoramovimientosDto->getFechaMovimiento() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getCveAccion() != "") {
            $sql.="cveAccion='" . $bitacoramovimientosDto->getCveAccion() . "'";
            if (($bitacoramovimientosDto->getFechaMovimiento() != "") || ($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getFechaMovimiento() != "") {
            $sql.="fechaMovimiento='" . $bitacoramovimientosDto->getFechaMovimiento() . "'";
            if (($bitacoramovimientosDto->getObservaciones() != "") || ($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getObservaciones() != "") {
            $sql.="observaciones='" . $bitacoramovimientosDto->getObservaciones() . "'";
            if (($bitacoramovimientosDto->getCveUsuario() != "") || ($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $bitacoramovimientosDto->getCveUsuario() . "'";
            if (($bitacoramovimientosDto->getCvePerfil() != "") || ($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getCvePerfil() != "") {
            $sql.="cvePerfil='" . $bitacoramovimientosDto->getCvePerfil() . "'";
            if (($bitacoramovimientosDto->getCveAdscripcion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($bitacoramovimientosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $bitacoramovimientosDto->getCveAdscripcion() . "'";
        }

        if ($param != "") {

            if ($param['fechaInicialConsulta'] != "" && $param['fechaInicialConsulta'] != 0 &&
                    $param['fechaFinalConsulta'] != "" && $param['fechaFinalConsulta'] != 0) {
                if ($param['fechaInicialConsulta'] == $param['fechaFinalConsulta']) {
                    $sql.= " AND fechaMovimiento >= '" . $param['fechaInicialConsulta'] . " 00:00:00'";
                    $sql.= " AND fechaMovimiento <= '" . $param['fechaInicialConsulta'] . " 23:59:59'";
                } else {
                    $sql.= " AND fechaMovimiento >= '" . $param['fechaInicialConsulta'] . " 00:00:00'";
                    $sql.= " AND fechaMovimiento <= '" . $param['fechaFinalConsulta'] . " 23:59:59'";
                }
            }

            if ($param["paginacion"] == "true") {
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
        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "true") {
                $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
            }
        }

        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new BitacoramovimientosDTO();
                        $tmp[$contador]->setIdBitacoraMovimiento($row["idBitacoraMovimiento"]);
                        $tmp[$contador]->setCveAccion($row["cveAccion"]);
                        $tmp[$contador]->setFechaMovimiento($row["fechaMovimiento"]);
                        $tmp[$contador]->setObservaciones($row["observaciones"]);
                        $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                        $tmp[$contador]->setCvePerfil($row["cvePerfil"]);
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                        $contador++;
                    } else {
                        $tmp[$contador] = $row["totalCount"];
                        $contador++;
                    }
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