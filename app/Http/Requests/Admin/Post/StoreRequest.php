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

//    public function prepareForValidation(): void
//    {
//        if ($this['post']['image']) {
//            $randomNumber = rand(100000, 999999);
//            $extension = $this['post']['image']->getClientOriginalExtension();
//            $imageName = $randomNumber.'.'.$extension;
//            $imagePath = Storage::disk('public')->putFileAs('images', $this['post']['image'], $imageName);
//            $this->merge([
//                'image_path' => $imagePath,
//            ]);
//        }
//    }

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

    public function passedValidation(): void
    {
        $validatedData = $this->validated();

        if (isset($validatedData['post']['image'])) {
            $randomNumber = rand(100000, 999999);
            $extension = $validatedData['post']['image']->getClientOriginalExtension();
            $imageName = $randomNumber . '.' . $extension;
            $imagePath = Storage::disk('public')->putFileAs('images', $validatedData['post']['image'], $imageName);
            $validatedData['post']['image_path'] = $imagePath;
        }

        $validatedData['post']['profile_id'] = auth()->user()->profile->id;

        $this->merge($validatedData);
    }
}
