@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
  <div class="row">
    <div class="col">
        <h1>Informacion Académica</h1>
    </div>
    <div class="col">
        @if(isset($persona) && $persona->foto !== null)
            <img class="foto-perfil" src="{{ Storage::url($persona->foto)}}" alt="Foto de Perfil">
        @endif
    </div>
  </div>
@stop

@section('content')
    <p>Datos Academicos del Semillerista @if (isset($persona)) {{$persona->nombre}} @endif</p>
    <br>

    <h3>Por favor asegurece de que los datos Académicos Esten Actualizados</h3>
    <div id="contenedor-perfil">
        <form action="{{ route('actualizar_acad_semillerista', $id) }}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="row">
              <div class="col">
                @error('cod_estudiante')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                  <input type = "text" id="cod_estudiante" name="cod_estudiante" class="form-control" value="{{ isset($semillerista) ? $semillerista->cod_estudiante : old('cod_estudiante') }}"/>
                  <label class="form-label" for="cod_estudiante">Código Estudiantil</label>
                </div>
              </div>
              <div class="col">
                @error('semestre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-outline">
                    <select id="semestre" name="semestre" class="form-select">
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
                </div>
            </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    @error('reporte_matricula')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label class="form-label" for="reporte_matricula">Cargar Reporte de Matrícula (PDF)</label>
                    <input class="form-control form-control-lg" id="reporte_matricula" name="reporte_matricula" type="file" accept=".pdf" placeholder="Cargar Reporte de Matrícula (PDF)" />
                </div> 
            </div>
          <br>
            <!-- Submit button -->
            <button type="submit" class="btn btn-success btn-block mb-4">Actualizar Información</button>
        </form>
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