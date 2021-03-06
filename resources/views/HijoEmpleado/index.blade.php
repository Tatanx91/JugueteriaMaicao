{{-- @extends('Templates.secciones.app')

@section('content')

     <div class="default" style="margin-bottom: 10px !important;">
            <div class="page-header">
                <div>
                    <h3 class="title_general">
                        Empleado         

                  
                            <button type="button" id="AGREGAR"  class="btn btn-primary derecha"  data-toggle="modal" data-placement="bottom" data-target="#popup" title="Agregar registro" >
                                <span class="fa fa-plus"></span>
                            </button>

                            <button type="button" id="MASIVO"  class="btn btn-primary derecha" style="margin-right:  2% !important;" data-toggle="modal" data-placement="bottom" data-target="#popup" title="Subir masivos" >
                                <span class="fa fa-upload"></span>
                            </button>

                    </h3>
                </div>
            </div>
        </div>

        <div id="mensaje"></div>
		{{ Form::hidden('id_modulo', 'empleado', array('id' => 'id_modulo')) }}
        <div class="table-responsive">
            <table class="table table-striped display responsive nowrap" cellspacing="0" id="Tablaempleado" width="100%">
                <thead  class="thead-dark">
                    <tr class="text-center">     
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
                cargarTablaempleadoHijo()
            });
        </script>
@endsection --}}

@extends('Templates.secciones.app')
@section('content_modal')
    <div class="modal-dialog" style="min-width: 80% !important;">
        <div class="modal-content">         
            
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">{{$titulo}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-md-12 modal-body" >
                        <button type="button" id="agregarHijo"  class="btn btn-primary derecha" onclick="crearHijo('{{$IdEmpleado}}')" title="Agregar registro" >
                            <span class="fa fa-plus"></span>
                        </button> 
                        <button type="button" id="volverHijo"  class="btn btn-primary derecha d-none" onclick="VolverTabla()" title="Volver" >
                            <span  class="fa fa-arrow-left"></span>
                        </a>
                        </button>         
                            
                    <br>
                    {{ Form::hidden('IdEmpleadoP',$IdEmpleado, array('id' => 'IdEmpleadoP')) }}
                    <div id="mensaje_hijo" style="margin-top: 2% !important;"></div>
                    <div class="col-md-12 center-block" id="div_tablaHijo">
                            <div id="mensaje"></div>
                            {{ Form::hidden('id_modulo', 'empleado', array('id' => 'id_modulo')) }}
                            <div class="table-responsive">
                                <table class="table table-striped display responsive nowrap" cellspacing="0" id="TablaempleadoHijo" width="100%">
                                    <thead  class="thead-dark">
                                        <tr class="text-center">     
                                            <th width="10%">ID</th>
                                            <th width="10%">Nombre</th>
                                            <th width="10%">Apellido</th>
                                            <th width="10%">NumeroDocumento</th>
                                            <th width="10%">FechaNacimiento</th>
                                            <th width="10%">Editar</th>                   
                                            <th width="7%">Estado</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>    

                        <div class="col-md-12 d-none" style="margin-bottom: 10px;" id="div_crearHijo">
                        </div>              
                </div>

                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a>      
                </div>                               
        </div>
    </div>
    {!! Html::script('js/Empleado/Hijoempleado.js') !!}
    <script type="text/javascript">
        var token = $("#_MTOKEN").val();
        $(document).ready(function(){
            cargarTablaempleadoHijo()
        });
    </script>
@endsection
