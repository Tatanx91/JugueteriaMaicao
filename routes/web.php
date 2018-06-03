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
Route::get('/','InicioController@index');

Route::get('/abrirform','UsuarioController@getIndex');
Route::get('/login','AuthController@login');

Route::post('/login',[
	'uses' => 'AuthController@login',
	'as' => 'login'
]);

Route::post('/RegistrarUsuario',[
	'uses' => 'UsuarioController@store',
	'as' => 'CrearUsuario'
]);

Route::post('/EditarUsuario',[
	'uses' => 'UsuarioController@edit',
	'as' => 'EditarUsuario'
]);