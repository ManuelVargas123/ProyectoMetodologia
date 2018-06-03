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
}
