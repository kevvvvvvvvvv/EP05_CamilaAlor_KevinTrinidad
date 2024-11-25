@extends('layaout.stencil')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Rethink+Sans:ital,wght@0,400..800;1,400..800&family=Vibur&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/personalizados.css') : secure_asset('css/personalizados.css') }}">
@endsection


@section('title', 'Nuestros pasteles personalizados')

@section('main')
    <header>
        <div class="titulo row d-flex align-items-center justify-content-center mb-5">
            <div class="col-6 text-center">
                <h2>¡Personaliza tu pastel!</h2>
            </div>
            <div class="col-6 text-center">
                <img src="img/pastel_macar.png" alt="Pastel" class="img-fluid">
            </div>
        </div>
    </header>

    <section>
        <div class="caracteristicas row d-flex align-items-center justify-content-center mb-5">
            <div class="caracteristica col-sm-12 col-md-4">
                <a href="{{ route('principal.pasteles') }}"><i class="bi bi-cake2"></i></a>
                <p>
                    Nuestros pasteles están disponibles a partir de <strong>3 kg en adelante</strong>. Haz clic en el ícono para descubrir todos los sabores que puedes elegir.
                </p>
            </div>
            <div class="caracteristica col-sm-12 col-md-4">
                <i class="bi bi-calendar-event"></i>
                <p>Personaliza tu pedido y elige la <strong>fecha de entrega</strong> que mejor se ajuste a tu evento.</p>
            </div>
            <div class="caracteristica col-sm-12 col-md-4">
                <i class="bi bi-brush"></i>
                <p>Explora una amplia gama de <strong>diseños y temas personalizados</strong> para hacer tu pastel único.</p>
            </div>
        </div>
    </section>

    <section class="disenos">
        <h3>¡Mira nuestros diseños!</h3>

        <div class="pasteles row">
            <div class="pastel col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-img-wrapper position-relative overflow-hidden">
                        <img src="img/pastel_boda.png" class="card-img-top" alt="Pastel de Bodas">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pastel de Boda Elegante</h5>
                        <p class="card-text">
                            Crea un ambiente romántico y sofisticado en tu boda con un pastel
                            diseñado a la perfección, reflejando tu estilo único.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pastel col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-img-wrapper position-relative overflow-hidden">
                        <img src="img/pastel_cumple.png" class="card-img-top" alt="Pastel de Cumpleaños">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pastel de Cumpleaños</h5>
                        <p class="card-text">
                            Celebra a esa persona especial con un pastel único, perfecto 
                            para regalar en su día, lleno de sabor y alegría.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pastel col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-img-wrapper position-relative overflow-hidden">
                        <img src="img/pastel_infantil.png" class="card-img-top" alt="Pastel infantil">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pastel Infantil Mágico</h5>
                        <p class="card-text">
                            Sorprende a los más pequeños con un pastel temático, inspirado en 
                            sus personajes y colores favoritos para un cumpleaños único.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="registrate">
        <div class="curva">
            <h3>¿Quieres probar nuestros pasteles?</h3>
            <img src="img/pasteles.png" alt="Nuestros Pasteles">
            <a href="{{ route('login') }}">¡Ingresa ya!</a>
        </div>
    </section>
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