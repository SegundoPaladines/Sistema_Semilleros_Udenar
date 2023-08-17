@extends('adminlte::page')

@section('title', 'Participantes')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
            <h1>Listado de Participantes del Semillero {{$semillero->nombre}}</h1>
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
                    <input id="buscador" type="text" placeholder="Buscar Semilleristas" style="width: 100%;">
                </div>
                <div id="ic">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="col-md-3" id="btn-agregar">
                <a href="{{route('add_par_sem', $id)}}" class="btn btn-success">Añadir Participantes</a>
            </div>
        </div>
        <br>

    </center>

    <br>
    <div class="tabla-container" style= "overflow-x: auto;">

        <table id="tabla_usuarios" class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero De Identificación</th>
                    <th scope="col">Codigo Estudiante</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Fecha Vinculación</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($participantes as $p)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$p->num_identificacion}}</td>
                    <td>{{$p->cod_estudiante}}</td>
                    <td>{{app('App\Http\Controllers\Admin\AdminController')->obtenerNombrePersona($p->num_identificacion)}}</td>
                    <td>{{app('App\Http\Controllers\Admin\AdminController')->obtenerCorreoUsuario($p->num_identificacion)}}</td>
                    <td>{{$p->semestre}}</td>
                    <td>{{$p->fecha_vinculacion}}</td>
                    <td>{{$p->estado}}</td>
                    <td>
                        <center>
                        <a style="margin: 3px;" href="{{route('desvincular_sem_sem', $p->num_identificacion)}}" class="btn btn-danger btn-sm">Desvincular</a>
                        <a style="margin: 3px;" href="{{route('act_info_acad_sem', app('App\Http\Controllers\Admin\AdminController')->obtenerIdUsuario($p->num_identificacion))}}" class="btn btn-primary btn-sm">Inf. Acad</a>
                        <a style="margin: 3px;" href="{{route('perfiles', app('App\Http\Controllers\Admin\AdminController')->obtenerIdUsuario($p->num_identificacion))}}" class="btn btn-info btn-sm">Perfil</a>
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

</div>

    @if (session('desvinculacionExitosa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                mostrarAlertaRegistroExitoso("Se desvinculo el usuario del semillero con Exito!", "Desvinculación Exitosa", true);
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