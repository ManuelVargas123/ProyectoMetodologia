<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio; //Modelo
use App\Http\Requests\ServiciosRequest;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::get();
        return view('servicios', compact('servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiciosRequest $request)
    {
        $servicio = new Servicio;
        $servicio->servicio = $request->servicio;
        $servicio->costo = $request->costo;
        $servicio->fecha = $request->fecha;
        $servicio->descripcion = $request->descripcion;
        if($servicio->save()){
            return redirect()->back()->with('success', 'Has agregado un nuevo servicio correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un servicio, intentalo de nuevo.');
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
        $servicio = Servicio::find($id);
        return response()->json([
            'id' => $servicio->id,
            'servicio' => $servicio->servicio,
            'costo' => $servicio->costo,
            'fecha' => $servicio->fecha,
            'descripcion' => $servicio->descripcion,
            'modificacion' => $servicio->updated_at
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiciosRequest $request)
    {
        $id = $request->id;

        $servicio = Servicio::find($id);
        $servicio->servicio = $request->servicio;
        $servicio->costo = $request->costo;
        $servicio->fecha = $request->fecha;
        $servicio->descripcion = $request->descripcion;
        if($servicio->save()){
            return redirect()->back()->with('success', 'Has editado un nuevo servicio correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar un servicio, intentalo de nuevo.');
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
        $servicio = Servicio::find($id); // Buscamos el registro
        if($servicio->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un servicio correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un servicio, intentalo de nuevo.');
        }
    }
}
