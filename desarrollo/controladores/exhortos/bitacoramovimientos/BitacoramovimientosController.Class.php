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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class BitacoramovimientosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarBitacoramovimientos($BitacoramovimientosDto) {
        $BitacoramovimientosDto->setidBitacoraMovimiento(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getidBitacoraMovimiento()))));
        $BitacoramovimientosDto->setcveAccion(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getcveAccion()))));
        $BitacoramovimientosDto->setfechaMovimiento(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getfechaMovimiento()))));
        $BitacoramovimientosDto->setobservaciones(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getobservaciones()))));
        $BitacoramovimientosDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getcveUsuario()))));
        $BitacoramovimientosDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getcvePerfil()))));
        $BitacoramovimientosDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim($BitacoramovimientosDto->getcveAdscripcion()))));
        return $BitacoramovimientosDto;
    }

    public function selectBitacoramovimientos($BitacoramovimientosDto, $param, $proveedor = null) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosDao = new BitacoramovimientosDAO();
        $BitacoramovimientosDto = $BitacoramovimientosDao->selectBitacoramovimientos($BitacoramovimientosDto, null, "", $param, null);
        return $BitacoramovimientosDto;
    }

    public function getPaginas($BitacoramovimientosDto, $param) {

        $BitacoramovimientosDao = new BitacoramovimientosDAO();
        $numTot = $BitacoramovimientosDao->selectBitacoramovimientos($BitacoramovimientosDto, null, "", $param, " count(idBitacoraMovimiento) as totalCount ");
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

    public function insertBitacoramovimientos($BitacoramovimientosDto, $proveedor = null) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosDao = new BitacoramovimientosDAO();
        $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $proveedor);
        return $BitacoramovimientosDto;
    }

    public function updateBitacoramovimientos($BitacoramovimientosDto, $proveedor = null) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosDao = new BitacoramovimientosDAO();
//$tmpDto = new BitacoramovimientosDTO();
//$tmpDto = $BitacoramovimientosDao->selectBitacoramovimientos($BitacoramovimientosDto,$proveedor);
//if($tmpDto!=""){//$BitacoramovimientosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $BitacoramovimientosDto = $BitacoramovimientosDao->updateBitacoramovimientos($BitacoramovimientosDto, $proveedor);
        return $BitacoramovimientosDto;
//}
//return "";
    }

    public function deleteBitacoramovimientos($BitacoramovimientosDto, $proveedor = null) {
        $BitacoramovimientosDto = $this->validarBitacoramovimientos($BitacoramovimientosDto);
        $BitacoramovimientosDao = new BitacoramovimientosDAO();
        $BitacoramovimientosDto = $BitacoramovimientosDao->deleteBitacoramovimientos($BitacoramovimientosDto, $proveedor);
        return $BitacoramovimientosDto;
    }

}

?>