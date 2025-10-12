<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('apellidos',100);
            $table->string('dni',8);
            $table->string('codigo',8)->nullable();
            $table->boolean('estado',3)->default(1);
            $table->string('celular',9)->nullable();      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
