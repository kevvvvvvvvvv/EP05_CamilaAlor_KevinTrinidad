<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jockey+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/layaout/stencil.css') : secure_asset('css/layaout/stencil.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    {{-- Verificar si es un empleado o cliente --}}
    @php
        $empleado = Auth::guard('empleado')->user();
        $cliente = Auth::guard('cliente')->user();
    @endphp  

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img src="{{asset('img/logo_negro.png')}}" alt="Logo pastelería" name="cloud-outline" id="cloud">
                <span>Divina <br>Tentación</span>
            </div>
        </div>

        <nav class="navegacion">
            <ul>
                <div class="contenedor">
                    <a href="{{route('principal')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-house-door-fill"></i>
                            <span>Principal</span> 
                        </button>
                    </a>
                </div>
                @if ($empleado && $empleado->hasRole('administrador'))
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Pedido</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-pedido')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('pedido.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-seam"></i>
                            <span>Almacenaje</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-almacenaje')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('almacenaje.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-cake2"></i>
                            <span>Productos</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-producto')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('producto.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tags-fill"></i>
                            <span>Promociones</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-promocion')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('promocion.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                            <span>Clientes</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-cliente')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('cliente.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-person"></i>
                            <span>Empleados</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-empleado')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('empleado.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-calendar-day"></i>
                            <span>Horario</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-horario')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('horario.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <div class="contenedor">
                    <a href="{{route('consultar-venta')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Venta</span> 
                        </button>
                    </a>
                </div>
                <li>
                    <div class="contenedor">
                        <a href="{{route('reportes.dashboard')}}">
                            <button class="contenedor-secundario" type="button">
                                <i class="bi bi-graph-up-arrow"></i>
                                <span>Reportes</span> 
                            </button>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="contenedor">
                        <a href="{{route('db.dashboard')}}">
                            <button class="contenedor-secundario" type="button">
                                <i class="bi bi-database"></i>
                                <span>Base de datos</span> 
                            </button>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-calendar2-plus"></i>
                            <span>Horarios</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('horario.asign.show')}}">Consultar </a></li>
                            <li><a class="dropdown-item" href="{{route('horario.asign')}}">Asignar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                {{-- Opciones del empleado --}}
                @if ($empleado && $empleado->hasRole('empleado'))
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Pedido</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-pedido')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('pedido.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-seam"></i>
                            <span>Almacenaje</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-almacenaje')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('almacenaje.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                            <span>Clientes</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-cliente')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('cliente.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <div class="contenedor">
                    <a href="{{route('horario.asign.empleado.show')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-calendar2-plus"></i>
                            <span>Horario</span> 
                        </button>
                    </a>
                </div>
                <div class="contenedor">
                    <a href="{{route('consultar-producto')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-cake2"></i>
                            <span>Productos</span> 
                        </button>
                    </a>
                </div>
                <div class="contenedor">
                    <a href="{{route('consultar-promocion')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-tags-fill"></i>
                            <span>Promociones</span> 
                        </button>
                    </a>
                </div>
                <div class="contenedor">
                    <a href="{{route('consultar-venta')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Venta</span> 
                        </button>
                    </a>
                </div>
                @endif
                @if($cliente)
                <div class="contenedor">
                    <a href="{{route('cliente.edit.self')}}">
                        <button class="contenedor-secundario" type="button">
                            <i class="bi bi-person-vcard"></i>
                            <span>Cuenta</span> 
                        </button>
                    </a>
                </div>
                <li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bag-check"></i>
                            <span>Pedidos</span> 
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('consultar-venta.cliente')}}">Consultar</a></li>
                            <li><a class="dropdown-item" href="{{route('pedido.cliente.create')}}">Agregar nuevo</a></li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </nav>

        <div>
            <div class="linea"></div> 
            @if ($empleado || $cliente)
            <div class="logout">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <div class="content d-flex">
                        <button class="align-items-center d-flex w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            <p class="mb-0 w-100">Cerrar sesión</p>
                        </button>
                    </div>
                </form>
            </div>
            <div class="usuario">
                <img src="{{ $empleado ? $empleado->profile_image : $cliente->profile_image }}" alt="Imagen perfil" />
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre">{{ $empleado ? $empleado->nombre : $cliente->alias }}</span>
                        <span class="email">{{ $empleado ? $empleado->email : $cliente->email }}</span>
                    </div>
                </div>
            </div>
            @else
            <div class="login d-flex">
                <a  href="{{route('login')}}"  class="content d-flex" >
                    <div class="align-items-center justify-content-center d-flex w-100">
                        <i class="bi bi-person"></i>
                        <p class="mb-0 w-100">Iniciar sesión</p>
                    </div>
                </a>
            </div>
            @endif
        </div>

    </div>


    <main>
        @yield('main')
    </main>

    <footer>
        @yield('footer')
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/layaout/stencil.js') : secure_asset('js/layaout/stencil.js') }}"></script>

</body>
</html>