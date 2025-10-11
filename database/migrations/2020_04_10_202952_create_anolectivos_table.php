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
        Schema::create('anolectivos', function (Blueprint $table) {
            $table->id();
            $table->string('años',50);
            $table->string('inicio',50);
            $table->string('fin',50);
            $table->boolean('estado')->default(1);    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anolectivos');
    }
};
