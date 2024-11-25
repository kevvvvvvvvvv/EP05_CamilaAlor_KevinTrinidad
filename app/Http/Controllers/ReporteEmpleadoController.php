<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ReporteEmpleadoController extends Controller
{
    // Manda a llamar la vista del formulario de empleados.
    // Recibe: Nada.
    // Devuelve: La vista del formulario de empleados.
    public function showEmpleados(){
        return view('reportes.empleados.empleados');
    }


    // Procesa los datos enviados desde el formulario y genera un reporte mensual 
    // de ventas por empleado.
    // Recibe: Un request con el formulario seleccionado y el mes a consultar.
    // Devuelve: Una redirección a la vista del formulario de empleados con los datos del reporte.
    public function showEmpleadosReporte(Request $request){
        $reporte = $request->input('formulario');

        $mes = (int) $request->input('mes');
        $year = now()->year;

        // Nombre del mes
        $nombreMes = ucfirst(Carbon::create()->month($mes)->translatedFormat('F'));

        //Información para la gráfica
        $conEmpleados = DB::select('select concat(nombre," ", ap, " ", am) as nombreCom, 
        sum(cantidad) as totalVen from venta
        inner join empleado on venta.ide = empleado.ide
        inner join pedido on venta.idv = pedido.idv
        where (month(fechaVent) = ? and year(fechaVent) = ?) and
        pedido.status != "En espera" 
        group by nombreCom order by totalVen desc limit 3;', [$mes, $year]);

        $empleados = [];
        $cantidad = [];

        foreach ($conEmpleados as $empleado) {
            $empleados[] = $empleado->nombreCom;
            $cantidad[] = $empleado->totalVen;
        }

        $jsonData = json_encode([
            'empleados' => $empleados,
            'cantidad' => $cantidad
        ]);

        $empMasVentas = !empty($empleados) ? $empleados[0] : 'Sin datos';
        $empMasCant = !empty($cantidad) ? $cantidad[0] : 0;

        //Devolución de datos
        return redirect()->route('reportes.empleados')->with(compact('nombreMes', 'year', 'jsonData', 'empMasVentas', 'empMasCant', 'reporte'));
    }


    // Genera un archivo PDF que contiene el reporte mensual de ventas por empleado.
    // Recibe: Un request con los datos del mes, año, empleado con más ventas, 
    // cantidad máxima y el gráfico generado.
    // Devuelve: Un archivo PDF descargable con el reporte generado.
    public function generarMensualPDF(Request $request){
        $nombreMes = $request->input('nombreMes');
        $year = $request->input('year');
        $empMasVentas = $request->input('empMasVentas');
        $empMasCant = $request->input('empMasCant');
        $graficoImagenMen = $request->file('graficoImagenMen');

        // Nombre del archivo y la ruta donde se almacenará
        $nombreArchivo = 'grafico_mensual.png'; 
        $rutaAlmacenamiento = public_path('temp/');

        $graficoImagenMen->move($rutaAlmacenamiento, $nombreArchivo);

        // Cargar la librería DOMPDF
        $pdf = App::make('dompdf.wrapper');

        // Construir el contenido HTML del PDF
        $html = view('reportes.empleados.empleados_mensuales_pdf', [
            'nombreMes' => $nombreMes,
            'year' => $year,
            'empMasVentas' => $empMasVentas,
            'empMasCant' => $empMasCant,
            'graficoImagenMen' => $graficoImagenMen
        ])->render();

        // Cargar el contenido HTML al PDF
        $pdf->loadHTML($html);

        // Descargar el PDF
        return $pdf->download('reporte_empleados_mensuales.pdf');
    }
}
