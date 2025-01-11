<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agente extends Model
{
    use HasFactory;

    protected $table = 'agentes';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
