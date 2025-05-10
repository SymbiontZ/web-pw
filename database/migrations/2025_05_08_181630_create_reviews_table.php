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
    if (!Schema::hasTable('reviews')) {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('libro_id');
            $table->string('usuario');
            $table->text('review');
            $table->integer('puntuacion');
            $table->timestamps();

            // Clave foránea
            $table->foreign('libro_id')->references('id_libro')->on('libros')->onDelete('cascade');
            $table->foreign('usuario')->references('Usuario')->on('usuarios')->onDelete('cascade');
        });
    }
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
