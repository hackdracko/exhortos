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
            Permisos usuarios
        </h5>
    </div>
    <input type="hidden" id="hddCveFormulario">
    <div class="panel-body">
        <div id="divBusquedaEmpleado" class="form-horizontal">
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">N&uacute;mero de empleado</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="txtNumeroEmpleado" placeholder="N&uacute;mero de empleado">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Nombre</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="txtnombreEmpleado" placeholder="Nombre del empleado">
                </div>
            </div>
            <div class="col-lg-12" id=""><br></div>
            <div class="form-group">
                <div class="caption control-label col-md-6 needed">                                 
                    <input type="submit" class="btn btn-primary" value="Consultar" onclick="consultaEmpleado();">                                                                                                          
                    <input type="submit" class="btn btn-primary" value="Limpiar" onclick="LimpiarBusqueda();">                                    
                </div>
            </div>
            <div id="divResultPerfilesUsuarios" style="display: none" class="col-md-12">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="col-md-3">
                        <label class="control-label" id="totalRegUsuarios"></label>
                    </div>

                    <div id="divPaginadorUsuarios" class="col-md-3" >
                        <label class="control-label">Pagina:</label>
                        <select  name="cmbPaginacionUsuarios" id="cmbPaginacionUsuarios" onchange="consultaEmpleado(0);">
                            <option value="1"></option>
                        </select>
                    </div>
                    <div id="divPaginadorUsuarios" class="col-md-4" >
                        <label class="control-label">Registros por p&aacute;gina:</label>
                        <select  name="cmbNumRegUsuarios" id="cmbNumRegUsuarios" onchange="consultaEmpleado(1);">
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

                <div id="divResultados" class="col-md-12"></div>
            </div>
        </div>
        <div class="tab-pane" id="divInformacionGeneral" style="display:none;">
            <input type="submit" class="btn btn-primary" value="Regresar" onclick="RegresarBusquedaEmpleado();">        
            <div id="divLlenaEfectos" >
                <div id="divFormulario" class="form-horizontal">
                    <div class="tab-content tabs-flat">
                        <div class="tabbable tabs-left">
                            <div class="tab-content">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <!-- 
*******
******DIV PARA LA INFORMACIÓN DEL USUARIO
*******
                                        -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapseGeneral" aria-expanded="true"
                                                       aria-controls="collapseGeneral">
                                                        1.- Informaci&oacute;n del usuario
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseGeneral" class="panel-collapse collapse in" role="tabpanel"
                                                 aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div id="divInfoEmpleado" class="form-horizontal" style="display:none;">
                                                        <div class="form-group">
                                                            <input type="hidden" id="hddCveUsuario">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">N&uacute;mero de empleado <span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="txtNumeroEmpleadoInfo" placeholder="N&uacute;mero de empleado">
                                                            </div>
                                                        </div>

                                                        <label class="caption control-label col-md-3 needed">Nombre del empleado <span class="requerido">(*)</span></label>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" id="nombreInfo" placeholder="Nombre ">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" id="paternoInfo" placeholder="Paterno">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" id="maternoInfo" placeholder="Materno">
                                                        </div>
                                                        <div class="col-lg-12"><br></div>

                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Adscripciones <span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbAdscripciones" class="form-control" name="cmbAdscripciones">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Grupo <span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbGrupo" class="form-control" name="cmbGrupo">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Usuario <span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="txtUsuarioInfo" placeholder="Usuario">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Constrase&ntilde;a  <span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="txtPasswordInfo" placeholder="Constrase&ntilde;a">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Tel&eacute;fono</label>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="txtTelInfo" placeholder="Tel&eacute;fono">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Correo electr&oacute;nico</label>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="txtCorreoInfo" placeholder="Correo electr&oacute;nico">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Activo<span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbActivoInfo" class="form-control" name="cmbActivoInfo">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                    <option value="S">SI</option>
                                                                    <option value="N">NO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12" id=""><br></div>
                                                        <div class="form-group">
                                                            <div class="caption control-label col-md-6 needed">                                 
                                                                <input type="submit" class="btn btn-primary" value="Guardar" onclick="GuardarInfoEmpleado();">                                                                                                                                                                                                            
                                                                <input type="submit" class="btn btn-primary" value="Limpiar" onclick="limpiarInfo();">                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div id="divAlertWarningFormUsuario" class="alert alert-warning alert-dismissable" style="display:none;">                    
                                                                <strong>Advertencia!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertSuccesFormUsuario" class="alert alert-success alert-dismissable" style="display:none;">

                                                                <strong>Correcto!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertDagerFormUsuario" class="alert alert-danger alert-dismissable" style="display:none;">

                                                                <strong>Error!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertInfoFormUsuario" class="alert alert-info alert-dismissable" style="display:none;">

                                                                <strong>Informaci&oacute;n!</strong> Mensaje
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 
*******
******DIV PARA LOS PERFILES YA ASIGNADOS
*******
                                        -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapsePerfilAdiignado" aria-expanded="false"
                                                       aria-controls="collapsePerfilAdiignado">
                                                        2.- Perfiles Asignados
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsePerfilAdiignado" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">


                                                    <div id="divResultPerfilesGeneral" style="display: none" class="col-md-12">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-6">
                                                            <div class="col-md-3">
                                                                <label class="control-label" id="totalReg"></label>
                                                            </div>

                                                            <div id="divPaginador" class="col-md-3" >
                                                                <label class="control-label">Pagina:</label>
                                                                <select  name="cmbPaginacion" id="cmbPaginacion" onchange="consultaPerfiles(0);">
                                                                    <option value="1"></option>
                                                                </select>
                                                            </div>
                                                            <div id="divPaginador" class="col-md-4" >
                                                                <label class="control-label">Registros por p&aacute;gina:</label>
                                                                <select  name="cmbNumReg" id="cmbNumReg" onchange="consultaPerfiles(1);">
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

                                                        <div id="divResultPerfiles" class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 
                                        *******
                                        ******DIV PARA LA INFORMACION DEL PERFIL
                                        *******
                                        -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseInfoPerfil" aria-expanded="false"
                                                       aria-controls="collapseInfoPerfil">
                                                        3.- Informaci&oacute;n del  perfil

                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseInfoPerfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    <div id="divNuevoPerfil" class="form-horizontal" style="display:none">
                                                        <input type="hidden" id="hddCvePerfil">
                                                        <input type="hidden" id="hddCveSistema">
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Sistema<span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbSistemasNuevo" class="form-control" name="cmbSistemasNuevo" onchange="comboGruposNuevo();">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Adscripci&oacute;n<span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbAdscripcionNueva" class="form-control" name="cmbAdscripcionNueva">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Grupo<span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbGrupoNuevo" class="form-control" name="cmbGrupoNuevo">
                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="caption control-label col-md-3 needed" id="">Activo<span class="requerido">(*)</span></label>
                                                            <div class="col-md-5">
                                                                <select id="cmbActivoPerfil" class="form-control" name="cmbActivoPerfil">
                                                                    <option value="">--</option>
                                                                    <option value="S">SI</option>
                                                                    <option value="N">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12" id=""><br></div>
                                                        <div class="form-group">
                                                            <div class="caption control-label col-md-6 needed">                                 
                                                                <input type="submit" class="btn btn-primary" value="Agregar" onclick="nuevoPerfil();">                                                                                                          
                                                                <input type="submit" class="btn btn-primary" value="Limpiar" onclick="limpiaNuevoPerfil();">                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div id="divAlertWarningFormPerfiles" class="alert alert-warning alert-dismissable" style="display:none;">                    
                                                                <strong>Advertencia!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertSuccesFormPerfiles" class="alert alert-success alert-dismissable" style="display:none;">

                                                                <strong>Correcto!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertDagerFormPerfiles" class="alert alert-danger alert-dismissable" style="display:none;">

                                                                <strong>Error!</strong> Mensaje
                                                            </div>
                                                            <div id="divAlertInfoFormPerfiles" class="alert alert-info alert-dismissable" style="display:none;">

                                                                <strong>Informaci&oacute;n!</strong> Mensaje
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- 
*******
******DIV LOS PERMISOS DE LOS FORMULARIOS
*******
                                        -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingFour">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseOpciones" aria-expanded="false"
                                                       aria-controls="collapseOpciones">
                                                        4.- Permisos formularios

                                                    </a>
                                                </h4>
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
                                            <div id="collapseOpciones" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                                                <div class="panel-body">
                                                    <div id="divResultadosOpciones"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Regresar" onclick="RegresarBusquedaEmpleado();">        
        </div>
        <!--
        DIV DE MENSAJES
        -->


    </div>
</div>
<script type="text/javascript">
    RegresarBusquedaEmpleado = function () {
        $('#divBusquedaEmpleado').show("slow");
        $('#divInfoEmpleado').hide("slow");
        $('#divNuevoPerfil').hide("slow");
        $('#divInformacionGeneral').hide("slow");
    };
    comboAdscripciones = function () {
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
                    alert("Error al cargar las adscripciones:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de adscripciones:\n\n" + otroobj);
            }
        });
    };
    comboGrupos = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/grupos/GruposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarGenerla", activo: 'S'},
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
    comboSistemasNuevo = function () {
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
                    $('#cmbSistemasNuevo').empty();
                    $('#cmbSistemasNuevo').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbSistemasNuevo').append('<option value="' + object.cveSistema + '">' + object.nomSistema + '</option>');
                        });
                        $("#cmbSistemasNuevo").val(1).trigger('change');
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
    comboAdscripcionesNuevo = function () {
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
                    $('#cmbAdscripcionNueva').empty();
                    $('#cmbAdscripcionNueva').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbAdscripcionNueva').append('<option value="' + object.cveAdscripcion + '">' + object.desAdscripcion + '</option>');
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
    comboGruposNuevo = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/grupos/GruposFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarGenerla", activo: 'S', cveSistema: $('#cmbSistemasNuevo').val()},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('#cmbGrupoNuevo').empty();
                    $('#cmbGrupoNuevo').append('<option value="">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('#cmbGrupoNuevo').append('<option value="' + object.CveGrupo + '">' + object.NomGrupo + '</option>');
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
    LimpiarBusqueda = function () {
        $('#txtNumeroEmpleado').val("");
        $('#txtnombreEmpleado').val("");
        $('#divResultados').hide("");
        $('#divResultados').html("");
        $('#divResultPerfilesUsuarios').hide("");
        limpiarInfo();
        limpiaNuevoPerfil();
    };
    validate = function () {
        $(".required").remove();
        var mensaje = "";
        var error = false;
        if ($('#txtNumeroEmpleadoInfo').val() == "" || $('#txtNumeroEmpleadoInfo').val() == "0") {
            $('#txtNumeroEmpleadoInfo').focus();
            $('#txtNumeroEmpleadoInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese el n&uacute;mero de empleado</label>");
            error = true;
        }
        if ($('#cmbAdscripciones').val() == "" || $('#cmbAdscripciones').val() == "0") {
            $('#cmbAdscripciones').focus();
            $('#cmbAdscripciones').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione una adscripci&oacute;n</label>");
            error = true;
        }
        if ($('#cmbGrupo').val() == "" || $('#cmbGrupo').val() == "0") {
            $('#cmbGrupo').focus();
            $('#cmbGrupo').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione un grupo</label>");
            error = true;
        }
        if ($('#txtUsuarioInfo').val() == "" || $('#txtUsuarioInfo').val() == "0") {
            $('#txtUsuarioInfo').focus();
            $('#txtUsuarioInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese un login</label>");
            error = true;
        }
        if ($('#txtPasswordInfo').val() == "" || $('#txtPasswordInfo').val() == "0") {
            $('#txtPasswordInfo').focus();
            $('#txtPasswordInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese una contrase&ntilde;a</label>");
            error = true;
        }
        if ($('#paternoInfo').val() == "" || $('#paternoInfo').val() == "0") {
            $('#paternoInfo').focus();
            $('#paternoInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese apellido paterno</label>");
            error = true;
        }
        if ($('#maternoInfo').val() == "" || $('#maternoInfo').val() == "0") {
            $('#maternoInfo').focus();
            $('#maternoInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese apellido materno</label>");
            error = true;
        }
        if ($('#nombreInfo').val() == "" || $('#nombreInfo').val() == "0") {
            $('#nombreInfo').focus();
            $('#nombreInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese nombre</label>");
            error = true;
        }
        if ($('#cmbActivoInfo').val() == "" || $('#cmbActivoInfo').val() == "0") {
            $('#cmbActivoInfo').focus();
            $('#cmbActivoInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione activo</label>");
            error = true;
        }

        if ($('#txtCorreoInfo').val() != "") {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            if (!regex.test($('#txtCorreoInfo').val().trim())) {
                $('#txtCorreoInfo').focus();
                $('#txtCorreoInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>Correo electronico no valido</label>");
                error = true;
            }
        }
        if ($('#txtTelInfo').val() != "") {
            if ($('#txtTelInfo').val().length != 10) {
                $('#txtTelInfo').focus();
                $('#txtTelInfo').parent().append("<br class='required'><label class='Arial13Rojo required'>El tel\u00e9fono  debe de tener 10 Digitos</label>");
                error = true;
            }
        }
        return error;
    };
    GuardarInfoEmpleado = function () {
        $(".required").remove();
        var error = false;
        if (!validate()) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/usuarios/UsuariosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "guardar",
                    cveUsuario: $('#hddCveUsuario').val(),
                    numEmpleado: $('#txtNumeroEmpleadoInfo').val(),
                    cveAdscripcion: $('#cmbAdscripciones').val(),
                    cveGrupo: $('#cmbGrupo').val(),
                    login: $('#txtUsuarioInfo').val(),
                    Password: $('#txtPasswordInfo').val(),
                    passwordCifrado: $('#txtPasswordInfo').val(),
                    paterno: $('#paternoInfo').val().toUpperCase(),
                    materno: $('#maternoInfo').val(),
                    nombre: $('#nombreInfo').val(),
                    activo: $("#cmbActivoInfo").val(),
                    telefono: $('#txtTelInfo').val(),
                    email: $('#txtCorreoInfo').val()
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    if (datos.status == 'Ok') {
                        $("#divAlertSuccesFormUsuario").html("");
                        $("#divAlertSuccesFormUsuario").html("El usuario se guard&oacute; de forma correcta.");
                        $("#divAlertSuccesFormUsuario").show("");
                        setTimeAlert("divAlertSuccesFormUsuario");
                        $("#hddCveUsuario").val(datos.resultado[0].cveUsuario);
                        $("#txtNumeroEmpleadoInfo").val(datos.resultado[0].numEmpleado);
                        $("#nombreInfo").val(datos.resultado[0].nombre);
                        $("#paternoInfo").val(datos.resultado[0].paterno);
                        $("#maternoInfo").val(datos.resultado[0].materno);
                        $("#cmbAdscripciones").val(datos.resultado[0].cveAdscripcion);
                        $("#cmbGrupo").val(datos.resultado[0].cveGrupo);
                        $("#txtUsuarioInfo").val(datos.resultado[0].login);
                        $("#txtPasswordInfo").val(datos.resultado[0].password);
                        $("#txtTelInfo").val(datos.resultado[0].telefono);
                        $("#txtCorreoInfo").val(datos.resultado[0].correo);
                        $("#cmbActivoInfo").val(datos.resultado[0].activo);
                        $("#divNuevoPerfil").show('');
                        $("#divInformacionGeneral").show('');
                    } else {
                        $("#divAlertWarningFormUsuario").html("");
                        $("#divAlertWarningFormUsuario").html(datos.mnj);
                        $("#divAlertWarningFormUsuario").show("");
                        setTimeAlert("divAlertWarningFormUsuario");
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

    getPaginasUsuarios = function (pag, cantReg) {
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/usuarios/UsuariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "getPaginas",
                numEmpleado: $('#txtNumeroEmpleado').val(),
                nombre: $('#txtnombreEmpleado').val(),
                cantxPag: cantReg
            },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                var json = datos;
                if (json.totalCount > 0) {
                    $('#cmbPaginacionUsuarios').find('option').remove().end();
                    for (var i = 0; i < (parseInt(json.total)); i++) {
                        $("#cmbPaginacionUsuarios").append($('<option></option>').val(json.data[i].pagina).html(json.data[i].pagina));
                    }
                    $("#totalRegUsuarios").html("<b> Total: " + json.totalCount + "</b>");
                    $("#cmbPaginacionUsuarios").val(pag);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };

    consultaEmpleado = function (id, pagAux) {
        $(".required").remove();
        if (($('#txtNumeroEmpleado').val() != "" && $('#txtNumeroEmpleado').val() != '0') || ($('#txtnombreEmpleado').val() != "" && $('#txtnombreEmpleado').val() != '0')) {

            var pag = 0;
            if (pagAux == 0) {
                pag = $("#cmbPaginacionUsuarios").val();
            } else {
                pag = 1;
            }
            var cantReg = $("#cmbNumRegUsuarios").val();

            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/usuarios/UsuariosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultarEmpleados",
                    numEmpleado: $('#txtNumeroEmpleado').val(),
                    nombre: $('#txtnombreEmpleado').val(),
                    pag: pag,
                    cantxPag: cantReg
                },
                beforeSend: function (datos) {

                },
                success: function (datos) {
                    if (datos.totalCount > 0) {
                        var table = "";
                        table += '<table id="tblResultados" width="50%" align="center" class="table table-hover table-striped table-bordered">';
                        table += '<thead>';
                        table += '<tr>';
                        table += '<th>No</th>';
                        table += '<th>Num empleado</th>';
                        table += '<th>Nombre</th>';
                        table += '<th>Paterno</th>';
                        table += '<th>Materno</th>';
                        table += '<th>Activo</th>';
                        table += '</tr>';
                        table += '</thead>';
                        table += "<tbody>";
                        for (var i = 0; i < datos.totalCount; i++) {
                            table += "<tr>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + (i + 1) + "</td>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + datos.data[i].numEmpleado + "</td>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + datos.data[i].nombre + "</td>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + datos.data[i].paterno + "</td>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + datos.data[i].materno + "</td>";
                            table += "<td onclick='consutaIdEmpleado(" + datos.data[i].cveUsuario + ")' >" + datos.data[i].activo + "</td>";
                            table += "</tr>";
                        }
                        table += "</tbody>";
                        table += "</table>";
                        $('#divResultados').html(table);
                        $("#tblResultados").DataTable({
                            paging: false
                        });
                        $('#divResultados').show("");
                        $('#divResultPerfilesUsuarios').show("");
                        getPaginasUsuarios(datos.pagina, cantReg);
                    } else {
                        $('#divResultPerfilesUsuarios').hide("");
                        $('#divResultados').hide("");
                        $('#divResultados').html("");
                        bootbox.dialog({
                            message: "No se encontro al usuario. \u00bf Desea darlo de alta?",
                            buttons: {
                                danger: {
                                    label: "Aceptar",
                                    className: "btn-primary",
                                    callback: function () {
                                        $('#divBusquedaEmpleado').hide("slow");
                                        $('#divInfoEmpleado').show("slow");
                                        $('#divInformacionGeneral').show("slow");
                                        limpiarInfo();
                                        limpiaNuevoPerfil();
                                        $('#txtNumeroEmpleadoInfo').val($('#txtNumeroEmpleado').val());
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
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
                }
            });
        } else {

            $('#txtnombreEmpleado').focus();
            $('#txtnombreEmpleado').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese criterio de b&uacute;squeda</label>");
        }
    };
    consutaIdEmpleado = function (id) {
        $(".required").remove();
        $('#divBusquedaEmpleado').hide("slow");
        $('#divInfoEmpleado').show("slow");
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/usuarios/UsuariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar",
                cveUsuario: id
            },
            beforeSend: function (datos) {

            },
            success: function (datos) {
                if (datos.totalCount > 0) {
                    $("#hddCveUsuario").val(datos.data[0].cveUsuario);
                    $("#txtNumeroEmpleadoInfo").val(datos.data[0].numEmpleado);
                    $("#nombreInfo").val(datos.data[0].nombre);
                    $("#paternoInfo").val(datos.data[0].paterno);
                    $("#maternoInfo").val(datos.data[0].materno);
                    $("#cmbAdscripciones").val(datos.data[0].cveAdscripcion);
                    $("#cmbGrupo").val(datos.data[0].cveGrupo);
                    $("#txtUsuarioInfo").val(datos.data[0].login);
                    $("#txtPasswordInfo").val(datos.data[0].password);
                    $("#txtTelInfo").val(datos.data[0].telefono);
                    $("#txtCorreoInfo").val(datos.data[0].correo);
                    $("#cmbActivoInfo").val(datos.data[0].activo);
                    consultaPerfiles(datos.data[0].cveUsuario);
                    $("#divNuevoPerfil").show('');
                    $("#divInformacionGeneral").show('');
                } else {
                    $("#divResultados").html("");
                    $("#divResultPerfilesGeneral").hide("");
                    $("#divResultPerfilesUsuarios").hide("");
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
    limpiarInfo = function () {
        $(".required").remove();
        $("#hddCveUsuario").val("");
        $("#txtNumeroEmpleadoInfo").val("");
        $("#nombreInfo").val("");
        $("#paternoInfo").val("");
        $("#maternoInfo").val("");
        $("#cmbAdscripciones").val("");
        $("#cmbGrupo").val("");
        $("#txtUsuarioInfo").val("");
        $("#txtUsuarioInfo").val("");
        $("#txtPasswordInfo").val("");
        $("#txtTelInfo").val("");
        $("#txtCorreoInfo").val("");
        $("#cmbActivoInfo").val("");
        $("#divResultPerfilesGeneral").hide("");
        $("#divResultPerfiles").html("");
        $("#divNuevoPerfil").hide('');
    };
    getPaginas = function (id, pag, cantReg) {
        var pag = $("#cmbPaginacion").val();
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/perfiles/PerfilesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "getPaginas",
                cveUsuario: id,
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
    validatePerfil = function () {
        var error = false;
        if ($('#hddCveUsuario').val() == "" || $('#hddCveUsuario').val() == "0") {
            $('#hddCveUsuario').focus();
            $('#hddCveUsuario').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe seleccionar a un usuario</label>");
            error = true;
        }
        if ($('#cmbSistemasNuevo').val() == "" || $('#cmbSistemasNuevo').val() == "0") {
            $('#cmbSistemasNuevo').focus();
            $('#cmbSistemasNuevo').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione un sistema</label>");
            error = true;
        }
        if ($('#cmbAdscripcionNueva').val() == "" || $('#cmbAdscripcionNueva').val() == "0") {
            $('#cmbAdscripcionNueva').focus();
            $('#cmbAdscripcionNueva').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione una adscripci&oacute;n</label>");
            error = true;
        }
        if ($('#cmbGrupoNuevo').val() == "" || $('#cmbGrupoNuevo').val() == "0") {
            $('#cmbGrupoNuevo').focus();
            $('#cmbGrupoNuevo').parent().append("<br class='required'><label class='Arial13Rojo required'>Seleccione un grupo</label>");
            error = true;
        }

        return error;
    };
    nuevoPerfil = function () {
        $(".required").remove();
        var error = false;
        if (!validatePerfil()) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/perfiles/PerfilesFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "guardar",
                    cvePerfil: $('#hddCvePerfil').val(),
                    cveUsuario: $('#hddCveUsuario').val(),
                    cveSistema: $('#cmbSistemasNuevo').val(),
                    cveAdscripcion: $('#cmbAdscripcionNueva').val(),
                    cveGrupo: $('#cmbGrupoNuevo').val(),
                    activo: $('#cmbActivoPerfil').val()
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    if (datos.status == 'ok') {
                        $("#divAlertSuccesFormPerfiles").html("");
                        $("#divAlertSuccesFormPerfiles").html(datos.mensaje);
                        $("#divAlertSuccesFormPerfiles").show("");
                        setTimeAlert("divAlertSuccesFormPerfiles");
                        $("#hddCvePerfil").val(datos.data[0].cvePerfil);
                        $("#hddCveUsuario").val(datos.data[0].cveUsuario);
                        $("#cmbSistemasNuevo").val(datos.data[0].cveSistema);
                        $("#cmbAdscripcionNueva").val(datos.data[0].cveAdscripcion);
                        $("#cmbGrupoNuevo").val(datos.data[0].cveGrupo);
                        $("#cmbActivoPerfil").val(datos.data[0].activo);
                        consultaPerfiles(datos.data[0].cveUsuario);
                        $("#divResultadosOpciones").html("");
                        consultaIdPerfil(datos.data[0].cvePerfil);
                    } else {
                        $("#divAlertWarningFormPerfiles").html("");
                        $("#divAlertWarningFormPerfiles").html(datos.mensaje);
                        $("#divAlertWarningFormPerfiles").show("");
                        setTimeAlert("divAlertWarningFormPerfiles");
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
    consultaPerfiles = function (id, pagAux) {
        $(".required").remove();
        var pag = 0;
        if (pagAux == 0) {
            pag = $("#cmbPaginacion").val();
        } else {
            pag = 1;
        }
        var cantReg = $("#cmbNumReg").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/perfiles/PerfilesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarDetalle",
                cveUsuario: id,
                pag: pag,
                cantxPag: cantReg
            },
            beforeSend: function (datos) {

            },
            success: function (datos) {
                if (datos.totalCount > 0) {
                    var table = "";
                    table += '<table id="tblResultadosPerfiles" width="80%" align="center" class="table table-hover table-striped table-bordered">';
                    table += '<thead>';
                    table += '<tr>';
                    table += '<th>No</th>';
                    table += '<th>Adscripcion</th>';
                    table += '<th>Grupo</th>';
                    table += '<th>Sistema</th>';
                    table += '<th>Activo</th>';
                    table += '</tr>';
                    table += '</thead>';
                    table += "<tbody>";
                    for (var i = 0; i < datos.totalCount; i++) {
                        table += "<tr>";
                        table += "<td onclick='consultaIdPerfil(" + datos.data[i].cvePerfil + ")' >" + (i + 1) + "</td>";
                        table += "<td onclick='consultaIdPerfil(" + datos.data[i].cvePerfil + ")' >" + datos.data[i].desAdscripcion + "</td>";
                        table += "<td onclick='consultaIdPerfil(" + datos.data[i].cvePerfil + ")' >" + datos.data[i].desGrupo + "</td>";
                        table += "<td onclick='consultaIdPerfil(" + datos.data[i].cvePerfil + ")' >" + datos.data[i].desSistema + "</td>";
                        table += "<td onclick='consultaIdPerfil(" + datos.data[i].cvePerfil + ")' >" + datos.data[i].activo + "</td>";
                        table += "</tr>";
                    }
                    table += "</tbody>";
                    table += "</table>";
                    $('#divResultPerfiles').html(table);
                    $("#tblResultadosPerfiles").DataTable({
                        paging: false
                    });
                    $('#divResultPerfiles').show("");
                    $('#divResultPerfilesGeneral').show("");
                    getPaginas(id, datos.pagina, cantReg);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };
    consultaIdPerfil = function (id) {
        $(".required").remove();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/perfiles/PerfilesFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarDetalle",
                cvePerfil: id
            },
            beforeSend: function (datos) {
            },
            success: function (datos) {
                if (datos.totalCount > 0) {
                    $("#hddCvePerfil").val(datos.data[0].cvePerfil);
                    $("#hddCveSistema").val(datos.data[0].cveSistema);
                    $("#cmbSistemasNuevo").val(datos.data[0].cveSistema);
                    comboGruposNuevo();
                    $("#cmbAdscripcionNueva").val(datos.data[0].cveAdscripcion);
                    $("#cmbGrupoNuevo").val(datos.data[0].cveGrupo);
                    $("#cmbActivoPerfil").val(datos.data[0].activo);
                    consultaOpcionMenu(id);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
            }
        });
    };
    consultaOpcionMenu = function (cvePerfil) {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/permisosusuarios/PermisosusuariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarOpciones",
                cvePerfil: cvePerfil,
            },
            beforeSend: function (datos) {
            },
            success: function (datos) {
                if (datos.status == 'ok') {
                    var table = "";
                    table += '<table id="tblResultadosOpciones" border="0" width="50%" align="center">';
                    table = opcionesDesc(datos, table, false, 0);
                    table += "</table>";
                    $('#divResultadosOpciones').html(table);
                    $('#divResultadosOpciones').show('');
                    cargaPermisos(cvePerfil);
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
    };
    opcionesDesc = function (datos, table, hijo, nivel) {
        try {
            if (hijo == false) {
                for (var i = 0; i < datos.opciones.length; i++) {
                    if (datos.opciones.length > 0) {
                        table += '<tr class="trOpciones"  bgcolor="#CEF6E3">';
                        table += '<td width="80%">' + datos.opciones[i].nomFormulario + '</td>';
                        table += '<td width="20%" ><input type="checkbox" title="Vista"  id="ckbF' + datos.opciones[i].cveFormulario + '" name="formulario" onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Guardar"  id="ckbI' + datos.opciones[i].cveFormulario + '" name="registrar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Consultar" id="ckbS' + datos.opciones[i].cveFormulario + '" name="consultar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Modificar" id="ckbU' + datos.opciones[i].cveFormulario + '" name="modificar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Eliminar" id="ckbD' + datos.opciones[i].cveFormulario + '" name="eliminar"  onclick="asignaPermiso(' + datos.opciones[i].cveFormulario + ', this.id);"></td>';
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
                        table += '<td width="20%" ><input type="checkbox" title="Vista"  id="ckbF' + datos.hijos[x].cveFormulario + '" name="formulario" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Guardar" id="ckbI' + datos.hijos[x].cveFormulario + '" name="registrar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Consultar" id="ckbS' + datos.hijos[x].cveFormulario + '" name="consultar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Modificar" id="ckbU' + datos.hijos[x].cveFormulario + '" name="modificar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);">';
                        table += '<input type="checkbox" title="Eliminar" id="ckbD' + datos.hijos[x].cveFormulario + '" name="eliminar" id="cbxPermisos" onclick="asignaPermiso(' + datos.hijos[x].cveFormulario + ', this.id);"></td>';
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


    cargaPermisos = function (cvePerfil) {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/permisosusuarios/PermisosusuariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar",
                cvePerfil: cvePerfil
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
            url: "../fachadas/exhortos/permisosusuarios/PermisosusuariosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "guardar",
                cveSistema: $('#hddCveSistema').val(),
                cveFormulario: cveFormulario,
                cvePerfil: $('#hddCvePerfil').val(),
                cveUsuario: $('#hddCveUsuario').val(),
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
    }
    ;
    limpiaNuevoPerfil = function () {
        $(".required").remove();
        $("#hddCvePerfil").val("");
        $("#hddCveSistema").val("");
        $("#cmbSistemasNuevo").val(1);
        $("#cmbAdscripcionNueva").val("");
        $("#cmbGrupoNuevo").val("");
        $("#cmbActivoPerfil").val("");
        $("#divResultadosOpciones").html("");
    };
    $(function () {
//        $('#txtNumeroEmpleadoInfo').validaCampo('0123456789');
        $('#txtTelInfo').validaCampo('0123456789');
        comboAdscripciones();
        comboGrupos();
        comboSistemasNuevo();
        comboAdscripcionesNuevo();
        comboGruposNuevo();
    });

</script>