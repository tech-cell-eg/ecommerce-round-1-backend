<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCardRequest extends FormRequest
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
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'min:16', 'max:16', 'unique:user_cards,card_number'],
            'card_expiry_date' => ['required', 'date_format:m-y'],
            'card_cvv' => ['required', 'string', 'size:3'],
        ];
    }
}
