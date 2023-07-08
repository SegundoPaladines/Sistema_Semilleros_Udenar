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
            $table->unsignedBigInteger('semillerista');

            $table->foreign('presentacion')->references('id')->on('presentaciones')->onDelete('cascade'); //si se elimina la presentacion, tambien a los participantes
            $table->foreign('semillerista')->references('num_identificacion')->on('semilleristas')->onDelete('cascade'); //si se elimina al semillerista, tambien al participante

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
