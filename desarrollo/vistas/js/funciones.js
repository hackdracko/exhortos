posValue = function (event) {/*CAMBIO DE FOCO AL PRESIONAR EL ENTER*/
    //if (event.shiftKey)
    //    alert(event.preventDefault());
    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 34) {
    } else if (event.keyCode == 13) {
        try {
            var id = "cmb" + this.id.substring(6, this.id.lentgh);
            var cmb = document.getElementById(id);
            cmb.value = this.value.toUpperCase();
            if (cmb.value == "0") {
                alert("La clave no se encontro");
                document.getElementById(this.id).focus();
                document.getElementById(this.id).select();
            } else {
                var tabIndex = parseInt($(this).attr('tabindex'));
                if ($(':input[tabindex=\'' + (tabIndex + 1) + '\']') != null) {
                    $(':input[tabindex=\'' + (tabIndex + 1) + '\']').focus();
                    $(':input[tabindex=\'' + (tabIndex + 1) + '\']').select();
                    return false;
                }
            }

        } catch (e) {
            var tabIndex = parseInt($(this).attr('tabindex'));
            if ($(':input[tabindex=\'' + (tabIndex + 1) + '\']') != null) {
                $(':input[tabindex=\'' + (tabIndex + 1) + '\']').focus();
                $(':input[tabindex=\'' + (tabIndex + 1) + '\']').select();
                return false;
            }
        }

    }
}

ajustar = function (object) {
    var doc = object.contentDocument ? object.contentDocument
            : object.contentWindow.document;

    var h = getDocHeight(doc);
    h = (h * .2) + h
    object.height = h;//getDocHeight(doc);//+ (getDocHeight(doc) * .2)
//    alert(object.height);
}

getDocHeight = function (doc) {
    doc = doc || document;
    var body = doc.body;
    var html = doc.documentElement;
//    alert("body.offsetHeight: " + body.offsetHeight + " html.clientHeight: " + html.clientHeight + " html.offsetHeight: " + html.offsetHeight + " body.scrollHeight:" +body.scrollHeight  + "html.scrollHeight:" + html.scrollHeight);
    if ((body.offsetHeight > 0) || (html.offsetHeight > 0)) {
        var height = (body.offsetHeight > 0) ? body.offsetHeight : html.offsetHeight;
    } else {
        var height = html.clientHeight;
    }
//    var height = Math.max( body.offsetHeight,
//            html.clientHeight, html.offsetHeight);//body.scrollHeight, html.scrollHeight
//            alert(height);
    return height;
}

jQuery.fn.resetForm = function () {
    $(this).each(function () {
        this.reset();
    });
};

jQuery.fn.Trim = function () {
    var strTexto = $(this).val().replace(/^\s*|\s*$/g, "");
    $(this).val(strTexto);
};

$.urlParam = function (name) {
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1] || 0;
    }
};


    /**
     * Valida la entrada exclusiva para nUmeros
     * @param {object} event Es el objeto del evento en Keypress
     * @return {boolean}  
     */
    function validateNumber(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9) {
            return true;
        } else if ( key < 48 || key > 57 ) {
            return false;
        } else 
            return true;
    };
    /**
    *FunciOn para la correcciOn del formato de fecha
    * @param {datetime} date Recibe la fecha y hora en formato YYYY-MM-DD HH:MM:SS
    * @param {datetime} dateTime Regresa la fecha y hora en formato DD/MM/YYY HH:MM:SS
    */
    function dateFormat(date){
        var dateTime = date.split(' ');
        var tmpDate = dateTime[0].split('-');
        return dateTime = tmpDate[2] + '/' + tmpDate[1] + '/' + tmpDate[0] + ' ' + dateTime[1];
    }

(function (a) {
    a.fn.validaCampo = function (b) {
        a(this).on({keypress: function (a) {
                var c = a.which, d = a.keyCode, e = String.fromCharCode(c).toLowerCase(), f = b;
                (-1 != f.indexOf(e) || 9 == d || 37 != c && 37 == d || 39 == d && 39 != c || 8 == d || 46 == d && 46 != c) && 161 != c || a.preventDefault()
            }})
    }
})(jQuery);

jQuery.fn.mueveScroll = function () {
    $('html,body').animate({scrollTop: Obj.offset().top}, 1000);
};

jQuery.fn.Mayusculas = function () {
    $(this).bind("blur", null, function (e) {
        $(this).val($(this).val().toUpperCase());
    });
};