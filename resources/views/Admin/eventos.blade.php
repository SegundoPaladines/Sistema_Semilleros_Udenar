@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Listado de Eventos</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <table id="buscador-agregar">
            <tr>
                <td>
                    <div id="contenedor-buscador" class="input-group">
                        <div id="inp">
                            <input id ="buscador" type="text" placeholder="Buscar Eventos">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="btn-agregar">
                        <a href="{{route('vista_reg_eventos')}}" class="btn btn-success">Añadir eventos</a>
                    </div>
                </td>
            </tr>
        </table>    
    </center>
    <br>
    <table id= "tabla_eventos" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo Evento</th>
                <th scope="col">Nombre de Evento</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Fecha de Finalización</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($eventos as $e)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$e->codigo_evento}}</td>
                    <td>{{$e->nombre}}</td>
                    <td>{{$e->fecha_inicio}}</td>
                    <td>{{$e->fecha_fin}}</td>
                    <td>
                        <a href="{{route('edit_eventos', $e->codigo_evento)}}" class="btn btn-primary">Editar</a>
                        <a href="{{route('delete_evento', $e->codigo_evento)}}" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/listarSemilleros.css')}}">
    
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/listarEventos.js') }}"></script>
@stop