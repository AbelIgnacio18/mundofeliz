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
        Schema::create('calendario_escolar', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->unique();
            $table->string('descripcion')->nullable();
            $table->boolean('es_laborable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_escolar');
    }
};
