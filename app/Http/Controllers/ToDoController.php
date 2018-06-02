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

    }

    public function transmisiones()
    {

    }

    public function partes()
    {

    }

    public function empleados()
    {

    }

    public function herramientas()
    {

    }

    public function cajas_herramientas()
    {

    }

    public function ventas()
    {
        
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
