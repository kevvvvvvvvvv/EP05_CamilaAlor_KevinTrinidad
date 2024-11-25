@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Edición empleado')

@section('main')
    <div class="container mt-5">
        <div class="row title">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                <h1 style="text-align: center;">Editar información de empleado</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>

        <hr>
        
        <div class="formulario">
            <form action="{{route('empleado.update',$empleado->ide)}}" method="post">

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
                        <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre) }}">
                        <br>
                        @error('nombre')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Apellido paterno:</label>
                        <br>
                        <input type="text" name="ap" value="{{ old('ap', $empleado->ap) }}">
                        <br>
                        @error('ap')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Apellido materno:</label>
                        <br>
                        <input type="text" name="am" value="{{ old('am', $empleado->am) }}">
                        <br>
                        @error('am')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <div class="contenedor">
                            <label>Fecha de nacimiento:</label>
                            <input type="date" name="fenac" value="{{ old('fenac', $empleado->fenac) }}">
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
                                <option value="Femenino" {{old('genero', $empleado->genero) == 'Femenino' ? 'selected' : ''}} >Femenino</option>
                                <option value="Masculino" {{old('genero', $empleado->genero) == 'Masculino' ? 'selected' : ''}} >Masculino</option>
                                <option value="Otro" {{old('genero', $empleado->genero) == 'Otro' ? 'selected' : ''}} >Otro</option>
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
                            <input type="text" name="profile_image" value="{{old('profile_image',$empleado->profile_image)}}">
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
                        <h6>Información de contacto y contraseña</h6>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label>Dirección:</label>
                        <br>
                        <input type="text" name="direccion" value="{{ old('direccion', $empleado->direccion) }}">
                        <br>
                        @error('direccion')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Teléfono:</label>
                        <br>
                        <input type="text" name="telefono" value="{{ old('telefono', $empleado->telefono) }}">
                        <br>
                        @error('telefono')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <label>Email:</label>
                        <br>
                        <input type="text" name="email" value="{{ old('email', $empleado->email) }}">
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

                <hr>

                <div class="row datos-trabajo">
                    <div class="col-sm-1 col-md-2"></div>

                    <div class="col-sm-4 col-md-2">
                        <h6>Información de trabajo</h6>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="contenedor">
                            <label>Fecha de ingreso:</label>
                            <input type="date" name="feIng" value="{{ old('feIng', $empleado->feIng) }}">
                        </div>
                        <br>
                        @error('feIng')
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