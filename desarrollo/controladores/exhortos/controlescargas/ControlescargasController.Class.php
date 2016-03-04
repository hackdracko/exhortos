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
define('WP_DEBUG', true); // enable debugging mode
ini_set("// error_log", dirname(__FILE__) . "/../../../logs/ControlesCargasController.log");
ini_set("log_errors", 1);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/controlescargas/ControlescargasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/configuracionescargas/ConfiguracionescargasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/controlescargas/ControlescargasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/configuracionescargas/ConfiguracionescargasController.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/oficialia/OficialiaController.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juzgados/JuzgadosController.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/juzgadosmaterias/JuzgadosmateriasController.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgadosmaterias/JuzgadosmateriasDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class ControlescargasController {

    private $proveedor;
    private $logs;
    private $name;

    public function __construct() {
        
    }

    public function validarControlescargas($ControlescargasDto) {
        $ControlescargasDto->setidControlCarga(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getidControlCarga()))));
        $ControlescargasDto->setcveConfiguracionCarga(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getcveConfiguracionCarga()))));
        $ControlescargasDto->setcveMateria(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getcveMateria()))));
        $ControlescargasDto->setcveJuicio(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getcveJuicio()))));
        $ControlescargasDto->setcveCuantia(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getcveCuantia()))));
        $ControlescargasDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getcveJuzgado()))));
        $ControlescargasDto->settotalAsignados(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->gettotalAsignados()))));
        $ControlescargasDto->setanioControl(strtoupper(str_ireplace("'", "", trim($ControlescargasDto->getanioControl()))));
        return $ControlescargasDto;
    }

    public function selectControlescargas($ControlescargasDto, $proveedor = null) {
        $ControlescargasDto = $this->validarControlescargas($ControlescargasDto);
        $ControlescargasDao = new ControlescargasDAO();
        $ControlescargasDto = $ControlescargasDao->selectControlescargas($ControlescargasDto, $proveedor);
        return $ControlescargasDto;
    }

    public function insertControlescargas($ControlescargasDto, $proveedor = null) {
        $ControlescargasDto = $this->validarControlescargas($ControlescargasDto);
        $ControlescargasDao = new ControlescargasDAO();
        $ControlescargasDto = $ControlescargasDao->insertControlescargas($ControlescargasDto, $proveedor);
        return $ControlescargasDto;
    }

    public function updateControlescargas($ControlescargasDto, $proveedor = null) {
        $ControlescargasDto = $this->validarControlescargas($ControlescargasDto);
        $ControlescargasDao = new ControlescargasDAO();
//$tmpDto = new ControlescargasDTO();
//$tmpDto = $ControlescargasDao->selectControlescargas($ControlescargasDto,$proveedor);
//if($tmpDto!=""){//$ControlescargasDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ControlescargasDto = $ControlescargasDao->updateControlescargas($ControlescargasDto, $proveedor);
        return $ControlescargasDto;
//}
//return "";
    }

    public function deleteControlescargas($ControlescargasDto, $proveedor = null) {
        $ControlescargasDto = $this->validarControlescargas($ControlescargasDto);
        $ControlescargasDao = new ControlescargasDAO();
        $ControlescargasDto = $ControlescargasDao->deleteControlescargas($ControlescargasDto, $proveedor);
        return $ControlescargasDto;
    }

    private function getFecha($proveedor) {
        $sql = "Select date_format(now(),'%Y-%m-%d') as fecha";
        $proveedor->execute($sql);
        if (!$proveedor->error()) {
            if ($proveedor->rows($proveedor->stmt) > 0) {
                $fecha = $proveedor->fetch_array($proveedor->stmt, 0);
                return $fecha["fecha"];
            }
        }
    }

    private function getHora($proveedor) {
        $sql = "Select date_format(now(),'%H:%i:%s') as hora";
        $proveedor->execute($sql);
        if (!$proveedor->error()) {
            if ($proveedor->rows($proveedor->stmt) > 0) {
                $fecha = $proveedor->fetch_array($proveedor->stmt, 0);
                return $fecha["hora"];
            }
        }
    }

    public function getDisponibilidad($configuracionesCargasDto, $proveedor = null) {
        // error_log("******REVISAMOS QUE LA OFICIALIA ESTE EN EL HORARIO DE ATENCION******");
        $configuracionesCargasDto->setActivo('S');
        $configuracionesCargasDto->setInicia($this->getHora($proveedor));
        $configuracionesCargasDao = new ConfiguracionesCargasDAO(null, true, $this->name);
        $configuracionesCargasDto = $configuracionesCargasDao->selectConfiguracionescargas($configuracionesCargasDto, "  ORDER BY fechaRegistro DESC", $proveedor);
//        $configuracionesCargasDto = $configuracionesCargasDao->selectConfiguracionesCarga($configuracionesCargasDto, $proveedor, "fechaRegistro DESC");

        if ($configuracionesCargasDto != "") {
            // error_log("******LA OFICIALIA ESTA EN EL HORARIO DE ATENCION******");
            return 0;
        } else {
            // error_log("******LA OFICIALIA NO ESTA EN EL HORARIO DE ATENCION******");
            return -2;
        }
    }

    public function noDispinibilidadJuzgado($oficialiaJuzDto, $fecha) {

        if (date('YmdHis', strtotime($oficialiaJuzDto->getFechaNoDisponibilidadInicia())) <= date('YmdHis', strtotime($fecha))) {
            if (date('YmdHis', strtotime($oficialiaJuzDto->getFechaNoDisponibilidadTermina())) >= date('YmdHis', strtotime($fecha))) {
                return true;
            }
        }
        return false;
    }

    private function burbuja($controlesCargasDto) {
        if (count($controlesCargasDto) > 0) {
            // error_log("******Se procede a ordenar el listado de juzgados por el total de asignados******");
            $aux = "";
            for ($x = 0; $x < count($controlesCargasDto); $x++) {
                for ($y = 0; $y < count($controlesCargasDto) - 1; $y++) {
                    if ($controlesCargasDto[$y]->getTotalAsignados() < $controlesCargasDto[$y + 1]->getTotalAsignados()) {
                        $aux = $controlesCargasDto[$y];
                        $controlesCargasDto[$y] = $controlesCargasDto[$y + 1];
                        $controlesCargasDto[$y + 1] = $aux;
                    }
                }
            }
            // error_log("******Termina de ordenar******");
            return $controlesCargasDto;
        }
        return "";
    }

    public function getJuzgado($configuracionesCargasDto = "", $controlesCargasDto = "", $proveedor = null, $params = null) {
        if ($configuracionesCargasDto == "") {
            $configuracionesCargasDto = new ConfiguracionesCargasDTO();
        }
        $oficialiasController = new OficialiaController();
        $OficialiaDto = new OficialiaDTO();
        $OficialiaDto->setActivo("S");
        $OficialiaDto->setCveAdscripcion($configuracionesCargasDto->getCveOficialia());
        $OficialiaDto=$oficialiasController->selectOficialia($OficialiaDto);
                if($OficialiaDto!=""){
                    $configuracionesCargasDto->setCveOficialia($OficialiaDto[0]->getCveOficialia());
                }
        $this->log = new Logger("", $this->name);
        if (((int) $configuracionesCargasDto->getCveOficialia()) > 0) {

            $this->name = "ControlCarga_" . $configuracionesCargasDto->getCveOficialia();

            // error_log("******INICIA PROCESO DE DISTRIBUCION DE CARGA******");
            // error_log("******BUSCANDO CONFIGURACION DE LA OFICIALIA******");
            if ($this->getDisponibilidad($configuracionesCargasDto, $proveedor) == 0) {
                $sorteo = array();
                $proceso = 1;
                $juzgado = 0;
                $count = 0;

                $configuracionesCargasDto->setActivo('S');
                $configuracionesCargasDao = new ConfiguracionesCargasDAO(null, true, $this->name);
                $configuracionesCargasDto = $configuracionesCargasDao->selectConfiguracionescargas($configuracionesCargasDto, " ORDER BY fechaRegistro DESC", $proveedor);

                if ($configuracionesCargasDto != "") {
                    //print_r($configuracionesCargasDto,true);

                    // error_log("******Configuracion Total: " . count($configuracionesCargasDto));
                    // error_log("******Descripcion Configuracion \nOficialia: " . $configuracionesCargasDto[0]->getCveOficialia() . "\nJuicio: ");

                    // error_log("******BUSCAMOS LOS JUZGADOS DE LA OFICIALIA : ");
//                    $juzgadosDao = new JuzgadosDAO(null, true, $this->name);
//                    $oficialiasJuzDto->setActivo("S");
//                    $oficialiasJuzDto = $juzgadosDao->selectOficialiasJuz($oficialiasJuzDto, $proveedor, " proporcion DESC");
                    $cveOficialia = $configuracionesCargasDto[0]->getCveOficialia();
                    $juzgadosDto = new JuzgadosDTO();
                    $juzgadosDto->setActivo("S");
                    $juzgadosDto->setCveOficialia($cveOficialia);
                    $juzgadosController = new JuzgadosController();
                    $juzgados = $juzgadosController->selectJuzgados($juzgadosDto);
                    
                    $listacveJuz = "";
                    foreach ($juzgados as $juzgado) {
                        $listacveJuz.=$juzgado->getCveJuzgado() . ",";
                    }
                    if ($listacveJuz != "") {
                        $listacveJuz = trim($listacveJuz, ",");
                    }

                    $juzgadosMateriasController = new JuzgadosmateriasController();
                    $juzgadosmateriasDto = new JuzgadosmateriasDTO();
                    $juzgadosmateriasDto->setCveJuzgado($listacveJuz);
                    $juzgadosmateriasDto->setCveCuantia($params["cveCuantia"]);
                    $juzgadosmateriasDto->setCveMateria($params["cveMateria"]);
                    $juzgadosMaterias = $juzgadosMateriasController->selectJuzgadosmaterias($juzgadosmateriasDto, "", $proveedor);
                   // error_log(print_r($juzgadosMaterias));
                   $juzgadosTmp="";
                    if ($juzgadosMaterias != "") {
                        $juzgadosTmp=array();
                         $juzgadosTmp = $juzgados;
                        foreach ($juzgados as $pos => $juzgado) {
                            $encontrado = false;
                            foreach ($juzgadosMaterias as $juzgadoMateria) {
                                if ($juzgadoMateria->getCveJuzgado() == $juzgado->getCveJuzgado()) {
                                    
                                    $encontrado = true;
                                    break;
                                }
                            }
                            if ($encontrado == false) {
                                unset($juzgadosTmp[$pos]);
                            }
                        }
                         $juzgados=array_values($juzgadosTmp);
                    }else{
                        $juzgados="";
                    }
                    //array_values($juzgadosTmp);
                    
//                    $juzgados=$juzgadosTmp;
                    
                    


                    // error_log("******TOTAL DE JUZGADOS ENCONTRADOS: " . count($juzgados));
                    if ($juzgados != "") {

                        $fecha = $this->getFecha($proveedor);
                        $hora = $this->getHora($proveedor);
                        $fecha.=" " . $hora;

                        $count = 0;
                        error_log(print_r($juzgados,true));
                        for ($index = 0; $index < count($juzgados); $index++) {
                            //if (!$this->noDispinibilidadJuzgado($juzgados[$index], $fecha)) {
                            $sorteo[$count] = $juzgados[$index];
                            $count++;
                            //}
                        }
                        error_log(print_r($sorteo,true));

                        if (count($sorteo) > 0) {
                           // print_r($sorteo);
                            //if ($controlesCargasDto->getCveTipoNumero() != "3") {
                            // error_log("******IDENTIFICAMOS SI SERA POR TOPE CARGA O PROPORCION");
                            // error_log("******EL PROCESO POR DEFAULT: " . $proceso);
                            // error_log("******EL PROCESO POR DEFAULT: " . $proceso);

                            if (count($sorteo) > 0) {
                                for ($index = 0; $index < count($sorteo); $index++) {
                                    // error_log(print_r($sorteo[$index],true));
                                    if ((int) $sorteo[$index]->getProporcion() > 1) {
                                        // error_log("******LA PROPORCION ES MAYOR A 1 (int) " . $sorteo[$index]->getProporcion() . " > 1");
                                        $proceso = 2;
                                        break;
                                    }
                                }
                            }
//                            } else if ($controlesCargasDto->getCveTipoNumero() == "3") {
//                                // error_log("******IDENTIFICAMOS SI SERA POR TOPE CARGA O PROPORCION PARA EXHORTO");
//                                // error_log("******EL PROCESO POR DEFAULT: " . $proceso);
//
//                                if (count($sorteo) > 0) {
//                                    // error_log(print_r($sorteo, true));
//                                    for ($index = 0; $index < count($sorteo); $index++) {
//
//                                        if ((int) $sorteo[$index]->getProporcionExhorto() > 1) {
//                                            // error_log("******LA PROPORCION ES MAYOR A 1 (int) " . $sorteo[$index]->getProporcionExhorto() . " > 1");
//                                            $proceso = 2;
//                                            break;
//                                        }
//                                    }
//                                }
//                            }


                            if ($proceso == 1) {
                                // error_log("******SE CONSIDERA QUE SERA POR TOPE CARGA");
                                $juzgado = $this->topeCarga($sorteo, $configuracionesCargasDto[0], $controlesCargasDto, $proveedor,$params);
                                // error_log("******TERMINA PROCESO DE DISTRIBUCION DE CARGA******");
                                return $juzgado;
                            } else if ($proceso == 2) {
                                // error_log("******SE CONSIDERA QUE SERA POR PROPORCION");
                                $juzgado = $this->proporcion($sorteo, $configuracionesCargasDto[0], $controlesCargasDto, $proveedor,$params);
                                // error_log("******TERMINA PROCESO DE DISTRIBUCION DE CARGA******");
                                return $juzgado;
                            }
                        } else {
                            // error_log("******NO EXISTEN JUZGADOS EN HORARIO DISPONIBLE");
                            return -3;
                        }
                    } else {
                        // error_log("******NO EXISTEN JUZGADOS");
                        return 0;
                    }
                } else {
                    // error_log("******NO EXISTEN CONFIGURACION PARA LA OFICIALIA******");
                    return -1;
                }
                return $juzgado;
            } else {
                /* No esta en horario de atencion */
                // error_log("******NO SE ENCUENTRA EN HORARIO DE ATENCION******");
                return -2;
            }
        } else {
            // error_log("******LA CLAVE DE OFICIALIA LLEGO VACIO O IGUAL A CERO******");
            return -4;
        }
    }

    private function topeCarga($sorteo, $configuracionesCargasDto, $controlesCargasDto, $proveedor,$params) {
        // error_log("******COMIENZA CON EL METODO TOPE DE CARGA******");
        $auxControlCargaDto = $controlesCargasDto;
        $historial = array();
        $count = 0;
        $aux = $sorteo;
        // error_log("******Revisamos que existan juzgados: " . count($sorteo));
        if (count($sorteo) > 0) {
            $controlesCargasDao = new ControlesCargasDAO(null, true, $this->name);
            for ($index = 0; $index < count($sorteo); $index++) {
                // error_log("******BUSCAMOS EL ANTECEDENTE DE LOS TOTALES ASIGNADOS******");
                $controlesCargasDto = new ControlesCargasDTO();
                //$controlesCargasDto->setCveJuicio($auxControlCargaDto->getCveJuicio());
                $controlesCargasDto->setCveCuantia($params["cveCuantia"]);
                $controlesCargasDto->setCveMateria($params["cveMateria"]);
                $controlesCargasDto->setAnioControl(date('Y', strtotime($this->getFecha($proveedor))));
                $controlesCargasDto->setCveJuzgado($sorteo[$index]->getCveJuzgado());
                $controlesCargasDto->setCveConfiguracionCarga($configuracionesCargasDto->getCveConfiguracionCarga());

                $controlesCargasDto = $controlesCargasDao->selectControlescargas($controlesCargasDto,"", $proveedor);

                if ($controlesCargasDto != "") {
                    $historial[$count] = $controlesCargasDto[0];
                    $totalAsignados = 0;
                    foreach ($controlesCargasDto as $controlCarga) {
                        $totalAsignados+=$controlCarga->getTotalAsignados();
                    }
                    $historial[$count]->setTotalAsignados($totalAsignados);
                    $count++;
                } else {
                    $historial[$count] = new ControlesCargasDTO();
                    $historial[$count]->setCveJuicio($auxControlCargaDto->getCveJuicio());
                    $historial[$count]->setCveCuantia($params["cveCuantia"]);
                    $historial[$count]->setCveMateria($params["cveMateria"]);
                    $historial[$count]->setAnioControl(date('Y', strtotime($this->getFecha($proveedor))));
                    $historial[$count]->setCveJuzgado($sorteo[$index]->getCveJuzgado());
                    $historial[$count]->setCveConfiguracionCarga($configuracionesCargasDto->getCveConfiguracionCarga());
                    $historial[$count]->setTotalAsignados(0);
                    $count++;
                }
            }

            if (count($historial) > 0) {
                $historial = $this->burbuja($historial);

                // error_log("Juzgados ordernados =>" . print_r($historial, true));
                if ($historial != "") {
                    // error_log("******Se revisa que el metodo de ordenamiento regrese el listado******");
                    $mayor = 0;
                    $menor = count($historial) - 1;
                    $sorteo = array();
                    $count = 0;
                    // error_log("******Se comienza ha ver que juzgados estaran disponibles para el sorteo******");
                    for ($x = count($historial) - 1; $x >= 0; $x--) {
                        for ($i = 0; $i < count($aux); $i++) {
                            if ($aux[$i]->getCveJuzgado() == $historial[$x]->getCveJuzgado()) {
                               // print_r($aux[$i]);
                                $resultado = $historial[$x]->getTotalAsignados() + $aux[$i]->getControl();
                                break;
                            }
                        }
                        // error_log("Operacion  =>" . $resultado . "-" . $historial[$mayor]->getTotalAsignados());
                        $resultado = $resultado - $historial[$mayor]->getTotalAsignados();
                        // error_log("Resultado =>" . $resultado . " Para el Juzgado =>" . $historial[$x]->getCveJuzgado());
                        if ($resultado < 0) { //$configuracionesCargasDto->getTopeCarga()
                            // error_log("La diferencia =>" . $historial[$x]->getTotalAsignados() . "-" . $historial[$menor]->getTotalAsignados());
                            $diferencia = $historial[$x]->getTotalAsignados() - $historial[$menor]->getTotalAsignados();
                            // error_log("La diferencia =>" . $diferencia . "Control Carga =>" . $configuracionesCargasDto->getTopeCarga());
                            // error_log( "tope cargar obtenido => ".$configuracionesCargasDto->getTopeCarga());
                            if ($diferencia <= $configuracionesCargasDto->getTopeCarga()) {
                                // error_log("=============  Juzgado para sorteo" . print_r($historial[$x], true));
                                $sorteo[$count] = $historial[$x];
                                //   // error_log("******juzgado para sorteo numero " . $count . ": " . $historial[$x]->getCveJuzgado());
                            }



                            $count++;
                        }
                    }
                    //   // error_log(print_r($sorteo,true));
                    if ($sorteo[$count] > 0) {
                        $sorteo[$count] = $historial[$menor];
                        $count++;
                    }

                    // error_log("******Revisamos que el listado de juzgados sea mayor a 0");
                    if (count($sorteo) <= 0) {
                        // error_log("******Como el listado es menor a 0 significa que todos los juzgados estan iguales y se contemplan todos para el sorteo");
                        $sorteo = $aux;
                    } else {
                        $juzgados = array();
                        $count = 0;
                        for ($index = 0; $index < count($sorteo); $index++) {
                            for ($i = 0; $i < count($aux); $i++) {
                                if ($aux[$i]->getCveJuzgado() == $sorteo[$index]->getCveJuzgado()) {
                                    $juzgados[$count] = $aux[$i];
                                    $count++;
                                    break;
                                }
                            }
                        }
                    }
                    shuffle($sorteo);
                    // error_log("Arreglo des ordenado" . print_r($sorteo, true));
                    $limite = count($sorteo) - 1;
                    // error_log("******Obtenemos el limite de indices para sortear: " . $limite);
                    while (1) {
                        $index = rand(0, $limite);
                        // error_log("******Obtenemos juzgado aleatorio: " . $sorteo[$index]->getCveJuzgado());
                        $controlesCargasDto = new ControlesCargasDTO();
                        // $controlesCargasDto->setCveJuicio($auxControlCargaDto->getCveJuicio());
                        $controlesCargasDto->setCveCuantia($params["cveCuantia"]);
                        $controlesCargasDto->setCveMateria($params["cveMateria"]);
                        $controlesCargasDto->setAnioControl(date('Y', strtotime($this->getFecha($proveedor))));
                        $controlesCargasDto->setCveJuzgado($sorteo[$index]->getCveJuzgado());
                        $controlesCargasDto->setCveConfiguracionCarga($configuracionesCargasDto->getCveConfiguracionCarga());
                        $controlesCargasDao = new ControlesCargasDAO(null, true, $this->name);
                        $tmp = $controlesCargasDao->selectControlescargas($controlesCargasDto,"", $proveedor);
                        // error_log("******Revisamos que exista el antecedente");
                        if ($tmp != "") {
                            // error_log("******Se determina que existe se actualiza");
                            $tmp = $tmp[0];
                            $tmp->setTotalAsignados($tmp->getTotalAsignados() + 1);
                            $tmp = $controlesCargasDao->updateControlescargas($tmp, $proveedor);
                            if ($tmp != "") {
                                // error_log("******Se actualizo de forma correcta");
                                // error_log("******El juzgado a regresar : " . $sorteo[$index]->getCveJuzgado());
                                return $sorteo[$index]->getCveJuzgado();
                            } else {
                                // error_log("******Ocurrio un error al actualizar el registro");
                                // error_log("******El juzgado a regresar : " . $sorteo[$index]->getCveJuzgado());
                                return 0;
                            }
                        } else {
                            // error_log("******Se determina que no existe antecedente");
                            // error_log("******Se inserta uno nuevo");
                            // error_log("******El juzgado a regresar : " . $sorteo[$index]->getCveJuzgado());
                            $controlesCargasDto->setTotalAsignados(1);
                            $tmp = $controlesCargasDao->insertControlescargas($controlesCargasDto, $proveedor);
                            if ($tmp != "") {
                                // error_log("******Se inserto de forma correcta");
                                // error_log("******El juzgado a regresar : " . $sorteo[$index]->getCveJuzgado());
                                return $sorteo[$index]->getCveJuzgado();
                            } else {
                                // error_log("******Ocurrio un error al actualizar el registro");
                                // error_log("******El juzgado a regresar : " . $sorteo[$index]->getCveJuzgado());
                                return 0;
                            }
                        }
                    }
                } else {
                    // error_log("******TERMINA CON EL METODO TOPE DE CARGA******");
                    return 0;
                }
            }
        }
        // error_log("******TERMINA CON EL METODO TOPE DE CARGA******");
        return 0;
    }

    private function proporcion($sorteo, $configuracionesCargasDto, $controlesCargasDto, $proveedor,$params) {
        // error_log("******COMIENZA CON EL METODO DE PROPORCION******");
        $auxControlCargaDto = $controlesCargasDto;
        $historial = array();
        $count = 0;
        // error_log("******COMIENZA CON EL METODO PROPORCION******");
        $limite = count($sorteo) - 1;
        // error_log("******OBTENEMOS EL LIMITE DE INDICES PARA SORTEAR:" . $limite);

        while (1) {//Comienza Ciclo
            // error_log("******COMIENZA EL CICLO PARA OBTENER UN JUZGADO******");
            $index = rand(0, $limite);
            // error_log("******INDICE DEL VECTOR: " . $index . " JUZGADO: " . $sorteo[$index]->getCveJuzgado() . " PROPORCION: " . $sorteo[$index]->getProporcion() . " ASIGNADOS: " . $sorteo[$index]->getAsignados());
            // error_log("******REVISAMOS QUE EL NUMERO DE INTENTOS NO SEA MAYOR AL NUMERO DE JUZGADOS");
            // error_log("******TOTAL DE JUZGADOS: " . count($sorteo) . " HISTORIAL DE INTENTOS: " . count($historial));

            if (count($sorteo) > count($historial)) {

                // error_log("******SE DETERMINA QUE EL NUMERO DE INTENTOS ES PERMITIDO");
                $encontrado = false;
                if (count($historial) != 0) {
                    // error_log("******SE BUSCA EL INDICE EL EL HISTORIAL PARA NO INTENTAR ASIGNAR DE NUEVO");
                    for ($x = 0; $x < count($historial); $x++) {
                        if ($historial[$x] == $sorteo[$index]->getCveJuzgado()) {
                            // error_log("******SE ENCONTRO EN EL HISTORIAL: " . $index . " JUZGADO: " . $sorteo[$index]->getCveJuzgado() . " PROPORCION: " . $sorteo[$index]->getProporcion() . " ASIGNADOS: " . $sorteo[$index]->getAsignados());
                            $encontrado = true;
                            break;
                        }
                    }
                }

                // error_log("******SE REVISA EL RESULTADO DE LA BUSQUEDA ANTERIOR");

                if (!$encontrado) {
                    // error_log("******NO SE ENCONTRO EN EL HISTORIAL");
                    // error_log("******SE REVISA QUE LAS VECES QUE SE LE HA ASIGNADO NO EXCEDA LA PROPORCION DESTINADA");
                    if (($sorteo[$index]->getAsignados() < $sorteo[$index]->getProporcion())) {
                        // error_log("******JUZGADO POSIBLE : " . $index . " JUZGADO: " . $sorteo[$index]->getCveJuzgado() . " PROPORCION: " . $sorteo[$index]->getProporcion() . " ASIGNADOS: " . $sorteo[$index]->getAsignados());
                        // error_log("******OBTENEMOS EL CONTROL CARGA");
                        $controlesCargasDto = new ControlesCargasDTO();
                        $controlesCargasDto->setCveJuicio($auxControlCargaDto->getCveJuicio());
                        $controlesCargasDto->setCveCuantia($params["cveCuantia"]);
                        $controlesCargasDto->setCveMateria($params["cveMAteria"]);
                        $controlesCargasDto->setAnioControl(date('Y', strtotime($this->getFecha($proveedor))));
                        $controlesCargasDto->setCveJuzgado($sorteo[$index]->getCveJuzgado());
                        $controlesCargasDto->setCveConfiguracionCarga($configuracionesCargasDto->getCveConfiguracionCarga());
                        $controlesCargasDao = new ControlesCargasDAO(null, true, $this->name);
                        $tmp = $controlesCargasDao->selectControlescargas($controlesCargasDto,"", $proveedor);

                        if ($tmp != "") {
                            // error_log("******SE ENCONTRARON LOS ANTECEDENTES");
                            // error_log("******SE ACTUALIZA EL REGISTRO");
                            $tmp = $tmp[0];
                            $tmp->setTotalAsignados($tmp->getTotalAsignados() + 1);
                            $tmp = $controlesCargasDao->updateControlescargas($tmp, $proveedor);
                            if ($tmp != "") {
                                // error_log("******SE ACTUALIZA EL NUMERO DE ASIGNADOS EN LA TABA DE OFICIALIASJUZ asignandos =>" . $sorteo[$index]->getAsignados() . "despues =>" . $sorteo[$index]->getAsignados() + 1);
                                $sorteo[$index]->setAsignados($sorteo[$index]->getAsignados() + 1);
                                $juzgadosDao = new JuzgadosDAO(null, true, $this->name);
                                $tmp = $juzgadosDao->updateJuzgados($sorteo[$index], $proveedor);
                                if ($tmp != "") {
                                    // error_log("******EL JUZGADO A REGRESAR: " . $sorteo[$index]->getCveJuzgado());
                                    // error_log("******TERMINA CON EL METODO PROPORCION******");
                                    return $sorteo[$index]->getCveJuzgado();
                                } else {
                                    // error_log("******NO SE LOGRO ACTUALIZAR EL NUMERO DE ASIGNADOS EN LA TABLA DE OFICIALIASJUZ");
                                    // error_log("******TERMINA CON EL METODO PROPORCION******");
                                    return 0;
                                }
                            } else {
                                // error_log("******NO SE LOGRO ACTUALIZAR EL NUMERO DE ASIGNADOS EN LA TABLA DE OFICIALIASJUZ");
                                // error_log("******TERMINA CON EL METODO PROPORCION******");
                                return 0;
                            }
                        } else {
                            // error_log("******NO SE ENCONTRO UN ANTECEDENTE");
                            // error_log("******CREAMOS EL REGISTRO NUEVO");
                            $controlesCargasDto->setTotalAsignados(1);
                            $tmp = $controlesCargasDao->insertControlCarga($controlesCargasDto, $proveedor);
                            if ($tmp != "") {
                                // error_log("******SE ACTUALIZA EL NUMERO DE ASIGNADOS EN LA TABA DE OFICIALIASJUZ");
                                $sorteo[$index]->setAsignados($sorteo[$index]->getAsignados() + 1);
                                $juzgadosDao = new JuzgadosDAO(null, true, $this->name);
                                $tmp = $juzgadosDao->updateJuzgados($sorteo[$index], $proveedor);
                                if ($tmp != "") {
                                    // error_log("******EL JUZGADO A REGRESAR: " . $sorteo[$index]->getCveJuzgado());
                                    // error_log("******TERMINA CON EL METODO PROPORCION******");
                                    return $sorteo[$index]->getCveJuzgado();
                                } else {
                                    // error_log("******NO SE LOGRO ACTUALIZAR EL NUMERO DE ASIGNADOS EN LA TABLA DE OFICIALIASJUZ");
                                    // error_log("******TERMINA CON EL METODO PROPORCION******");
                                    return 0;
                                }
                            } else {
                                // error_log("******NO SE LOGRO ACTUALIZAR EL NUMERO DE ASIGNADOS EN LA TABLA DE OFICIALIASJUZ");
                                // error_log("******TERMINA CON EL METODO PROPORCION******");
                                return 0;
                            }
//                            break;
                        }
                    } else {
                        // error_log("******SE SOBREPASO EL NUMERO DE ASIGNADOS CON EL DE LA PROPORCION");
                        $historial[$count] = $sorteo[$index]->getCveJuzgado();
                        // error_log("******SE GUARDA EN EL HISTORIAL EL JUZGADO: " . $sorteo[$index]->getCveJuzgado());
                        $count++;
                    }
                }
            } else {
                // error_log("******LOS JUZGADOS YA EXCEDIERON LAPROPORCION DESTINADA");
                // error_log("******SE REINICIA TODOS LOS JUZGADOS PARA PODER COMENZAR EL CICLO DEL SORTEO");
                for ($x = 0; $x < count($sorteo); $x++) {

                    $sorteo[$x]->setAsignados("0");

                    $juzgadosDao = new JuzgadosDAO(null, true, $this->name);
                    $juzgadosController = new JuzgadosController();
                    $tmp = $juzgadosController->updateJuzgados($sorteo[$x], $proveedor);
//                    $tmp = $juzgadosDao->updateOficialiasJuz($sorteo[$x], $proveedor);
                    // error_log("******JUZGADO INICIALIZADO: " . $sorteo[$x]->getCveJuzgado() . "\n");
                    if ($tmp != "") {
//                        // error_log("******JUZGADO INICIALIZADO: ".$sorteo[$x]->getCveJuzgado());
                        $sorteo[$x]->setAsignados(0);
                    }
                }
                // error_log("******SE LIMPIA EL VECTOR DE HISTORIAL");
                $historial = array();
            }
        }//Termina Ciclo

        // error_log("******TERMINA CON EL METODO DE PROPORCION******");
    }

}

//$proveedor = new Proveedor("mysql", "exhortos");
//$proveedor->connect();
//$proveedor->execute("BEGIN");
//
//$params["cveMateria"] = "1";
//$params["cveCuantia"] = "1";
//
//$controlesCargas = new ControlescargasController();
//
//$configuracionesCargasDto = new ConfiguracionescargasDTO();
//$configuracionesCargasDto->setCveOficialia(3);
//
//$controlescargasDto = new ControlescargasDTO();
//$controlescargasDto->setAnioControl(date("Y"));
//$controlescargasDto->setCveMateria("1");
//$x=0;
//while($x <1 ){
//echo "Juzgado Asignado =>". $controlesCargas->getJuzgado($configuracionesCargasDto, $controlescargasDto, $proveedor, $params)."\n";
//$proveedor->execute("COMMIT");
//$x++;
//}
//$proveedor->close();
?>
