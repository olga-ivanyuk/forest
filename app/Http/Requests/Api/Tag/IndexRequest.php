<?php

namespace App\Http\Requests\Api\Tag;

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
            'id' => 'nullable|integer|exists:profiles,id',
            'created_at_from' => 'nullable|date_format:Y-m-d',
            'created_at_to' => 'nullable|date_format:Y-m-d',
            'title' => 'nullable|string',
        ];
    }
}
