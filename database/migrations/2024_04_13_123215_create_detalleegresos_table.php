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
        Schema::create('detalleegresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idpagoegresos');
            $table->foreign('idpagoegresos')->references('id')->on('docentes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidadhoras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleegresos');
    }
};
