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
        Schema::create('empleado', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements("ide");
            $table->String("nombre");
            $table->String("ap");
            $table->String("am");
            $table->enum('genero', ['Femenino', 'Masculino'])->nullable();
            $table->date("fenac")->nullable();
            $table->date("feIng");
            $table->String("direccion")->nullable();
            $table->String("telefono")->nullable();
            $table->String("email");
            $table->String("contrasena");
            $table->string('profile_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
