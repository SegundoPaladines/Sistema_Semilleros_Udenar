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
  <!-- <div class="row">
    <div class="col">
        <h1>Perfil</h1>
    </div>
    <div class="col">
        @if(isset($persona) && $persona->foto !== null)
            <img class="foto-perfil" src="{{ Storage::url($persona->foto)}}" alt="Foto de Perfil">
        @endif
    </div>
  </div> -->
@stop

@section('content')
<div class="container">
    <center>
        <br>
        <ul class="list-unstyled">
        <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Perfil de {{$usr_edit->name }}</li>
        </ul>  
        <div class="col">
            @if(isset($persona) && $persona->foto !== null)
                <img class="foto-perfil" src="{{ Storage::url($persona->foto)}}" alt="Foto de Perfil">
            @else
                <img class="foto-perfil" src="https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png" alt="Imagen por Defecto">
            @endif
        </div>
        <br>
        <!-- <div id="contenedor-form">
          <form class="row g-3 needs-validation" novalidate id="form" name="form" method="POST" action="{{ route('registar_usuario') }}">
              @csrf -->
              <!-- Nombre y Apellidos completos-->
              <!-- <div class="col-md-12">
                  <div class="form-outline">
                      <input type="text" id="nombre" name="nombre" class="form-control is-valid" value="{{ isset($persona) ? $persona->nombre : old('nombre') }}" required />
                      <label for="nombre" class="form-label">Nombre y Apellidos Completos</label>
                      <div id="nombre-e" name="nombre-e" class="invalid-feedback">*</div>
                      @error('nombre')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div> -->
              <!-- Seleccionar rol -->
              <!-- <div class="col-md-6">
                  <div class="form-outline">
                      <select id="tipo_identificacion" name="tipo_identificacion" class="form-select " aria-label="Default select example">
                        <option value="1" {{ isset($persona) && $persona->tipo_identificacion == 1 ? 'selected' : '' }}>CC: Cédula de Ciudadanía</option>
                        <option value="2" {{ isset($persona) && $persona->tipo_identificacion == 2 ? 'selected' : '' }}>TI: Tarjeta de Identidad</option>
                        <option value="3" {{ isset($persona) && $persona->tipo_identificacion == 3 ? 'selected' : '' }}>RC: Registro Civil</option>
                        <option value="4" {{ isset($persona) && $persona->tipo_identificacion == 4 ? 'selected' : '' }}>CE: Cédula de Extranjería</option>
                      </select>
                      <span id="tipo_identificacion-e" name="tipo_identificacion-e" class="text-danger">Seleccione una opción.</span>
                      @error('tipo_identificacion')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div> -->
              <!-- Nombre y Apellidos completos-->
              <!-- <div class="col-md-12">
                  <div class="form-outline">
                      <input type="text" id="nombre" name="nombre" class="form-control is-valid" value="{{ isset($persona) ? $persona->nombre : old('nombre') }}" required />
                      <label for="nombre" class="form-label">Nombre y Apellidos Completos</label>
                      <div id="nombre-e" name="nombre-e" class="invalid-feedback">*</div>
                      @error('nombre')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div> -->


              <!-- Número de documento-->
              <!-- <div class="col-md-12">
                  <div class="form-outline">
                      <input type = "text" id="num_identificacion" name="num_identificacion" class="form-control is-valid" value="{{ isset($persona) ? $persona->num_identificacion : old('num_identificacion') }}" required />
                      <label for="nombre" class="form-label">Nombre y Apellidos Completos</label>
                      <div id="num_identificacion-e" name="num_identificacion-e" class="invalid-feedback">*</div>
                      @error('num_identificacion')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div> -->
          <!-- </form>
        </div> -->
    
    <div id="contenedor-perfil">
        <form action="{{route('actualizar_perfiles', $usr_edit->id)}}" method= "POST" enctype="multipart/form-data">
          @csrf
            <div class="row">
              <div class="col">
                @error('tipo_identificacion')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                  <select id="tipo_identificacion" name="tipo_identificacion" class="form-select" aria-label="Default select example">
                    <option value="1" {{ isset($persona) && $persona->tipo_identificacion == 1 ? 'selected' : '' }}>CC: Cédula de Ciudadanía</option>
                    <option value="2" {{ isset($persona) && $persona->tipo_identificacion == 2 ? 'selected' : '' }}>TI: Tarjeta de Identidad</option>
                    <option value="3" {{ isset($persona) && $persona->tipo_identificacion == 3 ? 'selected' : '' }}>RC: Registro Civil</option>
                    <option value="4" {{ isset($persona) && $persona->tipo_identificacion == 4 ? 'selected' : '' }}>CE: Cédula de Extranjería</option>
                  </select>
              </div>
              <div class="col">
                @error('num_identificacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type = "text" id="num_identificacion" name="num_identificacion" class="form-control" value="{{ isset($persona) ? $persona->num_identificacion : old('num_identificacion') }}"/>
                  <label class="form-label" for="num_identificacion">Número del Documento de Identidad</label>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                @error('nombre')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input  type="text" id="nombre" name="nombre" class="form-control" value="{{ isset($persona) ? $persona->nombre : old('nombre') }}" />
                  <label class="form-label" for="nombre">Nombre y Apellidos Completos</label>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                @error('foto')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                <label class="form-label" for="foto"> Cargar Foto</label>
                <input class="form-control form-control-lg" id="foto" name="foto" type="file" accept="image/*" placeholder="Cargar foto" />
              </div>
            </div>
            <br>
            <hr />
            <div class="row">
              <div class="col">
                @error('correo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type="email" id="correo" class="form-control disabled" disabled value="{{ $usr_edit->email }}"/>
                  <label class="form-label" for="correo">Correo</label>
                </div>
              </div>
              <div class="col">
                @error('telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type="text" id="telefono" name="telefono" class="form-control" value="{{ isset($persona) ? $persona->telefono : old('telefono') }}" />
                  <label class="form-label" for="telefono">Telefono</label>
                </div>
              </div>
              <div class="col">
                @error('direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type="text" id="direccion" name="direccion" class="form-control" value="{{ isset($persona) ? $persona->direccion : old('direccion') }}"/>
                  <label class="form-label" for="direccion">Dirección</label>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                @error('sexo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <select id="sexo" name="sexo" class="form-select" aria-label="Default select example">
                  <option value="1" {{ isset($persona) && $persona->sexo == 1 ? 'selected' : ''}} >M: Hombre</option>
                  <option value="0" {{ isset($persona) && $persona->sexo == 0 ? 'selected' : ''}}>F: Mujer</option>
                </select>
              </div>
              <div class="col">
                @error('programa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type="text" id="programa" name="programa" class="form-control" value="{{ isset($persona) ? $persona->programa_academico : old('programa') }}"/>
                  <label class="form-label" for="programa">Programa Academico</label>
                </div>
              </div>
              <div class="col">
                @error('fecha_nac')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input class="form-control" type="text" id="fecha_nac" name="fecha_nac" placeholder="Fecha de Nacimiento" value="{{ isset($persona) ? $persona->fecha_nac : old('fecha_nac')}}">
                  <label class="form-label" for="fecha_nac">Fecha de Nacimiento</label>
                </div>
              </div>
            </div>
            
          <br>
            <!-- Submit button -->
            <button type="submit" class="btn btn-success btn-block mb-4">Actualizar Información</button>
        </form>
    </div>
    </center>
</div>
<br><br>
    @if (session('actualizacionExitosa'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              actualizacionExitosa({{$usr_edit->id}});
          });
      </script>
    @endif

    @if (session('usuarioSinPersona'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              usuarioSinPersona({{$usr_edit->id}});
          });
      </script>
    @endif

    @if (session('noCoorSinDatos'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            noCoorSinDatos({{$usr_edit->id}});
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
    <script src="{{ asset('js/segundo/perfiles.js') }}"></script>
@stop