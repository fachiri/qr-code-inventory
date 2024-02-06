<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'code' => 'required|unique:items,code',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'unit_id' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Tanggal Masuk harus diisi.',
            'date.date' => 'Tanggal Masuk tidak valid.',
            'code.required' => 'Kode Barang harus diisi.',
            'code.unique' => 'Kode Barang sudah digunakan.',
            'name.required' => 'Nama Barang harus diisi.',
            'quantity.required' => 'Kuantitas Barang harus diisi.',
            'quantity.numeric' => 'Kuantitas Barang harus angka.',
            'unit_id.required' => 'Satuan Barang harus diisi.',
            'category_id.required' => 'Kategori Barang harus diisi.',
        ];
    }
}
