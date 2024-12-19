<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCardRequest;
use App\Models\UserCard;
use App\Traits\ApiResponse;

class UserCardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user_id = auth()->user()->id;
        $cards = UserCard::where('user_id', $user_id)->latest()->get();
        foreach ($cards as $card) {
            $card->card_number = decrypt($card->card_number);
            $card->card_cvv = decrypt($card->card_cvv);
        }
        return $this->success(200, 'Cards retrieved successfully', $cards);
    }

    public function create(UserCardRequest $userCard)
    {
        $validatedData = $userCard->validated();
        $user_id = auth()->user()->id;
        $decryptedCards = UserCard::where('user_id', $user_id)->latest()->get();
        foreach ($decryptedCards as $card) {
            $decryptedCardNumber = decrypt($card->card_number);
            if ($decryptedCardNumber === $validatedData['card_number']) {
                return $this->failed(422, 'Card number already exists.');
            }
        }
        $card = UserCard::create([
            'user_id' => $user_id,
            'card_name' => $validatedData['card_name'],
            'card_number' => encrypt($validatedData['card_number']),
            'card_expiry_date' => $validatedData['card_expiry_date'],
            'card_cvv' => encrypt($validatedData['card_cvv']),
        ]);
        return $this->success(200, 'Card created successfully', $card);
    }

    public function destroy(UserCard $userCard)
    {
        $user_id = auth()->user()->id;
        if ($userCard->user_id !== $user_id) {
            return $this->failed(404, 'Card not found.');
        }
        $userCard->delete();
        return $this->success(200, 'Your card deleted successfully');
    }


}
