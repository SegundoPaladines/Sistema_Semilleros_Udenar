@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <p>Bienvenido {{ $user->name }}</p>
    <br>
    <center>
        <div id="contenedor-form">
            <form method="POST" action="{{ route('editar_usr', $id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nombre de usuario -->
                        <div>
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{$usr_edit->name }}" />
                                <label class="form-label" for="nombre">Nombre de Usuario</label>
                            </div>
                        </div>
                        <!-- Email  -->
                        <div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="email" id="email" name="email" class="form-control" value="{{$usr_edit->email}}" />
                                <label class="form-label" for="email">Email</label>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <!-- Contraseña -->
                        <div>
                            @error('passwd1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-4 form-outline">
                                <input type="password" id="passwd1" name="passwd1" class="form-control"  placeholder="Escriba la nueva contraseña"/>
                                <label class="form-label" for="passwd1">Contraseña</label>
                            </div>
                        </div>
            
                        <!-- Repetir Contraseña -->
                       <div>
                        @error('passwd2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-4 form-outline">
                            <input type="password" id="passwd2" name="passwd2" class="form-control" placeholder="Repita la nueva contraseña"/>
                            <label class="form-label" for="passwd2">Repita la Contraseña</label>
                        </div>
                       </div>
                    </div>
                    <div class="mb-4 form-outline">
                        <label for="rol">Rol:</label>
                        <select id="rol" name="rol" class="form-select" aria-label="Default select example">
                            <option value="1" {{ $numRol == 1 ? 'selected' : '' }}>Semillerista</option>
                            <option value="2" {{ $numRol == 2 ? 'selected' : '' }}>Coordinador</option>
                            <option value="3" {{ $numRol == 3 ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('rol')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <!-- Boton Enviar -->
                <button type="submit" class="mb-3 btn btn-success btn-block">Guardar Cambios</button>
            </form>
        </div>
    </center>
    @if (session('registroExitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarAlertaRegistroExitoso();
            });
        </script>
    @endif

@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <!--CSS Propio-->
    <link rel="stylesheet" href="{{asset('css/segundo/reg_suarios.css')}}">
@endsection

@section('js')
    <!-- JQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!--Js Propio-->
    <script src="{{ asset('js/segundo/reg_suarios.js') }}"></script>
@stop