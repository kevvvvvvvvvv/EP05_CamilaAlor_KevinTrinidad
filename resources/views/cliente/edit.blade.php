@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición cliente')

@section('main')
    <div class="container mt-5">
        <div class="row title">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                <h1 style="text-align: center;">Editar información</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>

        <hr>

        <div class="formulario">
            <form action="{{route('cliente.update',$cliente->idcli)}}" method="post">

                @csrf
                @method('put')

                <div class="row datos-personales">
                    <div class="col-sm-1 col-md-2"></div>
                    
                    <div class="col-sm-4 col-md-2">
                        <h6>Datos personales</h6>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label>Nombre:</label>
                        <br>
                        <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">
                        <br>
                        @error('nombre')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Apellido paterno:</label>
                        <br>
                        <input type="text" name="ap" value="{{ old('ap', $cliente->ap) }}">
                        <br>
                        @error('ap')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Apellido materno:</label>
                        <br>
                        <input type="text" name="am" value="{{ old('am', $cliente->am) }}">
                        <br>
                        @error('am')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <div class="contenedor">
                            <label>Fecha de nacimiento:</label>
                            <br>
                            <input type="date" name="fenac" value="{{ old('fenac', $cliente->fenac) }}">
                        </div>
                        <br>
                        @error('fenac')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <div class="contenedor">
                            <label>Género:</label>
                            <select type="text" name="genero">
                                <option value="Femenino" {{old('genero', $cliente->genero) == 'Femenino' ? 'selected' : ''}} >Femenino</option>
                                <option value="Masculino" {{old('genero', $cliente->genero) == 'Masculino' ? 'selected' : ''}} >Masculino</option>
                                <option value="Otro" {{old('genero', $cliente->genero) == 'Otro' ? 'selected' : ''}} >Otro</option>
                            </select>
                        </div>
                        <br>
                        @error('genero')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>
                        
                        <div class="contenedor">
                            <label>Imagen de perfil (URL):</label>
                            <input type="text" name="profile_image" value="{{old('profile_image',$cliente->profile_image)}}">
                        </div>
                        <br>
                        <br>
                    </div>

                    <div class="col-sm-1 col-md-2"></div>
                </div>

                <hr>

                <div class="row datos-contacto">
                    <div class="col-sm-1 col-md-2"></div>

                    <div class="col-sm-4 col-md-2">
                        <h6>Información de contacto</h6>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label>Dirección:</label>
                        <br>
                        <input type="text" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                        <br>
                        @error('direccion')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Teléfono:</label>
                        <br>
                        <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                        <br>
                        @error('telefono')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Email:</label>
                        <br>
                        <input type="text" name="email" value="{{ old('email', $cliente->email) }}">
                        <br>
                        @error('email')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Contraseña:</label>
                        <br>
                        <input type="password" name="contrasena" value="">
                        <br>
                        @error('contrasena')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>
                    </div>

                    <div class="col-sm-1 col-md-2"></div>
                </div>

                <br>
                <br>
                <br>

                <div class="d-flex flex-sm-row flex-column gap-5 mb-5 justify-content-center">
                    <button type="submit" class="btn-enviar">Enviar</button>
                    <button type="button" class="btn-regresar" onclick="window.history.back();">Regresar</button>
                </div>
            </form>
        </div>
    </div>
@endsection