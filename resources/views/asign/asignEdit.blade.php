@extends('layaout.stencil')
    
@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Asignación de horario')

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
                <h1>Asignación de horario</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">

                <form action="{{route('asign.update', $asignacion->idNotaHo)}}" method="post">

                    @csrf

                    @method('put')

                    <div class="contenedor">
                        <label>Empleado:</label>
                        <select name="empleado" id="empleado">
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->ide }}" 
                                {{old('empleado',$asignacion->ide) == $empleado->ide ? 'selected' : ''}}>
                                    {{ $empleado->nombre }} {{ $empleado->ap }} {{ $empleado->am }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <br>
                    <br>

                    <div class="contenedor">
                        <label>Horario:</label>
                        <select name="horario" id="horario">
                            @foreach ($horarios as $horario)
                                <option value="{{ $horario->idh }}" 
                                {{old('horario',$asignacion->idh) == $horario->idh ? 'selected' : ''}}>
                                    {{ $horario->dia }} de {{ $horario->horaentrada }} a {{ $horario->horasalida }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <br>

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

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