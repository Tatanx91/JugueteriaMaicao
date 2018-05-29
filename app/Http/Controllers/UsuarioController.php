<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\Usuario;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\http\Request\UsuarioFormReqest;
use DB;

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
        //$Usuario = Usuario::all();
        $Usuario = Usuario::orderBy('NombreUsuario', 'desc')->get();
        return view('Usuario.ConsultarUsuarios',compact('Usuario'));
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
        $contrasena = bcrypt($request ['Contrasena']);

        $usuario = new usuario();
        $usuario->NombreUsuario = $NombreUsuario;
        $usuario->NumeroDocumento = $NumeroDocumento;
        $usuario->Contrasena = $contrasena;

        $usuario->save();
        //redirect('create');
        //return request()->back();
        //return "Ke esta hacieeendooooo!!!!";
        return view('Usuario.create');

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

    public function destroy()
    {
    	
    }


}

