<?php

namespace App\Http\Controllers;

use App\Models\Posicion;
use App\Http\Requests\StorePosicionRequest;

class PosicionController extends Controller
{
    public function index()
    {
        $posiciones = Posicion::all();
        return view('posiciones.index', compact('posiciones'));
    }

    public function store(StorePosicionRequest $request)
    {
        try {
            Posicion::create($request->all());
            return back()->with('success', 'Posición registrada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function update(StorePosicionRequest $request, string $id)
    {
        try {
            Posicion::findOrFail($id)->update($request->all());
            return back()->with('success', 'Posición actualizada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Posicion::findOrFail($id)->delete();
            return back()->with('success', 'Posición eliminada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar.']);
        }
    }
}