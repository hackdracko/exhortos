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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/usuarios/UsuariosDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/bitacoramovimientos/BitacoramovimientosDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/bitacoramovimientos/BitacoramovimientosDAO.Class.php");

class UsuariosController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarUsuarios($UsuariosDto) {
        $UsuariosDto->setcveUsuario(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getcveUsuario()))));
        $UsuariosDto->setnumEmpleado(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getnumEmpleado()))));
        $UsuariosDto->setcveAdscripcion(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getcveAdscripcion()))));
        $UsuariosDto->setlogin((str_ireplace("'", "", trim($UsuariosDto->getlogin()))));
        $UsuariosDto->setPassword((str_ireplace("'", "", trim($UsuariosDto->getPassword()))));
        $UsuariosDto->setPasswordCifrado((str_ireplace("'", "", trim($UsuariosDto->getPasswordCifrado()))));
        $UsuariosDto->setcveGrupo(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getcveGrupo()))));
        $UsuariosDto->setpaterno(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getpaterno()))));
        $UsuariosDto->setmaterno(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getmaterno()))));
        $UsuariosDto->setnombre(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getnombre()))));
        $UsuariosDto->setactivo(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getactivo()))));
        $UsuariosDto->settelefono(strtoupper(str_ireplace("'", "", trim($UsuariosDto->gettelefono()))));
        $UsuariosDto->setemail((str_ireplace("'", "", trim($UsuariosDto->getemail()))));
        $UsuariosDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getfechaRegistro()))));
        $UsuariosDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($UsuariosDto->getfechaActualizacion()))));
        return $UsuariosDto;
    }

    public function selectUsuarios($UsuariosDto, $proveedor = null) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = $UsuariosDao->selectUsuarios($UsuariosDto, $proveedor);
        return $UsuariosDto;
    }

    public function insertUsuarios($UsuariosDto, $proveedor = null) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = $UsuariosDao->insertUsuarios($UsuariosDto, $proveedor);
        return $UsuariosDto;
    }

    public function updateUsuarios($UsuariosDto, $proveedor = null) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = $UsuariosDao->updateUsuarios($UsuariosDto, $proveedor);
        return $UsuariosDto;
//}
//return "";
    }

    public function deleteUsuarios($UsuariosDto, $proveedor = null) {
        $UsuariosDto = $this->validarUsuarios($UsuariosDto);
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = $UsuariosDao->deleteUsuarios($UsuariosDto, $proveedor);
        return $UsuariosDto;
    }

    public function consultarEmpleados($param, $proveedor = null) {
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = $UsuariosDao->consultarEmpleados($param, $proveedor);
        return $UsuariosDto;
    }

    public function getPaginas($param) {

        $UsuariosDao = new UsuariosDAO();
        $numTot = $UsuariosDao->consultarEmpleados($param, null, "", " count(cveUsuario) as totalCount ");
//        print_r($param);
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

    public function cambioPassword($param) {
        $UsuariosDao = new UsuariosDAO();
        $UsuariosDto = new UsuariosDTO();
        $UsuariosDto->setCveUsuario($param['usuario']);
        $UsuariosDto->setPassword($param['passAnterior']);
        $rsUsuario = $UsuariosDao->selectUsuarios($UsuariosDto);
        $json = "";
        $x = 1;
        if ($rsUsuario != "") {
            $UsuariosDto->setCveUsuario($param['usuario']);
            $UsuariosDto->setPassword($param['passNueva']);
            $UsuariosDto->setPasswordCifrado(sha1($param['passNueva']));
            $rsPassUsuario = $UsuariosDao->updateUsuarios($UsuariosDto);
            if ($rsPassUsuario != "") {
                $json .= '{"status":"ok",';
                $json .= '"mnj":"La contrase&ntilde;a se modifico de forma satisfactoria."}';

                $BitacoramovimientosDao = new BitacoramovimientosDAO();
                $BitacoramovimientosDto = new BitacoramovimientosDTO();
                $BitacoramovimientosDto->setCveAccion("36");
                $BitacoramovimientosDto->setCveUsuario($_SESSION['cveUsuarioSistema']);
                $BitacoramovimientosDto->setCvePerfil($_SESSION['cvePerfil']);
                $BitacoramovimientosDto->setCveAdscripcion($_SESSION['cveAdscripcion']);
                $BitacoramovimientosDto->setObservaciones("modifico password. cveUsuario: " . $rsPassUsuario[0]->getCveUsuario() . " password Anterior:" . $rsUsuario[0]->getPassword() . " password Actual:" . $rsPassUsuario[0]->getPassword());
                $BitacoramovimientosDto = $BitacoramovimientosDao->insertBitacoramovimientos($BitacoramovimientosDto, $this->proveedor);
            } else {
                $json .= '{"status":"Fail",';
                $json .= '"mnj":"No se puedo modificar la contrase&ntilde;a."}';
            }
        } else {
            $json .= '{"status":"Fail",';
            $json .= '"mnj":"La contrase&ntilde;a anterior no corresponde a este usuario."}';
        }
        return $json;
    }

}

?>