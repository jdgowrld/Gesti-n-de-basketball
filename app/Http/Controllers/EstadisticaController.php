<?php

namespace App\Http\Controllers;

use App\Models\Estadistica;
use App\Models\Partido;
use App\Models\Jugador;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstadisticaRequest;

class EstadisticaController extends Controller
{
    public function index()
    {
        $estadisticas = Estadistica::with(['partido.equipoLocal', 'partido.equipoVisitante', 'jugador'])->get();
        // Solo traemos partidos que ya están jugándose o terminados para meter estadísticas
        $partidos = Partido::with(['equipoLocal', 'equipoVisitante'])->whereIn('estado', ['En Juego', 'Finalizado'])->get();
        $jugadores = Jugador::with('equipo')->get();
        
        return view('estadisticas.index', compact('estadisticas', 'partidos', 'jugadores'));
    }

    public function store(StoreEstadisticaRequest $request)
    {
        try {
            Estadistica::create($request->all());
            return back()->with('success', 'Rendimiento del jugador registrado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            Estadistica::findOrFail($id)->delete();
            return back()->with('success', 'Registro estadístico eliminado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al eliminar.']);
        }
    }
}