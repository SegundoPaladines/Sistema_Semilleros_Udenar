@extends('adminlte::page')

@section('title', 'Semilleros')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
            <h1>Semillero</h1>
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
    <hr>
    <br>

    <div class="card-container" style="display: flex; flex-wrap: wrap; justify-content: center;" >
        <div class="mb-3 text-center card" style="width: 95%;  margin: 10px; height: 100%; border-radius: 90px;" >
            <div class="row g-0" style="height: 95%;" style="margin: 5px;">
                <div class="col-md-4" style="display: flex; justify-content: center; align-items: center; background-color: #FAFAFA; border-top-left-radius: 90px; border-bottom-left-radius: 90px;">
                    <div class="col">
                        <img
                            src= "{{ Storage::url($semillero->logo)}}"
                            alt= "Foto Semillero"
                            class="img-fluid rounded-pill"
                            style="width: 250px; height: 250px;"
                        />
                        <div style="margin: 15px;" >
                            <h4>Objetivos</h4>
                            <p>{{$semillero->objetivos}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <br>
                            <center><h1>{{ $semillero->nombre }}</h1></center></div> <br>
                            <center><p><span style="font-size: small; font-style: italic;">{{$semillero->descripcion}}</span></p><br></center>
                            <center><p><span style="font-size: small; font-style: italic;"><strong>Sede:</strong>  {{$semillero->sede}}, Fundado en: {{$semillero->fecha_creacion}} según <a href="{{ Storage::url($semillero->resolucion)}}" target="_blank">Resolución {{$semillero->num_res}}</a></span></p></center>
                            <center><p><span style="font-size: small; font-style: italic;"><strong>Contacto:</strong>{{$semillero->correo}}</span></p></center>
                            <center>
                            <a href="{{ Storage::url($semillero->resolucion)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Resolución">
                                <i class="fas fa-download"></i>
                            </a>
                            </center>
                        </div>
                    </div>
                    <hr>
                    @can('coordinador.administracion')
                    <div class="row">
                        <center>
                            <div class="col">
                                <a  href="{{route('vista_editar_semillero_cor', $coordinador->semillero)}}" class="btn btn-secondary btn-rounded">Editar</a>
                                <a  href="{{route('sem_report_coor')}}" class="btn btn-secondary btn-rounded" target="_blank">Generar Reporte</a>
                            </div>
                        </center>
                    </div>
                    <hr>
                    @endcan
                    @can('semillerista.proyectos')
                        <div class="row">
                            <center>
                                <div class="col">
                                    <a  href="{{route('sem_report_sem')}}" class="btn btn-secondary btn-rounded" target="_blank">Generar Reporte</a>
                                </div>
                            </center>
                        </div>
                        <hr>
                    @endcan
                    <div class="col">

                        <div>
                            <h4>Presentación</h4>
                            <p>{{$semillero->presentacion}}</p>
                        </div>
                        <div >
                            <h4>Misión</h4>
                            <p>{{$semillero->mision}}</p>
                        </div>
                        <div >       
                            <h4>Visión</h4>
                            <p>{{$semillero->vision}}</p>
                        </div>
                        <div >
                            <h4>Valores</h4>
                            <p>{{$semillero->valores}}</p>
                        </div>
                        <div>
                            <h4>Lineas de Investigación</h4>
                            <p>{{$semillero->lineas_inv}}</p>
                        </div><br>

                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
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
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
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