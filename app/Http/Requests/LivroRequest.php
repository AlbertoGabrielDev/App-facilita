<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return $this->user()->can('create', Book::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,
     */
    public function rules(): array
    {

        return [
            'nome' => 'required|max:255',
            'autor' => 'required|max:255',
            'numero_registro' => [
                'required',
                'numeric',
                'unique:livros,numero_registro,' . $this->route('livro'),
            ],
            'genero' => 'required|max:255',
            'situacao' => 'required|in:disponivel,indisponivel',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do livro é obrigatório.',
            'nome.max' => 'O nome do livro não pode ter mais que 255 caracteres.',
            'autor.required' => 'O autor do livro é obrigatório.',
            'autor.max' => 'O nome do autor não pode ter mais que 255 caracteres.',
            'numero_registro.required' => 'O número de registro é obrigatório.',
            'numero_registro.numeric' => 'O número de registro deve conter apenas números.',
            'numero_registro.unique' => 'Já existe um livro com esse número de registro.',
            'genero.required' => 'O gênero do livro é obrigatório.',
            'genero.max' => 'O gênero do livro não pode ter mais que 255 caracteres.',
            'situacao.required' => 'A situação do livro é obrigatória.',
            'situacao.in' => 'A situação do livro deve ser "disponível" ou "indisponível".',
        ];
    }

    public function attributes(): array
    {
        return [
            'nome' => 'nome do livro',
            'autor' => 'autor do livro',
            'numero_registro' => 'número de registro',
            'genero' => 'gênero',
            'situacao' => 'situação do livro',
        ];
    }
}
