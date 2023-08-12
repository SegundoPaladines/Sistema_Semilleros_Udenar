@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
    <h1>Listado de Proyectos</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <table id="buscador-agregar">
            <tr>
                <td>
                    <div id="contenedor-buscador" class="input-group">
                        <div id="inp">
                            <input id ="buscador" type="text" placeholder="Buscar proyecto">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="btn-agregar">
                        <a href="{{route('vista_agr_proy')}}" class="btn btn-success">Añadir Proyecto</a>
                    </div>
                </td>
            </tr>
        </table>    
    </center>
    <br>
    <table id= "tabla_usuarios" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre del Proyecto</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo de Proyecto</th>
                <th scope="col">Fecha inicio</th>
                <th scope="col">Fecha Finalización</th>
                <th scope="col">Propuesta</th>
                <th scope="col">Proyecto Final</th>
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
                    <td>{{$p->estado}}</td>
                    <td>{{$p->tipo_proyecto}}</td>
                    <td>{{$p->feacha_inicio}}</td>
                    <td>{{$p->feacha_fin}}</td>
                    <td><a href="{{ asset($p->arc_propuesta) }}" target="_blank">Descargar PDF</a></td>
                    <td><a href="{{ asset($p->arc_adjunto) }}" target="_blank">Descargar PDF</a></td>
                    <td>
                        <a href="{{route('edit_proyectos', $p->id_proyecto)}}" class="btn btn-primary">Editar</a>
                        @if($p->id !== $user->id)
                            <a href="{{route('eliminar_proyecto', $p->id_proyecto)}}" class="btn btn-danger">Eliminar</a>
                        @endif
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

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