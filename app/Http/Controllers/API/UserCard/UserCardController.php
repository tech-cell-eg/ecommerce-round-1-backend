<?php

namespace App\Http\Controllers\API\UserCard;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserCard\UserCardRequest;
use App\Models\UserCard;
use App\Traits\ApiResponse;

class UserCardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user = auth()->user();
        return $this->success(200, 'Cards retrieved successfully', $user->cards);
    }

    public function store(UserCardRequest $userCard)
    {
        $validatedData = $userCard->validated();
        $user = auth()->user();
        foreach ($user->cards as $card) {
            if ($card->card_number === $validatedData['card_number']) {
                return $this->failed(422, 'Card number already exists.');
            }
        }
        $card = $user->cards()->create($validatedData);
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
