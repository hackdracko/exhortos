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
//include_once(dirname(__FILE__) . "/../../../webservice/cliente/permisos/PermisosCliente.php");
$tagXml = new TagXml();
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//juzgadosmaterias/frmJuzgadosmateriasView.xml", "frmJuzgadosmateriasView");
//include '../../inicio.php';
?>
<!DOCTYPE html>
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
<div class="container panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Registro de juzgados materias
        </h5>
    </div>
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <p class="col-lg-12" style="color:darkred;">
                Los campos marcados con (*) son obligatorios.
            </p>
            <div id="divCampos">
                <div class="starter-template">
                    <!--<fieldset>-->
                        <p style="text-align: center;">
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Juzgado</label>
                            <div class="col-md-5">
                                <input type="hidden" id="hddJuzgadoMateria">
                                <select id="cmbJuzgados" class="form-control" name="cmbJuzgados">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Materia</label>
                            <div class="col-md-5">
                                <select id="cmbMaterias" class="form-control" name="cmbMaterias">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Cuantia</label>
                            <div class="col-md-5">
                                <select id="cmbCuantias" class="form-control" name="cmbCuantias">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Tipo</label>
                            <div class="col-md-5">
                                <select id="cmbTipos" class="form-control" name="cmbTipos">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        </p>
                        <p style="text-align: center;">
                            <button type="button" class="btn btn-primary" value="Guardar" id="btnJuzgadosmateriasGuardar" name="btnJuzgadosmateriasGuardar" onclick="guardarJuzgadosmaterias()" tabIndex="10" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                            <button type="button"  class="btn btn-primary" value="Consultar" id="btnJuzgadosmateriasConsultar" name="btnJuzgadosmateriasConsultar" onclick="consultaJuzgadosmaterias()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                            <button type="button"  class="btn btn-primary" value="Eliminar" id="btnJuzgadosmateriasEliminar" name="btnJuzgadosmateriasEliminar" onclick="bajaJuzgadosmaterias()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                            <button type="button"  class="btn btn-primary" value="Limpiar" id="btnJuzgadosmateriasLimpiar" name="btnJuzgadosmateriasLimpiar" onclick="limpiaJuzgadosmaterias()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
                        </p>
                    <!--</fieldset>-->
                </div>
            </div>
        </div>
        <div id="divConsulta" style="display: none" class="col-xs-12">
            <div class="col-xs-12">
                <div class="col-xs-2">
                    <input type="submit" class="btn btn-primary" value="Regresar" onclick="changeDivForm(1);
                            $('#cmbPaginacion').val(1)">                                                    
                </div>

                <div id="divPaginador" class="form-group col-xs-4" style="float: right;">
                    <label class="control-label">Registros por p&aacute;gina:</label>
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaJuzgadosmaterias(1);">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div id="divPaginador" class="form-group col-xs-2" style="float: right;">
                    <label class="control-label">Pagina:</label>
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaJuzgadosmaterias();">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group col-xs-2" style="padding: 10px;float: right;">
                    <label class="control-label" id="totalReg"></label>
                </div>
            </div>

            <div id="divTableResult" class="col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <div id="divAlertWarning" class="alert alert-warning alert-dismissable">                    
                <strong>Advertencia!</strong> Mensaje
            </div>
            <div id="divAlertSucces" class="alert alert-success alert-dismissable">

                <strong>Correcto!</strong> Mensaje
            </div>
            <div id="divAlertDager" class="alert alert-danger alert-dismissable">

                <strong>Error!</strong> Mensaje
            </div>
            <div id="divAlertInfo" class="alert alert-info alert-dismissable">

                <strong>Informaci&oacute;n!</strong> Mensaje
            </div>
        </div>
    </div>
</div><!--.container -->
<script>
    $(document).ready(function () {
        $("#btnJuzgadosmateriasEliminar").hide();
    });
    guardarJuzgadosmaterias = function () {
        $(".required").remove();
        var accion = "";
        var hddJuzgadoMateria = $("#hddJuzgadoMateria").val();
        var guardar = 1;
        var cveJuzgado = $("#cmbJuzgados").val();
        if (cveJuzgado === "") {
            //alert("Falta campo");
            $('#cmbJuzgados').focus();
            $('#cmbJuzgados').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un juzgado</label>");
            guardar = 0;
        }
        var cveMateria = $("#cmbMaterias").val();
        if (cveMateria === "") {
            //alert("Falta campo");
            $('#cmbMaterias').focus();
            $('#cmbMaterias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una materia</label>");
            guardar = 0;
        }
        var cveCuantia = $("#cmbCuantias").val();
        if (cveCuantia === "") {
            //alert("Falta campo");
            $('#cmbCuantias').focus();
            $('#cmbCuantias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una cuantia</label>");
            guardar = 0;
        }
        var cveTipo = $("#cmbTipos").val();
        if (cveTipo === "") {
            //alert("Falta campo");
            $('#cmbTipos').focus();
            $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un tipo</label>");
            guardar = 0;
        }
        if (guardar == 1) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/juzgadosmaterias/JuzgadosmateriasFacade.Class.php",
                data: {
                    accion: "guardar",
                    cveJuzgado: cveJuzgado,
                    cveMateria: cveMateria,
                    cveCuantia: cveCuantia,
                    cveTipo: cveTipo,
                    cveJuzgadoMateria: hddJuzgadoMateria
                },
                async: true,
                dataType: "json",
                beforeSend: function (objeto) {
                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                },
                success: function (datos) {
                    try {
                        if (datos.totalCount > 0) {
                            $(".required").remove();
                            $("#hddJuzgadoMateria").val(datos.data[0].cveJuzgadoMateria);
                            $("#btnJuzgadosmateriasEliminar").show();
                            //alert(datos.text);
                            $("#divHideForm").hide();
                            $("#divAlertSucces").html("Correcto!: " + datos.text);
                            $("#divAlertSucces").show("slide");
                            setTimeAlert("divAlertSucces");
                        } else {
                            if (datos.totalCount == "#") {
                                $("#divAlertWarning").html("Error:\n\n" + datos.text);
                                $("#divAlertWarning").show("slide");
                                setTimeAlert("divAlertWarning");
                            } else {
                                $("#divAlertDager").html("Error en la peticion:\n\n" + datos.text);
                                $("#divAlertDager").show("slide");
                                setTimeAlert("divAlertDager");
                            }
                        }
                    } catch (e) {
                        //alert(datos.text);
                        //document.getElementById('divGeneros').innerHTML = "";
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                }
            });
        }
    };
    changeDivForm = function (n) {
        $(".required").remove();
        if (n == 1) {
            $("#divFormulario").show();
            $("#divConsulta").hide();
        }
    };
    limpiaJuzgadosmaterias = function () {
        $("#cmbJuzgados").val("");
        $("#cmbMaterias").val("");
        $("#cmbCuantias").val("");
        $("#cmbTipos").val("");
        $("#hddJuzgadoMateria").val("");
        $("#btnJuzgadosmateriasEliminar").hide();
        $(".required").remove();
    };
    bajaJuzgadosmaterias = function () {
        $(".required").remove();
        //## PARA VERIFICAR LA ELEIMINACION
        var hddJuzgadomateria = $("#hddJuzgadoMateria").val();
        if (hddJuzgadomateria != "") {
            bootbox.dialog({
                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar el juzgado materia ?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/juzgadosmaterias/JuzgadosMateriasFacade.Class.php",
                                data: {
                                    cveJuzgadoMateria: hddJuzgadomateria,
                                    accion: "guardar",
                                    activo: "N"
                                },
                                async: true,
                                dataType: "json",
                                beforeSend: function (objeto) {
                                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                                },
                                success: function (datos) {
                                    try {
                                        //alert(datos.text);
                                        limpiaJuzgadosmaterias();
                                        //document.getElementById('divGeneros').innerHTML = "";
                                        $("#divHideForm").hide();
                                        $("#divAlertSucces").html("Correcto!: " + datos.text + " (Eliminado) ");
                                        $("#divAlertSucces").show("slide");
                                        setTimeAlert("divAlertSucces");
                                    } catch (e) {
                                        $("#divAlertDager").html("Error en la peticion:\n\n" + datos.text);
                                        $("#divAlertDager").show("slide");
                                        setTimeAlert("divAlertDager");
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
        } else {
            //alert("No se ha seleccionado ningun registro");
        }
    };
    seleccionaJuzgadoMateriaModificar = function (cveJuzgadoMateria, cveJuzgado,cveMateria, cveCuantia, cveTipo) {
        $(".required").remove();
        $("#divConsulta").hide();
        $("#divFormulario").show();
        $("#cmbJuzgados").val(cveJuzgado);
        $("#cmbCuantias").val(cveCuantia);
        $("#cmbMaterias").val(cveMateria);
        $("#cmbTipos").val(cveTipo);
        $("#hddJuzgadoMateria").val(cveJuzgadoMateria);
        $("#btnJuzgadosmateriasEliminar").show();
    };
    getPaginas = function (pag, cantReg) {
        var juzgado = $("#cmbJuzgados").val();
        var materia = $("#cmbMaterias").val();
        var cuantia = $("#cmbCuantias").val();
        var tipo = $("#cmbTipos").val();
        //var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/juzgadosmaterias/JuzgadosmateriasFacade.Class.php",
            data: {
                cveJuzgado: juzgado,
                cveMateria: materia,
                cveCuantia: cuantia,
                cveTipo: tipo,
                accion: "getPaginas",
                cantxPag: cantReg,
                activo: "S"
            },
            async: true,
            dataType: "json",
            beforeSend: function (objeto) {
                //$('#barCarga').html('<center> <br/><img src="../img/cargando.gif" width="80"/></center>');  
            },
            success: function (datos) {
                //alert("HOLA");
                //alert(datos.totalCount);
//                        var json = "";
//                        json = eval("(" + datos + ")"); //Parsear JSON
//
                if (datos.totalCount > 0) {
                    $('#cmbPaginacion').find('option').remove().end();

                    for (var i = 0; i < (parseInt(datos.total)); i++) {
                        $("#cmbPaginacion").append($('<option></option>').val(datos.data[i].pagina).html(datos.data[i].pagina));
                    }
                    $("#totalReg").html("<b> Total: " + datos.totalCount + "</b>");
                    $("#cmbPaginacion").val(pag);
                } else {
                    var tipoNumero = $('#cmbTipoCarpeta :selected').text();

                    $("#divAlertDager").html("Error EL NUMERO DE " + tipoNumero + " NO EXISTE");
                    $("#divAlertDager").show("slide");
                    setTimeAlert("divAlertDager");
                }
                $('#barCarga').html("");

            },
            error: function (objeto, quepaso, otroobj) {
                //alert("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").html("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").show("slide");
                setTimeAlert("divAlertDager");
            }
        });
    };
    consultaJuzgadosmaterias = function (pDefault) {
        $(".required").remove();
        $(".alert").hide();
        var cuantia = $("#cmbCuantias").val();
        var materia = $("#cmbMaterias").val();
        var tipo = $("#cmbTipos").val();
        var juzgado = $("#cmbJuzgados").val();

        var table = "";
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $("#cmbPaginacion").val(1);
        if (pDefault != null) {
            pag = 1;
        }
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/juzgadosmaterias/JuzgadosmateriasFacade.Class.php",
            data: {
                cveJuzgado: juzgado,
                cveMateria: materia,
                cveCuantia: cuantia,
                cveTipo: tipo,
                accion: "consultar-paginacion",
                cantxPag: cantReg,
                pag: pag,
                activo: "S"
            },
            async: true,
            dataType: "json",
            beforeSend: function (objeto) {
                //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
            },
            success: function (datos) {
                if (datos.totalCount > 0) {
                    //alert("Entra");
                    table += "<table id='tblResultadosGrid' class='table table-hover table-striped table-bordered'>";
                    table += "<thead>";
                    table += "<tr>";
                    table += "<th>N&uacute;m.</th>";
                    table += "<th>Juzgado descripci&oacute;n</th>";
                    table += "<th>Materia descripci&oacute;n</th>";
                    table += "<th>Cuantia descripci&oacute;n</th>";
                    table += "<th>Tipo descripci&oacute;n</th>";
                    table += "</tr>";
                    table += "</thead>";
                    table += "<tbody>";
                    for (var i = 0; i < datos.totalCount; i++) {

//                        var nombreMunicipios = $("#cmbMunicipios option[value='" + datos.data[i].cveMunicipio + "']").text();
//                        var nombreDistrito = $("#cmbDistritos option[value='" + datos.data[i].cveDistrito + "']").text();
//                        alert(nombreEstado);
                        table += "<tr onclick='seleccionaJuzgadoMateriaModificar(" + datos.data[i].cveJuzgadoMateria + ", \"" + datos.data[i].cveJuzgado + "\", \"" + datos.data[i].cveMateria + "\", \"" + datos.data[i].cveCuantia + "\", \"" + datos.data[i].cveTipo + "\")'>";
                        table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(i) + 1)) + "</td>";
                        table += "<td>" + datos.data[i].desJuzgado + "</td>";
                        table += "<td>" + datos.data[i].desMateria + "</td>";
                        table += "<td>" + datos.data[i].desCuantia + "</td>";
                        table += "<td>" + datos.data[i].desTipo + "</td>";
                        table += "</tr>";
                    }
                    table += "</tbody>";
                    table += "</table>";
                    $("#divConsulta").show();
                    $("#divFormulario").hide();
                    $("#divTableResult").html(table);
                    $("#tblResultadosGrid").DataTable({
                        paging: false
                    });
                    $('#divTableResult').show("");
                    getPaginas(datos.pagina, cantReg);
                } else {
                    $("#divHideForm").hide();
                    $("#divTableResult").html(table);
                    $("#divConsulta").hide();
                    $("#divAlertInfo").show();
                    $("#divAlertInfo").html("Informaci&oacute;n: " + datos.text);
                    setTimeAlert("divAlertInfo");
                }
            },
            error: function (objeto, quepaso, otroobj) {
            }
        });
    };
    comboJuzgados = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbJuzgados').empty();
                    $('#cmbJuzgados').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbJuzgados').append('<option value="' + object.cveJuzgado + '">' + object.desJuzgado + '</option>');
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
    comboMaterias = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbMaterias').empty();
                    $('#cmbMaterias').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbMaterias').append('<option value="' + object.cveMateria + '">' + object.desMateria + '</option>');
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
    comboCuantias = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/cuantias/CuantiasFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbCuantias').empty();
                    $('#cmbCuantias').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbCuantias').append('<option value="' + object.cveCuantia + '">' + object.desCuantia + '</option>');
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
    comboTipos = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/tipos/TiposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbTipos').empty();
                    $('#cmbTipos').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbTipos').append('<option value="' + object.cveTipo + '">' + object.desTipo + '</option>');
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
    $(function () {
        comboJuzgados();
        comboMaterias();
        comboCuantias();
        comboTipos();
    });
</script>