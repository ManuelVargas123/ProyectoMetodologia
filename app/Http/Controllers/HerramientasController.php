<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Herramienta; // Modelo

class HerramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $herramientas = Herramienta::get();
    	return view('herramientas', compact('herramientas'));
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
        $herramienta = new Herramienta;
        $herramienta->cantidad            = $request->cantidad;
        $herramienta->marca               = $request->marca;
        $herramienta->tipo                = $request->tipo;
        $herramienta->descripcion         = $request->descripcion;
        if($herramienta->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has agregado una nueva herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una herramienta, intentalo de nuevo.');
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

        $herramienta = Herramienta::find($id);

        return response()->json([
            'id' => $herramienta->id,
            'cantidad' => $herramienta->cantidad,
            'marca' => $herramienta->marca,
            'tipo' => $herramienta->tipo,
            'descripcion' => $herramienta->descripcion,
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

        $herramienta = Herramienta::find($id);
        $herramienta->cantidad            = $request->cantidad;
        $herramienta->marca               = $request->marca;
        $herramienta->tipo                = $request->tipo;
        $herramienta->descripcion         = $request->descripcion;
        if($herramienta->save()) { // Insertar el registro
            return redirect()->back()->with('info', 'Has editado una herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una herramienta, intentalo de nuevo.');
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
        $herramienta = Herramienta::find($id); // Buscamos el registro
        if($herramienta->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una herramienta, intentalo de nuevo.');
        }
    }
}
