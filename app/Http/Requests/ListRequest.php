<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1', 'prohibits:cursor'],
            'cursor' => ['sometimes', 'string', 'uuid', 'prohibits:page'],
            'size' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'page.integer' => 'Page must be an integer.',
            'page.min' => 'Page must be at least 1.',
            'page.prohibits' => 'Cannot use both page and cursor for pagination.',
            'cursor.string' => 'Cursor must be a string.',
            'cursor.uuid' => 'Cursor must be a valid UUID.',
            'cursor.prohibits' => 'Cannot use both page and cursor for pagination.',
            'size.integer' => 'Size must be an integer.',
            'size.min' => 'Size must be at least 1.',
            'size.max' => 'Size cannot be greater than 100.',
        ];
    }
}
