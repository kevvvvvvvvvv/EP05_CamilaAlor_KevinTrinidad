document.addEventListener('DOMContentLoaded', function() {
    let today = new Date().toISOString().split('T')[0];
    document.getElementById("fecha").setAttribute("min", today);

    //Busqueda por rango de fechas
    $(document).ready(function () {

        var table = $('#myTable').DataTable();
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $('#minDate').val();
                var max = $('#maxDate').val();
                var fecha = data[3]; 

                if (!min && !max) {
                    return true; // Sin filtros, mostrar todo
                }

                if (min && new Date(fecha) < new Date(min)) {
                    return false; // Fecha menor al rango mínimo
                }

                if (max && new Date(fecha) > new Date(max)) {
                    return false; // Fecha mayor al rango máximo
                }

                return true; // Cumple el rango
            }
        );

        // Reaplicar el filtro cuando cambien las fechas
        $('#minDate, #maxDate').on('change', function () {
            table.draw();
        });
    });
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
        const statusSelect = document.getElementById('status');
        const status = statusSelect.options[statusSelect.selectedIndex].text;


        const promocionSelect = document.getElementById("promocion");
        const promocionText = promocionSelect.options[promocionSelect.selectedIndex].text;
        const descuento = parseFloat(promocionSelect.options[promocionSelect.selectedIndex].dataset
            .descuento) || 0;

        if (idProducto && cantidad > 0) {
            // Calcular subtotal
            const subtotalProducto = precio * cantidad;

            const idPromocion = document.getElementById('promocion').value;

            // Crear una nueva fila en la tabla
            const tr = document.createElement('tr');
            tr.setAttribute('data-id-promocion', idPromocion);
            tr.innerHTML = `
            <td>${nombreProducto}</td>
            <td>${descripcion}</td>
            <td>${cantidad}</td>
            <td>${descuento*precio*cantidad}</td>
            <td>${status}</td>
            <td>${precio.toFixed(2)}</td> <!-- Mostrar precio unitario -->
            <td>${subtotalProducto.toFixed(2)-descuento*precio*cantidad}</td> <!-- Mostrar subtotal -->
            <td>
                <button type="button" class="btn btn-danger eliminar" data-id="${idProducto}" data-subtotal="${subtotalProducto}" data-total="${subtotalProducto.toFixed(2)-descuento*precio*cantidad}">Eliminar</button>
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
            const subtotalCell = parseFloat(row.cells[6].innerText) ||
                0; // Obtener el subtotal de la fila
            subtotal += subtotalCell;
        });

        //subtotal -= removedSubtotal;
        subtotal = Math.max(0, subtotal);

        /* document.getElementById('subtotal').innerText = subtotal.toFixed(2); */
        document.getElementById('total').innerText = subtotal.toFixed(2);
        // Actualizar el nombre del cliente seleccionado en el elemento `clienteN`
        document.getElementById('clienteN').innerText = document.getElementById('cliente').value;
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
                descuento: tr.children[3].innerText, // Descuento del producto
                promocion: tr.getAttribute('data-id-promocion') ||
                    null, // ID de la promoción
                status: tr.children[4].innerText,
                precio: tr.children[5].innerText, // Precio del producto
                subtotal: tr.children[6].innerText // Subtotal del producto
            };
        });

        // Convertir el objeto a JSON y almacenar en el campo oculto
        document.getElementById('productos').value = JSON.stringify(productos);

        // Capturar el valor del total y almacenarlo en el campo oculto
        const total = document.getElementById('total').innerText;
        document.getElementById('totalHidden').value = total;
        const selectedOption = document.getElementById('cliente').options[document.getElementById(
            'cliente').selectedIndex];
        const idcli = selectedOption.getAttribute('data-idcli');
        document.getElementById('cli').value = idcli;
        document.getElementById('fechaP').value = document.getElementById('fecha').value;

        this.submit(); // Envía el formulario después de capturar todos los datos
    });

});