<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'desc' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'desc.required' => 'Tujuan Peminjaman harus diisi.'
        ];
    }
}
