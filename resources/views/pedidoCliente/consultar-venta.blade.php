@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/layaout/table.css') : secure_asset('css/layaout/table.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','Consulta de ventas')

@section('main')
    <div>
        <h1>Consulta de ventas</h1>
        <div class="table">
            <table id="myTable" class="cell-border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha venta</th>
                        <th>Fecha entrega</th>
                        <th>Total</th>
                        <th>Empleado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td>{{$venta->idv}}</td>
                        <td>{{$venta->fechaVent}}</td>
                        <td>{{$venta->fecEntrega}}</td>
                        <td>{{$venta->total}}</td>
                        <td>{{ $venta->empleado ? $venta->empleado->nombre . ' ' . $venta->empleado->ap . ' ' . $venta->empleado->am : 'Sin asignar' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex buttons justify-content-between align-items-center">
            <p><button id="detalles">Más detalles</button></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Cargar jQuery antes de DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cargar DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- JS de DataTables y extensiones de botones -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <!-- Cargar el archivo producto.js -->
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/pedidoCliente/ventaCliente.js?v=1.0.1') : secure_asset('js/pedidoCliente/ventaCliente.js?v=1.0.1') }}"></script>
@endsection
