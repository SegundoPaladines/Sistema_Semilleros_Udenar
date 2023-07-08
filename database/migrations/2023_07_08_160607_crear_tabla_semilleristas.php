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
        Schema::create('semilleristas', function (Blueprint $table) {
            $table->unsignedBigInteger('num_identificacion');
            $table->string('semillero',10);
            $table->unsignedBigInteger('cod_estudiante');
            $table->unsignedTinyInteger('semestre');
            $table->string('reporte_matricula');
            $table->date('fecha_vinculacion');
            $table->enum('estado',[0,1]); //0 incativo | 1 activo 

            $table->primary('num_identificacion');
            $table->foreign('num_identificacion')->references('num_identificacion')->on('personas')->onDelete('cascade');//si la persona elimina, se elimina al semillerista
            $table->foreign('semillero')->references('id_semillero')->on('semilleros')->onDelete('cascade');//si el semillero se elimina, se elimina al semillerista
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semilleristas');
    }
};
