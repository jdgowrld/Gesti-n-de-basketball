<?php

namespace App\Http\Controllers;

use App\Models\Uniforme;
use App\Models\Equipo;
use App\Http\Requests\StoreUniformeRequest;

class UniformeController extends Controller
{
    public function index()
    {
        // Traemos uniformes con su equipo, y la lista de equipos para el select
        $uniformes = Uniforme::with('equipo')->get();
        $equipos = Equipo::all();
        return view('uniformes.index', compact('uniformes', 'equipos'));
    }

    public function store(StoreUniformeRequest $request)
    {
        try {
            Uniforme::create($request->all());
            return back()->with('success', 'Uniforme registrado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function update(StoreUniformeRequest $request, string $id)
    {
        try {
            Uniforme::findOrFail($id)->update($request->all());
            return back()->with('success', 'Uniforme actualizado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Uniforme::findOrFail($id)->delete();
            return back()->with('success', 'Uniforme eliminado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar.']);
        }
    }
}