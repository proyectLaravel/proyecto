var base_url = 'http://localhost/authLaravelSimple/public/';

$( document ).ready(function() {
   traeUsuarios(); 
});

function showView(id,clases){
  //console.debug(id+'    '+ clases);
  $('.'+clases).hide();
  $('#'+id).show();
}

function traeUsuarios(){
	//console.debug('va a cambiar');
	

	$.ajax({
	  type: "GET",
        url : base_url + "content_ajax",
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
