<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ArbitroController;
use App\Http\Controllers\PatrocinadorController;
use App\Http\Controllers\PosicionController;
use App\Http\Controllers\UniformeController;
use App\Http\Controllers\PartidoJugadorController;


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
Route::resource('arbitros', ArbitroController::class);
Route::resource('patrocinadores', PatrocinadorController::class);
Route::resource('posiciones', PosicionController::class);
Route::resource('uniformes', UniformeController::class);
Route::resource('convocatorias', PartidoJugadorController::class)->except(['update']);