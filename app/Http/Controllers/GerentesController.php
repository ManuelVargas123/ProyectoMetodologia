<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\GerentesRequest;
use App\Http\Requests\GerenteRequestEdit;

class GerentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gerentes = User::all();
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
    public function store(GerentesRequest $request)
    {
        $gerente = new User;
        $gerente->name = $request->name;
        $gerente->primerApellido = $request->primerApellido;
        $gerente->email = $request->email;
        $gerente->is_admin = isset($request->is_admin) ? true : false;
        $gerente->password = Hash::make($request->password);
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
            'name' => $gerente->name,
            'primerApellido' => $gerente->primerApellido,
            'email' => $gerente->email,
            'is_admin' => $gerente->is_admin,
            //'password' => $gerente->password,
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

        $gerente = User::find($id);

        if(strcmp($request->email, $gerente->email) !== 0){
            $email = User::where('email', $request->email)->get();
            if (count($email) > 0) 
                return redirect()->back()->with('error', 'El correo ya esta registrado');
        }

        $gerente->name = $request->name;
        $gerente->primerApellido = $request->primerApellido;
        $gerente->is_admin = isset($request->is_admin) ? true : false;
        $gerente->email = $request->email;
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
        $gerente = User::find($id); // Buscamos el registro
        if($gerente->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado un gerente correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar un gerente, intentalo de nuevo.');
        }
    }
}
