<?php

namespace App\Http\Requests\Admin\Post;

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
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'id' => 'nullable|integer|exists:posts,id',
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

    protected function passedValidation()
    {
        return $this->merge([
            'page' => $this->page ?? 1,
            'per_page' => $this->per_page ?? 5,
        ]);
    }
}

