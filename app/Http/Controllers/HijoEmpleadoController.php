<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Jugueteria\model\EmpleadoModel;
use Jugueteria\model\HijoEmpleado_Model;
use Jugueteria\model\TipoDocumentoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\model\Usuario_Model;
use File;


class HijoEmpleadoController extends Controller
{
	public function __construct(){
        //$this->middleware('auth', ['except' => ['Index,datatableJuguete,datatableListJuguete,postStore,postFormJuguete']]);
         $this->middleware(['auth:web' || 'auth:api']); 
    }

    public function Index(Request $request)
    {
        $IdEmpleado = $request->input('IdEmpleado');

        $view = view('HijoEmpleado.index')->with(['titulo' =>'Hijos del empleado','IdEmpleado'=>$IdEmpleado]);
    	if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }  
    }

   	public function datatableListEmpleadoHijo(Request $request){
        // Datos de DATATABLE
        $IdEmpleadoP = $request->get("IdEmpleadoP");
        $search = $request->get("search");
        $order = $request->get("order");
        $sortColumnIndex = $order[0]['column'];
        $sortColumnDir = $order[0]['dir'];
        $length = $request->get('length');
        $start = $request->get('start');
        $columna = $request->get('columns');
        $orderBy = $columna[$sortColumnIndex]['data'];
        
        $result = HijoEmpleado_Model::join('tipodocumento','tipodocumento.Id','=','hijoempleado.IdGenero')
        ->join('empleado','empleado.Id','=','hijoempleado.IdEmpleado')
         ->select(
         	'hijoempleado.ID',
			'hijoempleado.Nombre',
			'hijoempleado.Apellido',
			'hijoempleado.IdTipoDocumento',
			'hijoempleado.NumeroDocumento',
			'hijoempleado.FechaNacimiento',
			'hijoempleado.Estado',
			'tipodocumento.Nombre')->where('empleado.ID',$IdEmpleadoP);
                                    //->orderBy("Idresult", "desc");//

        $result  = $result->orderBy($orderBy, $sortColumnDir);  
      
        $totalRegistros = $result->count();
        //BUSCAR            
            if($search['value'] != null){
                $result = $result->whereRaw(
                        "(ID LIKE '%".$search["value"]."%' OR ". 
                         "Nombre LIKE '%". $search['value'] . "%' OR " .
                         "Apellido LIKE '%". $search['value'] . "%' OR " .
                         "NumeroDocumento LIKE '%". $search['value'] . "%' OR " .
                         "FechaNacimiento LIKE '%". $search['value'] . "%' OR " .
                         "tipodocumento.Nombre LIKE '%". $search['value']. "%')");
            }
        
        $parcialRegistros = $result->count();
        $result = $result->skip($start)->take($length);

        $data = ['length'=> $length,
                'start' => $start,
                'buscar' => $search['value'],
                'draw' => $request->get('draw'),
                'last_query' => $result->toSql(),
                'recordsTotal' =>$totalRegistros,
                'orderBy'=>$orderBy,
                'recordsFiltered' =>$parcialRegistros,
                'data' =>$result->get()];

        return response()->json($data);
    }

    public function postForm(Request $request)
    {
        $IdEmpleado = $request->input('IdEmpleado');
        $ID = $request->input('ID');
        echo $ID;
        $datos = $ID == "" ? new HijoEmpleado_Model() : HijoEmpleado_Model::find($ID);
        $tipodoc = [null=>'Seleccione...'];
        $tipodoc = TipoDocumentoModel::orderBy('ID','asc')->pluck('Nombre','Id');
        $view = view('HijoEmpleado.formHijoEmpleado')->with(['datos' => $datos, 'tipodoc'=>$tipodoc,'IdEmpleado'=>$IdEmpleado]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }


}
