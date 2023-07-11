<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Semillero;

class SemilleroPolicy
{
    use HandlesAuthorization;

    public function coordinador(User $user, Semillero $semillero)
    {
        return false;
    }
}