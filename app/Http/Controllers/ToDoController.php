<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function edit()
    {
        return view('edit');
    }

    public function motores()
    {
        $Consultamotores = DB::table('motores')->get();
        return view('motores', compact('Consultamotores'));
    }

    public function transmisiones()
    {
        $Consultatransmisiones = DB::table('transmisiones')->get();
        return view('transmisiones', compact('Consultatransmisiones'));
    }

    public function partes()
    {
        $Consultapartes = DB::table('partes')->get();
        return view('partes');
    }

    public function empleados()
    {
        $Consultaempleados = DB::table('empleados')->get();
        return view('empleados', compact('Consultaempleados'));
    }
   
    public function herramientas()
    {
    	$Consultaherramientas = DB::table('herramientas')->get();
    	return view('herramientas', compact('Consultaherramientas'));
    }

    public function cajas_herramientas()
    {
        return view('cajas_herramientas');
    }

    public function ventas()
    {
        return view('ventas');
    }

    public function agregar_gerente()
    {
        return view('agregar_gerente');
    }

    public function eliminar_gerente()
    {
        return view('eliminar_gerente');
    }

    public function ver_gerentes()
    {
        return view('ver_gerentes');
    }
}
