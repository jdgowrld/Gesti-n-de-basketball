<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJugadorRequest;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::with('equipo')->get();
        $equipos = Equipo::all();
        return view('jugadores.index', compact('jugadores', 'equipos'));
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
}