<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Integrante_Proy extends Model
{
    protected $table = 'integrantes_proy';
    //el participante es de un proyecto
    public function proyecto(){
        return $this->belongsTo(Proyecto::class);
    }

    //el participante es un semillerista
    public function semillerista(){
        return $this->hasOne(Semillerista::class);
    }

    //el integrante puede presentarse a una presentacion
    public function participante(){
        return $this->hasMany(Participante_Pres::class);
    }
}
