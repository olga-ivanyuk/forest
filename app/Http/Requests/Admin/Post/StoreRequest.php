<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        if ($this->hasFile('image')) {
            $randomNumber = rand(100000, 999999);
            $extension = $this->file('image')->getClientOriginalExtension();
            $imageName = $randomNumber.'.'.$extension;
            $imagePath = Storage::disk('public')->putFileAs('images', $this->file('image'), $imageName);
            $this->merge([
                'image_path' => $imagePath,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'post.title' => 'required|min:3',
            'post.content' => 'nullable|string',
            'post.published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'post.category_id' => 'required|integer|exists:categories,id',
            'post.image' => 'nullable|image',
            'tags.*' => 'nullable|string',
        ];
    }

    public function passedValidation()
    {
        return $this->merge([
            'post' => [
                ...$this->validated()['post'],
                'profile_id' => auth()->user()->profile->id,
            ],
        ]);
    }
}
