<?php

namespace App\Policies;

use App\Models\Rol;
use App\Models\User;
use App\Models\Evento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventosPolicy
{
    public function director(User $user, Rol $rol, Evento $evento)
    {
        $autorization = false;
        if($rol->name === 'admin'){
            $autorization = true;
        }
        return $autorization;
    }
}
