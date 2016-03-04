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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/adscripciones/AdscripcionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/oficialia/OficialiaDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/oficialia/OficialiaDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgados/JuzgadosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgadosmaterias/JuzgadosmateriasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class AdscripcionesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarAdscripciones($AdscripcionesDto) {
        $AdscripcionesDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim($AdscripcionesDto->getcveAdscripcion()))));
        $AdscripcionesDto->setdesAdscripcion(strtoupper(str_ireplace("'", "", trim($AdscripcionesDto->getdesAdscripcion()))));
        $AdscripcionesDto->setactivo(strtoupper(str_ireplace("'", "", trim($AdscripcionesDto->getactivo()))));
        $AdscripcionesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($AdscripcionesDto->getfechaRegistro()))));
        $AdscripcionesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($AdscripcionesDto->getfechaActualizacion()))));
        return $AdscripcionesDto;
    }

    public function selectAdscripciones($AdscripcionesDto, $proveedor = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $AdscripcionesDto = $AdscripcionesDao->selectAdscripciones($AdscripcionesDto, ' order by desAdscripcion ASC ', $proveedor);
        return $AdscripcionesDto;
    }

    public function selectAdscripciones_j($AdscripcionesDto, $param = null, $tipo = null) {
        $campos = " a.cveAdscripcion, a.desAdscripcion ";
        $orden = "  FROM tbladscripciones a, tbljuzgados j";
        $orden .= " WHERE ";
        $orden .= "  j.activo = 'S' ";
        $orden .= "  AND a.activo = 'S' ";
        $orden .= "  AND a.cveAdscripcion = j.cveAdscripcion ";
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $adscripcion = new AdscripcionesDTO();
        $AdscripcionesDto = $AdscripcionesDao->selectAdscripciones($adscripcion, $orden, null, $param, $campos);
        if ($AdscripcionesDto != "")
            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
        else
            return $AdscripcionesDto;
        $datos['data'] = $AdscripcionesDto;
        $datos['totalCount'] = count($AdscripcionesDto);

//        var_dump($datos);
//        var_dump($OficialiaDao);
        return $datos;
    }

    public function selectAdscripciones_o($AdscripcionesDto, $param = null, $tipo = null) {
        $campos = " a.cveAdscripcion, a.desAdscripcion ";
        $orden = "  FROM tbladscripciones a, tbloficialia o";
        $orden .= " WHERE ";
        $orden .= "  o.activo = 'S' ";
        $orden .= "  AND a.activo = 'S' ";
        $orden .= "  AND a.cveAdscripcion = o.cveAdscripcion ";
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $adscripcion = new AdscripcionesDTO();
        $AdscripcionesDto = $AdscripcionesDao->selectAdscripciones($adscripcion, $orden, null, $param, $campos);
        if ($AdscripcionesDto != "")
            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
        else
            return $AdscripcionesDto;
        $datos['data'] = $AdscripcionesDto;
        $datos['totalCount'] = count($AdscripcionesDto);

//        var_dump($datos);
//        var_dump($OficialiaDao);
        return $datos;
    }

    public function selectAdscripciones_o_j($AdscripcionesDto, $param = null, $tipo = null, $oficialiaDto = null, $juzgadoDto = null, $juzgadoMateriaDto = null, $estado = null, $municipio = null, $distrito = null, $activos = null) {
        $adscripcionCancatena = true;
        $oficialiaConcatena = true;
        $json = "{";
        $orden = "  ";
        $campos = " ";
        if ($tipo == "") {
            
        } elseif ($tipo == "O") {
            
            $campos .= " ads.cveAdscripcion, ";
            $campos .= " ads.desAdscripcion, ";
            $campos .= " ads.activo as adsactivo, ";
            $campos .= " ofi.cveOficialia, ";
            $campos .= " ofi.desOficilia, ";
            $campos .= " ofi.activo as ofiactivo, ";
            $campos .= " dis.cveDistrito, ";
            $campos .= " dis.desDistrito, ";
            $campos .= " dis.activo as disactivo, ";
            $campos .= " mu.cveMunicipio, ";
            $campos .= " mu.desMunicipio, ";
            $campos .= " mu.activo as muactivo, ";
            $campos .= " es.cveEstado, ";
            $campos .= " es.desEstado, ";
            $campos .= " es.activo as esactivo ";

            $orden .= " ads ";
            $orden .= " inner join tbloficialia ofi on ofi.cveAdscripcion = ads.cveAdscripcion ";
            $orden .= " inner join tbldistritos dis on dis.cveDistrito = ofi.cveDistrito ";
            $orden .= " inner join tblmunicipios mu on mu.cveMunicipio = ofi.cveMunicipio ";
            $orden .= " inner join tblestados es on (es.cveEstado = dis.cveEstado AND es.cveEstado = mu.cveEstado) ";
            if($activos == "S"){
                $orden .= " where ";
                $orden .= " ads.activo = 'S' AND ofi.activo = 'S'";
            }elseif ($activos == "N") {
                $orden .= " where ";
                $orden .= " ads.activo = 'N'  OR ofi.activo = 'N'";
            }elseif ($activos == "A") {
                $orden .= " where ";
                $orden .= " (ads.activo = 'N'  AND ofi.activo = 'N') OR (ads.activo = 'S'  AND ofi.activo = 'S')";
            }
            if($AdscripcionesDto->getDesAdscripcion() != "")
                $orden .= " AND  ads.desAdscripcion like '%".$AdscripcionesDto->getDesAdscripcion()."%'";
            if($oficialiaDto->getCveOficialia() != "")
                $orden .= " AND ofi.cveOficialia = '".$oficialiaDto->getCveOficialia()."'";
            if($distrito != "")
                $orden .= " AND dis.cveDistrito = '".$distrito."'";
            if($municipio != "")
                $orden .= " AND mu.cveMunicipio = '".$municipio."'";
            if($estado != "")
                $orden .= " AND es.cveEstado = '".$estado."'";
            if($estado != "")
                $orden .= " AND es.cveEstado = '".$estado."'";
            

            $AdscripcionesDao = new AdscripcionesDAO();
            $adscripcion = new AdscripcionesDTO();
            $resultOficialias = $AdscripcionesDao->selectAdscripciones($adscripcion, $orden, null, $param, $campos);
            $cantidad = count($resultOficialias);
            if ($resultOficialias != "") {
                $json .= '"estatus": "OK",';
                $json .= '"pagina": "'.$param["pag"].'",';
                $json .= '"totalCount": "' . $cantidad . '",';
                $json .= '"tipo": "oficialia",';
                $json .= '"resultados": [';
                for ($i = 0; $i < $cantidad; $i++) {
                    $json .= "{";
                    $json .= '"cveAdscripcion": ' . json_encode($resultOficialias[$i]['cveAdscripcion']) . ',';
                    $json .= '"desAdscripcion": ' . json_encode($resultOficialias[$i]['desAdscripcion']) . ',';
                    $json .= '"adsactivo": ' . json_encode($resultOficialias[$i]['adsactivo']) . ',';
                    $json .= '"cveOficialia": ' . json_encode($resultOficialias[$i]['cveOficialia']) . ',';
                    $json .= '"desOficilia": ' . json_encode($resultOficialias[$i]['desOficilia']) . ',';
                    $json .= '"ofiactivo": ' . json_encode($resultOficialias[$i]['ofiactivo']) . ',';
                    $json .= '"cveMunicipio": ' . json_encode($resultOficialias[$i]['cveMunicipio']) . ',';
                    $json .= '"desMunicipio": ' . json_encode($resultOficialias[$i]['desMunicipio']) . ',';
                    $json .= '"cveDistrito": ' . json_encode($resultOficialias[$i]['cveDistrito']) . ',';
                    $json .= '"desDistrito": ' . json_encode($resultOficialias[$i]['desDistrito']) . ',';
                    $json .= '"cveEstado": ' . json_encode($resultOficialias[$i]['cveEstado']) . ',';
                    $json .= '"desEstado": ' . json_encode($resultOficialias[$i]['desEstado']) . ',';

                    $campos = " ";
                    $orden = " ";
                    $campos .= " juz.cveJuzgado, ";
                    $campos .= " juz.desJuzgado, ";
                    $campos .= " juz.cveOficialia, ";
                    $campos .= " juz.activo, ";
                    $campos .= " ads.cveAdscripcion, ";
                    $campos .= " ads.desAdscripcion ";

                    $orden .= " juz  inner join tbladscripciones ads on ads.cveAdscripcion = juz.cveAdscripcion ";
                    $orden .= " where juz.cveOficialia = " . $resultOficialias[$i]['cveOficialia'] . " ";
                    $orden .= " and juz.activo = 'S' ";
                    $JuzgadosDao = new JuzgadosDAO();
                    $juzgados = new JuzgadosDTO();
                    $resultJuzgados = $JuzgadosDao->selectJuzgados($juzgados, $orden, null, null, $campos);
                    if($resultJuzgados != ""){
                        $cantidad2 = count($resultJuzgados);
                    }else{
                        $cantidad2 = 0;
                    }
                    $json .= '"totalJuzgado": ' . json_encode($cantidad2) . ',';
                    $json .= '"Juzgado": [{';
                    if ($resultJuzgados != "") {
                        $json .= '"totalCountJuzgado": "' . ($cantidad2) . '",';
                        $json .= '"resultados": [';
                        for ($j = 0; $j < $cantidad2; $j++) {
                            $json .= "{";
                            $json .= '"cveJuzgado": ' . json_encode($resultJuzgados[$j]['cveJuzgado']) . ',';
                            $json .= '"desJuzgado": ' . json_encode($resultJuzgados[$j]['desJuzgado']) . ',';
                            $json .= '"cveOficialia": ' . json_encode($resultJuzgados[$j]['cveOficialia']) . ',';
                            $json .= '"cveAdscripcion": ' . json_encode($resultJuzgados[$j]['cveAdscripcion']) . ',';
                            $json .= '"desAdscripcion": ' . json_encode($resultJuzgados[$j]['desAdscripcion']) . ',';

                            $arrayJuzgadosMaterias = array();
                            $campos = " ";
                            $orden = " ";

                            $campos .= " jm.cveJuzgadoMateria, ";
                            $campos .= " jm.activo, ";
                            $campos .= " cu.cveCuantia, ";
                            $campos .= " cu.desCuantia, ";
                            $campos .= " cu.activo, ";
                            $campos .= " ma.cveMateria, ";
                            $campos .= " ma.desMateria, ";
                            $campos .= " ma.activo, ";
                            $campos .= " ti.cveTipo, ";
                            $campos .= " ti.desTipo ";

                            $orden .= " jm  ";
                            $orden .= " inner join tblcuantias cu on cu.cveCuantia = jm.cveCuantia ";
                            $orden .= " inner join tblmaterias ma on ma.cveMateria = jm.cveMateria ";
                            $orden .= " inner join tbltipos ti on ti.cveTipo = jm.cveTipo ";
                            $orden .= " where jm.cveJuzgado = " . $resultJuzgados[$j]['cveJuzgado'] . " ";
                            $orden .= " and jm.activo = 'S' ";
                            $juzgadoMateriaDao = new JuzgadosmateriasDAO();
                            $juzgadoMateriaDto = new JuzgadosmateriasDTO();
                            $resulJuzgadosMaterias = $juzgadoMateriaDao->selectJuzgadosmaterias($juzgadoMateriaDto, $orden, null, null, $campos);
                            $cantidad3 = count($resulJuzgadosMaterias);
                            if ($resulJuzgadosMaterias != "") {
                                $json .= '"totalCountJuzgadoMateria": "' . ($cantidad3).'"'. ',';
                                $json .= '"resultados": [';
                                for ($k = 0; $k < $cantidad3; $k++) {
                                    $json .= "{";
                                    $json .= '"cveJuzgadoMateria": ' . json_encode($resulJuzgadosMaterias[$k]['cveJuzgadoMateria']) . ',';
                                    $json .= '"cveCuantia": ' . json_encode($resulJuzgadosMaterias[$k]['cveCuantia']) . ',';
                                    $json .= '"desCuantia": ' . json_encode($resulJuzgadosMaterias[$k]['desCuantia']) . ',';
                                    $json .= '"cveMateria": ' . json_encode($resulJuzgadosMaterias[$k]['cveMateria']) . ',';
                                    $json .= '"desMateria": ' . json_encode($resulJuzgadosMaterias[$k]['desMateria']) . ',';
                                    $json .= '"cveTipo": ' . json_encode($resulJuzgadosMaterias[$k]['cveTipo']) . ',';
                                    $json .= '"desTipo": ' . json_encode($resulJuzgadosMaterias[$k]['desTipo']);
                                    $json .= "},";
                                }
                                $json = substr($json, 0, -1);
                                $json .= "]";
                                $json .= "},";
                            } else {
                                $json .= '"totalCountJuzgadoMateria": 0';
                                $json .= "},";
                            }
                        }
                        $json = substr($json, 0, -1);
                        $json .= "  ]";
                    } else {
                        $json .= '"totalCountJuzgado": 0';
                        $json .= "},";
                    }
                    $json = substr($json, 0, -1);
                    if ($resultJuzgados != "") {
                        $json .= "]}]";
                    } else {
                        $json .= "]";
                    }
                    $json .= "},";
                }
                $json = substr($json, 0, -1);
                $json .= "]";
                $json .= "}";
//                $arrayModificar = json_decode($json);
//                var_dump($arrayModificar);
                return $json;
            }
        } elseif ($tipo == "J") {
//            $campos .= " ads.cveAdscripcion, ";
//            $campos .= " ads.desAdscripcion, ";
//            $campos .= " ads.activo as adsactivo, ";
//            $campos .= " ofi.cveOficialia, ";
//            $campos .= " ofi.desOficilia, ";
//            $campos .= " ofi.activo as ofiactivo, ";
//            $campos .= " dis.cveDistrito, ";
//            $campos .= " dis.desDistrito, ";
//            $campos .= " dis.activo as disactivo, ";
//            $campos .= " mu.cveMunicipio, ";
//            $campos .= " mu.desMunicipio, ";
//            $campos .= " mu.activo as muactivo, ";
//            $campos .= " es.cveEstado, ";
//            $campos .= " es.activo as esactivo ";
//
//            $orden .= " ads ";
//            $orden .= " inner join tbljuzgados juz on juz.cveAdscripcion = ads.cveAdscripcion ";
//            $orden .= " inner join tbloficialia ofi on ofi.cveOficialia = juz.cveOficialia ";
//            $orden .= " inner join tbldistritos dis on dis.cveDistrito = ofi.cveDistrito ";
//            $orden .= " inner join tblmunicipios mu on mu.cveMunicipio = ofi.cveMunicipio ";
//            $orden .= " inner join tblestados es on (es.cveEstado = dis.cveEstado AND es.cveEstado = mu.cveEstado) ";
//            $orden .= " where ";
//            $orden .= " ads.activo = 'S'";
            
//            if($AdscripcionesDto->getDesAdscripcion() != "")
//                $orden .= " AND  ads.desAdscripcion like '%".$AdscripcionesDto->getDesAdscripcion()."%'";
//            if($oficialiaDto->getCveOficialia() != "")
//                $orden .= " AND ofi.cveOficialia = '".$oficialiaDto->getCveOficialia()."'";
//            if($distrito != "")
//                $orden .= " AND dis.cveDistrito = '".$distrito."'";
//            if($municipio != "")
//                $orden .= " AND mu.cveMunicipio = '".$municipio."'";
//            if($estado != "")
//                $orden .= " AND es.cveEstado = '".$estado."'";
            

//            $AdscripcionesDao = new AdscripcionesDAO();
//            $adscripcion = new AdscripcionesDTO();
//            $resultOficialias = $AdscripcionesDao->selectAdscripciones($adscripcion, $orden, null, $param, $campos);
//            $cantidad = count($resultOficialias);
//            if ($resultOficialias != "") {
                $json .= '"estatus": "OK",';
                $json .= '"pagina": "'.$param["pag"].'",';
                $json .= '"tipo": "juzgado",';
                $json .= '"resultados": [';
//                for ($i = 0; $i < $cantidad; $i++) {
                    $json .= "{";
//                    $json .= '"cveAdscripcion": ' . json_encode($resultOficialias[$i]['cveAdscripcion']) . ',';
//                    $json .= '"desAdscripcion": ' . json_encode($resultOficialias[$i]['desAdscripcion']) . ',';
//                    $json .= '"cveOficialia": ' . json_encode($resultOficialias[$i]['cveOficialia']) . ',';
//                    $json .= '"desOficilia": ' . json_encode($resultOficialias[$i]['desOficilia']) . ',';
//                    $json .= '"cveMunicipio": ' . json_encode($resultOficialias[$i]['cveMunicipio']) . ',';
//                    $json .= '"desMunicipio": ' . json_encode($resultOficialias[$i]['desMunicipio']) . ',';
//                    $json .= '"cveDistrito": ' . json_encode($resultOficialias[$i]['cveDistrito']) . ',';
//                    $json .= '"desDistrito": ' . json_encode($resultOficialias[$i]['desDistrito']) . ',';
//                    $json .= '"cveEstado": ' . json_encode($resultOficialias[$i]['cveEstado']) . ',';
//                    $json .= '"desEstado": ' . json_encode($resultOficialias[$i]['desEstado']) . ',';
                    $json .= '"Juzgado": [{';

                    $campos = " ";
                    $orden = " ";
                    $campos .= " juz.cveJuzgado, ";
                    $campos .= " juz.desJuzgado, ";
                    $campos .= " juz.cveOficialia, ";
                    $campos .= " juz.cveAdscripcion, ";
                    $campos .= " juz.activo, ";
                    $campos .= " ads.cveAdscripcion, ";
                    $campos .= " ads.desAdscripcion ";

                    $orden .= " juz  inner join tbladscripciones ads on ads.cveAdscripcion = juz.cveAdscripcion ";
                    $orden .= " where ";
                    $orden .= " juz.activo = 'S' ";
//                    $juzgadoDto->setCveOficialia($oficialia);
//                    $juzgadoDto->setCveAdscripcion($hddAdscripcionJuzgado);
//                    $juzgadoDto->setCveJuzgado($hddJuzgadoBusqueda);
//                    $juzgadoDto->setDesJuzgado($txtDescJuzgado);
//                    var_dump($juzgadoDto);
                    if($juzgadoDto->getCveOficialia() != "")
                        $orden .= " and juz.cveOficialia = " . $juzgadoDto->getCveOficialia() . " ";
//                    if($juzgadoDto->getDesJuzgado() != "")
//                        $orden .= " and juz.desJuzgado = '" . $juzgadoDto->getDesJuzgado() . "' ";
                    if($juzgadoDto->getCveAdscripcion() != "")
                        $orden .= " and juz.cveAdscripcion = " . $juzgadoDto->getCveAdscripcion() . " ";
                    if($juzgadoDto->getCveJuzgado() != "")
                        $orden .= " and juz.cveJuzgado = " . $juzgadoDto->getCveJuzgado() . " ";

                    

                    $JuzgadosDao = new JuzgadosDAO();
                    $juzgados = new JuzgadosDTO();
                    $resultJuzgados = $JuzgadosDao->selectJuzgados($juzgados, $orden, null, $param, $campos);
//                    var_dump($resultJuzgados);
                    $cantidad2 = count($resultJuzgados);
                    if ($resultJuzgados != "") {
                        $json .= '"totalCountJuzgado": "' . ($cantidad2) . '",';
                        $json .= '"resultados": [';
                        for ($j = 0; $j < $cantidad2; $j++) {
                            $json .= "{";
                            $json .= '"cveJuzgado": ' . json_encode($resultJuzgados[$j]['cveJuzgado']) . ',';
                            $json .= '"desJuzgado": ' . json_encode($resultJuzgados[$j]['desJuzgado']) . ',';
                            $json .= '"cveOficialia": ' . json_encode($resultJuzgados[$j]['cveOficialia']) . ',';
                            $json .= '"cveAdscripcion": ' . json_encode($resultJuzgados[$j]['cveAdscripcion']) . ',';
                            $json .= '"desAdscripcion": ' . json_encode($resultJuzgados[$j]['desAdscripcion']) . ',';

                            $arrayJuzgadosMaterias = array();
                            $campos = " ";
                            $orden = " ";

                            $campos .= " jm.cveJuzgadoMateria, ";
                            $campos .= " jm.activo, ";
                            $campos .= " cu.cveCuantia, ";
                            $campos .= " cu.desCuantia, ";
                            $campos .= " cu.activo, ";
                            $campos .= " ma.cveMateria, ";
                            $campos .= " ma.desMateria, ";
                            $campos .= " ma.activo, ";
                            $campos .= " ti.cveTipo, ";
                            $campos .= " ti.desTipo ";

                            $orden .= " jm  ";
                            $orden .= " inner join tblcuantias cu on cu.cveCuantia = jm.cveCuantia ";
                            $orden .= " inner join tblmaterias ma on ma.cveMateria = jm.cveMateria ";
                            $orden .= " inner join tbltipos ti on ti.cveTipo = jm.cveTipo ";
                            $orden .= " where jm.cveJuzgado = " . $resultJuzgados[$j]['cveJuzgado'] . " ";
                            $orden .= " and jm.activo = 'S' ";
//                            var_dump($juzgadoMateriaDto);
                            if($juzgadoMateriaDto->getCveMateria() != "")
                                $orden .= " and jm.cveMateria = ".$juzgadoMateriaDto->getCveMateria();
                            if($juzgadoMateriaDto->getCveCuantia() != "")
                                $orden .= " and jm.cveCuantia = ".$juzgadoMateriaDto->getCveCuantia();
                            if($juzgadoMateriaDto->getCveTipo() != "")
                                $orden .= " and jm.cveTipo = ".$juzgadoMateriaDto->getCveTipo();
//                            $orden .= " and ";
                            $juzgadoMateriaDao = new JuzgadosmateriasDAO();
                            $juzgadoMateriaDtoV = new JuzgadosmateriasDTO();
                            $resulJuzgadosMaterias = $juzgadoMateriaDao->selectJuzgadosmaterias($juzgadoMateriaDtoV, $orden, null, null, $campos);
                            $cantidad3 = count($resulJuzgadosMaterias);
                            if ($resulJuzgadosMaterias != "") {
                                $json .= '"totalCountJuzgadoMateria": "' . ($cantidad3).'"'. ',';
                                $json .= '"resultados": [';
                                for ($k = 0; $k < $cantidad3; $k++) {
                                    $json .= "{";
                                    $json .= '"cveJuzgadoMateria": ' . json_encode($resulJuzgadosMaterias[$k]['cveJuzgadoMateria']) . ',';
                                    $json .= '"cveCuantia": ' . json_encode($resulJuzgadosMaterias[$k]['cveCuantia']) . ',';
                                    $json .= '"desCuantia": ' . json_encode($resulJuzgadosMaterias[$k]['desCuantia']) . ',';
                                    $json .= '"cveMateria": ' . json_encode($resulJuzgadosMaterias[$k]['cveMateria']) . ',';
                                    $json .= '"desMateria": ' . json_encode($resulJuzgadosMaterias[$k]['desMateria']) . ',';
                                    $json .= '"cveTipo": ' . json_encode($resulJuzgadosMaterias[$k]['cveTipo']) . ',';
                                    $json .= '"desTipo": ' . json_encode($resulJuzgadosMaterias[$k]['desTipo']);
                                    $json .= "},";
                                }
                                $json = substr($json, 0, -1);
                                $json .= "]";
                                $json .= "},";
                            } else {
                                $json .= '"totalCountJuzgadoMateria": 0';
                                $json .= "},";
                            }
                        }
                        $json = substr($json, 0, -1);
                        $json .= "  ]";
                    } else {
                        $json .= '"totalCountJuzgado": 0';
                        $json .= "},";
                    }
                    $json = substr($json, 0, -1);
                    if ($resultJuzgados != "") {
                        $json .= "]}]";
                    } else {
                        $json .= "]";
                    }
                    $json .= "},";
//                }
                $json = substr($json, 0, -1);
                $json .= "]";
                $json .= "}";
//                $arrayModificar = json_encode($json);
//                var_dump($arrayModificar);
                return $json;
//            }
        }
    }
    public function reasignarJuzgado($AdscripcionesDto, $cveJuzgado = null, $desJuzgado = null, $cveOficialia = null) {
        echo "\nReasignar Juzgado\n";
        var_dump($AdscripcionesDto);
        var_dump($cveJuzgado);
        var_dump($desJuzgado);
        var_dump($cveOficialia);
        $juzgadoDtoReasignar = new JuzgadosDTO();
        $juzgadoDaoReasignar = new JuzgadosDAO();
        
        $juzgadoDtoReasignar->setActivo("S");
        $juzgadoDtoReasignar->setCveAdscripcion($AdscripcionesDto->getCveAdscripcion());
        $juzgadoDtoReasignar->setCveJuzgado($cveJuzgado);
        $juzgadoDtoReasignar->setCveOficialia($cveOficialia);
        $juzgadoDtoReasignar->setDesJuzgado($desJuzgado);
        
        $juzgadoDtoReasignar = $juzgadoDaoReasignar->updateJuzgados($juzgadoDtoReasignar);
        return $juzgadoDtoReasignar;
    }
    public function updateEliminarAdscripciones_o($AdscripcionesDto, $tipAdscripcionAnterior = null, $esOficialia = null, $esJuzgado = null) {
//        echo "\nupdateEliminarAdscripciones_o_j\n";
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
//        var_dump($AdscripcionesDto);
//        var_dump($tipAdscripcionAnterior);
//        var_dump($esOficialia);
//        var_dump($esJuzgado);
        $adscripcionesDao = new AdscripcionesDAO();
        $adscripcionUpdateEliminar = $adscripcionesDao->updateAdscripciones($AdscripcionesDto, $proveedor);
//        var_dump($adscripcionUpdateEliminar);
        $idAdscripcion = $adscripcionUpdateEliminar[0]->getCveAdscripcion();
//        var_dump($idAdscripcion);
        if($esOficialia != ""){
            if($adscripcionUpdateEliminar != ""){
                $oficialiaDto = new OficialiaDTO();
                $oficialiaDao = new OficialiaDAO();
                $oficialiaDto->setCveAdscripcion($idAdscripcion);
                $oficialiaDto->setCveOficialia($esOficialia);
                $oficialiaDto->setActivo("N");
                $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto, $proveedor);
                if($oficialiaDto != ""){
//                    echo "\n oficialia diferente de vacio\n";
//                    var_dump($oficialiaDto);
                }else{
                    $transaccion = 0;
                }
            }else{
                $transaccion = 0;
            }
        }elseif ($esJuzgado != "") {
            if($adscripcionUpdateEliminar != ""){
                $juzgadoDto = new JuzgadosDTO();
                $juzgadoDao = new JuzgadosDAO();
                $juzgadoDto->setCveAdscripcion($idAdscripcion);
                $juzgadoDto->setCveJuzgado($esJuzgado);
                $juzgadoDto->setActivo("N");
                $juzgadoDto = $juzgadoDao->updateJuzgados($juzgadoDto, $proveedor);
                if($juzgadoDto != ""){
//                    echo "\n juzgado diferente de vacio\n";
//                    var_dump($juzgadoDto);
                }else{
                    $transaccion = 0;
                }
            }else{
                $transaccion = 0;
            }
        }
        $respuesta = array();
        if ($transaccion == 1) {
//            echo '\ncommit\n';
//            var_dump($AdscripcionesDto);
            $proveedor->execute("COMMIT");
            if($esOficialia != ""){
                $resultadoJSON["estatus"] = "OK";
                $respuesta = array("Estatus" => "Ok",
                    "text" => "Se registro la adscripci&oacute;n",
                    "tipoAdscripcion" => "O",
                    "desAdscripcion" => $adscripcionUpdateEliminar[0]->getDesAdscripcion(),
                    "cveAdscripcion" => $adscripcionUpdateEliminar[0]->getCveAdscripcion(),
                    "cveOficialia" => $oficialiaDto[0]->getCveOficialia(),
                    "totalCount" => "1"
                );
            }elseif ($esJuzgado != "") {
                $resultadoJSON["estatus"] = "OK";
                $respuesta = array("Estatus" => "Ok",
                    "text" => "Se registro la adscripci&oacute;n",
                    "tipoAdscripcion" => "O",
                    "desAdscripcion" => $adscripcionUpdateEliminar[0]->getDesAdscripcion(),
                    "cveAdscripcion" => $adscripcionUpdateEliminar[0]->getCveAdscripcion(),
                    "cveOficialia" => $juzgadoDto[0]->getCveJuzgado(),
                    "totalCount" => "1"
                );
            }
        } elseif ($transaccion == 0) {
//            echo '\nrollback\n';
            $AdscripcionesDto = "";
            $proveedor->execute("ROLLBACK");
            $resultadoJSON["estatus"] = "FAIL";
            $respuesta = array("Estatus" => "Error", "Mensaje" => "Error !");
        }
//        var_dump($resultadoJSON);
        $proveedor->close();
        return $respuesta;
    }
    public function selectAdscripciones_o_j_old($AdscripcionesDto, $param = null, $tipo = null, $oficialiaDto = null, $juzgadoDto = null, $juzgadoMateriaDto = null, $estado = null, $municipio = null, $distrito = null) {
//        var_dump($AdscripcionesDto);
//        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
//        $AdscripcionesDao = new AdscripcionesDAO();
//        $AdscripcionesDto = $AdscripcionesDao->selectAdscripciones($AdscripcionesDto, "", null, $param, null);
////        var_dump($AdscripcionesDto);
//        var_dump($tipo);
        $orden = "  ";
        $campos = " * ";

        $orden .= " FROM ( ";
        $orden .= " (SELECT  a.cveAdscripcion,  a.desAdscripcion,  j.cveJuzgado,  j.desJuzgado as descripcion,  'JUZGADO' as origen   ";
        $orden .= " FROM tbladscripciones  a, tbljuzgados j   ";
        $orden .= " WHERE  a.activo = 'S'   ";
        $orden .= " AND j.activo = 'S'   ";
        $orden .= " AND a.cveAdscripcion = j.cveAdscripcion   ";
        if ($AdscripcionesDto->getDesAdscripcion() != "")
            $orden .= " AND a.desAdscripcion = '" . $AdscripcionesDto->getDesAdscripcion() . "' ";
        $orden .= " ) ";
        $orden .= " UNION ALL  (   ";
        $orden .= " SELECT  a.cveAdscripcion,  a.desAdscripcion,  o.cveOficialia,  o.desOficilia,  'OFICIALIA' as origen   ";
        $orden .= " FROM  tbladscripciones a, tbloficialia o   ";
        $orden .= " WHERE  a.activo = 'S'   ";
        $orden .= " AND o.activo = 'S'   ";
        $orden .= " AND a.cveAdscripcion = o.cveAdscripcion   ";
        if ($AdscripcionesDto->getDesAdscripcion() != "")
            $orden .= " AND a.desAdscripcion = '" . $AdscripcionesDto->getDesAdscripcion() . "' ";
        $orden .= " ) ";
        if ($tipo == "O")
            $orden .= " ) AS t WHERE origen = 'OFICIALIA' ";
        if ($tipo == "J")
            $orden .= " ) AS t WHERE origen = 'JUZGADO' ";
        if ($tipo == NULL)
            $orden .= " ) AS t WHERE origen != '' ";
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $adscripcion = new AdscripcionesDTO();
        $AdscripcionesDto = $AdscripcionesDao->selectAdscripciones($adscripcion, $orden, null, $param, $campos);
        if ($AdscripcionesDto != "")
            $datos = array("estatus" => "ok", "totalCount" => "", "pagina" => $param["pag"], "total" => "", "mensaje" => "Resultados", "data" => array());
        else
            return $AdscripcionesDto;
        $datos['data'] = $AdscripcionesDto;
        $datos['totalCount'] = count($AdscripcionesDto);
        return $datos;
    }

    public function insertAdscripciones($AdscripcionesDto, $proveedor = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $AdscripcionesDto = $AdscripcionesDao->insertAdscripciones($AdscripcionesDto, $proveedor);
        return $AdscripcionesDto;
    }

    public function insertAdscripciones_Oficialia($AdscripcionesDto, $proveedor = null, $municipio = null, $distrito = null, $nombreOficialia = null) {
        $resultadoJSON = array("data-adscripcion" => array(), "data-oficialia" => array(), "estatus" => "");
//        var_dump($resultadoJSON);
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $OficialiaDto = new OficialiaDTO();
        $OficialiaDao = new OficialiaDAO();
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
//        var_dump($AdscripcionesDto);
        $AdscripcionesDto = $AdscripcionesDao->insertAdscripciones($AdscripcionesDto, $proveedor);
//        var_dump($AdscripcionesDto[0]);
        array_push($resultadoJSON, $AdscripcionesDto);
//        $resultadoJSON["data-adscripcion"] = $AdscripcionesDto[0];
//        var_dump($resultadoJSON);
//        var_dump($AdscripcionesDto);
        if ($AdscripcionesDto == "") {
//            echo '\n no inserta adscripcion\n';
            $transaccion = 0;
        } else {
//            echo '\n si inserta adscripcion\n';
//            var_dump($AdscripcionesDto);
            $OficialiaDto->setCveAdscripcion($AdscripcionesDto[0]->getCveAdscripcion());
            $OficialiaDto->setDesOficilia($nombreOficialia);
            $OficialiaDto->setCveDistrito($distrito);
            $OficialiaDto->setCveMunicipio($municipio);
//            var_dump($OficialiaDto);
            $OficialiaDto = $OficialiaDao->insertOficialia($OficialiaDto, $proveedor);
//            var_dump($OficialiaDto[0]);
            array_push($resultadoJSON, $OficialiaDto);
//            $resultadoJSON["data-oficialia"] = $OficialiaDto[0];
//            var_dump($resultadoJSON);
//            var_dump($OficialiaDto);

            if ($OficialiaDto == "") {
//                echo '\n no inserta oficialia\n';
                $transaccion = 0;
            } else {
//                echo '\n si inserta adscripcion\n';
            }
        }
        $respuesta = array();
        if ($transaccion == 1) {
//            echo '\ncommit\n';
//            var_dump($AdscripcionesDto);
            $proveedor->execute("COMMIT");
            $resultadoJSON["estatus"] = "OK";
            $respuesta = array("Estatus" => "Ok",
                "text" => "Se registro la adscripci&oacute;n",
                "tipoAdscripcion" => "O",
                "desAdscripcion" => $AdscripcionesDto[0]->getDesAdscripcion(),
                "cveAdscripcion" => $AdscripcionesDto[0]->getCveAdscripcion(),
                "cveOficialia" => $OficialiaDto[0]->getCveOficialia(),
                "totalCount" => "1"
            );
        } elseif ($transaccion == 0) {
//            echo '\nrollback\n';
            $AdscripcionesDto = "";
            $proveedor->execute("ROLLBACK");
            $resultadoJSON["estatus"] = "FAIL";
            $respuesta = array("Estatus" => "Error", "Mensaje" => "Error !");
        }
//        var_dump($respuesta);
        $proveedor->close();
        return $respuesta;
    }

    public function insertAdscripciones_Juzgado($AdscripcionesDto, $proveedor = null, $listadoJuzgadoMateria = null, $oficialia = null) {
//        echo "\n inici ade controller listado\n";
//        var_dump($listadoJuzgadoMateria);
        $resultadoJSON = array("data-adscripcion" => array(), "data-juzgado" => array(), "estatus" => "");
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $JuzgadoDto = new JuzgadosDTO();
        $JuzgadoDao = new JuzgadosDAO();

        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
        $AdscripcionesDto = $AdscripcionesDao->insertAdscripciones($AdscripcionesDto, $proveedor);
        array_push($resultadoJSON, $AdscripcionesDto);
        if ($AdscripcionesDto == "") {
            $transaccion = 0;
        } else {
            $JuzgadoDto->setCveOficialia($oficialia);
            $JuzgadoDto->setCveAdscripcion($AdscripcionesDto[0]->getCveAdscripcion());
            $JuzgadoDto->setDesJuzgado($AdscripcionesDto[0]->getDesAdscripcion());
            $JuzgadoDto = $JuzgadoDao->insertJuzgados($JuzgadoDto, $proveedor);
//            var_dump($JuzgadoDto);
            if ($JuzgadoDto != "") {
//                echo "\nlistado\n";
                $cantidadElementos = (count($listadoJuzgadoMateria->content));
                for ($i = 0; $i < $cantidadElementos; $i++) {
                    $juzgadosMateriasDto = new JuzgadosmateriasDTO();
                    $juzgadosMateriasDao = new JuzgadosmateriasDAO();
//                    echo '\n***####\n' . $listadoJuzgadoMateria->content[$i]->nomnbreCuantia;
                    $juzgadosMateriasDto->setCveJuzgado($JuzgadoDto[0]->getCveJuzgado());
                    $juzgadosMateriasDto->setActivo("S");
                    $juzgadosMateriasDto->setCveMateria($listadoJuzgadoMateria->content[$i]->cveMateria);
                    $juzgadosMateriasDto->setCveCuantia($listadoJuzgadoMateria->content[$i]->cveCuantia);
                    $juzgadosMateriasDto->setCveTipo($listadoJuzgadoMateria->content[$i]->cveTipo);
//                    var_dump($juzgadosMateriasDto);
//                    var_dump($JuzgadoDto);
                    $juzgadosMateriasDto2 = $juzgadosMateriasDao->insertJuzgadosmaterias($juzgadosMateriasDto, $proveedor);
//                    var_dump($juzgadosMateriasDto2);
//                    echo "\n################################################\n";
                    if ($juzgadosMateriasDto2 == "") {
                        $transaccion = 0;
                    }
                }
            } else {
                $transaccion = 0;
            }
            array_push($resultadoJSON, $JuzgadoDto);
            if ($JuzgadoDto == "") {
                $transaccion = 0;
            } else {
                
            }
        }
        $respuesta = array();
        if ($transaccion == 1) {
//            echo '\ncommit\n';
            $proveedor->execute("COMMIT");
            $resultadoJSON["estatus"] = "OK";
            $respuesta = array("Estatus" => "Ok",
                "text" => "Se registro la adscripci&oacute;n",
                "tipoAdscripcion" => "J",
                "desAdscripcion" => $AdscripcionesDto[0]->getDesAdscripcion(),
                "cveAdscripcion" => $AdscripcionesDto[0]->getCveAdscripcion(),
                "cveJuzgado" => $JuzgadoDto[0]->getCveJuzgado(),
                "totalCount" => "1"
            );
        } elseif ($transaccion == 0) {
//            echo '\nrollback\n';
            $AdscripcionesDto = "";
            $proveedor->execute("ROLLBACK");
            $resultadoJSON["estatus"] = "FAIL";
            $respuesta = array("Estatus" => "Error", "Mensaje" => "Error !");
        }
//        var_dump($resultadoJSON);
        $proveedor->close();
        return $respuesta;
    }

    public function updateAdscripciones($AdscripcionesDto, $proveedor = null) {
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        var_dump($AdscripcionesDto);
        $AdscripcionesDto = $AdscripcionesDao->updateAdscripciones($AdscripcionesDto, $proveedor);
        if ($AdscripcionesDto == "") {
            $transaccion = 0;
        } else {
            var_dump($AdscripcionesDto[0]);
            $oficialiaDto = new OficialiaDTO();
            $oficialiaDao = new OficialiaDAO();
            $juzgadoDto = new JuzgadosDTO();
            $juzgadoDao = new JuzgadosDAO();
            $oficialiaDto->setCveAdscripcion($AdscripcionesDto[0]->getCveAdscripcion());
            var_dump($oficialiaDto);
            $oficialiaDto = $oficialiaDao->selectOficialia($oficialiaDto, "", $proveedor, null, null);
            var_dump($oficialiaDto);
            if ($oficialiaDto != "") {
                $oficialiaDto[0]->setActivo("N");
                $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto[0], $proveedor);
                var_dump($oficialiaDto);
            } else {
                var_dump($juzgadoDto);
                $juzgadoDto->setCveAdscripcion($AdscripcionesDto[0]->getCveAdscripcion());
                var_dump($juzgadoDto);
                $juzgadoDto = $juzgadoDao->selectJuzgados($juzgadoDto, "", $proveedor, null, null);
                var_dump($juzgadoDto);
                if ($juzgadoDto != "") {
                    $juzgadoDto[0]->setActivo("N");
                    var_dump($juzgadoDto);
                    $juzgadoDto = $juzgadoDao->updateJuzgados($juzgadoDto[0], $proveedor);
                    var_dump($juzgadoDto);
                    if ($juzgadoDto != "") {
                        echo "\n Juzgados materias \n";
                        $juzgadosMateriasDto = new JuzgadosmateriasDTO();
                        $juzgadosMateriasDao = new JuzgadosmateriasDAO();
                        var_dump($juzgadosMateriasDto);
                        $juzgadosMateriasDto->setCveJuzgado($juzgadoDto[0]->getCveJuzgado());
                        var_dump($juzgadosMateriasDto);
                        $juzgadosMateriasDto = $juzgadosMateriasDao->selectJuzgadosmaterias($juzgadosMateriasDto, "", null, null, null);
                        var_dump($juzgadosMateriasDto);
                        $juzgadosMateriasDto[0]->setActivo("N");
                        var_dump($juzgadosMateriasDto);
                        $juzgadosMateriasDto = $juzgadosMateriasDao->updateJuzgadosmaterias($juzgadosMateriasDto[0], $proveedor);
                        if ($juzgadosMateriasDto == "") {
                            $transaccion = 0;
                        }
                    } else {
                        $transaccion = 0;
                    }
                    var_dump($juzgadoDto);
                }
            }
            if ($oficialiaDto == "" && $juzgadoDto == "") {
                $transaccion = 0;
            }
        }
        if ($transaccion == 1) {
            echo "\ncommit\n";
            $proveedor->execute("COMMIT");
        } else {
            echo "\nrollback\n";
            $proveedor->execute("ROLLBACK");
        }
        $proveedor->close();
        return $AdscripcionesDto;
    }
//                                            $AdscripcionesDto, $tipo,    $oficialia, $tipoAnterior, null, $nombreOficialia
//                                            $AdscripcionesDto, $tipo, $juzgado, $tipoAnterior, $oficialia, $listadoJuzgadoMateria, desJuzgado
    public function updateAdscripciones_o_j($AdscripcionesDto, $tipo = null, $oj = null, $tipoAnterior= null, $oficialia = null, $listadoJuzgadoMateria = null, $nombreOficialia = null, $distrito = null, $municipio = null, $desJuzgado = null) {
//        var_dump($AdscripcionesDto->getCveAdscripcion());
//        echo "\nupdateAdscripciones_o_j\n";
//        var_dump($AdscripcionesDto);
//        var_dump($tipo);
//        var_dump($oj);
//        var_dump($tipoAnterior);
//        var_dump($oficialia);
//        var_dump($listadoJuzgadoMateria);
//        var_dump($nombreOficialia);
        $proveedor = new Proveedor('mysql', 'exhortos');
        $proveedor->connect();
        $proveedor->execute("BEGIN");
        $transaccion = 1;
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
//        var_dump($AdscripcionesDto);
        $AdscripcionesDto2 = $AdscripcionesDao->updateAdscripciones($AdscripcionesDto, $proveedor);
//        echo "\nAdscripcion  update\n";
//        var_dump($AdscripcionesDto2);
        $idAdscripcion = $AdscripcionesDto2[0]->getCveAdscripcion();
        $activoAdscripcion = $AdscripcionesDto2[0]->getActivo();
        if ($AdscripcionesDto2 == "") {
            $transaccion = 0;
        }
        if ($AdscripcionesDto2[0]->getActivo() == "N") {
//            echo "\n *** Se debe de eliminar en juzgados y juzgados materias ****\n";
            $juzgadoDto = new JuzgadosDTO();
            $juzgadoDao = new JuzgadosDAO();
            $juzgadoDto->setCveAdscripcion($idAdscripcion);
            $juzgadoDto->setActivo("S");
//            var_dump($juzgadoDto);
            $juzgadoDto = $juzgadoDao->selectJuzgados($juzgadoDto, "", null, null, null);
//            var_dump($juzgadoDto);
//            var_dump($juzgadoDto);
            $juzgadoDto[0]->setActivo("N");
            $juzgadoDto2 = $juzgadoDao->updateJuzgados($juzgadoDto[0], $proveedor);
//            var_dump($tipoAnterior);
            if ($tipoAnterior == "J") {
//                echo "\n eliminas en la tabla juzgados y en juzgados materias\n";
//                echo "\n******************************\n";
//                var_dump($juzgadoDto2);
                if ($juzgadoDto2 != "") {
//                    var_dump($juzgadoDto2);
                    $juzgadosMateriaDao = new JuzgadosmateriasDAO();
                    $juzgadosMateriaDto = new JuzgadosmateriasDTO();
                    $juzgadosMateriaDto->setCveJuzgado($juzgadoDto2[0]->getCveJuzgado());
                    $juzgadosMateriaDto->setActivo("S");
                    $juzgadosMateriaDto = $juzgadosMateriaDao->selectJuzgadosmaterias($juzgadosMateriaDto, "", null, null, null);
//                    var_dump($juzgadosMateriaDto);
                    $juzgadosMateriaDto[0]->setActivo("N");
//                    var_dump($juzgadosMateriaDto);
                    $juzgadosMateriasDto = $juzgadosMateriaDao->updateJuzgadosmaterias($juzgadosMateriaDto[0], $proveedor);
//                    var_dump($juzgadosMateriaDto);

                    $oficialiaDto = new OficialiaDTO();
                    $oficialiaDao = new OficialiaDAO();
                    $oficialiaDto->setCveAdscripcion($idAdscripcion);
//                    echo "\n***######\n";
//                    var_dump($oficialiaDto);
                    $oficialiaDto2 = $oficialiaDao->selectOficialia($oficialiaDto, "", null, null, null);
//                    var_dump($oficialiaDto2);
                    if ($oficialiaDto2 != "") {
//                        echo "\n desde oficialias resultado \n";
//                        var_dump($oficialiaDto);
                        $oficialiaDto[0]->setActivo("N");
//                        var_dump($oficialiaDto);
                        if ($oficialiaDto != "") {
//                            echo "\nTambien elimina en oficialia \n";
                            $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto[0], $proveedor);
//                            var_dump($oficialiaDto);
                            if ($oficialiaDto == "") {
                                $transaccion = 0;
                            }
                        }
                        if ($juzgadosMateriasDto == "") {
                            $transaccion = 0;
                        }
                    }
                } else {
                    $transaccion = 0;
                }
            } else {
//                echo "\n eliminas en oficialias \n";
            }
        } else {
//            echo "\n HOLA **** \n";
//            var_dump($AdscripcionesDto2[0]->getCveAdscripcion());
//            var_dump($tipo);
//            var_dump($tipoAnterior);
////            $AdscripcionesDto, $tipo = null, $oj = null, $tipoAnterior= null, $oficialia = null, $listadoJuzgadoMateria = null
//            var_dump($AdscripcionesDto);
//            var_dump($tipo);
//            var_dump($oj);
//            var_dump($tipoAnterior);
//            var_dump($oficialia);
//            var_dump($listadoJuzgadoMateria);
            if ($tipo == $tipoAnterior) {
//                echo "\nSe realiza la insercion en la misma table\n";
                if ($tipo == "O") {
                    $oficialiaDto = new OficialiaDTO();
                    $oficialiaDao = new OficialiaDAO();
                    $oficialiaDto->setCveAdscripcion($idAdscripcion);
                    $oficialiaDto->setCveOficialia($oficialia);
                    
//                    echo "\n***######\n";
//                    var_dump($nombreOficialia);
//                    var_dump($oficialiaDto);
                    $oficialiaDto = $oficialiaDao->selectOficialia($oficialiaDto, "", null, null, null);
                    $oficialiaDto[0]->setDesOficilia($nombreOficialia);
                    $oficialiaDto[0]->setCveDistrito($distrito);
                    $oficialiaDto[0]->setCveMunicipio($municipio);
//                    var_dump($oficialiaDto);
//                    if($activoAdscripcion == "N")
//                        $oficialiaDto->setActivo("N");
                    $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto[0], $proveedor);
//                    var_dump($oficialiaDto);
                    if ($oficialiaDto == "") {
//                        echo "\n oficialiaDto vacio\n";
                        $transaccion = 0;
                    }
                }
                if ($tipo == "J") {
//                    $juzgadoDto = new JuzgadosDTO();
//                    $juzgadoDao = new JuzgadosDAO();
//                    $juzgadoDto->setCveAdscripcion($idAdscripcion);
//                    $juzgadoDto = $juzgadoDao->selectJuzgados($juzgadoDto, $proveedor);
//                    $juzgadoDto = $juzgadoDao->updateJuzgados($juzgadoDto, $proveedor);
//                    var_dump($juzgadoDto);
//                    if ($juzgadoDto == "") {
//                        echo "\n juzgadoDto vacio\n";
//                        $transaccion = 0;
//                    }
//                    $AdscripcionesDto, $tipo = null, $oj = null, $tipoAnterior= null, $oficialia = null, $listadoJuzgadoMateria = null
//                    var_dump($AdscripcionesDto); 
//                    var_dump($tipo); 
//                    var_dump($oj); 
//                    var_dump($tipoAnterior); 
//                    var_dump($oficialia); 
//                    var_dump($listadoJuzgadoMateria); 
//                    var_dump($nombreOficialia); 
//                    var_dump($distrito); 
//                    var_dump($municipio); 
//                    var_dump($desJuzgado);
//                    var_dump($AdscripcionesDto);
//                    var_dump($tipo);
//                    var_dump($oj);
//                    var_dump($tipoAnterior);
//                    var_dump($oficialia);
//                    var_dump($listadoJuzgadoMateria);
                    
                    $juzgadoUpdateDto = new JuzgadosDTO();
                    $juzgadoUpdateDao = new JuzgadosDAO();
                    
                    $juzgadoUpdateDto->setActivo("S");
                    $juzgadoUpdateDto->setCveAdscripcion($idAdscripcion);
                    $juzgadoUpdateDto->setCveJuzgado($oj);
                    $juzgadoUpdateDto->setDesJuzgado($desJuzgado);
                    $juzgadoUpdateDto->setCveOficialia($oficialia);
//                    echo "\nJUZGADOS UPDATE DTO \n";
//                    var_dump($juzgadoUpdateDto);
                    $juzgadoUpdateDto = $juzgadoUpdateDao->updateJuzgados($juzgadoUpdateDto, $proveedor);
                    if($juzgadoUpdateDto != ""){
//                        var_dump($juzgadoUpdateDto);
                        $idJuzagdo = $juzgadoUpdateDto[0]->getCveJuzgado();
                        $cantidadListado = count($listadoJuzgadoMateria->content);
//                        echo "\n\n CANTODAD : ".$cantidadListado;
//                        var_dump($listadoJuzgadoMateria)
                        for($i = 0; $i < $cantidadListado; $i++){
                            $juzgadoMateriaUpdateDto = new JuzgadosmateriasDTO();
                            $juzgadosMateriaUpdateDao = new JuzgadosmateriasDAO();
//                            echo "\n Juzgado nuermo \n";
//                            var_dump($listadoJuzgadoMateria->content[$i]->activo);
                            $juzgadoMateriaUpdateDto->setCveJuzgado($idJuzagdo);
                            $juzgadoMateriaUpdateDto->setCveJuzgadoMateria($listadoJuzgadoMateria->content[$i]->cveJuzgadoMateria);
                            $juzgadoMateriaUpdateDto->setCveCuantia($listadoJuzgadoMateria->content[$i]->cveCuantia);
                            $juzgadoMateriaUpdateDto->setCveMateria($listadoJuzgadoMateria->content[$i]->cveMateria);
                            $juzgadoMateriaUpdateDto->setCveTipo($listadoJuzgadoMateria->content[$i]->cveTipo);
                            $juzgadoMateriaUpdateDto->setActivo($listadoJuzgadoMateria->content[$i]->activo);
                            if($listadoJuzgadoMateria->content[$i]->cveJuzgadoMateria == ""){
//                                echo "\nPrueba para vacio nuevo\n";
                                $juzgadoMateriaUpdateDto = $juzgadosMateriaUpdateDao->insertJuzgadosmaterias($juzgadoMateriaUpdateDto, $proveedor);
//                                var_dump($juzgadoMateriaUpdateDto);
                                if($juzgadoMateriaUpdateDto == ""){
                                    $transaccion = 0;
                                }
                            }else{
//                                echo "\n Prueba para update\n";
//                                echo "\nJUZGADO MATERI \n";
//                                var_dump($juzgadoMateriaUpdateDto);
                                $juzgadoMateriaUpdateDto = $juzgadosMateriaUpdateDao->updateJuzgadosmaterias($juzgadoMateriaUpdateDto, $proveedor);
//                                var_dump($juzgadoMateriaUpdateDto);
                                if($juzgadoMateriaUpdateDto == "" && $transaccion != 0){
                                    $transaccion = 0;
                                }
                            }
                        }
                    }else{
                        $transaccion = 0;
                    }
                }
            } else {
//                echo "\nSe debe de eliminar primero antes de actualizar a la otra tabla\n";
                if ($tipo == "O") {
                    if ($tipoAnterior == "J") {
//                        echo "\nborras en juzgado e inserta en oficialia\n";
                        $juzgadoDto = new JuzgadosDTO();
                        $juzgadoDao = new JuzgadosDAO();
//                        var_dump($juzgadoDto);
//                        var_dump($idAdscripcion);
                        $juzgadoDto->setCveAdscripcion($idAdscripcion);
//                        echo "\nHola: \n";
//                        var_dump($juzgadoDto);
                        $juzgadoDto = $juzgadoDao->selectJuzgados($juzgadoDto, null, null, null, null);
//                        echo "\nfernando\n";
//                        var_dump($juzgadoDto);
                        $juzgadoDto = $juzgadoDto[0];
                        $juzgadoDto->setActivo("N");

//                        var_dump($AdscripcionesDto2[0]->getCveAdscripcion());
//                        echo "\n JUZGADO ---------\n";
//                        var_dump($juzgadoDto);
                        $juzgadoDto = $juzgadoDao->updateJuzgados($juzgadoDto, $proveedor);
//                        var_dump($juzgadoDto);
                        if ($juzgadoDto == "") {
//                            echo "\nES vacio ---------\n";
                            $transaccion = 0;
                        }
                        if ($juzgadoDto != "") {
//                            echo "\nOFICIALIA ---------\n";
                            $oficialiaDto = new OficialiaDTO();
                            $oficialiaDao = new OficialiaDAO();
                            $oficialiaDto->setCveAdscripcion($idAdscripcion);
                            $oficialiaDto->setActivo("S");
//                            var_dump($oficialiaDto);
                            $oficialiaDto = $oficialiaDao->insertOficialia($oficialiaDto, $proveedor);
//                            var_dump($oficialiaDto);
                            if ($oficialiaDto = "") {
                                $transaccion = 0;
                            }
                        }
                    }
                }
                if ($tipo == "J") {
                    if ($tipoAnterior == "O") {
//                        echo "\nborras en oficialia e inserta en juzgado\n";
                        $oficialiaDto = new OficialiaDTO();
                        $oficialiaDao = new OficialiaDAO();
                        $oficialiaDto->setCveAdscripcion($idAdscripcion);
//                        var_dump($oficialiaDto);
                        $oficialiaDto = $oficialiaDao->selectOficialia($oficialiaDto, null, null, null, null);
//                        echo "\nFERNANDO\n";
//                        var_dump($oficialiaDto);
                        $oficialiaDto = $oficialiaDto[0];
                        $oficialiaDto->setActivo("N");

//                        var_dump($AdscripcionesDto2[0]->getCveAdscripcion());
//                        echo "\nOFICIALIA ---------\n";
//                        var_dump($oficialiaDto);
                        $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto, $proveedor);
//                        var_dump($oficialiaDto);
                        if ($oficialiaDto == "") {
//                            echo "\nES vacio ---------\n";
                            $transaccion = 0;
                        }
                        if ($oficialiaDto != "") {
//                            echo "\n JUZGADO ---------\n";
                            $juzgadoDto = new JuzgadosDTO();
                            $juzgadoDao = new JuzgadosDAO();
                            $juzgadoDto->setCveAdscripcion($idAdscripcion);
                            $juzgadoDto->setActivo("S");
//                            var_dump($juzgadoDto);
                            $juzgadoDto = $juzgadoDao->insertJuzgados($juzgadoDto, $proveedor);
//                            var_dump($juzgadoDto);
                            if ($juzgadoDto == "") {
                                $transaccion = 0;
                            }
                        }
                    }
                }
            }
//        if ($tipo == "O") {
//            $oficialiaDto = new OficialiaDTO();
//            $oficialiaDao = new OficialiaDAO();
//            $oficialiaDto->setCveAdscripcion($AdscripcionesDto->getCveAdscripcion());
//            $oficialiaDto = $oficialiaDao->updateOficialia($oficialiaDto, $proveedor);
//            if ($oficialiaDto = "") {
//                $transaccion = 0;
//            }
//        }
//        if ($tipo == "J") {
//            $juzgadoDto = new JuzgadosDTO();
//            $juzgadoDao = new JuzgadosDAO();
//            $juzgadoDto->setCveAdscripcion($AdscripcionesDto->getCveAdscripcion());
//            $juzgadoDto = $juzgadoDao->updateJuzgados($juzgadoDto, $proveedor);
//            if ($juzgadoDto = "") {
//                $transaccion = 0;
//            }
//        }
            if ($transaccion == 1) {
//                echo "\ncommit\n";
                $proveedor->execute("COMMIT");
            } else {
//                echo "\nrollback\n";
                $proveedor->execute("ROLLBACK");
            }
            $proveedor->close();
        }
        return $AdscripcionesDto2;
    }

    public function deleteAdscripciones($AdscripcionesDto, $proveedor = null) {
        $AdscripcionesDto = $this->validarAdscripciones($AdscripcionesDto);
        $AdscripcionesDao = new AdscripcionesDAO();
        $AdscripcionesDto = $AdscripcionesDao->deleteAdscripciones($AdscripcionesDto, $proveedor);
        return $AdscripcionesDto;
    }

    public function getPaginas($AdscripcionesDto, $param, $tipo) {
        //$campos = " o.cveOficialia,o.desOficilia,o.cveMunicipio,o.activo,e.cveEstado,e.desEstado,m.desMunicipio,o.cveDistrito,d.desDistrito ";
        $orden = "  ";
        $campos = " count(*) as totalCount";
        $orden .= " FROM ( ";
        $orden .= " (SELECT  a.cveAdscripcion,  a.desAdscripcion,  j.cveJuzgado,  j.desJuzgado as descripcion,  'JUZGADO' as origen   ";
        $orden .= " FROM tbladscripciones  a, tbljuzgados j   ";
        $orden .= " WHERE  a.activo = 'S'   ";
        $orden .= " AND j.activo = 'S'   ";
        $orden .= " AND a.cveAdscripcion = j.cveAdscripcion   ";
        if ($AdscripcionesDto->getDesAdscripcion() != "")
            $orden .= " AND a.desAdscripcion = '" . $AdscripcionesDto->getDesAdscripcion() . "' ";
        $orden .= " ) ";
        $orden .= " UNION ALL  (   ";
        $orden .= " SELECT  a.cveAdscripcion,  a.desAdscripcion,  o.cveOficialia,  o.desOficilia,  'OFICIALIA' as origen   ";
        $orden .= " FROM  tbladscripciones a, tbloficialia o   ";
        $orden .= " WHERE  a.activo = 'S'   ";
        $orden .= " AND o.activo = 'S'   ";
        $orden .= " AND a.cveAdscripcion = o.cveAdscripcion   ";
        if ($AdscripcionesDto->getDesAdscripcion() != "")
            $orden .= " AND a.desAdscripcion = '" . $AdscripcionesDto->getDesAdscripcion() . "' ";
        $orden .= " ) ";
        if ($tipo == "O")
            $orden .= " ) AS t WHERE origen = 'OFICIALIA' ";
        if ($tipo == "J")
            $orden .= " ) AS t WHERE origen = 'JUZGADO' ";
        if ($tipo == NULL)
            $orden .= " ) AS t WHERE origen != '' ";
        $AdscripcionDao = new AdscripcionesDAO();
        $param["paginacion"] = false;
        $adscripcion = new AdscripcionesDTO();
        $numTot = $AdscripcionDao->selectAdscripciones($adscripcion, $orden, null, null, $campos);
//        var_dump($numTot);
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
