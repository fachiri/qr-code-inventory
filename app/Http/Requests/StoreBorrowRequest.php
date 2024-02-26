<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subitem_uuid' => 'required',
            'desc' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'subitem_uuid.required' => 'Barang harus dipilih.',
            'desc.required' => 'Tujuan Peminjaman harus diisi.',
        ];
    }
}
