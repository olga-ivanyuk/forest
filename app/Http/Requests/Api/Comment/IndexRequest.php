<?php

namespace App\Http\Requests\Api\Comment;

use Carbon\Carbon;
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
            'id' => 'nullable|integer|exists:comments,id',
            'created_at_from' => 'nullable|date_format:Y-m-d',
            'created_at_to' => 'nullable|date_format:Y-m-d',
            'content' => 'nullable|string',
            'profile_name' => 'nullable|string',
        ];
    }
}