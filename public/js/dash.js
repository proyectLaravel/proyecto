var base_url = 'http://172.16.71.230/authLaravelSimple/public/';
/*Necesario para el spinner*/
var opts = {
  lines: 7, // The number of lines to draw
  length: 17, // The length of each line
  width: 25, // The line thickness
  radius: 50, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 64, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
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

function loadSpinner(){
	//var target = $('#eliminar');
	var target = document.getElementById('eliminar');
	var spinner = new Spinner(opts).spin(target);
}

$( document ).ready(function() {
   getUsers(); 
   getTasks();
   getTasksSuperAdmin();
   listUsers();
   $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

function showView(id,clases){
  //console.debug(id+'    '+ clases);

  $('.'+clases).hide();
  $('#'+id).show();
} 	

function addClassActive(id){
  $('.nav-sidebar > li').removeClass('active');
  $('.nav-sidebar > li#'+id).addClass('active');
}

function getUsers(){
	//console.debug('va a cambiar');
	$.ajax({
	  type: "GET",
        url : base_url + "getUsers",
        success : function(data){
            //console.log(data);
            var model = $('#usuarios');
			model.empty();
			for (var i in data.users) {
				var item = data.users[i];
				model.append("<option value='"+ item.id +"'>" + item.first_name + "</option>");
			}
        }
	});
}

function getTasks(){
	//console.debug('va a cambiar');
	$.ajax({
	  type: "GET",
        url : base_url + "getTasks",
        success : function(data){
            //console.log(data);
            var model = $('#tasks');
			model.empty();
			for (var i in data.tasks) {
				var item = data.tasks[i];
				model.append("<tr><th value='"+ item.Folio +"'>" + item.Folio + "</th>"+
				"<th value='"+ item.folio +"'>" + item.areaSolicitante + "</th>"+
				"<th value='"+ item.folio +"'>" + item.asunto + "</th>"+
				"<th value='"+ item.folio +"'>" + item.fecha_respuesta + "</th> </tr>");
			}
        }
	});
}

function getTasksSuperAdmin(){
	//console.debug('va a cambiar');
	$.ajax({
	  type: "GET",
        url : base_url + "getTasksSuperAdmin",
        success : function(data){
            //console.log(data);
            var model = $('#tasksSuperAdmin');
			model.empty();
			for (var i in data.tasks) {
				var item = data.tasks[i];
				model.append("<tr><th value='"+ item.Folio +"'>" + item.Folio + "</th>"+
				"<th value='"+ item.folio +"'>" + item.areaSolicitante + "</th>"+
				"<th value='"+ item.folio +"'>" + item.asunto + "</th>"+
				"<th value='"+ item.folio +"'>" + item.fecha_respuesta + "</th> </tr>");
			}
        }
	});
}

function listUsers(){
	//console.debug('va a cambiar');
	$.ajax({
	  type: "GET",
        url : base_url + "listUsers",
        success : function(data){
            //console.log(data);
            var model = $('#listUsers');
			model.empty();
			for (var i in data.users) {
				var item = data.users[i];
				model.append("<tr><th value='"+ item.id +"'>" + item.id + "</th>"+
				"<th value='"+ item.email  +"'>" + item.first_name + "</th>"+
				"<th value='"+ item.email  +"'>" + item.email + "</th>"+
				"<th value='"+ item.email  +"'>" + item.username + "</th>"+
				"<th><button type='button' class='btn btn-danger' onclick='deleteUser("+item.id+")'>Eliminar</button></th>"+ "</tr>");
			}
        }
	});
}

function deleteUser(id){
	var target = document.getElementById('listUsers');
	var spinner = new Spinner(opts).spin(target);
	$.ajax({
	  type: "GET",
        url : base_url + "deleteUser/"+id,
        success : function(data){
        	spinner.stop();
            listUsers();
        }
	});
}

