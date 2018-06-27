
    $(document).on('click','#AGREGAR',function(event){
    	event.stopPropagation();
        var id_modulo=$("#id_modulo").val();
        $.get($("#APP_URL").val()+"/"+id_modulo+"/postForm"+id_modulo+""/*+id_modulo*/,function(data){
            $('#popup').empty().append($(data));
         	$('#popup').modal('show');

        });
    });


    $(document).on('click','#EDITAR',function(event){
    	event.stopPropagation();
        var id_modulo=$("#id_modulo").val();
        IdJuguete=$(this).data('id');
        $.post($("#APP_URL").val()+"/"+id_modulo+"/postForm"+id_modulo,{ "_token" :  $("#_MTOKEN").val(), "IdJuguete" : IdJuguete },function(data){
	         $('#popup').empty().append($(data));
             $('#popup').modal('show');
        });
     })

    $(document).on('click','#EDITARUSUARIO',function(event){
        event.stopPropagation();
        var id_modulo=$("#id_modulo").val();
        IdUsuario=$(this).data('id');
        $.post($("#APP_URL").val()+"/"+id_modulo+"/postForm"+id_modulo,{ "_token" :  $("#_MTOKEN").val(), "IdUsuario" : IdUsuario },function(data){
             $('#popup').empty().append($(data));
             $('#popup').modal('show');
        });
     })

function validaCampos(form){
    $("#form-"+form).find('div.div_requerido, :input, input:text, input:password, input:file, select, textarea,input:radio').css({'border':'1px solid #ccc'});           
    
	console.log($("#form-"+form).find('div.div_requerido, :input, input:text, input:password, input:file, select, textarea,input:radio'))
    $.each($("#form-"+form).find('div.div_requerido, :input, input:text, input:password, input:file, select, textarea,input:radio'),function(key,val){           
        
        var id =$(val).attr('id');

        $("#"+id).css({'border':'1px solid #ccc'})
        $("#"+id+"_error").remove();
    });
}

 $('.numerico').keyup(function(){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });



    $(document).on('keyup','.num-real',function(event) {

        var substrings = this.value.split('.');
        var count = substrings.length - 1;
        
        esNumerico=$.inArray(event.keyCode,[8,37,39,46,190,110,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105]);
        if( esNumerico!==-1 ) {
            
        }
        else {
            this.value = parseFloat(this.value);
            if(isNaN(this.value))
                this.value='';            
        }

        if(count>1) {
            this.value = parseFloat(this.value);
        }

    });

    $(document).on('keyup','.num-entero',function(event) {

        esNumerico=$.inArray(event.keyCode,[8,37,39,46,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105]);
        if( esNumerico!==-1 ) {
        }
        else {
            this.value = parseInt(this.value);
            if(isNaN(this.value))
                this.value='';
        }
    });

function validarLongitud(id_campo_texto, numero_caracteres_permitidos, caracteres) {
     
    var campo_texto = id_campo_texto;
    var campo_caracteres = "c_" + id_campo_texto;
    var numero_caracteres = $("#" + campo_texto).val().length;
    var numero_permitido = numero_caracteres_permitidos;

    if (numero_caracteres > numero_permitido) {
        $("#" + campo_texto).val(contenido_textarea);
    } else {
        contenido_textarea = $("#" + campo_texto).val();
    }
    if (caracteres == 1) {
        cuenta(numero_caracteres, campo_caracteres, numero_permitido);
    }

}

function cuenta(numero_caracteres, campo_caracteres, numero_permitido) {

    var id = campo_caracteres;

    if (numero_caracteres > numero_permitido) {
        numero_caracteres--;
        $("#" + id).text(numero_caracteres);
    }
    else {  
        $("#" + id).text(numero_caracteres);
    }
}