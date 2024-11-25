<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreProducto;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function __construct()
    {

    }


    // Manda a llamar a la vista del formulario de registro.
    // Recibe: Nada.
    // Devulve: Nada.
    public function create(){
        return view('producto/create');
    }


    // Recoge los datos del formulario del registro y los guarda en la 
    // base de datos.
    // Recibe: Las respuestas del formulario en un request de StoreProducto
    // para su validación. Manda a llamar al dashboard.
    // Devulve: Nada.
    public function store(StoreProducto $request){
        $producto = new Producto();
        $producto -> nombre = $request -> nombre;
        $producto -> tipo = $request -> tipo;
        $producto -> descripcion = $request -> descripcion;
        $producto -> precio = $request -> precio;

        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $rutaDestino = 'images/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $subida = $request->file('imagen')->move($rutaDestino,$filename);
            $producto->imagen = $rutaDestino . $filename;
        };

        $producto -> save();
        return redirect(route('principal'));
    }


    // Recolecta los registros de la tabla Producto y manda a llamar
    // a la vista para su consulta.
    // Recibe: Nada.
    // Devulve: Nada.
    public function consultarProducto(){
        $producto= Producto::all();
        return view('producto/consultar-producto',compact('producto'));
    }


    // Busca los datos del registro que se va a editar y manda a llamar a la 
    // vista que contiene el formulario de edición.
    // Recibe: El ID del producto que se va a editar.
    // Devulve: Nada.
    public function edit($idpro){
        $producto=Producto::find($idpro); 
        return view('producto/edit',compact('producto'));
    }


    // Recoge los datos del formulario del edición y los guarda en la 
    // base de datos.
    // Recibe: Las respuestas del formulario en un request de StoreProducto
    // para su valdación, y el ID del producto a editar. Manda a llamar al dashboard.
    // Devulve: Nada.
    public function update(StoreProducto $request,$idpro){
        $producto = Producto::find($idpro);
        $producto -> nombre = $request -> nombre;
        $producto -> tipo = $request -> tipo;
        $producto -> descripcion = $request -> descripcion;
        $producto -> precio = $request -> precio;

        //Asignar la nueva imagen 
        if($request->hasFile('imagen')){
            
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                // Eliminar la imagen del directorio 'public/images'
                unlink(public_path($producto->imagen));
            }

            $file = $request->file('imagen');
            $rutaDestino = 'images/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $subida = $request->file('imagen')->move($rutaDestino,$filename);
            $producto->imagen = $rutaDestino . $filename;
        };

        $producto -> save();

        return redirect()->route('principal');
    }


    // Busca el registro a quitar y lo elimina de la base de datos.
    // Recibe: El ID del registro a eliminar.
    // Devuelve: Una respuesta JSON indicando el resultado de la operación.
    public function destroy($idpro){
        $producto = Producto::find($idpro);

        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            // Eliminar la imagen del directorio 'public/images'
            unlink(public_path($producto->imagen));
        }

        if($producto) {
            $producto->delete();
            return response()->json(['message' => 'Promoción eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }
    
}
