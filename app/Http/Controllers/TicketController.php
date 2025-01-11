<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
     /**
     * GET /api/tickets
     * Listar todos los tickets.
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * POST /api/tickets
     * Crear un nuevo ticket.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'solicitud_id' => 'required|exists:solicituds,id',
            'agente_id'    => 'nullable|exists:agentes,id',
            'estado'       => 'sometimes|string|max:50',
            'fecha_cierre' => 'nullable|date'
        ]);

        if (!isset($validatedData['estado'])) {
            $validatedData['estado'] = 'Creado';
        }

        $ticket = Ticket::create($validatedData);
        $ticket = Ticket::all();

        $ticket->load(['agente']);

        return response()->json($ticket, 201);
    }

    /**
     * GET /api/tickets/{id}
     * Mostrar un ticket específico
     */
    public function show($id)
    {
        $ticket = Ticket::with(['solicitud', 'agente', 'comentarios'])->findOrFail($id);
        return $ticket;
    }

    /**
     * PUT/PATCH /api/tickets/{id}
     * Actualizar un ticket
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validatedData = $request->validate([
            'solicitud_id' => 'sometimes|exists:solicituds,id',
            'agente_id'    => 'sometimes|nullable|exists:agentes,id',
            'estado'       => 'sometimes|string|max:50',
            'fecha_cierre' => 'sometimes|nullable|date'
        ]);

        $ticket->update($validatedData);
        $ticket->load(['solicitud', 'agente']);

        return response()->json($ticket, 200);
    }

    /**
     * DELETE /api/tickets/{id}
     * Eliminar un ticket (opcional).
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(null, 204);
    }
}
