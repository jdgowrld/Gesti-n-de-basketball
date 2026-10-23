<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\JugadorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('equipos', EquipoController::class);
Route::resource('temporadas', TemporadaController::class);
Route::resource('torneos', TorneoController::class);
Route::resource('partidos', PartidoController::class);
Route::resource('jugadores', JugadorController::class);