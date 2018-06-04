<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventas;
use App\Motor;
use App\Transmision;
use App\Autoparte;
use App\Http\Requests\VentasRequest;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Ventas::all();
        $motores = Motor::where('cantidad', '>', 0)->get();
        $motoresall = Motor::all();
        $transmisiones = Transmision::where('cantidad', '>', 0)->get();
        $transmisionesall = Transmision::all();
        $autopartes = Autoparte::where('cantidad', '>', 0)->get();
        $autopartesall = Autoparte::all();
        return view('ventas')->with([
            'ventas' => $ventas,
            'motores'           => $motores,
            'motoresall'        => $motoresall,
            'transmisiones'     => $transmisiones,
            'transmisionesall'  => $transmisionesall,
            'autopartes'        => $autopartes,
            'autopartesall'     => $autopartesall
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentasRequest $request)
    {
        $ventas = new Ventas;
        $ventas->nombre             = $request->nombre;
        $ventas->apellido           = $request->apellido;
        $ventas->telefono           = $request->telefono;
        $ventas->descripcion        = $request->descripcion;
        $ventas->costo              = $request->costo;
        $ventas->motor_id           = $request->motor;
        $ventas->transmision_id     = $request->transmision;
        $ventas->autoparte_id       = $request->autoparte;

        if(!empty($request->motor) && is_numeric($request->motor)) {
            if($request->motor > 0)
                Motor::where('id', $request->motor)->decrement('cantidad', 1); // Decrementar la cantidad de 1
        }
        if(!empty($request->transmision) && is_numeric($request->transmision)) {
            if($request->transmision > 0)
                Transmision::where('id', $request->transmision)->decrement('cantidad', 1); // Decrementar la cantidad de 1
        }
        if(!empty($request->autoparte) && is_numeric($request->autoparte)) {
            if($request->autoparte > 0)
                Autoparte::where('id', $request->autoparte)->decrement('cantidad', 1); // Decrementar la cantidad de 1
        }

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

        $venta = Ventas::find($id);

        return response()->json([
            'id' => $venta->id,
            'nombre' => $venta->nombre,
            'apellido' => $venta->apellido,
            'telefono' => $venta->telefono,
            'descripcion' => $venta->descripcion,
            'costo' => $venta->costo,
            'id_motor' => $venta->motor_id,
            'id_transmision' => $venta->transmision_id,
            'id_autoparte' => $venta->autoparte_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VentasRequest $request)
    {
        $id = $request->id;

        $ventas = Ventas::find($id);
        $ventas->nombre             = $request->nombre;
        $ventas->apellido           = $request->apellido;
        $ventas->telefono           = $request->telefono;
        $ventas->descripcion        = $request->descripcion;
        $ventas->costo              = $request->costo;
        $ventas->motor_id           = $request->motor;
        $ventas->transmision_id     = $request->transmision;
        $ventas->autoparte_id       = $request->autoparte;
        
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
