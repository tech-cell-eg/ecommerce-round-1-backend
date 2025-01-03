<?php

namespace App\Http\Controllers\API\UserCard;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserCard\UserCardRequest;
use App\Models\UserCard;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserCardController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
    {
        return ['auth:sanctum'];
    }

    /**
     * @OA\Get(
     *     path="/cards",
     *     tags={"card"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all user cards",
     *     description="Endpoint to Get all user cards",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401", 
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
    public function index()
    {
        $user = auth()->user();
        return $this->success(200, 'Cards retrieved successfully', $user->cards);
    }

    /**
     * @OA\Post(
     *     path="/cards/store",
     *     tags={"card"},
     *     security={{"bearerAuth": {}}},
     *     summary="Submit credit card information",
     *     description="Endpoint to submit credit card information",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"card_name", "card_number", "card_expiry_date", "card_cvv"},
     *                 @OA\Property(
     *                     property="card_name",
     *                     type="string",
     *                     description="Name on the credit card",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="card_number",
     *                     type="string",
     *                     description="Credit card number",
     *                     example="1234567812345678"
     *                 ),
     *                 @OA\Property(
     *                     property="card_expiry_date",
     *                     type="string",
     *                     description="Expiry date of the credit card (MM/YY)",
     *                     example="12/25"
     *                 ),
     *                 @OA\Property(
     *                     property="card_cvv",
     *                     type="string",
     *                     description="CVV of the credit card",
     *                     example="123"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401", 
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/cards/{id}",
     *     tags={"card"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete a user card by id",
     *     description="Endpoint to delete a user card by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401", 
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
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
