<?php

namespace App\Http\Requests\Admin\Comment;

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
            'content'=> 'nullable|string',
            'profile_id'=> 'required|integer|exists:profiles,id',
            'post_id'=> 'required|integer|exists:posts,id',
        ];
    }
}
