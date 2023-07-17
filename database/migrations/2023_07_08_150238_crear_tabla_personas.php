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
        Schema::create('personas', function (Blueprint $table) {
            $table->unsignedBigInteger('num_identificacion');
            $table->unsignedTinyInteger('tipo_identificacion');
            $table->unsignedBigInteger('usuario')->unique();
            $table->string('nombre',100);
            $table->string('correo',100);
            $table->string('telefono',20);
            $table->string('direccion',30);
            $table->enum('sexo', [0,1]); //0 mujer | 1 hombre. Este campo solo puede tomar 2 valores
            $table->string('foto')->nullable();
            $table->date('fecha_nac');
            $table->string('programa_academico');

            $table->primary('num_identificacion');
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');//si el usuario se elimina, se elimina a la persona

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
