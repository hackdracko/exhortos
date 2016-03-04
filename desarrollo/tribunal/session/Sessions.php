<?php

session_start();

@$cveUsuarioSistema = $_SESSION["cveUsuarioSistema"];
@$cvePerfil = $_POST["cvePerfil"];

if (($cvePerfil !== "") && (isset($_SESSION["cveUsuarioSistema"]))) {
    $fileJson = "../../archivos/" . $cveUsuarioSistema . ".json";
    if (file_exists($fileJson)) {

        $json = file_get_contents($fileJson);
        if ($json !== "") {
            $json = json_decode($json, true);
            if ($json["cveUsuario"] === $cveUsuarioSistema) {
                $_SESSION["cveUsuarioSistema"] = $json["cveUsuario"];
                $_SESSION["numEmpleado"] = $json["numEmpleado"];
                $_SESSION["nombre"] = $json["nombre"] . " " . $json["paterno"] . " " . $json["materno"];
                $_SESSION["email"] = $json["email"];
//                $_SESSION["tipoUsuario"] = $json["tipoUsuario"];

                foreach ($json["perfiles"][0]["perfil"] as $perfil) {
                    if ($perfil["cvePerfil"] === $cvePerfil) {
                        $_SESSION["cveGrupo"] = $perfil["cveGrupo"];
                        $_SESSION["cveSistema"] = $perfil["cveSistema"];
                        $_SESSION["cvePerfil"] = $perfil["cvePerfil"];
                        $_SESSION["cveAdscripcion"] = $perfil["cveAdscripcion"];
                        $_SESSION["desAdscripcion"] = $perfil["desAdscripcion"];
                    }
                }
            } else {
                echo "No corresponde Usuario Session vs Json";
            }
        } else {
            echo "Empty Json";
        }
    } else {
        echo "No Existe archivo";
    }
} else {
    echo "Sin session";
}


?>