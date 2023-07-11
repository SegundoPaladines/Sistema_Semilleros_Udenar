<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //el evento tiene presentaciones
    public function presentaciones(){
        return $this->hasMany(Presentacion::class);
    }
}
