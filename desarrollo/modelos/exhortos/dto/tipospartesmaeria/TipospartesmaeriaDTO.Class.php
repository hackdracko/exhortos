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

class TipospartesmaeriaDTO {
    private $idTipoParteMateria;
    private $cveTipoParte;
    private $cveMateria;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdTipoParteMateria(){
        return $this->idTipoParteMateria;
    }
    public function setIdTipoParteMateria($idTipoParteMateria){
        $this->idTipoParteMateria=$idTipoParteMateria;
    }
    public function getCveTipoParte(){
        return $this->cveTipoParte;
    }
    public function setCveTipoParte($cveTipoParte){
        $this->cveTipoParte=$cveTipoParte;
    }
    public function getCveMateria(){
        return $this->cveMateria;
    }
    public function setCveMateria($cveMateria){
        $this->cveMateria=$cveMateria;
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
        return array("idTipoParteMateria"=>$this->idTipoParteMateria,
"cveTipoParte"=>$this->cveTipoParte,
"cveMateria"=>$this->cveMateria,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>