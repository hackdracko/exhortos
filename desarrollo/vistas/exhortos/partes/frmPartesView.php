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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//partes/frmPartesView.xml", "frmPartesView");
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset = "ISO-8859-1">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <!--The above 3 meta tags *must* come first in the head;
        any other head content must come *after* these tags -->
        <title>Formulario de Partes</title>
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
            guardarPartes = function () {
                var <?php echo $tagXml->getAttribut("idParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
                var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("edad", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("edad", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>");
                var <?php echo $tagXml->getAttribut("RFC", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("RFC", "id"); ?>");
                var <?php echo $tagXml->getAttribut("CURP", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("CURP", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveEstado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("domicilio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("domicilio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
                var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
                var <?php echo $tagXml->getAttribut("detenido", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("detenido", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/partes/PartesFacade.Class.php",
                    data: {
                        idParte: <?php echo $tagXml->getAttribut("idParte", "id"); ?>.value,
                        idExhorto: <?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value,
                        idExhortoGenerado: <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value,
                        nombre: <?php echo $tagXml->getAttribut("nombre", "id"); ?>.value,
                        paterno: <?php echo $tagXml->getAttribut("paterno", "id"); ?>.value,
                        materno: <?php echo $tagXml->getAttribut("materno", "id"); ?>.value,
                        nombrePersonaMoral: <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value,
                        cveTipoPersona: <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value,
                        cveTipoParte: <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value,
                        edad: <?php echo $tagXml->getAttribut("edad", "id"); ?>.value,
                        fechaNacimiento: <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value,
                        RFC: <?php echo $tagXml->getAttribut("RFC", "id"); ?>.value,
                        CURP: <?php echo $tagXml->getAttribut("CURP", "id"); ?>.value,
                        cveEstado: <?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value,
                        cveMunicipio: <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value,
                        domicilio: <?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value,
                        telefono: <?php echo $tagXml->getAttribut("telefono", "id"); ?>.value,
                        email: <?php echo $tagXml->getAttribut("email", "id"); ?>.value,
                        cveGenero: <?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value,
                        detenido: <?php echo $tagXml->getAttribut("detenido", "id"); ?>.value,
                        activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                        fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                        fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                        accion: "guardar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divPartes').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            if (datos.totalCount > 0) {
                                alert(datos.text);
<?php echo $tagXml->getAttribut("idParte", "id"); ?>.value = datos.data[0].idParte;
<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value = datos.data[0].idExhorto;
<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value = datos.data[0].idExhortoGenerado;
<?php echo $tagXml->getAttribut("nombre", "id"); ?>.value = datos.data[0].nombre;
<?php echo $tagXml->getAttribut("paterno", "id"); ?>.value = datos.data[0].paterno;
<?php echo $tagXml->getAttribut("materno", "id"); ?>.value = datos.data[0].materno;
<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value = datos.data[0].nombrePersonaMoral;
<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value = datos.data[0].cveTipoPersona;
<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value = datos.data[0].cveTipoParte;
<?php echo $tagXml->getAttribut("edad", "id"); ?>.value = datos.data[0].edad;
<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value = datos.data[0].fechaNacimiento;
<?php echo $tagXml->getAttribut("RFC", "id"); ?>.value = datos.data[0].RFC;
<?php echo $tagXml->getAttribut("CURP", "id"); ?>.value = datos.data[0].CURP;
<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value = datos.data[0].cveEstado;
<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value = datos.data[0].cveMunicipio;
<?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value = datos.data[0].domicilio;
<?php echo $tagXml->getAttribut("telefono", "id"); ?>.value = datos.data[0].telefono;
<?php echo $tagXml->getAttribut("email", "id"); ?>.value = datos.data[0].email;
<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value = datos.data[0].cveGenero;
<?php echo $tagXml->getAttribut("detenido", "id"); ?>.value = datos.data[0].detenido;
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = datos.data[0].activo;
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = datos.data[0].fechaRegistro;
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = datos.data[0].fechaActualizacion;
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
?>
                            } else {
                                alert(datos.text);
                                document.getElementById('divPartes').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
?>
                            }
                        } catch (e) {
                            alert(datos.text);
                            document.getElementById('divPartes').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
?>
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            bajaPartes = function () {
                var <?php echo $tagXml->getAttribut("idParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
                var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("edad", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("edad", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>");
                var <?php echo $tagXml->getAttribut("RFC", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("RFC", "id"); ?>");
                var <?php echo $tagXml->getAttribut("CURP", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("CURP", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveEstado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("domicilio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("domicilio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
                var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
                var <?php echo $tagXml->getAttribut("detenido", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("detenido", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                if (confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?") == true) {
                    $.ajax({
                        type: "POST",
                        url: "../../../fachadas/partes/PartesFacade.Class.php",
                        data: {
                            idParte: <?php echo $tagXml->getAttribut("idParte", "id"); ?>.value,
                            idExhorto: <?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value,
                            idExhortoGenerado: <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value,
                            nombre: <?php echo $tagXml->getAttribut("nombre", "id"); ?>.value,
                            paterno: <?php echo $tagXml->getAttribut("paterno", "id"); ?>.value,
                            materno: <?php echo $tagXml->getAttribut("materno", "id"); ?>.value,
                            nombrePersonaMoral: <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value,
                            cveTipoPersona: <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value,
                            cveTipoParte: <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value,
                            edad: <?php echo $tagXml->getAttribut("edad", "id"); ?>.value,
                            fechaNacimiento: <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value,
                            RFC: <?php echo $tagXml->getAttribut("RFC", "id"); ?>.value,
                            CURP: <?php echo $tagXml->getAttribut("CURP", "id"); ?>.value,
                            cveEstado: <?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value,
                            cveMunicipio: <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value,
                            domicilio: <?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value,
                            telefono: <?php echo $tagXml->getAttribut("telefono", "id"); ?>.value,
                            email: <?php echo $tagXml->getAttribut("email", "id"); ?>.value,
                            cveGenero: <?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value,
                            detenido: <?php echo $tagXml->getAttribut("detenido", "id"); ?>.value,
                            activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                            fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                            fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                            accion: "baja"},
                        async: true,
                        dataType: "json",
                        beforeSend: function (objeto) {
                            document.getElementById('divPartes').innerHTML = "<img src='../../img/cargando.gif'/>";
                        },
                        success: function (datos) {
                            try {
                                alert(datos.text);
                                limpiaPartes();
                                document.getElementById('divPartes').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
?>
                            } catch (e) {
                                alert(datos.text);
                                document.getElementById('divPartes').innerHTML = "";
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
?>
                            }
                        },
                        error: function (objeto, quepaso, otroobj) {
                        }
                    });
                }
            }
            consultaPartes = function () {
                var <?php echo $tagXml->getAttribut("idParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
                var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("edad", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("edad", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>");
                var <?php echo $tagXml->getAttribut("RFC", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("RFC", "id"); ?>");
                var <?php echo $tagXml->getAttribut("CURP", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("CURP", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveEstado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("domicilio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("domicilio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
                var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
                var <?php echo $tagXml->getAttribut("detenido", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("detenido", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/partes/PartesFacade.Class.php",
                    data: {
                        idParte: <?php echo $tagXml->getAttribut("idParte", "id"); ?>.value,
                        idExhorto: <?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value,
                        idExhortoGenerado: <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value,
                        nombre: <?php echo $tagXml->getAttribut("nombre", "id"); ?>.value,
                        paterno: <?php echo $tagXml->getAttribut("paterno", "id"); ?>.value,
                        materno: <?php echo $tagXml->getAttribut("materno", "id"); ?>.value,
                        nombrePersonaMoral: <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value,
                        cveTipoPersona: <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value,
                        cveTipoParte: <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value,
                        edad: <?php echo $tagXml->getAttribut("edad", "id"); ?>.value,
                        fechaNacimiento: <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value,
                        RFC: <?php echo $tagXml->getAttribut("RFC", "id"); ?>.value,
                        CURP: <?php echo $tagXml->getAttribut("CURP", "id"); ?>.value,
                        cveEstado: <?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value,
                        cveMunicipio: <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value,
                        domicilio: <?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value,
                        telefono: <?php echo $tagXml->getAttribut("telefono", "id"); ?>.value,
                        email: <?php echo $tagXml->getAttribut("email", "id"); ?>.value,
                        cveGenero: <?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value,
                        detenido: <?php echo $tagXml->getAttribut("detenido", "id"); ?>.value,
                        activo: <?php echo $tagXml->getAttribut("activo", "id"); ?>.value,
                        fechaRegistro: <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value,
                        fechaActualizacion: <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value,
                        accion: "consultar"},
                    async: true,
                    dataType: "html",
                    beforeSend: function (objeto) {
                        document.getElementById('divPartes').innerHTML = "<img src='../../img/cargando.gif'/>";
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
                            datagrid.setHeadersP("Partes");
                            datagrid.setColspanP("23"); // 90%
                            datagrid.setHeaders("No.", "<?php echo $tagXml->getTag("idExhorto"); ?>", "<?php echo $tagXml->getTag("idExhortoGenerado"); ?>", "<?php echo $tagXml->getTag("nombre"); ?>", "<?php echo $tagXml->getTag("paterno"); ?>", "<?php echo $tagXml->getTag("materno"); ?>", "<?php echo $tagXml->getTag("nombrePersonaMoral"); ?>", "<?php echo $tagXml->getTag("cveTipoPersona"); ?>", "<?php echo $tagXml->getTag("cveTipoParte"); ?>", "<?php echo $tagXml->getTag("edad"); ?>", "<?php echo $tagXml->getTag("fechaNacimiento"); ?>", "<?php echo $tagXml->getTag("RFC"); ?>", "<?php echo $tagXml->getTag("CURP"); ?>", "<?php echo $tagXml->getTag("cveEstado"); ?>", "<?php echo $tagXml->getTag("cveMunicipio"); ?>", "<?php echo $tagXml->getTag("domicilio"); ?>", "<?php echo $tagXml->getTag("telefono"); ?>", "<?php echo $tagXml->getTag("email"); ?>", "<?php echo $tagXml->getTag("cveGenero"); ?>", "<?php echo $tagXml->getTag("detenido"); ?>", "<?php echo $tagXml->getTag("activo"); ?>", "<?php echo $tagXml->getTag("fechaRegistro"); ?>", "<?php echo $tagXml->getTag("fechaActualizacion"); ?>");
                            datagrid.setTamCols('5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%');
                            datagrid.setDocumentJson(datos);
                            datagrid.setDocumentDiv("divPartes");
                            datagrid.setTagShow("idExhorto", "idExhortoGenerado", "nombre", "paterno", "materno", "nombrePersonaMoral", "cveTipoPersona", "cveTipoParte", "edad", "fechaNacimiento", "RFC", "CURP", "cveEstado", "cveMunicipio", "domicilio", "telefono", "email", "cveGenero", "detenido", "activo", "fechaRegistro", "fechaActualizacion");
                            datagrid.setTagHidden("idParte");
                            datagrid.setTitle("Resultado de consulta");
                            datagrid.setOnclick("seleccionaPartes", "idParte");
                            datagrid.loadJson();
                            $("#divPartes").show("slow");
                            ajustar(parent.parent.document.getElementById("Contenido"));
                        } else {
                            alert(result.text);
                            document.getElementById('divPartes').innerHTML = "";
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            limpiaPartes = function () {
<?php echo $tagXml->getAttribut("idParte", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("nombre", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("paterno", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("materno", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("edad", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("RFC", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("CURP", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("telefono", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("email", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("detenido", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = "";
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = "";
            }
            seleccionaPartes = function (ididParte) {
                var <?php echo $tagXml->getAttribut("idParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
                var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
                var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
                var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
                var <?php echo $tagXml->getAttribut("edad", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("edad", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>");
                var <?php echo $tagXml->getAttribut("RFC", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("RFC", "id"); ?>");
                var <?php echo $tagXml->getAttribut("CURP", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("CURP", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveEstado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("domicilio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("domicilio", "id"); ?>");
                var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
                var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
                var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
                var <?php echo $tagXml->getAttribut("detenido", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("detenido", "id"); ?>");
                var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
                var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/partes/PartesFacade.Class.php",
                    data: {
                        idParte: <?php echo $tagXml->getAttribut("idParte", "id"); ?>.value = ididParte,
                        accion: "seleccionar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divPartes').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            if (datos.totalCount > 0) {
<?php echo $tagXml->getAttribut("idParte", "id"); ?>.value = datos.data[0].idParte
<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>.value = datos.data[0].idExhorto
<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>.value = datos.data[0].idExhortoGenerado
<?php echo $tagXml->getAttribut("nombre", "id"); ?>.value = datos.data[0].nombre
<?php echo $tagXml->getAttribut("paterno", "id"); ?>.value = datos.data[0].paterno
<?php echo $tagXml->getAttribut("materno", "id"); ?>.value = datos.data[0].materno
<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>.value = datos.data[0].nombrePersonaMoral
<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>.value = datos.data[0].cveTipoPersona
<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>.value = datos.data[0].cveTipoParte
<?php echo $tagXml->getAttribut("edad", "id"); ?>.value = datos.data[0].edad
<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>.value = datos.data[0].fechaNacimiento
<?php echo $tagXml->getAttribut("RFC", "id"); ?>.value = datos.data[0].RFC
<?php echo $tagXml->getAttribut("CURP", "id"); ?>.value = datos.data[0].CURP
<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>.value = datos.data[0].cveEstado
<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>.value = datos.data[0].cveMunicipio
<?php echo $tagXml->getAttribut("domicilio", "id"); ?>.value = datos.data[0].domicilio
<?php echo $tagXml->getAttribut("telefono", "id"); ?>.value = datos.data[0].telefono
<?php echo $tagXml->getAttribut("email", "id"); ?>.value = datos.data[0].email
<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>.value = datos.data[0].cveGenero
<?php echo $tagXml->getAttribut("detenido", "id"); ?>.value = datos.data[0].detenido
<?php echo $tagXml->getAttribut("activo", "id"); ?>.value = datos.data[0].activo
<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>.value = datos.data[0].fechaRegistro
<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>.value = datos.data[0].fechaActualizacion
                                document.getElementById('divPartes').innerHTML = "";
                                consultaPartes();
                            } else {
                                alert(datos.text);
                                document.getElementById('divPartes').innerHTML = "";
                            }
                        } catch (e) {
                            alert(datos.text);
                            document.getElementById('divPartes').innerHTML = "";
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaTipospersonas = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/tipospersonas/TipospersonasFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divTipospersonas').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveTipoPersona", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipoPersona", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveTipoPersona + "'>" + datos.data[index].cveTipoPersona + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divTipospersonas').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaTipospartes = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/tipospartes/TipospartesFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divTipospartes').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveTipoParte", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipoParte", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveTipoParte + "'>" + datos.data[index].cveTipoParte + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divTipospartes').innerHTML = html;
                        } catch (e) {
                            alert(e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
            listaGeneros = function (tabIndex) {
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/generos/GenerosFacade.Class.php",
                    data: {accion: "consultar"},
                    async: true,
                    dataType: "json",
                    beforeSend: function (objeto) {
                        document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                    },
                    success: function (datos) {
                        try {
                            var html = "";
                            if (datos.totalCount > 0) {
                                html += '<select name="<?php echo $tagXml->getAttribut("cveGenero", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveGenero", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
                                for (var index = 0; index < datos.totalCount; index++) {
                                    html += "<option value='" + datos.data[index].cveGenero + "'>" + datos.data[index].cveGenero + "</option>";
                                }
                                html += "</select>";
                            } else {
                                html = "Sin resultados";
                            }
                            document.getElementById('divGeneros').innerHTML = html;
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
                    Registro de Partes
                </h5>
            </div>
            <div class="panel-body">
                <div id="divFormulario" class="form-horizontal">
                    <div id="divCampos">
                        <div class="starter-template">
                            <fieldset>
                                <p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idParte", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("idParte", "id"); ?>" class="caption control-label col-xs-3 needed" id="idParte"><?php echo $tagXml->getTag("idParte"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("idParte", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("idParte", "name"); ?>" id="<?php echo $tagXml->getAttribut("idParte", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("idParte", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("idParte", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("idParte", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idExhorto", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>" class="caption control-label col-xs-3 needed" id="idExhorto"><?php echo $tagXml->getTag("idExhorto"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("idExhorto", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("idExhorto", "name"); ?>" id="<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("idExhorto", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("idExhorto", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("idExhorto", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idExhortoGenerado", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>" class="caption control-label col-xs-3 needed" id="idExhortoGenerado"><?php echo $tagXml->getTag("idExhortoGenerado"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("idExhortoGenerado", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("idExhortoGenerado", "name"); ?>" id="<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("idExhortoGenerado", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("idExhortoGenerado", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("idExhortoGenerado", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nombre", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("nombre", "id"); ?>" class="caption control-label col-xs-3 needed" id="nombre"><?php echo $tagXml->getTag("nombre"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("nombre", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("nombre", "name"); ?>" id="<?php echo $tagXml->getAttribut("nombre", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("nombre", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("nombre", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("nombre", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("paterno", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("paterno", "id"); ?>" class="caption control-label col-xs-3 needed" id="paterno"><?php echo $tagXml->getTag("paterno"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("paterno", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("paterno", "name"); ?>" id="<?php echo $tagXml->getAttribut("paterno", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("paterno", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("paterno", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("paterno", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("materno", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("materno", "id"); ?>" class="caption control-label col-xs-3 needed" id="materno"><?php echo $tagXml->getTag("materno"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("materno", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("materno", "name"); ?>" id="<?php echo $tagXml->getAttribut("materno", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("materno", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("materno", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="6">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("materno", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nombrePersonaMoral", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>" class="caption control-label col-xs-3 needed" id="nombrePersonaMoral"><?php echo $tagXml->getTag("nombrePersonaMoral"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("nombrePersonaMoral", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "name"); ?>" id="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="7">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("nombrePersonaMoral", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipoPersona", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveTipoPersona"><?php echo $tagXml->getTag("cveTipoPersona"); ?></label>
                                    <div name="divTipospersonas" id="divTipospersonas" class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("cveTipoPersona", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveTipoPersona", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveTipoPersona", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveTipoPersona", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="8">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("cveTipoPersona", "name"); ?>").keydown(posValue);
                                        listaTipospersonas(8);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipoParte", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveTipoParte"><?php echo $tagXml->getTag("cveTipoParte"); ?></label>
                                    <div name="divTipospartes" id="divTipospartes" class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("cveTipoParte", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveTipoParte", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveTipoParte", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveTipoParte", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="9">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("cveTipoParte", "name"); ?>").keydown(posValue);
                                        listaTipospartes(9);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("edad", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("edad", "id"); ?>" class="caption control-label col-xs-3 needed" id="edad"><?php echo $tagXml->getTag("edad"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("edad", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("edad", "name"); ?>" id="<?php echo $tagXml->getAttribut("edad", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("edad", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("edad", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="10">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("edad", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaNacimiento", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>" class="caption control-label col-xs-3 needed" id="fechaNacimiento"><?php echo $tagXml->getTag("fechaNacimiento"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("fechaNacimiento", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("fechaNacimiento", "name"); ?>" id="<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("fechaNacimiento", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("fechaNacimiento", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="11">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("fechaNacimiento", "name"); ?>").keydown(posValue);
                                        $('#<?php echo $tagXml->getAttribut("fechaNacimiento", "id"); ?>').datetimepicker({
                                            format: 'DD/MM/YYYY'
                                        });
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("RFC", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("RFC", "id"); ?>" class="caption control-label col-xs-3 needed" id="RFC"><?php echo $tagXml->getTag("RFC"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("RFC", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("RFC", "name"); ?>" id="<?php echo $tagXml->getAttribut("RFC", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("RFC", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("RFC", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="12">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("RFC", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("CURP", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("CURP", "id"); ?>" class="caption control-label col-xs-3 needed" id="CURP"><?php echo $tagXml->getTag("CURP"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("CURP", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("CURP", "name"); ?>" id="<?php echo $tagXml->getAttribut("CURP", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("CURP", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("CURP", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="13">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("CURP", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveEstado", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveEstado"><?php echo $tagXml->getTag("cveEstado"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("cveEstado", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveEstado", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveEstado", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveEstado", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveEstado", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="14">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("cveEstado", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveMunicipio", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveMunicipio"><?php echo $tagXml->getTag("cveMunicipio"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("cveMunicipio", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveMunicipio", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveMunicipio", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveMunicipio", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveMunicipio", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="15">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("cveMunicipio", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("domicilio", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("domicilio", "id"); ?>" class="caption control-label col-xs-3 needed" id="domicilio"><?php echo $tagXml->getTag("domicilio"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("domicilio", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("domicilio", "name"); ?>" id="<?php echo $tagXml->getAttribut("domicilio", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("domicilio", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("domicilio", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="16">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("domicilio", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("telefono", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("telefono", "id"); ?>" class="caption control-label col-xs-3 needed" id="telefono"><?php echo $tagXml->getTag("telefono"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("telefono", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("telefono", "name"); ?>" id="<?php echo $tagXml->getAttribut("telefono", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("telefono", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("telefono", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="17">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("telefono", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("email", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("email", "id"); ?>" class="caption control-label col-xs-3 needed" id="email"><?php echo $tagXml->getTag("email"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("email", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("email", "name"); ?>" id="<?php echo $tagXml->getAttribut("email", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("email", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("email", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="18">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("email", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveGenero", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>" class="caption control-label col-xs-3 needed" id="cveGenero"><?php echo $tagXml->getTag("cveGenero"); ?></label>
                                    <div name="divGeneros" id="divGeneros" class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("cveGenero", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("cveGenero", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("cveGenero", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("cveGenero", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="19">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("cveGenero", "name"); ?>").keydown(posValue);
                                        listaGeneros(19);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("detenido", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("detenido", "id"); ?>" class="caption control-label col-xs-3 needed" id="detenido"><?php echo $tagXml->getTag("detenido"); ?></label>
                                    <div class="col-xs-6">
                                        <select name="<?php echo $tagXml->getAttribut("detenido", "name"); ?>" id="<?php echo $tagXml->getAttribut("detenido", "id"); ?>" class="form-control text-uppercase" tabIndex="20" title="<?php echo $tagXml->getAttribut("detenido", "tooltip"); ?>" data-toggle="tooltip" >
                                            <option value="S">SI</option>
                                            <option value="N">NO</option>
                                        </select>
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("detenido", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption control-label col-xs-3 needed" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
                                    <div class="col-xs-6">
                                        <select name="<?php echo $tagXml->getAttribut("activo", "name"); ?>" id="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="form-control text-uppercase" tabIndex="21" title="<?php echo $tagXml->getAttribut("activo", "tooltip"); ?>" data-toggle="tooltip" >
                                            <option value="S">SI</option>
                                            <option value="N">NO</option>
                                        </select>
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("activo", "name"); ?>").keydown(posValue);
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaRegistro", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" class="caption control-label col-xs-3 needed" id="fechaRegistro"><?php echo $tagXml->getTag("fechaRegistro"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("fechaRegistro", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("fechaRegistro", "name"); ?>" id="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("fechaRegistro", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("fechaRegistro", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="22">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("fechaRegistro", "name"); ?>").keydown(posValue);
                                        $('#<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>').datetimepicker();
                                    </script>
                                </div>
                                <div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden") == "true") ? "style=\"display:none;\"" : ""; ?> >
                                    <label for="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" class="caption control-label col-xs-3 needed" id="fechaActualizacion"><?php echo $tagXml->getTag("fechaActualizacion"); ?></label>
                                    <div class="col-xs-6">
                                        <input type="<?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden") == "true") ? "hidden" : "text" ?>" name="<?php echo $tagXml->getAttribut("fechaActualizacion", "name"); ?>" id="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" placeholder="<?php echo $tagXml->getAttribut("fechaActualizacion", "placeholder"); ?>" title="<?php echo $tagXml->getAttribut("fechaActualizacion", "tooltip"); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="23">
                                    </div>
                                    <script>
                                        $("#<?php echo $tagXml->getAttribut("fechaActualizacion", "name"); ?>").keydown(posValue);
                                        $('#<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>').datetimepicker();
                                    </script>
                                </div>
                                </p>
                                <p style="text-align: center;">
                                    <button type="button" class="btn btn-success" value="Guardar" id="btnPartesGuardar" name="btnPartesGuardar" onclick="guardarPartes()" tabIndex="25" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                                    <button type="button"  class="btn btn-default" value="Limpiar" id="btnPartesLimpiar" name="btnPartesLimpiar" onclick="limpiaPartes()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
                                    <button type="button"  class="btn btn-info" value="Consultar" id="btnPartesConsultar" name="btnPartesConsultar" onclick="consultaPartes()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                                    <button type="button"  class="btn btn-danger" value="Eliminar" id="btnPartesEliminar" name="btnPartesEliminar" onclick="bajaPartes()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                                    <script>
<?php
if (($permisos["data"][0]->registrar == 'N') && ($permisos["data"][0]->modificar == 'N'))
    echo "$(\"#btnPartesGuardar\").css(\"display\",\"none\");\n";
?>
<?php
if ($permisos["data"][0]->eliminar == 'N')
    echo "$(\"#btnPartesEliminar\").css(\"display\",\"none\");\n";
?>
<?php
if ($permisos["data"][0]->consulta == 'N')
    echo "$(\"#btnPartesConsultar\").css(\"display\",\"none\");\n";
?>
                                    </script>
                                </p>
                                <div id="divPartes" name="divPartes" class="table-responsive" width="100%"></div>
                                <script>
<?php
if ($permisos["data"][0]->consulta == 'S')
    echo "consultaPartes();\n";
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
