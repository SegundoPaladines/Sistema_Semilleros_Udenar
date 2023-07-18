<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Semillero;
use App\Models\Rol;

class SemilleroPolicy
{
    use HandlesAuthorization;

    public function coordinador(User $user, Semillero $semillero)
    {
        return true;
    }

    public function director(User $user, Rol $rol, Semillero $semillero)
    {
        $autorization = false;
        if($rol->name === 'admin'){
            $autorization = true;
        }
        return $autorization;
    }
}