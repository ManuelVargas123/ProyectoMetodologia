<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CajaHerramienta;
use App\Herramienta;
use App\Empleado;
use App\Historial;
use App\HerramientaEnCaja;

class CajaHerramientasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caja_herramientas = CajaHerramienta::get();

        $empleados = Empleado::all();
        foreach ($caja_herramientas as $caja) {
            if(!empty($caja->user_id)) {
                if(Empleado::where('id', $caja->user_id)->count() > 0)
                    $caja->propietario1 = Empleado::where('id', $caja->user_id)->first()->nombre;
                else
                    $caja->propietario1 = "Ninguno";
            } else {
                $caja->propietario1 = "Ninguno";
            }
            if(!empty($caja->user_id2)) {
                $propietario = Empleado::where('id', $caja->user_id2)->first();
                if(Empleado::where('id', $caja->user_id2)->count() > 0)
                    $caja->propietario2 = Empleado::where('id', $caja->user_id2)->first()->nombre;
                else
                    $caja->propietario2 = "Ninguno";
            } else {
                $caja->propietario2 = "Ninguno";
            }
            if(count($caja->herramientas) == 0)
                $caja->herramientas = "Ninguna";
        }
        return view('cajas_herramientas')->with([
            'caja_herramientas' => $caja_herramientas,
            'empleados' => $empleados
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
    public function store(Request $request)
    {
        $cajaHerramienta = new CajaHerramienta;
        $cajaHerramienta->user_id = $request->empleado1;
        $cajaHerramienta->user_id2 = $request->empleado2;

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
        $historial->tabla = "Caja de Herramientas";
        
        $caja = CajaHerramienta::all();
        if ($caja->count())
            $caja_id = CajaHerramienta::orderBy('id', 'DESC')->first()->id;

        $historial->objeto = "Caja #";
        if(empty($caja_id))
            $historial->objeto .= "1";
        else
            $historial->objeto .= $caja_id + 1;
        $historial->save();

        if($cajaHerramienta->save()){
            return redirect()->back()->with('success', 'Has agregado una nueva Caja de Herramientas correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar agregar una Caja de Herramientas, intentalo de nuevo.');
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
    public function edit($id)
    {
        $cajaHerramienta = CajaHerramienta::find($id);

        if(Empleado::where('id', $cajaHerramienta->user_id)->count() > 0)
            $empleado1 = Empleado::where('id', $cajaHerramienta->user_id)->first()->id;
        else
            $empleado1 = NULL;
        if(Empleado::where('id', $cajaHerramienta->user_id2)->count() > 0)
            $empleado2 = Empleado::where('id', $cajaHerramienta->user_id2)->first()->id;
        else $empleado2 = NULL;

        return response()->json([
            'id' => $cajaHerramienta->id,
            'id_empleado1' => $empleado1,
            'id_empleado2' => $empleado2
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

        $cajaHerramienta = CajaHerramienta::find($id);
        $cajaHerramienta->user_id = $request->empleado1;
        $cajaHerramienta->user_id2 = $request->empleado2;

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
        $historial->tabla = "Caja de Herramientas";
        $historial->objeto = "Caja #";
        $historial->objeto .= $id;
        $historial->save();

        if($cajaHerramienta->save()){
            return redirect()->back()->with('success', 'Has editado una nueva Caja de Herramientas correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar editar una Caja de Herramientas, intentalo de nuevo.');
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
        $cajaHerramienta = CajaHerramienta::find($id); // Buscamos el registro

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
        $historial->tabla = "Caja de Herramientas";
        $historial->objeto = "Caja #";
        $historial->objeto .= $cajaHerramienta->id;
        $historial->save();

        if($cajaHerramienta->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una caja de herramientas correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una caja de herramientas, intentalo de nuevo.');
        }
    }
}
