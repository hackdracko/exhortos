<?php
date_default_timezone_set('America/Mexico_City');
$fecha = date("d/m/Y");
?>
<!doctype html>
<style type="text/css">
    .mayuscula{  
        text-transform: uppercase;  
    } 
    .requerido {
        color: darkred;
    }
    .required{
        color: red;
    }
</style>
<div class="container panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Registro de formularios
        </h5>
    </div>
    <input type="hidden" id="hddCveFormulario">
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <div class="starter-template">
                <p class="col-lg-12" style="color:darkred;">
                    Los campos marcados con (*) son obligatorios.
                </p>

                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="sistemas">Sistema<span class="requerido">(*)</span></label>
                    <div class="col-md-5">
                        <select id="cmbSistemas" class="form-control" name="cmbSistemas" onchange="formularios();" tabIndex="2">
                            <option value="">Seleccione una opci&oacute;n</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="Formularios">Padre</label>
                    <div class="col-md-5">
                        <select id="cmbFormularios" class="form-control" name="cmbFormularios">
                            <option value="">Seleccione una opci&oacute;n</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="nomFormularios">Nombre del formulario<span class="requerido">(*)</span></label>
                    <div class="col-md-5">
                        <input type="text" class="form-control mayuscula" id="txtNombreformualrio" placeholder="Nombre del formulario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="nomFormularios">Descripci&oacute;n del formulario<span class="requerido">(*)</span></label>
                    <div class="col-md-5">
                        <input type="text" class="form-control mayuscula" id="txtDescformualrio" placeholder="Descripci&oacute;n del formulario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="nomFormularios">Ruta<span class="requerido">(*)</span></label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="txtUrl" placeholder="ruta">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="caption control-label col-md-4 needed" id="nomFormularios">Activo<span class="requerido">(*)</span></label>
                    <div class="col-md-5">
                        <select id="cmbActivo" class="form-control" name="cmbActivo">
                            <option value="">Seleccione una opci&oacute;n</option>
                            <option value="S">SI</option>
                            <option value="N">NO</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3" id=""></div>
                <div class="col-lg-3">
                    <label class="control-label" for="cmbVista">Vista <span class="requerido">(*)</span></label>
                    <select id="cmbVista" class="form-control" name="cmbVista">
                        <option value="">Seleccione una opci&oacute;n</option>
                        <option value="S">SI</option>
                        <option value="N">NO</option>
                    </select>
                </div>
                <div class="col-lg-3" id="divMaternoImputado">
                    <label class="control-label" for="cmbNivel">Nivel <span class="requerido">(*)</span></label>
                    <select id="cmbNivel" class="form-control" name="cmbNivel">
                        <option value="">---</option>
                        <?php
                        for ($i = 0; $i <= 15; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-3" id="divMaternoImputado">
                    <label class="control-label" for="cmbOrden">Orden <span class="requerido">(*)</span></label>
                    <select id="cmbOrden" class="form-control" name="cmbOrden">
                        <option value="">---</option>
                        <?php
                        for ($i = 0; $i <= 99; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div><br></div>
                <div class="col-lg-12" id=""><br></div>
                <div class="col-lg-3" id=""></div>
                <div class="form-group">
                    <div class="caption control-label col-md-4 needed">
                        <input type="submit" class="btn btn-primary" value="Guardar" onclick="save();">                                    
                        <input type="submit" class="btn btn-primary" value="Consultar" onclick="consulta();">                                                                     
                        <!--<input type="submit" class="btn btn-primary" id="btnEliminar" style="display:none;" value="Eliminar" onclick="elimina();">-->                                                                     
                        <input type="submit" class="btn btn-primary" value="Limpiar" onclick="clean();">                                    
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" >
            <div id="divAlertWarningForm" class="alert alert-warning alert-dismissable" style="display:none;">                    
                <strong>Advertencia!</strong> Mensaje
            </div>
            <div id="divAlertSuccesForm" class="alert alert-success alert-dismissable" style="display:none;">

                <strong>Correcto!</strong> Mensaje
            </div>
            <div id="divAlertDagerForm" class="alert alert-danger alert-dismissable" style="display:none;">

                <strong>Error!</strong> Mensaje
            </div>
            <div id="divAlertInfoForm" class="alert alert-info alert-dismissable" style="display:none;">

                <strong>Informaci&oacute;n!</strong> Mensaje
            </div>
        </div>  
        <div id="divConsultaGrid" style="display: none" class="col-xs-12">
            <div class="col-xs-6"></div>
            <div class="col-xs-6">
                <div class="form-group col-xs-3">
                    <label class="control-label" id="totalReg"></label>
                </div>

                <div id="divPaginador" class="form-group col-xs-3" >
                    <label class="control-label">Pagina:</label>
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consulta(0);">
                        <option value="1"></option>
                    </select>
                </div>
                <div id="divPaginador" class="form-group col-xs-4" >
                    <label class="control-label">Registros por p&aacute;gina:</label>
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consulta(1);">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div id="divResultados" class="col-xs-12"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    sistemas = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbSistemas').empty();
                    $('#cmbSistemas').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbSistemas').append('<option value="' + object.cveSistema + '">' + object.nomSistema + '</option>');
                        });
                        $("#cmbSistemas").val(1).trigger('change');
                    }
                } catch (e) {
                    alert("Error al cargar el tipo de sistema:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de tipo de sistema:\n\n" + otroobj);
            }
        });
    };
    formularios = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", cveSistema: $('#cmbSistemas').val(), obligaPermiso: "false"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbFormularios').empty();
                    $('#cmbFormularios').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbFormularios').append('<option value="' + object.cveFormulario + '">' + object.nivel + " - " + object.nomFormulario + '</option>');
                        });
                    }
                } catch (e) {
                    alert("Error al cargar el tipo de formulario:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de tipo de formulario:\n\n" + otroobj);
            }
        });
    };

    validate = function () {
        var mensaje = "";
        var error = false;
        if ($('#cmbSistemas').val() == "" || $('#cmbSistemas').val() == "0") {
            $('#cmbSistemas').focus();
            $('#cmbSistemas').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe Seleccionar un sistema</label>");
//            mensaje += "*Seleccione un sistema \n";
            error = true;
        }
        if ($('#txtNombreformualrio').val() == "" || $('#txtNombreformualrio').val() == "0") {
            $('#txtNombreformualrio').focus();
            $('#txtNombreformualrio').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese el nombre del formulario</label>");
//            mensaje += "*Ingrese el nombre del formulario. </br>";
            error = true;
        }
        if ($('#txtDescformualrio').val() == "" || $('#txtDescformualrio').val() == "0") {
            $('#txtDescformualrio').focus();
            $('#txtDescformualrio').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese una descripcion del formulario</label>");
//            mensaje += "*Ingrese una descripcion del formulario. </br>";
            error = true;
        }
        if ($('#txtUrl').val() == "" || $('#txtUrl').val() == "0") {
            $('#txtUrl').focus();
            $('#txtUrl').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese una ruta del formulario</label>");
//            mensaje += "*Ingrese una ruta del formulario. </br>";
            error = true;
        }
        if ($('#cmbVista').val() == "" || $('#cmbVista').val() == "0") {
            $('#cmbVista').focus();
            $('#cmbVista').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione vista</label>");
//            mensaje += "*Seleccione vista. </br>";
            error = true;
        }
        if ($('#cmbNivel').val() == "") {
            $('#cmbNivel').focus();
            $('#cmbNivel').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione nivel</label>");
//            mensaje += "*Seleccione nivel.  </br>";
            error = true;
        }
        if ($('#cmbOrden').val() == "" || $('#cmbOrden').val() == "0") {
            $('#cmbOrden').focus();
            $('#cmbOrden').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione el orden del formulario</label>");
//            mensaje += "*Seleccione el orden del formulario.  </br>";
            error = true;
        }

        return error;
    };

    save = function () {
        $(".required").remove();
        var error = false;
        if (!validate()) {

            if ($('#cmbFormularios').val() != "") {
                var padre = $('#cmbFormularios').val();
            } else {
                var padre = 0;
            }

            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "guardar",
                    cveFormulario: $('#hddCveFormulario').val(),
                    cveSistema: $('#cmbSistemas').val(),
                    padre: padre,
                    nomFormulario: $('#txtNombreformualrio').val(),
                    desFormulario: $('#txtDescformualrio').val(),
                    ruta: $('#txtUrl').val(),
                    vista: $('#cmbVista').val(),
                    nivel: $('#cmbNivel').val(),
                    orden: $('#cmbOrden').val(),
                    activo: $('#cmbActivo').val()
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    if (datos.totalCount > 0) {
                        $("#divAlertSuccesForm").html("");
                        $("#divAlertSuccesForm").html("Se registro de forma correcta");
                        $("#divAlertSuccesForm").show("");
                        setTimeAlert("divAlertSuccesForm");
                        $("#hddCveFormulario").val(datos.data[0].cveFormulario);
                        $("#cmbSistemas").val(datos.data[0].cveSistema);
                        $("#cmbFormularios").val(datos.data[0].padre);
                        $("#txtNombreformualrio").val(datos.data[0].nomFormulario);
                        $("#txtDescformualrio").val(datos.data[0].desFormulario);
                        $("#txtUrl").val(datos.data[0].ruta);
                        $("#cmbVista").val(datos.data[0].vista);
                        $("#cmbNivel").val(datos.data[0].nivel);
                        $("#cmbOrden").val(datos.data[0].orden);
                        $("#cmbActivo").val(datos.data[0].activo);

                    } else {
                        $("#divAlertDagerForm").html("");
                        $("#divAlertDagerForm").html("");
                        $("#divAlertDagerForm").show("");
                        setTimeAlert("divAlertDagerForm");
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
                }
            });
        } else {
            error = false;
        }
        return error;
    };

    getPaginas = function (pag, cantReg) {
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "getPaginas",
                cveSistema: $('#cmbSistemas').val(),
                padre: $('#cmbFormularios').val(),
                nomFormulario: $('#txtNombreformualrio').val(),
                desFormulario: $('#txtDescformualrio').val(),
                ruta: $('#txtUrl').val().toUpperCase(),
                vista: $('#cmbVista').val(),
                nivel: $('#txtNumeroImputados').val(),
                orden: $('#cmbOrden').val(),
                activo: $('#cmbActivo').val(),
                cantxPag: cantReg
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                var json = datos;
                if (json.totalCount > 0) {
                    $('#cmbPaginacion').find('option').remove().end();
                    for (var i = 0; i < (parseInt(json.total)); i++) {
                        $("#cmbPaginacion").append($('<option></option>').val(json.data[i].pagina).html(json.data[i].pagina));
                    }
                    $("#totalReg").html("<b> Total: " + json.totalCount + "</b>");
                    $("#cmbPaginacion").val(pag);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };

    consulta = function (pagAux) {
        $(".required").remove();
        if ($('#cmbSistemas').val() != "") {

            var pag = 0;
            if (pagAux == 0) {
                pag = $("#cmbPaginacion").val();
            } else {
                pag = 1;
            }
            var cantReg = $("#cmbNumReg").val();
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "selectFormulariosGeneral",
                    cveSistema: $('#cmbSistemas').val(),
                    padre: $('#cmbFormularios').val(),
                    nomFormulario: $('#txtNombreformualrio').val(),
                    desFormulario: $('#txtDescformualrio').val(),
                    ruta: $('#txtUrl').val().toUpperCase(),
                    vista: $('#cmbVista').val(),
                    nivel: $('#cmbNivel').val(),
                    orden: $('#cmbOrden').val(),
                    activo: $('#cmbActivo').val(),
                    pag: pag,
                    cantxPag: cantReg
                },
                beforeSend: function (datos) {

                },
                success: function (datos) {
                    if (datos.totalCount > 0) {
                        var table = "";
                        table += '<table id="tblResultados" class="table table-hover table-striped table-bordered">';
                        table += '<thead>';
                        table += '<tr>';
                        table += '<th>No</th>';
                        table += '<th>Formulario</th>';
                        table += '<th>Ruta</th>';
                        table += '<th>Activo</th>';
                        table += '</tr>';
                        table += '</thead>';
                        table += "<tbody>";
                        for (var i = 0; i < datos.totalCount; i++) {
                            table += "<tr>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveFormulario + ")' >" + (i + 1) + "</td>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveFormulario + ")' >" + datos.data[i].nomFormulario + "</td>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveFormulario + ")' >" + datos.data[i].ruta + "</td>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveFormulario + ")' >" + datos.data[i].activo + "</td>";
                            table += "</tr>";
                        }
                        table += "</tbody>";
                        table += "</table>";
                        $('#divResultados').html(table);
                        $("#tblResultados").DataTable({
                            paging: false
                        });
                        $('#divResultados').show("");
                        $('#divConsultaGrid').show("");
                        getPaginas(datos.pagina, cantReg);
                    } else {
                        $("#divResultados").html("");
                        $("#divConsultaGrid").hide("");
                        $("#divAlertWarningForm").html("");
                        $("#divAlertWarningForm").html("No se encontraron resultados");
                        $("#divAlertWarningForm").show("");
                        setTimeAlert("divAlertWarningForm");
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
                }
            });

        } else {
            $("#divConsultaGrid").hide("");
            $("#divResultados").html("");
            $("#divConsultaGrid").hide("");
            $("#divAlertWarningForm").html("");
            $("#divAlertWarningForm").html("Seleccione un sistema");
            $("#divAlertWarningForm").show("");
            setTimeAlert("divAlertWarningForm");
        }
    };
    consutaId = function (id) {
        $(".required").remove();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar",
                cveFormulario: id
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                if (datos.totalCount > 0) {

                    $("#divConsultaGrid").hide("");
                    $("#divResultados").hide("");
                    $("#hddCveFormulario").val(datos.data[0].cveFormulario);
                    $("#cmbSistemas").val(datos.data[0].cveSistema);
                    formularios();
                    $("#cmbFormularios").val(datos.data[0].padre);
                    $("#txtNombreformualrio").val(datos.data[0].nomFormulario);
                    $("#txtDescformualrio").val(datos.data[0].desFormulario);
                    $("#txtUrl").val(datos.data[0].ruta);
                    $("#cmbVista").val(datos.data[0].vista);
                    $("#cmbNivel").val(datos.data[0].nivel);
                    $("#cmbOrden").val(datos.data[0].orden);
                    $("#cmbActivo").val(datos.data[0].activo);
//                    $("#btnEliminar").show("");

                } else {
                    $("#divResultados").html("");
                    $("#divConsultaGrid").hide("");
                    $("#divAlertWarningForm").html("");
                    $("#divAlertWarningForm").html("No se encontraron resultados");
                    $("#divAlertWarningForm").show("");
                    setTimeAlert("divAlertWarningForm");
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };

//    elimina = function () {
//        $(".required").remove();
//        if ($("#hddCveFormulario").val() != "") {
//            bootbox.dialog({
//                message: "\u00bf Desea eliminar el registro?",
//                buttons: {
//                    danger: {
//                        label: "Aceptar",
//                        className: "btn-primary",
//                        callback: function () {
//                            $.ajax({
//                                type: "POST",
//                                url: "../fachadas/exhortos/formularios/FormulariosFacade.Class.php",
//                                data: {
//                                    cveFormulario: $("#hddCveFormulario").val(),
//                                    accion: "eliminar"
//                                },
//                                async: true,
//                                dataType: "json",
//                                beforeSend: function (objeto) {
//                                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
//                                },
//                                success: function (datos) {
//                                    if (datos.totalCount > 0) {
//                                        $("#divAlertSuccesForm").html("");
//                                        $("#divAlertSuccesForm").html("El registro de elimino de forma correcta");
//                                        $("#divAlertSuccesForm").show("");
//                                        setTimeAlert("divAlertSuccesForm");
//                                        clean();
//                                    } else {
//                                        $("#divAlertWarningForm").html("");
//                                        $("#divAlertWarningForm").html("Error al eliminar. Verifique.");
//                                        $("#divAlertWarningForm").show("");
//                                        setTimeAlert("divAlertWarningForm");
//                                    }
//                                },
//                                error: function (objeto, quepaso, otroobj) {
//                                }
//                            });
//                        }
//                    },
//                    success: {
//                        label: "Cancelar",
//                        className: "btn-primary",
//                        callback: function () {
//
//                        }
//                    }
//                }
//            });
//        }
//    };

    clean = function () {
        $(".required").remove();
        $("#hddCveFormulario").val("");
        $("#cmbSistemas").val("");
        $("#cmbFormularios").val("");
        $("#txtNombreformualrio").val("");
        $("#txtDescformualrio").val("");
        $("#txtUrl").val("");
        $("#cmbVista").val("");
        $("#cmbNivel").val("");
        $("#cmbOrden").val("");
        $("#cmbActivo").val("");
        $("#divResultados").hide("");
        $("#divResultados").html("");
//        $("#btnEliminar").hide("");
        $("#divConsultaGrid").hide("");
        $("#cmbSistemas").val(1).trigger('change');
    };
    $(function () {
        sistemas();
    });

</script>