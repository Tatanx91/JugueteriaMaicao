@extends('Templates.secciones.app')
@section('content')
    <div>
        <center>
            <img src="{{asset('Imagenes/Logo_web_Maicao.png')}}" style="width: 128px; height: 128px" />
        </center>
    </div>

    <div class="container">
        <center>
            {{-- {{ Form::button('id_modulo', 'usuario', array('id' => 'id_modulo')) }} --}}
            <a href="/Usuarios" class="btn btn-primary">Usuarios</a>
            <a href="/juguete" class="btn btn-primary">Juguetes</a>
            <a href="/Empleados" class="btn btn-primary">Empleado</a>
            <a href="/Empresas" class="btn btn-primary">Empresas</a>
        </center>
    </div>
        
@endsection