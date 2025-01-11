<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketComment extends Model
{
    use HasFactory;

    protected $table = 'ticket_comments';

    protected $fillable = [
        'ticket_id',
        'agente_id',
        'comentario',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function agente()
    {
        return $this->belongsTo(Agente::class);
    }
}
