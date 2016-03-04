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
$tagXml->cargaXml(dirname(__FILE__) . "/../../../vistas/exhortos//usuarios/frmUsuariosView.xml", "frmUsuariosView");
?>
<!DOCTYPE html>
<html lang = "es">
<head>
<meta charset = "ISO-8859-1">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
<meta name = "viewport" content = "width=device-width, initial-scale=1">
<!--The above 3 meta tags *must* come first in the head;
any other head content must come *after* these tags -->
<title>Formulario de Usuarios</title>
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
guardarUsuarios = function(){
var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
var <?php echo $tagXml->getAttribut("numEmpleado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numEmpleado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
var <?php echo $tagXml->getAttribut("login", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("login", "id"); ?>");
var <?php echo $tagXml->getAttribut("Password", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("Password", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/usuarios/UsuariosFacade.Class.php",
data: {
cveUsuario : <?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value,
numEmpleado : <?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value,
cveAdscripcion : <?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value,
login : <?php  echo $tagXml->getAttribut("login","id" ); ?>.value,
Password : <?php  echo $tagXml->getAttribut("Password","id" ); ?>.value,
cveGrupo : <?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
telefono : <?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value,
email : <?php  echo $tagXml->getAttribut("email","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "guardar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divUsuarios').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
alert(datos.text);
<?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value=datos.data[0].cveUsuario;
<?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value=datos.data[0].numEmpleado;
<?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value=datos.data[0].cveAdscripcion;
<?php  echo $tagXml->getAttribut("login","id" ); ?>.value=datos.data[0].login;
<?php  echo $tagXml->getAttribut("Password","id" ); ?>.value=datos.data[0].Password;
<?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value=datos.data[0].cveGrupo;
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value=datos.data[0].paterno;
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value=datos.data[0].materno;
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value=datos.data[0].nombre;
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo;
<?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value=datos.data[0].telefono;
<?php  echo $tagXml->getAttribut("email","id" ); ?>.value=datos.data[0].email;
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro;
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion;
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
?>
}else{
alert(datos.text);
document.getElementById('divUsuarios').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
?>
}
} catch (e) {
alert(datos.text);
document.getElementById('divUsuarios').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
bajaUsuarios = function(){
var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
var <?php echo $tagXml->getAttribut("numEmpleado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numEmpleado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
var <?php echo $tagXml->getAttribut("login", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("login", "id"); ?>");
var <?php echo $tagXml->getAttribut("Password", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("Password", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
if(confirm("\¿ ESTAS SEGURO DE ELIMINAR EL REGISTRO ?")==true){
$.ajax({
type: "POST",
url: "../../../fachadas/usuarios/UsuariosFacade.Class.php",
data: {
cveUsuario : <?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value,
numEmpleado : <?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value,
cveAdscripcion : <?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value,
login : <?php  echo $tagXml->getAttribut("login","id" ); ?>.value,
Password : <?php  echo $tagXml->getAttribut("Password","id" ); ?>.value,
cveGrupo : <?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
telefono : <?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value,
email : <?php  echo $tagXml->getAttribut("email","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "baja"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divUsuarios').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
alert(datos.text);
limpiaUsuarios();
document.getElementById('divUsuarios').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
?>
} catch (e) {
alert(datos.text);
document.getElementById('divUsuarios').innerHTML = "";
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
?>
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
}
consultaUsuarios = function(){
var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
var <?php echo $tagXml->getAttribut("numEmpleado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numEmpleado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
var <?php echo $tagXml->getAttribut("login", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("login", "id"); ?>");
var <?php echo $tagXml->getAttribut("Password", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("Password", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/usuarios/UsuariosFacade.Class.php",
data: {
cveUsuario : <?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value,
numEmpleado : <?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value,
cveAdscripcion : <?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value,
login : <?php  echo $tagXml->getAttribut("login","id" ); ?>.value,
Password : <?php  echo $tagXml->getAttribut("Password","id" ); ?>.value,
cveGrupo : <?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value,
paterno : <?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value,
materno : <?php  echo $tagXml->getAttribut("materno","id" ); ?>.value,
nombre : <?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value,
activo : <?php  echo $tagXml->getAttribut("activo","id" ); ?>.value,
telefono : <?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value,
email : <?php  echo $tagXml->getAttribut("email","id" ); ?>.value,
fechaRegistro : <?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value,
fechaActualizacion : <?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value,
accion : "consultar"},
async: true,
dataType: "html",
beforeSend: function(objeto) {
document.getElementById('divUsuarios').innerHTML = "<img src='../../img/cargando.gif'/>";
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
datagrid.setHeadersP("Usuarios");
datagrid.setColspanP("14"); // 90%
datagrid.setHeaders("No.","<?php  echo $tagXml->getTag("numEmpleado" ); ?>","<?php  echo $tagXml->getTag("cveAdscripcion" ); ?>","<?php  echo $tagXml->getTag("login" ); ?>","<?php  echo $tagXml->getTag("Password" ); ?>","<?php  echo $tagXml->getTag("cveGrupo" ); ?>","<?php  echo $tagXml->getTag("paterno" ); ?>","<?php  echo $tagXml->getTag("materno" ); ?>","<?php  echo $tagXml->getTag("nombre" ); ?>","<?php  echo $tagXml->getTag("activo" ); ?>","<?php  echo $tagXml->getTag("telefono" ); ?>","<?php  echo $tagXml->getTag("email" ); ?>","<?php  echo $tagXml->getTag("fechaRegistro" ); ?>","<?php  echo $tagXml->getTag("fechaActualizacion" ); ?>");
datagrid.setTamCols('5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%','5%');
datagrid.setDocumentJson(datos);
datagrid.setDocumentDiv("divUsuarios");
datagrid.setTagShow("numEmpleado","cveAdscripcion","login","Password","cveGrupo","paterno","materno","nombre","activo","telefono","email","fechaRegistro","fechaActualizacion");
datagrid.setTagHidden("cveUsuario");
datagrid.setTitle("Resultado de consulta");
datagrid.setOnclick("seleccionaUsuarios", "cveUsuario");
datagrid.loadJson();
$("#divUsuarios").show("slow");
ajustar(parent.parent.document.getElementById("Contenido"));
}else{
alert(result.text);
document.getElementById('divUsuarios').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
limpiaUsuarios = function(){
<?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("login","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("Password","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("email","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value="";
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value="";
}
seleccionaUsuarios = function(idcveUsuario){
var <?php echo $tagXml->getAttribut("cveUsuario", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>");
var <?php echo $tagXml->getAttribut("numEmpleado", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("numEmpleado", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>");
var <?php echo $tagXml->getAttribut("login", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("login", "id"); ?>");
var <?php echo $tagXml->getAttribut("Password", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("Password", "id"); ?>");
var <?php echo $tagXml->getAttribut("cveGrupo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>");
var <?php echo $tagXml->getAttribut("paterno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("paterno", "id"); ?>");
var <?php echo $tagXml->getAttribut("materno", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("materno", "id"); ?>");
var <?php echo $tagXml->getAttribut("nombre", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("nombre", "id"); ?>");
var <?php echo $tagXml->getAttribut("activo", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("activo", "id"); ?>");
var <?php echo $tagXml->getAttribut("telefono", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("telefono", "id"); ?>");
var <?php echo $tagXml->getAttribut("email", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("email", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>");
var <?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?> = document.getElementById("<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>");
$.ajax({
type: "POST",
url: "../../../fachadas/usuarios/UsuariosFacade.Class.php",
data: {
cveUsuario : <?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?> .value=idcveUsuario,
accion : "seleccionar"},
async: true,
dataType: "json",
beforeSend: function(objeto) {
document.getElementById('divUsuarios').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function(datos) {
try {
if (datos.totalCount > 0) {
<?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>.value=datos.data[0].cveUsuario
<?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>.value=datos.data[0].numEmpleado
<?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>.value=datos.data[0].cveAdscripcion
<?php  echo $tagXml->getAttribut("login","id" ); ?>.value=datos.data[0].login
<?php  echo $tagXml->getAttribut("Password","id" ); ?>.value=datos.data[0].Password
<?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>.value=datos.data[0].cveGrupo
<?php  echo $tagXml->getAttribut("paterno","id" ); ?>.value=datos.data[0].paterno
<?php  echo $tagXml->getAttribut("materno","id" ); ?>.value=datos.data[0].materno
<?php  echo $tagXml->getAttribut("nombre","id" ); ?>.value=datos.data[0].nombre
<?php  echo $tagXml->getAttribut("activo","id" ); ?>.value=datos.data[0].activo
<?php  echo $tagXml->getAttribut("telefono","id" ); ?>.value=datos.data[0].telefono
<?php  echo $tagXml->getAttribut("email","id" ); ?>.value=datos.data[0].email
<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>.value=datos.data[0].fechaRegistro
<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>.value=datos.data[0].fechaActualizacion
document.getElementById('divUsuarios').innerHTML = "";
consultaUsuarios();
}else{
alert(datos.text);
document.getElementById('divUsuarios').innerHTML = "";
}
} catch (e) {
alert(datos.text);
document.getElementById('divUsuarios').innerHTML = "";
}
},
error: function(objeto, quepaso, otroobj) {}
});
}
listaAdscripciones = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/adscripciones/AdscripcionesFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divAdscripciones').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveAdscripcion", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveAdscripcion", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveAdscripcion + "'>" + datos.data[index].cveAdscripcion + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divAdscripciones').innerHTML = html;
} catch (e) {
alert(e);
}
},
error: function (objeto, quepaso, otroobj) {
}
});
}
listaGrupos = function (tabIndex) {
$.ajax({
type: "POST",
url: "../../../fachadas/grupos/GruposFacade.Class.php",
data: {accion: "consultar"},
async: true,
dataType: "json",
beforeSend: function (objeto) {
document.getElementById('divGrupos').innerHTML = "<img src='../../img/cargando.gif'/>";
},
success: function (datos) {
try {
var html = "";if (datos.totalCount > 0) {
html += '<select name="<?php echo $tagXml->getAttribut("cveGrupo", "name"); ?>" id="<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>" class="form-control text-uppercase" title="<?php echo $tagXml->getAttribut("cveGrupo", "tooltip"); ?>" data-toggle="tooltip" tabIndex="tabIndex">';
for (var index = 0; index < datos.totalCount; index++) {
html += "<option value='" + datos.data[index].cveGrupo + "'>" + datos.data[index].cveGrupo + "</option>";
}
html += "</select>";
} else {
html = "Sin resultados";
}
document.getElementById('divGrupos').innerHTML = html;
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
<legend>Registro de Usuarios</legend>
<p style="text-align: center;"><div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveUsuario", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveUsuario", "id"); ?>" class="caption" id="cveUsuario"><?php echo $tagXml->getTag("cveUsuario"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("cveUsuario", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveUsuario","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveUsuario","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveUsuario","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveUsuario","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="1">
<script>
$("#<?php  echo $tagXml->getAttribut("cveUsuario","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("numEmpleado", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("numEmpleado", "id"); ?>" class="caption" id="numEmpleado"><?php echo $tagXml->getTag("numEmpleado"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("numEmpleado", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("numEmpleado","name" ); ?>" id="<?php  echo $tagXml->getAttribut("numEmpleado","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("numEmpleado","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("numEmpleado","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="2">
<script>
$("#<?php  echo $tagXml->getAttribut("numEmpleado","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveAdscripcion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveAdscripcion", "id"); ?>" class="caption" id="cveAdscripcion"><?php echo $tagXml->getTag("cveAdscripcion"); ?></label>
<div name="divAdscripciones" id="divAdscripciones">
<input type="<?php echo ($tagXml->getAttribut("cveAdscripcion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveAdscripcion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveAdscripcion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveAdscripcion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveAdscripcion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="3">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveAdscripcion","name" ); ?>").keydown(posValue);
listaAdscripciones(3);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("login", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("login", "id"); ?>" class="caption" id="login"><?php echo $tagXml->getTag("login"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("login", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("login","name" ); ?>" id="<?php  echo $tagXml->getAttribut("login","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("login","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("login","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="4">
<script>
$("#<?php  echo $tagXml->getAttribut("login","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("Password", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("Password", "id"); ?>" class="caption" id="Password"><?php echo $tagXml->getTag("Password"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("Password", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("Password","name" ); ?>" id="<?php  echo $tagXml->getAttribut("Password","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("Password","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("Password","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="5">
<script>
$("#<?php  echo $tagXml->getAttribut("Password","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("cveGrupo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("cveGrupo", "id"); ?>" class="caption" id="cveGrupo"><?php echo $tagXml->getTag("cveGrupo"); ?></label>
<div name="divGrupos" id="divGrupos">
<input type="<?php echo ($tagXml->getAttribut("cveGrupo", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("cveGrupo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("cveGrupo","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("cveGrupo","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("cveGrupo","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="6">
</div>
<script>
$("#<?php  echo $tagXml->getAttribut("cveGrupo","name" ); ?>").keydown(posValue);
listaGrupos(6);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("paterno", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("paterno", "id"); ?>" class="caption" id="paterno"><?php echo $tagXml->getTag("paterno"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("paterno", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("paterno","name" ); ?>" id="<?php  echo $tagXml->getAttribut("paterno","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("paterno","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("paterno","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="7">
<script>
$("#<?php  echo $tagXml->getAttribut("paterno","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("materno", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("materno", "id"); ?>" class="caption" id="materno"><?php echo $tagXml->getTag("materno"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("materno", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("materno","name" ); ?>" id="<?php  echo $tagXml->getAttribut("materno","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("materno","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("materno","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="8">
<script>
$("#<?php  echo $tagXml->getAttribut("materno","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("nombre", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("nombre", "id"); ?>" class="caption" id="nombre"><?php echo $tagXml->getTag("nombre"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("nombre", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("nombre","name" ); ?>" id="<?php  echo $tagXml->getAttribut("nombre","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("nombre","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("nombre","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="9">
<script>
$("#<?php  echo $tagXml->getAttribut("nombre","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("activo", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("activo", "id"); ?>" class="caption" id="activo"><?php echo $tagXml->getTag("activo"); ?></label>
<select name="<?php  echo $tagXml->getAttribut("activo","name" ); ?>" id="<?php  echo $tagXml->getAttribut("activo","id" ); ?>" class="form-control text-uppercase" tabIndex="10" title="<?php  echo $tagXml->getAttribut("activo","tooltip" ); ?>" data-toggle="tooltip" >
<option value="S">SI</option>
<option value="N">NO</option>
</select>
<script>
$("#<?php  echo $tagXml->getAttribut("activo","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("telefono", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("telefono", "id"); ?>" class="caption" id="telefono"><?php echo $tagXml->getTag("telefono"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("telefono", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("telefono","name" ); ?>" id="<?php  echo $tagXml->getAttribut("telefono","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("telefono","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("telefono","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="11">
<script>
$("#<?php  echo $tagXml->getAttribut("telefono","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("email", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("email", "id"); ?>" class="caption" id="email"><?php echo $tagXml->getTag("email"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("email", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("email","name" ); ?>" id="<?php  echo $tagXml->getAttribut("email","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("email","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("email","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" tabIndex="12">
<script>
$("#<?php  echo $tagXml->getAttribut("email","name" ); ?>").keydown(posValue);
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>" class="caption" id="fechaRegistro"><?php echo $tagXml->getTag("fechaRegistro"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaRegistro", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaRegistro","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaRegistro","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaRegistro","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="13">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaRegistro","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaRegistro", "id"); ?>').datetimepicker();
</script>
</div>
<div class="form-group col-lg-12" <?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "style=\"display:none;\"":""; ?> >
<label for="<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>" class="caption" id="fechaActualizacion"><?php echo $tagXml->getTag("fechaActualizacion"); ?></label>
<input type="<?php echo ($tagXml->getAttribut("fechaActualizacion", "hidden")=="true") ? "hidden":"text" ?>" name="<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>" id="<?php  echo $tagXml->getAttribut("fechaActualizacion","id" ); ?>" placeholder="<?php  echo $tagXml->getAttribut("fechaActualizacion","placeholder" ); ?>" title="<?php  echo $tagXml->getAttribut("fechaActualizacion","tooltip" ); ?>" data-toggle="tooltip"  class="form-control text-uppercase" readonly tabIndex="14">
<script>
$("#<?php  echo $tagXml->getAttribut("fechaActualizacion","name" ); ?>").keydown(posValue);
$('#<?php echo $tagXml->getAttribut("fechaActualizacion", "id"); ?>').datetimepicker();
</script>
</div>
</p>
<p style="text-align: center;">
<button type="button" class="btn btn-success" value="Guardar" id="btnUsuariosGuardar" name="btnUsuariosGuardar" onclick="guardarUsuarios()" tabIndex="16" title="Boton para guadar cambios" data-toggle="tooltip" >Guardar</button>
<button type="button"  class="btn btn-default" value="Limpiar" id="btnUsuariosLimpiar" name="btnUsuariosLimpiar" onclick="limpiaUsuarios()" title="Boton para limpiar y realizar un registro nuevo" data-toggle="tooltip">Limpiar</button>
<button type="button"  class="btn btn-info" value="Consultar" id="btnUsuariosConsultar" name="btnUsuariosConsultar" onclick="consultaUsuarios()" title="Boton para consultar informacion" data-toggle="tooltip">Consultar</button>
<button type="button"  class="btn btn-danger" value="Eliminar" id="btnUsuariosEliminar" name="btnUsuariosEliminar" onclick="bajaUsuarios()" title="Boton para eliminar el registro actual" data-toggle="tooltip">Eliminar</button>
<script>
<?php
 if(($permisos["data"][0]->registrar=='N') && ($permisos["data"][0]->modificar=='N'))
 echo "$(\"#btnUsuariosGuardar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->eliminar=='N')
 echo "$(\"#btnUsuariosEliminar\").css(\"display\",\"none\");\n";
?>
<?php
 if($permisos["data"][0]->consulta=='N')
 echo "$(\"#btnUsuariosConsultar\").css(\"display\",\"none\");\n";
?>
</script>
</p>
<div id="divUsuarios" name="divUsuarios" class="table-responsive" width="100%"></div>
<script>
<?php
 if($permisos["data"][0]->consulta=='S')
 echo "consultaUsuarios();\n";
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
