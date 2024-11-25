@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición promoción')

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
                <h1>Editar una promoción</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('promocion.update',$promocion->idprom)}}" method="post">

                    @csrf

                    @method('put')

                    <label>Código:</label>
                    <br>
                    <input type="text" name="codigo" value="{{ old('codigo', $promocion->codigo) }}">
                    <br>
                    @error('codigo')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Descuento:</label>
                    <br>
                    <input type="text" name="descuento" value="{{ old('descuento', $promocion->descuento) }}">
                    <br>
                    @error('descuento')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Días:</label>
                    <br>
                    <input type="text" name="dias" value="{{old('dias', $promocion->dias) }}">
                    <br>
                    @error('dias')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Descripción:</label>
                    <br>
                    <div class="descripcion">
                        <input type="text" name="descripcion" value="{{old('descripcion', $promocion->descripcion) }}">
                    </div>
                    <br>
                    @error('descripcion')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Estatus:</label>
                        <select type="text" name="estatus">
                            <option value="Activa" {{old('estatus', $promocion->estatus) == 'Activa' ? 'selected' : ''}} >Activa</option>
                            <option value="Inactiva" {{old('estatus', $promocion->estatus) == 'Inactiva' ? 'selected' : ''}} >Inactiva</option>
                        </select>
                    </div>
                        
                    <br>
                    @error('estatus')
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