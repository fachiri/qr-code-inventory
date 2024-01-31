<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories,name',
            'detail' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Kategori harus diisi.',
            'name.unique' => 'Kategori sudah digunakan.',
            'detail.required' => 'Detail harus diisi.'
        ];
    }
}
