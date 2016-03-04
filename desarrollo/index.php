<?php

error_reporting(E_ALL);
error_reporting(-1);
//define('DS', DIRECTORY_SEPARATOR);
define('DS', "/");
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'aplicacion' . DS);

include_once(dirname(__FILE__) . "/tribunal/import/Package.Class.php");
new Package(trim(dirname(__FILE__) . "/aplicacion/configuracion.php"));
new Package(trim(dirname(__FILE__) . "/aplicacion/controller.php"));
new Package(trim(dirname(__FILE__) . "/aplicacion/facade.php"));
new Package(trim(dirname(__FILE__) . "/aplicacion/modelo.php"));
new Package(trim(dirname(__FILE__) . "/aplicacion/solicitud.php"));
new Package(trim(dirname(__FILE__) . "/aplicacion/view.php"));

date_default_timezone_set('America/Mexico_City');

if (DEFECTO_MODELO) {
    try {
        trim(Modelo::run());
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (DEFECTO_CONTROLLER) {
    try {
        Controller::run();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (DEFECTO_FACADE) {
    try {
        Facade::run();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (DEFECTO_VISTA) {
    try {
        View::run();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


$solicitud = new Solicitud();

if ($solicitud->getFachada() == "index") {
    header('Location: vistas/login.php');
} else {
    $accion = $solicitud->getFachada() . "/" . $solicitud->getMetodo();
    $argumentos = $solicitud->getArgumentos();

    if (count($argumentos) > 0) {
        for ($index = 0; $index < count($argumentos); $index++) {
            $accion.="/" . $argumentos[$index];
        }
    }
    if (file_exists($accion)) {
        header('Location: ' . $accion);
    } else {
        $facade = $solicitud->getFachada();
        $metodo = $solicitud->getMetodo();
        $parameters = array();
        $count = 0;

        foreach ($_GET as $param => $value) {
            if ($param != "url") {
                $parameters[$count] = array($param => $value);
                $count++;
            }
        }

        $reporte = explode(".", $metodo);
        if (count($reporte) > 1) {
            $accion = $reporte[0];
            $type = $reporte[1];

            $fileController = dirname(__FILE__) . "/controladores/".DEFECTO_BD."/" . strtolower($accion) . "/" . ucwords($accion) . "Controller.Class.php";
            $fileDto = dirname(__FILE__) . "/modelos/".DEFECTO_BD."/dto/" . strtolower($accion) . "/" . ucwords($accion) . "DTO.Class.php";

            if (file_exists($fileController)) {
                $controlador = ucwords($accion) . "Controller";
                $dto = ucwords($accion) . "DTO";
                $metodo = "select" . ucwords($accion);
                include_once(dirname(__FILE__) . "/tribunal/dtotojson/DtoToJson.Class.php");
                include_once(dirname(__FILE__) . "/tribunal/json/JsonEncod.Class.php");
                include_once($fileController);
                include_once($fileDto);
                $controlador = new $controlador;
                $dto = new $dto;
                for ($index = 0; $index < count($parameters); $index++) {
                    foreach ($parameters[$index] as $param => $value) {
                        $funcion = "set" . ucwords($param);
                        $dto->$funcion($value);
                    }
                }
                $dto = $controlador->$metodo($dto);
                if ($type == "json") {
                    if ($dto != "") {
                        $dtoToJson = new DtoToJson($dto);
                        echo $dtoToJson->toJson("");
                    } else {
                        $jsonDto = new Encode_JSON();
                        echo $jsonDto->encode(array("totalCount" => "0", "text" => "SIN RESULTADOS A MOSTRAR"));
                    }
                } else if ($type == "xml") {
                    $xml = "<?xml version='1.0'?>
      <$accion>
      </$accion>";

                    $fileXml = simplexml_load_string($xml);

                    for ($index = 0; $index < count($dto); $index++) {
                        $resultado = $fileXml->addChild("resultado");
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {
                            $tag = trim(substr($tag, strlen($accion . "DTO") + 1, strlen($tag)));
                            $resultado->addChild($tag, $value);
                        }
                    }

                    Header('Content-type: text/xml');
                    $xmlFormat = trim($fileXml->asXML());
                    echo $xmlFormat;
                    //                    echo "prueba";
                } else if ($type == "doc") {
                    $html = "<table border=\"1\">";
                    $html.="<tr>";

                    for ($index = 0; $index < count($dto); $index++) {
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {
                            $tag = trim(substr($tag, strlen($accion . "DTO") + 1, strlen($tag)));
                            $html.="<td>$tag</td>";
                        }
                        break;
                    }
                    $html.="</tr>";



                    for ($index = 0; $index < count($dto); $index++) {
                        $html.="<tr>";
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {

                            $html.="<td>$value</td>";
                        }
                        $html.="</tr>";
                    }

                    header('Content-type: application/vnd.ms-word');
                    header("Content-Disposition: attachment; filename=$accion.doc");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                    echo $html.="</table>";
                } else if ($type == "xls") {
                    $html = "<table border=\"1\">";
                    $html.="<tr>";

                    for ($index = 0; $index < count($dto); $index++) {
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {
                            $tag = trim(substr($tag, strlen($accion . "DTO") + 1, strlen($tag)));
                            $html.="<td>$tag</td>";
                        }
                        break;
                    }
                    $html.="</tr>";



                    for ($index = 0; $index < count($dto); $index++) {
                        $html.="<tr>";
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {

                            $html.="<td>$value</td>";
                        }
                        $html.="</tr>";
                    }

                    header('Content-type: application/vnd.ms-excel');
                    header("Content-Disposition: attachment; filename=$accion.xls");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                    echo $html.="</table>";
                } else if ($type == "html") {
                    $html = "<table border=\"1\">";
                    $html.="<tr>";

                    for ($index = 0; $index < count($dto); $index++) {
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {
                            $tag = trim(substr($tag, strlen($accion . "DTO") + 1, strlen($tag)));
                            $html.="<td>$tag</td>";
                        }
                        break;
                    }
                    $html.="</tr>";



                    for ($index = 0; $index < count($dto); $index++) {
                        $html.="<tr>";
                        $r = (array) $dto[$index];
                        foreach ($r as $tag => $value) {

                            $html.="<td>$value</td>";
                        }
                        $html.="</tr>";
                    }


                    echo $html.="</table>";
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                header("Status: 404 Not Found");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            header("Status: 404 Not Found");
        }
    }
}
?>
