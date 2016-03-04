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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgadosmaterias/JuzgadosmateriasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class JuzgadosmateriasController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuzgadosmaterias($JuzgadosmateriasDto) {
        $JuzgadosmateriasDto->setcveJuzgadoMateria(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getcveJuzgadoMateria()))));
        $JuzgadosmateriasDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getcveJuzgado()))));
        $JuzgadosmateriasDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getcveMateria()))));
        $JuzgadosmateriasDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getcveCuantia()))));
        $JuzgadosmateriasDto->setcveTipo(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getcveTipo()))));
        $JuzgadosmateriasDto->setactivo(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getactivo()))));
        $JuzgadosmateriasDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getfechaRegistro()))));
        $JuzgadosmateriasDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($JuzgadosmateriasDto->getfechaActualizacion()))));
        return $JuzgadosmateriasDto;
    }

    public function selectJuzgadosmaterias($JuzgadosmateriasDto, $param) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasDao = new JuzgadosmateriasDAO();
        $JuzgadosmateriasDto = $JuzgadosmateriasDao->selectJuzgadosmaterias($JuzgadosmateriasDto, "", null, $param, null);
        return $JuzgadosmateriasDto;
    }

    public function selectJuzgadosmateriasPaginacion($JuzgadosmateriasDto, $param) {
        $campos = " jm.cveJuzgadoMateria, jm.cveJuzgado, jm.cveMateria, jm.cveCuantia, jm.cveTipo, m.desMateria, c.desCuantia, t.desTipo, j.desJuzgado ";
        $orden = " jm, tblmaterias m, tblcuantias c, tbltipos t, tbljuzgados j ";
        $orden .= " WHERE m.cveMateria = jm.cveMateria ";
        $orden .= " AND jm.cveCuantia = c.cveCuantia ";
        $orden .= " AND jm.cveTipo = t.cveTipo ";
        $orden .= " AND jm.cveJuzgado = j.cveJuzgado ";
        $orden .= " AND jm.activo = 'S' ";
        $orden .= " AND m.activo = 'S' ";
        $orden .= " AND c.activo = 'S' ";
        $orden .= " AND t.activo = 'S' ";
        $orden .= " AND j.activo = 'S' ";
        if ($JuzgadosmateriasDto->getCveMateria() != "")
            $orden .= " AND jm.cveMateria = ".$JuzgadosmateriasDto->getCveMateria()." ";
        if ($JuzgadosmateriasDto->getCveJuzgado() != "")
            $orden .= " AND jm.cveJuzgado = ".$JuzgadosmateriasDto->getCveJuzgado()." ";
        if ($JuzgadosmateriasDto->getCveCuantia() != "")
            $orden .= " AND jm.cveCuantia = ".$JuzgadosmateriasDto->getCveCuantia()." ";
        if ($JuzgadosmateriasDto->getCveTipo() != "")
            $orden .= " AND jm.cveTipo = ".$JuzgadosmateriasDto->getCveTipo()." ";
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasDao = new JuzgadosmateriasDAO();
        $juzgado = new JuzgadosmateriasDTO();
        $JuzgadosmateriasDto = $JuzgadosmateriasDao->selectJuzgadosmaterias($juzgado, $orden, null, $param, $campos);
        if ($JuzgadosmateriasDto != "")
            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
        else
            return $JuzgadosmateriasDto;
        $datos['data'] = $JuzgadosmateriasDto;
        $datos['totalCount'] = count($JuzgadosmateriasDto);

//        var_dump($datos);
//        var_dump($OficialiaDao);
        return $datos;
    }

    public function insertJuzgadosmaterias($JuzgadosmateriasDto, $proveedor = null) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasDao = new JuzgadosmateriasDAO();
        $JuzgadosmateriasDto = $JuzgadosmateriasDao->insertJuzgadosmaterias($JuzgadosmateriasDto, $proveedor);
        return $JuzgadosmateriasDto;
    }

    public function updateJuzgadosmaterias($JuzgadosmateriasDto, $proveedor = null) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasDao = new JuzgadosmateriasDAO();
//$tmpDto = new JuzgadosmateriasDTO();
//$tmpDto = $JuzgadosmateriasDao->selectJuzgadosmaterias($JuzgadosmateriasDto,$proveedor);
//if($tmpDto!=""){//$JuzgadosmateriasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $JuzgadosmateriasDto = $JuzgadosmateriasDao->updateJuzgadosmaterias($JuzgadosmateriasDto, $proveedor);
        return $JuzgadosmateriasDto;
//}
//return "";
    }

    public function deleteJuzgadosmaterias($JuzgadosmateriasDto, $proveedor = null) {
        $JuzgadosmateriasDto = $this->validarJuzgadosmaterias($JuzgadosmateriasDto);
        $JuzgadosmateriasDao = new JuzgadosmateriasDAO();
        $JuzgadosmateriasDto = $JuzgadosmateriasDao->deleteJuzgadosmaterias($JuzgadosmateriasDto, $proveedor);
        return $JuzgadosmateriasDto;
    }

    public function getPaginas($JuzgadosmateriasDto, $param) {
        //$campos = " o.cveOficialia,o.desOficilia,o.cveMunicipio,o.activo,e.cveEstado,e.desEstado,m.desMunicipio,o.cveDistrito,d.desDistrito ";
        $campos = " jm.cveJuzgadoMateria, jm.cveJuzgado, jm.cveMateria, jm.cveCuantia, jm.cveTipo, m.desMateria, c.desCuantia, t.desTipo, j.desJuzgado ";
        $orden = " jm, tblmaterias m, tblcuantias c, tbltipos t, tbljuzgados j ";
        $orden .= " WHERE m.cveMateria = jm.cveMateria ";
        $orden .= " AND jm.cveCuantia = c.cveCuantia ";
        $orden .= " AND jm.cveTipo = t.cveTipo ";
        $orden .= " AND jm.cveJuzgado = j.cveJuzgado ";
        $orden .= " AND jm.activo = 'S' ";
        $orden .= " AND m.activo = 'S' ";
        $orden .= " AND c.activo = 'S' ";
        $orden .= " AND t.activo = 'S' ";
        $orden .= " AND j.activo = 'S' ";
        if ($JuzgadosmateriasDto->getCveMateria() != "")
            $orden .= " AND jm.cveMateria = ".$JuzgadosmateriasDto->getCveMateria()." ";
        if ($JuzgadosmateriasDto->getCveJuzgado() != "")
            $orden .= " AND jm.cveJuzgado = ".$JuzgadosmateriasDto->getCveJuzgado()." ";
        if ($JuzgadosmateriasDto->getCveCuantia() != "")
            $orden .= " AND jm.cveCuantia = ".$JuzgadosmateriasDto->getCveCuantia()." ";
        if ($JuzgadosmateriasDto->getCveTipo() != "")
            $orden .= " AND jm.cveTipo = ".$JuzgadosmateriasDto->getCveTipo()." ";
        $JuzgadomateriaDao = new JuzgadosmateriasDAO();
        $param["paginacion"] = false;
        $juzgadoM = new JuzgadosmateriasDTO();
        $numTot = $JuzgadomateriaDao->selectJuzgadosmaterias($juzgadoM, $orden, null, null, " count(jm.cveJuzgadoMateria) as totalCount ");
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