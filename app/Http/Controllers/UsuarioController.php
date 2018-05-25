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

            return view('Usuario.index');
    }
    
/*
    public function create()
    {
    	return view("Usuario.Usuarios.create");
    }
*/
    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
    	
    }


}
