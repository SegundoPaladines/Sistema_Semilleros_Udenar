<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Participante_Pres extends Model
{
    //el participante va a una presentacion
    public function presentacion(){
        return $this->belongsTo(Presentacion::class);
    }

    //el participante es un integrante del proyecto
    public function integrante(){
        return $this->belongsTo(Integrante_Proy::class);
    }
}
