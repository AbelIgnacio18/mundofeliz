<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('apellidos',100);
            $table->string('dni',8);
            $table->string('codigo',8)->nullable();
            $table->string('estado',3)->default('si');
            $table->string('celular',9)->nullable();  
            $table->unsignedBigInteger('idcontrato');
            $table->foreign('idcontrato')->references('id')->on('contratos')->onUpdate('cascade')->onDelete('cascade');        
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
