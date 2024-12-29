<?php

namespace App\Http\Requests\API\Review;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            "msg" => ["nullable"],
            "stars" => ["nullable", "min:1", "max:5"],
            "product_id" => ["nullable"],
            "name" => ["nullable", "string"],
            "email" => ["nullable", "email"]
        ];
    }
}
