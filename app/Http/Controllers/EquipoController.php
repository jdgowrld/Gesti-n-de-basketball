<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEquipoRequest;

class EquipoController extends Controller
{
    // Carga la tabla principal con todos los equipos
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    // Inyectamos el componente aquí en los paréntesis
    public function store(StoreEquipoRequest $request)
    {
        // Ya no hay $request->validate() aquí. ¡Código limpio!
        try {
            Equipo::create($request->all());
            return back()->with('success', 'Equipo registrado con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fallo al registrar: ' . $e->getMessage()]);
        }
    }

    // Procesa el formulario de actualización (Modal Editar)
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'logo'   => 'nullable|string'
        ]);

        try {
            $equipo = Equipo::findOrFail($id);
            $equipo->update($request->all());
            return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    // Elimina un equipo
    public function destroy(string $id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
            
            // Opcional: Aquí podrías validar si el equipo ya tiene jugadores antes de borrarlo (como hicimos con las ventas)
            if($equipo->jugadores()->count() > 0) {
                return back()->withErrors(['error' => 'No puedes eliminar un equipo que ya tiene jugadores registrados.']);
            }

            $equipo->delete();
            return redirect()->route('equipos.index')->with('success', 'Equipo eliminado de la liga.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo eliminar el equipo.']);
        }
    }
}