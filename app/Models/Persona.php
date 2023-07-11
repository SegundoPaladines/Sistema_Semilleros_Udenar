<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //la persona tiene un usuario
    public function usuario(){
        return $this->HasOne(User::class);
    }

    //la persona puede ser un semillerista, director o coordinador
    public function semillerista(){
        return $this->belongsTo(Semillerista::class);
    }
    
    public function director(){
        return $this->belongsTo(Director::class);
    }

    public function coordinador(){
        return $this->belongsTo(Coordinador::class);
    }
}
