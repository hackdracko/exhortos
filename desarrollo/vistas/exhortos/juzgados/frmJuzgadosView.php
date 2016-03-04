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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//juzgados/frmJuzgadosView.xml", "frmJuzgadosView");
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
            Registro de juzgados
        </h5>
    </div>
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <p class="col-lg-12" style="color:darkred;">
                Los campos marcados con (*) son obligatorios.
            </p>
            <div id="divCampos">
                <div class="starter-template">
                    <p style="text-align: center;">
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n juzgados</label>
                        <div class="col-md-5">
                            <input type="hidden" id="hddJuzgado" value="">
                            <input type="text" name="txtDescJuzgado" id="txtDescJuzgado" placeholder="Descripci&oacute;n juzgados" title="Descripci&oacute;n juzgados" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n adscripci&oacute;n</label>
                        <div class="col-md-5">
                            <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4">Filtrar oficialia por estado</label>
                        <div class="col-md-5">
                            <select id="cmbEstados" class="form-control" name="cmbEstados">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4">Filtrar oficialia por distrito</label>
                        <div class="col-md-5">
                            <select id="cmbDistritos" class="form-control" name="cmbDistritos">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4">Filtrar oficialia por municipio</label>
                        <div class="col-md-5">
                            <select id="cmbMunicipios" class="form-control" name="cmbMunicipios">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n oficialia</label>
                        <div class="col-md-5">
                            <select id="cmbOficialias" class="form-control" name="cmbOficialias">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n materia</label>
                        <div class="col-md-5">
                            <select id="cmbMaterias" class="form-control" name="cmbMaterias">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n cuantia</label>
                        <div class="col-md-5">
                            <select id="cmbCuantias" class="form-control" name="cmbCuantias">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n tipo</label>
                        <div class="col-md-5">
                            <select id="cmbTipos" class="form-control" name="cmbTipos">
                                <option value="">Seleccione una opci&oacute;n</option>
                            </select>                            
                        </div>
                    </div>
                    </p>
                    <p style="text-align: center;">
                        <button type="button" class="btn btn-primary" value="Guardar" id="btnJuzgadosGuardar" name="btnJuzgadosGuardar" onclick="guardarJuzgados()" tabIndex="8" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                        <button type="button"  class="btn btn-primary" value="Consultar" id="btnJuzgadosConsultar" name="btnJuzgadosConsultar" onclick="consultaJuzgados()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                        <button type="button"  class="btn btn-primary" value="Eliminar" id="btnJuzgadosEliminar" name="btnJuzgadosEliminar" onclick="bajaJuzgados()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                        <button type="button"  class="btn btn-primary" value="Limpiar" id="btnJuzgadosLimpiar" name="btnJuzgadosLimpiar" onclick="limpiaJuzgados()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
                    </p>
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
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaJuzgados(1);">
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
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaJuzgados();">
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
        $("#txtDescJuzgado").keypress(function (key) {
            //alert(key.charCode);
            if ((key.charCode < 225 || key.charCode > 252) && (key.charCode < 193 || key.charCode > 218) && (key.charCode < 48 || key.charCode > 57) && (key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45) && (key.charCode != 0) && (key.charCode != 32))
                return false;
        });
        $("#btnJuzgadosEliminar").hide();
        var estado = "";
        var municipio = "";
        var distritos = "";
        $("#cmbEstados").change(function () {
            estado = $("#cmbEstados").val();
            distritos = $("#cmbDistritos").val();
            municipio = $("#cmbMunicipios").val();
            comboMunicipios(estado);
            comboDistritos(estado);
            comboOficialia(estado, municipio, distritos);
        });
        $("#cmbDistritos").change(function () {
            estado = $("#cmbEstados").val();
            distritos = $("#cmbDistritos").val();
            municipio = $("#cmbMunicipios").val();
            comboOficialia(estado, municipio, distritos);
        });
        $("#cmbMunicipios").change(function () {
            estado = $("#cmbEstados").val();
            distritos = $("#cmbDistritos").val();
            municipio = $("#cmbMunicipios").val();
            comboOficialia(estado, municipio, distritos);
        });

    });
    guardarJuzgados = function () {
        $(".required").remove();
        var accion = "";
        var hddJuzgado = $("#hddJuzgado").val();
        var guardar = 1;
        var descripcionJuzgado = $("#txtDescJuzgado").val();
        if (descripcionJuzgado === "") {
            //alert("Falta campo");
            $('#txtDescJuzgado').focus();
            $('#txtDescJuzgado').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripcion del juzgado</label>");
            guardar = 0;
        }
        var cveOficialia = $("#cmbOficialias").val();
        if (cveOficialia === "") {
            //alert("Falta campo");
            $('#cmbOficialias').focus();
            $('#cmbOficialias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una oficialia</label>");
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
                url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
                data: {
                    accion: "guardar-provedor",
                    desJuzgado: descripcionJuzgado,
                    cveOficialia: cveOficialia,
                    cveJuzgado: hddJuzgado,
                    activo: "S"
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
                            $("#hddJuzgado").val(datos.data[0].cveJuzgado);
                            $("#btnJuzgadosEliminar").show();
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
    limpiaJuzgados = function () {
        $("#txtDescJuzgado").val("");
        $("#cmbOficialias").val("");
        $("#cmbEstados").val("");
        $("#cmbMunicipios").val("");
        $("#cmbDistritos").val("");
        $("#hddJuzgado").val("");
        $("#btnJuzgadosEliminar").hide();
        $(".required").remove();
        comboAdscripciones();
        comboOficialia();
        comboEstados();

    };
    bajaJuzgados = function () {
        $(".required").remove();
        //## PARA VERIFICAR LA ELEIMINACION
        var hddJuzgado = $("#hddJuzgado").val();
        if (hddJuzgado != "") {
            bootbox.dialog({
                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar el juzgado ?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
                                data: {
                                    cveJuzgado: hddJuzgado,
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
                                        limpiaJuzgados();
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
    seleccionaJuzgadoModificar = function (cveJuzgado, desJuzgado, cveOficialia, cveMunicipio, cveDistrito, cveEstado, cveAdscripcion, cveMateria, cveCuantia, cveTipo) {
        $(".required").remove();
        $("#divConsulta").hide();
        $("#divFormulario").show();
        $("#txtDescJuzgado").val(desJuzgado);
//        alert(cveAdscripcion);
        $("#cmbAdscripciones").val(cveAdscripcion);
        $("#cmbMaterias").val(cveMateria);
        $("#cmbCuantias").val(cveCuantia);
        $("#cmbTipos").val(cveTipo);
//        $("#cmbEstados").val(cveEstado);
//        $("#cmbDistritos").val(cveDistrito);
//        $("#cmbMunicipios").val(cveMunicipio);
        if (cveOficialia !== undefined)
            $("#cmbOficialias").val(cveOficialia);
        else
            $("#cmbOficialias").val("0");
        $("#hddJuzgado").val(cveJuzgado);
        $("#btnJuzgadosEliminar").show();
    };
    getPaginas = function (pag, cantReg) {
        var desJuzgado = $("#txtDescJuzgado").val();
        var oficialia = $("#cmbOficialias").val();
        //var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        var estado = $("#cmbEstados").val();
        var distritos = $("#cmbDistritos").val();
        var municipio = $("#cmbMunicipios").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
            data: {
                desJuzgado: desJuzgado,
                cveOficialia: oficialia,
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
    consultaJuzgados = function (pDefault) {
        $(".required").remove();
        $(".alert").hide();
        var descJuzgado = $("#txtDescJuzgado").val();
        var oficialia = $("#cmbOficialias").val();
        var table = "";
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $("#cmbPaginacion").val(1);
        var estado = $("#cmbEstados").val();
        var distritos = $("#cmbDistritos").val();
        var municipio = $("#cmbMunicipios").val();
        if (pDefault != null) {
            pag = 1;
        }
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
            data: {
                desJuzgado: descJuzgado,
                cveOficialia: oficialia,
                estado: estado,
                municipio: municipio,
                distrito: distritos,
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
//                alert(datos);
                if (datos.totalCount > 0) {
                    //alert("Entra");
                    table += "<table id='tblResultadosGrid' class='table table-hover table-striped table-bordered'>";
                    table += "<thead>";
                    table += "<tr>";
                    table += "<th>N&uacute;m.</th>";
                    table += "<th>Juzgado descripci&oacute;n</th>";
                    table += "<th>Oficialia descripci&oacute;n</th>";
                    table += "<th>Materia descripci&oacute;n</th>";
                    table += "<th>Cuantia descripci&oacute;n</th>";
                    table += "<th>Tipo descripci&oacute;n</th>";
                    table += "</tr>";
                    table += "</thead>";
                    table += "<tbody>";
                    for (var i = 0; i < datos.totalCount; i++) {
//                        var nombreOficialia = $("#cmbOficialias option[value='" + datos.data[i].cveOficialia + "']").text();
//                        alert(nombreEstado);
                        table += "<tr onclick='seleccionaJuzgadoModificar(" + datos.data[i].cveJuzgado + ", \"" + datos.data[i].desJuzgado + "\", \"" + datos.data[i].cveOficialia + "\", \"" + datos.data[i].cveMunicipio + "\", \"" + datos.data[i].cveDistrito + "\", \"" + datos.data[i].cveEstado + "\", \"" + datos.data[i].cveAdscripcion + "\", \"" + datos.data[i].cveMateria + "\", \"" + datos.data[i].cveCuantia + "\", \"" + datos.data[i].cveTipo + "\")'>";
                        table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(i) + 1)) + "</td>";
                        table += "<td>" + datos.data[i].desJuzgado + "</td>";
                        table += "<td>" + datos.data[i].desOficilia + "</td>";
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
                    getPaginas(pag, cantReg);
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
    comboOficialia = function (estado, municipio, distrito) {
        //        alert(estado);
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
            async: false,
            dataType: "json",
            data: {
                accion: "consultar-paginacion-estado",
                estado: estado,
                cveMunicipio: municipio,
                cveDistrito: distrito,
                activo: "S"
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbOficialias').empty();
                    $('#cmbOficialias').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbOficialias').append('<option value="' + object.cveOficialia + '">' + object.desOficilia + '</option>');
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
//        alert(estado);
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
                accion: "consultar-juzgado",
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
//        alert("Inicio");
        comboAdscripciones();
        comboOficialia();
        comboEstados();
        comboMaterias();
        comboCuantias();
        comboTipos();
//        comboDistritos();
//        comboMunicipios();
    });
</script>
