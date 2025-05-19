<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|unique:courses,name',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'O curso ja foi cadastrado!',
            'name.required' => 'O campo nome é obrigatório!',
            'description.required' => 'O campo descrição é obrigatório!',
        ];
    }
}
