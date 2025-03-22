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
      Schema::create('almacen_productos', function (Blueprint $table) {
        $table->foreignId('producto_id')->references('id')->on('productos')->constrained()->onDelete('cascade');
        $table->foreignId('almacen_id')->references('id')->on('almacenes')->constrained()->onDelete('cascade');
      });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_productos');
    }
};
