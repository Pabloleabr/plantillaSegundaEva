<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestada extends Model
{
    use HasFactory;

    public function pelicula(){
        return $this->belongsTo(Pelicula::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
