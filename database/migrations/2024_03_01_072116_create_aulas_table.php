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
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nivel',50);
            $table->string('grado',50);
            $table->string('seccion',50)->nullable();;
            $table->integer('vacantes'); 
            $table->time('horaentrada');
             $table->time('horatarde');             
              $table->time('horafalta');
               $table->time('horasalida')->nullable();
          $table->unsignedBigInteger('idsede');
            $table->foreign('idsede')->references('id')->on('sedes')
            ->onUpdate('cascade')->restrictOnDelete();
             
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
