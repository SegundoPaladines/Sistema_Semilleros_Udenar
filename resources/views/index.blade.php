@extends('adminlte::page')

@section('title', 'Coordinador')

@section('content_header')
    <h1>Sistema de Semilleros</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop