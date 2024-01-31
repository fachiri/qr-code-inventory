<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:units,name',
            'detail' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Satuan harus diisi.',
            'name.unique' => 'Satuan sudah digunakan.',
            'detail.required' => 'Detail harus diisi.'
        ];
    }
}
