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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/sistemas/SistemasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/sistemas/SistemasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class SistemasController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarSistemas($SistemasDto) {
        $SistemasDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($SistemasDto->getcveSistema()))));
        $SistemasDto->setnomSistema(strtoupper(str_ireplace("'", "", trim($SistemasDto->getnomSistema()))));
        $SistemasDto->setactivo(strtoupper(str_ireplace("'", "", trim($SistemasDto->getactivo()))));
        $SistemasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($SistemasDto->getfechaRegistro()))));
        $SistemasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($SistemasDto->getfechaActualizacion()))));
        return $SistemasDto;
    }

    public function selectSistemas($SistemasDto, $proveedor = null) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasDao = new SistemasDAO();
        $SistemasDto = $SistemasDao->selectSistemas($SistemasDto, $proveedor);
        return $SistemasDto;
    }

    public function insertSistemas($SistemasDto, $proveedor = null) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasDao = new SistemasDAO();
        $SistemasDto = $SistemasDao->insertSistemas($SistemasDto, $proveedor);
        return $SistemasDto;
    }

    public function updateSistemas($SistemasDto, $proveedor = null) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasDao = new SistemasDAO();
//$tmpDto = new SistemasDTO();
//$tmpDto = $SistemasDao->selectSistemas($SistemasDto,$proveedor);
//if($tmpDto!=""){//$SistemasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $SistemasDto = $SistemasDao->updateSistemas($SistemasDto, $proveedor);
        return $SistemasDto;
//}
//return "";
    }

    public function deleteSistemas($SistemasDto, $proveedor = null) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasDao = new SistemasDAO();
        $SistemasDto = $SistemasDao->deleteSistemas($SistemasDto, $proveedor);
        return $SistemasDto;
    }

    public function selectSistemasGeneral($SistemasDto, $param, $proveedor = null) {
        $SistemasDto = $this->validarSistemas($SistemasDto);
        $SistemasDao = new SistemasDAO();
        $SistemasDto = $SistemasDao->selectSistemasGeneral($SistemasDto, null, "", $param, null);
        return $SistemasDto;
    }

    public function getPaginas($SistemasDto, $param) {

        $SistemasDao = new SistemasDAO();
        $numTot = $SistemasDao->selectSistemasGeneral($SistemasDto, null, "", $param, " count(cveSistema) as totalCount ");
//        print_r($param);
        $Pages = (int) $numTot[0] / $param["cantxPag"];
        $restoPages = $numTot[0] % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0] . '",';
        $json .= '"data":[';
        $x = 1;

        if ($totPages >= 1) {
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