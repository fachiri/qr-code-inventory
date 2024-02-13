<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        if ($this->user->lecturer) {
            $rules['nidn'] = 'required|numeric|digits:10';
        }

        if ($this->user->student) {
            $rules['nim'] = 'required|numeric|digits:9';
        }

        return $rules;
    }
}
