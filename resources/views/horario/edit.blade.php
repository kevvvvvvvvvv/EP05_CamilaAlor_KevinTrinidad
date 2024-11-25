@extends('layaout.stencil')
    
@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición horario')

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
                <h1>Editar horario</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('horario.update',$horario->idh)}}" method="post">

                    @csrf

                    @method('put')

                    <label>Hora de entrada:</label>
                    <br>
                    <input type="time" name="horaentrada" value="{{ old('horaentrada', $horario->horaentrada) }}">
                    <br>
                    @error('horaentrada')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Hora de salida:</label>
                    <br>
                    <input type="time" name="horasalida" value="{{ old('horasalida', $horario->horasalida) }}">
                    <br>
                    @error('horasalida')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Día:</label>
                        <select type="text" name="dia">
                            <option value="Lunes" {{old('dia', $horario->dia) == 'Lunes' ? 'selected' : ''}} >Lunes</option>
                            <option value="Martes" {{old('dia', $horario->dia) == 'Martes' ? 'selected' : ''}} >Martes</option>
                            <option value="Miércoles" {{old('dia', $horario->dia) == 'Miércoles' ? 'selected' : ''}} >Miércoles</option>
                            <option value="Jueves" {{old('dia', $horario->dia) == 'Jueves' ? 'selected' : ''}} >Jueves</option>
                            <option value="Viernes" {{old('dia', $horario->dia) == 'Viernes' ? 'selected' : ''}} >Viernes</option>
                            <option value="Sábado" {{old('dia', $horario->dia) == 'Sábado' ? 'selected' : ''}} >Sábado</option>
                            <option value="Domingo" {{old('dia', $horario->dia) == 'Domingo' ? 'selected' : ''}} >Domingo</option>
                        </select>
                    </div>
                    <br>
                    @error('dia')
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