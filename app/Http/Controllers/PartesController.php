<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autoparte; // Modelo

class PartesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { // TODO: Primero es necesario crear la tabla
        $autopartes = Autoparte::get();
        return view('partes', compact('autopartes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autoparte = new Autoparte;
        $autoparte->parte = $request->parte;
        $autoparte->modelo = $request->modelo;
        $autoparte->cantidad = $request->cantidad;
        $autoparte->marca = $request->marca;
        $autoparte->descripcion = $request->descripcion;
        $autoparte->modelosDisponibles = $request->modelos_disponibles;
        $autoparte->palancaCambios = $request->palancaCambios;
        $autoparte->cilindros = $request->cilindros;
        if($autoparte->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has agregado una nueva autoparte correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una autoparte, intentalo de nuevo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;

        $autoparte = Autoparte::find($id);

        return response()->json([
            'id' => $autoparte->id,
            'parte' => $autoparte->parte,
            'modelo' => $autoparte->modelo,
            'cantidad' => $autoparte->cantidad,
            'marca' => $autoparte->marca,
            'descripcion' => $autoparte->descripcion,
            'modelos_disponibles' => $autoparte->modelosDisponibles,
            'palancaCambios' => $autoparte->palancaCambios,
            'cilindros' => $autoparte->cilindros,
            'modificacion' => $autoparte->updated_at
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $autoparte = Autoparte::find($id);
        $autoparte->parte = $request->parte;
        $autoparte->modelo = $request->modelo;
        $autoparte->cantidad = $request->cantidad;
        $autoparte->marca = $request->marca;
        $autoparte->descripcion = $request->descripcion;
        $autoparte->modelosDisponibles = $request->modelos_disponibles;
        $autoparte->palancaCambios = $request->palancaCambios;
        $autoparte->cilindros = $request->cilindros;
        if($autoparte->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has editado una nueva autoparte correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una autoparte, intentalo de nuevo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autoparte = Autoparte::find($id); // Buscamos el registro
        if($autoparte->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una autoparte correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una autoparte, intentalo de nuevo.');
        }
    }
}
