@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
        <h1>Listado de Eventos</h1>
        </figure>
    </div>
</div>

@stop

@section('content')
<div class="container">

    <ul class="list-unstyled">
        <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Bienvenido {{ $user->name }}</li>
    </ul>  
    <br>

    <br>
    <!-- Buscador y botón Añadir usuario  -->
    <div id="buscador-agregar" style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
        <div id="contenedor-buscador" class="input-group" style="flex-grow: 2; margin-right: 10px;">
            <div class="col-md-" id="inp">
                <input id="buscador" type="text" placeholder="Buscar Eventos" style="width: 100%;">
            </div>
            <div id="ic">
                <i class="fas fa-search"></i>
            </div>
        </div>
        @can('director.administracion')
        <div class="col-md-3" id="btn-agregar">
            <a href="{{route('vista_reg_eventos')}}" class="btn btn-success">Añadir eventos</a>
        </div>
        @endcan
    </div>

    </center>
    <div class="gap-2 d-grid d-md-flex justify-content-md-center">
        <a class="btn btn-warning btn-rounded" href="{{route('eventos_report')}}" target="_blank">
            <i class="fas fa-download"></i> Generar Reporte
        </a>
    </div>
    <br>
    <div class="tabla-container" style= "overflow-x: auto;">
    <table id= "tabla_eventos" class="table">
        <thead class="table-info">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo Evento</th>
                <th scope="col">Nombre de Evento</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Fecha de Finalización</th>
                <th scope="col">Lugar</th>
                <th scope="col">Tipo</th>
                <th scope="col">Modalidad</th>
                <th scope="col">Clasificación</th>
                @can('director.administracion')<th scope="col">Opciones</th>@endcan
                @can('coordinador.administracion')
                    <th scope="col">Opción</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($eventos as $e)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$e->codigo_evento}}</td>
                    <td>{{$e->nombre}}</td>
                    <td>{{$e->fecha_inicio}}</td>
                    <td>{{$e->fecha_fin}}</td>
                    <td>{{$e->lugar}}</td>
                    <td>{{$tipoOptions[$e->tipo]}}</td>
                    <td>{{$modalidadOptions[$e->modalidad]}}</td>
                    <td>{{$clasificacionOptions[$e->clasificacion]}}</td>
                    @can('coordinador.administracion')
                        <td>
                            <a style="margin: 3px;" href="{{route('vista_proy_vinculado_evento', $e->codigo_evento)}}" class="btn btn-primary btn-sm">Ver Proyectos</a>
                            <a class="btn btn-warning btn-rounded" href="{{route('eventosI_report', $e->codigo_evento)}}" target="_blank"> <i class="fas fa-download"></i> Generar Reporte </a>
                        </td>
                    @endcan
                    @can('director.administracion')
                    <td>
                        <a style="margin: 3px;" href="{{route('vista_proy_vinculado_evento', $e->codigo_evento)}}" class="btn btn-primary btn-sm">Ver Proyectos</a>
                        <a style="margin: 3px;" href="{{route('edit_eventos', $e->codigo_evento)}}" class="btn btn-primary btn-sm">Editar</a>
                        <a style="margin: 3px;" href="{{route('eliminar_evento', $e->codigo_evento)}}" class="btn btn-danger btn-sm">Eliminar</a>
                        <a class="btn btn-warning btn-rounded" href="{{route('eventosI_report', $e->codigo_evento)}}" target="_blank"><i class="fas fa-download"></i> Generar Reporte </a>                   
                    </td>
                    @endcan
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    </div>

    <script>

        //buscador
        document.addEventListener("DOMContentLoaded", function() {
            var filtroBusqueda = document.getElementById("buscador");

            filtroBusqueda.addEventListener("keyup", function() {
                var valorBusqueda = filtroBusqueda.value.toLowerCase();
                var filas = document.querySelectorAll("#tabla_eventos tbody tr");

                filas.forEach(function(fila) {
                    var contenidoFila = fila.textContent.toLowerCase();
                    if (contenidoFila.indexOf(valorBusqueda) !== -1) {
                        fila.style.display = "table-row";
                    } else {
                        fila.style.display = "none";
                    }
                });
            });
        });

    </script>

</div>

    @if (session('preguntarEliminar'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elimina = '{{ request()->query('elimina') }}';
            mostrarModalEliminar(elimina);
        });
    </script>
    @endif

    @if (session('eventoEliminado'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                mostrarAlertaRegistroExitoso("¡Evento: '{{ request()->query('eliminado') }}' eliminado con Éxito!", "Eliminado", true);
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
    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="delete_ext_emergente" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="usuarioEliminarNombre"></p>
                    <p id="usuarioEliminarCorreo"></p>
                    <p>¿Estás seguro de que deseas eliminar este evento?</p>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancerlarEliminarEvento()">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminarEvento()">Eliminar</button>
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
    <!--CSS propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/listarSemilleros.css')}}">
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/david/listarEventos.js') }}"></script>
    <script src="{{ asset('js/david/alerta_exito.js') }}"></script>
@stop