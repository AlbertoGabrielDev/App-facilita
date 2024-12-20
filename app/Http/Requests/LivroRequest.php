<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{

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
          
        ];
    }

    public function attributes(): array
    {
        return [
            'nome' => 'nome do livro',
            'autor' => 'autor do livro',
            'numero_registro' => 'número de registro',
            'genero' => 'gênero',
           
        ];
    }
}
