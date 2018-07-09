@extends('Templates.secciones.app')

@section('content')

     <div class="default" style="margin-bottom: 10px !important;">
            <div class="page-header">
                <div>
                    <h3 class="title_general">
                        Empleado       
                        <a class="btn btn-primary " tile="Volver" href="{!! url('Empresa'); !!}" style="cursor: pointer;">
                            <span  class="fa fa-arrow-left"></span>
                        </a>  
        
                  
                            <button type="button" id="AGREGAR"  class="btn btn-primary derecha"  data-toggle="modal" data-placement="bottom" data-target="#popup" title="Agregar registro" >
                                <span class="fa fa-plus"></span>
                            </button>

                            <button type="button" id="MASIVO"  class="btn btn-primary derecha" style="margin-right:  2% !important;" data-toggle="modal" data-placement="bottom" data-target="#popup" title="Subir masivos" >
                                <span class="fa fa-upload"></span>
                            </button>

                           {{--  <a class="btn btn-primary derecha" id="btn-inicio-sesion" style="margin-top: 30px;margin-bottom: 10px !important;" method="post" href="{{ url("/empleado/postFormempleado")  }}" title="Agregar registro">
                                <span class="fa fa-plus"></span>
                            </a> --}}
                    </h3>
                </div>
            </div>
        </div>
        {!! Form::hidden('IdEmpresaG', $IdEmpresa, array('id' => 'IdEmpresaG'))!!}
        {{ Form::hidden('id_modulo', 'empleado', array('id' => 'id_modulo')) }}
        <div id="mensaje"></div>
		{{ Form::hidden('id_modulo', 'empleado', array('id' => 'id_modulo')) }}
        <div class="table-responsive">
            <table class="table table-striped display responsive nowrap" cellspacing="0" id="Tablaempleado" width="100%">
                <thead  class="thead-dark">
                    <tr class="text-center">                        
                       {{--  <th>Id</th> --}}
                        <th width="10%">ID</th>
                        <th width="10%">Nombre</th>
                        <th width="10%">Apellido</th>
                        <th width="10%">NumeroDocumento</th>
                        <th width="10%">FechaNacimiento</th>
                        <th width="10%">Editar</th>                   
                        <th width="7%">Estado</th>
                        <th width="7%">Hijos</th>
                    </tr>
                </thead>
            </table>
        </div>

        {!! Html::script('js/Empleado/empleado.js') !!}
        <script type="text/javascript">
            var token = $("#_MTOKEN").val();
            $(document).ready(function(){
                cargarTablaempleado()
            });
        </script>
@endsection