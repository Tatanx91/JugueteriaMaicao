@extends('Templates.secciones.app')

@section('content')

    <div id="ConfirmCorreo"></div>
	{{ Form::hidden('id_modulo', 'Confirmacion', array('id' => 'id_modulo')) }}
    <div class="table-responsive">
        <h2>Se ha enviado un correo a la direccion registrada para que sea confirmado el usuario</h2>
        <p>por favor dirgirse al siguiente enlace para confirmar el registro en la plataforma</p>
        <a href="{{ url('/registro/verificacion/'.$data['CodigoConf']) }}">
        	Ingresar a confirmar el registro del usuario
        </a>

        <img src="{{asset('Imagenes/Logo_web_Maicao.png')}}" style="width: 128px; height: 128px" />
    </div>
@endsection