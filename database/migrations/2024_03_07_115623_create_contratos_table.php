<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo',50);
            $table->time('horaentrada');
            $table->string('nivel',50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
