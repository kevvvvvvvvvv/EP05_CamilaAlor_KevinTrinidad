
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

    /* Estilo de la sección de ganancias */
    .ganancias {
        text-align: center;
        margin-bottom: 30px;
        border: 1.5px solid black;
        border-radius: 1rem;
    }

    .ganancias .elemento {
        display: inline-block;
        width: 30%;
        vertical-align: top;
        padding: 10px;
        margin: 0;
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


    <h3 class="title">Reporte diario de ventas</h3>

    <section class="fecha">
        <p>{{ $fechaN }}</p>
    </section>

    <section class="ganancias">
        <div class="elemento">  
            <p>Ganancias pastelería</p>
            <h3>${{ $totalPP }}</h3>
        </div>      
        
        <div class="elemento">  
            <p>Ganancias cafetería</p>
            <h3>${{ $totalPC }}</h3>
        </div>  
        
        <div class="elemento">  
            <p>Ganancias totales</p>
            <h3>${{ $total }}</h3>
        </div>  
    </section>

    <section class="tabla">
        <table> 
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad vendida</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $ventas as $venta )
                <tr>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>${{ $venta->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

