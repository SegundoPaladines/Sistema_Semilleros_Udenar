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
    <script src="{{ asset('js/segundo/about.js') }}"></script>
    <link href="{{ asset('css/segundo/vista-bienvenida.css') }}" rel="stylesheet">
    <link href="{{ asset('css/segundo/about.css') }}" rel="stylesheet">

    <!--Iconos de font answere-->
    <script src="https://kit.fontawesome.com/47c9cd5333.js" crossorigin="anonymous"></script>

</head>
<body style="background-color:black">
    <header>
        <nav class="navbar navbar-custom">
            <div class="container" id="header">
                <div class="logo-container">
                    <a class="navbar-brand" href="{{ asset('https://www.udenar.edu.co/facultades/ingenieria/ingenieria-en-sistemas/') }}" target="_blank">
                        <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="50" width="30" height="24">
                    </a>
                    @auth
                        <span id="nombre">Bienvenido {{ auth()->user()->name }} </span>
                    @endauth
                </div>
                <div class="links-container">
                    <a class="log-in-button" href="{{ route('welcome') }}">Bienvenida</a></span>
                    @auth
                        <a class="log-in-button" href="{{ route('home') }}">Home</a>
                    @else
                        <a class="log-in-button" href="{{ route('dev_login') }}">Log-In</a>
                    @endauth
                </div>
            </div>
          </nav>
    </header>
    <section class="p-container">
        <center><h1 class="titulo" >Equipo de Desarrollo</h1></center>
        <div class="contenedor-cartas">
            <div class="carta">
                <div class="contenido">
                    <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                    <img class="perfil-img" src="{{asset('src/img/Developers/segundo.jpg')}}">
                    <h1>Segundo Paladines</h1>
                    <p class="trabajo">DESARROLLADOR</p>
                    <p class="descripcion">
                        Departamento de Sistemas <br>
                        Facultad de Ingeniería <br>
                        Universidad de Nariño <br>
                    </p>
                </div>
                <div class="links">
                    <a href="https://github.com/SegundoPaladines"  target="_blank"><i class="fa fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/segundo-paladines-ortiz-b60216257"  target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100010282954088"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/channel/UC0lBAjv2RCj8z--bKu2UAew"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                    <a href="https://wa.me/573147856561"  target="_blank"><i class="fa fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="carta">
                <div class="contenido">
                    <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                    <img class="perfil-img" src="{{asset('src/img/Developers/juan_camilo.jpg')}}">
                    <h1>Juan Insuasty</h1>
                    <p class="trabajo">DESARROLLADOR</p>
                    <p class="descripcion">
                        Departamento de Sistemas <br>
                        Facultad de Ingeniería <br>
                        Universidad de Nariño <br>
                    </p>
                </div>
                <div class="links">
                    <a href="#"  target="_blank"><i class="fa fa-github"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="#"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
            <div class="carta">
                <div class="contenido">
                    <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                    <img class="perfil-img" src="{{asset('src/img/Developers/david.jpg')}}">
                    <h1>David Criollo</h1>
                    <p class="trabajo">DESARROLLADOR</p>
                    <p class="descripcion">
                        Departamento de Sistemas <br>
                        Facultad de Ingeniería <br>
                        Universidad de Nariño <br>
                    </p>
                </div>
                <div class="links">
                    <a href="#"  target="_blank"><i class="fa fa-github"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="#"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
            <div class="carta">
                <div class="contenido">
                    <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                    <img class="perfil-img" src="{{asset('src/img/Developers/segundo.jpg')}}">
                    <h1>Dana Criollo</h1>
                    <p class="trabajo">DESARROLLADORA</p>
                    <p class="descripcion">
                        Departamento de Sistemas <br>
                        Facultad de Ingeniería <br>
                        Universidad de Nariño <br>
                    </p>
                </div>
                <div class="links">
                    <a href="#"  target="_blank"><i class="fa fa-github"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="#"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
    </section>

    <footer class="pie-pg">
        <div class="p-3 text-center" style="background-color: rgba(0, 0, 0, 0.2);">
            © 
            <a class="text-white" href="https://www.udenar.edu.co/" target="blank">Udenar</a>
             2023
        </div>
    </footer>
    
    <dialog id="vtn-login">
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
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
</body>
</html>