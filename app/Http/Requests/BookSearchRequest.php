<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'query' => 'required|string|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'query.required' => 'Query parameter is required.',
        ];
    }
}

