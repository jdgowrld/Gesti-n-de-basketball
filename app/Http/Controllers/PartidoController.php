<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        // Eager Loading para traer las relaciones sin saturar la memoria
        $partidos = Partido::with(['torneo', 'equipoLocal', 'equipoVisitante'])->get();
        $torneos = Torneo::all();
        $equipos = Equipo::all();
        
        return view('partidos.index', compact('partidos', 'torneos', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'torneo_id' => 'required|exists:torneos,id',
            'equipo_local_id' => 'required|exists:equipos,id|different:equipo_visitante_id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estado' => 'required|string'
        ]);

        try {
            Partido::create($request->all());
            return back()->with('success', 'Partido agendado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            Partido::findOrFail($id)->delete();
            return back()->with('success', 'Partido eliminado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al eliminar.']);
        }
    }
}