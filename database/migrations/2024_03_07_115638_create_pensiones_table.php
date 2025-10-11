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
        Schema::create('pensions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idpago');
            $table->unsignedBigInteger('idconcepto');
     


            $table->foreign('idpago')->references('id')->on('pagos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idconcepto')->references('id')->on('conceptos')->onUpdate('cascade')->onDelete('cascade');
            $table->Integer('cantidad');
            $table->decimal('monto',11,2);
            $table->string('descripcion', 50)->nullable();
            $table->date('fecha');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pensions');
    }
};
