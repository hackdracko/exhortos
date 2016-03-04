<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 DTOS
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

class UsuariosDTO {

    private $cveUsuario;
    private $numEmpleado;
    private $cveAdscripcion;
    private $login;
    private $Password;
    private $passwordCifrado;
    private $cveGrupo;
    private $paterno;
    private $materno;
    private $nombre;
    private $activo;
    private $telefono;
    private $email;
    private $fechaRegistro;
    private $fechaActualizacion;

    public function getCveUsuario() {
        return $this->cveUsuario;
    }

    public function setCveUsuario($cveUsuario) {
        $this->cveUsuario = $cveUsuario;
    }

    public function getNumEmpleado() {
        return $this->numEmpleado;
    }

    public function setNumEmpleado($numEmpleado) {
        $this->numEmpleado = $numEmpleado;
    }

    public function getCveAdscripcion() {
        return $this->cveAdscripcion;
    }

    public function setCveAdscripcion($cveAdscripcion) {
        $this->cveAdscripcion = $cveAdscripcion;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    function getPasswordCifrado() {
        return $this->passwordCifrado;
    }

    function setPasswordCifrado($passwordCifrado) {
        $this->passwordCifrado = $passwordCifrado;
    }

    public function getCveGrupo() {
        return $this->cveGrupo;
    }

    public function setCveGrupo($cveGrupo) {
        $this->cveGrupo = $cveGrupo;
    }

    public function getPaterno() {
        return $this->paterno;
    }

    public function setPaterno($paterno) {
        $this->paterno = $paterno;
    }

    public function getMaterno() {
        return $this->materno;
    }

    public function setMaterno($materno) {
        $this->materno = $materno;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    public function toString() {
        return array("cveUsuario" => $this->cveUsuario,
            "numEmpleado" => $this->numEmpleado,
            "cveAdscripcion" => $this->cveAdscripcion,
            "login" => $this->login,
            "Password" => $this->Password,
            "cveGrupo" => $this->cveGrupo,
            "paterno" => $this->paterno,
            "materno" => $this->materno,
            "nombre" => $this->nombre,
            "activo" => $this->activo,
            "telefono" => $this->telefono,
            "email" => $this->email,
            "fechaRegistro" => $this->fechaRegistro,
            "fechaActualizacion" => $this->fechaActualizacion);
    }

}

?>