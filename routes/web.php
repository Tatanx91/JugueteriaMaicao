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
Route::get('/', array(
    'as' => 'Inicio',
    'uses' => 'InicioController@index'
));

// Route::group(['prefix' => 'seguridad', 'middleware' => 'seguridad', 'namespace' => 'jugueteria'], function(){
    
//     Route::get('Usuarios','UsuarioController@getIndex');
//     Route::get('/juguete','JugueteController@index');
// });

Route::get('/Usuarios','UsuarioController@getIndex');
Route::get('/Juguete','JugueteController@index');

//Autenticacion
// Route::get('/login','AuthController@login');
Route::post('/login',[
    'uses' => 'AuthController@login',
    'as' => 'login'
]);

Route::get('/inicio/menu',[
    'as' => 'indexMenu',
    'uses' => 'InicioController@indexMenu'
]);



Route::post('/CambiarContrasena',[
    'uses' => 'UsuarioController@CambiarContrasena',
    'as' => 'CambiarContrasena'
]);

Route::get('/Contrasena/FormRecuperar',[
    'uses' => 'UsuarioController@FormRecuperar',
    'as' => 'FormRecuperarContrasena'
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

Route::get('/Empleado','EmpleadoController@index');
Route::get('/Empleado/Index/{Id}', array(
    'as' => 'Empleado',
    'uses' => 'EmpleadoController@index'
));

Route::get('/empleado/postFormempleado', array(
    'as' => 'postFormempleado',
    'uses' => 'EmpleadoController@postFormempleado'
));
Route::post('/empleado/postStore',[
    'as' => 'postStore',
    'uses' => 'EmpleadoController@postStore'
]);

Route::post('/empleado/postFormempleado', array(
    'as' => 'postFormempleado',
    'uses' => 'EmpleadoController@postFormempleado'
));

Route::get('/empleado/datatableListEmpleado', array(
    'as' => 'datatableListEmpleado',
    'uses' => 'EmpleadoController@datatableListEmpleado'
));


Route::post('/empleado/Masivoempleado',[
    'as' => 'Masivoempleado',
    'uses' => 'EmpleadoController@Masivoempleado'
]);

Route::post('/empleado/postStoremasivos',[
    'as' => 'postStoremasivos',
    'uses' => 'EmpleadoController@postStoremasivos'
]);
Route::post('/empleado/GuardarTxt',[
    'as' => 'GuardarTxt',
    'uses' => 'EmpleadoController@GuardarTxt'
]);



Route::post('/HijoEmpleado/Index',[
    'as' => 'Index',
    'uses' => 'HijoEmpleadoController@index'
]);
Route::get('/HijoEmpleado/datatableListEmpleadoHijo', array(
    'as' => 'datatableListEmpleadoHijo',
    'uses' => 'HijoEmpleadoController@datatableListEmpleadoHijo'
));


Route::post('/HijoEmpleado/postForm/',[
    'as' => 'postForm',
    'uses' => 'HijoEmpleadoController@postForm'
]);

//Rutas correos
Route::get('/registro/verificacion/{CodigoConf}', array(
    'as' => 'verificacion',
    'uses' => 'UsuarioController@VerificarUsuario'
));

Route::post('/Contrasena/EmailRecuperarContrasena', array(
    'as' => 'EmailRecuperar',
    'uses' => 'UsuarioController@EnviarRecuperarContrasena'
));

Route::get('/Contrasena/RecuperarContrasena/{CodigoConf}', array(
    'as' => 'RecuperarContrasena',
    'uses' => 'UsuarioController@RecuperarContrasena'
));

Route::post('/Contrasena/RecuperarCambiarContrasena', array(
    'as' => 'RecuperarCambiarContrasena',
    'uses' => 'UsuarioController@RecuperarCambiarContrasena'
));


Route::get('/Galeria/getGaleriaImg', array(
    'as' => 'getGaleriaImg',
    'uses' => 'GaleriaImgController@getGaleriaImg'
));


Route::post('/Galeria/GuardarImg', array(
    'as' => 'GuardarImg',
    'uses' => 'GaleriaImgController@GuardarImg'
));


Route::post('/Galeria/CargarContenedorImg', array(
    'as' => 'CargarContenedorImg',
    'uses' => 'GaleriaImgController@CargarContenedorImg'
));


// Rutas Empresa:
Route::get('/Empresa','EmpresaController@index');
Route::get('/empresa/postFormempresa', array(
    'as' => 'postFormempresa',
    'uses' => 'EmpresaController@postFormempresa'
));
Route::post('/empresa/postStore',[
    'as' => 'postStore',
    'uses' => 'EmpresaController@postStore'
]);

Route::post('/empresa/postFormempresa', array(
    'as' => 'postFormjuguete',
    'uses' => 'EmpresaController@postFormempresa'
));

Route::get('/empresa/datatableListEmpresa', array(
    'as' => 'datatableListEmpresa',
    'uses' => 'EmpresaController@datatableListEmpresa'
));

Route::post('/empresa/cambiaEstado',[
    'as' => 'cambiaEstado',
    'uses' => 'EmpresaController@cambiaEstado'
]);
Route::post('/empresa/Masivoempresa',[
    'as' => 'Masivoempresa',
    'uses' => 'EmpresaController@Masivoempresa'
]);

Route::post('/empresa/postStoremasivos',[
    'as' => 'postStoremasivos',
    'uses' => 'EmpresaController@postStoremasivos'
]);