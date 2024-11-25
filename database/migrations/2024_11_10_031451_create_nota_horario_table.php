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
        Schema::create('nota_horario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements("idNotaHo");
            $table->unsignedBigInteger("idh");
            $table->unsignedBigInteger("ide");
            $table->foreign("idh")->references("idh")->on("horario")->onDelete('cascade');
            $table->foreign("ide")->references("ide")->on("empleado")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_horario');
    }
};
