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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/oficialia/OficialiaDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class OficialiaController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarOficialia($OficialiaDto) {
        $OficialiaDto->setcveOficialia(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getcveOficialia()))));
        $OficialiaDto->setdesOficilia(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getdesOficilia()))));
        $OficialiaDto->setcveDistrito(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getcveDistrito()))));
        $OficialiaDto->setcveMunicipio(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getcveMunicipio()))));
        $OficialiaDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getcveAdscripcion()))));
        $OficialiaDto->setactivo(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getactivo()))));
        $OficialiaDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getfechaRegistro()))));
        $OficialiaDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($OficialiaDto->getfechaActualizacion()))));
        return $OficialiaDto;
    }

    public function selectOficialia($OficialiaDto, $param = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaDao = new OficialiaDAO();
        $OficialiaDto = $OficialiaDao->selectOficialia($OficialiaDto, "", null, $param, null);
        return $OficialiaDto;
    }

    public function selectOficialiaPaginacion($OficialiaDto, $param = null, $estado = null) {
//        var_dump($OficialiaDto);
        $inicia = false;
        $orden =  "  ";
        $campos = " a.cveAdscripcion, a.desAdscripcion, o.cveOficialia, o.desOficilia, o.cveDistrito, d.desDistrito, o.cveMunicipio,  m.desMunicipio, e.cveEstado, e.desEstado ";
        $orden .= "  o inner join tbladscripciones a on a.cveAdscripcion = o.cveAdscripcion ";
        $orden .= " left join tblmunicipios m on m.cveMunicipio = o.cveMunicipio ";
        $orden .= " left join tbldistritos d on d.cveDistrito = o.cveDistrito ";
        $orden .= " left join tblestados e on e.cveEstado = d.cveEstado AND e.cveEstado = m.cveMunicipio ";
        $orden .= " where a.activo = 'S' ";
        $orden .= " AND o.activo = 'S' ";
        
        if ($estado != "")
            $orden .= " AND e.cveEstado = " . $estado . " ";
        if ($OficialiaDto->getCveMunicipio() != "")
            $orden .= " AND o.cveMunicipio = " . $OficialiaDto->getCveMunicipio() . " ";
        if ($OficialiaDto->getCveDistrito() != "")
            $orden .= " AND o.cveDistrito = " . $OficialiaDto->getCveDistrito() . " ";
        if ($OficialiaDto->getDesOficilia() != "")
            $orden .= " AND o.desOficilia like '%" . $OficialiaDto->getDesOficilia() . "%' ";
//        echo $orden;
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaDao = new OficialiaDAO();
        $oficialia = new OficialiaDTO();
        $OficialiaDto = $OficialiaDao->selectOficialia($oficialia, $orden, null, $param, $campos);
//        var_dump($OficialiaDto);
        if ($OficialiaDto != "")
            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
        else
            return $OficialiaDto;
        $datos['data'] = $OficialiaDto;
        $datos['totalCount'] = count($OficialiaDto);

//        var_dump($datos);
//        var_dump($OficialiaDao);
        return $datos;
    }

    public function insertOficialia($OficialiaDto, $proveedor = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaDao = new OficialiaDAO();
        $OficialiaDto = $OficialiaDao->insertOficialia($OficialiaDto, $proveedor);
        return $OficialiaDto;
    }

    public function updateOficialia($OficialiaDto, $proveedor = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaDao = new OficialiaDAO();
//$tmpDto = new OficialiaDTO();
//$tmpDto = $OficialiaDao->selectOficialia($OficialiaDto,$proveedor);
//if($tmpDto!=""){//$OficialiaDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $OficialiaDto = $OficialiaDao->updateOficialia($OficialiaDto, $proveedor);
        return $OficialiaDto;
//}
//return "";
    }

    public function deleteOficialia($OficialiaDto, $proveedor = null) {
        $OficialiaDto = $this->validarOficialia($OficialiaDto);
        $OficialiaDao = new OficialiaDAO();
        $OficialiaDto = $OficialiaDao->deleteOficialia($OficialiaDto, $proveedor);
        return $OficialiaDto;
    }

    public function getPaginas($OficialiaDto, $param, $estado) {
        //$campos = " o.cveOficialia,o.desOficilia,o.cveMunicipio,o.activo,e.cveEstado,e.desEstado,m.desMunicipio,o.cveDistrito,d.desDistrito ";
        $inicia = false;
        $orden =  "  ";
        $campos = " a.cveAdscripcion, a.desAdscripcion, o.cveOficialia, o.desOficilia, o.cveDistrito, d.desDistrito, o.cveMunicipio,  m.desMunicipio, e.cveEstado, e.desEstado ";
        $orden .= "  o inner join tbladscripciones a on a.cveAdscripcion = o.cveAdscripcion ";
        $orden .= " left join tblmunicipios m on m.cveMunicipio = o.cveMunicipio ";
        $orden .= " left join tbldistritos d on d.cveDistrito = o.cveDistrito ";
        $orden .= " left join tblestados e on e.cveEstado = d.cveEstado AND e.cveEstado = m.cveMunicipio ";
        $orden .= " where a.activo = 'S' ";
        $orden .= " AND o.activo = 'S' ";
        if ($estado != "")
            $orden .= " AND e.cveEstado = " . $estado . " ";
        if ($OficialiaDto->getCveMunicipio() != "")
            $orden .= " AND o.cveMunicipio = " . $OficialiaDto->getCveMunicipio() . " ";
        if ($OficialiaDto->getCveDistrito() != "")
            $orden .= " AND o.cveDistrito = " . $OficialiaDto->getCveDistrito() . " ";
        if ($OficialiaDto->getDesOficilia() != "")
            $orden .= " AND o.desOficilia like '%" . $OficialiaDto->getDesOficilia() . "%' ";
        $OficialiaDao = new OficialiaDAO();
        $param["paginacion"] = false;
        $oficialia = new OficialiaDTO();
        $numTot = $OficialiaDao->selectOficialia($oficialia, $orden, null, null, " count(o.cveOficialia) as totalCount ");
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