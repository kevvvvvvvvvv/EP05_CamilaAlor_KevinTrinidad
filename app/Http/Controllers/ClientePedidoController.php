<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class ClientePedidoController extends Controller
{
    
    public function create(){
        $productos = Producto::all();
        return view('pedidoCliente/create',compact('productos'));
    }

    public function store(Request $request){
        
        /* dd($request->all()); */

        $venta = new Venta();
        $venta->fechaVent= now();
        $venta->fecEntrega= $request->fechaP;
        $venta->total=$request->total;
        $venta -> idcli = Auth::guard('cliente')->user()->idcli;
        $venta->save();

        $pedidos = json_decode($request->input('productos'), true); // true para convertir a array asociativo

        foreach ($pedidos as $item) {

            $producto = Producto::where('nombre', $item['nombre'])->first();

            $pedido = new Pedido();
            $pedido->descripcion = $item['descripcion']; 
            $pedido->fePed = now();
            $pedido->cantidad = $item['cantidad']; 
            $pedido->status = "En espera";
            $pedido->subtotal = $item['precio']*$item['cantidad'];
            $pedido->descuento = 0;
            $pedido->totalP = $item['subtotal'];
            $pedido->idv = $venta->idv; 
            $pedido->idpro = $producto->idpro;
            $pedido->save();
        } 
        return redirect()->route('pedido.cliente.create');
    }

    public function consultarVenta(){
        $ventas = Venta::where('idcli', Auth::guard('cliente')->user()->idcli)->get();
        return view('pedidoCliente/consultar-venta',compact('ventas'));
    }

    public function consultarPedido($idv){
        $pedidos = Pedido::where('idv',$idv)->get(); 
        $ventas = Venta::where('idcli', Auth::guard('cliente')->user()->idcli)->get();
        $venta = Venta::find($idv);
        if($venta->idcli == Auth::guard('cliente')->user()->idcli){
            return view('pedidoCliente/consultar-pedido',compact('pedidos'));
        }else{
            return view('pedidoCliente/consultar-venta',compact('ventas'));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            $venta = Venta::findOrFail($pedido->idv);
            if($pedido->status != "En espera") {
                return response()->json(['error' => 'Este pedido no puede ser cancelado.'], 400);
            }
            
            $pedido->status = $request->input('estado');
            $venta -> total -= $pedido->totalP;

            $pedido->save();
            $venta->save();
            return response()->json(['message' => 'Pedido actualizado correctamente']);
        } catch (\Exception $e) {
            // Devolver una respuesta de error
            return response()->json(['error' => 'Ocurrió un error al actualizar el pedido'], 500);
        }
    }

}
