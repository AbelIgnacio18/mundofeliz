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
        Schema::create('user_sedes', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idsede');
            $table->foreign('idsede')->references('id')->on('sedes')
            ->onUpdate('cascade')->restrictOnDelete();
           $table->unique(['iduser', 'idsede']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sedes');
    }
};
