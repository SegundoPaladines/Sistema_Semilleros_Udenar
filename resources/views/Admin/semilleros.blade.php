@extends('adminlte::page')

@section('title', 'Semilleros')

@section('content_header')
<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
        <h1>Listado de Semilleros</h1>
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
    <!-- Buscador y botón Añadir semilleros  -->
    <div id="buscador-agregar" style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
        <div id="contenedor-buscador" class="input-group" style="flex-grow: 2; margin-right: 10px;">
            <div class="col-md" id="inp">
                <input id="buscador" type="text" placeholder="Buscar Semilleros" style="width: 100%;">
            </div>
            <div id="ic">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="col-md-3" id="btn-agregar">
            <a href="{{route('agregar_semilleros')}}" class="btn btn-success">Añadir Semilleros</a>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <!-- Listado de Semilleros en cards -->
    <div class="card-container" style="display: flex; flex-wrap: wrap; justify-content: center;" >
        @foreach($semilleros as $s)
        <div class="card mb-3 text-center" style="width: 95%;  margin: 10px; height: 100%; border-radius: 90px;" >
            <div class="row g-0" style="height: 95%;" style="margin: 5px;">
                <div class="col-md-4" style="display: flex; justify-content: center; align-items: center; background-color: #FAFAFA; border-top-left-radius: 90px; border-bottom-left-radius: 90px;">
                    <div class="col">
                        <img
                            src= "{{ Storage::url($s->logo)}}"
                            alt= "Foto Semillero"
                            class="img-fluid rounded-pill"
                            style="width: 250px; height: 250px;"
                        />
                        <div style="margin: 15px;" >
                            <h4>Objetivos</h4>
                            <p>{{$s->objetivos}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <center><h1>{{$s->nombre}}</h1></center></div> <br>
                            <center><p><span style="font-size: small; font-style: italic;">{{$s->descripcion}}</span></p></center>
                            <center><p><span style="font-size: small; font-style: italic;"><strong>Sede:</strong>  {{$s->sede}}, Fundado en: {{$s->fecha_creacion}} según <a href="{{ Storage::url($s->resolucion)}}" target="_blank">Resolución {{$s->num_res}}</a></span></p></center>
                            <center><p><span style="font-size: small; font-style: italic;"><strong>Contacto:</strong>  {{$s->correo}}</span></p></center>
                            <center>
                                <a href="{{ Storage::url($s->resolucion)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Resolución">
                                    <i class="fas fa-download"></i>
                                </a>
                            </center>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <center>
                            <div class="col">
                                <a  href="{{route('actualizar_semillero', $s->id_semillero)}}" class="btn btn-secondary btn-rounded">Actualizar</a>
                                <a  href="{{route('participantes_semillero', $s->id_semillero)}}" class="btn btn-secondary btn-rounded">Participantes</a>
                                <a  href="{{route('vista_coor_sem', $s->id_semillero)}}" class="btn btn-secondary btn-rounded">Coordinador</a>
                                <a  href="{{route('delete_sem', $s->id_semillero)}}" class="btn btn-danger btn-rounded">Eliminar</a>
                            </div>
                        </center>
                    </div>
                    <hr>
                    <div class="col">
                        <div>
                            <h4>Presentación</h4>
                            <p>{{$s->presentacion}}</p>
                        </div>
                        
                        <div >
                                <h4>Misión</h4>
                                <p>{{$s->mision}}</p>
                        </div>
                        <div >       
                                <h4>Visión</h4>
                                <p>{{$s->vision}}</p>
                        </div>
                        <div >
                            <h4>Valores</h4>
                            <p>{{$s->valores}}</p>
                        </div>
                        <div>
                            <h4>Lineas de Investigación</h4>
                            <p>{{$s->lineas_inv}}</p>
                        </div><br>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>  
    </center>
    @if (session('preguntarEliminar'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var elimina = '{{ request()->query('elimina') }}';
                mostrarModalEliminar(elimina);
            });
        </script>
    @endif
    @if (session('semilleroEliminado'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                mostrarAlertaRegistroExitoso("¡Semillero: '{{ request()->query('eliminado') }}' eliminado con Éxito!", "Eliminado", true);
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
                    <p>¿Estás seguro de que deseas eliminar este semillero?</p>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancerlarEliminar()">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminar()">Eliminar</button>
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
    <link rel="stylesheet" href="{{asset('css/segundo/listarsemilleros.css')}}">
    
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/listarsemilleros.js') }}"></script>
    <script src="{{ asset('js/segundo/semilleros.js') }}"></script>
@stop