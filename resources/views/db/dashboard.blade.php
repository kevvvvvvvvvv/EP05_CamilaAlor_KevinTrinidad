@extends('layaout/stencil')

@section('head')
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/db/dashboard.css') : secure_asset('css/db/dashboard.css') }}">
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/formulario/formulario.css') : secure_asset('css/formulario/formulario.css') }}">
@endsection

@section('title', 'Dashboard base de datos')

@section('main')
    <div class="container mt-5">
        <div class="row title">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                <h1 style="text-align: center;">Respaldo y restauración de la base de datos</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        <hr>
        <br>
        <br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-6 col-md-6">
                <form action="{{ route('exportar.database') }}" method="get">
                    <button class="btn-enviar">
                        Exportar la base de datos
                    </button>
                </form>
                <br>
                <br>
            </div>

            <div class="col-sm-6 col-md-6 d-flex formulario ">
                <form action="{{ route('database.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="contenedor">
                        <input type="file" name="backup_file" class="file" required>
                    </div>
                    
                    <br>
                    <br>

                    <button type="submit" class="btn-regresar">Restaurar Base de Datos</button>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
