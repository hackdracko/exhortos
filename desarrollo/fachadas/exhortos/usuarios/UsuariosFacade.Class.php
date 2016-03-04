<?php

/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 FACADES
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

session_start();
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../controladores/exhortos/usuarios/UsuariosController.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/dtotojson/DtoToJson.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");


include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");

class UsuariosFacade {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarUsuarios($UsuariosDto) {

        $UsuariosDto->setcveUsuario(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getcveUsuario())))));
        $UsuariosDto->setnumEmpleado(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getnumEmpleado())))));
        $UsuariosDto->setcveAdscripcion(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getcveAdscripcion())))));
        $UsuariosDto->setlogin(trim((utf8_decode(str_replace("'", "", $UsuariosDto->getlogin())))));
        $UsuariosDto->setPassword(trim((utf8_decode(str_replace("'", "", $UsuariosDto->getPassword())))));
        $UsuariosDto->setPasswordCifrado(trim((utf8_decode(str_replace("'", "", $UsuariosDto->getPasswordCifrado())))));
        $UsuariosDto->setcveGrupo(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getcveGrupo())))));
        $UsuariosDto->setpaterno(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getpaterno())))));
        $UsuariosDto->setmaterno(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getmaterno())))));
        $UsuariosDto->setnombre(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getnombre())))));
        $UsuariosDto->setactivo(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->getactivo())))));
        $UsuariosDto->settelefono(trim(mb_strtoupper(utf8_decode(str_replace("'", "", $UsuariosDto->gettelefono())))));
        $UsuariosDto->setemail(trim((utf8_decode(str_replace("'", "", $UsuariosDto->getemail())))));
        $UsuariosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($UsuariosDto->getfechaRegistro(), "utf8") : strtoupper($UsuariosDto->getfechaRegistro()))))));
        if ($this->esFecha($UsuariosDto->getfechaRegistro())) {
            $UsuariosDto->setfechaRegistro($this->fechaMysql($UsuariosDto->getfechaRegistro()));
        }
        $UsuariosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim(utf8_decode((phpversion() <= 5.5) ? mb_strtoupper($UsuariosDto->getfechaActualizacion(), "utf8") : strtoupper($UsuariosDto->getfechaActualizacion()))))));
        if ($this->esFecha($UsuariosDto->getfechaActualizacion())) {
            $UsuariosDto->setfechaActualizacion($this->fechaMysql($UsuariosDto->getfechaActualizacion()));
        }
        return $UsuariosDto;
    }

    public function selectUsuarios($UsuariosDto) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosController = new UsuariosController();
        $UsuariosDto = $UsuariosController->selectUsuarios($UsuariosDto);
        $json = "";
        $x = 1;
        if ($UsuariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($UsuariosDto) . '",';
            $json .= '"data":[';
            foreach ($UsuariosDto as $Usuario) {
                $json .= "{";
                $json .= '"cveUsuario":' . json_encode(utf8_encode($Usuario->getCveUsuario())) . ",";
                $json .= '"numEmpleado":' . json_encode(utf8_encode($Usuario->getNumEmpleado())) . ",";
                $json .= '"cveAdscripcion":' . json_encode(utf8_encode($Usuario->getCveAdscripcion())) . ",";
                $json .= '"cveGrupo":' . json_encode(utf8_encode($Usuario->getCveGrupo())) . ",";
                $json .= '"login":' . json_encode(utf8_encode($Usuario->getLogin())) . ",";
                $json .= '"password":' . json_encode(utf8_encode($Usuario->getPassword())) . ",";
                $json .= '"passwordCifrado":' . json_encode(utf8_encode($Usuario->getPasswordCifrado())) . ",";
                $json .= '"nombre":' . json_encode(utf8_encode($Usuario->getNombre())) . ",";
                $json .= '"paterno":' . json_encode(utf8_encode($Usuario->getPaterno())) . ",";
                $json .= '"materno":' . json_encode(utf8_encode($Usuario->getMaterno())) . ",";
                $json .= '"correo":' . json_encode(utf8_encode($Usuario->getEmail())) . ",";
                $json .= '"telefono":' . json_encode(utf8_encode($Usuario->getTelefono())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Usuario->getActivo())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($UsuariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"total":"' . count($UsuariosDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        return $json;
    }

    public function insertUsuarios($UsuariosDto) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosController = new UsuariosController();
        $UsuariosAuxDto = new UsuariosDTO();
        $UsuariosAuxDto->setNumEmpleado($UsuariosDto->getNumEmpleado());
        $rsUsuarioExiste = $UsuariosController->selectUsuarios($UsuariosAuxDto);
        $json = "";
        if ($rsUsuarioExiste == "") {
            $UsuariosAuxDto->setNumEmpleado("");
            $UsuariosAuxDto->setLogin($UsuariosDto->getLogin());
            $rsLoginExiste = $UsuariosController->selectUsuarios($UsuariosAuxDto);
            if ($rsLoginExiste == "") {
                $UsuariosDto->setPasswordCifrado(sha1($UsuariosDto->getPasswordCifrado()));
                $UsuariosDto = $UsuariosController->insertUsuarios($UsuariosDto);
                $x = 1;
                if ($UsuariosDto != "") {
                    $json .= "{";
                    $json .= '"status":"Ok",';
                    $json .= '"totalCount":"' . count($UsuariosDto) . '",';
                    $json .= '"resultado":[';
                    foreach ($UsuariosDto as $Usuario) {
                        $json .= "{";
                        $json .= '"cveUsuario":' . json_encode(utf8_encode($Usuario->getCveUsuario())) . ",";
                        $json .= '"numEmpleado":' . json_encode(utf8_encode($Usuario->getNumEmpleado())) . ",";
                        $json .= '"cveAdscripcion":' . json_encode(utf8_encode($Usuario->getCveAdscripcion())) . ",";
                        $json .= '"login":' . json_encode(utf8_encode($Usuario->getLogin())) . ",";
                        $json .= '"password":' . json_encode(utf8_encode($Usuario->getPassword())) . ",";
                        $json .= '"passwordCifrado":' . json_encode(utf8_encode($Usuario->getPasswordCifrado())) . ",";
                        $json .= '"cveGrupo":' . json_encode(utf8_encode($Usuario->getCveGrupo())) . ",";
                        $json .= '"nombre":' . json_encode(utf8_encode($Usuario->getNombre())) . ",";
                        $json .= '"paterno":' . json_encode(utf8_encode($Usuario->getPaterno())) . ",";
                        $json .= '"materno":' . json_encode(utf8_encode($Usuario->getMaterno())) . ",";
                        $json .= '"correo":' . json_encode(utf8_encode($Usuario->getEmail())) . ",";
                        $json .= '"telefono":' . json_encode(utf8_encode($Usuario->getTelefono())) . ",";
                        $json .= '"activo":' . json_encode(utf8_encode($Usuario->getActivo())) . "";
                        $json .= "}" . "\n";
                        $x ++;
                        if ($x <= count($UsuariosDto)) {
                            $json .= ",";
                        }
                    }
                    $json .= "],";
                    $json .= '"total":"' . count($UsuariosDto) . '"';
                    $json .= "}";


                    $BitacoramovimientosDao = new BitacoramovimientosDAO();
                    $BitacoramovimientosDto = new BitacoramovimientosDTO();
                    $BitacoramovimientosDto->setCveAccion("1");
                    $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                    $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                    $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                    $BitacoramovimientosDto->setObservaciones("AGREGO USUARIOS " . $json);
                    $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
                } else {
                    $json .= '{"estatus":"Fail",';
                    $json .= '"mnj":"Error al guardar el registro."}';
                }
            } else {
                $json .= '{"estatus":"Fail",';
                $json .= '"mnj":"El usuario ya existe. Verifique."}';
            }
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"El usuario ya se encuentra dado de alta. Verifique."}';
        }
        return $json;
    }

    public function updateUsuarios($UsuariosDto) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosController = new UsuariosController();

        $UsuariosAuxDto = new UsuariosDTO();
        //Se comprueba que no se duplique el numero de empleado
        $UsuariosAuxDto->setNumEmpleado($UsuariosDto->getNumEmpleado());
        $rsUsuarioExiste = $UsuariosController->selectUsuarios($UsuariosAuxDto);
        $json = "";
        $controlModifica = true;
        $controlAux = true;

        if ($rsUsuarioExiste != "") {
            if (($rsUsuarioExiste[0]->getCveUsuario() == $UsuariosDto->getCveUsuario())) {
                $controlModifica = false;
            } else {
                $controlModifica = true;
            }
        } else {
            $controlModifica = false;
        }
        if (!$controlModifica) {

            //Se comprueba que no se duplique el login
            $UsuariosAuxDto->setNumEmpleado("");
            $UsuariosAuxDto->setLogin($UsuariosDto->getLogin());
            $rsLoginExiste = $UsuariosController->selectUsuarios($UsuariosAuxDto);
            if ($rsLoginExiste != "") {
                if (($rsLoginExiste[0]->getCveUsuario()) == ($UsuariosDto->getCveUsuario())) {
                    $controlAux = false;
                } else {
                    $controlAux = true;
                }
            } else {
                $controlAux = false;
            }
            if (!$controlAux) {
                $UsuariosDto->setPasswordCifrado(sha1($UsuariosDto->getPasswordCifrado()));
                $UsuariosDto = $UsuariosController->updateUsuarios($UsuariosDto);
                $json = "";
                $x = 1;
                if ($UsuariosDto != "") {
                    $json .= "{";
                    $json .= '"status":"Ok",';
                    $json .= '"totalCount":"' . count($UsuariosDto) . '",';
                    $json .= '"resultado":[';
                    foreach ($UsuariosDto as $Usuario) {
                        $json .= "{";
                        $json .= '"cveUsuario":' . json_encode(utf8_encode($Usuario->getCveUsuario())) . ",";
                        $json .= '"numEmpleado":' . json_encode(utf8_encode($Usuario->getNumEmpleado())) . ",";
                        $json .= '"cveAdscripcion":' . json_encode(utf8_encode($Usuario->getCveAdscripcion())) . ",";
                        $json .= '"cveGrupo":' . json_encode(utf8_encode($Usuario->getCveGrupo())) . ",";
                        $json .= '"login":' . json_encode(utf8_encode($Usuario->getLogin())) . ",";
                        $json .= '"password":' . json_encode(utf8_encode($Usuario->getPassword())) . ",";
                        $json .= '"passwordCifrado":' . json_encode(utf8_encode($Usuario->getPasswordCifrado())) . ",";
                        $json .= '"nombre":' . json_encode(utf8_encode($Usuario->getNombre())) . ",";
                        $json .= '"paterno":' . json_encode(utf8_encode($Usuario->getPaterno())) . ",";
                        $json .= '"materno":' . json_encode(utf8_encode($Usuario->getMaterno())) . ",";
                        $json .= '"correo":' . json_encode(utf8_encode($Usuario->getEmail())) . ",";
                        $json .= '"telefono":' . json_encode(utf8_encode($Usuario->getTelefono())) . ",";
                        $json .= '"activo":' . json_encode(utf8_encode($Usuario->getActivo())) . "";
                        $json .= "}" . "\n";
                        $x ++;
                        if ($x <= count($UsuariosDto)) {
                            $json .= ",";
                        }
                    }
                    $json .= "],";
                    $json .= '"total":"' . count($UsuariosDto) . '"';
                    $json .= "}";

                    $BitacoramovimientosDao = new BitacoramovimientosDAO();
                    $BitacoramovimientosDto = new BitacoramovimientosDTO();
                    $BitacoramovimientosDto->setCveAccion("2");
                    $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                    $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                    $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                    $BitacoramovimientosDto->setObservaciones(" datos modificados" . $json);
                    $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
                } else {
                    $json .= '{"estatus":"Fail",';
                    $json .= '"mnj":"Error al intentar modificar el registro."}';
                }
            } else {
                $json .= '{"estatus":"Fail",';
                $json .= '"mnj":"Ya existe el usuario. Verifique.."}';
            }
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"Ya se encuentra dado de alta el numero de empleado. Verifique.."}';
        }
        return $json;
    }

    public function deleteUsuarios($UsuariosDto) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosController = new UsuariosController();
        $UsuariosDto = $UsuariosController->deleteUsuarios($UsuariosDto);
        if ($UsuariosDto == true) {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "REGISTRO ELIMINADO DE FORMA CORRECTA"));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
    }

    public function consultarEmpleados($param) {
        $UsuariosController = new UsuariosController();
        $UsuariosDto = $UsuariosController->consultarEmpleados($param);
        $json = "";
        $x = 1;
        if ($UsuariosDto != "") {
            $json .= "{";
            $json .= '"status":"Ok",';
            $json .= '"totalCount":"' . count($UsuariosDto) . '",';
            $json .= '"data":[';
            foreach ($UsuariosDto as $Usuario) {
                $json .= "{";
                $json .= '"cveUsuario":' . json_encode(utf8_encode($Usuario->getCveUsuario())) . ",";
                $json .= '"numEmpleado":' . json_encode(utf8_encode($Usuario->getNumEmpleado())) . ",";
                $json .= '"cveAdscripcion":' . json_encode(utf8_encode($Usuario->getCveAdscripcion())) . ",";
                $json .= '"cveGrupo":' . json_encode(utf8_encode($Usuario->getCveGrupo())) . ",";
                $json .= '"nombre":' . json_encode(utf8_encode($Usuario->getNombre())) . ",";
                $json .= '"paterno":' . json_encode(utf8_encode($Usuario->getPaterno())) . ",";
                $json .= '"materno":' . json_encode(utf8_encode($Usuario->getMaterno())) . ",";
                $json .= '"activo":' . json_encode(utf8_encode($Usuario->getActivo())) . "";
                $json .= "}" . "\n";
                $x ++;
                if ($x <= count($UsuariosDto)) {
                    $json .= ",";
                }
            }
            $json .= "],";
            $json .= '"pagina":' . json_encode(utf8_encode($param["pag"])) . ",";
            $json .= '"total":"' . count($UsuariosDto) . '"';
            $json .= "}";
        } else {
            $json .= '{"estatus":"Fail",';
            $json .= '"mnj":"No se encontraron resultados."}';
        }
        return $json;
    }

    public function cambioPassword($param) {
        $UsuariosController = new UsuariosController();
        $rsUsuarios = $UsuariosController->cambioPassword($param);
        if ($rsUsuarios == true) {
            return $rsUsuarios;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
        }
    }

    public function getPaginas($param) {
        $UsuariosController = new UsuariosController();
        $rsUsuarios = $UsuariosController->getPaginas($param);
        if ($rsUsuarios == true) {
            return $rsUsuarios;
        } else {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
        }
    }

    private function esFecha($fecha) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
            return true;
        }
        return false;
    }

    private function esFechaMysql($fecha) {
        if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
            return true;
        }
        return false;
    }

    private function fechaMysql($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

    private function fechaNormal($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

}

@$cveUsuario = $_POST["cveUsuario"];
@$numEmpleado = $_POST["numEmpleado"];
@$cveAdscripcion = $_POST["cveAdscripcion"];
@$login = $_POST["login"];
@$Password = $_POST["Password"];
@$passwordCifrado = $_POST["passwordCifrado"];
@$cveGrupo = $_POST["cveGrupo"];
@$paterno = $_POST["paterno"];
@$materno = $_POST["materno"];
@$nombre = $_POST["nombre"];
@$activo = $_POST["activo"];
@$telefono = $_POST["telefono"];
@$email = $_POST["email"];
@$fechaRegistro = $_POST["fechaRegistro"];
@$fechaActualizacion = $_POST["fechaActualizacion"];
@$accion = $_POST["accion"];

$usuariosFacade = new UsuariosFacade();
$usuariosDto = new UsuariosDTO();

$usuariosDto->setCveUsuario($cveUsuario);
$usuariosDto->setNumEmpleado($numEmpleado);
$usuariosDto->setCveAdscripcion($cveAdscripcion);
$usuariosDto->setLogin($login);
$usuariosDto->setPassword($Password);
$usuariosDto->setPasswordCifrado($passwordCifrado);
$usuariosDto->setCveGrupo($cveGrupo);
$usuariosDto->setPaterno($paterno);
$usuariosDto->setMaterno($materno);
$usuariosDto->setNombre($nombre);
$usuariosDto->setActivo($activo);
$usuariosDto->setTelefono($telefono);
$usuariosDto->setEmail($email);
$usuariosDto->setFechaRegistro($fechaRegistro);
$usuariosDto->setFechaActualizacion($fechaActualizacion);


$param = array();
@$param["numEmpleado"] = utf8_decode($_POST['numEmpleado']);
@$param["nombre"] = utf8_decode($_POST['nombre']);
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["generico"] = $_POST['generico'];

if (($accion == "guardar") && ($cveUsuario == "")) {
    $usuariosDto = $usuariosFacade->insertUsuarios($usuariosDto);
    echo $usuariosDto;
} else if (($accion == "guardar") && ($cveUsuario != "")) {
    $usuariosDto = $usuariosFacade->updateUsuarios($usuariosDto);
    echo $usuariosDto;
} else if ($accion == "consultar") {
    $usuariosDto = $usuariosFacade->selectUsuarios($usuariosDto);
    echo $usuariosDto;
} else if (($accion == "baja") && ($cveUsuario != "")) {
    $usuariosDto = $usuariosFacade->deleteUsuarios($usuariosDto);
    echo $usuariosDto;
} else if (($accion == "seleccionar") && ($cveUsuario != "")) {
    $usuariosDto = $usuariosFacade->selectUsuarios($usuariosDto);
    echo $usuariosDto;
} else if (($accion == "consultarEmpleados")) {
    $param["paginacion"] = true;
    $usuariosDto = $usuariosFacade->consultarEmpleados($param);
    echo $usuariosDto;
} else if (($accion == "getPaginas")) {
    $param["paginacion"] = true;
    $usuariosDto = $usuariosFacade->getPaginas($param);
    echo $usuariosDto;
} else if (($accion == "cambioPassword")) {
    @$param["passAnterior"] = $_POST['passAnterior'];
    @$param["passNueva"] = $_POST['passNueva'];
    @$param["usuario"] = $_SESSION['cveUsuarioSistema'];
    $usuariosDto = $usuariosFacade->cambioPassword($param);
    echo $usuariosDto;
}
?>