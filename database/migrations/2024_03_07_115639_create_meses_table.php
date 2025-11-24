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
        Schema::create('meses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idmatricula');
            $table->foreign('idmatricula')->references('id')->on('matriculas')->onUpdate('cascade')->onDelete('cascade');
           $table->string('mes');
        $table->boolean('estado')->nullable()->default(false);
        
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meses');
    }
};
