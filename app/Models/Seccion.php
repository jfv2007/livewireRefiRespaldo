<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    public function tag18seccion(){
        return $this->hasMany(Tag18::class, 'id');
        /* una seccion tiene muchos tags */
    }
    
}
