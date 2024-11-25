@extends('layaout.stencil')

{{-- Datos del head --}}
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/layaout/table.css') : secure_asset('css/layaout/table.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Consulta de almacenaje')

@section('main')
    <div>
        <h1>Consulta de almacenaje</h1>
        <div class="table">
            <table id="myTable" class="cell-border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de caducidad</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($almacenaje as $almacenajes)
                        <tr>
                            <td>{{ $almacenajes->idalm }}</td>
                            <td>{{ $almacenajes->nombre }}</td>
                            <td>{{ $almacenajes->descripcion }}</td>
                            <td>{{ $almacenajes->fechaIng }}</td>
                            <td>{{ $almacenajes->fechaCad }}</td>
                            <td>{{ $almacenajes->cantidad }}</td>
                            <td>{{ $almacenajes->categoria }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex buttons justify-content-between align-items-center">
            <p><button id="eliminarDato">Eliminar fila seleccionada</button></p>
            <p><button id="actualizarDato">Actualizar fila seleccionada</button></p>
        </div>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- JS de DataTables y extensiones de botones -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <!-- archivo producto.js -->
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/almacenaje/almacenaje.js?v=1.0.1') : secure_asset('js/almacenaje/almacenaje.js?v=1.0.1') }}"></script>

@endsection
