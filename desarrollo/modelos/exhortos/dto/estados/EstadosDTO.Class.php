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

class EstadosDTO {
    private $cveEstado;
    private $desEstado;
    private $urlWebServices;
    private $activo;
    private $fechaRegistro;
    private $fechaActualizacion;
    public function getCveEstado(){
        return $this->cveEstado;
    }
    public function setCveEstado($cveEstado){
        $this->cveEstado=$cveEstado;
    }
    public function getDesEstado(){
        return $this->desEstado;
    }
    public function setDesEstado($desEstado){
        $this->desEstado=$desEstado;
    }
    public function getUrlWebServices(){
        return $this->urlWebServices;
    }
    public function setUrlWebServices($urlWebServices){
        $this->urlWebServices=$urlWebServices;
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
        return array("cveEstado"=>$this->cveEstado,
"desEstado"=>$this->desEstado,
"urlWebServices"=>$this->urlWebServices,
"activo"=>$this->activo,
"fechaRegistro"=>$this->fechaRegistro,
"fechaActualizacion"=>$this->fechaActualizacion);
    }
}
?>