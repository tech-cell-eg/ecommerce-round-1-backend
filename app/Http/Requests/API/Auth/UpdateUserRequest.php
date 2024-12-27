<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'mobile_number' => ['nullable', 'string', 'size:11','required_with:address'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'string','required_with:mobile_number' ,function ($attribute, $value, $fail) {
                $address = explode(',', $value);
                if (count($address) !== 5) {
                    $fail('Please enter the address in this format: address, Area, City, State, pin Code');
                } elseif (!is_numeric($address[4]) || strlen(trim($address[4])) != 5) {
                    $fail('Please enter a valid pin code of 5 digits.');
                }
            }],
        ];
    }
}
