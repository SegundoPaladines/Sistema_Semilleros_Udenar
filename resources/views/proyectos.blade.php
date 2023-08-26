@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')

<div class="container">
    <div class="mb-3 note note-success">
        <figure class="text-center">
            <h1>Listado de Proyectos</h1>
        </figure>
    </div>
</div>

    
@stop

@section('content')
<div class="container">

    <center>

    <br>
    <ul class="list-unstyled">
        <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Bienvenido {{ $user->name }}</li>
    </ul>  
    <br>

    <br>
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
    <div class="tabla-container" style= "overflow-x: auto;">

        <table id= "tabla_usuarios" class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre del Proyecto</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tipo de Proyecto</th>
                    <th scope="col">Fecha inicio</th>
                    <th scope="col">Fecha Finalización</th>
                    
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
                        <td>{{$tipoOptions[$p->tipo_proyecto]}}</td>
                        <td>{{$p->feacha_inicio}}</td>
                        <td>{{$p->feacha_fin}}</td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>

    </div>    

    <script>

        //buscador
        document.addEventListener("DOMContentLoaded", function() {
            var filtroBusqueda = document.getElementById("buscador");

            filtroBusqueda.addEventListener("keyup", function() {
                var valorBusqueda = filtroBusqueda.value.toLowerCase();
                var filas = document.querySelectorAll("#tabla_usuarios tbody tr");

                filas.forEach(function(fila) {
                    var contenidoFila = fila.textContent.toLowerCase();
                    if (contenidoFila.indexOf(valorBusqueda) !== -1) {
                        fila.style.display = "table-row";
                    } else {
                        fila.style.display = "none";
                    }
                });
            });
        });

    </script>

</div>    
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
    <link href="{{ asset('css/segundo/general.css') }}" rel="stylesheet">
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