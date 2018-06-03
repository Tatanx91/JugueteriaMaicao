@extends('layout.home')
@section('content')

{{ Form::hidden('id_modulo', 'usuarios', array('id' => 'id_modulo')) }}

<div class="table-responsive">
	<table class="table table-striped display responsive nowrap" cellspacing="0" id="TablaUsuariosRegistrados" width="100%">
		
		<thead>
			<tr>
				<td>Nombre Usuario</td>
				<td>Apellido Usuario</td>
				<td>Id Tipo Documento</td>
				<td>Numero Documento</td>
			</tr>
		</thead>
		<tbody>
			@foreach ($Usuario as $usuarios)
				<tr>
					<td>{{ $usuarios->NombreUsuario }}</td>
					<td>{{ $usuarios->ApellidoUsuario }}</td>
					<td>{{ $usuarios->IdTipoDocumento }}</td>
					<td>{{ $usuarios->NumeroDocumento }}</td>
					<td>
						<a href="{{ route('EditarUsuario', $usuarios->IdUsuario) }}" class="btn btn-success">Editar</a>
					</td>
				</tr>
			@endforeach
		</tbody>


	</table>
</div>

@endsection