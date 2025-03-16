<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ?  $userId->id : null),
            'password' => 'required|confirmed|min:6',
        ];
    }
    public function messages(): array
    {
        return[
            'name.required' => 'Campo nome é obrigatorio!',
            'email.required' => 'Campo e-mail é obrigatorio',
            'email.email' => 'Necessário enviar e-mail válido!',
            'email.unique' => 'O e-mail já está cadastrado',
            'password.required' => 'Campo senha é obrigatorio!',
            'password.confirmed' => 'A confirmação de senha não corresponde',
            'password.min' => 'Senha com no Mínimo :min caracteres!',
        ];
    }
}
