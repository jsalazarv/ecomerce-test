<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['sometimes','string', 'max:255', Rule::unique('products', 'name')->ignore(request()->id)],
            'description' => ['sometimes', 'string', 'max:255'],
            'price' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'boolean'],
            'photos' => ['sometimes', 'array', 'min:1'],
            'photos.*' => ['image', 'mimes:jpeg,png'],
        ];
    }
}
