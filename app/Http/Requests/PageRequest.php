<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'page_number' => [
                'required',
                'integer',
                'min:1',
                $id
                    ? Rule::unique('pages', 'page_number')->ignore($id)
                    : Rule::unique('pages', 'page_number'),
            ],
            'chapter_id' => 'required|integer|min:1',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'page_number.required' => 'Page Number is required.',
            'chapter_id.required' => 'Chapter is required.',
            'content.required' => 'Content is required.',
        ];
    }
    /**
     * Force JSON response for validation errors
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}

