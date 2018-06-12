<?php
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>

<html>

    <head>

        <title></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

         <!-- Compiled and minified CSS -->

        <!--<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />-->



        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <title>Maicao Gift Store</title>
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/booststrap/css/bootstrap.css') }}">
    <script src="{{asset('css/booststrap/js/bootstrap.min.js')}}"></script>

    </head>

    <body>

        <div class="row">
            <center>
                <div class="container" >

                    <div class="">
                        <!--
<form method="POST" action="http://127.0.0.1:8000/login" accept-charset="UTF-8" id="form-inicio-sesion" class="navbar-form navbar-left" type="POST">-->
    {!! Form::open(['route' => 'login', 'method'=> 'POST']) !!}
        {{  Form::token() }}

        <img src="{{asset('Imagenes/Logo_web_Maicao.png')}}" style="width: 128px; height: 128px" />
        <div class="form-group">
            <i class="fa fa-at prefix" aria-hidden="true"></i>
            {!!Form::text("Correo",null,["id"=>"Correo"])!!}
            {!!Form::label("Correo","Correo electrónico")!!}
        </div>



        <div class="form-group">
            <i class="fa fa-lock prefix" aria-hidden="true"></i>
            {!!Form::password("Contrasena",["id"=>"Contrasena"])!!}
            {!!Form::label("Contrasena","Contraseña")!!}
        </div>
<!--<button>prueba</button>
</form>-->

        <div id="contenedor-boton-inicio">

            <!--<a class="btn btn-info btn-md" id="btn-inicio-sesion" style="margin-top: 30px;" method="post" type="submit">Ingresar</a>-->
            {!! Form::button('<i class = "btn btn-info btn-md"></i> Submit', array('type' => 'submit', 'class' => 'button')) !!}
            {{--  'onclick' => 'return confirm("are you shure?")')) !!}--}}

        </div>

        <a href="{{url('/password/email')}}" class="col s12 blue-text text-darken-4 center" style="margin-top: 15px !important; font-size: small;">¿Olvidaste la contraseña?</a>
        {!!Form::hidden(null,url("/"),["id"=>"base_url"])!!}
    {!! Form::close() !!}

                    </div>

                </div>


                <p class="center" style="font-size: small;color: orange !important;"><a style="color: #0d47a1;" href="{{url("/")}}">Jugueteria Maicao</a> recomienda su versión movil usando Google Chrome</p>
                <p class="center" style="font-size: small;color: orange !important;">Copyright © {{date("Y")}} </p>
            </center>
        </div>



    </body>

</html>

