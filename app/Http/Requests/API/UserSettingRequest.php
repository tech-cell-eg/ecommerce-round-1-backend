<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingRequest extends FormRequest
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
            'appearance' => ['nullable','string','in:light,dark'],
            'language' => ['nullable','string','in:en,ar'],
            'two_factor_authentication' => ['nullable','bool'],
            'push_notifications' => ['nullable','bool'],
            'desktop_notification' => ['nullable','bool'],
            'email_notifications' => ['nullable','bool'],
        ];
    }
}
