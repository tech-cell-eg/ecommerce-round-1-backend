<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUSerRequest;
use App\Http\Requests\Users\UpdateUSerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.User.index', compact('users'));
    }


    public function create(): View
    {
        return view('admin.User.create');
    }


    public function store(StoreUSerRequest $request): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Hash the password and attach it to the data array
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user using the validated data
        $user = User::create($validatedData);


        event(new Registered($user));


        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('admin.User.edit', compact('user'));
    }


    public function update(UpdateUSerRequest $request, $id): RedirectResponse
    {
        $validatedData = $request->validated(); // Validate data

        // Find the user or fail
        $user = User::findOrFail($id);

        // Hash the password only if it was provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Remove password if not provided
        }

        // Update the user with the validated data
        $user->update($validatedData);


        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }



    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
