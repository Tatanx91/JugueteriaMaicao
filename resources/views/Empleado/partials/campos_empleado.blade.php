<div class="panel-body">
		<div class="row">	
			<div id="mensaje_error" style="width: 100%;"></div>
		</div>
	<div class="row">

		{!! Form::hidden('ID', $datos->ID, array('id' => 'ID'))!!}
		{!! Form::hidden('IdUsuario', $datos->IdUsuario, array('id' => 'IdUsuario'))!!}
		{!! Form::hidden('IdEmpresa', $datos->IdEmpresa, array('id' => 'IdEmpresa'))!!}
		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('Nombre', 'Nombre:') !!}
			{!! Form::text('Nombre', $datos->Nombre, array('id' => 'Nombre', 'class' => 'form-control requiere', 'placeholder' => 'Numero')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('Apellido', 'Apellido:') !!}
			{!! Form::text('Apellido', $datos->Apellido, array('id' => 'Apellido', 'class' => 'form-control requiere', 'placeholder' => 'Apellido')) !!}			
		</div>
		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('IdTipoDocumento', 'Tipo Documento:') !!}
			 {!! Form::select('IdTipoDocumento',$tipodoc ,$datos->IdTipoDocumento, array('id' => 'IdTipoDocumento','class'=>'form-control requiere' )) !!}
			{{-- {!! Form::text('IdTipoDocumento', $datos->IdTipoDocumento, array('id' => 'IdTipoDocumento', 'class' => 'form-control requiere num-entero', 'placeholder' => 'genero del juguete')) !!}		 --}}	
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('NumeroDocumento', 'NumeroDocumento:') !!}
			{!! Form::text('NumeroDocumento', $datos->NumeroDocumento, array('id' => 'NumeroDocumento', 'class' => 'form-control requiere num-entero', 'placeholder' => 'NumeroDocumento')) !!}			
		</div>


		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('Email', 'Email:') !!}
			{!! Form::text('Login', $datos->Login, array('id' => 'Login', 'class' => 'form-control requiere','onblur'=>'validarCorreo()', 'placeholder' => 'Email')) !!}			
		</div>


 		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('FechaNacimiento', 'FechaNacimiento:') !!}
            <div class="form-group">
                <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                    <input type="text" id="FechaNacimiento" value="{{$datos->FechaNacimiento}}" class="form-control datetimepicker-input Datepicker" data-target="#datetimepicker" placeholder = 'Fecha Nacimiento'/>
                    <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
		</div>

	</div>
	
</div> 
<script type="text/javascript">
 $(function () {
                $('#datetimepicker').datetimepicker({
                    format: 'L',
		            ignoreReadonly: true,            
		            format: 'YYYY-MM-DD',
		            maxDate: 'now'
                });
            });
 </script>