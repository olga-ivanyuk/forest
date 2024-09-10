<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer|exists:posts,id',
            'created_at_from' => 'nullable|date_format:Y-m-d',
            'created_at_to' => 'nullable|date_format:Y-m-d',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'published_at_from' => 'nullable|date_format:Y-m-d',
            'published_at_to' => 'nullable|date_format:Y-m-d',
            'views' => 'nullable|integer',
            'status' => 'nullable|integer',
            'profile_name' => 'nullable|string',
            'category_title' => 'nullable|string',
            'user_name' => 'nullable|string',
        ];
    }
}

