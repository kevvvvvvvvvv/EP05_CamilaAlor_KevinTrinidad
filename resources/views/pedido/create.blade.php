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

@section('title', 'Realizar pedido')

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
                <h1>Registro de un nuevo pedido</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>

        <hr>

        <div class="row formulario">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                <h3>Datos generales de la venta</h3>
                <br>

                <label>Fecha de entrega</label><br>
                <input type="date" name="fecha" id="fecha">
                <br>
                <br>

                <label>Clientes</label><br>
                <select name="cliente " id="cliente" class="form-control select2">
                    <option value="">Selecciona un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->nombre }} {{ $cliente->ap }} {{ $cliente->am }}"
                            data-idcli="{{ $cliente->idcli }}">{{ $cliente->nombre }} {{ $cliente->ap }}
                            {{ $cliente->am }}
                        </option>
                    @endforeach
                </select>
                <br>
                <br>

                <hr>

                <h3>Datos del pedido</h3>
                <br>

                <label>Producto</label>
                <br>
                <select name="producto" id="producto" class="form-control select2">
                    <option value="">Selecciona un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->idpro }}" data-nombre="{{ $producto->nombre }}"
                            data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <br>
                <br>

                <label>Descripción</label><br>
                <input type="text" id="descripcion" class="form-control" name="descripcion">
                <br>

                <label>Cantidad</label><br>
                <input type="number" id="cantidad" class="form-control" name="cantidad"><br>


                <label for="status">Estado:</label><br>
                <select id="status" name="status">
                    <option value="aprobado">Aprobado</option>
                    <option value="espera">En espera</option>
                </select>
                <br>
                <br>

                <label>Promoción</label><br>
                <select name="promocion " id="promocion" class="form-control select2">
                    <option value="">Selecciona una promoción</option>
                    @foreach ($promociones as $promocion)
                        <option value="{{ $promocion->idprom }}" data-codigo="{{ $promocion->codigo }}"
                            data-descuento="{{ $promocion->descuento }}">{{ $promocion->descripcion }}</option>
                    @endforeach
                </select>
                <br>
                <br>

                <button id="agregarProducto" class="btn-enviar">Agregar producto</button><br><br>
            </div>
            
            <div class="col-sm-1 col-md-2"></div>
        </div>
        <br>
        <br>

        <h3>Productos Agregados</h3>
        <br>

        <div class="table">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Descuento</th>
                        <th>Estado</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="listaProductos">
                    <!--Productos seleccionados -->
                </tbody>
            </table>

        </div>


        <br>
        {{-- <p>Subtotal: <span id="subtotal">0</span></p> --}}
        <p>Total: <span id="total">0</span></p>
        <p>Cliente: <span id="clienteN"></span></p>
        <p>Fecha de entrega: <span id="fechaentrega">0000-00-00</span></p>

        <form action="{{route('pedido.store')}}" method="post" id="formVenta">
            @csrf
            <input type="hidden" id="fechaP" name="fechaP">
            <input type="hidden" id="totalHidden" name="total">
            <input type="hidden" id="productos" name="productos">
            <input type="hidden" id="cli" name="cli">
            <button class="btn-enviar">Enviar</button>
        </form>
    </div>
@endsection
