@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<div class="container">
    <div class="note note-success mb-3">
        <figure class="text-center">
            <h1>Informacion Académica</h1>
        </figure>
    </div>
</div>
<!-- 

  <div class="row">
    <div class="col">
        <h1>Informacion Académica</h1>
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
    <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Datos Academicos del Semillerista @if (isset($persona)) {{$persona->nombre}} @endif</li>
    </ul>  
    <div class="col">
        @if(isset($persona) && $persona->foto !== null)
            <img class="foto-perfil" src="{{ Storage::url($persona->foto)}}" alt="Foto de Perfil">
        @else
            <img class="foto-perfil" src="https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png" alt="Imagen por Defecto">
        @endif
    </div>
    <br>
    <h5><mark>Por favor asegurece de que los datos Académicos Esten Actualizados</mark></h5>
    <br>
    <div id="contenedor-form">
        <form class="row g-3 needs-validation" novalidate action="{{ route('actualizar_acad_semillerista', $id) }}" method="POST" enctype="multipart/form-data">
          @csrf
            <!-- Número del código estudiantil -->
            <div class="col-md-6">
                <div class="form-outline">
                    <input type = "text" id="cod_estudiante" name="cod_estudiante" class="form-control is-valid" value="{{ isset($semillerista) ? $semillerista->cod_estudiante : old('cod_estudiante') }}"/>
                    <label class="form-label" for="cod_estudiante">Código Estudiantil</label>
                </div>
                @error('cod_estudiante')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Selección de semestre -->
            <div class="col-md-6">
                <select id="semestre" name="semestre" class="form-select is-valid" aria-label="Default select example">
                    <option value="">Seleccione el semestre</option>
                    @for($i = 1; $i <= 10; $i++)
                        @if(isset($semillerista) && $semillerista->semestre == $i)
                            <option value="{{ $i }}" selected> Semetre{{ $i }}</option>
                        @elseif(old('semestre') == $i)
                            <option value="{{ $i }}" selected> Semetre{{ $i }}</option>
                        @else
                            <option value="{{ $i }}"> Semetre {{ $i }}</option>
                        @endif
                    @endfor
                </select>
                @error('semestre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Cargar Reporte de matricula -->
            <div class="col-md-12">
                <label class="form-label" for="reporte_matricula" id="lb">Cargar Reporte de Matrícula (PDF)</label>
                <div class="form-outline">
                    <input class="form-control is-valid" id="reporte_matricula"  name="reporte_matricula" type="file" accept=".pdf" placeholder="Cargar Reporte de Matrícula (PDF)" />
                </div>
                @error('reporte_matricula')
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

    @if (session('actualizacionExitosa'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡La actualización se ha realizado exitosamente!","Actualizacion Exitosa", true);
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
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop