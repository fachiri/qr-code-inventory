<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required'
        ];

        if ($this->role === 'Admin') {
            $rules['username'] = 'required';
        }

        if ($this->role === 'Lecturer') {
            $rules['nidn'] = 'required';
        }

        if ($this->role === 'Student') {
            $rules['nim'] = 'required';
        }

        return $rules;
    }
}
