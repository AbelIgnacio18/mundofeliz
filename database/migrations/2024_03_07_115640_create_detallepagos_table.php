<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('detallepagos', function (Blueprint $table) {
            $table->id();

        
    $table->unsignedBigInteger('idpago');
    $table->unsignedBigInteger('idarticulo');          
    $table->foreign('idarticulo')->references('id')->on('articulos')->onUpdate('cascade')->onDelete('cascade');         
    $table->foreign('idpago')->references('id')->on('pagos')->onUpdate('cascade')->onDelete('cascade');
    $table->integer('cantidadar');
    $table->decimal('montoar',11,2);      
    $table->date('fecha');
    $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detallepagos');
    }
};
