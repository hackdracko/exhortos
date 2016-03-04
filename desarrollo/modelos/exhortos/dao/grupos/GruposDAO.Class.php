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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/grupos/GruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class GruposDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertGrupos($gruposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblgrupos(";
        if ($gruposDto->getCveGrupo() != "") {
            $sql.="CveGrupo";
            if (($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getNomGrupo() != "") {
            $sql.="NomGrupo";
            if (($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getCveSistema() != "") {
            $sql.="cveSistema";
            if (($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getActivo() != "") {
            $sql.="activo";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($gruposDto->getCveGrupo() != "") {
            $sql.="'" . $gruposDto->getCveGrupo() . "'";
            if (($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getNomGrupo() != "") {
            $sql.="'" . $gruposDto->getNomGrupo() . "'";
            if (($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getCveSistema() != "") {
            $sql.="'" . $gruposDto->getCveSistema() . "'";
            if (($gruposDto->getActivo() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getActivo() != "") {
            $sql.="'" . $gruposDto->getActivo() . "'";
        }
        if ($gruposDto->getFechaRegistro() != "") {
            
        }
        if ($gruposDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new GruposDTO();
            $tmp->setCveGrupo($this->_proveedor->lastID());
            $tmp = $this->selectGrupos($tmp, "", $this->_proveedor, "", null, null);
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

    public function updateGrupos($gruposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblgrupos SET ";
        if ($gruposDto->getCveGrupo() != "") {
            $sql.="CveGrupo='" . $gruposDto->getCveGrupo() . "'";
            if (($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getNomGrupo() != "") {
            $sql.="NomGrupo='" . $gruposDto->getNomGrupo() . "'";
            if (($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $gruposDto->getCveSistema() . "'";
            if (($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getActivo() != "") {
            $sql.="activo='" . $gruposDto->getActivo() . "'";
            if (($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $gruposDto->getFechaRegistro() . "'";
            if (($gruposDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($gruposDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $gruposDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE CveGrupo='" . $gruposDto->getCveGrupo() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new GruposDTO();
            $tmp->setCveGrupo($gruposDto->getCveGrupo());
            $tmp = $this->selectGrupos($tmp, "", $this->_proveedor, "", null, null);
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

    public function deleteGrupos($gruposDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblgrupos  WHERE CveGrupo='" . $gruposDto->getCveGrupo() . "'";
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

    public function selectGrupos($gruposDto, $orden = "", $proveedor = null, $param = null, $fields = null) {
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
            $sql .= " CveGrupo,NomGrupo,cveSistema,activo,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= " FROM tblgrupos ";
        if (($gruposDto->getCveGrupo() != "") || ($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($gruposDto->getCveGrupo() != "") {
            $sql.="CveGrupo='" . $gruposDto->getCveGrupo() . "'";
            if (($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getNomGrupo() != "") {
            if(isset($param["like"]))
                $sql.="NomGrupo='" . $gruposDto->getNomGrupo() . "'";
            else
                $sql.="NomGrupo like '%" . $gruposDto->getNomGrupo() . "%'";    
            if (($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $gruposDto->getCveSistema() . "'";
            if (($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getActivo() != "") {
            $sql.="activo='" . $gruposDto->getActivo() . "'";
            if (($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $gruposDto->getFechaRegistro() . "'";
            if (($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $gruposDto->getFechaActualizacion() . "'";
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
//        if($fields != null)
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
                        $tmp[$contador] = new GruposDTO();
                        $tmp[$contador]->setCveGrupo($row["CveGrupo"]);
                        $tmp[$contador]->setNomGrupo($row["NomGrupo"]);
                        $tmp[$contador]->setCveSistema($row["cveSistema"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
                        //$contador++;
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

    public function selectGruposPerfil($gruposDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT CveGrupo,NomGrupo,cveSistema,activo,fechaRegistro,fechaActualizacion FROM tblgrupos ";
        if (($gruposDto->getCveGrupo() != "") || ($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($gruposDto->getCveGrupo() != "") {
            $sql.="CveGrupo='" . $gruposDto->getCveGrupo() . "'";
            if (($gruposDto->getNomGrupo() != "") || ($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getNomGrupo() != "") {
            $sql.="NomGrupo='" . $gruposDto->getNomGrupo() . "'";
            if (($gruposDto->getCveSistema() != "") || ($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getCveSistema() != "") {
            $sql.="cveSistema='" . $gruposDto->getCveSistema() . "'";
            if (($gruposDto->getActivo() != "") || ($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getActivo() != "") {
            $sql.="activo='" . $gruposDto->getActivo() . "'";
            if (($gruposDto->getFechaRegistro() != "") || ($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $gruposDto->getFechaRegistro() . "'";
            if (($gruposDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($gruposDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $gruposDto->getFechaActualizacion() . "'";
        }
        if ($orden != "") {
            $sql.=$orden;
        } else {
            $sql.="";
        }
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                while ($row = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                    $tmp[$contador] = new GruposDTO();
                    $tmp[$contador]->setCveGrupo($row["CveGrupo"]);
                    $tmp[$contador]->setNomGrupo($row["NomGrupo"]);
                    $tmp[$contador]->setCveSistema($row["cveSistema"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                    $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
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