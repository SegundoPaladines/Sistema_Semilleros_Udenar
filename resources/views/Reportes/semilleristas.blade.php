<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Reporte de Semilleristas del semillero {{$semillero->nombre}}</title>
  </head>
  <body>
    <div class="encabezado">
      <table width="100%">
        <tr>
          <td widht="10%">
            <img src="{{ $foto }}" style="max-width: 150px;">
          </td>
          <td width="90%">
            <div style="padding-left: 5%;">
              <br>
              <h4>{{$semillero->nombre}}</h4>
              <p>Departamento de Sistemas <br>
                 Universidad de Nariño <br>
                {{$semillero->sede}} - Colombia  
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
        <h5>Listado de Semilleristas</h5>
      </div>
    </center>
    <br>
    <table class="table table-bordered">
      <thead>
          <tr>
              <th style="border: 1px solid black;}">#</th>
              <th style="border: 1px solid black;}">Codigo Estudiante</th>
              <th style="border: 1px solid black;}">Nombre</th>
              <th style="border: 1px solid black;}">Semestre</th>
              <th style="border: 1px solid black;}">Fecha Vinculacion</th>
          </tr>
      </thead>
      <tbody>
          @php $i = 1; @endphp
          @foreach($semilleristas as $s)
              <tr>
                  <td style="border: 1px solid black;}">{{$i}}</td>
                  <td style="border: 1px solid black;}"> {{$s->cod_estudiante}}</td>
                  <td style="border: 1px solid black;}"> {{app('App\Http\Controllers\Coordinador\CoordinadorController')->obtenerNombrePersona($s->num_identificacion)}}</td>
                  <td style="border: 1px solid black;}">{{ $s->semestre }}</td>
                  <td style="border: 1px solid black;}"><span>{{ $s->fecha_vinculacion }}</span></td>
              </tr>
              @php $i++; @endphp
          @endforeach
      </tbody>
  </table>
  </body>
</html>