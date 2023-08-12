@extends('adminlte::page')

@section('title', 'Participantes')

@section('content_header')
    <h1>Agregar Participantes al Semillero {{$semillero->nombre}}</h1>
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
                            <input id ="buscador" type="text" placeholder="Buscar Semilleristas">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </center>
    <br>
    <table id="tabla_usuarios" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numero De Identificación</th>
                <th scope="col">Codigo Estudiante</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Semestre</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($semilleristas_libres as $s)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $s->num_identificacion }}</td>
                    <td>{{ $s->cod_estudiante }}</td>
                    <td>{{ app('App\Http\Controllers\Admin\AdminController')->obtenerNombrePersona($s->num_identificacion) }}</td>
                    <td>{{ app('App\Http\Controllers\Admin\AdminController')->obtenerCorreoUsuario($s->num_identificacion) }}</td>
                    <td>{{ $s->semestre }}</td>
                    <td>
                        <a href="{{ route('vincular_sem_sem', ['num_identificacion' => $s->num_identificacion, 'id' => $id]) }}" class="btn btn-success">Vincular</a>
                        <a href="{{ route('perfiles', app('App\Http\Controllers\Admin\AdminController')->obtenerIdUsuario($s->num_identificacion)) }}" class="btn btn-info">Perfil</a>
                        <a href="{{route('act_info_acad_sem', app('App\Http\Controllers\Admin\AdminController')->obtenerIdUsuario($s->num_identificacion))}}" class="btn btn-primary">Inf. Acad</a>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

    @if (session('vinculacionExitosa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha vinculado el semillerita al semillero de forma correcta!","Vinculacion Exitosa", true);
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
    <script src="{{ asset('js/segundo/listarusuarios.js') }}"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop