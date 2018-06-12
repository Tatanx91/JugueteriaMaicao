<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jugueteria\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

class AuthController extends Controller
{
	/**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['Correo', 'Contrasena']);
        $Contrasena = md5($credentials['Contrasena']);
        $credentials['Contrasena'] =$Contrasena;

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        //return $this->respondWithToken($token);
        return view('Usuario.ConsultarUsuarios',compact('UsuariosModel'));

        // $Correo = $request['Correo'];
        // //$Contrasena = bcrypt($request['Contrasena']);
        // $Contrasena = md5($request['Contrasena']);

        // $credentials = request(['Correo', 'Contrasena']);
        // $credentials['Contrasena'] = $Contrasena;
    }

    public function CambiarContrasena(Request $request, $IdUsuario)
    {
        $Usuario = UsuariosModel::find($IdUsuario);
        $Usuario->Contrasena =  md5($request['Contrasena']);
        $Usuario->Confirmado = 1;
        $Usuario->save();

        return redirect::to('/Inicio');

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 120,
        ]);
    }
}

