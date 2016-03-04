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

include_once(dirname(__FILE__) . "/../../../../modelos/exhortos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class UsuariosDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function insertUsuarios($usuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "INSERT INTO tblusuarios(";
        if ($usuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario";
            if (($usuariosDto->getNumEmpleado() != "") || ($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNumEmpleado() != "") {
            $sql.="numEmpleado";
            if (($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion";
            if (($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getLogin() != "") {
            $sql.="login";
            if (($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPassword() != "") {
            $sql.="Password";
            if (($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPasswordCifrado() != "") {
            $sql.="passwordCifrado";
            if (($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveGrupo() != "") {
            $sql.="cveGrupo";
            if (($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPaterno() != "") {
            $sql.="paterno";
            if (($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getMaterno() != "") {
            $sql.="materno";
            if (($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNombre() != "") {
            $sql.="nombre";
            if (($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getActivo() != "") {
            $sql.="activo";
            if (($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getTelefono() != "") {
            $sql.="telefono";
            if (($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getEmail() != "") {
            $sql.="email";
        }
        $sql.=",fechaRegistro";
        $sql.=",fechaActualizacion";
        $sql.=") VALUES(";
        if ($usuariosDto->getCveUsuario() != "") {
            $sql.="'" . $usuariosDto->getCveUsuario() . "'";
            if (($usuariosDto->getNumEmpleado() != "") || ($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNumEmpleado() != "") {
            $sql.="'" . $usuariosDto->getNumEmpleado() . "'";
            if (($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveAdscripcion() != "") {
            $sql.="'" . $usuariosDto->getCveAdscripcion() . "'";
            if (($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getLogin() != "") {
            $sql.="'" . $usuariosDto->getLogin() . "'";
            if (($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPassword() != "") {
            $sql.="'" . $usuariosDto->getPassword() . "'";
            if (($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPasswordCifrado() != "") {
            $sql.="'" . $usuariosDto->getPasswordCifrado() . "'";
            if (($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveGrupo() != "") {
            $sql.="'" . $usuariosDto->getCveGrupo() . "'";
            if (($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPaterno() != "") {
            $sql.="'" . $usuariosDto->getPaterno() . "'";
            if (($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getMaterno() != "") {
            $sql.="'" . $usuariosDto->getMaterno() . "'";
            if (($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNombre() != "") {
            $sql.="'" . $usuariosDto->getNombre() . "'";
            if (($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getActivo() != "") {
            $sql.="'" . $usuariosDto->getActivo() . "'";
            if (($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getTelefono() != "") {
            $sql.="'" . $usuariosDto->getTelefono() . "'";
            if (($usuariosDto->getEmail() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getEmail() != "") {
            $sql.="'" . $usuariosDto->getEmail() . "'";
        }
        if ($usuariosDto->getFechaRegistro() != "") {
            
        }
        if ($usuariosDto->getFechaActualizacion() != "") {
            
        }
        $sql.=",now()";
        $sql.=",now()";
        $sql.=")";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new UsuariosDTO();
            $tmp->setcveUsuario($this->_proveedor->lastID());
            $tmp = $this->selectUsuarios($tmp, "", $this->_proveedor);
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

    public function updateUsuarios($usuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "UPDATE tblusuarios SET ";
        if ($usuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $usuariosDto->getCveUsuario() . "'";
            if (($usuariosDto->getNumEmpleado() != "") || ($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNumEmpleado() != "") {
            $sql.="numEmpleado='" . $usuariosDto->getNumEmpleado() . "'";
            if (($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $usuariosDto->getCveAdscripcion() . "'";
            if (($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getLogin() != "") {
            $sql.="login='" . $usuariosDto->getLogin() . "'";
            if (($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPassword() != "") {
            $sql.="Password='" . $usuariosDto->getPassword() . "'";
            if (($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPasswordCifrado() != "") {
            $sql.="passwordCifrado='" . $usuariosDto->getPasswordCifrado() . "'";
            if (($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getCveGrupo() != "") {
            $sql.="cveGrupo='" . $usuariosDto->getCveGrupo() . "'";
            if (($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getPaterno() != "") {
            $sql.="paterno='" . $usuariosDto->getPaterno() . "'";
            if (($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getMaterno() != "") {
            $sql.="materno='" . $usuariosDto->getMaterno() . "'";
            if (($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getNombre() != "") {
            $sql.="nombre='" . $usuariosDto->getNombre() . "'";
            if (($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getActivo() != "") {
            $sql.="activo='" . $usuariosDto->getActivo() . "'";
            if (($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getTelefono() != "") {
            $sql.="telefono='" . $usuariosDto->getTelefono() . "'";
            if (($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getEmail() != "") {
            $sql.="email='" . $usuariosDto->getEmail() . "'";
            if (($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $usuariosDto->getFechaRegistro() . "'";
            if (($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=",";
            }
        }
        if ($usuariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $usuariosDto->getFechaActualizacion() . "'";
        }
        $sql.=" WHERE cveUsuario='" . $usuariosDto->getCveUsuario() . "'";
        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $tmp = new UsuariosDTO();
            $tmp->setcveUsuario($usuariosDto->getCveUsuario());
            $tmp = $this->selectUsuarios($tmp, "", $this->_proveedor);
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

    public function deleteUsuarios($usuariosDto, $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "DELETE FROM tblusuarios  WHERE cveUsuario='" . $usuariosDto->getCveUsuario() . "'";
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

    public function selectUsuarios($usuariosDto, $orden = "", $proveedor = null) {
        $tmp = "";
        $contador = 0;
        if ($proveedor == null) {
            $this->_conexion(null);
//$this->_proveedor->connect();
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }
        $sql = "SELECT cveUsuario,numEmpleado,cveAdscripcion,login,Password,passwordCifrado,cveGrupo,paterno,materno,nombre,activo,telefono,email,fechaRegistro,fechaActualizacion FROM tblusuarios ";
        if (($usuariosDto->getCveUsuario() != "") || ($usuariosDto->getNumEmpleado() != "") || ($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
            $sql.=" WHERE ";
        }
        if ($usuariosDto->getCveUsuario() != "") {
            $sql.="cveUsuario='" . $usuariosDto->getCveUsuario() . "'";
            if (($usuariosDto->getNumEmpleado() != "") || ($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getNumEmpleado() != "") {
            $sql.="numEmpleado='" . $usuariosDto->getNumEmpleado() . "'";
            if (($usuariosDto->getCveAdscripcion() != "") || ($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getCveAdscripcion() != "") {
            $sql.="cveAdscripcion='" . $usuariosDto->getCveAdscripcion() . "'";
            if (($usuariosDto->getLogin() != "") || ($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getLogin() != "") {
            $sql.="login  COLLATE utf8_bin = '" . $usuariosDto->getLogin() . "'";
            if (($usuariosDto->getPassword() != "") || ($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getPassword() != "") {
            $sql.="Password='" . $usuariosDto->getPassword() . "'";
            if (($usuariosDto->getPasswordCifrado() != "") || ($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getPasswordCifrado() != "") {
            $sql.="passwordCifrado='" . $usuariosDto->getPasswordCifrado() . "'";
            if (($usuariosDto->getCveGrupo() != "") || ($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getCveGrupo() != "") {
            $sql.="cveGrupo='" . $usuariosDto->getCveGrupo() . "'";
            if (($usuariosDto->getPaterno() != "") || ($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getPaterno() != "") {
            $sql.="paterno='" . $usuariosDto->getPaterno() . "'";
            if (($usuariosDto->getMaterno() != "") || ($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getMaterno() != "") {
            $sql.="materno='" . $usuariosDto->getMaterno() . "'";
            if (($usuariosDto->getNombre() != "") || ($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getNombre() != "") {
            $sql.="nombre='" . $usuariosDto->getNombre() . "'";
            if (($usuariosDto->getActivo() != "") || ($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getActivo() != "") {
            $sql.="activo='" . $usuariosDto->getActivo() . "'";
            if (($usuariosDto->getTelefono() != "") || ($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getTelefono() != "") {
            $sql.="telefono='" . $usuariosDto->getTelefono() . "'";
            if (($usuariosDto->getEmail() != "") || ($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getEmail() != "") {
            $sql.="email='" . $usuariosDto->getEmail() . "'";
            if (($usuariosDto->getFechaRegistro() != "") || ($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getFechaRegistro() != "") {
            $sql.="fechaRegistro='" . $usuariosDto->getFechaRegistro() . "'";
            if (($usuariosDto->getFechaActualizacion() != "")) {
                $sql.=" AND ";
            }
        }
        if ($usuariosDto->getFechaActualizacion() != "") {
            $sql.="fechaActualizacion='" . $usuariosDto->getFechaActualizacion() . "'";
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
                    $tmp[$contador] = new UsuariosDTO();
                    $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                    $tmp[$contador]->setNumEmpleado($row["numEmpleado"]);
                    $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                    $tmp[$contador]->setLogin($row["login"]);
                    $tmp[$contador]->setPassword($row["Password"]);
                    $tmp[$contador]->setPasswordCifrado($row["passwordCifrado"]);
                    $tmp[$contador]->setCveGrupo($row["cveGrupo"]);
                    $tmp[$contador]->setPaterno($row["paterno"]);
                    $tmp[$contador]->setMaterno($row["materno"]);
                    $tmp[$contador]->setNombre($row["nombre"]);
                    $tmp[$contador]->setActivo($row["activo"]);
                    $tmp[$contador]->setTelefono($row["telefono"]);
                    $tmp[$contador]->setEmail($row["email"]);
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

    public function consultarEmpleados($param = null, $proveedor = null, $orden = "", $fields = null) {
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
            $sql .= " cveUsuario,numEmpleado,cveAdscripcion,login,Password,passwordCifrado,cveGrupo,paterno,materno,nombre,activo,telefono,email,fechaRegistro,fechaActualizacion ";
        } else {
            $sql .= $fields;
        }
        $sql .= "FROM tblusuarios";

        if ($param['numEmpleado'] != "" || $param['nombre'] != "") {
            $sql .= " WHERE ";
        }

        if ($param['numEmpleado'] != "") {
            $sql .= " numempleado='" . $param['numEmpleado'] . "'";
            if ($param['nombre'] != "") {
                $sql .= " AND ";
            }
        }
        if ($param['nombre'] != "") {
            $sql .= "  CONCAT_WS(' ',nombre,paterno,materno) like '%" . $param['nombre'] . "%'";
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
        $sql.= " order by nombre,materno,paterno DESC";

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
                        $tmp[$contador] = new UsuariosDTO();
                        $tmp[$contador]->setCveUsuario($row["cveUsuario"]);
                        $tmp[$contador]->setNumEmpleado($row["numEmpleado"]);
                        $tmp[$contador]->setCveAdscripcion($row["cveAdscripcion"]);
                        $tmp[$contador]->setLogin($row["login"]);
                        $tmp[$contador]->setPassword($row["Password"]);
                        $tmp[$contador]->setPasswordCifrado($row["passwordCifrado"]);
                        $tmp[$contador]->setCveGrupo($row["cveGrupo"]);
                        $tmp[$contador]->setPaterno($row["paterno"]);
                        $tmp[$contador]->setMaterno($row["materno"]);
                        $tmp[$contador]->setNombre($row["nombre"]);
                        $tmp[$contador]->setActivo($row["activo"]);
                        $tmp[$contador]->setTelefono($row["telefono"]);
                        $tmp[$contador]->setEmail($row["email"]);
                        $tmp[$contador]->setFechaRegistro($row["fechaRegistro"]);
                        $tmp[$contador]->setFechaActualizacion($row["fechaActualizacion"]);
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