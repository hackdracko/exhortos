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
            Registro de sistemas
        </h5>
    </div>
    <input type="hidden" id="hddCveSistema">
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <p class="col-lg-12" style="color:darkred;">
                Los campos marcados con (*) son obligatorios.
            </p>

            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="juzgados">Descripci&oacute;n<span class="requerido">(*)</span></label>
                <div class="col-md-5">
                    <input type="text" class="form-control mayuscula" id="txtSistemas" placeholder="Descripci&oacute;n">
                </div>
            </div>
            <div class="col-lg-12" id=""><br></div>
            <div class="col-lg-3" id=""></div>
            <div class="form-group">
                <div >
                    <input type="submit" class="btn btn-primary" value="Guardar" onclick="save();">                                    
                    <input type="submit" class="btn btn-primary" value="Consultar" onclick="consulta();">                                                                     
                    <input type="submit" id="btnEliminar" class="btn btn-primary" value="Eliminar" onclick="eliminar();" style="display:none">                                                                     
                    <input type="submit" class="btn btn-primary" value="Limpiar" onclick="clean();">                                    
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
    validate = function () {
        var mensaje = "";
        var error = false;
        if ($('#txtSistemas').val() == "" || $('#txtSistemas').val() == "0") {
            $('#txtSistemas').focus();
            $('#txtSistemas').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese la descripci&oacute;n del sistema</label>");
            error = true;
        }
        return error;
    };

    save = function () {
        $(".required").remove();
        var error = false;
        if (!validate()) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "guardar",
                    cveSistema: $('#hddCveSistema').val(),
                    nomSistema: $('#txtSistemas').val(),
                    activo: 'S'
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    if (datos.totalCount > 0) {
                        $("#divAlertSuccesForm").html("");
                        $("#divAlertSuccesForm").html("Se registro de forma correcta");
                        $("#divAlertSuccesForm").show("");
                        setTimeAlert("divAlertSuccesForm");

                        $("#hddCveSistema").val(datos.data[0].cveSistema);
                        $("#txtSistemas").val(datos.data[0].nomSistema);
                        $("#btnEliminar").show();
                    } else {
                        $("#divAlertWarningForm").html("");
                        $("#divAlertWarningForm").html(datos.text);
                        $("#divAlertWarningForm").show("");
                        setTimeAlert("divAlertWarningForm");
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
            url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "getPaginas",
                cveSistema: $('#hddCveSistema').val(),
                nomSistema: $('#txtSistemas').val(),
                activo: 'S',
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
                url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultaGeneral",
                    nomSistema: $('#txtSistemas').val(),
                    activo: 'S',
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
                        table += '<th>No&uacute;m.</th>';
                        table += '<th>Descripci&oacute;n</th>';
                        table += '</tr>';
                        table += '</thead>';
                        table += "<tbody>";
                        for (var i = 0; i < datos.totalCount; i++) {
                            table += "<tr>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveSistema + ")' >" + (i + 1) + "</td>";
                            table += "<td onclick='consutaId(" + datos.data[i].cveSistema + ")' >" + datos.data[i].nomSistema + "</td>";
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
            url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar",
                cveSistema: id,
                activo: 'S'
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                if (datos.totalCount > 0) {

                    $("#hddCveSistema").val(datos.data[0].cveSistema);
                    $("#txtSistemas").val(datos.data[0].nomSistema);
                    $("#divResultados").html("");
                    $("#divConsultaGrid").hide("");
                    $("#btnEliminar").show("");
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
    eliminar = function () {
        $(".required").remove();
        if ($("#hddIdContador").val() != "") {
            bootbox.dialog({
                message: "\u00bf Desea eliminar el registro?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
                                data: {
                                    cveSistema: $("#hddCveSistema").val(),
                                    accion: "eliminar"
                                },
                                async: true,
                                dataType: "json",
                                beforeSend: function (objeto) {
                                },
                                success: function (datos) {
                                    if (datos.totalCount > 0) {
                                        $("#divAlertSuccesForm").html("");
                                        $("#divAlertSuccesForm").html("El registro de elimino de forma correcta");
                                        $("#divAlertSuccesForm").show("");
                                        setTimeAlert("divAlertSuccesForm");
                                        clean();
                                    } else {
                                        $("#divAlertWarningForm").html("");
                                        $("#divAlertWarningForm").html("Error al eliminar. Verifique.");
                                        $("#divAlertWarningForm").show("");
                                        setTimeAlert("divAlertWarningForm");
                                    }
                                },
                                error: function (objeto, quepaso, otroobj) {
                                }
                            });
                        }
                    },
                    success: {
                        label: "Cancelar",
                        className: "btn-primary",
                        callback: function () {

                        }
                    }
                }
            });
        }
    }

    clean = function () {
        $("#hddCveSistema").val("");
        $("#txtSistemas").val("");
        $("#divConsultaGrid").hide("");
        $("#divResultados").html("");
        $("#btnEliminar").hide("");
        $(".required").remove();
    };
    $(function () {

    });

</script>