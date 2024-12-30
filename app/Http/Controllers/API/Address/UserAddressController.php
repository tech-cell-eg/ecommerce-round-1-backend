<?php

namespace App\Http\Controllers\API\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Address\StoreUserAddress;
use App\Http\Requests\API\Address\UpdateUserAddress;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserAddressController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware()
    {
        return ['auth:sanctum'];
    }

    /**
     * @OA\Get(
     *     path="/addresses",
     *     tags={"address"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all addresses",
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
        return $this->success(200, 'Address list', $user->addresses()->orderBy('default_address', 'desc')->latest()->get());
    }

    /**
     * @OA\Post(
     *     path="/addresses",
     *     tags={"address"},
     *     security={{"bearerAuth": {}}},
     *     summary="Add user address",
     *     description="Endpoint to add user's address",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *             required={"name", "mobile_number", "address", "area", "pin_code", "city", "state", "default_address"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the recipient",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="mobile_number",
     *                 type="string",
     *                 description="Mobile number of the recipient",
     *                 example="9876543210"
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 type="string",
     *                 description="Street address of the recipient",
     *                 example="123 Elm Street"
     *             ),
     *             @OA\Property(
     *                 property="area",
     *                 type="string",
     *                 description="Area or locality of the address",
     *                 example="Downtown"
     *             ),
     *             @OA\Property(
     *                 property="pin_code",
     *                 type="string",
     *                 description="Postal code of the address",
     *                 example="560001"
     *             ),
     *             @OA\Property(
     *                 property="city",
     *                 type="string",
     *                 description="City of the address",
     *                 example="Bangalore"
     *             ),
     *             @OA\Property(
     *                 property="state",
     *                 type="string",
     *                 description="State of the address",
     *                 example="Karnataka"
     *             ),
     *             @OA\Property(
     *                 property="default_address",
     *                 type="boolean",
     *                 description="Indicates if this is the default address",
     *                 example=true
     *             )
     *         ))
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
    public function store(StoreUserAddress $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();
        if ($validatedData['default_address'] == 1) {
            $user->addresses()->update(['default_address' => 0]);
        }
        $address = $user->addresses()->create($validatedData);
        return $this->success(200, 'New address added', $address);
    }

    /**
     * @OA\Get(
     *     path="/addresses/{id}",
     *     tags={"address"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get address by id",
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
    public function show(string $id)
    {
        $user = auth()->user();
        $address = $user->addresses()->findOrFail($id);
        return $this->success(200, 'Address updated successfully', $address);

    }


    /**
     * @OA\Put(
     *     path="/addresses/{id}",
     *     tags={"address"},
     *     security={{"bearerAuth": {}}},
     *     summary="update user address",
     *     description="Endpoint to update user's address",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the recipient",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="mobile_number",
     *                 type="string",
     *                 description="Mobile number of the recipient",
     *                 example="9876543210"
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 type="string",
     *                 description="Street address of the recipient",
     *                 example="123 Elm Street"
     *             ),
     *             @OA\Property(
     *                 property="area",
     *                 type="string",
     *                 description="Area or locality of the address",
     *                 example="Downtown"
     *             ),
     *             @OA\Property(
     *                 property="pin_code",
     *                 type="string",
     *                 description="Postal code of the address",
     *                 example="560001"
     *             ),
     *             @OA\Property(
     *                 property="city",
     *                 type="string",
     *                 description="City of the address",
     *                 example="Bangalore"
     *             ),
     *             @OA\Property(
     *                 property="state",
     *                 type="string",
     *                 description="State of the address",
     *                 example="Karnataka"
     *             ),
     *             @OA\Property(
     *                 property="default_address",
     *                 type="boolean",
     *                 description="Indicates if this is the default address",
     *                 example=true
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
    public function update(UpdateUserAddress $request, string $id)
    {
        $user = auth()->user();
        $address = $user->addresses()->findOrFail($id);
        $validatedData = $request->validated();
        if (isset($validatedData['default_address'])) {
            $user->addresses()->update(['default_address' => false]);
        }
        $address->update($validatedData);
        return $this->success(200, 'Address updated successfully', $address);
    }

    /**
     * @OA\Delete(
     *     path="/addresses/{id}",
     *     tags={"address"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete address by id",
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
    public function destroy(string $id)
    {
        $user = auth()->user();
        $address = $user->addresses()->findOrFail($id);
        $address->delete();
        return $this->success(200, 'Address deleted');
    }
}
