<?php

namespace App\Policies;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuariosPolicy
{
    use HandlesAuthorization;

    public function director(User $user, Rol $rol){
        $autorization = false;
        if($rol->name === 'admin'){
            $autorization = true;
        }
        return $autorization;
    }
    public function coordinador(User $user, Rol $rol){
        $autorization = false;
        if($rol->name === 'coordinador'){
            $autorization = true;
        }
        return $autorization;
    }
}
