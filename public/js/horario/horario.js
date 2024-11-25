$(document).ready(function () {
    // Inicializa el DataTable y guarda la instancia en una variable
    const myTable = $('#myTable').DataTable({
        autoWidth: false,
        pagingType: 'simple_numbers',
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        dom: 'frt<"button-container"B>ip', // Define la estructura de los controles, 'B' es para los botones
        buttons: [
            {
                extend: 'excelHtml5', // Extensión para exportar a Excel
                text: 'Exportar a Excel', // Texto del botón
                titleAttr: 'Exportar a Excel', // Tooltip
                className: 'btn btn-success' // Clase CSS para diseño del botón
            }
        ]
    });

    // Maneja el evento de clic en las filas de la tabla
    $('#myTable tbody').on('click', 'tr', function (e) {
        let classList = e.currentTarget.classList;

        if (classList.contains('selected')) {
            classList.remove('selected');
        } else {
            myTable.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    // Maneja el evento de clic en el botón para eliminar filas seleccionadas
    document.querySelector('#eliminarDato').addEventListener('click', function () {
        const selectedRow = myTable.row('.selected');

        if (selectedRow.length) {
            const rowData = selectedRow.data(); // Obtener datos de la fila seleccionada
            const horarioId = rowData[0]; // Suponiendo que el ID está en la primera columna
            Swal.fire({
                title: "¿Estás seguro de eliminarlo?",
                text: "No podrás revertir este cambio",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminalo"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "Tu registro ha sido eliminado",
                        icon: "success"
                    });
                    // Realizar la solicitud AJAX para eliminar el producto
                    $.ajax({
                        url: 'horario/' + horarioId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Incluye el token CSRF
                        },
                        success: function (result) {
                            selectedRow.remove().draw(false);
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: "Ha ocurrido un problema al intentar eliminar tu producto",
                                icon: "error"
                            });
                        }
                    });
                }
              });
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
              });
              Toast.fire({
                icon: "error",
                title: "Selecciona una fila"
              });
        }
    });

    // Maneja el evento de clic en el botón para actualizar filas seleccionadas
    document.querySelector('#actualizarDato').addEventListener('click', function () {
        const selectedRow = myTable.row('.selected');

        if (selectedRow.length) {
            const rowData = selectedRow.data(); // Obtener datos de la fila seleccionada
            const horariojeId = rowData[0]; // Suponiendo que el ID está en la primera columna
            window.location.href='horario/'+horariojeId+'/edit';
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
              });
              Toast.fire({
                icon: "error",
                title: "Selecciona una fila"
            });
        }
    });
});

