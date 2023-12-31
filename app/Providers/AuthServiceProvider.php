<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Semillero' => 'App\Policies\SemilleroPolicy',
        'App\Models\Rol' => 'App\Policies\UsuariosPolicy',
        'App\Models\Evento' => 'App\Policies\EventosPolicy',
        'App\Models\Proyecto' => 'App\Policies\ProyectosPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(GateContract $gate): void
    {
        $this->registerPolicies($gate);
    }
}
