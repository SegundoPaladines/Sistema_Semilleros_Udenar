<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Semilleros</title>
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <!--Hojas de estilo y scripts porpios-->
    <script src="{{ asset('js/segundo/vista-bienvenida.js') }}"></script>
    <link href="{{ asset('css/segundo/vista-bienvenida.css') }}" rel="stylesheet">

</head>
<header>
    <nav class="navbar navbar-custom">
        <div class="container" id="header">
          <a class="navbar-brand" href="{{ asset('https://www.udenar.edu.co/facultades/ingenieria/ingenieria-en-sistemas/') }}" target="_blank">
            <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="50" width="30" height="24">
          </a>
          <a class="log-in-button" href="{{ asset('/login') }}">Log-In</a>
        </div>
      </nav>
</header>
<body>
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
</body>
<footer class="pie-pg">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 
        <a class="text-white" href="https://www.udenar.edu.co/" target="blank">Udenar</a>
         2023
    </div>
  </footer>
</html>
