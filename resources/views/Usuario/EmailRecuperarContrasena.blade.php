@extends('Templates.secciones.app')
@section('content')

    {{ Form::hidden('id_modulo', 'RecuperarContrasena', array('id' => 'id_modulo')) }}

	<div class="default" style="margin-bottom: 10px !important;">
        <div class="page-header">
            <div>
                <h3 class="title_general" align="center">
                    Recuperar contraseña
                </h3>
            </div>
        </div>
        {!! Form::open(['route' => 'EmailRecuperar', 'method'=> 'POST', 'CodigoConf'=> 'CodigoConf' ]) !!}

        {{ Form::hidden('CodigoConf', $CodigoConf) }}

        <div class="form-group" align="center">
        	{!! Form::label('Correo', 'Correo Electronico', ['class'=> 'control-label col.md-2']) !!}
			{!! Form::text('Correo', null, ['class'=> '']) !!}
        </div>

        <div id="contenedor-boton-inicio" align="center">

            {!! Form::submit('Enviar Codigo') !!}

        </div>
        {!! Form::close() !!}

    </div>

		
@endsection