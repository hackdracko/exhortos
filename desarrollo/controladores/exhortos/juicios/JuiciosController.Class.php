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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juicios/JuiciosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juicios/JuiciosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class JuiciosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuicios($JuiciosDto) {
        $JuiciosDto->setcveJuicio(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getcveJuicio()))));
        $JuiciosDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getcveMateria()))));
        $JuiciosDto->setdesJuicioDelito(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getdesJuicioDelito()))));
        $JuiciosDto->setfundamento(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getfundamento()))));
        $JuiciosDto->setactivo(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getactivo()))));
        $JuiciosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getfechaRegistro()))));
        $JuiciosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($JuiciosDto->getfechaActualizacion()))));
        return $JuiciosDto;
    }

    public function selectJuicios($JuiciosDto, $param = null) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosDao = new JuiciosDAO();
        $JuiciosDto = $JuiciosDao->selectJuicios($JuiciosDto, " ORDER BY desJuicioDelito ASC ", null, $param, null);
        if( $JuiciosDto != '' ){
            foreach ($JuiciosDto as $Juicios) {
                $Juicios->setDesJuicioDelito( utf8_decode( $Juicios->getDesJuicioDelito() ) );
            }
        }
        return $JuiciosDto;
    }
    public function selectJuiciosPaginacion($JuiciosDto, $param = null) {
//        var_dump($JuiciosDto);
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosDao = new JuiciosDAO();
        $JuiciosDto = $JuiciosDao->selectJuicios($JuiciosDto, "", null, $param, null);
        return $JuiciosDto;
    }

    public function insertJuicios($JuiciosDto, $proveedor = null) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosDao = new JuiciosDAO();
        $JuiciosDto = $JuiciosDao->insertJuicios($JuiciosDto, $proveedor);
        return $JuiciosDto;
    }

    public function updateJuicios($JuiciosDto, $proveedor = null) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosDao = new JuiciosDAO();
//$tmpDto = new JuiciosDTO();
//$tmpDto = $JuiciosDao->selectJuicios($JuiciosDto,$proveedor);
//if($tmpDto!=""){//$JuiciosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $JuiciosDto = $JuiciosDao->updateJuicios($JuiciosDto, $proveedor);
        return $JuiciosDto;
//}
//return "";
    }

    public function deleteJuicios($JuiciosDto, $proveedor = null) {
        $JuiciosDto = $this->validarJuicios($JuiciosDto);
        $JuiciosDao = new JuiciosDAO();
        $JuiciosDto = $JuiciosDao->deleteJuicios($JuiciosDto, $proveedor);
        return $JuiciosDto;
    }
    public function getPaginas($JuiciosDto, $param) {
        $JuiciosDao = new JuiciosDAO();
        $param["paginacion"] = false;
        $numTot = $JuiciosDao->selectJuicios($JuiciosDto, null, "", null, " count(cveJuicio) as totalCount ");
        $Pages = (int) $numTot[0]['totalCount'] / $param["cantxPag"];
        $restoPages = $numTot[0]['totalCount'] % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0]['totalCount'] . '",';
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
        } else {
            $json .= "]}";
        }
        return $json;
    }
}

?>