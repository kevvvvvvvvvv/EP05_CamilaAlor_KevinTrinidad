@extends('layaout.stencil')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Registro almacenaje')

   
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
                <h1>Registro de un nuevo producto del almacenaje</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('almacenaje.store')}}" method="post">

                    @csrf
                
                    <input type="text" name="nombre" placeholder="Nombre del producto" value="{{old('nombre')}}">
                    <br>
                    @error('nombre')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>
                
                    <input type="text" name="descripcion" class="descripcion" placeholder="Descripción" value="{{old('descripcion')}}">
                    <br>
                    @error('descripcion')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>
                
                    <div class="contenedor">
                        <label>Fecha de ingreso de producto</label>
                        <input type="date" name="fechaIng" value="{{old('fechaIng')}}">
                    </div>
                    <br>
                    @error('fechaIng')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>
                
                    <div class="contenedor">
                        <label>Fecha de caducidad de producto</label>
                        <input type="date" name="fechaCad" value="{{old('fechaCad')}}">
                    </div>
                    <br>
                    @error('fechaCad')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>
                
                    <input type="text" name="cantidad" placeholder="Cantidad" value="{{old('cantidad')}}">
                    <br>
                    @error('cantidad')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>
                
                    <div class="contenedor">
                        <label>Categoría:</label>
                        <select type="text" name="categoria">
                            <option value="Utensilio" {{ old('categoria') == 'Utensilio' ? 'selected' : '' }}>Utensilio</option>
                            <option value="Comida" {{ old('categoria') == 'Comida' ? 'selected' : '' }}>Comida</option>
                            <option value="Otro" {{ old('categoria') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <br>
                    @error('categoria')
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

