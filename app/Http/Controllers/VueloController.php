<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use Illuminate\Http\Request;

class VueloController extends Controller
{
    public function index(){

        $orden = request()->query('orden') ?: 'id';
        $titulos =  array_keys(Vuelo::find(1)->toArray());
        //comprueo que existe el campo
        if(!in_array($orden, $titulos)){
            return redirect()->route('vuelo')->with('error','no se puede ordenar por ese campo');
        }

        return view('vuelos',[
            'vuelos' => Vuelo::with(
                ['companyia',
                'aeropuerto_de_origen',
                'aeropuerto_de_destino'])
                ->orderBy($orden)
                ->paginate(2)
            ]);
    }
}
