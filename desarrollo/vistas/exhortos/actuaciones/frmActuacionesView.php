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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//actuaciones/frmActuacionesView.xml", "frmActuacionesView");
?>
<!DOCTYPE html>
<html lang = "es">
<head>
<meta charset = "ISO-8859-1">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
<meta name = "viewport" content = "width=device-width, initial-scale=1">
<!--The above 3 meta tags *must* come first in the head;
any other head content must come *after* these tags -->
<title>Formulario de Actuaciones</title>
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
guardarActuaciones = function(){
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("aniActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("aniActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numeroExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numeroExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("anioExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("anioExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>");
var <?php echo $tagXml->getAttribut("carpetaInv", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("carpetaInv", "id"); ?>");
var <?php echo $tagXml->getAttribut("nuc", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nuc", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveMateria", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveCuantia", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>");
var <?php echo $tagXml->getAttribut("noFojas", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("noFojas", "id"); ?>");
var <?php echo $tagXml->getAttribut("numOficio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numOficio", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>");
var <?php echo $tagXml->getAttribut("sintesis", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("sintesis", "id"); ?>");
var <?php echo $tagXml->getAttribut("observaciones", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("observaciones", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/actuaciones/ActuacionesFacade.Class.php",
data: {
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
numActuacion : <?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value,
aniActuacion : <?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value,
cveTipoActuacion : <?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value,
numeroExp : <?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value,
anioExp : <?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value,
cveTipo : <?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value,
carpetaInv : <?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value,
nuc : <?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value,
cveMateria : <?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value,
cveCuantia : <?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value,
noFojas : <?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value,
numOficio : <?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value,
cveJuzgado : <?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value,
sintesis : <?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value,
observaciones : <?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value,
cveConsignacion : <?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value,
cveJuzgadoDestino : <?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value,
juzgadoDestino : <?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "guardar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divActuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
alert(datos.text);
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value=datos.data[0].idActuacion;
<?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value=datos.data[0].numActuacion;
<?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value=datos.data[0].aniActuacion;
<?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value=datos.data[0].cveTipoActuacion;
<?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value=datos.data[0].numeroExp;
<?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value=datos.data[0].anioExp;
<?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value=datos.data[0].cveTipo;
<?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value=datos.data[0].carpetaInv;
<?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value=datos.data[0].nuc;
<?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value=datos.data[0].cveMateria;
<?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value=datos.data[0].cveCuantia;
<?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value=datos.data[0].noFojas;
<?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value=datos.data[0].numOficio;
<?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value=datos.data[0].cveJuzgado;
<?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value=datos.data[0].sintesis;
<?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value=datos.data[0].observaciones;
<?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value=datos.data[0].cveConsignacion;
<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value=datos.data[0].cveJuzgadoDestino;
<?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value=datos.data[0].juzgadoDestino;
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo;
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro;
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion;
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
?>
}else{
alert(datos.text);
document.getElementById('divActuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
?>
}
} catch (e) {
alert(datos.text);
document.getElementById('divActuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
bajaActuaciones = function(){
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("aniActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("aniActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numeroExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numeroExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("anioExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("anioExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>");
var <?php echo $tagXml->getAttribut("carpetaInv", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("carpetaInv", "id"); ?>");
var <?php echo $tagXml->getAttribut("nuc", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nuc", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveMateria", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveCuantia", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>");
var <?php echo $tagXml->getAttribut("noFojas", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("noFojas", "id"); ?>");
var <?php echo $tagXml->getAttribut("numOficio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numOficio", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>");
var <?php echo $tagXml->getAttribut("sintesis", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("sintesis", "id"); ?>");
var <?php echo $tagXml->getAttribut("observaciones", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("observaciones", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
if(confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?")==true){
$.ajax({
type: "POST",
url: "../../../fachadas/actuaciones/ActuacionesFacade.Class.php",
data: {
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
numActuacion : <?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value,
aniActuacion : <?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value,
cveTipoActuacion : <?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value,
numeroExp : <?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value,
anioExp : <?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value,
cveTipo : <?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value,
carpetaInv : <?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value,
nuc : <?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value,
cveMateria : <?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value,
cveCuantia : <?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value,
noFojas : <?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value,
numOficio : <?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value,
cveJuzgado : <?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value,
sintesis : <?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value,
observaciones : <?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value,
cveConsignacion : <?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value,
cveJuzgadoDestino : <?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value,
juzgadoDestino : <?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "baja"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divActuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
alert(datos.text);
limpiaActuaciones();
document.getElementById('divActuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
?>
} catch (e) {
alert(datos.text);
document.getElementById('divActuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
}
consultaActuaciones = function(){
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("aniActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("aniActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numeroExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numeroExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("anioExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("anioExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>");
var <?php echo $tagXml->getAttribut("carpetaInv", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("carpetaInv", "id"); ?>");
var <?php echo $tagXml->getAttribut("nuc", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nuc", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveMateria", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveCuantia", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>");
var <?php echo $tagXml->getAttribut("noFojas", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("noFojas", "id"); ?>");
var <?php echo $tagXml->getAttribut("numOficio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numOficio", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>");
var <?php echo $tagXml->getAttribut("sintesis", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("sintesis", "id"); ?>");
var <?php echo $tagXml->getAttribut("observaciones", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("observaciones", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/actuaciones/ActuacionesFacade.Class.php",
data: {
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
numActuacion : <?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value,
aniActuacion : <?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value,
cveTipoActuacion : <?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value,
numeroExp : <?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value,
anioExp : <?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value,
cveTipo : <?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value,
carpetaInv : <?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value,
nuc : <?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value,
cveMateria : <?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value,
cveCuantia : <?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value,
noFojas : <?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value,
numOficio : <?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value,
cveJuzgado : <?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value,
sintesis : <?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value,
observaciones : <?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value,
cveConsignacion : <?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value,
cveJuzgadoDestino : <?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value,
juzgadoDestino : <?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "consultar"},
async: true,
dataType: "html",
beforeSend: function(objeto) {
document.getElementById('divActuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
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
datagrid.setHeadersP("Actuaciones");
datagrid.setColspanP("22"); // 90%
datagrid.setHeaders("No.","<?php  echo $tagXml->getTag("numActuacion" ); ?>","<?php  echo $tagXml->getTag("aniActuacion" ); ?>","<?php  echo $tagXml->getTag("cveTipoActuacion" ); ?>","<?php  echo $tagXml->getTag("numeroExp" ); ?>","<?php  echo $tagXml->getTag("anioExp" ); ?>","<?php  echo $tagXml->getTag("cveTipo" ); ?>","<?php  echo $tagXml->getTag("carpetaInv" ); ?>","<?php  echo $tagXml->getTag("nuc" ); ?>","<?php  echo $tagXml->getTag("cveMateria" ); ?>","<?php  echo $tagXml->getTag("cveCuantia" ); ?>","<?php  echo $tagXml->getTag("noFojas" ); ?>","<?php  echo $tagXml->getTag("numOficio" ); ?>","<?php  echo $tagXml->getTag("cveJuzgado" ); ?>","<?php  echo $tagXml->getTag("sintesis" ); ?>","<?php  echo $tagXml->getTag("observaciones" ); ?>","<?php  echo $tagXml->getTag("cveConsignacion" ); ?>","<?php  echo $tagXml->getTag("cveJuzgadoDestino" ); ?>","<?php  echo $tagXml->getTag("juzgadoDestino" ); ?>","<?php  echo $tagXml->getTag("activo" ); ?>","<?php  echo $tagXml->getTag("fechaRegistro" ); ?>","<?php  echo $tagXml->getTag("fechaActualizacion" ); ?>");
datagrid.setTamCols('5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%');
datagrid.setDocumentJson(datos);
datagrid.setDocumentDiv("divActuaciones");
datagrid.setTagShow("numActuacion","aniActuacion","cveTipoActuacion","numeroExp","anioExp","cveTipo","carpetaInv","nuc","cveMateria","cveCuantia","noFojas","numOficio","cveJuzgado","sintesis","observaciones","cveConsignacion","cveJuzgadoDestino","juzgadoDestino","activo","fechaRegistro","fechaActualizacion");
datagrid.setTagHidden("idActuacion");
datagrid.setTitle("Resultado de consulta");
datagrid.setOnclick("seleccionaActuaciones", "idActuacion");
datagrid.loadJson();
$("#divActuaciones").show("slow");
ajustar(parent.parent.document.getElementById("Contenido"));
}else{
alert(result.text);
document.getElementById('divActuaciones').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
limpiaActuaciones = function(){
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value="";
}
seleccionaActuaciones = function(ididActuacion){
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("aniActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("aniActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("numeroExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numeroExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("anioExp", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("anioExp", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>");
var <?php echo $tagXml->getAttribut("carpetaInv", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("carpetaInv", "id"); ?>");
var <?php echo $tagXml->getAttribut("nuc", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nuc", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveMateria", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveCuantia", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>");
var <?php echo $tagXml->getAttribut("noFojas", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("noFojas", "id"); ?>");
var <?php echo $tagXml->getAttribut("numOficio", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numOficio", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>");
var <?php echo $tagXml->getAttribut("sintesis", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("sintesis", "id"); ?>");
var <?php echo $tagXml->getAttribut("observaciones", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("observaciones", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/actuaciones/ActuacionesFacade.Class.php",
data: {
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?> .value=ididActuacion,
accion : "seleccionar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divActuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value=datos.data[0].idActuacion
<?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>.value=datos.data[0].numActuacion
<?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>.value=datos.data[0].aniActuacion
<?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>.value=datos.data[0].cveTipoActuacion
<?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>.value=datos.data[0].numeroExp
<?php  echo $tagXml->getAttribut("anioExp","id" ); ?>.value=datos.data[0].anioExp
<?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>.value=datos.data[0].cveTipo
<?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>.value=datos.data[0].carpetaInv
<?php  echo $tagXml->getAttribut("nuc","id" ); ?>.value=datos.data[0].nuc
<?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>.value=datos.data[0].cveMateria
<?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>.value=datos.data[0].cveCuantia
<?php  echo $tagXml->getAttribut("noFojas","id" ); ?>.value=datos.data[0].noFojas
<?php  echo $tagXml->getAttribut("numOficio","id" ); ?>.value=datos.data[0].numOficio
<?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>.value=datos.data[0].cveJuzgado
<?php  echo $tagXml->getAttribut("sintesis","id" ); ?>.value=datos.data[0].sintesis
<?php  echo $tagXml->getAttribut("observaciones","id" ); ?>.value=datos.data[0].observaciones
<?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>.value=datos.data[0].cveConsignacion
<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>.value=datos.data[0].cveJuzgadoDestino
<?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>.value=datos.data[0].juzgadoDestino
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion
document.getElementById('divActuaciones').innerHTML = "";
consultaActuaciones();
}else{
alert(datos.text);
document.getElementById('divActuaciones').innerHTML = "";
}
} catch (e) {
alert(datos.text);
document.getElementById('divActuaciones').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
listaTiposactuaciones = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/tiposactuaciones/TiposactuacionesFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divTiposactuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveTipoActuacion", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipoActuacion", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveTipoActuacion + "'>" + datos.data[index].cveTipoActuacion + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divTiposactuaciones').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaTipos = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/tipos/TiposFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divTipos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveTipo", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipo", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveTipo + "'>" + datos.data[index].cveTipo + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divTipos').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaMaterias = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/materias/MateriasFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divMaterias').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveMateria", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveMateria", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveMateria + "'>" + datos.data[index].cveMateria + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divMaterias').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaCuantias = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/cuantias/CuantiasFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divCuantias').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveCuantia", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveCuantia", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveCuantia + "'>" + datos.data[index].cveCuantia + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divCuantias').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaJuzgados = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/juzgados/JuzgadosFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divJuzgados').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveJuzgado", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveJuzgado", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveJuzgado + "'>" + datos.data[index].cveJuzgado + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divJuzgados').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaConsignaciones = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/consignaciones/ConsignacionesFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divConsignaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveConsignacion", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveConsignacion", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveConsignacion + "'>" + datos.data[index].cveConsignacion + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divConsignaciones').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
</script>
</head>
<body>
<div class="container">
<div class="starter-template">
<fieldset>
<legend>Registro de Actuaciones</legend>
<p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>" class="caption" id="idActuacion"><?php echo $tagXml->getTag("idActuacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("idActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
<script>
$("#<?php  echo $tagXml->getAttribut("idActuacion","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("numActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("numActuacion", "id"); ?>" class="caption" id="numActuacion"><?php echo $tagXml->getTag("numActuacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("numActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("numActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("numActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("numActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("numActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
<script>
$("#<?php  echo $tagXml->getAttribut("numActuacion","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("aniActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("aniActuacion", "id"); ?>" class="caption" id="aniActuacion"><?php echo $tagXml->getTag("aniActuacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("aniActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("aniActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("aniActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("aniActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("aniActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
<script>
$("#<?php  echo $tagXml->getAttribut("aniActuacion","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipoActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveTipoActuacion", "id"); ?>" class="caption" id="cveTipoActuacion"><?php echo $tagXml->getTag("cveTipoActuacion"); ?></label>
<div name="divTiposactuaciones" id="divTiposactuaciones">
<input type="<?php echo ($tagXml->getAttribut("cveTipoActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveTipoActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveTipoActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveTipoActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveTipoActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveTipoActuacion","name" ); ?>").keydown(posValue);
listaTiposactuaciones(4);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("numeroExp", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("numeroExp", "id"); ?>" class="caption" id="numeroExp"><?php echo $tagXml->getTag("numeroExp"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("numeroExp", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("numeroExp","name" ); ?>" id="<?php  echo $tagXml->getAttribut("numeroExp","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("numeroExp","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("numeroExp","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
<script>
$("#<?php  echo $tagXml->getAttribut("numeroExp","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("anioExp", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("anioExp", "id"); ?>" class="caption" id="anioExp"><?php echo $tagXml->getTag("anioExp"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("anioExp", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("anioExp","name" ); ?>" id="<?php  echo $tagXml->getAttribut("anioExp","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("anioExp","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("anioExp","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="6">
<script>
$("#<?php  echo $tagXml->getAttribut("anioExp","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveTipo", "id"); ?>" class="caption" id="cveTipo"><?php echo $tagXml->getTag("cveTipo"); ?></label>
<div name="divTipos" id="divTipos">
<input type="<?php echo ($tagXml->getAttribut("cveTipo", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveTipo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveTipo","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveTipo","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveTipo","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="7">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveTipo","name" ); ?>").keydown(posValue);
listaTipos(7);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("carpetaInv", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("carpetaInv", "id"); ?>" class="caption" id="carpetaInv"><?php echo $tagXml->getTag("carpetaInv"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("carpetaInv", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("carpetaInv","name" ); ?>" id="<?php  echo $tagXml->getAttribut("carpetaInv","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("carpetaInv","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("carpetaInv","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="8">
<script>
$("#<?php  echo $tagXml->getAttribut("carpetaInv","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nuc", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("nuc", "id"); ?>" class="caption" id="nuc"><?php echo $tagXml->getTag("nuc"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("nuc", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("nuc","name" ); ?>" id="<?php  echo $tagXml->getAttribut("nuc","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("nuc","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("nuc","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="9">
<script>
$("#<?php  echo $tagXml->getAttribut("nuc","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveMateria", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveMateria", "id"); ?>" class="caption" id="cveMateria"><?php echo $tagXml->getTag("cveMateria"); ?></label>
<div name="divMaterias" id="divMaterias">
<input type="<?php echo ($tagXml->getAttribut("cveMateria", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveMateria","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveMateria","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveMateria","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveMateria","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="10">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveMateria","name" ); ?>").keydown(posValue);
listaMaterias(10);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveCuantia", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveCuantia", "id"); ?>" class="caption" id="cveCuantia"><?php echo $tagXml->getTag("cveCuantia"); ?></label>
<div name="divCuantias" id="divCuantias">
<input type="<?php echo ($tagXml->getAttribut("cveCuantia", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveCuantia","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveCuantia","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveCuantia","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveCuantia","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="11">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveCuantia","name" ); ?>").keydown(posValue);
listaCuantias(11);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("noFojas", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("noFojas", "id"); ?>" class="caption" id="noFojas"><?php echo $tagXml->getTag("noFojas"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("noFojas", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("noFojas","name" ); ?>" id="<?php  echo $tagXml->getAttribut("noFojas","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("noFojas","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("noFojas","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="12">
<script>
$("#<?php  echo $tagXml->getAttribut("noFojas","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("numOficio", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("numOficio", "id"); ?>" class="caption" id="numOficio"><?php echo $tagXml->getTag("numOficio"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("numOficio", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("numOficio","name" ); ?>" id="<?php  echo $tagXml->getAttribut("numOficio","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("numOficio","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("numOficio","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="13">
<script>
$("#<?php  echo $tagXml->getAttribut("numOficio","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveJuzgado", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveJuzgado", "id"); ?>" class="caption" id="cveJuzgado"><?php echo $tagXml->getTag("cveJuzgado"); ?></label>
<div name="divJuzgados" id="divJuzgados">
<input type="<?php echo ($tagXml->getAttribut("cveJuzgado", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveJuzgado","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveJuzgado","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveJuzgado","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveJuzgado","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="14">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveJuzgado","name" ); ?>").keydown(posValue);
listaJuzgados(14);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("sintesis", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("sintesis", "id"); ?>" class="caption" id="sintesis"><?php echo $tagXml->getTag("sintesis"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("sintesis", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("sintesis","name" ); ?>" id="<?php  echo $tagXml->getAttribut("sintesis","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("sintesis","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("sintesis","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="15">
<script>
$("#<?php  echo $tagXml->getAttribut("sintesis","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("observaciones", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("observaciones", "id"); ?>" class="caption" id="observaciones"><?php echo $tagXml->getTag("observaciones"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("observaciones", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("observaciones","name" ); ?>" id="<?php  echo $tagXml->getAttribut("observaciones","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("observaciones","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("observaciones","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="16">
<script>
$("#<?php  echo $tagXml->getAttribut("observaciones","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveConsignacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveConsignacion", "id"); ?>" class="caption" id="cveConsignacion"><?php echo $tagXml->getTag("cveConsignacion"); ?></label>
<div name="divConsignaciones" id="divConsignaciones">
<input type="<?php echo ($tagXml->getAttribut("cveConsignacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveConsignacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveConsignacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveConsignacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveConsignacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="17">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveConsignacion","name" ); ?>").keydown(posValue);
listaConsignaciones(17);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveJuzgadoDestino", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveJuzgadoDestino", "id"); ?>" class="caption" id="cveJuzgadoDestino"><?php echo $tagXml->getTag("cveJuzgadoDestino"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("cveJuzgadoDestino", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="18">
<script>
$("#<?php  echo $tagXml->getAttribut("cveJuzgadoDestino","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("juzgadoDestino", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("juzgadoDestino", "id"); ?>" class="caption" id="juzgadoDestino"><?php echo $tagXml->getTag("juzgadoDestino"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("juzgadoDestino", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("juzgadoDestino","name" ); ?>" id="<?php  echo $tagXml->getAttribut("juzgadoDestino","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("juzgadoDestino","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("juzgadoDestino","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="19">
<script>
$("#<?php  echo $tagXml->getAttribut("juzgadoDestino","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
<select name="<?php  echo $tagXml->getAttribut("activo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("activo","id" ); ?>" class="form-control text-uppercase" tabIndex="20" title="<?php  echo $tagXml->getAttribut("activo","tooltip" ); ?>" data-toggle="tooltip" >
<option value="S">SI</option>
<option value="N">NO</option>
</select>
<script>
$("#<?php  echo $tagXml->getAttribut("activo","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" class="caption" id="fechaRegistro"><?php echo $tagXml->getTag("fechaRegistro"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaRegistro","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaRegistro","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="21">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>').datetimepicker();
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" class="caption" id="fechaActualizacion"><?php echo $tagXml->getTag("fechaActualizacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaActualizacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaActualizacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="22">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>').datetimepicker();
</script>
</div>
</p>
<p style="text-align: center;">
<button type="button" class="btn btn-success" value="Guardar" id="btnActuacionesGuardar" name="btnActuacionesGuardar" onclick="guardarActuaciones()" tabIndex="24" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
<button type="button"  class="btn btn-default" value="Limpiar" id="btnActuacionesLimpiar" name="btnActuacionesLimpiar" onclick="limpiaActuaciones()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
<button type="button"  class="btn btn-info" value="Consultar" id="btnActuacionesConsultar" name="btnActuacionesConsultar" onclick="consultaActuaciones()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
<button type="button"  class="btn btn-danger" value="Eliminar" id="btnActuacionesEliminar" name="btnActuacionesEliminar" onclick="bajaActuaciones()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
<script>
<?php
 if(($permisos["data"][0]->registrar=='N') && ($permisos["data"][0]->modificar=='N'))
 echo "$(\"#btnActuacionesGuardar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->eliminar=='N')
 echo "$(\"#btnActuacionesEliminar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->consulta=='N')
 echo "$(\"#btnActuacionesConsultar\").css(\"display\",\"none\");\n";
?>
</script>
</p>
<div id="divActuaciones" name="divActuaciones" class="table-responsive" width="100%"></div>
<script>
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaActuaciones();\n";
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
