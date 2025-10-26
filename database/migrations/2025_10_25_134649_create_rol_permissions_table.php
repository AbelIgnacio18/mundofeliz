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
        Schema::create('rol_permissions', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('idrol');
            $table->foreign('idrol')->references('id')->on('rols')->onUpdate('cascade')->onDelete('cascade');
             $table->unsignedBigInteger('idpermission');
            $table->foreign('idpermission')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permissions');
    }
};
