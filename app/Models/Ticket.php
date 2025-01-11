<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'solicitud_id',
        'agente_id',
        'estado',
        'fecha_cierre',
    ];

    /**
     * Un ticket pertenece a una solicitud (quien reporta)
     */
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }


    /**
     * Un ticket puede estar asignado a un agente
     */
    public function agente()
    {
        return $this->belongsTo(Agente::class);
    }

    /**
     * Un ticket puede tener muchos comentarios
     */
    public function comentarios()
    {
        return $this->hasMany(TicketComment::class);
    }

}
