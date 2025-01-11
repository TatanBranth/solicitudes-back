<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AgenteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;



Route::apiResource('solicituds', SolicitudController::class);

Route::apiResource('agentes', AgenteController::class);

Route::apiResource('tickets', TicketController::class);

// Rutas para "TicketComment" relacionadas a un ticket
// - Listar comentarios de un ticket
Route::get('tickets/{ticket}/comments', [TicketCommentController::class, 'index']);
// - Crear un comentario para un ticket específico
Route::post('tickets/{ticket}/comments', [TicketCommentController::class, 'store']);