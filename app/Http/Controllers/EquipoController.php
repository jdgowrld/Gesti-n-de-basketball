<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    // Carga la tabla principal con todos los equipos
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    // Procesa el formulario de registro (Modal Crear)
    public function store(Request $request)
    {
        // 1. Validación estricta antes de tocar la base de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'logo'   => 'nullable|string' // Puede ir vacío si aún no tienen logo
        ]);

        try {
            // 2. Inserción limpia usando el $fillable del modelo
            Equipo::create($request->all());
            return redirect()->route('equipos.index')->with('success', 'Equipo registrado a la perfección.');
        } catch (\Exception $e) {
            // 3. Manejo de errores amigable para la UX
            return back()->withErrors(['error' => 'Hubo un fallo al registrar el equipo: ' . $e->getMessage()]);
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