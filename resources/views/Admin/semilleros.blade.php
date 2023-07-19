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
    <hr>
    <hr>
    <br>
    @foreach($semilleros as $s)
        <section>
            <div class="container">
               <div class="row">
                    <div class="col">
                        <center><h1>{{$s->nombre}}</h1></center></div> <br>
                        <center><p><span style="font-size: small; font-style: italic;">{{$s->descripcion}}</span></p><br></center>
                        <center><p><span style="font-size: small; font-style: italic;"><strong>Sede:</strong>  {{$s->sede}}, Fundado en: {{$s->fecha_creacion}} según <a href="{{ Storage::url($s->resolucion)}}" target="_blank">Resolución {{$s->num_res}}</a></span></p></center>
                        <center><p><span style="font-size: small; font-style: italic;"><strong>Contacto:</strong>  {{$s->correo}}</span></p></center>
                    </div>
                </div>
                <div class="row">
                    <center>
                        <a href="{{ Storage::url($s->resolucion)}}" target="_blank" style="background-color: #6caa84;" class="btn btn-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Resolución">
                            <i class="fas fa-download"></i>
                        </a>
                    </center>
                </div><br>
                <div class="row">
                    <center>
                        <div class="col">
                            <a  class="btn btn-primary">Actualizar</a>
                            <a  class="btn btn-info">Participantes</a>
                            <a  class="btn btn-danger">Eliminar</a>
                        </div>
                    </center>
                </div>
                <hr><br>
                <div class="row">
                    <div class="col">
                        <div class="bg-image hover-overlay">
                            <img src="{{ Storage::url($s->logo)}}" class="w-100" />
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
                        <div>
                            <h4>Presentación</h4>
                            <p>{{$s->presentacion}}</p>
                        </div><br>
                        <div>
                            <h4>Objetivos</h4>
                            <p>{{$s->objetivos}}</p>
                        </div><br>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <div>
                            <h4>Misión</h4>
                            <p>{{$s->mision}}</p>
                        </div><br>
                    </div>
                    <div class="col">
                        <div>
                            <h4>Visión</h4>
                            <p>{{$s->vision}}</p>
                        </div><br>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <h4>Lineas de Investigación</h4>
                        <p>{{$s->lineas_inv}}</p>
                    </div><br>
                </div><br>
                <div class="row">
                    <div>
                        <h4>Valores</h4>
                        <p>{{$s->valores}}</p>
                    </div><br>
                </div>
            </div>
            <br>
        </section>
        <hr>
        <hr>
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