<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function generarReporteUsuarios(){
        $usuarios = User::all();
        date_default_timezone_set('America/Bogota');
        $fechaActual = date("d-m-Y");
        $horaActual = date("h:i A");
        $fecha = $fechaActual.' | '.$horaActual;
        $pdf = Pdf::loadView('Reportes.usuarios', compact('usuarios', 'fecha'));
        return $pdf->stream('Reporte_Usuarios.pdf');
    }
}
