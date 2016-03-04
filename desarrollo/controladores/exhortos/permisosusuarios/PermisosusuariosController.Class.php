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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosusuarios/PermisosusuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/permisosusuarios/PermisosusuariosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/perfiles/PerfilesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/formularios/FormulariosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class PermisosusuariosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPermisosusuarios($PermisosusuariosDto) {
        $PermisosusuariosDto->setcvePermisoUsuario(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getcvePermisoUsuario()))));
        $PermisosusuariosDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getcveUsuario()))));
        $PermisosusuariosDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getcveSistema()))));
        $PermisosusuariosDto->setcveFormulario(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getcveFormulario()))));
        $PermisosusuariosDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getcvePerfil()))));
        $PermisosusuariosDto->setconsulta(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getconsulta()))));
        $PermisosusuariosDto->setmodificar(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getmodificar()))));
        $PermisosusuariosDto->seteliminar(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->geteliminar()))));
        $PermisosusuariosDto->setregistrar(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getregistrar()))));
        $PermisosusuariosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getfechaRegistro()))));
        $PermisosusuariosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($PermisosusuariosDto->getfechaActualizacion()))));
        return $PermisosusuariosDto;
    }

    public function selectPermisosusuarios($PermisosusuariosDto, $proveedor = null) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosDao = new PermisosusuariosDAO();
        $PermisosusuariosDto = $PermisosusuariosDao->selectPermisosusuarios($PermisosusuariosDto, $proveedor);
        return $PermisosusuariosDto;
    }

    public function insertPermisosusuarios($PermisosusuariosDto, $param, $proveedor = null) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosDao = new PermisosusuariosDAO();
        $cveAccion = 0;
        $movimiento = "";
        $json = "";
        $error = false;
        $controlGuarda = false;
        $control = false;
        $accion = $param['crud'];

        if ($param['tipoPermiso'] == "asignaPermiso") {
            if ($accion[3] == 'F') {
                $PermisosusuariosDto->setConsulta('S');
                $PermisosusuariosDto->setModificar('S');
                $PermisosusuariosDto->setEliminar('S');
                $PermisosusuariosDto->setRegistrar('S');
                $rsPermisoUsuario = $PermisosusuariosDao->insertPermisosusuarios($PermisosusuariosDto);
            } else {
                //Se consulta para obtener el id del permisousuario
                $rsRegistroPermisoUsuario = $PermisosusuariosDao->selectPermisosusuarios($PermisosusuariosDto);
                if ($rsRegistroPermisoUsuario != "") {
                    $PermisosusuariosDto->setCvePermisoUsuario($rsRegistroPermisoUsuario[0]->getCvePermisoUsuario());
                    if ($accion[3] == 'I') { //permisos para regristrar
                        $PermisosusuariosDto->setRegistrar('S');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                    } elseif ($accion[3] == 'S') { //permisos para consultar
                        $PermisosusuariosDto->setConsulta('S');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                    } elseif ($accion[3] == 'U') { //permisos para modificar
                        $PermisosusuariosDto->setModificar('S');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                    } elseif ($accion[3] == 'D') { // permisos para eliminar
                        $PermisosusuariosDto->setEliminar('S');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                    }
                } else {
                    $controlGuarda = true;
                }
            }
            if (!$controlGuarda) {
                if ($rsPermisoUsuario != "") {
                    $json .= '{"status":"ok",';
                    $json .= '"totalCount":"' . count($rsPermisoUsuario) . '",';
                    $json .= '"data":[';
                    $json .= "{";
                    $json .= '"cveUsuario":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveUsuario())) . ",";
                    $json .= '"cveSistema":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveSistema())) . ",";
                    $json .= '"cveFormulario":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveFormulario())) . ",";
                    $json .= '"cvePerfil":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCvePerfil())) . ",";
                    $json .= '"consulta":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getConsulta())) . ",";
                    $json .= '"modificar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getModificar())) . ",";
                    $json .= '"eliminar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getEliminar())) . ",";
                    $json .= '"registrar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getRegistrar())) . "";
                    $json .= "}";
                    $json .= "]";
                    $json .= "}";
                    $cveAccion = 5;
                    $movimiento = "inserto permisos usuario:" . $json;
                } else {
                    $error = true;
                    $json .= '{"status":"Fail",';
                    $json .= '"mnj":"No se encontraron resultados."}';
                }
            } else {
                $error = true;
                $json .= '{"status":"FailInicio",';
                $json .= '"mnj":"No se encontro el permiso usuario."}';
            }
        } else {
            if ($accion[3] == 'F') {
                $control = false;
                $rsPermisoUsuario = $PermisosusuariosDao->deletePermisosusuarios($PermisosusuariosDto);
                if ($rsPermisoUsuario == true) {
                    $json .= '{"status":"okEliminaTodos",';
                    $json .= '"cveFormulario":' . json_encode(utf8_encode($PermisosusuariosDto->getCveFormulario())) . ",";
                    $json .= '"mnj":"Se elimino de forma correcta."}';

                    $cveAccion = 7;
                    $movimiento = "Elimino permisos  usuario:" . $json;
                } else {
                    $error = true;
                    $json .= '{"status":"Fail",';
                    $json .= '"mnj":"No se encontraron resultados."}';
                }
            } else {
                $rsRegistroPermisoUsuario = $PermisosusuariosDao->selectPermisosusuarios($PermisosusuariosDto);
                if ($rsRegistroPermisoUsuario != "") {
                    $PermisosusuariosDto->setCvePermisoUsuario($rsRegistroPermisoUsuario[0]->getCvePermisoUsuario());
                    if ($accion[3] == 'I') { //permisos para registrar
                        $PermisosusuariosDto->setRegistrar('N');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                        $control = true;
                    } elseif ($accion[3] == 'S') { //permisos para consultar
                        $PermisosusuariosDto->setConsulta('N');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                        $control = true;
                    } elseif ($accion[3] == 'U') { //permisos para modificar
                        $PermisosusuariosDto->setModificar('N');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                        $control = true;
                    } elseif ($accion[3] == 'D') { //permisos para eliminar
                        $PermisosusuariosDto->setEliminar('N');
                        $rsPermisoUsuario = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto);
                        $control = true;
                    }
                } else {
                    $controlGuarda = true;
                }
            }


            if (!$controlGuarda) {
                if ($control && $accion[3] != 'F') {
                    if ($rsPermisoUsuario != "") {
                        $json .= '{"status":"okElimina",';
                        $json .= '"totalCount":"' . count($rsPermisoUsuario) . '",';
                        $json .= '"data":[';
                        $json .= "{";
                        $json .= '"cveUsuario":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveUsuario())) . ",";
                        $json .= '"cveSistema":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveSistema())) . ",";
                        $json .= '"cveFormulario":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCveFormulario())) . ",";
                        $json .= '"cvePerfil":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getCvePerfil())) . ",";
                        $json .= '"consulta":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getConsulta())) . ",";
                        $json .= '"modificar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getModificar())) . ",";
                        $json .= '"eliminar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getEliminar())) . ",";
                        $json .= '"registrar":' . json_encode(utf8_encode($rsPermisoUsuario[0]->getRegistrar())) . "";
                        $json .= "}";
                        $json .= "]";
                        $json .= "}";
                        $cveAccion = 7;
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
                $json .= '"mnj":"No se encontro el permiso usuario."}';
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

    public function updatePermisosusuarios($PermisosusuariosDto, $proveedor = null) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosDao = new PermisosusuariosDAO();
        $PermisosusuariosDto = $PermisosusuariosDao->updatePermisosusuarios($PermisosusuariosDto, $proveedor);
        return $PermisosusuariosDto;
    }

    public function deletePermisosusuarios($PermisosusuariosDto, $proveedor = null) {
        $PermisosusuariosDto = $this->validarPermisosusuarios($PermisosusuariosDto);
        $PermisosusuariosDao = new PermisosusuariosDAO();
        $PermisosusuariosDto = $PermisosusuariosDao->deletePermisosusuarios($PermisosusuariosDto, $proveedor);
        return $PermisosusuariosDto;
    }

    public function consultarOpciones($perfilesDto) {
        $perfilesDao = new PerfilesDAO();
        $jsonResponse = "";
        $rsPerfiles = $perfilesDao->selectPerfiles($perfilesDto);
        if ($rsPerfiles != "") {
            $formularioDto = new FormulariosDTO();
            $formularioDto->setCveSistema($rsPerfiles[0]->getCveSistema());
            $cveSistema = $rsPerfiles[0]->getCveSistema();
            $formularioDto->setNivel(0);

            $formularioDao = new FormulariosDAO();
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

    public function permisosFormulario($accion, $formulario) {
        $permisos = null;
        $permisosUsuariosDto = new PermisosusuariosDTO();
        $permisosUsuariosDao = new PermisosusuariosDAO();
//        var_dump($permisosUsuariosDto);
        switch ($accion) {
            case "consulta":
                $permisosUsuariosDto->setConsulta("S");
                break;
            case "modificar":
                $permisosUsuariosDto->setModificar("S");
                break;
            case "eliminar":
                $permisosUsuariosDto->setEliminar("S");
                break;
            case "registrar":
                $permisosUsuariosDto->setRegistrar("S");
                break;
        }
//        var_dump($permisosUsuariosDto);
//        array(11) { ["cveSistema"]=> string(1) "1" ["cveUsuarioSistema"]=> string(1) "2" ["NumEmpleado"]=> string(6) "EXH001" ["Nombre"]=> string(20) "PRUEBA PRUEBA PRUEBA" ["numEmpleado"]=> string(6) "EXH001" ["nombre"]=> string(20) "PRUEBA PRUEBA PRUEBA" ["email"]=> string(0) "" ["cveGrupo"]=> string(1) "9" ["cvePerfil"]=> string(1) "2" ["cveAdscripcion"]=> string(1) "3" ["desAdscripcion"]=> string(25) "OFICIALIA DE PARTES COMUN" }
        $permisosUsuariosDto->setCveSistema($_SESSION['cveSistema']);
        $permisosUsuariosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
        $permisosUsuariosDto->setCvePerfil($_SESSION['cvePerfil']);
        $permisosUsuariosDto->setCveFormulario($formulario);
//        var_dump($permisosUsuariosDto);
        $permisos = $permisosUsuariosDao->selectPermisosusuarios($permisosUsuariosDto);
//        var_dump($permisos);
        if ($permisos == "") {
            return false;
        } else {
            return true;
        }
    }

}

?>