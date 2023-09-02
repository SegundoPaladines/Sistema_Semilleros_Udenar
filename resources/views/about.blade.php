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
    <link href="{{ asset('css/segundo/about.css') }}" rel="stylesheet">
    <!--Iconos de font answere-->
    <script src="https://kit.fontawesome.com/47c9cd5333.js" crossorigin="anonymous"></script>

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!--JS propio-->
    <script src="{{ asset('js/segundo/about.js') }}"></script>

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
   <div id="t-cont">
        <section class="p-container">
            <center><h1 class="titulo" >Equipo de Desarrollo</h1></center>
            <br>
            <div class="contenedor-cartas">
                <div class="carta">
                    <div class="contenido">
                        <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                        <img class="perfil-img" src="{{asset('src/img/Developers/segundo.png')}}">
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
                        <a href="https://github.com/juancig01"  target="_blank"><i class="fa fa-github"></i></a>
                        <a href="https://www.facebook.com/juankmilo.insuasty"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a id="insta-j" href="https://www.instagram.com/juanc__cmx/"  target="_blank"><i class="fa fa-instagram"></i></a>
                        <a id="insta-j" href="https://www.youtube.com/channel/UCLln8gUHErtBGw3ghKOXC9w"  target="_blank"><i class="fa fa-youtube-play"></i></a>
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
                        <a href="https://github.com/diulioz"  target="_blank"><i class="fa fa-github"></i></a>
                        <a id="insta-j" href="https://www.youtube.com/channel/UCl2-w3n4Mgu9JMw6l8nY-_w"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                        <a href="mailto:davidcriollo@udenar.edu.co"><i class="fa fa-envelope-o"></i></a>
                    </div>
                </div>
                <div class="carta">
                    <div class="contenido">
                        <img class="fondo-img" src="{{asset('src/img/Developers/fondo.png')}}">
                        <img class="perfil-img" src="{{asset('src/img/Developers/dana.jpeg')}}">
                        <h1>Dana Criollo</h1>
                        <p class="trabajo">DESARROLLADORA</p>
                        <p class="descripcion">
                            Departamento de Sistemas <br>
                            Facultad de Ingeniería <br>
                            Universidad de Nariño <br>
                        </p>
                    </div>
                    <div class="links">
                        <a href="https://github.com/DanaCriolloLopez"  target="_blank"><i class="fa fa-github"></i></a>
                        <a href="mailto:dana.criollo@udenar.edu.co"  target="_blank"><i class="fa fa-envelope-o"></i></a>
                        <a href="https://www.facebook.com/dana.criollo"  target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/channel/UCucgO2oe-2IkymgOiUg0O_Q"  target="_blank"><i class="fa fa-youtube-play"></i></a>
                        <a id="insta-j" href="https://instagram.com/dana__crl?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D"  target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
        </section>
        <br>
        <div class="luces-verdes"></div>
        <section>
            <div class="container">
                <h1 class="titulo2" >Sobre Nosotros</h1>
                <div class="row">
                    <div class="col">
                        <p class="text">
                            Cada uno de los miembros del equipo de trabajo posee conocimientos que incluyen entre otras cosas a Git y GitHub para el control
                            de versiones, Laravel como framework para desarrollo de diferentes tipos de aplicativo web,
                            CSS, blade y HTML para la generación del contenido, junto con JS para el Font-end y PHP para 
                            el trabajo en Back-end. 
                        </p>
                    </div>
                    <div id="tag" class="col">
                    </div>
                </div>
            </div>
        </section>
   </div>

    <footer class="pg-pie">
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