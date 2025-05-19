<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine se o usuário tem permissão para fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obter as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'username' => 'unique:users,username,' . ($userId ? $userId->id : null),
            //'email' => 'required|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Obter as mensagens de erro personalizadas para cada validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'username.required' => 'Campo matrícula é obrigatório!',
            'username.unique' => 'A matrícula já está cadastrada!',
            'password.required' => 'Campo senha é obrigatório!',
            'password.confirmed' => 'A confirmação de senha não corresponde!',
            'password.min' => 'Senha com no mínimo :min caracteres!',
        ];
    }
}
