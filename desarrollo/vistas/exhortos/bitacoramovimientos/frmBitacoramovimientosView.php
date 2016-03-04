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
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Bit&aacute;cora movimientos
        </h5>
    </div>
    <input type="hidden" id="hddIdContador">
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <p class="col-lg-12" style="color:darkred;">
                Los campos marcados con (*) son obligatorios.
            </p>

            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Adscripci&oacute;n</label>
                <div class="col-md-5">
                    <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Acci&oacute;n</label>
                <div class="col-md-5">
                    <select id="cmbAcciones" class="form-control" name="cmbAcciones">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Fecha inicio</label>
                <div class="col-xs-3">
                    <input type="text" id="txtFechaInicio" value="<?php echo $fecha ?>" placeholder="Fecha Inicio">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Fecha fin</label>
                <div class="col-xs-3">
                    <input type="text" id="txtFechaFin" value="<?php echo $fecha ?>" placeholder="Fecha Fin">
                </div>
            </div>
            <div class="col-lg-12" id=""><br></div>
            <div class="col-lg-3" id=""></div>
            <div class="form-group">
                <div >                             
                    <input type="submit" class="btn btn-primary" value="Consultar" onclick="consulta();">                                                                                                          
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
    adscripciones = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", activo: 'S'},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbAdscripciones').empty();
                    $('#cmbAdscripciones').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbAdscripciones').append('<option value="' + object.cveAdscripcion + '">' + object.desAdscripcion + '</option>');
                        });
                    }
                } catch (e) {
                    alert("Error al cargar el juzgado:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de juzgados:\n\n" + otroobj);
            }
        });
    };
    acciones = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/acciones/AccionesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", activo: 'S'},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbAcciones').empty();
                    $('#cmbAcciones').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbAcciones').append('<option value="' + object.cveAccion + '">' + object.desAccion + '</option>');
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
        if (($('#cmbAdscripciones').val() == "" || $('#cmbAdscripciones').val() == "0") && ($('#cmbAcciones').val() == "" || $('#cmbAcciones').val() == "0")) {
            $('#cmbAcciones').focus();
            $('#cmbAcciones').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese un criterio de b&uacute;squeda</label>");
            error = true;
        }
        return error;
    };
    getPaginas = function (pag, cantReg) {
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/bitacoramovimientos/BitacoramovimientosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "getPaginas",
                cveAdscripcion: $('#cmbAdscripciones').val(),
                cveAccion: $('#cmbAcciones').val(),
                fechaInicio: $('#txtFechaInicio').val(),
                fechaFin: $('#txtFechaFin').val(),
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
        var error = false;
        if (!validate()) {
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
                    url: "../fachadas/exhortos/bitacoramovimientos/BitacoramovimientosFacade.Class.php",
                    async: true,
                    dataType: "json",
                    data: {accion: "consultar",
                        cveAdscripcion: $('#cmbAdscripciones').val(),
                        cveAccion: $('#cmbAcciones').val(),
                        fechaInicio: $('#txtFechaInicio').val(),
                        fechaFin: $('#txtFechaFin').val(),
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
                            table += '<th>No</th>';
                            table += '<th>Usuario</th>';
                            table += '<th>Acci\u00F3n</th>';
                            table += '<th>Adscripci\u00F3n</th>';
                            table += '<th>Fecha</th>';
                            table += '<th>Movimiento</th>';
                            table += '</tr>';
                            table += '</thead>';
                            table += "<tbody>";
                            for (var i = 0; i < datos.totalCount; i++) {
                                table += "<tr>";
//                                table += "<td onclick='consutaId(" + datos.data[i].idBitacoraMovimiento + ")' >" + (i + 1) + "</td>";
                                table += "<td>" + (i + 1) + "</td>";
                                table += "<td>" + datos.data[i].usuario + "</td>";
                                table += "<td>" + datos.data[i].desAccion + "</td>";
                                table += "<td>" + datos.data[i].desAdscripciones + "</td>";
                                table += "<td>" + datos.data[i].fechaMovimiento + "</td>";
                                table += "<td>" + datos.data[i].observaciones + "</td>";
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
        } else {
            error = false;
        }
        return error;
    };

    clean = function () {
        $("#cmbAdscripciones").val("");
        $("#cmbAcciones").val("");
        $("#divConsultaGrid").hide("");
        $("#divResultados").hide("");
        $("#divResultados").html("");
        $(".required").remove();
        $("#txtFechaInicio").val("");
        $("#txtFechaFin").val("");
    };
    $(function () {
        var currentDate = new Date();
        var maxDate = currentDate.setDate(currentDate.getDate());
        $("#txtFechaInicio").datetimepicker({
            sideBySide: false,
            locale: 'es',
            format: "DD/MM/YYYY",
            maxDate: maxDate
        });
        $("#txtFechaFin").datetimepicker({
            sideBySide: false,
            locale: 'es',
            format: "DD/MM/YYYY",
            maxDate: maxDate
        });
        adscripciones();
        acciones();
    });

</script>