@extends('layaout.stencil')

@section('head')
    <link rel="stylesheet" href="{{ request()->getHost() === 'localhost' ? asset('css/formularios/formularios.css') : secure_asset('css/formularios/formularios.css') }}">
@endsection

@section('title','Registro empleado')

@section('main')
    <div class="container mt-5">
        <div class="row title">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-sm-10 col-md-8">
                <h1 style="text-align: center;">Registro de un nuevo empleado</h1>
            </div>

            <div class="col-sm-1 col-md-2"></div>
        </div>

        <hr>
        
        <div class="formulario">
            <form action="{{route('empleado.store')}}" method="post">

                @csrf

                <div class="row datos-personales">
                    <div class="col-sm-1 col-md-2"></div>
                    
                    <div class="col-sm-4 col-md-2">
                        <h6>Datos personales</h6>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <input type="text" name="nombre" placeholder="Nombre(s)" value="{{old('nombre')}}">
                        <br>
                        @error('nombre')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <input type="text" name="ap" placeholder="Apellido paterno" value="{{old('ap')}}">
                        <br>
                        @error('ap')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <input type="text" name="am" placeholder="Apellido materno" value="{{old('am')}}">
                        <br>
                        @error('am')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <div class="contenedor">
                            <label>Fecha de nacimiento:</label>
                            <input type="date" name="fenac" value="{{old('fenac')}}">
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
                                <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                            <input type="text" name="profile_image" value="{{old('profile_image')}}">
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
                        <input type="text" name="direccion" placeholder="Dirección" value="{{old('direccion')}}">
                        <br>
                        @error('direccion')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <input type="text" name="telefono" placeholder="Teléfono" value="{{old('telefono')}}">
                        <br>
                        @error('telefono')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <input type="text" name="email" placeholder="Email" value="{{old('email')}}">
                        <br>
                        @error('email')
                            <span>*{{ $message }}</span>
                        @enderror
                        <br>
                        <br>

                        <input type="password" name="contrasena" placeholder="Contraseña" value="{{old('contrasena')}}">
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
                            <input type="date" name="feIng" value="{{old('feIng')}}">
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