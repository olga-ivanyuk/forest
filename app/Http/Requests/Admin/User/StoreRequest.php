<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|min:3',
            'email'=> 'nullable|string',
            'password'=> 'nullable|string',
            'role'=> 'nullable|integer|exists:roles,id',
        ];
    }
}
