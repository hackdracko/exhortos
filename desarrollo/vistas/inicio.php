<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fechahoy = date("d/m/y");
//echo $_SESSION["cveAdscripcion"];
if ((isset($_SESSION["cveUsuarioSistema"])) && (!empty($_SESSION["cveUsuarioSistema"]))) {
    ?>
    <!doctype html>
    <html>
        <head>            
            <meta name="description" content="Dashboard" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

            <title>EXORTOS ELECTR&Oacute;NICOS</title>       

            <link type="text/css" href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet" />  
            <link type="text/css" href="css/font-awesome.min.css" rel="stylesheet" />
            <link type="text/css" href="css/weather-icons.min.css" rel="stylesheet" />
            <link type="text/css" href="css/beyond.min.css" rel="stylesheet" type="text/css" />        
            <link type="text/css" href="css/typicons.min.css" rel="stylesheet" />
            <link type="text/css" href="css/animate.min.css" rel="stylesheet" />        
            <link type="text/css" href="css/dataTables.bootstrap.css" rel="stylesheet" />                
            <link type="text/css" href="css/loadercss.css" rel="stylesheet" />
            <link rel="stylesheet" href="css/jquery-ui.css">        
            <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />                    
            <link type="text/css" href="css/iconfont/style.css" rel="stylesheet" />                    
            <link type="text/css" href="js/jstree/src/themes/default/style.css" rel="stylesheet" />                    

            <style type="text/css">
                #divImgFotoUsr{
                    width: 45px;
                    height: 45px;
                    border-radius: 35px;
                    border: solid 1px;
                    background: #FF0000;
                }
                .control-label{                
                    color: #23473f;
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
                .divUserData{
                    float: left;
                    margin-top: 5px;
                    margin-bottom: 10px;
                    margin-right: 15px;
                    padding: 5px;
                    height: 43px;
                }

                .spanLblInfo{
                    text-align: center;
                    height: 43px;
                    font-family: Arial;
                    /*font-size: 12px;*/
                    font-size: 15px;
                    font-weight: bold;
                    margin-top: auto;
                    margin-bottom: auto;
                    vertical-align: central;
                    line-height: 35px;
                }


                .modal-footer{
                    border: 0px;
                    background: #FFFFFF;
                }


                .select2-hidden-accessible  {
                    display: none;
                }


            </style>

        </head>
        <body style="background: url(img/imgFondo.jpg); background-repeat: no-repeat; background-position: right; background-size: auto;">
            <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-header pull-left">
                        <a href="#" class="navbar-brand">
                            <small>
                                <img src="img/logoPj.png" alt="" id="logo_empresa"/>
                            </small>
                        </a>
                    </div>
                </div>
                <div class="navbar-collapse collapse">
                    <div id="divMenu">
                    </div>                    
                </div>

                <div class="navbar-collapse collapse">
                    <div style="margin-left: auto; margin-right: auto; background-color: #868686; width: 100%; border: solid 1px;">
                        <div class='divUserData'>
                            <span class="spanLblInfo">                            
                                Usuario
                            </span>
                            <span id="spanUsuarioSession">                            
                                <?php echo @$_SESSION["nombre"]; ?>
                            </span>
                        </div>
                        <div class='divUserData'>
                            <span class="spanLblInfo">                            
                                Adscripci&oacute;n
                            </span>
                            <span id="spanAdscripcionSession">                            
                                <?php echo @$_SESSION["desAdscripcion"]; ?>
                            </span>
                        </div>
                        <div class='divUserData'>
                            <span class="spanLblInfo">                            
                                Fecha
                            </span>
                            <span>                            
                                <?php echo $fechahoy; ?>
                            </span>
                        </div>
                        <div class='divUserData'>
                            <span class="spanLblInfo">                            
                                Perfil
                            </span>
                            <span id="spanCmbPerfiles">
                            </span>
                        </div>
                    </div>
                </div>      

                <div class="main-container container-fluid" style="margin-top: 15px;">
                    <div id="divHideForm">
                        <div id="divMenssage">
                            Por favor espere
                        </div>
                        <div id="divImgloading"></div>
                    </div>
                    <div class="page-container" id="areadetrabajo">                
                        <!--<div class="page-content" id="areadetrabajo">-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">                                                            
                                    Bienvenido     
                                </h5>
                            </div>
                            <div class="panel-body" id="divPerfilesReview" >                                                                    
                            </div>
                        </div>
                        <!--</div>-->                
                    </div>
                </div>

                <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>                       
                <script type="text/javascript" src="js/jquery-ui-1.11.14.js"></script>
                <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>                         
                <script type="text/javascript" src="js/bootstrap.min.js"></script>
                <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
                <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>
                <script type="text/javascript" src="js/datatable/jquery.dataTables.js"></script>
                <script type="text/javascript" src="js/datatable/dataTables.tableTools.js"></script>
                <script type="text/javascript" src="js/datatable/dataTables.bootstrap.js"></script>
                <script type="text/javascript" src="js/funciones.js"></script>                                                
                <script type="text/javascript" src="js/datetimepicker/moment-with-locales.js"></script><!--/*---*/-->
                <script type="text/javascript" src="js/datetime/bootstrap-datepicker.js"></script><!--/*---*/-->                        
                <script type="text/javascript" src="js/datetimepicker/bootstrap-datetimepicker.js"></script><!--/*---*/-->
                <script type="text/javascript" src="js/datetime/bootstrap-timepicker.js"></script>                        
                <script type="text/javascript" src="js/select2/select2.js"></script>
                <script type="text/javascript" src="js/datetimepicker/moment-with-locales.js"></script>
                <script type="text/javascript" src="js/datetime/bootstrap-datepicker.js"></script>
                <script type="text/javascript" src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
                <script type="text/javascript" src="js/datetime/bootstrap-timepicker.js"></script>
                <script type="text/javascript" src="js/datetime/bootstrap-timepicker.min.js"></script>
                <script type="text/javascript" src="js/select2/select2.js"></script>
                <script type="text/javascript" src="js/fullcalendar/fullcalendar.js"></script>
                <script type="text/javascript" src="js/jstree/src/jstree.js"></script>
                <script type="text/javascript" src="js/bootbox/bootbox.js"></script>

                <script type="text/javascript">

                    $(document).ajaxStart(function () {
                        ToggleLoading(1);
                    });
                    $(document).ajaxStop(function () {
                        ToggleLoading(2);
                    });
                    getPerfiles = function () {
                        var url = "../archivos/<?php echo $_SESSION["cveUsuarioSistema"]; ?>.json";
                        $.getJSON(url, function (json) {
                            if (json !== "") {
                                $("#spanUsuarioSession").html(json.paterno + " " + json.materno + " " + json.nombre);
                                var lenPerfiles = json.perfiles.length;
                                if (lenPerfiles > 0) {
                                    var html = "";
                                    if (json.perfiles[0].totPerfiles.toString() === "1") {
                                        getMenu(json.perfiles[0].perfil[0].cvePerfil);
                                        setSessions(json.perfiles[0].perfil[0].cvePerfil);

                                        $("#spanCmbPerfiles").html(json.perfiles[0].perfil[0].desGrupo + " | " + json.perfiles[0].perfil[0].desAdscripcion);
                                    } else {
                                        var totPerfilesShow = json.perfiles[0].totPerfiles;
                                        var cmb = '<select onchange="if (this.value !== \'\') {getMenu(this.value);setSessions(this.value);}">';
                                        cmb += "<option value=''>---SELECCIONE---</option>";
                                        for (var i = 0; i < totPerfilesShow; i++) {

                                            cmb += "<option value='" + json.perfiles[0].perfil[i].cvePerfil + "'><b>" + json.perfiles[0].perfil[i].desGrupo + "</b> - " + json.perfiles[0].perfil[i].desAdscripcion + "</option>";

                                            if ((i % 2) === 0) {
                                                html += "<div class='divPerfil1' onclick='getMenu(" + json.perfiles[0].perfil[i].cvePerfil + ");setSessions(" + json.perfiles[0].perfil[i].cvePerfil + ");' >";
                                            } else {
                                                html += "<div class='divPerfil2' onclick='getMenu(" + json.perfiles[0].perfil[i].cvePerfil + ");setSessions(" + json.perfiles[0].perfil[i].cvePerfil + ");' >";
                                            }
                                            html += "<table>";
                                            html += "<td><span class='icon-users' style='font-size:25px; margin:5px;'></span>Grupo</td>";
                                            html += "</tr>";
                                            html += "<tr>";
                                            html += "<td><b>" + json.perfiles[0].perfil[i].desGrupo + "</b></td>";
                                            html += "</tr>";
                                            html += "<tr>";
                                            html += "<td><span class='icon-library' style='font-size:25px; margin:5px;'></span>Adscripci&oacute;n</td>";
                                            html += "</tr>";
                                            html += "<tr>";
                                            html += "<td><b>" + json.perfiles[0].perfil[i].desAdscripcion + "<b></td>";
                                            html += "</tr>";
                                            html += "</table>";
                                            html += "</div>";
                                        }

                                        cmb += "</select>";

                                        $("#spanCmbPerfiles").html(cmb);

                                        $("#divPerfilesReview").html(html);
                                        $(".divPerfil1").css({
                                            width: "250px",
                                            height: "150px",
                                            border: "1px solid",
                                            float: "left",
                                            margin: "5px",
                                            padding: "10px",
                                            background: "#666666",
                                            color: "#f9f9f9"
                                        });
                                        $(".divPerfil2").css({
                                            width: "250px",
                                            height: "150px",
                                            border: "1px solid",
                                            float: "left",
                                            margin: "5px",
                                            padding: "10px",
                                            background: "#868686",
                                            color: "#f9f9f9"
                                        });

                                        $(".divPerfil1").hover(function () {
                                            $(this).css({cursor: "pointer", background: "#9b9b9b"});
                                        }, function () {
                                            $(this).css({
                                                width: "250px",
                                                height: "150px",
                                                border: "1px solid",
                                                float: "left",
                                                margin: "5px",
                                                padding: "10px",
                                                background: "#666666",
                                                color: "#f9f9f9"
                                            });
                                        });
                                        $(".divPerfil2").hover(function () {
                                            $(this).css({cursor: "pointer", background: "#9b9b9b"});
                                        }, function () {
                                            $(this).css({
                                                width: "250px",
                                                height: "150px",
                                                border: "1px solid",
                                                float: "left",
                                                margin: "5px",
                                                padding: "10px",
                                                background: "#868686",
                                                color: "#f9f9f9"
                                            });
                                        });
                                    }
                                }
                            }
                        });
                    };
                    loadOpcion = function (url, div) {
                        if (url != "#noir") {
                            $.post(url, function (htmlexterno) {
                                $("#" + div).html(htmlexterno);
                            });
                        }
                    };

                    setSessions = function (cvePerfil) {
                        $.post("../tribunal/session/Sessions.php", {cvePerfil: cvePerfil}, function (json) {
                            if (json !== "") {
                                alert(json);
                            }
                        });

    //limpiar frm cuando cambie de session                    loadOpcion("","areadetrabajo");                        
                    };

                    getMenu = function (cvePerfil) {
                        var url = "../archivos/<?php echo $_SESSION["cveUsuarioSistema"]; ?>.json";
                        var divMenu = $('#divMenu');
                        $.getJSON(url, function (json) {
                            if (json !== "") {
                                var html = "";
                                html += "<ul class=\"nav navbar-nav\" id=\"ulMenuPrincipal\">";
                                html = buildMenu(json, html, false, cvePerfil);
                                html += "</ul>";
                                $('#divMenu').html(html);
                                $('#ulMenuPrincipal').smartmenus();
                                $("#divPerfilesReview").hide("");
                            }
                        });
                    }


                    function setTimeAlert(div) {
                        setTimeout(function () {
                            $("#" + div).hide("slide");
                        }, 4000);
                    }

                    buildMenu = function (json, html, hijo, cvePerfil) {
                        try {
                            if (hijo == false) { //loadOpcion
                                for (var index = 0; index < json.perfiles[0].totPerfiles; index++) {
                                    if (json.perfiles[0].perfil[index].cvePerfil.toString() === cvePerfil.toString()) {
                                        $("#spanAdscripcionSession").html(json.perfiles[0].perfil[index].desAdscripcion);
                                        for (var x = 0; x < json.perfiles[0].perfil[index].permisos.length; x++) {
                                            html += "<li ";
                                            if (typeof json.perfiles[0].perfil[index].permisos[x].hijos != "undefined") {
                                                if (json.perfiles[0].perfil[index].permisos[x].hijos.length > 0) {
                                                    html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json.perfiles[0].perfil[index].permisos[x].archivo + "','areadetrabajo')\">" + json.perfiles[0].perfil[index].permisos[x].nomFormulario;
                                                    html += "<span class=\"caret\"></span></a>";
                                                    html += "<ul class=\"dropdown-menu\">";
                                                    html = buildMenu(json.perfiles[0].perfil[index].permisos[x].hijos, html, true, cvePerfil);
                                                    html += "</ul>";
                                                    html += "</li>";
                                                } else {
                                                    html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json.perfiles[0].perfil[index].permisos[x].archivo + "','areadetrabajo')\">" + json.perfiles[0].perfil[index].permisos[x].nomFormulario;
                                                    html += "</a></li>";
                                                }
                                            } else {
                                                html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json.perfiles[0].perfil[index].permisos[x].archivo + "','areadetrabajo')\">" + json.perfiles[0].perfil[index].permisos[x].nomFormulario;
                                                html += "</a></li>";
                                            }
                                        }
                                    }
                                }
                            } else if (hijo == true) {
                                for (var index = 0; index < json.length; index++) {
                                    html += "<li ";
                                    if (typeof json[index].hijos != "undefined") {
                                        if (json[index].hijos.length > 0) {
                                            html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json[index].archivo + "','areadetrabajo')\">" + json[index].nomFormulario;
                                            html += "<span class=\"caret\"></span></a>";
                                            html += "<ul class=\"dropdown-menu\">";
                                            html = buildMenu(json[index].hijos, html, true);
                                            html += "</ul>";
                                            html += "</li>";
                                        } else {
                                            html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json[index].archivo + "','areadetrabajo')\">" + json[index].nomFormulario;
                                            html += "</a></li>";
                                        }
                                    } else {
                                        html += "><a href=\"#noir\" onclick=\"loadOpcion('" + json[index].archivo + "','areadetrabajo')\">" + json[index].nomFormulario;
                                        html += "</a></li>";
                                    }
                                }
                            }
                        } catch (e) {
                            alert(e);
                        }
                        return html;
                    }

                    ToggleLoading = function (opc) {
                        if (opc === 1) {
                            $("#divHideForm").show("slide");
                        } else if (opc === 2) {
                            $("#divHideForm").hide("fade");
                        }
                    }
                    $(function () {
                        getPerfiles();
                        //                            getMenu();
                        $('[data-toggle="tooltip"]').tooltip();
                    });
                    changeDivForm = function (opc) {
                        if (opc === 1) {
                            $("#divFormulario").show("slide");
                            $("#divConsulta").hide("fade");
                        } else if (opc === 2) {
                            $("#divFormulario").hide("fade");
                            $("#divConsulta").show("slide");
                        }
                    };</script>

                <style type="text/css">
                    #divImgFotoUsr{
                        width: 45px;
                        height: 45px;
                        border-radius: 35px;
                        border: solid 1px;
                        background: #FF0000;

                        .control-label{                
                            color: #23473f;
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

                        .divPerfil1{
                            width: 250px; 
                            height: 150px; 
                            border: 1px solid; 
                            float: left; 
                            margin: 5px; 
                            padding: 10px;
                            background: #666666; 
                            color:#f9f9f9;
                        }

                        .divPerfil2{
                            width: 250px; 
                            height: 150px; 
                            border: 1px solid; 
                            float: left; 
                            margin: 5px; 
                            padding: 10px;
                            background: #868686; 
                            color:#f9f9f9;
                        }

                    </style>

            </body>
        </html>
        <?php
    } else {
        ?>
        <!doctype html>
        <html>
            <head>            
                <meta name="description" content="Dashboard" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link rel="shortcut icon" href="img/logoColorPJEM.png" type="image/x-icon">

                <title>EXORTOS ELECTR&Oacute;NICOS</title>       

                <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />        
                <link type="text/css" href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet" />  
                <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />        
                <link type="text/css" href="css/font-awesome.min.css" rel="stylesheet" />
                <link type="text/css" href="css/weather-icons.min.css" rel="stylesheet" />
                <link type="text/css" href="css/beyond.min.css" rel="stylesheet" type="text/css" />        
                <link type="text/css" href="css/typicons.min.css" rel="stylesheet" />
                <link type="text/css" href="css/animate.min.css" rel="stylesheet" />        
                <link type="text/css" href="css/dataTables.bootstrap.css" rel="stylesheet" />                
                <link type="text/css" href="css/loadercss.css" rel="stylesheet" />

                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">        

                <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
                <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                <script src="js/jquery-ui-1.10.4.custom.js"></script>        
                <script type="text/javascript" src="js/bootstrap.min.js"></script>
                <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
                <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>
                <script type="text/javascript" src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
                <script type="text/javascript" src="js/datatable/jquery.dataTables.js"></script>
                <script type="text/javascript" src="js/datatable/dataTables.tableTools.js"></script>
                <script type="text/javascript" src="js/datatable/dataTables.bootstrap.js"></script>

                <style type="text/css">
                    #divImgFotoUsr{
                        width: 45px;
                        height: 45px;
                        border-radius: 35px;
                        border: solid 1px;
                        background: #FF0000;
                    }
                </style>

                <script type="text/javascript">
                    ToggleLoading = function (opc) {
                        if (opc === 1) {
                            $("#divHideForm").show("slide");
                        } else if (opc === 2) {
                            $("#divHideForm").hide("fade");
                        }
                    };
                </script>

                <style>
                    .control-label{                
                        color: #23473f;
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

                </style>
            </head>
            <body>

                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">

                        <div class="navbar-header pull-left">
                            <a href="#" class="navbar-brand">
                                <small>
                                    <img src="img/logoPj.png" alt="" id="logo_empresa"/>
                                </small>
                            </a>                            
                        </div>
                    </div>

                    <div class="navbar-collapse collapse">                        
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>                    
                </div>      

                <div class="main-container container-fluid">
                    <div id="divHideForm">
                        <div id="divMenssage">
                            Por favor espere
                        </div>
                        <div id="divImgloading"></div>
                    </div>
                    <div class="page-container" id="areadetrabajo">                
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">                                                            
                                    Sesi&oacute;n fallida
                                </h5>
                            </div>
                            <div class="panel-body">

                                <div id="divFormulario" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" >&times;</button><!--data-dismiss="alert"-->
                                            <strong>Error!</strong> No inicio ses&oacute;n de forma correcta
                                        </div>
                                    </div>  
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>

            </body>
        </html>
    <?php } ?>
