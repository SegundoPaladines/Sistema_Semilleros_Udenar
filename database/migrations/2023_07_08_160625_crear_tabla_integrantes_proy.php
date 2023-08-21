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
        Schema::create('integrantes_proy', function (Blueprint $table) {
            $table->id();
            $table->integer('proyecto');
            $table->unsignedBigInteger('semillerista');
            $table->string('campo');

            $table->foreign('proyecto')->references('id_proyecto')->on('proyectos')->onDelete('cascade')->onUpdate('cascade');//si se emimina o actualiza el protecto tamnbien a los integrantes
            $table->foreign('semillerista')->references('num_identificacion')->on('semilleristas')->onDelete('cascade')->onUpdate('cascade');//si se emimina  o actualiza al semillerista tamnbien al integrante

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrantes_proy');
    }
};
