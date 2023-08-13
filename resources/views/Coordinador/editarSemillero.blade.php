@extends('adminlte::page')

@section('title', 'Actualizar Semillero')

@section('content_header')
    <h1>Actualizar Semillero</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form method="POST" action="{{ route('actualizar_semillero_cor', $id_semillero) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div>
                            @error('id_semillero')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="id_semillero" name="id_semillero" class="form-control" value="{{ $id_semillero }}" />
                                <label class="form-label" for="id_semillero">Id del Semillero</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $semillero->nombre }}" />
                                <label class="form-label" for="nombre">Nombre del Semillero</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        @error('sede')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id="sede" name="sede" class="form-select">
                            <option value="">Sede</option>
                            <option value="1" {{  $semillero->sede == "Pasto" ? 'selected' : '' }}>Pasto</option>
                            <option value="2" {{  $semillero->sede == "Ipiales" ? 'selected' : '' }}>Ipiales</option>
                            <option value="3" {{  $semillero->sede == "Túqueres" ? 'selected' : '' }}>Túquerres</option>
                            <option value="4" {{  $semillero->sede == "Tumaco" ? 'selected' : '' }}>Tumaco</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <label class="form-label" for="logo"> Cargar Logo</label>
                      <input class="form-control form-control-lg" id="logo" name="logo" type="file" accept="image/*" placeholder="Cargar foto" />
                    </div>

                    <div class="col">
                        @error('resolucion')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label class="form-label" for="resolucion"> Cargar Resolución</label>
                        <input class="form-control form-control-lg" id="resolucion" name="resolucion" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx" placeholder="Cargar Resolucion" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div>
                            @error('correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="correo" name="correo" class="form-control" value="{{ $semillero->correo }}" />
                                <label class="form-label" for="correo">Correo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('num_res')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="num_res" name="num_res" class="form-control" value="{{ $semillero->num_res }}" />
                                <label class="form-label" for="num_res">Numero de Resolución</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            @error('fecha_creacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <input class="form-control" type="text" id="fecha_creacion" name="fecha_creacion" value="{{ $semillero->fecha_creacion }}" placeholder="Fecha de Creacion">
                                <label class="form-label" for="fecha_creacion">Fecha de Creacion</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $semillero->descripcion }}</textarea>
                                <label class="form-label" for="descripcion">Descripción</label>
                              </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div>
                            @error('mision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="mision" name="mision" rows="3">{{ $semillero->mision }}</textarea>
                                <label class="form-label" for="mision">Mision</label>
                              </div>
                        </div>
                    </div>

                    <div class="col">
                        <div>
                            @error('vision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="vision" name="vision" rows="3">{{$semillero->vision }}</textarea>
                                <label class="form-label" for="vision">Vision</label>
                              </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div>
                            @error('presentacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="presentacion" name="presentacion" rows="3">{{ $semillero->presentacion }}</textarea>
                                <label class="form-label" for="presentacion">Presentación</label>
                              </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div>
                            @error('objetivos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="objetivos" name="objetivos" rows="3">{{ $semillero->objetivos }}</textarea>
                                <label class="form-label" for="objetivos">Objetivos</label>
                              </div>
                        </div>
                    </div>

                    <div class="col">
                        <div>
                            @error('valores')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="valores" name="valores" rows="3">{{ $semillero->valores }}</textarea>
                                <label class="form-label" for="valores">Valores</label>
                              </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div>
                            @error('lineas_inv')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-outline">
                                <textarea class="form-control" id="lineas_inv" name="lineas_inv" rows="3">{{ $semillero->lineas_inv }}</textarea>
                                <label class="form-label" for="lineas_inv">Lineas de Investigación</label>
                              </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Actualizar Semillero</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El semillero se ha actualizado con éxito!", "Actualizacion Exitosa", true);
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
    <!-- JQery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!-- CSS Propio -->

@stop

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!-- JS Propio -->
    <script src="{{ asset('js/segundo/campos-especiales.js') }}"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop