<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
        public function up()
        {
            // Inserir o usuário e capturar o ID
            $userId = DB::table('users')->insertGetId([
                'numero_cadastro' => null, // Pode deixar como null se não precisar de valor
                'name' => 'Alberto Gabriel Martins',
                'email' => 'admim@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('123456789'), // Certifique-se de usar um hash válido
                'remember_token' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Inserir os livros usando o $userId
            DB::table('livros')->insert([
                [
                    'nome' => 'O Senhor dos Anéis',
                    'autor' => 'J.R.R. Tolkien',
                    'numero_registro' => 12345,
                    'situacao' => 'Disponível',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'Harry Potter e a Pedra Filosofal',
                    'autor' => 'J.K. Rowling',
                    'numero_registro' => 12346,
                    'situacao' => 'Disponível',
                    'genero' => 'Fantasia',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'O Hobbit',
                    'autor' => 'J.R.R. Tolkien',
                    'numero_registro' => 12347,
                    'situacao' => 'Disponível',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => '1984',
                    'autor' => 'George Orwell',
                    'numero_registro' => 12348,
                    'situacao' => 'Emprestado',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'Dom Casmurro',
                    'autor' => 'Machado de Assis',
                    'numero_registro' => 12349,
                    'situacao' => 'Emprestado',
                    'genero' => 'Romance',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'O Primo Basílio',
                    'autor' => 'José de Alencar',
                    'numero_registro' => 12350,
                    'situacao' => 'Disponível',
                    'genero' => 'Romance',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'O Cortiço',
                    'autor' => 'Aluísio Azevedo',
                    'numero_registro' => 12351,
                    'situacao' => 'Disponível',
                    'genero' => 'Romance',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'A Metamorfose',
                    'autor' => 'Franz Kafka',
                    'numero_registro' => 12352,
                    'situacao' => 'Emprestado',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'A Caverna',
                    'autor' => 'José Saramago',
                    'numero_registro' => 12353,
                    'situacao' => 'Disponível',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'nome' => 'Ensaio Sobre a Cegueira',
                    'autor' => 'José Saramago',
                    'numero_registro' => 12354,
                    'situacao' => 'Disponível',
                    'genero' => 'Ficção',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
            ]);
    
            // Inserir os empréstimos usando o $userId e IDs dos livros
            DB::table('livro_emprestimos')->insert([
                [
                    'id_livros' => 1, // ID do livro inserido
                    'data_emprestimo' => '2024-12-01',
                    'data_devolucao' => '2024-12-15',
                    'status_emprestimo' => 'Devolvido',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 2, // ID do livro inserido
                    'data_emprestimo' => '2024-12-05',
                    'data_devolucao' => '2024-12-19',
                    'status_emprestimo' => 'Devolvido',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 3, // ID do livro inserido
                    'data_emprestimo' => '2024-12-10',
                    'data_devolucao' => '2024-12-24',
                    'status_emprestimo' => 'Em Andamento',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 4, // ID do livro inserido
                    'data_emprestimo' => '2024-12-11',
                    'data_devolucao' => '2024-12-25',
                    'status_emprestimo' => 'Em Andamento',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 5, // ID do livro inserido
                    'data_emprestimo' => '2024-12-15',
                    'data_devolucao' => '2024-12-29',
                    'status_emprestimo' => 'Em Andamento',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 6, // ID do livro inserido
                    'data_emprestimo' => '2024-12-16',
                    'data_devolucao' => '2024-12-30',
                    'status_emprestimo' => 'Devolvido',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 7, // ID do livro inserido
                    'data_emprestimo' => '2024-12-18',
                    'data_devolucao' => '2024-12-26',
                    'status_emprestimo' => 'Em Andamento',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 8, // ID do livro inserido
                    'data_emprestimo' => '2024-12-20',
                    'data_devolucao' => '2024-12-30',
                    'status_emprestimo' => 'Em Andamento',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
                [
                    'id_livros' => 9, // ID do livro inserido
                    'data_emprestimo' => '2024-12-20',
                    'data_devolucao' => '2024-12-31',
                    'status_emprestimo' => 'Devolvido',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_users' => $userId, // Usar o ID do usuário inserido
                ],
            ]);
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            DB::table('livros')->truncate();
            DB::table('users')->truncate();
            DB::table('livro_emprestimos')->truncate();
        }
};
