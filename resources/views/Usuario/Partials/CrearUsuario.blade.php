<div class="panel-body">
	<div class="row">
		<div id="mensaje_error" style="width: 100%;"></div>
	</div>
<div class="row" >
	{!! Form::hidden('IdUsuario', $usuario->IdUsuario, array('id' => 'IdUsuario'))!!}
	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('NombreUsuario', 'Nombre usuario', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::text('NombreUsuario', $usuario->NombreUsuario, array('id' => 'NombreUsuario', 'class'=> 'form-control', 'placeholder' => 'Nombre del usuario')) !!}
		{!! $errors->has('NombreUsuario')?$errors->first('NombreUsuario'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('ApellidoUsuario', 'Apellido usuario', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::text('ApellidoUsuario', $usuario->ApellidoUsuario, array('id' => 'ApellidoUsuario', 'class'=> 'form-control', 'placeholder' => 'Apellido del usuario')) !!}
		{!! $errors->has('ApellidoUsuario')?$errors->first('ApellidoUsuario'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('IdTipoDocumento', 'TipoDocumento', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::select('TipoDocumento', ['1'=> 'Cedula de ciudadania', '2'=> 'Nit']) !!}
		{{-- {!! Form::DropDownList('IdTipoDocumento', null, ['class'=> 'form-control']) !!} --}}
		{!! $errors->has('IdTipoDocumento')?$errors->first('IdTipoDocumento'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('NumeroDocumento', 'Numero de documento', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::text('NumeroDocumento', $usuario->NumeroDocumento, array('id' => 'NumeroDocumento', 'class'=> 'form-control', 'placeholder' => 'Numero de documento')) !!}
		{!! $errors->has('NumeroDocumento')?$errors->first('NumeroDocumento'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('TipoUsuario', 'Tipo de Usuario', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::text('TipoUsuario', $usuario->TipoUsuario, array('id' => 'TipoUsuario', 'class'=> 'form-control', 'placeholder' => 'Seleccionar tipo usuario')) !!}
		<!--<input type="password" class="form-control" name="TipoUsuario">-->
		{!! $errors->has('TipoUsuario')?$errors->first('TipoUsuario'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('Contrasena', 'Contraseña', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::password('Contrasena', $usuario->Contrasena, array('id' => 'Contrasena', 'class'=> 'form-control', 'placeholder' => 'Ingresar Contraseña')) !!}
		<!--<input type="password" class="form-control" name="Contrasena">-->
		{!! $errors->has('Contrasena')?$errors->first('Contrasena'):'' !!}
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
		{!! Form::label('Correo', 'Correo', ['class'=> 'control-label col.md-2']) !!}
		{!! Form::email('Correo', $usuario->Correo, array('id' => 'Correo', 'class'=> 'form-control', 'placeholder' => 'Correo del usuario')) !!}
		<!--<input type="password" class="form-control" name="Contrasena">-->
		{!! $errors->has('Correo')?$errors->first('Correo'):'' !!}
	</div>
</div>
</div>