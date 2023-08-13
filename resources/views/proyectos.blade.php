@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
    <h1>Listado de Proyectos</h1>
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
                            <input id ="buscador" type="text" placeholder="Buscar proyecto">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
            </tr>
        </table>    
    </center>
    <br>
    <table id= "tabla_usuarios" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre del Proyecto</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo de Proyecto</th>
                <th scope="col">Fecha inicio</th>
                <th scope="col">Fecha Finalización</th>
                <th scope="col">Propuesta</th>
                <th scope="col">Proyecto Final</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($proyectos as $p)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$p->id_proyecto}}</td>
                    <td>{{$p->titulo}}</td>
                    <td>{{$estadoOptions[$p->estado]}}</td>
                    <td>{{$estadoOptions[$p->tipo_proyecto]}}</td>
                    <td>{{$p->feacha_inicio}}</td>
                    <td>{{$p->feacha_fin}}</td>
                    <td><a href="{{ asset($p->arc_propuesta) }}" target="_blank">Descargar PDF</a></td>
                    <td><a href="{{ asset($p->arc_adjunto) }}" target="_blank">Descargar PDF</a></td>
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
    <link rel="stylesheet" href="{{asset('css/segundo/listarusuarios.css')}}">
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/juan/listarProyectos.js') }}"></script>
    <script src="{{ asset('js/juan/alert.js') }}"></script>
@stop