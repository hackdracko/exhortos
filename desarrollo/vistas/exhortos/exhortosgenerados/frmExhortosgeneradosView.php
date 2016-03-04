<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="application/json; charset=UTF-8" />
<?php
	header('Content-Type: text/html; charset=UTF-8'); 
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
?>
<style type="text/css">
    .alert{ display: none; }
    #divHideForm{ display: none; position: absolute; width: 100%; height: 100vh; opacity: .5; z-index: 99999; background: #427468; }
    #divMenssage{ width: 100%; height: 40px; padding-top: 10px; padding-bottom: 10px; text-align: center; margin-top: 40vh; margin-bottom: auto; color: #284740; background: #FFFFFF; text-transform: uppercase; }
    #divImgloading{ background: #FFFFFF url(img/cargando_1.gif) no-repeat; background-position: center; width: 100%; height: 70px; margin-left: auto; margin-right: auto; }
    .panel panel-default{ background: #427468; color: #ebf3f1; }
    .panel-heading{ background: #427468; color: #ebf3f1; }
    .panel-group .panel-heading{ background: #427468; color: #ebf3f1; }
    .panel-default > .panel-heading{ background: #427468; color: #ebf3f1; }
    .imputadoDesc{ text-decoration: underline; }
	.needed:after { color:darkred; content: " (*)"; }
	.textCorrection{ display: block; text-transform: lowercase; }
	.textCorrection:first-letter { text-transform: uppercase; }
	.capital{ text-transform: uppercase; }
	input[type='text'], textarea { text-transform: uppercase; resize: none; }
	.inputLower{ text-transform: lowercase !important; }
 	.divPersonaFisica, .divPersonaMoral, .botonesPersonas{ display: none; }
 	.tablaPartes{ margin-top: 30px; margin-bottom: 40px; }
 	td{ text-transform: uppercase !important; }
 	.status1 { color:inherit; border-bottom: 2px solid #FE9A2E; }
 	.status2 { color:inherit; border-bottom: 2px solid #0080FF; }
 	.status3 { color:inherit; border-bottom: 2px solid #01DF01; }
 	.status4 { color:inherit; border-bottom: 2px solid #DF0101; }
</style>
<input type="hidden" id="idActuacion" name="idActuacion"/>
<input type="hidden" id="cveJuzgado" name="cveJuzgado" value="<?=$_SESSION['cveAdscripcion']?>"/>
<input type="hidden" id="fechaHoy" name="fechaHoy" value="<?=date("d/m/Y")?>"/>
<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="<?=$_SESSION['nombre']?>" />
<input type="hidden" id="fechaSistema" name="fechaSistema" value="<?=date('d/m/Y G:i:s')?>" />
<input type="hidden" id="desAdscripcion" name="desAdscripcion" value="<?=$_SESSION['desAdscripcion']?>" />
<input type="hidden" id="uploadMaxSize" name="uploadMaxSize" value="<?=file_upload_max_size()?>" />
<input type="hidden" id="uploadMaxFiles" name="uploadMaxFiles" value="10485760" /> <!-- 10 Mb -->
<input type="hidden" id="totalAdjuntos" name="totalAdjuntos" value="0" /> <!-- 0 Mb -->
<div class="panel panel-default">
	<div class="panel-heading">
	<span id="spanSession"></span>
	    <h5 class="panel-title" id="exhortosGeneradosTitulo">
	        Exhortos Generados
	    </h5>
	</div>
	<div class="panel-body" id="seccion_captura">
		<form class="form-horizontal" role="form" id="formulario_exhortos"> 
			<fieldset>
				<legend>Informaci&oacute;n del Exhorto Generado</legend>
				<div class="form-group" >
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">Detalles del Exhorto Generado</label>
					<div class="col-xs-11  col-sm-3 col-md-2">
						<label style="display: block;">Status</label>
						<span style="display: block;" id="divStatusExhorto">POR ENVIAR</span>
					</div>
					<div class="col-xs-11  col-sm-3 col-md-2">
						<label style="display: block;">No. / Año de Exhorto</label>
						<span style="display: block;" id="divNoAnioExhorto">---- / ----</span>
					</div>
					<div class="col-xs-11 col-sm-3 col-md-4">
						<label style="display: block;">Juzgado asignado</label>
						<span style="display: block;" id="divJuzgadoAsignado">--------</span>
					</div>
				</div>
				<div class="form-group"> <!-- Número y Año de Expediente -->
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">N&uacute;mero y A&ntilde;o de Exhorto Generado</label>
					<div class="col-xs-12 col-sm-6 col-md-5">
						<input type="text" id="numActuacion" name="numActuacion" maxlength="5" size="7" placeholder="N&uacute;mero" val="" class="form-inline" tabindex="" disabled="disabled" />
						/
						<input type="text" id="aniActuacion" name="aniActuacion" maxlength="4" size="7" placeholder="A&ntilde;o" val="" class="form-inline" tabindex="" disabled="disabled" />
					</div>
				</div> <!-- Número y Año de Expediente/ -->
				<div class="form-group"> <!-- Estado Destino -->
					<label for="cveEstadoDestino" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Estado Destino</label>
					<div class="col-xs-12 col-sm-8 col-md-3">
						<select id="cveEstadoDestino" name="cveEstadoDestino" class="form-control" tabindex=""></select>
					</div>
				</div> <!-- Estado Destino/ -->
				<div class="form-group"> <!-- Oficialia -->
					<label for="cveOficialia" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Oficialia</label>
					<div class="col-xs-12 col-sm-8 col-md-5">
						<select id="cveOficialia" name="cveOficialia" class="form-control" tabindex="">
 							<option value="0">--SELECCIONE UN ESTADO DESTINO--</option>
						</select>
					</div>
				</div> <!-- Estado Destino/ -->
				<div class="form-group" style="display: none;"> <!-- Tipo de Actuación -->
					<label for="cveTipoActuacion" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Tipo de Actuaci&oacute;n</label>
					<div class="col-xs-12 col-sm-8 col-md-3">
						<select id="cveTipoActuacion" name="cveTipoActuacion" class="form-control" tabindex="" disabled="disabled"></select>
					</div>
				</div> <!-- Tipo de Actuación/ -->
				<div class="form-group"> <!-- Número y Año de Expediente -->
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2 needed">N&uacute;mero y A&ntilde;o de Expediente</label>
					<div class="col-xs-12 col-sm-8 col-md-7">
						<input type="text" id="numeroExp" name="numeroExp" maxlength="5" size="7" placeholder="N&uacute;mero Expediente" val="" class="form-inline" tabindex=""/>
						/
						<input type="text" id="anioExp" name="anioExp" maxlength="4" size="7" placeholder="A&ntilde;o Expediente" val="" class="form-inline" tabindex=""/>
					</div>
				</div> <!-- Número y Año de Expediente/ -->
				<div class="form-group"> <!-- Número y Año de Oficio -->
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2 needed">N&uacute;mero y A&ntilde;o de Oficio</label>
					<div class="col-xs-12 col-sm-8 col-md-7">
						<input type="text" id="numOficio" name="numOficio" maxlength="5" size="7" placeholder="N&uacute;mero Oficio" val="" class="form-inline" tabindex=""/>
						/
						<input type="text" id="anioOficio" name="anioOficio" maxlength="4" size="7" placeholder="A&ntilde;o Oficio" val="" class="form-inline" tabindex=""/>
					</div>
				</div> <!-- Número y Año de Oficio/ -->
				<div class="form-group"> <!-- Tipo -->
					<label for="cveTipo" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Tipo de Carpeta</label>
					<div class="col-xs-12 col-sm-8 col-md-3">
						<select id="cveTipo" name="cveTipo" class="form-control" tabindex=""></select>
					</div>
				</div> <!-- Tipo/ -->
				<div class="form-group"> <!-- Materia -->
					<label for="cveMateria" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Materia</label>
					<div class="col-xs-12 col-sm-8 col-md-3">
						<select id="cveMateria" name="cveMateria" class="form-control" tabindex=""></select>
					</div>
				</div> <!-- Materia/ -->
				<div class="form-group"> <!-- Juicio -->
					<label for="cveJuicio" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Juicio</label>
					<div class="col-xs-12 col-sm-8 col-md-6">
						<select id="cveJuicio" name="cveJuicio" class="form-control" tabindex=""><option value="0">--SELECCIONE MATERIA--</option></select>
						<input type="text" id="otroJuicio" name="otroJuicio" maxlength="100" placeholder="DEFINA EL JUICIO" val="" class="form-control" tabindex="" style="display: none;" />
					</div>
				</div> <!-- Juicio/ -->
				<div class="form-group"> <!-- Cuantía -->
					<label for="cveCuantia" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Cuant&iacute;a</label>
					<div class="col-xs-12 col-sm-8 col-md-3">
						<select id="cveCuantia" name="cveCuantia" class="form-control" tabindex=""></select>
					</div>
				</div> <!-- Cuantía/ -->
				<div class="form-group"> <!-- Carpeta de Investigación -->
					<label for="carpetaInv" class="control-label col-xs-12 col-sm-2 col-md-2">Carpeta de Investigaci&oacute;n</label>
					<div class="col-xs-12 col-sm-8 col-md-5">
						<input type="text" id="carpetaInv" name="carpetaInv" maxlength="30" placeholder="Carpeta de Investigaci&oacute;n" val="" class="form-control" tabindex="" disabled="disabled" />
					</div>
				</div> <!-- Carpeta de Investigación/ -->
				<div class="form-group"> <!-- Número Unico de Causa (NUC) -->
					<label for="nuc" class="control-label col-xs-12 col-sm-2 col-md-2">N&uacute;mero Unico de Causa (NUC)</label>
					<div class="col-xs-12 col-sm-8 col-md-5">
						<input type="text" id="nuc" name="nuc" maxlength="30" placeholder="N&uacute;mero Unico de Causa (NUC)" val="" class="form-control" tabindex="" disabled="disabled" />
					</div>
				</div> <!-- Número Unico de Causa (NUC)/ -->
				<div class="form-group"> <!-- No. de Fojas -->
					<label for="noFojas" class="control-label col-xs-12 col-sm-2 col-md-2 needed">No. de Fojas</label>
					<div class="col-xs-12 col-sm-8 col-md-2">
						<input type="text" id="noFojas" name="noFojas" maxlength="7" placeholder="No. de Fojas" val="" class="form-control" tabindex=""/>
					</div>
				</div> <!-- No. de Fojas/ -->
				<div class="form-group"> <!-- Síntesis -->
					<label for="sintesis" class="control-label col-xs-12 col-sm-2 col-md-2 needed">S&iacute;ntesis</label>
					<div class="col-xs-12 col-sm-8 col-md-7">
						<input type="text" id="sintesis" name="sintesis" maxlength="300" placeholder="S&iacute;ntesis" val="" class="form-control" tabindex=""/>
					</div>
				</div> <!-- Síntesis/ -->
				<div class="form-group"> <!-- Observaciones -->
					<label for="observaciones" class="control-label col-xs-12 col-sm-2 col-md-2">Observaciones</label>
					<div class="col-xs-12 col-sm-8 col-md-7">
						<textarea id="observaciones" name="observaciones" placeholder="Observaciones" rows="6" cols="" class="form-control" tabindex=""></textarea>
					</div>
				</div> <!-- Observaciones/ -->
				<div class="form-group"> <!-- Consignación -->
					<label for="cveConsignacion" class="control-label col-xs-12 col-sm-2 col-md-2">Consignaci&oacute;n</label>
					<div class="col-xs-12 col-sm-8 col-md-7" id="consignacionExhorto">
						<select id="cveConsignacion" name="cveConsignacion" class="form-control" tabindex="" style="display:none;"></select>
						<span id="inputConsignacionExhorto"><!-- POR DEFINIR --></span>
					</div>
				</div> <!-- Consignación/ -->
			</fieldset>
		</form>
 		<form class="form-horizontal" role="form" id="formulario_partes"> 
			<fieldset>
				<legend>Informaci&oacute;n de las partes</legend>
					<!-- inicio partes -->
                        <!-- INICIO DE FORMULARIO DE IMPUTADOS -->
						<div class="form-group"> <!-- Tipo de parte -->
							<label for="cveTipoParte" class="control-label col-xs-12 col-sm-2 col-md-2">Tipo de Parte</label>
							<div class="col-xs-12 col-sm-8 col-md-4">
								<select id="cveTipoParte" name="cveTipoParte" class="form-control" tabindex="" disabled="disabled"></select>
							</div>
						</div> <!-- Tipo de parte/ -->
						<div class="form-group"> <!-- Tipo de Persona -->
							<label for="cveTipoPersona" class="control-label col-xs-12 col-sm-2 col-md-2">Tipo de Persona</label>
							<div class="col-xs-12 col-sm-8 col-md-4">
								<select id="cveTipoPersona" name="cveTipoPersona" class="form-control" tabindex="" disabled="disabled"></select>
                                <input type="hidden" name="idParte" id="idParte"/>
							</div>
						</div> <!-- Tipo de Persona/ -->
						<!-- Div de persona fisica -->
						<div id="divPersonaFisica" class="divPersonaFisica">
							<fieldset>
							<legend>Persona F&iacute;sica</legend>
							<div class="form-group"> <!-- Nombre -->
								<label for="nombre" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Nombre</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="nombre" name="nombre" maxlength="100" placeholder="Nombre" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Nombre/ -->
							<div class="form-group"> <!-- Apellido Paterno -->
								<label for="paterno" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Apellido Paterno</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="paterno" name="paterno" maxlength="100" placeholder="Apellido Paterno" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Apellido Paterno/ -->
							<div class="form-group"> <!-- Apellido Materno -->
								<label for="materno" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Apellido Materno</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="materno" name="materno" maxlength="100" placeholder="Apellido Materno" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Apellido Materno/ -->
							<div class="form-group"> <!-- Fecha de nacimiento -->
								<label for="fechaNacimiento" class="control-label col-xs-12 col-sm-2 col-md-2">Fecha de Nacimiento</label>
								<div class="col-xs-12 col-sm-8 col-md-2">
									<input type="text" id="fechaNacimiento" name="fechaNacimiento" maxlength="" placeholder="Fecha de nacimiento" val="" class="form-control datepicker" data-date-format="dd/mm/yyyy" tabindex=""/>
								</div>
							</div> <!-- Fecha de nacimiento/ -->
							<div class="form-group"> <!-- Edad -->
								<label for="edad" class="control-label col-xs-12 col-sm-2 col-md-2">Edad</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="hidden" id="edad" name="edad" maxlength="" placeholder="" val="" class="form-control" tabindex=""/>
									<span id="txtEdad"></span>
								</div>
							</div> <!-- Edad/ -->
							<div class="form-group"> <!-- genero -->
								<label for="cveGenero" class="control-label col-xs-12 col-sm-2 col-md-2 needed">G&eacute;nero</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<select id="cveGenero" name="cveGenero" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- genero/ -->
							<div class="form-group"> <!-- rfc -->
								<label for="RFC" class="control-label col-xs-12 col-sm-2 col-md-2">RFC</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<input type="text" id="RFC" name="RFC" maxlength="14" placeholder="RFC" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- rfc/ -->
							<div class="form-group"> <!-- curp -->
								<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">CURP</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<input type="text" id="CURP" name="CURP" maxlength="20" placeholder="CURP" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- curp/ -->
							<div class="form-group"> <!-- Telefono -->
								<label for="telefono" class="control-label col-xs-12 col-sm-2 col-md-2">Tel&eacute;fono</label>
								<div class="col-xs-12 col-sm-8 col-md-2">
									<input type="text" id="telefono" name="telefono" maxlength="10" placeholder="Tel&eacute;fono" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Telefono/ -->
							<div class="form-group"> <!-- e-mail -->
								<label for="email" class="control-label col-xs-12 col-sm-2 col-md-2">Correo electr&oacute;nico</label>
								<div class="col-xs-12 col-sm-8 col-md-4">
									<input type="text" id="email" name="email" maxlength="50" placeholder="Correo electr&oacute;nico" val="" class="form-control inputLower" tabindex=""/>
								</div>
							</div> <!-- e-mail/ -->
							<div class="form-group"> <!-- Entidad de la parte -->
								<label for="cveEstado" class="control-label col-xs-12 col-sm-2 col-md-2">Estado</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<select id="cveEstado" name="cveEstado" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Entidad de la parte/ -->
							<div class="form-group"> <!-- Municipio -->
								<label for="cveMunicipio" class="control-label col-xs-12 col-sm-2 col-md-2">Municipio</label>
								<div class="col-xs-12 col-sm-8 col-md-4">
									<select id="cveMunicipio" name="cveMunicipio" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Municipio/ -->
							<div class="form-group"> <!-- Domicilio -->
								<label for="domicilio" class="control-label col-xs-12 col-sm-2 col-md-2">Domicilio</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="domicilio" name="domicilio" maxlength="100" placeholder="Domicilio" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Domicilio/ -->
							<div class="form-group"> <!-- Detenido -->
								<label for="detenido" id="labelDetenido" class="control-label col-xs-12 col-sm-2 col-md-2">Detenido</label>
								<div class="col-xs-12 col-sm-8 col-md-2">
									<select id="detenido" name="detenido" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Detenido/ -->
							</fieldset>
						</div>
						<!-- Div de persona fisica/ -->
						<!-- Div de persona moral -->
						<div id="divPersonaMoral" class="divPersonaMoral">
							<fieldset>
							<legend id="legendPersonaMoral"></legend>
							<div class="form-group"> <!-- Nombre -->
								<label for="nombreMoral" class="control-label col-xs-12 col-sm-2 col-md-2 needed">Nombre</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="nombreMoral" name="nombreMoral" maxlength="350" placeholder="Nombre" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Nombre/ -->
							<div class="form-group"> <!-- rfc -->
								<label for="rfcMoral" class="control-label col-xs-12 col-sm-2 col-md-2">RFC</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<input type="text" id="rfcMoral" name="rfcMoral" maxlength="14" placeholder="RFC" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- rfc/ -->
							<div class="form-group"> <!-- Telefono -->
								<label for="telefonoMoral" class="control-label col-xs-12 col-sm-2 col-md-2">T&eacute;lefono</label>
								<div class="col-xs-12 col-sm-8 col-md-2">
									<input type="text" id="telefonoMoral" name="telefonoMoral" maxlength="10" placeholder="T&eacute;lefono" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Telefono/ -->
							<div class="form-group"> <!-- email -->
								<label for="emailMoral" class="control-label col-xs-12 col-sm-2 col-md-2">Correo electr&oacute;nico</label>
								<div class="col-xs-12 col-sm-8 col-md-4">
									<input type="text" id="emailMoral" name="emailMoral" maxlength="50" placeholder="Correo electr&oacute;nico" val="" class="form-control inputLower" tabindex=""/>
								</div>
							</div> <!-- email/ -->
							<div class="form-group"> <!-- Entidad de la parte -->
								<label for="cveEstadoMoral" class="control-label col-xs-12 col-sm-2 col-md-2">Estado</label>
								<div class="col-xs-12 col-sm-8 col-md-3">
									<select id="cveEstadoMoral" name="cveEstadoMoral" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Entidad de la parte/ -->
							<div class="form-group"> <!-- Municipio -->
								<label for="cveMunicipioMoral" class="control-label col-xs-12 col-sm-2 col-md-2">Municipio</label>
								<div class="col-xs-12 col-sm-8 col-md-4">
									<select id="cveMunicipioMoral" name="cveMunicipioMoral" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Municipio/ -->
							<div class="form-group"> <!-- Domicilio -->
								<label for="domicilioMoral" class="control-label col-xs-12 col-sm-2 col-md-2">Domicilio</label>
								<div class="col-xs-12 col-sm-8 col-md-7">
									<input type="text" id="domicilioMoral" name="domicilioMoral" maxlength="100" placeholder="Domicilio" val="" class="form-control" tabindex=""/>
								</div>
							</div> <!-- Domicilio/ -->
							<div class="form-group"> <!-- Detenido -->
								<label for="detenidoMoral" id="labelDetenidoMoral" class="control-label col-xs-12 col-sm-2 col-md-2">Detenido</label>
								<div class="col-xs-12 col-sm-8 col-md-2">
									<select id="detenidoMoral" name="detenidoMoral" class="form-control" tabindex=""></select>
								</div>
							</div> <!-- Detenido/ -->
							</fieldset>
						</div>
						<!-- Div de persona moral/ -->
                        <div class="form-group botonesPersonas" style="text-align:center" id="botonesPersonas">
                            <button type="button" class="btn btn-primary" name="agregarParte" id="agregarParte">Agregar Parte</button>
                            <button type="button" class="btn btn-primary" name="limpiarParte" id="limpiarParte">Limpiar</button>
                            <button type="button" class="btn btn-primary" name="cancelaParte" id="cancelaParte">Cancelar</button>
                        </div>
                        <table id="tablaPartes"  border="1" align="center"  width="90%"  class="table table-bordered table-striped table-hover table-responsive tablaPartes">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo Parte</th>
                                    <th>Tipo Persona</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
					<!-- fin partes -->
			</fieldset>
 		</form>
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
						<div class="form-group"> <!-- Enviar exhorto -->
							<label for="enviarExhorto" class="control-label col-xs-12 col-sm-2 col-md-2">Enviar Exhorto Generado</label>
							<div class="col-xs-12 col-sm-8 col-md-7" id="consignacionExhorto">
								<input type="checkbox" name="enviarExhorto" id="enviarExhorto">
							</div>
						</div> <!-- Enviar exhorto/ -->

                        <!-- FIN DE FORMULARIO DE ADJUNTOS -->
            </fieldset>
 		</form>
		<div class="form-group" id="botonesExhorto">
			<div class="col-xs-offset-3 col-xs-9">
					<button type="button" class="btn btn-primary btn-lg" id="guardaExhortos"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;Guardar</button>			
                	<!-- <input type="submit" class="btn btn-primary" value="Guardar" id="guardaExhortos"/> -->
                    <input type="submit" class="btn btn-primary btn-lg" value="Limpiar" id="limpiaExhortos"/>
                    <input type="submit" class="btn btn-primary btn-lg" value="Consultar" id="consultaExhortos"/>
                    <input type="submit" class="btn btn-primary btn-lg" value="Eliminar" id="eliminaExhortos" style="display:none;" disabled/>
                    <input type="submit" class="btn btn-primary btn-lg" value="Imprimir" id="imprimeExhorto" style="display:none;"/>
			</div>
		</div>
	</div>

	<div class="panel-body" id="seccion_busqueda">
		<div id="seccionConsulta" style="display: none;">
			<div> <!-- consulta y busqueda -->
				<input type="submit" class="btn btn-primary" value="Regresar" onclick="cambiaModulo('captura')">
				<hr/>
				<div class="form-horizontal">
					<div class="form-group"> <!-- Estado Destino -->
						<label for="b_cveEstadoDestino" class="control-label col-xs-12 col-sm-2 col-md-2">Estado Destino</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveEstadoDestino" name="b_cveEstadoDestino" class="form-control" tabindex=""></select>
						</div>
					</div> <!-- Estado Destino/ -->
					<div class="form-group"> <!-- Actuacion -->
						<label for="b_numActuacion" class="control-label col-xs-12 col-sm-2 col-md-2">Exhorto Generado</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_numActuacion" name="b_numActuacion" maxlength="5" placeholder="N&Uacute;MERO DE EXHORTO GENERADO" val="" class="form-inline" tabindex=""/>
							&nbsp;&nbsp;/&nbsp;&nbsp;
							<input type="text" id="b_aniActuacion" name="b_aniActuacion" maxlength="4" placeholder="A&Ntilde;O DE EXHORTO GENERADO" val="" class="form-inline" tabindex=""/>
						</div>
					</div> <!-- Actuacion/ -->
<!-- 					<div class="form-group"> <!-- Expediente - ->
						<label for="b_numeroExp" class="control-label col-xs-12 col-sm-2 col-md-2">Expediente</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_numeroExp" name="b_numeroExp" maxlength="5" placeholder="N&Uacute;MERO DE EXPEDIENTE" val="" class="form-inline" tabindex=""/>
							&nbsp;&nbsp;/&nbsp;&nbsp;
							<input type="text" id="b_anioExp" name="b_anioExp" maxlength="4" placeholder="A&Ntilde;O DE EXPEDIENTE" val="" class="form-inline" tabindex=""/>
						</div>
					</div> <!-- Expediente/ - -> 
					<div class="form-group"> <!-- Tipo de Carpeta - ->
						<label for="b_cveTipo" class="control-label col-xs-12 col-sm-2 col-md-2">Tipo de Carpeta</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveTipo" name="b_cveTipo" class="form-control" tabindex=""></select>
						</div>
					</div> <!-- Tipo de Carpeta/ - -> -->
<!-- 					<div class="form-group"> <!-- Materia - ->
						<label for="b_cveMateria" class="control-label col-xs-12 col-sm-2 col-md-2">Materia</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveMateria" name="b_cveMateria" class="form-control" tabindex=""></select>
						</div>
					</div> <!-- Materia/ - ->
					<div class="form-group"> <!-- Juicio - ->
						<label for="b_cveJuicio" class="control-label col-xs-12 col-sm-2 col-md-2">Juicio</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveJuicio" name="b_cveJuicio" class="form-control" tabindex=""><option value="0">--SELECCIONE MATERIA--</option></select>
							<input type="text" id="b_otroJuicio" name="b_otroJuicio" maxlength="100" placeholder="DEFINA EL JUICIO" val="" class="form-control" tabindex="" style="display: none;" />
						</div>
					</div> <!-- Juicio/ - ->
					<div class="form-group"> <!-- Cuantia - ->
						<label for="b_cveCuantia" class="control-label col-xs-12 col-sm-2 col-md-2">Cuant&iacute;a</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveCuantia" name="b_cveCuantia" class="form-control" tabindex=""></select>
						</div>
					</div> <!-- Cuantia/ - -> -->
					<div class="form-group"> <!-- Carpeta de Investigacion -->
						<label for="b_carpetaInv" class="control-label col-xs-12 col-sm-2 col-md-2">Carpeta de Investigaci&oacute;n</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_carpetaInv" name="b_carpetaInv" maxlength="30" placeholder="Carpeta de Investigaci&oacute;n" val="" class="form-control" tabindex="" />
						</div>
					</div> <!-- Carpeta de Investigacion/ -->
					<div class="form-group"> <!-- NUC -->
						<label for="b_NUC" class="control-label col-xs-12 col-sm-2 col-md-2">NUC</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_NUC" name="b_NUC" maxlength="30" placeholder="NUC" val="" class="form-control" tabindex="" />
						</div>
					</div> <!-- NUC/ -->
					<div class="form-group"> <!-- Consignacion -->
						<label for="b_cveConsignacion" class="control-label col-xs-12 col-sm-2 col-md-2">Consignaci&oacute;n</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<select id="b_cveConsignacion" name="b_cveConsignacion" class="form-control" tabindex="" ></select>
						</div>
					</div> <!-- Consignacion/ -->
					<div class="form-group"> <!-- Fecha inicio -->
						<label for="b_fechaInicio" class="control-label col-xs-12 col-sm-2 col-md-2">Fecha inicio</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_fechaInicio" name="b_fechaInicio" maxlength="10" placeholder="Fecha inicio" val="" class="form-control datepicker" data-date-format="dd/mm/yyyy" tabindex=""/>
						</div>
					</div> <!-- Fecha inicio/ -->
					<div class="form-group"> <!-- Fecha fin -->
						<label for="b_fechaFin" class="control-label col-xs-12 col-sm-2 col-md-2">Fecha fin</label>
						<div class="col-xs-12 col-sm-8 col-md-7">
							<input type="text" id="b_fechaFin" name="b_fechaFin" maxlength="10" placeholder="Fecha fin" val="" class="form-control datepicker" data-date-format="dd/mm/yyyy" tabindex=""/>
						</div>
					</div> <!-- Fecha fin/ -->
					<div class="form-group">
						<div class="col-xs-offset-3 col-xs-9">
		                    <input type="submit" class="btn btn-primary" value="Buscar" id="buscarExhortos">
		                    <input type="submit" class="btn btn-primary" value="Limpiar" id="buscarLimpiar">
	                    </div>
					</div>
				</div>
			</div>
		</div>
		<div id="seccionResultados" style="display: none;">
			<div> <!-- resultados -->
				<input type="submit" class="btn btn-primary" value="Regresar" onclick="cambiaModulo('consulta')">
<!--                 &nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" value="Enviar seleccionado(s)" onclick="enviarExhortosExpress()"> -->
				<hr/>
				<div class="form-horizontal">



<!--             <div class="col-xs-12"> <!-- paginacion - -> -->
<!--                 <div class="form-group col-xs-4" style="padding: 10px">
                    <label class="control-label" id="totalReg"></label>
                </div>
                <div id="divPaginador" class="form-group col-xs-4" >
                    <label class="control-label">Cambiar a la p&aacute;gina:</label>
                    <select  name="cmbPaginacion" id="cmbPaginacion" onchange="findMedidasCautelares()">
                    </select>
                </div>
                <div id="divPaginador" class="form-group col-xs-4" >
                    <label class="control-label">Registros por p&aacute;gina:</label>
                    <select  name="cmbNumReg" id="cmbNumReg" onchange="findMedidasCautelares()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div> -->
			<div class="col-xs-12 table-responsive" id="divTablaResultados">
			</div>
			</div>
		</div>
	</div>

    <div class="form-group" id="notificaciones">
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
    <div id="imprimir" style="display: none;">
        <div id="printable" ></div>
        <div id="botones">
            <input type="submit" class="btn btn-primary" id="inputRegresar" value="Regresar" onclick="" style="display: block"> 
        </div>
    </div>    
</div>
<script type="text/javascript">
	// Variable para almacenar a las partes
	var partes = {
		data:[],
		counter:0
	};

	obtenerMaximoEnvio = function(){
		var maxDefinido = $('#uploadMaxFiles').val();
		return ( ((maxDefinido/1024)/1024) + ' Mb' );
	}

	obtenerMaximoPorArchivo = function(){
		var maxDefinido = $('#uploadMaxSize').val();
		return ( ((maxDefinido/1024)/1024) + ' Mb' );
	}

	/**
	* Función para el envío masivo de exhortos
	*/
	enviarExhortosExpress = function(){
		var idExhortos = [], contador=0, idExhortoExpress = { 'idExhortoExpress':[] };
		$('#tblResultados input:checked').each(function(){
			idExhortos[contador++] = $(this).prop('id');
		});
		idExhortoExpress['idExhortoExpress'] = idExhortos;
	}

	/**
	* Acción al presionar el check de 'enviar exhorto', cambio de etiqueta en boton de guardar
	*/
	$('#enviarExhorto').on('click', function(){
		var icono = ( $('#idActuacion').val() == '' ) ? 'floppy-save' : 'refresh';
		var etiqueta = ( ( $('#idActuacion').val() == '' ) ? 'Guardar' : 'Actualizar' ) + ( ( $(this).prop('checked') == true ) ? ' y Enviar' : '' );
		$('#guardaExhortos').html('<span class="glyphicon glyphicon-' + icono + '" aria-hidden="true"></span>&nbsp;' + etiqueta);
	});

	/**
	* Acción al presionar el botón de limpiar en consulta
	*/
	$('#buscarLimpiar').on('click', function(){
		limpiaFormulario('consulta');
	});

	/**
	* Función para mostrar la información un Exhorto generado a través del Id de Actuación
	*/
	muestraExhorto = function( objeto ){
		var estatusExhorto = objeto.exhortoGenerado[0].cveEstatusExhorto[0].cveEstatusExhorto;
		var tmpStatus = false;
		var tmpStatusAdjunto = false;
		//oculta seccion de 'busqueda', 'resultados' y muestra la sección principal
		cambiaModulo('captura');
		$('#idActuacion').val(objeto.idActuacion);
		$('#cveEstadoDestino').val(objeto.exhortoGenerado[0].cveEstadoDestino[0].cveEstado);
		$('#cveOficialia').empty().append( obtieneOficialias( objeto.exhortoGenerado[0].cveEstadoDestino[0].cveEstado ) ).val(objeto.exhortoGenerado[0].cveOficialia);
		$('#numActuacion').val(objeto.numActuacion);
		$('#aniActuacion').val(objeto.aniActuacion);
		$('#cveTipoActuacion').val(objeto.cveTipoActuacion);
		$('#numeroExp').val(objeto.numeroExp);
		$('#anioExp').val(objeto.anioExp);
		$('#numOficio').val(objeto.numOficio);
		$('#anioOficio').val(objeto.anioOficio);
		$('#cveTipo').val(objeto.cveTipo[0].cveTipo);
		$('#cveMateria').val(objeto.cveMateria);
		$('#cveCuantia').val(objeto.cveCuantia);
		$('#carpetaInv').val( ( objeto.carpetaInv == 'n/a' ) ? '' : objeto.carpetaInv );
		$('#nuc').val( ( objeto.nuc == 'n/a' ) ? '' : objeto.nuc );
		$('#noFojas').val(objeto.noFojas);
		$('#sintesis').val(objeto.sintesis);
		$('#observaciones').val(objeto.observaciones); 
		$('#divStatusExhorto').empty().html(objeto.exhortoGenerado[0].cveEstatusExhorto[0].desEstatusExhorto);
		if( objeto.exhortoGenerado[0].cveEstatusExhorto[0].cveEstatusExhorto != 5 ){
			$('#divNoAnioExhorto').empty().html(objeto.exhortoGenerado[0].numeroAnio);
			$('#divJuzgadoAsignado').empty().html(objeto.juzgadoDestino);
		}else{
			$('#divNoAnioExhorto').empty().html('---- / ----');
			$('#divJuzgadoAsignado').empty().html('--------');
		}
		//activacion de campos de tipos de persona y parte
		$('#cveTipoPersona, #cveTipoParte').prop('disabled',false);
		if( objeto.cveMateria == globales.materiaPenal ){
			$('#carpetaInv, #nuc').prop('disabled',false);
		}else{
			$('#carpetaInv, #nuc').prop('disabled',true);
		}
		//validacion de juicio, actualiza combo
		$('#cveJuicio').empty().append( juiciosMateria( objeto.cveMateria ) ).append('<option value="9999">OTRO JUICIO</option>').val(objeto.exhortoGenerado[0].juiciosExhortos[0].cveJuicio);
		herenciaMateria( objeto.cveMateria, 'consulta' );

		//valida la opcion de 'otro juicio'
		muestraOtroJuicio( $('#cveJuicio').val() );
		$('#otroJuicio').val(objeto.exhortoGenerado[0].juiciosExhortos[0].otroJuicio);
		var partesObj = objeto.exhortoGenerado[0].partes;
		var dataConsulta = [], contador=0;
		var tipoPersona = 0;
		$.each(partesObj, function(k,v){
			tipoPersona = v.cveTipoPersona[0].cveTipoPersona;
			if(tipoPersona == '1'){
				dataConsulta[contador] = {
					//idParte:partes.counter,
					cveTipoParte:v.cveTipoParte[0].cveTipoParte,
					descTipoParte:v.cveTipoParte[0].descTipoParte,
					cveTipoPersona:v.cveTipoPersona[0].cveTipoPersona,
					desTipoPersona:v.cveTipoPersona[0].desTipoPersona,
					nombre:v.nombre,
					paterno:v.paterno,
					materno:v.materno,
					fechaNacimiento:v.fechaNacimiento,
					edad:v.edad,
					cveGenero:v.cveGenero,
					RFC:v.rfc,
					CURP:v.curp,
					telefono:v.telefono,
					email:v.email,
					cveEstado:v.cveEstado,
					cveMunicipio:v.cveMunicipio,
					domicilio:v.domicilio,
					detenido:v.detenido
				};
				contador++;
			}else if(tipoPersona == '2' || tipoPersona == '3'){
				dataConsulta[contador] = {
					//idParte:partes.counter, 
					cveTipoParte:v.cveTipoParte[0].cveTipoParte,
					descTipoParte:v.cveTipoParte[0].descTipoParte,
					cveTipoPersona:v.cveTipoPersona[0].cveTipoPersona,
					desTipoPersona:v.cveTipoPersona[0].desTipoPersona,
					nombrePersonaMoral:v.nombrePersonaMoral,
					cveGenero:3,
					RFC:v.rfc,
					telefono:v.telefono,
					email:v.email,
					cveEstado:v.cveEstado,
					cveMunicipio:v.cveMunicipio,
					domicilio:v.domicilio,
					detenido:v.detenido
				};
				contador++;
			}
		});
		//llena tabla de 'partes'
		partes.data = dataConsulta;
		partes.counter = contador;
		llenaTablaPartes();
		//cambia etiqueta del boton
		$('#guardaExhortos').html('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Actualizar');
		//valida el estatus del exhorto
		$.each( globales.estatusExhortoBloqueado, function(index, value){
			if( estatusExhorto == value ){
				tmpStatus = true;
			}
		});
		//muestra los archivos adjuntos
		muestraAdjuntos(objeto.adjuntos);
		//valida el estatus del exhorto para adjuntar archivos
		$.each( globales.estatusAdjuntoBloqueado, function(index, value){
			if( estatusExhorto == value ){
				tmpStatusAdjunto = true;
			}
		});
		if( tmpStatus == true ){
			$('#enviarExhorto').prop('checked',true);
			bloqueaFormulario( 'exhorto', true);
		}else{
			$('#eliminaExhortos').show().prop("disabled", false);
		}
		if( tmpStatusAdjunto == true ){
			//***Activar seccion de adjuntar archivos
		}
			$('#formulario-adjuntos').show();
		//muestra boton para impresion
		$('#imprimeExhorto').show();
		objetoImpresion = objeto;
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
	* Acción al presionar el boton de impresión
	*/
	$('#imprimeExhorto').on('click', function(){
		imprimeExhorto();
	});

	/**
	* Impresión del Exhorto cargado
	*/
	imprimeExhorto = function(){
		var obj = objetoImpresion;
		var requisitoria = ( obj.exhortoGenerado[0].requisitoria == 'N' ) ? 'NO' : 'SI';
		var nombre = '';
		var tablaImpresion = '<style> .tablaImpresion{ font-size: 10px;  } </style>';
		tablaImpresion += '<table class="tablaImpresion" style="width: 100%; margin-left: auto; margin-right: auto;border-spacing: 10px;">'
			+ '<tr><td><table class="tablaImpresion" style="width: 100%;"><tr>'
			+ '<td align="left" style="width: 115px;"><img src="../vistas/img/EscudoEstadoMexico.png" width="85" height="90"></td>'
			+ '<td align="left"><p><b>Gobierno del Estado de M&eacute;xico</b></p><p>Poder Judicial</p><p>Consejo de la Judicatura</p>'
			+ '</td><td align="right" style="width: 85px;"><img src="../vistas/img/EscudoPoderJudicial.png" width="85" height="90"></td>'
			+ '</tr></table></td></tr><tr><td><b>Comprobante de Exhorto Generado</b></td></tr><tr><td>'
			+ '<table class="tablaImpresion" style="width: 100%; border: 3px solid black; border-radius: 7px;"><tr><td align="right" style="width: 20%;"><b>N&uacute;mero de Exhorto:</b></td>'
			+ '<td style="width: 30%;">' + obj.numActuacion + ' / ' + obj.aniActuacion + '</td><td align="right" style="width: 20%;"><b>Fecha de Alta:</b></td>'
			+ '<td style="width: 30%;">' + obj.fechaRegistro + '</td></tr><tr><td align="right" style="width: 20%;"><b>N&uacute;mero de Expediente:</b></td>'
			+ '<td style="width: 30%;">' + obj.numeroExp + ' / ' + obj.anioExp + '</td><td align="right" style="width: 20%;"><b>Destino:</b></td>'
			+ '<td style="width: 30%;">' + obj.juzgadoDestino + '</td></tr><tr><td align="right" style="width: 20%;"><b>Expediente:</b></td><td style="width: 30%;">' + obj.cveTipo[0].desCarpeta + '</td>'
			+ '<td align="right" style="width: 20%;"><b>Procedencia:</b></td><td style="width: 30%;">' + $('#desAdscripcion').val() + '</td></tr></table>'
			+ '</td></tr><tr><td><table class="tablaImpresion" style="width: 100%; border: 1px solid black; border-radius: 7px;">'
			+ '<tr><td align="right" style="width: 20%;"><b>S&iacute;ntesis:</b></td><td style="width: 30%;">' + obj.sintesis + '</td>'
			+ '<td align="right" style="width: 20%;"><b>Estatus:</b></td><td style="width: 30%;">' + obj.exhortoGenerado[0].cveEstatusExhorto[0].desEstatusExhorto + '</td></tr>'
			+ '<tr><td align="right" style="width: 20%;"><b>Requisitoria:</b></td><td style="width: 30%;">' + requisitoria + '</td>'
			+ '<td style="width: 20%;">&nbsp;</td><td style="width: 30%;">&nbsp;</td></tr><tr><td align="right" style="width: 20%;"><b>Observaciones:</b></td>'
			+ '<td align="left" colspan="3" style="width: 80%;">' + obj.observaciones + '</td></tr></table></td></tr><tr><td>'
			+ '<table class="tablaImpresion" style="width: 100%; border: 1px solid black; border-radius: 7px;">';
/*			console.log('partes');
			console.log(obj.exhortoGenerado[0].partes);*/
		$.each(obj.exhortoGenerado[0].partes, function(index, value){
/*			console.log('objeto');
			console.log(value);
			console.log('tipo persona');
			console.log(value.cveTipoPersona[0].cveTipoPersona);*/
			nombre = ( value.cveTipoPersona[0].cveTipoPersona == 1 ) ? value.paterno+' '+value.materno+' '+value.nombre : value.nombrePersonaMoral ;
			tablaImpresion += '<tr><td align="right" style="width: 20%;"><b>Tipo de parte:</b></td><td style="width: 30%;">' + value.cveTipoParte[0].descTipoParte + '</td><td align="right" style="width: 20%;"><b>Tipo de persona:</b></td><td style="width: 30%;">' + value.cveTipoPersona[0].desTipoPersona + '</td></tr>'
				+ '<tr><td align="right" style="width: 20%;"><b>Nombre:</b></td><td colspan="3" style="width: 80%;">' + nombre + '</td></tr>'
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
	* Eliminación del Exhorto cargado
	*/
	$('#eliminaExhortos').on('click', function(){
		if( confirm('Se eliminará el Exhorto, ¿Continuar?') ){
			eliminaExhorto( $('#idActuacion').val() );
			reiniciaFormulario();
		}
	});

	eliminaExhorto = function( idActuacion ){
		var idActuacion = idActuacion || '0';
		if( idActuacion > 0 ){
			$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php',
				data:{ idActuacion:idActuacion,activo:'N',accion:'guardar'},
				success:function(response){
		            var object = eval("("+response+")");
		            var totalCount = object.totalCount;
		            if( object.totalCount > 0 ){
		            	muestraMensaje('EXHORTO ELIMINADO SATISFACTORIAMENTE.','information');
		            }
				}
			}); 
		}
	}

	buscarExhortos = function(){
		var b_cveTipoActuacion = $('#cveTipoActuacion').val();
		var b_cveEstadoDestino = ( $('#b_cveEstadoDestino').val() != 0 ) ? $('#b_cveEstadoDestino').val() : '';
		var b_numActuacion = $('#b_numActuacion').val();
		var b_aniActuacion = $('#b_aniActuacion').val();
		var b_cveTipo = $('#b_cveTipo').val();
		var b_carpetaInv = $('#b_carpetaInv').val();
		var b_NUC = $('#b_NUC').val();
		var cveJuzgado = globales.cveJuzgado;
		var b_cveConsignacion = ( $('#b_cveConsignacion').val() != 0 ) ? $('#b_cveConsignacion').val() : '';
		var b_fechaInicio = $('#b_fechaInicio').val();
		var b_fechaFin = $('#b_fechaFin').val();
		if( b_cveEstadoDestino != '' || b_numActuacion != '' || b_aniActuacion != '' || b_carpetaInv != '' || b_NUC != '' || b_cveConsignacion != '' ){
			b_fechaInicio = '';
			b_fechaFin = '';
		}
		//envío de variables para búsqueda
		$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php',
			data:{
				cveTipoActuacion:b_cveTipoActuacion,
				cveEstadoDestino:b_cveEstadoDestino,
				numActuacion:b_numActuacion,
				aniActuacion:b_aniActuacion,
				cveTipo:b_cveTipo,
				carpetaInv:b_carpetaInv,
				nuc:b_NUC,
				cveJuzgado:cveJuzgado,
				cveConsignacion:b_cveConsignacion,
				fechaInicio:b_fechaInicio,
				fechaFin:b_fechaFin,
				activo:'S',
				accion:'consultarExhortoGenerado'
			},
			success:function(response){
				//console.log(response);
				try{
	            	var object = eval("("+response+")");
	            	var data = object.data;
	            	var mensaje = '', tabla = '', statusExhorto = '', clase = '';
	            	if( object.status == 'OK' && object.totalCount > 0){
	            		tabla += '<table id="tblResultados" class="table table-hover table-striped table-bordered">'
	            		+ '<thead>'
	            		+ '<tr>'
	            		+ '<th>#</th>'
/*	            		+ '<th>Enviar</th>'*/
	            		+ '<th>Estatus</th>'
	            		+ '<th>Estado Destino</th>'
	            		+ '<th>Exhorto Generado</th>'
	            		+ '<th>Carpeta de Investigaci&oacute;n</th>'
	            		+ '<th>NUC</th>'
	            		+ '<th>Consignaci&oacute;n</th>'
	            		+ '<th>Fecha de Registro</th>'
	            		+ '</tr>'
	            		+ '</thead>'
	            		+ '<tbody>';
	            		$.each( data, function(index, value){
		            		tabla += "<tr>"
		            		+ "<td>" + (parseInt(index)+1) + "</td>"
/*		            		+ "<td>";
		            		if( value.exhortoGenerado[0].cveEstatusExhorto[0].cveEstatusExhorto == 6 || value.exhortoGenerado[0].cveEstatusExhorto[0].cveEstatusExhorto == 1 ){
		            			tabla += "&nbsp;";
		            		}else{
		            			tabla += "<input type='checkbox' class='checkEnvioExpress' id='" + value.idActuacion + "'/>";
		            		}*/
		            		//validacion del estado del exhorto
		            		statusExhorto = value.exhortoGenerado[0].cveEstatusExhorto[0].cveEstatusExhorto;
		            		if( statusExhorto == 1){ clase = 'status3'; }
		            		if( statusExhorto == 2 || statusExhorto == 3 || statusExhorto == 4){ clase = 'status4'; }
		            		if( statusExhorto == 5){ clase = 'status1'; }
		            		if( statusExhorto == 6){ clase = 'status2'; }
		            		tabla += "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'><span class='" + clase + "'>" + value.exhortoGenerado[0].cveEstatusExhorto[0].desEstatusExhorto + "</span></td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.exhortoGenerado[0].cveEstadoDestino[0].desEstado + "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.numActuacion + " / " + value.aniActuacion + "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.carpetaInv + "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.nuc + "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.cveConsignacion[0].desConsignacion + "</td>"
		            		+ "<td onclick='muestraExhorto(" + JSON.stringify(value) + ")'>" + value.fechaRegistro + "</td>"
		            		+ "</tr>";
	            		});
	            		tabla += '</tbody>'
	            		+ '</table>';
	            		$('#divTablaResultados').empty().append( tabla ).show();
						cambiaModulo('resultados');
						limpiaFormulario('consulta');
	            	}else{
	            		muestraMensaje('NO EXISTEN DATOS CON ESTOS PARAMETROS DE BUSQUEDA.','error');
	            	}
				} catch (e){
                    muestraMensaje('Existi&oacute; un problema al realizar la consulta.','error');
                }
			}
		});
	}

	$('#buscarExhortos').on('click',function(){
		buscarExhortos();
	});

	var titulos = {
		'titulo1':'Exhortos Generados',
		'titulo1a':'<a href="#" style="text-decoration:underline" onclick="cambiaModulo(\'captura\')">Exhortos Generados</a>',
		'titulo2':'B&uacute;squeda',
		'titulo2a':'<a href="#" style="text-decoration:underline" onclick="cambiaModulo(\'consulta\')">B&uacute;squeda</a>',
		'titulo3':'Resultados',
		'titulo3a':'<a href="#" style="text-decoration:underline" onclick="cambiaModulo(\'resultados\')">Resultados</a>'
	}
	/**
	 * Muestra/Oculta el div del formulario y la tabla de bUsqueda
	 * @param {int} opc Recibe un parametro para mostrar el DIV correspondiente
	 */
    function cambiaDiv(opcion) {
    	var opcion = opcion || 'captura';
        if (opcion === 'captura') {
            $("#seccionConsulta").hide("fade");
            $("#seccionResultados").hide("fade");
            $("#seccion_captura").show("slide");
            //cambia el titulo
            $('#exhortosGeneradosTitulo').empty().append(titulos['titulo1']);
            //limpia formulario de consulta
            limpiaFormulario('consulta');
        } else if (opcion === 'consulta') {
            $("#seccionResultados").hide("fade");
            $("#seccion_captura").hide("fade");
            $("#seccionConsulta").show("slide");
            $('#exhortosGeneradosTitulo').empty().append(titulos['titulo1a'] + ' > ' + titulos['titulo2']);
        } else if (opcion === 'resultados'){
            $("#seccionConsulta").hide("fade");
            $("#seccion_captura").hide("fade");
            $("#seccionResultados").show("slide");
            $('#exhortosGeneradosTitulo').empty().append(titulos['titulo1a'] + ' > ' + titulos['titulo2a'] + ' > ' + titulos['titulo3']);
        }
    }

	/**
	* FunciOn para el cambio de modulos entre el principal y el de bUsqueda
	* @param {integer} idModule Id del mOdulo. 1:principal, 2:bUsqueda
	*/
	function cambiaModulo(idModulo){
		//muestra el módulo de búsqueda
		cambiaDiv(idModulo);
        return;
	}

	/**
	 * Muestra mensajes personalizados en el div destinado para ello
	 * @param {string} message Es el mensaje que se mostrarA
	 * @param {string} type Es el tipo de mensaje. 1:success, 2:warning, 3:information, 4:error
	 * @param {string} divAux Es el postfijo para identificar un DIV alterno de notificaciOn
	 */
    function muestraMensaje(message,type,divAux){
    	var message = message || '';
    	var div_message = '';
    	var divAux = divAux || '';
    	var state = 0;
    	switch(type){
    		case 'success':
				div_message = 'divCorrecto';
    		break;
    		case 'warning':
				div_message = 'divAdvertencia';
				state = 1;
    		break;
    		case 'information':
				div_message = 'divInformacion';
    		break;
    		case 'error':
				div_message = 'divError';
    		break;
    	}
    	if(divAux != ''){
    		div_message += divAux;
	        if(type == 'success'){
	            $("#divInformacion" + divAux).hide();
	            //$("#" + div_message).hide();
	        }
	        if(type == 'information'){
	            $("#divCorrecto" + divAux).hide();
		        $('#' + div_message).html(message);
		        $('#' + div_message).show("slide");
	        }
    	}else{
	        $('#' + div_message).html(message);
	        $('#' + div_message).show("slide");
	    }
        setTimeout(function () {
            $("#" + div_message).hide("slide");
        }, 5000);
        return;
    }

	/**
	 * Funcion que devuelve true o false dependiendo de si la fecha es correcta.
	 * Tiene que recibir el dia, mes y año
	 */
	function isValidDate(day,month,year){
	    var dteDate;
	    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
	    //   siendo 0 el mes de enero
	    // Por esta razon, tenemos que restar 1 al mes
	    month=month-1;
	    // Establecemos un objeto Data con los valore recibidos
	    // Los parametros son: año, mes, dia, hora, minuto y segundos
	    // getDate(); devuelve el dia como un entero entre 1 y 31
	    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
	    //   martes, miercoles ...
	    // getHours(); Devuelve la hora
	    // getMinutes(); Devuelve los minutos
	    // getMonth(); devuelve el mes como un numero de 0 a 11
	    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
	    //   de enero de 1970 hasta el momento definido en el objeto date
	    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
	    // getYear(); devuelve el año
	    // getFullYear(); devuelve el año
	    dteDate=new Date(year,month,day);
	    //Devuelva true o false...
	    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
	}

	/**
	 * Funcion para validar una fecha
	 * Tiene que recibir:
	 *  La fecha en formato ingles yyyy-mm-dd
	 * Devuelve:
	 *  true-Fecha correcta
	 *  false-Fecha Incorrecta
	 */
	function validate_fecha(fecha){
	    //var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
	    var patron=new RegExp("^([0-9]{1,2})([/])([0-9]{1,2})([/])(19|20)+([0-9]{2})$");
	    if(fecha.search(patron)==0){
	        var values=fecha.split("/");
	        if(isValidDate(values[2],values[1],values[0])){
	            return true;
	        }
	    }
	    return false;
	}

	/**
	 * Esta función calcula la edad de una persona y los meses
	 * La fecha la tiene que tener el formato yyyy-mm-dd que es
	 * metodo que por defecto lo devuelve el <input type="date">
	 */
	$('#fechaNacimiento').on('blur', function(){
		calcularEdad();
	});

	calcularEdad = function() {
	    var fecha=$('#fechaNacimiento').val();
	    fecha = fecha.split('/');
	    var birthDate = new Date( fecha[2] + '-' + fecha[1] + '-' + fecha[0] );
	    var now = new Date();
		function isLeap(year) {
			return year % 4 == 0 && (year % 100 != 0 || year % 400 == 0);
		}
		// days since the birthdate    
		var days = Math.floor((now.getTime() - birthDate.getTime())/1000/60/60/24);
		var age = 0;
		// iterate the years
		for (var y = birthDate.getFullYear(); y <= now.getFullYear(); y++){
			var daysInYear = isLeap(y) ? 366 : 365;
			if (days >= daysInYear){
				days -= daysInYear;
				age++;
				// increment the age only if there are available enough days for the year.
			}
		}
	    $('#edad').val(age);
	    $('#txtEdad').empty().append( age + ' a&ntilde;os' );	
	}

    /**
    * FunciOn para la obtenciOn de informacion de tablas y llenado de combos
    * @param {array} selectIds Ids de los combos donde se mostraran los datos
    * @param {string} facade Es la ruta de la fachada que se invoca, solo se define la carpeta y el nombre del archivo sin la extensiOn Class en adelante. Ej. tiposcarpetas/TiposcarpetasFacade
    * @param {string} value Es el identificador del campo llave
    * @param {string} descripction Es el identificador del campo de descripciOn
    */
	fillCombo = function(selectIds,facade,value,description,selected,mensaje){
		var selected = selected || '';
		var mensaje = mensaje || '**NO DEFINIDO**'
		$.each(selectIds,function(k,v){
			$('#' + v).empty();
		});
		$.post('../fachadas/exhortos/' + facade + '.Class.php',
			{ activo:'S', accion:'consultar' },
			function(response){
	            var object = eval("("+response+")");
				var options = '';
				var selectedOption = '';
				if(object.totalCount > 0){
					options = '<option value="0">--SELECCIONE--</option>';
					$.each(object.data,function(k,v){
						selectedOption = ( v[value]==selected ) ? " selected" : "";
						options += '<option value="' + v[value] + '" ' + selectedOption + '>' + v[description] + '</option>'; 
					});
				}else{
					options = '<option value="0">--SIN REGISTROS--</option>';
					alert('No existen registros para: ' + mensaje);
				}
				$.each(selectIds, function(k,v){
					$('#' + v).append(options);						
				});
			});
		return null;
	}

	/**
	 * Valida que antes de guardar o actualizar, todos los campos contegan informaciOn
	 * @param {array} array Es el arraglo de campos a validar
	 * @return {boolean} estado Regresa 'true' si todos los campos contienen informaciOn
	 */
	validaCampos = function(array){
		var estado = true;
		var faltantes = [];
		var counter = 0;
		$.each(array, function(k,v){
			if(v.value == '' || v.value == 0 || v.value == null){
				estado = false;
				faltantes[counter++] = v.name;
				return;
			}
		});
		if(!estado){
			estado = faltantes;
		}
		return estado;
	}

	/**
	** Función para traer de vuelta la informacion de un registro almacenado temporalmente y poder modififcarlo
	*/
	actualizaParte = function(idRegistro){
		idRegistro = parseInt(idRegistro)-1;
		if( idRegistro >= 0 ){
			//limpiar formularios
			limpiaFormulario('fisica');
			limpiaFormulario('moral');
			limpiaFormulario('partes');
			//obtener los datos del registro
			var registro = partes.data[idRegistro];
			//muestra datos generales
			$('#idParte').val(idRegistro);
			$('#cveTipoParte').val(registro.cveTipoParte);
			$('#cveTipoPersona').val(registro.cveTipoPersona);
			if(registro.cveTipoPersona == persona.fisica){
				$('#nombre').val(registro.nombre);
				$('#paterno').val(registro.paterno);
				$('#materno').val(registro.materno);
				$('#fechaNacimiento').val(registro.fechaNacimiento);
				$('#edad').val(registro.edad);
				$('#txtEdad').empty().append(registro.edad + ' a&ntilde;os');
				$('#cveGenero').val(registro.cveGenero);
				$('#RFC').val(registro.RFC);
				$('#CURP').val(registro.CURP);
				$('#telefono').val(registro.telefono);
				$('#email').val(registro.email);
				$('#cveEstado').val(registro.cveEstado);
				$('#cveMunicipio').val(registro.cveMunicipio); //pendiente
				$('#domicilio').val(registro.domicilio);
				$('#detenido').val(registro.detenido);
				//muestra formulario
				verFormulariosPartes(1,0);				
			}else if( registro.cveTipoPersona == persona.moral || registro.cveTipoPersona == persona.otra ){
				$('#nombreMoral').val(registro.nombrePersonaMoral);
				$('#rfcMoral').val(registro.RFC);
				$('#telefonoMoral').val(registro.telefono);
				$('#emailMoral').val(registro.email);
				$('#cveEstadoMoral').val(registro.cveEstado);
				$('#cveMunicipioMoral').val(registro.cveMunicipio); //pendiente
				$('#domicilioMoral').val(registro.domicilio);
				$('#detenidoMoral').val(registro.detenido);
				//muestra formulario
				verFormulariosPartes(0,1);
			}
			//etiqueta de botones
			$('#agregarParte').html('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Actualizar Parte');
		}else{
			alert('Registro no valido.');
		}
	}

	/**
	* Función para eliminar un registro de la tabla de 'partes'
	*/
	eliminarParte = function(idRegistro){
		if(confirm('¿Realmente desea eliminar el registro?')){
			//identifica el registro
			idRegistro = parseInt(idRegistro)-1;
			//elimina el elemento del objeto
	        partes.data.splice(idRegistro, 1);
	        //reduce el contador de elementos
	        partes.counter--;
	        //muestra tabla de 'partes'
        	llenaTablaPartes();
	    }
        return null;
	}

	/**
	* Función para definir la consignación general del exhorto
	*/
	defineConsignacion = function(){
		var detenido = { si:0, no:0, otro:0 };
		var consignacion = null;
		//obtencion del estado 'detenido' de todos los registros
		$.each(partes.data , function(index, value){
			if( value.detenido == 0 ){ //no seleccionado
				detenido.otro++;
			}else if( value.detenido == 1 ){ //detenido
				detenido.si++;
			}else if( value.detenido == 2 ){ //no detenido
				detenido.no++;
			}
		});
		var totalRegistros = partes.data.length;
		if(detenido.si == totalRegistros){
			consignacion = 1;
		}else if(detenido.no == totalRegistros){
			consignacion = 2;
		}else if(detenido.otro == totalRegistros){
			consignacion = 4;
		}else{
			consignacion = 3;
		}
		if( $('#cveMateria').val() != globales.materiaPenal ){ //validacion de materia no penal
			//asigna valor por defecto como 'no aplica'
			consignacion = 4;
		}else{
			//consignacion = null;
			//$('#inputConsignacionExhorto').empty().html('');
		}
		//determinacion de la consignación del exhorto
		$('#cveConsignacion').val(consignacion);
		$('#inputConsignacionExhorto').empty().append( $('#cveConsignacion option:selected').text() );
		return null;
	}

	/**
	* Función para llenar la tabla de partes, si existen partes agregadas bloquea el combo de tipo materia
	* Si no exiten partes, desbloquea el combo de materia
	*/
	llenaTablaPartes = function( arreglo ){
		var arreglo = arreglo || partes.data;
		var tabla = '', nombreParte = '', consecutivo = 0;
		if( partes.data.length == 0 ){
			//los datos vienen de la consulta, se copia el valor del array a partes.data
			partes.data = arreglo;
		}
		$('#tablaPartes tbody').empty();
		if(arreglo.length > 0){
			//bloquea el cambio de materia
			//$('#cveMateria').prop('disabled',true);
			//ordena por tipo de parte
			var dataTmp = arreglo;
			var sortTmp = dataTmp.sort(function(a,b){
			   return a.cveTipoParte - b.cveTipoParte;
			});
			//define la consignacion del exhorto
			defineConsignacion();
			$.each(arreglo, function(index,value){
				consecutivo = parseInt(index)+1;
				//validacion de persona
				nombreParte = (value.cveTipoPersona == persona.fisica) ? value.paterno + ' ' + value.materno + ' ' + value.nombre : value.nombrePersonaMoral ;
				tabla += '<tr>'
				+ '<td>' + consecutivo + '</td>'
				+ '<td>' + value.descTipoParte + '</td>'
				+ '<td>' + value.desTipoPersona + '</td>'
				+ '<td>' + nombreParte + '</td>'
				+ '<td>'
				+ '<button type="button" class="btn btn-info btn-partes" aria-label="Left Align" onclick="actualizaParte(' + consecutivo + ')">'
				+ '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> &nbsp;&nbsp;&nbsp;'
				+ '<button type="button" class="btn btn-danger btn-partes" aria-label="Left Align" onclick="eliminarParte(' + consecutivo + ')">'
				+ '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>'
				+ '</td>'
				+ '</tr>';
			});
			$('#tablaPartes tbody').append(tabla);
		}else{
			//debloquea el cambio de materia
			$('#cveMateria').prop('disabled',false);
		}
		return null;		
	}

	/**
	* Función para la obtencion de juicios
	*/
	juiciosMateria = function(idMateria){
		var idMateria = idMateria || 1; //por default Estado de Mexico
		var options = '';
		$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/juicios/JuiciosFacade.Class.php',
			data:{ cveMateria:idMateria,activo:'S',accion:'consultar'},
			success:function(response){
	            var object = eval("("+response+")");
	            var data = object.data;
				if(object.totalCount > 0){
					options = '<option value="0">--SELECCIONE--</option>';
					$.each(data,function(k,v){
						options += '<option value="' + v.cveJuicio + '">' + v.desJuicioDelito + '</option>'; 
					});
				}else{
					options = '<option value="0">--SELECCIONE MATERIA--</option>';
				}
			}
		}); 
		return options;
	}

	/**
	* Función para la obtencion de municipios
	*/
	municipiosEstado = function(idEstado){
		var idEstado = idEstado || 15; //por default Estado de Mexico
		var options = '';
		$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/municipios/MunicipiosFacade.Class.php',
			data:{ cveEstado:idEstado,activo:'S',accion:'consultar'},
			success:function(response){
	            var object = eval("("+response+")");
	            var data = object.data;
				if(object.totalCount > 0){
					options = '<option value="0">--SELECCIONE--</option>';
					$.each(data,function(k,v){
						options += '<option value="' + v.cveMunicipio + '">' + v.desMunicipio + '</option>'; 
					});
				}else{
					options = '<option value="0">--SELECCIONE ESTADO--</option>';
				}
			}
		}); 
		return options;
	}

	/**
	* Accion al dar click en 'agregar' una 'parte'
	*/
	$('#agregarParte').on('click', function(e){
		e.preventDefault();
		var tmpPartes = {
			data:[],
			counter:0
		};		
		var idParte = $('#idParte').val();
		var cveTipoParte = $('#cveTipoParte option:selected').val();
		var descTipoParte = $('#cveTipoParte option:selected').text();
		var cveTipoPersona = $('#cveTipoPersona option:selected').val();
		var desTipoPersona = $('#cveTipoPersona option:selected').text();
		//datos persona fisica
		var nombre = $('#nombre').val();
		var paterno = $('#paterno').val();
		var materno = $('#materno').val();
		//var fechaNacimiento = ( $('#fechaNacimiento').val() != '' ) ? $('#fechaNacimiento').val() : '00/00/0000' ;
		var fechaNacimiento = $('#fechaNacimiento').val();
		var edad = $('#edad').val();
		var cveGenero = $('#cveGenero option:selected').val();
		var RFC = $('#RFC').val();
		var CURP = $('#CURP').val();
		var telefono = $('#telefono').val();
		var email = $('#email').val();
		var cveEstado = $('#cveEstado option:selected').val();
		var cveMunicipio = $('#cveMunicipio option:selected').val();
		var domicilio = $('#domicilio').val();
		var detenido = $('#detenido option:selected').val();
		//datos persona moral
		var nombreMoral = $('#nombreMoral').val();
		var rfcMoral = $('#rfcMoral').val();
		var telefonoMoral = $('#telefonoMoral').val();
		var emailMoral = $('#emailMoral').val();
		var cveEstadoMoral = $('#cveEstadoMoral option:selected').val();
		var cveMunicipioMoral = $('#cveMunicipioMoral option:selected').val();
		var domicilioMoral = $('#domicilioMoral').val();
		var detenidoMoral = $('#detenidoMoral option:selected').val();
		//variables de control
		var camposNecesarios = '';
		var camposFaltantes = '';
		var estadoCampos = false;
		var datosPartes = [], contador = 0;
		if( cveTipoParte != '' && cveTipoParte != 0 ){ //validacion de seleccion del tipo de parte
			if( cveTipoPersona != '' && cveTipoPersona != 0 ){ //validacion de seleccion de tipo de persona
		        //elimina el elemento con los datos previos
		        if(idParte != ''){
	                partes.data.splice(idParte, 1);
	                partes.counter--;
/*	                tmpPartes.data.splice(idParte, 1);
	                tmpPartes.counter--;*/
					//limpia idParte
					$('#idParte').val('');
            	}
				//validacion de tipo de persona
				if( cveTipoPersona == 1 ){ //persona fisica
					//validacion de campos persona fisica
					camposNecesarios = [
						{name:'Nombre',value:nombre},
						{name:' Apellido Paterno',value:paterno},
						{name:' Apellido Materno',value:materno},
						{name:' G&eacute;nero',value:cveGenero}
					];
				}else if( cveTipoPersona == 2 || cveTipoPersona == 3 ){ //persona moral u otra
					camposNecesarios = [
						{name:'Nombre',value:nombreMoral}
					];
				}
				estadoCampos = validaCampos(camposNecesarios);
				if( estadoCampos == true ){
					if(cveTipoPersona == 1){
						partes.data[partes.counter] = {
/*						tmpPartes.data[tmpPartes.counter] = {*/
							//idParte:partes.counter,
							cveTipoParte:cveTipoParte,
							descTipoParte:descTipoParte,
							cveTipoPersona:cveTipoPersona,
							desTipoPersona:desTipoPersona,
							nombre:nombre,
							paterno:paterno,
							materno:materno,
							fechaNacimiento:fechaNacimiento,
							edad:edad,
							cveGenero:cveGenero,
							RFC:RFC,
							CURP:CURP,
							telefono:telefono,
							email:email,
							cveEstado:cveEstado,
							cveMunicipio:cveMunicipio,
							domicilio:domicilio,
							detenido:detenido
						};
						//contador++;
						partes.counter++;
/*						tmpPartes.counter++;*/
					}else if(cveTipoPersona == 2 || cveTipoPersona == 3){
						//datosPartes[contador] = {
						partes.data[partes.counter] = {
/*						tmpPartes.data[tmpPartes.counter] = {*/
							//idParte:partes.counter,
							cveTipoParte:cveTipoParte,
							descTipoParte:descTipoParte,
							cveTipoPersona:cveTipoPersona,
							desTipoPersona:desTipoPersona,
							nombrePersonaMoral:nombreMoral,
							cveGenero:3,
							RFC:rfcMoral,
							telefono:telefonoMoral,
							email:emailMoral,
							cveEstado:cveEstadoMoral,
							cveMunicipio:cveMunicipioMoral,
							domicilio:domicilioMoral,
							detenido:detenidoMoral
						};
						partes.counter++;
/*						tmpPartes.counter++;*/
						//contador++;
					}
					//llena tabla de 'partes'
					llenaTablaPartes();
					//limpia campos
					limpiaFormulario('fisica');
					limpiaFormulario('moral');
					limpiaFormulario('partes');
					//oculta div
					verFormulariosPartes(0,0);
					//etiqueta de botones
					$('#agregarParte').html('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Agregar Parte');
				}else{
					$.each(estadoCampos, function(index,value){
						camposFaltantes += '&nbsp;- ' + value + '<br/>';
					});
					muestraMensaje('Necesita definir la información de: <br/>' + camposFaltantes,'warning');
				}
			}else{
				muestraMensaje('Selecciona el Tipo de Persona','warning');
			}
		}else{
			muestraMensaje('Seleccione el Tipo de Parte','warning');
		}
	}); 

	/**
	* Accion al cambiar el combo de Estado. Obtencion de municipios conforme a la clave del estado
	*/
	$('#cveEstado, #cveEstadoMoral').on('change', function(){
		$('#cveMunicipio, #cveMunicipioMoral').empty().append( municipiosEstado( $(this).find('option:selected').val() ) );
	});

	/**
	* Función para mostrar/ocultar los formularios del tipo de personas
	*/
	verFormulariosPartes = function(verFisica,verMoral){
		if( verFisica == 1 ) $('#divPersonaFisica').show(); else $('#divPersonaFisica').hide();
		if( verMoral == 1 ) $('#divPersonaMoral').show(); else $('#divPersonaMoral').hide();
		if( verFisica == 1 || verMoral == 1 ) $('#botonesPersonas').show(); else $('#botonesPersonas').hide();
		return null;
	}

	/**
	* Función para limpiar los formularios
	* 'exhorto', 'fisica', 'moral', 'partes'
	*/
	limpiaFormulario = function(idFormulario){
		var idFormulario = idFormulario || 'exhorto';
		var limpiezaGlobal = 0;
		if( idFormulario == 'exhorto' ){
			$('#numActuacion').val('');
			$('#aniActuacion').val('');
			$('#cveEstadoDestino').val(0);
			$('#cveOficialia').empty().append('<option value="0">--SELECCIONE UN ESTADO--</option>').val(0);
			//$('#cveTipoActuacion').val(0);
			$('#numeroExp').val('');
			$('#anioExp').val('');
			$('#numOficio').val('');
			$('#anioOficio').val('');
			$('#cveTipo').val(0);
			$('#carpetaInv').val('');
			$('#nuc').val('');
			$('#cveMateria').val(0);
			$('#cveJuicio').val(0);
			$('#otroJuicio').val('').hide();
			$('#cveCuantia').val(0);
			$('#noFojas').val('');
			$('#sintesis').val('');
			$('#observaciones').val('');
			$('#inputConsignacionExhorto').empty().html('');
			$('#idActuacion').val('');
			$('#enviarExhorto').prop('checked', false);
			$('#divStatusExhorto').empty().html('POR ENVIAR');
			$('#divNoAnioExhorto').empty().html('----/----');
			$('#divJuzgadoAsignado').empty().html('--------');
			$('#formulario-adjuntos').hide();
			$('#uploadfiles').val('');
			$('#tbody-adjuntos').empty();
			$('#totalAdjuntos').val('0');
			$('#progress-bar-filesSize').width('0%').empty().append('0%');
			filesSizeAttached = 0;
			limpiezaGlobal = 1;
		}
		if( idFormulario == 'partes' || limpiezaGlobal ==1 ){
			$('#cveTipoParte').val(0);
			$('#cveTipoPersona').val(0);
		}
		if( idFormulario == 'fisica' || limpiezaGlobal ==1 ){
			$('#nombre').val('');
			$('#paterno').val('');
			$('#materno').val('');
			$('#fechaNacimiento').val('');
			$('#edad').val('');
			$('#txtEdad').empty();
			$('#cveGenero').val(0);
			$('#RFC').val('');
			$('#CURP').val('');
			$('#telefono').val('');
			$('#email').val('');
			$('#cveEstado').val(0);
			$('#cveMunicipio').empty().append('<option value="0">--SELECCIONE UN ESTADO--</option>').val(0);
			$('#domicilio').val('');
			if( $('#cveMateria').val() == globales.materiaPenal )
				$('#detenido').val(0);
		}
		if( idFormulario == 'moral' || limpiezaGlobal == 1 ){
			$('#nombreMoral').val('');
			$('#rfcMoral').val('');
			$('#telefonoMoral').val('');
			$('#emailMoral').val('');
			$('#cveEstadoMoral').val(0);
			$('#cveMunicipioMoral').empty().append('<option value="0">--SELECCIONE UN ESTADO--</option>').val(0);
			$('#domicilioMoral').val('');
			if( $('#cveMateria').val() == globales.materiaPenal )
				$('#detenidoMoral').val(0);
		}
		if( idFormulario == 'consulta' ){
			$('#b_cveEstadoDestino').val(0);
			$('#b_numActuacion').val('');
			$('#b_aniActuacion').val('');
			$('#b_carpetaInv').val('');
			$('#b_NUC').val('');
			$('#b_cveConsignacion').val(0);
			$('#b_fechaInicio').val( $('#fechaHoy').val() );
			$('#b_fechaFin').val( $('#fechaHoy').val() );
		}
		//limpia el valor de idParte en caso de provenir de una actualizacion de registro
		$('#idParte').val('');
		//reinicia la etiqueta de botones
		$('#agregarParte').html('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Agregar Parte');
		return null;
	}

	/**
	* Función para la obtención de Oficialias a través del ID del Estado
	*/
	obtieneOficialias = function( idEstado ){
		var options = '';
		if( idEstado != 0 ){
			$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php',
				data:{ cveEstadoDestino:idEstado,accion:'obtenerOficialias'},
				success:function(response){
		            var object = eval("("+response+")");
					if(object.estatus == 'ok'){
		            	var data = object.oficialias;
						options = '<option value="0">--SELECCIONE--</option>';
						$.each(data,function(k,v){
							options += '<option value="' + v.cveOficialia + '">' + v.desOficialia + '</option>'; 
						});
					}else{
						options = '<option value="0">--' + object.mensaje + '--</option>';
					}
				}
			}); 
		}else{
			options = '<option value="0">--SELECCIONE UN ESTADO DESTINO--</option>';
		}
		return options;
	}

	/**
	* Accion al cambiar la seleccion del combo 'estado destino'
	*/
	$('#cveEstadoDestino').on('change', function(){
		//obtencion de las oficialias
		$('#cveOficialia').empty().append( obtieneOficialias( $(this).find('option:selected').val() ) );
	});

	/**
	* Accion al cambiar el tipo de 'parte'
	* Al cambiar reinicia el combo de tipo personas, oculta y limpia los formularios
	* Actor, quejoso, tercero perjudicado, autoridad federal
	*/
	$('#cveTipoParte').on('change', function(){
		var opcionParte = $(this).find('option:selected').val();
		if( opcionParte == 0 ){
			$('#cveTipoPersona').val(0);
			verFormulariosPartes(0,0);
			limpiaFormulario('fisica');
			limpiaFormulario('moral');
		}
		//limpia estados y municipios que pudieron heredarse de tipos parte globales
		$('#cveEstado, #cveEstadoMoral').val(0);
		$('#cveMunicipio, #cveMunicipioMoral').empty().append('<option value="0">--SELECCIONE UN ESTADO--</option>').val(0);
	});

	$('#cancelaParte').on('click', function(e){
		e.preventDefault();
		limpiaFormulario('partes');
		limpiaFormulario('fisica');
		limpiaFormulario('moral');
		verFormulariosPartes(0,0);
	});

	/**
	* Limpia los formularios de las 'partes'
	*/
	$('#limpiarParte').on('click', function(e){
		e.preventDefault();
		limpiaFormulario('fisica');
		limpiaFormulario('moral');
	});

	/**
	* Acción al cambiar la seleccion del combo tipo persona, muestra el formulario correspondiente
	*/
	$('#cveTipoPersona').on('change', function(){
		var opcionParte = $('#cveTipoParte option:selected').val();
		var opcionPersona = 0;
		var generoOtro = 3; //corresponde al mismo ID de la base de datos
		if( opcionParte != 0 ){
			opcionPersona = $(this).find('option:selected').val();
			if( opcionPersona == persona.fisica ){
				verFormulariosPartes(1,0);
				$('#cveGenero').val(0);
			}else if( opcionPersona == persona.moral){
				verFormulariosPartes(0,1);
				$("#legendPersonaMoral").empty().html('Persona Moral');
				$('#cveGenero').val(generoOtro);
			}else if( opcionPersona == persona.otra ){
				verFormulariosPartes(0,1);
				$("#legendPersonaMoral").empty().html('Otra');
				$('#cveGenero').val(generoOtro);
			}else if( opcionPersona == 0){
				verFormulariosPartes(0,0);
			}
			//limpia los formularios
			limpiaFormulario('fisica');
			limpiaFormulario('moral');
		}else{
			$(this).val(0);
			muestraMensaje('Debe seleccionar un Tipo de Parte','warning');
		}
	});

	/**
	* Acción para limpiar el formulario completo
	*/
	$('#limpiaExhortos').on('click', function(){
		reiniciaFormulario();
	});

	/**
	* Reinicia el formulario completo
	*/
	reiniciaFormulario = function(){
		limpiaFormulario('exhorto');
		bloqueaFormulario('exhorto',false);
		partes.data = [];
		partes.counter = 0;
		llenaTablaPartes();
		verFormulariosPartes(0,0);
		$('#guardaExhortos').html('<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;Guardar').prop('disabled',false);
		$('#eliminaExhortos').hide();
		$('#imprimeExhorto').hide();
	}

	/**
	* Funcion que se ejecuta al definirse una materia
	*/
	herenciaMateria = function( opcion, consulta ){
		var consulta = consulta || '';
		if( opcion == globales.materiaPenal ){
			//el tipo de parte tiene que ser 'imputado'
			//se muestra unicamente tal opción en el combo partes
			// * ocultar todos los elementos del combo y muestra solo la de imputado
			$('#cveTipoParte option').hide();
			$('#cveTipoParte option[value=\'' + globales.parteImputado + '\']').show();
			$('#cveTipoParte option[value=\'' + globales.parteOfendido + '\']').show();
			if( consulta == '' ){
				//el combo 'detenido' reinicia a 0
				$('#detenido, #detenidoMoral').val(0).show();
				$('#labelDetenido, #labelDetenidoMoral').show();
				//los campos de 'carpeta de investigacion' y 'nuc' se habilitarán
				$('#carpetaInv, #nuc').prop('disabled',false);
			}
		}else{
			//en caso de ser otro tipo de materia
			//se oculta la opcion 'imputado' de las 'partes'
			$('#cveTipoParte option').show();
			$('#cveTipoParte option[value=\'' + globales.parteImputado + '\']').hide();
			$('#cveTipoParte option[value=\'' + globales.parteOfendido + '\']').hide();
			if( consulta == '' ){
				//el combo 'detenido' se autoselecciona en 'No' y se oculta la etiqueta y el combo
				$('#detenido, #detenidoMoral').val(2).hide();
				$('#labelDetenido, #labelDetenidoMoral').hide();
				//los campos de 'carpeta de investigacion' y 'nuc' se deshabilitarán
				$('#carpetaInv, #nuc').val('').prop('disabled',true);
				defineConsignacion();
			}
		}
		if( opcion != 0 ){ //valida que exista una seleccion distinta a la de defecto
			$('#cveTipoParte, #cveTipoPersona').prop('disabled',false);
		}else{
			$('#cveTipoParte, #cveTipoPersona').prop('disabled',true);
		}
		if( consulta == '' ){
			//actualiza combo de juicios
			$('#cveJuicio').empty().append( juiciosMateria( opcion ) ).append('<option value="9999">OTRO JUICIO</option>');
		}
	}

	/**
	* Acción al cambiar el tipo de materia
	* Limpia los formularios de las partes, dependiendo del tipo de materia muestra opciones para detencion
	* Actualiza el tipo de juicio y si es 'penal' habilita los campos de 'carpeta de investigacion' y 'nuc'
	*/
	$('#cveMateria').on('change', function(){
		var opcion = $(this).find('option:selected').val();
		limpiaFormulario('partes');
		limpiaFormulario('fisica');
		limpiaFormulario('moral');
		verFormulariosPartes(0,0);
		herenciaMateria(opcion);
		//oculta campos de juicio manual
		$('#otroJuicio').val('').hide();
	});

	/**
	* Función para mostrar u ocultar el combo de 'Otro Juicio'
	*/
	muestraOtroJuicio = function( opcion ){
		//if( opcion == juicioManual[0] || opcion == juicioManual[1] || opcion == juicioManual[2] || opcion == juicioManual[3] ){
		if( opcion == juicioManual[0]){
			$('#otroJuicio').val('').show(); //, #b_otroJuicio
		}else{
			$('#otroJuicio').val('').hide(); //, #b_otroJuicio
		}
		return null;
	}

	$('#cveJuicio').on('change',function(){ //, #b_cveJuicio
		muestraOtroJuicio( $(this).find('option:selected').val() );
	});

	/**
	* Accion al presionar guardar exhorto
	*/
	$('#guardaExhortos').on('click', function(e){		
		e.preventDefault();
		//campos del exhorto
		var idActuacion = $('#idActuacion').val();
		var numActuacion = $('#numActuacion').val();
		var aniActuacion = $('#aniActuacion').val();
		var cveEstadoDestino = $('#cveEstadoDestino option:selected').val();
		var cveOficialia = $('#cveOficialia').val();
		var cveTipoActuacion = $('#cveTipoActuacion option:selected').val();
		var numeroExp = $('#numeroExp').val();
		var anioExp = $('#anioExp').val();
		var numOficio = $('#numOficio').val();
		var anioOficio = $('#anioOficio').val();
		var cveTipo = $('#cveTipo option:selected').val();
		var carpetaInv = $('#carpetaInv').val();
		var nuc = $('#nuc').val();
		var cveMateria = $('#cveMateria option:selected').val();
		var cveJuicio = $('#cveJuicio option:selected').val();
		var desJuicio = $('#cveJuicio option:selected').text();
		var otroJuicio = $('#otroJuicio').val();
		var cveCuantia = $('#cveCuantia option:selected').val();
		var noFojas = $('#noFojas').val();
		var sintesis = $('#sintesis').val();
		var observaciones = $('#observaciones').val();
		var cveConsignacion = $('#cveConsignacion option:selected').val();
		var checkEnvio = $('#enviarExhorto').prop('checked');
		var totalPartes = partes.data.length;
		//variables de control
		var banderaPartes = banderaCamposExhorto = false;
		var camposFaltantes = '';
		var accion = '', mensaje = '';
		var juicioEstado = false;
		var estadoJuicioManual = false;
		var enviarExhorto = false;
		var banderaAdjuntos =  false;

		//validacion de accion
		if( idActuacion == '' ){ //insercion
			accion = 'guardarExhortoGenerado';
			mensaje = 'NO SE GUARD&Oacute; EL EXHORTO. INTENTE NUEVAMENTE.';
			mensajeWS = 'EXISTI&Oacute; UN PROBLEMA AL ENVIAR EL EXHORTO. INTENTE M&Aacute;S TARDE.';
			banderaAdjuntos = true;
		}else if( idActuacion != '' ){ //actualizacion
			accion = 'actualizarExhortoGenerado';
			mensaje = 'NO SE ACTUALIZ&Oacute; EL EXHORTO. INTENTE NUEVAMENTE.';
			mensajeWS = 'EXISTI&Oacute; UN PROBLEMA AL ENVIAR EL EXHORTO. INTENTE M&Aacute;S TARDE.';
			//validación de archivos adjuntos
			if( $('#totalAdjuntos').val() > 0 && obtenerCantidadArchivos() > 0 ){
				banderaAdjuntos = true; 
			}else{
				if( $('#totalAdjuntos').val() == 0 && obtenerCantidadArchivos() > 0 ){
					muestraMensaje('El o los archivos adjuntos estan vac&iacute;os, elim&iacute;nelos y adjunte archivos v&aacute;lidos.','warning');
				}
				if( $('#totalAdjuntos').val() > 0 && obtenerCantidadArchivos() == 0 ){
					muestraMensaje('Exis&eacute; un error en el o los archivos adjuntos. Recargue el módulo e intente nuevamente.','warning');
				}
				if( $('#totalAdjuntos').val() == 0 && obtenerCantidadArchivos() == 0 ){
					muestraMensaje('Debe adjuntar al menos un archivo.','warning');
				}
			}

		}
		//validacion del exhorto
		camposNecesariosExhorto = [
			{name:'Estado',value:cveEstadoDestino},
			{name:'Oficialia',value:cveOficialia},
			{name:'Tipo de Actuación',value:cveTipoActuacion},
			{name:'Número de Expediente',value:numeroExp},
			{name:'Año de Expediente',value:anioExp},
			{name:'Número de Oficio',value:numOficio},
			{name:'Año de Oficio',value:anioOficio},
			{name:'Tipo de Carpeta',value:cveTipo},
			{name:'Materia',value:cveMateria},
			{name:'Juicio',value:cveJuicio},
			{name:'Cuantía',value:cveCuantia},
			{name:'No. de Fojas',value:noFojas},
			{name:'Síntesis',value:sintesis}
		];
		estadoCamposExhorto = validaCampos(camposNecesariosExhorto);
		//validacion de juicio
		$.each( juicioManual, function(index, value){
			if( cveJuicio == value ){
				juicioEstado = true;
			}
		});
		if( juicioEstado == true ){ //validacion de juicio manual
			if( $('#otroJuicio').val() != '' ){
				estadoJuicioManual = true;
			}else{
				muestraMensaje('Debe especificar un Juicio de forma manual.','warning');
			}
		}else{
			estadoJuicioManual = true;			
		}
		//validacion de al menos una 'parte' agregada
		if( totalPartes > 0 ){
			banderaPartes = true;
		}else{
			muestraMensaje('Debe agregar al menos una Parte.','warning');
		}
		if( estadoCamposExhorto == true ){
			banderaCamposExhorto = true;
			numOficio = numOficio + '/' + anioOficio;
		}else{
			$.each(estadoCamposExhorto, function(index,value){
				camposFaltantes += '&nbsp;- ' + value + '<br/>';
			});
			muestraMensaje('Necesita definir la información de: <br/>' + camposFaltantes,'warning');
		}
		if( checkEnvio == true ){
			if( confirm('¿Realmente desea enviar el Exhorto Generado?') ){
				enviarExhorto = true;
			}else{
				$('#enviarExhorto').prop('checked',false);
			}
		}

		if( banderaCamposExhorto == true && estadoJuicioManual == true && banderaPartes == true && banderaAdjuntos == true){
			//envía los datos a la fachada
			$.ajax({ type:'POST',async:false,url:'../fachadas/exhortos/actuaciones/ActuacionesFacade.Class.php',
				data:{
					idActuacion:idActuacion,
					numActuacion:numActuacion,
					aniActuacion:aniActuacion,
					cveTipoActuacion:cveTipoActuacion,
					numeroExp:numeroExp,
					anioExp:anioExp,
					numOficio:numOficio,
					cveTipo:cveTipo,
					carpetaInv:carpetaInv,
					nuc:nuc,
					cveMateria:cveMateria,
					cveJuicio:cveJuicio,
					desJuicio:desJuicio,
					otroJuicio:otroJuicio,
					cveCuantia:cveCuantia,
					noFojas:noFojas,
					sintesis:sintesis,
					observaciones:observaciones,
					cveConsignacion:cveConsignacion,
					cveEstadoDestino:cveEstadoDestino,
					cveOficialia:cveOficialia,
					partes:partes.data,
					enviarExhorto:enviarExhorto,
					activo:'S',
					accion:accion
				},
				success:function(response){
					console.log(response);
	            	var object = eval("("+response+")");
	            	var cveJuzgadoDestino = '';
					try{
		            	if( object.totalCount > 0 ){
		            		var data = object.data[0];
		            		//console.log('respuesta positiva');
		            		cveJuzgadoDestino = data.cveJuzgadoDestino;
		            		//asignacion de valores de control
		            		$('#idActuacion').val(data.idActuacion);
		            		$('#numActuacion').val(data.numActuacion);
		            		$('#aniActuacion').val(data.aniActuacion);
		            		//cambio de etiqueta de boton
		            		$('#guardaExhortos').html('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Actualizar');
		            		//muestra mensaje de confirmacion
        					muestraMensaje(object.text,'success');
        					//valida, si se 'envio' el exhorto, bloquea la edicion de los campos
        					var estatusExhorto = 'POR ENVIAR';
        					if( enviarExhorto == true && cveJuzgadoDestino != '' ){
        						estatusExhorto = 'ENVIADO';
        						bloqueaFormulario('exhorto',true);
        						$('#eliminaExhortos').hide();
        						$('#divStatusExhorto').empty().html( estatusExhorto );
								//***muestra datos de exhorto enviado
								$('#divNoAnioExhorto').empty().html( data.cveJuzgadoDestino );
								$('#divJuzgadoAsignado').empty().html( data.juzgadoDestino );
								//WSrespuesta 
								//datos de impresión
        					} 
							//***muestra boton para impresion
							//genera el objeto para enviar a impresion
							var cveConsignacion = [], exhortoGeneradoTmp = [], exhortoGenerado = [], cveTipo = [], cveEstatusExhorto = [];
							var cveEstadoDestino = [], juiciosExhortos = [];
							var cveTipoParteArr = [], cveTipoPersonaArr = [];
							var partesImp = [];
							cveConsignacion[0] = { cveConsignacion:'ClaveConsignacion', desConsignacion:'descripConsignacion'};
							cveEstatusExhorto[0] = { cveEstatusExhorto:'---',desEstatusExhorto:estatusExhorto };
							cveEstadoDestino[0] = { cveEstado:'---',desEstado:'---' };
							juiciosExhortos[0] = { cveJuicio:'---',idJuicioExhorto:'---',otroJuicio:'---' };
							cveTipo[0] = { cveTipo:'---', desCarpeta:$('#cveTipo option:selected').text() };
							$.each(partes.data, function(index,value){
								//console.log(value.nombre+'/'+value.paterno+'/'+value.materno+'/'+value.nombrePersonaMoral);
								cveTipoPersonaArr[0] = { cveTipoPersona:value.cveTipoPersona,desTipoPersona:value.desTipoPersona };
								cveTipoParteArr[0] = { cveTipoParte:value.cveTipoParte,descTipoParte:value.descTipoParte };
								partesImp[index] = { nombre:value.nombre,paterno:value.paterno,materno:value.materno,nombrePersonaMoral:value.nombrePersonaMoral,cveTipoParte:cveTipoParteArr, cveTipoPersona:cveTipoPersonaArr };
							});
							exhortoGenerado['cveEstadoDestino'] = cveEstadoDestino;
							exhortoGenerado['cveEstatusExhorto'] = cveEstatusExhorto;
							exhortoGenerado['cveOficialia'] = '---';
							exhortoGenerado['idExhortoGenerado'] = 'idExhortoGEnerado';
							exhortoGenerado['juiciosExhortos'] = juiciosExhortos;
							exhortoGenerado['numeroAnio'] = 'numeroAnio';
							exhortoGenerado['partes'] = partesImp;
							exhortoGenerado['requisitoria'] = 'requisitoria';
							exhortoGeneradoTmp[0] = exhortoGenerado;
							objetoImpresion = { aniActuacion:$('#aniActuacion').val(), anioExp:$('#anioExp').val(), anioOficio:'---', carpetaInv:'---', cveConsignacion:cveConsignacion,
							cveCuantia:'---', cveJuzgado:'---', cveJuzgadoDestino:'---', cveMateria:'---', cveTipo:cveTipo,
							cveTipoActuacion:'---', exhortoGenerado:exhortoGeneradoTmp, fechaRegistro:data.fechaRegistro, idActuacion:'---',
							juzgadoDestino:'POR DEFINIR', noFojas:'---', nuc:'---', numActuacion:$('#numActuacion').val(), numOficio:'---', numeroExp:$('#numeroExp').val(),
							observaciones:$('#observaciones').val(), sintesis:$('#sintesis').val() };
							//console.log( objetoImpresion );
							//muestra boton
							$('#imprimeExhorto').show();
							//***Activar seccion de adjuntar archivos
							$('#formulario-adjuntos').show();
		            	}else{
		            		//console.log('respuesta negativa');
		            		muestraMensaje(object.text,'error');
		            		//muestraMensaje(mensaje,'error');
		            	}
					} catch (e){
	                    muestraMensaje(object.text,'error');
	                }
				}
				/*,
				error: function(xhr){
            		muestraMensaje("Ocurri&oacute; un error: " + xhr.status + " " + xhr.statusText,'error');
            		console.log("Ocurri&oacute; un error: " + xhr.status + " " + xhr.statusText);
        		}*/
			}); 
		}
	});

	bloqueaFormulario = function( seccion, estado ){
		var seccion = seccion || 'exhorto';
		if( seccion == 'exhorto' ){
			$('#cveEstadoDestino').prop('disabled',estado);
			$('#cveOficialia').prop('disabled',estado);
			$('#numeroExp').prop('disabled',estado);
			$('#anioExp').prop('disabled',estado);
			$('#numOficio').prop('disabled',estado);
			$('#anioOficio').prop('disabled',estado);
			$('#cveTipo').prop('disabled',estado);
			$('#carpetaInv').prop('disabled',true);
			$('#nuc').prop('disabled',true);
			$('#cveMateria').prop('disabled',estado);
			$('#cveJuicio').prop('disabled',estado);
			$('#otroJuicio').prop('disabled',estado);
			$('#cveCuantia').prop('disabled',estado);
			$('#noFojas').prop('disabled',estado);
			$('#sintesis').prop('disabled',estado);
			$('#observaciones').prop('disabled',estado);
			$('#enviarExhorto').prop('disabled',estado);

			$('#cveTipoParte').prop('disabled',true);
			$('#cveTipoPersona').prop('disabled',true);

			$('.btn-partes').prop('disabled',estado);
			$('#guardaExhortos').html('Enviado').prop('disabled',estado);
		}
	}

	//consulta de exhortos
	$('#consultaExhortos').on('click',function(){
		limpiaFormulario('consulta');
		cambiaModulo('consulta');
		reiniciaFormulario();
	});

	//Validacion de ingreso numerico
	$('#numeroExp, #anioExp, #numOficio, #anioOficio, #noFojas, #telefono, #telefonoMoral').keypress(validateNumber);
	$('#fechaNacimiento, #b_fechaInicio, #b_fechaFin').datepicker().on('changeDate',function(e){ $(this).datepicker('hide'); });

	// Variable para el control de tipo de personas
	var persona = {
		fisica:1,
		moral:2,
		otra:3
	};
	//IDs de juicios para ingreso manual, 1 por materia
	var juicioManual = [9999] //[135,141,1,134];
	var objetoImpresion = '';

	var globales = {
		materiaPenal:4, // Identificador igual al de la base de datos para materia penal
		noDetenido:2, // identificador igual al definido para los combos 'detenido'
		parteActor:1, // Identificadores igual a los de la base de datos para: imputado, Actor, quejoso, tercero perjudicado, autoridad federal, ofendido
		parteTerceroPerjudicado:3,
		parteQuejoso:4,
		parteFederal:6,
		parteImputado:8,
		parteOfendido:9,
		estatusExhortoBloqueado:[1,2,3,4,6], //id correspondientes a los estatus en los que los campos se deberán bloquear a la edición, tomados de la tabla -tblestatusexhortos-
		estatusAdjuntoBloqueado:[2,3,4,5],
		//del sistema
		cveJuzgado:$('#cveJuzgado').val(),
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
        fd.append('idActuacion', $('#idActuacion').val() );
        fd.append('cveTipoDocumento', '9');
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

	/**
	* Función para realizar la carga de la informacion necesaria en la pantalla principal
	*/
	cargaGeneral = function(){
		//validacion de sesion 
		if( $('#cveJuzgado').val() == '' ){
			$('#spanSession').empty().html('<b>*** NO HAY SESIÓN ACTIVA, LOS DATOS NO SE GUARDARÁN. SALGA DEL SISTEMA Y VUELVA A AUTENTIFICARSE.***</b>');
		}
		//combo de estados
		fillCombo(['cveEstadoDestino','cveEstado','cveEstadoMoral','b_cveEstadoDestino'],'estados/EstadosFacade','cveEstado','desEstado','','combo -Estado Destino-');
		//combo de actuaciones, con la seleccion de -exorto generado- por default
		fillCombo(['cveTipoActuacion'],'tiposactuaciones/TiposactuacionesFacade','cveTipoActuacion','desTipoActuacion','1','combo -Tipo de Actuación-');
		//combo de tipos
		fillCombo(['cveTipo','b_cveTipo'],'tipos/TiposFacade','cveTipo','desCarpeta','','combo -Tipo de Carpeta-');
		//combo de materias
		fillCombo(['cveMateria'],'materias/MateriasFacade','cveMateria','desMateria','','combo -Materia-'); //,'b_cveMateria'
		//combo de cuantias
		fillCombo(['cveCuantia'],'cuantias/CuantiasFacade','cveCuantia','desCuantia','','combo -Cuantía-'); //,'b_cveCuantia'
		//combo de tipo partes
		fillCombo(['cveTipoParte'],'tipospartes/TipospartesFacade','cveTipoParte','descTipoParte','','combo -Tipo de Parte-');
		//combo de generos
		fillCombo(['cveGenero'],'generos/GenerosFacade','cveGenero','desGenero','','combo -Género-');
		//combo de tipos de personas
		fillCombo(['cveTipoPersona'],'tipospersonas/TipospersonasFacade','cveTipoPersona','desTipoPersona','','combo -Tipo de Personas-');
		//combo detenido
		var detenidoOpciones = '<option value="0">--SELECCIONE--</option><option value="1">SI</option><option value="2">NO</option>';
		$('#detenido, #detenidoMoral').append(detenidoOpciones);
		//combo consignaciones
		fillCombo(['cveConsignacion','b_cveConsignacion'],'consignaciones/ConsignacionesFacade','cveConsignacion','desConsignacion','','-Consignaciones-');
		//definicion del maximo de envío
		$('#maximoEnvio').empty().html( '% de espacio ocupado para env&iacute;o (' + obtenerMaximoEnvio() + '):' );
		//muestra el tamaño maximo por archivo
		$('#maximoPorArchivo').empty().html( obtenerMaximoPorArchivo );
		return null;
	}

	/**
	* Inicialización
	*/
	$(function(){
		//carga captura general
		cargaGeneral();
	});
</script>