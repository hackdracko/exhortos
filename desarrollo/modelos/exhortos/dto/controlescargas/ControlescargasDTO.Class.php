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

class ControlescargasDTO {
    private $idControlCarga;
    private $cveConfiguracionCarga;
    private $cveMateria;
    private $cveJuicio;
    private $cveCuantia;
    private $cveJuzgado;
    private $totalAsignados;
    private $anioControl;
    public function getIdControlCarga(){
        return $this->idControlCarga;
    }
    public function setIdControlCarga($idControlCarga){
        $this->idControlCarga=$idControlCarga;
    }
    public function getCveConfiguracionCarga(){
        return $this->cveConfiguracionCarga;
    }
    public function setCveConfiguracionCarga($cveConfiguracionCarga){
        $this->cveConfiguracionCarga=$cveConfiguracionCarga;
    }
    public function getCveMateria(){
        return $this->cveMateria;
    }
    public function setCveMateria($cveMateria){
        $this->cveMateria=$cveMateria;
    }
    public function getCveJuicio(){
        return $this->cveJuicio;
    }
    public function setCveJuicio($cveJuicio){
        $this->cveJuicio=$cveJuicio;
    }
    public function getCveCuantia(){
        return $this->cveCuantia;
    }
    public function setCveCuantia($cveCuantia){
        $this->cveCuantia=$cveCuantia;
    }
    public function getCveJuzgado(){
        return $this->cveJuzgado;
    }
    public function setCveJuzgado($cveJuzgado){
        $this->cveJuzgado=$cveJuzgado;
    }
    public function getTotalAsignados(){
        return $this->totalAsignados;
    }
    public function setTotalAsignados($totalAsignados){
        $this->totalAsignados=$totalAsignados;
    }
    public function getAnioControl(){
        return $this->anioControl;
    }
    public function setAnioControl($anioControl){
        $this->anioControl=$anioControl;
    }
    public function toString(){
        return array("idControlCarga"=>$this->idControlCarga,
"cveConfiguracionCarga"=>$this->cveConfiguracionCarga,
"cveMateria"=>$this->cveMateria,
"cveJuicio"=>$this->cveJuicio,
"cveCuantia"=>$this->cveCuantia,
"cveJuzgado"=>$this->cveJuzgado,
"totalAsignados"=>$this->totalAsignados,
"anioControl"=>$this->anioControl);
    }
}
?>