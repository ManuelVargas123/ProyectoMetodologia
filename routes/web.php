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

Route::middleware(['auth'])->group(function () {
	Route::get('/','ToDoController@index');
	Route::get('/edit','ToDoController@edit')->name('edit');
	Route::get('/motores', 'ToDoController@motores');
	Route::get('/transmisiones', 'ToDoController@transmisiones');
	Route::get('/partes', 'ToDoController@partes');                           //<--------Falta implementar
	Route::get('/empleados', 'ToDoController@empleados');
	Route::get('/herramientas', 'ToDoController@herramientas');
	Route::get('/cajas_herramientas', 'ToDoController@cajas_herramientas');  //<--------Falta implementar
	Route::get('/ventas', 'ToDoController@ventas');                         //<--------Falta implementar
	Route::get('/agregar_gerente', 'ToDoController@agregar_gerente');        //<--------Falta implementar
	Route::get('/eliminar_gerente', 'ToDoController@eliminar_gerente');       //<--------Falta implementar
	Route::get('/ver_gerentes', 'ToDoController@ver_gerentes');          //<--------Falta implementar
});


Auth::routes();

