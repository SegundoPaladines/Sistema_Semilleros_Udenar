@extends('adminlte::page')

@section('title', 'Registrar Evento')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
        <h1>Registrar Evento</h1>
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

        <form class="row g-3 needs-validation" novalidate method="POST" action="" action="{{ route('registrar_evento') }}">
            @csrf

            <!-- Id del Evento -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="number" id="codigo_evento" name="codigo_evento" class="form-control is-valid"/>
                    <label class="form-label" for="codigo_evento">Id del Evento</label>
                </div>
                @error('codigo_evento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <!-- Nombre del Evento -->
            <div class="col-md-8">
                <div class="form-outline">
                <input type="text" id="nombre" name="nombre" class="form-control is-valid"/>
                <label class="form-label" for="nombre">Nombre del Evento</label>
                </div>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha inicio -->
            <div class="col-md-6">
                <label class="form-label" for="fecha_inicio" id="lb">Fecha de Inicio</label>
                <input class="form-control is-valid" type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de inicio">
                @error('fecha_inicio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de finalización -->
            <div class="col-md-6">
                <label class="form-label" for="fecha_fin" id="lb">Fecha de Finalización</label>
                <input class="form-control is-valid" type="date" id="fecha_fin" name="fecha_fin" placeholder="Fecha de fin">
                @error('fecha_fin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Dirección -->
            <div class="col-md-12">
                <div class="form-outline">
                    <input type="text" id="lugar" name="lugar" class="form-control is-valid"/>
                    <label class="form-label" for="lugar">Lugar</label>
                </div>
                @error('lugar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- tipo de evento -->
            <div class="col-md-4">
                <label class="form-label" for="tipo_proyecto" id="lb">Tipo de evento: </label>
                <select id ="tipo" name="tipo" class="form-select is-valid">
                        <!-- <option selected>Tipo</option> -->
                        <option value="1">Congreso</option>
                        <option value="2">Encuentro</option>
                        <option value="3">Seminario</option>
                        <option value="4">Taller</option>
                    </select>
                @error('tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- modalidad -->
            <div class="col-md-4">
                <label class="form-label" for="tipo_proyecto" id="lb">Modalidad del evento: </label>
                <select id ="modalidad" name="modalidad" class="form-select is-valid">
                    <!-- <option selected>Modalidad</option> -->
                    <option value="1">Virtual</option>
                    <option value="2">Presencial</option>
                    <option value="3">Hibrida</option>
                </select>
                @error('modalidad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- clasificación -->
            <div class="col-md-4">
                <label class="form-label" for="tipo_proyecto" id="lb">Clasificación del evento: </label>
                <select id ="clasificacion" name="clasificacion" class="form-select is-valid">
                    <!-- <option selected>Clasificación</option> -->
                    <option value="1">Local</option>
                    <option value="2">Regional</option>
                    <option value="3">Nacional</option>
                </select>
                @error('clasificacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="col-md-6">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="descripcion" name="descripcion" rows="3"></textarea>
                    <label class="form-label" for="descripcion">Descripción</label>
                </div>
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Observaciones -->
            <div class="col-md-6">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="observaciones" name="observaciones" rows="3"></textarea>
                    <label class="form-label" for="observaciones">Observaciones</label>
                </div>
                @error('observaciones')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Boton Enviar -->
            <button type="submit" class="mb-3 btn btn-success btn-block">Agregar Evento</button>
        </form>
    </div>
    </center>
</div>

    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha registrado el evento!","", true);
            });
        </script>
    @endif
    @if (session('registroNoExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡No se ha registrado el evento, el ID ingresado ya existe","", false);
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
    <script src="{{ asset('js/david/alerta_exito.js') }}"></script>
@stop