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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosgrupos/PermisosgruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/permisosgrupos/PermisosgruposDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/formularios/FormulariosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class PermisosgruposController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPermisosgrupos($PermisosgruposDto) {
        $PermisosgruposDto->setcvePermisoGrupo(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getcvePermisoGrupo()))));
        $PermisosgruposDto->setcveGrupo(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getcveGrupo()))));
        $PermisosgruposDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getcveSistema()))));
        $PermisosgruposDto->setcveFormulario(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getcveFormulario()))));
        $PermisosgruposDto->setconsulta(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getconsulta()))));
        $PermisosgruposDto->setmodificar(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getmodificar()))));
        $PermisosgruposDto->seteliminar(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->geteliminar()))));
        $PermisosgruposDto->setregistrar(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getregistrar()))));
        $PermisosgruposDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getfechaRegistro()))));
        $PermisosgruposDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($PermisosgruposDto->getfechaActualizacion()))));
        return $PermisosgruposDto;
    }

    public function selectPermisosgrupos($PermisosgruposDto, $proveedor = null) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposDao = new PermisosgruposDAO();
        $PermisosgruposDto = $PermisosgruposDao->selectPermisosgrupos($PermisosgruposDto, $proveedor);
        return $PermisosgruposDto;
    }

    public function insertPermisosgrupos($PermisosgruposDto, $param, $proveedor = null) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposDao = new PermisosgruposDAO();
        $cveAccion = 0;
        $movimiento = "";
        $json = "";
        $error = false;
        $controlGuarda = false;
        $control = false;
        $accion = $param['crud'];

        if ($param['tipoPermiso'] == "asignaPermiso") {
            if ($accion[3] == 'F') {
                $PermisosgruposDto->setConsulta('S');
                $PermisosgruposDto->setModificar('S');
                $PermisosgruposDto->setEliminar('S');
                $PermisosgruposDto->setRegistrar('S');
                $rsPermisoGrupo = $PermisosgruposDao->insertPermisosgrupos($PermisosgruposDto);
            } else {
                //Se consulta para obtener el id del permisousuario
                $rsRegistroPermisoGrupo = $PermisosgruposDao->selectPermisosgrupos($PermisosgruposDto);
                if ($rsRegistroPermisoGrupo != "") {
                    $PermisosgruposDto->setCvePermisoGrupo($rsRegistroPermisoGrupo[0]->getCvePermisoGrupo());
                    if ($accion[3] == 'I') { //permisos para regristrar
                        $PermisosgruposDto->setRegistrar('S');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                    } elseif ($accion[3] == 'S') { //permisos para consultar
                        $PermisosgruposDto->setConsulta('S');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                    } elseif ($accion[3] == 'U') { //permisos para modificar
                        $PermisosgruposDto->setModificar('S');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                    } elseif ($accion[3] == 'D') { // permisos para eliminar
                        $PermisosgruposDto->setEliminar('S');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                    }
                } else {
                    $controlGuarda = true;
                }
            }
            if (!$controlGuarda) {
                if ($rsPermisoGrupo != "") {
                    $json .= '{"status":"ok",';
                    $json .= '"totalCount":"' . count($rsPermisoGrupo) . '",';
                    $json .= '"data":[';
                    $json .= "{";
                    $json .= '"cvePermisoGrupo":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCvePermisoGrupo())) . ",";
                    $json .= '"cveGrupo":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveGrupo())) . ",";
                    $json .= '"cveSistema":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveSistema())) . ",";
                    $json .= '"cveFormulario":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveFormulario())) . ",";
                    $json .= '"consulta":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getConsulta())) . ",";
                    $json .= '"modificar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getModificar())) . ",";
                    $json .= '"eliminar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getEliminar())) . ",";
                    $json .= '"registrar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getRegistrar())) . "";
                    $json .= "}";
                    $json .= "]";
                    $json .= "}";
                    $cveAccion = 25;
                    $movimiento = "inserto permisos grupo:" . $json;
                } else {
                    $error = true;
                    $json .= '{"status":"Fail",';
                    $json .= '"mnj":"No se encontraron resultados."}';
                }
            } else {
                $error = true;
                $json .= '{"status":"FailInicio",';
                $json .= '"mnj":"No se encontro el permiso grupo."}';
            }
        } else {
            if ($accion[3] == 'F') {
                $control = false;
                $rsPermisoGrupo = $PermisosgruposDao->deletePermisosgrupos($PermisosgruposDto);
                if ($rsPermisoGrupo == true) {
                    $json .= '{"status":"okEliminaTodos",';
                    $json .= '"cveFormulario":' . json_encode(utf8_encode($PermisosgruposDto->getCveFormulario())) . ",";
                    $json .= '"mnj":"Se elimino de forma correcta."}';

                    $cveAccion = 24;
                    $movimiento = "Elimino permisos  grupo:" . $json;
                } else {
                    $error = true;
                    $json .= '{"status":"Fail",';
                    $json .= '"mnj":"No se encontraron resultados."}';
                }
            } else {
                $rsRegistroPermisoGrupo = $PermisosgruposDao->selectPermisosgrupos($PermisosgruposDto);
                if ($rsRegistroPermisoGrupo != "") {
                    $PermisosgruposDto->setCvePermisoGrupo($rsRegistroPermisoGrupo[0]->getCvePermisoGrupo());
                    if ($accion[3] == 'I') { //permisos para registrar
                        $PermisosgruposDto->setRegistrar('N');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                        $control = true;
                    } elseif ($accion[3] == 'S') { //permisos para consultar
                        $PermisosgruposDto->setConsulta('N');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                        $control = true;
                    } elseif ($accion[3] == 'U') { //permisos para modificar
                        $PermisosgruposDto->setModificar('N');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                        $control = true;
                    } elseif ($accion[3] == 'D') { //permisos para eliminar
                        $PermisosgruposDto->setEliminar('N');
                        $rsPermisoGrupo = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto);
                        $control = true;
                    }
                } else {
                    $controlGuarda = true;
                }
            }


            if (!$controlGuarda) {
                if ($control && $accion[3] != 'F') {
                    if ($rsPermisoGrupo != "") {
                        $json .= '{"status":"okElimina",';
                        $json .= '"totalCount":"' . count($rsPermisoGrupo) . '",';
                        $json .= '"data":[';
                        $json .= "{";
                        $json .= '"cvePermisoGrupo":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCvePermisoGrupo())) . ",";
                        $json .= '"cveGrupo":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveGrupo())) . ",";
                        $json .= '"cveSistema":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveSistema())) . ",";
                        $json .= '"cveFormulario":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getCveFormulario())) . ",";
                        $json .= '"consulta":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getConsulta())) . ",";
                        $json .= '"modificar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getModificar())) . ",";
                        $json .= '"eliminar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getEliminar())) . ",";
                        $json .= '"registrar":' . json_encode(utf8_encode($rsPermisoGrupo[0]->getRegistrar())) . "";
                        $json .= "}";
                        $json .= "]";
                        $json .= "}";
                        $cveAccion = 24;
                        $movimiento = "elimino permisos usuarios:" . $json;
                    } else {
                        $error = true;
                        $json .= '{"status":"Fail",';
                        $json .= '"mnj":"No se encontraron resultados."}';
                    }
                }
            } else {
                $error = true;
                $json .= '{"status":"FailInicio",';
                $json .= '"mnj":"No se encontro el permiso grupo."}';
            }
        }

        if ((!$error)) {
            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion($cveAccion);
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones($movimiento);
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
        }

        return $json;
    }

    public function updatePermisosgrupos($PermisosgruposDto, $proveedor = null) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposDao = new PermisosgruposDAO();
//$tmpDto = new PermisosgruposDTO();
//$tmpDto = $PermisosgruposDao->selectPermisosgrupos($PermisosgruposDto,$proveedor);
//if($tmpDto!=""){//$PermisosgruposDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $PermisosgruposDto = $PermisosgruposDao->updatePermisosgrupos($PermisosgruposDto, $proveedor);
        return $PermisosgruposDto;
//}
//return "";
    }

    public function deletePermisosgrupos($PermisosgruposDto, $proveedor = null) {
        $PermisosgruposDto = $this->validarPermisosgrupos($PermisosgruposDto);
        $PermisosgruposDao = new PermisosgruposDAO();
        $PermisosgruposDto = $PermisosgruposDao->deletePermisosgrupos($PermisosgruposDto, $proveedor);
        return $PermisosgruposDto;
    }

    public function consultarOpciones($param, $proveedor = null) {
        $jsonResponse = "";

        $formularioDto = new FormulariosDTO();
        $formularioDto->setCveSistema($param['cveSistema']);
        $cveSistema = $param['cveSistema'];
        $formularioDto->setNivel(0);

        $formularioDao = new FormulariosDAO();

//        print_r($formularioDto);

        $formularioDto = $formularioDao->selectFormularioNivel($formularioDto, " order by orden ASC");
        if ($formularioDto != "") {
            $jsonResponse .= '{"status":"ok",';
            $jsonResponse .= '"opciones":[';
            $jsonResponse .= $this->getHijo($formularioDto, $cveSistema);
            $jsonResponse = substr($jsonResponse, 0, -1);
            $jsonResponse .= ']';
            $jsonResponse .= '}';
        } else {
            $jsonResponse .= '{"status":"Fail"}';
        }

        return $jsonResponse;
    }

    public function getHijo($formularioDto = null, $cveSistema = null) {
        $formularioDao = new FormulariosDAO();
        $index = 0;
        $html = "";
        if (count($formularioDto) >= 0) {
            foreach ($formularioDto as $formulario) {
                $tmp = $formularioDao->selectFormularioHijo($formulario, " order by orden ASC");
                if ($tmp != "") {
                    if ($formulario->getVista() == 'S') {
                        $html .= "{";
                        $html .='"nomFormulario":' . json_encode(utf8_encode($formulario->getNomFormulario()));
                        $html .=',"cveFormulario":' . json_encode(utf8_encode($formulario->getCveFormulario()));
                        $html .=',"archivo":' . json_encode(utf8_encode($formulario->getRuta()));
                        $html .=',"nivel":' . json_encode(utf8_encode($formulario->getNivel()));
                        $html .=',"hijos":[ ';
                        $html .= $this->getHijo($tmp, $cveSistema);
                        $html = substr($html, 0, -1);
                        $html .=']';
                        $html .="},";
                    }
                } else {
                    if ($formulario->getVista() == 'S') {
                        $html .="{";
                        $html .='"nomFormulario":' . json_encode(utf8_encode($formulario->getNomFormulario()));
                        $html .=',"cveFormulario":' . json_encode(utf8_encode($formulario->getCveFormulario()));
                        $html .=',"archivo":' . json_encode(utf8_encode($formulario->getRuta()));
                        $html .=',"nivel":' . json_encode(utf8_encode($formulario->getNivel()));
                        $html .="},";
                    }
                }
            }
        }
        return $html;
    }

}

?>