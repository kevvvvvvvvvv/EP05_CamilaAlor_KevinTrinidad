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
        Schema::create('horario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idh');
            $table->time('horaentrada');
            $table->time('horasalida');
            $table->string('dia');
            // $table->unsignedBigInteger('ide'); // unsigned BIGINT para coincidir con empleado
            // $table->foreign('ide')->references('ide')->on('empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario');
    }
};
