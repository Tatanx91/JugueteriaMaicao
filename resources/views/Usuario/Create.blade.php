@extends('layout.home')
@section('content')
	{!! Form::open(['route' => 'CrearUsuario', 'method'=> 'POST']) !!}
		<div class="form-group">
			{!! Form::label('NombreUsuario', 'Nombre usuario', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::text('NombreUsuario', null, ['class'=> 'form-control']) !!}
			{!! $errors->has('NombreUsuario')?$errors->first('NombreUsuario'):'' !!}
		</div>

		<div class="form-group">
			{!! Form::label('ApellidoUsuario', 'Nombre usuario', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::text('ApellidoUsuario', null, ['class'=> 'form-control']) !!}
			{!! $errors->has('ApellidoUsuario')?$errors->first('ApellidoUsuario'):'' !!}
		</div>

		<div class="form-group">
			{!! Form::label('IdTipoDocumento', 'Nombre usuario', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::select('TipoDocumento', ['CC'=> 'Cedula de ciudadania'], null, ['N'=> 'Nit']) !!}
			{!! Form::DropDownList('IdTipoDocumento', null, ['class'=> 'form-control']) !!}
			{!! $errors->has('IdTipoDocumento')?$errors->first('IdTipoDocumento'):'' !!}
		</div>

		<div class="form-group">
			{!! Form::label('NumeroDocumento', 'Numero de documento', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::text('NumeroDocumento', null, ['class'=> 'form-control']) !!}
			{!! $errors->has('NumeroDocumento')?$errors->first('NumeroDocumento'):'' !!}
		</div>

		<div class="form-group">
			{!! Form::label('Contrasena', 'Contraseña', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::text('Contrasena', null, ['class'=> 'form-control']) !!}
			<!--<input type="password" class="form-control" name="Contrasena">-->
			{!! $errors->has('Contrasena')?$errors->first('Contrasena'):'' !!}
		</div>

		<div class="form-group">
			{!! Form::label('Descripcion', 'Descripcion', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::textarea('Descripcion', null, ['class'=> 'form-control']) !!}
		</div>
		<button class="btn btn-primary" type="submit">Registrar</button>
	{!! Form::close() !!}

@endsection