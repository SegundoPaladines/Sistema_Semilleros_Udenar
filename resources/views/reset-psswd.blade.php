@extends('adminlte::page')

@section('title', 'Cambiar Contraseña')

@section('content_header')
<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
            <h1>Cambiar Contraseña</h1>
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
        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('cambio-contrasena') }}">
            @csrf
            <!-- Contraseña Actual-->
            <div class="col-md-12">
                <div class="form-outline">
                    <input type="password" id="passwd1" name="passwd1" class="form-control is-valid" placeholder="Escriba la contraseña actual" required />
                    <label for="passwd1" class="form-label">Contraseña Actual</label>
                    <div id="passwd1-e" name="passwd1-e" class="invalid-feedback">*</div>
                </div>
                @error('passwd1')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Nueva Contraseña -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type="password" id="passwd2" name="passwd2" class="form-control is-valid" placeholder="Escriba la nueva contraseña" required />
                    <label for="passwd2" class="form-label">Nueva Contraseña</label>
                    <div id="passwd2-e" name="passwd2-e" class="invalid-feedback">*</div>
                </div>
                @error('passwd2')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Repetición Nueva Contraseña -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type="password" id="passwd3" name="passwd3" class="form-control is-valid" placeholder="Repita la nueva contraseña" required />
                    <label for="passwd3" class="form-label">Repita la Nueva Contraseña</label>
                    <div id="passwd3-e" name="passwd3-e" class="invalid-feedback">*</div>
                </div>
                @error('passwd3')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Boton Guardar Cambios -->
            <button type="submit" id="btn-submit" class="mb-3 btn btn-success btn-block">Guardar Cambios</button>
        </form>
    </div>
    </center>
    @if (session('cambioExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("La contraseña se actualizó correctamente", "Contraseña Actualizada", true);
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
                    <button widht="60%" type="button" id="btnCerrarModal" class="btn">Home</button>
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
    <link rel="stylesheet" href="{{asset('css/segundo/ress-passwd.css')}}">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/ress-passwd.js') }}"></script>
@stop