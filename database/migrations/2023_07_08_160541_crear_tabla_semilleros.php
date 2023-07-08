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
        Schema::create('semilleros', function (Blueprint $table) {
            $table->string('id_semillero',10);
            $table->string('sede',30);
            $table->string('nombre',30);
            $table->string('correo',50);
            $table->string('logo');
            $table->string('descripcion');
            $table->string('mision');
            $table->string('vision');
            $table->string('valores');
            $table->string('objetivos');
            $table->string('lineas_inv');
            $table->string('presentacion');
            $table->date('fecha_creacion');
            $table->integer('num_res');
            $table->string('resolucion');

            $table->primary('id_semillero');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semilleros');
    }
};
