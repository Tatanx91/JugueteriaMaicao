<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class InicioController extends Controller
{
    public function Index()
    {
    	if(Session::get("PRIVILEGIOS") != null)
        	Session::forget('PRIVILEGIOS');
        return view('Templates.master');
    }

 	public function indexMenu()
    {
        return view('Templates.Menu');
    }
}
