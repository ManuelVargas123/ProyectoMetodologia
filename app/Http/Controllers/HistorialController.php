<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Historial;

class HistorialController extends Controller
{
    public function index()
    {
        $historias = Historial::get(); 
        return view('historial', compact('historias')); 
    }

    public function store(Request $request)
    {
       	$historial = new Historial;
        $historial->user = auth()->user();
        $historial->rol = $request->rol;
        $historial->accion = $request->accion;
        $historial->tabla = $request->tabla;
        $historial->id_objeto = $request->id_objeto;

        if($historial->save()){
            return redirect()->back()->with('success', 'Has agregado una nueva Caja de Herramientas correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una Caja de Herramientas, intentalo de nuevo.');
        }
    }
}
