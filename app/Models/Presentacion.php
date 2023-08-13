<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $table = 'presentaciones';
    //la presentacion perteneces a un evento
    public function evento(){
        return $this->belongsTo(Evento::class);
    }

    //la presentacion tiene participantes
    public function participantes(){
        return $this->hasMany(Participante_Pres::class);
    }

    //la presentacion tiene un proyecto
    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }
}
