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
        Schema::create('coordinadores', function (Blueprint $table) {
            $table->unsignedBigInteger('num_identificacion');
            $table->string('area_con',50);
            $table->date('fecha_vinculacion');
            $table->string('acuerdo_nombramiento');
            $table->string('semillero',10);


            $table->primary('num_identificacion');
            $table->foreign('num_identificacion')->references('num_identificacion')->on('personas')->onDelete('cascade')->onUpdate('cascade');//si la persona elimina o actualiza, se elimina o actualiza al coordinador
            $table->foreign('semillero')->references('id_semillero')->on('semilleros')->onDelete('cascade')->onUpdate('cascade');//si el semillero se elimina o actualiza, se elimina o actualiza al coordinador

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinadores');
    }
};
