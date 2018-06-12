<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\model\UsuariosModel;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\http\Request\UsuarioFormReqest;
use DB;
use Mail;

class UsuarioController extends Controller
{
    public function __construct()
    {

    }


    public function index(Request $request)
    {
    	$nombre ='';
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
    		$Usuarios=DB::table('Usuarios')-> where('NombreUsuario','LIKE','%'.$query.'%')
    		->where('ApellidoUsuario','like','%'.$query.'%')
    		->orderBy('NombreUsuario')
    		->paginate(7);

    		return view('Usuario.index');
    	}

    }
    public function getIndex()
    {
        $Usuario = UsuariosModel::orderBy('NombreUsuario', 'desc')->get();
        return view('Usuario.ConsultarUsuarios',compact('UsuariosModel'));
        //return view('Usuario.ConfirmacionUsuario',compact('UsuariosModel'));
    }
    
/*
    public function create()
    {
    	return view("Usuario.Usuarios.create");
    }
*/
    public function store(request $request)
    {

        
        $this->validate($request,[
            'NombreUsuario'=>'Required',
            'NumeroDocumento'=>'Required',
            'Contrasena'=>'Required'
        ]);
        

        $NombreUsuario = $request ['NombreUsuario'];
        $NumeroDocumento = $request ['NumeroDocumento'];
        //$contrasena = bcrypt($request ['Contrasena']);
        $contrasena = md5($request ['Contrasena']);
        $Correo = $request ['Correo'];

        $usuario = new usuario();
        $usuario->NombreUsuario = $NombreUsuario;
        $usuario->NumeroDocumento = $NumeroDocumento;
        $usuario->Contrasena = $contrasena;
        $usuario->Correo = $Correo;

        $usuario->save();
        //redirect('create');
        //return request()->back();
        //return "Ke esta hacieeendooooo!!!!";
        return view('Usuario.create');

    }

    public function postStore(request $request)
    {

        try{
            
            $data = $request->all();
            $data['CodigoConf'] = str_random(25);
            $data['Contrasena'] = md5($request['Contrasena']);


            $IdUsuario = $request->input('IdUsuario');
            $usuario = $IdUsuario == "" ? new UsuariosModel() : UsuariosModel::find($IdUsuario);
            $usuario['Confirmado'] = 0;
            $usuario['Estado'] = 1;
            $usuario['CodigoConf'] = $data['CodigoConf'];            

            $usuario->fill($data);
            $usuario->save();

            $token = $request['_token'];

            //envio correo de confirmacion
            Mail::send('Correos.CodigoDeConfirmacion',['data' => $data],function($mensaje) use ($data){
                $mensaje->from('jonathandev123@gmail.com');
                $mensaje->to($data['Correo'], $data['NombreUsuario'])->subject('Por favor cofirmar el correo');
            });
            

        } catch (Exception $e) {

            $retorno = [
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ];

            return response()->json($retorno);
        }
        
            $retorno = [
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "usuario" => $usuario
            ];

        return view('Usuario.ConsultarUsuarios');

    }

    public function VerificarUsuario($CodigoConf)
    {
        $usuarios = UsuariosModel::where('CodigoConf', $CodigoConf);
        $existe = $usuarios->count();
        $usuario = $usuarios->first();

        if($existe == 1 > 0 and $usuario->Confirmado == 0)
        {
            $id = $usuario->IdUsuario;
            
            return view('Usuario.CambioContrasena',compact('IdUsuario'));
        }
        else{
            return redirect::to('datatableListUsuario');
        }
    }

    public function datatableListUsuario(Request $request){
        //Datos de datadable
        $search = $request->get("search");
        $order = $request->get("order");
        $sortColumnIndex = $order[0]['column'];
        $sortColumnDir = $order[0]['dir'];
        $length = $request->get('length');
        $start = $request->get('start');
        $columna = $request->get('columns');
        $orderBy = $columna[$sortColumnIndex]['data'];

        $usuario = UsuariosModel:://table('usuarios')
            select(
                'IdUsuario',
                'NumeroDocumento',
                'NombreUsuario',
                'ApellidoUsuario',
                'Correo',
                'TipoUsuario');

        $usuario  = $usuario->orderBy($orderBy, $sortColumnDir);  

        $totalRegistros = $usuario->count();

         if($search['value'] != null){
                $usuario = $usuario->whereRaw(
                        "(IdUsuario LIKE '%".$search["value"]."%' OR ". 
                         "NumeroDocumento LIKE '%". $search['value'] . "%' OR " .
                         "NombreUsuario LIKE '%". $search['value'] . "%' OR " .
                         "Correo LIKE '%". $search['value'] . "%' OR " .
                         "ApellidoUsuario LIKE '%". $search['value'] . "%' OR " .
                         "TipoUsuario LIKE '%". $search['value']. "%')");
            }
        
        $parcialRegistros = $usuario->count();
        $usuario = $usuario->skip($start)->take($length);

        $data = ['length'=> $length,
                'start' => $start,
                'buscar' => $search['value'],
                'draw' => $request->get('draw'),
                'last_query' => $usuario->toSql(),
                'recordsTotal' =>$totalRegistros,
                'orderBy'=>$orderBy,
                'recordsFiltered' =>$parcialRegistros,
                'data' =>$usuario->get()];

        return response()->json($data);
    }

    public function show()
    {

    }

    public function edit($idUsuario)
    {
        $usuario = Usuario::edit($idUsuario);   
        return view('Usuario.Editar',compact('Usuario'));
    }

    public function update(request $request, $idUsuario)
    {
        $this->validate($request,[
            'NombreUsuario'=>'Required',
            'NumeroDocumento'=>'Required',
            'Contrasena'=>'Required'
        ]);

        $usuario = Usuario::dbplus_find($idUsuario);
        $usuarioUpdate = $request->all();
        $usuario->update($usuarioUpdate);

        return view('Usuario.create');
    }

    public function postFormusuario(request $request)
    {
        $titulo = "Usuario";
        $IdUsuario = $request->input('IdUsuario');
        $usuario = $IdUsuario == "" ? new UsuariosModel() : UsuariosModel::find($idUsuario);

        //$genero = [null=>'Seleccione...'];
        //$genero = Genero_model::orderBy('IdGenero','asc')->pluck('NombreGenero','IdGenero');

        $view = view('Usuario.FormUsuario')->with(['usuario' => $usuario, 'titulo' => $titulo]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }

    public function cambiaEstadoUsuario(Request $request)
    {
        try {
            
            $IdUsuario = $request->input('IdUsuario');
            $estado = $request->input('estado');
            $usuario = UsuariosModel::find($IdUsuario);
            $usuario['estado'] = $estado;
            $data = $request->all();
            $usuario->fill($data);
            $usuario->save();
    
        } catch (Exception $e) {
            return response([
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ]);
        }
        
        // return response([
        //         "success" => true,
        //         "mensaje" => "Datos guardados correctamente",
        //         //"request" => $request->all(),
        //         "usuario" => $usuario
        //     ]);

        $retorno = [
        "success" => true,
        "mensaje" => "Datos guardados correctamente",
        //"request" => $request->all(),
        "usuario" => $usuario
        ];

        return view('Usuario.ConsultarUsuarios');
    }

    public function destroy()
    {
    	
    }


}

