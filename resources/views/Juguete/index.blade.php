@extends('Templates.secciones.app')

@section('content')

     <div class="default" style="margin-bottom: 10px !important;">
            <div class="page-header">
                <div>
                    <h3 class="title_general">
                        Juguetes         

                  
                            <button type="button" id="AGREGAR"  class="btn btn-primary derecha"  data-toggle="modal" data-placement="bottom" data-target="#popup" title="Agregar registro" >
                                <span class="fa fa-plus"></span>
                            </button>

                           {{--  <a class="btn btn-primary derecha" id="btn-inicio-sesion" style="margin-top: 30px;margin-bottom: 10px !important;" method="post" href="{{ url("/juguete/postFormJuguete")  }}" title="Agregar registro">
                                <span class="fa fa-plus"></span>
                            </a> --}}
                    </h3>
                </div>
            </div>
        </div>

        <div id="mensaje"></div>
		{{ Form::hidden('id_modulo', 'juguete', array('id' => 'id_modulo')) }}
        <div class="table-responsive">
            <table class="table table-striped display responsive nowrap" cellspacing="0" id="TablaEmpresasRegistradas" width="100%">
                <thead  class="thead-dark">
                    <tr class="text-center">                        
                        <th>Id</th>
                        <th>NumeroReferencia</th>
                        <th>NombreJuguete</th>
                        <th>Dimensiones</th>
                        <th>EdadInicial</th>
                        <th>EdadFinal</th>
                        <th>IdGenero</th>                        
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>

        {!! Html::script('js/Juguete/juguete.js') !!}
        <script type="text/javascript">
            var token = $("#_MTOKEN").val();
            $(document).ready(function(){
                cargarTablaJuguete()
                // var TablaEmpresasRegistradas = $("#TablaEmpresasRegistradas").dataTable({destroy:true});
                // TablaEmpresasRegistradas.fnDestroy();
                // TablaEmpresasRegistradas.DataTable();
            });
        </script>
@endsection