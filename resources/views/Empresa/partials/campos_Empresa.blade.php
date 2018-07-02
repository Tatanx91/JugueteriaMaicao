<div class="panel-body">
		<div class="row">	
			<div id="mensaje_error" style="width: 100%;"></div>
		</div>
	<div class="row">

		{!! Form::hidden('ID', $empresa->ID, array('id' => 'ID'))!!}
		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('NombreEmpresa', 'Nombre Empresa:') !!}
			{!! Form::text('NombreEmpresa', $empresa->Nombre, array('id' => 'Nombre', 'class' => 'form-control', 'placeholder' => 'Nombre de la Empresa')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('IdTipoDocumento', 'Tipo Documento:') !!}
			 {!! Form::select('IdTipoDocumento',$tipodocumento ,$empresa->IdTipoDocumento, array('id' => 'IdTipoDocumento','class'=>'form-control' )) !!}
			{{-- {!! Form::text('IdTipoDocumento', $empresas->IdTipoDocumento, array('id' => 'IdTipoDocumento', 'class' => 'form-control num-entero', 'placeholder' => 'Tipo de Documento')) !!}		 --}}	
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('NumeroDocumento', 'Numero Documento:') !!}
			{!! Form::text('NumeroDocumento', $empresa->NumeroDocumento, array('id' => 'NumeroDocumento', 'class' => 'form-control', 'placeholder' => 'Numero de documento de la Empresa')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('Logo', 'Logo:') !!}
			{!! Form::text('Logo', $empresa->Logo, array('id' => 'Logo', 'class' => 'form-control', 'placeholder' => 'Logo de la Empresa')) !!}
		</div>

	</div>
	
</div>