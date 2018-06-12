<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
//Route::resourses('Usuarios'=>'UsuarioController');
//Route::get('/','UsuarioController@index');
Route::get('Inicio','InicioController@index');
Route::get('Inicio', array(
    'as' => 'Inicio',
    'uses' => 'InicioController@index'
));

Route::get('Usuarios','UsuarioController@getIndex');
Route::get('/login','AuthController@login');

Route::post('/login',[
	'uses' => 'AuthController@login',
	'as' => 'login'
]);

Route::post('/CambiarContrasena',[
    'uses' => 'AuthController@CambiarContrasena',
    'as' => 'CambiarContrasena'
]);

//Rutas Usuarios
Route::post('/RegistrarUsuario',[
	'uses' => 'UsuarioController@store',
	'as' => 'CrearUsuario'
]);

Route::post('/EditarUsuario',[
	'uses' => 'UsuarioController@edit',
	'as' => 'EditarUsuario'
]);

Route::get('/Usuario/datatableListUsuario', array(
    'as' => 'datatableListUsuario',
    'uses' => 'UsuarioController@datatableListUsuario'
));

Route::post('/Usuario/CambiaEstadoUsuario',[
    'as' => 'cambiaEstado',
    'uses' => 'UsuarioController@cambiaEstadoUsuario'
]);

Route::post('/usuario/postStore',[
    'as' => 'StoreUsuario',
    'uses' => 'UsuarioController@postStore'
]);

Route::get('/usuario/postFormusuario',[
    'as' => 'postFormusuario',
    'uses' => 'UsuarioController@postFormusuario'
]);

Route::post('/usuario/postFormusuario',[
    'as' => 'postFormusuario',
    'uses' => 'UsuarioController@postFormusuario'
]);

//Rutas Juguetes

//Route::resources(['juguete'=> 'JugueteController']);
//Route::resources(['juguete'=> 'JugueteController']);
//Route::post('/juguete/postFormJuguete','JugueteController@postFormJuguete');
// Route::resource(['juguete'=> 'JugueteController'])
// ->except([
//     'postStore', 'datatableListJuguete'
// ]);
Route::get('/juguete','JugueteController@index');
Route::get('/juguete/postFormjuguete', array(
    'as' => 'postFormjuguete',
    'uses' => 'JugueteController@postFormjuguete'
));
Route::post('/juguete/postStore',[
    'as' => 'postStore',
    'uses' => 'JugueteController@postStore'
]);

Route::post('/juguete/postFormjuguete', array(
    'as' => 'postFormjuguete',
    'uses' => 'JugueteController@postFormjuguete'
));

Route::get('/juguete/datatableListJuguete', array(
    'as' => 'datatableListJuguete',
    'uses' => 'JugueteController@datatableListJuguete'
));


Route::post('/juguete/cambiaEstado',[
    'as' => 'cambiaEstado',
    'uses' => 'JugueteController@cambiaEstado'
]);


//Rutas correos
Route::get('/registro/verificacion/{CodigoConf}', array(
    'as' => 'verificacion',
    'uses' => 'UsuarioController@VerificarUsuario'
));