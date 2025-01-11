<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agente;
use Illuminate\Http\Request;

class AgenteController extends Controller
{
    /**
     * GET /api/agentes
     * Listar todos los agentes.
     */
    public function index()
    {
        return Agente::all();
    }

    /**
     * POST /api/agentes
     * Crear un nuevo agente.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'correo'   => 'required|email|unique:agentes,correo'
        ]);

        $agente = Agente::create($validatedData);

        return response()->json($agente, 201);
    }

    /**
     * GET /api/agentes/{id}
     * Mostrar un agente específico.
     */
    public function show($id)
    {
        $agente = Agente::findOrFail($id);
        return $agente;
    }

    /**
     * PUT/PATCH /api/agentes/{id}
     * Actualizar un agente existente.
     */
    public function update(Request $request, $id)
    {
        $agente = Agente::findOrFail($id);

        $validatedData = $request->validate([
            'nombre'   => 'sometimes|string|max:255',
            'apellido' => 'sometimes|nullable|string|max:255',
            'correo'   => 'sometimes|email|unique:agentes,correo,' . $agente->id
        ]);

        $agente->update($validatedData);
        return response()->json($agente, 200);
    }

    /**
     * DELETE /api/agentes/{id}
     * Eliminar un agente.
     */
    public function destroy($id)
    {
        $agente = Agente::findOrFail($id);
        $agente->delete();

        return response()->json(null, 204);
    }
}
