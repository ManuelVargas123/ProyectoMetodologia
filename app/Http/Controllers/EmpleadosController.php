<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado; // Modelo
use App\CajaHerramienta;
use App\Falta;
use App\Trabajo;
use App\EmpleadoFalta;
use App\EmpleadoTrabajo;
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
        $empleados = Empleado::all();

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
        $empleado->telefono = $request->telefono;
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
            'telefono' => $empleado->telefono,
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
        $empleado->telefono = $request->telefono;
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

        //Para eliminar la caja
        $empleado->cajaHerramientas()->detach();

        //Para eliminar la falta
        $id_falta = EmpleadoFalta::select('falta_id')->where('empleado_id', $id)->get();
        if(count($id_falta) > 0)
        {
            for ($i=0; $i < count($id_falta) ; $i++) { 
                $falta = Falta::where('id', $id_falta[$i]->falta_id)->first();
                $falta->empleados()->detach();
                $falta->delete();
            }
        }
        $empleado->faltas()->detach();

        //Para eliminar el trabajo
        /*$id_trabajo = EmpleadoTrabajo::select('trabajo_id')->where('empleado_id', $id)->get();
        if(count($id_trabajo) > 0)
        {
            for ($i=0; $i < count($id_trabajo) ; $i++) { 
                $trabajo = Trabajo::where('id', $id_trabajo[$i]->trabajo_id)->first();
                $trabajo->empleados()->detach();
                $trabajo->delete();
            }
        }*/
        $empleado->trabajos()->detach();

        if($empleado->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un empleado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un empleado, intentalo de nuevo.');
        }
    }
}
