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
        // Usamos 'with' para traer el torneo Y su temporada en una sola consulta SQL (Eager Loading)
        // Esto evita el problema de las consultas N+1 y hace que el sistema vuele.
        $torneos = Torneo::with('temporada')->get();
        
        // Traemos las temporadas activas para llenar el <select> en el modal de creación
        $temporadas = Temporada::where('estado', true)->get();
        
        return view('torneos.index', compact('torneos', 'temporadas'));
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
    
    // Aquí agregarías update() y destroy() siguiendo la misma lógica que hicimos con Equipos
}
