<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>{{$semillero->nombre}}</title>
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
        <div style="border-top:1px solid black;">
          <br>
          <h5>Datos del Semillero de Investigación {{$semillero->nombre}}</h5>
          <i style="font-size: 12px">{{$semillero->descripcion}}</i>
          <p><a href="{{ Storage::url($semillero->resolucion)}}" target="_blank">Resolución No. {{$semillero->num_res}}</a></p>
        </div>
      </center>
      <br>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th style="border: 1px solid black;}">Sede</th>
                  <th style="border: 1px solid black;}">Nombre</th>
                  <th style="border: 1px solid black;}">Correo</th>
                  <th style="border: 1px solid black;}">Facha de Creación</th>
              </tr>
            </thead>
          <tbody>
              <tr>
                <td style="border: 1px solid black;}">{{$semillero->sede}}</td>
                <td style="border: 1px solid black;}">{{$semillero->nombre}}</td>
                <td style="border: 1px solid black;}"><a href="mailto:{{$semillero->correo}}">{{$semillero->correo}}</a></td>
                <td style="border: 1px solid black;}">{{$semillero->fecha_creacion}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div>
      <h5>Presentación</h5>
      <p>{{$semillero->presentacion}}</p>
    </div>
    <br>
    <div>
      <h5>Misión</h5>
      <p>{{$semillero->mision}}</p>
    </div>
    <br>
    <div>
      <h5>Visión</h5>
      <p>{{$semillero->vision}}</p>
    </div>
    <br>
    <div>
      <h5>Valores</h5>
      <p>{{$semillero->valores}}</p>
    </div>
    <br>
    <div>
      <h5>Objetivos</h5>
      <p>{{$semillero->objetivos}}</p>
    </div>
    <br>
    <div>
      <h5>Lineas de Investigación</h5>
      <p>{{$semillero->lineas_inv}}</p>
    </div>
  </body>
</html>