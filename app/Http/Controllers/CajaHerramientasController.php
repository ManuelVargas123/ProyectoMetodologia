<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CajaHerramienta;
use App\Herramienta;
use App\Empleado;

class CajaHerramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cajaHerramienta = CajaHerramienta::get();
        return view('cajaHerramienta', compact('cajaHerramienta'));
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
        $id_empleado1 = $request->id_empleado1; //Se obtiene el id del empleado 1 (POSIBLEMENTE SE OBTENGA EL NOMBRE)
        $id_empleado2 = $request->id_empleado2; //Se obtiene el id del empleado 2 (POSIBLEMENTE SE OBTENGA EL NOMBRE)

        $empleado = Empleado::where('nombre', '=', $id_empleado1); //Se obtiene toda la fila del empleado 1
        $empleado2 = Empleado::where('nombre', '=', $id_empleado2); //Se obtiene toda la fila del empleeado 2

        $cajaHerramienta = new CajaHerramienta;
        $cajaHerramienta->id_empleado1 = $empleado->id; 
        $cajaHerramienta->id_empleado2 = $empleado2->id;
        $cajaHerramienta->herramientas = $request->herramientas;
        if($cajaHerramienta->save()){
            return redirect()->back()->with('success', 'Has agregado una nueva Caja de Herramientas correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una Caja de Herramientas, intentalo de nuevo.');
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

        $id_empleado1 = $request->id_empleado1; //Se obtiene el id del empleado 1 (POSIBLEMENTE SE OBTENGA EL NOMBRE)
        $id_empleado2 = $request->id_empleado2; //Se obtiene el id del empleado 2 (POSIBLEMENTE SE OBTENGA EL NOMBRE)

        $empleado = Empleado::where('nombre', '=', $id_empleado1); //Se obtiene toda la fila del empleado 1
        $empleado2 = Empleado::where('nombre', '=', $id_empleado2); //Se obtiene toda la fila del empleeado 2

        $cajaHerramienta = CajaHerramienta::find($id);
        return response()->json([
            'id' => $cajaHerramienta->id,
            'id_empleado1' => $empleado->id,
            'id_empleado2' => $empleado2->id,
            'herramientas' => $cajaHerramienta->herramientas,
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
    public function update(Request $request)
    {
        $id = $request->id;

        $id_empleado1 = $request->id_empleado1; //Se obtiene el id del empleado 1 (POSIBLEMENTE SE OBTENGA EL NOMBRE)
        $id_empleado2 = $request->id_empleado2; //Se obtiene el id del empleado 2 (POSIBLEMENTE SE OBTENGA EL NOMBRE)

        $empleado = Empleado::where('nombre', '=', $id_empleado1); //Se obtiene toda la fila del empleado 1
        $empleado2 = Empleado::where('nombre', '=', $id_empleado2); //Se obtiene toda la fila del empleeado 2
        
        $cajaHerramienta = CajaHerramienta::find($id);
        $cajaHerramienta->id_empleado1 = $empleado->id; 
        $cajaHerramienta->id_empleado2 = $empleado2->id;
        $cajaHerramienta->herramientas = $request->herramientas;

        if($cajaHerramienta->save()){
            return redirect()->back()->with('success', 'Has editado una nueva Caja de Herramientas correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una Caja de Herramientas, intentalo de nuevo.');
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
        $cajaHerramienta = CajaHerramienta::find($id); // Buscamos el registro
        if($cajaHerramienta->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una caja de herramientas correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una caja de herramientas, intentalo de nuevo.');
        }
    }
}
