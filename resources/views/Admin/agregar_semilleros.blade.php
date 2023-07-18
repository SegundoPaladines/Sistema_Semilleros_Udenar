@extends('adminlte::page')

@section('title', 'Registrar Semillero')

@section('content_header')
    <h1>Registrar Semillero</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col">
                        <div>
                            @error('id_semillero')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="id_semillero" name="id_semillero" class="form-control" />
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
                                <input type="text" id="nombre" name="nombre" class="form-control" />
                                <label class="form-label" for="nombre">Nombre del Semillero</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        @error('sede')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id ="sede" name="sede" class="form-select">
                            <option selected>Sede</option>
                            <option value="1">Pasto</option>
                            <option value="1">Ipiales</option>
                            <option value="3">Túquerres</option>
                            <option value="4">Tumaco</option>
                        </select>
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
                            @error('num_res')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="num_res" name="num_res" class="form-control" />
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
                                <input class="form-control" type="text" id="fecha_creacion" name="fecha_creacion" placeholder="Fecha de Creacion">
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
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
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
                                <textarea class="form-control" id="mision" name="mision" rows="3"></textarea>
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
                                <textarea class="form-control" id="vision" name="vision" rows="3"></textarea>
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
                                <textarea class="form-control" id="presentacion" name="presentacion" rows="3"></textarea>
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
                                <textarea class="form-control" id="objetivos" name="objetivos" rows="3"></textarea>
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
                                <textarea class="form-control" id="valores" name="valores" rows="3"></textarea>
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
                                <textarea class="form-control" id="lineas_inv" name="lineas_inv" rows="3"></textarea>
                                <label class="form-label" for="lineas_inv">Lineas de Investigación</label>
                              </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Agregar Semillero</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡La actualización se ha realizado exitosamente!","Actualizacion Exitosa", true);
            });
        </script>
    @endif

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
    <script src="{{ asset('js/segundo/campos-especiales.js') }}"></script>
@stop