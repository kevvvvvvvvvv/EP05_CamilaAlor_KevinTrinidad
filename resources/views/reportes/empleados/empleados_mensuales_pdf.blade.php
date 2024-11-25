
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

    /* Estilo de la sección de empleado */
    .empleados {
        text-align: center;
        margin-bottom: 30px;
        border: 1.5px solid black;
        border-radius: 1rem;
    }

    .empleados .elemento {
        vertical-align: top;
        padding: 10px;
        margin: 0;
    }
</style>


    <h3 class="title">Reporte mensual de empleado del mes</h3>

    <section class="fecha">
        <p>{{ $nombreMes }} del {{ $year }}</p>
    </section>

    <section class="empleados">
        <div class="elemento">  
            <p>Empleado del mes</p>
            <h3>{{ $empMasVentas }}</h3>
            <p>Cantidad de productos vendidos: {{ $empMasCant }}</p>
        </div>      
    </section>

    <h3>Gráfico de Empleados</h3>
    <img src="{{ public_path('temp/grafico_mensual.png') }}" alt="Gráfico de empleados" style="width: 1000px; height: 480px;">


    

