<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Falta;

class FaltasController extends Controller
{
    public function index()
    { 
        $faltas = Falta::get();
        foreach ($faltas as $falta) 
        {
        	if(!empty($falta->empleado_id))
        	{
        		$falta->empleado = Empleado::where('id', $falta->empleado_id)->first()->nombre;
        		$falta->empleado .= ' '. Empleado::where('id', $falta->empleado_id)->first()->primerApellido;
        	}
        	else
        		$falta->empleado = "Ninguno";
        }

        $empleados = Empleado::get();
        return view('faltas')->with([
        	'faltas' => $faltas,
        	'empleados' => $empleados
        ]);
    }

	public function store(Request $request)
    {
        $falta = new Falta;
        $falta->empleado_id = $request->empleado;

        if ($request->justificacion === "on") 
        	$falta->justificacion = 1;
       else
        	$falta->justificacion = 0;

        $falta->razon = $request->razon;
        $falta->fecha = $request->fecha;

        if($falta->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has agregado una nueva falta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una falta, intentalo de nuevo.');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $falta = Falta::find($id);

        return response()->json([
            'id' => $falta->id,
            'empleado' => $falta->empleado_id,
            'justificacion' => $falta->justificacion,
            'razon' => $falta->razon,
            'fecha' => $falta->fecha
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $falta = Falta::find($id);
        $falta->empleado_id = $request->empleado;

        if ($request->justificacion === "on") 
        	$falta->justificacion = 1;
        else
        	$falta->justificacion = 0;

        $falta->razon = $request->razon;
        $falta->fecha = $request->fecha;
        
        if($falta->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has editado una falta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una falta, intentalo de nuevo.');
        }
    }

    public function destroy($id)
    {
        $falta = Falta::find($id); // Buscamos el registro
        if($falta->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una falta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una falta, intentalo de nuevo.');
        }
    }

}
