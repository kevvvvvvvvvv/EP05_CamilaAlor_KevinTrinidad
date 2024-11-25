@extends('layaout.stencil')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Rethink+Sans:ital,wght@0,400..800;1,400..800&family=Vibur&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ request()->getHost() === 'localhost' ? asset('css/pasteles.css') : secure_asset('css/pasteles.css') }}">
@endsection


@section('title', 'Nuestros pasteles')

@section('main')

    <div class="titulo mb-5">
        <h2 class="text-center">Nuestros Pasteles</h2>
    </div>

    <div class="container mt-4"> 
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-img-wrapper position-relative overflow-hidden">
                            <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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