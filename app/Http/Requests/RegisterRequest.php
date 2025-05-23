<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'type' => [
                'required',

            ],
            'cpf' => [
                'string',

            ],
            'cnpj' => [
                'string',

            ],
            'email' => [
                'required',
                'email',

            ],
            'password' => 'required|min:6',
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
