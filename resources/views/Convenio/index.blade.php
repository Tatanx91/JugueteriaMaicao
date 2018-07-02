@extends('Templates.secciones.app')
@section('content')
     <div class="default" style="margin-bottom: 10px !important;">
            <div class="page-header">
                <div>
                    <br/>
                    <h3 class="title_general">
                        Convenio
                    </h3>              
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table width="100%">
                <tr>
                    <td style="text-align: center;">
                        <h5> Fecha Inicio</h5>
                        <input type="date" id="DTPFechaInicio" name="DTPFechaInicio">
                    </td>
                    <td style="text-align: center;">
                        <h5>Fecha Fin</h5>
                        <input type="date" id="DTPFechaFin" name="DTPFechaFin">
                    </td>
                </tr>
            </table>

            <table width="100%" style="text-align: center;">
                <tr>
                    <br/>
                    <td style="text-align: center;"><button class="btn btn-dark" onclick="GuardarConvenio()">Guardar</button></td>
                </tr>
            </table>
        </div>

        {!! Html::script('js/Convenio/convenio.js') !!}
        <script type="text/javascript">
            var token = $("#_MTOKEN").val();
            $(document).ready(function(){
                // cargarTablaEmpresa()
                // var TablaEmpresasRegistradas = $("#TablaEmpresasRegistradas").dataTable({destroy:true});
                // TablaEmpresasRegistradas.fnDestroy();
                // TablaEmpresasRegistradas.DataTable();
            });
        </script>
@endsection