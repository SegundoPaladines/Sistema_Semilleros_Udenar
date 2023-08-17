<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //relacion uno a uno de vuelta con persona
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function adminlte_image(){
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();
        if($persona !== null){
            $foto = $persona->foto;
            if($foto !== null){
                $foto= Storage::url($persona->foto);
                return $foto;
            }else{
                return 'https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png';
            }
        }else{
            return 'https://distrimar.s3.amazonaws.com/static/apm/img/misc/default_user.png';
        }
    }
    public function adminlte_desc(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = '';
        if($nombre_rol == 'admin'){
            $rol='Administrador';
        }else if($nombre_rol == 'coordinador'){
            $rol='Coordinador';
        }else if($nombre_rol == 'semillerista'){
            $rol='Semillerista';
        }
        return $rol;
    }
    public function adminlte_profile_url(){
        return 'perfil';
    }
}
