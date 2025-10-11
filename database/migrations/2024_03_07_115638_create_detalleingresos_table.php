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
        Schema::create('detalleingresos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idingreso');
            $table->foreign('idingreso')->references('id')->on('ingresos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idarticulo');
            $table->foreign('idarticulo')->references('id')->on('articulos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('montototal',11,2);
            $table->date('fecha');
       
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalleingresos');
    }
};
