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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/perfiles/PerfilesDAO.Class.php");


include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosgrupos/PermisosgruposDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/permisosgrupos/PermisosgruposDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/permisosusuarios/PermisosusuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/permisosusuarios/PermisosusuariosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class PerfilesController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarPerfiles($PerfilesDto) {
        $PerfilesDto->setcvePerfil(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getcvePerfil()))));
        $PerfilesDto->setcveGrupo(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getcveGrupo()))));
        $PerfilesDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getcveUsuario()))));
        $PerfilesDto->setcveSistema(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getcveSistema()))));
        $PerfilesDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getcveAdscripcion()))));
        $PerfilesDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getfechaRegistro()))));
        $PerfilesDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getfechaActualizacion()))));
        $PerfilesDto->setactivo(strtoupper(str_ireplace("'", "", trim($PerfilesDto->getactivo()))));
        return $PerfilesDto;
    }

    public function selectPerfiles($PerfilesDto, $proveedor = null) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesDao = new PerfilesDAO();
        $PerfilesDto = $PerfilesDao->selectPerfiles($PerfilesDto, $proveedor);
        return $PerfilesDto;
    }

    public function getPaginas($PerfilesDto, $param) {
        $PerfilesDao = new PerfilesDAO();
        $numTot = $PerfilesDao->selectPerfilesGeneral($PerfilesDto, null, "", $param, " count(cvePerfil) as totalCount ");
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

    public function insertPerfiles($PerfilesDto, $proveedor = null) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesDao = new PerfilesDAO();

        $error = false;
        $msg = array();

        if ($proveedor == null) {
            $this->proveedor = new Proveedor('mysql', 'EXHORTOS');
            $this->proveedor->connect();
        } else {
            $this->proveedor = $proveedor;
        }
        $this->proveedor->execute("BEGIN");


        $PerfilesDto = $PerfilesDao->insertPerfiles($PerfilesDto, $this->proveedor);
        if ($PerfilesDto != "") {
            $permisosUsuariosDao = new PermisosusuariosDAO();
            $permisosUsuariosAuxDto = new PermisosusuariosDTO();
            $permisosUsuariosAuxDto->setCveUsuario($PerfilesDto[0]->getCveUsuario());
            $permisosUsuariosAuxDto->setCveSistema($PerfilesDto[0]->getCveSistema());
            $permisosUsuariosAuxDto->setCvePerfil($PerfilesDto[0]->getCvePerfil());
            $rsPermisosBorraGrupos = $permisosUsuariosDao->deletePermisosusuarios($permisosUsuariosAuxDto, $this->proveedor);
            if ($rsPermisosBorraGrupos == true) {
                $permisosGruposDto = new PermisosgruposDTO();
                $permisosGruposDao = new PermisosgruposDAO();
                $permisosGruposDto->setCveGrupo($PerfilesDto[0]->getCveGrupo());
                $permisosGruposDto->setCveSistema($PerfilesDto[0]->getCveSistema());
                $rsPermisosGrupos = $permisosGruposDao->selectPermisosgrupos($permisosGruposDto, "", $this->proveedor);
                if ($rsPermisosGrupos != "") {
                    foreach ($rsPermisosGrupos as $permisoGrupo) {
                        $permisosUsuariosDto = new PermisosusuariosDTO();
                        $permisosUsuariosDto->setCveUsuario($PerfilesDto[0]->getCveUsuario());
                        $permisosUsuariosDto->setCveSistema($permisoGrupo->getCveSistema());
                        $permisosUsuariosDto->setCveFormulario($permisoGrupo->getCveFormulario());
                        $permisosUsuariosDto->setCvePerfil($PerfilesDto[0]->getCvePerfil());
                        $permisosUsuariosDto->setConsulta($permisoGrupo->getConsulta());
                        $permisosUsuariosDto->setModificar($permisoGrupo->getModificar());
                        $permisosUsuariosDto->setEliminar($permisoGrupo->getEliminar());
                        $permisosUsuariosDto->setRegistrar($permisoGrupo->getRegistrar());
                        $rsPermisosUsuarios = $permisosUsuariosDao->insertPermisosusuarios($permisosUsuariosDto, $this->proveedor);
                        if ($rsPermisosUsuarios != "") {
                            
                        } else {
                            $msg[] = array("No se pudo guardar los permisos grupos.");
                            $error = true;
                        }
                    }
                } else {
                    $msg[] = array("No se encontraro permisos grupos. Contacte al administrador");
                    $error = true;
                }
            } else {
                $msg[] = array("Error al eliminar los permisos. Verifique");
                $error = true;
            }
        } else {
            $msg[] = array("Error al registrar el perfil. Verifique");
            $error = true;
        }


        if ((!$error)) {
            $this->proveedor->execute("COMMIT");

            $listaResultados = array();
            $resultado = array(
                "cvePerfil" => $PerfilesDto[0]->getCvePerfil(),
                "cveGrupo" => $PerfilesDto[0]->getCveGrupo(),
                "cveUsuario" => $PerfilesDto[0]->getCveUsuario(),
                "cveSistema" => $PerfilesDto[0]->getCveSistema(),
                "cveAdscripcion" => $PerfilesDto[0]->getCveAdscripcion(),
                "activo" => $PerfilesDto[0]->getActivo()
            );
            array_push($listaResultados, $resultado);
            $result = array("status" => "ok", "mensaje" => 'Se actualizo de forma correcta.', "data" => $listaResultados);
            $result = json_encode($result);


            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("3");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones("Inserto Perfil" . json_encode($result));
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
        } else {
            $this->proveedor->execute("ROLLBACK");
            $result = array("status" => "error", "mensaje" => $msg);
            $result = json_encode($result);
        }
        return $result;
    }

    public function updatePerfiles($PerfilesDto, $proveedor = null) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesDao = new PerfilesDAO();

        $error = false;
        $msg = array();

        if ($proveedor == null) {
            $this->proveedor = new Proveedor('mysql', 'EXHORTOS');
            $this->proveedor->connect();
        } else {
            $this->proveedor = $proveedor;
        }
        $this->proveedor->execute("BEGIN");


        $PerfilesDto = $PerfilesDao->updatePerfiles($PerfilesDto, $this->proveedor);
        if ($PerfilesDto != "") {
            $permisosUsuariosDao = new PermisosusuariosDAO();
            $permisosUsuariosAuxDto = new PermisosusuariosDTO();
            $permisosUsuariosAuxDto->setCveUsuario($PerfilesDto[0]->getCveUsuario());
            $permisosUsuariosAuxDto->setCveSistema($PerfilesDto[0]->getCveSistema());
            $permisosUsuariosAuxDto->setCvePerfil($PerfilesDto[0]->getCvePerfil());
            $rsPermisosBorraGrupos = $permisosUsuariosDao->deletePermisosusuarios($permisosUsuariosAuxDto, $this->proveedor);
            if ($rsPermisosBorraGrupos == true) {
                $permisosGruposDto = new PermisosgruposDTO();
                $permisosGruposDao = new PermisosgruposDAO();
                $permisosGruposDto->setCveGrupo($PerfilesDto[0]->getCveGrupo());
                $permisosGruposDto->setCveSistema($PerfilesDto[0]->getCveSistema());
                $rsPermisosGrupos = $permisosGruposDao->selectPermisosgrupos($permisosGruposDto, "", $this->proveedor);
                if ($rsPermisosGrupos != "") {
                    foreach ($rsPermisosGrupos as $permisoGrupo) {
                        $permisosUsuariosDto = new PermisosusuariosDTO();
                        $permisosUsuariosDto->setCveUsuario($PerfilesDto[0]->getCveUsuario());
                        $permisosUsuariosDto->setCveSistema($permisoGrupo->getCveSistema());
                        $permisosUsuariosDto->setCveFormulario($permisoGrupo->getCveFormulario());
                        $permisosUsuariosDto->setCvePerfil($PerfilesDto[0]->getCvePerfil());
                        $permisosUsuariosDto->setConsulta($permisoGrupo->getConsulta());
                        $permisosUsuariosDto->setModificar($permisoGrupo->getModificar());
                        $permisosUsuariosDto->setEliminar($permisoGrupo->getEliminar());
                        $permisosUsuariosDto->setRegistrar($permisoGrupo->getRegistrar());
                        $rsPermisosUsuarios = $permisosUsuariosDao->insertPermisosusuarios($permisosUsuariosDto, $this->proveedor);
                        if ($rsPermisosUsuarios != "") {
                            
                        } else {
                            $msg[] = array("No se pudo guardar los permisos grupos.");
                            $error = true;
                        }
                    }
                } else {
                    $msg[] = array("No se encontraro permisos grupos. Contacte al administrador");
                    $error = true;
                }
            } else {
                $msg[] = array("Error al eliminar los permisos. Verifique");
                $error = true;
            }
        } else {
            $msg[] = array("Error al actualizar el perfil. Verifique");
            $error = true;
        }


        if ((!$error)) {
            $this->proveedor->execute("COMMIT");

            $listaResultados = array();
            $resultado = array(
                "cvePerfil" => $PerfilesDto[0]->getCvePerfil(),
                "cveGrupo" => $PerfilesDto[0]->getCveGrupo(),
                "cveUsuario" => $PerfilesDto[0]->getCveUsuario(),
                "cveSistema" => $PerfilesDto[0]->getCveSistema(),
                "cveAdscripcion" => $PerfilesDto[0]->getCveAdscripcion(),
                "activo" => $PerfilesDto[0]->getActivo()
            );
            array_push($listaResultados, $resultado);
            $result = array("status" => "ok", "mensaje" => 'Se actualizo de forma correcta.', "data" => $listaResultados);
            $result = json_encode($result);


            $BitacoramovimientosDao = new BitacoramovimientosDAO();
            $BitacoramovimientosDto = new BitacoramovimientosDTO();
            $BitacoramovimientosDto->setCveAccion("4");
            $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
            $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
            $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
            $BitacoramovimientosDto->setObservaciones("Modifico Perfil" . json_encode($result));
            $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
        } else {
            $this->proveedor->execute("ROLLBACK");
            $result = array("status" => "error", "mensaje" => $msg);
            $result = json_encode($result);
        }
        return $result;
    }

//    public function updatePerfiles($PerfilesDto, $proveedor = null) {
//        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
//        $PerfilesDao = new PerfilesDAO();
//        $PerfilesDto = $PerfilesDao->updatePerfiles($PerfilesDto, $proveedor);
//        return $PerfilesDto;
//    }

    public function deletePerfiles($PerfilesDto, $proveedor = null) {
        $PerfilesDto = $this->validarPerfiles($PerfilesDto);
        $PerfilesDao = new PerfilesDAO();
        $PerfilesDto = $PerfilesDao->deletePerfiles($PerfilesDto, $proveedor);
        return $PerfilesDto;
    }

}

?>