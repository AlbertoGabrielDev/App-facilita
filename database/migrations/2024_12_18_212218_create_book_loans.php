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
        Schema::create('livro_emprestimos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_livros');
            $table->date('data_emprestimo');
            $table->date('data_devolucao');
            $table->enum('status_emprestimo', ['Em Andamento', 'Atrasado', 'Devolvido'])->default('Em Andamento');
         
            $table->foreign('id_livros')->references('id')->on('livros');
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
        Schema::dropIfExists('livro_emprestimos');
    }
};
