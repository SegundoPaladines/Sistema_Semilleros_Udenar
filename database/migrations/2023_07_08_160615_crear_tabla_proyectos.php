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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->integer('id_proyecto');
            $table->string('semillero',10);
            $table->string('titulo');
            $table->string('tipo_proyecto',20);
            $table->string('estado',20); //o inactivo, 1 activo
            $table->date('feacha_inicio');
            $table->date('feacha_fin');
            $table->string('arc_propuesta');
            $table->string('arc_adjunto');

            $table->primary('id_proyecto');
            $table->foreign('semillero')->references('id_semillero')->on('semilleros')->onDelete('cascade')->onUpdate('cascade');//si el semillero se elimina o actualiza, se elimina o actualiza al semillerista

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
