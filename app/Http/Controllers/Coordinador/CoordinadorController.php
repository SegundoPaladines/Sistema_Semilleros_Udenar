<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Coordinador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class CoordinadorController extends Controller
{
    public function index()
    {
        $semillero = new Semillero();
        $this->authorize('coordinador', $semillero);

        return view('Coordinador.index');
    }

    public function editarSemillero($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol);        
        $semillero = Semillero::findOrFail($id);
        return view('Coordinador.editarSemillero', ['id_semillero'=>$id, 'semillero' => $semillero, 'user' => $user]);
    }
}
