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
            <form method="POST" action="{{ route('registar_usuario') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nombre de usuario -->
                        <div class="mb-4 form-outline">
                            <label class="form-label" for="nombre">Nombre de Usuario</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" />
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <!-- Email  -->
                        <div class="mb-4 form-outline">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <!-- Contraseña -->
                        <div class="mb-4 form-outline">
                            <label class="form-label" for="passwd1">Contraseña</label>
                            <input type="password" id="passwd1" name="passwd1" class="form-control" value="{{ old('passwd1') }}" />
                            @error('passwd1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <!-- Repetir Contraseña -->
                        <div class="mb-4 form-outline">
                            <label class="form-label" for="passwd2">Repita la Contraseña</label>
                            <input type="password" id="passwd2" name="passwd2" class="form-control" value="{{ old('passwd2') }}" />
                            @error('passwd2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4 form-outline">
                        <label for="rol">Rol: </label>
                        <select id ="rol" name="rol" class="form-select" aria-label="Default select example">
                            <option value="1" {{ old('rol') == '1' ? 'selected' : '' }}>Semillerista</option>
                            <option value="2" {{ old('rol') == '2' ? 'selected' : '' }}>Coordinador</option>
                            <option value="3" {{ old('rol') == '3' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('rol')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Registrar</button>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop