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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
   $table->unsignedBigInteger('idanolectivo');
    $table->foreign('idanolectivo')
        ->references('id')
        ->on('anolectivos')
        ->onDelete('cascade');

    $table->string('nombre'); // Bimestre 1
    $table->integer('numero');
        });
    }

    /**
     * Campo	Tipo	Descripción

     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
