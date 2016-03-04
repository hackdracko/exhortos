<?php
	$id = addslashes($_GET["id"]);
?>
<!doctype html>
<html>
    <head>            
        <meta name="description" content="Dashboard" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>EXHORTOS</title>       

        <link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet" />        
        <link type="text/css" href="../../css/jquery.smartmenus.bootstrap.css" rel="stylesheet" />  
        <link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet" />        
        <link type="text/css" href="../../css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/weather-icons.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/beyond.min.css" rel="stylesheet" type="text/css" />        
        <link type="text/css" href="../../css/typicons.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/animate.min.css" rel="stylesheet" />        
        <link type="text/css" href="../../css/dataTables.bootstrap.css" rel="stylesheet" />                
        <link type="text/css" href="../../css/loadercss.css" rel="stylesheet" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">        

        <script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="../../js/jquery-ui-1.10.4.custom.js"></script>        
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <style>
            body {
                /* el tamaño por defecto es 14px */
                font-size: 156px;
            }
            .border{
                -moz-box-shadow: 0 0 2px black;
                -webkit-box-shadow: 0 0 2px black;
                box-shadow: 0 0 2px black;
            }
        </style>


        <script type="text/javascript">
            exhorto = function () {
                var idExhorto = <?php echo $id; ?>;
                var partes = "";
                $.ajax({
                    type: "POST",
                    url: "../../../fachadas/exhortos/exhortos/ExhortosFacade.Class.php",
                    async: false,
                    dataType: "json",
                    data: {accion: "consultarReporte", idExhorto: idExhorto, activo: "S"},
                    beforeSend: function (objeto) {
                    },
                    success: function (datos) {
                        try {
                        	$.each(datos, function (key, val) {
                                $("#numExhorto").html(val.numExhorto+"/"+val.aniExhorto);
                                $("#numPromocion").html(val.numPromocion+"/"+val.aniPromocion);
                                $("#numCausa").html(val.numeroExp+"/"+val.anioExp);
                                $("#numOficio").html(val.numOficio);
                                $("#carpInv").html(val.carpetaInv);
                                if(val.cveJuzgadoProcedencia.cveJuzgado != ""){
                                    $("#procedencia").html(val.cveJuzgadoProcedencia.desJuzgado);
                                }else{
                                    $("#procedencia").html(val.juzgadoProcedencia);
                                }
                                $("#destino").html(val.juzgadoDestino.desJuzgado);
                                $("#fechaAlta").html(val.fechaAlta);
                                $("#sintesis").html(val.sintesis);
                                $("#observaciones").html(val.observaciones);
                                $.each(val.partes, function (keyPartes, valPartes) {
                                    if(valPartes.cveTipoPersona == 1){
                                        partes += '<div class="col-xs-12">';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Tipo Persona:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>'+valPartes.desTipoPersona+'</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Tipo Parte:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>'+valPartes.desTipoParte+'</p>';
                                            partes += '</div>';
                                        partes += '</div>';
                                        partes += '<div class="col-xs-12">';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Nombre:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-9">';
                                                partes += '<p>'+valPartes.nombre+' '+valPartes.paterno+' '+valPartes.materno+'</p>';
                                            partes += '</div>';
                                        partes += '</div>';
                                    }else{
                                        partes += '<div class="col-xs-12">';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Tipo Persona:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>'+valPartes.desTipoPersona+'</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Tipo Parte:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>'+valPartes.desTipoParte+'</p>';
                                            partes += '</div>';
                                        partes += '</div>';
                                        partes += '<div class="col-xs-12">';
                                            partes += '<div class="col-md-3">';
                                                partes += '<p>Nombre:</p>';
                                            partes += '</div>';
                                            partes += '<div class="col-md-9">';
                                                partes += '<p>'+valPartes.nombrePersonaMoral+'</p>';
                                            partes += '</div>';
                                        partes += '</div>';
                                    }
                                });
                        	});
                        } catch (e) {
                            alert("Error al cargar Datos de la Audiencia:" + e);
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error en la peticion Datos de la Audiencia:\n\n" + otroobj);
                    }
                });
                $("#partes").html(partes);
            };
			imprimirER = function () {
		        w = window.open("", 'Print_Page', 'scrollbars=yes');
		        w.document.write($('#reporte').html());
		        w.document.close();
		        w.print();
		        w.close();
			};
            $(function () {
            	exhorto();
            });
        </script>

    </head>
    <body>    

        <div class="main-container container-fluid">
        	<button type="button" name="imprimir" id="imprimir" onclick="imprimirER();">IMPRIMIR</button>
        	<input type="hidden" id="idSolicitud" name="idSolicitud"></input>
            <div id="reporte">
                <div class="page-container" id="areadetrabajo">                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-4">
                                        <img src="../../img/EscudoEstadoMexico.png" height="90" width="90"></img>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <img src="../../img/PJ-Leyenda-2.png" height="90" width="250"></img>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="divFormulario" class="form-horizontal">
    				        <link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet" media="all"/>
    				        <link type="text/css" href="../../css/print.css" rel="stylesheet" media="all" />
                                <h3>Comprobante de Exhorto</h3>
    							<div class="col-xs-12 border">
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Número Exhorto:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="numExhorto"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Fecha de Alta:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="fechaAlta"></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Número de Expediente</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="numCausa"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Procedencia:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="procedencia"></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Número de Oficio:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="numOficio"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Destino:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="destino"></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Número de Promocion:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="numPromocion"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Carpeta Investigación:</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p id="carpInv"></p>
                                        </div>
                                    </div>
    							</div>
                                <div class="clearfix"></div>
                                <div class="col-xs-12 border">
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Sintesis:</p>
                                        </div>
                                        <div class="col-md-9">
                                            <p id="sintesis"></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-3">
                                            <p>Observaciones:</p>
                                        </div>
                                        <div class="col-md-9">
                                            <p id="observaciones"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="partes" class="col-xs-12 border">
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
