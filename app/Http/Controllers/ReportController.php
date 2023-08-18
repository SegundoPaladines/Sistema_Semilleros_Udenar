<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Semillero;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ReportController extends Controller
{
    public function generarReporteUsuarios(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $usuarios = User::all();
        date_default_timezone_set('America/Bogota');
        $fechaActual = date("d-m-Y");
        $horaActual = date("h:i A");
        $fecha = $fechaActual.' | '.$horaActual;
        $pdf = Pdf::loadView('Reportes.usuarios', compact('usuarios', 'fecha'));
        return $pdf->stream('Reporte_Usuarios.pdf');
    }
    public function generarReporteSemillero_admin($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        date_default_timezone_set('America/Bogota');
        $fechaActual = date("d-m-Y");
        $horaActual = date("h:i A");
        $fecha = $fechaActual.' | '.$horaActual;

        $semillero = Semillero::where('id_semillero', $id)->first();

        if($semillero !== null){
            $logo = $semillero->logo;
            $foto = '';
            if($logo !== null){
                $foto= public_path().Storage::url($logo);
            }else{
                $foto = public_path().'/vendor/adminlte/dist/img/logo.png';
            }
            
            $pdf = Pdf::loadView('Reportes.semillero', compact('semillero', 'fecha', 'foto'));
            return $pdf->stream('Reporte_Semillero.pdf');
        }else{
            return redirect('home');
        }
    }
}
