<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'username' => 'required|string',
            'password' => 'required|string',
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
            'username.required' => 'O campo matrícula de usuário é obrigatório!',
            'password.required' => 'O campo senha é obrigatório!',
        ];
    }
}
