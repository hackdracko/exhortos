<style type="text/css">
    .mayuscula{  
        text-transform: uppercase;  
    } 
    .requerido {
        color: darkred;
    }
    #accordion .panel-heading{
        background-color: #e9e7e7;
        color: #666666;
    }
    .required{
        color: red;
    }
    .trOpciones{
        cursor: pointer;
    }
    .trOpciones:hover{
        background-color: #e9e7e7;
    }

</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Permisos grupos
        </h5>
    </div>
    <div class="panel-body">
        <div id="divInfo" class="form-horizontal">
<!--            <input type="text" id="hddCveSistema">
            <input type="text" id="hddCveGrupo">-->

            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Sistema</label>
                <div class="col-md-5">
                    <select id="cmbSistema" class="form-control" name="cmbSistema" onchange="comboGrupos();">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Grupo</label>
                <div class="col-md-5">
                    <select id="cmbGrupo" class="form-control" name="cmbGrupo" onchange="consultaOpcionMenu();">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
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
            <div id="divResultadosOpciones"></div>
            <div class="form-group">
                <div class="caption control-label col-md-6 needed">                                 
                    <!--<input type="submit" class="btn btn-primary" value="Consultar" onclick="guardar();">-->                                                                                                          
                    <!--<input type="submit" class="btn btn-primary" value="Consultar" onclick="consultar();">-->                                                                                                          
                    <input type="submit" class="btn btn-primary" value="Limpiar" onclick="limpiar();">                                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    comboSistemas = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/sistemas/SistemasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", activo: 'S'},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbSistema').empty();
                    $('#cmbSistema').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbSistema').append('<option value="' + object.cveSistema + '">' + object.nomSistema + '</option>');
                        });
                        $("#cmbSistema").val(1).trigger('change');
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

    comboGrupos = function () {
        $('#divResultadosOpciones').html('');
        $('#divResultadosOpciones').hide('');
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/grupos/GruposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarGenerla", activo: 'S', cveSistema: $('#cmbSistema').val()},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbGrupo').empty();
                    $('#cmbGrupo').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbGrupo').append('<option value="' + object.CveGrupo + '">' + object.NomGrupo + '</option>');
                        });
                    }
                } catch (e) {
                    alert("Error al cargar las adscripciones:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de adscripciones:\n\n" + otroobj);
            }
        });
    };


    consultaOpcionMenu = function () {
        if ($('#cmbSistema').val() != "" && $('#cmbGrupo').val() != "") {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/permisosgrupos/PermisosgruposFacade.Class.php",
                async: true,
                dataType: "json",
                data: {accion: "consultarOpciones",
                    cveSistema: $('#cmbSistema').val(),
                    activo: 'S'
                },
                beforeSend: function (datos) {
                },
                success: function (datos) {
                    if (datos.status == 'ok') {
                        var table = "";
                        table += '<table id="tblResultadosOpciones" border="0" width="50%" align="center">';
//                        table += '<tr>';
//                        table += '<td>Nombre del formuario</td>';
//                        table += '<td>V  C  R  U  D</td>';
//                        table += '</tr>';
                        table = opcionesDesc(datos, table, false, 0);
                        table += "</table>";
                        $('#divResultadosOpciones').html(table);
                        $('#divResultadosOpciones').show('');
                        cargaPermisos($('#cmbGrupo').val());
                    } else {
                        $('#divResultadosOpciones').html('');
                        $('#divResultadosOpciones').hide('');
                        $("#divAlertWarningForm").html("");
                        $("#divAlertWarningForm").html('Este sistema no cuenta con opciones.');
                        $("#divAlertWarningForm").show("");
                        setTimeAlert("divAlertWarningForm");
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
                }
            });
        } else {
            $('#divResultadosOpciones').html('');
            $('#divResultadosOpciones').hide('');
            $("#divAlertWarningForm").html("");

            if ($('#cmbSistema').val() == "") {
                $("#divAlertWarningForm").html('Debe de seleccionar un sistema.');
            } else if ($('#cmbGrupo').val() == "") {
                $("#divAlertWarningForm").html('Debe de seleccionar un grupo.');
            }
            $("#divAlertWarningForm").show("");
            setTimeAlert("divAlertWarningForm");

        }
    };
    opcionesDesc = function (datos, table, hijo, nivel) {
        try {
            if (hijo == false) {
                for (var i = 0; i < datos.opciones.length; i++) {
                    if (datos.opciones.length > 0) {
                        table += '<tr class="trOpciones"  bgcolor="#CEF6E3">';
                        table += '<td width="80%">' + datos.opciones[i].nomFormulario + '</td>';
                        table += '<td width="20%" ><input type="checkbox" title="Vista" id="ckbF' + datos.opciones[i].cveFormulario + '" name="formulario" onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Guardar"  id="ckbI' + datos.opciones[i].cveFormulario + '" name="registrar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Consultar"  id="ckbS' + datos.opciones[i].cveFormulario + '" name="consultar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Modificar"  id="ckbU' + datos.opciones[i].cveFormulario + '" name="modificar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Eliminar"  id="ckbD' + datos.opciones[i].cveFormulario + '" name="eliminar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);"></td>';
                        table += '</tr>';
                        table = opcionesDesc(datos.opciones[i], table, true, datos.opciones[i].nivel);
                    }
                }
            } else {
                for (var x = 0; x < datos.hijos.length; x++) {
                    if (datos.hijos.length > 0) {
                        table += '<tr  class="trOpciones">';
                        table += '<td width="80%">'
                        for (var nivel = 0; nivel < datos.hijos[x].nivel; nivel++) {
                            table += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        table += datos.hijos[x].nomFormulario + '</td>';
                        table += '<td width="20%" ><input type="checkbox" title="vista"  id="ckbF' + datos.hijos[x].cveFormulario + '" name="formulario" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Guardar"  id="ckbI' + datos.hijos[x].cveFormulario + '" name="registrar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Consultar"  id="ckbS' + datos.hijos[x].cveFormulario + '" name="consultar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Modificar"  id="ckbU' + datos.hijos[x].cveFormulario + '" name="modificar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Eliminar"  id="ckbD' + datos.hijos[x].cveFormulario + '" name="eliminar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);"></td>';
                        table += '</tr>';
                        table = opcionesDesc(datos.hijos[x], table, true, datos.hijos[x].nivel);
                    }
                }
            }
        } catch (e) {
//            alert(e);
        }
        return table;
    };

    cargaPermisos = function (cveGrupo) {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/permisosgrupos/PermisosgruposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar",
                cveGrupo: cveGrupo
            },
            beforeSend: function (datos) {
            },
            success: function (datos) {
                if (datos.totalCount > 0) {
                    for (var i = 0; i < datos.totalCount; i++) {
                        $("#ckbF" + datos.data[i].cveFormulario + "").prop("checked", true);
                        if (datos.data[i].consulta == 'S') {
                            $("#ckbS" + datos.data[i].cveFormulario + "").prop("checked", true);
                        } else {
                            $("#ckbS" + datos.data[i].cveFormulario + "").prop("checked", false);
                        }
                        if (datos.data[i].modificar == 'S') {
                            $("#ckbU" + datos.data[i].cveFormulario + "").prop("checked", true);
                        } else {
                            $("#ckbU" + datos.data[i].cveFormulario + "").prop("checked", false);
                        }
                        if (datos.data[i].eliminar == 'S') {
                            $("#ckbD" + datos.data[i].cveFormulario + "").prop("checked", true);
                        } else {
                            $("#ckbD" + datos.data[i].cveFormulario + "").prop("checked", false);
                        }
                        if (datos.data[i].registrar == 'S') {
                            $("#ckbI" + datos.data[i].cveFormulario + "").prop("checked", true);
                        } else {
                            $("#ckbI" + datos.data[i].cveFormulario + "").prop("checked", false);
                        }
                    }
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };

    asignaPermiso = function (cveFormulario, idRef) {
        if ($("#" + idRef + "").is(':checked')) {
            var tipoPermiso = "asignaPermiso";
        } else {
            var tipoPermiso = "quitaPermiso";
        }
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/permisosgrupos/PermisosgruposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "guardar",
                cveGrupo: $('#cmbGrupo').val(),
                cveSistema: $('#cmbSistema').val(),
                cveFormulario: cveFormulario,
                tipoPermiso: tipoPermiso,
                crud: idRef
            },
            beforeSend: function (data) {

            },
            success: function (datos) {
                if (datos.status == 'ok' || datos.status == 'okElimina') {
                    $("#ckbF" + datos.data[0].cveFormulario + "").prop("checked", true);
                    if (datos.data[0].consulta == 'S') {
                        $("#ckbS" + datos.data[0].cveFormulario + "").prop("checked", true);
                    } else {
                        $("#ckbS" + datos.data[0].cveFormulario + "").prop("checked", false);
                    }
                    if (datos.data[0].modificar == 'S') {
                        $("#ckbU" + datos.data[0].cveFormulario + "").prop("checked", true);
                    } else {
                        $("#ckbU" + datos.data[0].cveFormulario + "").prop("checked", false);
                    }
                    if (datos.data[0].eliminar == 'S') {
                        $("#ckbD" + datos.data[0].cveFormulario + "").prop("checked", true);
                    } else {
                        $("#ckbD" + datos.data[0].cveFormulario + "").prop("checked", false);
                    }
                    if (datos.data[0].registrar == 'S') {
                        $("#ckbI" + datos.data[0].cveFormulario + "").prop("checked", true);
                    } else {
                        $("#ckbI" + datos.data[0].cveFormulario + "").prop("checked", false);
                    }

                } else if (datos.status == 'okEliminaTodos') {
                    $("#ckbF" + datos.cveFormulario + "").prop("checked", false);
                    $("#ckbS" + datos.cveFormulario + "").prop("checked", false);
                    $("#ckbU" + datos.cveFormulario + "").prop("checked", false);
                    $("#ckbD" + datos.cveFormulario + "").prop("checked", false);
                    $("#ckbI" + datos.cveFormulario + "").prop("checked", false);
                } else if (datos.status == 'Fail') {
                    alert(datos.mnj);
                } else if (datos.status == 'FailInicio') {
                    $("#" + idRef + "").prop("checked", false);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };

    limpiar = function () {
        $('#cmbSistema').val(1);
        $('#cmbGrupo').val('');
        $('#divResultadosOpciones').hide('slow');
        $('#divResultadosOpciones').html('');
    };
    $(function () {
        comboSistemas();
        comboGrupos();
    });

</script>