<?php

namespace App\Http\Requests\API\Order;

use App\Models\UserAddress;
use App\Models\UserCard;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'user_address_id' => ['required', 'integer', 'exists:user_addresses,id', function ($attribute, $value, $fail) {
                if (!UserAddress::where('id', $value)
                    ->where('user_id', auth()->user()->id)
                    ->exists()) {
                    $fail('This address id does not exist.');
                }
            }],
            'user_card_id' => ['required', 'integer', 'exists:user_cards,id', function ($attribute, $value, $fail) {
                if (!UserCard::where('id', $value)
                    ->where('user_id', auth()->user()->id)
                    ->exists()) {
                    $fail('This card id does not exist.');
                }
            }],
            'discount_code' => ['nullable', 'string'],
            'products' => ['required', 'array'],
            'products.*' => ['required', 'exists:products,id'],
            'quantities' => ['required', 'array', 'min:' . count($this->products)],
            'quantities.*' => ['required', 'min:1'],
            'sizes' => ['required', 'array', 'min:' . count($this->products)],
            'sizes.*' => ['required', 'in:S,M,L,XL,XXL'],
        ];
    }
}
