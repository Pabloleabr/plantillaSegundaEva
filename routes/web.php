<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PrestadaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VueloController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('alumnos',AlumnoController::class)->middleware(['auth']);

Route::middleware(['auth'])->group(function(){
    Route::get('peliculas', [PrestadaController::class, 'create'])
    ->name('peliculas');
    Route::get('peliculasAlquiladas', [PrestadaController::class, 'reservaUser'])
    ->name('peliculasAlquiladas');
    Route::post('alquilar/{pelicula}', [PrestadaController::class, 'store'])
    ->name('alquilar');

    //ejecicio vuelos
    Route::get('reservar/{vuelo}', [ReservaController::class, 'create'])->name('reservar');
    Route::resource('reservas',ReservaController::class);

    Route::get('vuelos', [VueloController::class, 'index'])->name('vuelo');

});

Route::get('alumnos/criterios/{alumno}',[AlumnoController::class,'criterios'])
->middleware(['auth'])->name('criterios');


require __DIR__.'/auth.php';
