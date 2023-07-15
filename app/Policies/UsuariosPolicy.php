<?php

namespace App\Policies;

use App\Models\Director;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuariosPolicy
{
    use HandlesAuthorization;

    public function registrar(User $user, Director $director)
    {
        $autorization = false;
        if($user->email === 'admin@udenar.edu.co'){
            $autorization = true;
        }
        return $autorization;
    }
}
