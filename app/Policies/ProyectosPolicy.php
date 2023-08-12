<?php

namespace App\Policies;

use App\Models\Rol;
use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProyectosPolicy
{
    public function director(User $user, Rol $rol, Proyecto $proyecto){
        $autorization = false;
        if($rol->name === 'admin'){
            $autorization = true;
        }
        return $autorization;
    }

    public function coordinador(User $user, Rol $rol, Proyecto $proyecto){
        $autorization = false;
        if($rol->name === 'coordinador'){
            $autorization = true;
        }
        return $autorization;
    }

    public function semillerista(User $user, Rol $rol, Proyecto $proyecto){
        $autorization = false;
        if($rol->name === 'semillerista'){
            $autorization = true;
        }
        return $autorization;
    }

    
}
