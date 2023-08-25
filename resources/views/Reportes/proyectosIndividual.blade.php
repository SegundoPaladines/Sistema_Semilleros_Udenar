<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Reporte de Proyecto</title>
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
          <h5>Proyecto</h5>
        </div>
      </center>
      <br>
      <table class="table table-bordered">
    <tbody>
        @php $i = 0; @endphp
        @foreach($proyectos as $p)
            @if($i % 4 === 0)
                <tr>
            @endif
            <td style="border: 1px solid black;">Código: {{$p->id_proyecto}}</td>
            <td colspan="2" style="border: 1px solid black;">Nombre: {{ $p->titulo }}</td>
            @if($i % 4 === 3)
          </tr>
          @endif
          @if($i % 4 === 0)
          <tr>
            @endif
            <td style="border: 1px solid black;">Semillero: {{ $nombre }}</td>
            <td style="border: 1px solid black;">Fecha Inicio: {{ $p->feacha_inicio }}</td>
            <td style="border: 1px solid black;">Fecha Fin: {{ $p->feacha_fin }}</td>
            @if($i % 4 === 3)
                </tr>
            @endif
            @if($i % 4 === 0)
                <tr>
            @endif
            <td style="border: 1px solid black;">Tipo: {{$tipoOptions[$p->tipo_proyecto]}}</td>
            <td colspan="2" style="border: 1px solid black;">Estado: {{$estadoOptions[$p->estado]}}</td>
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