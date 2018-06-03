<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventas;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Ventas::get();
        return view('ventas', compact('ventas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventas = new Ventas;
        $ventas->nombre             = $request->nombre;
        $ventas->apellido           = $request->apellido;
        $ventas->telefono           = $request->telefono;
        $ventas->descripcion        = $request->descripcion;
        $ventas->costo              = $request->costo;
        if($ventas->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has agregado una nueva ventas correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una ventas, intentalo de nuevo.');
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

        $ventas = Ventas::find($id);

        return response()->json([
            'id' => $ventas->id,
            'nombre' => $ventas->nombre,
            'apellido' => $ventas->apellido,
            'telefono' => $ventas->telefono,
            'descripcion' => $ventas->descripcion,
            'costo' => $ventas->costo
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

        $ventas = Ventas::find($id);
        $ventas->nombre             = $request->nombre;
        $ventas->apellido           = $request->apellido;
        $ventas->telefono           = $request->telefono;
        $ventas->descripcion        = $request->descripcion;
        $ventas->costo              = $request->costo;
        if($ventas->save()) { // Insertar el registro
            return redirect()->back()->with('info', 'Has editado una ventas correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una ventas, intentalo de nuevo.');
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
        $ventas = Ventas::find($id); // Buscamos el registro
        if($ventas->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una venta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una venta, intentalo de nuevo.');
        }
    }
}
