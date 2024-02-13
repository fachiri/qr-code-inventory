<?php

namespace App\Http\Requests;

use App\Constants\StatusUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('users', 'username')->ignore($this->uuid, 'uuid'),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->uuid, 'uuid'),
            ],
            'status' => 'required|in:'.StatusUser::ACTIVE.','.StatusUser::INACTIVE
        ];
    }
}
