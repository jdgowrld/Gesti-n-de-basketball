<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\CanchaController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('equipos', EquipoController::class);
Route::resource('temporadas', TemporadaController::class);
Route::resource('torneos', TorneoController::class);
Route::resource('partidos', PartidoController::class);
Route::resource('jugadores', JugadorController::class);
Route::resource('estadisticas', EstadisticaController::class);
Route::resource('canchas', CanchaController::class);

