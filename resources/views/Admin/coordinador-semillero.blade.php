@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
  <div class="row">
    <div class="col">
    </div>
        @if (isset($coordinador))
            @if (isset($persona) && $persona->foto !== null)
                <center>
                    <div class="row">
                        <div class="col">
                            <h1>{{ $persona->nombre }} Coordinador del Semillero {{ $semillero->nombre }}</h1>
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col">
                            <img class="foto-perfil" src="{{ Storage::url($persona->foto) }}" alt="Foto de Perfil">
                        </div>
                    </div> 
                </center>
                
            @endif
        @else
            <h1>El Semillero {{ $semillero->nombre }} no tiene un coordinador</h1>
        @endif
  </div>
@stop

@section('content')

    @if (isset($coordinador))
        <center>
            <div>
                <div>
                    Nombre: {{$persona->nombre}}
                </div>
                <div>
                    Identificacion: {{$coordinador->num_identificacion}}
                </div>
                <div>
                    Area del Conocimiento: {{$coordinador->area_con}}
                </div>
                <div>
                    Feccha Vinculacion: {{$coordinador->fecha_vinculacion}}
                </div>
                <div>
                    <a href="{{ Storage::url($coordinador->acuerdo_nombramiento)}}" target="_blank">Acuerdo de nombramiento: </a>
                    <a href="{{ Storage::url($coordinador->acuerdo_nombramiento)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Acuerdo">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        </center>
        <hr>
        <br>
        <center><a  href="{{route('perfiles', $persona->usuario)}}" class="btn btn-info">Perfil</a>
        <br>
        <center><a  href="{{route('destituir_coor_sem', $id)}}" class="btn btn-danger">Destituir</a></center>
    @else
        <center> <div> <a href="{{route('vencular_coor_sem', $id)}}" class="btn btn-success">Nombrar un Coordinador</a> </div></center>
    @endif

    @if (session('coordinadorVinculado'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El registro se ha realizado exitosamente!","Coordinador vinculado con exito", true);
            });
        </script>
    @endif

    @if (session('coordinadordesVinculado'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El coordinador se ha elimiado exitosamente!","Coordinador desvinculado con exito", true);
            });
        </script>
    @endif

    @if (session('errorDespedirCoordinador'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso("¡El coordinador no existe!","Transaccion cancelada", false);
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