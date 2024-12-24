<?php

namespace App\Http\Controllers\API\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Address\StoreUserAddress;
use App\Http\Requests\API\Address\UpdateUserAddress;
use App\Traits\ApiResponse;

class UserAddressController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return $this->success(200, 'Address list', $user->addresses()->orderBy('default_address', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddress $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();
        if ($validatedData['default_address']) {
            $user->addresses()->update(['default_address' => false]);
        }
        $address = $user->addresses()->create($validatedData);
        return $this->success(200, 'New address added', $address);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $address = $user->addresses()->findOrFail($id);
        return $this->success(200, 'Address updated successfully', $address);

    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $address = $user->addresses()->findOrFail($id);
        $address->delete();
        return $this->success(200, 'Address deleted');
    }
}
