<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor; // Modelo para llamar a la tabla de Motores
use App\Historial;
use App\Http\Requests\MotorRequest;

class MotoresController extends Controller
{
    /**
     * Muestra la pagina principal de motores
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motores = Motor::get(); // Obtiene todos los registros de la tabla 'motores'
        return view('motores', compact('motores')); // Retorna la vista de 'motores'
    }

    /**
     * Guardar los datos del formulario en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotorRequest $request)
    {
        $motor = new Motor;
        $motor->nombre              = $request->nombre;
        $motor->modelo              = $request->modelo;
        $motor->cantidad            = $request->cantidad;
        $motor->marca               = $request->marca;
        $motor->costo               = $request->costo;
        $motor->moneda              = $request->moneda;
        $motor->descripcion         = $request->descripcion;
        $motor->modelosDisponibles  = $request->modelos_disponibles;
        $motor->cilindros           = $request->cilindros;
        $motor->modelo              = $request->modelo; //Esto se esta repitiendo, no?

        //Informacion del usuario
        $usuario = auth()->user();

        //Historial
        $historial = new Historial;
        $historial->user_id = $usuario->id;
        if($usuario->is_admin === 1)
            $historial->rol = "Administrador";
        else
            $historial->rol = "Gerente";
        $historial->accion = "Agregar";
        $historial->tabla = "Motores";
        $historial->objeto = $request->nombre;
        $historial->objeto .= " ". $request->marca;
        $historial->save();

        if($motor->save()) { // Insertar el registro
            return redirect()->back()->with('success', 'Has agregado un nuevo motor correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un motor, intentalo de nuevo.');
        }
    }

    /**
     * Mostrar una vista con un registro en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: Es requerido mostrar la info de un motor?
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

        $motor = Motor::find($id);

        return response()->json([
            'id' => $motor->id,
            'nombre' => $motor->nombre,
            'modelo' => $motor->modelo,
            'cantidad' => $motor->cantidad,
            'marca' => $motor->marca,
            'costo' => $motor->costo,
            'moneda' => $motor->moneda,
            'descripcion' => $motor->descripcion,
            'modelos_disponibles' => $motor->modelosDisponibles,
            'cilindros' => $motor->cilindros,
            'modificacion' => $motor->updated_at
        ]);
    }

    /**
     * Actualizar los datos de un registro en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MotorRequest $request)
    {
        $id = $request->id;

        $motor = Motor::find($id);
        $motor->nombre              = $request->nombre;
        $motor->modelo              = $request->modelo;
        $motor->cantidad            = $request->cantidad;
        $motor->marca               = $request->marca;
        $motor->costo               = $request->costo;
        $motor->moneda              = $request->moneda;
        $motor->descripcion         = $request->descripcion;
        $motor->modelosDisponibles  = $request->modelos_disponibles;
        $motor->cilindros           = $request->cilindros;
        $motor->modelo              = $request->modelo;

        //Informacion del usuario
        $usuario = auth()->user();

        //Historial
        $historial = new Historial;
        $historial->user_id = $usuario->id;
        if($usuario->is_admin === 1)
            $historial->rol = "Administrador";
        else
            $historial->rol = "Gerente";
        $historial->accion = "Modificar";
        $historial->tabla = "Motores";
        $historial->objeto = $request->nombre;
        $historial->objeto .= " ". $request->marca;
        $historial->save();

        if($motor->save()) { // Insertar el registro
            return redirect()->back()->with('info', 'Has editado un motor correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar un motor, intentalo de nuevo.');
        }
    }

    /**
     * Eliminar un registro en la base de datos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $motor = Motor::find($id); // Buscamos el registro

        //Informacion del usuario
        $usuario = auth()->user();

        //Historial
        $historial = new Historial;
        $historial->user_id = $usuario->id;
        if($usuario->is_admin === 1)
            $historial->rol = "Administrador";
        else
            $historial->rol = "Gerente";

        $historial->accion = "Eliminar";
        $historial->tabla = "Motores";
        $historial->objeto = $motor->nombre;
        $historial->objeto .= " ". $motor->marca;
        $historial->save();

        //Para eliminar de la tabla de relacion
        $motor->ventas()->detach();

        if($motor->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un motor correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un motor, intentalo de nuevo.');
        }
    }
}
