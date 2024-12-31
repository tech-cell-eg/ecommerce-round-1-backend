<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialStoreRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'text' => 'required|string',
            'user_id' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Please select a product.',
            'product_id.exists'   => 'The selected product does not exist.',
            'image.image'         => 'The uploaded file must be an image.',
            'video.mimes'         => 'The video format must be mp4.',
            
        ];
    }
}
