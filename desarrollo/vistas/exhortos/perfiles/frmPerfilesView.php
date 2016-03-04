<?php
/*
 * ************************************************
 * FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
 * Copyright 2009-2015 VIEWS
 * Licensed under the MIT license 
 * Autor: *
 * Departamento de Desarrollo de Software
 * Subdireccion de Ingenieria de Software
 * Direccion de Teclogias de Informacion
 * Poder Judicial del Estado de Mexico
 * ************************************************
 */

session_start();
include_once(dirname(__FILE__) . "/../../../tribunal/tagXml/TagXml.Class.php");
include_once(dirname(__FILE__) . "/../../../tribunal/json/JsonDecod.Class.php");
include_once(dirname(__FILE__) . "/../../../webservice/cliente/permisos/PermisosCliente.php");
$tagXml = new TagXml();
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//perfiles/frmPerfilesView.xml", "frmPerfilesView");
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset = "ISO-8859-1">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <!--The above 3 meta tags *must* come first in the head;
        any other head content must come *after* these tags -->
        <title>Formulario de Perfiles</title>
        <!--Bootstrap -->
        <link href = "../../css/bootstrap.min.css" rel = "stylesheet">
        <link href = "../../css/datetimepicker/bootstrap-datetimepicker.css" rel = "stylesheet"><link href = "../../css/datagrid/jsonGrid.css" rel = "stylesheet">
        <link href = "../../css/normalize.css" rel = "stylesheet">
        <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="../../js/html5shiv/html5shiv.min.js"></script>
        <script src="../../js/respond/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src = "../../js/jquery/jquery.min.js"></script>
        <script src = "../../js/moment/moment.min.js"></script><!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../../js/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/datetimepicker/bootstrap-datetimepicker.min.js"></script><script src="../../js/datagrid/jsonMyDatagrid.js"></script>
        <script src="../../js/funciones.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            guardarPerfiles = function () {
                var <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveSistema", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/perfiles/PerfilesFacade.Class.php",
                    data: {
                        cvePerfil: <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value,
                        cveGrupo: <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value,
                        cveUsuario: <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value,
                        cveSistema: <?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value,
                        cveAdscripcion: <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value,
                        fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                        fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                        activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                        accion: "guardar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divPerfiles').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            if (datos.totalCount > 0) {
                                alert(datos.text);
<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value = datos.data[0].cvePerfil;
<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value = datos.data[0].cveGrupo;
<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value = datos.data[0].cveUsuario;
<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value = datos.data[0].cveSistema;
<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value = datos.data[0].cveAdscripcion;
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = datos.data[0].fechaRegistro;
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = datos.data[0].fechaActualizacion;
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = datos.data[0].activo;
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                            } else {
                                alert(datos.text);
                                document.getElementById('divPerfiles').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                            }
                        } catch (e) {
                            alert(datos.text);
                            document.getElementById('divPerfiles').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            bajaPerfiles = function () {
                var <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveSistema", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                if (confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?") == true) {
                    $.ajax({
                        type: "POST",
                        url: "../../../fachadas/perfiles/PerfilesFacade.Class.php",
                        data: {
                            cvePerfil: <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value,
                            cveGrupo: <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value,
                            cveUsuario: <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value,
                            cveSistema: <?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value,
                            cveAdscripcion: <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value,
                            fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                            fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                            activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                            accion: "baja"},
                        async: true,
                        dataType: "json",
                        beforeSend: function (objeto) {
                            document.getElementById('divPerfiles').innerHTML = "<img src='../../img/cargando.gif'/>";
                        },
                        success: function (datos) {
                            try {
                                alert(datos.text);
                                limpiaPerfiles();
                                document.getElementById('divPerfiles').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                            } catch (e) {
                                alert(datos.text);
                                document.getElementById('divPerfiles').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                            }
                        },
                        error: function (objeto, quepaso, otroobj) {
                        }
                    });
                }
            }
            consultaPerfiles = function () {
                var <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveSistema", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/perfiles/PerfilesFacade.Class.php",
                    data: {
                        cvePerfil: <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value,
                        cveGrupo: <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value,
                        cveUsuario: <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value,
                        cveSistema: <?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value,
                        cveAdscripcion: <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value,
                        fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                        fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                        activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                        accion: "consultar"},
                    async: true,
                    dataType: "html",
                    beforeSend: function (objeto) {
                        document.getElementById('divPerfiles').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        var result = eval("(" + datos + ")");
                        if (result.totalCount > 0) {
                            var datagrid = new JsonMyDatagrid();
                            datagrid.setClase(datagrid);
                            datagrid.setImagenPath("img/");
                            datagrid.setMouseOver("#CCCCCC");
                            datagrid.setMouseOut("#FFFFFF");
                            datagrid.setSizeTable("100%");
                            datagrid.setPaginacion(false);
                            datagrid.setBorder(1);
        //datagrid.setTagImg("deposito");
                            datagrid.setShowPagina("buscar");
                            datagrid.setHeadersP("Perfiles");
                            datagrid.setColspanP("8"); // 90%
                            datagrid.setHeaders("No.", "<?php echo $tagXml->getTag("cveGrupo"); ?>", "<?php echo $tagXml->getTag("cveUsuario"); ?>", "<?php echo $tagXml->getTag("cveSistema"); ?>", "<?php echo $tagXml->getTag("cveAdscripcion"); ?>", "<?php echo $tagXml->getTag("fechaRegistro"); ?>", "<?php echo $tagXml->getTag("fechaActualizacion"); ?>", "<?php echo $tagXml->getTag("activo"); ?>");
                            datagrid.setTamCols('5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%');
                            datagrid.setDocumentJson(datos);
                            datagrid.setDocumentDiv("divPerfiles");
                            datagrid.setTagShow("cveGrupo", "cveUsuario", "cveSistema", "cveAdscripcion", "fechaRegistro", "fechaActualizacion", "activo");
                            datagrid.setTagHidden("cvePerfil");
                            datagrid.setTitle("Resultado de consulta");
                            datagrid.setOnclick("seleccionaPerfiles", "cvePerfil");
                            datagrid.loadJson();
                            $("#divPerfiles").show("slow");
                            ajustar(parent.parent.document.getElementById("Contenido"));
                        } else {
                            alert(result.text);
                            document.getElementById('divPerfiles').innerHTML = "";
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            limpiaPerfiles = function () {
<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = "";
            }
            seleccionaPerfiles = function (idcvePerfil) {
                var <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveSistema", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/perfiles/PerfilesFacade.Class.php",
                    data: {
                        cvePerfil: <?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value = idcvePerfil,
                        accion: "seleccionar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divPerfiles').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            if (datos.totalCount > 0) {
<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>.value = datos.data[0].cvePerfil
<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>.value = datos.data[0].cveGrupo
<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>.value = datos.data[0].cveUsuario
<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>.value = datos.data[0].cveSistema
<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>.value = datos.data[0].cveAdscripcion
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = datos.data[0].fechaRegistro
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = datos.data[0].fechaActualizacion
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = datos.data[0].activo
                                document.getElementById('divPerfiles').innerHTML = "";
                                consultaPerfiles();
                            } else {
                                alert(datos.text);
                                document.getElementById('divPerfiles').innerHTML = "";
                            }
                        } catch (e) {
                            alert(datos.text);
                            document.getElementById('divPerfiles').innerHTML = "";
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaGrupos = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/grupos/GruposFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divGrupos').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveGrupo", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveGrupo", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveGrupo + "'>" + datos.data[index].cveGrupo + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divGrupos').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaUsuarios = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/usuarios/UsuariosFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divUsuarios').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveUsuario", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveUsuario", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveUsuario + "'>" + datos.data[index].cveUsuario + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divUsuarios').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaSistemas = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/sistemas/SistemasFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divSistemas').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveSistema", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveSistema", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveSistema + "'>" + datos.data[index].cveSistema + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divSistemas').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaAdscripciones = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/adscripciones/AdscripcionesFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divAdscripciones').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveAdscripcion", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveAdscripcion", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveAdscripcion + "'>" + datos.data[index].cveAdscripcion + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divAdscripciones').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
        </script>
        <style type="text/css">

            .alert{
                display: none;
            }

            #divHideForm{
                display: none;
                position: absolute;
                width: 100%;
                height: 100vh;
                opacity: .5;
                z-index: 99999;
                background: #427468;
            }

            #divMenssage{                
                width: 100%;
                height: 40px;
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: center;
                margin-top: 40vh;
                margin-bottom: auto;
                color: #284740;
                background: #FFFFFF;
                text-transform: uppercase;

            }

            #divImgloading{                  
                background: #FFFFFF url(img/cargando_1.gif) no-repeat;
                background-position: center;
                width: 100%;
                height: 70px;
                margin-left: auto;
                margin-right: auto;
            }

            .panel panel-default{
                background: #427468;
                color: #ebf3f1;
            }

            .panel-heading{
                background: #427468;
                color: #ebf3f1;
            }

            .panel-group .panel-heading{
                background: #427468;
                color: #ebf3f1;
            }
            .panel-default > .panel-heading{
                background: #427468;        
                color: #ebf3f1;
            }
            .optionprom{
                height: 10px;
            }

            .required{
                color: red;
            }
            .needed:after {
                color:darkred;
                content: " (*)";
            }

        </style>
    </head>
    <body>
        <div class="container panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">                                                            
                    Registro de Perfiles
                </h5>
            </div>
            <div class="panel-body">
                <div id="divFormulario" class="form-horizontal">
                    <div id="divCampos">
            <div class="starter-template">
                <fieldset>
                    <p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cvePerfil", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>" class="caption control-label col-xs-3 needed" id="cvePerfil"><?php echo $tagXml->getTag("cvePerfil"); ?></label>
                        <div class="col-xs-6">
                        <input type="<?php echo ($tagXml->getAttribut("cvePerfil", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cvePerfil", "name"); ?>" id="<?php echo $tagXml->getAttribut("cvePerfil", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cvePerfil", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cvePerfil", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("cvePerfil", "name"); ?>").keydown(posValue);
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveGrupo", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveGrupo"><?php echo $tagXml->getTag("cveGrupo"); ?></label>
                        <div name="divGrupos" id="divGrupos" class="col-xs-6">
                            <input type="<?php echo ($tagXml->getAttribut("cveGrupo", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveGrupo", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveGrupo", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveGrupo", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("cveGrupo", "name"); ?>").keydown(posValue);
                            listaGrupos(2);
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveUsuario", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveUsuario"><?php echo $tagXml->getTag("cveUsuario"); ?></label>
                        <div name="divUsuarios" id="divUsuarios" class="col-xs-6">
                            <input type="<?php echo ($tagXml->getAttribut("cveUsuario", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveUsuario", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveUsuario", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveUsuario", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("cveUsuario", "name"); ?>").keydown(posValue);
                            listaUsuarios(3);
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveSistema", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveSistema"><?php echo $tagXml->getTag("cveSistema"); ?></label>
                        <div name="divSistemas" id="divSistemas" class="col-xs-6">
                            <input type="<?php echo ($tagXml->getAttribut("cveSistema", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveSistema", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveSistema", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveSistema", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveSistema", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("cveSistema", "name"); ?>").keydown(posValue);
                            listaSistemas(4);
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveAdscripcion", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveAdscripcion"><?php echo $tagXml->getTag("cveAdscripcion"); ?></label>
                        <div name="divAdscripciones" id="divAdscripciones" class="col-xs-6">
                            <input type="<?php echo ($tagXml->getAttribut("cveAdscripcion", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveAdscripcion", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveAdscripcion", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveAdscripcion", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("cveAdscripcion", "name"); ?>").keydown(posValue);
                            listaAdscripciones(5);
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaRegistro", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" class="caption control-label col-xs-3 needed" id="fechaRegistro"><?php echo $tagXml->getTag("fechaRegistro"); ?></label>
                        <div class="col-xs-6">
                        <input type="<?php echo ($tagXml->getAttribut("fechaRegistro", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("fechaRegistro", "name"); ?>" id="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("fechaRegistro", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("fechaRegistro", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="6">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("fechaRegistro", "name"); ?>").keydown(posValue);
                            $('#<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>').datetimepicker();
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" class="caption control-label col-xs-3 needed" id="fechaActualizacion"><?php echo $tagXml->getTag("fechaActualizacion"); ?></label>
                        <div class="col-xs-6">
                        <input type="<?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("fechaActualizacion", "name"); ?>" id="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("fechaActualizacion", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("fechaActualizacion", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="7">
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("fechaActualizacion", "name"); ?>").keydown(posValue);
                            $('#<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>').datetimepicker();
                        </script>
                    </div>
                    <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                        <label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption control-label col-xs-3 needed" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
                        <div class="col-xs-6">
                        <select name="<?php echo $tagXml->getAttribut("activo", "name"); ?>" id="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="form-control text-uppercase" tabIndex="8" title="<?php echo $tagXml->getAttribut("activo", "tooltip"); ?>" data-toggle="tooltip" >
                            <option value="S">SI</option>
                            <option value="N">NO</option>
                        </select>
                        </div>
                        <script>
                            $("#<?php echo $tagXml->getAttribut("activo", "name"); ?>").keydown(posValue);
                        </script>
                    </div>
                    </p>
                    <p style="text-align: center;">
                        <button type="button" class="btn btn-success" value="Guardar" id="btnPerfilesGuardar" name="btnPerfilesGuardar" onclick="guardarPerfiles()" tabIndex="10" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                        <button type="button"  class="btn btn-default" value="Limpiar" id="btnPerfilesLimpiar" name="btnPerfilesLimpiar" onclick="limpiaPerfiles()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
                        <button type="button"  class="btn btn-info" value="Consultar" id="btnPerfilesConsultar" name="btnPerfilesConsultar" onclick="consultaPerfiles()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                        <button type="button"  class="btn btn-danger" value="Eliminar" id="btnPerfilesEliminar" name="btnPerfilesEliminar" onclick="bajaPerfiles()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                        <script>
<?php
if (($permisos["data"][0]->registrar == 'N') && ($permisos["data"][0]->modificar == 'N'))
    echo "$(\"#btnPerfilesGuardar\").css(\"display\",\"none\");\n";
?>
<?php
if ($permisos["data"][0]->eliminar == 'N')
    echo "$(\"#btnPerfilesEliminar\").css(\"display\",\"none\");\n";
?>
<?php
if ($permisos["data"][0]->consulta == 'N')
    echo "$(\"#btnPerfilesConsultar\").css(\"display\",\"none\");\n";
?>
                        </script>
                    </p>
                    <div id="divPerfiles" name="divPerfiles" class="table-responsive" width="100%"></div>
                    <script>
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPerfiles();\n";
?>
                    </script>
                </fieldset>
            </div>
                    </div>
                </div>
            </div>
        </div><!--.container -->
        <script>
            ajustar(parent.parent.document.getElementById("Contenido"));
        </script>
    </body>
</html>
