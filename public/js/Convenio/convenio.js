var token = $("#_MTOKEN").val();

function guardarConvenio(){

	//validaCampos('empresa')
	var url = $("#APP_URL").val() + "/Convenio/postStore/";
	var params = $("#form-convenio").serialize();
	params += "&_token=" + token;
	//console.log(url)
	$.post(url, params).done(function(data){
		//cargarTablaEmpresa()
		//$('.close').click();
		//$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
		alert('Ok');	
	}).fail(function(jqXHR){
		//$("#mensaje_error").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
		alert('Fail');
	});
}