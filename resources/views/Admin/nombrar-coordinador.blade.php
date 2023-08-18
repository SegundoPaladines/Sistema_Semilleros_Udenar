@extends('adminlte::page')

@section('title', 'Asignar Coordinador')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
            <h1>Escoger coordinador para el Semillero {{$semillero->nombre}}</h1>
        </figure>
    </div>
</div>

@stop

@section('content')
<div class="container">
    <center>
        <div id="contenedor-form">

            <br>
            <br>
            <div id="contenedor-buscador" class="input-group" style="flex-grow: 2; margin-right: 10px;">
                <div class="col-md-11" id="inp">
                    <input id="buscador" type="text" placeholder="Buscar Semilleros" style="width: 100%;">
                </div>
                <div id="ic">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <br>
            <br>
            
            <table id= "tabla_usuarios" class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col"> </th>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre de Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col"><center>Opciones</center></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach($candidatos as $c)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$c->id}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->email}}</td>
                            <td>
                                <center>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nombrarCoordinadorModal" data-candidato-id="{{$c->id}}">Nombrar</button>
                                <a href="{{ route('perfiles', $c->id) }}" class="btn btn-info">Ver Perfil</a>
                                </center>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>

            <br>
        </div>
    </center>
</div>
    <!-- Modal -->
    <div class="modal fade" id="nombrarCoordinadorModal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="nombrarCoordinadorModalLabel">Nombrar Coordinador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Formulario -->
            <form action="{{ route('nombrar_coor_sem', ['semillero_id' => $id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="candidato_id" id="candidato_id">
                <div class="mb-3">
                <label for="area_conocimiento" class="form-label">Área de Conocimiento</label>
                <input type="text" class="form-control" id="area_conocimiento" name="area_conocimiento" required>
                </div>
                <div class="mb-3">
                <label for="acuerdo_nombramiento" class="form-label">Acuerdo de Nombramiento (PDF, Word o Power Point)</label>
                <input type="file" class="form-control" id="acuerdo_nombramiento" name="acuerdo_nombramiento" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
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
    <!-- CSS propio -->
    <link rel="stylesheet" href="{{asset('css/segundo/listarusuarios.css')}}">
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/listarusuarios.js') }}"></script>
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
    <script src="{{ asset('js/segundo/nombrar-coor.js') }}"></script>
@stop