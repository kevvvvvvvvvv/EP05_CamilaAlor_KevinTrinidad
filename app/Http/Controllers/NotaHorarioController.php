<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Horario;
use App\Models\NotaHorario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotaHorarioController extends Controller
{
    public function asign(){
        $empleados = Empleado::all();
        $horarios = Horario::all();

        return view('asign.asign',compact('empleados','horarios'));
    }

    public function asignStore(Request $request){
        // Validación previa
        $existeHorario = NotaHorario::where('ide', $request->empleado)
        ->where('idh', $request->horario)
        ->exists();

        if ($existeHorario) {
            return redirect()->back()
            ->withErrors(['error' => 'Este horario ya está asignado a este empleado.'])
            ->withInput();
        }

        $notaHorario = new NotaHorario();
        $notaHorario -> idh = $request -> horario;
        $notaHorario -> ide = $request -> empleado;
        $notaHorario->save();
        return redirect(route('principal'));
    }

    public function asignShow(){
        $horariosAsig = DB::select('select idNotaHo, concat(nombre," ",ap, " ", am) as nombreComp, 
        dia, horaentrada, horasalida from empleado 
        inner join nota_horario on empleado.ide = nota_horario.ide
        inner join horario on nota_horario.idh = horario.idh;');

        return view('asign.asignShow',compact('horariosAsig'));
    }

    public function edit($idNotaHo){
        $asignacion = NotaHorario::find($idNotaHo);
        $empleados = Empleado::all();
        $horarios = Horario::all();

        return view('asign/asignEdit',compact('asignacion', 'empleados', 'horarios'));
    }

    public function update(Request $request,$idNotaHo){
        // Validación previa
        $existeHorario = NotaHorario::where('ide', $request->empleado)
        ->where('idh', $request->horario)
        ->exists();

        if ($existeHorario) {
            return redirect()->back()
            ->withErrors(['error' => 'Este horario ya está asignado a este empleado.'])
            ->withInput();
        }

        $notaHorario = NotaHorario::find($idNotaHo);
        $notaHorario -> idh = $request -> horario;
        $notaHorario -> ide = $request -> empleado;
        $notaHorario -> save();

        return redirect()->route('principal');
    }


    public function destroy($idNotaHo){
        $asignacion = NotaHorario::find($idNotaHo);
        if($asignacion){
            $asignacion->delete();
            return response()->json(['message' => 'Elemento de la asignación eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }

    public function asignEmpleadoShow(){
        // Obtén el 'ide' del empleado autenticado
        $ide = Auth::guard('empleado')->user()->ide;

        //dd($ide);

        $horarios = DB::select('select idNotaHo, concat(nombre," ",ap, " ", am) as nombreComp, 
        dia, horaentrada, horasalida from empleado 
        inner join nota_horario on empleado.ide = nota_horario.ide
        inner join horario on nota_horario.idh = horario.idh
        where nota_horario.ide = ?;', [$ide]);

        //dd($horarios);

        return view('asign.asignShowEmpleado',compact('horarios'));
    }
}
