<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gerente;

class GerentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gerentes = Gerente::get();
        return view('gerentes', compact('gerentes'));
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
        $gerente = new User;
        $gerente->nombre = $request->nombre;
        $gerente->primerApellido = $request->primerApellido;
        $gerente->email = $request->email;
        $gerente->password = $request->password;
        if($gerente->save()){
            return redirect()->back()->with('success', 'Has agregado un nuevo gerente correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un gerente, intentalo de nuevo.');
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
        $gerente = User::find($id);
        return response()->json([
            'id' => $gerente->id,
            'nombre' => $gerente->nombre,
            'primerApellido' => $gerente->primerApellido,
            'email' => $gerente->email,
            'password' => $gerente->password,
            'modificacion' => $gerente->updated_at
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

        $gerente = Gerente::find($id);
        $gerente->nombre = $request->nombre;
        $gerente->primerApellido = $request->primerApellido;
        $gerente->email = $request->email;
        $gerente->password = $request->password;
        if($gerente->save()){
            return redirect()->back()->with('success', 'Has editado un nuevo gerente correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar un gerente, intentalo de nuevo.');
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
        $gerente = Gerente::find($id); // Buscamos el registro
        if($gerente->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un gerente correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un gerente, intentalo de nuevo.');
        }
    }
}
