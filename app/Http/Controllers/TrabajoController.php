<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado; // Modelo
use App\EmpleadoTrabajo;
use App\Trabajo;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = Trabajo::all();
        $empleados = Empleado::all();
        return view('trabajos')->with([
            'trabajos' => $trabajos,
            'empleados' => $empleados
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trabajo = new Trabajo;

        $trabajo->descripcion = $request->descripcion;
        $trabajo->fechaLlegada = $request->fechaLlegada;
        $trabajo->fechaInicio = $request->fechaInicio;
        $trabajo->fechaFinal = $request->fechaFinal;

        if($trabajo->save()) { // Insertar el registro
            $trabajo->empleados()->attach($request->empleado);

            return redirect()->back()->with('success', 'Has agregado un nuevo trabajo correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un trabajo, intentalo de nuevo.');
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

        $trabajo = Trabajo::find($id);

        $empleados = EmpleadoTrabajo::select('empleado_id')->where('trabajo_id', $id)->get();

        return response()->json([
            'id' => $trabajo->id,
            'empleado' => $empleados,
            'descripcion' => $trabajo->descripcion,
            'fechaLlegada' => $trabajo->fechaLlegada,
            'fechaInicio' => $trabajo->fechaInicio,
            'fechaFinal' => $trabajo->fechaFinal
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

        $trabajo = Trabajo::find($id);
        $trabajo->descripcion = $request->descripcion;
        $trabajo->fechaLlegada = $request->fechaLlegada;
        $trabajo->fechaInicio = $request->fechaInicio;
        $trabajo->fechaFinal = $request->fechaFinal;
        
        if($trabajo->save()) { // Insertar el registro
            $trabajo->empleados()->sync($request->empleado);
            return redirect()->back()->with('info', 'Has editado un trabajo correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar un trabajo, intentalo de nuevo.');
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
        $trabajo = Trabajo::find($id); // Buscamos el registro
        $trabajo->empleados()->detach();

        if($trabajo->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un trabajo correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un trabajo, intentalo de nuevo.');
        }
    }
}
