<?php

namespace App\Http\Controllers;
use DB;
use App\Servicio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ToDoController extends Controller
{
    public function index()
    {
        $fechaSemana = Carbon::now()->addWeeks(1);
        $proximasCitas = Servicio::where('fechaSiguiente', '<=',  $fechaSemana)->get();
        return view('index')->with(['proximasCitas' => $proximasCitas]);
       // return view('index', compact('servicios'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $servicio = Servicio::find($id);

        $servicio->agendada = $request->agendada;
        $servicio->finalizado = $request->finalizado;
        if($servicio->save()){
            return redirect()->back()->with('success', 'Has agregado un nuevo servicio correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar un servicio, intentalo de nuevo.');
        }
    }
}
