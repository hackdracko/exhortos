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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//promoventesactuaciones/frmPromoventesactuacionesView.xml", "frmPromoventesactuacionesView");
?>
<!DOCTYPE html>
<html lang = "es">
<head>
<meta charset = "ISO-8859-1">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
<meta name = "viewport" content = "width=device-width, initial-scale=1">
<!--The above 3 meta tags *must* come first in the head;
any other head content must come *after* these tags -->
<title>Formulario de Promoventesactuaciones</title>
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
guardarPromoventesactuaciones = function(){
var <?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
var <?php echo $tagXml->getAttribut("cedula", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cedula", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/promoventesactuaciones/PromoventesactuacionesFacade.Class.php",
data: {
idPromoventeActuacion : <?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value,
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
cveTipoParte : <?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value,
cveTipoPersona : <?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
nombrePersonaMoral : <?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value,
cedula : <?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value,
cveGenero : <?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value,
accion : "guardar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divPromoventesactuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
alert(datos.text);
<?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value=datos.data[0].idPromoventeActuacion;
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value=datos.data[0].idActuacion;
<?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value=datos.data[0].cveTipoParte;
<?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value=datos.data[0].cveTipoPersona;
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value=datos.data[0].nombre;
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value=datos.data[0].paterno;
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value=datos.data[0].materno;
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo;
<?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value=datos.data[0].nombrePersonaMoral;
<?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value=datos.data[0].cedula;
<?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value=datos.data[0].cveGenero;
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
?>
}else{
alert(datos.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
?>
}
} catch (e) {
alert(datos.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
bajaPromoventesactuaciones = function(){
var <?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
var <?php echo $tagXml->getAttribut("cedula", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cedula", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
if(confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?")==true){
$.ajax({
type: "POST",
url: "../../../fachadas/promoventesactuaciones/PromoventesactuacionesFacade.Class.php",
data: {
idPromoventeActuacion : <?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value,
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
cveTipoParte : <?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value,
cveTipoPersona : <?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
nombrePersonaMoral : <?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value,
cedula : <?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value,
cveGenero : <?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value,
accion : "baja"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divPromoventesactuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
alert(datos.text);
limpiaPromoventesactuaciones();
document.getElementById('divPromoventesactuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
?>
} catch (e) {
alert(datos.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
}
consultaPromoventesactuaciones = function(){
var <?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
var <?php echo $tagXml->getAttribut("cedula", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cedula", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/promoventesactuaciones/PromoventesactuacionesFacade.Class.php",
data: {
idPromoventeActuacion : <?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value,
idActuacion : <?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value,
cveTipoParte : <?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value,
cveTipoPersona : <?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
nombrePersonaMoral : <?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value,
cedula : <?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value,
cveGenero : <?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value,
accion : "consultar"},
async: true,
dataType: "html",
beforeSend: function(objeto) {
document.getElementById('divPromoventesactuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
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
datagrid.setHeadersP("Promoventesactuaciones");
datagrid.setColspanP("11"); // 90%
datagrid.setHeaders("No.","<?php  echo $tagXml->getTag("idActuacion" ); ?>","<?php  echo $tagXml->getTag("cveTipoParte" ); ?>","<?php  echo $tagXml->getTag("cveTipoPersona" ); ?>","<?php  echo $tagXml->getTag("nombre" ); ?>","<?php  echo $tagXml->getTag("paterno" ); ?>","<?php  echo $tagXml->getTag("materno" ); ?>","<?php  echo $tagXml->getTag("activo" ); ?>","<?php  echo $tagXml->getTag("nombrePersonaMoral" ); ?>","<?php  echo $tagXml->getTag("cedula" ); ?>","<?php  echo $tagXml->getTag("cveGenero" ); ?>");
datagrid.setTamCols('5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%');
datagrid.setDocumentJson(datos);
datagrid.setDocumentDiv("divPromoventesactuaciones");
datagrid.setTagShow("idActuacion","cveTipoParte","cveTipoPersona","nombre","paterno","materno","activo","nombrePersonaMoral","cedula","cveGenero");
datagrid.setTagHidden("idPromoventeActuacion");
datagrid.setTitle("Resultado de consulta");
datagrid.setOnclick("seleccionaPromoventesactuaciones", "idPromoventeActuacion");
datagrid.loadJson();
$("#divPromoventesactuaciones").show("slow");
ajustar(parent.parent.document.getElementById("Contenido"));
}else{
alert(result.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
limpiaPromoventesactuaciones = function(){
<?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value="";
}
seleccionaPromoventesactuaciones = function(ididPromoventeActuacion){
var <?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("idActuacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>");
var <?php echo $tagXml->getAttribut("cedula", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cedula", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGenero", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/promoventesactuaciones/PromoventesactuacionesFacade.Class.php",
data: {
idPromoventeActuacion : <?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?> .value=ididPromoventeActuacion,
accion : "seleccionar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divPromoventesactuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
<?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>.value=datos.data[0].idPromoventeActuacion
<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>.value=datos.data[0].idActuacion
<?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>.value=datos.data[0].cveTipoParte
<?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>.value=datos.data[0].cveTipoPersona
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value=datos.data[0].nombre
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value=datos.data[0].paterno
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value=datos.data[0].materno
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo
<?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>.value=datos.data[0].nombrePersonaMoral
<?php  echo $tagXml->getAttribut("cedula","id" ); ?>.value=datos.data[0].cedula
<?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>.value=datos.data[0].cveGenero
document.getElementById('divPromoventesactuaciones').innerHTML = "";
consultaPromoventesactuaciones();
}else{
alert(datos.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
}
} catch (e) {
alert(datos.text);
document.getElementById('divPromoventesactuaciones').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
listaActuaciones = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/actuaciones/ActuacionesFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divActuaciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("idActuacion", "name"); ?>" id="<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("idActuacion", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].idActuacion + "'>" + datos.data[index].idActuacion + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divActuaciones').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaTipospartes = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/tipospartes/TipospartesFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divTipospartes').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveTipoParte", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipoParte", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveTipoParte + "'>" + datos.data[index].cveTipoParte + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divTipospartes').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaTipospersonas = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/tipospersonas/TipospersonasFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divTipospersonas').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveTipoPersona", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveTipoPersona", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveTipoPersona + "'>" + datos.data[index].cveTipoPersona + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divTipospersonas').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaGeneros = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/generos/GenerosFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divGeneros').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveGenero", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveGenero", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveGenero + "'>" + datos.data[index].cveGenero + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divGeneros').innerHTML = html;
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
<legend>Registro de Promoventesactuaciones</legend>
<p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idPromoventeActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idPromoventeActuacion", "id"); ?>" class="caption" id="idPromoventeActuacion"><?php echo $tagXml->getTag("idPromoventeActuacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("idPromoventeActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idPromoventeActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idPromoventeActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idPromoventeActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idPromoventeActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
<script>
$("#<?php  echo $tagXml->getAttribut("idPromoventeActuacion","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("idActuacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("idActuacion", "id"); ?>" class="caption" id="idActuacion"><?php echo $tagXml->getTag("idActuacion"); ?></label>
<div name="divActuaciones" id="divActuaciones">
<input type="<?php echo ($tagXml->getAttribut("idActuacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("idActuacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("idActuacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("idActuacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("idActuacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("idActuacion","name" ); ?>").keydown(posValue);
listaActuaciones(2);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipoParte", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveTipoParte", "id"); ?>" class="caption" id="cveTipoParte"><?php echo $tagXml->getTag("cveTipoParte"); ?></label>
<div name="divTipospartes" id="divTipospartes">
<input type="<?php echo ($tagXml->getAttribut("cveTipoParte", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveTipoParte","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveTipoParte","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveTipoParte","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveTipoParte","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveTipoParte","name" ); ?>").keydown(posValue);
listaTipospartes(3);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveTipoPersona", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveTipoPersona", "id"); ?>" class="caption" id="cveTipoPersona"><?php echo $tagXml->getTag("cveTipoPersona"); ?></label>
<div name="divTipospersonas" id="divTipospersonas">
<input type="<?php echo ($tagXml->getAttribut("cveTipoPersona", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveTipoPersona","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveTipoPersona","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveTipoPersona","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveTipoPersona","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveTipoPersona","name" ); ?>").keydown(posValue);
listaTipospersonas(4);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nombre", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("nombre", "id"); ?>" class="caption" id="nombre"><?php echo $tagXml->getTag("nombre"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("nombre", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("nombre","name" ); ?>" id="<?php  echo $tagXml->getAttribut("nombre","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("nombre","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("nombre","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
<script>
$("#<?php  echo $tagXml->getAttribut("nombre","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("paterno", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("paterno", "id"); ?>" class="caption" id="paterno"><?php echo $tagXml->getTag("paterno"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("paterno", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("paterno","name" ); ?>" id="<?php  echo $tagXml->getAttribut("paterno","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("paterno","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("paterno","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="6">
<script>
$("#<?php  echo $tagXml->getAttribut("paterno","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("materno", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("materno", "id"); ?>" class="caption" id="materno"><?php echo $tagXml->getTag("materno"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("materno", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("materno","name" ); ?>" id="<?php  echo $tagXml->getAttribut("materno","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("materno","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("materno","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="7">
<script>
$("#<?php  echo $tagXml->getAttribut("materno","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("activo", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("activo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("activo","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("activo","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("activo","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="8">
<script>
$("#<?php  echo $tagXml->getAttribut("activo","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nombrePersonaMoral", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("nombrePersonaMoral", "id"); ?>" class="caption" id="nombrePersonaMoral"><?php echo $tagXml->getTag("nombrePersonaMoral"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("nombrePersonaMoral", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("nombrePersonaMoral","name" ); ?>" id="<?php  echo $tagXml->getAttribut("nombrePersonaMoral","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("nombrePersonaMoral","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("nombrePersonaMoral","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="9">
<script>
$("#<?php  echo $tagXml->getAttribut("nombrePersonaMoral","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cedula", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cedula", "id"); ?>" class="caption" id="cedula"><?php echo $tagXml->getTag("cedula"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("cedula", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cedula","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cedula","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cedula","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cedula","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="10">
<script>
$("#<?php  echo $tagXml->getAttribut("cedula","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveGenero", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveGenero", "id"); ?>" class="caption" id="cveGenero"><?php echo $tagXml->getTag("cveGenero"); ?></label>
<div name="divGeneros" id="divGeneros">
<input type="<?php echo ($tagXml->getAttribut("cveGenero", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveGenero","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveGenero","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveGenero","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveGenero","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="11">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveGenero","name" ); ?>").keydown(posValue);
listaGeneros(11);
</script>
</div>
</p>
<p style="text-align: center;">
<button type="button" class="btn btn-success" value="Guardar" id="btnPromoventesactuacionesGuardar" name="btnPromoventesactuacionesGuardar" onclick="guardarPromoventesactuaciones()" tabIndex="13" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
<button type="button"  class="btn btn-default" value="Limpiar" id="btnPromoventesactuacionesLimpiar" name="btnPromoventesactuacionesLimpiar" onclick="limpiaPromoventesactuaciones()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
<button type="button"  class="btn btn-info" value="Consultar" id="btnPromoventesactuacionesConsultar" name="btnPromoventesactuacionesConsultar" onclick="consultaPromoventesactuaciones()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
<button type="button"  class="btn btn-danger" value="Eliminar" id="btnPromoventesactuacionesEliminar" name="btnPromoventesactuacionesEliminar" onclick="bajaPromoventesactuaciones()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
<script>
<?php
 if(($permisos["data"][0]->registrar=='N') && ($permisos["data"][0]->modificar=='N'))
 echo "$(\"#btnPromoventesactuacionesGuardar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->eliminar=='N')
 echo "$(\"#btnPromoventesactuacionesEliminar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->consulta=='N')
 echo "$(\"#btnPromoventesactuacionesConsultar\").css(\"display\",\"none\");\n";
?>
</script>
</p>
<div id="divPromoventesactuaciones" name="divPromoventesactuaciones" class="table-responsive" width="100%"></div>
<script>
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaPromoventesactuaciones();\n";
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
