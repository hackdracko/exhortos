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

include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dto/contadores/ContadoresDTO.Class.php");
include_once(dirname(__FILE__) . "/../../../modelos/exhortos/dao/contadores/ContadoresDAO.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/connect/Proveedor.Class.php");

class ContadoresController {

    private $proveedor;

    public function __construct() {
        
    }

    public function validarContadores($ContadoresDto) {
        $ContadoresDto->setidContador(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getidContador()))));
        $ContadoresDto->setnumero(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getnumero()))));
        $ContadoresDto->setanio(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getanio()))));
        $ContadoresDto->setcveJuzgado(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getcveJuzgado()))));
        $ContadoresDto->setactivo(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getactivo()))));
        $ContadoresDto->setfechaRegistro(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getfechaRegistro()))));
        $ContadoresDto->setfechaActualizacion(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getfechaActualizacion()))));
        $ContadoresDto->setcveTipoActuacion(strtoupper(str_ireplace("'", "", trim($ContadoresDto->getcveTipoActuacion()))));
        return $ContadoresDto;
    }

    public function selectContadores($ContadoresDto, $proveedor = null) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresDao = new ContadoresDAO();
        $ContadoresDto = $ContadoresDao->selectContadores($ContadoresDto, $proveedor);
        return $ContadoresDto;
    }

    public function insertContadores($ContadoresDto, $proveedor = null) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresDao = new ContadoresDAO();
        $ContadoresDto = $ContadoresDao->insertContadores($ContadoresDto, $proveedor);
        return $ContadoresDto;
    }

    public function updateContadores($ContadoresDto, $proveedor = null) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresDao = new ContadoresDAO();
//$tmpDto = new ContadoresDTO();
//$tmpDto = $ContadoresDao->selectContadores($ContadoresDto,$proveedor);
//if($tmpDto!=""){//$ContadoresDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
        $ContadoresDto = $ContadoresDao->updateContadores($ContadoresDto, $proveedor);
        return $ContadoresDto;
//}
//return "";
    }

    public function deleteContadores($ContadoresDto, $proveedor = null) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresDao = new ContadoresDAO();
        $ContadoresDto = $ContadoresDao->deleteContadores($ContadoresDto, $proveedor);
        return $ContadoresDto;
    }

    public function selectContadoresGeneral($ContadoresDto, $param = null) {
        $ContadoresDto = $this->validarContadores($ContadoresDto);
        $ContadoresDao = new ContadoresDAO();
        $ContadoresDto = $ContadoresDao->selectContadoresGeneral($ContadoresDto, null, "", $param, null);
        return $ContadoresDto;
    }

    public function getPaginas($ContadoresDto, $param) {

        $ContadoresDao = new ContadoresDAO();
        $numTot = $ContadoresDao->selectContadoresGeneral($ContadoresDto, null, "", $param, " count(idContador) as totalCount ");
        
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

    public function getContador($contadoresDto, $proveedor = null) {
//print_r($contadoresDto);
        $error = false;

        if ($proveedor == null) {
            $this->proveedor = new Proveedor('mysql', 'exhortos');
            $this->proveedor->connect();
            $this->proveedor->execute("BEGIN");
        } else {
            $this->proveedor = $proveedor;
        }

        $tmpDto = $contadoresDto;

        $contadoresDao = new ContadoresDAO();
        $tmpDto = $contadoresDao->selectContadores($tmpDto, " FOR UPDATE ", $this->proveedor); // CONSULTAMOS Y BLOQUEMOS EL REGISTRO

        if ($tmpDto != "") {
            $numero = (int) $tmpDto[0]->getNumero(); // Obtnemos el numero
            $numero = $numero + 1;                          // Incrementamos el numero
            $tmpDto[0]->setNumero($numero);          //setiamos el numero para realizar la actualizacion en la base de datos
            $tmpDto = $contadoresDao->updateContadores($tmpDto[0], $this->proveedor); // Actualizamos el registro en la tabla de contadores
            if ($tmpDto == "") {
                $error = true;
            }
        } else {
            $tmpDto = new ContadoresDTO();
            $tmpDto->setCveJuzgado($contadoresDto->getCveJuzgado());
            $tmpDto->setCveTipoActuacion($contadoresDto->getCveTipoActuacion());
            $tmpDto->setAnio($contadoresDto->getAnio());
            $tmpDto->setNumero(1);

            $tmpDto = $contadoresDao->insertContadores($tmpDto, $this->proveedor); // INsertamos un nuevo contador en uno

            if ($tmpDto == "") {
                $error = true;
            }
        }

        if ($proveedor == null) {
            if ($error == false) {
                $this->proveedor->execute("COMMIT");
            } else {
                $this->proveedor->execute("ROLLBACK");
            }
        }


        if ($proveedor == null) {
            $this->proveedor->close();
        }

        return $tmpDto;
    }

}

//$contadoresDto = new ContadoresDTO();
//$contadoresDto->setCveJuzgado(1);
//$contadoresDto->setCveTipoActuacion(2);
//$contadoresDto->setAnio("2015");
//
//$contadoresController = new ContadoresController();
//$contadoresDto = $contadoresController->getContador($contadoresDto);
//print_r($contadoresDto);
?>