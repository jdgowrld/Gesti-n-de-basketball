<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use App\Http\Requests\StoreArbitroRequest;

class ArbitroController extends Controller
{
    public function index()
    {
        $arbitros = Arbitro::all();
        return view('arbitros.index', compact('arbitros'));
    }

    public function store(StoreArbitroRequest $request)
    {
        try {
            Arbitro::create($request->all());
            return back()->with('success', 'Árbitro registrado en el padrón.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function update(StoreArbitroRequest $request, string $id)
    {
        try {
            Arbitro::findOrFail($id)->update($request->all());
            return back()->with('success', 'Datos del árbitro actualizados.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Arbitro::findOrFail($id)->delete();
            return back()->with('success', 'Árbitro dado de baja.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar.']);
        }
    }
}