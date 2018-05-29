@extends('layout.home')
@section('content')

	<table class="table table-bordered table-responsive" style="margin-top: 10px;">
		
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

@endsection