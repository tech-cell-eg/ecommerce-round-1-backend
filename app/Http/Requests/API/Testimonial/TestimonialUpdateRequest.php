<?php

namespace App\Http\Requests\API\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'video' => 'nullable|file|mimes:mp4', 
            'product_id' => 'exists:products,id',
            'text' => 'string'
        ];
    }
}
