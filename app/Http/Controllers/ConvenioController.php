<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\Empresa;
use App\Http\Requests;
use Jugueteria\model\Empresa_Model;
use Jugueteria\model\TipoDocumento_Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EmpresaController extends Controller
{
    public function __construct(){
        //$this->middleware('auth', ['except' => ['Index,datatableJuguete,datatableListJuguete,postStore,postFormJuguete']]);
         $this->middleware(['auth:web' || 'auth:api']); 
    }

    public function Index()
    {
        return view('Empresa.index');
    }

    public function datatableListEmpresa(Request $request){
        $search = $request->get("search");
        $order = $request->get("order");
        $sortColumnIndex = $order[0]['column'];
        $sortColumnDir = $order[0]['dir'];
        $length = $request->get('length');
        $start = $request->get('start');
        $columna = $request->get('columns');
        $orderBy = $columna[$sortColumnIndex]['data'];
        
        $empresas = Empresa_Model::join('tipodocumento','tipodocumento.IdTipoDocumento','=','empresas.IdTipoDocumento')
         ->select(
                'empresas.IdEmpresa',
                'empresas.NombreEmpresa',
                'tipodocumento.IdTipoDocumento',
                'tipodocumento.NombreTipoDocumento',
                'empresas.NumeroDocumento',
                'empresas.Logo',
                'empresas.Password',
                'empresas.Estado');
                //->orderBy("IdEmpresa", "desc");

        $empresas = $empresas->orderBy($orderBy, $sortColumnDir);  
      
        $totalRegistros = $empresas->count();
        //BUSCAR            
            if($search['value'] != null){
                $empresas = $empresas->whereRaw(
                        "(IdEmpresa LIKE '%".$search["value"]."%' OR ". 
                         "NombreEmpresa LIKE '%". $search['value'] . "%' OR " .
                         "NombreTipoDocumento LIKE '%". $search['value'] . "%' OR " .
                         "NumeroDocumento LIKE '%". $search['value'] . "%' OR " .
                         "Logo LIKE '%". $search['value'] . "%' OR " .
                         "Password LIKE '%". $search['value'] ."%')");
            }
        
        $parcialRegistros = $empresas->count();
        $empresas = $empresas->skip($start)->take($length);

        $data = ['length'=> $length,
                'start' => $start,
                'buscar' => $search['value'],
                'draw' => $request->get('draw'),
                'last_query' => $empresas->toSql(),
                'recordsTotal' =>$totalRegistros,
                'orderBy'=>$orderBy,
                'recordsFiltered' =>$parcialRegistros,
                'data' =>$empresas->get()];

        return response()->json($data);
    }

    public function postStore(Request $request)
    {
        try {
            $IdEmpresa = $request->input('IdEmpresa');
            $empresas = $IdEmpresa == "" ? new Empresa_Model() : Empresa_Model::find($IdEmpresa);
            $empresas['Estado'] = 1;
            $data = $request->all();
            $empresas->fill($data);
            $empresas->save();
    
        } catch (Exception $e) {
            return response([
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ]);
        }
        
        return response([
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "empresas" => $empresas
            ]);
    }

    public function postFormempresa(Request $request)
    {
        $titulo = "Empresas";
        $empresaID = $request->input('IdItem');
        $empresas = $empresaID == "" ? new Empresa_Model() : Empresa_Model::find($empresaID);

        $tipodocumento = [null=>'Seleccione...'];
        $tipodocumento = TipoDocumento_Model::orderBy('IdTipoDocumento','asc')->pluck('NombreTipoDocumento','IdTipoDocumento');

        $view = view('Empresa.formEmpresa')->with(['empresas' => $empresas, 'titulo' => $titulo,'tipodocumento'=>$tipodocumento]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }

    public function cambiaEstado(Request $request)
    {
        try {
            
            $IdEmpresa = $request->input('IdEmpresa');
            $Estado = $request->input('Estado');
            $empresas = Empresa_Model::find($IdEmpresa);
            $empresas['Estado'] = $Estado;
            $data = $request->all();
            $empresas->fill($data);
            $empresas->save();
    
        } catch (Exception $e) {
            return response([
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ]);
        }
        
        return response([
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "empresas" => $empresas
            ]);
    }

    public function destroy(Empresas $empresas)
    {
        //
    }
}
