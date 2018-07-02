var token = $("#_MTOKEN").val();

function cargarTablaEmpresa(){

	var url = $('#APP_URL').val() + "/empresa/datatableListEmpresa";//&_token=" + token;
	console.log(url);
	var TablaEmpresas = $("#TablaEmpresas").dataTable({destroy:true});
	TablaEmpresas.fnDestroy();
	TablaEmpresas.DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"url":url,
			"type":"GET",
		},
		"columns":[
			{"data": "ID", "className": "text-center d-none"},
			{"data": "IdUsuario", "className": "text-center d-none"},
			{"data": "IdTipoDocumento", "className": "text-center d-none"},
			{"data": "Logo", "className": "text-center d-none"},
			{"data": "Estado", "className": "text-center d-none"},
			{"data": "Nombre", "className": "text-center"},
			{"data": "NombreTipoDocumento", "className": "text-center"},
			{"data": "NumeroDocumento", "className": "text-center"},
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false },
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false },
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false }

		],
		"createdRow":function(row, data, index){
			var Estado = "activar";
			clase_estado = "fa-toggle-off";

			if(data.Estado == "1"){
				Estado = "desactivar";
				clase_estado = "fa-toggle-on";
			}
					console.log(Estado);
            		$(row).attr('id','tr_'+index);
					$("td", row).eq(8).html("<span style='cursor: pointer;' class='fa fa-edit fa-2x' data-id='"+data.ID+"' id='EDITAR' title='Editar Empresa'></span>");
					$("td", row).eq(9).html("<span style='cursor: pointer;' id=estado_"+data.ID+" class='fa "+clase_estado+" fa-2x' onclick=activarDessactivarEmpresa('"+data.ID+"','"+data.Estado+"'); title='"+Estado+" Empresa'></span></button>")
					$("td", row).eq(10).html("<span style='cursor: pointer;' class='fa fa-camera fa-2x'></span>")
		},
		"aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
		"iDisplayLength": 10, "bLengthChange": true,
       
   });
}


function guardarEmpresa(){

	validaCampos('empresa')
	var url = $("#APP_URL").val() + "/empresa/postStore/";
	var params = $("#form-empresa").serialize();
	params += "&_token=" + token;
	//console.log(url)
	$.post(url, params).done(function(data){
		cargarTablaEmpresa()
		$('.close').click();
		$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
			
	}).fail(function(jqXHR){
		$("#mensaje_error").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
	});
}
function activarDessactivarEmpresa(id,Estado){
	var estado_update = 1;

	if(Estado == "1"){
		estado_update = 0; 
	}

	var url = $("#APP_URL").val() + "/empresa/cambiaEstado/";
	$.post(url,{Estado : estado_update,ID : id,_token:token})
	.done(function(data){
		cargarTablaEmpresa()
		$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
			
	}).fail(function(jqXHR){
		$("#mensaje").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
	    
	});

}
