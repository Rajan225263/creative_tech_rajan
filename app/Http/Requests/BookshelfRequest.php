<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookshelfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $id
                    ? Rule::unique('bookshelves', 'name')->ignore($id)
                    : Rule::unique('bookshelves', 'name'),
            ],
            'location' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bookshelves Name is required.',
            'name.unique' => 'Bookshelves Name already exists.',
        ];
    }
}

