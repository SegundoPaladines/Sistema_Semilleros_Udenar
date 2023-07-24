<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Coordinador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoordinadorController extends Controller
{
    public function index()
    {
        $semillero = new Semillero();
        $this->authorize('coordinador', $semillero);

        return view('Coordinador.index');
    }
}
