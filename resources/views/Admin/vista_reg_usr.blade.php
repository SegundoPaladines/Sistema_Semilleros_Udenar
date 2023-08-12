@extends('adminlte::page')

@section('title', 'Registrar Usuarios')

@section('content_header')
<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
            <h1>Registar Usuario</h1>
        </figure>
    </div>
</div>
@stop

@section('content')
<div class="container">
    <center>
        <br>
        <ul class="list-unstyled">
        <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Bienvenido {{ $user->name }}</li>
        </ul>  
        <br>
        <div id="contenedor-form">
            <form class="row g-3 needs-validation" novalidate id="form" name="form" method="POST" action="{{ route('registar_usuario') }}">
                @csrf
                <!-- Nombre de usuario -->
                <div class="col-md-6">
                    <div class="form-outline">
                        <input type="text" id="nombre" name="nombre" class="form-control is-valid" value="{{ old('nombre') }}" required />
                        <label for="nombre" class="form-label">Nombre de Usuario</label>
                        <div id="nombre-e" name="nombre-e" class="invalid-feedback">*</div>
                        @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Email  -->
                <div class="col-md-6">
                    <div class="form-outline">
                        <input type="email" id="email" name="email" class="form-control is-valid" value="{{ old('email') }}" required />
                        <label for="email" class="form-label">Email</label>
                        <div id="email-e" name="email-e" class="invalid-feedback">*</div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Contraseña -->
                <div class="col-md-6">
                    <div class="form-outline">
                        <input type="password" id="passwd1" name="passwd1" class="form-control is-valid" value="{{ old('passwd1') }}"  required />
                        <label for="passwd1" class="form-label">Contraseña</label>
                        <div id="passwd1-e" name="passwd1-e" class="invalid-feedback">*</div>
                        @error('passwd1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Repetir Contraseña -->
                <div class="col-md-6">
                    <div class="form-outline">
                        <input type="password" id="passwd2" name="passwd2" class="form-control is-valid" value="{{ old('passwd2') }}" required />
                        <label for="passwd2" class="form-label">Repita la Contraseña</label>
                        <div id="passwd2-e" name="passwd2-e" class="invalid-feedback">*</div>
                        @error('passwd2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Seleccionar rol -->
                <div class="col-md-12">
                    <div class="form-outline">
                        <label for="rol" class="form-label" id="rolb">Rol: </label>
                        <select id ="rol" name="rol" class="form-select is-valid" aria-label="Default select example">
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