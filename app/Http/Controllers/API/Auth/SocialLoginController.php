<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use TechCell\TechcellSocialite\Facades\TechcellSocialite;

class SocialLoginController extends Controller
{
    use ApiResponse;

    public function providerAuth($provider)
    {
        return TechcellSocialite::loginUsingProvider($provider);
    }

    public function providerCallback($provider)
    {
        $providerUser = TechcellSocialite::callbackFromProvider($provider);
        $name = $providerUser->getName();
        $name = explode(" ", $name);
        $user = User::firstOrCreate(['email' => $providerUser->email], [
            'first_name' => $name[0],
            'last_name' => $name[1],
            'password' => Str::password(10),
            'terms_agreed' => 1
        ]);
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->success(200, 'User logged in successfully.', [
            'user' => $user,
            'token' => $token
        ]);
    }
}
