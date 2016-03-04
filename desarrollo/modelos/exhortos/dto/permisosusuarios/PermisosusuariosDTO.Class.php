<?php
 /*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 DTOS
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

class PermisosusuariosDTO {
    private $cvePermisoUsuario;
    private $cveUsuario;
    private $cveSistema;
    private $cveFormulario;
    private $cvePerfil;
    private $consulta;
    private $modificar;
    private $eliminar;
    private $registrar;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCvePermisoUsuario(){
        return $this->cvePermisoUsuario;
    }
    public function setCvePermisoUsuario($cvePermisoUsuario){
        $this->cvePermisoUsuario=$cvePermisoUsuario;
    }
    public function getCveUsuario(){
        return $this->cveUsuario;
    }
    public function setCveUsuario($cveUsuario){
        $this->cveUsuario=$cveUsuario;
    }
    public function getCveSistema(){
        return $this->cveSistema;
    }
    public function setCveSistema($cveSistema){
        $this->cveSistema=$cveSistema;
    }
    public function getCveFormulario(){
        return $this->cveFormulario;
    }
    public function setCveFormulario($cveFormulario){
        $this->cveFormulario=$cveFormulario;
    }
    public function getCvePerfil(){
        return $this->cvePerfil;
    }
    public function setCvePerfil($cvePerfil){
        $this->cvePerfil=$cvePerfil;
    }
    public function getConsulta(){
        return $this->consulta;
    }
    public function setConsulta($consulta){
        $this->consulta=$consulta;
    }
    public function getModificar(){
        return $this->modificar;
    }
    public function setModificar($modificar){
        $this->modificar=$modificar;
    }
    public function getEliminar(){
        return $this->eliminar;
    }
    public function setEliminar($eliminar){
        $this->eliminar=$eliminar;
    }
    public function getRegistrar(){
        return $this->registrar;
    }
    public function setRegistrar($registrar){
        $this->registrar=$registrar;
    }
    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }
    public function setFechaRegistro($fechaRegistro){
        $this->fechaRegistro=$fechaRegistro;
    }
    public function getFechaActualizacion(){
        return $this->fechaActualizacion;
    }
    public function setFechaActualizacion($fechaActualizacion){
        $this->fechaActualizacion=$fechaActualizacion;
    }
    public function toString(){
        return array("cvePermisoUsuario"=>$this->cvePermisoUsuario,
"cveUsuario"=>$this->cveUsuario,
"cveSistema"=>$this->cveSistema,
"cveFormulario"=>$this->cveFormulario,
"cvePerfil"=>$this->cvePerfil,
"consulta"=>$this->consulta,
"modificar"=>$this->modificar,
"eliminar"=>$this->eliminar,
"registrar"=>$this->registrar,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>