<?php

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/usuarios/UsuariosDAO.Class.php");


include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/perfiles/PerfilesDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/perfiles/PerfilesDAO.Class.php");


include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/permisosusuarios/PermisosusuariosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto//permisosusuarios/PermisosusuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/formularios/FormulariosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/formularios/FormulariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/sistemas/SistemasDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/sistemas/SistemasDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/grupos/GruposDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/grupos/GruposDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/juzgados/JuzgadosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/juzgados/JuzgadosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/adscripciones/AdscripcionesDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/adscripciones/AdscripcionesDTO.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");

//include(dirname(__FILE__) . "/../../librerias/import/Package.Class.php");

class LoginController {

    private function isValid($user = "", $password = "") {
        $valido = false;
        if (is_dir("../" . $user) == true) {
            if (is_file("../" . $user . "/" . $password . ".pwsd") == true) {
                $valido = true;
            } else {
                $valido = false;
            }
        } else {
            $valido = false;
        }
        return $valido;
    }

    public function getLogin($usuario, $password, $cveSistema, $u, $p) {
        if ($this->isValid($u, $p)) {
            $usuarioDto = new UsuariosDTO();
            $usuarioDto->setLogin($usuario);
            $usuarioDto->setPassword($password);

            $usuarioDao = new UsuariosDAO();
            $usuarioDto = $usuarioDao->selectLoginUsuario(utf8_decode($usuario), true);


            if ($usuarioDto != "") {
                if ($usuarioDto->getActivo() == 'S') {
                    if (trim($usuarioDto->getPassword()) == trim($password)) {
                        $json = new Encode_JSON();
                        return utf8_encode($json->convert($usuarioDto->toString()));
                    } else {
                        $json = new Encode_JSON();
                        return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos " . $password)));
                    }
                } else {
                    $json = new Encode_JSON();
                    return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos o")));
                }
            } else {
                $json = new Encode_JSON();
                return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos U" . $usuario)));
            }
        } else {
            $json = new Encode_JSON();
            return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos, verifica con informatica")));
        }
    }

    public function getJuzgadoName($cveJuz) {
        $juzgadosDTO = new JuzgadosDTO();
        $juzgadosDAO = new JuzgadosDAO();
        $juzgadosDTO->setIdJuzgado($cveJuz);
        $juzgadosDTO = $juzgadosDAO->selectJuzgados($juzgadosDTO, true);

        $nameJuz = "Nombre Adscripcion";
        if ($juzgadosDTO != "") {
            $nameJuz = $juzgadosDTO->getDesJuz();
        }
        return $nameJuz;
    }

    public function getAdscripcionName($cveJuz) {
        $AdscripcionesDTO = new AdscripcionesDTO();
        $AdscripcionesDAO = new AdscripcionesDAO();
        $AdscripcionesDTO->setCveAdscripcion($cveJuz);
        $AdscripcionesDTO = $AdscripcionesDAO->selectAdscripciones($AdscripcionesDTO);
        $nameJuz = "Nombre Adscripcion Externa";
        if ($AdscripcionesDTO !== "") {

            foreach ($AdscripcionesDTO as $Adscripcion) {
                $nameJuz = $Adscripcion->getDesAdscripcion();
            }
        }
        return $nameJuz;
    }

    public function getGrupoName($cveGrupo) {
        $gruposDTO = new GruposDTO();
        $gruposDAO = new GruposDAO();
        $gruposDTO->setCveGrupo($cveGrupo);
        $juzgadosDTO = $gruposDAO->selectGruposPerfil($gruposDTO);
        $nameGrupo = "Nombre Grupo";
        if ($juzgadosDTO != "") {
            $nameGrupo = $juzgadosDTO[0]->getNomGrupo();
        }
        return $nameGrupo;
    }

    public function getFullLogin($usuario, $password, $cveSistema) {
//        if ($this->isValid($u, $p)) {
        //$usuario = str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_str($usuario, "utf8") : strtoupper($usuario))));

        $usuarioDto = new UsuariosDTO();
        $usuarioDto->setLogin($usuario);
        $usuarioDto->setPasswordCifrado($password);
        $usuarioDao = new UsuariosDAO();
        $usuarioDto = $usuarioDao->selectUsuarios($usuarioDto);

        if ($usuarioDto != "") {
            $usuarioDto = $usuarioDto[0];
            if ($usuarioDto->getActivo() == 'S') {
                if (trim($usuarioDto->getPasswordCifrado()) == trim($password)) {
                    $jsonResponse = "{";
                    $jsonResponse .= '"cveUsuario":' . json_encode(utf8_encode($usuarioDto->getCveUsuario()));
                    $jsonResponse .= ',"numEmpleado":' . json_encode(utf8_encode($usuarioDto->getNumEmpleado()));
                    $jsonResponse .= ',"cveAdscripcion":' . json_encode(utf8_encode($usuarioDto->getCveAdscripcion()));
                    $jsonResponse .= ',"desAdscripcion":' . json_encode(utf8_encode($this->getAdscripcionName($usuarioDto->getCveAdscripcion())));
                    $jsonResponse .= ',"login":' . json_encode(utf8_encode($usuarioDto->getLogin()));
                    $jsonResponse .= ',"password":' . json_encode(utf8_encode($usuarioDto->getPassword()));
                    $jsonResponse .= ',"passwordCifrado":' . json_encode(utf8_encode($usuarioDto->getPasswordCifrado()));
                    $jsonResponse .= ',"paterno":' . json_encode(utf8_encode($usuarioDto->getPaterno()));
                    $jsonResponse .= ',"materno":' . json_encode(utf8_encode($usuarioDto->getMaterno()));
                    $jsonResponse .= ',"nombre":' . json_encode(utf8_encode($usuarioDto->getNombre()));
                    $jsonResponse .= ',"email":' . json_encode(utf8_encode($usuarioDto->getEmail()));
                    $jsonResponse .= ',"telefono":' . json_encode(utf8_encode($usuarioDto->getTelefono()));
                    $jsonResponse .= ',"cveSistema":' . json_encode($cveSistema);
                    $jsonResponse .= ',"perfiles":[{';
                    $perfilDto = new PerfilesDTO();
                    $perfilDto->setCveUsuario($usuarioDto->getCveUsuario());
                    $perfilDto->setCveSistema($cveSistema);
                    $perfilDto->setActivo("S");
                    $perfilDao = new PerfilesDAO();
                    $perfilDto = $perfilDao->selectPerfiles($perfilDto);
                    if (count($perfilDto) > 0) {
                        $jsonResponse .= '"totPerfiles":' . json_encode(utf8_encode(count($perfilDto)));
                        $jsonResponse .= ',"perfil":[';
                        foreach ($perfilDto as $perfil) {
                            $jsonResponse .= '{';
                            $jsonResponse .= '"cvePerfil":' . json_encode(utf8_encode($perfil->getCvePerfil()));
                            $jsonResponse .= ',"cveGrupo":' . json_encode(utf8_encode($perfil->getCveGrupo()));
                            $jsonResponse .= ',"desGrupo":' . json_encode(utf8_encode($this->getGrupoName($perfil->getCveGrupo())));
                            $jsonResponse .= ',"cveUsuario":' . json_encode(utf8_encode($perfil->getCveUsuario()));
                            $jsonResponse .= ',"cveSistema":' . json_encode(utf8_encode($perfil->getCveSistema()));
                            $jsonResponse .= ',"cveAdscripcion":' . json_encode(utf8_encode($perfil->getCveAdscripcion()));
                            $jsonResponse .= ',"desAdscripcion":' . json_encode(utf8_encode($this->getAdscripcionName($perfil->getCveAdscripcion())));
                            $jsonResponse .= ',"permisos":[ ';

                            $perfilPerfilUsuarioSistemaDto = new PerfilesDTO();
                            $perfilDao = new PerfilesDAO();
                            $perfilPerfilUsuarioSistemaDto->setCvePerfil($perfil->getCvePerfil());
                            $perfilPerfilUsuarioSistemaDto->setCveSistema($cveSistema);
                            $perfilPerfilUsuarioSistemaDto = $perfilDao->selectPerfiles($perfilPerfilUsuarioSistemaDto);
                            $perfilPerfilUsuarioSistemaDto = $perfilPerfilUsuarioSistemaDto[0];
                            if ($perfilPerfilUsuarioSistemaDto->getCvePerfil() != "") {

                                $formularioDto = new FormulariosDTO();
                                $formularioDto->setCveSistema($perfilPerfilUsuarioSistemaDto->getCveSistema());
                                $formularioDto->setNivel(0);

                                $formularioDao = new FormulariosDAO();
                                $formularioDto = $formularioDao->selectFormularioNivel($formularioDto, " order by orden ASC");
                                $permisoUsuarioDto = new PermisosUsuariosDTO();
                                $permisoUsuarioDto->setCvePerfil($perfilPerfilUsuarioSistemaDto->getCvePerfil());
                                $permisoUsuarioDto->setCveUsuario($perfilPerfilUsuarioSistemaDto->getCveUsuario());
                                $permisoUsuarioDto->setCveSistema($perfilPerfilUsuarioSistemaDto->getCveSistema());
                                $permisoUsuarioDao = new PermisosUsuariosDAO();

                                if ($formularioDto != "") {
                                    $jsonResponse .= $this->getHijo($permisoUsuarioDto, $permisoUsuarioDao, $formularioDto, $cveSistema);
                                    $jsonResponse = substr($jsonResponse, 0, -1);
                                } else {
                                    $jsonResponse .= '{"estatusPermisos":"Fail"}';
                                }
                            } else {
                                $jsonResponse .= '{"estatusPermisos":"Empty"}';
                            }
                            $jsonResponse .= ']';
                            $jsonResponse .= '},';
                        }
                        $jsonResponse = substr($jsonResponse, 0, -1);
                        $jsonResponse .= ']';
                    } else {
                        $jsonResponse .= '{"estatusPerfil":"Fail"}';
                    }
                    $jsonResponse .= '}]';

                    return $jsonResponse .= "}";
                } else {
                    $json = new Encode_JSON();
                    return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos " . $password)));
                }
            } else {
                $json = new Encode_JSON();
                return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos o")));
            }
        } else {
            $json = new Encode_JSON();
            return utf8_encode($json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos U " . utf8_decode($usuario))));
        }
    }

    public function getHijo($permisoUsuarioDto = null, $permisoUsuarioDao = null, $formularioDto = null, $cveSistema = null) {
        $formularioDao = new FormulariosDAO();
        $index = 0;
        $html = "";
        if (count($formularioDto) >= 0) {
            foreach ($formularioDto as $formulario) {
                $permisoUsuarioDto->setCveFormulario($formulario->getCveFormulario());
                $dto = $permisoUsuarioDao->selectPermisosusuarios($permisoUsuarioDto);
                if ($dto != "") {
                    $tmp = $formularioDao->selectFormularioHijo($formulario, " order by orden ASC");
                    if ($tmp != "") {
                        if ($formulario->getVista() == 'S') {
                            $html .= "{";
                            $html .='"nomFormulario":' . json_encode(utf8_encode($formulario->getNomFormulario()));
                            $html .=',"archivo":' . json_encode(utf8_encode($formulario->getRuta()));
                            $html .=',"target":"Contenido"';
                            $html .=',"permisoFormulario":[{';
                            $html .='"create":' . json_encode($dto[0]->getRegistrar());
                            $html .=',"read":' . json_encode($dto[0]->getConsulta());
                            $html .=',"update":' . json_encode($dto[0]->getModificar());
                            $html .=',"delete":' . json_encode($dto[0]->getEliminar());
                            $html .='}]';
                            $html .=',"hijos":[ ';

                            $html .= $this->getHijo($permisoUsuarioDto, $permisoUsuarioDao, $tmp, $cveSistema);
                            $html = substr($html, 0, -1);
                            $html .=']';
                            $html .="},";
                        }
                    } else {
                        if ($formulario->getVista() == 'S') {
                            $html .="{";
                            $html .='"nomFormulario":' . json_encode(utf8_encode($formulario->getNomFormulario()));
                            $html .=',"archivo":' . json_encode(utf8_encode($formulario->getRuta()));
                            $html .=',"target":"Contenido"';
                            $html .=',"permisoFormulario":[{';
                            $html .='"create":' . json_encode($dto[0]->getRegistrar());
                            $html .=',"read":' . json_encode($dto[0]->getConsulta());
                            $html .=',"update":' . json_encode($dto[0]->getModificar());
                            $html .=',"delete":' . json_encode($dto[0]->getEliminar());
                            $html .='}]';
                            $html .="},";
                        }
                    }
                }
            }
        }
        return $html;
    }

    public function getPerfil($usuarioDto, $cveSistema, $user, $passwd) {
        if ($this->isValid($user, $passwd)) {
            $usuarioDto = json_decode($usuarioDto, true);
            $perfilDto = new PerfilesDTO();
            $perfilDto->setCveUsuario($usuarioDto["cveUsuario"]);
            $perfilDto->setCveSistema($cveSistema);

            $perfilDao = new PerfilesDAO();
            $perfilDto = $perfilDao->selectPerfilUsuario($perfilDto, true);
            if ($perfilDto != "") {
                $json = new Encode_JSON();
                return $json->convert($perfilDto->toString());
            } else {
                return null;
            }
        } else {
            $json = new Encode_JSON();
            return $json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos"));
        }
    }

    public function getUsuarioNombre($txtNombre, $cveSistema, $user, $passwd) {
        if ($this->isValid($user, $passwd)) {
            $usuarioDto = new UsuariosDTO();

            $usuarioDao = new UsuariosDAO();
            $usuarioDto = $usuarioDao->selectNombreUsuario($txtNombre, true);

            $toJson = new DtoToJson($usuarioDto);
            return utf8_encode($toJson->toJson());
        } else {
            $json = new Encode_JSON();
            return $json->convert(array("type" => "Error", "text" => "Usuario y contraseña incorrectos"));
        }
    }

}

//ini_set("soap.wsdl_cache_enabled", "0");
//$server = new SoapServer("LoginScramble.wsdl");
//$server->setClass("LoginServer");
//$server->handle();
?>
