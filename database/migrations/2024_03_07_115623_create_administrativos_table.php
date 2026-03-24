<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->id();
         $table->foreignId('user_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    // ⚠️ estos campos podrías NO duplicarlos
    // porque ya existen en users
    // mejor usar solo user_id

    $table->string('dni', 8)->unique();
    $table->string('celular', 9)->nullable();
    $table->string('codigo', 8)->nullable();

    $table->boolean('estado')->default(1);
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administrativos');
    }
};
