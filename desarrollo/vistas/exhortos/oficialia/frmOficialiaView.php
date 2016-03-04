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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//oficialia/frmOficialiaView.xml", "frmOficialiaView");
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
            Registro de Oficialia
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
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n de la oficialia</label>
                        <div class="col-md-5">
                            <input type="hidden" id="hddOficialia">
                            <input type="text" name="" id="txtDescOficialia" placeholder="Descripci&oacute;n oficialia" title="Descripci&oacute;n oficialia" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n adscripci&oacute;n</label>
                        <div class="col-md-5">
                            <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                        <!--                        <div class="form-group">
                                                    <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n adscripci&oacute;n</label>
                                                    <div class="col-md-5">
                                                        <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                                                            <option value="">Seleccione una opci&oacute;n</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4">Descripci&oacute;n estado</label>
                        <div class="col-md-5">
                            <select id="cmbEstados" class="form-control" name="cmbEstados">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n Municipio</label>
                        <div class="col-md-5">
                            <select id="cmbMunicipios" class="form-control" name="cmbMunicipios">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n Distrito</label>
                        <div class="col-md-5">
                            <select id="cmbDistritos" class="form-control" name="cmbDistritos">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    </p>
                    <p style="text-align: center;">
                        <button type="button" class="btn btn-primary" value="Guardar" id="btnOficialiaGuardar" name="btnOficialiaGuardar" onclick="guardarOficialia()" tabIndex="9" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                        <button type="button"  class="btn btn-primary" value="Consultar" id="btnOficialiaConsultar" name="btnOficialiaConsultar" onclick="consultaOficialia()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                        <button type="button"  class="btn btn-primary" value="Eliminar" id="btnOficialiaEliminar" name="btnOficialiaEliminar" onclick="bajaOficialia()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                        <button type="button"  class="btn btn-primary" value="Limpiar" id="btnOficialiaLimpiar" name="btnOficialiaLimpiar" onclick="limpiaOficialia()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
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
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaOficialia(1);">
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
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaOficialia();">
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
    $(document).ajaxStart(function () {
        ToggleLoading(2);
    });
    $(document).ajaxStop(function () {
        ToggleLoading(2);
    });
    $(document).ready(function () {
        $("#txtDescOficialia").keypress(function (key) {
            //alert(key.charCode);
            if ((key.charCode < 225 || key.charCode > 252) && (key.charCode < 193 || key.charCode > 218) && (key.charCode < 48 || key.charCode > 57) && (key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45) && (key.charCode != 0) && (key.charCode != 32))
                return false;
        });
        $("#btnOficialiaEliminar").hide();
        $("#cmbEstados").change(function () {
            var estado = $("#cmbEstados").val();
            comboMunicipios(estado);
            comboDistritos(estado);
        });
    });
    guardarOficialia = function () {
        $(".required").remove();
        var accion = "";
        var hddOficialia = $("#hddOficialia").val();
        var guardar = 1;
        var descripcionOficialia = $("#txtDescOficialia").val();
        if (descripcionOficialia === "") {
            //alert("Falta campo");
            $('#txtDescOficialia').focus();
            $('#txtDescOficialia').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripcion de la oficialia</label>");
            guardar = 0;
        }
        var adscripcion = $("#cmbAdscripciones").val();
        if (adscripcion === "") {
            //alert("Falta campo");
            $('#cmbAdscripciones').focus();
            $('#cmbAdscripciones').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una adscripci&oacute;n</label>");
            guardar = 0;
        }
        var cveMunicipio = $("#cmbMunicipios").val();
        if (cveMunicipio === "") {
            //alert("Falta campo");
            $('#cmbMunicipios').focus();
            $('#cmbMunicipios').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un municipio</label>");
            guardar = 0;
        }
        var cveDistrito = $("#cmbDistritos").val();
        if (cveDistrito === "") {
            //alert("Falta campo");
            $('#cmbDistritos').focus();
            $('#cmbDistritos').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un distrito</label>");
            guardar = 0;
        }
        if (guardar == 1) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
                data: {
                    accion: "guardar",
                    desOficilia: descripcionOficialia,
                    cveAdscripcion: adscripcion,
                    cveMunicipio: cveMunicipio,
                    cveDistrito: cveDistrito,
                    cveOficialia: hddOficialia
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
                            $("#hddOficialia").val(datos.data[0].cveOficialia);
                            $("#btnOficialiaEliminar").show();
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
    limpiaOficialia = function () {
        $("#txtDescOficialia").val("");
        $("#cmbEstados").val("");
        $("#cmbMunicipios").val("");
        $("#cmbDistritos").val("");
        $("#hddOficialia").val("");
        $("#btnOficialiaEliminar").hide();
        $(".required").remove();
        comboAdscripciones();
        comboEstados();
        comboMunicipios();
        comboDistritos();
    };
    bajaOficialia = function () {
        $(".required").remove();
        //## PARA VERIFICAR LA ELEIMINACION
        var hddOficialia = $("#hddOficialia").val();
        if (hddOficialia != "") {
            bootbox.dialog({
                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar la oficialia ?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
                                data: {
                                    cveOficialia: hddOficialia,
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
                                        limpiaOficialia();
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
    seleccionaOficialiaModificar = function (cveOficialia, descOficialia, cveMunicipio, cveDistrito, cveEstado, cveAdscripcion) {
        $(".required").remove();
        $("#divConsulta").hide();
        $("#divFormulario").show();
        $("#txtDescOficialia").val(descOficialia);
        $("#cmbAdscripciones").val(cveAdscripcion);
        $("#cmbEstados").val(cveEstado);
        $("#cmbDistritos").val(cveDistrito);
        $("#cmbMunicipios").val(cveMunicipio);
        $("#hddOficialia").val(cveOficialia);
        $("#btnOficialiaEliminar").show();
    };
    getPaginas = function (pag, cantReg) {
        var desOficialia = $("#txtDescOficialia").val();
        var municipio = $("#cmbMunicipios").val();
        var distrito = $("#cmbDistritos").val();
        //var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        var estado = $("#cmbEstados").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
            data: {
                desOficilia: desOficialia,
                cveMunicipio: municipio,
                cveDistrito: distrito,
                accion: "getPaginas",
                cantxPag: cantReg,
                activo: "S",
                estado: estado
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
    consultaOficialia = function (pDefault) {
        $(".required").remove();
        $(".alert").hide();
        var descOficialia = $("#txtDescOficialia").val();
        var municipio = $("#cmbMunicipios").val();
        var estado = $("#cmbEstados").val();
        var distrito = $("#cmbDistritos").val();
        var table = "";
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $("#cmbPaginacion").val(1);
        if (pDefault != null) {
            pag = 1;
        }
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
            data: {
                desOficilia: descOficialia,
                cveMunicipio: municipio,
                cveDistrito: distrito,
                estado: estado,
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
                    table += "<th>Oficialia descripci&oacute;n</th>";
                    table += "<th>Municipio descripci&oacute;n</th>";
                    table += "<th>Distrito descripci&oacute;n</th>";
                    ;
                    table += "</tr>";
                    table += "</thead>";
                    table += "<tbody>";
                    for (var i = 0; i < datos.totalCount; i++) {
                        var nombreMunicipios = "";
                        var nombreDistrito = "";
                        var nombreEstado = "";
                        if (datos.data[i].cveMunicipio != 0)
                            nombreMunicipios = $("#cmbMunicipios option[value='" + datos.data[i].cveMunicipio + "']").text();
                        if (datos.data[i].cveDistrito != 0)
                            nombreDistrito = $("#cmbDistritos option[value='" + datos.data[i].cveDistrito + "']").text();
                        if (datos.data[i].cveEstado != 0)
                            nombreEstado = $("#cmbEstados option[value='" + datos.data[i].cveEstado + "']").text();
//                        alert(nombreEstado);
                        table += "<tr onclick='seleccionaOficialiaModificar(" + datos.data[i].cveOficialia + ", \"" + datos.data[i].desOficilia + "\", \"" + datos.data[i].cveMunicipio + "\", \"" + datos.data[i].cveDistrito + "\", \"" + datos.data[i].cveEstado + "\", \"" + datos.data[i].cveAdscripcion + "\")'>";
                        table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(i) + 1)) + "</td>";
                        table += "<td>" + datos.data[i].desOficilia + "</td>";
                        table += "<td>" + nombreMunicipios + "</td>";
                        table += "<td>" + nombreDistrito + "</td>";
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
    comboDistritos = function (estado) {
//        alert(estado);
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/distritos/DistritosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                cveEstado: estado,
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbDistritos').empty();
                    $('#cmbDistritos').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbDistritos').append('<option value="' + object.cveDistrito + '">' + object.desDistrito + '</option>');
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
    comboMunicipios = function (estado) {
//        alert(estado);$("#divHideForm").hide();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/municipios/MunicipiosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar",
                cveEstado: estado,
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbMunicipios').empty();
                    $('#cmbMunicipios').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbMunicipios').append('<option value="' + object.cveMunicipio + '">' + object.desMunicipio + '</option>');
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
    comboEstados = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/estados/EstadosFacade.Class.php",
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
                    $('#cmbEstados').empty();
                    $('#cmbEstados').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbEstados').append('<option value="' + object.cveEstado + '">' + object.desEstado + '</option>');
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
    comboAdscripciones = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar-oficialia",
                activo: "S"
            },
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
                    alert("Error al cargar las adscripciones:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de adscripciones:\n\n" + otroobj);
            }
        });
    };
    $(function () {
//        alert("Inicio");
        comboAdscripciones();
        comboEstados();
        comboDistritos();
        comboMunicipios();
    });
</script>
