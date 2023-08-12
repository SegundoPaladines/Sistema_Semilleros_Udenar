<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //busco proyecto por id
    protected $primaryKey = 'id_proyecto';
    //el proyecto pertenece a un semillero
    public function semillero(){
        return $this->belongsTo(Semillero::class);
    }

    //el proyecto tiene participantes
    public function integrantes(){
        return $this->hasMany(Integrante_Proy::class);
    }

    //el proyecto puede haber sido presentado
    public function presentacion(){
        return $this->belongsToMany(Presentacion::class);
    }
}
