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

    public function herramientas()
    {
    	$Consultaherramientas = DB::table('herramientas')->get();
    	return view('herramientas', compact('Consultaherramientas'));
    }
}
