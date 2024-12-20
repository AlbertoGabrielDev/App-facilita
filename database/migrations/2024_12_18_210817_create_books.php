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
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('autor');
            $table->integer('numero_registro')->unique();
            $table->enum('situacao', ['Disponível', 'Emprestado'])->default('Disponível');
            $table->enum('genero', ['Ficção', 'Romance', 'Fantasia', 'Aventura'])->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
