<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function registrarUsuarios(){
        $director = new Director();
        $this->authorize('registrar', $director);
        return view('auth.register');
    }
}
