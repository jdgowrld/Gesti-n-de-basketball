<?php

namespace App\Http\Controllers;

use App\Models\PartidoJugador;
use App\Models\Partido;
use App\Models\Jugador;
use App\Http\Requests\StorePartidoJugadorRequest;

class PartidoJugadorController extends Controller
{
    public function index()
    {
        $convocatorias = PartidoJugador::with(['partido', 'jugador'])->get();
        $partidos = Partido::all();
        $jugadores = Jugador::with('equipo')->get(); // Traemos el equipo para saber de dónde es el jugador
        return view('partido_jugadores.index', compact('convocatorias', 'partidos', 'jugadores'));
    }

    public function store(StorePartidoJugadorRequest $request)
    {
        try {
            PartidoJugador::create($request->all());
            return back()->with('success', 'Jugador convocado al partido.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // Error de duplicado en MariaDB
                return back()->withErrors(['error' => 'Este jugador ya está convocado para este partido.']);
            }
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error inesperado.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            PartidoJugador::findOrFail($id)->delete();
            return back()->with('success', 'Jugador retirado de la convocatoria.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar.']);
        }
    }
}