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
        Schema::create('nota', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements("idnot");
            $table->integer("cantidad");
            $table->unsignedBigInteger("idpro");
            $table->unsignedBigInteger("idv");
            $table->foreign("idpro")->references("idpro")->on("producto")->onDelete('cascade');
            $table->foreign("idv")->references("idv")->on("venta")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};
