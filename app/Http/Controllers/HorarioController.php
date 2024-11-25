<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHorario;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function __construct()
    {

    }

    // Manda a llamar la vista del formulario de registro de horarios.
    // Recibe: Nada.
    // Devuelve: Nada.
    public function create(){
        return view('horario/create');
    }


    // Recoge los datos del formulario de registro de horario y los guarda 
    // en la base de datos.
    // Recibe: Las respuestas del formulario validadas en un request de StoreHorario.
    // Devuelve: Nada.
    public function store(StoreHorario $request){
        $horario = new Horario();
        $horario -> horaentrada = $request -> horaentrada;
        $horario -> horasalida = $request -> horasalida;
        $horario -> dia = $request -> dia;

        $horario -> save();
        return redirect(route('principal'));
    }


    // Recolecta todos los registros de horarios y manda a llamar la vista para su consulta.
    // Recibe: Nada.
    // Devuelve: Nada.
    public function consultarHorario(){
        $horario= Horario::all();
        return view('horario/consultar-horario',compact('horario'));
    }


    // Busca los datos del horario que se va a editar y manda a llamar la vista 
    // que contiene el formulario de edición.
    // Recibe: El ID del horario que se va a editar.
    // Devuelve: Nada.
    public function edit($idh){
        $horario=Horario::find($idh); 
        return view('horario/edit',compact('horario'));
    }


    // Recoge los datos del formulario de edición de horario y actualiza los datos 
    // en la base de datos.
    // Recibe: Las respuestas del formulario validadas en un request de StoreHorario y el ID del horario.
    // Devuelve: Nada.
    public function update(StoreHorario $request,$idh){
        $horario = Horario::find($idh);
        $horario -> horaentrada = $request -> horaentrada;
        $horario -> horasalida = $request -> horasalida;
        $horario -> dia = $request -> dia;
        $horario -> save();

        return redirect()->route('principal');
    }


    // Busca el registro de horario a eliminar y lo elimina de la base de datos si existe.
    // Recibe: El ID del horario a eliminar.
    // Devuelve: Una respuesta JSON indicando el resultado de la operación.
    public function destroy($idh){
        $horario = Horario::find($idh);
        if($horario){
            $horario->delete();
            return response()->json(['message' => 'Elemento del almacen eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }
}
