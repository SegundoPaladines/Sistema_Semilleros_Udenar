@extends('adminlte::page')

@section('title', 'Agregar proyecto')

@section('content_header')

<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
        <h1>Agregar proyecto</h1>
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

        <form  class="row g-3 needs-validation" novalidate method="POST" action=""  enctype="multipart/form-data" action="{{ route('agregar_proyecto') }}">
            @csrf

            <!-- Id del proyecto -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type="number" id="id_proyecto" name="id_proyecto" class="form-control is-valid"/>
                    <label class="form-label" for="id_proyecto">Id del Proyecto</label>
                </div>
                @error('id_proyecto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Id del semillero -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type="text" id="semillero" name="semillero" class="form-control is-valid" value="{{$coordinador->semillero}}" readonly/>
                    <label class="form-label" for="semillero">Id del Semillero</label>
                </div>
                @error('semillero')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Titulo-->
            <div class="col-md-12">
                <div class="form-outline">
                    <input type="text" id="titulo" name="titulo" class="form-control is-valid"/>
                    <label class="form-label" for="titulo">Titulo</label>
                </div>
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Opciones tipo de proyecto -->
            <div class="col-md-6">
            <label class="form-label" for="tipo_proyecto" id="lb">Tipo de proyecto: </label>
                <select id ="tipo_proyecto" name="tipo_proyecto" class="form-select is-valid">
                    <!-- <option selected>Tipo</option> -->
                    <option value="1">Investigación</option>
                    <option value="2">Innovación y Desarrollo</option>
                    <option value="3">Emprendimiento</option>
                </select>
                @error('tipo_proyecto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Opciones estado -->
            <div class="col-md-6">
            <label class="form-label" for="estado" id="lb">Estado del proyecto: </label>
                <select id ="estado" name="estado" class="form-select is-valid">
                    <!-- <option selected>Estado</option> -->
                    <option value="1">Propuesta</option>
                    <option value="2">En curso</option>
                    <option value="3">Finalizado</option>
                    <option value="4">Inactivo</option>
                </select>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha inicio -->
            <div class="col-md-6">
                <label class="form-label" for="feacha_inicio" id="lb">Fecha de Inicio</label>
                <input class="form-control is-valid" type="date" id="feacha_inicio" name="feacha_inicio" placeholder="Fecha de inicio">
                @error('feacha_inicio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de finalización -->
            <div class="col-md-6">
                <label class="form-label" for="feacha_fin" id="lb">Fecha de Finalización</label>
                <input class="form-control is-valid" type="date" id="feacha_fin" name="feacha_fin" placeholder="Fecha de fin">
                @error('feacha_fin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Propuesta -->
            <div class="col-md-6">
                <label class="form-label" for="arc_propuesta" id="lb">Propuesta</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="arc_propuesta" name="arc_propuesta" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx" placeholder="Cargar Propuesta"/>
                </div>
                @error('arc_propuesta')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Proyecto Final -->
            <div class="col-md-6">
                <label class="form-label" for="arc_adjunto" id="lb">Proyecto Final</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="arc_adjunto" name="arc_adjunto" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx" placeholder="Cargar Propuesta"/>
                </div>
                @error('arc_adjunto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <br>
            <!-- Boton Enviar -->
            <button type="submit" class="mb-3 btn btn-success btn-block">Agregar proyecto</button>
        </form>
    </div>

    </center>

</div>

    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha agregado el proyecto!","", true);
            });
        </script>
    @endif
    @if (session('registroNoExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡No se ha agregado el proyecto, el ID ingresado ya existe!","", false);
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
    <!-- JQery -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS Propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/perfil.css')}}">
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/juan/alert.js') }}"></script>
@stop