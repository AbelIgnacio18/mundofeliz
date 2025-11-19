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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idestudiante');
            $table->foreign('idestudiante')->references('id')->on('estudiantes')->onUpdate('cascade')->onDelete('cascade');          
            $table->decimal('montototal',11,2);
            $table->decimal('montoefectivo',11,2);
            $table->decimal('montodigital',11,2);
            $table->string('descripcion', 50)->nullable();
            $table->string('archivo', 50)->nullable();
            $table->unsignedBigInteger('numcomprobante');
            $table->date('fecha');
             $table->unsignedBigInteger('idanolectivo');
            $table->foreign('idanolectivo')->references('id')->on('anolectivos')->onUpdate('cascade')
            ->onDelete('cascade');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
