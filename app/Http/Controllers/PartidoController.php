<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartidoRequest;

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

    public function store(StorePartidoRequest $request)
    {
        try {
            Partido::create($request->all());
            return back()->with('success', 'Partido agendado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }

    public function update(StorePartidoRequest $request, string $id)
    {
        try {
            Partido::findOrFail($id)->update($request->all());
            return back()->with('success', 'Estado y datos del partido actualizados.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar: ' . $e->getMessage()]);
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

   

public function create()
{
    $posiciones = Posicion::all();
    return view('jugadores.create', compact('posiciones'));
}
}