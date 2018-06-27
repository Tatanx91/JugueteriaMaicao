<?php

namespace Jugueteria\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Seguridad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // if(auth()->check() && auth()->user()->TipoUsuario == 1){
        if (Auth::check() && Auth::user()->TipoUsuario = 1) {
            return redirect('/Usuarios');
        }
        else{
            return redirect('/Inicio');
        }

        return $next($request);


        // if(auth()->check() && auth()->user()->TipoUsuario == 1)
        //     return $next($request);

        // return redirec('/Inicio');
    }
}
