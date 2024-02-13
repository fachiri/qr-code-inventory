<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.'
        ];
    }
}
