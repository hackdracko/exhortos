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

    $cveAdscripcion = $_SESSION["cveAdscripcion"];
?>
<style type="text/css">
    .requerido {
        color: darkred;
    }
    .disableddiv {
        pointer-events: none;
        opacity: 0.4;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title" id="registro">                                                            
            EXHORTOS
        </h5>
    </div>
    <div class="panel-body">
        <input type="hidden" id="uploadMaxSize" name="uploadMaxSize" value="<?=file_upload_max_size()?>" />
        <input type="hidden" id="uploadMaxFiles" name="uploadMaxFiles" value="10485760" /> <!-- 10 Mb -->
        <input type="hidden" id="totalAdjuntos" name="totalAdjuntos" value="0" /> <!-- 0 Mb -->
        <input type="hidden" id="cveEstado" name="cveEstado" value="0" /> <!-- 0 Mb -->
        <!-- INICIO EXHORTOS RECIBIDOS-->
        <div id="divFormulario" class="form-horizontal">
            <input type="hidden" disabled readonly name="idExhorto" id="idExhorto" class="form-inline">
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Exhorto</label>
                <div class="col-md-6">
                    <input type="text" disabled readonly name="numero" id="numero" class="form-inline" placeholder="N&uacute;mero" size="5">
                    / <input type="text" disabled readonly name="anio" id="anio" class="form-inline"  placeholder="A&ntilde;o" size="5">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Juzgado Asignado </span></label>
                <div class="col-md-6">
                    <input type="text" readonly disabled name="juzgadoAsignado" id="juzgadoAsignado" class="form-control">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Expediente <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" name="numeroExp" id="numeroExp" class="form-inline number-only" placeholder="N&uacute;mero" size="5">
                    / <input type="text" name="anioExp" id="anioExp" class="form-inline number-only"  placeholder="A&ntilde;o" size="5">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3 ">Estado Procedencia<span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <select class="form-control cmbEstado" name="cmbEstado" id="cmbEstado">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3 ">Juzgado Procedencia <span class="requerido">(*)</span></label>
                <div id="divJuzgadoProcedenciaCmb" class="col-md-6">
                    <select class="form-control cmbJuzgado" name="cmbJuzgado" id="cmbJuzgado">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
                <div id="divJuzgadoProcedencia" style="display:none;" class="col-md-6">
                    <input type="text" name="juzgadoProcedencia" id="juzgadoProcedencia" class="form-control" placeholder="Nombre del Juzgado">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Materia <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <select class="form-control cmbMateria" name="cmbMateria" id="cmbMateria">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Juicio <span class="requerido">(*)</span></label>
                <div id="divCmbJuicio" class="col-md-6">
                    <select class="form-control cmbJuicio" name="cmbJuicio" id="cmbJuicio">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
                <div id="divOtroJuicio" style="display:none;" class="col-md-6">
                    <input type="text" name="otroJuicio" id="otroJuicio" class="form-control" placeholder="Nombre del Juicio">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Cuantia <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <select class="form-control cmbCuantia" name="cmbCuantia" id="cmbCuantia">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Carpeta Investigaci&oacute;n</label>
                <div class="col-md-6">
                    <input type="text" name="txtCarpetaInv" id="txtCarpetaInv" placeholder="Carpeta Inv." class="form-control text-uppercase" value=""/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Nuc (N&uacute;mero &uacute;nico de causa) </label>
                <div class="col-md-6">
                    <input type="text" name="txtNuc" id="txtNuc" placeholder="Nuc" class="form-control text-uppercase" value=""/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Fojas <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" name="txtFojas" id="txtFojas" placeholder="Fojas" class="form-control number-only" value=""/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Oficio <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" name="txtOficio" id="txtOficio" placeholder="No. Oficio" class="form-inline number-only" />
                    /<input type="text" class="form-inline number-only" id="txtOficioAnio" id="txtOficioAnio" placeholder="A&ntilde;o">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Sintesis <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <input type="text" id="txtSintesis" placeholder="Sintesis" class="form-control text-uppercase" value=""/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Observaciones</label>
                <div class="col-md-6">
                    <textarea rows="5" id="txtObservaciones" class="form-control text-uppercase" placeholder="Observaciones"></textarea>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3" >Consignaci&oacute;n</label>
                <div class="col-md-6">
                    <select class="form-control cmbConsignacion" name="cmbConsignacion" id="cmbConsignacion">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3" >Estatus <span class="requerido">(*)</span></label>
                <div class="col-md-6">
                    <select class="form-control cmbEstatusExhorto" name="cmbEstatusExhorto" id="cmbEstatusExhorto">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="panel-group accordionPartes col-xs-12" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                PARTES
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <!-- INICIO DE FORMULARIO DE IMPUTADOS -->
                            <div class="form-group col-xs-12">
                                <label class="control-label col-md-3">Tipo Parte <span class="requerido">(*)</span></label>
                                <div class="col-md-6">
                                    <select class="form-control cmbTipoParte" name="cmbTipoParte" id="cmbTipoParte">
                                        <option value="0">Seleccione una opcion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <label class="control-label col-md-3">Tipo Persona <span class="requerido">(*)</span></label>
                                <div class="col-md-6">
                                    <select class="form-control cmbTipoPersona" name="cmbTipoPersona" id="cmbTipoPersona">
                                        <option value="0">Seleccione una opcion</option>
                                    </select>
                                    <input type="hidden" readonly disabled name="posicion" id="posicion"/>
                                    <input type="hidden" readonly disabled name="part" id="part"/>
                                </div>
                            </div>
                            <div id="divPartesFisica" style="display:none;">
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3">Parte <span class="requerido">(*)</span></label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtNombreFisica" name="txtNombreFisica" placeholder="Nombre" class="form-control text-uppercase"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="txtPaternoFisica" name="txtPaternoFisica" placeholder="Paterno" class="form-control text-uppercase"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="txtMaternoFisica" name="txtMaternoFisica" placeholder="Materno" class="form-control text-uppercase"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">Edad</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtEdadFisica" name="txtEdadFisica" placeholder="Edad" class="form-control"/>
                                    </div>
                                    <label class="control-label col-md-2 ">Fecha Nacimiento</label>
                                    <div class="col-md-2">
                                        <input type="text" readonly id="txtFNacFisica" name="txtFNacFisica" placeholder="Fecha Nacimiento" class="form-control fecha"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">RFC</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtRfcFisica" name="txtRfcFisica" placeholder="RFC" class="form-control text-uppercase"/>
                                    </div>
                                    <label class="control-label col-md-2 ">CURP</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtCurpFisica" name="txtCurpFisica" placeholder="CURP" class="form-control text-uppercase"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">Genero <span class="requerido">(*)</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbGenero" name="cmbGenero" id="cmbGenero">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2 ">Direccion</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtDireccionFisica" name="txtDireccionFisica" placeholder="Direccion" class="form-control text-uppercase"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3">Estado</label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbEstadoParte" name="cmbEstadoFisica" id="cmbEstadoFisica">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2">Municipio</label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbMunicipio" name="cmbMunicipioFisica" id="cmbMunicipioFisica">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3">Telefono</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtTelefonoFisica" name="txtTelefonoFisica" placeholder="Telefono" class="form-control"/>
                                    </div>
                                    <label class="control-label col-md-2 ">Correo Electronico</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtMailFisica" name="txtMailFisica" placeholder="Correo Electronico" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">Detenido</label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbSiNo" name="cmbDetenido" id="cmbDetenido">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="divPartesMoral" style="display:none;">
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3">Parte <span class="requerido">(*)</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="txtNombreMoral" name="txtNombreMoral" placeholder="Nombre" class="form-control text-uppercase"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">RFC</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtRfcMoral" name="txtRfcMoral" placeholder="RFC" class="form-control text-uppercase"/>
                                    </div>
                                    <label class="control-label col-md-2 ">Direccion</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtDireccionMoral" name="txtDireccionMoral" placeholder="Direccion" class="form-control text-uppercase"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">Estado</label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbEstadoParte" name="cmbEstadoMoral" id="cmbEstadoMoral">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2 ">Municipio</label>
                                    <div class="col-md-2">
                                        <select class="form-control cmbMunicipio" name="cmbMunicipioMoral" id="cmbMunicipioMoral">
                                            <option value="0">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="control-label col-md-3 ">Telefono</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtTelefonoMoral" name="txtTelefonoMoral" placeholder="Telefono" class="form-control"/>
                                    </div>
                                    <label class="control-label col-md-2 ">Correo Electronico</label>
                                    <div class="col-md-2">
                                        <input type="text" id="txtMailMoral" name="txtMailMoral" placeholder="Correo Electronico" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="text-align:center">
                                <button class="btn btn-primary" style="display:none;" name="modificarParte" id="modificarParte">Modificar</button>
                                <button class="btn btn-primary" name="agregarParte" id="agregarParte">Agregar</button>
                                <button class="btn btn-primary" name="limpiarParte" id="limpiarParte">Limpiar</button>
                            </div>
                            <table id="tablaPartes"  border="1" align="center"  width="90%"  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo Parte</th>
                                        <th>Tipo Persona</th>
                                        <th>Nombre</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div style="display:none;" class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="form-group col-xs-12 text-center">
                <button style="display:none;" class="btn btn-primary" name="actualizar" id="actualizar">Actualizar</button>
                <button class="btn btn-primary" name="guardar" id="guardar">Guardar</button>
                <button class="btn btn-primary" name="consultar" id="consultar">Consultar</button>
                <button class="btn btn-primary" name="limpiar" id="limpiar">Limpiar</button>
            </div>
        </div>
        <!-- CONSULTA EXHORTOS RECIBIDOS-->
        <div style="display:none;" id="divFormularioConsulta" class="form-horizontal">
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">No. Exhorto</label>
                <div class="col-md-2">
                    <input type="text" name="numeroConsulta" id="numeroConsulta" class="form-inline" placeholder="N&uacute;mero" size="5">
                    / <input type="text" name="anioConsulta" id="anioConsulta" class="form-inline"  placeholder="A&ntilde;o" size="5">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Estado Procedencia</label>
                <div class="col-md-6">
                    <select class="form-control cmbEstado" name="cmbEstadoConsulta" id="cmbEstadoConsulta">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Juzgado Procedencia</label>
                <div class="col-md-6">
                    <select class="form-control cmbJuzgado" name="cmbJuzgadoConsulta" id="cmbJuzgadoConsulta">
                        <option value="0">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Fecha Inicio</label>
                <div class="col-md-6">
                    <input type="text" readonly name="fechaInicioConsulta" id="fechaInicioConsulta" placeholder="Fecha" class="form-control fecha" value="<?php echo date("dd/mm/YYYY"); ?>"/>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label col-md-3">Fecha Fin</label>
                <div class="col-md-6">
                    <input type="text" readonly name="fechaFinConsulta" id="fechaFinConsulta" placeholder="Fecha" class="form-control fecha" value="<?php echo date("dd/mm/YYYY"); ?>"/>
                </div>
            </div>
            <div class="col-xs-12">
                <div style="display:none;" class="alert alert-success alert-dismissable mensajeSuccess"></div>
                <div style="display:none;" class="alert alert-warning alert-dismissable mensajeError"></div>
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
            <table id="tablaPartesConsulta"  class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO. EXHORTO</th>
                        <th>JUZGADO EXHORTADO</th>
                        <th>JUZGADO EXHORTANTE</th>
                        <th>FECHA REGISTRO</th>
                        <th>ELECTRONICO</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="paginadorExhortos"></div>
            <div class="form-group">
                <div class="form-group" style="text-align:center">
                    <button class="btn btn-primary" name="regresar" id="regresar">Regresar</button>
                    <button class="btn btn-primary" name="consultarExhorto" id="consultarExhorto">Consultar</button>
                    <button class="btn btn-primary" name="limpiarExhorto" id="limpiarExhorto">Limpiar</button>
                </div>         
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        var filesSizeAttached = 0;
        juzgadoUsuario = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultarEstado",
                        cveAdscripcion: <?php echo $cveAdscripcion; ?>
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    $("#cveEstado").val(datos.cveEstado);
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de estados:\n\n" + otroobj);
                }
            });
        };
        ////////////////////////////////////////////////////////
        /////////////////FUNCIONES DE JAVASCRIPT////////////////
        ////////////////////////////////////////////////////////
        $("#guardar").click(function () {
            $(".mensajeSuccess").empty();
            $(".mensajeError").empty();
            var numeroExp = $("#numeroExp").val();
            var anioExp = $("#anioExp").val();
            var cmbEstado = $("#cmbEstado").val();
            var juzgadoProcedencia = $("#juzgadoProcedencia").val();
            var cmbJuzgado = $("#cmbJuzgado").val();
            var txtCarpetaInv = $("#txtCarpetaInv").val();
            var txtNuc = $("#txtNuc").val();
            var cmbMateria = $("#cmbMateria").val();
            var cmbJuicio = $("#cmbJuicio").val();
            var cmbCuantia = $("#cmbCuantia").val();
            var txtFojas = $("#txtFojas").val();
            var txtOficio = $("#txtOficio").val();
            var txtOficioAnio = $("#txtOficioAnio").val();
            var txtAnio = $("#txtAnio").val();
            var txtSintesis = $("#txtSintesis").val();
            var txtObservaciones = $("#txtObservaciones").val();
            var cmbConsignacion = $("#cmbConsignacion").val();
            var cmbEstatus = $("#cmbEstatusExhorto").val();
            var trLength = $("#tablaPartes tbody tr").length;
            var array = [];
            if (cmbConsignacion == 0) {
                cmbConsignacion = 4;
            }
            var mensaje = "";
            for (var i = 0; i < 20; i++) {
                array.push($("#dataParte_" + i).val());
            }
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "guardarExhortoParte",
                    numeroExp: numeroExp,
                    anioExp: anioExp,
                    cveJuzgadoProcedencia: cmbJuzgado,
                    juzgadoProcedencia: juzgadoProcedencia,
                    cveEstadoProcedencia: cmbEstado,
                    carpetaInv: txtCarpetaInv,
                    nuc: txtNuc,
                    cveMateria: cmbMateria,
                    cveJuicio: cmbJuicio,
                    cveCuantia: cmbCuantia,
                    noFojas: txtFojas,
                    numOficio: txtOficio + "/" + txtOficioAnio,
                    sintesis: txtSintesis,
                    observaciones: txtObservaciones,
                    cveConsignacion: cmbConsignacion,
                    cveEstatusExhorto: cmbEstatus,
                    cveEstadoDestino: "1",
                    partes: array,
                    activo: "S"
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        if (datos.status == "error") {
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
                        if (datos.status == "ok") {
                            $.each(datos.resultados, function (key, val) {
                                mensaje += val.mensaje;
                                $("#numero").val(val.numero);
                                $("#anio").val(val.anio);
                                $("#juzgadoAsignado").val(val.juzgadoAsignado.desJuzgado);
                            });
                            $(".mensajeSuccess").append(mensaje);
                            $(".mensajeSuccess").show();
                            setTimeout(function () {
                                $(".mensajeSuccess").hide();
                            }, 4000);
                            bloqueaCampos();
                            $("#guardar").hide();
                            $(".accordionPartes").addClass("disableddiv");
                            $("#formulario-adjuntos").show();
                            //$( "#limpiar" ).trigger( "click" );
                            return false;
                        }
                        console.log(datos);
                    } catch (e) {
                        alert("Error al guardar exhorto:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de estados:\n\n" + otroobj);
                }
            });

        });
        $("#actualizar").click(function () {
            $(".mensajeSuccess").empty();
            $(".mensajeError").empty();
            var idExhorto = $("#idExhorto").val();
            var numeroExp = $("#numeroExp").val();
            var anioExp = $("#anioExp").val();
            var cmbEstado = $("#cmbEstado").val();
            var juzgadoProcedencia = $("#juzgadoProcedencia").val();
            var cmbJuzgado = $("#cmbJuzgado").val();
            var txtCarpetaInv = $("#txtCarpetaInv").val();
            var txtNuc = $("#txtNuc").val();
            var cmbMateria = $("#cmbMateria").val();
            var cmbJuicio = $("#cmbJuicio").val();
            var cmbCuantia = $("#cmbCuantia").val();
            var txtFojas = $("#txtFojas").val();
            var txtOficio = $("#txtOficio").val();
            var txtOficioAnio = $("#txtOficioAnio").val();
            var txtAnio = $("#txtAnio").val();
            var txtSintesis = $("#txtSintesis").val();
            var txtObservaciones = $("#txtObservaciones").val();
            var cmbConsignacion = $("#cmbConsignacion").val();
            var cmbEstatus = $("#cmbEstatusExhorto").val();
            var trLength = $("#tablaPartes tbody tr").length;
            var array = [];
            if (cmbConsignacion == 0) {
                cmbConsignacion = 4;
            }
            var mensaje = "";
            for (var i = 0; i < 20; i++) {
                array.push($("#dataParte_" + i).val());
            }
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "actualizaExhortoParte",
                    idExhorto: idExhorto,
                    numeroExp: numeroExp,
                    anioExp: anioExp,
                    cveJuzgadoProcedencia: cmbJuzgado,
                    juzgadoProcedencia: juzgadoProcedencia,
                    cveEstadoProcedencia: cmbEstado,
                    carpetaInv: txtCarpetaInv,
                    nuc: txtNuc,
                    cveMateria: cmbMateria,
                    cveJuicio: cmbJuicio,
                    cveCuantia: cmbCuantia,
                    noFojas: txtFojas,
                    numOficio: txtOficio + "/" + txtOficioAnio,
                    sintesis: txtSintesis,
                    observaciones: txtObservaciones,
                    cveConsignacion: cmbConsignacion,
                    cveEstatusExhorto: cmbEstatus,
                    cveEstadoDestino: "1",
                    partes: array,
                    activo: "S"
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        if (datos.status == "error") {
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
                        if (datos.status == "ok") {
                            $.each(datos.resultados, function (key, val) {
                                mensaje += val.mensaje;
                                $("#numero").val(val.numero);
                                $("#anio").val(val.anio);
                            });
                            $(".mensajeSuccess").append(mensaje);
                            $(".mensajeSuccess").show();
                            setTimeout(function () {
                                $(".mensajeSuccess").hide();
                            }, 4000);
                            bloqueaCampos();
                            $("#actualizar").hide();
                            $(".accordionPartes").addClass("disableddiv");
                            return false;
                        }
                        console.log(datos);
                    } catch (e) {
                        alert("Error al guardar exhorto:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de estados:\n\n" + otroobj);
                }
            });

        });
        $("#regresar").click(function () {
            $("#divFormulario").show();
            $("#divFormularioConsulta").hide();
        });
        $("#consultarExhorto").click(function () {
            consultarExhorto(1);
        });
        function consultarExhorto(pagina) {
            $("#tablaPartesConsulta tbody").empty();
            $("#paginadorExhortos").empty();
            var numero = $("#numeroConsulta").val();
            var anio = $("#anioConsulta").val();
            var estado = $("#cmbEstadoConsulta").val();
            var juzgado = $("#cmbJuzgadoConsulta").val();
            var cveJuzgado = "<?php echo $_SESSION["cveAdscripcion"]; ?>";
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
                data: {accion: "consultarExhortoParteJuzgado",
                    numExhorto: numero,
                    aniExhorto: anio,
                    cveEstadoProcedencia: estado,
                    cveJuzgadoProcedencia: juzgado,
                    cveJuzgado:cveJuzgado,
                    pagina: pagina,
                    numeroRegistros: numeroRegistros,
                    partes: fechaRegistro,
                    activo: "S"
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        if (datos.estatus == "ok") {
                            totalPaginas = datos.datos[0].totalPaginas;
                            pagina = datos.datos[0].pagina;
                            $.each(datos.datos, function (count, object) {
                                tabla += "<tr style='cursor:pointer;' onclick='datosPartesConsulta(" + JSON.stringify(object) + ");'>";
                                    tabla += "<td>" + object.numExhorto + "/" + object.aniExhorto + "</td>";
                                    tabla += "<td>" + object.cveJuzgado[0].desJuzgado + "</td>";
                                    if (object.juzgadoProcedencia != "") {
                                        tabla += "<td>" + object.juzgadoProcedencia + "</td>";
                                    } else {
                                        tabla += "<td>" + object.cveJuzgadoProcedencia[0].desJuzgado + "</td>";
                                    }
                                    tabla += "<td>" + object.fechaRegistro + "</td>";
                                    if (object.idExhortoGenerado != 0) {
                                        tabla += "<td>SI</td>";
                                    } else {
                                        tabla += "<td>NO</td>";
                                    }
                                tabla += "</tr>";
                            });
                        } else {
                            tabla += "<tr>";
                            tabla += "<td colspan='6' class='text-center'>" + datos.mensaje + "</td>";
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
            $("#tablaPartesConsulta tbody").append(tabla);
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
            $("#paginadorExhortos").append(paginacion);
        }
        paginadorRef = function (pagina) {
            consultarExhorto(pagina);
        }
        datosPartesConsulta = function (object) {
            console.log(object);
            $("#actualizar").show();
            $("#guardar").hide();
            $("#idExhorto").val(object.idExhorto);
            $("#numero").val(object.numExhorto);
            $("#anio").val(object.aniExhorto);
            $("#juzgadoAsignado").val(object.cveJuzgado[0].desJuzgado);
            $("#numeroExp").val(object.numeroExp);
            $("#anioExp").val(object.anioExp);
            $("#cmbEstado").val(object.cveEstadoProcedencia[0].cveEstado);
            if (object.juzgadoProcedencia != "") {
                $("#cmbJuzgado").val(0);
                $("#divJuzgadoProcedenciaCmb").hide();
                $("#divJuzgadoProcedencia").show();
            } else {
                $("#cmbJuzgado").val(object.cveJuzgadoProcedencia[0].cveJuzgado);
                $("#divJuzgadoProcedenciaCmb").show();
                $("#divJuzgadoProcedencia").hide();
            }
            if (object.cveJuicio[0].otroJuicio != "") {
                $("#divOtroJuicio").show();
                $("#otroJuicio").val(object.cveJuicio[0].otroJuicio);
                $("#divCmbJuicio").hide();
            }
            $("#juzgadoProcedencia").val(object.juzgadoProcedencia);
            $("#cmbMateria").val(object.cveMateria);
            $("#cmbMateria").trigger("change");
            $("#cmbJuicio").val(object.cveJuicio[0].cveJuicio);
            $("#cmbCuantia").val(object.cveCuantia);
            $("#txtCarpetaInv").val(object.carpetaInv);
            $("#txtNuc").val(object.nuc);
            $("#txtFojas").val(object.noFojas);
            $("#txtOficio").val(object.numOficio);
            $("#txtOficioAnio").val(object.anioOficio);
            $("#txtSintesis").val(object.sintesis);
            $("#txtObservaciones").val(object.observaciones);
            $("#cmbConsignacion").val(object.cveConsignacion);
            $("#cmbEstatusExhorto").val(object.cveEstatusExhorto);
            $("#formulario-adjuntos").show();
            if (object.idExhortoGenerado > 0) {
                bloqueaCampos();
                $("#guardar").hide();
                $("#actualizar").hide();
                $(".accordionPartes").addClass("disableddiv");
            }
            var trLength = $("#tablaPartes tbody tr").length;
            $.each(object.partes, function (count, object) {
                var nombreTipo = object.cveTipoParte[0].descTipoParte;
                var nombrePersona = object.cveTipoPersona[0].desTipoPersona;
                var cveTipoParte = object.cveTipoParte[0].cveTipoParte;
                var cveTipoPersona = object.cveTipoPersona[0].cveTipoPersona;
                var trLength = $("#tablaPartes tbody tr").length;
                var dataParte = JSON.stringify({idParte: object.idParte,
                    posicion: trLength,
                    tipo: cveTipoPersona,
                    persona: cveTipoPersona,
                    nombreFisica: object.nombre,
                    paternoFisica: object.paterno,
                    maternoFisica: object.materno,
                    edadFisica: object.edad,
                    fNacFisica: object.fechaNacimiento,
                    rfcFisica: object.rfc,
                    curpFisica: object.curp,
                    generoFisica: object.cveGenero,
                    direccionFisica: object.domicilio,
                    estadoFisica: object.cveEstado,
                    municipioFisica: object.cveMunicipio,
                    telefonoFisica: object.telefono,
                    mailFisica: object.email,
                    detenidoFisica: object.detenido,
                    nombreMoral: object.nombrePersonaMoral,
                    rfcMoral: object.rfc,
                    direccionMoral: object.domicilio,
                    estadoMoral: object.cveEstado,
                    municipioMoral: object.cveMunicipio,
                    telefonoMoral: object.telefono,
                    mailMoral: object.email
                });
                var tabla = '';
                tabla += "<tr>";
                tabla += "<td>" + nombreTipo + "</td>";
                tabla += "<td>" + nombrePersona + "</td>";
                if (cveTipoPersona == 1) {
                    tabla += "<td>" + object.nombre + " " + object.paterno + " " + object.materno + "</td>";
                } else {
                    tabla += "<td>" + object.nombrePersonaMoral + "</td>";
                }
                tabla += "<td>";
                tabla += "<input type='hidden' name='dataParte_" + trLength + "' id='dataParte_" + trLength + "' value='" + dataParte + "'>";
                tabla += "<a onclick='datosPartes(" + dataParte + ");'>Editar</a> <a class='trPosicion' pos=''>Eliminar</a>";
                tabla += "</td>";
                tabla += "</tr>";
                $("#tablaPartes tbody").append(tabla);
                actualizaPosicion();
            });

            $("#divFormulario").show("slide");
            $("#divFormularioConsulta").hide();
            muestraAdjuntos(object.adjuntos);
        },
        $("#consultar").click(function () {
            $("#divFormulario").hide();
            $("#divFormularioConsulta").show();
            $("#limpiar").trigger("click");
            $("#limpiarParte").trigger("click");
            limpiarTablaParte();
            limpiarTablaConsulta();
        });
        $("#limpiar").click(function () {
            $("#actualizar").hide();
            $("#guardar").show();
            $("#idExhorto").val('');
            $("#numero").val('');
            $("#anio").val('');
            $("#juzgadoAsignado").val('');
            $("#juzgadoProcedencia").val('');
            $("#numeroExp").val('');
            $("#anioExp").val('');
            $("#cmbEstado").val(0);
            $("#cmbJuzgado").val(0);
            $("#juzgadoProcedencia").val('');
            $("#divJuzgadoProcedenciaCmb").show();
            $("#divJuzgadoProcedencia").hide();
            $("#divOtroJuicio").hide();
            $("#otroJuicio").val('');
            $("#divCmbJuicio").show();
            $("#txtCarpetaInv").val('');
            $("#txtNuc").val('');
            $("#cmbMateria").val(0);
            $("#cmbJuicio").val(0);
            $("#cmbCuantia").val(0);
            $("#txtFojas").val('');
            $("#txtOficio").val('');
            $("#txtOficioAnio").val('');
            $("#txtSintesis").val('');
            $("#txtObservaciones").val('');
            $("#cmbConsignacion").val(0);
            $("#cmbEstatusExhorto").val(2);
            $(".accordionPartes").removeClass("disableddiv");
            $("#formulario-adjuntos").hide();
            $(".tablaAdjuntos tbody").empty();
            limpiarTablaParte();
            debloqueaCampos();
            $("#totalAdjuntos").val(0);
            actualizaPorcentajeArchivos();

        });
        $("#limpiarExhorto").click(function () {
            $("#numeroConsulta").val('');
            $("#anioConsulta").val('');
            $("#cmbEstadoConsulta").val(0);
            $("#cmbJuzgadoConsulta").val(0);
            $("#fechaInicioConsulta").val('');
            $("#fechaFinConsulta").val('');
        });
        $("#agregarParte").click(function () {
            var tipo = $("#cmbTipoParte").val();
            var nombreTipo = $('select[name=cmbTipoParte] option:selected').text();
            var persona = $("#cmbTipoPersona").val();
            var nombrePersona = $('select[name=cmbTipoPersona] option:selected').text();
            var nombreFisica = $("#txtNombreFisica").val();
            var paternoFisica = $("#txtPaternoFisica").val();
            var maternoFisica = $("#txtMaternoFisica").val();
            var edadFisica = $("#txtEdadFisica").val();
            var fNacFisica = $("#txtFNacFisica").val();
            var rfcFisica = $("#txtRfcFisica").val();
            var curpFisica = $("#txtCurpFisica").val();
            var generoFisica = $("#cmbGenero").val();
            var direccionFisica = $("#txtDireccionFisica").val();
            var estadoFisica = $("#cmbEstadoFisica").val();
            var municipioFisica = $("#cmbMunicipioFisica").val();
            var telefonoFisica = $("#txtTelefonoFisica").val();
            var mailFisica = $("#txtMailFisica").val();
            var detenidoFisica = $("#cmbDetenido").val();
            var nombreMoral = $("#txtNombreMoral").val();
            var rfcMoral = $("#txtRfcMoral").val();
            var direccionMoral = $("#txtDireccionMoral").val();
            var estadoMoral = $("#cmbEstadoMoral").val();
            var municipioMoral = $("#cmbMunicipioMoral").val();
            var telefonoMoral = $("#txtTelefonoMoral").val();
            var mailMoral = $("#txtMailMoral").val();
            var trLength = $("#tablaPartes tbody tr").length;
            var mensaje = "";
            $(".mensajeError").empty();
            if (tipo == 0) {
                mensaje += "Debes elegir un Tipo Parte";
                $(".mensajeError").append(mensaje);
                $(".mensajeError").show();
                setTimeout(function () {
                    $(".mensajeError").hide();
                }, 4000);
                return false;
            }
            if (persona == 0) {
                mensaje += "Debes elegir un Tipo Persona";
                $(".mensajeError").append(mensaje);
                $(".mensajeError").show();
                setTimeout(function () {
                    $(".mensajeError").hide();
                }, 4000);
                return false;
            }
            var dataParte = JSON.stringify({idParte: 0,
                posicion: trLength,
                tipo: tipo,
                persona: persona,
                nombreFisica: nombreFisica,
                paternoFisica: paternoFisica,
                maternoFisica: maternoFisica,
                edadFisica: edadFisica,
                fNacFisica: fNacFisica,
                rfcFisica: rfcFisica,
                curpFisica: curpFisica,
                generoFisica: generoFisica,
                direccionFisica: direccionFisica,
                estadoFisica: estadoFisica,
                municipioFisica: municipioFisica,
                telefonoFisica: telefonoFisica,
                mailFisica: mailFisica,
                detenidoFisica: detenidoFisica,
                nombreMoral: nombreMoral,
                rfcMoral: rfcMoral,
                direccionMoral: direccionMoral,
                estadoMoral: estadoMoral,
                municipioMoral: municipioMoral,
                telefonoMoral: telefonoMoral,
                mailMoral: mailMoral
            });
            var tabla = '';
            tabla += "<tr>";
            tabla += "<td>" + nombreTipo + "</td>";
            tabla += "<td>" + nombrePersona + "</td>";
            if (persona == 1) {
                tabla += "<td>" + nombreFisica + " " + paternoFisica + " " + maternoFisica + "</td>";
            } else {
                tabla += "<td>" + nombreMoral + "</td>";
            }
            tabla += "<td>";
            tabla += "<input type='hidden' name='dataParte_" + trLength + "' id='dataParte_" + trLength + "' value='" + dataParte + "'>";
            tabla += "<a onclick='datosPartes(" + dataParte + ");'>Editar</a> <a class='trPosicion' pos=''>Eliminar</a>";
            tabla += "</td>";
            tabla += "</tr>";
            $("#tablaPartes tbody").append(tabla);
            $("#limpiarParte").trigger("click");
            actualizaPosicion();
        });
        bloqueaCampos = function () {
            $("#numeroExp").prop("disabled", true);
            $("#anioExp").prop("disabled", true);
            $("#cmbEstado").prop("disabled", true);
            $("#cmbJuzgado").prop("disabled", true);
            $("#txtCarpetaInv").prop("disabled", true);
            $("#txtNuc").prop("disabled", true);
            $("#cmbMateria").prop("disabled", true);
            $("#cmbJuicio").prop("disabled", true);
            $("#cmbCuantia").prop("disabled", true);
            $("#txtFojas").prop("disabled", true);
            $("#txtOficio").prop("disabled", true);
            $("#txtOficioAnio").prop("disabled", true);
            $("#txtSintesis").prop("disabled", true);
            $("#txtObservaciones").prop("disabled", true);
            $("#cmbConsignacion").prop("disabled", true);
            $("#cmbEstatusExhorto").prop("disabled", true);
            $("#juzgadoProcedencia").prop("disabled", true);
            $("#otroJuicio").prop("disabled", true);
        },
        debloqueaCampos = function () {
            $("#numeroExp").prop("disabled", false);
            $("#anioExp").prop("disabled", false);
            $("#cmbEstado").prop("disabled", false);
            $("#cmbJuzgado").prop("disabled", false);
            $("#txtCarpetaInv").prop("disabled", false);
            $("#txtNuc").prop("disabled", false);
            $("#cmbMateria").prop("disabled", false);
            $("#cmbJuicio").prop("disabled", false);
            $("#cmbCuantia").prop("disabled", false);
            $("#txtFojas").prop("disabled", false);
            $("#txtOficio").prop("disabled", false);
            $("#txtOficioAnio").prop("disabled", false);
            $("#txtSintesis").prop("disabled", false);
            $("#txtObservaciones").prop("disabled", false);
            $("#cmbConsignacion").prop("disabled", false);
            $("#cmbEstatusExhorto").prop("disabled", false);
            $("#juzgadoProcedencia").prop("disabled", false);
            $("#otroJuicio").prop("disabled", false);
        },
        actualizaPosicion = function (dataParte) {
            var i = 0;
            $(".trPosicion").each(function () {
                var pos = $(this).attr("pos", i);
                i++;
            });
        },
        limpiarTablaParte = function (dataParte) {
            $("#tablaPartes tbody").empty();
        },
        limpiarTablaConsulta = function (dataParte) {
            $("#tablaPartesConsulta tbody").empty();
            $("#paginadorExhortos").empty();
        },
        $("#limpiarParte").click(function () {
            $("#part").val('');
            $("#cmbTipoParte").val(0);
            $("#cmbTipoPersona").val(0);
            $("#txtNombreFisica").val('');
            $("#txtPaternoFisica").val('');
            $("#txtMaternoFisica").val('');
            $("#txtEdadFisica").val('');
            $("#txtFNacFisica").val('');
            $("#txtRfcFisica").val('');
            $("#txtCurpFisica").val('');
            $("#cmbGenero").val(0);
            $("#txtDireccionFisica").val('');
            $("#cmbEstadoFisica").val(0);
            $("#cmbMunicipioFisica").val(0);
            $("#txtTelefonoFisica").val('');
            $("#txtMailFisica").val('');
            $("#cmbDetenido").val(0);
            $("#txtNombreMoral").val('');
            $("#txtRfcMoral").val('');
            $("#txtDireccionMoral").val('');
            $("#cmbEstadoMoral").val(0);
            $("#cmbMunicipioMoral").val(0);
            $("#txtTelefonoMoral").val('');
            $("#txtMailMoral").val('');
            $("#posicion").val('');
            $("#divPartesFisica").hide();
            $("#divPartesMoral").hide();
            $("#agregarParte").show();
            $("#modificarParte").hide();
        });
        $(".number-only").on("input", function () {
            //var regexp = /[^a-zA-Z]/g;
            var regexp = /[^0-9]/g;
            if ($(this).val().match(regexp)) {
                $(this).val($(this).val().replace(regexp, ''));
            }
        });
        calcularEdad = function (fecha) {
            fecha = new Date(fecha);
            var today = new Date();
            var edad = Math.floor((today-fecha) / (365.25 * 24 * 60 * 60 * 1000));
            return edad;
        },
        $("#cmbMateria").change(function () {
            var materia = $(this).val();
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/juicios/JuiciosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", cveMateria: materia, activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbJuicio').empty();
                        $('.cmbJuicio').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbJuicio').append('<option value="' + object.cveJuicio + '">' + object.desJuicioDelito + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar Juicios:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Juicios:\n\n" + otroobj);
                }
            });
        });
        $("#cmbTipoPersona").change(function () {
            var tipo = $("#cmbTipoParte").val();
            var persona = $(this).val();
            if (tipo == 0) {
                alert("Debes elegir un Tipo de Parte");
                $("#cmbTipoParte").val(0);
                $(this).val(0);
                $("#divPartesFisica").hide();
                $("#divPartesMoral").hide();
                return false;
            }
            if (persona == 0) {
                alert("Debes elegir un Tipo de Persona");
                $("#cmbTipoParte").val(0);
                $(this).val(0);
                $("#divPartesFisica").hide();
                $("#divPartesMoral").hide();
                return false;
            }
            if (persona == 1) {
                $("#divPartesFisica").show();
                $("#divPartesMoral").hide();
            } else {
                $("#divPartesMoral").show();
                $("#divPartesFisica").hide();
            }
        });
        $("#cmbEstado").change(function () {
            var estado = $(this).val();
            var estadoActual = $("#cveEstado").val();
            if (estado != estadoActual) {
                $("#cmbJuzgado").val(0);
                $("#juzgadoProcedencia").val('');
                $("#divJuzgadoProcedencia").show("slide");
                $("#divJuzgadoProcedenciaCmb").hide("slide");
            } else {
                $("#cmbJuzgado").val(0);
                $("#juzgadoProcedencia").val('');
                $("#divJuzgadoProcedencia").hide("slide");
                $("#divJuzgadoProcedenciaCmb").show("slide");
            }

        });
        $("#modificarParte").click(function () {
            $("#agregarParte").show();
            $("#modificarParte").hide();
            var part = $("#part").val();
            var posicion = $("#posicion").val();
            $("#tablaPartes tbody tr:eq(" + posicion + ")").empty();
            var tipo = $("#cmbTipoParte").val();
            var nombreTipo = $('select[name=cmbTipoParte] option:selected').text();
            var persona = $("#cmbTipoPersona").val();
            var nombrePersona = $('select[name=cmbTipoPersona] option:selected').text();
            var nombreFisica = $("#txtNombreFisica").val();
            var paternoFisica = $("#txtPaternoFisica").val();
            var maternoFisica = $("#txtMaternoFisica").val();
            var edadFisica = $("#txtEdadFisica").val();
            var fNacFisica = $("#txtFNacFisica").val();
            var rfcFisica = $("#txtRfcFisica").val();
            var curpFisica = $("#txtCurpFisica").val();
            var generoFisica = $("#cmbGenero").val();
            var direccionFisica = $("#txtDireccionFisica").val();
            var estadoMoral = $("#cmbEstadoMoral").val();
            var municipioMoral = $("#cmbMunicipioMoral").val();
            var estadoFisica = $("#cmbEstadoFisica").val();
            var municipioFisica = $("#cmbMunicipioFisica").val();
            var telefonoFisica = $("#txtTelefonoFisica").val();
            var mailFisica = $("#txtMailFisica").val();
            var detenidoFisica = $("#cmbDetenido").val();
            var nombreMoral = $("#txtNombreMoral").val();
            var rfcMoral = $("#txtRfcMoral").val();
            var direccionMoral = $("#txtDireccionMoral").val();
            var telefonoMoral = $("#txtTelefonoMoral").val();
            var mailMoral = $("#txtMailMoral").val();
            var dataParte = JSON.stringify({idParte: part,
                posicion: posicion,
                tipo: tipo,
                persona: persona,
                nombreFisica: nombreFisica,
                paternoFisica: paternoFisica,
                maternoFisica: maternoFisica,
                edadFisica: edadFisica,
                fNacFisica: fNacFisica,
                rfcFisica: rfcFisica,
                curpFisica: curpFisica,
                generoFisica: generoFisica,
                direccionFisica: direccionFisica,
                estadoFisica: estadoFisica,
                municipioFisica: municipioFisica,
                telefonoFisica: telefonoFisica,
                mailFisica: mailFisica,
                detenidoFisica: detenidoFisica,
                nombreMoral: nombreMoral,
                rfcMoral: rfcMoral,
                direccionMoral: direccionMoral,
                estadoMoral: estadoMoral,
                municipioMoral: municipioMoral,
                telefonoMoral: telefonoMoral,
                mailMoral: mailMoral
            });
            var tabla = '';
            tabla += "<td>" + nombreTipo + "</td>";
            tabla += "<td>" + nombrePersona + "</td>";
            if (persona == 1) {
                tabla += "<td>" + nombreFisica + " " + paternoFisica + " " + maternoFisica + "</td>";
            } else {
                tabla += "<td>" + nombreMoral + "</td>";
            }
            tabla += "<td>";
            tabla += "<input type='hidden' name='dataParte_" + posicion + "' id='dataParte_" + posicion + "' value='" + dataParte + "'>";
            tabla += "<a onclick='datosPartes(" + dataParte + ");'>Editar</a> <a class='trPosicion' pos=''>Eliminar</a>";
            tabla += "</td>";
            $("#tablaPartes tbody tr:eq(" + posicion + ")").append(tabla);
            $("#limpiarParte").trigger("click");
            actualizaPosicion();
        });
        datosPartes = function (dataParte) {
            $("#part").val(dataParte.idParte);
            $("#cmbTipoParte").val(dataParte.tipo);
            $("#cmbTipoPersona").val(dataParte.persona);
            $("#txtNombreFisica").val(dataParte.nombreFisica);
            $("#txtPaternoFisica").val(dataParte.paternoFisica);
            $("#txtMaternoFisica").val(dataParte.maternoFisica);
            $("#txtEdadFisica").val(dataParte.edadFisica);
            $("#txtFNacFisica").val(dataParte.fNacFisica);
            $("#txtRfcFisica").val(dataParte.rfcFisica);
            $("#txtCurpFisica").val(dataParte.curpFisica);
            $("#cmbGenero").val(dataParte.generoFisica);
            $("#txtDireccionFisica").val(dataParte.direccionFisica);
            $("#cmbEstadoFisica").val(dataParte.estadoFisica);
            $("#cmbEstadoMoral").val(dataParte.estadoMoral);
            $(".cmbEstadoParte").trigger("change");
            $("#cmbMunicipioFisica").val(dataParte.municipioFisica);
            $("#txtTelefonoFisica").val(dataParte.telefonoFisica);
            $("#txtMailFisica").val(dataParte.mailFisica);
            $("#cmbDetenido").val(dataParte.detenidoFisica);
            $("#txtNombreMoral").val(dataParte.nombreMoral);
            $("#txtRfcMoral").val(dataParte.rfcMoral);
            $("#txtDireccionMoral").val(dataParte.direccionMoral);
            $("#txtTelefonoMoral").val(dataParte.telefonoMoral);
            $("#cmbMunicipioMoral").val(dataParte.municipioFisica);
            $("#txtMailMoral").val(dataParte.mailMoral);
            $("#posicion").val(dataParte.posicion);
            $("#divPartesFisica").hide();
            $("#divPartesMoral").hide();
            $("#cmbTipoPersona").trigger("change");
            $("#modificarParte").show();
            $("#agregarParte").hide();
        };
        $(".cmbEstadoParte").change(function () {
            var persona = $("#cmbTipoPersona").val();
            var estado = 0;
            if (persona == 1) {
                estado = $("#cmbEstadoFisica").val();
            } else {
                estado = $("#cmbEstadoMoral").val();
            }
            comboMunicipios(estado);
        });
        ///////////////////////////////////////////
        //////////////ELIMINA PARTES///////////////
        ///////////////////////////////////////////
        $("#tablaPartes").on("click", ".trPosicion", function () {
            var posicion = $(this).attr("pos");
            $("#tablaPartes tbody tr:eq(" + posicion + ")").remove();
            actualizaPosicion();
        });
        comboJuzgados = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/juzgados/JuzgadosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbJuzgado').empty();
                        $('.cmbJuzgado').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbJuzgado').append('<option value="' + object.cveJuzgado + '">' + object.desJuzgado + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar Juzgados:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Juzgados:\n\n" + otroobj);
                }
            });
        };
        comboEstados = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/estados/EstadosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", like: "like", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbEstado').empty();
                        $('.cmbEstado').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbEstado').append('<option value="' + object.cveEstado + '">' + object.desEstado + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar estados:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de estados:\n\n" + otroobj);
                }
            });
        };
        comboEstadosPartes = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/estados/EstadosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", like: "like", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbEstadoParte').empty();
                        $('.cmbEstadoParte').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbEstadoParte').append('<option value="' + object.cveEstado + '">' + object.desEstado + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar estados:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de estados:\n\n" + otroobj);
                }
            });
        };
        comboMunicipios = function (idEstado) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/municipios/MunicipiosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", cveEstado: idEstado, activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbMunicipio').empty();
                        $('.cmbMunicipio').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbMunicipio').append('<option value="' + object.cveMunicipio + '">' + object.desMunicipio + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar municipios:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de municipios:\n\n" + otroobj);
                }
            });
        };
        comboMaterias = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/materias/MateriasFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbMateria').empty();
                        $('.cmbMateria').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbMateria').append('<option value="' + object.cveMateria + '">' + object.desMateria + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar materias:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de materias:\n\n" + otroobj);
                }
            });
        };
        comboCuantias = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/cuantias/CuantiasFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbCuantia').empty();
                        $('.cmbCuantia').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbCuantia').append('<option value="' + object.cveCuantia + '">' + object.desCuantia + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar cuantias:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de cuantias:\n\n" + otroobj);
                }
            });
        };
        comboConsignaciones = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/consignaciones/ConsignacionesFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbConsignacion').empty();
                        $('.cmbConsignacion').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbConsignacion').append('<option value="' + object.cveConsignacion + '">' + object.desConsignacion + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar consignaciones:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de consignaciones:\n\n" + otroobj);
                }
            });
        };
        comboEstatusExhortos = function () {
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
                        $('.cmbEstatusExhorto').empty();
                        $('.cmbEstatusExhorto').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbEstatusExhorto').append('<option value="' + object.cveEstatusExhorto + '">' + object.desEstatusExhorto + '</option>');
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
        comboTiposPartes = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/tipospartes/TipospartesFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbTipoParte').empty();
                        $('.cmbTipoParte').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbTipoParte').append('<option value="' + object.cveTipoParte + '">' + object.descTipoParte + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar tipospartes:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de tipospartes:\n\n" + otroobj);
                }
            });
        };
        comboTiposPersonas = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/tipospersonas/TipospersonasFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbTipoPersona').empty();
                        $('.cmbTipoPersona').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbTipoPersona').append('<option value="' + object.cveTipoPersona + '">' + object.desTipoPersona + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar tipospersonas:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de tipospersonas:\n\n" + otroobj);
                }
            });
        };
        comboGeneros = function () {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/generos/GenerosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "consultar", activo: "S"},
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    try {
                        $('.cmbGenero').empty();
                        $('.cmbGenero').append('<option value="0">Seleccione una opcion</option>');
                        if (datos.totalCount > 0) {
                            $.each(datos.data, function (count, object) {
                                $('.cmbGenero').append('<option value="' + object.cveGenero + '">' + object.desGenero + '</option>');
                            });
                        }
                    } catch (e) {
                        alert("Error al cargar Generos:" + e);
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Generos:\n\n" + otroobj);
                }
            });
        };
        comboSiNo = function () {
            $('.cmbSiNo').empty();
            $('.cmbSiNo').append('<option value="0">Seleccione una opcion</option>');
            $('.cmbSiNo').append('<option value="S">SI</option>');
            $('.cmbSiNo').append('<option value="N">NO</option>');
        };


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
        fd.append('idExhorto', $('#idExhorto').val() );
        fd.append('cveTipoDocumento', '8');
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
        ////////////////////////////////////////////////////////
        /////////////////INICIALIZA FUNCIONES///////////////////
        ////////////////////////////////////////////////////////

        $(function () {
            juzgadoUsuario();
            comboJuzgados();
            comboEstados();
            comboEstadosPartes();
            comboMaterias();
            comboCuantias();
            comboConsignaciones();
            comboEstatusExhortos();
            comboTiposPartes();
            comboTiposPersonas();
            comboGeneros();
            comboSiNo();
            $("#cmbEstado").val($("#cveEstado").val());

            $("#cmbEstatusExhorto").val(2);
            $('.fecha').datetimepicker({
                locale: 'es',
                sideBySide: false,
                format: "DD/MM/YYYY",
                ignoreReadonly: true
            });
            $("#txtFNacFisica").on("dp.change", function (e) {
                var fecha = $("#txtFNacFisica").val();
                var edad = calcularEdad(fecha);
                if(edad > 10){
                    $("#txtEdadFisica").val(edad);
                }
            });
            $("#fechaInicioConsulta").on("dp.change", function (e) {
                $('#fechaFinConsulta').data("DateTimePicker").minDate(e.date);
            });
            $("#fechaFinConsulta").on("dp.change", function (e) {
                $('#fechaInicioConsulta').data("DateTimePicker").maxDate(e.date);
            });
        });

    </script>
