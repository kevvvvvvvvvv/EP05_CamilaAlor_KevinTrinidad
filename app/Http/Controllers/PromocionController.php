<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromocion;
use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function __construct()
    {

    }

    /*
        Crear una nueva promoción
        Recibe: nada
        Retorna: vista para registrar una nueva promoción
    */
    public function create(){
        return view('promocion/create');
    }

    /*
        Registrar una nueva promoción
        Recibe: 
            código de la promoción (codigo)
            descuento en decimal (descuento)
            duración en días (dias)
            descripción de la promoción (descripcion)
            estado de la promoción (estatus)
        Retorna: redirección a la vista principal
    */
    public function store(StorePromocion $request){
        $promocion = new Promocion();
        $promocion -> codigo = $request -> codigo;
        $promocion -> descuento = $request -> descuento;
        $promocion -> dias = $request -> dias;
        $promocion -> descripcion = $request -> descripcion;
        $promocion -> estatus = $request -> estatus;

        $promocion -> save();
        return redirect(route('principal'));
    }

    /*
        Consultar todas las promociones
        Recibe: nada
        Retorna: vista para consultar todas las promociones
                junto con la información de cada promoción
    */
    public function consultarPromocion(){
        $promocion= Promocion::all();
        return view('promocion/consultar-promocion',compact('promocion'));
    }

    /*
        Editar una promoción
        Recibe: ID de la promoción (idprom)
        Retorna: vista para editar una promoción específica
                junto con su información actual
    */
    public function edit($idprom){
        $promocion=Promocion::find($idprom); 
        return view('promocion/edit',compact('promocion'));
    }

    /*
        Actualizar una promoción
        Recibe: 
            código de la promoción (codigo)
            descuento en decimal(descuento)
            duración en días (dias)
            descripción de la promoción (descripcion)
            estado de la promoción (estatus)
            ID de la promoción a actualizar (idprom)
        Retorna: redirección a la vista principal
    */
    public function update(StorePromocion $request,$idprom){
        $promocion = Promocion::find($idprom);
        $promocion -> codigo = $request -> codigo;
        $promocion -> descuento = $request -> descuento;
        $promocion -> dias = $request -> dias;
        $promocion -> descripcion = $request -> descripcion;
        $promocion -> estatus = $request -> estatus;
        $promocion -> save();

        return redirect()->route('principal');
    }

    /*
        Eliminar una promoción
        Recibe: ID de la promoción (idprom)
        Retorna: mensaje de éxito si la promoción fue eliminada
                o mensaje de error si no se encontró el registro
    */
    public function destroy($idprom){
        $promocion = Promocion::find($idprom);

        if($promocion) {
            $promocion->delete();
            return response()->json(['message' => 'Promoción eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
    }
}
