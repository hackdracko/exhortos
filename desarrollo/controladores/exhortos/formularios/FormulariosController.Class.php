<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 CONTROLLER
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/formularios/FormulariosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class FormulariosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarFormularios($FormulariosDto) {
        $FormulariosDto->setcveFormulario(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getcveFormulario()))));
        $FormulariosDto->setnomFormulario(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getnomFormulario()))));
        $FormulariosDto->setactivo(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getactivo()))));
        $FormulariosDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getcveSistema()))));
//$FormulariosDto->setruta((str_ireplace("'","",trim($FormulariosDto->getruta()))));
        $FormulariosDto->setdesFormulario(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getdesFormulario()))));
        $FormulariosDto->setorden(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getorden()))));
        $FormulariosDto->setpadre(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getpadre()))));
        $FormulariosDto->setnivel(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getnivel()))));
        $FormulariosDto->setvista(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getvista()))));
        $FormulariosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getfechaRegistro()))));
        $FormulariosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($FormulariosDto->getfechaActualizacion()))));
        return $FormulariosDto;
    }

    public function selectFormularios($FormulariosDto, $proveedor = null) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosDao = new FormulariosDAO();
        $FormulariosDto = $FormulariosDao->selectFormularios($FormulariosDto, $proveedor);
        return $FormulariosDto;
    }

    public function selectFormulariosGeneral($FormulariosDto, $param, $proveedor = null) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosDao = new FormulariosDAO();
        $FormulariosDto = $FormulariosDao->selectFormularioGeneral($FormulariosDto, null, "", $param, null);
        return $FormulariosDto;
    }

    public function insertFormularios($FormulariosDto, $proveedor = null) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosDao = new FormulariosDAO();
        $FormulariosDto = $FormulariosDao->insertFormularios($FormulariosDto, $proveedor);
        return $FormulariosDto;
    }

    public function updateFormularios($FormulariosDto, $proveedor = null) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosDao = new FormulariosDAO();
//$tmpDto = new FormulariosDTO();
//$tmpDto = $FormulariosDao->selectFormularios($FormulariosDto,$proveedor);
//if($tmpDto!=""){//$FormulariosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $FormulariosDto = $FormulariosDao->updateFormularios($FormulariosDto, $proveedor);
        return $FormulariosDto;
//}
//return "";
    }

    public function deleteFormularios($FormulariosDto, $proveedor = null) {
        $FormulariosDto = $this->validarFormularios($FormulariosDto);
        $FormulariosDao = new FormulariosDAO();
        $FormulariosDto = $FormulariosDao->deleteFormularios($FormulariosDto, $proveedor);
        return $FormulariosDto;
    }

    public function getPaginas($FormulariosDto, $param) {

        $FormulariosDao = new FormulariosDAO();
        $numTot = $FormulariosDao->selectFormularioGeneral($FormulariosDto, null, "", $param, " count(cveFormulario) as totalCount ");


        $Pages = (int) $numTot[0] / $param["cantxPag"];
        $restoPages = $numTot[0] % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0] . '",';
        $json .= '"data":[';
        $x = 1;

        if ($totPages > 1) {
            for ($index = 1; $index <= $totPages; $index++) {

                $json .= "{";
                $json .= '"pagina":' . json_encode(utf8_encode($index)) . "";
                $json .= "}";
                $x++;
                if ($x <= ($totPages )) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":{"total":""},';
            $json .= '"total":"' . ($index - 1) . '"';
            $json .= "}";
        }
        return $json;
    }

}

?>