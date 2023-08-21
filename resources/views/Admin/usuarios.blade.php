@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
            <h1>Listado de Usuarios</h1>
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
        <!-- Buscador y botón Añadir usuario  -->
        <div id="buscador-agregar" style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
            <div id="contenedor-buscador" class="input-group" style="flex-grow: 2; margin-right: 10px;">
                <div class="col-md-" id="inp">
                    <input id="buscador" type="text" placeholder="Buscar usuarios" style="width: 100%;">
                </div>
                <div id="ic">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="col-md-3" id="btn-agregar">
                <a href="{{route('v_reg_usr')}}" class="btn btn-success">Añadir Usuarios</a>
            </div>
        </div>
    </center>
    <br><br>
    <div class="gap-2 d-grid d-md-flex justify-content-md-center">
        <a class="btn btn-warning btn-rounded" href="{{route('usr_report')}}" target="_blank">
            <i class="fas fa-download"></i> Generar Reporte
        </a>
    </div>
    <br><br>
    <!-- Creación de tarjetas usuarios -->
    <div  class="card-container" style="display: flex; flex-wrap: wrap; justify-content: center;" >
        @foreach($usuarios as $u)
            <div class="card-flip">
                <div class="card-inner">
                    <div class="card-front" style="width: 15em; background-image: linear-gradient(to top right, rgba(10, 10, 22, 0.6), rgba(139, 135, 125, 0.6)), url('{{ app('App\Http\Controllers\Admin\AdminController')->obtenerFoto($u->id) }}');">
                        <div>
                            <h5 class="card-text" >{{$u->name}}</h5>
                        </div>
                    </div>
                    <div class="card-back">
                        <div>
                            <br>
                            <h5 class="card-text2" >{{$u->name}}</h5>
                        </div>
                        <div>
                            <p class="card-text" style="margin: 10px;">
                                <span id="rol_{{$u->id}}"class="badge rounded-pill d-inline">
                                    {{ $u->getRoleNames()->first() }}
                                </span>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Correo: {{$u->email}}</small>
                            </p>
                            <hr>
                        </div>
                        <hr>
                        <div>
                            <a href="{{route('edit_usr', $u->id)}}" class="btn btn-primary">Editar</a>
                            @if($u->id !== $user->id)
                                <a href="{{route('delete_usr', $u->id)}}" class="btn btn-danger">Eliminar</a>
                            @endif

                            @if($u->id !== $user->id)
                                <a href="{{route('perfiles', $u->id)}}" class="btn btn-info">Perfil</a>
                            @else
                                <a href="{{route('perfil')}}" class="btn btn-info">Perfil</a>
                            @endif

                            @if($u->getRoleNames()->first() == 'semillerista')
                                <a href="{{route('act_info_acad_sem', $u->id)}}" class="btn btn-dark">Inf. Acad</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡La actualización se ha realizado exitosamente!","Actualizacion Exitosa", true);
            });
        </script>
    @endif

    @if (session('noSuicidio'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡No puede eliminarse a si mismo!","Accion Rechazada", false);
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="usuarioEliminarNombre"></p>
                    <p id="usuarioEliminarCorreo"></p>
                    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancerlarEliminarUsuario()">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminarUsuario()">Eliminar</button>
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
    <script src="{{ asset('js/segundo/listarusuarios.js') }}"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop