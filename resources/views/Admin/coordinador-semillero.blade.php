@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
        <h1>Coordinador Semillero</h1>
        </figure>
    </div>
</div>

@stop

@section('content')

<div class="container">

    @if (isset($coordinador))

        <div class="text-center card">
            <div class="card-header">
                <h4>{{ $persona->nombre }} - Coordinador del Semillero {{ $semillero->nombre }}</h4>
            </div>
            <div class="card-body">
                @if(isset($persona) && $persona->foto !== null)
                    <img class="foto-perfil" src="{{ Storage::url($persona->foto) }}" alt="Foto de Perfil">
                @else
                    <img class="foto-perfil" src="https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png" alt="Imagen por Defecto">
                @endif
                <div>
                    <strong>Nombre: </strong>{{$persona->nombre}}
                </div>
                <div>
                    <strong>Identificacion: </strong>{{$coordinador->num_identificacion}}
                </div>
                <div>
                    <strong>Area del Conocimiento: </strong>{{$coordinador->area_con}}
                </div>
                <div>
                    <strong>Fecha Vinculacion: </strong>{{$coordinador->fecha_vinculacion}}
                </div>
                <div>
                    <strong>Correo: </strong>{{$persona->correo}}
                </div>
                <div>
                    <a href="{{ Storage::url($coordinador->acuerdo_nombramiento)}}" target="_blank">Acuerdo de nombramiento </a>
                </div>
                <div>
                    <a href="{{ Storage::url($coordinador->acuerdo_nombramiento)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Acuerdo">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
            <div class="card-footer text-muted">
                <center><a  href="{{route('perfiles', $persona->usuario)}}" class="btn btn-primary">Perfil</a>
                <a  href="{{route('destituir_coor_sem', $id)}}" class="btn btn-danger">Destituir</a></center>
            </div>
        </div>

    @else

        <div class="text-center card">
            <div class="card-header">
                <br>
                <h4><mark>El Semillero {{ $semillero->nombre }} no tiene un coordinador</mark></h4>
                <br>
            </div>
            <div class="card-footer text-muted">
                <center>
                <a href="{{route('vencular_coor_sem', $id)}}" class="btn btn-success">Nombrar un Coordinador</a>
                </center>
            </div>
        </div>

    @endif

</div>

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
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
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