@extends('adminlte::page')

@section('title', 'Semilleros')

@section('content_header')
    <h1>Listado de Semilleros</h1>
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
                            <input id ="buscador" type="text" placeholder="Buscar Semilleros">
                        </div>
                        <div id="ic">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="btn-agregar">
                        <a href="{{route('agregar_semilleros')}}" class="btn btn-success">Añadir Semilleros</a>
                    </div>
                </td>
            </tr>
        </table>    
    </center>
    <br>

    @foreach($semilleros as $s)
        <section>
            <div class="container">
               <div class="row">
                    <div class="col"><center><h1><td>{{$s->nombre}}</td></h1></center></div>
                    <div class="col">
                        <a  class="btn btn-primary">Actualizar</a>
                        <a  class="btn btn-info">Participantes</a>
                        <a  class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
                <hr><br>
                <div class="row">
                    <div class="col">
                        <div class="bg-image hover-overlay">
                            <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/053.webp" class="w-100" />
                            <div
                                class="mask"
                                style="
                                background: linear-gradient(
                                    45deg,
                                    hsla(168, 85%, 52%, 0.5),
                                    hsla(263, 88%, 45%, 0.5) 100%
                                );
                                "
                            ></div>
                        </div>
                    </div>
                    <div class="col">
                        <p>{{$s->descripcion}}</p>
                    </div>
                </div>
            </div>
            <br>
        </section>
        <br>
        <br>
    @endforeach
    
@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/listarsemilleros.css')}}">
    
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/listarsemilleros.js') }}"></script>
@stop