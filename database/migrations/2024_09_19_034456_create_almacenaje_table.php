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
        Schema::create('almacenaje', function (Blueprint $table) {
            $table->bigIncrements("idalm");
            $table->String("nombre");
            $table->String("descripcion");
            $table->date("fechaIng");
            $table->date("fechaCad")->nullable();
            $table->integer("cantidad");
            $table->String("categoria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacenaje');
    }
};
