<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|min:3',
            'description'=> 'nullable|string',
            'content'=> 'nullable|string',
            'published_at'=> 'nullable|date_format:Y-m-d',
            'views'=> 'nullable',
            'status'=> 'nullable',
            'profile_id'=> 'integer|exists:profiles,id',
            'category_id'=> 'integer|exists:categories,id',
//            'user'=> 'nullable|string',
//            'category'=> 'nullable|string',
            'tag'=> 'nullable|string',
            'image_path'=> 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be string',
        ];
    }
}

