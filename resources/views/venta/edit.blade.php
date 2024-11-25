@extends('layaout.stencil')
    
@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición venta')

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
                <h1>Editar venta</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>
        
        <hr>
        
        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>
            
            <div class="col-sm-10 col-md-8">
                <form action="{{route('venta.update',$venta->idv)}}" method="post">

                    @csrf

                    @method('put')

                    <label>Fecha de entrega:</label>
                    <br>
                    <input type="date" name="fecentrega" value="{{ old('fecentrega', $venta->fecEntrega) }}">
                    <br>
                    @error('fecentrega')
                        <span>*{{ $message }}</span>
                    @enderror
                    <br>
                    <br>

                    <label>Empleado:</label>
                    <br>
                    <select name="empleado" id="empleado" class="form-control select2">
                        <option value="">Selecciona un cliente</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->ide}}" {{old('empleado',$venta->ide) == $empleado->ide ? 'selected' : ''}}>{{ $empleado->nombre }} {{ $empleado->ap }}
                                {{$empleado->am}}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    <br>

                    <label>Cliente:</label>
                    <br>
                    <select name="cliente" id="cliente" class="form-control select2">
                        <option value="">Selecciona un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->idcli}}" {{old('cliente',$venta->idcli) == $cliente->idcli ? 'selected' : ''}}>{{ $cliente->nombre }} {{ $cliente->ap }}
                                {{ $cliente->am }}
                            </option>
                        @endforeach
                    </select>
                    <br>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#cliente').select2({
                placeholder: "Selecciona o escribe un cliente",
                allowClear: true,
                width: '100%'
            });

            $('#empleado').select2({
                placeholder: "Selecciona o escribe una empleado",
                allowClear: true,
                width: '100%'
            });
        });

    </script>

@endsection