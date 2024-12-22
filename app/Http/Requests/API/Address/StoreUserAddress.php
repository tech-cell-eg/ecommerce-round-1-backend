<?php

namespace App\Http\Requests\API\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddress extends FormRequest
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
            'name' => ['required','string','max:255'],
            'mobile_number' => ['required','string','size:11'],
            'address' => ['required','string'],
            'area' => ['required','string'],
            'pin_code' => ['required','integer','digits:5'],
            'city' => ['required','string'],
            'state' => ['required','string'],
            'default_address' => ['required','bool'],
        ];
    }
}
