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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/contadores/ContadoresDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class ContadoresDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertContadores($contadoresDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblcontadores(";
        if ($contadoresDto->getIdContador() != "") {
            $sql.="idContador";
            if (($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getNumero() != "") {
            $sql.="numero";
            if (($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getAnio() != "") {
            $sql.="anio";
            if (($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado";
            if (($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getActivo() != "") {
            $sql.="activo";
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($contadoresDto->getIdContador() != "") {
            $sql.="'" . $contadoresDto->getIdContador() . "'";
            if (($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getNumero() != "") {
            $sql.="'" . $contadoresDto->getNumero() . "'";
            if (($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getAnio() != "") {
            $sql.="'" . $contadoresDto->getAnio() . "'";
            if (($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveJuzgado() != "") {
            $sql.="'" . $contadoresDto->getCveJuzgado() . "'";
            if (($contadoresDto->getActivo() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getActivo() != "") {
            $sql.="'" . $contadoresDto->getActivo() . "'";
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getFechaRegistro() != "") {
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getFechaActualizacion() != "") {
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveTipoActuacion() == "null") {
            $sql.="" . $contadoresDto->getCveTipoActuacion() . "";
        }
        else if ($contadoresDto->getCveTipoActuacion() != "") {
            $sql.="'" . $contadoresDto->getCveTipoActuacion() . "'";
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
       // echo $sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ContadoresDTO();
            $tmp->setidContador($this->_proveedor->lastID());
            $tmp = $this->selectContadores($tmp, "", $this->_proveedor);
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

    public function updateContadores($contadoresDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblcontadores SET ";
        if ($contadoresDto->getIdContador() != "") {
            $sql.="idContador='" . $contadoresDto->getIdContador() . "'";
            if (($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getNumero() != "") {
            $sql.="numero='" . $contadoresDto->getNumero() . "'";
            if (($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getAnio() != "") {
            $sql.="anio='" . $contadoresDto->getAnio() . "'";
            if (($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $contadoresDto->getCveJuzgado() . "'";
            if (($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getActivo() != "") {
            $sql.="activo='" . $contadoresDto->getActivo() . "'";
            if (($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $contadoresDto->getFechaRegistro() . "'";
            if (($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $contadoresDto->getFechaActualizacion() . "'";
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=",";
            }
        }
        if ($contadoresDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $contadoresDto->getCveTipoActuacion() . "'";
        }
        $sql.=" WHERE idContador='" . $contadoresDto->getIdContador() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new ContadoresDTO();
            $tmp->setidContador($contadoresDto->getIdContador());
            $tmp = $this->selectContadores($tmp, "", $this->_proveedor);
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

    public function deleteContadores($contadoresDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblcontadores  WHERE idContador='" . $contadoresDto->getIdContador() . "'";
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

    public function selectContadores($contadoresDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT idContador,numero,anio,cveJuzgado,activo,fechaRegistro,fechaActualizacion,cveTipoActuacion FROM tblcontadores ";
        if (($contadoresDto->getIdContador() != "") || ($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($contadoresDto->getIdContador() != "") {
            $sql.="idContador='" . $contadoresDto->getIdContador() . "'";
            if (($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getNumero() != "") {
            $sql.="numero='" . $contadoresDto->getNumero() . "'";
            if (($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getAnio() != "") {
            $sql.="anio='" . $contadoresDto->getAnio() . "'";
            if (($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $contadoresDto->getCveJuzgado() . "'";
            if (($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getActivo() != "") {
            $sql.="activo='" . $contadoresDto->getActivo() . "'";
            if (($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $contadoresDto->getFechaRegistro() . "'";
            if (($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $contadoresDto->getFechaActualizacion() . "'";
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getCveTipoActuacion() == "null") {

            $sql.="cveTipoActuacion is null ";
        }
        else if ($contadoresDto->getCveTipoActuacion() != "") {

            $sql.="cveTipoActuacion='" . $contadoresDto->getCveTipoActuacion() . "'";
        }
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
       // echo $sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    $tmp[$contador] = new ContadoresDTO();
                    $tmp[$contador]->setIdContador($row["idContador"]);
                    $tmp[$contador]->setNumero($row["numero"]);
                    $tmp[$contador]->setAnio($row["anio"]);
                    $tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                    $tmp[$contador]->setCveTipoActuacion($row["cveTipoActuacion"]);
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

    public function selectContadoresGeneral($contadoresDto, $proveedor = null, $orden = "", $param = null, $fields = null) {
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
            $sql .= " idContador,numero,anio,cveJuzgado,activo,fechaRegistro,fechaActualizacion,cveTipoActuacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblcontadores";

        if (($contadoresDto->getIdContador() != "") || ($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($contadoresDto->getIdContador() != "") {
            $sql.="idContador='" . $contadoresDto->getIdContador() . "'";
            if (($contadoresDto->getNumero() != "") || ($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getNumero() != "") {
            $sql.="numero='" . $contadoresDto->getNumero() . "'";
            if (($contadoresDto->getAnio() != "") || ($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getAnio() != "") {
            $sql.="anio='" . $contadoresDto->getAnio() . "'";
            if (($contadoresDto->getCveJuzgado() != "") || ($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getCveJuzgado() != "") {
            $sql.="cveJuzgado='" . $contadoresDto->getCveJuzgado() . "'";
            if (($contadoresDto->getActivo() != "") || ($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getActivo() != "") {
            $sql.="activo='" . $contadoresDto->getActivo() . "'";
            if (($contadoresDto->getFechaRegistro() != "") || ($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $contadoresDto->getFechaRegistro() . "'";
            if (($contadoresDto->getFechaActualizacion() != "") || ($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $contadoresDto->getFechaActualizacion() . "'";
            if (($contadoresDto->getCveTipoActuacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($contadoresDto->getCveTipoActuacion() != "") {
            $sql.="cveTipoActuacion='" . $contadoresDto->getCveTipoActuacion() . "'";
        }
        if ($param != "") {
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
        $sql.= " order by idContador DESC";

        if ($param != "" || $param != null) {
            if ($param["paginacion"] == "true") {
                $sql.=" LIMIT " . $inicial . "," . $param["cantxPag"];
            }
        }
//        echo $sql;
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    if ($fields === null) {
                        $tmp[$contador] = new ContadoresDTO();
                        $tmp[$contador]->setIdContador($row["idContador"]);
                        $tmp[$contador]->setNumero($row["numero"]);
                        $tmp[$contador]->setAnio($row["anio"]);
                        $tmp[$contador]->setCveJuzgado($row["cveJuzgado"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        $tmp[$contador]->setCveTipoActuacion($row["cveTipoActuacion"]);
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