<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Agente;

class TicketCommentController extends Controller
{
    /**
     * GET /api/tickets/{ticket}/comments
     * Listar comentarios de un ticket específico.
     */
    public function index($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        return $ticket->comentarios()->with('agente')->get();
    }

    /**
     * POST /api/tickets/{ticket}/comments
     * Crear un comentario asociado a un ticket.
     */
    public function store(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        $validatedData = $request->validate([
            'agente_id' => 'required|exists:agentes,id',
            'comentario' => 'required|string'
        ]);

        $validatedData['ticket_id'] = $ticket->id;

        $comment = TicketComment::create($validatedData);
        $comment -> load('agente');

        return response()->json($comment, 201);
    }
}
