<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CajaHerramienta;
use App\Herramienta; // Modelo
use App\Historial;
use App\HerramientaEnCaja;
use App\Http\Requests\HerramientasRequest;

class HerramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $herramientas = Herramienta::all();
        foreach ($herramientas as $herramienta) 
        {
            $herramienta->caja = HerramientaEnCaja::select('caja_id')->where('herramienta_id', $herramienta->id)
                ->get();

            //Esto es para saber las cajas donde se encuentra la herramienta
            if(count($herramienta->caja) == 0)
                $herramienta->caja = "Ninguna";
            else
            {
                $json = $herramienta->caja;
                $herramienta->caja = "";
                for($i=0; $i<count($json); $i++)
                {
                    $arr[$i] = $json[$i]->caja_id;
                }
                $herramienta->caja = implode(", ", $arr);
            }
        }
        $cajas = CajaHerramienta::all();
    	return view('herramientas')->with([
            'herramientas' => $herramientas,
            'cajas'         => $cajas
        ]);
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
    public function store(HerramientasRequest $request)
    {
        $herramienta = new Herramienta;
        $herramienta->cantidad              = $request->cantidad;
        $herramienta->marca                 = $request->marca;
        $herramienta->nombre                = $request->nombre;
        $herramienta->descripcion           = $request->descripcion;
        //$herramienta->caja_id               = $request->caja_herramientas;

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
        $historial->tabla = "Herramientas";
        $historial->objeto = $request->nombre;
        $historial->objeto .= " ". $request->marca;
        $historial->save();

        if($herramienta->save()) { // Insertar el registro
            //Para la tabla de la relacion
            $herramienta_id = Herramienta::orderBy('id', 'DESC')->first()->id;
            $herramienta->cajaHerramientas()->sync($request->caja_herramientas, $herramienta_id);
           
            return redirect()->back()->with('success', 'Has agregado una nueva herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una herramienta, intentalo de nuevo.');
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

        $herramienta = Herramienta::find($id);
        //$caja_id = HerramientaEnCaja::where('caja_id', $request->caja_herramientas)->first()->id;

        return response()->json([
            'id' => $herramienta->id,
            'cantidad' => $herramienta->cantidad,
            'marca' => $herramienta->marca,
            'nombre' => $herramienta->nombre,
            'descripcion' => $herramienta->descripcion,
            'caja_herramientas' => $herramienta->caja_herramientas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HerramientasRequest $request)
    {
        $id = $request->id;

        $herramienta = Herramienta::find($id);
        $herramienta->cantidad              = $request->cantidad;
        $herramienta->marca                 = $request->marca;
        $herramienta->nombre                = $request->nombre;
        $herramienta->descripcion           = $request->descripcion;
       // $herramienta->caja_id               = $request->caja_herramientas;

        //Para la tabla de la relacion
        $herramienta->cajaHerramientas()->sync($request->caja_herramientas, $id);

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
        $historial->tabla = "Herramientas";
        $historial->objeto = $request->nombre;
        $historial->objeto .= " ". $request->marca;
        $historial->save();

        if($herramienta->save()) { // Insertar el registro
            return redirect()->back()->with('info', 'Has editado una herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una herramienta, intentalo de nuevo.');
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
        $herramienta = Herramienta::find($id); // Buscamos el registro

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
        $historial->tabla = "Herramientas";
        $historial->objeto = $herramienta->nombre;
        $historial->objeto .= " ". $herramienta->marca;
        $historial->save();

        if($herramienta->delete()) { // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una herramienta correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una herramienta, intentalo de nuevo.');
        }
    }
}
