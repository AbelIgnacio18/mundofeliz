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
       Schema::create('asistencias', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('idanolectivo');
    $table->foreign('idanolectivo')->references('id')->on('anolectivos')->cascadeOnDelete();

    $table->unsignedBigInteger('iduser');
    $table->foreign('iduser')->references('id')->on('users')->cascadeOnDelete();

    $table->date('fechaentrada');
    $table->time('horaentrada')->nullable();
    $table->time('horasalida')->nullable();

    $table->integer('minutos_tarde')->default(0);
    $table->decimal('descuento', 8, 2)->default(0);

    // 🔥 CORREGIDO
    $table->tinyInteger('estado')->default(1);

    $table->timestamps();

    // 🔥 PROTECCIÓN
    $table->unique(['iduser', 'fechaentrada']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
