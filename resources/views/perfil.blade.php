@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
            <h1>Perfil</h1>
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
    <div class="col">
        @if(isset($persona) && $persona->foto !== null)
            <img class="foto-perfil" src="{{ Storage::url($persona->foto)}}" alt="Foto de Perfil">
        @else
            <img class="foto-perfil" src="https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png" alt="Imagen por Defecto">
        @endif
    </div>
    <br>
    <div id="contenedor-form">
        <form class="row g-3 needs-validation" novalidate action="{{ route('actualizar_perfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Seleccionar tipo identificación -->
            <div class="col-md-6">
                <!-- <div class="form-outline"> -->
                <select id="tipo_identificacion" name="tipo_identificacion" class="form-select is-valid" aria-label="Default select example">
                    <option value="1" {{ isset($persona) && $persona->tipo_identificacion == 1 ? 'selected' : '' }}>CC: Cédula de Ciudadanía</option>
                    <option value="2" {{ isset($persona) && $persona->tipo_identificacion == 2 ? 'selected' : '' }}>TI: Tarjeta de Identidad</option>
                    <option value="3" {{ isset($persona) && $persona->tipo_identificacion == 3 ? 'selected' : '' }}>RC: Registro Civil</option>
                    <option value="4" {{ isset($persona) && $persona->tipo_identificacion == 4 ? 'selected' : '' }}>CE: Cédula de Extranjería</option>
                </select>
                @error('tipo_identificacion')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <!-- </div> -->
            </div>
            <!-- Número de identificación -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type = "text" id="num_identificacion" name="num_identificacion" class="form-control is-valid" value="{{ isset($persona) ? $persona->num_identificacion : old('num_identificacion') }}"/>
                    <label class="form-label" for="num_identificacion">Número del Documento de Identidad</label>
                </div>
                @error('num_identificacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Nombre completo -->
            <div class="col-md-12">
                <div class="form-outline">
                    <input  type="text" id="nombre" name="nombre" class="form-control is-valid" value="{{ isset($persona) ? $persona->nombre : old('nombre') }}" />
                    <label class="form-label" for="nombre">Nombre y Apellidos Completos</label>
                </div>
                @error('nombre')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Cargar foto -->
            <div class="col-md-12">
                <label class="form-label" for="foto" id="lb"> Cargar Foto</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="foto" name="foto" type="file" accept="image/*" placeholder="Cargar foto" />
                </div>
                @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <!-- Correo -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="email" id="correo" class="form-control is-valid disabled" disabled value="{{ $user->email }}"/>
                    <label class="form-label" for="correo">Correo</label>
                </div>
                @error('correo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Telefono -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="telefono" name="telefono" class="form-control is-valid" value="{{ isset($persona) ? $persona->telefono : old('telefono') }}" />
                    <label class="form-label" for="telefono">Telefono</label>
                </div>
                @error('telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Dirección -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="direccion" name="direccion" class="form-control is-valid" value="{{ isset($persona) ? $persona->direccion : old('direccion') }}"/>
                    <label class="form-label" for="direccion">Dirección</label>
                </div>
                @error('direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Opciones Sexo -->
            <div class="col-md-4">
                <select id="sexo" name="sexo" class="form-select is-valid" aria-label="Default select example">
                    <option value="1" {{ isset($persona) && $persona->sexo == 1 ? 'selected' : ''}} >M: Hombre</option>
                    <option value="0" {{ isset($persona) && $persona->sexo == 0 ? 'selected' : ''}}>F: Mujer</option>
                </select>
                @error('sexo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Programa Academico -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input type="text" id="programa" name="programa" class="form-control is-valid" value="{{ isset($persona) ? $persona->programa_academico : old('programa') }}"/>
                    <label class="form-label" for="programa">Programa Academico</label>
                </div>
                @error('programa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Fecha de NAcimiento -->
            <div class="col-md-4">
                <div class="form-outline">
                    <input class="form-control is-valid" type="text" id="fecha_nac" name="fecha_nac" placeholder="Fecha de Nacimiento" value="{{ isset($persona) ? $persona->fecha_nac : old('fecha_nac')}}">
                    <label class="form-label" for="fecha_nac">Fecha de Nacimiento</label>
                </div>
                @error('fecha_nac')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-success btn-block mb-4">Actualizar Información</button>
        </form>
    </div>
    </center> 
</div>
    <br><br>
    @if (session('actualizarProfa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                porfavorActualizar();
            });
        </script>
    @endif

    @if (session('actualizacionExitosa'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              actualizacionExitosa();
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
                  <button widht="60%" type="button" id="btnCerrarModal" class="btn">ok</button>
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
    <!--CSS Propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/perfil.css')}}">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/campos-especiales.js') }}"></script>
    <script src="{{ asset('js/segundo/perfil.js') }}"></script>
@stop