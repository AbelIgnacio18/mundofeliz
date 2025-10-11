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
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddocente');
            $table->foreign('iddocente')->references('id')->on('docentes')->onUpdate('cascade')->onDelete('cascade');          
            $table->decimal('montototal',11,2);
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
        Schema::dropIfExists('egresos');
    }
};
