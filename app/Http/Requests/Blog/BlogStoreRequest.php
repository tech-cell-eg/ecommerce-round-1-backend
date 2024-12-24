<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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
            'slug' => 'required|unique:blogs,slug',
            'content' => 'required|string',
            'featured_image' => 'nullable|image',
            'tags' => 'nullable',
            'status' => 'required|string',
            'category' => 'required|string|exists:categories,name',
            'is_featured' => 'required|boolean',
            'author_id'=>'required|string|exists:users,id'
        ];
    }
}
