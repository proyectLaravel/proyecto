var base_url = 'http://localhost/authLaravelSimple/public/';

$( document ).ready(function() {
   getUsers(); 
   getTasks();
});

function showView(id,clases){
  //console.debug(id+'    '+ clases);
  $('.'+clases).hide();
  $('#'+id).show();
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
				model.append("<tr><th value='"+ item.Folio +"'>" + item.Folio + "</option>"+
				"<th value='"+ item.folio +"'>" + item.areaSolicitante + "</option>"+
				"<th value='"+ item.folio +"'>" + item.asunto + "</option>"+
				"<th value='"+ item.folio +"'>" + item.fechaRespuesta + "</option> </tr>");
			}
        }
	});
}



