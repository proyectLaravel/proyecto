var base_url = 'http://172.16.71.230/authLaravelSimple/public/';

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
	$.ajax({
	  type: "GET",
        url : base_url + "deleteUser/"+id,
        success : function(data){
            listUsers();
        }
	});
}

