@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/layaout/table.css') : secure_asset('css/layaout/table.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','Consulta de pedidos')

@section('main')
    <div>
        <h1>Consulta de pedidos</h1>
        <div class="table">
            <table id="myTable" class="cell-border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Producto</th>
                        <th>ID venta</th>
                        <th>Promoción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->idped}}</td>
                        <td>{{$pedido->descripcion}}</td>
                        <td>{{$pedido->cantidad}}</td>
                        <td>{{$pedido->fePed}}</td>
                        <td>{{$pedido->subtotal}}</td>
                        <td>{{$pedido->descuento}}</td>
                        <td>{{$pedido->totalP}}</td>
                        <td>{{$pedido->status}}</td>
                        <td>{{$pedido->producto ? $pedido->producto->nombre : 'Sin asignar'}}</td>
                        <td>{{$pedido->idv}}</td>
                        <td>{{$pedido->promocion ? $pedido->promocion->descripcion : 'Sin asignar'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex buttons justify-content-between align-items-center">
            <p><button id="eliminarDato">Cancelar pedido</button></p>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
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
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/pedidoCliente/pedidoCliente.js?v=1.0.1') : secure_asset('js/pedidoCliente/pedidoCliente.js?v=1.0.1') }}"></script>
@endsection