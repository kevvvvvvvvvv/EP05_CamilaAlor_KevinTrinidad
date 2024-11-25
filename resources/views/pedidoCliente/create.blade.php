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
                <h3>Datos del generales de la venta</h3>
                <br>

                <label>Fecha de entrega</label><br>
                <input type="date" name="fecha" id="fecha">
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
        <p>Fecha de entrega: <span id="fechaentrega">0000-00-00</span></p>

        <form action="{{ route('pedido.cliente.store') }}" method="post" id="formVenta">
            @csrf
            <input type="hidden" id="fechaP" name="fechaP">
            <input type="hidden" id="totalHidden" name="total">
            <input type="hidden" id="productos" name="productos">
            <button class="btn-enviar">Enviar</button>
        </form>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("fecha").setAttribute("min", today);
    });
    document.addEventListener("DOMContentLoaded", function() {
        $('.select2').select2({
            placeholder: "Selecciona una opción",
            allowClear: true
        });

        document.getElementById('agregarProducto').addEventListener('click', function() {
            const select = document.getElementById('producto');
            const idProducto = select.value;
            const nombreProducto = select.options[select.selectedIndex].dataset.nombre;
            const precio = parseFloat(select.options[select.selectedIndex].dataset
                .precio); // Obtener el precio
            const descripcion = document.getElementById('descripcion').value;
            const cantidad = parseInt(document.getElementById('cantidad').value) || 0;


            if (idProducto && cantidad > 0) {
                // Calcular subtotal
                const subtotalProducto = precio * cantidad;

                // Crear una nueva fila en la tabla
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${nombreProducto}</td>
                <td>${descripcion}</td>
                <td>${cantidad}</td>
                <td>${precio.toFixed(2)}</td> <!-- Mostrar precio unitario -->
                <td>${subtotalProducto.toFixed(2)}</td> <!-- Mostrar subtotal -->
                <td>
                    <button type="button" class="btn btn-danger eliminar" data-id="${idProducto}" data-subtotal="${subtotalProducto}" data-total="${subtotalProducto.toFixed(2)}">Eliminar</button>
                </td>
            `;

                document.getElementById('listaProductos').appendChild(tr);

                // Limpiar el campo de selección y los inputs
                select.value = '';
                document.getElementById('descripcion').value = '';
                document.getElementById('cantidad').value = '';
                $(select).val('').trigger('change');

                // Actualizar subtotal y total
                updateTotals();
            }
        });

        // Manejar el evento de eliminar un producto de la lista
        document.getElementById('listaProductos').addEventListener('click', function(event) {
            if (event.target.classList.contains('eliminar')) {
                const subtotal = parseFloat(event.target.dataset.subtotal);
                const total = parseFloat(event.target.dataset.total);
                event.target.closest('tr').remove(); // Eliminar la fila

                // Actualizar subtotal y total
                updateTotals(total);
            }
        });

        // Función para actualizar el subtotal y total
        function updateTotals(removedSubtotal = 0) {
            const rows = document.querySelectorAll('#listaProductos tr');
            let subtotal = 0;

            rows.forEach(row => {
                const subtotalCell = parseFloat(row.cells[4].innerText) ||
                    0; // Obtener el subtotal de la fila
                
                subtotal += subtotalCell;
            });

            //subtotal -= removedSubtotal;
            subtotal = Math.max(0, subtotal);

            /* document.getElementById('subtotal').innerText = subtotal.toFixed(2); */
            document.getElementById('total').innerText = subtotal.toFixed(2);
            document.getElementById('fechaentrega').innerText = document.getElementById('fecha').value;
        }


        document.getElementById('formVenta').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            // Productos guardados en un campo oculto
            const lista = document.getElementById('listaProductos');
            const productos = Array.from(lista.children).map(tr => {
                // Asegúrate de que cada tr tenga las celdas necesarias
                return {
                    id: tr.querySelector('.eliminar').dataset.id, // ID del producto
                    nombre: tr.children[0].innerText, // Nombre del producto
                    descripcion: tr.children[1].innerText, // Descripción del producto
                    cantidad: tr.children[2].innerText, // Cantidad del producto
                    precio: tr.children[3].innerText, // Precio del producto
                    subtotal: tr.children[4].innerText // Subtotal del producto
                };
            });

            // Convertir el objeto a JSON y almacenar en el campo oculto
            document.getElementById('productos').value = JSON.stringify(productos);

            // Capturar el valor del total y almacenarlo en el campo oculto
            const total = document.getElementById('total').innerText;
            document.getElementById('totalHidden').value = total;
            document.getElementById('fechaP').value = document.getElementById('fecha').value;

            this.submit(); // Envía el formulario después de capturar todos los datos
        });

    });
</script>
