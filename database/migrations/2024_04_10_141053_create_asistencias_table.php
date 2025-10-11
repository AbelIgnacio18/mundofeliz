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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idañolectivo');
            $table->foreign('idañolectivo')->references('id')->on('anolectivos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('iddocente');
            $table->foreign('iddocente')->references('id')->on('docentes')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('fechaentrada');
           
            $table->boolean('estado')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
