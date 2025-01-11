<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitud_id');
            $table->unsignedBigInteger('agente_id')->nullable();
            $table->string('estado')->default('Creado');
            $table->datetime('fecha_cierre')->nullable();
            $table->timestamps();

            $table->foreign('solicitud_id')->references('id')->on('solicituds');
            $table->foreign('agente_id')->references('id')->on('agentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
