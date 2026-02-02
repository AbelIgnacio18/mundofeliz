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
            $table->string('dni',8)->nullable();         
            $table->string('celular',50)->nullable();             
            $table->string('observaciones',200)->nullable();       
         
           
             $table->unsignedBigInteger('idapoderado');
            $table->foreign('idapoderado')->references('id')->on('apoderados')->onUpdate('cascade');
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
