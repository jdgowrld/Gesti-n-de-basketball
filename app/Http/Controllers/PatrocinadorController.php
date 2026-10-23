<?php

namespace App\Http\Controllers;

use App\Models\Patrocinador;
use App\Http\Requests\StorePatrocinadorRequest;

class PatrocinadorController extends Controller
{
    public function index()
    {
        $patrocinadores = Patrocinador::all();
        return view('patrocinadores.index', compact('patrocinadores'));
    }

    public function store(StorePatrocinadorRequest $request)
    {
        try {
            Patrocinador::create($request->all());
            return back()->with('success', 'Patrocinador registrado con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    public function update(StorePatrocinadorRequest $request, string $id)
    {
        try {
            Patrocinador::findOrFail($id)->update($request->all());
            return back()->with('success', 'Datos del patrocinador actualizados.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Patrocinador::findOrFail($id)->delete();
            return back()->with('success', 'Patrocinador eliminado del padrón.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar.']);
        }
    }
}