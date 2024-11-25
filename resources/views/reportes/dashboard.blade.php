@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/reportes/dashboard.css') : secure_asset('css/reportes/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
@endsection
    
@section('title','Dashboard de reportes')

@section('main')
        <div class="container mt-5">
            <div class="row justify-content-center mb-3 row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reporte de ventas</h5>
                            <p class="card-text">Muestra un reporte de las ventas mensuales, semanales o diarias.</p>
                            <a href="{{ route('reportes.ventas') }}" class="btn btn-primary">Generar reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ranking de productos</h5>
                            <p class="card-text">Ve tus productos más vendidos durenate la semana o el mes.</p>
                            <a href="{{ route('reportes.productos') }}" class="btn btn-primary">Generar reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Empleado del mes</h5>
                            <p class="card-text">Consulta al empleado que realizó más ventas durante el mes.</p>
                            <a href="{{ route('reportes.empleados') }}" class="btn btn-primary">Generar reporte</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Próximos a caducar</h5>
                            <p class="card-text">Ve los productos que están próximos a caducar.</p>
                            <a href="{{ route('reportes.caducados') }}" class="btn btn-primary" class="btn btn-primary">Generar reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pedidos pendientes</h5>
                            <p class="card-text">Consulta los pedidos de pasteles que están próximos a entregar.</p>
                            <a href="{{ route('reportes.pedidos') }}" class="btn btn-primary">Generar reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection