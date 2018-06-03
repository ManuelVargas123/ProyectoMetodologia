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
	Route::post('/transmisiones/store', 'TransmisionesController@store')->name('transmisiones_store');
	Route::delete('/transmisiones/delete/{id}', 'TransmisionesController@destroy')->name('transmisiones_destroy');
	Route::post('/transmisiones/edit', 'TransmisionesController@edit')->name('transmisiones_edit');
	Route::post('/transmisiones/update', 'TransmisionesController@update')->name('transmisiones_update');

	Route::get('/partes', 'PartesController@index');                           //<--------Falta implementar

	//empleados
	Route::get('/empleados', 'EmpleadosController@index');
	Route::post('/empleados/store', 'EmpleadosController@store')->name('empleados_store');
	Route::delete('/empleados/delete/{id}', 'EmpleadosController@destroy')->name('empleados_destroy');
	Route::post('/empleados/edit', 'EmpleadosController@edit')->name('empleados_edit');
	Route::post('/empleados/update', 'EmpleadosController@update')->name('empleados_update');

	// Caja de herramientas
	Route::get('/cajas_herramientas', 'CajaHerramientasController@index');
	Route::post('/cajas_herramientas/store', 'CajaHerramientasController@store')->name('caja_herramientas_store');
	Route::delete('/cajas_herramientas/delete/{id}', 'CajaHerramientasController@destroy')->name('caja_herramientas_destroy');
	Route::post('/cajas_herramientas/edit', 'CajaHerramientasController@edit')->name('caja_herramientas_edit');
	Route::post('/cajas_herramientas/update', 'CajaHerramientasController@update')->name('caja_herramientas_update');

	//Ventas
	Route::get('/ventas', 'VentasController@index');
	Route::post('/ventas/store', 'VentasController@store')->name('ventas_store');
	Route::delete('/ventas/delete/{id}', 'VentasController@destroy')->name('ventas_destroy');
	Route::post('/ventas/edit', 'VentasController@edit')->name('ventas_edit');
	Route::post('/ventas/update', 'VentasController@update')->name('ventas_update');

	//Administrar usuarios
	Route::get('/edit','ToDoController@edit')->name('edit');

	//servicios
	Route::get('/servicios', 'ServiciosController@index');
	Route::post('/servicios/store', 'ServiciosController@store')->name('servicios_store');
	Route::delete('/servicios/delete/{id}', 'ServiciosController@destroy')->name('servicios_destroy');
	Route::post('/servicios/edit', 'ServiciosController@edit')->name('servicios_edit');
	Route::post('/servicios/update', 'ServiciosController@update')->name('servicios_update');

	//autopartes
	Route::get('/autopartes', 'PartesController@index');
	Route::post('/autopartes/store', 'PartesController@store')->name('partes_store');
	Route::delete('/autopartes/delete/{id}', 'PartesController@destroy')->name('partes_destroy');
	Route::post('/autopartes/edit', 'PartesController@edit')->name('partes_edit');
	Route::post('/autopartes/update', 'PartesController@update')->name('partes_update');

	Route::get('/gerentes', 'GerentesController@index');
	Route::post('/gerentes/store', 'GerentesController@store')->name('gerentes_store');
	Route::delete('/gerentes/delete/{id}', 'GerentesController@destroy')->name('gerentes_destroy');
	Route::post('/gerentes/edit', 'GerentesController@edit')->name('gerentes_edit');
	Route::post('/gerentes/update', 'GerentesController@update')->name('gerentes_update');

	//herramientas
	Route::get('/herramientas', 'HerramientasController@index');
	Route::post('/herramientas/store', 'HerramientasController@store')->name('herramientas_store');
	Route::delete('/herramientas/delete/{id}', 'HerramientasController@destroy')->name('herramientas_destroy');
	Route::post('/herramientas/edit', 'HerramientasController@edit')->name('herramientas_edit');
	Route::post('/herramientas/update', 'HerramientasController@update')->name('herramientas_update');

});

Auth::routes();
