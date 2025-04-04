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
      Schema::create('vehiculos', function (Blueprint $table) {
          $table->id();
          $table->string('placa');
          $table->string('modelo');
          $table->string('marca');
          $table->string('persona_id')->references('id')->on('personas')->nullable(true);
          $table->string('empresa_id')->references('id')->on('empresas')->nullable(true);
          $table->timestamps();
      });
  }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
