<?php
session_start();
    function file_upload_max_size() {
        static $max_size = -1;
        if ($max_size < 0) {
            // Start with post_max_size.
            $max_size = parse_size(ini_get('post_max_size'));
            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return $max_size;
    }

    function parse_size($size) {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else { return round($size); }
    }
?>
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

    .requerido {
        color: darkred;
    }

</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title" id="h5titulo">                                                            
            Registro de Oficios
        </h5>
    </div>
    <div class="panel-body">
        <input type="hidden" id="uploadMaxSize" name="uploadMaxSize" value="<?=file_upload_max_size()?>" />
        <input type="hidden" id="uploadMaxFiles" name="uploadMaxFiles" value="10485760" /> <!-- 10 Mb -->
        <input type="hidden" id="totalAdjuntos" name="totalAdjuntos" value="0" /> <!-- 0 Mb -->
        <!-- INICIO RESPUESTA ACTUACIONES-->
        <div id="divFormulario" class="form-horizontal">
            <div class="form-group col-xs-12">
                <input type="hidden" readonly disabled name="idExhorto" id="idExhorto" class="form-control" value=""/>
                <input type="hidden" readonly disabled name="idExhortoGenerado" id="idExhortoGenerado" class="form-control" value=""/>
                <input type="hidden" readonly disabled name="idActuacion" id="idActuacion" class="form-control" value=""/>

                <label class="control-label col-md-3">No. Exhorto</label>
                <div class="col-md-6">
                    <input type="text" name="numero" id="numero" class="form-inline number-only" placeholder="N&uacute;mero" size="5">
                    / <input type="text" name="anio" id="anio" class="form-inline number-only"  placeholder="A&ntilde;o" size="5">
                    <button type="button" name="buscarExhorto" id="buscarExhorto" class="btn btn-primary form-inline">Buscar</button>
                </div>
            </div>
            <div class="form-group col-xs-12">                                                                
                <label class="control-label col-md-3">No. Promocion</label>
                <div class="col-md-6">
                    <input type="text" disabled readonly name="txtNPromocion" id="txtNPromocion" placeholder="No. Promocion" class="form-inline number-only" />
                    /<input type="text" disabled readonly class="form-inline" id="txtAPromocion" id="txtAPromocion" placeholder="A&ntilde;o">
                </div>
            </div>
            <div class="form-group col-xs-12">                                                                
                <label class="control-label col-md-3">No. Oficio </label>
                <div class="col-md-6">
                    <input type="text" name="txtOficio" id="txtOficio" placeholder="No. Oficio" class="form-inline number-only" />
                    /<input type="text" class="form-inline number-only" id="txtOficioAnio" id="txtOficioAnio" placeholder="A&ntilde;o">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Fojas <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" name="txtFojas" id="txtFojas" placeholder="Fojas" class="form-control number-only" value=""/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Sintesis <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" id="txtSintesis" placeholder="Sintesis" class="form-control text-uppercase" value=""/>
                </div>
            </div>

            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Observaciones<span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <textarea rows="5" id="txtObservaciones" class="form-control text-uppercase" placeholder="Observaciones"></textarea>
                </div>
            </div>
            <div class="form-group col-xs-12"> 
                <label class="control-label col-md-3" >Estatus <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <select class="form-control cmbEstatus" name="cmbEstatus" id="cmbEstatus">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <div class="col-xs-12">
                <form class="form-horizontal" style="display:none" role="form" id="formulario-adjuntos">
                    <fieldset>
                        <legend>Archivos Adjuntos</legend>
                            <!-- inicio partes -->
                                <!-- INICIO DE FORMULARIO DE ADJUNTOS -->
                                <div class="form-group"> <!-- Adjuntar -->
                                    <label for="cveTipoParte" class="control-label col-xs-12 col-sm-2 col-md-2">Seleccione archivo(s)</label>
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <input type="file" id="uploadfiles" multiple="multiple" accept="application/pdf" class="form-control" style="border: 0px none;" />
                                    </div>
                                    <label class="control-label col-xs-12 col-sm-3 col-md-3">Tama&ntilde;o m&aacute;ximo por archivo: <span id="maximoPorArchivo"></span></label>
                                </div> <!-- Adjuntar/ -->
                                <div class="form-group">
                                    <div id="divInformacion_Archivos" class="alert alert-warning alert-dismissable" style="display: none">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong id="strAdvertencia"></strong> 
                                    </div>
                                </div>
                                <div class="form-group"> <!-- Barra de progreso -->
                                    <label for="" id="maximoEnvio" class="control-label col-xs-12 col-sm-2 col-md-2"></label>
                                    <div class="col-xs-12 col-sm-9 col-md-9 progress">
                                      <div class="progress-bar" id="progress-bar-filesSize" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; ">
                                      0%
                                      </div>
                                    </div>
                                </div> <!-- Barra de progreso/ -->
                                <!-- TABLA DE ARCHIVOS -->
                                <div class="col-xs-12">
                                    <table border="1" align="center"  width="90%"  class="table table-bordered table-striped table-hover table-responsive tablaAdjuntos">
                                        <thead>
                                            <tr>
                                                <th style="width: 70%;">Archivo</th>
                                                <th style="width: 15%;">Tama&ntilde;o de archivo</th>
                                                <th style="width: 15%;">Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-adjuntos">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- TABLA DE ARCHIVOS/ -->
                                <!-- FIN DE FORMULARIO DE ADJUNTOS -->
                    </fieldset>
                </form>
            </div>

            <div class="col-xs-12">
                <div style="display:none;" class="alert alert-success alert-dismissable mensajeSuccess"></div>
                <div style="display:none;" class="alert alert-warning alert-dismissable mensajeError"></div>
            </div>
            <div class="form-group">
                <br>
                <br>
                <br>
                <div class="form-group" style="text-align:center">
                    <button class="btn btn-primary" style="display:none" name="imprimir" id="imprimir">Imprimir</button>
                    <button class="btn btn-primary" style="display:none" name="actualizar" id="actualizar">Actualizar</button>
                    <button class="btn btn-primary" name="guardar" id="guardar">Guardar</button>
                    <button class="btn btn-primary" name="consultar" id="consultar">Consultar</button>
                    <button class="btn btn-primary" name="limpiar" id="limpiar" onclick="limpiaCamposInicio();">Limpiar</button>
                </div>
                <div id="divRespuesta" class="form-group col-xs-12" style="display:none;"> 
                    <div class="col-md-12" style="text-align:center">
                        <button class="btn btn-primary" name="enviarRespuesta" id="enviarRespuesta">Enviar Oficio</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- INICIO CONSULTA ACTUACIONES-->
        <div id="divConsulta" style="display:none;" class="form-horizontal">
            <div class="form-group col-xs-12">                                                                
                <label class="control-label col-md-3">No. Oficio</label>
                <div class="col-md-6">
                    <input type="text" name="txtOficioConsulta" id="txtOficioConsulta" placeholder="No. Oficio" class="form-inline number-only" />
                    /<input type="text" class="form-inline number-only" id="txtOficioAnioConsulta" id="txtOficioAnioConsulta" placeholder="A&ntilde;o">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Fecha Inicio</label>
                <div class="col-md-9">
                    <input type="text" readonly name="fechaInicioConsulta" id="fechaInicioConsulta" placeholder="Fecha" class="form-control fecha" value="<?php echo date("dd/mm/YYYY"); ?>"/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Fecha Fin</label>
                <div class="col-md-9">
                    <input type="text" readonly name="fechaFinConsulta" id="fechaFinConsulta" placeholder="Fecha" class="form-control fecha" value="<?php echo date("dd/mm/YYYY"); ?>"/>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-xs-12 text-center">
                <label class="control-label">Numero de Registros a mostrar</label>
                <select name="numeroRegistros" id="numeroRegistros">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option selected value="20">20</option>
                </select>
            </div>
            <table id="tablaActuaciones"  border="1" align="center"  width="90%"  class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO. OFICIO</th>
                        <th>NO. EXHORTO</th>
                        <th>ENVIADO</th>
                        <th>ESTATUS ENVIADO</th>
                        <th>ELECTRONICO</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="paginadorActuaciones"></div>
            <div class="clearfix"></div>
            <div class="form-group">
                <br>
                <br>
                <br>
                <div class="form-group" style="text-align:center">
                    <button class="btn btn-primary" name="regresar" id="regresar">Regresar</button>
                    <button class="btn btn-primary" name="consultarRespuesta" id="consultarRespuesta">Consultar</button>
                    <button class="btn btn-primary" name="limpiarConsulta" id="limpiarConsulta" onclick="limpiaConsulta();">Limpiar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var filesSizeAttached = 0;
    $( "#buscarExhorto" ).click(function() {
        $("#idExhorto").val('');
        $("#idExhortoGenerado").val('');
        $(".mensajeSuccess").empty();
        $(".mensajeError").empty();
        var numExhorto = $("#numero").val();
        var aniExhorto = $("#anio").val();
        var mensaje = "";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarExhortoAdscripcion",
                    numExhorto: numExhorto,
                    aniExhorto: aniExhorto,
                    activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    if (datos.totalCount > 0) {
                        $("#idExhorto").val(datos.data[0].idExhorto);
                        $("#idExhortoGenerado").val(datos.data[0].IdExhortoGenerado);
                        desbloqueaCamposInicio();
                        mensaje += "Exhorto Encontrado";
                        $(".mensajeSuccess").append(mensaje);
                        $(".mensajeSuccess").show();
                        setTimeout(function () {
                            $(".mensajeSuccess").hide();
                        }, 4000);
                        return false;
                    }else{
                        mensaje += "El Exhorto que intentas buscar no existe o ya se encuentra registrado";
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                        return false;
                    }
                } catch (e) {
                    alert("Error al buscar exhorto:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de buscar exhorto:\n\n" + otroobj);
            }
        });

    });
    $( "#guardar" ).click(function() {
        $(".mensajeSuccess").empty();
        $(".mensajeError").empty();
        var idExhorto = $("#idExhorto").val();
        var idExhortoGenerado = $("#idExhortoGenerado").val();
        var fojas = $("#txtFojas").val();
        var sintesis = $("#txtSintesis").val();
        var observaciones = $("#txtObservaciones").val();
        var estatus = $("#cmbEstatus").val();
        var mensaje = "";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "guardarOficio",
                    idExhorto: idExhorto,
                    noFojas: fojas,
                    sintesis: sintesis,
                    observaciones: observaciones,
                    cveEstatusExhorto: estatus,
                    activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                console.log(datos);
                try {
                    if(datos.status == "error"){
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                        });
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                        return false;
                    }
                    if(datos.status == "ok"){
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                            $("#txtOficio").val(val.numero);
                            $("#txtOficioAnio").val(val.anio);
                            $("#idActuacion").val(val.idActuacion);
                            $("#formulario-adjuntos").show("slide");
                        });
                        $(".mensajeSuccess").append(mensaje);
                        $(".mensajeSuccess").show();
                        setTimeout(function () {
                            $(".mensajeSuccess").hide();
                        }, 4000);
                        if(idExhortoGenerado > 0){
                            $("#divRespuesta").show("slide");
                        }
                        $("#guardar").hide("slide");
                        return false;
                    }
                } catch (e) {
                    alert("Error al guardar oficio:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de guardar oficio:\n\n" + otroobj);
            }
        });

    });
    $( "#actualizar" ).click(function() {
        $(".mensajeSuccess").empty();
        $(".mensajeError").empty();
        var idExhorto = $("#idExhorto").val();
        var idExhortoGenerado = $("#idExhortoGenerado").val();
        var fojas = $("#txtFojas").val();
        var sintesis = $("#txtSintesis").val();
        var observaciones = $("#txtObservaciones").val();
        var estatus = $("#cmbEstatus").val();
        var mensaje = "";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "actualizaOficio",
                    idExhorto: idExhorto,
                    noFojas: fojas,
                    sintesis: sintesis,
                    observaciones: observaciones,
                    cveEstatusExhorto: estatus,
                    activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                console.log(datos);
                try {
                    if(datos.status == "error"){
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                        });
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                        return false;
                    }
                    if(datos.status == "ok"){
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                            $("#txtOficio").val(val.numero);
                            $("#txtOficioAnio").val(val.anio);
                        });
                        $(".mensajeSuccess").append(mensaje);
                        $(".mensajeSuccess").show();
                        setTimeout(function () {
                            $(".mensajeSuccess").hide();
                        }, 4000);
                        if(idExhortoGenerado > 0){
                            $("#divRespuesta").show("slide");
                        }
                        $("#guardar").hide("slide");
                        return false;
                    }
                } catch (e) {
                    alert("Error al guardar oficio:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de guardar oficio:\n\n" + otroobj);
            }
        });

    });
    $( "#enviarRespuesta" ).click(function() {
        $(".mensajeSuccess").empty();
        $(".mensajeError").empty();
        var idExhorto = $("#idExhorto").val();
        var idActuacion = $("#idActuacion").val();
        var mensaje = "";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "respuestaWs",
                    idExhorto: idExhorto,
                    IdExhortoGenerado: idActuacion,
                    activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                console.log(datos);
                try {
                    if(datos.status == "error"){
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                        });
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                        return false;
                    }
                    if(datos.status == "ok"){
                        console.log(datos);
                        $.each(datos.resultados, function (key, val) {
                            mensaje += val.mensaje;
                            $("#txtNPromocion").val(val.numPromocion);
                            $("#txtAPromocion").val(val.aniPromocion);
                        });
                        $(".mensajeSuccess").append(mensaje);
                        $(".mensajeSuccess").show();
                        setTimeout(function () {
                            $(".mensajeSuccess").hide();
                        }, 4000);
                        $("#divRespuesta").hide("slide");
                        $("#actualizar").hide("slide");
                        bloqueaCamposInicio();
                        return false;
                    }
                } catch (e) {
                    alert("Error al guardar oficio:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de guardar oficio:\n\n" + otroobj);
            }
        });

    });
    $( "#consultar" ).click(function() {
        $("#divFormulario").hide("slide");
        $("#divConsulta").show("slide");
        $("#limpiar").trigger("click");
        $("#tablaActuaciones tbody").empty();
        $(".tablaAdjuntos tbody").empty();
    });
    $( "#regresar" ).click(function() {
        $("#divConsulta").hide("slide");
        $("#divFormulario").show("slide");
    });
    $( "#consultarRespuesta" ).click(function() {
        consultarExhorto(1);
    });
    function consultarExhorto(pagina) {
        $("#tablaActuaciones tbody").empty();
        $("#paginadorActuaciones").empty();
        var numero = $("#txtOficioConsulta").val();
        var anio = $("#txtOficioAnioConsulta").val();
        var fechaInicioConsulta = $("#fechaInicioConsulta").val();
        var fechaFinConsulta = $("#fechaFinConsulta").val();
        var fechaRegistro = JSON.stringify({fechaInicioConsulta, fechaFinConsulta});
        var tabla = "";
        var totalPaginas = 0;
        var numeroRegistros = $("#numeroRegistros").val();
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultarOficios",
                    numExhorto: numero,
                    aniExhorto: anio,
                    pagina: pagina,
                    numeroRegistros: numeroRegistros,
                    partes: fechaRegistro,
                    activo: "S"
                },
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    if(datos.estatus == "ok"){
                        totalPaginas = datos.datos[0].totalPaginas;
                        pagina = datos.datos[0].pagina;
                        $.each(datos.datos, function (count, object) {
                            tabla += "<tr style='cursor:pointer;' onclick='datosFormulario("+JSON.stringify(object)+");'>";
                                tabla += "<td>"+object.numActuacion+"/"+object.aniActuacion+"</td>";
                                tabla += "<td>"+object.numExhorto+"/"+object.aniExhorto+"</td>";
                                if(object.idActuacionPromocion != ""){
                                    tabla += "<td>SI</td>";
                                }else{
                                    tabla += "<td>NO</td>";
                                }
                                tabla += "<td>"+object.desEstatusExhorto+"</td>";
                                if(object.idExhortoGenerado != 0){
                                    tabla += "<td>SI</td>";
                                }else{
                                    tabla += "<td>NO</td>";
                                }
                            tabla += "</tr>";
                        });
                    }else{
                        tabla += "<tr>";
                            tabla += "<td colspan='6' class='text-center'>"+datos.mensaje+"</td>";
                        tabla += "</tr>";
                    }
                } catch (e) {
                    alert("Error al guardar exhorto:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de estados:\n\n" + otroobj);
            }
        });
        $("#tablaActuaciones tbody").append(tabla);
        var paginacion = '';
        paginacion += '<nav>';
        paginacion += '<ul class="pagination">';
        if (totalPaginas > 1) {
            if (pagina != 1)
                paginacion += '<li><a class="paginadorRef" onclick="paginadorRef(' + (pagina - 1) + ');" aria-label="Previous" data-ref="' + (pagina - 1) + '" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            for (var i = 1; i <= totalPaginas; i++) {
                if (pagina == i) {
                    paginacion += '<li class="active"><a href="#">' + pagina + '<span class="sr-only">(current)</span></a></li>';
                } else {
                    paginacion += '<li><a class="paginadorRef" onclick="paginadorRef(' + i + ');" data-ref="' + i + '" href="#">' + i + '</a></li>';
                }
            }
            if (pagina != totalPaginas) {
                pagina = parseInt(pagina) + parseInt(1);
                paginacion += '<li><a class="paginadorRef" onclick="paginadorRef(' + (pagina) + ');" aria-label="Next" data-ref="' + (pagina) + '" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
        paginacion += '</ul>';
        paginacion += '</nav>';
        $("#paginadorActuaciones").append(paginacion);
    }
    paginadorRef = function (pagina) {
        consultarExhorto(pagina);
    },
    datosFormulario = function (object) {
        $("#idExhorto").val(object.idExhorto);
        $("#idExhortoGenerado").val(object.idExhortoGenerado);
        $("#idActuacion").val(object.idActuacion);
        $("#txtNPromocion").val(object.numPromocion);
        $("#txtAPromocion").val(object.aniPromocion);
        $("#numero").val(object.numExhorto);
        $("#anio").val(object.aniExhorto);
        $("#txtOficio").val(object.numActuacion);
        $("#txtOficioAnio").val(object.aniActuacion);
        $("#txtFojas").val(object.noFojas);
        $("#txtSintesis").val(object.sintesis);
        $("#txtObservaciones").val(object.observaciones);
        $("#cmbEstatus").val(object.cveEstatusExhorto);
        $("#buscarExhorto").hide();
        $("#guardar").hide();
        $("#imprimir").show();
        $("#formulario-adjuntos").show();
        if(object.idExhortoGenerado > 0){
            if(object.idActuacionPromocion == ""){
                $("#numero").prop( "disabled", true );
                $("#anio").prop( "disabled", true );
                $("#txtFojas").prop( "disabled", false );
                $("#txtSintesis").prop( "disabled", false );
                $("#txtObservaciones").prop( "disabled", false );
                $("#cmbEstatus").prop( "disabled", false );
                $("#divRespuesta").show();
                $("#actualizar").show();
            }else{
                $("#numero").prop( "disabled", true );
                $("#anio").prop( "disabled", true );
                $("#txtFojas").prop( "disabled", true );
                $("#txtSintesis").prop( "disabled", true );
                $("#txtObservaciones").prop( "disabled", true );
                $("#cmbEstatus").prop( "disabled", true );
                $("#actualizar").hide();
            }
        }else{
            $("#numero").prop( "disabled", true );
            $("#anio").prop( "disabled", true );
            $("#txtFojas").prop( "disabled", false );
            $("#txtSintesis").prop( "disabled", false );
            $("#txtObservaciones").prop( "disabled", false );
            $("#cmbEstatus").prop( "disabled", false );
            $("#actualizar").show();
        }
        $("#regresar").trigger("click");
        muestraAdjuntos(object.adjuntos);
        console.log(object);
    },
    comboEstatus = function () {
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/estatusexhortos/EstatusexhortosFacade.Class.php",
            async: false,
            dataType: "json",
            data: {accion: "consultar", activo: "S"},
            beforeSend: function (objeto) {
            },
            success: function (datos) {
                try {
                    $('.cmbEstatus').empty();
                    $('.cmbEstatus').append('<option value="0">Seleccione una opcion</option>');
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (count, object) {
                            $('.cmbEstatus').append('<option value="' + object.cveEstatusExhorto + '">' + object.desEstatusExhorto + '</option>');
                        });
                    }
                } catch (e) {
                    alert("Error al cargar estatusexhortos:" + e);
                }
            },
            error: function (objeto, quepaso, otroobj) {
                alert("Error en la peticion de estatusexhortos:\n\n" + otroobj);
            }
        });
    };
    bloqueaCamposInicio = function () {
        $("#txtFojas").prop( "disabled", true );
        $("#txtSintesis").prop( "disabled", true );
        $("#txtObservaciones").prop( "disabled", true );
        $("#cmbEstatus").prop( "disabled", true );
    },
    desbloqueaCamposInicio = function () {
        $("#txtFojas").prop( "disabled", false );
        $("#txtSintesis").prop( "disabled", false );
        $("#txtObservaciones").prop( "disabled", false );
        $("#cmbEstatus").prop( "disabled", false );
    },
    limpiaCamposInicio = function () {
        $("#idExhorto").val('');
        $("#idExhortoGenerado").val('');
        $("#txtNPromocion").val('');
        $("#txtAPromocion").val('');
        $("#numero").val('');
        $("#anio").val('');
        $("#txtFojas").val('');
        $("#txtOficio").val('');
        $("#txtOficioAnio").val('');
        $("#txtSintesis").val('');
        $("#txtObservaciones").val('');
        $("#cmbEstatus").val(0);
        $("#numero").prop( "disabled", false );
        $("#anio").prop( "disabled", false );
        $("#buscarExhorto").show("slide");
        $("#guardar").show("slide");
        $("#actualizar").hide("slide");
        $("#imprimir").hide("slide");
        $("#divRespuesta").hide("slide");
        $(".tablaAdjuntos tbody").empty();
        bloqueaCamposInicio();
        $("#totalAdjuntos").val(0);
        actualizaPorcentajeArchivos();
    },
    limpiaConsulta = function () {
        $("#txtOficioConsulta").val('');
        $("#txtOficioAnioConsulta").val('');
        $("#fechaInicioConsulta").val('');
        $("#fechaFinConsulta").val('');
    },
    $( "#imprimir" ).click(function() {
        var idExhorto = $("#idExhorto").val();
        window.open('exhortos/exhortos/frmReporteExhortos.php?id='+idExhorto,'Reporte', '"scrollbars=1,width=1000, height=1000');
    });
    $(".number-only").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
    obtenerMaximoEnvio = function(){
        var maxDefinido = $('#uploadMaxFiles').val();
        return ( ((maxDefinido/1024)/1024) + ' Mb' );
    }

    obtenerMaximoPorArchivo = function(){
        var maxDefinido = $('#uploadMaxSize').val();
        return ( ((maxDefinido/1024)/1024) + ' Mb' );
    }
    eliminaArchivo = function( data ){
        $(".mensajeError").empty();
        var mensaje = "";
        //validación de no borrado de archivo único
        if (obtenerCantidadArchivos() > 1 ){
            data = data.split('|');
            idArchivo = data[0];
            fileSize = data[1];
            //eliminacion fisica del archivo y logica de la base
            $.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/imagenes/ImagenesFacade.Class.php',
                data:{ idImagen:idArchivo,activo:'N',accion:'guardar'},
                success:function(response){
                    //console.log('eliminacion de archivo => '+response);
                    var object = eval("("+response+")");
                    var totalCount = object.totalCount;
                    if( object.totalCount > 0 ){
                        mensaje += "ARCHIVO ELIMINADO SATISFACTORIAMENTE.";
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                    }
                }
            }); 
            //reducción del global de tamaño de archivos adjuntos
            filesSizeAttached -= parseInt(fileSize);
            $('#totalAdjuntos').val( filesSizeAttached );
            actualizaPorcentajeArchivos();
            //eliminacion del renglon del archivo eliminado
            $('#adjunto_' + idArchivo ).remove();
        }else{
            mensaje += "Antes de eliminar el archivo &uacute;nico, debe agregar uno nuevo.";
            $(".mensajeError").append(mensaje);
            $(".mensajeError").show();
            setTimeout(function () {
                $(".mensajeError").hide();
            }, 4000);
        }
    }
    /**
    * Subir archivos
    */
    var uploadfiles = document.querySelector('#uploadfiles');
    uploadfiles.addEventListener('change', function () {
        var mensaje = "";
        var files = this.files;
        var uploadMaxSize = $('#uploadMaxSize').val();
        for(var i=0; i<files.length; i++){
            if( files[i].type == 'application/pdf' ){
                if( uploadMaxSize >= files[i].size ){
                    //console.log( parseInt(actualizaPorcentajeArchivos()) + ' ** ' + 99 );
                    if( parseInt(actualizaPorcentajeArchivos()) <= 99 ){
                        uploadFile(files[i]);
                    }else{
                        mensaje += "Se ha alcanzado el m&aacute;ximo permitido de Mb a adjuntar.";
                        $(".mensajeError").append(mensaje);
                        $(".mensajeError").show();
                        setTimeout(function () {
                            $(".mensajeError").hide();
                        }, 4000);
                    }
                }else{
                    mensaje += "El archivo [ " + files[i].name + " ] excede el tama&ntilde;o m&aacute;ximo permitido. Intente con otro.";
                    $(".mensajeError").append(mensaje);
                    $(".mensajeError").show();
                    setTimeout(function () {
                        $(".mensajeError").hide();
                    }, 4000);
                }
            }else{
                mensaje += "El archivo [ " + files[i].name + " ] No esta en formato PDF, verifique e intente nuevamente.";
                $(".mensajeError").append(mensaje);
                $(".mensajeError").show();
                setTimeout(function () {
                    $(".mensajeError").hide();
                }, 4000);
            }
        }
    }, false);

    /**
     * Upload a file
     * @param file
     */

    function uploadFile(file){
        var url = "../fachadas/exhortos/imagenes/ImagenesFacade.Class.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Every thing ok, file uploaded
                showFileInfo(file,xhr.responseText);
                //console.log(xhr.responseText); // handle response.
            }
        };
        fd.append('uploaded_file', file);
        fd.append('idActuacion', $('#idActuacion').val() );
        fd.append('cveTipoDocumento', '11');
        fd.append('accion', 'guardar');
        xhr.send(fd);
    }

    actualizaPorcentajeArchivos = function(){
        var uploadMaxFiles = $('#uploadMaxFiles').val();
        var filesSizeAttached = $('#totalAdjuntos').val();
        var porcentajeArchivos = parseInt((filesSizeAttached*100)/uploadMaxFiles).toFixed(0);
        $('#progress-bar-filesSize').width(porcentajeArchivos+'%').empty().append( porcentajeArchivos + '%');
        return porcentajeArchivos;
    }


    function showFileInfo(file,response){
        var mensaje = "";
        var obj = eval("("+response+")");
        var data = obj.data;
        var status = data.type;
        var porcentajeArchivos = 0;
        if( status == 'OK' ){
            filesSizeAttached += parseInt(file.size);
            $('#totalAdjuntos').val( filesSizeAttached );
            actualizaPorcentajeArchivos();
            var renglonAdjunto = '<tr id="adjunto_' + data.idImagen + '">'
            //+ '<td>' + file.name + ' => [ ' + data.nombreArchivo + ' ]</td><td>' + data.text + '</td>'
            + '<td>' + file.name + ' => [ ' + data.nombreArchivo + ' ]</td><td>' + parseFloat((file.size)/1048576).toFixed(2) + ' Mb</td>'
            + '<td>'
            + '<button type="button" class="btn btn-default" aria-label="Left Align" onclick="window.open(\'/exhortos/desarrollo/' + data.ruta + '\', \'_blank\')">'
            + '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> &nbsp;&nbsp;&nbsp;'
            + '<button type="button" class="btn btn-danger btn-partes" aria-label="Left Align" onclick="eliminaArchivo(\'' + data.idImagen + '|' + file.size + '\')">'
            + '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>'
            + '</td>'
            + '</tr>';
            $('#tbody-adjuntos').append( renglonAdjunto );
        }else{
            mensaje += 'Archivo [' + file.name + '] <br/>Error: <b>' + data.text + '</b>';
            $(".mensajeError").append(mensaje);
            $(".mensajeError").show();
            setTimeout(function () {
                $(".mensajeError").hide();
            }, 4000);
        }
        $('#uploadfiles').val('');
        /*console.log("name : " + file.name);
        console.log("size : " + file.size);
        console.log("type : " + file.type);
        console.log("date : " + file.lastModified);*/
    }

    muestraAdjuntos = function(adjuntos){
        var renglonAdjunto = '';
        if(  adjuntos != '' ){
        $.each(adjuntos, function(index,object){
            filesSizeAttached += parseInt(object.tamano);
            $('#totalAdjuntos').val( filesSizeAttached );
            actualizaPorcentajeArchivos();          
            renglonAdjunto += '<tr id="adjunto_' + object.idImagen + '">'
            + '<td>' + object.nombreArchivo + '</td><td>' + parseFloat((object.tamano)/1048576).toFixed(2) + ' Mb</td>'
            + '<td>'
            + '<button type="button" class="btn btn-default" aria-label="Left Align" onclick="window.open(\'/exhortos/desarrollo/' + object.ruta + '\', \'_blank\')">'
            + '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> &nbsp;&nbsp;&nbsp;'
            + '<button type="button" class="btn btn-danger btn-partes" aria-label="Left Align" onclick="eliminaArchivo(\'' + object.idImagen + '|'+ object.tamano +'\')">'
            + '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>'
            + '</td>';
            + '</tr>';
        });
        $('#tbody-adjuntos').empty().append( renglonAdjunto );
        }
    }

    /**
    * Función para obtener el total de archivos registrados en la tabla de adjuntos
    */
    obtenerCantidadArchivos = function(){
        return $('.glyphicon-eye-open').length;
    }

    $(function () {
        comboEstatus();
        bloqueaCamposInicio();
        $("#txtOficio").prop( "disabled", true );
        $("#txtOficioAnio").prop( "disabled", true );
        $('.fecha').datetimepicker({
            locale: 'es',
            sideBySide: false,
            format: "DD/MM/YYYY",
            ignoreReadonly: true
        });
        $("#fechaInicioConsulta").on("dp.change", function (e) {
            $('#fechaFinConsulta').data("DateTimePicker").minDate(e.date);
        });
        $("#fechaFinConsulta").on("dp.change", function (e) {
            $('#fechaInicioConsulta').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
