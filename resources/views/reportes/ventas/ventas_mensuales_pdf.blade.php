
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
</style>


    <h3 class="title">Reporte mensual de ventas</h3>

    <section class="fecha">
        <p>{{ $nombreMes }} del {{ $year }}</p>
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

    <h3>Gráfico de Ventas</h3>
    <img src="{{ public_path('temp/grafico_mensual.png') }}" alt="Gráfico de ventas" style="width: 1000px; height: 480px;">


    

