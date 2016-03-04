<?php

include_once(dirname(__FILE__) . "/../../../../tribunal/connect/Proveedor.Class.php");

class SelectDAO {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "gestion") {
        $this->_proveedor = new Proveedor('mysql', 'exhortos');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function _selectDAO($params, $proveedor = null) {

        if ($params != "") {
            if ($proveedor == null) {
                $this->_conexion(null);
            } else if ($proveedor != null) {
                $this->_proveedor = $proveedor;
            }


            if (array_key_exists('fields', $params) && array_key_exists('tables', $params)) {

                $sql = "SELECT " . $params["fields"] . " FROM " . $params["tables"];

                if (array_key_exists('conditions', $params)) {
                    if (trim($params["conditions"]) != "") {
                        $sql .= " WHERE " . $params["conditions"];
                    }
                }

                if (array_key_exists('groups', $params)) {
                    if (trim($params["groups"]) != "") {
                        $sql .= " GROUP BY " . $params["groups"];
                    }
                }

                if (array_key_exists('orders', $params)) {
                    if (trim($params["orders"]) != "") {
                        $sql .= " ORDER BY " . $params["orders"];
                    }
                }

                $FielsName = preg_split("/,/", $params["fields"]);// split(",", $params["fields"]);
//                echo "\n\n" . $sql; 
                $this->_proveedor->execute($sql);
                $json = "";
                $cont = 0;
                $jsondatos = "";
                if (!$this->_proveedor->error()) {
                    if ($this->_proveedor->rows($this->_proveedor->stmt) > 0) {
                        $num_Field = mysqli_num_fields($this->_proveedor->stmt);
                        $json .= "";
                        while ($result = $this->_proveedor->fetch_array($this->_proveedor->stmt, 0)) {
                            $jsonDetalle = "";
                            for ($index = 0; $index < $num_Field; $index++) {
                                $fieldinfo = mysqli_fetch_field_direct($this->_proveedor->stmt, $index);
                                $jsonDetalle .= '"' . $fieldinfo->name . '":' . json_encode(utf8_encode($result[$fieldinfo->name])) . ',';
                            }
                            $cont++;
                            $jsondatos .= "\n" . '{' . substr($jsonDetalle, 0, -1) . '},';
                        }
                        $json .= substr($jsondatos, 0, -1) . "" . "\n";

                        $tmp = '{"Estatus":"ok",';
                        $tmp .= '"totalCount":"' . $cont . '",';
                        $tmp .= '"mnj":"Consulta exitosa",';
                        $tmp .= '"data":[';
                        $tmp .= $json;
                        $tmp .= "]";
                        $tmp .= "}";
                    } else {
                        $tmp = '{"Estatus":"ok",';
                        $tmp .= '"mnj":"Sin resultados",';
                        $tmp .= '"totalCount":"0"';
                        $tmp .= "}";
                    }
                } else {
                    $tmp = '{"Estatus":"Fail",';
                    $tmp .= '"mnj":' . json_encode(utf8_encode($this->_proveedor->error()));
                    $tmp .= "}";
                }

                $this->_proveedor->stmt = $this->_proveedor->free_result($this->_proveedor->stmt);
                if ($proveedor == null) {
                    $this->_proveedor->close();
                }
            } else {
                $tmp = '{"Estatus":"Fail",';
                $tmp .= '"mnj":"La consulta no contiene los parametros necesarios"';
                $tmp .= "}";
            }
        } else {
            $tmp = '{"Estatus":"Fail",';
            $tmp .= '"mnj":"La consulta no contiene los parametros"';
            $tmp .= "}";
        }
        return $tmp;
    }

}

//$SelectDAO = new SelectDAO();
//$params["fields"] = "a.cveAdscripcion,
// a.desAdscripcion,
// j.cveJuzgado,
// j.desJuzgado,
// j.cveAdscripcion,
// o.cveOficialia,
// o.desOficilia,
// m.cveMunicipio,
// m.desMunicipio,
// d.cveDistrito,
// d.desDistrito,
// e.cveEstado,
// e.desEstado";
//$params["tables"] = "tbloficialia o right join (tbljuzgados j inner join tbladscripciones a on a.cveAdscripcion = j.cveAdscripcion) on o.cveOficialia = j.cveOficialia
//left join tblmunicipios m on o.cveMunicipio = m.cveMunicipio 
//left join tbldistritos d on o.cveDistrito = d.cveDistrito
//left join tblestados e on m.cveEstado = e.cveEstado AND d.cveEstado = e.cveEstado";
//$params["conditions"] = "";
//$params["groups"] = "";
//$params["orders"] = "";
//
//$rs = $SelectDAO->_selectDAO($params);
//print_r($rs);
