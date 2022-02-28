<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestadaRequest;
use App\Http\Requests\UpdatePrestadaRequest;
use App\Models\Pelicula;
use App\Models\Prestada;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PrestadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orden = $this->orden();

        return view('peliculas.peliculas',[
            'peliculas' => Pelicula::OrderBy($orden)->get()
        ]);
    }

    private function orden(){
        $orden = request()->query('orden') ?: 'id';
        abort_unless(in_array($orden, ['id', 'nombre', 'precio', 'cantidad', 'duracion']), 404);
        return $orden;
    }

    public function reservaUser(){
        $user = Auth::user();

        $alquiladas = Prestada::where('user_id' , $user->id);

        return view('peliculas.alquiladas', [
            'prestadas' => $alquiladas->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrestadaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pelicula $pelicula)
    {

        abort_unless($pelicula->cantidad > 0, 404);
        $prestada = new Prestada();
        $prestada->user_id = Auth::user()->id;
        $prestada->pelicula_id = $pelicula->id;
        $prestada->created_at = Carbon::now();
        $pelicula->cantidad -= 1;
        $pelicula->save();
        $prestada->save();
        return redirect()->route('peliculasAlquiladas');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestada  $prestada
     * @return \Illuminate\Http\Response
     */
    public function show(Prestada $prestada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestada  $prestada
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestada $prestada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrestadaRequest  $request
     * @param  \App\Models\Prestada  $prestada
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrestadaRequest $request, Prestada $prestada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestada  $prestada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestada $prestada)
    {
        //
    }
}
