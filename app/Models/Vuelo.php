<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;

    public function companyia(){
        return $this->belongsTo(Companyia::class);
    }

    public function aeropuerto_de_origen(){
        return $this->belongsTo(Aeropuerto::class, 'aeropuerto_origen');
    }
    public function aeropuerto_de_destino(){
        return $this->belongsTo(Aeropuerto::class, 'aeropuerto_destino');
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}
