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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
       
    $table->unsignedBigInteger('iduser'); // 🔥 CLAVE
    $table->foreign('iduser')->references('id')->on('users')->cascadeOnDelete();
      //   $table->unsignedBigInteger('idaula');
          // $table->foreign('idaula')->references('id')->on('aulas')->onUpdate('cascade')->onDelete('cascade');
          //   $table->unsignedBigInteger('idcurso');
          //   $table->foreign('idcurso')->references('id')->on('curso')->onUpdate('cascade')->onDelete('cascade');
          //   $table->unsignedBigInteger('idhora');
          //   $table->foreign('idhora')->references('id')->on('horas')->onUpdate('cascade')->onDelete('cascade');
          
            $table->string('dia_semana');
            $table->time('hora_ingreso');
            // $table->time('hora_inicio');
            // $table->time('hora_fin');
          $table->integer('tolerancia')->default(5);             
            $table->boolean('estado')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Campo	Tipo	Descripción

     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
