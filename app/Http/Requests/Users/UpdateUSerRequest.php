<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUSerRequest extends FormRequest
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
        $userId = $this->route('user');
        return [
            'first_name' => ['sometimes','required', 'string', 'max:255'],
            'last_name' => ['sometimes','required', 'string', 'max:255'],
            'email' => ['sometimes','required','string','lowercase','email','max:255',
            'unique:' . User::class . ',email,' . $userId,
            ],
            'password' => ['sometimes','nullable', Rules\Password::defaults()], // Password is optional on updates
        ];
    }
}
