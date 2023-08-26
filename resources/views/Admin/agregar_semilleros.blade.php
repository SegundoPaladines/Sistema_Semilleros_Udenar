@extends('adminlte::page')

@section('title', 'Registrar Semillero')

@section('content_header')
<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
        <h1>Registrar Semillero</h1>
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
    <div id="contenedor-form">
        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('agregar_semillero') }}" enctype="multipart/form-data">
            @csrf

            <!-- Id del Semillero -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="id_semillero" name="id_semillero" class="form-control is-valid" value="{{ old('id_semillero') }}" />
                    <label class="form-label" for="id_semillero">Id del Semillero</label>
                </div>
                @error('id_semillero')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nombre del Semillero -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="nombre" name="nombre" class="form-control is-valid" value="{{ old('nombre') }}" />
                    <label class="form-label" for="nombre">Nombre del Semillero</label>
                </div>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Opciones Sede -->
            <div class="col-md-4">
                <select id="sede" name="sede"  class="form-select is-valid" >
                    <option value="">Sede</option>
                    <option value="1">Pasto</option>
                    <option value="2">Ipiales</option>
                    <option value="3">Túquerres</option>
                    <option value="4">Tumaco</option>
                </select>
                @error('sede')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cargar Logo -->
            <div class="col-md-6">
                <label class="form-label" for="logo" id="lb"> Cargar Logo</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="logo" name="logo" type="file" accept="image/*" placeholder="Cargar foto" />
                </div>
                @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cargar Resolución-->
            <div class="col-md-6">
                <label class="form-label" for="resolucion" id="lb"> Cargar Resolución</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="resolucion" name="resolucion" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx" placeholder="Cargar Resolucion" />
                </div>
                @error('resolucion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="correo" name="correo" class="form-control is-valid" value="{{ old('correo') }}" />
                    <label class="form-label" for="correo">Correo</label>
                </div>
                @error('correo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Número de resolución -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="num_res" name="num_res" class="form-control is-valid" value="{{ old('num_res') }}" />
                    <label class="form-label" for="num_res">Numero de Resolución</label>
                </div>
                @error('num_res')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Creación -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input class="form-control is-valid" type="text" id="fecha_creacion" name="fecha_creacion" value="{{ old('fecha_creacion') }}" placeholder="Fecha de Creacion">
                    <label class="form-label" for="fecha_creacion">Fecha de Creación</label>
                </div>
                @error('fecha_creacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    <label class="form-label" for="descripcion">Descripción</label>
                </div>
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Misión -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="mision" name="mision" rows="3">{{ old('mision') }}</textarea>
                    <label class="form-label" for="mision">Misión</label>
                </div>
                @error('mision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Visión -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="vision" name="vision" rows="3">{{ old('vision') }}</textarea>
                    <label class="form-label" for="vision">Visión</label>
                </div>
                @error('vision')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Presentación -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="presentacion" name="presentacion" rows="3">{{ old('presentacion') }}</textarea>
                    <label class="form-label" for="presentacion">Presentación</label>
                </div>
                @error('presentacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Objetivos -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="objetivos" name="objetivos" rows="3">{{ old('objetivos') }}</textarea>
                    <label class="form-label" for="objetivos">Objetivos</label>
                </div>
                @error('objetivos')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Valores -->
            <div class="col-md-4">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="valores" name="valores" rows="3">{{ old('valores') }}</textarea>
                    <label class="form-label" for="valores">Valores</label>
                </div>
                @error('valores')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Lineas de Investigación -->
            <div class="col-md-12">
                <div class="form-outline">
                    <textarea class="form-control is-valid" id="lineas_inv" name="lineas_inv" rows="3">{{ old('lineas_inv') }}</textarea>
                    <label class="form-label" for="lineas_inv">Lineas de Investigación</label>
                </div>
                @error('lineas_inv')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Boton Enviar -->
            <button type="submit" class="mb-3 btn btn-success btn-block">Agregar Semillero</button>
        </form>
    </div>
    </center>
</div>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El semillero se ha registrado con éxito!", "Registro Exitoso", true);
            });
        </script>
    @endif
    @if (session('registroNoExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El semillero no se ha registrado con éxito, el ID ingresado ya existe!", "Registro Exitoso", false);
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
    <link href="{{ asset('css/segundo/campos-especiales.css') }}" rel="stylesheet">
    <link href="{{ asset('css/segundo/perfil.css') }}" rel="stylesheet">
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
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