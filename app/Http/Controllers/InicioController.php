<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function Index()
    {

            return view('Templates.master');
    }
}
