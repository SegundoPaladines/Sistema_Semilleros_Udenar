<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    //el semilerro tiene varios semilleristas
    public function semilleristas(){
        return $this->hasMany(Semillerista::class);
    }

    //el semillero tiene proyectos
    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }

    //el semillero tiene coordinador
    public function coordinador(){
        return $this->hasOne(Coordinador::class);
    }
}