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
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();

            $table->integer('proyecto');
            $table->string('evento',20);

            $table->foreign('proyecto')->references('id_proyecto')->on('proyectos')->onDelete('cascade'); // si se ilimina el proyecto se eliminan las presentaciones
            $table->foreign('evento')->references('codigo_evento')->on('eventos')->onDelete('cascade'); // si se ilimina el evento se eliminan las presentaciones

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentaciones');
    }
};
