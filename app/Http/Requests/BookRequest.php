<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                $id
                    ? Rule::unique('books', 'title')->ignore($id)
                    : Rule::unique('books', 'title'),
            ],
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer|digits:4|min:1500|max:' . now()->year,
            'bookshelf_id' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Book Name is required.',
            'title.unique' => 'Book Name already exists.',
        ];
    }
}

