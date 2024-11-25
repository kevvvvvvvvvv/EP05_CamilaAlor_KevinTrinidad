
<style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        margin: 60px;
        color: black;
        font-weight: bold
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .fecha {
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* Estilo de la tabla */
    .tabla table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tabla th, .tabla td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    .tabla th {
        background-color: #d4b398;
        font-weight: bold;
    }
</style>


    <h3 class="title">Reporte de productos próximos a caducar</h3>

    <section class="fecha">
        <p>{{ $hoyN }}</p>
    </section>

    <section class="tabla">
        <table> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Fecha de ingreso</th>
                    <th>Fecha de caducidad</th>
                    <th>Días que faltan para que caduque</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($caducados as $caducado)
                    <tr>
                        <td>{{ $caducado['idalm'] }}</td>
                        <td>{{ $caducado['nombre'] }}</td>
                        <td>{{ $caducado['categoria'] }}</td>
                        <td>{{ $caducado['fechaIng'] }}</td>
                        <td>{{ $caducado['fechaCad'] }}</td>
                        <td>{{ $caducado['dias'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    

