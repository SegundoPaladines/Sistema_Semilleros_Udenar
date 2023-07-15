<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Semilleros</title>
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--Hojas de estilo y scripts porpios-->
    <script src="{{ asset('js/segundo/vista-bienvenida.js') }}"></script>
    <link href="{{ asset('css/segundo/vista-bienvenida.css') }}" rel="stylesheet">

    <!--Iconos de font answere-->
    <script src="https://kit.fontawesome.com/47c9cd5333.js" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <nav class="navbar navbar-custom">
            <div class="container" id="header">
              <a class="navbar-brand" href="{{ asset('https://www.udenar.edu.co/facultades/ingenieria/ingenieria-en-sistemas/') }}" target="_blank">
                <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="50" width="30" height="24">
              </a>
                @auth
                    <span id="nombre"> Bienvenido denuevo {{ auth()->user()->name }} </span>
                    <span> <a class="log-in-button" href="{{ route('home') }}">Home</a></span>
                @else
                    <a class="log-in-button" href="{{ route('login') }}">Log-In</a>
                @endauth
            </div>
          </nav>
    </header>
    <div  class="title-container">
        <section>
            <video src="{{ asset('src/videos/humo.mp4') }}" autoplay muted></video>
            <h2 class="titulo1">Departamento de</h2>
            <h1>
                <span>S</span>
                <span>I</span>
                <span>S</span>
                <span>T</span>
                <span>E</span>
                <span>M</span>
                <span>A</span>
                <span>S</span>
                <br>
                <span>U</span>
                <span>D</span>
                <span>E</span>
                <span>N</span>
                <span>A</span>
                <span>R</span>
            </h1>
            <h2 class="titulo2">Semilleros de Investigación</h2>
        </section>
    </div>
    
    <dialog id="vtn-login">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif 

        <center>
            <div id="logo" >
                <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="logo">
            </div>
        </center>
        <center>
            <div id="msg-bienvenida">
                <h1>Bienvenid@ al SSDSU</h1>
            </div>
        </center>
        <br>
        <br>

        <center>
            <div id="frm-login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div style="position: relative;">
                            <input class="input-frm" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Por favor Ingrese su E-mail..." />
                            <div id="texto-email" class="alert alert-warning alert-dismissible fade show" role="alert">
                                <table>
                                    <tr>
                                        <td>
                                            <i class="fas fa-exclamation-circle"></i>
                                        </td>
                                        <td>
                                            <span class="texto-email">Debe usar el correo institucional, con el que fue registrado en el sistema: ejemplo@udenar.edu.co</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div style="position: relative;">
                            <input class="input-frm" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Por favor Ingrese su Contraseña..." />
                            <button id="ver-contra" type="button" class="ver-contrasena">
                                <i id="icono-ver-contra" class="fas fa-eye"></i>
                            </button>
                            <div id="texto-pass" class="alert alert-warning alert-dismissible fade show" role="alert">
                                <table>
                                    <tr>
                                        <td>
                                            <i class="fas fa-exclamation-circle"></i>
                                        </td>
                                        <td>
                                            <span class="texto-email">Debe ingresar una contraseña</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="fmr-div">
                            <input type="checkbox" id="remember_me" name="remember" />
                            <span>Recuerdame</span>
                        </div>
                        <br>
                        <div class="fmr-div">
                            <button id="bt-login" class="btn-login" type="submit">Log-In</button>
                        </div>
                        <br>
                        @error('email')
                            <div id="error-login" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                Correo y/o Contraseña Incorrectos
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                        @enderror
                        <br>
                        <div class="fmr-div">
                            @if (Route::has('password.request'))
                                <a class="reset-passwd" href="{{ route('password.request') }}">¿Olvidó su Contraseña?</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </center>
    </dialog>

    @if(session()->has('openModal'))
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const loginModal = document.querySelector('#vtn-login');
                loginModal.showModal();
            });
        </script>
    @endif

    <footer class="pie-pg">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 
            <a class="text-white" href="https://www.udenar.edu.co/" target="blank">Udenar</a>
             2023
        </div>
    </footer>
</body>
</html>
