@extends('adminlte::page')

@section('title', 'Registrar Evento')

@section('content_header')
    <h1>Registrar Evento</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form method="POST" action="" action="{{ route('registrar_evento') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div>
                            @error('codigo_evento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="codigo_evento" name="codigo_evento" class="form-control" />
                                <label class="form-label" for="codigo_evento">Id del Evento</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="nombre" name="nombre" class="form-control" />
                                <label class="form-label" for="nombre">Nombre del Evento</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('fecha_inicio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de inicio">
                                <label class="form-label" for="fecha_inicio">Fecha de Inicio</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('fecha_fin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <input class="form-control" type="date" id="fecha_fin" name="fecha_fin" placeholder="Fecha de fin">
                                <label class="form-label" for="fecha_fin">Fecha de Finalización</label>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>

                <div class="row">
                    <div class="col">
                        <div>
                            @error('correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="correo" name="correo" class="form-control" />
                                <label class="form-label" for="correo">Correo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="telefono" name="telefono" class="form-control" />
                                <label class="form-label" for="telefono">Numero de Contacto</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('lugar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="lugar" name="lugar" class="form-control" />
                                <label class="form-label" for="lugar">Lugar</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                <div class="col">
                        @error('tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="tipo" name="tipo" class="form-select">
                            <option selected>Tipo</option>
                            <option value="1">Congreso</option>
                            <option value="1">Encuentro</option>
                            <option value="3">Seminario</option>
                            <option value="4">Taller</option>
                        </select>
                    </div>
                    <div class="col">
                        @error('modalidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="modalidad" name="modalidad" class="form-select">
                            <option selected>Modalidad</option>
                            <option value="1">Virtual</option>
                            <option value="1">Presencial</option>
                            <option value="3">Hibrida</option>
                        </select>
                    </div>
                    <div class="col">
                        @error('clasificacion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="clasificacion" name="clasificacion" class="form-select">
                            <option selected>Clasificación</option>
                            <option value="1">Local</option>
                            <option value="1">Regional</option>
                            <option value="3">Nacional</option>
                        </select>
                    </div>
                    <
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div>
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                <label class="form-label" for="descripcion">Descripción</label>
                              </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('observaciones')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                <label class="form-label" for="observaciones">Observaciones</label>
                              </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Agregar Evento</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡Se ha registrado el evento!","", true);
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
    <script src="{{ asset('js/david/alerta_exito.js') }}"></script>
@stop