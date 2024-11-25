@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/reportes/reportes.css') : secure_asset('css/reportes/reportes.css') }}">
@endsection

@section('title','Reporte de empleados')


@section('main')
        <!-- Botones -->
        <div class="botones mt-5">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Productos próximos a caducar</label>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-regresar" onclick="window.location.href='{{ route('reportes.dashboard') }}'">Regresar</button>

        <!-- Mostrar Resultados -->
        <section class="resultados">
            <h3 class="title">Productos próximos a caducar</h3>

            <section class="fecha">
                <p>{{ $hoyN }}</p>
            </section>

            <section class="tabla">
                <table id="caducadosTable" class="table-striped table-bordered tabla-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Fecha de ingreso</th>
                            <th>Fecha de caducidad</th>
                            <th>Días que faltan para que caduque</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($caducados as $caducado)
                            <tr>
                                <td>{{ $caducado->idalm }}</td>
                                <td>{{ $caducado->nombre }}</td>
                                <td>{{ $caducado->categoria }}</td>
                                <td>{{ $caducado->fechaIng }}</td>
                                <td>{{ $caducado->fechaCad }}</td>
                                <td>{{ $caducado->dias }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <!-- Datos para el PDF -->
            <section class="datos-pdf">
                <form action="{{ route('reportes.caducados.pdf') }}" enctype="multipart/form-data" method="GET">
                    @csrf
                    <input type="hidden" name="caducados" value="{{ json_encode($caducados) }}">
                    <input type="hidden" name="hoyN" value="{{ $hoyN }}">

                    <button class="btn btn-primary">Descargar en PDF</button>
                </form>
            </section>
        </section>
        
    

    <!-- Cargar jQuery antes de DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cargar DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Cargar Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>    

    <!-- Script de ventas -->
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/reportes/caducados/caducados.js') : secure_asset('js/reportes/caducados/caducados.js') }}"></script>

@endsection


