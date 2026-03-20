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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idcaja');
            $table->foreign('idcaja')->references('id')->on('cajas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tipo', 10);
            $table->unsignedBigInteger('idpago')->nullable();
            $table->foreign('idpago')->references('id')->on('pagos')->onDelete('set null');
            
             $table->unsignedBigInteger('iddocente')->nullable();
            $table->foreign('iddocente')->references('id')->on('docentes')->onDelete('set null');

            $table->decimal('monto', 11, 2);
            $table->string('metodo', 20)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
