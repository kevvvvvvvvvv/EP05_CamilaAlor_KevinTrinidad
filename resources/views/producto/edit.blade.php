@extends('layaout.stencil')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición producto')
    
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
                <h1>Editar un producto</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('producto.update',$producto->idpro)}}" method="post" enctype="multipart/form-data">

                    @csrf

                    @method('put')

                    <label>Nombre:</label>
                    <br>
                    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}">
                    <br>
                    @error('nombre')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Tipo:</label>
                        <select type="text" name="tipo">
                            <option value="Pastelería" {{old('tipo', $producto->tipo) == 'Pastelería' ? 'selected' : ''}} >Pastelería</option>
                            <option value="Cafetería" {{old('tipo', $producto->tipo) == 'Cafetería' ? 'selected' : ''}} >Cafetería</option>
                        </select>
                    </div>
                    <br>
                    @error('tipo')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Descripción:</label>
                    <div class="descripcion">
                        <input type="text" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}">
                    </div>
                    <br>
                    @error('descripcion')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Precio:</label>
                    <br>
                    <input type="text" name="precio" value="{{old('precio', $producto->precio) }}">
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