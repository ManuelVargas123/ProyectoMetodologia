<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CajaHerramienta;
use App\Herramienta;
use App\Empleado;
use App\User;
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
        //$empleados = User::where('is_admin', false)->get();
        $empleados = Empleado::get();
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
            $caja->herramientas = "";
            $herramientas = Herramienta::where('caja_id', $caja->id)->get();
            foreach ($herramientas as $herramienta) {
                $caja->herramientas .= $herramienta->nombre.", ";
            }
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
    public function edit(Request $request)
    {
        $id = $request->id;
        $empleado = Empleado::where('nombre', '=', $request->id_empleado1); //Se obtiene toda la fila del empleado 1
        $empleado2 = Empleado::where('nombre', '=', $request->id_empleado2); //Se obtiene toda la fila del empleeado 2
        $cajaHerramienta = CajaHerramienta::find($id);
        return response()->json([
            'id' => $cajaHerramienta->id,
            'id_empleado1' => $empleado->id,
            'id_empleado2' => $empleado2->id
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
        $id_empleado1 = $request->id_empleado1; //Se obtiene el id del empleado 1 (POSIBLEMENTE SE OBTENGA EL NOMBRE)
        $id_empleado2 = $request->id_empleado2; //Se obtiene el id del empleado 2 (POSIBLEMENTE SE OBTENGA EL NOMBRE)
        $empleado = Empleado::where('nombre', '=', $request->id_empleado1); //Se obtiene toda la fila del empleado 1
        $empleado2 = Empleado::where('nombre', '=', $request->id_empleado2); //Se obtiene toda la fila del empleado 2
        $cajaHerramienta = CajaHerramienta::find($id);
        $cajaHerramienta->user_id = $empleado->id;
        $cajaHerramienta->user_id2 = $empleado2->id;
        $cajaHerramienta->herramientas = $request->herramientas;
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
        if($cajaHerramienta->delete()) {   // Lo eliminamos
            return redirect()->back()->with('success', 'Has eliminado una caja de herramientas correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar una caja de herramientas, intentalo de nuevo.');
        }
    }
}