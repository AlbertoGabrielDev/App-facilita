<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'numero_cadastro' => [
                'required',
                'numeric',
                'unique:users,numero_cadastro,' . $this->route('usuario'),
            ],
            'id_users' => 'nullable|numeric|exists:users,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'name.unique' => 'O nome não pode repetir',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail precisa ser válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha precisa ser uma string válida.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            
            'numero_cadastro.required' => 'O número de cadastro é obrigatório.',
            'numero_cadastro.numeric' => 'O número de cadastro deve ser numérico.',
            'numero_cadastro.unique' => 'Este número de cadastro já está em uso.',
            
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'numero_cadastro' => 'número de cadastro',
        ];
    }

 
}
