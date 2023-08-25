<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Reporte de Evento</title>
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
          <h5>Evento</h5>
        </div>
      </center>
      <br>
      <table class="table table-bordered">
      <table class="table table-bordered">
    <tbody>
        @php $i = 0; @endphp
        @foreach($eventos as $e)
            @if($i % 4 === 0)
                <tr>
            @endif
            <td style="border: 1px solid black;">Código: {{$e->codigo_evento}}</td>
            <td colspan="2" style="border: 1px solid black;">Nombre: {{ $e->nombre }}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @if($i % 4 === 0)
                <tr>
            @endif
            <td style="border: 1px solid black;">Fecha Inicio: {{ $e->fecha_inicio }}</td>
            <td style="border: 1px solid black;">Fecha Fin: {{ $e->fecha_fin }}</td>
            <td style="border: 1px solid black;">Lugar: {{ $e->lugar }}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @if($i % 4 === 0)
                <tr>
            @endif
            <td style="border: 1px solid black;">Tipo: {{$tipoOptions[$e->tipo]}}</td>
            <td style="border: 1px solid black;">Modalidad: {{$modalidadOptions[$e->modalidad]}}</td>
            <td style="border: 1px solid black;">Clasificación: {{$clasificacionOptions[$e->clasificacion]}}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @if($i % 4 === 0)
                <tr>
            @endif
            <td colspan="3" style="border: 1px solid black;">Descripción: {{ $e->descripcion }}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @if($i % 4 === 0)
                <tr>
            @endif
            <td colspan="3" style="border: 1px solid black;">Observaciones: {{ $e->observaciones }}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @php $i++; @endphp
        @endforeach
        @if($i % 4 !== 0)
            </tr>
        @endif
    </tbody>
</table>


  </body>
</html>