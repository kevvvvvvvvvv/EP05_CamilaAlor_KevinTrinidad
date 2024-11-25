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
        Schema::create('cliente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements("idcli");
            $table->String("alias")->nullable();
            $table->String("nombre")->nullable();
            $table->String("ap")->nullable();
            $table->String("am")->nullable();
            $table->enum('genero', ['Femenino', 'Masculino'])->nullable();
            $table->String("direccion")->nullable();
            $table->date("fenac")->nullable();
            $table->String("telefono")->nullable();
            $table->String("email");
            $table->String("contrasena")->nullable();
            $table->String("google_id")->nullable();
            $table->string('profile_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
