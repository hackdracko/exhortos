<?php
@session_start();
date_default_timezone_set('America/Mexico_City');
$_SESSION = array();
$_SESSION["cveSistema"] = 38;
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>EXHORTOS ELECTR&Oacute;NICOS</title>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />


        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slimscroll/jquery.slimscroll.min.js"></script>

        <style type="text/css">
            /*
                * Specific styles of signin component
                */
            /*
             * General styles
             */
            body, html {
                height: 100%;
                background: #EEEEEE;
                /*background-repeat: no-repeat;*/
                /*background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
            }

            .card-container.card {
                max-width: 350px;
                padding: 40px 40px;
            }

            .btn {
                font-weight: 700;
                height: 36px;
                -moz-user-select: none;
                -webkit-user-select: none;
                user-select: none;
                cursor: default;
            }

            /*
             * Card component
             */
            .card {
                background-color: #F7F7F7;
                /* just in case there no content*/
                padding: 20px 25px 30px;
                margin: 0 auto 25px;
                margin-top: 50px;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }

            .profile-img-card {
                /*width: 96px;*/
                /*height: 96px;*/
                margin: 0 auto 10px;
                display: block;
                /*-moz-border-radius: 50%;*/
                /*-webkit-border-radius: 50%;*/
                /*border-radius: 50%;*/
            }

            /*
             * Form styles
             */
            .profile-name-card {
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                margin: 10px 0 0;
                min-height: 1em;
            }

            .reauth-email {
                display: block;
                color: #404040;
                line-height: 2;
                margin-bottom: 10px;
                font-size: 14px;
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .form-signin #txtPassword,
            .form-signin #txtUsuario {
                direction: ltr;
                height: 44px;
                font-size: 16px;
            }

            .form-signin input[type=email],
            .form-signin input[type=password],
            .form-signin input[type=text],
            .form-signin button {
                width: 100%;
                display: block;
                margin-bottom: 10px;
                z-index: 1;
                position: relative;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .form-signin .form-control:focus {
                border-color: rgb(104, 145, 162);
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            }

            .btn.btn-signin {
                /*background-color: #4d90fe; */
                background-color: #427468;
                /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
                padding: 0px;
                font-weight: 700;
                font-size: 14px;
                height: 36px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                border: none;
                -o-transition: all 0.218s;
                -moz-transition: all 0.218s;
                -webkit-transition: all 0.218s;
                transition: all 0.218s;
                color: #F7F7F7;
            }

            .btn.btn-signin:hover,
            .btn.btn-signin:active,
            .btn.btn-signin:focus {
                background-color: #90c3b7;
                cursor: pointer;
            }

            .forgot-password {
                color: rgb(104, 145, 162);
            }

            .forgot-password:hover,
            .forgot-password:active,
            .forgot-password:focus{
                color: rgb(12, 97, 33);
            }

            #divTitulo{
                width: 100%;
                text-align: center;
                background-color: #427468;
                padding-top: 10px;
                padding-bottom: 10px;
                height: auto;
                font-size: 25px;
                color: #FFFFFF;
            }

            #divFoot{
                position: fixed;
                bottom: 0px;
                width: 100%;
                text-align: right;
                background-color: #427468;
                padding-top: 10px;
                padding-bottom: 10px;
                height: auto;
                font-size: 14px;
                color: #FFFFFF;
            }

            body{
                margin: 0px;
                padding: 0;
                font-family: Arial;
            }
        </style>

        <script type="text/javascript">
            $('#txtUsuario').focus();

            $("#txtUsuario").keypress(function (e) {
                if (e.which === 13) {
                    if ($("#txtUsuario").val() !== "")
                    {
                        $("#txtPassword").focus();
                    }
                }
            });

            $("#txtPassword").keypress(function (e) {
                if (e.which === 13) {
                    $('#btnIngresar').click();
                }
            });



            $(function () {
                $('#btnIngresar').on('click', function () {
                    var txtUsuario = $.trim($('#txtUsuario').val());
                    var txtPassword = $.trim($('#txtPassword').val());
                    if (txtUsuario !== "" && txtPassword !== "") {
                        login();
                    } else {
                        $("#divErrorMnj").html("Por favor ingrese usuario y/o contrase&ntilde;a.");
                        $("#divErrorMnj").show("fade");
                    }

                });
            });


            login = function () {
                $.post("../fachadas/exhortos/login/LoginFacade.Class.php", {usuario: $.trim($('#txtUsuario').val()), password: $.trim($('#txtPassword').val())},
                function (result) {
                    if (result !== "") {
                        var jsonResult = eval("(" + result + ")");
                        if (jsonResult.estatus === "ok") {
                            $(location).attr('href', jsonResult.location);
                        } else {
                            $("#divErrorMnj").html("Usuario o contrase&ntilde;a incorrecta");
                            $("#divErrorMnj").show("fade");
                        }
                    }
                });
            };

        </script>


    </head>
    <body>        
        <div id="divTitulo">SISTEMA DE EXHORTOS ELECTR&Oacute;NICOS</div>
        <div class="card card-container">                
            <img id="profile-img" class="profile-img-card" src="img/logoPj.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <br/>                
            <div class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="txtUsuario" class="form-control" placeholder="Usuario" value="" required autofocus>
                <input type="password" id="txtPassword" class="form-control" placeholder="Contrase&ntilde;a" value="" required>
                <br/>                
                <div id="divErrorMnj" class="alert alert-danger" style="display: none; text-align: center" onclick="$('#divErrorMnj').hide('flip');">                    
                </div>
                <br/>                                
                <button id="btnIngresar" class="btn btn-lg btn-primary btn-block btn-signin" >Entrar</button>
            </div> 
            <br/>
            <br/>
            <a href="#" class="forgot-password">                
            </a>
        </div>
        <div id="cargando_sesion"></div>
        <div id="divFoot">Poder Judicial del Estado de M&eacute;xico, 2016</div>        
    </body>
</html>
