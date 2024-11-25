<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteVentaController extends Controller
{
    // Muestra la vista principal del dashboard de reportes.
    // Recibe: Nada.
    // Devuelve: Una vista del dashboard de reportes.
    public function show(){
        return view('reportes/dashboard');
    }


    // Muestra la vista de reportes de ventas.
    // Recibe: Nada.
    // Devuelve: La vista de reportes de ventas.
    public function showVentas(){
        return view('reportes.ventas.ventas');
    }


    // Maneja la generación de reportes de ventas según el formulario seleccionado 
    // (diario, semanal o mensual), procesando las entradas y devolviendo datos 
    // necesarios para la vista de reportes.
    // Recibe: Un request con los datos del formulario (La fecha de inicio o el número del mes).
    // Devuelve: Una redirección con los datos procesados para la vista de reportes.
    public function showVentasReporte(Request $request){
        $reporte = $request->input('formulario');

        switch ($reporte) {
            case 'formulario1':
                $fecha = $request->input('fecha');

                // Validación
                $request->validate([
                    'fecha' => 'required|date',
                ]);

                // Totales
                $totalPP = DB::select('select COALESCE(sum(totalP), 0) as totalPas from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Pastelería" 
                and fechaVent = ? and pedido.status != "En espera";', [$fecha]);

                $totalPC = DB::select('select COALESCE(sum(totalP), 0) totalCaf from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Cafetería" 
                and fechaVent = ? and pedido.status != "En espera";', [$fecha]);

                $total = $totalPP[0]->totalPas + $totalPC[0]->totalCaf;


                // Información para tabla
                $ventas = DB::select('select nombre, sum(cantidad) as cantidad, sum(totalP) as total
                from venta inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where fechaVent = ? and pedido.status != "En espera"
                group by nombre;', [$fecha]);
                
                $fechaN = Carbon::createFromFormat('Y-m-d', $fecha)->format('Y - F - d');

                return redirect()->route('reportes.ventas')->with(compact('totalPP', 'totalPC', 'total', 'reporte', 'fechaN', 'ventas'));
                break;


            case 'formulario2':
                $fecha = $request->input('fecha');
                // Validación
                $request->validate([
                    'fecha' => 'required|date',
                ]);

                //Fechas
                $fechaInicio = Carbon::parse($fecha)->startOfDay();
                $fechaFin = Carbon::parse($fechaInicio)->addWeek(1)->endOfDay();

                //Totales
                $totalPP = DB::select('select COALESCE(sum(totalP), 0) as totalPas from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Pastelería" 
                and (fechaVent between ? and ?) 
                and pedido.status != "En espera";', [$fechaInicio, $fechaFin]);

                $totalPC = DB::select('select COALESCE(sum(totalP), 0) as totalCaf from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Cafetería" 
                and (fechaVent between ? and ?) 
                and pedido.status != "En espera";', [$fechaInicio, $fechaFin]);

                $total = $totalPP[0]->totalPas + $totalPC[0]->totalCaf;


                // Información para gráfico
                $conVentasP = DB::select('select fechaVent, sum(totalP) as total
                from venta inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Pastelería" 
                and (fechaVent between ? and ?) 
                and pedido.status != "En espera"
                group by fechaVent;', [$fechaInicio, $fechaFin]);

                $conVentasC = DB::select('select fechaVent, sum(totalP) as total
                from venta inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Cafetería" 
                and (fechaVent between ? and ?) 
                and pedido.status != "En espera"
                group by fechaVent;', [$fechaInicio, $fechaFin]);

                $periodo = CarbonPeriod::create($fechaInicio, $fechaFin);
                $fechas = [];
                $dias = [];
                foreach ($periodo as $fecha) {
                    $fechas[] = $fecha->format('Y-m-d');
                    $dias[] = $fecha->locale('es')->isoFormat('dddd');
                }

                $ventasP = array_fill(0, count($fechas), 0); 
                $ventasC = array_fill(0, count($fechas), 0);

                foreach ($conVentasP as $venta) {
                    foreach ($fechas as $i => $fecha) {
                        if ($venta->fechaVent === $fecha) {
                            $ventasP[$i] = $venta->total;
                        }
                    }
                }

                foreach ($conVentasC as $venta) {
                    foreach ($fechas as $i => $fecha) {
                        if ($venta->fechaVent === $fecha) {
                            $ventasC[$i] = $venta->total;
                        }
                    }
                }

                $jsonData = json_encode([
                    'dias' => $dias,
                    'ventasP' => $ventasP,
                    'ventasC' => $ventasC,
                ]);

                //Modificar formato de fecha 
                $fechaInicioN = $fechaInicio->format('Y - F - d');
                $fechaFinN = $fechaFin->format('Y - F - d');

                //Devolución de datos
                return redirect()->route('reportes.ventas')->with(compact('fechaInicioN', 'fechaFinN', 'totalPP', 'totalPC', 'total', 'jsonData', 'reporte'));

                break;

            case 'formulario3':
                
                $mes = (int) $request->input('mes');
                $year = now()->year;

                // Nombre del mes
                $nombreMes = ucfirst(Carbon::create()->month($mes)->translatedFormat('F'));

                // Totales
                $totalPP = DB::select('select COALESCE(sum(totalP), 0) as totalPas from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Pastelería" 
                and (month(fechaVent) = ? and year(fechaVent)=?) 
                and pedido.status != "En espera";', [$mes, $year]);

                $totalPC = DB::select('select COALESCE(sum(totalP), 0) as totalCaf from venta 
                inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Cafetería" 
                and (month(fechaVent) = ? and year(fechaVent)=?)  
                and pedido.status != "En espera";', [$mes, $year]);

                $total = ($totalPP[0]->totalPas ?? 0) + ($totalPC[0]->totalCaf ?? 0);

                //Información para el gráfico
                $conVentasP = DB::select('select fechaVent, sum(totalP) as total
                from venta inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Pastelería" 
                and (month(fechaVent) = ? and year(fechaVent)=?) 
                and pedido.status != "En espera"
                group by fechaVent;', [$mes, $year]);

                $conVentasC = DB::select('select fechaVent, sum(totalP) as total
                from venta inner join pedido on venta.idv = pedido.idv
                inner join producto on pedido.idpro = producto.idpro
                where producto.tipo = "Cafetería" 
                and (month(fechaVent) = ? and year(fechaVent)=?) 
                and pedido.status != "En espera"
                group by fechaVent;', [$mes, $year]);

                $dias = range(1, 30); 
                $ventasP = array_fill(0, 30, 0); 
                $ventasC = array_fill(0, 30, 0); 

                foreach ($conVentasP as $venta) {
                    $dia = (int) Carbon::parse($venta->fechaVent)->day; 
                    $ventasP[$dia - 1] = $venta->total; 
                }

                foreach ($conVentasC as $venta) {
                    $dia = (int) Carbon::parse($venta->fechaVent)->day; 
                    $ventasC[$dia - 1] = $venta->total; 
                }

                $jsonDataMen = json_encode([
                    'dias' => $dias,
                    'ventasP' => $ventasP,
                    'ventasC' => $ventasC,
                ]);

                //Devolución de datos
                return redirect()->route('reportes.ventas')->with(compact('nombreMes', 'year', 'totalPP', 'totalPC', 'total', 'jsonDataMen', 'reporte'));

                break;
        }        
    }


    // Genera un PDF con el reporte diario de ventas incluyendo información como
    // totales por tipo de producto y lista de ventas.
    // Recibe: Un request con los datos procesados previamente en el controlador.
    // Devuelve: Un archivo PDF descargable con el reporte diario.
    public function generarDiarioPDF(Request $request){
        $fechaN = $request->input('fechaN');
        $totalPP = $request->input('totalPP');
        $totalPC = $request->input('totalPC');
        $total = $request->input('total');
        $ventas = json_decode($request->input('ventas'));

        $data = [
            'fechaN' => $fechaN,
            'totalPP' => $totalPP,
            'totalPC' => $totalPC,
            'total' => $total,
            'ventas' => $ventas
        ];

        $pdf = Pdf::loadView('reportes.ventas.ventas_diarias_pdf', $data);
        return $pdf->download('reporte_ventas_diarias.pdf');
    }

    
    // Genera un PDF con el reporte semanal de ventas, incluyendo totales, fechas
    // y un gráfico semanal de las ventas si se subió correctamente.
    // Recibe: Un request con los datos procesados y el archivo del gráfico semanal.
    // Devuelve: Un archivo PDF generado o un mensaje de error si la imagen no es válida.
    public function generarSemanalPDF(Request $request)
    {
        ini_set('max_execution_time', 120);

        $fechaInicioN = $request->input('fechaInicioN');
        $fechaFinN = $request->input('fechaFinN');
        $totalPP = $request->input('totalPP');
        $totalPC = $request->input('totalPC');
        $total = $request->input('total');
        $graficoImagenSem = $request->file('graficoImagenSem');
    
        if ($graficoImagenSem && $graficoImagenSem->isValid()) {
            // Nombre del archivo y la ruta donde se almacenará
            $nombreArchivo = 'grafico_semanal.png'; 
            $rutaAlmacenamiento = public_path('temp/');

            if (!file_exists($rutaAlmacenamiento)) {
                mkdir($rutaAlmacenamiento, 0777, true);  // Crear la carpeta si no existe
            }
    
            // Mover el archivo a la ruta de almacenamiento
            $graficoImagenSem->move($rutaAlmacenamiento, $nombreArchivo);
    
            // Cargar la librería DOMPDF
            $pdf = App::make('dompdf.wrapper');
            
            // Construir el contenido HTML del PDF
            $html = view('reportes.ventas.ventas_semanales_pdf', [
                'fechaInicioN' => $fechaInicioN,
                'fechaFinN' => $fechaFinN,
                'totalPP' => $totalPP,
                'totalPC' => $totalPC,
                'total' => $total,
                // Usar la URL pública de la imagen almacenada
                'graficoImagenSem' => url('temp/' . $nombreArchivo)
            ])->render();
    
            // Cargar el contenido HTML al PDF
            $pdf->loadHTML($html);
            return $pdf->stream('reporte_ventas_semanales.pdf');
        } else {
            return response()->json([
                'message' => 'No se subió ningún archivo válido'
            ], 400);
        }
    }
    
    
    // Genera un PDF con el reporte mensual de ventas, incluyendo totales, el nombre
    // del mes, el año y un gráfico mensual de las ventas si se subió correctamente.
    // Recibe: Un request con los datos procesados y el archivo del gráfico mensual.
    // Devuelve: Un archivo PDF generado o un mensaje de error si la imagen no es válida.
    public function generarMensualPDF(Request $request){
        ini_set('max_execution_time', 120);

        $nombreMes = $request->input('nombreMes');
        $year = $request->input('year');
        $totalPP = $request->input('totalPP');
        $totalPC = $request->input('totalPC');
        $total = $request->input('total');
        $graficoImagenMen = $request->file('graficoImagenMen');
        

            // Nombre del archivo y la ruta donde se almacenará
            $nombreArchivo = 'grafico_mensual.png'; 
            $rutaAlmacenamiento = public_path('temp/');

            if (!file_exists($rutaAlmacenamiento)) {
                mkdir($rutaAlmacenamiento, 0777, true);  // Crear la carpeta si no existe
            }

            // Mover el archivo a la ruta de almacenamiento
            $graficoImagenMen->move($rutaAlmacenamiento, $nombreArchivo);

            // Cargar la librería DOMPDF
            $pdf = App::make('dompdf.wrapper');

            // Construir el contenido HTML del PDF
            $html = view('reportes.ventas.ventas_mensuales_pdf', [
                'nombreMes' => $nombreMes,
                'year' => $year,
                'totalPP' => $totalPP,
                'totalPC' => $totalPC,
                'total' => $total,
                'graficoImagenMen' => url('temp/' . $nombreArchivo)
            ])->render();

            // Cargar el contenido HTML al PDF
            $pdf->loadHTML($html);

            // Descargar el PDF
            return $pdf->download('reporte_ventas_mensuales.pdf');

    }
}
