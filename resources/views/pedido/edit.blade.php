@extends('layaout.stencil')

@section('head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/pedido/pedido.css') : secure_asset('css/pedido/pedido.css') }}">
@endsection

@section('title', 'Editar pedido')

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
                <h1>Edición de pedido</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>

        <hr>

        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>

            <form action="{{route('pedido.update',$pedido->idped) }}" method="post" id="formVenta">
                @csrf
                @method('put')
                <div class="col-sm-10 col-md-8">

                    <h3>Datos del pedido</h3>
                    <br>

                    <label>Producto</label>
                    <br>
                    <select name="producto" id="producto" class="form-control select2">
                        <option value="">Selecciona un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->idpro }}" {{old('producto',$pedido->idpro) == $producto->idpro ? 'selected' : ''}}>{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    <br>
                    <br>

                    <label>Descripción</label><br>
                    <input type="text" id="descripcion" class="form-control" name="descripcion" value="{{old('descripcion',$pedido->descripcion)}}">
                    <br>

                    <label>Cantidad</label><br>
                    <input type="number" id="cantidad" class="form-control" name="cantidad" value="{{old('cantidad',$pedido->cantidad)}}"><br>


                    <label for="status">Estado:</label><br>
                    <select id="status" name="status">
                        <option value="En espera" {{old('status', $pedido->status) == 'En espera' ? 'selected' : ''}}>En espera</option>
                        <option value="Aprobado" {{old('status', $pedido->status) == 'Aprobado' ? 'selected' : ''}}>Aprobado</option>
                        <option value="Preparando" {{old('status', $pedido->status) == 'Preparando' ? 'selected' : ''}}>Preparando</option>
                        <option value="Finalizado" {{old('status', $pedido->status) == 'Finalizado' ? 'selected' : ''}}>Finalizado</option>
                        <option value="Entregado" {{old('status', $pedido->status) == 'Entregado' ? 'selected' : ''}}>Entregado</option>
                    </select>
                    <br>
                    <br>

                    <label>Promoción</label><br>
                    <select name="promocion" id="promocion" class="form-control select2">
                        <option value="">Selecciona una promoción</option>
                        @foreach ($promociones as $promocion)
                            <option value="{{ $promocion->idprom }}" {{old('promocion',$pedido->idprom) == $promocion->idprom ? 'selected' : ''}}>{{ $promocion->descripcion }}</option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                </div>

                <br>
                <br>
                <button class="btn-enviar">Enviar</button>
            </form>
        </div>

        <div class="col-sm-1 col-md-2"></div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#producto').select2({
                placeholder: "Selecciona o escribe un producto",
                allowClear: true,
                width: '100%'
            });

            $('#promocion').select2({
                placeholder: "Selecciona o escribe una promoción",
                allowClear: true,
                width: '100%'
            });
        });

    </script>

@endsection



