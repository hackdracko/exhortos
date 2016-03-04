<style type="text/css">
    .mayuscula{  
        text-transform: uppercase;  
    } 
    .requerido {
        color: darkred;
    }
    #accordion .panel-heading{
        background-color: #e9e7e7;
        color: #666666;
    }
    .required{
        color: red;
    }
    .trOpciones{
        cursor: pointer;
    }
    .trOpciones:hover{
        background-color: #e9e7e7;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">                                                            
            Cambio de contrase&ntilde;a
        </h5>
    </div>
    <input type="hidden" id="hddCveFormulario">
    <div class="panel-body">
        <p class="col-lg-12" style="color:darkred;">
            Los campos marcados con (*) son obligatorios.
        </p>
        <div id="divBusquedaEmpleado" class="form-horizontal">
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Contrase&ntilde;a anterior <span class="requerido">(*)</span></label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="txtPassAnterior" placeholder="Contrase&ntilde;a anterior">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Contrase&ntilde;a nueva <span class="requerido">(*)</span></label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="txtPassNueva" placeholder="Contrase&ntilde;a nueva">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="caption control-label col-md-4 needed" id="">Confirmar constrase&ntilde;a nueva <span class="requerido">(*)</span></label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="txtConfirmPassNueva" placeholder="Contrase&ntilde;a nueva">
                </div>
            </div>
            <div class="col-lg-12" id=""><br></div>
            <div class="form-group">
                <div class="caption control-label col-md-6 needed">                                 
                    <input type="submit" class="btn btn-primary" value="Cambiar contrase&ntilde;a" onclick="cambiaPass();">                                                                                                          
                    <input type="submit" class="btn btn-primary" value="Limpiar" onclick="limpiar();">                                    
                </div>
            </div>
            <div class="form-group" >
                <div id="divAlertWarningFormUsuario" class="alert alert-warning alert-dismissable" style="display:none;">                    
                    <strong>Advertencia!</strong> Mensaje
                </div>
                <div id="divAlertSuccesFormUsuario" class="alert alert-success alert-dismissable" style="display:none;">

                    <strong>Correcto!</strong> Mensaje
                </div>
                <div id="divAlertDagerFormUsuario" class="alert alert-danger alert-dismissable" style="display:none;">

                    <strong>Error!</strong> Mensaje
                </div>
                <div id="divAlertInfoFormUsuario" class="alert alert-info alert-dismissable" style="display:none;">

                    <strong>Informaci&oacute;n!</strong> Mensaje
                </div>
            </div>
        </div>
        <!--
        DIV DE MENSAJES
        -->


    </div>
</div>
<script type="text/javascript">
    validate = function () {
        $(".required").remove();
        var error = false;
        if ($('#txtPassAnterior').val() == "" || $('#txtPassAnterior').val() == "0") {
            $('#txtPassAnterior').focus();
            $('#txtPassAnterior').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese la contrase&ntilde;a anterior</label>");
            error = true;
        }
        if ($('#txtPassNueva').val() == "" || $('#txtPassNueva').val() == "0") {
            $('#txtPassNueva').focus();
            $('#txtPassNueva').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese la contrase&ntilde;a nueva</label>");
            error = true;
        }
        if ($('#txtConfirmPassNueva').val() == "" || $('#txtConfirmPassNueva').val() == "0") {
            $('#txtConfirmPassNueva').focus();
            $('#txtConfirmPassNueva').parent().append("<br class='required'><label class='Arial13Rojo required'>Ingrese la confirmaci&oacute;n de la contrase&ntilde;a nueva</label>");
            error = true;
        }
        if (($('#txtPassNueva').val() != "" || $('#txtPassNueva').val() != "0") && ($('#txtConfirmPassNueva').val() != "" || $('#txtConfirmPassNueva').val() != "0")) {
            if ($('#txtPassNueva').val() != $('#txtConfirmPassNueva').val()) {
                $('#txtConfirmPassNueva').focus();
                $('#txtConfirmPassNueva').parent().append("<br class='required'><label class='Arial13Rojo required'>La confirmaci&oacute;n de la contrase&ntilde;a no coincide. Verifique.</label>");
                error = true;
            }
        }
        return error;
    };

    cambiaPass = function () {
        $(".required").remove();
        var error = false;
        if (!validate()) {
            $.ajax({
                type: "POST",
                url: "../fachadas/exhortos/usuarios/UsuariosFacade.Class.php",
                async: false,
                dataType: "json",
                data: {accion: "cambioPassword",
                    passAnterior: $('#txtPassAnterior').val(),
                    passNueva: $('#txtPassNueva').val()
                },
                beforeSend: function (objeto) {
                },
                success: function (datos) {
                    if (datos.status == 'ok') {
                        $("#divAlertSuccesFormUsuario").html("");
                        $("#divAlertSuccesFormUsuario").html("La contrase&ntilde;a se ha modificado correctamente..");
                        $("#divAlertSuccesFormUsuario").show("");
                        setTimeAlert("divAlertSuccesFormUsuario");
                    } else {
                        $("#divAlertWarningFormUsuario").html("");
                        $("#divAlertWarningFormUsuario").html(datos.mnj);
                        $("#divAlertWarningFormUsuario").show("");
                        setTimeAlert("divAlertWarningFormUsuario");
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    alert("Error en la peticion de Consulta de Audiencia:\n\n" + otroobj);
                }
            });
        } else {
            error = false;
        }
        return error;
    };

    limpiar = function () {
        $(".required").remove();
        $("#txtPassAnterior").val("");
        $("#txtPassNueva").val("");
        $("#txtConfirmPassNueva").val("");
    };

    $(function () {

    });

</script>