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

class JuiciosexhortosDTO {
    private $idJuicioexhorto;
    private $idExhorto;
    private $idExhortoGenerado;
    private $cveJuicio;
    private $otroJuicio;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getIdJuicioexhorto(){
        return $this->idJuicioexhorto;
    }
    public function setIdJuicioexhorto($idJuicioexhorto){
        $this->idJuicioexhorto=$idJuicioexhorto;
    }
    public function getIdExhorto(){
        return $this->idExhorto;
    }
    public function setIdExhorto($idExhorto){
        $this->idExhorto=$idExhorto;
    }
    public function getIdExhortoGenerado(){
        return $this->idExhortoGenerado;
    }
    public function setIdExhortoGenerado($idExhortoGenerado){
        $this->idExhortoGenerado=$idExhortoGenerado;
    }
    public function getCveJuicio(){
        return $this->cveJuicio;
    }
    public function setCveJuicio($cveJuicio){
        $this->cveJuicio=$cveJuicio;
    }
    public function getOtroJuicio(){
        return $this->otroJuicio;
    }
    public function setOtroJuicio($otroJuicio){
        $this->otroJuicio=$otroJuicio;
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
        return array("idJuicioexhorto"=>$this->idJuicioexhorto,
"idExhorto"=>$this->idExhorto,
"idExhortoGenerado"=>$this->idExhortoGenerado,
"cveJuicio"=>$this->cveJuicio,
"otroJuicio"=>$this->otroJuicio,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>