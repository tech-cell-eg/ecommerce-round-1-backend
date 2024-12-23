<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'slug' => 'sometimes|required|unique:blogs,slug',
            'content' => 'sometimes|required|string',
            'featured_image' => 'nullable|image',
            'tags' => 'nullable',
            'status' => 'sometimes|required|string',
            'category' => 'sometimes|required|string|exists:categories,name',
            'is_featured' => 'sometimes|required|boolean'
        ];
    }
}
