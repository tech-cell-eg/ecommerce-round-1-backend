<?php

namespace App\Http\Requests\API\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddress extends FormRequest
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
            'name' => ['nullable','string','max:255'],
            'mobile_number' => ['nullable','string','size:11'],
            'address' => ['nullable','string'],
            'area' => ['nullable','string'],
            'pin_code' => ['nullable','integer','digits:5'],
            'city' => ['nullable','string'],
            'state' => ['nullable','string'],
            'default_address' => ['required','bool'],
        ];
    }
}
