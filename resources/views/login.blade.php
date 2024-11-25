<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/login/login.css') : secure_asset('css/login/login.css') }}">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row align-items-center justify-content-center d-flex">
                <div class="column col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 ">
                    <form action="{{route('validar-sesion')}}" method="post" id="loginForm" class="d-flex flex-column align-items-center">
                        <h1 class="text-center">Inicio de sesión</h1><br>
                        @csrf
                        <div>
                            <label>Email</label><br>
                            <input type="text" name="email" id="email" placeholder="ejemplo@gmail.com">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div>
                            <label>Contraseña</label><br>
                            <input type="password" name="contrasena" id="contra" placeholder="Escribe tu contraseña aquí">
                            @error('contrasena')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="send">Enviar</button>
                        </div><br>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="sign-up">¿No tienes cuenta? <a href="{{route('signup')}}">Regístrate</a></p>
                        </div>
                        <hr>
                        <!-- Mostrar errores -->
                        @if ($errors->has('usuario'))
                            <span class="error">{{ $errors->first('usuario') }}</span>
                        @endif
                        <div class="d-flex align-items-center justify-content-center" >
                            <div class="google d-flex align-items-center justify-content-center">
                                <a href="{{route('login-google')}}"><i class="bi bi-google"></i>Inicia sesión con Google</a>
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="column col-sm-12 col-md-6 col-lg-6 col-xxl-6 message d-flex align-items-center justify-content-center">
                    <div class="text-center introduction">
                        <h1>¡Hola de nuevo!</h1>
                        <p>Inicia sesión para acceder a más funcionalidades</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ request()->getHost() === 'localhost' ? asset('js/login/login.js') : secure_asset('js/login/login.js') }}"></script>
</body>
</html>

