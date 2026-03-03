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
        Schema::create('asistenciaests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idanolectivo');
            $table->foreign('idanolectivo')->references('id')->on('anolectivos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idmatricula');
            $table->foreign('idmatricula')->references('id')->on('matriculas')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fechaentrada');
            $table->text('observacion');
            
            $table->boolean('estado')->nullable();
            $table->timestamps();

            //comparar las fechas entrada y fecha de actulizacion del regitro nde un mismo dia, si son diferentes crear un nuevo registro un rejistro... entrada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistenciaests');
    }
};
