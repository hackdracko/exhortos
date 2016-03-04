<?php

error_reporting(E_ALL);
error_reporting(-1);
include_once(ROOT . DS . "tribunal" . DS . "connect" . DS . "Proveedor.Class.php");
include_once(ROOT . DS . "tribunal" . DS . "logger" . DS . "Logger.Class.php");

class Facade {

    public function __construct() {
        
    }

    public static function run() {
        $tablas = "";
        $contador = 0;
        $error = false;

        $proveedor = new Proveedor(DEFECTO_GESTOR, DEFECTO_BD);
        $proveedor->connect();

        $proveedor->execute("show tables");
        if (!$proveedor->error()) {
            if ($proveedor->rows($proveedor->stmt) > 0) {
                while ($row = $proveedor->fetch_rows($proveedor->stmt, 0)) {
                    $tablas[$contador] = $row[0];
                    $contador++;
                }
            } else {
                $error = true;
                throw new Exception("No se loalizaron tablas de la bd");
            }
        } else {
            $error = true;
            throw new Exception("Ocurrio un error al obtener el listado de tablas de la base");
        }

        if ((!$error) && (count($tablas) > 0)) {
            $logger = new Logger("/../../logs/", "Facades");
            $logger->w_onError("**********COMIENZA EL PROGRAMA CON LA CREACION DEL FACADE**********");
            for ($i = 0; $i < count($tablas); $i++) {
                $campos = "";
                $contador = 0;
                $proveedor->execute("desc " . $tablas[$i]);
                if (!$proveedor->error()) {
                    if ($proveedor->rows($proveedor->stmt) > 0) {
                        while ($row = $proveedor->fetch_rows($proveedor->stmt, 0)) {
                            $campos[$contador] = array("field" => $row[0], "primary" => $row[3], "type" => $row[1]);
                            $contador++;
                        }
                    } else {
                        $error = true;
                    }
                } else {
                    $error = true;
                }

                if (count($campos) > 0) {
                    $pref = substr($tablas[$i], 0, 3);
                    $name = "";
                    if ($pref == DEFECTO_PREFIJO) {
                        $name = substr($tablas[$i], 3);
                    } else {
                        $name = $tablas[$i];
                    }

                    $facade = new Facade();
                    $facade->creaDirectorio(ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name);
                    $logger->w_onError("CREAMOS EL DIRECTORIO: " . ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name);
                    if ($facade->existeDirectorio(ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name)) {
                        if (!$facade->existeArchivo(ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name . DS . ucwords($name) . "Facade.Class.php")) {
                            $dto = fopen(ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name . DS . ucwords($name) . "Facade.Class.php", "w");
                            $logger->w_onError("CREAMOS EL ARCHIVO: " . ROOT . "fachadas" . DS . DEFECTO_BD . DS . $name . DS . ucwords($name) . "Facade.Class.php");
                            $cuerpo = "<?php\n\n";
                            $cuerpo.="/*\n";
                            $cuerpo.="*************************************************\n";
                            $cuerpo.="*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)\n";
                            $cuerpo.="*Copyright 2009-2015 FACADES\n";
                            $cuerpo.="* Licensed under the MIT license \n";
                            $cuerpo.="* Autor: *\n";
                            $cuerpo.="* Departamento de Desarrollo de Software\n";
                            $cuerpo.="* Subdireccion de Ingenieria de Software\n";
                            $cuerpo.="* Direccion de Teclogias de Informacion\n";
                            $cuerpo.="* Poder Judicial del Estado de Mexico\n";
                            $cuerpo.="*************************************************\n";
                            $cuerpo.="*/\n\n";
                            $cuerpo.="session_start();\n";

                            $cuerpo.="include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "modelos" . DS . DEFECTO_BD . DS . "dto" . DS . $name . DS . ucwords($name) . "DTO.Class.php\");\n";
                            $cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "controladores" . DS . DEFECTO_BD . DS . $name . DS . ucwords($name) . "Controller.Class.php\");\n";
                            $cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "tribunal" . DS . "connect" . DS . "Proveedor.Class.php\");\n";
                            $cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "tribunal" . DS . "dtotojson" . DS . "DtoToJson.Class.php\");\n";
                            $cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "tribunal" . DS . "json" . DS . "JsonEncod.Class.php\");\n";
                            $cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . ".." . DS . "tribunal" . DS . "json" . DS . "JsonDecod.Class.php\");\n";
                            //$cuerpo.= "include_once(dirname(__FILE__).\"" . DS . ".." . DS . ".." . DS . "webservice/cliente/" . DS . "permisos" . DS . "PermisosCliente.php\");\n\n";
                            $cuerpo.= "class " . ucwords($name) . "Facade {\n";
                            $cuerpo.= "private \$proveedor;\n";
                            $cuerpo.="public function __construct() {\n";
                            $cuerpo.="}\n";
                            $cuerpo.="public function validar" . ucwords($name) . "($" . ucwords($name) . "Dto){\n";
                            for ($x = 0; $x < count($campos); $x++) {
                                $cuerpo.="$" . ucwords($name) . "Dto->set" . $campos[$x]["field"] . "(strtoupper(str_ireplace(\"'\",\"\",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($" . ucwords($name) . "Dto->get" . $campos[$x]["field"] . "(),\"utf8\"):strtoupper($" . ucwords($name) . "Dto->get" . $campos[$x]["field"] . "()))))));\n";
                                $cuerpo.="if(\$this->esFecha($" . ucwords($name) . "Dto->get" . $campos[$x]["field"] . "())){\n";
                                $cuerpo.="$" . ucwords($name) . "Dto->set" . $campos[$x]["field"] . "(\$this->fechaMysql($" . ucwords($name) . "Dto->get" . $campos[$x]["field"] . "()));\n";
                                $cuerpo.="}\n";
                            }
                            $cuerpo.="return $" . ucwords($name) . "Dto;\n";
                            $cuerpo.="}\n";
                            $cuerpo.="public function select" . ucwords($name) . "($" . ucwords($name) . "Dto){\n";
                            $cuerpo.="$" . ucwords($name) . "Dto=\$this->validar" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="$" . ucwords($name) . "Controller = new " . ucwords($name) . "Controller();\n";
                            $cuerpo.="$" . ucwords($name) . "Dto = $" . ucwords($name) . "Controller->select" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="if($" . ucwords($name) . "Dto!=\"\"){\n";
                            $cuerpo.="\$dtoToJson = new DtoToJson($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="return \$dtoToJson->toJson(\"RESULTADOS DE LA CONSULTA\");\n";
                            $cuerpo.="}\n";
                            $cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            $cuerpo.="return \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"SIN RESULTADOS A MOSTRAR\"));\n";
                            $cuerpo.="}\n";
                            $cuerpo.="public function insert" . ucwords($name) . "($" . ucwords($name) . "Dto){\n";
                            $cuerpo.="$" . ucwords($name) . "Dto=\$this->validar" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="$" . ucwords($name) . "Controller = new " . ucwords($name) . "Controller();\n";
                            $cuerpo.="$" . ucwords($name) . "Dto = $" . ucwords($name) . "Controller->insert" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="if($" . ucwords($name) . "Dto!=\"\"){\n";
                            $cuerpo.="\$dtoToJson = new DtoToJson($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="return \$dtoToJson->toJson(\"REGISTRO REALIZADO DE FORMA CORRECTA\");\n";
                            $cuerpo.="}\n";
                            $cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            $cuerpo.="return \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"OCURRIO UN ERROR AL REALIZAR EL REGISTRO\"));\n";
                            $cuerpo.="}\n";
                            $cuerpo.="public function update" . ucwords($name) . "($" . ucwords($name) . "Dto){\n";
                            $cuerpo.="$" . ucwords($name) . "Dto=\$this->validar" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="$" . ucwords($name) . "Controller = new " . ucwords($name) . "Controller();\n";
                            $cuerpo.="$" . ucwords($name) . "Dto = $" . ucwords($name) . "Controller->update" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="if($" . ucwords($name) . "Dto!=\"\"){\n";
                            $cuerpo.="\$dtoToJson = new DtoToJson($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="return \$dtoToJson->toJson(\"REGISTRO ACTUALIZADO\");\n";
                            $cuerpo.="}\n";
                            $cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            $cuerpo.="return \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION\"));\n";
                            $cuerpo.="}\n";
                            $cuerpo.="public function delete" . ucwords($name) . "($" . ucwords($name) . "Dto){\n";
                            $cuerpo.="$" . ucwords($name) . "Dto=\$this->validar" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="$" . ucwords($name) . "Controller = new " . ucwords($name) . "Controller();\n";
                            $cuerpo.="$" . ucwords($name) . "Dto = $" . ucwords($name) . "Controller->delete" . ucwords($name) . "($" . ucwords($name) . "Dto);\n";
                            $cuerpo.="if($" . ucwords($name) . "Dto==true){\n";
                            $cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            $cuerpo.="return \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"REGISTRO ELIMINADO DE FORMA CORRECTA\"));\n";
                            $cuerpo.="}\n";
                            $cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            $cuerpo.="return \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"OCURRIO UN ERROR AL REALIZAR EL LA BAJA\"));\n";
                            $cuerpo.="}\n";

                            $cuerpo.="private function esFecha(\$fecha) {\n";
                            $cuerpo.="if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', \$fecha)) {\n";
                            $cuerpo.="return true;\n";
                            $cuerpo.="}\n";
                            $cuerpo.="return false;\n";
                            $cuerpo.="}\n";

                            $cuerpo.="private function esFechaMysql(\$fecha) {\n";
                            $cuerpo.="if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', \$fecha)) {\n";
                            $cuerpo.="return true;\n";
                            $cuerpo.="}\n";
                            $cuerpo.="return false;\n";
                            $cuerpo.="}\n";

                            $cuerpo.="private function fechaMysql(\$fecha) {\n";
                            $cuerpo.="list(\$dia, \$mes, \$year) = explode(\"/\", \$fecha);\n";
                            $cuerpo.="return \$year . \"-\" . \$mes . \"-\" . \$dia;\n";
                            $cuerpo.="}\n";

                            $cuerpo.="private function fechaNormal(\$fecha) {\n";
                            $cuerpo.="list(\$dia, \$mes, \$year) = explode(\"/\", \$fecha);\n";
                            $cuerpo.="return \$year . \"-\" . \$mes . \"-\" . \$dia;\n";
                            $cuerpo.="}\n";

                            $cuerpo.= "}\n";
                            $cuerpo.="\n";
                            $cuerpo.="\n";
                            $cuerpo.="\n";

                            for ($x = 0; $x < count($campos); $x++) {
                                $cuerpo.="@$" . $campos[$x]["field"] . "=\$_POST[\"" . $campos[$x]["field"] . "\"];\n";
                                if ($campos[$x]["primary"] == "PRI") {
                                    $primary = $campos[$x]["field"];
                                }
                            }
                            $cuerpo.="@\$accion=\$_POST[\"accion\"];\n\n";
                            $cuerpo.="$" . $name . "Facade = new " . ucwords($name) . "Facade();\n";
                            $cuerpo.="$" . $name . "Dto = new " . ucwords($name) . "DTO();\n\n";

                            for ($x = 0; $x < count($campos); $x++) {
                                $cuerpo.="$" . $name . "Dto->set" . ucwords($campos[$x]["field"]) . "($" . $campos[$x]["field"] . ");\n";
                            }

                            //$cuerpo.="\$permisosCliente = new PermisosCliente();\n";
                            //$cuerpo.="\$permisos = \$permisosCliente->getPermisos(\"../../vistas/" . DEFECTO_BD . DS . "$name/" . "frm" . ucwords($name) . "View.php\",\$_SESSION[\"cveSistema\"],\$_SESSION[\"cvePerfil\"]);\n";
                            //$cuerpo.="if(\$permisos!=\"\"){\n";

//                            $cuerpo.="\$decodeJson = new Decode_JSON();\n";
//                            $cuerpo.="\$permisos = \$decodeJson->decode(\$permisos, true);\n";

                            $cuerpo.="\nif( (\$accion==\"guardar\") && ($" . $primary . "==\"\") ){\n";
                            //$cuerpo.="if(\$permisos[\"data\"][0]->registrar=='S'){\n";
                            $cuerpo.="$" . $name . "Dto=$" . $name . "Facade->insert" . ucwords($name) . "($" . $name . "Dto);\n";
                            $cuerpo.="echo $" . $name . "Dto;\n";
                            //$cuerpo.="}else{\n";
                            //$cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            //$cuerpo.="echo \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"USTED NO TIENE LOS PERMISOS PARA REALIZAR EL GUARDADO\"));\n";
                            //$cuerpo.="}\n";
                            $cuerpo.="} else if((\$accion==\"guardar\") && ($" . $primary . "!=\"\")){\n";
                            //$cuerpo.="if(\$permisos[\"data\"][0]->modificar=='S'){\n";
                            $cuerpo.="$" . $name . "Dto=$" . $name . "Facade->update" . ucwords($name) . "($" . $name . "Dto);\n";
                            $cuerpo.="echo $" . $name . "Dto;\n";
                            //$cuerpo.="}else{\n";
                            //$cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            //$cuerpo.="echo \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"USTED NO TIENE LOS PERMISOS PARA REALIZAR LA ACTUALIZACION\"));\n";
                            //$cuerpo.="}\n";
                            $cuerpo.="} else if(\$accion==\"consultar\"){\n";
                            //$cuerpo.="if(\$permisos[\"data\"][0]->consulta=='S'){\n";
                            $cuerpo.="$" . $name . "Dto=$" . $name . "Facade->select" . ucwords($name) . "($" . $name . "Dto);\n";
                            $cuerpo.="echo $" . $name . "Dto;\n";
                            //$cuerpo.="}else{\n";
                            //$cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            //$cuerpo.="echo \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"USTED NO TIENE LOS PERMISOS PARA REALIZAR LA CONSULTA\"));\n";
                            //$cuerpo.="}\n";
                            $cuerpo.="} else if( (\$accion==\"baja\") && ($" . $primary . "!=\"\") ){\n";
                            //$cuerpo.="if(\$permisos[\"data\"][0]->eliminar=='S'){\n";
                            $cuerpo.="$" . $name . "Dto=$" . $name . "Facade->delete" . ucwords($name) . "($" . $name . "Dto);\n";
                            $cuerpo.="echo $" . $name . "Dto;\n";
                            //$cuerpo.="}else{\n";
                            //$cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            //$cuerpo.="echo \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"USTED NO TIENE LOS PERMISOS PARA REALIZAR LA ACTUALIZACION\"));\n";
                            //$cuerpo.="}\n";
                            $cuerpo.="} else if( (\$accion==\"seleccionar\") && ($" . $primary . "!=\"\") ){\n";
                            //$cuerpo.="if(\$permisos[\"data\"][0]->consulta=='S'){\n";
                            $cuerpo.="$" . $name . "Dto=$" . $name . "Facade->select" . ucwords($name) . "($" . $name . "Dto);\n";
                            $cuerpo.="echo $" . $name . "Dto;\n";
                            //$cuerpo.="}else{\n";
                            //$cuerpo.="\$jsonDto = new Encode_JSON();\n";
                            //$cuerpo.="echo \$jsonDto->encode(array(\"totalCount\"=>\"0\",\"text\"=>\"USTED NO TIENE LOS PERMISOS PARA REALIZAR LA CONSULTA\"));\n";
                            //$cuerpo.="}\n";
                            //$cuerpo.="}\n";
                            $cuerpo.="}\n\n\n?>";
                            fwrite($dto, $cuerpo);
                        } else {
                            $logger->w_onError("EL ARCHIVO YA EXISTE NO SE PUEDE REESCRIBIR " . ROOT . "fachadas" . DS . $name . DS . ucwords($name) . "Facade.Class.php");
                        }
                    } else {
                        $logger->w_onError("EL DIRECTORIO NO SE LOGRO CREAR");
                    }
                }

//                break;
            }
        }

        $proveedor->free_result($proveedor->stmt);
        $proveedor->close();
    }

    private function existeArchivo($NomArchivo) {
        if (file_exists($NomArchivo)) {
            return true;
        } else {
            return false;
        }
    }

    private function creaDirectorio($NomDirectorio) {
        $VectorDirectorio = preg_split("[" . DS . "]", $NomDirectorio);
        $ruta = "";
        foreach ($VectorDirectorio as $Carpeta) {
            if ($Carpeta != "." && trim($Carpeta) != "") {
                if (DEFECTO_SO == "windows") {
                    if ($ruta == "") {
                        $ruta = $Carpeta;
                    } else {
                        $ruta = $ruta . "" . DS . "" . $Carpeta;
                    }
                } else {
                    $ruta = $ruta . "/" . $Carpeta;
                }

                if (!$this->existeDirectorio($ruta)) {
                    mkdir($ruta, 0777);
                }
            }
        }
    }

    private function existeDirectorio($NomDirectorio) {
        if (is_dir($NomDirectorio) == true)
            return true;

        return false;
    }

    private function funcionExiste($function) {
        if (function_exists($function))
            return true;
        else
            return false;
    }

}

?>
