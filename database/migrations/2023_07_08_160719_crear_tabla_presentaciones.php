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

            $table->foreign('proyecto')->references('id_proyecto')->on('proyectos')->onDelete('cascade')->onUpdate('cascade'); // si se ilimina o acutaliza el proyecto se eliminan o actualizan las presentaciones
            $table->foreign('evento')->references('codigo_evento')->on('eventos')->onDelete('cascade')->onUpdate('cascade'); // si se ilimina o actualiza el evento se eliminan o actualozan las presentaciones

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
