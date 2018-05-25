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

        <title>Vendiendo.co - Facturación en Línea</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

         <!-- Compiled and minified CSS -->

        <!--<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />-->




        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <title>Jugueteria Maicao</title>
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/booststrap/css/bootstrap.css') }}">
    <script src="{{asset('css/booststrap/js/bootstrap.min.js')}}"></script>

    </head>

    <body>

        <div class="row">
            <center>
                {!!Form::open(array('id'=>'form-inicio-sesion','class'=>'navbar-form navbar-left'))!!}

                <div class="container" >

                    <div class="">

                        <div class="form-group">
                            <i class="fa fa-at prefix" aria-hidden="true"></i>
                            {!!Form::text("email",null,["id"=>"email"])!!}
                            {!!Form::label("email","Correo electrónico")!!}
                        </div>



                        <div class="form-group">
                            <i class="fa fa-lock prefix" aria-hidden="true"></i>
                            {!!Form::password("password",["id"=>"password"])!!}
                            {!!Form::label("password","Contraseña")!!}
                        </div>





                        <div id="contenedor-boton-inicio">

                            <a class="btn btn-info btn-md" id="btn-inicio-sesion" style="margin-top: 30px;">Ingresar</a>

                        </div>

                        <a href="{{url('/password/email')}}" class="col s12 blue-text text-darken-4 center" style="margin-top: 15px !important; font-size: small;">¿Olvidaste la contraseña?</a>
                        {!!Form::hidden(null,url("/"),["id"=>"base_url"])!!}

                    </div>

                </div>


                <p class="center" style="font-size: small;color: orange !important;"><a style="color: #0d47a1;" href="{{url("/")}}">Jugueteria Maicao</a> recomienda su versión movil usando Google Chrome</p>
                <p class="center" style="font-size: small;color: orange !important;">Copyright © {{date("Y")}} </p>
            </center>
        </div>

        {!!Form::close()!!}


    </body>

</html>

