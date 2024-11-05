<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'parent_id' => 'nullable|integer|exists:comments,id',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'profile_id' => auth()->user()->profile->id,
        ]);
    }
}
