<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required',
            'name' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode Barang harus diisi.',
            'name.required' => 'Nama Barang harus diisi.',
            'unit_id.required' => 'Satuan Barang harus diisi.',
            'category_id.required' => 'Kategori Barang harus diisi.',
        ];
    }
}
