<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Reporte de Eventos</title>
  </head>
  <body>
      <div class="encabezado">
        <table width="100%">
          <tr>
            <td widht="10%">
              <img src="{{ public_path().'/vendor/adminlte/dist/img/logo.png' }}">
            </td>
            <td width="90%">
              <div style="padding-left: 5%;">
                <br>
                <h4>Departamento de Sistemas</h4>
                <p>Universidad de Nariño <br>
                  San Juan de Pasto - Colombia  
                </p>
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td style="text-align: right;">
              <i style="font-size: 12px">Fecha y Hora de Expedición: {{$fecha}}</i>
            </td>
          </tr>
        </table>
        <br>
      </div>
      <center>
        <div style="border-top:1px solid black; border-bottom: 1px solid black;">
          <h5>Listado de Eventos</h5>
        </div>
      </center>
      <br>
      <table class="table table-bordered">
    <table class="table table-bordered">
          <thead>
              <tr>
                  <th style="border: 1px solid black;}">#</th>
                  <th style="border: 1px solid black;}">Id</th>
                  <th style="border: 1px solid black;}">Nombre</th>
                  <th style="border: 1px solid black;}">Descripción</th>
                  <th style="border: 1px solid black;}">Fecha Inicio</th>
                  <th style="border: 1px solid black;}">Fecha Finalización</th>
                  <th style="border: 1px solid black;}">Lugar</th>
                  <th style="border: 1px solid black;}">Tipo</th>
                  <th style="border: 1px solid black;}">Modalidad</th>
                  <th style="border: 1px solid black;}">Clasificación</th>
              </tr>
          </thead>
          <tbody>
              @php $i = 1; @endphp
              @foreach($eventos as $e)
                  <tr>
                      <td style="border: 1px solid black;}">{{$i}}</td>
                      <td style="border: 1px solid black;}"> {{$e->codigo_evento}}</td>
                      <td style="border: 1px solid black;}">{{ $e->nombre }}</td>
                      <td style="border: 1px solid black;}">{{ $e->descripcion }}</td>
                      <td style="border: 1px solid black;}">{{ $e->fecha_inicio }}</td>
                      <td style="border: 1px solid black;}">{{ $e->fecha_fin }}</td>
                      <td style="border: 1px solid black;}">{{ $e->lugar }}</td>
                      <td style="border: 1px solid black;}">{{$tipoOptions[$e->tipo]}}</td>
                      <td style="border: 1px solid black;}">{{$modalidadOptions[$e->modalidad]}}</td>
                      <td style="border: 1px solid black;}">{{$clasificacionOptions[$e->clasificacion]}}</td>
                  </tr>
                  @php $i++; @endphp
              @endforeach
          </tbody>
      </table>

  </body>
</html>