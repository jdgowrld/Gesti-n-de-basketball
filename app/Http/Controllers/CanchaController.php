<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCanchaRequest;

class CanchaController extends Controller
{
    public function index()
    {
        $canchas = Cancha::all();
        return view('canchas.index', compact('canchas'));
    }

    public function store(StoreCanchaRequest $request)
    {
        try {
            Cancha::create($request->all());
            return back()->with('success', 'Sede registrada correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar la sede.']);
        }
    }

    public function update(StoreCanchaRequest $request, string $id)
    {
        try {
            Cancha::findOrFail($id)->update($request->all());
            return back()->with('success', 'Sede actualizada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al actualizar.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Cancha::findOrFail($id)->delete();
            return back()->with('success', 'Sede eliminada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al eliminar la sede.']);
        }
    }
}