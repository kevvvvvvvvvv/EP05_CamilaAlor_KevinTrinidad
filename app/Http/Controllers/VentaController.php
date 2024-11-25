<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Pedido;

class VentaController extends Controller
{
    // Consulta todas las ventas junto con sus relaciones (empleado y cliente) 
    // y manda a llamar la vista para mostrarlas.
    // Recibe: Nada.
    // Devuelve: Nada.
    public function consultarVenta(){
        $ventas = Venta::with('empleado','cliente')->get();
        return view('venta/consultar-venta',compact('ventas'));
    }

    
    // Busca los datos de la venta que se va a editar junto con todos los clientes 
    // y empleados, y manda a llamar la vista que contiene el formulario de edición.
    // Recibe: El ID de la venta a editar.
    // Devuelve: Nada.
    public function edit($idv){
        $venta = Venta::find($idv);
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        return view('venta/edit',compact('venta','clientes','empleados'));
    }


    // Actualiza los datos de una venta existente en la base de datos.
    // Recibe: Un request con los datos del formulario de edición y el ID de la venta.
    // Devuelve: Nada.
    public function update(Request $request,$idv){
        $venta = Venta::find($idv);
        $venta -> fecEntrega = $request -> fecentrega; 
        $venta -> ide = $request -> empleado;
        $venta -> idcli = $request -> cliente;
        $venta -> save();
        return redirect()->route('consultar-venta');
    }


    // Elimina una venta de la base de datos si existe.
    // Recibe: El ID de la venta a eliminar.
    // Devuelve: Una respuesta JSON indicando el resultado de la operación.
    public function destroy($idv){
        $venta = Venta::find($idv);
        if($venta){
            $venta->delete();
            return response()->json(['message' => 'La venta se ha eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }


    // Busca los pedidos relacionados con una venta específica y manda a llamar 
    // la vista para consultarlos.
    // Recibe: El ID de la venta cuyos pedidos se quieren consultar.
    // Devuelve: Nada.
    public function consultarDetalle($idv){
        $pedidos = Pedido::where('idv',$idv)->get();
        return view('pedido/consultar-pedido',compact('pedidos'));
    }

}
