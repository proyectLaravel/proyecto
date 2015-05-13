var base_url = 'http://172.16.71.230/authLaravelSimple/public/';
/*Necesario para el spinner*/
var opts = {
    lines: 15, // The number of lines to draw
    length: 17, // The length of each line
    width: 25, // The line thickness
    radius: 50, // The radius of the inner circle
    corners: 1, // Corner roundness (0..1)
    rotate: 64, // The rotation offset
    direction: 1, // 1: clockwise, -1: counterclockwise
    color: '#1976D2', // #rgb or #rrggbb or array of colors
    speed: 2, // Rounds per second
    trail: 48, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: false, // Whether to use hardware acceleration
    className: 'spinner', // The CSS class to assign to the spinner
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    top: '50%', // Top position relative to parent
    left: '50%' // Left position relative to parent
};
/*Necesario para el spinner*/

function loadSpinner() {
    //var target = $('#eliminar');
    var target = document.getElementById('spin');
    var spinner = new Spinner(opts).spin(target);
}

$(document).ready(function() {
    getUsers();
    getTasks();
    getTasksSuperAdmin();
    listUsers();
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("form").submit(function(event) {
        var target = document.getElementById('asignarTarea');
        var target1 = document.getElementById('updateUser');
        var target2 = document.getElementById('registrarUsuario');
        var spinner = new Spinner(opts).spin(target);
        var spinner1 = new Spinner(opts).spin(target1);
        var spinner2 = new Spinner(opts).spin(target2);
    });
});

function showView(id, clases) {
    //console.debug(id+'    '+ clases);

    $('.' + clases).hide();
    $('#' + id).show();
}

function addClassActive(id) {
    $('.nav-sidebar > li').removeClass('active');
    $('.nav-sidebar > li#' + id).addClass('active');
}

function getUsers() {
    //console.debug('va a cambiar');
    $.ajax({
        type: "GET",
        url: base_url + "getUsers",
        success: function(data) {
            //console.log(data);
            var model = $('#usuarios');
            model.empty();
            for (var i in data.users) {
                var item = data.users[i];
                model.append("<option value='" + item.id + "'>" + item.first_name + "</option>");
            }
        }
    });
}

function getTasks() {
    //console.debug('va a cambiar');
    $.ajax({
        type: "GET",
        url: base_url + "getTasks",
        success: function(data) {
            d = new Date();
            //console.log(data);
            var model = $('#tasks');
            model.empty();
            for (var i in data.tasks) {
                var item = data.tasks[i];
                if (item.fecha_respuesta == d.format('Y\\-m\\-d 00\\:00\\:00')) {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-danger' style='border-radius:45%;'></button></th>";
                } else {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-success' style='border-radius:45%;'></button></th>";
                };
                model.append("<tr><th class='center'>" + item.folio + "</th>" +
                    "<th class='center'>" + item.oficio_referencia + "</th>" +
                    "<th class='center'>" + item.area_generadora + "</th>" +
                    "<th class='center'>" + item.asunto + "</th>" +
                    "<th class='center'>" + item.fecha_respuesta +
                    "<th class='center'>" + item.estatus +
                    semaforo + "</th> </tr>");
            }
        }
    });
}

function getTasksSuperAdmin() {
    //console.debug('va a cambiar');
    $.ajax({
        type: "GET",
        url: base_url + "getTasksSuperAdmin",
        success: function(data) {
            //console.log(data);
            d = new Date();
            var model = $('#tasksSuperAdmin');
            model.empty();
            for (var i in data.tasks) {
                var item = data.tasks[i];
                var fechar =item.fecha_respuesta;
                //alert( $.format.parseDate(fechar, 'dd/MM/yyyy'))
                if (item.fecha_respuesta == d.format('Y\\-m\\-d 00\\:00\\:00')) {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-danger' style='border-radius:45%;'></button></th>";
                } else {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-success' style='border-radius:45%;'></button></th>";
                };
                model.append("<tr><th class='center'>" + item.folio + "</th>" +
                    "<th class='center'>" + item.oficio_referencia + "</th>" +
                    "<th class='center'>" + item.asunto + "</th>" +
                    "<th class='center'>" + item.first_name + "</th>" +
                    //"<th class='center shortDateFormat'>" + item.fecha_respuesta + "</th>" +
                    //"<th class='center'>" + item.estatus +
                    semaforo +
                    "<th class='center'><button type='button' class='btn btn-info' onclick='getTaskDetailsById(" + item.id + ")'>Ver Detalles</button></th>"+
                    "<th class='center'><button type='button' class='btn btn-danger' onclick='deleteTask(" + item.id + ")'>Eliminar</button></th> </tr>");
            }
        }
    });
}

function listUsers() {
    //console.debug('va a cambiar');
    $.ajax({
        type: "GET",
        url: base_url + "listUsers",
        success: function(data) {
            //console.log(data);
            var model = $('#listUsers');
            model.empty();
            for (var i in data.users) {
                var item = data.users[i];
                model.append("<tr><th value='" + item.id + "'>" + item.id + "</th>" +
                    "<th value='" + item.email + "'>" + item.first_name + "</th>" +
                    "<th value='" + item.email + "'>" + item.email + "</th>" +
                    "<th value='" + item.email + "'>" + item.username + "</th>" +
                    "<th><button type='button' class='btn btn-danger' onclick='deleteUser(" + item.id + ")'>Eliminar</button></th>" + "</tr>");
            }
        }
    });
}

function deleteUser(id) {
    var target = document.getElementById('listUsers');
    var spinner = new Spinner(opts).spin(target);
    $.ajax({
        type: "GET",
        url: base_url + "deleteUser/" + id,
        success: function(data) {
            spinner.stop();
            listUsers();
        }
    });
}

function cleanDD() {
    var target = document.getElementById('limpiarEspacio');
    var spinner = new Spinner(opts).spin(target);
    $.ajax({
        type: "GET",
        url: base_url + "cleanDD",
        success: function(data) {
            spinner.stop();
        }
    });
}

function deleteTask(id) {
    var target = document.getElementById('main');
    var spinner = new Spinner(opts).spin(target);
    $.ajax({
        type: "GET",
        url: base_url + "deleteTask/" + id,
        success: function(data) {
            spinner.stop();
            getTasksSuperAdmin();
        }
    });
}

function getTaskDetailsById(id) {
    //console.debug('va a cambiar');
    showView('verDetalleTarea','ocultar')
    $.ajax({
        type: "GET",
        url: base_url + "getTaskDetailsById/"+id,
        success: function(data) {
            d = new Date();
            //console.log(data);
            var model = $('#detailsTask');
            model.empty();
            for (var i in data.tasks) {
                var item = data.tasks[i];
                if (item.fecha_respuesta == d.format('Y\\-m\\-d 00\\:00\\:00')) {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-danger' style='border-radius:45%;'></button></th>";
                } else {
                    var semaforo = "<th class='center'><button type='button' class='btn btn-success' style='border-radius:45%;'></button></th>";
                };
                model.append("<tr><th class='center'" + item.folio + "'>" + item.folio + "</th>" +
                    "<th class='center'" + item.folio + "'>" + item.oficio_referencia + "</th>" +
                    "<th class='center'" + item.folio + "'>" + item.area_generadora + "</th>" +
                    "<th class='center'" + item.folio + "'>" + item.asunto + "</th>" +
                    "<th class='center'" + item.folio + "'>" + item.fecha_recepcion +
                    "<th class='center'" + item.folio + "'>" + item.fecha_respuesta +
                    "<th class='center'" + item.folio + "'>" + item.nombre_titular +
                    "<th class='center'" + item.folio + "'>" + item.ubicacion_topografica +
                    "<th class='center'" + item.folio + "'>" + item.estatus +
                    semaforo + "</th> </tr>");
            }
        }
    });
}

/*libraries*/

jQuery(function() {
    var shortDateFormat = 'dd/MM/yyyy';
    var longDateFormat  = 'dd/MM/yyyy HH:mm:ss';

    jQuery(".shortDateFormat").each(function (idx, elem) {
        if (jQuery(elem).is(":input")) {
            jQuery(elem).val(jQuery.format.date(jQuery(elem).val(), shortDateFormat));
        } else {
            jQuery(elem).text(jQuery.format.date(jQuery(elem).text(), shortDateFormat));
        }
    });
    jQuery(".longDateFormat").each(function (idx, elem) {
        if (jQuery(elem).is(":input")) {
            jQuery(elem).val(jQuery.format.date(jQuery(elem).val(), longDateFormat));
        } else {
            jQuery(elem).text(jQuery.format.date(jQuery(elem).text(), longDateFormat));
        }
    });
});