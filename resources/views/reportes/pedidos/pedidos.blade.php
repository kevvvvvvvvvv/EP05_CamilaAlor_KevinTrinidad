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
            <h3 class="title">Pedidos próximos a entregar</h3>

            <section class="fecha">
                <p>{{ $hoyN }}</p>
            </section>

            <section class="text-center pedidos">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-12">
                        <p>Pedidos aprobados</p>
                        <h3>{{ $conteoPedidos['Aprobado'] }}</h3>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <p>Pedidos en espera</p>
                        <h3>{{ $conteoPedidos['En espera'] }}</h3>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <p>Pedidos en preparación</p>
                        <h3>{{ $conteoPedidos['Preparando'] }}</h3>
                    </div>
                </div>

                <br>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12">
                        <p>Pedidos finalizados</p>
                        <h3>{{ $conteoPedidos['Finalizado'] }}</h3>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <p>Pedidos entregados</p>
                        <h3>{{ $conteoPedidos['Entregado'] }}</h3>
                    </div>
                </div>
            </section>

            <section class="tabla">
                <table id="pedidosTable" class="table-striped table-bordered tabla-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th>Fecha de realización de pedido</th>
                            <th>Fecha de entrega</th>
                            <th>Días para entregar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->idped }}</td>
                                <td>{{ $pedido->nombre }}</td>
                                <td>{{ $pedido->descripcion }}</td>
                                <td>{{ $pedido->cantidad }}</td>
                                <td>{{ $pedido->subtotal }}</td>
                                <td>{{ $pedido->descuento }}</td>
                                <td>{{ $pedido->totalP }}</td>
                                <td>{{ $pedido->fePed }}</td>
                                <td>{{ $pedido->fecEntrega }}</td>
                                <td>{{ $pedido->DiasFaltantes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <!-- Datos para el PDF -->
            <section class="datos-pdf">
                <form action="{{ route('reportes.pedidos.pdf') }}" enctype="multipart/form-data" method="GET">
                    @csrf
                    <input type="hidden" name="pedidos" value="{{ json_encode($pedidos) }}">
                    <input type="hidden" name="hoyN" value="{{ $hoyN }}">
                    <input type="hidden" name="conteoPedidos" value="{{ json_encode($conteoPedidos) }}">

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
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/reportes/pedidos/pedidos.js') : secure_asset('js/reportes/pedidos/pedidos.js') }}"></script>

@endsection


