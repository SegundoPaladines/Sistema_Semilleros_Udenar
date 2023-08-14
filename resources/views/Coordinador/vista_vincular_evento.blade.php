@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')

<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
            <h1>Listado de Eventos</h1>
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

    <br>
        <table id="buscador-agregar">
            <tr>
                <td>
                    <div id="contenedor-buscador" class="input-group">
                        <div id="inp">
                            <input id ="buscador" type="text" placeholder="Buscar Eventos">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
                @can('director.administracion')
                <td>
                    <div id="btn-agregar">
                        <a href="{{route('vista_reg_eventos')}}" class="btn btn-success">Añadir eventos</a>
                    </div>
                </td>
                @endcan
            </tr>
        </table>    
    </center>

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
                    <th scope="col">Opciones</th>
                    @can('director-coordinador.eventos')
                    <th scope="col">Opciones</th>
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
                        <td>
                            <center>
                            <a style="margin: 3px;" href="{{route('vincular_proyecto_evento', ['codigo_evento' => $e->codigo_evento, 'id_proyecto' => $id_proyecto])}}" class="btn btn-primary btn-sm">Vincular</a>
                            <a style="margin: 3px;" href="{{route('desvincular_proy_evento', ['codigo_evento' => $e->codigo_evento, 'id_proyecto' => $id_proyecto])}}" class="btn btn-danger btn-sm">Desvincular</a>
                            @can('director.administracion')
                            <a style="margin: 3px;" href="{{route('edit_eventos', $e->codigo_evento)}}" class="btn btn-primary btn-sm">Editar</a>
                            <a style="margin: 3px;" href="{{route('eliminar_evento', $e->codigo_evento)}}" class="btn btn-danger btn-sm">Eliminar</a>
                            @endcan
                            </center>
                        </td>
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

    @if (session('vinculacionExitosa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha vinculado el proyecto al evento de forma correcta!","Vinculacion Exitosa", true);
            });
        </script>
    @endif

    @if (session('vinculacionDenegada'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("No se pudo vincular al proyecto porque ya está vinculado al evento.","Vinculación Denegada", false);
            });
        </script>
    @endif

    @if (session('desvinculacionExitosa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("El proyecto ha sido desvinculado del evento.","Vinculación Denegada", true);
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