<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;

class TemporadaController extends Controller
{
    public function index()
    {
        $temporadas = Temporada::all();
        return view('temporadas.index', compact('temporadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'año_inicio' => 'required|integer',
            'año_fin' => 'required|integer',
            'estado' => 'nullable' // El checkbox manda 'on' si está marcado, nulo si no
        ]);

        try {
            Temporada::create([
                'año_inicio' => $request->año_inicio,
                'año_fin' => $request->año_fin,
                // Si el checkbox se manda, guardamos 1 (Activo), si no 0 (Inactivo)
                'estado' => $request->has('estado') ? 1 : 0
            ]);
            return back()->with('success', 'Temporada registrada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al guardar: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'año_inicio' => 'required|integer',
            'año_fin' => 'required|integer',
            'estado' => 'nullable'
        ]);

        try {
            $temporada = Temporada::findOrFail($id);
            $temporada->update([
                'año_inicio' => $request->año_inicio,
                'año_fin' => $request->año_fin,
                'estado' => $request->has('estado') ? 1 : 0
            ]);
            return back()->with('success', 'Temporada actualizada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $temporada = Temporada::findOrFail($id);
            // Validación para evitar dejar torneos huérfanos
            if($temporada->torneos()->count() > 0) {
                return back()->withErrors(['error' => 'No puedes borrar una temporada que ya tiene torneos.']);
            }
            $temporada->delete();
            return back()->with('success', 'Temporada eliminada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al eliminar.']);
        }
    }
}