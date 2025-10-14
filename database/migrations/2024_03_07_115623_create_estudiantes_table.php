<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('apellidos',100);
            $table->string('dni',8);          
            $table->string('celularm',9)->nullable();
            $table->string('celularp',9)->nullable();
            $table->string('nombreapoderado',9)->nullable();    
            $table->string('direccion',9)->nullable(); 
            $table->string('observaciones',9)->nullable();       
            $table->string('codigo',8)->nullable();
              $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
