@extends('adminlte::page')

@section('title', 'Agregar proyecto')

@section('content_header')
    <h1>Agregar proyecto</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form method="POST" action="" action="{{ route('agregar_proyecto_dir') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div>
                            @error('id_proyecto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="id_proyecto" name="id_proyecto" class="form-control" />
                                <label class="form-label" for="id_proyecto">Id del Proyecto</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('semillero')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="semillero" name="semillero" class="form-control" />
                                <label class="form-label" for="semillero">Id del Semillero</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('titulo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="titulo" name="titulo" class="form-control" />
                                <label class="form-label" for="titulo">Titulo</label>
                            </div>
                        </div>
                    </div>
                   
                    
                </div>

                <div class="row">

                <div class="col">
                        @error('tipo_proyecto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="tipo_proyecto" name="tipo_proyecto" class="form-select">
                            <option selected>Tipo</option>
                            <option value="1">Investigación</option>
                            <option value="2">Innovación y Desarrollo</option>
                            <option value="3">Emprendimiento</option>
                        </select>
                    </div>

                    <div class="col">
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="estado" name="estado" class="form-select">
                            <option selected>Estado</option>
                            <option value="1">Propuesta</option>
                            <option value="2">En curso</option>
                            <option value="3">Finalizado</option>
                            <option value="4">Inactivo</option>
                        </select>
                    </div>
                    
                    <div class="col">
                        <div>
                            @error('feacha_inicio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <input class="form-control" type="date" id="feacha_inicio" name="feacha_inicio" placeholder="Fecha de inicio">
                                <label class="form-label" for="feacha_inicio">Fecha de Inicio</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('feacha_fin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <input class="form-control" type="date" id="feacha_fin" name="feacha_fin" placeholder="Fecha de fin">
                                <label class="form-label" for="feacha_fin">Fecha de Finalización</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    
                    
                    <div class="col">
                        <div>
                            @error('arc_propuesta')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- <div class="mb-4 form-outline"> -->
                                <label class="form-label" for="arc_propuesta">Propuesta</label>
                                <input type="file" id="arc_propuesta" name="arc_propuesta" class="form-control" />
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('arc_adjunto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- <div class="mb-4 form-outline"> -->
                                <label class="form-label" for="arc_adjunto">Proyecto Final</label>
                                <input type="file" id="arc_adjunto" name="arc_adjunto" class="form-control" accept=".pdf, .doc, .docx" />
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <br>
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Agregar proyecto</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha agregado el proyecto!","", true);
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
    <!-- JQery -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS Propio-->

@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/juan/alert.js') }}"></script>
@stop