<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    // el director es una persona
    public function persona(){
        return $this->hasOne(Persona::class);
    }
}
