<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); // Will take id from route during update

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // The product name will be unique, but will ignore itself during the update.
                $id
                    ? Rule::unique('products', 'name')->ignore($id)
                    : Rule::unique('products', 'name'),
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.unique' => 'This product name already exists.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'category_ids.required' => 'At least one category is required.',
            'category_ids.*.exists' => 'Selected category is invalid.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
