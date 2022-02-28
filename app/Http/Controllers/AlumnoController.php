<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Models\Alumno;
use App\Models\Ccee;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::all();
        $orden = request()->query('orden') ?: 'id';
        $titulos =  array_keys($alumnos->toArray()[0]);
        //comprueo que existe el campo
        abort_unless(in_array($orden, $titulos), 404);

        $alumnos= Alumno::orderBy($orden);

        //para buscar
        if(($var = request()->query('id')) !== null){
            $alumnos->where('id', '=', "$var");
        }
        if(($var = request()->query('nombre')) !== null){
            $alumnos->where('nombre', 'ilike', "%$var%");
        }
        $alumnos = $alumnos->get();
        foreach($alumnos as $alumno){
            $notas = $this->notasMax($alumno);
            $alumno->nota = array_sum($notas)/(count($notas)?: 1);
        }
        return view('usoTablas', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlumnoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlumnoRequest $request)
    {
        $alum = new Alumno();
        $alum->nombre = $request->nombre;
        $alum->save();
        return redirect()->route('alumnos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view('Alumno.show', [
            'alumno' => $alumno
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('Alumno.edit',[
            'alumno' => $alumno
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlumnoRequest  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        $alumno->nombre = $request->nombre;
        $alumno->save();
        return redirect()->route('alumnos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        foreach($alumno->notas as $nota){
            $nota->delete();
        }
        $alumno->delete();
        return redirect()->route('alumnos.index');
    }
    public function criterios(Alumno $alumno)
    {
        $colec = $this->notasMax($alumno);

        return view('Alumno.criterios',[
            'criterios' => $colec,
            'alumno' => $alumno
        ]);
    }

    private function notasMax(Alumno $alumno){
        $criterios = $alumno->notas->groupBy('ccee_id');
        $colec = [];
        foreach($criterios as $c){
            $new = $c->max('nota');
            $colec[$c[0]->ccee->ce] = $new;
        }
        return $colec;
    }
}
