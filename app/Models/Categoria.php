<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function tag18categoria(){
        return $this->hasMany(Tag18::class, 'id');
        /* un categoria tiene muchas tags */
    }
}
