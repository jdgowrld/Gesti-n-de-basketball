<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Temporada;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTorneoRequest;

class TorneoController extends Controller
{
    public function index()
    {
        $torneos = Torneo::with('temporada')->get();
        
        $temporadas = Temporada::all(); 
        
        return view('torneos.index', compact('torneos', 'temporadas'));
    }

    public function create()
{
    $temporadas = Temporada::all(); // <-- Asegúrate de que esto esté aquí
    $equipos = Equipo::all(); 
    return view('torneos.create', compact('temporadas', 'equipos'));
}

    public function store(StoreTorneoRequest $request)
    {
        try {
            Torneo::create($request->all());
            return back()->with('success', 'Torneo registrado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al guardar: ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
{
    $torneo = Torneo::findOrFail($id);
    $torneo->delete();

    return redirect()->route('torneos.index')->with('success', 'Torneo eliminado correctamente.');
}
    
}
