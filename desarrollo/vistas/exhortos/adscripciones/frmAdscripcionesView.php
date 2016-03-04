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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//adscripciones/frmAdscripcionesView.xml", "frmAdscripcionesView");
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
    .seleccionadoAdscripcion{
        
    }
    .seleccionadoAdscripcion:hover{
    }
    .seleccionadoOficialia{
        
    }
    
    .seleccionadoJuzgado{
        
    }
    .seleccionadoJuzgado:hover{
        
    }
    .hoverSeleccionado{
        background-color: #cecece;
    }
</style>
<div class="container panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Registro de adscripciones
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
                        <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n adscripci&oacute;n</label>
                        <div class="col-md-5">
                            <input type="hidden" id="hddAdscripcion" value="">
                            <input type="hidden" id="hddJuzgado" value="">
                            <input type="hidden" id="hddOficialia" value="">
                            <input type="text" name="txtDescAdscripcion" id="txtDescAdscripcion" placeholder="Descripci&oacute;n adscripci&oacute;n" title="Descripci&oacute;n adscripci&oacute;n" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="caption control-label col-md-4 needed">Tipo adscripci&oacute;n</label>
                        <div class="col-md-5">
                            <input type="hidden" id="hddTipoAnterior" value="">
                            <input name="rd" id="rd1" value="O" onclick="" type="radio">
                            <label class="Arial11Verde" id="" name="">OFICIALIA</label>
                            <input name="rd" id="rd2" value="J" onclick="" type="radio">
                            <label class="Arial11Verde" id="" name="">JUZGADO</label>
                        </div>
                    </div>
                    <div id="divCamposOficialia">
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Descripci&oacute;n oficialia</label>
                            <div class="col-md-5">
                                <input type="text" name="txtDescOficialia" id="txtDescOficialia" placeholder="Descripci&oacute;n oficialia" title="Descripci&oacute;n oficialia" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Descripci&oacute;n estado</label>
                            <div class="col-md-5">
                                <select id="cmbEstadosO" class="form-control" name="cmbEstadosO">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n municipio</label>
                            <div class="col-md-5">
                                <select id="cmbMunicipiosO" class="form-control" name="cmbMunicipiosO">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n distrito</label>
                            <div class="col-md-5">
                                <select id="cmbDistritosO" class="form-control" name="cmbDistritosO">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="divCamposJuzgado">
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Descripci&oacute;n juzgado</label>
                            <div class="col-md-5">
                                <input type="text" name="txtDescJuzgado" id="txtDescJuzgado" placeholder="Descripci&oacute;n juzgado" title="Descripci&oacute;n juzgado" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Filtrar oficialia por estado</label>
                            <div class="col-md-5">
                                <select id="cmbEstadosJ" class="form-control" name="cmbEstadosJ">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Filtrar oficialia por municipio</label>
                            <div class="col-md-5">
                                <select id="cmbMunicipiosJ" class="form-control" name="cmbMunicipiosJ">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4">Filtrar oficialia por distrito</label>
                            <div class="col-md-5">
                                <select id="cmbDistritosJ" class="form-control" name="cmbDistritosJ">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n oficialia</label>
                            <div class="col-md-5">
                                <input type="hidden" value="" id="hddOficialiaAnterior">
                                <select id="cmbOficialias" class="form-control" name="cmbOficialias">
                                    <option value="">Seleccione una opci&oacute;n</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="panel panel-default" id="divListado">
                                <div class="panel-heading">Agregar Materia, Cuantia y Tipo</div>
                                <div class="panel-body">
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
                                </div>
                                <div class="panel-footer">
                                    <p style="text-align: center;" id="botonesLista">
                                        <button type="button" class="btn btn-primary" value="Agregar" id="btnAgregar" name="btnAgregar" onclick="AgregarLista()" tabIndex="7" title="Boton para agregar relaciones" data-toggle="tooltip" >Agregar</button>
                                    </p>
                                    <table id="ltsJuzgadosMaterias" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style=""></th>
                                                <th>Materia</th>
                                                <th>Cuantia</th>
                                                <th>Tipo</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
                    <p style="text-align: center;">
                        <button type="button" class="btn btn-primary" value="Guardar" id="btnAdscripcionesGuardar" name="btnAdscripcionesGuardar" onclick="guardarAdscripciones()" tabIndex="7" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                        <button type="button"  class="btn btn-primary" value="Consultar" id="btnAdscripcionesConsultar" name="btnAdscripcionesConsultar" onclick="consultaAdscripciones()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
                        <button type="button"  class="btn btn-primary" value="Eliminar" id="btnAdscripcionesEliminar" name="btnAdscripcionesEliminar" onclick="bajaAdscripciones()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
                        <button type="button"  class="btn btn-primary" value="Limpiar" id="btnAdscripcionesLimpiar" name="btnAdscripcionesLimpiar" onclick="limpiaAdscripciones()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
                    </p>
                    <!--</fieldset>-->
                </div>
            </div>
        </div>
        <div id="divCamposReasignarJuzgado" class="form-horizontal">
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n juzgado </label>
                <div class="col-md-5">
                    <input type="hidden" name="hddIdJuzgadoReasignar" id="hddJuzgadoReasignar">
                    <input type="text" name="txtDescJuzgadoReasignar" id="txtDescJuzgadoReasignar" placeholder="Descripci&oacute;n juzgado" title="Descripci&oacute;n juzgado" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n adscripci&oacute;n </label>
                <div class="col-md-5">
                    <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed">Descripci&oacute;n oficialia </label>
                <div class="col-md-5">
                    <select id="cmbOficialiasReasignar" class="form-control" name="cmbOficialiasReasignar">
                        <option value="">Seleccione una opci&oacute;n</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            <p style="text-align: center;">
                <button type="button" class="btn btn-primary" value="Guardar" id="btnAdscripcionesGuardarReasignar" name="btnAdscripcionesGuardarReasignar" onclick="guardarAdscripcionesReasignar()" tabIndex="7" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
                <button type="button"  class="btn btn-primary" value="Regresar" id="btnAdscripcionesRegresar" name="btnAdscripcionesRegresar" onclick="regresarTable()" title="Boton para regresar" data-toggle="tooltip">Regresar</button>
            </p>
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
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaAdscripciones(1);">
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
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaAdscripciones();">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group col-xs-2" style="padding: 10px;float: right;">
                    <label class="control-label" id="totalReg"></label>
                </div>
                <div id="divPaginador" class="form-group col-xs-2" style="float: right;">
                    <select  name="cmbActivos" id="cmbActivos" onchange="consultaAdscripciones();">
                        <option value="S" selected="">Activados</option>
                        <option value="N">Desactivados</option>
                        <option value="A">Ambos</option>
                    </select>
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
    var listado = {};
    listado['content'] = [];
    $(document).ready(function () {
        $('#txtDescAdscripcion').on('keyup', function(){
            $("#txtDescOficialia, #txtDescJuzgado").val($("#txtDescAdscripcion").val());
        });
        $("#divCamposReasignarJuzgado").hide();
        $("#divCamposJuzgado").hide();
        $("#divCamposOficialia").hide();

        $("#txtDescAdscripcion").keypress(function (key) {
            //alert(key.charCode);
            if ((key.charCode < 225 || key.charCode > 252) && (key.charCode < 193 || key.charCode > 218) && (key.charCode < 48 || key.charCode > 57) && (key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45) && (key.charCode != 0) && (key.charCode != 32))
                return false;
        });
        $("#btnAdscripcionesEliminar").hide();
        $("#rd1").click(function () {
            $("#cmbEstadosO").val($("#cmbEstadosJ").val());
            $("#cmbMunicipiosO").val($("#cmbMunicipiosJ").val());
            $("#cmbDistritosO").val($("#cmbDistritosJ").val());
            $("#divCamposJuzgado").hide();
            $("#divCamposOficialia").show("slow");
            $(".required").remove();

            //
            var estado = "";
            var municipio = "";
            var distritos = "";
            $("#cmbEstadosO").change(function () {
                estado = $("#cmbEstadosO").val();
                distritos = $("#cmbDistritosO").val();
                municipio = $("#cmbMunicipiosO").val();
                comboMunicipios(estado);
                comboDistritos(estado);
                comboOficialia(estado, municipio, distritos);
            });
            $("#cmbDistritosO").change(function () {
                estado = $("#cmbEstadosO").val();
                distritos = $("#cmbDistritosO").val();
                municipio = $("#cmbMunicipiosO").val();
                comboOficialia(estado, municipio, distritos);
            });
            $("#cmbMunicipiosO").change(function () {
                estado = $("#cmbEstadosO").val();
                distritos = $("#cmbDistritosO").val();
                municipio = $("#cmbMunicipiosO").val();
                comboOficialia(estado, municipio, distritos);
            });
            //

        });
        $("#rd2").click(function () {
            comboOficialia();
            $("#cmbEstadosJ").val($("#cmbEstadosO").val());
            $("#cmbMunicipiosJ").val($("#cmbMunicipiosO").val());
            $("#cmbDistritosJ").val($("#cmbDistritosO").val());
            $("#divCamposOficialia").hide();
            $("#divCamposJuzgado").show("slow");
            $(".required").remove();

            //
            var estado = "";
            var municipio = "";
            var distritos = "";
            $("#cmbEstadosJ").change(function () {
                estado = $("#cmbEstadosJ").val();
                distritos = $("#cmbDistritosJ").val();
                municipio = $("#cmbMunicipiosJ").val();
                comboMunicipios(estado);
                comboDistritos(estado);
                comboOficialia(estado, municipio, distritos);
            });
            $("#cmbDistritosJ").change(function () {
                estado = $("#cmbEstadosJ").val();
                distritos = $("#cmbDistritosJ").val();
                municipio = $("#cmbMunicipiosJ").val();
                comboOficialia(estado, municipio, distritos);
            });
            $("#cmbMunicipiosJ").change(function () {
                estado = $("#cmbEstadosJ").val();
                distritos = $("#cmbDistritosJ").val();
                municipio = $("#cmbMunicipiosJ").val();
                comboOficialia(estado, municipio, distritos);
            });
            //
        });
        $("#cmbEstadosO").change(function () {
            var estado = $("#cmbEstadosO").val();
            comboMunicipios(estado);
            comboDistritos(estado);
        });
        $("#cmbEstadosJ").change(function () {
            var estado = $("#cmbEstadosO").val();
            comboMunicipios(estado);
            comboDistritos(estado);
        });
    });
    AgregarLista = function () {
        console.log("Hola");
        $(".required").remove();
        var cveOficialia = $("#cmbOficialias").val();
        var agregar = 1;
        var cveMateria = $("#cmbMaterias").val();
        if (cveMateria === "") {
            //alert("Falta campo");
            $('#cmbMaterias').focus();
            $('#cmbMaterias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una materia</label>");
            agregar = 0;
        }
        var cveCuantia = $("#cmbCuantias").val();
        if (cveCuantia === "") {
            //alert("Falta campo");
            $('#cmbCuantias').focus();
            $('#cmbCuantias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una cuantia</label>");
            agregar = 0;
        }
        var cveTipo = $("#cmbTipos").val();
        if (cveTipo === "") {
            //alert("Falta campo");
            $('#cmbTipos').focus();
            $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un tipo</label>");
            agregar = 0;
        }
        if (agregar == 1) {
            var listaJuzgadosMaterias = {};
            var nombreMateria = $("#cmbMaterias option:selected").text();
            listaJuzgadosMaterias["cveMateria"] = cveMateria;
            listaJuzgadosMaterias["nomnbreMateria"] = nombreMateria;
            var nombreCuantia = $("#cmbCuantias option:selected").text();
            listaJuzgadosMaterias["cveCuantia"] = cveCuantia;
            listaJuzgadosMaterias["nomnbreCuantia"] = nombreCuantia;
            var nombreTipo = $("#cmbTipos option:selected").text();
            listaJuzgadosMaterias["cveTipo"] = cveTipo;
            listaJuzgadosMaterias["nomnbreTipos"] = nombreTipo;
            listaJuzgadosMaterias["activo"] = "S";
            listaJuzgadosMaterias["cveAdscripcion"] = $("#hddAdscripcion").val();
            listaJuzgadosMaterias["cveJuzgado"] = $("#hddJuzgado").val();
            listaJuzgadosMaterias["cveJuzgadoMateria"] = "";

            var existe = comprobarExistenciaListado(listaJuzgadosMaterias);
            if (existe == 0) {
                $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Ya existe en la lista no es necesario agregarlo</label>");
            } else {
//                console.log(listado['content'][0]);
                llenarTable("S");
//                limpiarJuzgadosMateria();
            }

        }
    };
    llenarTable = function (activo, idJuzgadoMateria, idJuzgado) {
        
        if (activo === undefined)
            activo = "S"
        if (idJuzgadoMateria === undefined)
            idJuzgadoMateria = "-1";
        if (idJuzgado === undefined)
            idJuzgado = "-1";
        var table = "";
        for (var i = 0; i < listado['content'].length; i++) {
            if(listado['content'][i].activo == "S"){
                console.log("****************************");
                console.log(listado['content'][i].cveJuzgadoMateria);
                console.log(listado['content'][i].cveJuzgado);
//                juzgado.resultados[i].cveJuzgadoMateria, juzgado.cveJuzgad
                if(listado['content'][i].cveJuzgadoMateria != ""){
                    idJuzgadoMateria = listado['content'][i].cveJuzgadoMateria;
                }else{
                    idJuzgadoMateria = "-1";
                }
                if(listado['content'][i].cveJuzgado != ""){
                    idJuzgado = listado['content'][i].cveJuzgado;
                }else{
                    idJuzgado = "-1"; 
                }
                table += "<tr style='cursor: pointer;'>";
                table += "<th style=''><input type='text' value='" + activo + ";" + idJuzgadoMateria + ";" + idJuzgado + ";" + listado['content'][i].cveMateria + ";" + listado['content'][i].cveCuantia + ";" + listado['content'][i].cveTipo + "'></th>";
                table += "<th onclick='seleccionarJuzgadoMateria(" + i + "," + idJuzgadoMateria + "," + idJuzgado + "," + listado['content'][i].cveMateria + "," + listado['content'][i].cveCuantia + "," + listado['content'][i].cveTipo + ")'> " + listado['content'][i].nomnbreMateria + " </th>";
                table += "<th onclick='seleccionarJuzgadoMateria(" + i + "," + idJuzgadoMateria + "," + idJuzgado + "," + listado['content'][i].cveMateria + "," + listado['content'][i].cveCuantia + "," + listado['content'][i].cveTipo + ")'> " + listado['content'][i].nomnbreCuantia + " </th>";
                table += "<th onclick='seleccionarJuzgadoMateria(" + i + "," + idJuzgadoMateria + "," + idJuzgado + "," + listado['content'][i].cveMateria + "," + listado['content'][i].cveCuantia + "," + listado['content'][i].cveTipo + ")'> " + listado['content'][i].nomnbreTipos + " </th>";
                table += "<th> <button onclick='eliminarJuzgadoMateria(" + i + "," + idJuzgadoMateria + "," + idJuzgado + "," + listado['content'][i].cveMateria + "," + listado['content'][i].cveCuantia + "," + listado['content'][i].cveTipo + ")' type='button' class='btn btn-default'><span class='glyphicon glyphicon-trash'></span> </th>";
                table += "</tr>";
            }
        }
        table += "";
        $("#ltsJuzgadosMaterias tbody").html(table);
//        limpiarJuzgadosMateria();
    };
    seleccionarJuzgadoMateria = function (pos, idJuzgadoMateria, idJuzgado, materia, cuantia, tipo) {
        $("#btnAgregar").hide();
        $("#cmbMaterias").val(materia);
        $("#cmbCuantias").val(cuantia);
        $("#cmbTipos").val(tipo);
//        materia = $("#cmbMaterias").val();
//        cuantia = $("#cmbCuantias").val();
//        tipo = $("cmbTipos").val();
        $("#botonesLista").append("<button type='button' class='btn btn-primary' value='Modificar' id='btnModificar' name='btnModificar' onclick='ModificarLista(" + pos + "," + idJuzgadoMateria + "," + idJuzgado + "," + materia + "," + cuantia + "," + tipo + ")' tabIndex='7' title='Boton para agregar relaciones' data-toggle='tooltip' >Modificar</button>");
    };
    eliminarJuzgadoMateria = function (i, idJuzgadoMateria, idJuzgado, materia, cuantia, tipo) {
//        alert("Eliminar Juzgado Materia ");
//        alert(idJuzgadoMateria);
//        alert(idJuzgado);
        for (var i = 0; i < listado['content'].length; i++) {
            if (listado['content'][i].cveCuantia == cuantia && listado['content'][i].cveMateria == materia && listado['content'][i].cveTipo == tipo) {
                console.log(listado['content'][i]);
                if (idJuzgado == "-1" && idJuzgadoMateria == "-1") {
                    console.log(listado['content'][i]);
                    console.log("ELIMINAR ENCONTRO");
                    listado['content'].splice(i, 1);
//                    console.log(listado['content'][i]);
                    llenarTable();
                } else {
                    console.log("inactiva ENCONTRO");
                    console.log(listado['content'][i]);
                    listado['content'][i].activo = "N";
                    console.log(listado['content'][i]);
                    llenarTable();
                }
            }
        }
        return 0;
    };
    ModificarLista = function (pos, idJuzgadoMateria, idJuzgado, materia, cuantia, tipo) {
//        alert("##################"+$("#cmbMaterias").val());
//        alert("pos"+pos);
//        alert("idJuzgadoMateria"+idJuzgadoMateria);
//        alert("idJuzgado"+idJuzgado);
//        alert("materia"+materia);
//        alert("cuantia"+cuantia);
//        alert("tipo"+tipo);
        $("#btnModificar").remove();
        $("#btnAgregar").show();
        for (var i = 0; i < listado['content'].length; i++) {
//            alert("pos1");
//            alert(i);
//            alert("pos2");
            if( pos == i && listado['content'][i].cveJuzgadoMateria == idJuzgadoMateria && listado['content'][i].cveJuzgado == idJuzgado){
//                alert("***************************************************************");
                listado['content'][i].cveMateria = $("#cmbMaterias").val();
                listado['content'][i].nomnbreMateria = $("#cmbMaterias :selected").text();
                listado['content'][i].cveCuantia = $("#cmbCuantias").val();
                listado['content'][i].nomnbreCuantia = $("#cmbCuantias :selected").text();
                listado['content'][i].cveTipo = $("#cmbTipos").val();
                listado['content'][i].nomnbreTipos = $("#cmbTipos :selected").text();
//                alert($("#cmbMaterias :selected").text());
//                alert($("#cmbCuantias :selected").text());
//                alert($("#cmbTipos :selected").text());
            }
            var materiaAux = $("#cmbMaterias").val();
            var cuantiaAux = $("#cmbCuantias").val();
            var tipoAux = $("#cmbTipos").val();
            if( pos == i && idJuzgadoMateria == "-1" && idJuzgado == "-1" ){
//                alert("##################################################################");
                listado['content'][i].cveMateria = $("#cmbMaterias").val();
                listado['content'][i].nomnbreMateria = $("#cmbMaterias :selected").text();
                listado['content'][i].cveCuantia = $("#cmbCuantias").val();
                listado['content'][i].nomnbreCuantia = $("#cmbCuantias :selected").text();
                listado['content'][i].cveTipo = $("#cmbTipos").val();
                listado['content'][i].nomnbreTipos = $("#cmbTipos :selected").text();
//                alert($("#cmbMaterias :selected").text());
//                alert($("#cmbCuantias :selected").text());
//                alert($("#cmbTipos :selected").text());
            }
        }
        limpiarJuzgadosMateria();
//        eliminarJuzgadoMateria(i, idJuzgadoMateria, idJuzgado, materia, cuantia, tipo);
//        AgregarLista();
        llenarTable();
    };
    comprobarExistenciaListado = function (elemento) {
        
        for (var i = 0; i < listado['content'].length; i++) {
            console.log(listado['content'][i]);
            console.log(elemento);
//            alert("exi ?");
//            alert(listado['content'][i].cveCuantia == elemento.cveCuantia);
//            alert(listado['content'][i].cveMateria == elemento.cveMateria);
//            alert(listado['content'][i].cveTipo == elemento.cveTipo);
//            alert("exi !!!!!");
            if(listado['content'][i].cveCuantia == elemento.cveCuantia &&
                    listado['content'][i].cveMateria == elemento.cveMateria &&
                    listado['content'][i].cveTipo == elemento.cveTipo){
//                alert("existe !!!!!!!!!!!!!!!!!");
                return 0;
            }
        }
        listado['content'].push(elemento);
        limpiarJuzgadosMateria();
        return 1;
    };
    limpiarJuzgadosMateria = function () {
        $("#cmbMaterias").val("");
        $("#cmbCuantias").val("");
        $("#cmbTipos").val("");
    };
    guardarAdscripciones = function () {
        $(".required").remove();
        var accion = "";
        var url = "";
        var cveDistrito;
        var cveMunicipio;
        var cveOficialia;
        var cveMateria;
        var cveCuantia;
        var cveTipo;
        var hddAdscripcion = $("#hddAdscripcion").val();
        var guardar = 1;
        var descripcionAdscripcion = $("#txtDescAdscripcion").val();
        var oficialiaAnterior;
        var oficialiaNueva;
        if (descripcionAdscripcion === "") {
            //alert("Falta campo");
            $('#txtDescAdscripcion').focus();
            $('#txtDescAdscripcion').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripci&oacute;n de la adscripci&oacute;n</label>");
            guardar = 0;
//            alert("descripcion adscripcion 0");
        }
        var descripcionJuzgado = $("#txtDescJuzgado").val();
        if (descripcionJuzgado === "") {
            //alert("Falta campo");
            $('#txtDescJuzgado').focus();
            $('#txtDescJuzgado').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripci&oacute;n de la adscripci&oacute;n</label>");
            guardar = 0;
//            alert("descripcion adscripcion 0");
        }
        
        var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
//        alert(tipoAdscripcion);
        if (tipoAdscripcion == null) {
            $('input:radio[name=rd]').focus();
            $('input:radio[name=rd]').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un tipo de adscripci&oacute;n</label>");
            guardar = 0;
//            alert("tipo  adscripcion");
        }
        if ($('input:radio[name=rd]:checked').val() === "O") {
            accion = "guardar-oficialia";
            cveMunicipio = $("#cmbMunicipiosO").val();
            var descripcionOficialia = $("#txtDescOficialia").val();
            if (descripcionOficialia === "") {
                //alert("Falta campo");
                $('#txtDescOficialia').focus();
                $('#txtDescOficialia').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripci&oacute;n de la oficialia</label>");
                guardar = 0;
//                alert("descripcion oficialia");
            }
            if (cveMunicipio === "") {
                //alert("Falta campo");
                $('#cmbMunicipiosO').focus();
                $('#cmbMunicipiosO').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un municipio</label>");
                guardar = 0;
//                alert("O municipio  adscripcion");
            }
            cveDistrito = $("#cmbDistritosO").val();
            if (cveDistrito === "") {
                //alert("Falta campo");
                $('#cmbDistritosO').focus();
                $('#cmbDistritosO').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un distrito</label>");
                guardar = 0;
//                alert("O distrito  adscripcion");
            }
        }
        if ($('input:radio[name=rd]:checked').val() === "J") {
            accion = "guardar-juzgado";
            cveOficialia = $("#cmbOficialias").val();
            if (cveOficialia === "") {
                alert("vacio oficialia");
//                $('#cmbOficialias').focus();
//                $('#cmbOficialias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una oficialia</label>");
                guardar = 0;
//                alert("J oficialia adscripcion");
            }
            cveMateria = $("#cmbMaterias").val();
            if (cveMateria === "") {
                //alert("Falta campo");
//                $('#cmbMaterias').focus();
//                $('#cmbMaterias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una materia</label>");
//                guardar = 0;
//                alert("Materias J adscripcion");
            }
            cveCuantia = $("#cmbCuantias").val();
            if (cveCuantia === "") {
//                alert("Falta cuantia");
//                $('#cmbCuantias').focus();
//                $('#cmbCuantias').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una cuantia</label>");
//                guardar = 0;
            }
            cveTipo = $("#cmbTipos").val();
            if (cveTipo === "") {
                //alert("Falta campo");
//                $('#cmbTipos').focus();
//                $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar un tipo</label>");
//                guardar = 0;
//                alert("J Tipos adscripcion");
            }
            if (listado['content'].length == 0) {
//                alert("listado es vacio 0");
                guardar = 0;
                $('#divListado').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe agregar elementos</label>");
            }
//            alert("OFICIALIA ANTERIOR; " + $("#hddOficialiaAnterior").val());
            oficialiaAnterior = $("#hddOficialiaAnterior").val();
//            alert("   OFICIALIA NUEVA; " + $("#cmbOficialias").val());
            oficialiaNueva = $("#cmbOficialias").val();
        }
        var tipo = $('input:radio[name=rd]:checked').val();
        var hddOficialia = $("#hddOficialia").val();
        var hddJuzgado = $("#hddJuzgado").val();
        var hddTipoAdscripcionAnterior = $("#hddTipoAnterior").val();
//        alert(tipo);
        var data;
        if ($('input:radio[name=rd]:checked').val() === "O") {
            console.log($("#cmbMunicipiosO").val());
            console.log($("#cmbDistritosO").val());
            data = {
                accion: accion,
                cveAdscripcion: hddAdscripcion,
                desAdscripcion: descripcionAdscripcion,
                cveOficialia: hddOficialia,
                cveDistrito: cveDistrito,
                cveMunicipio: cveMunicipio,
                desOfificialia:descripcionOficialia,
                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
                tipoAdscripcion: tipo
            };
        }
        if ($('input:radio[name=rd]:checked').val() === "J") {
            console.log("*******");
            console.log($("#txtDescAdscripcion").val());
            console.log($("#cmbOficialias").val());
            console.log(listado);
            data = {
                accion: accion,
                cveAdscripcion: hddAdscripcion,
                desAdscripcion: descripcionAdscripcion,
                desJuzgado: descripcionJuzgado,
                cveJuzgado: hddJuzgado,
                cveOficialia: cveOficialia,
                listaJuzgadoMateria: JSON.stringify(listado),
                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
                tipoAdscripcion: tipo
            };
        }
//        alert(guardar);
        console.log(data);
        if (guardar == 1) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
                data: data,
                async: true,
                dataType: "json",
                beforeSend: function (objeto) {
                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                },
                success: function (datos) {
//                    alert(datos);
                    try {
                        if (datos.totalCount > 0) {
//                            alert("TIPO ADAS " + datos);
                            $(".required").remove();
//                            alert(datos.cveOficialia);
//                            alert(datos.cveJuzgado);
                            $("#hddAdscripcion").val(datos.cveAdscripcion);
                            if (datos.tipoAdscripcion == "O") {
                                $("#hddOficialia").val(datos.cveOficialia);
                                $("#hddTipoAnterior").val(datos.tipoAdscripcion);
                            }
                            if (datos.tipoAdscripcion == "J") {
                                $("#hddJuzgado").val(datos.cveJuzgado);
                                $("#hddTipoAnterior").val(datos.tipoAdscripcion);
                            }

                            $("#btnAdscripcionesEliminar").show();
                            //alert(datos.text);
                            $("#divHideForm").hide();
                            $("#divAlertSucces").html("Correcto!: " + datos.text);
                            $("#divAlertSucces").show("slide");
//                            consultaAdscripciones(1);
//                            limpiaAdscripciones();
                            var tipoAdscripcionConsulta = $('input:radio[name=rd]:checked').val();
//                            alert(tipoAdscripcionConsulta);
                            if (tipoAdscripcionConsulta == "O") {
                                consultaAdscripciones(1);
//                                limpiaAdscripciones();
                            }
                            if (tipoAdscripcionConsulta == "J") {
//                                alert("HOLA");
                                consultaAdscripciones(1);
                                limpiaAdscripciones();
                            }
                            
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
    regresarTable = function(){
        changeDivForm(2);
    };
    changeDivForm = function (n) {
        $(".required").remove();
        if (n == 1) {
            $("#divFormulario").show();
            $("#divConsulta").hide();
        }
        if(n == 2){
            $("#divCamposReasignarJuzgado").hide("slow");
            $("#divConsulta").show("slow");
        }
    };
    limpiaAdscripciones = function () {
        comboOficialia();
        comboMaterias();
        comboCuantias();
        comboTipos();
        comboEstados();
        listado = {};
        listado['content'] = [];
        llenarTable();
        $("#divCamposJuzgado").hide("slow");
        $("#divCamposOficialia").hide("slow");
        $("#cmbEstadosO").val("");
        $("#cmbMunicipiosO").val("");
        $("#cmbDistritosO").val("");
        $("#cmbEstadosJ").val("");
        $("#cmbMunicipiosJ").val("");
        $("#cmbDistritosJ").val("");
        $("#txtDescAdscripcion").val("");
        $("#hddAdscripcion").val("");
        $("#cmbOficialias").val("");
        $("#cmbMaterias").val("");
        $("#cmbCuantias").val("");
        $("#cmbTipos").val("");
        $("[name = 'rd']").prop('checked', false);
        $("#btnAdscripcionesEliminar").hide();
        $(".required").remove();
        $("#txtDescOficialia").val("");
        $("#txtDescJuzgado").val("");
        $("#cmbEstadosJ").val("");
        $("#cmbMunicipiosJ").val("");
        $("#cmbDistritosJ").val("");
        $("#cmbOficialias").val("");
        $("#cmbMaterias").val("");
        $("#cmbCuantias").val("");
        $("#cmbTipos").val("");
        $("#hddAdscripcion").val("");
        $("#hddJuzgado").val("");
        $("#hddOficialia").val("");
        $("#hddTipoAnterior").val("");
        $("#hddOficialiaAnterior").val("");
        $("#hddJuzgadoReasignar").val("");
        $("#txtDescJuzgadoReasignar").val("");
        $("#cmbAdscripciones").val("");
        $("#cmbOficialiasReasignar").val("");
//        $("#txtDescOficialia").val();
//        $("#txtDescOficialia").val();
//        $("#txtDescJuzgado").val();
    };
    bajaAdscripciones = function () {
        $(".required").remove();
        var data;
        var actual = "";
        var TipEliminar;
        //## PARA VERIFICAR LA ELEIMINACION
        var hddAdscripcion = $("#hddAdscripcion").val();
        var esOficialia = $("#hddOficialia").val();
        var esJuzgado = $("#hddJuzgado").val();
        var accion = "";
        var hddTipoAdscripcionAnterior = $("#hddTipoAnterior").val();
//        alert(hddTipoAdscripcionAnterior);
        if (esOficialia != "") {
            TipEliminar = "OFICIALIA";
            actual = "OFICIALIA: " + $("#txtDescOficialia").val();
            accion = "eliminar-guardar-oficialia";
//            alert("Es oficialia");
            var desAdscripcionOficialia = $("#txtDescAdscripcion").val();
            var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
            var DescOficialia = $("#txtDescOficialia").val();
            var estadoO = $("#cmbEstadosO").val();
            var municipioO = $("#cmbMunicipiosO").val();
            var distritoO = $("#cmbDistritosO").val();
            data =  {
                cveAdscripcion: hddAdscripcion,
                accion: "eliminar-guardar-Adscripcion",
                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
                activo: "N",
                esOficialia: esOficialia, 
                adscripcion: "true"
            };
        } else if (esJuzgado != "") {
            TipEliminar = "JUZGADO";
            actual = "JUZGADO: " + $("#txtDescJuzgado").val();
            accion = "eliminar-guardar-juzgado";
            data =  {
                cveAdscripcion: hddAdscripcion,
                accion: "eliminar-guardar-Adscripcion",
                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
                activo: "N",
                esJuzgado: esJuzgado, 
                adscripcion: "true"
            };
            
        }
        if (hddAdscripcion != "") {
            bootbox.dialog({
                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar la adscripci&oacute;n ?",
                buttons: {
                    danger: {
                        label: "Eliminar ADSCRIPCI&Oacute;N",
                        className: "btn-primary",
                        callback: function () {
//                            data =  {
//                                cveAdscripcion: hddAdscripcion,
//                                accion: "eliminar-guardar-Adscripcion",
//                                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
//                                activo: "N",
//                                esOficialia: esOficialia, 
//                                adscripcion: "true"
//                            };
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
                                data: data,
                                async: true,
                                dataType: "json",
                                beforeSend: function (objeto) {
                                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                                },
                                success: function (datos) {
                                    try {
                                        //alert(datos.text);
                                        limpiaAdscripciones();
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
//            bootbox.dialog({
//                message: "Advertencia!! <br><br> ¿ Qu&eacute; desea eliminar ?",
//                buttons: {
//                    danger: {
//                        label: "Eliminar Adscripcion",
//                        className: "btn-primary",
//                        callback: function () {
//                            bootbox.dialog({
//                                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar la adscripci&oacute;n ?",
//                                buttons: {
//                                    danger: {
//                                        label: "Eliminar ADSCRIPCI&Oacute;N",
//                                        className: "btn-primary",
//                                        callback: function () {
//                                            data =  {
//                                                cveAdscripcion: hddAdscripcion,
//                                                accion: "eliminar-guardar-Adscripcion",
//                                                TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
//                                                activo: "N",
//                                                esOficialia: esOficialia, 
//                                                adscripcion: "true"
//                                            };
//                                            $.ajax({
//                                                type: "POST",
//                                                url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
//                                                data: data,
//                                                async: true,
//                                                dataType: "json",
//                                                beforeSend: function (objeto) {
//                                                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
//                                                },
//                                                success: function (datos) {
//                                                    try {
//                                                        //alert(datos.text);
//                                                        limpiaAdscripciones();
//                                                        //document.getElementById('divGeneros').innerHTML = "";
//                                                        $("#divHideForm").hide();
//                                                        $("#divAlertSucces").html("Correcto!: " + datos.text + " (Eliminado) ");
//                                                        $("#divAlertSucces").show("slide");
//                                                        setTimeAlert("divAlertSucces");
//                                                    } catch (e) {
//                                                        $("#divAlertDager").html("Error en la peticion:\n\n" + datos.text);
//                                                        $("#divAlertDager").show("slide");
//                                                        setTimeAlert("divAlertDager");
//                                                    }
//                                                },
//                                                error: function (objeto, quepaso, otroobj) {
//                                                }
//                                            });
//                                        }
//                                    },
//                                    success: {
//                                        label: "Cancelar",
//                                        className: "btn-primary",
//                                        callback: function () {
//
//                                        }
//                                    }
//                                }
//                            });
//                        }
//                    },
//                    success: {
//                        label: "Eliminar "+ TipEliminar,
//                        className: "btn-primary",
//                        callback: function () {
//                            bootbox.dialog({
//                                message: "Advertencia!! <br><br> ¿ Est&aacute; seguro de eliminar "+actual+" ?",
//                                buttons: {
//                                    danger: {
//                                        label: "Eliminar " + TipEliminar,
//                                        className: "btn-primary",
//                                        callback: function () {
//                                            if(esOficialia != ""){
////                                                alert("DATA OFICIALIA");
//                                                data =  {
//                                                    cveAdscripcion: hddAdscripcion,
//                                                    accion: "eliminar-guardar-Adscripcion-OJ",
//                                                    TipoAdscripcionAnterior: hddTipoAdscripcionAnterior,
//                                                    activo: "N",
//                                                    esOficialia: esOficialia,
//                                                    adscripcion: "false",
//                                                    oj: "true"
//                                                };
//                                            }
//                                            if(esJuzgado != ""){
////                                                alert("DATA JUZGADO");
//                                            }
//                                            $.ajax({
//                                                type: "POST",
//                                                url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
//                                                data: data,
//                                                async: true,
//                                                dataType: "json",
//                                                beforeSend: function (objeto) {
//                                                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
//                                                },
//                                                success: function (datos) {
//                                                    try {
//                                                        //alert(datos.text);
//                                                        limpiaAdscripciones();
//                                                        //document.getElementById('divGeneros').innerHTML = "";
//                                                        $("#divHideForm").hide();
//                                                        $("#divAlertSucces").html("Correcto!: " + datos.text + " (Eliminado) ");
//                                                        $("#divAlertSucces").show("slide");
//                                                        setTimeAlert("divAlertSucces");
//                                                    } catch (e) {
//                                                        $("#divAlertDager").html("Error en la peticion:\n\n" + datos.text);
//                                                        $("#divAlertDager").show("slide");
//                                                        setTimeAlert("divAlertDager");
//                                                    }
//                                                },
//                                                error: function (objeto, quepaso, otroobj) {
//                                                }
//                                            });
//                                        }
//                                    },
//                                    success: {
//                                        label: "Cancelar",
//                                        className: "btn-primary",
//                                        callback: function () {
//
//                                        }
//                                    }
//                                }
//                            });
//                        }
//                    }
//                }
//            });
        } else {
            //alert("No se ha seleccionado ningun registro");
        }
    };
    seleccionaAdscripcionesModificar = function (cveAdscripcion, descAdscripcion, tipoAdscripcion, cveOficialia, cveJuzgado) {
        $(".required").remove();
        $("#divConsulta").hide();
        $("#divFormulario").show();
        $("#txtDescAdscripcion").val(descAdscripcion);
        $("[name = 'rd'][value='" + tipoAdscripcion.substr(0, 1) + "']").prop('checked', true);
        $("#hddAdscripcion").val(cveAdscripcion);
        $("#btnAdscripcionesEliminar").show();
        if (tipoAdscripcion == "OFICIALIA") {
            $("#hddOficialia").val(cveOficialia);
            $("#hddTipoAnterior").val("O");
        }
        if (tipoAdscripcion == "JUZGADO") {
            $("#hddJuzgado").val(cveJuzgado);
            $("#hddTipoAnterior").val("J");
        }
    };
    getPaginas = function (pag, cantReg) {
        var desAdscripcion = $("#txtDescAdscripcion").val();
        var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
        //var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        var estado = $("#cmbEstados").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
            data: {
                desAdscripcion: desAdscripcion,
                tipoAdscripcion: tipoAdscripcion,
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
    consultaAdscripciones = function (pDefault) {
        $(".required").remove();
        $(".alert").hide();
        var descAdscripciones = $("#txtDescAdscripcion").val();
        var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
        var table = "";
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $("#cmbPaginacion").val(1);
        if (pDefault != null) {
            pag = 1;
        }
        var estadoO = $("#cmbEstadosO").val();
        var municipioO = $("#cmbMunicipiosO").val();
        var distritoO = $("#cmbDistritosO").val();
        var data;
        var activosOption = $("#cmbActivos").val();
        if ($('input:radio[name=rd]:checked').val() === "O") {
            console.log($("#cmbMunicipiosO").val());
            console.log($("#cmbDistritosO").val());
            data = {
                accion: "consultar-paginacion",
                tipoAdscripcion: tipoAdscripcion,
                desAdscripcion: descAdscripciones,
                cveEstado: estadoO,
                cveDistrito: distritoO,
                cveMunicipio: municipioO,
                cantxPag: cantReg,
                pag: pag,
                activo: activosOption
            };
        }
        var estadoJ = $("#cmbEstadosJ").val();
        var municipioJ = $("#cmbMunicipiosJ").val();
        var distritoJ = $("#cmbDistritosJ").val();
        var oficialiaJ = $("#cmbOficialias").val();
        var materiaJ = $("#cmbMaterias").val();
        var cuantiaJ = $("#cmbCuantias").val();
        var tipoJ = $("#cmbTipos").val();
        var hddAdscripcionJuzgado = $("#hddAdscripcion").val();
        var hddJuzgadoBusqueda = $("#hddJuzgado").val();
        var txtDescJuzgado = $("#txtDescJuzgado").val();
        var cmbMaterias = $("#cmbMaterias").val();
        var cmbCuantias = $("#cmbCuantias").val();
        var cmbTipos = $("#cmbTipos").val();
        if ($('input:radio[name=rd]:checked').val() === "J") {
            console.log("*******");
            console.log($("#txtDescAdscripcion").val());
            console.log($("#cmbOficialias").val());
            console.log(listado);
            data = {
                accion: "consultar-paginacion",
                hddAdscripcionJuzgado: hddAdscripcionJuzgado,
                hddJuzgadoBusqueda: hddJuzgadoBusqueda,
                txtDescJuzgado: txtDescJuzgado,
                tipoAdscripcion: tipoAdscripcion,
                cveEstado: estadoJ,
                cveMunicipio: municipioJ,
                cveDistrito: distritoJ,
                cveOficialia: oficialiaJ,
                cveMateria: materiaJ,
                cveCuantia: cuantiaJ,
                cveTipo: tipoJ,
                cantxPag: cantReg,
                pag: pag,
                activo: "S"
            };
        }
        if (tipoAdscripcion === undefined) {
            data = {
                accion: "consultar-paginacion",
                tipoAdscripcion: "",
                cantxPag: cantReg,
                pag: pag,
                activo: "S"
            };
        }
//        {
//                desAdscripcion: descAdscripciones,
//                tipoAdscripcion: tipoAdscripcion,
//                accion: "consultar-paginacion",
//                cantxPag: cantReg,
//                pag: pag,
//                activo: "S"
//            }
        console.log(data);
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
            data: data,
            async: true,
            dataType: "json",
            beforeSend: function (objeto) {
                //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
            },
            success: function (datos) {
                console.log(datos);
                if(datos.tipo == "oficialia") {
//                    alert("ES OFICIALIA PARA IMPRIMIR LA TABLA");
                    if (datos.totalCount > 0) {
                        //alert("Entra");
                        table += "<table id='tblResultadosGrid' class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Adscripci&oacute;n'>";
                        table += "<thead>";
                        table += "<tr>";
                        table += "<th><strong>N&uacute;m.</strong></th>";
                        table += "<th><strong>Descripci&oacute;n</strong></th>";
                        table += "</tr>";
                        table += "</thead>";
                        table += "<tbody>";
                        for (var i = 0; i < datos.totalCount; i++) {
                            var JSONAdscripcion = JSON.stringify(datos.resultados[i]);
//                            alert();
    //                        if(datos.resultados[i].totalJuzgado > 0){
                            table += "<tr id='rowhide"+i+"'>";
                            table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(i) + 1)) + "</td>";
                            table += "<td>";
                            table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Adscripci&oacute;n | Oficialia 2'>"; //table para adscripcion y oficialia
                            table += "<tr>";
                            if(datos.resultados[i].adsactivo == "N")
                                table += "<td class='seleccionadoAdscripcion' data-toggle='tooltip' data-placement='right' title='Clic para editar la adscripci&oacute;n: "+datos.resultados[i].desAdscripcion+"'><strong>Adscripcion: </strong> " + datos.resultados[i].desAdscripcion + "<p class='bg-danger' style='color: rgb(255, 255, 255);'> Adscripci&oacute;n eliminada, los juzgados tiene que ser reasignados</p></td>";
                            else
                                table += "<td onclick='seleccionarAdscripcionModificar("+JSONAdscripcion+")' class='seleccionadoAdscripcion' data-toggle='tooltip' data-placement='right' title='Clic para editar la adscripci&oacute;n: "+datos.resultados[i].desAdscripcion+"'><strong>Adscripcion: </strong> " + datos.resultados[i].desAdscripcion + "</td>";

                            table += "</tr>";
                            table += "<tr>";
                            if(datos.resultados[i].ofiactivo == "N")
                                table += "<td class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Oficialia:</strong> "+datos.resultados[i].desOficilia+" <p class='bg-danger' style='color: rgb(255, 255, 255);'> Oficialia eliminada, los juzgados tiene que ser reasignados</p>";
                            else
                                table += "<td onclick='seleccionarOficialiaModificar("+JSONAdscripcion+")' class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Oficialia:</strong> "+datos.resultados[i].desOficilia+"";

                            table += "</td>";
                            table += "</tr>";

                            table += "<tr>";
                            if(datos.resultados[i].ofiactivo == "N")
                                table += "<td class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Distrito:</strong> "+datos.resultados[i].desDistrito+"";
                            else    
                                table += "<td onclick='seleccionarOficialiaModificar("+JSONAdscripcion+")' class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Distrito:</strong> "+datos.resultados[i].desDistrito+"";
                            table += "</td>";
                            table += "</tr>";

                            table += "<tr>";
                            if(datos.resultados[i].ofiactivo == "N")
                                table += "<td class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Municipio:</strong> "+datos.resultados[i].desMunicipio+"";
                            else
                                table += "<td onclick='seleccionarOficialiaModificar("+JSONAdscripcion+")' class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Municipio:</strong> "+datos.resultados[i].desMunicipio+"";
                            table += "</td>";
                            table += "</tr>";

                            table += "<tr>";
                            if(datos.resultados[i].ofiactivo == "N")
                                table += "<td class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Estado:</strong> "+datos.resultados[i].desEstado+"";
                            else    
                                table += "<td onclick='seleccionarOficialiaModificar("+JSONAdscripcion+")' class='seleccionadoOficialia' data-toggle='tooltip' data-placement='right' title='Clic para editar la oficialia: "+datos.resultados[i].desOficilia+"'><strong>Estado:</strong> "+datos.resultados[i].desEstado+"";
                            table += "</td>";
                            table += "</tr>";

                            for (var j = 0; j < datos.resultados[i].Juzgado[0].totalCountJuzgado; j++) {
                                /*Juzgados*/
                                var tableJuzgados = "";
                                table += "<tr>";
                                table += "<td>";
                                var JSONJuzgado = JSON.stringify(datos.resultados[i].Juzgado[0].resultados[j]);

                                if(datos.resultados[i].Juzgado[0].resultados[j].totalCountJuzgadoMateria == 0){
                                    table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado'>";//table para juzgados dentro de oficialia
                                    table += "<tr>";
                                    table += "<td onclick='seleccionarJuzgadoModificar("+JSONAdscripcion+")'><p class='bg-warning'><strong>JUZGADO:</strong>" + datos.resultados[i].Juzgado[0].resultados[j].desJuzgado + "</p> ";
                                    table += "</td>";
                                    table += "</tr>";
                                }else{
                                    table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado'>";//table para juzgados dentro de oficialia
                                    table += "<tr>";
                                    if(datos.resultados[i].ofiactivo == "N")
                                        table += "<td><p class='bg-primary'><strong>JUZGADO:</strong>" + datos.resultados[i].Juzgado[0].resultados[j].desJuzgado + "</p> <button type='button' class='btn btn-primary btn-xs' style='float: right;' onclick='reasignarJuzgado("+JSONJuzgado+")'>Reasignar</button>";
                                    else
                                        table += "<td><p onclick='seleccionarJuzgadoModificar("+JSONAdscripcion+", "+JSONJuzgado+")' class='bg-primary'><strong>JUZGADO:</strong>" + datos.resultados[i].Juzgado[0].resultados[j].desJuzgado + "</p> <button type='button' class='btn btn-primary btn-xs' style='float: right;' onclick='cambiarJuzgado("+JSONJuzgado+", "+datos.resultados[i].cveOficialia+", "+ datos.resultados[i].cveAdscripcion +")'>Cambiar de oficialia/adscripci&oacute;n</button>";
                                    table += "</td>";
                                    table += "</tr>";
                                }


                                table += "<tr>";
                                table += "<td>";

                                    for(var k = 0; k < datos.resultados[i].Juzgado[0].resultados[j].totalCountJuzgadoMateria; k++){
                                        table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado | Materias'>"; //table para juzgados materias 
                                        table += "<tr>";
                                        table += "<td><strong>Materia:</strong> "+datos.resultados[i].Juzgado[0].resultados[j].resultados[k].desMateria+" <br></td>";
                                        table += "<td><strong>Cuantia:</strong> "+datos.resultados[i].Juzgado[0].resultados[j].resultados[k].desCuantia+" <br></td>";
                                        table += "<td><strong>   Tipo:</strong> "+datos.resultados[i].Juzgado[0].resultados[j].resultados[k].desTipo+" <br></td>";
                                        table += "</tr>";
                                        table += "</table>";
                                    }
                                table += "</td>";
                                table += "</tr>";

                                table += "</table>";
                                table += "</td>";
                                table += "</tr>";
                                /*Juzgados Fin*/
                            }

                            table += "</table>";
                            table += "</td>";
                            table += "</tr>";
    //                        }
                        }
                        table += "</tbody>";
                        table += "</table>";
    //                    $('#rowhide6').hide();
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
                }else if(datos.tipo == "juzgado"){
//                    alert("ES JUZGADO PARA IMPRIMIR LA TABLA");
                    if (datos.resultados[0].Juzgado[0].totalCountJuzgado > 0) {
                        table += "<table id='tblResultadosGrid' class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Adscripci&oacute;n'>";
                        table += "<thead>";
                        table += "<tr>";
                        table += "<th><strong>N&uacute;m.</strong></th>";
                        table += "<th><strong>Descripci&oacute;n</strong></th>";
                        table += "</tr>";
                        table += "</thead>";
                        table += "<tbody>";
                            for (var j = 0; j < datos.resultados[0].Juzgado[0].totalCountJuzgado; j++) {
                                /*Juzgados*/
                                var tableJuzgados = "";
                                table += "<tr>";
                                table += "<td>" + (parseInt((cantReg * (pag - 1))) + (parseInt(j) + 1)) + "</td>";
                                table += "<td>";
                                var JSONJuzgado = JSON.stringify(datos.resultados[0].Juzgado[0].resultados[j]);
                                if(datos.resultados[0].Juzgado[0].resultados[j].totalCountJuzgadoMateria == 0){
                                    table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado'>";//table para juzgados dentro de oficialia
                                    table += "<tr>";
                                    table += "<td onclick='seleccionarJuzgadoUnicoModificar("+JSONJuzgado+")'><p class='bg-warning'><strong>JUZGADO:</strong>" + datos.resultados[0].Juzgado[0].resultados[j].desJuzgado + "</p> ";
                                    table += "</td>";
                                    table += "</tr>";
                                }else{
                                    table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado'>";//table para juzgados dentro de oficialia
                                    table += "<tr>";
                                    if(datos.resultados[0].ofiactivo == "N")
                                        table += "<td><p class='bg-primary'><strong> # JUZGADO:</strong>" + datos.resultados[0].Juzgado[0].resultados[j].desJuzgado + "</p>";
                                    else
                                        table += "<td onclick='seleccionarJuzgadoUnicoModificar("+JSONJuzgado+")'><p class='bg-primary'><strong> JUZGADO:</strong>" + datos.resultados[0].Juzgado[0].resultados[j].desJuzgado + "</p>";
                                    table += "</td>";
                                    table += "</tr>";
                                }
                                table += "<tr>";
                                table += "<td>";
                                    for(var k = 0; k < datos.resultados[0].Juzgado[0].resultados[j].totalCountJuzgadoMateria; k++){
                                        table += "<table class='table table-hover table-striped table-bordered' data-toggle='tooltip' data-placement='right' title='Juzgado | Materias'>"; //table para juzgados materias 
                                        table += "<tr>";
                                        table += "<td><strong>Materia:</strong> "+datos.resultados[0].Juzgado[0].resultados[j].resultados[k].desMateria+" <br></td>";
                                        table += "<td><strong>Cuantia:</strong> "+datos.resultados[0].Juzgado[0].resultados[j].resultados[k].desCuantia+" <br></td>";
                                        table += "<td><strong>   Tipo:</strong> "+datos.resultados[0].Juzgado[0].resultados[j].resultados[k].desTipo+" <br></td>";
                                        table += "</tr>";
                                        table += "</table>";
                                    }
                                table += "</td>";
                                table += "</tr>";

                                table += "</table>";
                                table += "</td>";
                                table += "</tr>";
                                /*Juzgados Fin*/
                            }
                            table += "</table>";
                            table += "</td>";
                            table += "</tr>";
                        table += "</tbody>";
                        table += "</table>";
    //                    $('#rowhide6').hide();
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
                    $('#cmbDistritosO').empty();
                    $('#cmbDistritosJ').empty();
                    $('#cmbDistritosO').append('<option value="">Seleccione una opcion</option>');
                    $('#cmbDistritosJ').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbDistritosO').append('<option value="' + object.cveDistrito + '">' + object.desDistrito + '</option>');
                            $('#cmbDistritosJ').append('<option value="' + object.cveDistrito + '">' + object.desDistrito + '</option>');
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
                    $('#cmbMunicipiosO').empty();
                    $('#cmbMunicipiosJ').empty();
                    $('#cmbMunicipiosO').append('<option value="">Seleccione una opcion</option>');
                    $('#cmbMunicipiosJ').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbMunicipiosO').append('<option value="' + object.cveMunicipio + '">' + object.desMunicipio + '</option>');
                            $('#cmbMunicipiosJ').append('<option value="' + object.cveMunicipio + '">' + object.desMunicipio + '</option>');
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
                    $('#cmbEstadosO').empty();
                    $('#cmbEstadosJ').empty();
                    $('#cmbEstadosO').append('<option value="">Seleccione una opcion</option>');
                    $('#cmbEstadosJ').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbEstadosO').append('<option value="' + object.cveEstado + '">' + object.desEstado + '</option>');
                            $('#cmbEstadosJ').append('<option value="' + object.cveEstado + '">' + object.desEstado + '</option>');
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
    comboAdscripciones = function () {
        //        alert(estado);
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
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
    seleccionarAdscripcionModificar = function (adscripcion){
//        alert("seleccionarAdscripcionModificar");
//        $("input:radio[name=rd]").attr('checked', true);
//        $("[name = 'rd'][value='O']").prop('checked', true);
        $("#btnAdscripcionesEliminar").show();
        $("#hddTipoAnterior").val("O");
        console.log(adscripcion);
        changeDivForm(1);
        $("#txtDescAdscripcion").val(adscripcion.desAdscripcion);
        var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
        if(tipoAdscripcion == "O"){
//            alert("O");
            $("#txtDescOficialia").val(adscripcion.desOficilia);
            $("#cmbEstadosO").val(adscripcion.cveEstado);
            var estado = $("#cmbEstadosO").val();
            comboMunicipios(estado);
            comboDistritos(estado);
            $("#cmbMunicipiosO").val(adscripcion.cveMunicipio);
            $("#cmbDistritosO").val(adscripcion.cveDistrito);
            $("#hddAdscripcion").val(adscripcion.cveAdscripcion);
            $("#hddOficialia").val(adscripcion.cveOficialia);
        }else if(tipoAdscripcion == "J"){
//            alert("J");
        }
    };
    seleccionarOficialiaModificar = function (adscripcion){
//        alert("seleccionarOficialiaModificar");
        $("#btnAdscripcionesEliminar").show();
        console.log(adscripcion);
        changeDivForm(1);
        $("#hddTipoAnterior").val("O");
        $("#txtDescAdscripcion").val(adscripcion.desAdscripcionv);
        var tipoAdscripcion = $('input:radio[name=rd]:checked').val();
        if(tipoAdscripcion == "O"){
//            alert("O");
            $("#txtDescOficialia").val(adscripcion.desOficilia);
            $("#cmbEstadosO").val(adscripcion.cveEstado);
            var estado = $("#cmbEstadosO").val();
            comboMunicipios(estado);
            comboDistritos(estado);
            $("#cmbMunicipiosO").val(adscripcion.cveMunicipio);
            $("#cmbDistritosO").val(adscripcion.cveDistrito);
            $("#hddAdscripcion").val(adscripcion.cveAdscripcion);
            $("#hddOficialia").val(adscripcion.cveOficialia);
        }else if(tipoAdscripcion == "J"){
//            alert("J");
            
            
        }
    };
    seleccionarJuzgadoUnicoModificar = function (juzgado){
        console.log(juzgado);
        changeDivForm(1);
        $("#btnAdscripcionesEliminar").show();
        $("#hddTipoAnterior").val("J");
        $("[name = 'rd'][value='J']").prop('checked', true);
        $("#divCamposOficialia").hide("slow");
        $("#divCamposJuzgado").show("slow");
        $("#txtDescAdscripcion").val(juzgado.desAdscripcion);
        $("#hddAdscripcion").val(juzgado.cveAdscripcion);
        $("#cmbOficialias").val(juzgado.cveOficialia);
        $("#txtDescJuzgado").val(juzgado.desJuzgado);
        
        $("#hddJuzgado").val(juzgado.cveJuzgado);
        $("#txtDescJuzgado").val(juzgado.desJuzgado);
        $("#hddOficialiaAnterior").val(juzgado.cveOficialia);
        for(var i = 0; i < juzgado.totalCountJuzgadoMateria; i++){
            var listaJuzgadosMaterias = {};
            var nombreMateria = juzgado.resultados[i].desMateria;
            listaJuzgadosMaterias["cveMateria"] = juzgado.resultados[i].cveMateria;
            listaJuzgadosMaterias["nomnbreMateria"] = nombreMateria;
            var nombreCuantia = juzgado.resultados[i].desCuantia;
            listaJuzgadosMaterias["cveCuantia"] = juzgado.resultados[i].cveCuantia;
            listaJuzgadosMaterias["nomnbreCuantia"] = nombreCuantia;
            var nombreTipo = juzgado.resultados[i].desTipo;
            listaJuzgadosMaterias["cveTipo"] = juzgado.resultados[i].cveTipo;
            listaJuzgadosMaterias["nomnbreTipos"] = nombreTipo;
            listaJuzgadosMaterias["activo"] = "S";
            listaJuzgadosMaterias["cveAdscripcion"] = juzgado.cveAdscripcion;
            listaJuzgadosMaterias["cveJuzgado"] = juzgado.cveJuzgado;
            listaJuzgadosMaterias["cveJuzgadoMateria"] = juzgado.resultados[i].cveJuzgadoMateria;
            
            var existe = comprobarExistenciaListado(listaJuzgadosMaterias);
            if (existe == 0) {
                $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Ya existe en la lista no es necesario agregarlo</label>");
            } else {
//                alert(juzgado.resultados[i].cveJuzgadoMateria);
//                alert(juzgado.cveJuzgado);
                llenarTable("S",juzgado.resultados[i].cveJuzgadoMateria, juzgado.cveJuzgado);
            }
        }
    };
    seleccionarJuzgadoModificar = function (adscripcion, juzgado){
//        alert("seleccionarJuzgadoModificar");
        $("#btnAdscripcionesEliminar").show();
        console.log(adscripcion);
        console.log(juzgado);
        changeDivForm(1);
        $("#hddTipoAnterior").val("J");
        $("[name = 'rd'][value='J']").prop('checked', true);
        $("#divCamposOficialia").hide("slow");
        $("#divCamposJuzgado").show("slow");
        $("#txtDescAdscripcion").val(juzgado.desAdscripcion);
        $("#hddAdscripcion").val(juzgado.cveAdscripcion);
//        $("#hddOficialia").val(adscripcion.cveOficialia);
        $("#cmbOficialias").val(adscripcion.cveOficialia);
//        ("#cmbOficialias").prop('disabled', 'disabled');
        $("#cmbEstadosJ").val(adscripcion.cveEstado);
        var estado = $("#cmbEstadosJ").val();
        comboMunicipios(estado);
        comboDistritos(estado);
        $("#cmbMunicipiosJ").val(adscripcion.cveMunicipio);
        $("#cmbDistritosJ").val(adscripcion.cveDistrito);
        $("#hddJuzgado").val(juzgado.cveJuzgado);
        $("#txtDescJuzgado").val(juzgado.desJuzgado);
        $("#hddOficialiaAnterior").val(adscripcion.cveOficialia);
        for(var i = 0; i < juzgado.totalCountJuzgadoMateria; i++){
            var listaJuzgadosMaterias = {};
            var nombreMateria = juzgado.resultados[i].desMateria;
            listaJuzgadosMaterias["cveMateria"] = juzgado.resultados[i].cveMateria;
            listaJuzgadosMaterias["nomnbreMateria"] = nombreMateria;
            var nombreCuantia = juzgado.resultados[i].desCuantia;
            listaJuzgadosMaterias["cveCuantia"] = juzgado.resultados[i].cveCuantia;
            listaJuzgadosMaterias["nomnbreCuantia"] = nombreCuantia;
            var nombreTipo = juzgado.resultados[i].desTipo;
            listaJuzgadosMaterias["cveTipo"] = juzgado.resultados[i].cveTipo;
            listaJuzgadosMaterias["nomnbreTipos"] = nombreTipo;
            listaJuzgadosMaterias["activo"] = "S";
            listaJuzgadosMaterias["cveAdscripcion"] = adscripcion.cveAdscripcion;
            listaJuzgadosMaterias["cveJuzgado"] = juzgado.cveJuzgado;
            listaJuzgadosMaterias["cveJuzgadoMateria"] = juzgado.resultados[i].cveJuzgadoMateria;
            
            var existe = comprobarExistenciaListado(listaJuzgadosMaterias);
            if (existe == 0) {
                $('#cmbTipos').parent().append("<br class='required'><label class='Arial13Rojo required'>Ya existe en la lista no es necesario agregarlo</label>");
            } else {
//                alert(juzgado.resultados[i].cveJuzgadoMateria);
//                alert(juzgado.cveJuzgado);
                llenarTable("S",juzgado.resultados[i].cveJuzgadoMateria, juzgado.cveJuzgado);
            }
        }
    };
    function comboOficialiaReasignar(){
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/oficialia/OficialiaFacade.Class.php",
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
                    $('#cmbOficialiasReasignar').empty();
                    $('#cmbOficialiasReasignar').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbOficialiasReasignar').append('<option value="' + object.cveOficialia + '">' + object.desOficilia + '</option>');
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
    function guardarAdscripcionesReasignar(){
//        alert("guardarAdscripcionesReasignar");
        var guardar = 1;
        var descripcionJuzgadoReasignar = $("#txtDescJuzgadoReasignar").val();
        if (descripcionJuzgadoReasignar === "") {
            $('#txtDescJuzgadoReasignar').focus();
            $('#txtDescJuzgadoReasignar').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar una descripci&oacute;n del juzgado</label>");
            guardar = 0;
        }
        var descripcionAdscripcionReasignar = $("#cmbAdscripciones").val();
        if (descripcionAdscripcionReasignar === "") {
            $('#cmbAdscripciones').focus();
            $('#cmbAdscripciones').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una adscripci&oacute;n</label>");
            guardar = 0;
        }
        var descripcionOficialiaReasignar = $("#cmbOficialiasReasignar").val();
        if (descripcionOficialiaReasignar === "") {
            $('#cmbOficialiasReasignar').focus();
            $('#cmbOficialiasReasignar').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar una oficialia</label>");
            guardar = 0;
        }
        var hddJuzgadoReasignar = $("#hddJuzgadoReasignar").val();
        if(guardar != 0){
//            alert("debe insertar");
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/adscripciones/AdscripcionesFacade.Class.php",
                data: {
                    accion: "guardar-reasignar-juzgado",
                    activo: "S",
                    cveJuzgado: hddJuzgadoReasignar,
                    desJuzgado: descripcionJuzgadoReasignar,
                    cveAdscripcion: descripcionAdscripcionReasignar,
                    cveOficialia: descripcionOficialiaReasignar
                },
                async: true,
                dataType: "json",
                beforeSend: function (objeto) {
                    //document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
                },
                success: function (datos) {
//                    alert(datos);
                    try {
                        if (datos.totalCount > 0) {}
                    } catch (e) {
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                }
            });
        }
    };
    function cambiarJuzgado(juzgado, oficialia, adscripcion){
//        alert("cambiar juzgado");
        $("#divConsulta").hide("slow");
        $("#divFormulario").hide("slow");
        $("#divCamposReasignarJuzgado").show("slow");
        $("#hddJuzgadoReasignar").val(juzgado.cveJuzgado);
        $("#txtDescJuzgadoReasignar").val(juzgado.desJuzgado);
        comboAdscripciones();
        comboOficialiaReasignar();
        $("#cmbAdscripciones").val(adscripcion);
        $("#cmbOficialiasReasignar").val(oficialia);
    };
    function reasignarJuzgado(juzgado){
//        alert("reasignar juzgado");
        $("#divConsulta").hide("slow");
        $("#divFormulario").hide("slow");
        $("#divCamposReasignarJuzgado").show("slow");
        $("#hddJuzgadoReasignar").val(juzgado.cveJuzgado);
        $("#txtDescJuzgadoReasignar").val(juzgado.desJuzgado);
        comboAdscripciones();
        comboOficialiaReasignar();
    };
    $(function () {
        comboOficialia();
        comboMaterias();
        comboCuantias();
        comboTipos();
        comboEstados();
//        comboDistritos();
//        comboMunicipios();
    });
</script>
