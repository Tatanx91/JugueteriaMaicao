<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\model\UsuariosModel;
use Illuminate\Support\Facades\Auth;
use Jugueteria\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;
use Illuminate\Support\Facades\Session;

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

        // $usuarios = UsuariosModel::where('Correo', $credentials['Correo']);
        $usuarios = UsuariosModel::join('TipoUsuario', 'TipoUsuario.ID' ,'=', 'Usuario.IdTipoUsuario')
            //->join('Administrador', 'Administrador.IdUsuario' ,'=', 'Usuario.ID')
            ->where('Usuario.Correo', $credentials['Correo']);
        $existe = $usuarios->count();
        $usuario = $usuarios->first();

        Session::forget('PRIVILEGIOS');
        $session = null;
        if($usuario != null ){
            if($usuario->IdTipoUsuario == 1){
                $session = UsuariosModel::join('TipoUsuario', 'TipoUsuario.ID' ,'=', 'Usuario.IdTipoUsuario')
                        ->join('Administrador', 'Administrador.IdUsuario' ,'=', 'Usuario.ID')
                        ->where('Usuario.Correo', $credentials['Correo'])->first();
            }
            if($usuario->IdTipoUsuario == 2 || $usuario->IdTipoUsuario == 3){
                $session = UsuariosModel::join('TipoUsuario', 'TipoUsuario.ID' ,'=', 'Usuario.IdTipoUsuario')
                        ->join('empleado', 'empleado.IdUsuario' ,'=', 'Usuario.ID')
                        ->where('Usuario.Correo', $credentials['Correo'])->first();
            }
        }
if($session != null){
        Session::put("PRIVILEGIOS", $session);
        if($existe > 0 and $usuario['Confirmado'] == 0){

            $nombreUsuario = $usuario['NombreUsuario'];
            $numeroDocumento = $usuario['NumeroDocumento'];
            $codigoConfirmacion = $usuario['CodigoConf'];

            $largo = strlen($numeroDocumento);

            $PrimeraContraseña = strtoupper(substr($nombreUsuario,0,1));
            $PrimeraContraseña = md5($PrimeraContraseña .substr($numeroDocumento,$largo - 4,4));

            if($PrimeraContraseña == $Contrasena)
            {
                return redirect::to('/registro/verificacion/'.$codigoConfirmacion);
            }
            else
            {
                return 'La contraseña inicial asignada no es correcta';
            }

            
        }

        // if (! $token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);
        // return view('Usuario.ConsultarUsuarios');
        // return view('Juguete.Index');
        // return view('Templates.Menu');
        // return view('Mensajes.MensajeErrorLogin');
        // 
        return redirect::to('/inicio/menu');
}else{
    return redirect::to('/');
}
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
        \auth()->logout();

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

