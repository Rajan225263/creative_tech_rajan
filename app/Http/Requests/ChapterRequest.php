<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChapterRequest extends FormRequest
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
                    ? Rule::unique('chapters')->where(function ($query) {
                    return $query->where('book_id', $this->book_id);
                })->ignore($id)
                    : Rule::unique('chapters')->where(function ($query) {
                    return $query->where('book_id', $this->book_id);
                }),
            ],
            'chapter_number' => [
                'required',
                'integer',
                'min:1',
                $id
                    ? Rule::unique('chapters')->where(function ($query) {
                    return $query->where('book_id', $this->book_id);
                })->ignore($id)
                    : Rule::unique('chapters')->where(function ($query) {
                    return $query->where('book_id', $this->book_id);
                }),
            ],

            'book_id' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.unique' => 'Title already exists.',
            'book_id.unique' => 'Book is required.',
        ];
    }
}

