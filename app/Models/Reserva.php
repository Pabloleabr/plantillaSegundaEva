<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    public function vuelo(){
        return $this->belongsTo(Vuelo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
