<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idestudiante');
            $table->foreign('idestudiante')->references('id')->on('estudiantes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idanolectivo');
            $table->foreign('idanolectivo')->references('id')->on('anolectivos')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('idaula');
            $table->foreign('idaula')->references('id')->on('aulas')->onUpdate('cascade');
           
            $table->unsignedBigInteger('idsede');

            $table->foreign('idsede')->references('id')->on('sedes')->onUpdate('cascade')->onDelete('restrict'); // 🔥 importante
            $table->unsignedBigInteger('idconcepto');
            $table->foreign('idconcepto')->references('id')->on('conceptos')->onUpdate('cascade');
                $table->string('colegio_procedencia')->nullable();
            $table->date('fecha_matricula');
            $table->string('codigo',9)->nullable();

            $table->boolean('estado')->nullable()->default(1);
         
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
