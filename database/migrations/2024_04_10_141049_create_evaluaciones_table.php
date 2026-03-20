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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idanolectivo');
            $table->foreign('idanolectivo')->references('id')->on('anolectivos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre');

            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Campo	Tipo	Descripción
Campo	Descripción
id	PK
nombre	Bimestre 1
fecha_inicio	inicio
fecha_fin	fin
anolectivo_id
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
