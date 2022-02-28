<?php

use App\Http\Controllers\AlumnoController;
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

Route::get('alumnos/criterios/{alumno}',[AlumnoController::class,'criterios'])
->middleware(['auth'])->name('criterios');


require __DIR__.'/auth.php';
