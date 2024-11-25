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
    <link rel="stylesheet" href="{{asset('css/signup/signup.css') }}">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row align-items-center justify-content-center">
                <div class="column col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 ">
                    <form action="{{route('validar-registro')}}" method="post">
                        <h1 class="text-center">Introduce tu información</h1><br>
                        @csrf

                        <div>
                            <label>Email</label><br>
                            <input type="text" name="email" placeholder="ejemplo@gmail.com" value="{{old('email')}}">
                        </div>
                        
                        <br>
                        
                        <div>
                            <label>Contraseña</label><br>
                            <input type="password" name="contrasena" placeholder="Escribe tu contraseña aquí" value="{{old('contrasena')}}">
                        </div>
                        
                        <br>
                        
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="send">Enviar</button>
                        </div>

                        <br>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form> 
                </div>
                <div class="column col-sm-12 col-md-6 col-lg-6 col-xxl-6 message d-flex align-items-center justify-content-center">
                    <div class="text-center introduction">
                        <h1>¡Hola!</h1>
                        <p>Registrate para acceder a más funcionalidades</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>