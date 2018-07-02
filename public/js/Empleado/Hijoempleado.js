var token = $("#_MTOKEN").val();

function cargarTablaempleadoHijo(){

	var url = $('#APP_URL').val() + "/HijoEmpleado/datatableListEmpleadoHijo";
	var Empleado = $("#TablaempleadoHijo").dataTable({destroy:true});
	Empleado.fnDestroy();
	Empleado.DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"url":url,
			"type":"GET",
			data:{IdEmpleadoP:$("#IdEmpleadoP").val(),_token: + token}
		},
		"columns":[
			// {"data": "IdJuguete", "className": "text-center"},
			{"data": "ID", "className": "text-center"},
			{"data": "Nombre", "className": "text-center"},
			{"data": "Apellido", "className": "text-center"},
			{"data": "NumeroDocumento", "className": "text-center"},
			{"data": "FechaNacimiento", "className": "text-center"},
			{"data": "Estado", "className": "text-center"},
			{"data": null, "defaultContent": "", "className": "text-center ","orderable": false }

		],
		"createdRow":function(row, data, index){
			var estado = "activar";
			clase_estado = "fa-toggle-off";

			if(data.Estado == "1"){
				estado = "desactivar";
				clase_estado = "fa-toggle-on";
			}
            		$(row).attr('id','tr_'+index);
					$("td", row).eq(5).html("<span style='cursor: pointer;' class='fa fa-edit fa-2x' data-id='"+data.ID+"' id='EDITAR' title='Editar juguete'></span>");
					$("td", row).eq(6).html("<span style='cursor: pointer;' id=estado_"+data.ID+" class='fa "+clase_estado+" fa-2x' onclick=activarDessactivarEmpleado('"+data.ID+"','"+data.Estado+"'); title='"+estado+" empleado'></span>")
					
			
		},
		"aLengthMenu": false,//[[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
		"iDisplayLength": 5, "bLengthChange": false,
       
   });
}


function guardarHijoEmpleado(){
	if(validaForm('Hijoempleado')){
		validaCampos('Hijoempleado')
		var url = $("#APP_URL").val() + "/HijoEmpleado/postStore/";
		var params = $("#form-Hijoempleado").serialize();
		params += "&_token=" + token;
		$.post(url, params).done(function(data){
			cargarTablaempleadoHijo()
			$('.close').click();
			$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
				
		}).fail(function(jqXHR){
			$("#mensaje_error").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
		    
		});
	}else{
		$("#mensaje_error").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Los campos subrayados en rojo son requeridos.</b></center></div>')
		return false;
	}
}

// function activarDessactivarEmpleado(id,estado){
// 		var estado_update = 1;
// 		var texto = "¿Esta seguro de activar empleado?";

// 		if(estado == "1"){
// 			estado_update = 0; 
// 			texto = "¿Esta seguro de desactivar empleado?";
// 		}

// 	if(confirmacion(texto)){
// 		var url = $("#APP_URL").val() + "/empleado/cambiaEstado/";
// 		$.post(url,{estado : estado_update,Id : id,_token:token})
// 		.done(function(data){
// 			cargarTablaempleadoHijo()
// 			$("#mensaje").html('<div class="alert alert-success alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>'+data.mensaje+'</b></center></div>')		
				
// 		}).fail(function(jqXHR){
// 			$("#mensaje").html('<div class="alert alert-danger alert-dismissible div-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><b>Error al guardar</b></center></div>')
		    
// 		});
// 	}else{
// 		return false;
// 	}

// }

function crearHijo(id){

	var url = $("#APP_URL").val() + "/HijoEmpleado/postForm/";
	$.post(url,{ "_token" :  $("#_MTOKEN").val(), "IdEmpleado" : id },function(data){
		$("#div_tablaHijo").addClass('d-none');	
		$("#agregarHijo").addClass('d-none');
		$("#div_crearHijo").html(data);
		$("#div_crearHijo").removeClass('d-none');
		$("#volverHijo").removeClass('d-none');	

    });


}
function VolverTabla(){
	$("#volverHijo").addClass('d-none');	
	$("#div_crearHijo").addClass('d-none');
	$("#agregarHijo").removeClass('d-none');
	$("#div_tablaHijo").removeClass('d-none');	
}


