<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado; // Modelo
use App\Http\Requests\EmpleadosRequest;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::get();
        return view('empleados', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadosRequest $request)
    {
        $empleado = new Empleado;
        $empleado->nombre = $request->nombre;
        $empleado->primerApellido = $request->primerApellido;
        if($empleado->save()){
            return redirect()->back()->with('success', 'Has agregado un nuevo empleado correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un empleado, intentalo de nuevo.');
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
        $empleado = Empleado::find($id);
        return response()->json([
            'id' => $empleado->id,
            'nombre' => $empleado->nombre,
            'primerApellido' => $empleado->primerApellido,
            'modificacion' => $empleado->updated_at
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadosRequest $request)
    {
        $id = $request->id;

        $empleado = Empleado::find($id);
        $empleado->nombre = $request->nombre;
        $empleado->primerApellido = $request->primerApellido;
        if($empleado->save()) {
            return redirect()->back()->with('success', 'Has editado un empleado correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar un empleado, intentalo de nuevo.');
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
        $empleado = Empleado::find($id); // Buscamos el registro
        if($empleado->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un empleado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un empleado, intentalo de nuevo.');
        }
    }
}
