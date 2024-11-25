@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Registro producto')

@section('main')
    <div class="container mt-5">
        <div class="row title">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                @if (Auth::guard('cliente')->check())
                    <h6>Hola, {{ Auth::guard('cliente')->user()->nombre }}</h6>
                @elseif (Auth::guard('empleado')->check())
                    <h6>Hola, {{ Auth::guard('empleado')->user()->nombre }}</h6>
                @endif
                <h1>Registro de un nuevo producto</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('producto.store')}}" method="post" enctype="multipart/form-data">

                    @csrf

                    <input type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
                    <br>
                    @error('nombre')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Tipo:</label>
                        <select type="text" name="tipo">
                            <option value="Pastelería" {{ old('tipo') == 'Pastelería' ? 'selected' : '' }}>Pastelería</option>
                            <option value="Cafetería" {{ old('tipo') == 'Cafetería' ? 'selected' : '' }}>Cafetería</option>
                        </select>
                    </div>
                    <br>
                    @error('tipo')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="descripcion">
                        <input type="text" name="descripcion" placeholder="Descripción" value="{{old('descripcion')}}">
                        <br>
                    </div>
                    @error('descripcion')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <input type="text" name="precio" placeholder="Precio" value="{{old('precio')}}">
                    <br>
                    @error('precio')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Imagen:</label>
                        <input type="file" name="imagen">
                    </div>
                    <br>
                    @error('imagen')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="d-flex flex-sm-row flex-column gap-5 mb-5">
                        <button type="submit" class="btn-enviar">Enviar</button>
                        <button type="button" class="btn-regresar" onclick="window.history.back();">Regresar</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
    </div>
@endsection