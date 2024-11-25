<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Dompdf\Dompdf;
use Dompdf\Options;


class ReportePedidoController extends Controller
{

    // Recoge los pedidos y su conteo según el estatus de entrega para la próxima semana 
    // y manda a llamar la vista correspondiente.
    // Recibe: Nada.
    // Devuelve: La vista de pedidos con los datos de los pedidos y su conteo por estatus.
    public function showPedidos(){
        $pedidos = DB::select('select idped, nombre, pedido.descripcion, cantidad, 
        subtotal, descuento, totalP, fePed, fecEntrega, datediff(fecEntrega,curdate()) as DiasFaltantes
        from venta inner join pedido on venta.idv = pedido.idv
        inner join producto on pedido.idpro = producto.idpro
        where (fecEntrega between curdate() and adddate(curdate(), interval 1 week))  
        and pedido.status != "En espera";');

        $conteoCons = DB::select('select pedido.status as estatus, count(*) as totalPed
        from pedido inner join venta on pedido.idv = venta.idv
        where (fecEntrega between curdate() and adddate(curdate(), interval 1 week)) 
        group by estatus;');

        $estatusIndices = ['Aprobado', 'En espera', 'Preparando', 'Finalizado', 'Entregado'];
        $conteoPedidos = array_fill_keys($estatusIndices, 0);

        foreach ($conteoCons as $conteo) {
            if (isset($conteoPedidos[$conteo->estatus])) {
                $conteoPedidos[$conteo->estatus] = $conteo->totalPed;
            }
        }

        $hoy = new \DateTime();
        $hoyN = $hoy->format('Y - F - d');

        return view('reportes.pedidos.pedidos', compact('pedidos', 'conteoPedidos', 'hoyN'));
    }


    // Genera un archivo PDF con la información de los pedidos y su conteo por estatus.
    // Recibe: Un request con los datos de los pedidos, la fecha de hoy y el conteo 
    // de los pedidos por estatus.
    // Devuelve: Un archivo PDF descargable con el reporte de los pedidos.
    public function generarPedidosPDF(Request $request){
        $pedidos = json_decode($request->input('pedidos'), true);
        $hoyN = $request->input('hoyN');
        $conteoPedidos = json_decode($request->input('conteoPedidos'), true);

        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('orientation', 'landscape');
        
        // Crear el objeto Dompdf con las opciones
        $pdf = new Dompdf($options);

        // Construir el contenido HTML del PDF
        $html = view('reportes.pedidos.pedidos_pdf', [
            'pedidos' => $pedidos,
            'hoyN' => $hoyN,
            'conteoPedidos' => $conteoPedidos,
        ])->render();

        // Cargar el contenido HTML al PDF
        $pdf->loadHTML($html);

        $pdf->setPaper('A4', 'landscape'); 
        $pdf->render();

        // Descargar el PDF
        return $pdf->stream('reporte_pedidos_pendientes.pdf');
    }
}
