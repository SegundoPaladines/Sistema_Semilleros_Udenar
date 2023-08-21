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
        Schema::create('director', function (Blueprint $table) {
            $table->unsignedBigInteger('num_identificacion');

            $table->primary('num_identificacion');
            $table->foreign('num_identificacion')->references('num_identificacion')->on('personas')->onDelete('cascade')->onUpdate('cascade');//si la persona elimina o actualiza, se elimina o actualiza al director

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director');
    }
};
