<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoForm extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_users' => 'required|exists:users,id',
            'id_livros' => 'required|exists:livros,id', 
            'data_emprestimo' => 'required|date|before:data_devolucao', 
            'data_devolucao' => 'required|date|after:data_emprestimo|after_or_equal:today', 
            'status_emprestimo' => 'required|in:em_andamento,atrasado,devolvido',
            'situacao' => 'required|in:Disponivel,Emprestado'
        ];
    }
    public function messages(): array
    {
        return [
            'id_users.required' => 'O usuário é obrigatório.',
            'id_users.exists' => 'O usuário selecionado não existe.',
            'id_livros.required' => 'O livro é obrigatório.',
            'id_livros.exists' => 'O livro selecionado não existe.',
            'data_devolucao.required' => 'A data de devolução é obrigatória.',
            'data_devolucao.after' => 'A data de devolução deve ser depois da data de empréstimo.',
            'status_emprestimo.required' => 'O status do empréstimo é obrigatório.',
            'status_emprestimo.in' => 'O status do empréstimo deve ser um dos seguintes: em_andamento, atrasado, devolvido.',
        ];
    }
    public function attributes(): array
    {
        return [
            'id_users' => 'usuário',
            'id_livros' => 'livro',
            'data_emprestimo' => 'data de empréstimo',
            'data_devolucao' => 'data de devolução',
            'status_emprestimo' => 'status do empréstimo',
        ];
    }
}
