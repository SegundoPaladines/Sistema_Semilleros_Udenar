<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    // el coordinador es una persona
    public function persona(){
        return $this->hasOne(Persona::class);
    }

    //el coordinador es solo de un solo semillero
    public function semillero(){
        return $this->belongsTo(Semillero::class);
    }
}
