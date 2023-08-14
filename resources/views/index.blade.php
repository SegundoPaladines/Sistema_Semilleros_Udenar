@extends('adminlte::page')

@section('title', 'Semilleros Sistemas Udenar')

@section('content_header')

    <div class="container">
        <div class="note note-success mb-3">
            <figure class="text-center">
                <h1>Sistema de Semilleros</h1>
            </figure>
        </div>
        <center>
        <br>
        <ul class="list-unstyled">
            <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i>Bienvenido {{ $user->name }}</li>
        </ul>  
        <br>
        </center>
    </div>
@stop

@section('content')
    <!-- <p>Bienvenido {{ $user->name }}</p> -->
@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--Css Propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@stop

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
@stop