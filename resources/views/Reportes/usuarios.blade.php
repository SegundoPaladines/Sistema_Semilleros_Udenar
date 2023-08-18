<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Reporte de Usuarios</title>
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
          <h5>Listado de Usuarios</h5>
        </div>
      </center>
      <br>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th style="border: 1px solid black;}">#</th>
                  <th style="border: 1px solid black;}">id</th>
                  <th style="border: 1px solid black;}">Nombre</th>
                  <th style="border: 1px solid black;}">Rol</th>
                  <th style="border: 1px solid black;}">Correo</th>
              </tr>
          </thead>
          <tbody>
              @php $i = 1; @endphp
              @foreach($usuarios as $u)
                  <tr>
                      <td style="border: 1px solid black;}">{{$i}}</td>
                      <td style="border: 1px solid black;}"> {{$u->id}}</td>
                      <td style="border: 1px solid black;}">{{ $u->name }}</td>
                      <td style="border: 1px solid black;}"><span>{{ $u->getRoleNames()->first() }}</span></td>
                      <td style="border: 1px solid black;}"><a href="mailto:{{ $u->email }}">{{ $u->email }}</a></td>
                  </tr>
                  @php $i++; @endphp
              @endforeach
          </tbody>
      </table>
  </body>
</html>