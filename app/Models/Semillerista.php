<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semillerista extends Model
{
    // el semillerista es una persona
    public function persona(){
        return $this->hasOne(Persona::class);
    }

    //el semillerista pertenece a un semillero
    public function semillero(){
        return $this->belongsTo(Semillero::class);
    }

    //semillerista es un integrante de un proyecto
    public function integrante(){
        return $this->belongsTo(Integrante_Proy::class);
    }
}
