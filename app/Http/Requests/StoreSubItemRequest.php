<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entry_date' => 'required|date',
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'entry_date.required' => 'Tanggal Masuk Barang harus diisi.',
            'entry_date.date' => 'Tanggal Masuk Barang tidak valid.',
            'quantity.required' => 'Kuantitas Barang harus diisi.',
            'quantity.numeric' => 'Kuantitas Barang harus angka.',
            'quantity.min' => 'Kuantitas Barang minimal 1.',
        ];
    }
}
