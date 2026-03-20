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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idmatricula');
            $table->foreign('idmatricula')->references('id')->on('matriculas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('iddocente');
            $table->foreign('iddocente')->references('id')->on('docentes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idcurso');
            $table->foreign('idcurso')->references('id')->on('cursos')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('idevaluacion');
            // $table->foreign('idevaluacion')->references('id')->on('evaluaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idperiodo');
            $table->foreign('idperiodo')
                ->references('id')
                ->on('periodos')
                ->onDelete('cascade');

            $table->decimal('notanumero', 5, 2)->nullable();
             $table->string('notaletra',10)->nullable();

            $table->string('observacion')->nullable();
            $table->unique(['idmatricula','idcurso','idperiodo']);
            $table->timestamps();
        });
    }
    /**
     * Campo	Tipo	Descripción

     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
