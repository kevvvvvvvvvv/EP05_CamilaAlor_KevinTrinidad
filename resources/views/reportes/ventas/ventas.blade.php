@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/reportes/reportes.css') : secure_asset('css/reportes/reportes.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','Reporte de ventas')

@section('main')
        <!-- Botones -->
        <div class="botones mt-5">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Diario</label>
            
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Semanal</label>
            
                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio3">Mensual</label>
            </div>
        </div>

        <!-- Formularios -->
        <div id="formulario1" class="formulario">
            <h3>Reportes</h3>
            <br>
            <form action="{{route('ventas.generar')}}" method="post">
                @csrf
                <input type="hidden" name="formulario" value="formulario1"> 
                <div class="mb-3">
                    <label for="input1">Fecha: </label>
                    <input type="date" name="fecha" id="input1">
                </div>
                @error('fecha')
                    <span>*{{ $message }}</span>
                @enderror
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Generar reporte</button>
            </form>
        </div>

        <div id="formulario2" class="formulario">
            <h3>Reportes</h3>
            <br>
            <form action="{{route('ventas.generar')}}" method="post">
                @csrf
                <input type="hidden" name="formulario" value="formulario2"> 
                <div class="mb-3">
                    <label for="input2">Fecha de inicio de semana: </label>
                    <input type="date" name="fecha" id="input2">
                </div>
                @error('fecha')
                    <span>*{{ $message }}</span>
                @enderror
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Generar reporte</button>
            </form>
        </div>

        <div id="formulario3" class="formulario">
            <h3>Reportes</h3>
            <br>
            <form action="{{route('ventas.generar')}}" method="post">
                @csrf
                <input type="hidden" name="formulario" value="formulario3"> 
                <div class="mb-3">
                    <label for="input3">Mes:</label>
                    <select id="input3" name="mes">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Generar reporte</button>
            </form>
        </div>

        <button type="button" class="btn btn-primary btn-regresar" onclick="window.location.href='{{ route('reportes.dashboard') }}'">Regresar</button>
        
        <!-- Mostrar Resultados -->
        <section class="resultados">
            @if (session('reporte') == 'formulario1') 
                
                <h3 class="title">Reporte diario de ventas</h3>    

                <section class="fecha">
                    <p>{{ session('fechaN') }}</p>
                </section>
                
                <section class="text-center ganacias">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias pastelería</p>
                            <h3>${{ session('totalPP')[0]->totalPas }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias cafetería</p>
                            <h3>${{ session('totalPC')[0]->totalCaf }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias totales</p>
                            <h3>${{ session('total') }}</h3>
                        </div>
                    </div>
                </section>

                <section class="tabla table-responsive">
                    <table id="ventasTable" class="table table-striped table-bordered tabla-custom"> 
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad vendida</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( session('ventas') as $venta )
                            <tr>
                                <td>{{ $venta->nombre }}</td>
                                <td>{{ $venta->cantidad }}</td>
                                <td>${{ $venta->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                <!-- Datos para el PDF -->
                <section class="datos-pdf">
                    <form action="{{ route('reportes.ventasdiarias.pdf') }}" method="GET">
                        @csrf
                        <input type="hidden" name="fechaN" value="{{ session('fechaN') }}">
                        <input type="hidden" name="totalPP" value="{{ session('totalPP')[0]->totalPas }}">
                        <input type="hidden" name="totalPC" value="{{ session('totalPC')[0]->totalCaf }}">
                        <input type="hidden" name="total" value="{{ session('total') }}">
                        <input type="hidden" name="ventas" value="{{ json_encode(session('ventas')) }}">
                        
                        <button type="submit" class="btn btn-primary">Descargar en PDF</button>
                    </form>
                </section>
            @endif 

            
            @if (session('reporte') == 'formulario2')
                
                <h3 class="title">Reporte semanal de ventas</h3>

                <section class="fecha">
                    <p>{{ session('fechaInicioN') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ session('fechaFinN') }}</p>
                </section>

                <section class="text-center ganacias">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias pastelería</p>
                            <h3>${{ session('totalPP')[0]->totalPas }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias cafetería</p>
                            <h3>${{ session('totalPC')[0]->totalCaf }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias totales</p>
                            <h3>${{ session('total') }}</h3>
                        </div>
                    </div>
                </section>

                <!-- Gráfica -->
                <section class="grafica">
                    <script>
                        var jsonData = {!! session('jsonData') !!};
                        console.log(jsonData);
                    </script>
                    <div id="graficoVentasSem"></div>
                </section>

                <!-- Datos para el PDF -->
                <section class="datos-pdf">
                    <form id="formExportar" action="{{ route('reportes.ventassemanales.pdf') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="fechaInicioN" value="{{ session('fechaInicioN') }}">
                        <input type="hidden" name="fechaFinN" value="{{ session('fechaFinN') }}">
                        <input type="hidden" name="totalPP" value="{{ session('totalPP')[0]->totalPas }}">
                        <input type="hidden" name="totalPC" value="{{ session('totalPC')[0]->totalCaf }}">
                        <input type="hidden" name="total" value="{{ session('total') }}">
                        <input type="hidden" name="graficoImagenSem" id="graficoImagenSem">
                
                        <button id="exportarGraficoSem" type="button" class="btn btn-primary">Descargar en PDF</button>
                    </form>
                </section>
            @endif

            @if (session('reporte') == 'formulario3')
                <h3 class="title">Reporte mensual de ventas</h3>
                
                <section class="fecha">
                    <p>{{ session('nombreMes') }} del {{ session('year') }}</p>
                </section>

                <section class="text-center ganacias">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias pastelería</p>
                            <h3>${{ session('totalPP')[0]->totalPas }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias cafetería</p>
                            <h3>${{ session('totalPC')[0]->totalCaf }}</h3>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <p>Ganancias totales</p>
                            <h3>${{ session('total') }}</h3>
                        </div>
                    </div>
                </section>

                <!-- Gráfica -->
                <section class="grafica">
                    <script>
                        var jsonDataMen = {!! session('jsonDataMen') !!};
                        console.log(jsonDataMen);
                    </script>
                    <div id="graficoVentasMen"></div>
                </section>

                <!-- Datos para el PDF -->
                <section class="datos-pdf">
                    <form id="formMensual" action="{{ route('reportes.ventasmensuales.pdf') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="nombreMes" value="{{ session('nombreMes') }}">
                        <input type="hidden" name="year" value="{{ session('year') }}">
                        <input type="hidden" name="totalPP" value="{{ session('totalPP')[0]->totalPas }}">
                        <input type="hidden" name="totalPC" value="{{ session('totalPC')[0]->totalCaf }}">
                        <input type="hidden" name="total" value="{{ session('total') }}">
                        <input type="hidden" name="graficoImagenMen" id="graficoImagenMen">

                        <button id="exportarGraficoMen" class="btn btn-primary">Descargar en PDF</button>
                    </form>
                </section>
            @endif

        </section>
    
    {{-- Constantes para el manejo de rutas de los métodos post --}}
    <script>
        const ventasmensualesUrl ="{{route('reportes.ventasmensuales.pdf')}}"
        const ventassemanalesUrl = "{{ route('reportes.ventassemanales.pdf') }}";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/canvg@2.0.0/dist/browser/canvg.min.js"></script>

    <!-- Cargar jQuery antes de DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cargar DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Cargar Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>    
    

    <!-- Script de ventas -->
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/reportes/ventas/ventas.js') : secure_asset('js/reportes/ventas/ventas.js') }}"></script>
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/reportes/ventas/ventasSem.js') : secure_asset('js/reportes/ventas/ventasSem.js') }}" defer></script>
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/reportes/ventas/ventasMen.js') : secure_asset('js/reportes/ventas/ventasMen.js') }}" defer></script>

@endsection


