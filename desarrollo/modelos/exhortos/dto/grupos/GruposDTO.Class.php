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

class GruposDTO {
    private $CveGrupo;
    private $NomGrupo;
    private $cveSistema;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveGrupo(){
        return $this->CveGrupo;
    }
    public function setCveGrupo($CveGrupo){
        $this->CveGrupo=$CveGrupo;
    }
    public function getNomGrupo(){
        return $this->NomGrupo;
    }
    public function setNomGrupo($NomGrupo){
        $this->NomGrupo=$NomGrupo;
    }
    public function getCveSistema(){
        return $this->cveSistema;
    }
    public function setCveSistema($cveSistema){
        $this->cveSistema=$cveSistema;
    }
    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($activo){
        $this->activo=$activo;
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
        return array("CveGrupo"=>$this->CveGrupo,
"NomGrupo"=>$this->NomGrupo,
"cveSistema"=>$this->cveSistema,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>