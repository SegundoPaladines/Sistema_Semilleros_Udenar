@extends('adminlte::page')

@section('title', 'Registrar Usuarios')

@section('content_header')
    <h1>Registar Usuario</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form  id="form" name="form" method="POST" action="{{ route('registar_usuario') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nombre de usuario -->
                        <div>
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span id="nombre-e" name="nombre-e"class="text-danger"></span>
                            <div class="mb-4 form-outline">
                                <input type="text" id="nombre" name="nombre" class="form-control" required value="{{ old('nombre') }}" />
                                <label class="form-label" for="nombre">Nombre de Usuario</label>
                            </div>
                        </div>
            
                        <!-- Email  -->
                        <div>
                            @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span id="email-e" name="email-e"class="text-danger"></span>
                            <div class="mb-4 form-outline">
                                <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}" />
                                <label class="form-label" for="email">Email</label>
                            </div>
                        </div>
                    </div>
            
                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <div>
                            @error('passwd1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span id="passwd1-e" name="passwd1-e"class="text-danger"></span>
                            <div class="mb-4 form-outline">
                                <input type="password" id="passwd1" name="passwd1" class="form-control" required value="{{ old('passwd1') }}" />
                                <label class="form-label" for="passwd1">Contraseña</label>
                            </div>
                        </div>
            
                        <!-- Repetir Contraseña -->
                        <div>
                            @error('passwd2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span id="passwd2-e" name="passwd2-e" class="text-danger"></span>
                            <div class="mb-4 form-outline">
                                <input type="password" id="passwd2" name="passwd2" class="form-control" required value="{{ old('passwd2') }}" />
                                <label class="form-label" for="passwd2">Repita la Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 form-outline">
                        <label for="rol">Rol: </label>
                        <select id ="rol" name="rol" class="form-select" aria-label="Default select example">
                            <option value="1" {{ old('rol') == '1' ? 'selected' : '' }}>Semillerista</option>
                            <option value="2" {{ old('rol') == '2' ? 'selected' : '' }}>Coordinador</option>
                            <option value="3" {{ old('rol') == '3' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        <span id="rol-e" name="rol-e" class="text-danger">Seleccione una opción.</span>
                        @error('rol')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <!-- Boton Enviar -->
                <button type="submit" id="btn-submit" class="mb-3 btn btn-success btn-block">Registrar</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El registro se ha realizado exitosamente!","Registro Exitoso", true);
            });
        </script>
    @endif
    
    <!-- Modal -->
    <div id="reg_ext_emergente" class="modal fade" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExitoLabel">
                        <h5 id="modal-titulo"></h5>
                    </h5>
                    <button id="cerrar-modal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i id="modal-icono"></i>
                    </div>
                    <p id="modalExitoMensaje" class="mt-3 text-center"></p>
                </div>
                <div class="modal-footer">
                    <button widht="60%" type="button" id="btnCerrarModal" class="btn">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
     

@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS Propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop