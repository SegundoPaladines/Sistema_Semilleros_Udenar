<?php

namespace App\Http\Controllers\Semillerista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Rol;
use App\Models\Proyecto;

class SemilleristaController extends Controller
{
    public function listarProyectos()
    {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('semillerista.proyectos', $rol, new Proyecto());
    
        $proyectos = Proyecto::all();
    
        return view('proyectos', compact('proyectos', 'user'));
    }
}
