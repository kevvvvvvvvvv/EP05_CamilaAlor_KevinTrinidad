@extends('layaout.stencil')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Rethink+Sans:ital,wght@0,400..800;1,400..800&family=Vibur&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/index.css') : secure_asset('css/index.css') }}">
@endsection


@section('title', 'Pastelería Divina Tentación')

@section('main')

    <header>
        <div class="titulo">
            <img class="logo" src="img/logo_negro.png" alt="">
            <br>
            <h1>Pastelería Divina Tentación</h1>
            <br>
            <a href="{{ route('signup') }}"><img src="img/logo_registro.png" alt="registrate"></a>
        </div>

        <div class="carrusel">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/frappeOreo.png') }}" class="d-block mx-auto w-auto" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/frappeCapu.png') }}" class="d-block mx-auto w-auto" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/pastel_rosa.png') }}" class="d-block mx-auto w-auto" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/pastel_mariposa.png') }}" class="d-block mx-auto w-auto" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <p class="descripcion">
                Un pastel para cada ocasión, creado con amor y los mejores ingredientes. 
                <br>
                ¡Haz de cada momento algo especial!
            </p>
        </div>
    </header>
    
    <hr>

    <section>
        <article>
            <div class="container w-75">

                <div class="row pasteles_predisenados">
                    <div class="texto col-xs-12 col-md-6 flex-column d-flex justify-content-center align-items-center">
                        <h2>Prueba nuestros pasteles</h2>
                        <p>Cada pastel está pensado para crear momentos únicos y memorables. 
                            ¿Cuál probarás primero?</p>
                            <a href="{{ route('principal.pasteles') }}" class="text-left">
                                <button>Conocer más</button>
                            </a>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <img src="{{ asset('img/pastel_flan.png') }}" alt="Pastel">
                    </div>
                </div>

                <div class="row pasteles_predisenados">
                    <div class="col-xs-12 col-md-6 order-last order-md-first">
                        <img src="{{ asset('img/pastel_personalizado.png') }}" alt="Pastel personalizado">
                    </div>
                    <div class="texto col-xs-12 col-md-6 flex-column d-flex justify-content-center align-items-center">
                        <h2>Crea el pastel de tu sueños</h2>
                        <p>Tenemos una variedad de sabores y estilos, ¡y puedes personalizar el tuyo para cualquier ocasión especial!</p>
                        <a href="{{ route('principal.personalizados') }}" class="text-left">
                            <button>Conocer más</button>
                        </a>
                    </div>
                </div>

                <div class="row pasteles_predisenados">
                    <div class="texto col-md-6 flex-column d-flex justify-content-center align-items-center">
                        <h2>Productos para cada gusto</h2>
                        <p>Desde sabores clásicos hasta combinaciones únicas, tenemos algo 
                            especial para cada ocasión. Echa un vistazo a nuestras opciones 
                            y encuentra el tuyo.</p>
                        <a href="{{ route('principal.productos') }}" class="text-left">
                            <button>Conocer más</button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('img/fraMoka.png') }}" alt="Frappe">
                    </div>
                </div>
            </div>
        </article>
    </section>

    <hr>
@endsection

@section('footer')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 d-flex flex-column align-items-center justify-content-center">
                <a href="https://wa.me/17775311896" target="_blank">
                    <p>
                        <i class="bi bi-whatsapp"></i>
                        WhatsApp
                    </p>
                </a>
                <br>
                <a href="https://www.facebook.com/profile.php?id=100073295176137&locale=es_LA" target="_blank">
                    <p>
                        <i class="bi bi-facebook"></i>
                        Facebook
                    </p>
                </a>
                <br>
                <a href="https://www.instagram.com/p.divinas_tentaciones/" target="_blank">
                    <p>
                        <i class="bi bi-instagram"></i>
                        Instragram
                    </p>
                </a>   
            </div>
            <div class="col-md-6 col-xl-4 d-flex flex-column align-items-center justify-content-center">
                <a href="https://maps.app.goo.gl/CSM4caJHEHYe8p7N6" target="_blank">
                    <p>
                        <i class="bi bi-geo-alt-fill"></i>
                        C. Tepozteco 18, Vicente Guerrero, 62570 Jiutepec, Mor.
                    </p>
                </a>
            </div>
        </div>
    </div>
@endsection