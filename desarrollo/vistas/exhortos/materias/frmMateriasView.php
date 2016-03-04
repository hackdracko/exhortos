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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//materias/frmMateriasView.xml", "frmMateriasView");
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
            Registro de materias
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
                            <label for="" class="caption control-label col-md-4 needed" id="cveMateria">Descripci&oacute;n materia</label>
                            <div class="col-md-5">
                                <input type="hidden" id="hddMateria" value="">
                                <input type="text" name="txtDesMaterias" id="txtDescMaterias" placeholder="Descripci&oacute;n de la materia" title="Descripci&oacute;n de la materia" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                            </div>
                        </div>
                        </p>
                        <p style="text-align: center;">
                            <button type="button" class="btn btn-primary" value="Guardar" id="btnMateriasGuardar" name="btnMateriasGuardar" onclick="guardarMaterias()" tabIndex="7" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                            <button type="button"  class="btn btn-primary" value="Consultar" id="btnMateriasConsultar" name="btnMateriasConsultar" onclick="consultaMaterias()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                            <button type="button"  class="btn btn-primary" value="Eliminar" id="btnMateriasEliminar" name="btnMateriasEliminar" onclick="bajaMaterias()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                            <button type="button"  class="btn btn-primary" value="Limpiar" id="btnMateriasLimpiar" name="btnMateriasLimpiar" onclick="limpiaMaterias()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
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
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaMaterias(1);">
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
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaMaterias();">
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
        $("#txtDesMaterias").keypress(function (key) {
            //alert(key.charCode);
            if ((key.charCode < 225 || key.charCode > 252) && (key.charCode < 193 || key.charCode > 218) && (key.charCode < 48 || key.charCode > 57) && (key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45) && (key.charCode != 0) && (key.charCode != 32))
                return false;
        });
        $("#btnMateriasEliminar").hide();
    });
    guardarMaterias = function () {
        $(".required").remove();
        var accion = "";
        var hddMateria = $("#hddMateria").val();
        var guardar = 1;
        var descripcionMateria = $("#txtDescMaterias").val();
        if (descripcionMateria === "") {
            //alert("Falta campo");
            $('#txtDescMaterias').focus();
            $('#txtDescMaterias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripcion de la materia</label>");
            guardar = 0;
        }
        if (guardar == 1) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
                data: {
                    accion: "guardar",
                    desMateria: descripcionMateria,
                    cveMateria: hddMateria
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
                            $("#hddMateria").val(datos.data[0].cveMateria);
                            $("#btnMateriasEliminar").show();
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
    limpiaMaterias = function () {
        $("#txtDescMaterias").val("");
        $("#hddMateria").val("");
        $("#btnMateriasEliminar").hide();
        $(".required").remove();
    };
    bajaMaterias = function () {
        $(".required").remove();
        //## PARA VERIFICAR LA ELEIMINACION
        var hddMateria = $("#hddMateria").val();
        if (hddMateria != "") {
            bootbox.dialog({
                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar la materia ?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
                                data: {
                                    cveMateria: hddMateria,
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
                                        limpiaMaterias();
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
    selecionarMateriaModificar = function (cveMateria, descMateria) {
        $(".required").remove();
        $("#divConsulta").hide();
        $("#divFormulario").show();
        $("#txtDescMaterias").val(descMateria);
        $("#hddMateria").val(cveMateria);
        $("#btnMateriasEliminar").show();
    };
    getPaginas = function (pag, cantReg) {
        var desMateria = $("#txtDescMaterias").val();
        //var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();

        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
            data: {
                desMateria: desMateria,
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
    consultaMaterias = function (pDefault) {
        $(".required").remove();
        $(".alert").hide();
        var desMateria = $("#txtDescMaterias").val();
        var table = "";
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $("#cmbPaginacion").val(1);
        if (pDefault != null) {
            pag = 1;
        }
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
            data: {
                desMateria: desMateria,
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
                    table += "<th>Materia descripci&oacute;n</th>";
                    table += "</tr>";
                    table += "</thead>";
                    table += "<tbody>";
                    for (var i = 0; i < datos.totalCount; i++) {
                        table += "<tr onclick='selecionarMateriaModificar(" + datos.data[i].cveMateria + ", \"" + datos.data[i].desMateria + "\")'>";
                        table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(i) + 1)) + "</td>";
                        table += "<td>" + datos.data[i].desMateria + "</td>";
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
</script>
