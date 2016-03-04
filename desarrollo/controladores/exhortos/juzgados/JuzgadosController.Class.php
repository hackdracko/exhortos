<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 CONTROLLER
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de  Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgados/JuzgadosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/oficialia/OficialiaDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/municipios/MunicipiosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/municipios/MunicipiosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgadosmaterias/JuzgadosmateriasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/select/SelectDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class JuzgadosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarJuzgados($JuzgadosDto) {
        $JuzgadosDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getcveJuzgado()))));
        $JuzgadosDto->setdesJuzgado(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getdesJuzgado()))));
        $JuzgadosDto->setcveOficialia(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getcveOficialia()))));
        $JuzgadosDto->setproporcion(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getproporcion()))));
        $JuzgadosDto->setactivo(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getactivo()))));
        $JuzgadosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getfechaRegistro()))));
        $JuzgadosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getfechaActualizacion()))));
        $JuzgadosDto->setasignados(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getasignados()))));
        $JuzgadosDto->setcontrol(strtoupper(str_ireplace("'", "", trim($JuzgadosDto->getcontrol()))));
        return $JuzgadosDto;
    }

    public function selectJuzgados($JuzgadosDto, $param = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
        $JuzgadosDto = $JuzgadosDao->selectJuzgados($JuzgadosDto, "", null, $param, null);
//        // var_dump($JuzgadosDto);
        return $JuzgadosDto;
    }
    public function selectJuzgadosEstado($JuzgadosDto, $param = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
        $JuzgadosDto = $JuzgadosDao->selectJuzgados($JuzgadosDto, "", null, $param, null);

        if( $JuzgadosDto != '' ){
            //obtencion del municipio a través de -tbloficialias-
            $OficialiaDTO = new OficialiaDTO();
            $OficialiaDAO = new OficialiaDAO();
            $OficialiaDTO->setCveOficialia( $JuzgadosDto[0]->getCveOficialia() );
            $OficialiaDTO = $OficialiaDAO->selectOficialia( $OficialiaDTO);
            if( $OficialiaDTO != '' ){
                //obtencion del estado a través de -tblmunicipios-
                $MunicipiosDTO = new MunicipiosDTO();
                $MunicipiosDAO = new MunicipiosDAO();
                $MunicipiosDTO->setCveMunicipio( $OficialiaDTO[0]->getCveMunicipio() );
                $MunicipiosDTO = $MunicipiosDAO->selectMunicipios( $MunicipiosDTO);
                if( $MunicipiosDTO != '' ){
                    $cveEstadoProcedencia = $MunicipiosDTO[0]->getCveEstado();
                }
            }
        }
        $mensaje = array("estatus" => "ok", "mensaje" => "SI EXISTE EL ESTADO", "cveEstado" => $cveEstadoProcedencia);
        return json_encode($mensaje);
    }

    public function selectJuzgadosPaginacion($JuzgadosDto = null, $param = null, $estado = null, $municipio = null, $distrito = null) {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "j.cveJuzgado,
 j.desJuzgado,
 j.activo,
 o.cveOficialia,
 o.desOficilia,
  o.activo,
 mu.cveMunicipio,
 mu.desMunicipio,
  mu.activo,
 di.cveDistrito,
 di.desDistrito,
  di.activo,
 es.cveEstado,
 es.desEstado,
  es.activo,
 jm.cveJuzgadoMateria,
  jm.activo,
 t.cveTipo,
 t.desTipo,
  t.activo,
 c.cveCuantia,
 c.desCuantia,
  c.activo,
 ma.cveMateria,
 ma.desMateria,
  ma.activo,
  j.cveAdscripcion
";
        $params["tables"] = "tbljuzgados j left join tbloficialia o on ( j.cveOficialia = o.cveOficialia)
left join tblmunicipios mu on (mu.cveMunicipio = o.cveMunicipio)
left join tbldistritos di on (di.cveDistrito = o.cveDistrito)
left join tblestados es on (es.cveEstado = mu.cveEstado AND es.cveEstado = di.cveEstado)
left join tbljuzgadosmaterias jm on (jm.cveJuzgado = j.cveJuzgado AND jm.activo = 'S') 
left join tblcuantias c on (c.cveCuantia = jm.cveCuantia)
left join tblmaterias ma on (ma.cveMateria = jm.cveMateria)
left join tbltipos t on (t.cveTipo = jm.cveTipo)
";
        $params["conditions"] = " j.activo = 'S' AND jm.cveJuzgado = j.cveJuzgado ";
        $params["groups"] = "";
        $params["orders"] = "";

        $rs = $SelectDAO->_selectDAO($params);
        return $rs;

//        $campos = " a.cveAdscripcion,a.desAdscripcion,j.cveJuzgado,j.desJuzgado,j.cveOficialia ";
//        $orden = "  j, tbladscripciones a";
//        $orden .= " WHERE j.activo = 'S' ";
//        $orden .= "  AND a.activo = 'S' ";
//        $orden .= "  AND a.cveAdscripcion = j.cveAdscripcion ";
//        if ($JuzgadosDto->getCveJuzgado() != "")
//            $orden .= " AND j.cveJuzgado = " . $JuzgadosDto->getCveJuzgado() . " ";
//        if ($JuzgadosDto->getCveOficialia() != "")
//            $orden .= " AND j.cveOficialia = " . $JuzgadosDto->getCveOficialia() . " ";
//        if ($JuzgadosDto->getDesJuzgado() != "")
//            $orden .= " AND j.desJuzgado like '%" . $JuzgadosDto->getDesJuzgado() . "%' ";
//        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
//        $JuzgadosDao = new JuzgadosDAO();
//        $juzgado = new JuzgadosDTO();
//        $JuzgadosDto = $JuzgadosDao->selectJuzgados($juzgado, $orden, null, $param, $campos);
//        if($JuzgadosDto != "")
//            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
//        else
//            return $JuzgadosDto;
//        $datos['data'] = $JuzgadosDto;
//        $datos['totalCount'] = count($JuzgadosDto);
//         return $datos;
    }

    public function insertJuzgados($JuzgadosDto, $proveedor = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
        $JuzgadosDto = $JuzgadosDao->insertJuzgados($JuzgadosDto, $proveedor);
        return $JuzgadosDto;
    }

    public function insertJuzgadosProvedor($JuzgadosDto, $juzgadoMateriaDto, $proveedor = null) {
        // var_dump($JuzgadosDto);
        // var_dump($juzgadoMateriaDto);
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
        $JuzgadosDto = $JuzgadosDao->insertJuzgados($JuzgadosDto, $proveedor);
      //  // var_dump($JuzgadosDto);
        if ($JuzgadosDto == "") {
            $transaccion = 0;
        } else {
            $juzgadoMateriaDao = new JuzgadosmateriasDAO();
            $juzgadoMateriaDto->setCveJuzgado($JuzgadosDto[0]->getCveJuzgado());
            // var_dump($juzgadoMateriaDto);
            $juzgadoMateriaDto = $juzgadoMateriaDao->insertJuzgadosmaterias($juzgadoMateriaDto, $proveedor);
            // var_dump($juzgadoMateriaDto);
            if ($juzgadoMateriaDto == "") {
                $transaccion = 0;
            }
        }
       // var_dump($proveedor->error());
         echo $proveedor->error();
        if ($transaccion == 1) {
            // echo  "\ncommit\n";
           
            $proveedor->execute("COMMIT");
        } else {
            // echo  "\nrollback\n";
            $proveedor->execute("ROLLBACK");
        }
        $proveedor->close();
        return $JuzgadosDto;
    }

    public function updateJuzgados($JuzgadosDto, $proveedor = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
//$tmpDto = new JuzgadosDTO();
//$tmpDto = $JuzgadosDao->selectJuzgados($JuzgadosDto,$proveedor);
//if($tmpDto!=""){//$JuzgadosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $JuzgadosDto = $JuzgadosDao->updateJuzgados($JuzgadosDto, $proveedor);
        return $JuzgadosDto;
//}
//return "";
    }

    public function deleteJuzgados($JuzgadosDto, $proveedor = null) {
        $JuzgadosDto = $this->validarJuzgados($JuzgadosDto);
        $JuzgadosDao = new JuzgadosDAO();
        $JuzgadosDto = $JuzgadosDao->deleteJuzgados($JuzgadosDto, $proveedor);
        return $JuzgadosDto;
    }

    public function getPaginas($JuzgadosDto, $param, $estado, $municipio, $distrito) {
//        $campos = " j.cveJuzgado,j.desJuzgado,j.cveOficialia,o.desOficilia,m.cveMunicipio,m.desMunicipio,e.cveEstado,e.desEstado,d.cveDistrito,d.desDistrito ";
//        $orden = "  j, tbloficialia o, tblmunicipios m, tbldistritos d, tblestados e  ";
//        $orden .= " WHERE o.cveOficialia = j.cveOficialia ";
//        $orden .= " AND o.cveMunicipio = m.cveMunicipio ";
//        $orden .= " AND o.cveDistrito = d.cveDistrito ";
//        $orden .= " AND d.cveEstado = e.cveEstado ";
//        $orden .= " AND e.cveEstado = m.cveEstado ";
//        $orden .= " AND o.activo = 'S' ";
//        $orden .= " AND j.activo = 'S' ";
//        $orden .= " AND m.activo = 'S' ";
//        $orden .= " AND e.activo = 'S' ";
//        $orden .= " AND d.activo = 'S' ";
//        if ($JuzgadosDto->getCveJuzgado() != "")
//            $orden .= " AND j.cveJuzgado = " . $JuzgadosDto->getCveJuzgado() . " ";
//        if ($JuzgadosDto->getCveOficialia() != "")
//            $orden .= " AND j.cveOficialia = " . $JuzgadosDto->getCveOficialia() . " ";
//        if ($estado != "")
//            $orden .= " AND e.cveEstado = " . $estado . " ";
//        if ($municipio != "")
//            $orden .= " AND m.cveMunicipio = " . $municipio . " ";
//        if ($distrito != "")
//            $orden .= " AND d.cveDistrito = " . $distrito . " ";
//        if ($JuzgadosDto->getDesJuzgado() != "")
//            $orden .= " AND j.desJuzgado like '%" . $JuzgadosDto->getDesJuzgado() . "%' ";
//        $JuzgadosDao = new JuzgadosDAO();
//        $param["paginacion"] = false;
//        $juzgado = new JuzgadosDTO();
        $SelectDAO = new SelectDAO();
        $params["fields"] = " count(j.cveJuzgado) as totalCount";
        $params["tables"] = "tbloficialia o right join (tbljuzgados j inner join tbladscripciones a on a.cveAdscripcion = j.cveAdscripcion) on o.cveOficialia = j.cveOficialia
left join tblmunicipios m on o.cveMunicipio = m.cveMunicipio 
left join tbldistritos d on o.cveDistrito = d.cveDistrito
left join tblestados e on m.cveEstado = e.cveEstado AND d.cveEstado = e.cveEstado";
        $params["conditions"] = " j.activo =  'S' AND a.activo = 'S' ";
        $params["groups"] = "";
        $params["orders"] = "";
        $rs = json_decode($SelectDAO->_selectDAO($params));
//        // var_dump($rs->data[0]->totalCount);
        $numTot = $rs->data;
//        // var_dump($numTot);
        $Pages = (int) $numTot[0]->totalCount / $param["cantxPag"];
        $restoPages = $numTot[0]->totalCount % $param["cantxPag"];
        $totPages = $Pages + (($restoPages > 0) ? 1 : 0);

        $json = "";
        $json .= '{"type":"OK",';
        $json .= '"totalCount":"' . $numTot[0]->totalCount . '",';
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
