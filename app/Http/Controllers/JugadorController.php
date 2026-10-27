<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use App\Models\Posicion; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreJugadorRequest;

class JugadorController extends Controller
{
   public function index()
{
    $jugadores = Jugador::with(['equipo', 'posicion'])->get();
    $equipos = Equipo::all();
    $posiciones = Posicion::all(); // <-- Agrega esto si también usas posiciones en el modal
    
    return view('jugadores.index', compact('jugadores', 'equipos', 'posiciones'));
}

    public function store(StoreJugadorRequest $request)
    {
        try {
            Jugador::create($request->all());
            return back()->with('success', 'Jugador registrado en el roster.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function update(StoreJugadorRequest $request, string $id)
    {
        try {
            Jugador::findOrFail($id)->update($request->all());
            return back()->with('success', 'Roster actualizado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Jugador::findOrFail($id)->delete();
            return back()->with('success', 'Jugador dado de baja.');
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