<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\Empresa;
use App\Http\Requests;
use Jugueteria\model\Empresa_Model;
use Jugueteria\model\TipoDocumento_Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\model\UsuariosModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use File;

class EmpresaController extends Controller
{
    public function __construct(){
        //$this->middleware('auth', ['except' => ['Index,datatableJuguete,datatableListJuguete,postStore,postFormJuguete']]);
         $this->middleware(['auth:web' || 'auth:api']); 
    }

    public function Masivoempresa(Request $request){
        $titulo = "masivo Empresa";
        $datos =  new Empresa_Model();
        $datos['IdEmpresa'] = 1;
        $view = view('Empresa.MasivoEmpresa')->with(['titulo' => $titulo,'datos'=>$datos]);

          if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }  
        //return view('Empresa.index');
    }

    public function Index()
    {
        if(Session::get("PRIVILEGIOS") == null){
            Session::forget('PRIVILEGIOS');
            return redirect::to('/');
        }

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
        $orderBy = $columna[$sortColumnIndex]['data'] == 'ID' ? 'Empresa.ID' :  $columna[$sortColumnIndex]['data'];
        
        $empresas = Empresa_Model::join('TipoDocumento','TipoDocumento.Id','=','Empresa.IdTipoDocumento')
        //join('TipoDocumento','TipoDocumento.ID','=','Empresa.IdTipoDocumento')
                 ->select(
                        'Empresa.ID',
                        'Empresa.IdUsuario',
                        'Empresa.Nombre',
                        'Empresa.IdTipoDocumento',
                        'TipoDocumento.Nombre AS NombreTipoDocumento',
                        'Empresa.NumeroDocumento',
                        'Empresa.Logo',
                        'Empresa.Estado');
                        //->orderBy("IdEmpresa", "desc");)

        $empresas = $empresas->orderBy($orderBy, $sortColumnDir);  
      
        $totalRegistros = $empresas->count();
        //BUSCAR            
            if($search['value'] != null){
                $empresas = $empresas->whereRaw(
                        "(Id LIKE '%".$search["value"]."%' OR ". 
                         "Nombre LIKE '%". $search['value'] . "%' OR " .
                         //"NombreTipoDocumento LIKE '%". $search['value'] . "%' OR " .
                         "NumeroDocumento LIKE '%". $search['value'] . "%')");
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
            $IdEmpresa = $request->input('ID');
            $empresas = $IdEmpresa == "" ? new Empresa_Model() : Empresa_Model::find($IdEmpresa);
            $empresas['Estado'] = 1;
            $empresas['IdUsuario'] = 1;
            $data = $request->all();
            $empresas->fill($data);
            $empresas->save();
    
        } catch (Exception $e) {
            // return response([
            //         "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
            //         "error" => $e->getMessage()
            //     ]);

            $retorno = [
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ];

            return response()->json($retorno);
        }
        
        // return response([
        //         "success" => true,
        //         "mensaje" => "Datos guardados correctamente",
        //         //"request" => $request->all(),
        //         "empresas" => $empresas
        //     ]);

         $retorno = [
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "usuario" => $empresas
            ];

        return response()->json($retorno);
    }

    public function postFormempresa(Request $request)
    {
        $titulo = "Empresas";
        $empresaID = $request->input('IdItem');
        $empresas = $empresaID == "" ? new Empresa_Model() : Empresa_Model::find($empresaID);

        $tipodocumento = [null=>'Seleccione...'];
        $tipodocumento = TipoDocumento_Model::orderBy('ID','asc')->pluck('Nombre','ID');

        $view = view('Empresa.formEmpresa')->with(['empresa' => $empresas, 'titulo' => $titulo,'tipodocumento'=>$tipodocumento]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }

    public function cambiaEstado(Request $request)
    {
        try {
            $IdEmpresa = $request->input('ID');
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

    public function GuardarTxt(Request $request){
        try{

                $data = $request->all();
                $fecha = \DateTime::createFromFormat('Y-m-d', date('Y-m-d H:i:s'));

                $file = $request->file('file');
                $allowedFiles = array('txt');
                $path = public_path().'/uploads/Masivo/empresa/'.$fecha.'/'; 

                if($file != null ){
                    $archivo =  str_replace(" ", "_", $file->getClientOriginalName());
                    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    if(in_array($extension,$allowedFiles)){                    
                        if(!file_exists($path)){
                          mkdir($path,0777,true);
                          chmod($path, 0777); 
                        }                       
                    }

                    $fileName = str_replace(" ", "_", $file->getClientOriginalName());
                    $file->move($path, 'empresa.'.$extension);   
                    $leerarchivo = explode("\n",File::get($path. '/empresa.'.$extension));

                        $result_texto = '';
                   // var_dump($leerarchivo);
                    foreach ($leerarchivo as $key=>$line){
                        $datosLinea = explode(',', $line);
                        //echo count($datosLinea);
                         $datos =  new Empresa_Model();
                         $datosusu = new UsuariosModel();
                        if(count($datosLinea) > 0  && count($datosLinea) == 4){
                            if(is_string($datosLinea[0])){
                                $datos['Nombre'] = $datosLinea[0];
                                if(is_string($datosLinea[1])){
                                    $id_codigo = TipoDocumento_Model::where('Codigo',$datosLinea[1])->select('ID')->first();
                                    $datos['IdTipoDocumento'] = ($id_codigo['ID'] != null)?$id_codigo['ID']:1;
                                    if(is_string($datosLinea[2])){  
                                        $datos['NumeroDocumento'] = $datosLinea[2];
                                        if( $this->email($datosLinea[3])){
                                            $datosusu['Correo'] = $datosLinea[3];
                                        }else{
                                            $result_texto .= '| Email no valido, linea:'.$key.' |';
                                        }
                                    }else{
                                        $result_texto .= '| NumeroDocumento no valido, linea:'.$key.' |';
                                    }
                                }else{
                                    $result_texto .= '| IdTipoDocumento no valido, linea:'.$key.' |';
                                }
                            }else{
                                $result_texto .= '| Nombre no valido, linea:'.$key.' |';
                            }
                            if($result_texto == ''){
                                //$datosusu['Login'] = $datos['NumeroDocumento'];
                                $datosusu['Contrasena'] = $datos['NumeroDocumento'];
                                $datosusu['Confirmado'] = 0;
                                $datosusu['CodigoConf'] = "";
                                $datosusu['IdTipoUsuario'] = 3;
                                $datosusu->save();
                                $datos['IdUsuario'] = $datosusu->ID;

                                //$datos['IdUsuario'] = 1;
                                $datos->save();
                                //var_dump($datos);
                            }
                        }else{
                            $result_texto .= 'Error  al guardar. Cadena de texto no conside, linea: '.$key ;
                        }
                    }

                    if($result_texto != ''){
                        return response()->json([
                                'mensaje'=>$result_texto,    
                                'error' => 'error'
                            ]);
                    }
                }else{
                    return response()->json([
                    'mensaje'=>"Error al guardar. Extensión no válida."        
                    
                    ]);
                }
            return response()->json([
               'mensaje'=> "Datos guardados Correctamente", 
               'success' => 'success'
             ]);

        }catch (Exception $e) {
            return response()->json([
                'mensaje'=>"Error  al guardar. Por favor intenta de nuevo.",         
                'error' => $e->getMessage()
            ]);
        }
    }

    function email($str){
      return (false !== strpos($str, "@") && false !== strpos($str, "."));
    }


}
