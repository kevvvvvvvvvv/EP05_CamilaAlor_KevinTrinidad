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
        Schema::create('venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements("idv");
            $table->date("fechaVent");
            $table->date("fecEntrega")->nullable();
            $table->float("total");
            $table->unsignedBigInteger("ide")->nullable();
            $table->unsignedBigInteger("idcli")->nullable();
            $table->foreign("ide")->references("ide")->on("empleado")->onDelete('cascade');
            $table->foreign("idcli")->references("idcli")->on("cliente")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
