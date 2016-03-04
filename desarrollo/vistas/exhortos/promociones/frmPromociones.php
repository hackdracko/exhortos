<?php
ini_set("log_errors", 0);
ini_set('display_errors', 0);
//ini_set('error_reporting', E_ALL ^ E_NOTICE);
if(session_status() == PHP_SESSION_NONE){ @session_start(); }
    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
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

$idActuacionArbol = "";
$idCarpetaJudicialArbol = "";
$procedencia = 0;

if (isset($_POST['idActuacion'])) {
    $idActuacionArbol = @$_POST['idActuacion'];
}
if (isset($_POST['idCarpetaJudicial'])) {
    $idCarpetaJudicialArbol = @$_POST['idCarpetaJudicial'];
}

if (($idActuacionArbol != 0 && $idActuacionArbol != "") || ($idCarpetaJudicialArbol != 0 && $idCarpetaJudicialArbol != "")) {
    $procedencia = 1; // viene de arbol
} else {
    $procedencia = 0; // formulario general
}

?>

<style type="text/css">
    .tblGridAgrega{
        margin-top: 20px;
        font-family: arial;
        font-size: 11px;
        text-align: center;
    }
    .trGridAgrega{
        color: #ffffff;
        background-color: #427468;
    }
    .mayuscula{  
        text-transform: uppercase;  
    }  
    .trSeleccion:hover{
        background-color:#dff0d8;
        cursor: pointer;
    } 
    .requerido {
        color: darkred;
    }

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
    input[type='text'], textarea { text-transform: uppercase !important; resize: none; }
    .needed:after { color:darkred; content: " (*)"; }    

</style>

<input type="hidden" id="hiddenIdActuacion" value="<?php echo $idActuacionArbol; ?>" >
<input type="hidden" id="hiddenIdActuacionExhGen" value="<?php echo $idCarpetaJudicialArbol; ?>" >
<input type="hidden" id="hiddenCveTipo" value="" >
<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="<?=$_SESSION['nombre']?>" />
<input type="hidden" id="fechaSistema" name="fechaSistema" value="<?=date('d/m/Y G:i:s')?>" />
<!--<input type="hidden" id="hiddenCveTipoCarpeta" value="" >-->
<input type="hidden" id="hiddenCveAdscripcion" value="<?php echo $_SESSION["cveAdscripcion"]; ?>" >
<input type="hidden" id="hiddenIntentoGuardar" value="0" >
<input type="hidden" id="uploadMaxSize" name="uploadMaxSize" value="<?=file_upload_max_size()?>" />
<input type="hidden" id="uploadMaxFiles" name="uploadMaxFiles" value="10485760" /> <!-- 10 Mb -->
<input type="hidden" id="totalAdjuntos" name="totalAdjuntos" value="0" /> <!-- 0 Mb -->


<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title" id="promocionesTitulo">
            Promociones
        </h5>
    </div>
    <div class="panel-body">
        <div id="divFormulario" class="form-horizontal">
            <div id="divCampos">
                <div class="form-group"> 
                    <label class="control-label col-xs-12 col-sm-2 col-md-2">No. y A&ntilde;o de Promoci&oacute;n:</label>
                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <input  disabled="disabled" type="text" id="txtNumActuacion2" placeholder="" class="form-inline" value="" size="7" />
                        /
                        <input disabled="disabled" type="text" id="txtAniActuacion2" placeholder="" class="form-inline" value="" size="7" />
                    </div>                 
                    <!-- <label class="control-label col-xs-1" >Asignaci&oacute;n de N&uacute;mero: </label>
                    <div class="col-xs-4">
                        <div class="col-xs-5">
                            <input type="radio" checked  value="0" name="asigNumero"  ><label >Automatico</label>
                            <input type="radio"   value="1" name="asigNumero"  ><label>Manual</label>
                        </div>
                    </div> -->  
                </div>
                <!--                <div class="form-group">                                                                
                                    <label class="control-label col-xs-3 ">Relacionado con:</label>
                                    <div class="col-xs-6">
                                        <div id="divCmbRelaciones" class="logobox"></div>
                                        <select class="form-control Relacionado" name="cmbTipoCarpeta" id="cmbTipoCarpeta" onchange="changeLabel(this, '')">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>                                
                                </div>-->
                <div class="form-group">                                                                
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed" id="lblRelationName">No. y A&ntilde;o de Exhorto Generado</label>
                    <div id="divSinRelacion" class="col-xs-12 col-sm-4 col-md-2">
                        <input type="text" id="txtNumero" class="form-inline Relacionado" id="txtNumero" placeholder="N&uacute;mero" size="7"/>
                        /
                        <input type="text" class="form-inline Relacionado" id="txtAnio"  id="txtAnio" placeholder="A&ntilde;o" size="7"/>
                    </div>
                    <div id="divSinRelacionMsg" class="col-xs-12 col-sm-6 col-md-8">
                    </div>
                </div>
                <div class="form-group">                                                                
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">No. Fojas</label>
                    <div class="col-xs-12 col-sm-8 col-md-2">
                        <input type="text" id="txtFojas" placeholder="No Fojas" class="form-control" value="" size="7" />
                    </div>
                </div>
                <div class="form-group">                                                                
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">Tipo de Persona</label>
                    <div class="col-xs-12 col-sm-3 col-md-3" id="divTiposPersonas">
                        <select class="form-control " name="cmbTiposPersonas" id="cmbTiposPersonas" onchange="ocultarCampos(this.value);" ></select>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3" id="divGeneros">
                        <select class="form-control " name="cmbGeneros" id="cmbGeneros" ></select>
                    </div>
                </div>
                <div id="divPromoventes" class="form-group rnActor">
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">Promovente:</label>
                    <div class="col-xs-12 col-sm-3 col-md-3 divNombre" >
                        <input type="text" name="txtPaternoAct" id="txtPaternoAct"
                            value="" placeholder="Ap. Paterno" class="form-control txtActor"
                            onKeyPress="return capturaNombrePersona(event, 'txtMaternoAct', 'txtActor', 'lstActores', 'cmbTiposPersonas');" />
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 divNombre" >
                        <input type="text" name="txtMaternoAct" id="txtMaternoAct"
                            value="" placeholder="Ap. Materno" class="form-control txtActor"
                            onKeyPress="return capturaNombrePersona(event, 'txtNombreAct', 'txtActor', 'lstActores', 'cmbTiposPersonas');" />
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 divDescNombre">
                        <input type="text" name="txtNombreAct" id="txtNombreAct"
                            value="" placeholder="Nombre(s)" class="form-control txtActor"
                            onKeyPress="return capturaNombrePersona(event, 'agregaPersona', 'txtActor', 'lstActores', 'cmbTiposPersonas');" />
                    </div>

                </div>
                <div  class="form-group">
                    <div class="col-xs-10 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-7 col-md-offset-2">
                        <input type="submit" class="btn btn-primary" id="inputAgregarPro" value="Agregar Promovente" onclick="return capturaNombrePersonaBoton(event, 'agregaPersona', 'txtActor', 'lstActores', 'cmbTiposPersonas','cmbGeneros');"> &nbsp;
                        <input type="submit" class="btn btn-primary" id="inputLimpiarPro" value="Limpiar Promovente" onclick="limpiarPromovente();"> 
                    </div>
                </div>
                <div id="divListaPromoventes" class="form-group">
                    <input type="hidden" id="hiddenIdentificador"  value=""/>
                    <input type="hidden" id="hiddenIdPromovente"  value="0"/>
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">Lista promovente(s):</label>
                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <table id="ltsPromoventes" class="table table-bordered table-responsive table-hover tblGridAgrega" ></table>
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">Sintesis</label>
                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <input type="text" id="txtSintesis" placeholder="Sintesis" class="form-control" value=""/>
                    </div>
                </div>
                <div id="divNotas" class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-md-2 needed">Notas:</label>
                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <textarea rows="5" id="txtNotas" class="form-control" placeholder="Notas"></textarea>
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="formulario-adjuntos" style="display: none;">
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
                                <table border="1" align="center"  width="90%"  class="table table-bordered table-striped table-hover table-responsive tablaPartes">
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
                                <!-- TABLA DE ARCHIVOS/ -->
                                <!-- FIN DE FORMULARIO DE ADJUNTOS -->
                    </fieldset>
                </form>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" class="btn btn-primary" id="inputGuardar" value="Guardar" onclick="guardarPromocion();">
                        <input type="submit" class="btn btn-primary" id="inputRegresar" value="Regresar" onclick="regresar();" style="display: none">                                    
                        <input type="submit" class="btn btn-primary" id="inputLimpiar" value="Limpiar" onclick="limpiar();">
                        <input type="submit" class="btn btn-primary" id="inputConsultar" value="Consultar" onclick="consultar('divCamposConsulta'); limpiar();">
                        <input type="submit" class="btn btn-primary" id="inputBuscar" value="Buscar" onclick="consultarAcuerdos();" style="display: none">                                    
                        <input type="submit" class="btn btn-primary" id="inputEliminar" value="Eliminar" onclick="eliminarPromocion()" style="display: none;">
                        <input type="submit" class="btn btn-primary print-link no-print" id="inputImprimir" value="Imprimir" onclick="imprimirRecibo()" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <div id="divAdvertencia" class="alert alert-warning alert-dismissable" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="strAdvertencia"></strong> 
                    </div>
                    <div id="divCorrecto" class="alert alert-success alert-dismissable" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="strCorrecto"></strong> 
                    </div>
                    <div id="divError" class="alert alert-danger alert-dismissable" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="strError"></strong>
                    </div>
                    <div id="divInformacion" class="alert alert-info alert-dismissable" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="strInformacion"></strong>
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

        </div>

        <div id="divCamposConsulta" class="form-horizontal" style="display: none">
            <div class="form-group">
                <div class="col-xs-1">                       
                    <input type="submit" class="btn btn-primary" id="inputRegresar" value="Regresar" onclick="consultar('divCampos'); limpiarBusqueda();" style="display: block">
                </div>
            </div>
<!--             <div class="form-group">                                                                
                <label class="control-label col-xs-12 col-sm-2 col-md-2" id="lblRelationName2">No. y A&ntilde;o de Exhorto Generado</label>
                <div id="divSinRelacion" class="col-xs-12 col-sm-8 col-md-7">
                    <input type="text" class="form-inline" id="txtNumero2" placeholder="N&uacute;mero" size="7"/>
                    /
                    <input type="text" class="form-inline" id="txtAnio2"  placeholder="A&ntilde;o" size="7"/>
                </div>                                
                <div id="divSinRelacionMsg" class="col-xs-6">
                </div>                                
            </div> -->
            <div class="form-group">                                                                
                <label class="control-label col-xs-12 col-sm-2 col-md-2" id="lblRelationName">No. y A&ntilde;o de Promoci&oacute;n</label>
                <div id="divSinRelacion" class="col-xs-12 col-sm-8 col-md-7">
                    <input type="text"  class="form-inline " id="txtNumActuacion" placeholder="N&uacute;mero" size="7"/>
                    /
                    <input type="text" class="form-inline " id="txtAniActuacion"  placeholder="A&ntilde;o" size="7"/>
                </div>                                
                <div id="divSinRelacionMsg" class="col-xs-6">
                </div>                                
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 col-md-2" id="lblRelationName">Fecha Inicial</label>
                <div class="col-xs-12 col-sm-2 col-md-2">
                    <input type="text" id="txtfechaInicial" placeholder="FECHA INICIAL" class="form-control datepicker" value=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 col-md-2" id="lblRelationName">Fecha Final</label>
                <div class="col-xs-12 col-sm-2 col-md-2">
                    <input type="text" id="txtfechaFinal" placeholder="FECHA FINAL" class="form-control datepicker" value=""/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-xs-offset-2 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2">
                    <div class="col-xs-2 col-sm-4 col-md-3">
                        <input type="submit" class="btn btn-primary" id="inputBuscar" value="Buscar" onclick="buscarPromocion(0);"/>
                        <input type="submit" class="btn btn-primary" id="inputLimpiar" value="Limpiar" onclick="limpiarBusqueda();"/>                                    
                    </div>
                </div>
            </div>
        </div>
        <div id="divConsulta" style="display: none" class="col-xs-12">
            <div class="col-xs-12">
                <div class="col-xs-3">
                    <input type="submit" class="btn btn-primary" value="Regresar" onclick="consultar('divCamposConsulta'); $('#cmbPaginacion').val(1); limpiarBusqueda();">
                    <!-- regresaBusqueda(1); -->
                </div>
<!--                 <div class="form-group col-xs-2" style="padding: 10px">
                    <label class="control-label" id="totalReg"></label>
                </div>
                <div id="divPaginador" class="form-group col-xs-2" >
                    <label class="control-label">Pagina:</label>
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="buscarPromocion();">
                        <option value="1">1</option>
                    </select>
                </div>
                <div id="divPaginador" class="form-group col-xs-4" >
                    <label class="control-label">Registros por p&aacute;gina:</label>
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="buscarPromocion();">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div> -->
            </div>
            <br/>
            <br/>
            <div id="divTableResult" class="col-xs-12">
            </div>
        </div>
        </div>
        <div class="form-group">
            <div id="divAlertWarning2" class="alert alert-warning alert-dismissable">                    
                <strong>Advertencia!</strong> Mensaje
            </div>
            <div id="divAlertSucces2" class="alert alert-success alert-dismissable">

                <strong>Correcto!</strong> Mensaje
            </div>
            <div id="divAlertDager2" class="alert alert-danger alert-dismissable">

                <strong>Error!</strong> Mensaje
            </div>
            <div id="divAlertInfo2" class="alert alert-info alert-dismissable">

                <strong>Informaci&oacute;n!</strong> Mensaje
            </div>
        </div>    

        <div id="imprimir" style="display: none;">
            <div id="printable" ></div>
            <div id="botones">
                <input type="submit" class="btn btn-primary" id="inputRegresar" value="Regresar" onclick="consultar('divCampos');" style="display: block"> 
            </div>
        </div>
    </div>

<script type="text/javascript">
    limpiarBusqueda = function () {
        $("#cmbTipoCarpeta2").val("0");
        $("#txtNumero2").val("");
        $("#txtAnio2").val("");
        $("#txtNumActuacion").val("");
        $("#txtAniActuacion").val("");
        var d = new Date();
        var month = new Array();
        month[0] = "01";
        month[1] = "02";
        month[2] = "03";
        month[3] = "04";
        month[4] = "05";
        month[5] = "06";
        month[6] = "07";
        month[7] = "08";
        month[8] = "09";
        month[9] = "10";
        month[10] = "11";
        month[11] = "12";

        var day = new Array();
        day[1] = "01";
        day[2] = "02";
        day[3] = "03";
        day[4] = "04";
        day[5] = "05";
        day[6] = "06";
        day[7] = "07";
        day[8] = "08";
        day[9] = "09";
        var dia = d.getDate();
        if (dia < 10) {
            dia = day[dia];
        }
        var fecha = dia + "/" + month[d.getMonth()] + "/" + d.getFullYear();
        $("#txtfechaInicial").val(fecha);
        $("#txtfechaFinal").val(fecha);
    };

    limpiarPromovente = function () {
        $("#cmbTiposPersonas").val(0);
        $("#cmbTiposPersonas").prop("disabled", false);
        $("#cmbGeneros").val(0);
        $("#txtPaternoAct").val("");
        $("#txtMaternoAct").val("");
        $("#txtNombreAct").val("");
        $("#hiddenIdPromovente").val("0");
        $("#hiddenIdentificador").val("");
        $(".required").remove();
        $("#cmbGeneros").removeAttr('disabled');
        ocultarCampos(1);
    };

    eliminarPromovente = function (identificador) {
        //  alert("identificador" + identificador);
        $("#" + identificador).remove();
        //validar la existencia del elemento
        var item_id = find_in_object(promoventes.data, 'id', identificador);
        //si existe el elemento lo borra
        if(item_id > -1){
                promoventes.data.splice(item_id, 1);
                promoventes.counter--;
        }
    };

    /**
    * FunciOn para buscar dentro de un array un elemento a travEs de una llave, el resultado es el indice del elemento
    * @param {array} array Es el array en donde se buscarA el elemento
    * @param {string} property Es el nombre del campo en el cual se buscarA
    * @param {string} value Es el valor a encontrar
    * @return {integer} index Si encuentra el elemento regresa '-1' en otro caso regresa la posiciOn del elemento
    */
    function find_in_object(array, property, value) {
        var index2 = array.map(function(d) { 
            return d[property]; 
        });
        var index = index2.indexOf(value);
        return index;
    }

    cargarPromovente = function (identificador) {
        var cveTipoPersona = $("#" + identificador).attr("data-cvetipopersona");
        var cveGenero = $("#" + identificador).attr("data-cvegenero");
        var idPromovente = $("#" + identificador).attr("data-idpromovente");
        var nombre = $("#" + identificador).attr("data-nombre");
        nombre = nombre.split(',');
        ocultarCampos(cveTipoPersona);
        if (cveTipoPersona == 1) {
            $("#txtPaternoAct").val("");
            $("#txtMaternoAct").val("");
        }
        $("#cmbTiposPersonas").val(cveTipoPersona);
        $("#cmbGeneros").val(cveGenero);
        $("#txtPaternoAct").val(nombre[0]);
        $("#txtMaternoAct").val(nombre[1]);
        $("#txtNombreAct").val(nombre[2]);
        $("#hiddenIdentificador").val(identificador);
        $("#hiddenIdPromovente").val(idPromovente);
        $("#inputAgregarPro").val("Modificar Promovente");
    };

    agregarPromovente = function (idPromovente, cveTipoPersona, descTipoPersona, cveGenero, descGenero, nombre) {
        try {
            var hiddenIdentificador = $("#hiddenIdentificador").val();
            var totalRenglones = $("#ltsPromoventes tr").length;
        //alert("total de renglones " + totalRenglones);
            if (totalRenglones == 0) {
                $("#ltsPromoventes").show();
                var cabeceras = '<tr class=\"trGridAgrega\"><th>Tipo Persona</th><th>Nombre</th><th>G&eacute;nero</th><th></th></tr>';
                $("#ltsPromoventes").append(cabeceras);
            }
            var identificador = nombre.join("");

            if (cveTipoPersona == 2) {
                identificador = identificador.replace(/\s+/g, '');

            }
            identificador = identificador.replace(/\s+/g, '');
            if (hiddenIdentificador == "") {
                var renglon = "<tr onclick='cargarPromovente(\"" + identificador + "\")' id='" + identificador + "' class=\"trSeleccion\"><td>" + descTipoPersona + "</td><td>" + nombre.join(" ") + "</td><td>" + descGenero + "</td><td><a onclick='eliminarPromovente(\"" + identificador + "\")'><img src='../vistas/img/eliminar.png' width='30' height='30'></a></td></tr>";
                $("#ltsPromoventes").append(renglon);
                $('#' + identificador).attr('data-' + "cvetipopersona", cveTipoPersona);
                $('#' + identificador).attr('data-' + "idpromovente", idPromovente);
                $('#' + identificador).attr('data-' + "cvegenero", cveGenero);
                $('#' + identificador).attr('data-' + "nombre", nombre);
                //insercion de datos en el array -promoventes.data-
                promoventes.data[promoventes.counter] = {
                    id:identificador,
                    cveTipoPersona:cveTipoPersona,
                    descTipoPersona:descTipoPersona,
                    paterno:nombre[0],
                    materno:nombre[1],
                    nombre:nombre[2],
                    nombrePersonaMoral:nombre[2]
                };
                promoventes.counter++;
            } else {
                //selector.attr("data-change-me","someValue");
                $('#' + hiddenIdentificador + " td").remove();
                $('#' + hiddenIdentificador).attr("data-cvetipoPersona", cveTipoPersona);
                $('#' + hiddenIdentificador).attr("data-idpromovente", idPromovente);
                $('#' + hiddenIdentificador).attr("data-cvegenero", cveGenero);
                $('#' + hiddenIdentificador).attr("data-nombre", nombre);
                $('#' + hiddenIdentificador).attr('onclick', "cargarPromovente(\"" + identificador + "\")");
                $('#' + hiddenIdentificador).append("<td>" + descTipoPersona + "</td><td>" + nombre.join(" ") + "</td><td>" + descGenero + "</td><td><a onclick='eliminarPromovente(\"" + identificador + "\")'><img src='../vistas/img/eliminar.png' width='30' height='30'></a></td>");
                $('#' + hiddenIdentificador).attr("id", identificador);
                //eliminacion del dato previo
                //validar la existencia del elemento
                var item_id = find_in_object(promoventes.data, 'id', hiddenIdentificador);
                //si existe el elemento lo borra
                if(item_id > -1){
                        promoventes.data.splice(item_id, 1);
                        promoventes.counter--;
                }
                //insercion de datos en el array -promoventes.data-
                promoventes.data[promoventes.counter] = {
                    id:identificador,
                    cveTipoPersona:cveTipoPersona,
                    descTipoPersona:descTipoPersona,
                    paterno:nombre[0],
                    materno:nombre[1],
                    nombre:nombre[2],
                    nombrePersonaMoral:nombre[2]
                };
                promoventes.counter++;
                $("#hiddenIdentificador").val("");
                $("#hiddenIdPromovente").val("0");
                $("#inputAgregarPro").val("Agregar Promovente");
            }
        } catch (e) {
            alert('Error al agregar promovente: ' + e);
        }
    };

    cargaTipoCarpeta = function () {
        var strDatos = "accion=consultar";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/tiposcarpetas/TiposcarpetasFacade.Class.php",
            data: strDatos,
            async: true,
            dataType: "html",
            beforeSend: function (objeto) {
                // $('#divCmbRelaciones').html('<center> <br/><img src="../img/cargando.gif" width="20"/></center>');
            },
            success: function (datos) {
                var json = "";
                json = eval("(" + datos + ")"); //Parsear JSON

                if (json.totalCount > 0) {
                    for (var i = 0; i < json.totalCount; i++) {
                        $("#cmbTipoCarpeta").append($('<option></option>').val(json.data[i].cveTipoCarpeta).html(json.data[i].desTipoCarpeta));
                        $("#cmbTipoCarpeta2").append($('<option></option>').val(json.data[i].cveTipoCarpeta).html(json.data[i].desTipoCarpeta));
                    }
                    //$("#cmbTipoCarpeta").append($('<option></option>').val(9).html("SIN RELACI&Oacute;N"));
                    //$("#cmbTipoCarpeta2").append($('<option></option>').val(9).html("SIN RELACI&Oacute;N"));
                }
                $('#divCmbRelaciones').hide();
            },
            error: function (objeto, quepaso, otroobj) {
                //alert("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").html("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").show("slide");
                setTimeAlert("divAlertDager");
            }
        });
    };

    regresaBusqueda = function () {
        $("#divConsulta").hide();
        $("#divCamposConsulta").show();
    };

    var juzgadoSesion = "<?php $_SESSION['cveAdscripcion']; ?>";
    var cveUsuarioSesion = "<?php echo $_SESSION["cveUsuarioSistema"]; ?>";
    var procedencia = "<?php echo $procedencia; ?>";
    var titulos = {
        'titulo1':'Promociones',
        'titulo1a':'<a href="#" style="text-decoration:underline" onclick="consultar(\'divCampos\'); limpiarBusqueda();">Promociones</a>',
        'titulo2':'B&uacute;squeda',
        'titulo2a':'<a href="#" style="text-decoration:underline" onclick="consultar(\'divCamposConsulta\'); $(\'#cmbPaginacion\').val(1); limpiarBusqueda();">B&uacute;squeda</a>',
        'titulo3':'Resultados',
        'titulo3a':'<a href="#" style="text-decoration:underline" onclick="cambiaModulo(\'resultados\')">Resultados</a>'
    }

    consultar = function (elementomostrar) {
        if (elementomostrar === "divCamposConsulta") {
            $("#divCamposConsulta").show();
            $("#imprimir").hide();
            $("#divCampos").hide();
            $("#divConsulta").hide();
            $('#promocionesTitulo').empty().append(titulos['titulo1a'] + ' > ' + titulos['titulo2']);
        } else if (elementomostrar === "imprimir") {
            $("#divCamposConsulta").hide();
            $("#imprimir").show();
            $("#divCampos").hide();
        } else if (elementomostrar === "divCampos") {
            $("#divCamposConsulta").hide();
            $("#imprimir").hide();
            $("#divCampos").show();
            $("#divConsulta").hide();
            $('#promocionesTitulo').empty().append(titulos['titulo1']);
        }
    }

    buscarPromocion = function (pag) {
        var numero = $("#txtNumero2").val();
        var anio = $("#txtAnio2").val();
        var numActuacion = $("#txtNumActuacion").val();
        var aniActuacion = $("#txtAniActuacion").val();
        var fechaInicial = $("#txtfechaInicial").val();
        var fechaFinal = $("#txtfechaFinal").val();
        var cveAdscripcion = $("#hiddenCveAdscripcion").val();
        var pag = $("#cmbPaginacion").val()
        var cantReg = $("#cmbNumReg").val();
        var table = "";
        $.ajax({
            type: "POST",
            async: false,
            dataType: "json",
            url: "../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php",
            data: {
                ExhNumero: numero,
                ExhAnio: anio,
                numActuacion: numActuacion,
                aniActuacion: aniActuacion,
                txtFecInicialBusqueda: fechaInicial,
                txtFecFinalBusqueda: fechaFinal,
                cveTipoDocumento : '13',
                accion: "consultarActuacion_Promocion",
                cveJuzgado: cveAdscripcion,
                cveTipoActuacion: "2", //Id de promocion
                pag: pag,
                cantxPag: cantReg,
                paginacion: "paginacion",
            },
            beforeSend: function (xhr) {
            },
            success: function (data, textStatus, jqXHR) {
                if (data.estatus == "ok") {
                    if (pag == 1) {
                        if (data.totalCount.totalCount > 0) {
                            //$('#cmbPaginacion').find('option').remove().end().append('<option value="0">Seleccione pagina</option>').val('0');
                            $('#cmbPaginacion').find('option').remove().end();
                            for (var i = 0; i < (parseInt(data.total)); i++) {
                                $("#cmbPaginacion").append($('<option></option>').val(i + 1).html(i + 1));
                            }
                            $("#cmbPaginacion").val(pag);
                            $("#totalReg").html("<b> Total: " + data.totalCount + "</b>");
                        }

                    }
                    $("#divCamposConsulta").hide();
                    $("#divConsulta").show();
                    //actualizacion del titulo
                    $('#promocionesTitulo').empty().append(titulos['titulo1a'] + ' > ' + titulos['titulo2a'] + ' > ' + titulos['titulo3']);
                    table += "<table id='tblResultadosGrid' class='table table-hover table-striped table-bordered table-responsive'>";
                    table += "    <thead>";
                    table += "        <tr>";
                    table += "            <th>N&uacute;m.</th>";
                    table += "            <th>No. / A&ntilde;o de la Promocion</th>";
                    table += "            <th>No. / A&ntilde;o del Exhorto Generado</th>";
                    table += "            <th>Sintesis</th>";
                    table += "            <th>Notas</th>";
                    table += "            <th>Promoventes</th>";
                    table += "            <th>Fecha de registro</th>";
                    table += "        </tr>";
                    table += "    </thead>";
                    table += "    <tbody>";
                    $.each(data.datos, function (index, element) {
                        var promoventes = "";
                        $.each(element.promoventes, function (index2, element2) {
                            var nombre = "";
                            var paterno = "";
                            var materno = "";
                            if (element2.nombrePersonaMoral != "") {
                                nombre = element2.nombrePersonaMoral;
                            }else if (element2.nombre != "") {
                                nombre = element2.nombre;
                            }
                            if (element2.paterno != null) {
                                paterno = element2.paterno;
                            }
                            if (element2.materno != null) {
                                materno = element2.materno;
                            }

                            promoventes += "&raquo; " + paterno + " " + materno + " " + nombre + "<br>";
                        });
                        table += "<tr onclick='muestraPromocion(" + JSON.stringify(element) + ")'>";
                        table += "        <td> " + (index + 1) + "</td>";
                        table += "        <td>" + element.numActuacion + " / " + element.aniActuacion + "</td>";
                        table += "        <td>" + element.numExhorto + " / " + element.anioExhorto + "</td>";
                        table += "        <td>" + element.sintesis + "</td>";
                        table += "        <td>" + element.observaciones + "</td>";
                        table += "        <td>" + promoventes + "</td>";
                        table += "        <td>" + element.fechaRegistro + "</td>";
                        table += "    </tr> ";
                    });
                    table += "</tbody>";
                    table += "</table>";
                    $("#divHideForm").hide();
                    $("#divTableResult").html(table);
                    /*$("#tblResultadosGrid").DataTable(
                            {
                                paging: false
                            }
                    );*/
                } else {
                    $("#divAlertDager2").html(data.mensaje);
                    $("#divAlertDager2").show("slide");
                    setTimeAlert("divAlertDager2");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("error =>" + textStatus);
            }
        });
    };

    muestraPromocion = function ( objeto ) {
        objetoImpresion = objeto;
        consultar("divCampos"); 
        $("#divConsulta").hide();
        //muestra datos en formulario
        $("#txtNumActuacion2").val(objeto.numActuacion);
        $("#txtAniActuacion2").val(objeto.aniActuacion);
        $("#txtNumero").val(objeto.numExhorto);
        $("#txtAnio").val(objeto.anioExhorto);
        $("#txtFojas").val(objeto.fojas);
        $("#txtSintesis").val(objeto.sintesis);
        $("#txtNotas").val(objeto.observaciones);
        $("#hiddenIdActuacion").val(objeto.idActuacion);
        $("#hiddenIdActuacionExhGen").val(objeto.idReferencia);
        $("#ltsPromoventes").empty().show();
        $.each(objeto.promoventes, function (index, element) {
            var nombres = [];
            if (element.cveTipoPersona == 1) {
                nombre = element.nombre;
                paterno = element.paterno;
                materno = element.materno;
                nombres = [paterno, materno, nombre]
            } else {
                paterno = "";
                materno = "";
                nombre = element.nombrePersonaMoral;
                nombres = [paterno, materno, nombre]
            }
            //idPromovente, cveTipoPersona, descTipoPersona, cveGenero, descGenero, nombre
            agregarPromovente(element.idPromoventeActuacion, element.cveTipoPersona, element.descTipoPersona, element.cveGenero, element.descGenero, nombres)
        });
        $('#inputEliminar, #inputImprimir').show(); 
        $('#formulario-adjuntos').show();
        muestraAdjuntos( objeto.adjuntos );
    };

    cargarTiposPersonas = function () {
        var strDatos = "accion=consultar";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/tipospersonas/TipospersonasFacade.Class.php",
            data: strDatos,
            async: true,
            dataType: "html",
            beforeSend: function (objeto) {
                // $('#divCmbRelaciones').html('<center> <br/><img src="../img/cargando.gif" width="20"/></center>');
            },
            success: function (datos) {
                var json = "";
                json = eval("(" + datos + ")"); //Parsear JSON
                var opciones = '';
                if (json.totalCount > 0) {
                    var checked = "";
                    opciones += "<option value='0'>--SELECCIONE--</option>";
                    for (var i = 0; i < json.totalCount; i++) {
                        opciones += "<option value='" + json.data[i].cveTipoPersona + "'>" + json.data[i].desTipoPersona + "</option>";
                    }
                }else{
                    opciones += "<option value='0'>--NO HAY REGISTROS--</option>";
                }
                $("#cmbTiposPersonas").append( opciones );

            },
            error: function (objeto, quepaso, otroobj) {
                //alert("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").html("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").show("slide");
                setTimeAlert("divAlertDager");
            }
        });
    };

    cargarGeneros = function () {
        var strDatos = "accion=consultar";
        $.ajax({
            type: "POST",
            url: "../fachadas/exhortos/generos/GenerosFacade.Class.php",
            data: strDatos,
            async: true,
            dataType: "json",
            beforeSend: function (objeto) {
                // $('#divCmbRelaciones').html('<center> <br/><img src="../img/cargando.gif" width="20"/></center>');
            },
            success: function (datos) {
                var opciones = '';
                if (datos.totalCount > 0) {
                    opciones += "<option value='0'>--SELECCIONE--</option>";
                    $.each(datos.data, function (index, element) {
                        opciones += "<option value = " + element.cveGenero + ">" + element.desGenero + "</option>";
                    });
                } else {
                    opciones += "<option value='0'>--NO HAY REGISTROS--</option>";
                    $("#divAlertDager").html("Error en la peticion:\n\n" + "Sin resultados");
                    $("#divAlertDager").show("slide");
                    setTimeAlert("divAlertDager");
                }
                $("#cmbGeneros").append(opciones);
            },
            error: function (objeto, quepaso, otroobj) {
                //alert("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").html("Error en la peticion:\n\n" + quepaso);
                $("#divAlertDager").show("slide");
                setTimeAlert("divAlertDager");
            }
        });
    };

    ocultarCampos = function (cveTipoPersona) {
        var myClass = $("#txtNombreAct").parent().attr("class");
        if (cveTipoPersona == 1 || cveTipoPersona ==0) {
            $("#cmbGeneros").val(0);
            $("#cmbGeneros").removeAttr('disabled');
            $(".divNombre").show();
/*            if (myClass === "col-xs-6") {
                $("#txtNombreAct").parent().toggleClass('col-xs-6');
                $("#txtNombreAct").parent().toggleClass('col-xs-2');
            }*/
            $('.divDescNombre').removeClass('col-sm-9 col-md-9').addClass('col-sm-3 col-md-3');
            $('#txtPaternoAct, #txtMaternoAct, #txtNombreAct').val('');
        } else if (cveTipoPersona == 2 || cveTipoPersona == 3) {
            $(".divNombre").hide();
            $("#cmbGeneros").val("3");
            $("#cmbGeneros").attr('disabled', true);
/*            if (myClass === "col-xs-2") {
                $("#txtNombreAct").parent().toggleClass('col-xs-2');
                $("#txtNombreAct").parent().toggleClass('col-xs-6');
            }*/
            $('.divDescNombre').removeClass('col-sm-3 col-md-3').addClass('col-sm-9 col-md-9');
        }
    };

    changeLabel = function (objOption, clave) {
        $("#lblRelationName" + clave).html("No. " + $("#" + objOption.id + " option:selected").text() + ":");
        $("#hiddenCveTipoCarpeta" + clave).val($("#cmbTipoCarpeta").val());
        if ($("#cmbTipoCarpeta" + clave).val() == 9) {
            $("#txtNumero" + clave).val("");
            $("#txtAnio" + clave).val("");
            $("#divSinRelacion").hide();
        } else {
            $("#txtNumero" + clave).val("");
            $("#txtAnio" + clave).val("");
            $("#divSinRelacion").show();
        }
    };

    validarFormulario = function () {
        $(".required").remove();
        //var cveTipoCarpeta = $("#cmbTipoCarpeta").val();
        var numero = $("#txtNumero").val();
        var anio = $("#txtAnio").val();
        var idReferencia = $("#hiddenIdActuacionExhGen").val();
        var idActuacion = $("#hiddenIdActuacion").val();
        var fojas = $("#txtFojas").val();
        var genero = $('#cmbGeneros').val();
        var sintesis = $("#txtSintesis").val();
        var observaciones = $("#txtNotas").val();
        var numActuacion = $("#txtNumActuacion2").val();
        var aniActuacion = $("#txtAniActuacion2").val();
        var cveAdscripcion = $("#hiddenCveAdscripcion").val();
        var listaPromoventes = new Array();
        var JsonPromoventes = "";
        //var asigNumero = $("input:radio[name=asigNumero]:checked").val();
        var guardar = 1;

        var intentoGuardar = $("#hiddenIntentoGuardar").val();

        if (intentoGuardar == 1) {

            /*if ($("input:radio[name=asigNumero]:checked").val() == 1) {
                if (numActuacion == "") {
                    $("#txtNumActuacion2").parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese el numero de la promoci&oacute;n</label>");

                }
                if (numActuacion == "") {
                    $("#txtAniActuacion2").parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese el a&ntildeo de promoci&oacute;n</label>");
                }
            }*/
            if (numero === "") {
                guardar = 0;
                $('#txtNumero').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar el n&uacute;mero del Exhorto Generado.</label>");
            }
            if (anio === "") {
                guardar = 0;
                $('#txtAnio').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar el a&ntilde;o del Exhorto Generado.</label>");
            }
            if (fojas === "") {
                guardar = 0;
                $('#txtFojas').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar el n&uacute;mero de fojas.</label>");
            }
            if (sintesis === "") {
                guardar = 0;
                $('#txtSintesis').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar la S&iacute;ntesis.</label>");
            }
            if (observaciones === "") {
                guardar = 0;
                $('#txtNotas').parent().append("<br class='required'><label class='Arial13Rojo required'>Debe ingresar las Notas.</label>");
            }
            /*if (idReferencia === "" && cveTipoCarpeta != 9) {
                guardar = 0;
                //  alert("aqui =>" + cveTipoCarpeta);

                $('#cmbTipoCarpeta').parent().append("<br class='required'><label class='Arial13Rojo required'>La carpeta relacionada no existe por favor verifique</label>");
            }*/
            var totalRenglones = $("#ltsPromoventes tr").length;
            if (totalRenglones > 1) {

            } else {
                $("#ltsPromoventes").parent().append("<br class='required'><label class='Arial13Rojo required'>Debe registrar al menos un promovente</label>");
                guardar = 0;
            }
        }
        return guardar;
    };

    guardarPromocion = function () {
        $(".required").remove();
        //$("#hiddenIntentoGuardar").val("1");
        var numero = $("#txtNumero").val();
        var anio = $("#txtAnio").val();
        var idReferencia = $("#hiddenIdActuacionExhGen").val();
        var idActuacion = $("#hiddenIdActuacion").val();
        var fojas = $("#txtFojas").val();
        var sintesis = $("#txtSintesis").val();
        var observaciones = $("#txtNotas").val();
        //var numActuacion = $("#txtNumActuacion2").val();
        //var aniActuacion = $("#txtAniActuacion2").val();
        var cveAdscripcion = $("#hiddenCveAdscripcion").val();
        var cveTipo = $("#hiddenCveTipo").val();
        var listaPromoventes = new Array();
        var JsonPromoventes = "";
        //var asigNumero = $("input:radio[name=asigNumero]:checked").val();
        var guardar = 1;
        $("#hiddenIntentoGuardar").val("1");

        var totalRenglones = $("#ltsPromoventes tr").length;
        if (totalRenglones > 1) {
            $("#ltsPromoventes tr").each(
                    function () {
                        var identificador = $(this).attr("id");
                        if (typeof identificador != "undefined") {
                            var cveTipoPersona = $(this).attr("data-cvetipopersona");
                            var idPromovente = $(this).attr("data-idpromovente");
                            var cveGenero = $(this).attr("data-cvegenero");
                            var nombre = $(this).attr("data-nombre");
                            nombre = nombre.split(",");
                            listaPromoventes.push(new promovente(idPromovente, cveTipoPersona, cveGenero,
                                    nombre[0], nombre[1], nombre[2])); //xxx
                        }
                    });
            if (listaPromoventes.length > 0) {
                JsonPromoventes = JSON.stringify(listaPromoventes);
                JsonPromoventes = decodeURIComponent(JsonPromoventes);
            } else {
                guardar = 0;

            }
        }
        guardar = validarFormulario();
        if (guardar == 1) {
            //    alert("todos los campos estan completos \n" + cveTipoCarpeta + " || " + numero + " || " + anio + " || " + fojas + " || " + sintesis + " || " + observaciones + " || " + JsonPromoventes);
            var accion = "guardarActuacion_Promocion";
            if (idActuacion > 0) {
                accion = "actualizarActuacion_Promocion";
            }
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php",
                async: false,
                dataType: "json",
                data: {
                    //numActuacion: numActuacion,
                    //aniActuacion: aniActuacion,
                    numero: numero,
                    anio: anio,
                    noFojas: fojas,
                    sintesis: sintesis,
                    listaPromoventes: JsonPromoventes,
                    observaciones: observaciones,
                    accion: accion,
                    idReferencia: idReferencia,
                    cveUsuario: cveUsuarioSesion,
                    cveTipoActuacion: "2",
                    cveTipo: cveTipo,
                    cveJuzgado: cveAdscripcion,
                    idActuacion: idActuacion
                    //asigNumero: asigNumero
                },
                success: function (data) {
                    if (data.totalCount >= 0) {
                        $("#divHideForm").hide();
                        $("#divAlertSucces").html("Correcto!: " + data.text);
                        $("#divAlertSucces").show("slide");
                        setTimeAlert("divAlertSucces");
                        $("#hiddenIdActuacion").val(data.data[0].idActuacion);
                        var actuacion = data.data;
                        $("#txtNumActuacion2").val(actuacion[0].numActuacion);
                        $("#txtAniActuacion2").val(actuacion[0].aniActuacion);
                        //armado del objeto para impresion
                        objetoImpresion =  {
                            numActuacion:actuacion[0].numActuacion,
                            aniActuacion:actuacion[0].aniActuacion,
                            fechaRegistro:actuacion[0].fechaRegistro,
                            numExhorto:numero,
                            anioExhorto:anio,
                            sintesis:actuacion[0].sintesis,
                            observaciones:actuacion[0].observaciones,
                            fojas:fojas,
                            promoventes:promoventes.data,
                        }
                        //muestra boton de impresión
                        $('#inputImprimir').show(); 
                    } else {
                        $("#divAlertDager").html("Error en la peticion:\n\n" + data.text);
                        $("#divAlertDager").show("slide");
                        setTimeAlert("divAlertDager");
                    }
                }
            });
        } else {
        }
    };

    promovente = function (idPromoventeActuacion, cveTipoPersona, cveGenero, paterno, materno, nombre) {
        this.paterno = paterno;
        this.materno = materno;
        this.nombre = nombre;
        this.cveTipoPersona = cveTipoPersona;
        this.idPromoventeActuacion = idPromoventeActuacion;
        this.cveGenero = cveGenero;
    };

    limpiar = function ( completo ) {
        var completo = completo || 1;
        if( completo != 0 ){
            $("#txtNumero").val("");
            $("#txtAnio").val("");
        }
            $("#hiddenIdActuacionExhGen").val("");
            $("#hiddenIdActuacion").val("");
            $("#txtFojas").val("");
            $("#txtSintesis").val("");
            $("#txtNotas").val("");
            $("#txtNumActuacion2").val("");
            $("#txtAniActuacion2").val("");
            //$("#asigNumero").val("0");
            // $("input:radio[name=asigNumero]").val("0");
            //$("input:radio[name=asigNumero]").filter('[value=0]').prop('checked', true);
            $(".required").remove();
            $("#lstActores").empty();
            $("#ltsPromoventes tr").remove();
            $('#txtPaternoAct').val('');
            $('#txtMaternoAct').val('');
            $('#txtNombreAct').val('');
            $('#cmbTiposPersonas').val(0);
            $('#cmbGeneros').val(0).prop('disabled',false);
            $(".divNombre").show();
            $('.divDescNombre').removeClass('col-sm-9 col-md-9').addClass('col-sm-3 col-md-3');
            $('#inputEliminar, #inputImprimir').hide(); 
            promoventes.data = [];
            promoventes.counter = 0;
            $('#formulario-adjuntos').hide();
            $('#uploadfiles').val('');
            $('#tbody-adjuntos').empty();
            $('#totalAdjuntos').val('0');
            $('#progress-bar-filesSize').width('0%').empty().append('0%');
            filesSizeAttached = 0;
    };

        $.fn.agregaPersona = function (Clase, Destino, valorRadio) {
            $(".required").remove();
            var arrNombre = new Array();
            var agregar = true;
            var noElementos = $("." + Clase).length;
            $("." + Clase).each(function () {

                if ($.trim($(this).val()) != "" && $(this).is(":visible")) {
                    arrNombre.push($.trim($(this).val().toUpperCase()));
                } else if ($(this).is(":visible")) {
                    agregar = false;
                    $(this).parent().append("<br class='required'><label class='Arial13Rojo required'>Este campo no puede estar vacio</label>");
                    arrNombre = new Array();
                } else {
                    arrNombre.push("");
                }

            });
            if (arrNombre.join('').length > 0 && agregar) {
                var found = false;
                /*$("#" + Destino + " option").each(function () {
                    if (arrNombre.join(' ') == $(this).text().toUpperCase()) {
                        found = true;
                    }
                });*/
                var totalRenglones = $("#ltsPromoventes tr").length;
                //alert("total de renglones " + totalRenglones);
                var hiddenIdentificador = $("#hiddenIdentificador").val();
                //alert("hiddenIdentificador "+hiddenIdentificador);
                if (totalRenglones == 0 || hiddenIdentificador !== "") {
                    found = false;
                } else {
                    var identificador = arrNombre.join("");
                    identificador = identificador.replace(/\s+/g, '');
                    $('#ltsPromoventes tr').each(function () {
                        if ($(this).attr('id') === identificador) {
                            found = true;
                        }

                    });
                }

                if (found != true) {
                    var cveGenero = $("#cmbGeneros").val();
                    var descGenero = $("#cmbGeneros option:selected").text();
                    var cveTipoPersona = $("#cmbTiposPersonas").val();
                    var descTipoPersona = $("#cmbTiposPersonas option:selected").text();
                    var idPromovente = $("#hiddenIdPromovente").val();
                    var nombre = arrNombre;

                    agregarPromovente(idPromovente, cveTipoPersona, descTipoPersona, cveGenero, descGenero, nombre);
                    $("." + Clase).each(function () {
                        $(this).val("");
                    });
                    $("." + Clase).first().focus();
                    $('#cmbGeneros').val(0);
                } else {
                    alert("El nombre " + arrNombre.join(' ') + " ya existe.");
                }
            } else {

            }
        };

        capturaNombrePersona = function (e, Sig, clase, destino, radio) {
            tecla = (document.all) ? e.keyCode : e.which;
            var valorRadio = $("#".radio).val();
            if (tecla == 8)
                return true; // Tecla de retroceso (para poder borrar)
            if (tecla == 13) {
                if (Sig.length > 0) {
                    if (Sig in $.fn) {
                        $.fn[Sig](clase, destino, valorRadio);
                    } else if ($('#' + Sig)) {
                        $('#' + Sig).focus();
                    }
                    return true;
                }
            }
            patron = /"|'|\\/; // No acepta ",',/,\ (se separan por | )
            te = String.fromCharCode(tecla);
            return !patron.test(te);
        };

        capturaNombrePersonaBoton = function (e, Sig, clase, destino, radio, generos) {
            tecla = (document.all) ? e.keyCode : e.which;
            $('.required').remove();
            var valorRadio = $("#" + radio).val();
            var genero = $("#" + generos).val();
            if( genero == '0'){
                $("#" + generos).parent().append("<br class='required'><label class='Arial13Rojo required'>Este campo no puede estar vacio</label>");
                return null;
            }else{
           /* if (tecla == 8)
                return true; // Tecla de retroceso (para poder borrar)
            if (tecla == 13) {*/
            if (Sig.length > 0) {
                if (Sig in $.fn) {
                    $.fn[Sig](clase, destino, valorRadio);
                } else if ($('#' + Sig)) {
                    $('#' + Sig).focus();
                }
                return true;
            }
            }
            var patron = /"|'|\\/; // No acepta ",',/,\ (se separan por | )
            te = String.fromCharCode(tecla);
            return !patron.test(te);
            
        };
        
        borraPersona = function (Combo) {
            if (confirm("Esta seguro de eliminar a:\n"
                    + $('#' + Combo).find('option:selected').text())) {
                $('#' + Combo).find('option:selected').remove().end();
            }
        };

    /**
    * Función para la verificación de datos validos de exhortos
    */
    $(".Relacionado").focusout(function () {
        $("#divSinRelacionMsg").empty();
        var numero = $("#txtNumero").val();
        var anio = $("#txtAnio").val();
        var consulta = true;
        var cveAdscripcion = $("#hiddenCveAdscripcion").val();
        if (numero == "") { consulta = false; }
        if (anio == "") { consulta = false; }
        if (consulta) {
            $.ajax({
                url: "../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php",
                dataType: 'json', async: false, type: "POST",
                data: {
                    accion: "consultar",
                    numActuacion: numero,
                    aniActuacion: anio,
                    cveTipoActuacion: "1",
                    cveJuzgado: cveAdscripcion
                },
                beforeSend: function (xhr) {
                },
                success: function (datos) {
                    //console.log(datos);
                    $("#divSinRelacionMsg").empty();
                    if (datos.totalCount > 0) {
                        $.each(datos.data, function (index, element) {
                            $("#divSinRelacionMsg").append("<b>Exhorto Encontrado.</b>");
                            $("#hiddenIdActuacionExhGen").val(element.idActuacion);
                            $("#hiddenCveTipo").val(element.cveTipo);
                            $('#formulario-adjuntos').show();
                            return false;
                        });
                    } else {
                        $("#divSinRelacionMsg").append("<b>Datos incorrectos, no existe Exhorto.Verifique. </b>");
                        $("#hiddenIdActuacionExhGen").val("");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(jqXHR+ '**' + textStatus+ '**' + errorThrown);
                }
            });
        }
    }).on('change', function(){
        limpiar('0');
    });

    imprimirRecibo_old = function () {
        var cveAdscripcion = $("#cveAdscripcion").val();
        var idActuacion = $("#hiddenIdActuacion").val();
        if (idActuacion > 0) {
            var nombre = "";
            var paterno = "";
            var materno = "";
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php",
                data: {
                    idActuacion: idActuacion,
                    accion: "consultarActuacion_Promocion",
                    cveJuzgado: cveAdscripcion,
                    pag: "-1",
                    usuario: "porUsuario"
                },
                async: false,
                dataType: "json",
                beforeSend: function (xhr) {

                },
                success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    if (data.estatus == "ok") {
                        var actuacion = data.datos;
                        var listaPromoventes = "";
                        $.each(actuacion[0].promoventes, function (index, element) {
                            if (element.cveTipoPersona == 1) {
                                nombre = element.nombre;
                                paterno = element.paterno;
                                materno = element.materno;
                            } else {
                                paterno = "";
                                materno = "";
                                nombre = element.nombrePersonaMoral;
                            }
                            listaPromoventes += nombre + " " + paterno + " " + materno + "<br>";
                        });
                        var hostname = location.pathname;
                        hostname = hostname.split("/");
                        hostname = hostname[0] + "/" + hostname[1] + "/" + hostname[2];
                        var tabla = "<table style='width:100%; font-size:14px; border-collapse:collapse; font-family: \"Courier New\", Courier, monospace;''>";
                        tabla += "<tr><td align='left' style='width:30%; font-weight:bold; border-bottom:solid black 2px;'><img src='../vistas/img/EscudoEstadoMexico.png' width='85' height='90'></td><td style='font-size:16px; font-weight:bold; border-bottom:solid black 2px;'>Gobierno del Estado de M&eacute;xico<br> Poder Judicial del Estado de M&eacute;xico<br>Consejo de la Judicatura<br>Comprobante de Promociones</td><td align='left' style='padding-left:5px; border-bottom:solid black 2px;'><img src='../vistas/img/EscudoPoderJudicial.png' width='85' height='90'></td></tr>";
                        tabla += "<tr><td colspan='4'>&nbsp;</td></tr>"
                        tabla += "<tr><td colspan='4'>&nbsp;</td></tr>"
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Num. de Promoci&oacute;n:</td><td align='left' style='padding-left:5px;'>" + actuacion[0].numActuacion + "/" + actuacion[0].aniActuacion + "</td></tr>";
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Sintesis:</td><td align='left' style='padding-left:5px;'>" + actuacion[0].sintesis + "</td></tr>";
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Promoventes:</td><td align='left' style='padding-left:5px;'>" + listaPromoventes + "</td></tr>";
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Notas:</td><td align='left' style='padding-left:5px;'>" + actuacion[0].observaciones + "</td></tr>";
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Fecha de Entrega:</td><td align='left' style='padding-left:5px;'>" + actuacion[0].fechaRegistro + "</td></tr>";
                        tabla += "<tr><td align='right' style='width:30%; font-weight:bold;'>Capturado por:</td><td align='left' style='padding-left:5px;'>" + actuacion[0].nombrePerCaptura + "</td></tr>";
                        tabla += "</table >";
                        consultar("imprimir");
                        $('#printable').empty();
                        $('#printable').append(tabla + "<br>");
                        w = window.open("", 'Print_Page', 'scrollbars=yes');
                        w.document.write($('#printable').html());
                        w.document.close();
                        w.print();
                        w.close();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        } else {
            $("#divAlertDager").html("Error en la peticion:\n\n Debe seleccionar una promocion");
            $("#divAlertDager").show("slide");
            setTimeAlert("divAlertDager");
        }
    };

    /**
    * Impresión del Exhorto cargado
    */
    imprimirRecibo = function(){
        var obj = objetoImpresion;
        var nombre = '', XXX='';
        var tablaImpresion = '<style> .tablaImpresion{ font-size: 10px;  } </style>';
        tablaImpresion += '<table class="tablaImpresion" style="width: 100%; margin-left: auto; margin-right: auto;border-spacing: 10px;">'
            + '<tr><td><table class="tablaImpresion" style="width: 100%;"><tr>'
            + '<td align="left" style="width: 115px;"><img src="../vistas/img/EscudoEstadoMexico.png" width="85" height="90"></td>'
            + '<td align="left"><p><b>Gobierno del Estado de M&eacute;xico</b></p><p>Poder Judicial</p><p>Consejo de la Judicatura</p>'
            + '</td><td align="right" style="width: 85px;"><img src="../vistas/img/EscudoPoderJudicial.png" width="85" height="90"></td>'
            + '</tr></table></td></tr><tr><td><b>Comprobante de Promoci&oacute;n</b></td></tr><tr><td>'
            + '<table class="tablaImpresion" style="width: 100%; border: 3px solid black; border-radius: 7px;"><tr><td align="right" style="width: 20%;"><b>N&uacute;mero de Promoci&oacute;n:</b></td>'
            + '<td style="width: 30%;">' + obj.numActuacion + ' / ' + obj.aniActuacion + '</td><td align="right" style="width: 20%;"><b>Fecha de Alta:</b></td>'
            + '<td style="width: 30%;">' + obj.fechaRegistro + '</td></tr><tr><td align="right" style="width: 20%;"><b>N&uacute;mero de Exhorto:</b></td>'
            + '<td style="width: 30%;">' + obj.numExhorto + ' / ' + obj.anioExhorto + '</td><td style="width: 20%;">&nbsp;</td>'
            + '<td style="width: 30%;">&nbsp;</td></tr></table>'
            + '</td></tr><tr><td><table class="tablaImpresion" style="width: 100%; border: 1px solid black; border-radius: 7px;">'
            + '<tr><td align="right" style="width: 20%;"><b>S&iacute;ntesis:</b></td><td style="width: 80%;">' + obj.sintesis + '</td></tr>'
            + '<tr><td align="right" style="width: 20%;"><b>Notas:</b></td><td align="left" style="width: 80%;">' + obj.observaciones + '</td></tr>'
            + '<tr><td align="right" style="width: 20%;"><b>No. Fojas:</b></td><td align="left" style="width: 80%;">' + obj.fojas + '</td></tr>'
            + '</table></td></tr><tr><td>'
            + '<table class="tablaImpresion" style="width: 100%; border: 1px solid black; border-radius: 7px;">';
            + '<tr><td align="center"><b>PROMOVENTES</b></td></tr>'
        $.each(obj.promoventes, function(index, value){
            nombre = ( value.cveTipoPersona == 1 ) ? value.paterno+' '+value.materno+' '+value.nombre : value.nombrePersonaMoral ;
            tablaImpresion += '<tr><td align="right" style="width: 20%;"><b>Tipo de persona:</b></td><td style="width: 10%;">' + value.descTipoPersona + '</td><td align="right" style="width: 20%;"><b>Promovente:</b></td><td style="width: 50%;">' + nombre + '</td></tr>'
                + '<tr><td colspan="4" align="center"><hr style="width: 70%;" /></td></tr>';
        });

        tablaImpresion += '</table></td></tr><tr><td><table class="tablaImpresion" style="width: 100%;"><tr>'
            + '<td align="left">Por: ' + $('#nombreUsuario').val() + '<br/>Fecha de Impresion: ' + $('#fechaSistema').val() + '</td></tr></table></td></tr></table>';
        $('#printable').empty().append(tablaImpresion);
        w = window.open("", 'Print_Page', 'scrollbars=yes');
        w.document.write($('#printable').html());
        w.print();
        //w.document.close();
        //w.close();
    };

    /**
    * Función para la eliminación de Exhortos
    */        
    eliminarPromocion = function () {
        var idActuacion = $("#hiddenIdActuacion").val();
        if (idActuacion > 0) {
            bootbox.dialog({
                message: "Esta a punto de eliminar esta Promoci&oacute;n <br/><br/> ¿Desea continuar?",
                buttons: {
                    danger: {
                        label: "Aceptar",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                type: "POST",
                                url: "../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php",
                                data: { idActuacion: idActuacion, accion: "eliminarActuacion_Promocion"},
                                async: false, dataType: "json",
                                beforeSend: function (xhr) {
                                },
                                success: function (data, textStatus, jqXHR) {
                                    if (data.Estatus == "Ok") {
                                        $("#divHideForm").hide();
                                        $("#divAlertSucces").html("Correcto!: " + data.Mensaje);
                                        $("#divAlertSucces").show("slide");
                                        setTimeAlert("divAlertSucces");
                                        limpiar();
                                    } else {
                                        $("#divAlertDager").html("Error en la peticion:\n\n" + data.Mensaje);
                                        $("#divAlertDager").show("slide");
                                        setTimeAlert("divAlertDager");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                }
                            });
                        }// end callback
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
            $("#divAlertDager").html("Error en la peticion:\n\n Debe seleccionar una promoci&oacute;n");
            $("#divAlertDager").show("slide");
            setTimeAlert("divAlertDager");
        }
    }

    var objetoImpresion = '';
    // Variable para almacenar a las partes
    var promoventes = {
        data:[],
        counter:0
    };

    //cantidad de Mb de archivos adjuntos
    var filesSizeAttached = 0;

    eliminaArchivo = function( data ){
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
                        muestraMensaje('Archivo eliminado satisfactoriamente.','information','_Archivos');
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
            muestraMensaje('Antes de eliminar el archivo &uacute;nico, debe agregar uno nuevo.', 'information','_Archivos');
        }
    }

    /**
    * Subir archivos
    */
    var uploadfiles = document.querySelector('#uploadfiles');
    uploadfiles.addEventListener('change', function () {
        var files = this.files;
        var uploadMaxSize = $('#uploadMaxSize').val();
        for(var i=0; i<files.length; i++){
            if( files[i].type == 'application/pdf' ){
                if( uploadMaxSize >= files[i].size ){
                    //console.log( parseInt(actualizaPorcentajeArchivos()) + ' ** ' + 99 );
                    if( parseInt(actualizaPorcentajeArchivos()) <= 99 ){
                        uploadFile(files[i]);
                    }else{
                        muestraMensaje('Se ha alcanzado el m&aacute;ximo permitido de Mb a adjuntar.','information','_Archivos');
                    }
                }else{
                    muestraMensaje('El archivo [ ' + files[i].name + ' ] excede el tama&ntilde;o m&aacute;ximo permitido. Intente con otro.','information','_Archivos');
                }
            }else{
                muestraMensaje('El archivo [ ' + files[i].name + ' ] No esta en formato PDF, verifique e intente nuevamente.','information','_Archivos');
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
        fd.append('idActuacion', $('#hiddenIdActuacion').val() );
        fd.append('cveTipoDocumento', '13');
        fd.append('cveTipoActuacionExhorto', '1'); //1 para Actuacion-Exhorto Generado
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
            muestraMensaje('Archivo [' + file.name + '] <br/>Error: <b>' + data.text + '</b>','warning');
        }
        $('#uploadfiles').val('');
        /*console.log("name : " + file.name);
        console.log("size : " + file.size);
        console.log("type : " + file.type);
        console.log("date : " + file.lastModified);*/
    }

    /**
    * Función para obtener el total de archivos registrados en la tabla de adjuntos
    */
    obtenerCantidadArchivos = function(){
        return $('.glyphicon-eye-open').length;
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

    obtenerMaximoEnvio = function(){
        var maxDefinido = $('#uploadMaxFiles').val();
        return ( ((maxDefinido/1024)/1024) + ' Mb' );
    }

    obtenerMaximoPorArchivo = function(){
        var maxDefinido = $('#uploadMaxSize').val();
        return ( ((maxDefinido/1024)/1024) + ' Mb' );
    }

    //funcion de inicialización
    $(function () {
        $("·hiddenCveAdscripcion ").val(juzgadoSesion);
        $("#txtNumero").validaCampo('0123456789');
        $("#txtAnio").validaCampo('0123456789');
        $("#txtNumero2").validaCampo('0123456789');
        $("#txtAnio2").validaCampo('0123456789');
        $("#txtNumActuacion2").validaCampo('0123456789');
        $("#txtAniActuacion2").validaCampo('0123456789');
        $("#txtNumActuacion").validaCampo('0123456789');
        $("#txtAniActuacion").validaCampo('0123456789');
        $("#txtFojas").validaCampo('0123456789');
        var d = new Date();
        $("#txtfechaInicial, #txtfechaFinal").datetimepicker( {sideBySide: false, locale: 'es', format: "DD/MM/YYYY", date: d} );
        cargarTiposPersonas();
        cargarGeneros();
        $("input").change(function () { validarFormulario(); });
        //definicion del maximo de envío
        $('#maximoEnvio').empty().html( '% de espacio ocupado para env&iacute;o (' + obtenerMaximoEnvio() + '):' );
        //muestra el tamaño maximo por archivo
        $('#maximoPorArchivo').empty().html( obtenerMaximoPorArchivo );

    });
</script> 