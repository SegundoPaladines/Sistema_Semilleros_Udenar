@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Listado de Usuarios</h1>
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
                            <input id ="buscador" type="text" placeholder="Buscar usuarios">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="btn-agregar">
                        <a href="{{route('v_reg_usr')}}" class="btn btn-success">Añadir Usuarios</a>
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
                <th scope="col">Nombre de Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($usuarios as $u)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td> 
                        <span id="rol_{{$u->id}}"class="badge rounded-pill d-inline">
                            {{ $u->getRoleNames()->first() }}
                        </span>
                    </td>
                    <td>
                        <a href="{{route('edit_usr', $u->id)}}" class="btn btn-primary">Editar</a>

                        @if($u->id !== $user->id)
                            <a href="{{route('delete_usr', $u->id)}}" class="btn btn-danger">Eliminar</a>
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
    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/segundo/listarusuarios.css')}}">
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/segundo/listarusuarios.js') }}"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop