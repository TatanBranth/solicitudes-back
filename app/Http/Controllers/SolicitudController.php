<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * GET /api/solicituds
     * Listar todas las solicitudes.
     */
    public function index()
    {
        return Solicitud::all();
    }

    /**
     * POST /api/solicituds
     * Crear una nueva solicitud.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:solicituds,correo',
        ]);

        // Crear la solicitud
        $solicitud = Solicitud::create($validated);
        $solicitud = Solicitud::all();
        // Retornar la respuesta
        return response()->json($solicitud, 201);
    }

    /**
     * GET /api/solicituds/{id}
     * Mostrar una solicitud específica.
     */
    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return $solicitud;
    }

    /**
     * PUT/PATCH /api/solicituds/{id}
     * Actualizar una solicitud existente.
     */
    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $validatedData = $request->validate([
            'nombre'   => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'correo'   => 'sometimes|email|unique:solicituds,correo,' . $solicitud->id
        ]);

        $solicitud->update($validatedData);
        return response()->json($solicitud, 200);
    }

     /**
     * DELETE /api/solicituds/{id}
     * Eliminar una solicitud.
     */
    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return response()->json(null, 204);
    }

}
