@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
        <h1>Listado de Proyectos</h1>
        </figure>
    </div>
</div>

@stop

@section('content')

<div class="container">
    <center>
        <div>
            <br>
            <ul class="list-unstyled">
                <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Bienvenido {{ $user->name }}</li>
            </ul>  
            <br>
        </div>
    </center>

    @if ($proyectos !== null)
        <center>
            <!-- Buscador y botón Añadir usuario  -->
            <div id="buscador-agregar" style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
                <div id="contenedor-buscador" class="input-group" style="flex-grow: 2; margin-right: 10px;">
                    <div class="col-md-" id="inp">
                        <input id="buscador" type="text" placeholder="Buscar proyecto" style="width: 100%;">
                    </div>
                    <div id="ic">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="col-md-3" id="btn-agregar">
                    <a href="{{route('vista_agr_proy')}}" class="btn btn-success">Añadir Proyecto</a>
                </div>
            </div>
            <br>
        </center>
        <div class="gap-2 d-grid d-md-flex justify-content-md-center">
        <a class="btn btn-warning btn-rounded" href="{{route('proyectosC_report')}}" target="_blank">
            <i class="fas fa-download"></i> Generar Reporte
        </a>
    </div>
        <br>
        <div class="tabla-container" style= "overflow-x: auto;">
        <table id= "tabla_usuarios" class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre del Proyecto</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tipo de Proyecto</th>
                    <th scope="col">Fecha inicio</th>
                    <th scope="col">Fecha Finalización</th>
                    <th scope="col">Semillero</th>
                    <th scope="col">Propuesta</th>
                    <th scope="col">Proyecto final</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach($proyectos as $p)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$p->id_proyecto}}</td>
                        <td>{{$p->titulo}}</td>
                        <td>{{$estadoOptions[$p->estado]}}</td>
                        <td>{{$tipoOptions[$p->tipo_proyecto]}}</td>
                        <td>{{$p->feacha_inicio}}</td>
                        <td>{{$p->feacha_fin}}</td>
                        <td>{{$p->semillero}}</td>
                        <td>
                            <a href="{{ Storage::url($p->arc_propuesta)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar propuesta">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ Storage::url($p->arc_adjunto)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar proyecto final">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        
                        <td>
                            <center>
                            <a style="margin: 3px;" href="{{route('vista_proy_evento_vincular', $p->id_proyecto)}}" class="btn btn-primary btn-sm">Vincular a Evento</a>
                            <a style="margin: 3px;" href="{{route('edit_proyectos', $p->id_proyecto)}}" class="btn btn-info btn-sm">Editar</a>
                            <a class="btn btn-warning btn-rounded" href="{{route('proyectosCI_report', $p->id_proyecto)}}" target="_blank"> <i class="fas fa-download"></i> Generar Reporte </a>
                            
                            @if($p->id !== $user->id)
                                <a style="margin: 3px;" href="{{route('eliminar_proyecto', $p->id_proyecto)}}" class="btn btn-danger btn-sm">Eliminar</a>
                            @endif
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
                    var filas = document.querySelectorAll("#tabla_usuarios tbody tr");
    
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
    @else
        <center>
            <div>
                <h5>Es posible que usted no este vinculad@ a un semillero</h5>
            </div>
        </center>
    @endif

</div>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡La actualización se ha realizado exitosamente!","Actualizacion Exitosa", true);
            });
        </script>
    @endif

    @if (session('preguntarEliminar'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elimina = '{{ request()->query('elimina') }}';
            mostrarModalEliminar(elimina);
        });
    </script>
    @endif

    @if (session('usuarioEliminado'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                mostrarAlertaRegistroExitoso("¡Usuario: '{{ request()->query('eliminado') }}' eliminado con Éxito!", "Eliminado", true);
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
                </div>
                <div class="modal-body">
                    <p id="usuarioEliminarNombre"></p>
                    <p id="usuarioEliminarCorreo"></p>
                    <p>¿Estás seguro de que deseas eliminar este proyecto?</p>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancerlarEliminarProyecto()">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminarProyecto()">Eliminar</button>
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
    <link rel="stylesheet" href="{{asset('css/segundo/listarusuarios.css')}}">
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/juan/listarProyectos.js') }}"></script>
    <script src="{{ asset('js/juan/alert.js') }}"></script>
@stop