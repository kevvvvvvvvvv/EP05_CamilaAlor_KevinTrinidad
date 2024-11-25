<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlmacenaje;
use App\Models\Almacenaje;
use Illuminate\Http\Request;

class AlmacenajeController extends Controller
{
    public function __construct()
    {

    }

    /*
        Mostrar formulario para crear un nuevo registro de almacenaje
        Recibe: nada
        Retorna: vista con el formulario para crear un nuevo almacenaje
    */
    public function create(){
        return view('almacenaje/create');
    }

    /*
        Registrar un nuevo almacenaje
        Recibe: 
            nombre del producto (nombre)
            descripción del producto (descripcion)
            fecha de ingreso (fechaIng)
            fecha de caducidad (fechaCad)
            cantidad disponible (cantidad)
            categoría del producto (categoria)
        Retorna: redirección a la vista principal
    */
    public function store(StoreAlmacenaje $request){
        $almacenaje = new Almacenaje();
        $almacenaje -> nombre = $request -> nombre;
        $almacenaje -> descripcion = $request -> descripcion;
        $almacenaje -> fechaIng = $request -> fechaIng;
        $almacenaje -> fechaCad = $request -> fechaCad;
        $almacenaje -> cantidad = $request -> cantidad;
        $almacenaje -> categoria = $request -> categoria;

        $almacenaje -> save();
        return redirect(route('principal'));
    }

    /*
        Consultar todos los registros de almacenaje
        Recibe: nada
        Retorna: vista para consultar todos los registros de almacenaje
                junto con la información de cada uno de ellos
    */
    public function consultarAlmacenaje(){
        $almacenaje= Almacenaje::all();
        return view('almacenaje/consultar-almacenaje',compact('almacenaje'));
    }

    /*
        Editar un registro de almacenaje
        Recibe: ID del registro de almacenaje ($idalm)
        Retorna: vista para editar un registro específico de almacenaje
                junto con toda su información
    */
    public function edit($idalm){
        $almacenaje=Almacenaje::find($idalm); 
        return view('almacenaje/edit',compact('almacenaje'));
    }

    /*
        Actualiza un registro de almacenaje
        Recibe: 
            nombre (nombre)
            descripcion (descripcion)
            fecha de ingreso (fechaIng)
            fecha de caducidad (fechaCad)
            cantidad (cantidad)
            categoria (categoria)
        Retorna: vista principal después de actualizar el registro de almacenaje
    */
    public function update(StoreAlmacenaje $request,$idalm){
        $almacenaje = Almacenaje::find($idalm);
        $almacenaje -> nombre = $request -> nombre;
        $almacenaje -> descripcion = $request -> descripcion;
        $almacenaje -> fechaIng = $request -> fechaIng;
        $almacenaje -> fechaCad = $request -> fechaCad;
        $almacenaje -> cantidad = $request -> cantidad;
        $almacenaje -> categoria = $request -> categoria;
        $almacenaje -> save();

        return redirect()->route('principal');
    }

    /*
        Elimina un registro de almacenaje
        Recibe: ID del almacenaje
        Retorna: Mensaje de éxito o fallo al eliminar el registro
    */
    public function destroy($idalm){
        $almacenaje = Almacenaje::find($idalm);
        if($almacenaje){
            $almacenaje->delete();
            return response()->json(['message' => 'Elemento del almacen eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }
}
