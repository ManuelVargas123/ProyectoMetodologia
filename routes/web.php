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

	// Inventario
	Route::get('/motores', 'MotoresController@index');
	Route::post('/motores/store', 'MotoresController@store')->name('motores_store');
	Route::delete('/motores/delete/{id}', 'MotoresController@destroy')->name('motores_destroy');
	Route::post('/motores/edit', 'MotoresController@edit')->name('motores_edit');
	Route::post('/motores/update', 'MotoresController@update')->name('motores_update');

	Route::get('/transmisiones', 'TransmisionesController@index');
	Route::get('/partes', 'PartesController@index');                           //<--------Falta implementar
	Route::get('/empleados', 'EmpleadosController@index');
	Route::get('/cajas_herramientas', 'CajaHerramientasController@index');  //<--------Falta implementar

	Route::get('/ventas', 'VentasController@index');                         //<--------Falta implementar

	Route::get('/edit','ToDoController@edit')->name('edit');
	Route::get('/agregar_gerente', 'ToDoController@agregar_gerente');        //<--------Falta implementar
	Route::get('/eliminar_gerente', 'ToDoController@eliminar_gerente');       //<--------Falta implementar
	Route::get('/ver_gerentes', 'ToDoController@ver_gerentes');          //<--------Falta implementar

	//herramientas
	Route::get('/herramientas', 'HerramientasController@index');
	Route::post('/herramientas/store', 'HerramientasController@store')->name('herramientas_store');
	Route::delete('/herramientas/delete/{id}', 'HerramientasController@destroy')->name('herramientas_destroy');
	Route::post('/herramientas/edit', 'HerramientasController@edit')->name('herramientas_edit');
	Route::post('/herramientas/update', 'HerramientasController@update')->name('herramientas_update');
});

Auth::routes();
