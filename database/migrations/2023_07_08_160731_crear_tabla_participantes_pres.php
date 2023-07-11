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
        Schema::create('participantes_pres', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('presentacion');
            $table->unsignedBigInteger('integrante');

            $table->foreign('presentacion')->references('id')->on('presentaciones')->onDelete('cascade'); //si se elimina la presentacion, tambien a los participantes
            $table->foreign('integrante')->references('id')->on('integrantes_proy')->onDelete('cascade'); //si se elimina al integrante, tambien al participante

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes_pres');
    }
};
