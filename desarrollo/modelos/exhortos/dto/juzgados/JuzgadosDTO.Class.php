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

class JuzgadosDTO {

    private $cveJuzgado;
    private $desJuzgado;
    private $cveOficialia;
    private $cveAdscripcion;
    private $proporcion;
    private $asignados;
    private $control;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;

    public function getCveJuzgado() {
        return $this->cveJuzgado;
    }

    public function setCveJuzgado($cveJuzgado) {
        $this->cveJuzgado = $cveJuzgado;
    }

    public function getDesJuzgado() {
        return $this->desJuzgado;
    }

    public function setDesJuzgado($desJuzgado) {
        $this->desJuzgado = $desJuzgado;
    }

    public function getCveOficialia() {
        return $this->cveOficialia;
    }

    public function setCveOficialia($cveOficialia) {
        $this->cveOficialia = $cveOficialia;
    }

    public function getCveAdscripcion() {
        return $this->cveAdscripcion;
    }

    public function setCveAdscripcion($cveAdscripcion) {
        $this->cveAdscripcion = $cveAdscripcion;
    }

    public function getProporcion() {
        return $this->proporcion;
    }

    public function setProporcion($proporcion) {
        $this->proporcion = $proporcion;
    }

    public function getAsignados() {
        return $this->asignados;
    }

    public function setAsignados($asignados) {
        $this->asignados = $asignados;
    }

    public function getControl() {
        return $this->control;
    }

    public function setControl($control) {
        $this->control = $control;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
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
        return array("cveJuzgado" => $this->cveJuzgado,
            "desJuzgado" => $this->desJuzgado,
            "cveOficialia" => $this->cveOficialia,
            "cveAdscripcion" => $this->cveAdscripcion,
            "proporcion" => $this->proporcion,
            "asignados" => $this->asignados,
            "control" => $this->control,
            "activo" => $this->activo,
            "fechaRegistro" => $this->fechaRegistro,
            "fechaActualizacion" => $this->fechaActualizacion);
    }

}

?>