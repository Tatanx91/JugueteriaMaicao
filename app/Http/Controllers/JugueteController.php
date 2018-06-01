<?php

namespace Jugueteria\Http\Controllers;

use Jugueteria\Juguete;
use Illuminate\Http\Request;
use App\Http\Requests;
use Jugueteria\model\Juguete_model;
use Jugueteria\model\Genero_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JugueteController extends Controller
{
    public function __construct(){
        //$this->middleware('auth', ['except' => ['Index,datatableJuguete,datatableListJuguete,postStore,postFormJuguete']]);
         $this->middleware(['auth:web' || 'auth:api']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {

        return view('Juguete.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableListJuguete(Request $request){
        // Datos de DATATABLE
        $search = $request->get("search");
        $order = $request->get("order");
        $sortColumnIndex = $order[0]['column'];
        $sortColumnDir = $order[0]['dir'];
        $length = $request->get('length');
        $start = $request->get('start');
        $columna = $request->get('columns');
        $orderBy = $columna[$sortColumnIndex]['data'];
        
        $juguete = Juguete_model::join('genero','genero.IdGenero','=','juguete.IdGenero')
         ->select(
                'juguete.IdJuguete',
                'juguete.NumeroReferencia',
                'juguete.NombreJuguete',
                'juguete.Dimensiones',
                'juguete.EdadInicial',
                'juguete.EdadFinal',
                'juguete.IdGenero',
                'juguete.estado',
                'genero.IdGenero',
                'genero.NombreGenero');
                                    //->orderBy("IdJuguete", "desc");//

        $juguete  = $juguete->orderBy($orderBy, $sortColumnDir);  
      
        $totalRegistros = $juguete->count();
        //BUSCAR            
            if($search['value'] != null){
                $juguete = $juguete->whereRaw(
                        "(IdJuguete LIKE '%".$search["value"]."%' OR ". 
                         "NumeroReferencia LIKE '%". $search['value'] . "%' OR " .
                         "NombreJuguete LIKE '%". $search['value'] . "%' OR " .
                         "Dimensiones LIKE '%". $search['value'] . "%' OR " .
                         "EdadInicial LIKE '%". $search['value'] . "%' OR " .
                         "EdadFinal LIKE '%". $search['value'] . "%' OR " .
                         "genero.NombreGenero LIKE '%". $search['value']. "%')");
            }
        
        $parcialRegistros = $juguete->count();
        $juguete = $juguete->skip($start)->take($length);

        $data = ['length'=> $length,
                'start' => $start,
                'buscar' => $search['value'],
                'draw' => $request->get('draw'),
                'last_query' => $juguete->toSql(),
                'recordsTotal' =>$totalRegistros,
                'orderBy'=>$orderBy,
                'recordsFiltered' =>$parcialRegistros,
                'data' =>$juguete->get()];

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        try {
            
            $IdJuguete = $request->input('IdJuguete');
            $juguete = $IdJuguete == "" ? new Juguete_model() : Juguete_model::find($IdJuguete);
            $juguete['Imagenes'] = 'prueba';
            $juguete['estado'] = 1;
            $data = $request->all();
            $juguete->fill($data);
            $juguete->save();
    
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
                "juguete" => $juguete
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Jugueteria\Juguete  $juguete
     * @return \Illuminate\Http\Response
     */
    public function postFormjuguete(Request $request)
    {
        $titulo = "Juguetes";
        $jugueteID = $request->input('IdJuguete');
        $juguete = $jugueteID == "" ? new Juguete_model() : Juguete_model::find($jugueteID);

        $genero = [null=>'Seleccione...'];
        $genero = Genero_model::orderBy('IdGenero','asc')->pluck('NombreGenero','IdGenero');

        $view = view('Juguete.formJuguete')->with(['juguete' => $juguete, 'titulo' => $titulo,'genero'=>$genero]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }


    public function cambiaEstado(Request $request)
    {
        try {
            
            $IdJuguete = $request->input('IdJuguete');
            $estado = $request->input('estado');
            $juguete = Juguete_model::find($IdJuguete);
            $juegute['estado'] = $estado;
            $data = $request->all();
            $juguete->fill($data);
            $juguete->save();
    
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
                "juguete" => $juguete
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Jugueteria\Juguete  $juguete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juguete $juguete)
    {
        //
    }
}
