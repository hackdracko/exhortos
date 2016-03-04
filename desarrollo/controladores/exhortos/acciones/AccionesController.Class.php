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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/acciones/AccionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/acciones/AccionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class AccionesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarAcciones($AccionesDto) {
        $AccionesDto->setcveAccion(strtoupper(str_ireplace("'", "", trim($AccionesDto->getcveAccion()))));
        $AccionesDto->setdesAccion(strtoupper(str_ireplace("'", "", trim($AccionesDto->getdesAccion()))));
        $AccionesDto->setactivo(strtoupper(str_ireplace("'", "", trim($AccionesDto->getactivo()))));
        $AccionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($AccionesDto->getfechaRegistro()))));
        $AccionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($AccionesDto->getfechaActualizacion()))));
        return $AccionesDto;
    }

    public function selectAcciones($AccionesDto, $param, $proveedor = null) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesDao = new AccionesDAO();
        $AccionesDto = $AccionesDao->selectAcciones($AccionesDto, null, " order by desAccion ASC ", $param, null);
        return $AccionesDto;
    }

    public function getPaginas($SistemasDto, $param) {

        $AccionesDao = new AccionesDAO();
        $numTot = $AccionesDao->selectAcciones($SistemasDto, null, "", $param, " count(cveAccion) as totalCount ");
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

    public function insertAcciones($AccionesDto, $proveedor = null) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesDao = new AccionesDAO();
        $AccionesDto = $AccionesDao->insertAcciones($AccionesDto, $proveedor);
        return $AccionesDto;
    }

    public function updateAcciones($AccionesDto, $proveedor = null) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesDao = new AccionesDAO();
        $AccionesDto = $AccionesDao->updateAcciones($AccionesDto, $proveedor);
        return $AccionesDto;
    }

    public function deleteAcciones($AccionesDto, $proveedor = null) {
        $AccionesDto = $this->validarAcciones($AccionesDto);
        $AccionesDao = new AccionesDAO();
        $AccionesDto = $AccionesDao->deleteAcciones($AccionesDto, $proveedor);
        return $AccionesDto;
    }

}

?>