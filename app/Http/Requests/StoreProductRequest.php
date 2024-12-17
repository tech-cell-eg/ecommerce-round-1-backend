<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|integer|min:0|max:5',
            'featured' => 'nullable|boolean',
            'image' => 'nullable|string',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'category_id' => 'required|exists:categories,id',
        ];
    }
}
