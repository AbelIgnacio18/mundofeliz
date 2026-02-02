<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apoderados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);          
            $table->string('dni',8)->unique();         
            $table->string('celular',50)->nullable();
            $table->string('direccion',200)->nullable();           
            $table->string('password');      
            $table->text('fcm_token')->nullable();              
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apoderados');
    }
};
