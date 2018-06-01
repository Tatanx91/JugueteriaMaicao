var token = $("#_MTOKEN").val();

function cargarTablaJuguete(){

	var url = $('#APP_URL').val() + "/juguete/datatableListJuguete";//&_token=" + token;
	var TablaEmpresasRegistradas = $("#TablaEmpresasRegistradas").dataTable({destroy:true});
	TablaEmpresasRegistradas.fnDestroy();
	TablaEmpresasRegistradas.DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"url":url,
			"type":"GET",
		},
		"columns":[
			{"data": "IdJuguete", "className": "text-center"},
			{"data": "NumeroReferencia", "className": "text-center hidden"},
			{"data": "NombreJuguete", "className": "text-center"},
			{"data": "Dimensiones", "className": "text-center hidden"},
			{"data": "EdadInicial", "className": "text-center"},
			{"data": "EdadFinal", "className": "text-center"},
			{"data": "NombreGenero", "className": "text-center"},
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false },
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false },
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false }

		],
		"createdRow":function(row, data, index){
			var estado = "activar";
			clase_estado = "fa-toggle-off";

			if(data.estado == "1"){
				estado = "desactivar";
				clase_estado = "fa-toggle-on";
			}
console.log(estado)
            		$(row).attr('id','tr_'+index);
					$("td", row).eq(7).html("<span style='cursor: pointer;' class='fa fa-edit fa-2x' data-id='"+data.IdJuguete+"' id='EDITAR' title='Editar juguete'></span>");
					$("td", row).eq(8).html("<span style='cursor: pointer;' id=estado_"+data.IdJuguete+" class='fa "+clase_estado+" fa-2x' onclick=activarDessactivarJuguete('"+data.IdJuguete+"','"+data.estado+"'); title='"+estado+" juguete'></span></button>")
					$("td", row).eq(9).html("<span style='cursor: pointer;' class='fa fa-camera fa-2x'></span>")
				//<button type='button' onclick=\"habilitar_deshabilitar_juguete('"+data.IdJuguete+"', 'deshabilitar')\" class='btn btn-primary' ></button>
				//<button type='button' data-id='"+data.IdJuguete+"' id='EDITAR' class='btn btn-primary' data-toggle='modal' data-placement='bottom' data-target='#popup' title='Editar registro'><span class='fa fa-edit'></span></button>
				//
				//<a class='btn btn-primary' title='Agregar Imagenes' href='"+data.IdJuguete+"'>
				//fa-toggle-on

			
		},
		"aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
		"iDisplayLength": 10, "bLengthChange": true,
       
   });
}


function guardarJuguete(){

	validaCampos('juguete')
	var url = $("#APP_URL").val() + "/juguete/postStore/";
	var params = $("#form-juguete").serialize();
	params += "&_token=" + token;
	//console.log(url)
	$.post(url, params).done(function(data){
		cargarTablaJuguete()
		$('.close').click();
		$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
			
	}).fail(function(jqXHR){
		$("#mensaje_error").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
	    
	});
}
function activarDessactivarJuguete(id,estado){
	var estado_update = 1;

	if(estado == "1"){
		estado_update = 0; 
	}

	var url = $("#APP_URL").val() + "/juguete/cambiaEstado/";
	$.post(url,{estado : estado_update,IdJuguete : id,_token:token})
	.done(function(data){
		cargarTablaJuguete()
		$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
			
	}).fail(function(jqXHR){
		$("#mensaje").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
	    
	});

}
