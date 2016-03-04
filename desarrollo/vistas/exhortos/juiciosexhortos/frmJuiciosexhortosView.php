<?php
/*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 VIEWS
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

session_start();
include_once(dirname(__FILE__)."/../../../tribunal/tagXml/TagXml.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
include_once(dirname(__FILE__)."/../../../webservice/cliente/permisos/PermisosCliente.php");
$tagXml = new TagXml();
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//juiciosexhortos/frmJuiciosexhortosView.xml", "frmJuiciosexhortosView");
?>
<!DOCTYPE html>
<html lang = "es">
<head>
<meta charset = "ISO-8859-1">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
<meta name = "viewport" content = "width=device-width, initial-scale=1">
<!--The above 3 meta tags *must* come first in the head;
any other head content must come *after* these tags -->
<title>Formulario de Juiciosexhortos</title>
<!--Bootstrap -->
<link href = "../../js/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
<link href = "../../css/datetimepicker/bootstrap-datetimepicker.css" rel = "stylesheet"><link href = "../../css/datagrid/jsonGrid.css" rel = "stylesheet">
<link href = "../../css/normalize.css" rel = "stylesheet">
<!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="../../js/html5shiv/html5shiv.min.js"></script>
<script src="../../js/respond/respond.min.js"></script>
<![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src = "../../js/jquery/jquery.min.js"></script>
<script src = "../../js/moment/moment.min.js"></script><!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../../js/bootstrap/js/bootstrap.min.js"></script>
<script src="../../js/datetimepicker/bootstrap-datetimepicker.min.js"></script><script src="../../js/datagrid/jsonMyDatagrid.js"></script>
<script src="../../js/funciones.js"></script>
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
guardarJuiciosexhortos = function(){
var <?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("otroJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("otroJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/juiciosexhortos/JuiciosexhortosFacade.Class.php",
data: {
idJuicioexhorto : <?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value,
idExhorto : <?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value,
idExhortoGenerado : <?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value,
cveJuicio : <?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value,
otroJuicio : <?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "guardar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divJuiciosexhortos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
alert(datos.text);
<?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value=datos.data[0].idJuicioexhorto;
<?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value=datos.data[0].idExhorto;
<?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value=datos.data[0].idExhortoGenerado;
<?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value=datos.data[0].cveJuicio;
<?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value=datos.data[0].otroJuicio;
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo;
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro;
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion;
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
}else{
alert(datos.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
}
} catch (e) {
alert(datos.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
bajaJuiciosexhortos = function(){
var <?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("otroJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("otroJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
if(confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?")==true){
$.ajax({
type: "POST",
url: "../../../fachadas/juiciosexhortos/JuiciosexhortosFacade.Class.php",
data: {
idJuicioexhorto : <?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value,
idExhorto : <?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value,
idExhortoGenerado : <?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value,
cveJuicio : <?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value,
otroJuicio : <?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "baja"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divJuiciosexhortos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
alert(datos.text);
limpiaJuiciosexhortos();
document.getElementById('divJuiciosexhortos').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
} catch (e) {
alert(datos.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
}
consultaJuiciosexhortos = function(){
var <?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("otroJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("otroJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/juiciosexhortos/JuiciosexhortosFacade.Class.php",
data: {
idJuicioexhorto : <?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value,
idExhorto : <?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value,
idExhortoGenerado : <?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value,
cveJuicio : <?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value,
otroJuicio : <?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "consultar"},
async: true,
dataType: "html",
beforeSend: function(objeto) {
document.getElementById('divJuiciosexhortos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
var result = eval("(" + datos + ")");
if (result.totalCount > 0) {
var datagrid = new JsonMyDatagrid();
datagrid.setClase(datagrid);
datagrid.setImagenPath("img/");
datagrid.setMouseOver("#CCCCCC");
datagrid.setMouseOut("#FFFFFF");
datagrid.setSizeTable("100%");
datagrid.setPaginacion(false);
datagrid.setBorder(1);
//datagrid.setTagImg("deposito");
datagrid.setShowPagina("buscar");
datagrid.setHeadersP("Juiciosexhortos");
datagrid.setColspanP("8"); // 90%
datagrid.setHeaders("No.","<?php  echo $tagXml->getTag("idExhorto" ); ?>","<?php  echo $tagXml->getTag("idExhortoGenerado" ); ?>","<?php  echo $tagXml->getTag("cveJuicio" ); ?>","<?php  echo $tagXml->getTag("otroJuicio" ); ?>","<?php  echo $tagXml->getTag("activo" ); ?>","<?php  echo $tagXml->getTag("fechaRegistro" ); ?>","<?php  echo $tagXml->getTag("fechaActualizacion" ); ?>");
datagrid.setTamCols('5%','5%','5%','5%','5%','5%','5%','5%');
datagrid.setDocumentJson(datos);
datagrid.setDocumentDiv("divJuiciosexhortos");
datagrid.setTagShow("idExhorto","idExhortoGenerado","cveJuicio","otroJuicio","activo","fechaRegistro","fechaActualizacion");
datagrid.setTagHidden("idJuicioexhorto");
datagrid.setTitle("Resultado de consulta");
datagrid.setOnclick("seleccionaJuiciosexhortos", "idJuicioexhorto");
datagrid.loadJson();
$("#divJuiciosexhortos").show("slow");
ajustar(parent.parent.document.getElementById("Contenido"));
}else{
alert(result.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
limpiaJuiciosexhortos = function(){
<?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value="";
}
seleccionaJuiciosexhortos = function(ididJuicioexhorto){
var <?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhorto", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>");
var <?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("otroJuicio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("otroJuicio", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/juiciosexhortos/JuiciosexhortosFacade.Class.php",
data: {
idJuicioexhorto : <?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?> .value=ididJuicioexhorto,
accion : "seleccionar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divJuiciosexhortos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
<?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>.value=datos.data[0].idJuicioexhorto
<?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>.value=datos.data[0].idExhorto
<?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>.value=datos.data[0].idExhortoGenerado
<?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>.value=datos.data[0].cveJuicio
<?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>.value=datos.data[0].otroJuicio
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion
document.getElementById('divJuiciosexhortos').innerHTML = "";
consultaJuiciosexhortos();
}else{
alert(datos.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
}
} catch (e) {
alert(datos.text);
document.getElementById('divJuiciosexhortos').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
</script>
</head>
<body>
<div class="container">
<div class="starter-template">
<fieldset>
<legend>Registro de Juiciosexhortos</legend>
<p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idJuicioexhorto", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idJuicioexhorto", "id"); ?>" class="caption" id="idJuicioexhorto"><?php echo $tagXml->getTag("idJuicioexhorto"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("idJuicioexhorto", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idJuicioexhorto","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idJuicioexhorto","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idJuicioexhorto","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idJuicioexhorto","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
<script>
$("#<?php  echo $tagXml->getAttribut("idJuicioexhorto","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idExhorto", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idExhorto", "id"); ?>" class="caption" id="idExhorto"><?php echo $tagXml->getTag("idExhorto"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("idExhorto", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idExhorto","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idExhorto","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idExhorto","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idExhorto","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
<script>
$("#<?php  echo $tagXml->getAttribut("idExhorto","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idExhortoGenerado", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idExhortoGenerado", "id"); ?>" class="caption" id="idExhortoGenerado"><?php echo $tagXml->getTag("idExhortoGenerado"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("idExhortoGenerado", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idExhortoGenerado","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idExhortoGenerado","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idExhortoGenerado","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idExhortoGenerado","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
<script>
$("#<?php  echo $tagXml->getAttribut("idExhortoGenerado","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveJuicio", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveJuicio", "id"); ?>" class="caption" id="cveJuicio"><?php echo $tagXml->getTag("cveJuicio"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("cveJuicio", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveJuicio","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveJuicio","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveJuicio","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveJuicio","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
<script>
$("#<?php  echo $tagXml->getAttribut("cveJuicio","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("otroJuicio", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("otroJuicio", "id"); ?>" class="caption" id="otroJuicio"><?php echo $tagXml->getTag("otroJuicio"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("otroJuicio", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("otroJuicio","name" ); ?>" id="<?php  echo $tagXml->getAttribut("otroJuicio","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("otroJuicio","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("otroJuicio","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
<script>
$("#<?php  echo $tagXml->getAttribut("otroJuicio","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
<select name="<?php  echo $tagXml->getAttribut("activo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("activo","id" ); ?>" class="form-control text-uppercase" tabIndex="6" title="<?php  echo $tagXml->getAttribut("activo","tooltip" ); ?>" data-toggle="tooltip" >
<option value="S">SI</option>
<option value="N">NO</option>
</select>
<script>
$("#<?php  echo $tagXml->getAttribut("activo","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" class="caption" id="fechaRegistro"><?php echo $tagXml->getTag("fechaRegistro"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaRegistro","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaRegistro","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="7">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>').datetimepicker();
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" class="caption" id="fechaActualizacion"><?php echo $tagXml->getTag("fechaActualizacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaActualizacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaActualizacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="8">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>').datetimepicker();
</script>
</div>
</p>
<p style="text-align: center;">
<button type="button" class="btn btn-success" value="Guardar" id="btnJuiciosexhortosGuardar" name="btnJuiciosexhortosGuardar" onclick="guardarJuiciosexhortos()" tabIndex="10" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
<button type="button"  class="btn btn-default" value="Limpiar" id="btnJuiciosexhortosLimpiar" name="btnJuiciosexhortosLimpiar" onclick="limpiaJuiciosexhortos()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
<button type="button"  class="btn btn-info" value="Consultar" id="btnJuiciosexhortosConsultar" name="btnJuiciosexhortosConsultar" onclick="consultaJuiciosexhortos()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
<button type="button"  class="btn btn-danger" value="Eliminar" id="btnJuiciosexhortosEliminar" name="btnJuiciosexhortosEliminar" onclick="bajaJuiciosexhortos()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
<script>
<?php
 if(($permisos["data"][0]->registrar=='N') && ($permisos["data"][0]->modificar=='N'))
 echo "$(\"#btnJuiciosexhortosGuardar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->eliminar=='N')
 echo "$(\"#btnJuiciosexhortosEliminar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->consulta=='N')
 echo "$(\"#btnJuiciosexhortosConsultar\").css(\"display\",\"none\");\n";
?>
</script>
</p>
<div id="divJuiciosexhortos" name="divJuiciosexhortos" class="table-responsive" width="100%"></div>
<script>
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaJuiciosexhortos();\n";
?>
</script>
</fieldset>
</div>
</div><!--.container -->
<script>
ajustar(parent.parent.document.getElementById("Contenido"));
</script>
</body>
</html>
