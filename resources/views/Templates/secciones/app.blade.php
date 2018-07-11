
<!DOCTYPE html>
<html lang="en">
<div id="header">
    @include('Templates.secciones._header')
    <style type="text/css" media="screen">
    .derecha{
       float: right;
   }
   
   .derecha{
       text-align: right;
   }
    </style>
</div>
<body style="padding-top: 0px;">
    <div id="head" class="navbar navbar-inverse navbar-fixed-top" style="z-index:4; background-color:#295c93 !important; border-color: #295c93;margin-bottom: 5px !important;">
        <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" style="color: #FFFFFF;" href="{{ url('/inicio/menu') }}">Maicao GiftStore</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

              @if(Session::get("PRIVILEGIOS")->IdTipoUsuario == 1)
              <li class="nav-item">
                    <a href="{{ url('Usuarios') }}" title="Usuarios" style="color: #FFFFFF;" class="nav-link">
                        <span class="fa fa-user" aria-hidden="true" style="color:#FFFFFF">Usuarios</span>
                    </a>
              </li>
              @endif
              @if(Session::get("PRIVILEGIOS")->IdTipoUsuario == 1 || Session::get("PRIVILEGIOS")->IdTipoUsuario == 2)
              <li class="nav-item">
                    <a href="{{ url('Empresa') }}" title="Empresa" style="color: #FFFFFF;" class="nav-link">
                        <span class="fa fa-building" aria-hidden="true" style="color:#FFFFFF">Empresas</span>                
                    </a> 
              </li>
              @endif
              @if(Session::get("PRIVILEGIOS")->IdTipoUsuario == 2)
              <li class="nav-item">
                    <a href="{{ url('/Empleado/Index/'.Session::get("PRIVILEGIOS")->IdEmpresa) }}" title="Empresa" style="color: #FFFFFF;" class="nav-link">
                        <span class="fa fa-users" aria-hidden="true" style="color:#FFFFFF">Empleados</span>                
                    </a> 
              </li>
              @endif
              @if(Session::get("PRIVILEGIOS")->IdTipoUsuario == 1)
              <li class="nav-item">
                    <a href="{{ url('Juguete') }}" title="Juguetes" style="color: #FFFFFF;" class="nav-link">
                        <span class="fa fa-space-shuttle" aria-hidden="true" style="color:#FFFFFF">Juguetes</span>
                    </a>
              </li>
              @endif
            </ul>
          </div>
        </nav>       
        <a href="{{ url('/') }}" title="Cerrar Sesion" style="color: #FFFFFF;float: right;">
            Cerrar Sesion
        </a>   
    </div>


    <div class="container">

        <div id="body">        
            
            <input type="hidden" id="APP_URL" value="{{ url("/")  }}" />
            <input type="hidden" id="_MTOKEN" value="{{ csrf_token()  }}" />

            @yield('content')
            <div class="modal fade" id="popup" role="dialog">
                @section('content_modal')
                 <div class="modal-dialog" style="min-width: 80% !important;">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                        </div>
                        <div class="modal-body">
                            <div class="row center-block">
                            </div>                  
                        </div>
                        <div class="modal-footer"> 
                        </div>                               
                    </div>
                </div>
                @show
            </div>
           

        </div>    </div> <!-- /container -->
<script type="text/javascript">
      
$(document).ready(function(){
   $('#popup').modal({
        backdrop: 'static',
        //keyboard: false  // to prevent closing with Esc button (if you want this too),
        show: false
    });
});

</script>
</body>
